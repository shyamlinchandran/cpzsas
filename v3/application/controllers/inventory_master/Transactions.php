<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase
 *
 * @author u43255
 */
class Transactions extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('inventory_model/Transactions_model', 'transaction');
    }
	public function man_journal_list() {
		$this->transaction->man_journal();
        $list = $this->transaction->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
			$row = array();
			$row[]  =$no;
            $row[] = $item->date;
            $row[] = $this->transaction->get_url($item->id,$item->voucher_no,'man_journal');
            $row[] = $item->godown_name;
            $row[] = $item->quantity;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	public function damage_list() {
        $this->transaction->damage();
        $list = $this->transaction->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
			$row = array();
			$row[]  =$no;
            $row[] = $item->date;
            $row[] = $this->transaction->get_url($item->damage_id,$item->invoice,'damage');
            $row[] = $item->godown_name;
            $row[] = $item->quantity;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
	
	 public function stockjournal_list() {
        $this->transaction->stockjournal();
        $list = $this->transaction->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
			$row = array();
			$row[]  =$no;
            $row[] = $item->date;
            $row[] = $this->transaction->get_url($item->id,$item->voucher_no,'stock_journal');
            $row[] = $item->issued;
            $row[] = $item->received;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
	 public function ajax_list() {
        $this->transaction->sales();
        $list = $this->transaction->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
			$row = array();
			$row[]  =$no;
            $row[] = $item->invoice_date;
            $row[] = $this->transaction->get_url($item->sales_id,$item->invoice,$item->type);
            $row[] = $item->customer;
            $row[] = $item->unit;
            $row[] = $item->quantity;
			$row[] = $item->mrp;
            $row[] = $item->total;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
	public function purchase_list() {
        $this->transaction->purchase();
        $list = $this->transaction->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
			$row = array();
			$row[]  =$no;
            $row[] = $item->date;
            $row[] = $this->transaction->get_url($item->id,$item->invoice,$item->type);
            $row[] = $item->supplier;
            $row[] = $item->unit;
            $row[] = $item->quantity;
			$row[] = $item->rate;
            $row[] = $item->total;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->transaction->count_all(),
            "recordsFiltered" => $this->transaction->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

  

  

}
