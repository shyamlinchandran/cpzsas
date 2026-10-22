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
class Ledger_mistake extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/ledger_mistake_model', 'ledger');
    }

    function ledger_mistake() {
        $data['title'] = 'Ledger Check';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/ledger_mistake/ledger_mistake', $data);
    }

    public function ajax_list() {
        $this->ledger->where();
        $list = $this->ledger->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $this->ledger->get_url($vouchers->tb_id, $vouchers->voucher_no, $vouchers->trn_tp);
            $row[] = $vouchers->trn_tp;
            $row[] = $vouchers->debit;
            $row[] = $vouchers->credit;
            $row[] = $vouchers->diff;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledger->count_all() ,
            "recordsFiltered" => $this->ledger->count_filtered() ,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
