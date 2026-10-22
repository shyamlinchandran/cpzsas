<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aeging
 *
 * @author jijodileep
 */
class Aeging extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('reports/aging_model', 'aging');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/aging/aging');
    }
    public function  del($id){
         $this->aging->age();
    }
	
	public function salesoutstand_list(){
		$this->aging->wherecondition();
        $this->aging->salesaging();
        $list = $this->aging->get_datatables();
        $data = array();
        $id = 0;
        $totcredit=$totdebit=$totbalance=0;
        foreach ($list as $members) {
            $id = $id + 1;
            $totcredit =$totcredit + $members->credit;
            $totdebit = $totdebit + $members->debit;
            $row = array();
            $row[] = $members->name;
            $row[] = $this->aging->get_url($members->tb_id,$members->voucher_no,$members->tb_name);
			$row[] = $members->names;
			$row[] = $members->user;
            $row[] = $members->tb_crdate;
            $row[] = $members->debit;
            $row[] = $members->credit;

            $bal = $members->debit - $members->credit;
            if ($bal < 0) {
                $row[] = ($bal * -1) . ' CR';
            } else {
                $row[] = ($bal) . ' DR';
            }
            $row[] = $members->outdate; 
          
            $data[] = $row;
        }
            $row = array();
            $row[] = '';
            $row[] = '';
			$row[] = '';
			$row[] = '';
            $row[] = 'Total';
            $row[] = $totdebit;
            $row[] = $totcredit;
            $row[] = '';
            $row[] = ''; 
          
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->aging->count_all()+1,
            "recordsFiltered" => $this->aging->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

  public function outstanding_list() {
        $this->aging->outstanding();
        $this->aging->age();
        $list = $this->aging->get_datatables();
        $data = array();
        $id = 0;
        $totcredit=$totdebit=$totbalance=$totreturn = 0;
        foreach ($list as $members) {
		//	if($members->billno != '' && $members->billno != null && $members->billno != 'null'){
				$id = $id + 1;
				$totcredit =$totcredit + $members->credit;
				$totreturn =$totreturn + $members->return_amount;
				$totdebit = $totdebit + $members->debit + $members->return_amount;
				$row = array();
				$row[] = $members->name;
                $inv = $this->aging->get_url($members->tb_id,$members->voucher_no,$members->tb_name);
                if($inv ==''){
                    $inv = $members->voucher_no;
                }
				$row[] = $inv.' Previous FY';
				$row[] = $members->tb_crdate;
				$row[] = $members->route_name;
				$row[] = $members->area_name;
				$row[] = $members->debit + $members->return_amount;
				$row[] = $members->return_amount;
				$row[] = $members->credit;

				$bal = $members->debit - $members->credit;
				if ($bal < 0) {
					$row[] = ($bal * -1) . ' CR';
				} else {
					$row[] = ($bal) . ' DR';
				}
				$row[] = $members->outdate; 
				
				$row[] = $members->due;
				$row[] = $members->day;
				$data[] = $row;
		//	}
        }
            $row = array();
            $row[] = '';
            $row[] = '';
             $row[] = '';
            $row[] = '';
            $row[] = 'Total';
            $row[] = $totdebit;
            $row[] = $totreturn;
            $row[] = $totcredit;
            $row[] = '';
            $row[] = ''; 
			$row[] = '';
            $row[] = ''; 
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->aging->count_all()+1,
            "recordsFiltered" => $this->aging->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list() {
        $this->aging->wherea();
        $this->aging->age();
        $list = $this->aging->get_datatables();
        $data = array();
        $id = 0;

        foreach ($list as $members) {
            $id = $id + 1;
            $row = array();
            $row[] = $members->name;
            $row[] = $this->aging->get_url($members->tb_id,$members->voucher_no,$members->tb_name);
            $row[] = $members->tb_crdate;
            $row[] = $members->debit;
            $row[] = $members->credit;

            $bal = $members->debit - $members->credit;
            if ($bal < 0) {
                $row[] = ($bal * -1) . ' CR';
            } else {
                $row[] = ($bal) . ' DR';
            }
            $row[] = $members->outdate; 
            $act = ' <a tp="confirm" base="' . base_url() . 'transport/aeging/listall" message="Do you want Delete ' . $members->voucher_no. ' ?" success="Delete  ' . $members->voucher_no. ' successfuly " href="' . base_url() . 'transport/aeging/del/' . $members->age_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[]=$act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->aging->count_all()+1,
            "recordsFiltered" => $this->aging->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
