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
class Package_report extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Package_model', 'package');
    }
	
	

    function Package_sales($type = "") {
		$data['title'] = 'Package Sales Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/package/package_sales',$data);
    }

	
	public function ajax_list() {
        $this->package->Package_sales();
        $list = $this->package->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->package;
            $row[] = $items->student;
            $row[] = $items->fee_start_date;
            $row[] = $items->fee_end_date;
            $row[] = $items->payment_method;
            $row[] = $items->discountedfee;
            $row[] = $items->no_of_classes;
            $row[] = $items->attended_classes;
            $row[] = $items->balance;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->package->count_all(),
            "recordsFiltered" => $this->package->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	
	


	


}
