<?php
	
defined('BASEPATH') or exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class FinantialYea extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('FinantialYear_model', 'fin');
       
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
