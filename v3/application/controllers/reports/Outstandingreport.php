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
class Outstandingreport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Outstandreport_model', 'outstand');
    }

    function outstandingreport() {
        $data['title'] = 'Outstanding Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/outstandreport/outstand', $data);
    }
   
      public function ajax_list() {
        $this->outstand->where();
        $list = $this->outstand->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $totcredit=$totdebit=0;
        foreach ($list as $vouchers) {
            $credit =$debit =0;
            $no++;
            if($vouchers->credit>0){
                $debit = $vouchers->credit;
                $totdebit=$totdebit+$debit;
            }
            if($vouchers->credit<0){
                $credit =  $vouchers->credit*-1;
                $totcredit=$totcredit+$credit;
            }
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->phone;
            $row[] = $credit;
            $row[] = $debit; 
            $data[] = $row;
        }$no++;
         $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = 'Total';
            $row[] = $this->number_fm($totcredit);
            $row[] = $this->number_fm($totdebit); 
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->outstand->count_all()+1,
            "recordsFiltered" => $this->outstand->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
