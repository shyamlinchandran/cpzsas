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
class Hsn extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Hsn_model', 'hsn');
    }
	
	function getinvoice(){
		$search = strtolower($_GET['term']);
        return $this->hsn->getinvoice($search);
	}
	
	function eway(){
		$data['title'] = 'E-way Bill Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/eway',$data);
	}
	
	function itemreport(){
		$data['title'] = 'Item Wise Hsn  Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/itemreport',$data);
	}
	
	function purchasehsn(){
		$data['title'] = 'Purchase Hsn Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/purchasehsn',$data);
	}
	
	function salesexport(){
		$data['title'] = 'Sales Export';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/salesexport',$data);
	}


	function saleshsn(){
		$data['title'] = 'Sales Hsn Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/saleshsn',$data);
	}
	
	function saleshsn_consolidate(){
		$data['title'] = 'Sales Hsn Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/saleshsn_consolidate',$data);
	}
	
	 function Billwise() {
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
        $data['settings'] = $this->hsn->getCompanySettings();
		$data['title'] = 'Gst Sales Taxwise';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/billwisereport',$data);
    }
	 function Daywise() {
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
		$data['title'] = 'GST Report Daywise Sales';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/daywisereport',$data);
    }
	
	function Billwise_purchase() {
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
        $data['settings'] =  $settings = $this->hsn->getCompanySettings();
		$data['title'] = 'GST Purchase Taxwise';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/billwisereport_pur',$data);
    }
	
	 function Hsnreport() {
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
		$data['title'] = 'Hsn Wise Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/hsnreport',$data);
    }
	function Hsnreport_new() {
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
		$data['title'] = 'Hsn Wise Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/hsn/hsnreport_new',$data);
    }
	
	public function hsn_list() {
        $this->hsn->where_hsn();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$company = $this->hsn->getCompany();
		$com_state = substr($company['tin'],0,2);
		$taxable = $total = 0;
        foreach ($list as $items) {
			$taxable = (float) $taxable  +(float)  $items->taxable;
			$total = (float) $total  +(float)  $items->total;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsn;
            $row[] = $items->quantity;
            $row[] = $items->taxable;
			if((float) $items->tax < 1 ){
				$row[] = 0;
				$row[] = 0;
			}else{
				$row[] = $items->tax/2;
				$row[] = $items->tax/2;
			}
            $row[] = $items->taxable_igst;
            $row[] = $items->tax_igst;
            $row[] = $items->itm_raw_ces;
            $row[] = $items->kfc;
			$row[] = $items->total;
            $data[] = $row;
        }
		$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = round($taxable,$this->company_roundoff);
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($total,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


  public function ajax_list() {
        $this->hsn->where();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$company = $this->hsn->getCompany();
		$com_state = substr($company['tin'],0,2);
		$tot = 0;
		foreach($tax_array as $item){
			$tot_array['taxable'.$item['gstid']] = 0;
			$tot_array['tax'.$item['gstid']] = 0;
			$tot_array['igst'.$item['gstid']] = 0;
		}
        foreach ($list as $items) {
			$tot = (float) $tot + (float) $items->tot;
			$cust_state = $items->custstate;
			$cust_state = substr($cust_state,0,2);
			if($cust_state == '' ){
				$cust_state  = $com_state;
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsncode;
            $row[] = $items->in_date;
            $row[] = $items->invoice;
            $row[] = $items->type;
            $row[] = $items->name;
            $row[] = $items->hsnqty;
			foreach($tax_array as $item){
				$txt = 'taxable'.$item['gstid']; 
				$taxtxt = 'tax'.$item['gstid'];
				$igst = 'tottax'.$item['gstid'];
				if($cust_state == $com_state){
					$tot_array['taxable'.$item['gstid']] = (float) $tot_array['taxable'.$item['gstid']] + (float) $items->$txt;
					$tot_array['tax'.$item['gstid']] = (float) $tot_array['tax'.$item['gstid']]  + (float) $items->$taxtxt/2;
					$row[] = round($items->$txt,$this->company_roundoff);
					$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
					$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
					$row[] = number_format(0,2);
				}else{
					$tot_array['taxable'.$item['gstid']] = (float) $tot_array['taxable'.$item['gstid']] + (float) $items->$txt;
					$row[] = round($items->$txt,$this->company_roundoff);
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
					$row[] = number_format($items->$taxtxt,$this->company_roundoff);
					$tot_array['igst'.$item['gstid']] = (float) $tot_array['igst'.$item['gstid']] + (float) $items->$taxtxt;
				}
				
			}
			$row[] = $items->tot;
            $data[] = $row;
        }
		$row = array();
            $row[] = '';
            $row[] = '';
			$row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			foreach($tax_array as $item){
				$row[] = round($tot_array['taxable'.$item['gstid']],$this->company_roundoff);
				$row[] = round($tot_array['tax'.$item['gstid']],$this->company_roundoff);
				$row[] = round($tot_array['tax'.$item['gstid']],$this->company_roundoff);
				$row[] = round($tot_array['igst'.$item['gstid']],$this->company_roundoff);
			}
			$row[] = round($tot,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	 public function daywise_list() {
        $this->hsn->daywise();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$additional_cess = $ces_amt = $roundoff = $discount =$tot = 0;
		$company = $this->hsn->getCompany();
		$com_state = substr($company['tin'],0,2);
		$tax_total_array = array();
        foreach ($list as $items) {
			$cust_state = $items->custstate;
			if($cust_state == '' ){
				$cust_state  = $com_state;
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->invoice_date;
            $row[] = $items->type;
			foreach($tax_array as $item){
				$txt = 'taxables'.$item['gstid']; 
				$taxtxt = 'taxes'.$item['gstid'];
				$igst = 'tottaxes'.$item['gstid'];
				if($cust_state == $com_state){
					if(isset($tax_total_array['CGST'.$item['gstid']]) ){
						$tax_total_array['TAXABLE'.$item['gstid']] = (float) $tax_total_array['TAXABLE'.$item['gstid']] + (float) $items->$txt;
						$tax_total_array['SGST'.$item['gstid']] = (float) $tax_total_array['SGST'.$item['gstid']] + (float) $items->$taxtxt/2;
						$tax_total_array['CGST'.$item['gstid']] = (float) $tax_total_array['CGST'.$item['gstid']] + (float) $items->$taxtxt/2;
					}else{
						$tax_total_array['SGST'.$item['gstid']] = (float) $items->$taxtxt/2;
						$tax_total_array['CGST'.$item['gstid']] =  (float) $items->$taxtxt/2;
						$tax_total_array['IGST'.$item['gstid']] = 0 ;
						$tax_total_array['TAXABLEIGST'.$item['gstid']] = 0;
						$tax_total_array['TAXABLE'.$item['gstid']] =  (float) $items->$txt;
						
					}
					$row[] = round($items->$txt,$this->company_roundoff);
					$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
					$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
				}else{
					$row[] = round(0,2);
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
				}				
			}
			foreach($tax_array as $item){
				$txt = 'taxables'.$item['gstid']; 
				$taxtxt = 'taxes'.$item['gstid'];
				$igst = 'tottaxes'.$item['gstid'];
				if($cust_state == $com_state){
					if(isset($tax_total_array['CGST'.$item['gstid']]) ){
						$tax_total_array['TAXABLEIGST'.$item['gstid']] = (float) $tax_total_array['TAXABLEIGST'.$item['gstid']] + (float)$items->$txt ;
						$tax_total_array['IGST'.$item['gstid']] = (float) $tax_total_array['IGST'.$item['gstid']] + (float) $items->$taxtxt ;
					}
					$row[] = round(0,2);
					$row[] = number_format(0,2);
				}else{
					$row[] = round($items->$txt,$this->company_roundoff);
					$row[] = number_format($items->$taxtxt,$this->company_roundoff);
				}			
			}
			$additional_cess = (float) $items->additional + (float) $additional_cess;
			$ces_amt = (float) $items->cesamt + (float) $ces_amt;
			$roundoff = (float) $items->rount + (float) $roundoff;
			$discount = (float) $items->salediscount + (float) $discount;
			$tot = (float) $items->saletot + (float) $tot;
			$row[] = $items->additional;
			$row[] = $items->cesamt;
			$row[] = $items->rount;
			$row[] = $items->salediscount;
			$row[] = $items->saletot;
            $data[] = $row;
        }
			$row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = '';
			foreach($tax_array as $item){
				if(isset($tax_total_array['TAXABLE'.$item['gstid']]) ){
					$row[] = number_format($tax_total_array['TAXABLE'.$item['gstid']],$this->company_roundoff);
					$row[] = number_format($tax_total_array['SGST'.$item['gstid']],$this->company_roundoff);
					$row[] = number_format($tax_total_array['SGST'.$item['gstid']],$this->company_roundoff);
				}else{
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
				}
			}
			foreach($tax_array as $item){
				if(isset($tax_total_array['TAXABLEIGST'.$item['gstid']]) ){
					$row[] = number_format($tax_total_array['TAXABLEIGST'.$item['gstid']],$this->company_roundoff);
					$row[] = number_format($tax_total_array['IGST'.$item['gstid']],$this->company_roundoff);
				}else{
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
				}
			}
			$row[] = $additional_cess;
			$row[] = $ces_amt;
			$row[] = $roundoff;
			$row[] = $discount;
			$row[] = $tot;
		 $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	 public function billwise_list() {
        $this->hsn->billwise();
        $list = $this->hsn->get_datatables();
        $data = array();
		$cessamt = 0;
    	$is_cigarette_cess = $this->input->post('is_cigarette_cess');
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$additional_cess = $ces_amt = $roundoff = $discount =$tot = 0;
		$company = $this->hsn->getCompany();
		$com_state = substr($company['tin'],0,2);
		$tax_total_array = array();
		$row = array();
        foreach ($list as $items) {
			$cust_state = $items->custstate;
			$cust_state  = substr($cust_state,0,2);
			if($cust_state == '' ){
				if($items->stateCodes != ''){
					$cust_state  = $items->stateCodes;
				}else{
					$cust_state  = $com_state;
				}
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->in_date;
            $row[] = $this->hsn->get_url($items->sales_id, $items->invoice, 'sales');
            $row[] = $items->type;
            $row[] = $items->customer;
            $row[] = $items->tin;
			foreach($tax_array as $item){
				$txt = 'taxable'.$item['gstid']; 
				$taxtxt = 'tax'.$item['gstid'];
				$igst = 'tottax'.$item['gstid'];
				

				if($cust_state == $com_state){
					if(isset($tax_total_array['CGST'.$item['gstid']]) ){
						if($items->salepub == 'yes'){
							$tax_total_array['TAXABLE'.$item['gstid']] = (float) $tax_total_array['TAXABLE'.$item['gstid']] + (float) $items->$txt;
							$tax_total_array['SGST'.$item['gstid']] = (float) $tax_total_array['SGST'.$item['gstid']] + (float) $items->$taxtxt/2;
							$tax_total_array['CGST'.$item['gstid']] = (float) $tax_total_array['CGST'.$item['gstid']] + (float) $items->$taxtxt/2;
						}
					}else{
						if($items->salepub == 'yes'){
							$tax_total_array['SGST'.$item['gstid']] = (float) $items->$taxtxt/2;
							$tax_total_array['CGST'.$item['gstid']] =  (float) $items->$taxtxt/2;
							$tax_total_array['IGST'.$item['gstid']] = 0 ;
							$tax_total_array['TAXABLEIGST'.$item['gstid']] = 0;
							$tax_total_array['TAXABLE'.$item['gstid']] =  (float) $items->$txt;
						}
						
					}
					if($items->salepub == 'yes'){
						$row[] = round($items->$txt,$this->company_roundoff);
						$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
						$row[] = number_format($items->$taxtxt/2,$this->company_roundoff);
					}else{
						$row[] = round(0,2);
						$row[] = round(0,2);
						$row[] = round(0,2);
					}
				}else{
					$row[] = round(0,2);
					$row[] = number_format(0,2);
					$row[] = number_format(0,2);
				}				
			}
			foreach($tax_array as $item){
				$txt = 'taxable'.$item['gstid']; 
				$taxtxt = 'tax'.$item['gstid'];
				$igst = 'tottax'.$item['gstid'];
				if($cust_state == $com_state){
					
					$row[] = round(0,2);
					$row[] = number_format(0,2);
				}else{
					if(isset($tax_total_array['CGST'.$item['gstid']]) ){
						if($items->salepub == 'yes'){
							$tax_total_array['TAXABLEIGST'.$item['gstid']] = (float) $tax_total_array['TAXABLEIGST'.$item['gstid']] + (float)$items->$txt ;
							$tax_total_array['IGST'.$item['gstid']] = (float) $tax_total_array['IGST'.$item['gstid']] + (float) $items->$taxtxt ;
						}
					}else{
							$tax_total_array['TAXABLEIGST'.$item['gstid']] =  (float)$items->$txt ;
							$tax_total_array['IGST'.$item['gstid']] =  (float) $items->$taxtxt ;
					}
					if($items->salepub == 'yes'){
						$row[] = round($items->$txt,$this->company_roundoff);
						$row[] = number_format($items->$taxtxt,$this->company_roundoff);
					}else{
						$row[] = round(0,2);
						$row[] = number_format(0,2);
					}
				}			
			}
			if($items->salepub == 'yes'){
				$additional_cess = (float) $items->additional_cess + (float) $additional_cess;
				$ces_amt = (float) $items->ces_amt + (float) $ces_amt;
				$roundoff = (float) $items->roundoff + (float) $roundoff;
				$discount = (float) $items->discount + (float) $discount;
				$tot = (float) $items->tot + (float) $tot;
			}
			if($items->salepub == 'yes'){
				if($is_cigarette_cess > 0 ){
					$row[] = round($items->cessamt,$this->company_roundoff);
					$cessamt = (float) $cessamt + (float) $items->cessamt;
        		}
				$row[] = $items->additional_cess;
				$row[] = $items->ces_amt;
				$row[] = $items->roundoff;
				$row[] = $items->discount;
				$row[] = $items->tot;
			}else{
				if($is_cigarette_cess > 0 ){
					$row[] = round(0,2);
				}
				$row[] = round(0,2);
				$row[] = round(0,2);
				$row[] = round(0,2);
				$row[] = round(0,2);
				$row[] = round(0,2);
			}
            $data[] = $row;
        }
		$row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			foreach($tax_array as $item){
				if(isset($tax_total_array['TAXABLE'.$item['gstid']]) ){
					$row[] = number_format($tax_total_array['TAXABLE'.$item['gstid']],$this->company_roundoff);
				}else{
					$row[] = 0;
				}
				if(isset($tax_total_array['SGST'.$item['gstid']] ) ){
					$row[] = number_format($tax_total_array['SGST'.$item['gstid']] ,$this->company_roundoff);
				}else{
					$row[] = 0;
				}
				if(isset($tax_total_array['SGST'.$item['gstid']] ) ){
					$row[] = number_format($tax_total_array['SGST'.$item['gstid']] ,$this->company_roundoff);
				}else{
					$row[] = 0;
				}
			}
			foreach($tax_array as $item){
				if(isset($tax_total_array['TAXABLEIGST'.$item['gstid']]) ) {
					$row[] = number_format($tax_total_array['TAXABLEIGST'.$item['gstid']],$this->company_roundoff);
				}else{
					$row[] = 0;
				}
				if(isset($tax_total_array['IGST'.$item['gstid']]) ) {
					$row[] = number_format($tax_total_array['IGST'.$item['gstid']],$this->company_roundoff);
				}else{
				
					$row[] = 0;
				}
			}
			$row[] = $additional_cess;
			$row[] = $ces_amt;
			if($is_cigarette_cess > 0 ){
				$row[] = $cessamt;
			}
			$row[] = $roundoff;
			$row[] = $discount;
			$row[] = $tot;
		 $data[] = $row;
		 //$data[0] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	
	//  public function billwise_pur_list() {
    //     $this->hsn->billwise_purchase();
    //     $list = $this->hsn->get_datatables();
    //     $data = array();
    //     $no = $this->input->post('start');
	// 	$qry = "select * from taxgst order by gstid asc";
	// 	$tax_array = $this->db->query($qry)->result_array();
	// 	$company = $this->hsn->getCompany();
	// 	$com_state = $company['comset_statecode'];
	// 	$additional_cess = $roundoff = $tot = $discount = 0;
	// 	$tax_total_array = array();
    //     foreach ($list as $items) {
			
	// 	$additional_cess = (float) $additional_cess + (float) $items->additional_cess;
	// 	$roundoff = (float) $roundoff + (float) $items->roundoff;
	// 	$tot = (float) $tot + (float) $items->tot;
	// 	$discount = (float) $discount + (float) $items->discount;
	// 		$cust_state = $items->custstate;
	// 		if($cust_state == '' ){
	// 			$cust_state  = $com_state;
	// 		}else if( (float) $cust_state < 1 ){
	// 			$cust_state  = $com_state;
	// 		}
    //         $no++;
    //         $row = array();
    //         $row[] = $no;
    //         $row[] = $items->in_date;
    //         $row[] = $this->hsn->get_url($items->id, $items->invoice, 'purchase');
    //         $row[] = $items->type;
    //         $row[] = $items->customer;
    //         $row[] = $items->tin;
	// 	foreach($tax_array as $item){
	// 			$txt = 'taxable'.$item['gstid']; 
	// 			$taxtxt = 'tax'.$item['gstid'];
	// 			$igst = 'tottax'.$item['gstid'];
	// 			$pltaxable = 'pltaxable'.$item['gstid']; 
	// 			$pltax = 'pltax'.$item['gstid'];
	// 			$ledger_taxable = (float) $items->$pltaxable;
	// 			if($ledger_taxable == null || $ledger_taxable == '' || $ledger_taxable == 'null'){
	// 				$ledger_taxable = 0;
	// 			}
	// 			$ledger_tax = (float) $items->$pltax;
	// 			if($ledger_tax == null || $ledger_tax == '' || $ledger_tax == 'null'){
	// 				$ledger_tax = 0;
	// 			}
	// 			if($cust_state == $com_state){
	// 				if(isset($tax_total_array['CGST'.$item['gstid']]) ){
	// 						$tax_total_array['TAXABLE'.$item['gstid']] = (float) $tax_total_array['TAXABLE'.$item['gstid']] + (float) $items->$txt;
	// 						$tax_total_array['SGST'.$item['gstid']] = (float) $tax_total_array['SGST'.$item['gstid']] + (float) $items->$taxtxt/2;
	// 						$tax_total_array['CGST'.$item['gstid']] = (float) $tax_total_array['CGST'.$item['gstid']] + (float) $items->$taxtxt/2;
							
	// 						$tax_total_array['TAXABLE'.$item['gstid']] = (float) $tax_total_array['TAXABLE'.$item['gstid']] + (float) $ledger_taxable;
	// 						if((float)$ledger_tax > 0 ){
	// 							$tax_total_array['SGST'.$item['gstid']] = (float) $tax_total_array['SGST'.$item['gstid']] + (float) $ledger_tax/2;
	// 							$tax_total_array['CGST'.$item['gstid']] = (float) $tax_total_array['CGST'.$item['gstid']] + (float) $ledger_tax/2;
	// 						}
	// 				}else{
	// 						$tax_total_array['SGST'.$item['gstid']] = (float) $items->$taxtxt/2;
	// 						$tax_total_array['CGST'.$item['gstid']] =  (float) $items->$taxtxt/2;
	// 						$tax_total_array['IGST'.$item['gstid']] = 0 ;
	// 						$tax_total_array['TAXABLEIGST'.$item['gstid']] = 0;
	// 						$tax_total_array['TAXABLE'.$item['gstid']] =  (float) $items->$txt;
							
	// 						if((float)$ledger_tax > 0 ){
	// 							$tax_total_array['SGST'.$item['gstid']] = (float) $ledger_tax/2;
	// 							$tax_total_array['CGST'.$item['gstid']] =  (float) $ledger_tax/2;
	// 						}
	// 						$tax_total_array['TAXABLE'.$item['gstid']] =  (float) $tax_total_array['TAXABLE'.$item['gstid']] +  (float) $ledger_taxable;
							
						
	// 				}
	// 					$t_taxable = (float) $items->$txt + (float) $ledger_taxable;
	// 					$t_tax = 0;
	// 					if((float) $items->$taxtxt > 0 ){
	// 						$t_tax = (float) $t_tax + (float) $items->$taxtxt/2;
	// 					}
	// 					if((float)$ledger_tax > 0 ){
	// 						$t_tax = (float) $t_tax + (float) $ledger_tax/2;
	// 					}
	// 					$row[] = round($t_taxable,$this->company_roundoff);
	// 					$row[] = number_format($t_tax,$this->company_roundoff);
	// 					$row[] = number_format($t_tax,$this->company_roundoff);
					
	// 			}else{
	// 				$row[] = round(0,2);
	// 				$row[] = number_format(0,2);
	// 				$row[] = number_format(0,2);
	// 			}				
	// 		}
	// 		foreach($tax_array as $item){
	// 			$txt = 'taxable'.$item['gstid']; 
	// 			$taxtxt = 'tax'.$item['gstid'];
	// 			$igst = 'tottax'.$item['gstid'];
	// 			$pltaxable = 'pltaxable'.$item['gstid']; 
	// 			$pltax = 'pltax'.$item['gstid'];
	// 			$ledger_taxable = (float) $items->$pltaxable;
	// 			if($ledger_taxable == null || $ledger_taxable == '' || $ledger_taxable == 'null'){
	// 				$ledger_taxable = 0;
	// 			}
	// 			$ledger_tax = (float) $items->$pltax;
	// 			if($ledger_tax == null || $ledger_tax == '' || $ledger_tax == 'null'){
	// 				$ledger_tax = 0;
	// 			}
	// 			if($cust_state == $com_state){
					
	// 				$row[] = round(0,2);
	// 				$row[] = number_format(0,2);
	// 			}else{
	// 				if(isset($tax_total_array['CGST'.$item['gstid']]) ){
	// 						$tax_total_array['TAXABLEIGST'.$item['gstid']] = (float) $tax_total_array['TAXABLEIGST'.$item['gstid']] + (float)$items->$txt ;
	// 						$tax_total_array['IGST'.$item['gstid']] = (float) $tax_total_array['IGST'.$item['gstid']] + (float) $items->$taxtxt ;
							
	// 						$tax_total_array['TAXABLEIGST'.$item['gstid']] = (float) $tax_total_array['TAXABLEIGST'.$item['gstid']] + (float)$ledger_taxable ;
	// 						$tax_total_array['IGST'.$item['gstid']] = (float) $tax_total_array['IGST'.$item['gstid']] + (float) $ledger_tax ;
	// 				}else{
	// 						$tax_total_array['TAXABLEIGST'.$item['gstid']] =  (float)$items->$txt ;
	// 						$tax_total_array['IGST'.$item['gstid']] =  (float) $items->$taxtxt ;
							
	// 						$tax_total_array['TAXABLEIGST'.$item['gstid']] =  (float)$ledger_taxable ;
	// 						$tax_total_array['IGST'.$item['gstid']] =  (float) $ledger_tax ;
	// 				}
	// 					$row[] = round((float)$items->$txt + (float)$ledger_taxable,$this->company_roundoff);
	// 					$row[] = number_format((float)$items->$taxtxt + (float) $ledger_tax ,$this->company_roundoff);
					
	// 			}			
	// 		}
	// 		$row[] = $items->additional_cess;
	// 		$row[] = $items->roundoff;
	// 		$row[] = $items->discount;
	// 		$row[] = $items->tot;
    //         $data[] = $row;
    //     }
	// 	$row = array();
    //         $row[] = '';
    //         $row[] = '';
    //         $row[] = '';
    //         $row[] = '';
    //         $row[] = '';
    //         $row[] = '';
	// 			foreach($tax_array as $item){
	// 			if(isset($tax_total_array['TAXABLE'.$item['gstid']]) ){
	// 				$row[] = number_format($tax_total_array['TAXABLE'.$item['gstid']],$this->company_roundoff);
	// 			}else{
	// 				$row[] = 0;
	// 			}
	// 			if(isset($tax_total_array['SGST'.$item['gstid']] ) ){
	// 				$row[] = number_format($tax_total_array['SGST'.$item['gstid']] ,$this->company_roundoff);
	// 			}else{
	// 				$row[] = 0;
	// 			}
	// 			if(isset($tax_total_array['SGST'.$item['gstid']] ) ){
	// 				$row[] = number_format($tax_total_array['SGST'.$item['gstid']] ,$this->company_roundoff);
	// 			}else{
	// 				$row[] = 0;
	// 			}
	// 		}
	// 		foreach($tax_array as $item){
	// 			if(isset($tax_total_array['TAXABLEIGST'.$item['gstid']]) ) {
	// 				$row[] = number_format($tax_total_array['TAXABLEIGST'.$item['gstid']],$this->company_roundoff);
	// 			}else{
	// 				$row[] = 0;
	// 			}
	// 			if(isset($tax_total_array['IGST'.$item['gstid']]) ) {
	// 				$row[] = number_format($tax_total_array['IGST'.$item['gstid']],$this->company_roundoff);
	// 			}else{
				
	// 				$row[] = 0;
	// 			}
	// 		}
	// 		$row[] = $additional_cess;
	// 		$row[] = $roundoff;
	// 		$row[] = $discount;
	// 		$row[] = $tot;
    //         $data[] = $row;
    //     $output = array(
    //         "draw" => $this->input->post('draw'),
    //         "recordsTotal" => $this->hsn->count_all(),
    //         "recordsFiltered" => $this->hsn->count_filtered(),
    //         "data" => $data,
    //     );
    //     echo json_encode($output);
    // }
	
// 	public function billwise_pur_list() {
//     $this->hsn->billwise_purchase();
//     $list = $this->hsn->get_datatables();
//     $data = array();
//     $no = $this->input->post('start');
//     $qry = "select * from taxgst order by gstid asc";
//     $tax_array = $this->db->query($qry)->result_array();
//     $company = $this->hsn->getCompany();
//     $com_state = $company['comset_statecode'];
//     $additional_cess = $roundoff = $tot = $discount = 0;
    
//     // Initialize tax total array with all possible keys
//     $tax_total_array = array();
//     foreach($tax_array as $item) {
//         $tax_total_array['TAXABLE'.$item['gstid']] = 0;
//         $tax_total_array['SGST'.$item['gstid']] = 0;
//         $tax_total_array['CGST'.$item['gstid']] = 0;
//         $tax_total_array['IGST'.$item['gstid']] = 0;
//         $tax_total_array['TAXABLEIGST'.$item['gstid']] = 0;
//     }

//     foreach ($list as $items) {
//         $additional_cess = (float) $additional_cess + (float) $items->additional_cess;
//         $roundoff = (float) $roundoff + (float) $items->roundoff;
//         $tot = (float) $tot + (float) $items->tot;
//         $discount = (float) $discount + (float) $items->discount;
        
//         $cust_state = $items->custstate;
//         if($cust_state == '' || (float) $cust_state < 1) {
//             $cust_state = $com_state;
//         }

//         $no++;
//         $row = array();
//         $row[] = $no;
//         $row[] = $items->in_date;
//         $row[] = $this->hsn->get_url($items->id, $items->invoice, 'purchase');
//         $row[] = $items->type;
//         $row[] = $items->customer;
//         $row[] = $items->tin;

//         foreach($tax_array as $item) {
//             $txt = 'taxable'.$item['gstid']; 
//             $taxtxt = 'tax'.$item['gstid'];
//             $pltaxable = 'pltaxable'.$item['gstid']; 
//             $pltax = 'pltax'.$item['gstid'];
            
//             $ledger_taxable = (float) ($items->$pltaxable ?? 0);
//             $ledger_tax = (float) ($items->$pltax ?? 0);
//             $invoice_taxable = (float) ($items->$txt ?? 0);
//             $invoice_tax = (float) ($items->$taxtxt ?? 0);
            
//             $total_taxable = $invoice_taxable + $ledger_taxable;
//             $total_tax = $invoice_tax + $ledger_tax;

//             if($cust_state == $com_state) {
//                 // Intra-state transaction - CGST+SGST
//                 $tax_total_array['TAXABLE'.$item['gstid']] += $total_taxable;
//                 $tax_total_array['SGST'.$item['gstid']] += $total_tax / 2;
//                 $tax_total_array['CGST'.$item['gstid']] += $total_tax / 2;
                
//                 $row[] = round($total_taxable, $this->company_roundoff);
//                 $row[] = number_format($total_tax / 2, $this->company_roundoff);
//                 $row[] = number_format($total_tax / 2, $this->company_roundoff);
//                 $row[] = round(0, 2); // IGST taxable
//                 $row[] = number_format(0, 2); // IGST
//             } else {
//                 // Inter-state transaction - IGST
//                 $tax_total_array['TAXABLEIGST'.$item['gstid']] += $total_taxable;
//                 $tax_total_array['IGST'.$item['gstid']] += $total_tax;
                
//                 $row[] = round(0, 2); // CGST/SGST taxable
//                 $row[] = number_format(0, 2); // SGST
//                 $row[] = number_format(0, 2); // CGST
//                 $row[] = round($total_taxable, $this->company_roundoff);
//                 $row[] = number_format($total_tax, $this->company_roundoff);
//             }
//         }

//         $row[] = $items->additional_cess;
//         $row[] = $items->roundoff;
//         $row[] = $items->discount;
//         $row[] = $items->tot;
//         $data[] = $row;
//     }

//     // Add totals row
//     $row = array();
//     $row[] = '';
//     $row[] = '';
//     $row[] = '';
//     $row[] = '';
//     $row[] = '';
//     $row[] = '';

//     foreach($tax_array as $item) {
//         $row[] = number_format($tax_total_array['TAXABLE'.$item['gstid']], $this->company_roundoff);
//         $row[] = number_format($tax_total_array['SGST'.$item['gstid']], $this->company_roundoff);
//         $row[] = number_format($tax_total_array['CGST'.$item['gstid']], $this->company_roundoff);
//         $row[] = number_format($tax_total_array['TAXABLEIGST'.$item['gstid']], $this->company_roundoff);
//         $row[] = number_format($tax_total_array['IGST'.$item['gstid']], $this->company_roundoff);
//     }

//     $row[] = $additional_cess;
//     $row[] = $roundoff;
//     $row[] = $discount;
//     $row[] = $tot;
//     $data[] = $row;

//     $output = array(
//         "draw" => $this->input->post('draw'),
//         "recordsTotal" => $this->hsn->count_all(),
//         "recordsFiltered" => $this->hsn->count_filtered(),
//         "data" => $data,
//     );
//     echo json_encode($output);
// }


	public function billwise_pur_list() {
    $this->hsn->billwise_purchase();
    $list = $this->hsn->get_datatables();
    $data = array();
    $no = $this->input->post('start');
    $qry = "select * from taxgst order by gstid asc";
    $tax_array = $this->db->query($qry)->result_array();
    $company = $this->hsn->getCompany();
	$cessamt = 0;
    $com_state = $company['comset_statecode'];
    $additional_cess = $roundoff = $tot = $discount = 0;
     $is_cigarette_cess = $this->input->post('is_cigarette_cess');
    // Initialize tax total array with all possible keys
    $tax_total_array = array();
    foreach($tax_array as $item) {
        $tax_total_array['TAXABLE'.$item['gstid']] = 0;
        $tax_total_array['SGST'.$item['gstid']] = 0;
        $tax_total_array['CGST'.$item['gstid']] = 0;
        $tax_total_array['IGST'.$item['gstid']] = 0;
        $tax_total_array['TAXABLEIGST'.$item['gstid']] = 0;
    }

    foreach ($list as $items) {
        $additional_cess += (float)$items->additional_cess;
        $roundoff += (float)$items->roundoff;
        $tot += (float)$items->tot;
        $discount += (float)$items->discount;
        
        $cust_state = $items->custstate;
        if(empty($cust_state) || (float)$cust_state < 1) {
            $cust_state = $com_state;
        }

        $no++;
        $row = array();
        $row[] = $no;
        $row[] = $items->in_date;
        $row[] = $this->hsn->get_url($items->id, $items->invoice, 'purchase');
        $row[] = $items->type;
        $row[] = $items->customer;
        $row[] = $items->tin;

        // First process all CGST/SGST columns
        foreach($tax_array as $item) {
            $txt = 'taxable'.$item['gstid']; 
            $taxtxt = 'tax'.$item['gstid'];
            $pltaxable = 'pltaxable'.$item['gstid']; 
            $pltax = 'pltax'.$item['gstid'];
            
            $ledger_taxable = (float)($items->$pltaxable ?? 0);
            $ledger_tax = (float)($items->$pltax ?? 0);
            $invoice_taxable = (float)($items->$txt ?? 0);
            $invoice_tax = (float)($items->$taxtxt ?? 0);
            
            $total_taxable = $invoice_taxable + $ledger_taxable;
            $total_tax = $invoice_tax + $ledger_tax;

            if($cust_state == $com_state) {
                // Intra-state - show values
                $tax_total_array['TAXABLE'.$item['gstid']] += $total_taxable;
                $tax_total_array['SGST'.$item['gstid']] += $total_tax / 2;
                $tax_total_array['CGST'.$item['gstid']] += $total_tax / 2;
                
                $row[] = round($total_taxable, $this->company_roundoff);
                $row[] = number_format($total_tax / 2, $this->company_roundoff);
                $row[] = number_format($total_tax / 2, $this->company_roundoff);
            } else {
                // Inter-state - show zeros
                $row[] = round(0, $this->company_roundoff);
                $row[] = number_format(0, $this->company_roundoff);
                $row[] = number_format(0, $this->company_roundoff);
            }
        }

        // Then process all IGST columns
        foreach($tax_array as $item) {
            $txt = 'taxable'.$item['gstid']; 
            $taxtxt = 'tax'.$item['gstid'];
            $pltaxable = 'pltaxable'.$item['gstid']; 
            $pltax = 'pltax'.$item['gstid'];
            
            $ledger_taxable = (float)($items->$pltaxable ?? 0);
            $ledger_tax = (float)($items->$pltax ?? 0);
            $invoice_taxable = (float)($items->$txt ?? 0);
            $invoice_tax = (float)($items->$taxtxt ?? 0);
            
            $total_taxable = $invoice_taxable + $ledger_taxable;
            $total_tax = $invoice_tax + $ledger_tax;

            if($cust_state == $com_state) {
                // Intra-state - show zeros
                $row[] = round(0, $this->company_roundoff);
                $row[] = number_format(0, $this->company_roundoff);
            } else {
                // Inter-state - show values
                $tax_total_array['TAXABLEIGST'.$item['gstid']] += $total_taxable;
                $tax_total_array['IGST'.$item['gstid']] += $total_tax;
                
                $row[] = round($total_taxable, $this->company_roundoff);
                $row[] = number_format($total_tax, $this->company_roundoff);
            }
        }

        $row[] = $items->additional_cess;
		 if($is_cigarette_cess > 0 ){
            $row[] = round($items->cessamt,$this->company_roundoff);
            $cessamt = (float) $cessamt + (float) $items->cessamt;
        }
        $row[] = $items->roundoff;
        $row[] = $items->discount;
        $row[] = $items->tot;
        $data[] = $row;
    }

    // Add totals row
    $row = array();
    $row[] = '';
    $row[] = '';
    $row[] = '';
    $row[] = '';
    $row[] = '';
    $row[] = '';

    // First add CGST/SGST totals
    foreach($tax_array as $item) {
        $row[] = number_format($tax_total_array['TAXABLE'.$item['gstid']], $this->company_roundoff);
        $row[] = number_format($tax_total_array['SGST'.$item['gstid']], $this->company_roundoff);
        $row[] = number_format($tax_total_array['CGST'.$item['gstid']], $this->company_roundoff);
    }

    // Then add IGST totals
    foreach($tax_array as $item) {
        $row[] = number_format($tax_total_array['TAXABLEIGST'.$item['gstid']], $this->company_roundoff);
        $row[] = number_format($tax_total_array['IGST'.$item['gstid']], $this->company_roundoff);
    }

    $row[] = $additional_cess;
	if($is_cigarette_cess > 0 ){
		$row[]  = $cessamt;    
    }
    $row[] = $roundoff;
    $row[] = $discount;
    $row[] = $tot;
    $data[] = $row;

    $output = array(
        "draw" => $this->input->post('draw'),
        "recordsTotal" => $this->hsn->count_all(),
        "recordsFiltered" => $this->hsn->count_filtered(),
        "data" => $data,
    );
    echo json_encode($output);
}
	 public function eway_list() {
        $this->hsn->eway();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->invoice_date;
            $row[] = $items->name;
            $row[] = $items->tin;
            $row[] = $items->type;
            $row[] = $items->invoice;
			$row[] = $items->total;
			$row[] = $items->ewb_no;
			$row[] = $items->ewb_details;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function item_list() {
        $this->hsn->hsn();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$quantity = $total = $before = $sgst = $cess = 0;
        foreach ($list as $items) {
			$quantity = (float) $quantity + (float) $items->quantity;
			$total = (float) $total + (float) $items->total;
			$before = (float) $before + (float) ($items->total - $items->tax);
			$sgst = (float) $sgst + (float) $items->sgst;
			$cess = (float) $cess + (float) $items->cess;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsncode;
            $row[] = $items->name;
            $row[] = $items->itemtype;
            $row[] = $items->code;
			$row[] = $items->quantity;
			$row[] = $items->total;
            $row[] = round($items->total - $items->tax,$this->company_roundoff);
            $row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = $items->cess;
			$row[] = $items->total;
            $data[] = $row;
        }
			$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($quantity,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $row[] = round($before,$this->company_roundoff);
            $row[] = round($sgst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($cess,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function purchase_hsn_list(){
		$this->hsn->purchasehsn();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$quantity = $total = $before = $sgst = $cess = 0;
        foreach ($list as $items) {
			$quantity = (float) $quantity + (float) $items->quantity;
			$total = (float) $total + (float) $items->total;
			$before = (float) $before + (float) ($items->total - $items->tax);
			$sgst = (float) $sgst + (float) $items->sgst;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsncode;
            $row[] = $items->name;
            $row[] = $items->itemtype;
            $row[] = $items->code;
			$row[] = $items->quantity;
			$row[] = $items->total;
            $row[] = round($items->total - $items->tax,$this->company_roundoff);
            $row[] = $items->GSTRATE;
            $row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = $items->total;
            $data[] = $row;
        }
			$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($quantity,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $row[] = round($before,$this->company_roundoff);
            $row[] = '';
            $row[] = round($sgst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}
	

	public function sales_export_list() {
        $this->hsn->salesexport();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$quantity = $total = $before = $sgst = $cess = $igst = 0;
        foreach ($list as $items) {
			$quantity = (float) $quantity + (float) $items->quantity;
			$total = (float) $total + (float) $items->total;
			$before = (float) $before + (float) ($items->total - $items->tax);
			$sgst = (float) $sgst + (float) $items->sgst;
			$igst = (float) $igst + (float) $items->igst;
			$cess = (float) $cess + (float) $items->cess;
			$txt = '';
			if((float) $items->igst > 0  ){
				$txt = 'INTERSTATE ';
			}
            $no++;
            $row = array();
            $row[] = $no;
			$row[] = $items->invoice;
            $row[] = $items->invoice_date;
            $row[] = $items->btype;
			$row[] = $items->supname;
            $row[] = $items->suptin;
            $row[] = $items->name;
            $row[] = $items->hsncode;
            $row[] = $txt.' Sales @'.$items->GSTRATE.' %';
			$row[] = $items->quantity;
			$row[] = $items->rate;
            $row[] = round($items->amount,$this->company_roundoff);
            $row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->igst,$this->company_roundoff);
			$row[] = $items->cess;
			$row[] = $items->total;
            $data[] = $row;
        }
			$row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = '';
			$row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($quantity,$this->company_roundoff);
			$row[] = '';
            $row[] = '';
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($igst,$this->company_roundoff);
			$row[] = round($cess,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	public function sales_hsn_list() {
        $this->hsn->saleshsn();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$quantity = $total = $before = $sgst = $cess = $igst = 0;
        foreach ($list as $items) {
			$quantity = (float) $quantity + (float) $items->quantity;
			$total = (float) $total + (float) $items->total;
			$before = (float) $before + (float) ($items->total - $items->tax);
			$sgst = (float) $sgst + (float) $items->sgst;
			$igst = (float) $igst + (float) $items->igst;
			$cess = (float) $cess + (float) $items->cess;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsncode;
            $row[] = $items->name;
            $row[] = $items->itemtype;
            $row[] = $items->code;
			$row[] = $items->quantity;
			$row[] = $items->total;
            $row[] = round($items->total - $items->tax,$this->company_roundoff);
            $row[] = $items->GSTRATE;
            $row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->igst,$this->company_roundoff);
			$row[] = $items->cess;
			$row[] = $items->total;
            $data[] = $row;
        }
			$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($quantity,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $row[] = round($before,$this->company_roundoff);
            $row[] = '';
            $row[] = round($sgst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($igst,$this->company_roundoff);
			$row[] = round($cess,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
		public function sales_hsn_consoidate_list() {
        $this->hsn->saleshsn_consoidate();
        $list = $this->hsn->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$qry = "select * from taxgst order by gstid asc";
		$tax_array = $this->db->query($qry)->result_array();
		$quantity = $total = $before = $sgst = $cess = $igst = 0;
        foreach ($list as $items) {
			$quantity = (float) $quantity + (float) $items->quantity;
			$total = (float) $total + (float) $items->total;
			$before = (float) $before + (float) ($items->total - $items->tax);
			$sgst = (float) $sgst + (float) $items->sgst;
			$igst = (float) $igst + (float) $items->igst;
			$cess = (float) $cess + (float) $items->cess;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->hsncode;
            $row[] = '';
            $row[] = $items->code;
			$row[] = $items->quantity;
			$row[] = $items->total;
            $row[] = round($items->beforetax,$this->company_roundoff);
			$row[] = round($items->igst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = round($items->sgst,$this->company_roundoff);
			$row[] = $items->cess;
			$row[] = $items->GSTRATE;
            
            $data[] = $row;
        }
			$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = '';
			$row[] = round($quantity,$this->company_roundoff);
			$row[] = round($total,$this->company_roundoff);
            $row[] = round($before,$this->company_roundoff);
            $row[] = round($igst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($sgst,$this->company_roundoff);
			$row[] = round($cess,$this->company_roundoff);
            $row[] = '';
           // $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->hsn->count_all(),
            "recordsFiltered" => $this->hsn->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
