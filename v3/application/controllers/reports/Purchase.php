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
class purchase extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/purchasereport_model', 'purchasereport');
    }

    function category() {
        $data['types'] = $this->purchasereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/purchasereport/categoryreport', $data);
    }

    function purchase_barcode() {
        $data['types'] = $this->purchasereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/purchasereport/purchase_barcode', $data);
    }

    public function purchase_barcode_list() {
        $this->purchasereport->purchase_barcode();
        $list = $this->purchasereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $no++;
          //  $total = $total + $vouchers->quantity;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->ibarcode;
            $row[] = $vouchers->barcode;
            $row[] = 1;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->supname;
            $data[] = $row;
        }
        // $row = array();
        // $row[] = '';
        // $row[] = '';
        // $row[] = 'Total';
        // $row[] = $this->number_fm($total);
        // $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->purchasereport->count_all()+1,
            "recordsFiltered" => $this->purchasereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }



    function purchasereport() {
        $data['purtype'] = 'purchase';
        $data['title'] = 'Purchase Report';
        $data['types'] = $this->purchasereport->getType();
        $data['settings'] =  $settings = $this->purchasereport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/purchasereport/purchasereport', $data);
    }
     function purchasereturn() {
        $data['title'] = 'Purchase Return Report';
        $data['purtype'] = 'purchase_return';
        $data['types'] = $this->purchasereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/purchasereport/purchasereport', $data);
    }
     function purchaseorder() {
        $data['title'] = 'Purchase Order Report';
        $data['purtype'] = 'order';
        $data['types'] = $this->purchasereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/purchasereport/purchasereport', $data);
    }

    public function category_list() {
        $this->purchasereport->wherecategory();
        $list = $this->purchasereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $no++;
            $total = $total + $vouchers->quantity;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->item;
            $row[] = $vouchers->name;
            $row[] = $vouchers->quantity;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = 'Total';
        $row[] = $this->number_fm($total);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->purchasereport->count_all()+1,
            "recordsFiltered" => $this->purchasereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $company = $this->purchasereport->getCompany();
		$com_state = substr($company['tin'],0,2);
        $this->purchasereport->where();
        $list = $this->purchasereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $totalroundoff = 0;
        $totbeftax = 0;
        $ttax = 0;
        $tot_igst  = 0 ;
		$tot_sgst = 0;
        $gbef = 0;
        $cessamt = 0;
        $is_cigarette_cess = $this->input->post('is_cigarette_cess');
        foreach ($list as $vouchers) {
            $cust_state = $vouchers->tin;
			$cust_state  = substr($cust_state,0,2);
            if($cust_state == '' ){
                $cust_state = $com_state;
            }
			$sgst = 0;
			if((float)$vouchers->ptax > 0  ){

				$sgst = $vouchers->ptax/2;
                if($com_state == $cust_state){
				$tot_sgst = (float) $tot_sgst + (float) $sgst;
                }else{
                    $tot_igst = (float) $tot_igst + (float) $vouchers->ptax;

                }
			}
            $no++;
            $totbeftax = $vouchers->Ptotal - $vouchers->ptax    ;
            $gbef = (float) $gbef  + $vouchers->Ptotal - $vouchers->ptax    ;
            $ttax = $ttax + ($totbeftax*$vouchers->cur_exc_amt);
            $grandtotal = $grandtotal + ($vouchers->total*$vouchers->cur_exc_amt);
            $totaltax = $totaltax + ($vouchers->tax*$vouchers->cur_exc_amt);
            $totalroundoff = $totalroundoff + ($vouchers->roundoff*$vouchers->cur_exc_amt);
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->in_date;
            $row[] = $vouchers->createduser;
            $row[] = $this->purchasereport->get_url($vouchers->id,$vouchers->invoice,$vouchers->ptype);
            $row[] = $vouchers->name;
            $row[] = $vouchers->tin;
            $row[] = round(($vouchers->Ptotal - $vouchers->ptax   )*$vouchers->cur_exc_amt,$this->company_roundoff);
            if($com_state == $cust_state){
                $row[] = round($sgst*$vouchers->cur_exc_amt,$this->company_roundoff);
                $row[] = round($sgst*$vouchers->cur_exc_amt,$this->company_roundoff);
                $row[] = '0.00';
            }else{
                $row[] = '0.00';
                $row[] = '0.00';
                $row[] = round($vouchers->tax*$vouchers->cur_exc_amt,$this->company_roundoff);
            }
           
            if($is_cigarette_cess > 0 ){
                $row[] = round($vouchers->cessamt*$vouchers->cur_exc_amt,$this->company_roundoff);
                $cessamt = (float) $cessamt + (float) $vouchers->cessamt;
            }
            $row[] = $vouchers->discount;
            $row[] = round($vouchers->roundoff*$vouchers->cur_exc_amt,$this->company_roundoff);
            $row[] = round($vouchers->total*$vouchers->cur_exc_amt,$this->company_roundoff);

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total ';
        $row[] = $this->number_fm($gbef);
        $row[] = $this->number_fm($tot_sgst);
        $row[] = $this->number_fm($tot_sgst);
        $row[] = $this->number_fm($tot_igst);
        if($is_cigarette_cess > 0 ){
            $row[] = round($cessamt*$vouchers->cur_exc_amt,$this->company_roundoff);
        }
        $row[] = '';
        $row[] = $this->number_fm($totalroundoff);
        $row[] = $this->number_fm($grandtotal);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->purchasereport->count_all()+1,
            "recordsFiltered" => $this->purchasereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
