<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxcall
 *
 * @author u43255
 */
class Ajaxcall extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('ajax_model', 'ajax');
    }

    public function getpurchaseitems($type = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->getpurchaseitems($search, $type);
    }


    public function update_jk_stock_cross_schema() {
    // 1. Extend limits for large data migration
    ini_set('max_execution_time', 0);
    ini_set('memory_limit', '512M');

    // 2. Fetch all unprocessed rows from the SOURCE database
    // Table: ozone_sfcho.jk_stock_detail
    $this->db->where('is_add', 0);
    $jk_details = $this->db->get('ozone_sfcho.jk_stock_detail')->result_array();

    $success_count = 0;
    $not_found_count = 0;

    foreach ($jk_details as $jk_row) {
        /**
         * 3. Match item in TARGET database
         * Logic: Match by Name and Barcode where it hasn't been updated yet (is_add=0)
         */
        $this->db->where('name', $jk_row['item_name']);
        $this->db->where('barcode', $jk_row['item_code']);
        $this->db->where('is_add', 0); 
        $item = $this->db->get('ozone_sfchn.item')->row();

        if ($item) {
            $itemId = $item->id;

            // 4. Get the specific Godown record (Godown 1) in TARGET
            $this->db->where('item_id', $itemId);
            $this->db->where('godown_id', 1);
            $godown_row = $this->db->get('ozone_sfchn.item_godown')->row();

            if ($godown_row) {
                // START TRANSACTION: Both databases update together or not at all
                $this->db->trans_start();

                // A. Update item_godown: Backup current to 'open', set new 'open_stock'
                $this->db->where('id', $godown_row->id);
                $this->db->update('ozone_sfchn.item_godown', [
                    'open'       => $godown_row->open_stock, 
                    'open_stock' => $jk_row['opening_stock']
                ]);

                // B. Mark Item in ozone_sfchn as updated
                $this->db->where('id', $itemId);
                $this->db->update('ozone_sfchn.item', ['is_add' => 1]);

                // C. Mark Record in ozone_sfcho as updated
                $this->db->where('id', $jk_row['id']);
                $this->db->update('ozone_sfcho.jk_stock_detail', ['is_add' => 1]);

                $this->db->trans_complete();

                if ($this->db->trans_status() === TRUE) {
                    $success_count++;
                }
            } else {
                // No entry found in item_godown for this item
                $not_found_count++;
            }
        } else {
            // No matching item found in ozone_sfchn.item
            $not_found_count++;
        }
    }

    echo "<h3>Migration Report</h3>";
    echo "Successfully updated: " . $success_count . " items.<br>";
    echo "Skipped/Not matched: " . $not_found_count . " items.";
}


