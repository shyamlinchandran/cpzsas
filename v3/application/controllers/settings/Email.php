<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Email extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Email_model', 'email');
    }

    public function listall() {
        $data['title'] = 'Email';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/email/list_all', $data);
    }
 public function create($id=0) {
        $data['title'] = 'Email';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/email/create', $data);
    }
    public function getsing($id) {
        $this->email->getsing($id);
    }
 public function edit($id) {
        $data['title'] = 'Email';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/email/create', $data);
    }
      public function save() {  
        $id = $this->email->save();
         if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }
    }
   
    public function ajax_list() {
        $this->email->where();
        $list = $this->email->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->message;
            $act = '<a  href="' . base_url() . 'settings/email/edit/'.$vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/email/edit/'.$vouchers->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $row[] = $act;

             $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->email->count_all(),
            "recordsFiltered" => $this->email->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
