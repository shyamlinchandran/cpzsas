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
class Stocktransfer extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Stocktransfer_model', 'stocktransfer');
    }

    function stocktransfer() {
        $data['title'] = 'Stock Transfer Register';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/stocktransfer/stocktransfer', $data);
    }

  
      public function ajax_list() {
        $this->stocktransfer->where();
        $list = $this->stocktransfer->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->item;
            $row[] = $vouchers->frmgdn;
            $row[] = $vouchers->togdn; 
            $row[] = $vouchers->qty;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stocktransfer->count_all()+1,
            "recordsFiltered" => $this->stocktransfer->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
