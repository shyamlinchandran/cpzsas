<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shipping
 *
 * @author dimind
 */
class Shipping extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Trasport_model', 'trasport');
        $this->load->model('shipping_model', 'shipping');
    }

    public function ledgerstatement() {
        $data['consignee'] = $this->trasport->tra_consignee();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/shipping/shipping', $data);
    }

    public function ledgerstate() {
        $data['consignee'] = $this->trasport->tra_consignee();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/shipping/ledgershipping', $data);
    }

    public function ledger_list() {
        $this->shipping->shippingledger();
        $list = $this->shipping->get_datatables();
        $this->ledgerlist($list);
    }

    public function list_ledger() {
        $this->shipping->shippingledger();
        $list = $this->shipping->get_datatables();
        $this->trilist($list);
    }

    private function trilist($list) {
        $gtot = 0;
        $data = array();
        foreach ($list as $members) {
            $row = array();
            $row[] = $members->sdate;
            $row[] = $members->invoice;
            $row[] = $members->vess;
            $row[] = $members->con;
            $row[] = $members->fact;
            $row[] = $members->container;
            $row[] = $members->eta;
            $row[] = $members->sdate;
            $row[] = $members->dst;
            $row[] = $members->invoice;
            $row[] = $members->Vehicle_num;
            $row[] = $members->gtotal;
            $row[] = '';
            $gtot = $gtot + $members->gtotal;
            $row[] = $members->gtotal;
            $row[] = '';
            $row[] = $gtot;
            $row[] = '';
            $data[] = $row;
        }

        if ($this->input->post('toid')) {
            $lists = $this->shipping->transaction($this->input->post('toid'));
            foreach ($lists as $members) {
                $row = array();
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = $members['tran_amt'];
                $gtot = $gtot - $members['tran_amt'];
                $row[] = $this->number_fm($gtot);
                $row[] = $members['tran_narration'];
                $data[] = $row;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $data,
        );
        echo json_encode($output);
    }

    private function ledgerlist($list) {
        $gtot = 0;
        $data = array();
        foreach ($list as $members) {
            $row = array();
            $row[] = $members->sdate;
            $row[] = $members->invoice;
            $row[] = $members->fact;
            $row[] = $members->container;
            $row[] = $members->sdate;
            $row[] = $members->gtotal;
            $row[] = '';
            $gtot = $gtot + $members->gtotal;
            $row[] = $members->gtotal;
            $row[] = '';
            $row[] = $gtot;
            $row[] = '';
            $row[] = '';
            $data[] = $row;
        }

        if ($this->input->post('toid')) {
            $lists = $this->shipping->transaction($this->input->post('toid'));
            foreach ($lists as $members) {
                $row = array();
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';                 
                $row[] = $members['tran_amt'];
                $gtot = $gtot - $members['tran_amt'];
                $row[] = $this->number_fm($gtot);
                $row[] = $members['tran_date'];
                $row[] = $members['tran_narration'];
                $data[] = $row;
            }
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list() {
        
    }

}
