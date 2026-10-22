<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Message extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Message_model', 'Message');
    }

    public function listall() {
        $data['title'] = 'Message';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/message/list_all', $data);
    }

    public function create($id = 0) {
        $data['title'] = 'Message';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/message/create', $data);
    }

    public function getsing($id) {
        $this->Message->getsing($id);
    }

    public function edit($id) {
        $data['title'] = 'Message';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/message/create', $data);
    }

    public function save() {
        $id = $this->Message->save();
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
        $this->Message->where();
        $list = $this->Message->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->sms;
            $act = '<a  href="' . base_url() . 'settings/message/edit/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/message/edit/' . $vouchers->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Message->count_all(),
            "recordsFiltered" => $this->Message->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
