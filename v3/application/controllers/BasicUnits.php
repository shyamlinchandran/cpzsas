<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */
class BasicUnits extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Basicunit_model', 'unit');
    }

	public function parent($id){
		 $this->unit->parent($id);
	}
    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('units/list_all');
    }
	
	public function save(){
			$this->unit->save();
	}
	
	public function getsing($id){
        echo json_encode($this->unit->getsing($id));
	}
	
	public function create($id =0 ) {
		$data['id'] = $id;
		$data['type'] = 'Create';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('units/create',$data);
    }

    public function ajax_list() {
//        $this->unit->where();
        $list = $this->unit->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->code;
            $row[] = $vouchers->uqc_name;
            $row[] = $vouchers->unit_count;
            $row[] = $vouchers->Parentunit;
            $act = '<a  back="' . base_url() . 'BasicUnits/listall" href="' . base_url() . 'masters/units/read/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act = $act . '<a  back="' . base_url() . 'BasicUnits/listall" href="' . base_url() . 'BasicUnits/create/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            if ($vouchers->unit_id == $vouchers->id || $vouchers->unit == $vouchers->id) {
                
            } else {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/BasicUnits/listall/' . '"  success="Delete ' . $vouchers->name . ' successfuly "  message="Do you want Delete ' . $vouchers->name . '?"  href="' . base_url() . 'masters/units/delete/' . $vouchers->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->unit->count_all() + 1,
            "recordsFiltered" => $this->unit->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
