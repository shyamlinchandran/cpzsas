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
class Gold extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/goldreport_model', 'gold');
    }

    function Stock() {
        $settings = $this->gold->getCompanySettings();
        $data['settings'] = $settings;
        $data['title'] = 'Stock Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gold/stock', $data);
    }

    function Billwise() {
        $settings = $this->gold->getCompanySettings();
        $data['settings'] = $settings;
        $data['title'] = 'Billwise Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gold/billwise', $data);
    }

    
	public function Billwise_list(){
		$no = $this->input->post('start');
        $this->gold->billwise();
        $list = $this->gold->get_datatables();
        $data = array();
		foreach ($list as $vouchers) {
			$no++;
            $row = array();
            $row[] = $no;
			$row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->code;
			$row[] = $vouchers->stock;
            $row[] = $vouchers->landing_cost;
            $row[] =$vouchers->prate;
            $row[] =$vouchers->rate;
			$row[] = number_format($vouchers->ratevalue,$this->company_roundoff);
			$row[] = number_format($vouchers->lcvalue,$this->company_roundoff);
            $row[] = number_format($vouchers->pratevalue,$this->company_roundoff);
            $row[] =number_format($vouchers->lcmargin,$this->company_roundoff);
            $row[] =number_format($vouchers->pratemargin,$this->company_roundoff);
			
			
			
			$data[] = $row;
		}
		
		// $row = array();
        //     $row[] = $no;
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] = number_format($ratevalue,$this->company_roundoff);
		// 	$row[] = number_format($lcvalue,$this->company_roundoff);
        //     $row[] = number_format($pratevalue,$this->company_roundoff);
        //     $row[] =number_format($lcmargin,$this->company_roundoff);
        //     $row[] =number_format($pratemargin,$this->company_roundoff);
			
			
			
		// 	$data[] = $row;
		
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invoicereport->count_all() + 1,
            "recordsFiltered" => $this->invoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function Ajax_list(){
		$no = $this->input->post('start');
        $this->gold->get_stock();
        $list = $this->gold->get_datatables();
        $data = array();
        $net_wt = 0 ;
        $net_qty = 0 ;
		foreach ($list as $vouchers) {
            $net_wt = (float) $vouchers->wt  +  (float) $vouchers->purchase - (float) $vouchers->saleswt + (float) $vouchers->rec_wt - (float) $vouchers->issue_wt;
			$net_qty = (float) $vouchers->open  +  (float) $vouchers->purchaseqty - (float) $vouchers->salesqty + (float) $vouchers->rec_qty - (float) $vouchers->issue_qty;
            $no++;
            $row = array();
            $row[] = $no;
			$row[] = $vouchers->name;
            $row[] = number_format($vouchers->open,$this->company_roundoff);
            $row[] = number_format($vouchers->wt,$this->company_roundoff);
			$row[] = number_format($vouchers->purchaseqty,$this->company_roundoff);
            $row[] = number_format($vouchers->purchase,$this->company_roundoff);
            $row[] =number_format($vouchers->salesqty,$this->company_roundoff);
            $row[] =number_format($vouchers->saleswt,$this->company_roundoff);
			$row[] = number_format($vouchers->issue_qty,$this->company_roundoff);
			$row[] = number_format($vouchers->issue_wt,$this->company_roundoff);
            $row[] = number_format($vouchers->rec_qty,$this->company_roundoff);
            $row[] =number_format($vouchers->rec_wt,$this->company_roundoff);
            $row[] =number_format($net_qty,$this->company_roundoff);
            $row[] =number_format($net_wt,$this->company_roundoff);
			$data[] = $row;
		}
		
		// $row = array();
        //     $row[] = $no;
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] ='';
		// 	$row[] = number_format($ratevalue,$this->company_roundoff);
		// 	$row[] = number_format($lcvalue,$this->company_roundoff);
        //     $row[] = number_format($pratevalue,$this->company_roundoff);
        //     $row[] =number_format($lcmargin,$this->company_roundoff);
        //     $row[] =number_format($pratemargin,$this->company_roundoff);
			
			
			
		// 	$data[] = $row;
		
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->gold->count_all() + 1,
            "recordsFiltered" => $this->gold->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    

}
