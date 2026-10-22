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
class Delivery_method extends MY_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce/Delivery_method_model', 'delivery');
    }

    public function create($type, $id = 0) {
        $data['id'] = $id;
        $data['type'] = $type;
        $data['type'] = $type;
        $data['text'] = 'Delivery';
        $data['title'] = "Delivery Option";
        if ($type == "payment_method") {
            $data['title'] = "Payment Method";
            $data['text'] = 'Payment';
        }
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('ecommerce/delivery/create', $data);
    }

    function get_state($id) {
        $this->delivery->get_state($id);
        // echo json_encode($result);
    }

    function list_all($type) {
        $data['type'] = $type;
        $data['title'] = "Delivery Option";
        if ($type == "payment_method") {
            $data['title'] = "Payment Method";
        }
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('ecommerce/delivery/listall', $data);
    }

    public function save() {
        $this->delivery->save();
    }

    public function getsing($id) {
        $this->delivery->getsing($id);
    }

    public function ajax_list() {
        $this->delivery->where();
        $list = $this->delivery->get_datatables();
        $data = array();
        $type = $this->input->post('type');
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->delivery_method;
            $row[] = $vouchers->amount;
            $act = ' <a  back="' . base_url() . 'ecommerce/Delivery_method/list_all"  href="' . base_url() . 'ecommerce/Delivery_method/create/' . $type . '/' . $vouchers->delivery_method_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->delivery->count_all() + 1,
            "recordsFiltered" => $this->delivery->count_filtered() + 1,
            "data" => $data,
        );
//output to json format
        echo json_encode($output);
    }

}
