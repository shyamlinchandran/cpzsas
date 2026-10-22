<?php


class CompanyNotification extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('CompanyNotification_model', 'company');
    }
	
	public function listall() {
        $data['title'] = 'Company Settings';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/Companynotification/list_all', $data);
    }
	
	public function create($id=0,$view="create"){ 
        $data['id'] = $id;
        $data['view'] = $view;
		$data['title'] = 'Company Notification & Support Create';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/Companynotification/create', $data);
    }
	
	public function getsing($id){
		 return $this->company->getsing($id);
	}
	
	public function getcompanies(){
		return $this->company->getcompanies();
	}
	
	public function save(){
		$this->company->save();
	}
	
	public function save_key(){
		$this->company->save_key();
	}
	
	public function edit($id){
		$data['id'] = $id;
		$data['view'] = 'edit';
		$data['title'] = 'Company Notification & Support Edit';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/Companynotification/create', $data);
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
			$row[] = $vouchers->type;
            $row[] = $vouchers->message;
			$row[] = $vouchers->timeout;
            $act = '<a  href="' . base_url() . 'settings/Companynotification/edit/'.$vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a href="#" onclick="deleteRecord('.$vouchers->id.')" title="Delete" data-toggle="tooltip" class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span></a>';
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
	
	public function delete($id){
		$this->company->delete($id);
	}

	public function getnotifications(){
		return $this->company->getbytype('notification');
	}
	
	public function getsupport(){
		return $this->company->getbytype('support');
	}
}