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
class Commission extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Commission_model', 'commission');
    }

    function Commision() {
        $data['settings'] = $this->commission->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/commission/commission', $data);
    }
	
	function ItemwiseCommision(){
		$data['saletype'] = 'sales';
		$data['title'] = 'Item Wise Commission Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/commission/itemcommission',$data);
	}
	function BillwiseCommision(){
		$data['saletype'] = 'sales';
		$data['title'] = 'Bill Wise Commission Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/commission/billcommission',$data);
	}

    function CommisionAnalyse(){
		$data['saletype'] = 'sales';
		$data['title'] = 'Bill Wise Commission Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/commission/commissionanalyze',$data);
	}
	
    
	 public function commissionanalysis() {
        $this->commission->commissionanalysis();
        $list = $this->commission->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->refname;
            $row[] = $vouchers->item_commission;
            $row[] = $vouchers->return_commission;
            $row[] = (float) $vouchers->item_commission - (float) $vouchers->return_commission;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->commission->count_all() + 1,
            "recordsFiltered" => $this->commission->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	 public function billwise_list() {
        $this->commission->billwise_list();
        $list = $this->commission->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->commission->get_url($vouchers->sales_id, $vouchers->invoice, $vouchers->type);
            $row[] = $vouchers->customer;
            $row[] = $vouchers->cash_type;
			$row[] = $vouchers->total;
            $row[] = $vouchers->item_commission;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->commission->count_all() + 1,
            "recordsFiltered" => $this->commission->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	 public function itemwise_list() {
        $this->commission->itemwise_list();
        $list = $this->commission->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->commission->get_url($vouchers->sales_id, $vouchers->invoice, $vouchers->type);
            $row[] = $vouchers->name;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->total;
            $row[] = $vouchers->customer;
            $row[] = $vouchers->cash_type;
            $row[] = $vouchers->item_commission;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->commission->count_all() + 1,
            "recordsFiltered" => $this->commission->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->commission->wherecondition();
        $list = $this->commission->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        $grandtotal = 0;
        foreach ($list as $vouchers) {
            $total = $total + $vouchers->amount;
            $grandtotal = $grandtotal + $vouchers->total;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->user_name;
            $row[] = number_format($vouchers->total,$this->company_roundoff);
            $row[] = $vouchers->percentage.'  %';
            $row[] = number_format($vouchers->amount,$this->company_roundoff);
            $data[] = $row;
        }
        $no++;
        $row = array();
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '<b>'.number_format($grandtotal,$this->company_roundoff).'</b>';
        $row[] = '';
        $row[] = '<b>'.number_format($total,$this->company_roundoff).'</b>';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->commission->count_all() + 1,
            "recordsFiltered" => $this->commission->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
