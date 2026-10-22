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
class Stock extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('itemreg_model', 'itemreg');
    }

    public function leadger() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/stock/leadger');
    }

    public function itemstock() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/stock/stock');
    }
	
	public function day_stock() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/stock/day_stock');
    }
	
	public function get_day_stock() {
        $this->itemreg->day_stock();
        $list = $this->itemreg->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->hsn;
            $row[] = $vouchers->unit;
            $row[] = $vouchers->GST;
			$row[] = $vouchers->godown_name;
            $row[] = $vouchers->day_stock;
            $row[] = $vouchers->stock_in;
            $row[] = $vouchers->stock_out;
            $row[] = $vouchers->stock;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemreg->count_all() + 1,
            "recordsFiltered" => $this->itemreg->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }



    public function godownstock() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/stock/godownstock');
    }

    public function get_stock() {
        $this->itemreg->stocknow();
        $list = $this->itemreg->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->catname;
            $row[] = $vouchers->current_stock;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemreg->count_all() + 1,
            "recordsFiltered" => $this->itemreg->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function godown_stock() {
        $this->itemreg->godownstock();
        $list = $this->itemreg->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->godown_name;
            $row[] = $vouchers->item_qty;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemreg->count_all() + 1,
            "recordsFiltered" => $this->itemreg->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    private function addrow($no, $date, $narration, $dbit, $cdit, $stock,$voucher="",$godown ='' ) {
        $row = array();
        $row[] = $no + 1;
        $row[] = $date;
        $row[] = $narration;
        $row[] = $voucher;
		$row[] = $godown;
        $row[] = number_format((float)$cdit,$this->company_roundoff);
        $row[] = number_format((float)$dbit,$this->company_roundoff);
        $row[] = number_format((float)$stock,$this->company_roundoff);
        return $row;
    }

    var $dbit = 0.0;
    var $credit = 0.0;
    var $open = 0.0;
    var $stock = 0.0;

    public function getopst($date, $id) {
        log_message('error', 'Some variable did not contain a value.');
        $amt1 = $this->itemreg->getopst($date, $id);
        $this->open = $amt1['open'];
        $this->stock = $amt1['open_stock'];
    }

    public function getLedegerbalance($date, $id, $type) {
        log_message('error', 'Some variable did not contain a value.');
        $amt = $this->itemreg->getLedegerbalance($date, $id, $type);


        if ($amt >= 0) {
            $this->dbit = $amt;
            $this->credit = 0;
        } else {
            $this->dbit = 0;
            $this->credit = $amt;
        }
    }

    public function ajax_list() {
        $this->itemreg->where();
        $this->getopst($this->input->post('startdate'), $this->input->post('toid'));

        $list = $this->itemreg->get_datatables();
        $totCredit = 0;
        $totDebit = 0;
        $data = array();
        $no = $this->input->post('start');
        $stock = 0;
        $opst = 0;
        $this->getLedegerbalance($this->input->post('startdate'), $this->input->post('toid'), 'op');
        if (sizeof($list) != '') {
            foreach ($list as $members) {
                if ($no == 0) {
                    $this->open = $this->open + $members->godownopen;
                    if ($this->open > 0) {
                        $this->dbit = $this->open;
                        $totDebit = $totDebit + $this->open;
                    } else {
                        $this->credit = $this->open;
                        $totCredit = $totCredit + ($this->open * -1);
                    }
                    $row = $this->addrow($no, '', 'Openning Balance', $this->dbit, $this->credit * -1, $this->open);
					$amount =  $this->itemreg->getamount();
					$row[] = $amount['cr'];
					$row[] = $amount['dt'];
					$data[] = $row;
                }
                $no++;
                if ($members->trans_type == 'cr') {


                    $this->open = $this->open - $members->quantity;
                    $totCredit = $totCredit + $members->quantity;


                    $data[] = $this->addrow($no, $members->trans_date, $members->trans_status, '', $members->quantity, $this->open,$this->itemreg->get_url($members->trans_id,$members->voucher_no,$members->trans_status),$members->godown_name);
                    $stock = $members->quantity - $members->openstock;
                } else {

                    $this->open = $this->open + $members->quantity;
                    $totDebit = $totDebit + $members->quantity;


                    $data[] = $this->addrow($no, $members->trans_date, $members->trans_status, $members->quantity, '', $this->open,$this->itemreg->get_url($members->trans_id,$members->voucher_no,$members->trans_status),$members->godown_name);
                    $stock = $members->quantity + $members->open_stock;
                }
            }$no++;
        } else {
			if($this->open + $this->stock >= 0){
				$dt = $this->open + $this->stock;
				$cr = 0;
			}else{
				$cr = ($this->open + $this->stock)*-1;
				$dt = 0;
			}
            $row = $this->addrow($no, '', 'Openning Balance', $dt, $cr, $this->open + $this->stock);
			$row[] = $cr;
			$row[] = $dt;
			$data[] = $row;
            $data[] = $this->addrow($no, '', 'Closing Balance', 0, 0, $this->open + $this->stock);
        }
        $this->getLedegerbalance($this->input->post('enddate'), $this->input->post('toid'), 'cl');
        if (sizeof($list) != '') {
        $data[] = $this->addrow($no, '', 'Closing Balance', $totDebit, $totCredit, $this->open);
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemreg->count_all() + 1,
            "recordsFiltered" => $this->itemreg->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
