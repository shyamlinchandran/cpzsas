<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Physical_inventory_import extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('excel'); 
        $this->load->model('Physical_inventory_import_model', 'import_model');
    }

    public function index() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('physical_stock/import_study');
    }

    public function study() {
        // Increase limits for processing large Excel files
        ini_set('max_execution_time', 3000000);
        ini_set('memory_limit', '-1');
        
        $response = array('valid' => false, 'message' => '', 'data' => []);
        
        if (isset($_FILES["file"]["name"]) && $_FILES["file"]["name"] != '') {
            $path = $_FILES["file"]["tmp_name"];
            try {
                $object = PHPExcel_IOFactory::load($path);
                $worksheet = $object->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                
                $data_rows = [];
                
                // Assuming data starts at Row 3 (Row 1 is report header, Row 2 is column headers)
                $startRow = 3;
                
                for ($row = $startRow; $row <= $highestRow; $row++) {
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Column B (Name)
                    $barcode = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); // Column C (Barcode)
                    $batch = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); // Column D (Batch)
                    $godown = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); // Column E (Godown)
                    $excel_closing_stock = $worksheet->getCellByColumnAndRow(5, $row)->getCalculatedValue(); // Column F (Closing Stock)
                    $excel_closing_rate = $worksheet->getCellByColumnAndRow(6, $row)->getCalculatedValue(); // Column G (Closing Rate)
                    $new_quantity = $worksheet->getCellByColumnAndRow(8, $row)->getCalculatedValue(); // Column I (Physical Stock)
                    
                    if (empty($name) && empty($barcode)) {
                        continue;
                    }
                    
                    $cleaned_name = $this->clean_item_name($name);
                    
                    // Match in DB
                    $db_item = null;
                    $match_status = 'Not Found';
                    $db_id = '';
                    $db_name = '';
                    $db_barcode = '';
                    $db_current_qty = 0.0;
                    $db_current_prate = 0.0;
                    
                    // 1. Try Barcode Match with name validation first (Priority 1 if barcode exists in Excel)
                    if (!empty($barcode)) {
                        $potential_item = $this->import_model->find_by_barcode($barcode, $cleaned_name);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                                $match_status = 'Found by Barcode';
                            }
                        }
                    }
                    
                    // 2. Try Name Match (Exact or normalized match) if barcode match not found
                    if (!$db_item && !empty($cleaned_name)) {
                        $db_item = $this->import_model->find_by_clean_name($cleaned_name, $barcode);
                        if ($db_item) {
                            $match_status = 'Found by Name';
                        }
                    }
                    
                    // 3. Try fuzzy name match with validation
                    if (!$db_item && !empty($cleaned_name)) {
                        $potential_item = $this->import_model->find_by_name_like($cleaned_name, $barcode);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                                $match_status = 'Found by Fuzzy Name';
                            }
                        }
                    }
                    
                    if ($db_item) {
                        // Normalize keys to lowercase to prevent array key case discrepancies
                        $db_item = array_change_key_case($db_item, CASE_LOWER);
                        
                        $db_id = $db_item['id'];
                        $db_name = $db_item['name'];
                        $db_barcode = $db_item['barcode'];
                        
                        $prate = isset($db_item['prate']) ? (float)$db_item['prate'] : 0.0;
                        $open_stk_rate = isset($db_item['open_stk_rate']) ? (float)$db_item['open_stk_rate'] : 0.0;
                        $openstkrate = isset($db_item['openstkrate']) ? (float)$db_item['openstkrate'] : 0.0;
                        
                        $db_current_prate = $prate;
                        if ($db_current_prate == 0.0) {
                            $db_current_prate = ($open_stk_rate == 0.0) ? $openstkrate : $open_stk_rate;
                        }
                        
                        $godown_id = $this->import_model->get_godown_id_by_name($godown);
                        $db_current_qty = $this->import_model->get_item_current_stock($db_id, $godown_id, $batch);
                    }
                    
                    $stock_diff = (float)($excel_closing_stock ? $excel_closing_stock : 0.0) - $db_current_qty;
                    $difference = (float)($new_quantity ? $new_quantity : 0.0) - $db_current_qty;
                    
                    $data_rows[] = array(
                        'row_no' => $row,
                        'excel_name' => $name,
                        'excel_barcode' => $barcode,
                        'cleaned_name' => $cleaned_name,
                        'excel_closing_stock' => $excel_closing_stock ? (float)$excel_closing_stock : 0.0,
                        'db_stock' => $db_current_qty,
                        'stock_diff' => $stock_diff,
                        'excel_physical_stock' => $new_quantity ? (float)$new_quantity : 0.0,
                        'difference' => $difference,
                        'excel_closing_rate' => $excel_closing_rate ? (float)$excel_closing_rate : 0.0,
                        'db_prate' => $db_current_prate,
                        'today_date' => date('Y-m-d'),
                        'db_id' => $db_id ? $db_id : 'Not Found',
                        'db_name' => $db_name ? $db_name : '-',
                        'db_barcode' => $db_barcode ? $db_barcode : '-',
                        'status' => $match_status
                    );
                }
                
                $response['valid'] = true;
                $response['data'] = $data_rows;
                
            } catch (Exception $e) {
                $response['message'] = 'Error reading file: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Please upload a valid Excel file.';
        }
        
        echo json_encode($response);
    }

    /**
     * Helper to clean item names, stripping bold tags, HTML tags, and trailing dashes
     */
    private function clean_item_name($name) {
        if (empty($name)) {
            return '';
        }
        
        // Trim spaces
        $name = trim($name);
        
        // Remove specific pattern like " - <b>something</b>" or " - <b></b>" at the end
        $name = preg_replace('/\s*-\s*<b>.*?<\/b>\s*$/i', '', $name);
        
        // Strip other HTML tags
        $name = strip_tags($name);
        
        // Remove trailing dashes or spaces
        $name = preg_replace('/\s*-\s*$/i', '', $name);
        
        return trim($name);
    }

    /**
     * Verify name similarity for barcode match validation
     */
    private function are_names_similar($name1, $name2) {
        $n1 = $this->import_model->normalize_string($name1);
        $n2 = $this->import_model->normalize_string($name2);
        
        if (empty($n1) || empty($n2)) {
            return false;
        }
        
        // 1. Exact normalized match
        if ($n1 === $n2) {
            return true;
        }
        
        // 2. Substring match
        if (strpos($n1, $n2) !== false || strpos($n2, $n1) !== false) {
            return true;
        }
        
        // 3. Word overlap match
        $words1 = preg_split('/[^a-z0-9]/', strtolower(strip_tags($name1)), -1, PREG_SPLIT_NO_EMPTY);
        $words2 = preg_split('/[^a-z0-9]/', strtolower(strip_tags($name2)), -1, PREG_SPLIT_NO_EMPTY);
        
        // Filter out common small words
        $stop_words = array('rs', 'gm', 'kg', 'ml', 'and', 'with', 'for', 'the', 'pcs', 'set', 'of', 'in', 'a', 'b', 'c');
        $w1 = array_diff($words1, $stop_words);
        $w2 = array_diff($words2, $stop_words);
        
        if (empty($w1) || empty($w2)) {
            return false;
        }
        
        $intersect = array_intersect($w1, $w2);
        $overlap_count = count($intersect);
        
        $min_words = min(count($w1), count($w2));
        if ($min_words > 0) {
            $overlap_ratio = $overlap_count / $min_words;
            if ($overlap_ratio >= 0.70) {
                return true;
            }
        }
        
        // 4. Character sequence similarity
        similar_text($n1, $n2, $percent);
        if ($percent >= 70) {
            return true;
        }
        
        return false;
    }

    public function debug_cli() {
        if (!is_cli()) {
            echo "CLI only";
            return;
        }
        $barcode = '8906034800796';
        $cleaned_name = 'A-One Bleaching Powder .250gm';
        
        $item = $this->import_model->find_by_barcode($barcode, $cleaned_name);
        echo "find_by_barcode item:\n";
        print_r($item);
        
        $item2 = $this->import_model->find_by_clean_name($cleaned_name, $barcode);
        echo "\nfind_by_clean_name item:\n";
        print_r($item2);
    }

    public function ImportDummyPhysicalInventory() {
        // Increase execution time and memory limit to handle very large Excel files
        ini_set('max_execution_time', 3000000);
        ini_set('memory_limit', '1024M');
        
        $response = array('valid' => false, 'message' => '');
        
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $path = $_FILES['file']['tmp_name'];
            
            try {
                $object = PHPExcel_IOFactory::load($path);
                $worksheet = $object->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                
                $items_to_insert = [];
                $startRow = 3;
                
                for ($row = $startRow; $row <= $highestRow; $row++) {
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Column B (Name)
                    $barcode = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); // Column C (Barcode)
                    $batch = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); // Column D (Batch)
                    $godown = $worksheet->getCellByColumnAndRow(4, $row)->getValue(); // Column E (Godown)
                    $excel_closing_stock = $worksheet->getCellByColumnAndRow(5, $row)->getCalculatedValue(); // Column F (Closing Stock)
                    $new_quantity = $worksheet->getCellByColumnAndRow(8, $row)->getCalculatedValue(); // Column I (Physical Stock)
                    
                    if (empty($name) && empty($barcode)) {
                        continue;
                    }
                    
                    $cleaned_name = $this->clean_item_name($name);
                    
                    // Match in DB
                    $db_item = null;
                    
                    // 1. Try Barcode Match with name validation first (Priority 1 if barcode exists in Excel)
                    if (!empty($barcode)) {
                        $potential_item = $this->import_model->find_by_barcode($barcode, $cleaned_name);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    // 2. Try Name Match (Exact or normalized match) if barcode match not found
                    if (!$db_item && !empty($cleaned_name)) {
                        $db_item = $this->import_model->find_by_clean_name($cleaned_name, $barcode);
                    }
                    
                    // 3. Try fuzzy name match with validation
                    if (!$db_item && !empty($cleaned_name)) {
                        $potential_item = $this->import_model->find_by_name_like($cleaned_name, $barcode);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    if ($db_item) {
                        // Normalize keys to lowercase to prevent array key case discrepancies
                        $db_item = array_change_key_case($db_item, CASE_LOWER);
                        
                        $db_id = $db_item['id'];
                        $db_barcode = $db_item['barcode'];
                        
                        $godown_id = $this->import_model->get_godown_id_by_name($godown);
                        $db_current_qty = $this->import_model->get_item_current_stock($db_id, $godown_id, $batch);
                        
                        $items_to_insert[] = array(
                            'item' => $db_id,
                            'barcode' => $db_barcode,
                            'godown' => $godown_id,
                            'batch' => $batch ? $batch : '',
                            'currentstock' => $new_quantity ? (float)$new_quantity : 0.0, // Physical stock in Excel
                            'actualstock' => $db_current_qty, // DB Stock (open_stock + current_stock)
                            'updatequantity' => (float)($new_quantity ? $new_quantity : 0.0) - $db_current_qty // Difference
                        );
                    }
                }
                
                if (empty($items_to_insert)) {
                    throw new Exception("No matching database items found to import.");
                }
                
                // Chunk items in groups of 50
                $chunks = array_chunk($items_to_insert, 50);
                $inserted_vouchers = [];
                $user_id = $this->session->userdata('user_id') ?? $this->session->userdata('id') ?? 1;
                
                foreach ($chunks as $chunk) {
                    // Get next voucher number
                    $voucher_no = $this->get_next_voucher_no();
                    
                    // Insert into phy_stk
                    $phy_stk_data = array(
                        'date' => date('Y-m-d'),
                        'voucher_no' => $voucher_no,
                        'user' => $user_id,
                        'published' => 'yes'
                    );
                    $this->db->insert('phy_stk', $phy_stk_data);
                    $phy_stk_id = $this->db->insert_id();
                    
                    // Insert items into phy_stk_items
                    foreach ($chunk as $item) {
                        $phy_stk_item_data = array(
                            'phy_stk_id' => $phy_stk_id,
                            'item' => $item['item'],
                            'barcode' => $item['barcode'],
                            'godown' => $item['godown'],
                            'batch' => $item['batch'],
                            'currentstock' => $item['currentstock'],
                            'actualstock' => $item['actualstock'],
                            'updatequantity' => $item['updatequantity'],
                            'is_delete' => 0 // active
                        );
                        $this->db->insert('phy_stk_items', $phy_stk_item_data);
                    }
                    
                    $inserted_vouchers[] = $voucher_no;
                }
                
                $response['valid'] = true;
                $response['message'] = 'Successfully imported ' . count($items_to_insert) . ' items into ' . count($chunks) . ' Physical Stock vouchers: ' . implode(', ', $inserted_vouchers);
                
            } catch (Exception $e) {
                $response['message'] = 'Error importing data: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Please upload a valid Excel file.';
        }
        
        echo json_encode($response);
    }
    
    /**
     * Get next voucher number
     */
    private function get_next_voucher_no() {
        $qry = "select * from phy_stk where published ='yes' order by phy_stk_Id desc limit 0,1";
        $query = $this->db->query($qry);
        if($query->num_rows() > 0 ){
            $query = $query->row_array();
            $invoice = str_replace('PHY', "", $query['voucher_no']);
            $invoice = (int) $invoice + 1;
            return 'PHY'.$invoice;
        }else{
            return 'PHY313'; // Default start
        }
    }

    public function UpdatePrate() {
        // Increase execution time and memory limit to handle very large Excel files
        ini_set('max_execution_time', 3000000);
        ini_set('memory_limit', '1024M');
        
        $response = array('valid' => false, 'message' => '');
        
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $path = $_FILES['file']['tmp_name'];
            
            try {
                $object = PHPExcel_IOFactory::load($path);
                $worksheet = $object->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                
                // Ensure the 'oldprate' column exists in the 'item' table
                if (!$this->db->field_exists('oldprate', 'item')) {
                    $this->db->query("ALTER TABLE item ADD COLUMN oldprate decimal(10,3) DEFAULT 0.000");
                }
                
                $updated_count = 0;
                $startRow = 3;
                
                for ($row = $startRow; $row <= $highestRow; $row++) {
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Column B (Name)
                    $barcode = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); // Column C (Barcode)
                    $excel_closing_rate = $worksheet->getCellByColumnAndRow(6, $row)->getCalculatedValue(); // Column G (Closing Rate)
                    
                    if (empty($name) && empty($barcode)) {
                        continue;
                    }
                    
                    $cleaned_name = $this->clean_item_name($name);
                    
                    // Match in DB
                    $db_item = null;
                    
                    // 1. Try Barcode Match with name validation first (Priority 1 if barcode exists in Excel)
                    if (!empty($barcode)) {
                        $potential_item = $this->import_model->find_by_barcode($barcode, $cleaned_name);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    // 2. Try Name Match (Exact or normalized match) if barcode match not found
                    if (!$db_item && !empty($cleaned_name)) {
                        $db_item = $this->import_model->find_by_clean_name($cleaned_name, $barcode);
                    }
                    
                    // 3. Try fuzzy name match with validation
                    if (!$db_item && !empty($cleaned_name)) {
                        $potential_item = $this->import_model->find_by_name_like($cleaned_name, $barcode);
                        if ($potential_item) {
                            if ($this->are_names_similar($cleaned_name, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    if ($db_item) {
                        $db_item = array_change_key_case($db_item, CASE_LOWER);
                        $db_id = $db_item['id'];
                        $current_db_prate = isset($db_item['prate']) ? (float)$db_item['prate'] : 0.0;
                        
                        // If current prate is 0, check open_stk_rate as fallback
                        if ($current_db_prate == 0.0) {
                            $open_stk_rate = isset($db_item['open_stk_rate']) ? (float)$db_item['open_stk_rate'] : 0.0;
                            $openstkrate = isset($db_item['openstkrate']) ? (float)$db_item['openstkrate'] : 0.0;
                            $current_db_prate = ($open_stk_rate == 0.0) ? $openstkrate : $open_stk_rate;
                        }
                        
                        $new_prate = $excel_closing_rate ? (float)$excel_closing_rate : 0.0;
                        
                        // Update item in database
                        $update_data = array(
                            'oldprate' => $current_db_prate,
                            'prate' => $new_prate
                        );
                        $this->db->where('id', $db_id);
                        $this->db->update('item', $update_data);
                        
                        $updated_count++;
                    }
                }
                
                $response['valid'] = true;
                $response['message'] = 'Successfully updated purchase rates (prate) for ' . $updated_count . ' items. Old rates were backed up to oldprate.';
                
            } catch (Exception $e) {
                $response['message'] = 'Error updating purchase rates: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Please upload a valid Excel file.';
        }
        
        echo json_encode($response);
    }

    public function CreatePhysicalStockComparison() {
        // Increase limits for processing large Excel files
        ini_set('max_execution_time', 3000000);
        ini_set('memory_limit', '1024M');
        
        $response = array('valid' => false, 'message' => '');
        
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            $path = $_FILES['file']['tmp_name'];
            
            try {
                $object = PHPExcel_IOFactory::load($path);
                $worksheet = $object->getActiveSheet();
                $highestRow = $worksheet->getHighestRow();
                
                // Create table physical_stock_comparison if it doesn't exist
                $create_table_query = "
                    CREATE TABLE IF NOT EXISTS `physical_stock_comparison` (
                        `id` int(11) NOT NULL AUTO_INCREMENT,
                        `excelname` varchar(255) NOT NULL,
                        `excelbarcode` varchar(100) DEFAULT NULL,
                        `excelcleanname` varchar(255) NOT NULL,
                        `excelcleanbarcode` varchar(100) DEFAULT NULL,
                        `excelqty` decimal(10,3) DEFAULT 0.000,
                        `excelrate` decimal(10,3) DEFAULT 0.000,
                        `dbqty` decimal(10,3) DEFAULT 0.000,
                        `dbrate` decimal(10,3) DEFAULT 0.000,
                        `dbitemid` int(11) DEFAULT NULL,
                        `dbname` varchar(255) DEFAULT NULL,
                        `dbbarcode` varchar(100) DEFAULT NULL,
                        `batch` varchar(255) DEFAULT NULL,
                        PRIMARY KEY (`id`)
                    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
                ";
                $this->db->query($create_table_query);
                
                // Alter table to add missing columns
                if (!$this->db->field_exists('batch', 'physical_stock_comparison')) {
                    $this->db->query("ALTER TABLE `physical_stock_comparison` ADD COLUMN `batch` varchar(255) DEFAULT NULL");
                }
                if (!$this->db->field_exists('dbitemid', 'physical_stock_comparison')) {
                    $this->db->query("ALTER TABLE `physical_stock_comparison` 
                        ADD COLUMN `dbitemid` int(11) DEFAULT NULL,
                        ADD COLUMN `dbname` varchar(255) DEFAULT NULL,
                        ADD COLUMN `dbbarcode` varchar(100) DEFAULT NULL");
                }
                
                // Truncate the table before inserting new comparison data
                $this->db->query("TRUNCATE TABLE `physical_stock_comparison`");
                
                $inserted_count = 0;
                $startRow = 3;
                
                for ($row = $startRow; $row <= $highestRow; $row++) {
                    $name = $worksheet->getCellByColumnAndRow(1, $row)->getValue(); // Column B (Name)
                    $barcode = $worksheet->getCellByColumnAndRow(2, $row)->getValue(); // Column C (Barcode)
                    $excel_batch = $worksheet->getCellByColumnAndRow(3, $row)->getValue(); // Column D (Batch)
                    $excel_batch = $excel_batch ? trim($excel_batch) : '';
                    $excel_rate = $worksheet->getCellByColumnAndRow(6, $row)->getCalculatedValue(); // Column G (Closing Stock Rate / excelrate)
                    $physical_stock = $worksheet->getCellByColumnAndRow(8, $row)->getCalculatedValue(); // Column I (Physical Stock / excelqty)
                    
                    if (empty($name) && empty($barcode)) {
                        continue;
                    }
                    
                    // Clean numeric inputs
                    $excel_rate = $excel_rate ? (float)str_replace(',', '', $excel_rate) : 0.0;
                    $physical_stock = $physical_stock ? (float)str_replace(',', '', $physical_stock) : 0.0;
                    
                    $excelcleanname = $this->clean_item_name($name);
                    $excelcleanbarcode = preg_replace('/[^0-9a-zA-Z]/', '', $barcode);
                    
                    // Match in DB
                    $db_item = null;
                    
                    // 1. Try Barcode Match with name validation first (Priority 1 if barcode exists in Excel)
                    if (!empty($barcode)) {
                        $potential_item = $this->import_model->find_by_barcode($barcode, $excelcleanname);
                        if ($potential_item) {
                            if ($this->are_names_similar($excelcleanname, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    // 2. Try Name Match (Exact or normalized match) if barcode match not found
                    if (!$db_item && !empty($excelcleanname)) {
                        $db_item = $this->import_model->find_by_clean_name($excelcleanname, $barcode);
                    }
                    
                    // 3. Try fuzzy name match with validation
                    if (!$db_item && !empty($excelcleanname)) {
                        $potential_item = $this->import_model->find_by_name_like($excelcleanname, $barcode);
                        if ($potential_item) {
                            if ($this->are_names_similar($excelcleanname, $potential_item['name'])) {
                                $db_item = $potential_item;
                            }
                        }
                    }
                    
                    $dbqty = 0.0;
                    $dbrate = 0.0;
                    $dbitemid = null;
                    $dbname_db = null;
                    $dbbarcode_db = null;
                    
                    if ($db_item) {
                        $db_item = array_change_key_case($db_item, CASE_LOWER);
                        $db_id = $db_item['id'];
                        $dbitemid = $db_id;
                        $dbname_db = $db_item['name'];
                        $dbbarcode_db = $db_item['barcode'];
                        
                        // Get DB rate (prate falling back to open_stk_rate/openstkrate if 0)
                        $prate = isset($db_item['prate']) ? (float)$db_item['prate'] : 0.0;
                        if ($prate == 0.0) {
                            $open_stk_rate = isset($db_item['open_stk_rate']) ? (float)$db_item['open_stk_rate'] : 0.0;
                            $openstkrate = isset($db_item['openstkrate']) ? (float)$db_item['openstkrate'] : 0.0;
                            $prate = ($open_stk_rate == 0.0) ? $openstkrate : $open_stk_rate;
                        }
                        $dbrate = $prate;
                        
                        // Get DB stock for this specific batch
                        $esc_batch = $this->db->escape($excel_batch);
                        if ($excel_batch !== '') {
                            $stock_res = $this->db->query("
                                SELECT SUM(IFNULL(current_stock, 0.00) + IFNULL(open_stock, 0.00)) as total_stock 
                                FROM item_godown 
                                WHERE item_id = {$db_id} AND batch = {$esc_batch}
                            ");
                        } else {
                            $stock_res = $this->db->query("
                                SELECT SUM(IFNULL(current_stock, 0.00) + IFNULL(open_stock, 0.00)) as total_stock 
                                FROM item_godown 
                                WHERE item_id = {$db_id} AND (batch = '' OR batch IS NULL)
                            ");
                        }
                        if ($stock_res && $stock_res->num_rows() > 0) {
                            $stock_row = $stock_res->row_array();
                            $dbqty = (float)$stock_row['total_stock'];
                        }
                    }
                    
                    // Insert into physical_stock_comparison
                    $comparison_data = array(
                        'excelname' => $name,
                        'excelbarcode' => $barcode,
                        'excelcleanname' => $excelcleanname,
                        'excelcleanbarcode' => $excelcleanbarcode,
                        'excelqty' => $physical_stock,
                        'excelrate' => $excel_rate,
                        'dbqty' => $dbqty,
                        'dbrate' => $dbrate,
                        'dbitemid' => $dbitemid,
                        'dbname' => $dbname_db,
                        'dbbarcode' => $dbbarcode_db,
                        'batch' => $excel_batch
                    );
                    $this->db->insert('physical_stock_comparison', $comparison_data);
                    $inserted_count++;
                }
                
                $response['valid'] = true;
                $response['message'] = 'Successfully created comparison table and inserted ' . $inserted_count . ' comparison records into physical_stock_comparison table (including dbitemid, dbname, and dbbarcode).';
                
            } catch (Exception $e) {
                $response['message'] = 'Error processing file: ' . $e->getMessage();
            }
        } else {
            $response['message'] = 'Please upload a valid Excel file.';
        }
        
        echo json_encode($response);
    }

    public function test_valuation() {
        echo "=== Bootstrapping CodeIgniter Database context ===\n";
        
        // 1. Query physical_stock_comparison values
        $comp_res = $this->db->query("SELECT SUM(excelqty * excelrate) as excel_val, SUM(dbqty * dbrate) as db_val FROM physical_stock_comparison")->row_array();
        $excel_val = (float)$comp_res['excel_val'];
        $comp_db_val = (float)$comp_res['db_val'];
        
        echo "physical_stock_comparison totals:\n";
        echo "  excelqty * excelrate = " . number_format($excel_val, 3) . "\n";
        echo "  dbqty * dbrate       = " . number_format($comp_db_val, 3) . "\n";
        
        // 2. Query total database valuation from Profit & Loss model
        $this->load->model('reports/FinantialReports_model', 'finantial');
        $pl_closing = $this->finantial->closingStock_new(date('Y-m-d'));
        echo "\nProfit & Loss Closing Stock Value: " . number_format($pl_closing, 3) . "\n";
        
        // 3. Difference
        $diff = $pl_closing - $comp_db_val;
        echo "Difference (P&L Closing Stock - Counted DB Stock): " . number_format($diff, 3) . "\n";
        
        // 4. Find where the difference comes from:
        // Sum of all items in database that have non-zero stock but are NOT in physical_stock_comparison
        $missing_res = $this->db->query("
            SELECT SUM((IFNULL(ig.open_stock, 0.00) + IFNULL(ig.current_stock, 0.00)) * CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END) as missing_val
            FROM item i
            INNER JOIN item_godown ig ON ig.item_id = i.id
            WHERE i.published = 'yes'
              AND i.id NOT IN (SELECT DISTINCT dbitemid FROM physical_stock_comparison WHERE dbitemid IS NOT NULL)
        ")->row_array();
        $missing_val = (float)$missing_res['missing_val'];
        echo "Valuation of database items NOT in physical_stock_comparison: " . number_format($missing_val, 3) . "\n";
    }
}
