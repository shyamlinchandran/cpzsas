<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vouchers
 *
 * @author u43255
 */
class Vouchers extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('vouchers_model', 'vouchers');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function getLedegerbalance($id) {
        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $id, 'cl');
        if ($amt < 0) {
            echo round(($amt * -1), 2) . ' Cr';
        } else {
            echo $amt . ' Cr';
        }
    }

    function delete($id) {
        $this->vouchers->delete($id);
    }

    function cancel($id) {
        $this->vouchers->cancel($id);
    }

    public function listall($type) {
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/vouchers/list_all', $data);
    }

    public function ajax_list() {
        $this->vouchers->wherecustomer();
        $list = $this->vouchers->get_datatables();
        $max = $this->vouchers->max();
        $max_id = $max['max_id'];
        // print_r($max_id);
        // exit();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->tran_date;
            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->invoice;
            } else {
                $row[] = $vouchers->voucher_no;
            }
			$row[] = str_replace(',', '<br/>', $vouchers->names);

            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->naration;
            }
            $row[] = str_replace(';', '<br/>', $vouchers->credit_amounnts);
            $row[] = str_replace(';', '<br/>', $vouchers->debit_amounts);
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->vouchers->count_all(),
            "recordsFiltered" => $this->vouchers->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function payment($id = 0, $view = '') {
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/vouchers/payment', $data);
    }

    public function receipt($id = 0, $view = '') {
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/vouchers/receipt', $data);
    }

    public function journal($id = 0, $view = '') {
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/vouchers/journal', $data);
    }

    public function save() {
        $response = $this->vouchers->save();
        echo json_encode($response);
    }

    public function savejournel() {
        $response = $this->vouchers->savejournel();
        echo json_encode($response);
    }

    public function search($type) {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->ledgers->getautocomplete($q, $type);
        }
    }

    function getVoucher($id) {
        $sale = $this->vouchers->getvouchers($id);
        echo json_encode($sale);
    }

    function getJouVoucher($id) {
        $sale = $this->vouchers->getjouvouchers($id);
        echo json_encode($sale);
    }

    
}
