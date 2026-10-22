<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Kitgroup extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kitgroup_model', 'kit');
    }

    public function listall($type) {
        $data['type'] = $type;
        $data['title'] = 'Kit Groups';
        $data['field'] = 'Kit Group';
        if ($type == 'price_code') {
            $data['title'] = 'Price Code';
            $data['field'] = 'Price Codr Name';
        }
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('kitgroup/listall', $data);
    }

    public function price_code($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['title'] = 'Price Code';
        $data['type'] = 'price_code';
        $data['Field'] = 'Price Code Name*';
        $data['id'] = $id;
        $data['settings'] = $this->kit->getCompanySettings();
        $this->load->view('kitgroup/create', $data);
    }

    public function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['title'] = 'Kit Group';
        $data['type'] = 'kit_group';
        $data['Field'] = 'Kit Group*';
        $data['id'] = $id;
        $data['settings'] = $this->kit->getCompanySettings();
        $this->load->view('kitgroup/create', $data);
    }

    public function kit_items($id) {
        return $this->kit->kit_items($id);
    }

    public function get_kit_items($id) {
        return $this->kit->get_kit_items($id);
    }

    public function kitgroup($customer_id = 0) {
        $search = strtolower($_GET['term']);
        return $this->kit->kitgroup($search, $customer_id);
    }

    public function ajax_list() {
        $this->kit->where();
        $list = $this->kit->get_datatables();
        $type = 'create';
        if ($this->input->post('type') == 'price_code') {
            $type = 'price_code';
        }

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->kitname;
            // $row[] = $item->customer;
            $act = '<a  href="' . base_url() . 'Kitgroup/' . $type . '/' . $item->kitid . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->kit->count_all(),
            "recordsFiltered" => $this->kit->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $id = $this->kit->save();
        if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }
    }

}
