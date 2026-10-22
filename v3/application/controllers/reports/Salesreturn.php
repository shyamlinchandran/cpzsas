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
class Salesreturn extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Salesreturn_model', 'salereports');
    }

    function Adjustment() {
        $data['title'] = 'Sales Exchange Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/adjustment', $data);
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
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->name; 
            $row[] = $vouchers->total;
			$row[] = $vouchers->adjustment_amount; 
            $row[] = $vouchers->adjustment_ref;
            $row[] = (float) $vouchers->total - (float) $vouchers->adjustment_amount ;
			$row[] = $vouchers->salesman; 
			$row[] = $vouchers->user; 
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

}
