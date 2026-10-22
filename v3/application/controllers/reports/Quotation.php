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
class Quotation extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Quotationreport_model', 'quotation');
    }

    function quotationreport() {
        $data['title'] = 'Quotation Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/quotationreport/quotationreport', $data);
    }

  
      public function ajax_list() {
        $this->quotation->where();
        $list = $this->quotation->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->cusname; 
            $row[] = $vouchers->total;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->quotation->count_all()+1,
            "recordsFiltered" => $this->quotation->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
