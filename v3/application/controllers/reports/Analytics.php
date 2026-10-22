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
class Analytics extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Analytics_model', 'analytics');
    }
    function voucheredit(){
        $data['title'] = 'Edited Voucher Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/analytics/voucheredit',$data);
    }

    public function edited_list() {
        $this->analytics->edited_list();
        $list = $this->analytics->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->trn_tp;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->created_date;
            $row[] = $vouchers->created ;

            $row[] = $vouchers->voucher_value;
            $row[] = $vouchers->edited_count;
            $row[] = $vouchers->last_edited_date;
            $row[] = $vouchers->last_edited_value ;
            $row[] = $vouchers->edited;
            $row[] = $vouchers->salemanname ;
            $row[] = $vouchers->agentname ;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->analytics->count_all() + 1,
            "recordsFiltered" => $this->analytics->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	

    function ItemAnalytics($type ="asc") {
		$data['type'] = $type;
		$data['title'] = 'Item Analytics Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/analytics/item_analytics', $data);
    }
	
	function CustomerAnalytics($type="asc"){
		$data['type'] = $type;
		$data['title'] = 'Customer Analytics Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/analytics/customer_analytics',$data);
	}
	
	
	 public function Item_list() {
        $this->analytics->ItemAnalytics();
        $list = $this->analytics->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->total ;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->analytics->count_all() + 1,
            "recordsFiltered" => $this->analytics->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	 public function Customer_list() {
        $this->analytics->CustomerAnalytics();
        $list = $this->analytics->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->phone;
            $row[] = $vouchers->count;
            $row[] = $vouchers->total ;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->analytics->count_all() + 1,
            "recordsFiltered" => $this->analytics->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
}
