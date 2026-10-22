<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RecoverSales extends MY_Controller {
    public function __construct() {
        parent::__construct();
        // Load the main sales model to use its insertion features
        $this->load->model('Sales_model', 'sales_mdl');
        // Load our custom recover model for customer and item checks
        $this->load->model('RecoverSales_model', 'recover');
    }

    public function import_from_file() {
        ini_set('max_execution_time', 30000000);
        // Path to the pdf_temp directory
        $directory = FCPATH . 'pdf_temp/';
        
        if (!is_dir($directory)) {
            echo json_encode(['status' => false, 'message' => "Directory not found: " . $directory]);
            return;
        }

        // Get all JSON files from the directory (sorted numerically)
        $files = glob($directory . '*.json');
        
        if (empty($files)) {
            echo json_encode(['status' => false, 'message' => "No JSON files found in: " . $directory]);
            return;
        }

        // Sort files numerically by the numeric prefix
        usort($files, function($a, $b) {
            preg_match('/(\d+)_/', basename($a), $matches_a);
            preg_match('/(\d+)_/', basename($b), $matches_b);
            $num_a = isset($matches_a[1]) ? intval($matches_a[1]) : 0;
            $num_b = isset($matches_b[1]) ? intval($matches_b[1]) : 0;
            return $num_a - $num_b;
        });

        $results = [];

        // Loop through each JSON file
        foreach ($files as $file_path) {
            if (!file_exists($file_path)) {
                continue;
            }

            $json_content = file_get_contents($file_path);
            $data_array = json_decode($json_content, true);
            
            if(!is_array($data_array)) {
                continue;
            }

            // Check if this is a single invoice object or an array of invoices
            // Single invoice will have 'inv_no' and 'to' keys
            if(isset($data_array['inv_no']) && isset($data_array['to'])) {
                // Single invoice object - wrap in array
                $data_array = [$data_array];
            }

            // Process each record in the current JSON file
            foreach($data_array as $data) {
            $customer_name = isset($data['to']) ? $data['to'] : 'Walk-in Customer';
            $tin = isset($data['gst_no']) ? $data['gst_no'] : '';
            $phone = isset($data['phone']) ? $data['phone'] : '';
            $invoice = isset($data['inv_no']) ? $data['inv_no'] : 'INV-'.time();
            $invoice_date = isset($data['date']) ? $data['date'] : date('Y-m-d');
            $grand_total = isset($data['grand_total']) ? (float)$data['grand_total'] : 0;
            $total_tax = isset($data['gst_total']) ? (float)$data['gst_total'] : 0;
            $subtot = isset($data['total']) ? (float)$data['total'] : 0;
            
            // Newly mapped fields from puthen.php view
            $ewb_no = isset($data['ewb_no']) ? $data['ewb_no'] : '';
            $remarks = isset($data['remarks']) ? $data['remarks'] : '';
            $adjustment = isset($data['adjustment']) ? (float)$data['adjustment'] : 0; // Exchange Amount
            $cess = isset($data['cess']) ? (float)$data['cess'] : 0; // KFC(1%)
            
            // Check if customer exists or create new
            $customer_id = $this->recover->find_or_create_customer($customer_name,$tin,$phone);
            
            $insert_data = array(
                'customer_id' => $customer_id,
                'invoice' => $invoice,
                'invoice_date' => $invoice_date,
                'total' => $grand_total,
                'status' => 'completed',
                'type' => 'sales',
                'redeemed_amount'=>0,
                'redeemed_points' => 0,
                'bill_type' => 2,
                'cash_type' => 'Cash',
                'saletype' => 'b2c',
                'tax' => $total_tax,
                'tax_id' => 0,
                'discount' => isset($data['discount']) ? (float)$data['discount'] : 0,
                'roundoff' => 0,
                'created_date' => date('Y-m-d H:i:s'),
                'created_by' => 1,
                'published' => 'yes',
                'cost_center' => 1,
                'cusname' => $customer_name,
                'narration' => 'Recovered Sales Invoice:- ' . $invoice . ' on ' . $invoice_date,
                'ref_id' => 0,
                'ref_no' => '',
                'estimate_id' => 0,
                
                // Additional mapped fields
                'ewb_no' => $ewb_no,
                'remarks' => $remarks,
                'adjustment_amount' => $adjustment,
                'cess' => $cess,
                
                // Fields to prevent Undefined index
                'freight' => 0,
                'other' => 0,
                'advance' => 0,
                'ref_amount' => 0,
                'cash_amount' => $grand_total,
                'delivery_date' => $invoice_date,
                'credit_eod' => $invoice_date,
                'salesman' => 1,
                'route' => '',
                'vehicle' => '',
                'area' => '',
                'cusdetails' => '',
                'cusemail' => '',
                'additional_cess' => 0,
                'device_id' => '',
                'is_mobile' => 1,
                'longitude' => '',
                'latitude' => '',
                'terms_condition' => '',
                'despatch_details' => '',
                'printtype' => 1
            );
            
            // Insert main sales header
            $insert_id = $this->sales_mdl->InsertSales($insert_data, 1);
            
            // Insert line items
            if(isset($data['line_items']) && is_array($data['line_items'])) {
                foreach($data['line_items'] as $item) {
                    if(empty($item['description_of_goods'])) continue;

                    $item_id = $this->recover->find_or_create_item($item['description_of_goods'], isset($item['hsn_code']) ? $item['hsn_code'] : null);
                    
                    // Address OCR issues: Fallback qty to 1 if missing or 0
                    $qty = (float)$item['qty'] > 0 ? (float)$item['qty'] : 1;
                    $free_quantity = isset($item['free_qty']) ? (float)$item['free_qty'] : 0;
                    $total = isset($item['total']) ? (float)$item['total'] : 0;
                    $dis_amt = isset($item['dis_amt']) ? (float)$item['dis_amt'] : (isset($item['discount']) ? (float)$item['discount'] : 0);
                    $gst_percent = isset($item['gst_percent']) ? (float)$item['gst_percent'] : 0;
                    $itmrate = isset($item['rate']) ? (float)$item['rate'] : 0;
                    // Tax parsing
                    $sgst = isset($item['sgst']) ? (float)$item['sgst'] : 0;
                    $cgst = isset($item['cgst']) ? (float)$item['cgst'] : 0;
                    $tax_amount = isset($item['gst_amount']) ? (float)$item['gst_amount'] : ($sgst + $cgst);
                    
                    // Calculations as per formula: 
                    // taxable = total / (1 + (gst_percent / 100))
                    // (qty * mrp) - dis_amt = taxable -> mrp = (taxable + dis_amt) / qty
                    // discount_percentage = (dis_amt / (qty * mrp)) * 100
                    
                    $taxable = $total / (1 + ($gst_percent / 100));
                    $mrp = ($taxable + $dis_amt) / $qty;
                    
                    $discount_percentage = 0;
                    if ($mrp > 0) {
                        $discount_percentage = ($dis_amt / ($qty * $mrp)) * 100;
                    }
                    
                    $qry = 'select * from taxgst where GST = '.$gst_percent.' ';
                    $tax_p = $this->db->query($qry)->row_array();
                    $tax_id = $tax_p ? $tax_p['gstid'] : 0;
                    
                    $data_items = array(
                        'sales_id' => $insert_id,
                        'item_id' => $item_id,
                        'quantity' => $qty,
                        'rate' => $discount_percentage,
                        'discount' => 0,
                        'total' => $total,
                        'tax' => $tax_amount,
                        'tax_id' => $tax_id,
                        'published' => 'yes',
                        'unit_id' => 1,
                        'base_unit_id' => 1,
                        'godown' => 1,
                        'item_rate' => $mrp,
                        'mrp' => $itmrate,
                        'actual_quantity' => $qty,
                        'is_taxincluded' => '0',
                        'itm_ces_id' => 0,
                        'itm_raw_ces' => 0,
                        'ces_amt' => 0,
                        'free_quantity' => $free_quantity,
                        'sales_ref_type' => 'Nil',
                        'batch' => '',
                        'dis_amt' => $dis_amt,
                        'mar_pur_rate' => $mrp,
                        'sales_ref_id' => 0,
                        'damage_quantity' => 0,
                        'itm_ces_name' => '',
                        'itm_ces_per' => 0,
                        'ces' => 0,
                        'item_margin' => 0
                    );
                    
                    $this->sales_mdl->InsertSales_items($data_items, 'sales', $invoice_date, 1, 1, $invoice, 'b2c');
                }
            }
            
            // Generate ledgers and accounting entries
            $this->sales_mdl->savesub($insert_data, 'sales', $insert_id, $subtot, $total_tax, 0, 0, 1, 1);
            
            $results[] = $insert_id;
            }
        }
        
        echo json_encode(['status' => true, 'message' => "Bulk Sales imported successfully from " . count($files) . " files", 'imported_ids' => $results]);
    }
}
