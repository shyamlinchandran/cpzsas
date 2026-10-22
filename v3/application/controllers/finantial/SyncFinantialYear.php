<?php
	
defined('BASEPATH') or exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class SyncFinantialYear extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FinantialYear_model', 'fin');
       
    }
	
	public function Sync_data($type){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		if($type == 'item'){
			$this->load->view('finantial/syncitem');
		}
		if($type == 'ledger'){
			$this->load->view('finantial/syncledger');
		}
	}
	
	public function Sync($type){
		$last_finantial_reference = $this->session->userdata('last_finantial_reference'); 
		if($type == 'item'){
			$qry = "UPDATE item_godown as itemg INNER join (SELECT a.batch,a.godown_id,IFNULL(stk,0) + IFNULL(a.open_stock,0) as stock,it.id as  item_id from ".$last_finantial_reference.".item_godown as a LEFT JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,item_id,b.godown,b.batch from ".$last_finantial_reference.".item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id  and x.godown = a.godown_id  inner join item as it on it.fin_sync_id = a.item_id ) as y on y.item_id = itemg.item_id  and y.godown_id = itemg.godown_id set itemg.open_stock = stock ";
			$settings = $this->fin->getCompanySettings();
			$isbatch = $settings[0]['is_batch'];
			if( (float) $isbatch > 0 ){
				$qry = "UPDATE item_godown as itemg INNER join (SELECT a.batch,a.godown_id,IFNULL(stk,0) + IFNULL(a.open_stock,0) as stock,it.id as  item_id from ".$last_finantial_reference.".item_godown as a LEFT JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,item_id,b.godown,b.batch from ".$last_finantial_reference.".item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown,b.batch) as x on x.item_id = a.item_id  and x.godown = a.godown_id and x.batch = a.batch  inner join item as it on it.fin_sync_id = a.item_id ) as y on y.item_id = itemg.item_id  and y.godown_id = itemg.godown_id and y.batch = itemg.batch set itemg.open_stock = stock ";
			}
			$this->db->query($qry);
		}else{
			$qry ="UPDATE acc_ledgers   INNER JOIN ( select case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.id from  ".$last_finantial_reference.".acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from ".$last_finantial_reference.".acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE 1  
ORDER BY `balance` ASC ) as countitems ON acc_ledgers.fin_sync_id = countitems.id SET acc_ledgers.openning_bal = countitems.balance";
		$this->db->query($qry);
		$qry = "UPDATE `acc_ledgers`  set type = 'Dr' WHERE  fin_sync_id > 0  and openning_bal > 0 ";
		$this->db->query($qry);
		$qry = "UPDATE `acc_ledgers`  set type = 'Cr' WHERE fin_sync_id > 0  and  openning_bal < 0";
		$this->db->query($qry);
		$qry = "UPDATE `acc_ledgers` set openning_bal = openning_bal * -1 WHERE fin_sync_id > 0  and openning_bal < 0";
		$this->db->query($qry);
			
		}
		
		
		
		$response = array(
            'status' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
	}
	
	public function Sync_finantialyear(){
		$qry = "SELECT replace(sdb_name,'_2021','') as datbase from ozone_main.company as a INNER JOIN ozone_main.set_database as b on a.com_id = b.com_id and a.comkey = '".$this->session->userdata('login_comid')."' ";
		$query = $this->db->query($qry)->row_array();
		$data['database'] = $query['datbase'];
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('finantial/Syncfinantialyear',$data);
	}
	
	public function Sync_item(){
		$qry = "SELECT replace(sdb_name,'_2021','') as datbase from ozone_main.company as a INNER JOIN ozone_main.set_database as b on a.com_id = b.com_id and a.comkey = '".$this->session->userdata('login_comid')."' ";
		$query = $this->db->query($qry)->row_array();
		$data['database'] = $query['datbase'];
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('finantial/Sync_item',$data);
	}
	
	
	
	public function sync_master(){
		ini_set('max_execution_time', 30000000);
		$this->fin->sync_master();
	}
	
	public function sync_ledger(){
		ini_set('max_execution_time', 30000000);
		$this->fin->sync_ledger();
	}

	public function Syncfinantialyear($database ='' ){
		$database = $this->input->post('database_name');
		ini_set('max_execution_time', 30000000);
		$this->fin->Syncfinantialyear($database);
	}
	
	public function Syncitem($database=''){
		$database = $this->input->post('database_name');
		ini_set('max_execution_time', 30000000);
		$this->fin->Syncitem_new($database);
	}


}
