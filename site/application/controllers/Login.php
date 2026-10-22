<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author jijodileep
 */
class Login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $product_name = $this->config->item('product_name');
        $user = $this->session->userdata('user');
        //if ($user == "") {
            $type = "emps";
            $error = "";
            $data = array("type" => $type, 'error' => $error);
            
            if ($product_name=='dims'){
                $this->load->view('_jlogin/dimslogin', $data);
            }
            else {
                $this->load->view('_jlogin/dimslogin', $data);
            }
      /*  } else {
            $version = 'v1/';
            if ($user['utype'] == 'Super Admin') {
                $url = base_url() . "dashboard/superadmin";
            } else if ($user['utype'] == 'Admin') {
                $url = base_url() . "dashboard/admin";
            } else if ($user['utype'] == 'clinic') {
                $url = base_url() . "dashboard/clinic";
            } else {
                $url = base_url() . "dashboard/users";
            }
            redirect($url);
        }*/
    }

    public function logout() {
        $login_url = $this->session->userdata('login_url');
        unset($_SESSION['username']);
        unset($_SESSION['pswd']);
        unset($_SESSION['logged_in']);
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' .$login_url . 'login">';
    }
	
	
	public function clone_data($db){
		ini_set('max_execution_time', 30000000);
		
		$DB_HOST = $db['sdb_server'];
		$DB_USER = $db['sdb_username'];
		$DB_PASS = $db['sdb_password'];

		$DB_SRC = $db['sdb_name'];
		$DB_DST = $db['base_comkey'].'_'.date("Y");



		// MYSQL Connect

		$mysqli = new mysqli( $DB_HOST, $DB_USER, $DB_PASS ) or die( $mysqli->error );
		$mysqli->query( "CREATE DATABASE $DB_DST" ) or die( $mysqli->error );

	
		// Iterate through tables of source database

		$tables = $mysqli->query( "SHOW TABLES FROM $DB_SRC where Tables_in_$DB_SRC not like '%hotel%' and Tables_in_$DB_SRC not like '%hr_%' " ) or die( $mysqli->error );

		while( $table = $tables->fetch_array() ): $TABLE = $table[0];


		// Copy table and contents in destination database
		
		$mysqli->query( "CREATE TABLE $DB_DST.$TABLE LIKE $DB_SRC.$TABLE" ) or die( $mysqli->error );
		if($DB_DST.$TABLE != 'purchase_items' && $DB_DST.$TABLE != 'bill_material_main' && $DB_DST.$TABLE != 'bill_material_sub' && $DB_DST.$TABLE != 'bom_main' && $DB_DST.$TABLE != 'bom_sub_ledger' && $DB_DST.$TABLE != 'bom_sub_material' && $DB_DST.$TABLE != 'credit_debit_voucher'   && $DB_DST.$TABLE != 'credit_debit_voucher_trans'  && $DB_DST.$TABLE != 'item_transfer'  && $DB_DST.$TABLE != 'item_transfer_sub'  && $DB_DST.$TABLE != 'physical_stk_update' && $DB_DST.$TABLE != 'physical_stk_update_items' && $DB_DST.$TABLE != 'purchase_items_imei' && $DB_DST.$TABLE != 'stock_journal_ledger'   && $DB_DST.$TABLE != 'purchase'  && $DB_DST.$TABLE != 'purchase_ledgers'  && $DB_DST.$TABLE != 'sales' && $DB_DST.$TABLE != 'sales_items'  && $DB_DST.$TABLE != 'sales_ledgers' && $DB_DST.$TABLE != 'stock_journal' && $DB_DST.$TABLE != 'stock_journal_items' && $DB_DST.$TABLE != 'voucher' && $DB_DST.$TABLE != 'voucher_trans' ){
			$mysqli->query( "INSERT INTO $DB_DST.$TABLE SELECT * FROM $DB_SRC.$TABLE" ) or die( $mysqli->error );
		}


		endwhile;
		
		
		$qry ="UPDATE ".$DB_DST.".acc_ledgers   INNER JOIN ( select case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.id from  ".$DB_DST.".acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from ".$DB_DST.".acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE 1  
ORDER BY `balance` ASC ) as countitems ON acc_ledgers.id = countitems.id SET acc_ledgers.openning_bal = countitems.balance";
		$this->db->query($qry);
		
		
		$qry = 'update '.$DB_DST.'.acc_ledgers set type = "Dr" ';
		$this->db->query($qry);
		
		
		$qry = 'update '.$DB_DST.'.acc_ledgers set type = "Cr"  where openning_bal < 0 ';
		$this->db->query($qry);
		
		$qry = 'update '.$DB_DST.'.acc_ledgers set openning_bal = openning_bal*-1  where openning_bal < 0 ';
		$this->db->query($qry);
		
		
		$qry = "UPDATE ".$DB_DST.".item_godown as itemg INNER join (SELECT a.godown_id,IFNULL(stk,0) + IFNULL(a.open_stock,0) as stock,a.item_id from ".$DB_DST.".item_godown as a LEFT JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from ".$DB_DST.".item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id  and x.godown = a.godown_id ) as y on y.item_id = itemg.item_id  and y.godown_id = itemg.godown_id set itemg.open_stock = stock ,itemg.current_stock = 0 ";
		$this->db->query($qry);
		$qry = "update ".$DB_DST.".item set fin_sync_id = id ";
		$this->db->query($qry);
		$qry = "update ".$DB_DST.".acc_ledgers set fin_sync_id = id ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".bill_material_main ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".bill_material_sub ";
		$this->db->query($qry);
		
		
		$qry = "update ".$DB_DST.".item set open_stk_rate = prate where prate >= 1 " ;
		$this->db->query($qry);


		$qry = " TRUNCATE  ".$DB_DST.".item_ledger ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".acc_ledger_trans ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".bom_main ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".bom_sub_ledger ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".bom_sub_material ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".credit_debit_voucher ";
		//$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".credit_debit_voucher_trans ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".item_transfer ";
		//$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".item_transfer_sub ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".physical_stk_update ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".physical_stk_update_items ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".purchase ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".purchase_items ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".purchase_items_imei ";
	//	$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".purchase_ledgers ";
		$this->db->query($qry);
		
		//$qry = " TRUNCATE  ".$DB_DST.".replacement ";
		//$this->db->query($qry);
		
		//$qry = " TRUNCATE  ".$DB_DST.".replacement_items ";
		//$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".sales ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".sales_coupon ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".sales_items ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".sales_ledgers ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".stock_journal ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".stock_journal_items ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".stock_journal_ledger ";
		//$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".voucher ";
		$this->db->query($qry);
		
		$qry = " TRUNCATE  ".$DB_DST.".voucher_trans ";
		$this->db->query($qry);
		
		
		
		
		
		
		
		
		
		
		
	}
	
	

	public function update_finantial_year($db){
		$is_financial_update = $db['is_financial_update'];
		$is_current = $db['is_current'];
		$end_date =  $db['end_date'];
		$updatefin = $db['updatefin'];
		if((float) $updatefin > 0 && (float) $is_current > 0 && (float) $is_financial_update > 0  ){
			$data_company = array(
				'name'=>$db['name'],
				'comkey'=>$db['base_comkey'],
				'base_comkey'=>$db['base_comkey'],
				'created_date'=>'2022-04-01',
				'end_date'=>'2024-03-31',
				'package'=>$db['package'],
				'subcription'=>$db['subcription'],
				'version'=>$db['version'],
				'contact_person'=>$db['contact_person'],
				'contact_phone'=>$db['contact_phone'],
				'address'=>$db['address'],
				'phone'=>$db['phone'],
				'tin'=>$db['tin'],
				'comyear'=>date("Y"),
				'is_active'=>1,
				'is_financial_update'=>0,
				'is_current'=>1,
				'last_finantial_reference'=>$db['sdb_name']
				
			);
			$this->db->insert('company',$data_company);
			$insert_id = $this->db->insert_id();
			$data = array(
				'sdb_name'=> $db['base_comkey'].'_'.date("Y"),
				'sdb_username'=>$db['sdb_username'],
				'sdb_password'=>$db['sdb_password'],
				'sdb_server'=>$db['sdb_server'],
				'com_id' => $insert_id
			);

			$this->db->insert('set_database',$data);
			
			$data = array(
				'is_current'=>0,
				'comkey'=>$db['base_comkey'].$db['comyear']
			);
			$this->db->where('com_id',$db['com_id']);
			$this->db->update('company',$data);
			$this->clone_data($db);
		}
	}
    public function loginset() {
        $product_name = $this->config->item('product_name'); 
        $type = "emps";
        $this->load->model('Getdata_model', 'getdata');
        $error = "Invalid Login";
        $data = array("type" => $type, 'error' => $error);
        $uname = $_POST['uname'];
        $comid = $_POST['comid'];
        $db = $this->getdata->getdb($comid); 
		$is_active = 1;
		if($db){
			$is_active = $db['is_active'];
			$this->update_finantial_year($db);
			$db = $this->getdata->getdb($comid); 
		}
		
        if ($db && (float) $is_active > 0 ) {
            $fin_database = $this->getdata->getfinantialdb($comid);
            $version = $db['version_name'];
            $pswd = $_POST['pswd'];
            $newdata = array(
                'username' => $uname,
                'logged_in' => TRUE
            );
            $newdata['hostname'] = $db['sdb_server'];
            $newdata['username'] = $db['sdb_username'];
            $newdata['password'] = $db['sdb_password'];
            $newdata['database'] = $db['sdb_name'];
            $newdata['isexcute'] = $db['sdb_isexcute'];
            $newdata['dbcompany'] = $db;
            $newdata['baseurl'] = base_url();
            $this->load->vars($newdata);

            $this->load->model('User_model', 'user');
            $user = $this->user->login($uname, $pswd); 
			$company_settings = $this->user->getCompanySettings();
            if ($user['password'] == $pswd && $user['username'] == $uname) {
                
                $newdata['user'] = $user;
				if ($user['utype'] == 'mobile') {
                    $url = base_url() . $version . "mobile/Main/sales";
				}
                else if ($user['utype'] == 'Super Admin') {
                    $url = base_url() . $version . "dashboard/superadmin";
                } else if ($user['utype'] == 'Admin') {
                    $url = base_url() . $version . "dashboard/admin";
                } else if ($user['utype'] == 'clinic') {
                    $url = base_url() . $version . "dashboard/clinic";
                }else if ($user['utype'] == 'yoga') {
                    $url = base_url() . $version . "dashboard/yoga";
                } else {
                    $url = base_url() . $version . "dashboard/users";
                }
				$newdata['company_settings'] = $company_settings;
                $newdata['last_finantial_reference'] = $db['last_finantial_reference'];
                $newdata['fin_database'] = $fin_database;
                $newdata['dash'] = $url;
                $newdata['login_url'] =  base_url();
                $newdata['login_comid'] = $comid;
                $this->session->set_userdata($newdata);
                $data = array(
                    'user_id' => $user['Id'],
                    'session_id' => session_id(),
                    'set_ip' => $_SERVER['REMOTE_ADDR'],
                    'set_status' => TRUE
                );
                $this->getdata->insertlogin($data);
                redirect($url);
            }
            $error = "Invalid User Name & password  ";
            $data = array("type" => $type, 'error' => $error);
            if ($product_name=='dims'){
                $this->load->view('_jlogin/dimslogin', $data);
            }
            else {
                $this->load->view('_jlogin/dimslogin', $data);
            }
        } else {
         
            $error = "Invalid Company Details";
			if($is_active == 0 ){
				$error = "Your Account is Deactivated";
			}
            $data = array("type" => $type, 'error' => $error);
            if ($product_name=='dims'){
                $this->load->view('_jlogin/dimslogin', $data);
            }
            else {
                $this->load->view('_jlogin/dimslogin', $data);
            }
        }
    }

}
