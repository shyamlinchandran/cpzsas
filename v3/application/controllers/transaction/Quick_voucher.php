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
class Quick_voucher extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Quick_voucher_model', 'quick_voucher');
    }

    function listall() {
        $data['title'] = 'Quick voucher';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/quick_voucher/list_all', $data);
    }

    function create($id = 0) {
        $data['title'] = 'Add Quick voucher';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/quick_voucher/create', $data);
    }

    public function ledgers() {
        return $this->quick_voucher->ledgers();
    }

    public function main_ledgers() {
        return $this->quick_voucher->main_ledgers();
    }

    public function expense_ledger($id,$main_id) {
        return $this->quick_voucher->expense_ledger($id,$main_id);
    }

    public function save() {
        $id = $this->quick_voucher->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function ajax_list() {
        $this->quick_voucher->where();
        $list = $this->quick_voucher->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->frm;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->total;
            $act = ' <a href="' . base_url() . 'transaction/Quick_voucher/create/' . $vouchers->id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->quick_voucher->count_all() + 1,
            "recordsFiltered" => $this->quick_voucher->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
