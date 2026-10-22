<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of stock
 *
 * @author jijodileep
 */
class Itemdetails extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/itemdetails_model', 'itemdtl');
       }

    public function listall() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/itemdetails');
    }
 public function ajax_list() {
        //$this->itemdtl->stocknow();
        $list = $this->itemdtl->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $quantity =0 ;$open_stk_rate =0;
        foreach ($list as $item) {
            $quantity = $quantity +  $item->open_stock;
            $open_stk_rate = $open_stk_rate +  $item->open_stock*$item->open_stk_rate;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->item;
            $row[] = $item->hsn;
            $row[] = $item->unit;
            $row[] = $item->godown;
            //$row[] = $item->quantity;
            $row[] = $item->open_stock;
            $row[] = number_format((float)$item->open_stk_rate,$this->company_roundoff);
            $row[] = number_format((float)$item->open_stock*$item->open_stk_rate,$this->company_roundoff);
            $data[] = $row;
        }
          $row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = 'Total';
            $row[] = '';
            $row[] = '';
            $row[] ='';
           // $row[] = '';
            $row[] = number_format($quantity,$this->company_roundoff);
            $row[] = '';
            $row[] = number_format($open_stk_rate,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemdtl->count_all()+1,
            "recordsFiltered" => $this->itemdtl->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }   
}



    


