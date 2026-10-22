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
class Pos extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Pos_model', 'pos');
    }

	function dayreport(){
		$settings = $this->pos->getCompanySettings();
		$qry = "select a.name,b.id from counter as a inner join set_billtype as b on b.id= a.bill_type where is_pos = 1 and transaction='sales'";
		$query = $this->db->query($qry)->result_array();
		$data['billtypes']  = $query;
        $data['settings'] = $settings;
        $data['title'] = 'Pos Day Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/pos/dayreport', $data);
	}
   
    function posreport() {
        $settings = $this->pos->getCompanySettings();
		$qry = "select a.name,b.id from counter as a inner join set_billtype as b on b.id= a.bill_type where is_pos = 1 and transaction='sales'";
		$query = $this->db->query($qry)->result_array();
		$data['billtypes']  = $query;
        $data['settings'] = $settings;
        $data['title'] = 'Pos Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/pos/posreport', $data);
    }

    public function ajax_list() {
        $this->pos->where();
        $list = $this->pos->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = $distotal = 0;
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->counter;
            $row[] = $vouchers->user;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->cash_amount;
            $row[] = $vouchers->bank_amount;
            $row[] = $vouchers->total;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pos->count_all() + 1,
            "recordsFiltered" => $this->pos->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function day_list() {
        $this->pos->getdayreport();
        $list = $this->pos->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = $distotal = 0;
        foreach ($list as $vouchers) {
			$status = 'Completed';
			if((int)$vouchers->status <1 ){
				$status = 'Processing';
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->trans_date;
            $row[] = $vouchers->cnt;
            $row[] = $vouchers->opening_balance;
            $row[] = $vouchers->cash;
            $row[] = $vouchers->bank;
            $row[] = $vouchers->total;
            $row[] = $vouchers->closing_balance;
            $row[] = $status ;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pos->count_all() + 1,
            "recordsFiltered" => $this->pos->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
