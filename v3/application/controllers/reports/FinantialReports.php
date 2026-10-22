<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accounts
 *
 * @author u43255
 */
class FinantialReports extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('excel');   //load PHPExcel library
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('reports/FinantialReports_model', 'finantial');

    }

    public function BalanceSheetData(){
        $start_date = $this->input->post('startdate');
        $end_date = $this->input->post('enddate');
        $includeDetails = $this->input->post('includeDetails');
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data = $this->finantial->BalanceSheetData($start_date, $end_date,$includeDetails);
        $this->load->view('reports/finantialreports/balancesheet', $data);    
    }

    function num($num) {
        return number_format($num, 2);
    }

public function export_transactions_pdf() {
    $enddate = $this->input->post('enddate');
    $includeDetails = $this->input->post('includeDetails') ?? 0;

    $TrialBalanceData = $this->finantial->TrialBalanceData($enddate, $includeDetails);
    
    $settings = $this->finantial->getCompanySettings();
    $TrialBalanceData['company_name'] = isset($settings[0]['name']) ? $settings[0]['name'] : 'Company';
    $TrialBalanceData['enddate'] = $enddate;

    $html = $this->load->view('reports/finantialreports/trialbalance_pdf', $TrialBalanceData, true);

    $this->load->library('M_pdf');
    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => 'A4-L', 'autoPageBreak' => TRUE];
    $this->m_pdf->load();
    $pdf = $this->m_pdf->pdf;
    
    $pdf->WriteHTML($html);
    
    $filepath = './uploads/trailbalance.pdf';
    $pdf->Output($filepath, 'F');
    
    echo base_url('uploads/trailbalance.pdf');
    exit;
}

