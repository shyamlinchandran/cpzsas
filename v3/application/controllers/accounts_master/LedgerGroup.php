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
class LedgerGroup extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('accounts_master/Ledgers_model', 'ledgers');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('accounts_master/ledgergroup/list_all');
    }

    public function ajax_list() {
        $this->ledgers->ledgergroup();
        $list = $this->ledgers->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            if ($this->multiple != 0) {
                $row[] = $vouchers->name_lan;
            }
            $row[] = $vouchers->code;
            $row[] = $vouchers->subtype;
            $act = '<a  back="' . base_url() . 'accounts_master/LedgerGroup/listall" href="' . base_url() . 'accounts_master/Ledger/mainledgers/edit/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledgers->count_all() + 1,
            "recordsFiltered" => $this->ledgers->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
