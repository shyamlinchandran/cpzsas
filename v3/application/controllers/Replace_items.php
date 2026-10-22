<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Replace_items extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Replace_items_model', 'replace');
    }
	
	public function getsing($id){
        $res = $this->replace->getsing($id);
        echo json_encode($res);
	}
	
	public function list(){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('replace_item/list');
	}

    public function create($id = 0,$type = 'create') {
		$settings = $this->replace->getCompanySettings();
        $data['settings'] = $settings;
		$data['id'] = $id; 
		$data['voucher_no'] = '';
		if((float) $id > 0 ){
			$qry = "select * from replacement where rep_id = ".$id;
			$query = $this->db->query($qry)->row_array();
			$data['voucher_no'] =  $query['rep_invoice'];
		}
		$data['view'] = $type;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('replace_item/create',$data);
    }
	
	
	
	public function list_all(){
		
	}
    public function ajax_list() {
        $this->replace->where();
        $list = $this->replace->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->rep_invoice;
            $row[] = $vouchers->customer;
            $row[] = $vouchers->user;
            $act = '<a  back="' . base_url() . 'Replace_items/list" href="' . base_url() . 'Replace_items/create/' . $vouchers->rep_id . '/view" title="Edit" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act = $act . '<a  back="' . base_url() . 'Replace_items/list" href="' . base_url() . 'Replace_items/create/' . $vouchers->rep_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/Replace_items/list/' . '"  success="Delete ' . $vouchers->rep_invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->rep_invoice . '?"  href="' . base_url() . 'Replace_items/delete/' . $vouchers->rep_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->replace->count_all() + 1,
            "recordsFiltered" => $this->replace->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


	

    function save() {
        $this->replace->save_data();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
			);
        echo json_encode($response);
    }

}