public function export_transactions() {
    $includeDetails = $this->input->post('includeDetails') ?? 0;
    $enddate = $this->input->post('enddate');
    $TrialBalanceData = $this->finantial->TrialBalanceData($enddate, $includeDetails);

    $this->load->library('PHPExcel');
    $objPHPExcel = new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();

    $objPHPExcel->getProperties()->setTitle("Transaction Report")
                                ->setSubject("Transaction Report");
    $Transactions = $TrialBalanceData['Transactions'];
    $openstock = round($TrialBalanceData['openstock'] ?? 0, 2);

    $groupedTransactions = [];
    foreach ($Transactions as $transaction) {
        $mainAccount = $transaction['mainaccount'];
        $d = round($transaction['debit'], 2);
        $c = round($transaction['credit'], 2);

        if (!isset($groupedTransactions[$mainAccount])) {
            $groupedTransactions[$mainAccount] = [
                'sum_d' => 0,
                'sum_c' => 0,
                'items' => []
            ];
        }
        $groupedTransactions[$mainAccount]['items'][] = [
            'NAME'   => $transaction['NAME'],
            'debit'  => $d,
            'credit' => $c
        ];
        $groupedTransactions[$mainAccount]['sum_d'] += $d;
        $groupedTransactions[$mainAccount]['sum_c'] += $c;
    }

    $displayTotalDebit  = $openstock;
    $displayTotalCredit = 0;

    foreach ($groupedTransactions as $group) {
        $net = $group['sum_d'] - $group['sum_c'];
        if ($net > 0) {
            $displayTotalDebit += $net;
        } elseif ($net < 0) {
            $displayTotalCredit += abs($net);
        }
    }

    $adjDebit = 0;
    $adjCredit = 0;
    $diff = $displayTotalDebit - $displayTotalCredit;
    if (round($diff, 2) != 0) {
        if ($diff > 0) {
            $adjCredit = abs($diff);
            $displayTotalCredit += $adjCredit;
        } else {
            $adjDebit = abs($diff);
            $displayTotalDebit += $adjDebit;
        }
    }

    // Styles
    $headerStyle = [
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F8F9FA']],
        'borders' => ['allborders' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]
    ];
    
    $mainAccountStyle = [
        'font' => ['bold' => true],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'E9ECEF']]
    ];
    
    $subAccountStyle = [
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F8F9FA']]
    ];
    
    $adjustmentStyle = [
        'font' => ['bold' => true, 'italic' => true, 'color' => ['rgb' => 'D9534F']],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'FFF8F8']]
    ];

    $grandTotalStyle = [
        'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => '333333']]
    ];

    // Set column headers
    $sheet->setCellValue('A1', 'SL No')->getStyle('A1')->applyFromArray($headerStyle);
    $sheet->setCellValue('B1', 'Account Head / Ledger')->getStyle('B1')->applyFromArray($headerStyle);
    $sheet->setCellValue('C1', 'Debit')->getStyle('C1')->applyFromArray($headerStyle);
    $sheet->setCellValue('D1', 'Credit')->getStyle('D1')->applyFromArray($headerStyle);

    // Set column widths
    $sheet->getColumnDimension('A')->setWidth(8);
    $sheet->getColumnDimension('B')->setWidth(40);
    $sheet->getColumnDimension('C')->setWidth(18);
    $sheet->getColumnDimension('D')->setWidth(18);

    $row = 2; // Start data at row 2

    // 1. Opening Stock Row
    $sheet->setCellValue('A'.$row, '');
    $sheet->setCellValue('B'.$row, 'Opening Stock')->getStyle('B'.$row)->getFont()->setBold(true);
    $sheet->setCellValue('C'.$row, number_format($openstock, 2));
    $sheet->setCellValue('D'.$row, '');
    $row++;

    $slno = 1;
    // 2. Main Accounts & Sub Items
    foreach ($groupedTransactions as $mainAccount => $group) {
        $headBalance = $group['sum_d'] - $group['sum_c'];
        
        $sheet->setCellValue('A'.$row, $slno++);
        $sheet->setCellValue('B'.$row, $mainAccount);
        $sheet->setCellValue('C'.$row, ($headBalance > 0) ? number_format(abs($headBalance), 2) : '');
        $sheet->setCellValue('D'.$row, ($headBalance < 0) ? number_format(abs($headBalance), 2) : '');
        $sheet->getStyle('A'.$row.':D'.$row)->applyFromArray($mainAccountStyle);
        $row++;

        foreach ($group['items'] as $item) {
            $sheet->setCellValue('A'.$row, '');
            $sheet->setCellValue('B'.$row, '    └ '.$item['NAME'])->getStyle('B'.$row)->applyFromArray($subAccountStyle);
            $sheet->setCellValue('C'.$row, ($item['debit'] > 0) ? number_format($item['debit'], 2) : '');
            $sheet->setCellValue('D'.$row, ($item['credit'] > 0) ? number_format($item['credit'], 2) : '');
            $sheet->getStyle('A'.$row.':D'.$row)->applyFromArray($subAccountStyle);
            $row++;
        }
    }

    // 3. Adjustment Row
    if ($adjDebit > 0 || $adjCredit > 0) {
        $sheet->setCellValue('A'.$row, '');
        $sheet->setCellValue('B'.$row, 'Adjustment / Difference in Trial Balance');
        $sheet->setCellValue('C'.$row, ($adjDebit > 0) ? number_format($adjDebit, 2) : '');
        $sheet->setCellValue('D'.$row, ($adjCredit > 0) ? number_format($adjCredit, 2) : '');
        $sheet->getStyle('A'.$row.':D'.$row)->applyFromArray($adjustmentStyle);
        $row++;
    }

    // 4. Grand Total Row
    $sheet->setCellValue('A'.$row, '');
    $sheet->setCellValue('B'.$row, 'GRAND TOTAL');
    $sheet->setCellValue('C'.$row, number_format($displayTotalDebit, 2));
    $sheet->setCellValue('D'.$row, number_format($displayTotalCredit, 2));
    $sheet->getStyle('A'.$row.':D'.$row)->applyFromArray($grandTotalStyle);

    $filepath = './uploads/trailbalance.xls';
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save($filepath);
    
    echo base_url('uploads/trailbalance.xls');
    exit;
}

    public function export_profit_loss() {
    // Load PHPExcel library
    $this->load->library('PHPExcel');
    $objPHPExcel = new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();

    // Get company and date information
    $settings = $this->finantial->getCompanySettings();
    $company_name = $settings[0]['name'];
    $start_date = $this->input->post('startdate') ?? date('Y-m-01');
    $end_date = $this->input->post('enddate') ?? date('Y-m-d');
    $mystart = $start_date;
    $myend = $end_date;
    $printed_date = date('d/m/Y h:i A');

    // Get P&L data
    $datas = $this->finantial->getProfitandLossData($start_date, $end_date);
    $direxp_data = $datas['direxp_data'] ?? [];
    $dirinc_data = $datas['dirinc_data'] ?? [];
    $indirexp_data = $datas['indirexp_data'] ?? [];
    $indirinc_data = $datas['indirinc_data'] ?? [];
    $openstock = isset($datas['openstock']) ? abs($datas['openstock']) : 0;
    $closingstock = isset($datas['closingstock']) ? abs($datas['closingstock']) : 0;
    $profit = $datas['profit'] ?? 0;
    $lose = $datas['lose'] ?? 0;

    // Calculate totals (same logic as HTML)
    $grouped_direxp = [];
    $total_direxp_items = 0;
    foreach ($direxp_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_direxp[$groupName])) {
            $grouped_direxp[$groupName] = ['total' => 0, 'items' => []];
        }
        $grouped_direxp[$groupName]['items'][] = $item;
        $grouped_direxp[$groupName]['total'] += $item['balance'];
        $total_direxp_items += $item['balance'];
    }
    $total_direxp = $openstock + $total_direxp_items;

    $grouped_dirinc = [];
    $total_dirinc_items = 0;
    foreach ($dirinc_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_dirinc[$groupName])) {
            $grouped_dirinc[$groupName] = ['total' => 0, 'items' => []];
        }
        $grouped_dirinc[$groupName]['items'][] = $item;
        $grouped_dirinc[$groupName]['total'] += $item['balance'];
        $total_dirinc_items += $item['balance'];
    }
    $total_dirinc = $closingstock + $total_dirinc_items;

    $gross_profit = $total_dirinc - $total_direxp;

    $grouped_indirexp = [];
    $total_indirexp = 0;
    foreach ($indirexp_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_indirexp[$groupName])) {
            $grouped_indirexp[$groupName] = ['total' => 0, 'items' => []];
        }
        $grouped_indirexp[$groupName]['items'][] = $item;
        $grouped_indirexp[$groupName]['total'] += $item['balance'];
        $total_indirexp += $item['balance'];
    }

    $grouped_indirinc = [];
    $total_indirinc = 0;
    foreach ($indirinc_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_indirinc[$groupName])) {
            $grouped_indirinc[$groupName] = ['total' => 0, 'items' => []];
        }
        $grouped_indirinc[$groupName]['items'][] = $item;
        $grouped_indirinc[$groupName]['total'] += $item['balance'];
        $total_indirinc += $item['balance'];
    }

    $net_profit = ($gross_profit + $total_indirinc) - $total_indirexp;
    $indinc = $gross_profit < 0 ? $gross_profit : 0;
    $indexp = $gross_profit >= 0 ? $gross_profit : 0;

    // Styles
    $mainHeaderStyle = [
        'font' => ['bold' => true, 'size' => 16],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
    ];
    
    $subHeaderStyle = [
        'font' => ['bold' => true, 'size' => 12],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
    ];
    
    $columnHeaderStyle = [
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F0F0F0']],
        'borders' => ['bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]
    ];
    
    $groupHeaderStyle = [
        'font' => ['bold' => true],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F8F8F8']]
    ];
    
    $negativeStyle = [
        'font' => ['color' => ['rgb' => 'FF0000']]
    ];
    
    $totalStyle = [
        'font' => ['bold' => true],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'EAEAEA']]
    ];
    
    $doubleUnderlineStyle = [
        'borders' => ['bottom' => ['style' => PHPExcel_Style_Border::BORDER_DOUBLE]]
    ];

    // Set headers
    $sheet->mergeCells('A1:E1');
    $sheet->setCellValue('A1', $company_name)->getStyle('A1')->applyFromArray($mainHeaderStyle);

    $sheet->mergeCells('A2:E2');
    $sheet->setCellValue('A2', 'Profit & Loss Statement')->getStyle('A2')->applyFromArray($subHeaderStyle);

    $sheet->mergeCells('A3:E3');
    $sheet->setCellValue('A3', 'From '.$mystart.' to '.$myend.' - Printed on '.$printed_date)
          ->getStyle('A3')->applyFromArray($subHeaderStyle);

    // Empty row
    $sheet->mergeCells('A4:E4');
    
    // Column headers
    $sheet->setCellValue('A5', 'Particulars')->getStyle('A5')->applyFromArray($columnHeaderStyle);
    $sheet->setCellValue('B5', 'Amount')->getStyle('B5')->applyFromArray($columnHeaderStyle);
    $sheet->setCellValue('D5', 'Particulars')->getStyle('D5')->applyFromArray($columnHeaderStyle);
    $sheet->setCellValue('E5', 'Amount')->getStyle('E5')->applyFromArray($columnHeaderStyle);

    $row = 6; // Start data at row 6

    // Opening and Closing Stock
    $sheet->setCellValue('A'.$row, 'Opening Stock');
    $sheet->setCellValue('B'.$row, $this->num($openstock));
    $sheet->setCellValue('D'.$row, 'Closing Stock');
    $sheet->setCellValue('E'.$row, $this->num($closingstock));
    $row++;

    // Section Header - Direct Expenses/Income
    $sheet->mergeCells('A'.$row.':B'.$row);
    $sheet->setCellValue('A'.$row, 'Direct Expense')->getStyle('A'.$row)->applyFromArray($groupHeaderStyle);
    $sheet->mergeCells('D'.$row.':E'.$row);
    $sheet->setCellValue('D'.$row, 'Direct Income')->getStyle('D'.$row)->applyFromArray($groupHeaderStyle);
    $row++;

    // Direct Expenses
    $left_row = $row;
    foreach ($grouped_direxp as $groupName => $group) {
        $sheet->setCellValue('A'.$left_row, $groupName)->getStyle('A'.$left_row)->applyFromArray($groupHeaderStyle);
        $sheet->setCellValue('B'.$left_row, $this->num($group['total']));
        if ($group['total'] < 0) {
            $sheet->getStyle('B'.$left_row)->applyFromArray($negativeStyle);
        }
        $left_row++;

        foreach ($group['items'] as $item) {
            $sheet->setCellValue('A'.$left_row, $item['ledger']);
            $sheet->setCellValue('B'.$left_row, $this->num($item['balance']));
            if ($item['balance'] < 0) {
                $sheet->getStyle('B'.$left_row)->applyFromArray($negativeStyle);
            }
            $left_row++;
        }
    }

    // Direct Income
    $right_row = $row;
    foreach ($grouped_dirinc as $groupName => $group) {
        $sheet->setCellValue('D'.$right_row, $groupName)->getStyle('D'.$right_row)->applyFromArray($groupHeaderStyle);
        $sheet->setCellValue('E'.$right_row, $this->num($group['total']));
        if ($group['total'] < 0) {
            $sheet->getStyle('E'.$right_row)->applyFromArray($negativeStyle);
        }
        $right_row++;

        foreach ($group['items'] as $item) {
            $sheet->setCellValue('D'.$right_row, $item['ledger']);
            $sheet->setCellValue('E'.$right_row, $this->num($item['balance']));
            if ($item['balance'] < 0) {
                $sheet->getStyle('E'.$right_row)->applyFromArray($negativeStyle);
            }
            $right_row++;
        }
    }

    $row = max($left_row, $right_row);

    // Gross Profit/Loss
    if ($gross_profit >= 0) {
        $sheet->setCellValue('A'.$row, 'Gross Profit')->getStyle('A'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('B'.$row, $this->num($gross_profit))->getStyle('B'.$row)->applyFromArray($totalStyle);
    } else {
        $sheet->setCellValue('D'.$row, 'Gross Loss')->getStyle('D'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('E'.$row, $this->num(abs($gross_profit)))->getStyle('E'.$row)->applyFromArray($totalStyle);
    }
    $row++;

    // Totals with double underline
    $sheet->setCellValue('A'.$row, 'Total')->getStyle('A'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('B'.$row, $this->num(max($total_dirinc, $total_direxp)))
         ->getStyle('B'.$row)->applyFromArray($doubleUnderlineStyle);
    $sheet->setCellValue('D'.$row, 'Total')->getStyle('D'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('E'.$row, $this->num(max($total_dirinc, $total_direxp)))
         ->getStyle('E'.$row)->applyFromArray($doubleUnderlineStyle);
    $row += 2; // Add empty row

    // Repeat Gross Profit/Loss in opposite position
    if ($gross_profit < 0) {
        $sheet->setCellValue('A'.$row, 'Gross Loss')->getStyle('A'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('B'.$row, $this->num(abs($gross_profit)))->getStyle('B'.$row)->applyFromArray($totalStyle);
    } else {
        $sheet->setCellValue('D'.$row, 'Gross Profit')->getStyle('D'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('E'.$row, $this->num($gross_profit))->getStyle('E'.$row)->applyFromArray($totalStyle);
    }
    $row++;

    // Section Header - Indirect Expenses/Income
    $sheet->mergeCells('A'.$row.':B'.$row);
    $sheet->setCellValue('A'.$row, 'Indirect Expense')->getStyle('A'.$row)->applyFromArray($groupHeaderStyle);
    $sheet->mergeCells('D'.$row.':E'.$row);
    $sheet->setCellValue('D'.$row, 'Indirect Income')->getStyle('D'.$row)->applyFromArray($groupHeaderStyle);
    $row++;

    // Indirect Expenses
    $left_row = $row;
    foreach ($grouped_indirexp as $groupName => $group) {
        $sheet->setCellValue('A'.$left_row, $groupName)->getStyle('A'.$left_row)->applyFromArray($groupHeaderStyle);
        $sheet->setCellValue('B'.$left_row, $this->num($group['total']));
        if ($group['total'] < 0) {
            $sheet->getStyle('B'.$left_row)->applyFromArray($negativeStyle);
        }
        $left_row++;

        foreach ($group['items'] as $item) {
            $sheet->setCellValue('A'.$left_row, $item['ledger']);
            $sheet->setCellValue('B'.$left_row, $this->num($item['balance']));
            if ($item['balance'] < 0) {
                $sheet->getStyle('B'.$left_row)->applyFromArray($negativeStyle);
            }
            $left_row++;
        }
    }

    // Indirect Income
    $right_row = $row;
    foreach ($grouped_indirinc as $groupName => $group) {
        $sheet->setCellValue('D'.$right_row, $groupName)->getStyle('D'.$right_row)->applyFromArray($groupHeaderStyle);
        $sheet->setCellValue('E'.$right_row, $this->num($group['total']));
        if ($group['total'] < 0) {
            $sheet->getStyle('E'.$right_row)->applyFromArray($negativeStyle);
        }
        $right_row++;

        foreach ($group['items'] as $item) {
            $sheet->setCellValue('D'.$right_row, $item['ledger']);
            $sheet->setCellValue('E'.$right_row, $this->num($item['balance']));
            if ($item['balance'] < 0) {
                $sheet->getStyle('E'.$right_row)->applyFromArray($negativeStyle);
            }
            $right_row++;
        }
    }

    $row = max($left_row, $right_row);

    // Net Profit/Loss
    if ($net_profit >= 0) {
        $sheet->setCellValue('A'.$row, 'Net Profit')->getStyle('A'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('B'.$row, $this->num($net_profit))->getStyle('B'.$row)->applyFromArray($totalStyle);
    } else {
        $sheet->setCellValue('D'.$row, 'Net Loss')->getStyle('D'.$row)->applyFromArray($totalStyle);
        $sheet->setCellValue('E'.$row, $this->num(abs($net_profit)))->getStyle('E'.$row)->applyFromArray($totalStyle);
    }
    $row++;

    // Final totals with double underline
    $sheet->setCellValue('A'.$row, 'Total')->getStyle('A'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('B'.$row, $this->num(max($total_indirinc + $indexp, $total_indirexp + $indinc)))
         ->getStyle('B'.$row)->applyFromArray($doubleUnderlineStyle);
    $sheet->setCellValue('D'.$row, 'Total')->getStyle('D'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('E'.$row, $this->num(max($total_indirinc + $indexp, $total_indirexp + $indinc)))
         ->getStyle('E'.$row)->applyFromArray($doubleUnderlineStyle);

    // Set column widths
    $sheet->getColumnDimension('A')->setWidth(40);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(5); // Spacer
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(15);

    // Format amount columns
    $sheet->getStyle('B6:B'.$sheet->getHighestRow())
          ->getNumberFormat()
          ->setFormatCode('#,##0.00');
    $sheet->getStyle('E6:E'.$sheet->getHighestRow())
          ->getNumberFormat()
          ->setFormatCode('#,##0.00');

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="profit_loss.xls"');
    header('Cache-Control: max-age=0');
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    
    // Optional: Save to file
    $filepath = './uploads/profitloss.xls';
    $objWriter->save($filepath);
    
    return $filepath;
}

public function export_balance_sheet() {
    // Load PHPExcel library
    $this->load->library('PHPExcel');
    $objPHPExcel = new PHPExcel();
    $sheet = $objPHPExcel->getActiveSheet();

    // Set document properties
    $objPHPExcel->getProperties()->setTitle("Balance Sheet")
                                ->setSubject("Balance Sheet");

    // Get company and date information
    $settings = $this->finantial->getCompanySettings();
    $company_name = $settings[0]['name'];
    $start_date = $this->input->post('startdate') ?? date('Y-m-01');
    $end_date = $this->input->post('enddate') ?? date('Y-m-d');
    $printed_date = date('d/m/Y h:i A');
    $includeDetails = $this->input->post('includeDetails') ?? 0 ;
    $datas = $this->finantial->BalanceSheetData($start_date, $end_date,$includeDetails);
    $liability_data = $datas['liability_data'];
    $asset_data = $datas['asset_data'];
    $lose = $datas['lose'];
    $profit = $datas['profit'];
    $closingstock = $datas['closingstock'];

    // Group liabilities
    $grouped_liability = [];
    foreach ($liability_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_liability[$groupName])) {
            $grouped_liability[$groupName] = [
                'total' => 0,
                'items' => []
            ];
        }
        $grouped_liability[$groupName]['items'][] = $item;
        $grouped_liability[$groupName]['total'] += $item['balance'];
    }

    // Group assets
    $grouped_asset = [];
    foreach ($asset_data as $item) {
        $groupName = $item['name'] ?? 'Other';
        if (!isset($grouped_asset[$groupName])) {
            $grouped_asset[$groupName] = [
                'total' => 0,
                'items' => []
            ];
        }
        $grouped_asset[$groupName]['items'][] = $item;
        $grouped_asset[$groupName]['total'] += $item['balance'];
    }

    $total_liability = array_sum(array_column($liability_data, 'balance')) + $profit;
    $total_asset = array_sum(array_column($asset_data, 'balance')) + $closingstock + $lose;
    $net_profit = $total_asset - $total_liability;

    // Styles
    $mainHeaderStyle = [
        'font' => ['bold' => true, 'size' => 16],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
    ];
    
    $subHeaderStyle = [
        'font' => ['bold' => true, 'size' => 12],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER]
    ];
    
    $columnHeaderStyle = [
        'font' => ['bold' => true],
        'alignment' => ['horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F0F0F0']],
        'borders' => ['bottom' => ['style' => PHPExcel_Style_Border::BORDER_THIN]]
    ];
    
    $groupHeaderStyle = [
        'font' => ['bold' => true],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'F8F8F8']]
    ];
    
    $negativeStyle = [
        'font' => ['color' => ['rgb' => 'FF0000']]
    ];
    
    $totalStyle = [
        'font' => ['bold' => true],
        'fill' => ['type' => PHPExcel_Style_Fill::FILL_SOLID, 'color' => ['rgb' => 'EAEAEA']]
    ];

    // Set headers
    $sheet->mergeCells('A1:E1');
    $sheet->setCellValue('A1', $company_name)->getStyle('A1')->applyFromArray($mainHeaderStyle);

    $sheet->mergeCells('A2:E2');
    $sheet->setCellValue('A2', 'Balance Sheet')->getStyle('A2')->applyFromArray($subHeaderStyle);

    $sheet->mergeCells('A3:E3');
    $sheet->setCellValue('A3', 'From '.$start_date.' to '.$end_date.' - Printed on '.$printed_date)
          ->getStyle('A3')->applyFromArray($subHeaderStyle);

    // Empty row
    $sheet->mergeCells('A4:E4');
    
    // Column headers
    $sheet->mergeCells('A5:B5');
    $sheet->setCellValue('A5', 'Liabilities')->getStyle('A5')->applyFromArray($columnHeaderStyle);
    $sheet->mergeCells('D5:E5');
    $sheet->setCellValue('D5', 'Assets')->getStyle('D5')->applyFromArray($columnHeaderStyle);
    
    // Amount column headers
    $sheet->setCellValue('B5', 'Amount');
    $sheet->setCellValue('E5', 'Amount');

    $row = 6; // Start data at row 6

    // Add Profit/Loss row if exists
    if ($profit > 0 || $lose > 0) {
        if ($profit > 0) {
            $sheet->setCellValue('A'.$row, 'Net Profit');
            $sheet->setCellValue('B'.$row, $this->num($profit));
        }
        
        if ($lose > 0) {
            $sheet->setCellValue('D'.$row, 'Net Loss');
            $sheet->setCellValue('E'.$row, $this->num($lose));
        }
        $row++;
    }

    // Prepare all items for both sides
    $left_items = [];
    $right_items = [];
    
    // Prepare left side items (Liabilities)
    foreach ($grouped_liability as $groupName => $group) {
        $left_items[] = ['type' => 'header', 'text' => $groupName, 'value' => $group['total']];
        foreach ($group['items'] as $item) {
            $left_items[] = ['type' => 'item', 'text' => $item['ledger'], 'value' => $item['balance']];
        }
    }
    
    // Prepare right side items (Assets)
    foreach ($grouped_asset as $groupName => $group) {
        $right_items[] = ['type' => 'header', 'text' => $groupName, 'value' => $group['total']];
        foreach ($group['items'] as $item) {
            $right_items[] = ['type' => 'item', 'text' => $item['ledger'], 'value' => $item['balance']];
        }
    }
    
    // Add closing stock to assets
    $right_items[] = ['type' => 'item', 'text' => 'Closing Stock', 'value' => $closingstock];
    
    // Determine which side has more items
    $max_items = max(count($left_items), count($right_items));
    
    // Output items while maintaining alignment
    for ($i = 0; $i < $max_items; $i++) {
        // Left side
        if (isset($left_items[$i])) {
            $item = $left_items[$i];
            $sheet->setCellValue('A'.$row, $item['text']);
            $sheet->setCellValue('B'.$row, $this->num($item['value']));
            if ($item['value'] < 0) {
                $sheet->getStyle('B'.$row)->applyFromArray($negativeStyle);
            }
            if ($item['type'] == 'header') {
                $sheet->getStyle('A'.$row)->applyFromArray($groupHeaderStyle);
            }
        }
        
        // Right side
        if (isset($right_items[$i])) {
            $item = $right_items[$i];
            $sheet->setCellValue('D'.$row, $item['text']);
            $sheet->setCellValue('E'.$row, $this->num($item['value']));
            if ($item['value'] < 0) {
                $sheet->getStyle('E'.$row)->applyFromArray($negativeStyle);
            }
            if ($item['type'] == 'header') {
                $sheet->getStyle('D'.$row)->applyFromArray($groupHeaderStyle);
            }
        }
        
        $row++;
    }

    // Difference row if needed
    if ($total_liability != $total_asset) {
        $difference = abs($total_liability - $total_asset);
        if ($total_asset > $total_liability) {
            $sheet->setCellValue('A'.$row, 'Difference in Opening');
            $sheet->setCellValue('B'.$row, $this->num($difference));
        }
        $row++;
    }

    // Grand Total
    $grand_total = max(abs($total_liability), abs($total_asset));
    $sheet->setCellValue('A'.$row, 'Total')->getStyle('A'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('B'.$row, $this->num($grand_total))->getStyle('B'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('D'.$row, 'Total')->getStyle('D'.$row)->applyFromArray($totalStyle);
    $sheet->setCellValue('E'.$row, $this->num($grand_total))->getStyle('E'.$row)->applyFromArray($totalStyle);

    // Set column widths
    $sheet->getColumnDimension('A')->setWidth(40);
    $sheet->getColumnDimension('B')->setWidth(15);
    $sheet->getColumnDimension('C')->setWidth(5); // Spacer
    $sheet->getColumnDimension('D')->setWidth(40);
    $sheet->getColumnDimension('E')->setWidth(15);

    // Format amount columns
    $sheet->getStyle('B6:B'.$row)
          ->getNumberFormat()
          ->setFormatCode('#,##0.00');
    $sheet->getStyle('E6:E'.$row)
          ->getNumberFormat()
          ->setFormatCode('#,##0.00');

    // Set headers and output
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="Balance_Sheet.xls"');
    header('Cache-Control: max-age=0');
    
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    
    // Optional: Save to file
    $filepath = './uploads/BalanceSheet.xls';
    $objWriter->save($filepath);
    
    return $filepath;
}

     public function TrialBalance(){
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/finantialreports/trialbalancereport');    
    }

    public function getTrialBalanceData(){
        $includeDetails = $this->input->post('includeDetails');
        $end_date = $this->input->post('enddate');
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data = $this->finantial->TrialBalanceData( $end_date,$includeDetails);
        $this->load->view('reports/finantialreports/trialbalance', $data);    
    }


    public function BalanceSheet(){
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/finantialreports/balancesheetreport');    
    }

    public function getProfitandLossData(){
        $start_date = $this->input->post('startdate');
        $end_date = $this->input->post('enddate');
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data = $this->finantial->getProfitandLossData($start_date, $end_date);
        $this->load->view('reports/finantialreports/profitandloss', $data);    
    }

     public function ProfitandLoss(){
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/finantialreports/profitandlosereport');    
    }

}