public function tupdatestockmsa() {
    ini_set('max_execution_time', 300000);
 
// 1. Get the data from msait matched with the item master
$qry = "SELECT 1 AS godown_id, 
    i.id AS item_id, 
    a.rate AS openrate, 
    a.stock, 
    a.id AS msa_id  FROM msait a INNER JOIN item AS i ON i.barcode = a.barcode AND i.is_add = 0  WHERE a.is_add= 0 GROUP BY a.id;"; // Using a.id to ensure we process every line in msait

$msa_data = $this->db->query($qry)->result_array();

foreach($msa_data as $it) {
    $item_id  = $it['item_id'];
    $msa_id   = $it['msa_id'];
    $openrate = $it['openrate'];
    $stock    = $it['stock'];

    // 2. Find the FIRST entry in item_godown for this item in godown 1
    // We sort by ID ASC to ensure the update hits the primary/first batch
    $target_row = $this->db->query("SELECT id FROM item_godown 
                                    WHERE item_id = ? AND godown_id = 1 
                                    ORDER BY id ASC LIMIT 1", array($item_id))->row_array();

    if (!empty($target_row)) {
        $ig_id = $target_row['id'];

        // 3. Update item_godown (Only Open Stock and Rate, NOT current_stock)
        $this->db->where('id', $ig_id);
        $this->db->update('item_godown', [
            'open_stock'      => $stock,
            'item_opnstkrate' => $openrate
        ]);

        // 4. Update item table
        $this->db->where('id', $item_id);
        $this->db->update('item', [
            'openstkrate' => $openrate,
            'is_add'      => 1
        ]);

        // 5. Mark msait as processed so it doesn't repeat
        $this->db->where('id', $msa_id);
        $this->db->update('msait', ['is_add' => 1]);
    }
}
    // 1. Get unique rows from msait
    // Removed GROUP BY if you want to ensure every single row is evaluated, 
    // but kept it if you only want unique barcode/name combos.
    // $qry = "SELECT rate, stock, name, barcode FROM msait GROUP BY barcode, name";
    // $msa_data = $this->db->query($qry)->result_array();

    // $updated_count = 0;
    // $not_found_count = 0;
    // $already_had_stock = 0;

    // foreach($msa_data as $it) {
    //     $item_id = null;

    //     // 2. Priority Matching: Name+Barcode then Barcode Only
    //     $check = $this->db->query("SELECT id FROM item WHERE (name = ? AND barcode = ?) OR barcode = ? LIMIT 1", 
    //                                array($it['name'], $it['barcode'], $it['barcode']))->row();

    //     if ($check) {
    //         $item_id = $check->id;
            
    //         // 3. Find the record in item_godown for Godown 1
    //         $godown_row = $this->db->query("SELECT id, open_stock FROM item_godown 
    //                                        WHERE item_id = ? AND godown_id = 1 LIMIT 1", 
    //                                        array($item_id))->row();

    //         if ($godown_row) {
    //             // Determine if we should update stock (only if currently 0/NULL)
    //             $can_update_stock = ($godown_row->open_stock == 0 || $godown_row->open_stock == NULL);
                
    //             if ($can_update_stock) {
    //                 // Update BOTH stock and rate
    //                 $this->db->query("UPDATE item_godown 
    //                                  SET open_stock = ?, 
    //                                      item_opnstkrate = ? 
    //                                  WHERE id = ?", 
    //                                  array($it['stock'], $it['rate'], $godown_row->id));
    //                 $updated_count++;
    //             } else {
    //                 // Update ONLY the rate (as per your new request)
    //                 $this->db->query("UPDATE item_godown 
    //                                  SET item_opnstkrate = ? 
    //                                  WHERE id = ?", 
    //                                  array($it['rate'], $godown_row->id));
    //                 $already_had_stock++;
    //             }
    //         }
    //     } else {
    //         $not_found_count++;
    //     }
    // }
    
    // echo "--- Update Process Finished ---<br>";
    // echo "Total Source Rows evaluated: " . count($msa_data) . "<br>";
    // echo "New Stocks + Rates Updated: " . $updated_count . "<br>";
    // echo "Rates Updated (Stock already existed): " . $already_had_stock . "<br>";
    // echo "Items Not Found in Master Table: " . $not_found_count . "<br>";
    // echo "Total Handled: " . ($updated_count + $already_had_stock + $not_found_count);
}


    public function rupdatedate(){
        $qry ="SELECT b.sdb_name,a.com_id,a.created_at FROM cpzsas_main.company AS a INNER JOIN cpzsas_main.set_database AS b ON a.com_id = b.com_id WHERE a.created_at LIKE'%000%' ORDER BY a.com_id desc";
        $array = $this->db->query($qry)->result_array();
        foreach($array as $it){
            $qry ="SELECT table_schema AS Database_Name, MIN(create_time) AS Creation_Time FROM information_schema.tables WHERE table_schema = '".$it['sdb_name']."'Group by table_schema;";
            $res = $this->db->query($qry)->row_array();
            $qry ="update cpzsas_main.company set created_at = '".$res['Creation_Time']."' where com_id = ".$it['com_id'];
            $this->db->query($qry);
        }
    }

function ReportRequest($report_name) {
    // Get session data with validation
    $tmp = $this->session->userdata('user');
    if (!$tmp || !isset($tmp['Id']) || !isset($tmp['user_name'])) {
        throw new Exception('Invalid user session data');
    }
    $filtersJson = $_POST['filters'] ?? '{}'; // Default to empty object if not provided
    print_r($filtersJson);
    $createduserid = $tmp['Id'];
    $createdusername = $tmp['user_name'];
    $com_key = $this->session->userdata('login_comid');
    $fin_database = $this->session->userdata('login_database');
   

    $db_name = $fin_database;
    $type = $report_name;
    $status = 'created';


    $data = array(
            'db_name' => $db_name,
            'filters'=>$filtersJson,
            'com_key' => $com_key,
            'type' => $type,
            'status' => $status,
            'createduserid' => $createduserid,
            'createdusername' => $createdusername
    ); 
    $this->db->where('type',$type);
    $this->db->where('status',$status);
    $this->db->where('filters',$filtersJson);
    $datas = $this->db->get('db_download');
   if ($datas->num_rows() == 0) {
        $this->db->insert('db_download',$data);
        $ref_id = $this->db->insert_id();
    }else{
        $datas = $datas->row_array();
        $ref_id = $datas['id'];
    }

    // Database credentials (should be in config file in production)
     $servername = "185.193.19.114";
    $username = "root";
    $password = "kbn9AeEVHc57dKuJXgrhBz";
    $dbname = "cpzsas_main";

    try {
        // Create PDO connection
        $conn = new PDO(
            "mysql:host=$servername;dbname=$dbname;charset=utf8mb4",
            $username,
            $password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false
            ]
        );

        // First check if record already exists
        $checkStmt = $conn->prepare("
            SELECT id FROM db_download 
            WHERE db_name = :db_name 
            AND status = :status
            AND type = :type
            AND filters = :filters
            LIMIT 1
        ");

        $checkStmt->execute([
            ':db_name' => $db_name,
            ':status' => $status,
            ':filters'=>$filtersJson,
            ':type' => $type
        ]);

        $existingRecord = $checkStmt->fetch();

        if ($existingRecord) {
            // Record already exists - return existing ID
            return [
                'success' => true,
                'message' => 'Report request already exists',
                'insert_id' => $existingRecord['id'],
                'existing' => true
            ];
        }

        // No existing record - proceed with insert
        $insertStmt = $conn->prepare("
    INSERT INTO db_download
    (`db_name`, `com_key`, `type`, `status`, `createduserid`, `createdusername`, `filters`,`ref_id`) 
    VALUES 
    (:db_name, :com_key, :type, :status, :createduserid, :createdusername, :filters,:ref_id)
");

$insertStmt->execute([
    ':db_name' => $db_name,
    ':com_key' => $com_key,
    ':type' => $type,
    ':status' => $status,
    ':createduserid' => $createduserid,
    ':createdusername' => $createdusername,
    ':filters' => $filtersJson, // Insert the raw JSON string
    ':ref_id'=>$ref_id
]);

 $apiUrl = 'https://dw.cpzsas.in/jobs/run_item_report.php';
        $apiData['ref_id'] = $ref_id;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($apiData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Only for testing, remove in production
    
    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    if (curl_errno($ch)) {
        $error = curl_error($ch);
        curl_close($ch);
        return [
            'success' => false,
            'message' => 'API request failed',
            'error' => $error
        ];
    }
    
    curl_close($ch);
    


        // Get the inserted ID
        $insertId = $conn->lastInsertId();

        // Close connection
        $conn = null;

        return [
            'success' => true,
            'message' => 'Report request logged successfully',
            'insert_id' => $insertId,
            'existing' => false
        ];

    } catch (PDOException $e) {
        // Log full error for debugging
        error_log("Database error in ReportRequest: " . $e->getMessage());
        
        return [
            'success' => false,
            'message' => 'Failed to log report request',
            'error' => 'Database error occurred'
        ];
    }
}

    function getlastsalesrate(){
        $item_id = $this->input->post('item_id');
        $customer_id =  $this->input->post('customer_id');
        $qry = "select * from sales as a inner join sales_items as b on a.sales_id = b.sales_id and a.published ='yes' and b.published ='yes' inner join suppliers as s on s.id = a.customer_id where a.customer_id = '".$customer_id."' and b.item_id = '".$item_id."' order by a.sales_id desc limit 0,1 ";
        $data = $this->db->query($qry);
        echo json_encode($data->result_array());
    }
    public function get_unitcounts() {
        return $this->ajax->get_unitcounts();
    }



    function getitemdetails(){
        $item_id = $this->input->post('item_id');
        $godown_id = $this->input->post('godown_id');
        $qry ="SELECT sum(a.open_stock+a.current_stock) as stock from item_godown as a WHERE a.item_id = $item_id and a.godown_id = $godown_id";
        $stock = $this->db->query($qry);
        $itmstock = 0;
        if($stock->num_rows() > 0 ){
            $stock = $stock->row_array();
            $itmstock = $stock['stock'];
        }

        $qry = "SELECT id,reorder_point, $itmstock as stock FROM `item` WHERE id=".$item_id;
        $data = $this->db->query($qry)->row_array();
        echo json_encode($data);
    }

    public function getmsg(){
        $login_comid = $this->session->userdata('login_comid');
        $qry ="SELECT * FROM cpzsas_main.company WHERE   CURDATE() != IFNULL(msgdate,'0000-00-00')   and comkey = '".$this->session->userdata('login_comid')."' AND created_date = '2025-04-01' AND end_date = '2026-03-31' ";
        $data = $this->db->query($qry)->result_array();

        $qry ="update cpzsas_main.company set msgdate = CURDATE() where CURDATE() != msgdate  and comkey = '".$this->session->userdata('login_comid')."' AND created_date = '2025-04-01' AND end_date = '2026-03-31'";
        $this->db->query($qry);
        echo json_encode($data);
    }


    function ref($id){
       $qry = "SELECT percent FROM  `reference` WHERE ref_id = ".$id;
       $data = $this->db->query($qry)->row_array();
       print_r($data['percent']);
    }

    function getitemsqft(){
        $item_id = $this->input->post('item_id');
        $qry = "select * from item where id =  ".$item_id;
        $data = $this->db->query($qry)->row_array();
        print_r($data['sqft']);
    }
	 public function acc_main() {
        return $this->ajax->acc_main();
    }
	
	public function last_purchaserate($id){
		 $this->ajax->last_purchaserate($id);
	}
	function get_visible(){
		$this->ajax->get_visible();
	}
	
	function load_items($type = ''){
		$search = strtolower($_GET['term']);
        return $this->ajax->load_items($search, $type);
	}

     function search_area(){
		$search = strtolower($_GET['term']);
        return $this->ajax->search_area($search);
	}

    function item_cess() {
        return $this->ajax->item_cess();
    }
	
	 function customer_type() {
        return $this->ajax->customer_type();
    }
	
	function district() {
        return $this->ajax->district();
    }
	
	 function itemgroup() {
        return $this->ajax->itemgroup();
    }
	
	function load_points($customer_id){
		return $this->ajax->load_points($customer_id);
	}

    public function checkCustomerstatus($id){
        return $this->ajax->checkCustomerstatus($id);
    }
	
	public function checkstatus($id){
        return $this->ajax->checkstatus($id);
    }

    public function purity() {
        return $this->ajax->purity();
    }

    public function driver($id) {
        return $this->ajax->driver($id);
    }

    public function ims_driver() {
        return $this->ajax->ims_driver();
    }

    function customer($id) {
        return $this->ajax->customer($id);
    }

    public function getitem($opt) {
        return $this->ajax->getitem($opt);
    }

    public function gettaxledger($sal_tax_id) {
        return $this->ajax->gettaxledger($sal_tax_id);
    }

    function Patientbyid($id) {
        return $this->ajax->Patientbyid($id);
    }

    function tyr_customer($id) {
        return $this->ajax->tyr_customer($id);
    }

    public function estimates($type = 0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->estimates($search, $type);
    }

    public function category() {
        $search = strtolower($_GET['term']);
        return $this->ajax->category($search);
    }

    public function quotation_items($id) {
        return $this->ajax->quotation_items($id);
    }

    public function service_items($id) {
        return $this->ajax->service_items($id);
    }

    public function sale_coupon($id) {
        return $this->ajax->sale_coupon($id);
    }

    public function barcode_batch($id) {
        return $this->ajax->barcode_batch($id);
    }

    public function pur_service_items($id) {
        return $this->ajax->pur_service_items($id);
    }

    public function sales_items($id) {
        return $this->ajax->sales_items($id);
    }

    public function getprinters($id) {
        return $this->ajax->getprinters($id);
    }

    public function cli_salesitems($id) {
        return $this->ajax->cli_salesitems($id);
    }

    public function size() {
        return $this->ajax->size();
    }
	
	public function yoga_times() {
        return $this->ajax->yoga_times();
    }
	
	 public function uqc() {
        return $this->ajax->uqc();
    }
	
	public function counters() {
        return $this->ajax->counters();
    }

    public function cli_diagonise($id) {
        return $this->ajax->cli_diagonise($id);
    }

    public function cli_observation($id) {
        return $this->ajax->cli_observation($id);
    }

    public function tyrsales_items($id) {
        return $this->ajax->tyrsales_items($id);
    }

    public function purchase($id) {
        return $this->ajax->purchase($id);
    }

    public function suppliers($type = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->suppliers($search, $type);
    }

    public function hsn() {
        $search = strtolower($_GET['term']);
        return $this->ajax->hsn($search);
    }

    public function Observation() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Observation($search);
    }

    public function Diagonise() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Diagonise($search);
    }

    public function Patient() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Patient($search);
    }

    public function members() {
        $search = strtolower($_GET['term']);
        return $this->ajax->members($search);
    }

    public function ledgers($type= "") {
        $search = strtolower($_GET['term']);
        return $this->ajax->ledgers($search,$type);
    }

    public function items($check = 0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->items($search);
    }

    public function alter_items($id) {
        return $this->ajax->alter_items($id);
    }

    public function mainledger() {
        $search = strtolower($_GET['term']);
        return $this->ajax->mainledger($search);
    }
	
	public function itemauotocomplete() {
        $search = strtolower($_GET['term']);
        return $this->ajax->itemauotocomplete($search);
    }
	
    public function itemssearch_purchase($check = 0, $customer = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->itemssearch_purchase($search, $check, $customer);
    }

	public function itemssearch_new($check = 0, $customer = '' ,$type = '',$btype ='') {
        $search = strtolower($_GET['term']);
        return $this->ajax->itemssearch_new($search, $check, $customer,$type,$btype);
    }

    public function itemssearch($check = 0, $customer = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->itemssearch($search, $check, $customer);
    }

    public function itemssearchsale($id) {
        $search = strtolower($_GET['term']);
        $this->ajax->itemssearchsale($search, $id);
    }

    public function barcodesearch() {
        $search = strtolower($_GET['term']);
        return $this->ajax->barcodesearch($search);
    }

    public function itemsearchbyid($id) {
        return $this->ajax->itemsearchbyid($id);
    }

    public function pestimates($type = 0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->pestimates($search, $type);
    }

    public function currency() {
        return $this->ajax->currency();
    }

    public function bank() {
        return $this->ajax->bank();
    }

    public function branch() {
        return $this->ajax->branch();
    }

    public function states() {
        return $this->ajax->states();
    }

    public function delivery_type() {
        return $this->ajax->delivery_type();
    }

    public function myprinter() {
        return $this->ajax->myprinter();
    }

    public function godownstock($search) {
        return $this->ajax->godownstock($search);
    }

    public function get_saleskey($type) {
        return $this->ajax->get_saleskey($type);
    }
	
	public function subunits($search){
        return $this->ajax->subunits($search);
	}

    public function units($search) {
        return $this->ajax->units($search);
    }

    public function cliunits($search) {
        return $this->ajax->cliunits($search);
    }

    public function tax() {
        return $this->ajax->tax();
    }

    public function setledgers($paytype) {
        return $this->ajax->setledgers($paytype);
    }

    public function godown($item_id =0) {
        return $this->ajax->godown($item_id );
    }

    public function getgodown() {
        return $this->ajax->getgodown();
    }

    public function godownjson() {
        return $this->ajax->godownjson();
    }

    public function billtype($type) {
        return $this->ajax->billtype($type);
    }

    public function billtypes($type) {
        return $this->ajax->billtypes($type);
    }

    public function Doctor() {
        return $this->ajax->Doctor();
    }

    public function Intervel() {
        return $this->ajax->Intervel();
    }

    public function Cat() {
        return $this->ajax->Cat();
    }

    public function analyticscenter() {
        return $this->ajax->analyticscenter();
    }

    public function costcenter() {
        return $this->ajax->costcenter();
    }

    public function Procedure() {
        return $this->ajax->Procedure();
    }

    public function Schedule($id, $date) {
        return $this->ajax->Schedule($id, $date);
    }

    public function salesman() {
        return $this->ajax->salesman();
    }

    public function potency() {
        return $this->ajax->potency();
    }

    public function area() {
        return $this->ajax->area();
    }

    public function printtype($type) {
        return $this->ajax->printtype($type);
    }

    public function route() {
        return $this->ajax->route();
    }

    public function messagetype() {
        return $this->ajax->messagetype();
    }

    public function emailtype() {
        return $this->ajax->emailtype();
    }

    public function email_type() {
        return $this->ajax->email_type();
    }

    public function reference() {
        return $this->ajax->reference();
    }

    public function vehicle() {
        return $this->ajax->vehicle();
    }

    public function room_category() {
        return $this->ajax->room_category();
    }

    public function member_category() {
        return $this->ajax->member_category();
    }

    public function room() {
        $type = $_GET['type'];
        return $this->ajax->room($type);
    }

}
