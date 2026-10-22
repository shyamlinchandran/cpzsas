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
        $this->load->model('email/Email_model', 'email');
    }

    public function listall() {
        $data['title'] = 'Email';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('email/list_all', $data);
    }

    public function create($id = 0) {
        $data['title'] = 'Message';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('email/create', $data);
    }

    public function getsing($id) {
        $this->email->getsing($id);
    }

   

    public function save() {
       
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
            $row[] = $vouchers->type;
            $row[] = $vouchers->subject;
            $act = '<a  href="' . base_url() . 'email/Email/add/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
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
