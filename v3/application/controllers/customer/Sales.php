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
class Sales extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function listall($type) {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/sales/list_all', $data);
    }

    function delete($id) {
        $this->sales->delete($id);
    }

    function ledbal($id) {
        $data = $this->sales->ledbalid($id);
        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $data['id'], 'cl');
        if ($amt < 0) {
            echo round(($amt * -1), 2) . ' Cr';
        } else {
            echo $amt . ' Cr';
        }
    }

    function cancel($id) {
        $this->sales->cancel($id);
    }

    public function ajax_list() {
        $this->sales->wherecustomer();
        $max = $this->sales->max();
        $max_id = $max['max_id'];
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->in_date;
            if ($vouchers->customer_id == 0) {
                $row[] = $vouchers->cusname;
            } else {
                $row[] = $vouchers->name;
            }
            //$row[] = $vouchers->narration;
            //$row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all_sales(),
            "recordsFiltered" => $this->sales->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function sales($type, $id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['type'] = $type;
        $settings = $this->sales->getCompanySettings();
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales', $data);
    }

    /* estimate start */

    public function estimate($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/estimate', $data);
    }

    /* estimate End */

    public function sales8b($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8b', $data);
    }

    public function sales8($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8', $data);
    }

    public function sales_return($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $this->load->view('transaction/sales/salesr', $data);
    }

    public function view($id) {
        $data['id'] = $id;
        $data['type'] = 'View';
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/sales/view', $data);
    }

    public function save($type) {
        $id = $this->sales->save($type);
        if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'bill' => base_url() . 'transaction/sales/bill/' . $id,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }
    }

    

}
