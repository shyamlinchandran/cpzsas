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
class SalesOrderMerge extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/SalesOrderMerge_model', 'merge');
    }

    function mergereport() {
        $data['title'] = 'Sales Order Merge Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/mergereport', $data);
    }
   
        public function ajax_list() {
        $this->merge->where();
        $list = $this->merge->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = round($vouchers->total,$this->company_roundoff);
            $row[] = round($vouchers->balance,$this->company_roundoff);
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->merge->count_all() + 1,
            "recordsFiltered" => $this->merge->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
