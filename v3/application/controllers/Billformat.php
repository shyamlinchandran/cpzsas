<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class Billformat extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Billformat_model', 'billformat');
    }

    function billformat() {
        $data['title'] = 'Bill format';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('billformat/billformat', $data);
    }
	
	function save(){
		$this->billformat->save();
	}
	
	function cutomize($id){
		$data['title'] = 'Customise Bill Format';
		$details = $this->billformat->getdetails($id);
		$print_settings = $details['print_settings'];
		$data['details'] = $details;
		$data['id'] = $id;
		$print_settings = json_decode($print_settings);
		$data['print_settings'] = $print_settings ;
		$data['footer_settings'] = json_decode($details['footer_settings']) ;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('billformat/customise', $data);
	}

    public function switchdatabase($id) {
        $em = $this->billformat->connectDb($id); 
        $newdata['hostname'] = $em['sdb_server'];
        $newdata['username'] = $em['sdb_username'];
        $newdata['password'] = $em['sdb_password'];
        $newdata['database'] = $em['sdb_name'];
        $newdata['isexcute'] = 1;
        $this->load->vars($newdata);
        $this->session->set_userdata($newdata);
		redirect(base_url(), 'refresh'); 

    }

    function view($code) {
        $data['code'] = $code;
        $data['title'] = 'Print Type';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('billformat/view', $data);
    }

    public function ajax_list() {
        $this->billformat->where();
        $list = $this->billformat->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->code;
            $act = ' <a tp="pdf" href="' . base_url() . 'assets/pdf/'.$vouchers->code.'.pdf" data-toggle="tooltip" title="View" class="btn btn-primary "><span class="glyphicon glyphicon-eye-open"></span></a>';;
			$act = $act . '<a  href="' . base_url() . 'Billformat/cutomize/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success">Customize</a>';
			$row[] = $act;
			$data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->billformat->count_all() + 1,
            "recordsFiltered" => $this->billformat->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
