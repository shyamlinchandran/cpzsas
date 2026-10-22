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
class Item extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/itemreport_model', 'itemereport');
    }

    
    function pitemereport($saletype='purchase') {
		$data['saletype'] = $saletype;
		$data['title'] = 'Item Wise Purchase Register';
		if($saletype == 'purchase_return'){
			$data['title'] = 'Item Wise PR Register';
		}
        $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemereport/pitemereport', $data);
    }

      public function pajax_list() {
        $this->itemereport->wherep();
        $list = $this->itemereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal=0;
        $totaltax=0;
        $totalroundoff=0;
        $taxablevalue=0;
		$quantity = $free_quantity = 0 ;
        $gst=0;
		$total = 0 ;
        $name=$hsn=$unit='';
        foreach ($list as $vouchers) {
             $quantity  =(float) $quantity  +(float)$vouchers->quantity;
             $free_quantity  =(float) $free_quantity  +(float)$vouchers->free_quantity;
            $sgst=0;
             $total  =(float) $total  +(float)$vouchers->total;
            if($vouchers->tax>0){
              $sgst=$vouchers->tax/2;
              $gst=$gst+$sgst;
			  }
           $taxablevalue=$taxablevalue+$vouchers->bef;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->hsn;
            $row[] = $vouchers->item;
            $row[] = $vouchers->unit;
            $row[] = $vouchers->avg;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->free_quantity;
            $row[] = $vouchers->gst;
            $row[] = $vouchers->bef;
            $row[] = $sgst;
            $row[] = $sgst;
            $row[] = $vouchers->total;
            $row[] = '';
            
            $data[] = $row;
        }
          $row = array();
            $row[] = $no;
            $row[] = '';
            $row[] ='';
            $row[] ='';
            $row[] ='';
            $row[] = $quantity;
            $row[] = $free_quantity;
            $row[] = '';
            $row[] = $this->number_fm($taxablevalue);
            $row[] = $this->number_fm($gst);
            $row[] = $this->number_fm($gst);
            $row[] = $total;
            $row[] = '';
            
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemereport->count_all()+1,
            "recordsFiltered" => $this->itemereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
    
    
    function itemereport($saletype='sales') {
		$data['saletype'] = $saletype;
		$data['title'] = 'Item Wise Sales Register';
		if($saletype == 'sales_return'){
			$data['title'] = 'Item Wise SR Register';
		}
        $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemereport/itemereport', $data);
    }
	
	public function list_item(){
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/list_item');
	}
     function invoicereport() {
        $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemereport/itemereport', $data);
    }
  function stocklevel() {
        $data['title'] = 'Stock level report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemereport/stocklevelreport', $data);
    }
   


    public function stocklevel_list() {
        $this->itemereport->stocklevel();
        $list = $this->itemereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->item;
            $row[] = $vouchers->catname;
            $row[] = $vouchers->ibr_name;
            $row[] = $vouchers->unit;
            $row[] = $vouchers->max_level; 
            $row[] = $vouchers->min_level; 
            $row[] = $vouchers->reorder_point; 
            $row[] = $vouchers->stock; 
            $data[] = $row;
        }
       
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemereport->count_all()+1,
            "recordsFiltered" => $this->itemereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


	public function item_list() {
        $this->itemereport->item_list_where();
        $this->itemereport->get_item_list();
        $list = $this->itemereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->hsncode;
            $row[] = $vouchers->part_no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->unitname;
            $row[] = $vouchers->itemtax;
            $row[] = $vouchers->ces_name;
            $row[] = $vouchers->discount;
            $row[] = $vouchers->catname;
            $row[] = $vouchers->ibr_name;
            $row[] = $vouchers->supname;
            $row[] = $vouchers->prate;
            $row[] = $vouchers->srate;
            if($vouchers->prate > 0 ){
                $txt = (float)  $vouchers->srate - (float) $vouchers->prate ;
                $txtper =  round((($vouchers->srate - $vouchers->prate) / $vouchers->prate) * 100,2);
                $row[] = $txt.'('.$txtper.'%)';
            }else{
                $row[] = "";
            }
            $row[] = $vouchers->MRP;
            $row[] = $vouchers->special_rate;
			
			$row[] = $vouchers->wh_rate;
            $row[] = $vouchers->landing_cost;
            $row[] = $vouchers->mty_name;
            $row[] = $vouchers->stk;
            
            $data[] = $row;
        }
          
            
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemereport->count_all()+1,
            "recordsFiltered" => $this->itemereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
	
	

	public function ajax_list() {
        $this->itemereport->where();
        $list = $this->itemereport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal=0;
        $totaltax=0;
        $totalroundoff=0;
        $taxablevalue=0;
        $gst=0;
		$total = 0 ;
        $name=$hsn=$unit='';
        foreach ($list as $vouchers) {
            $sgst=0;
             $total  =(float) $total  +(float)$vouchers->total;
            if($vouchers->tax>0){
              $sgst=$vouchers->tax/2;
              $gst=$gst+$sgst;
            }
           $taxablevalue=$taxablevalue+$vouchers->bef;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->hsn;
            $row[] = $vouchers->item;
            $row[] = $vouchers->unit;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->free_quantity;
            $row[] = $vouchers->gst;
            $row[] = $vouchers->bef;
            $row[] = $sgst;
            $row[] = $sgst;
            $row[] = $vouchers->total;
            $row[] = '';
            
            $data[] = $row;
        }
          $row = array();
            $row[] = $no;
            $row[] = '';
            $row[] ='';
            $row[] ='';
            $row[] ='';
            $row[] = '';
            $row[] = '';
            $row[] = $this->number_fm($taxablevalue);
            $row[] = $this->number_fm($gst);
            $row[] = $this->number_fm($gst);
            $row[] = $total;
            $row[] = '';
            
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemereport->count_all()+1,
            "recordsFiltered" => $this->itemereport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
}
