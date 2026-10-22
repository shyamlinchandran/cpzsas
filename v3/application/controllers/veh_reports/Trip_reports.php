<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Trip_reports extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('veh_reports/Trip_reports_model', 'trip');
//        $this->load->library('excel'); //load PHPExcel library 
//        $this->load->model('excel_data_insert_model', 'itemexcel');
    }
  

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('veh_reports/list');
    }
    public function ajax_list() {
        $this->trip->where();
        $list = $this->trip->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //print_r($itemcount);
            $row = array();
            $row[] = $no;
            $row[] = $item->trip_startdate;
            $row[] = $item->trip_enddate;
            $row[] = $item->veh_number;
            $row[] = $item->pro_fname;
            $row[] = $item->name;
            $row[] = $item->trip_total;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trip->count_all(),
            "recordsFiltered" => $this->trip->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
