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
class totalinvoicereport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/totinvereport_model', 'totalinvoicereport');
    }

    function purchase() {
        // $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/totalinvoicereport/purchase');
    }

    function sales() {
        // $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/totalinvoicereport/sales');
    }

    public function purchase_list() {
        $this->totalinvoicereport->purchase();
        $list = $this->totalinvoicereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $no++;
            $total = $total + $vouchers->total;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $this->totalinvoicereport->get_url($vouchers->pid, $vouchers->invoice, $vouchers->ptype);
            $row[] = $vouchers->name;
            $row[] = $vouchers->btype;
            $row[] = $vouchers->total;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = number_format($total,$this->company_roundoff);
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->totalinvoicereport->count_all() + 1,
            "recordsFiltered" => $this->totalinvoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->totalinvoicereport->sales();
        $list = $this->totalinvoicereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $ctype = $vouchers->cash_type;
            if ($ctype == 'COB') {
                $ctype = 'Cash/Bank';
            } else if ($ctype == 'Ba_Ca_Cr') {
                $ctype = 'Bank/Cash/Credit';
            } else if ($ctype == 'Ca_Cr') {
                $ctype = 'Cash/Credit';
            } else if ($ctype == 'Ba_Cr') {
                $ctype = 'Bank/Credit';
            }
            $no++;
            $total = $total + $vouchers->total;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->totalinvoicereport->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->name;
            $row[] = $ctype;
            $row[] = $vouchers->btype;
            $row[] = $vouchers->total;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = number_format($total,$this->company_roundoff);
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->totalinvoicereport->count_all() + 1,
            "recordsFiltered" => $this->totalinvoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
