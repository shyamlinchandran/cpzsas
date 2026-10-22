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
class Salesorder extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/salereport_model', 'salereports');
    }

    function type() {
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/typereport', $data);
    }
     function category() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/categoryreport');
    }
    function salesreport() {
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salesreport', $data);
    }
     function salerefreport() {
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salerefreport', $data);
    }
    public function category_list() {
        $this->salereports->wherecategory();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $no++;
            $total = $total +  $vouchers->quantity;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->item;
            $row[] = $vouchers->name;
            $row[] = $vouchers->quantity; 
            $data[] = $row;
        }
        $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = 'Total';
            $row[] = $this->number_fm($total); 
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all()+1,
            "recordsFiltered" => $this->salereports->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
      public function ajax_list() {
        $this->salereports->where();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->name; 
            $row[] = $vouchers->total;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all()+1,
            "recordsFiltered" => $this->salereports->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
public function get_salesreport() {
        $this->salereports->wherecondition();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal=0;
        $totaltax=0;
        $totalroundoff=0;
        foreach ($list as $vouchers) {
            $no++;
            $grandtotal=$grandtotal+$vouchers->total;
            $totaltax=$totaltax+$vouchers->tax;
            $totalroundoff=$totalroundoff+$vouchers->roundoff;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->name;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->ref;
            $row[] = $vouchers->invoice_date; 
            $row[] = $vouchers->tax;
            $row[] = $vouchers->roundoff;
            $row[] = $vouchers->total;

            $data[] = $row;
        }
         $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
 $row[] = '';
        $row[] = '';        $row[] = 'Total ';
        $row[] = $this->number_fm($totaltax);
        $row[] = $this->number_fm($totalroundoff);
        $row[] = $this->number_fm($grandtotal);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all()+1,
            "recordsFiltered" => $this->salereports->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
