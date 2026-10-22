<?php


class CompanySettings extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CompanySettings_model', 'company');
    }
	
	public function listall() {
        $data['title'] = 'Company Settings';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companysettings/list_all', $data);
    }
	
	public function company_keys(){
		$data['title'] = 'Company Ky Settings';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companysettings/list_key', $data);
    }
	
	public function getsing($id){
		 return $this->company->getsing($id);
	}
	
	public function save(){
		$this->company->save();
	}
	
	public function save_key(){
		$this->company->save_key();
	}
	
	public function edit($id){
		$this->load->view('_blocks/subpages/create');    
		$settings = $this->company->getCompanySettings();
		$data['settings'] = $settings;
        $data['id'] = $id;
		$qry = "select * from `keys` where type='general'";
		$data['general_settings'] = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type='item'";
		$data['item_settings'] = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type='Sales'";
		$data['sales_settings'] = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type='Purchase'";
		$data['purchase_settings'] = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type='company'";
		$data['company_settings'] = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type='voucher'";
        $data['voucher_settings'] = $this->db->query($qry)->row_array();
        $qry = "select * from `keys` where type='enquiry'";
        $data['enquiry_settings'] = $this->db->query($qry)->row_array();
        $qry = "select * from `keys` where type='lead_master'";
        $data['lead_settings'] = $this->db->query($qry)->row_array();
        $this->load->view('settings/companysettings/create', $data);
	}
	
	public function add_settings($id){
		$this->load->view('_blocks/subpages/create');
		$qry = "select * from `keys` where id=".$id;
		$data['settings'] = $this->db->query($qry)->row_array();
		$data['id'] = $id;
        $this->load->view('settings/companysettings/add_settings', $data);
	}
	
	public function key_list() {
        $this->company->where_key();
        $list = $this->company->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->type;
		
            $act = '<a  href="' . base_url() . 'settings/CompanySettings/add_settings/'.$vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success">Add Settings</a>';
            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->company->count_all(),
            "recordsFiltered" => $this->company->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function ajax_list() {
        $this->company->where();
        $list = $this->company->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
			$row[] = $vouchers->address;
            $row[] = $vouchers->StateName;
			$row[] = $vouchers->comset_bank;
            $act = '<a  href="' . base_url() . 'settings/CompanySettings/edit/'.$vouchers->com_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->company->count_all(),
            "recordsFiltered" => $this->company->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	
}
