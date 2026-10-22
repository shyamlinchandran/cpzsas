<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BankfdbExcelImport_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->model('vouchers_model', 'vouchers');
    }

    public function get_bill_type($type) {
        $trans = ($type == 'pay' || $type == 'payment') ? 'pay' : 'rec';
        $qry = "SELECT id FROM set_billtype WHERE transaction = '$trans' ORDER BY id ASC LIMIT 1";
        $query = $this->db->query($qry)->row_array();
        if ($query && isset($query['id'])) {
            return $query['id'];
        }
        return 1; // Default fallback bill_type
    }

    public function parse_excel_file($filePath) {
        $this->load->library('excel');
        $objReader = PHPExcel_IOFactory::createReaderForFile($filePath);
        $objPHPExcel = $objReader->load($filePath);

        $parsedRows = array();
        $sheetCount = $objPHPExcel->getSheetCount();

        for ($s = 0; $s < $sheetCount; $s++) {
            $sheet = $objPHPExcel->getSheet($s);
            $sheetTitle = strtolower(trim($sheet->getTitle()));

            // Determine default type based on sheet name or index
            $defaultType = 'receipt';
            if (strpos($sheetTitle, 'withdraw') !== false || strpos($sheetTitle, 'pay') !== false || $s == 1) {
                $defaultType = 'payment';
            }

            $highestRow = $sheet->getHighestRow();

            // Data starts at row 5 (Row 4 is header: Date | Particulars | Amount | Type)
            for ($r = 5; $r <= $highestRow; $r++) {
                $rawDate = trim($sheet->getCell('A' . $r)->getFormattedValue());
                $particulars = trim($sheet->getCell('B' . $r)->getValue());
                $rawAmount = trim($sheet->getCell('C' . $r)->getValue());
                $rawType = trim($sheet->getCell('D' . $r)->getValue());

                // Skip completely empty rows
                if (empty($rawDate) && empty($particulars) && empty($rawAmount)) {
                    continue;
                }

                // Sanitize amount (remove commas)
                $amount = (float) str_replace(',', '', $rawAmount);
                if ($amount <= 0) {
                    continue;
                }

                // Determine row type (override with Column D if present)
                $rowType = strtolower($rawType);
                if (strpos($rowType, 'pay') !== false || $rowType == 'payment' || $rowType == 'withdraw') {
                    $type = 'payment';
                } elseif (strpos($rowType, 'rec') !== false || $rowType == 'receipt' || $rowType == 'deposit') {
                    $type = 'receipt';
                } else {
                    $type = $defaultType;
                }

                // Parse date format (d-m-Y or Y-m-d)
                $dateFormatted = $this->format_date($rawDate);

                $parsedRows[] = array(
                    'row_no' => $r,
                    'sheet' => $sheet->getTitle(),
                    'date' => $dateFormatted,
                    'raw_date' => $rawDate,
                    'particulars' => !empty($particulars) ? $particulars : 'Suspence Account-0',
                    'amount' => $amount,
                    'type' => $type
                );
            }
        }

        return $parsedRows;
    }

    private function format_date($dateStr) {
        if (empty($dateStr)) {
            return date('Y-m-d');
        }

        // Standardize delimiters
        $cleanDate = str_replace(array('/', '.'), '-', trim($dateStr));
        $parts = explode('-', $cleanDate);

        if (count($parts) == 3) {
            // If DD-MM-YYYY
            if (strlen($parts[0]) == 2 && strlen($parts[2]) == 4) {
                return $parts[2] . '-' . sprintf('%02d', $parts[1]) . '-' . sprintf('%02d', $parts[0]);
            }
            // If YYYY-MM-DD
            if (strlen($parts[0]) == 4) {
                return $parts[0] . '-' . sprintf('%02d', $parts[1]) . '-' . sprintf('%02d', $parts[2]);
            }
        }

        $timestamp = strtotime($cleanDate);
        if ($timestamp !== false) {
            return date('Y-m-d', $timestamp);
        }

        return date('Y-m-d');
    }

    public function process_import($rows) {
        $created_by = 1;
        if ($this->session->has_userdata('user')) {
            $tmp = $this->session->userdata('user');
            $created_by = isset($tmp['Id']) ? $tmp['Id'] : 1;
        }

        $bankLedgerId = 166;       // Bank Account ID

        $successCount = 0;
        $errorCount = 0;

        foreach ($rows as $row) {
            $type = strtolower($row['type']);
            $amount = (float) $row['amount'];
            $date = $row['date'];
            $narration = $row['particulars'];

            if ($type == 'receipt' || $type == 'rec') {
                $suspenseLedgerId = 6734; // Suspense Account ID for Receipt
                $billtype = $this->get_bill_type('rec');
                $voucher_no = $this->vouchers->generatevouchernumber($billtype);

                $data = array(
                    'ledger' => $bankLedgerId,
                    'amount' => $amount,
                    'salesman' => 0,
                    'invoices' => '',
                    'cost_center' => 0,
                    'naration' => $narration,
                    'trans_date' => $date,
                    'created_date' => date('Y-m-d'),
                    'is_post' => "yes",
                    'bill_type' => $billtype,
                    'published' => "yes",
                    'created_by' => $created_by,
                    'reference' => ''
                );

                // Receipt: Bank (166) Debit, Suspense (6734) Credit
                $res = $this->vouchers->UpdateReceiptVoucher('rec', $data, 0, $suspenseLedgerId, $voucher_no, 0, $bankLedgerId);
                if (isset($res['valid']) && $res['valid']) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            } else {
                // Payment
                $suspenseLedgerId = 6735; // Suspense Account ID for Payment
                $billtype = $this->get_bill_type('pay');
                $voucher_no = $this->vouchers->generatevouchernumber($billtype);

                $data = array(
                    'ledger' => $bankLedgerId,
                    'amount' => $amount,
                    'salesman' => 0,
                    'invoices' => '',
                    'cost_center' => 0,
                    'naration' => $narration,
                    'trans_date' => $date,
                    'created_date' => date('Y-m-d'),
                    'is_post' => "yes",
                    'bill_type' => $billtype,
                    'published' => "yes",
                    'created_by' => $created_by,
                    'reference' => ''
                );

                // Payment: Suspense (6735) Debit, Bank (166) Credit
                $res = $this->vouchers->UpdatePaymentVoucher('pay', $data, 0, $suspenseLedgerId, $voucher_no, 0, $bankLedgerId);
                if (isset($res['valid']) && $res['valid']) {
                    $successCount++;
                } else {
                    $errorCount++;
                }
            }
        }

        return array(
            'success' => $successCount,
            'errors' => $errorCount,
            'total' => count($rows)
        );
    }
}
