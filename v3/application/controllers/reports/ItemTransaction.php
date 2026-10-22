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
class ItemTransaction extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/ItemTransaction_model', 'trans');
    }

    
    function stock_journal() {
		$data['title'] = 'Stock Journal Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemtransaction/stock_journal', $data);
    }
	
	function godown_transfer() {
		$data['title'] = 'Godown Transfer Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemtransaction/godown_transfer', $data);
    }
	
	function item_movement() {
		$data['title'] = 'Item Movement Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemtransaction/item_movement', $data);
    }
	
	function physical_stk_update() {
		$data['title'] = 'Physical Stock Update Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemtransaction/physical_stk_update', $data);
    }
	
	public function physical_stk_update_list(){
		$this->trans->physical_stk_update();
		$list = $this->trans->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->godown_name;
            $row[] = $vouchers->open_stock;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->voucher_date;
            $row[] = $vouchers->Increase;
            $row[] = $vouchers->Decrease;
            $row[] = $vouchers->stock;
            $data[] = $row;
        }
         
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trans->count_all()+1,
            "recordsFiltered" => $this->trans->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	public function movement_list() {
        $this->trans->stock_movement();
        $list = $this->trans->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->itemopen;
            $row[] = $vouchers->purchase;
            $row[] = $vouchers->purchase_return;
            $row[] = $vouchers->sales;
            $row[] = $vouchers->sreturn;
            $row[] = $vouchers->damage;
            $row[] = $vouchers->sjissue;
			$row[] = $vouchers->sjrec;
			$row[] = $vouchers->mjissue;
			$row[] = $vouchers->mjrec;
			$row[] = $vouchers->stock;
            $data[] = $row;
        }
         
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trans->count_all()+1,
            "recordsFiltered" => $this->trans->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }

	public function ajax_list() {
        $this->trans->stock_journal();
        $list = $this->trans->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $this->trans->get_url($vouchers->id, $vouchers->voucher_no, 'stock_journal');
            $row[] = $vouchers->name;
            $row[] = $vouchers->godown_name;
            $row[] = $vouchers->type;
            $row[] = $vouchers->srate;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->prate;
            $row[] = $vouchers->stock_value;
            $data[] = $row;
        }
         
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trans->count_all()+1,
            "recordsFiltered" => $this->trans->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
	public function transfer_list() {
        $this->trans->godown_transfer();
        $list = $this->trans->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $this->trans->get_url($vouchers->id, $vouchers->invoice, 'transfer');
            $row[] = $vouchers->name;
            $row[] = $vouchers->from_godown;
            $row[] = $vouchers->to_godown;
            $row[] = $vouchers->unit;
            $row[] = $vouchers->qty;
            $data[] = $row;
        }
         
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trans->count_all()+1,
            "recordsFiltered" => $this->trans->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
}
