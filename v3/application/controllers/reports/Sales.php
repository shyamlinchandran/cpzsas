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
class Sales extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/salereport_model', 'salereports');
    }
	
	function get_consoled(){
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$btype = $this->input->post('btype');
		return $this->salereports->get_consoled($startdate, $enddate,$btype);
	}
	
	function sales_freequantity(){
		$data['saletype'] = 'sales';
		$data['title'] = 'Sales Free Quantity Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/freequantity',$data);
	}
	
	function gstreport(){
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/gstreport');
	}
	
	function customersales(){
		$data['title'] = 'Route Summary Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/customersales',$data);
	}
	
	 public function freequantity_list() {
        $this->salereports->freequantity_list();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $discount = $total =  $cash = $credit = $rec_amount = $bal = 0;
        foreach ($list as $vouchers) {
			$no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->salereports->get_url($vouchers->sales_id, $vouchers->invoice, $vouchers->type);
            $row[] = $vouchers->customer;
            $row[] = $vouchers->name;
            $row[] = $vouchers->barcode;
			$row[] = $vouchers->base_free_quantity;
            $data[] = $row;
        }$no++;
			
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	
    public function get_customersalesreport() {
        $this->salereports->customersalesreport();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $discount = $total =  $cash = $credit = $rec_amount = $bal = 0;
        foreach ($list as $vouchers) {
			$discount = (float) $discount + (float) $vouchers->discount;
			$total = (float) $total + (float) $vouchers->total;
			$cash = (float) $cash + (float) $vouchers->cash;
			$credit = (float) $credit + (float) $vouchers->credit;
			$rec_amount = (float) $rec_amount + (float) $vouchers->rec_amount;
			$bal = (float) $bal + (float) $vouchers->bal;
			$no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = ' <a  onclick="showledger('.$vouchers->supledgerid.','."'".$vouchers->name."'".')">'.$vouchers->name.'</a>';
			
            $row[] = $vouchers->discount;
            $row[] = $vouchers->total;
            $row[] = $vouchers->cash;
			$row[] = $vouchers->credit;
            $row[] = $vouchers->rec_amount;
			$row[] = (float) $vouchers->bal ;
            $data[] = $row;
        }$no++;
			$row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = '';
			
            $row[] = $discount;
            $row[] = $total;
            $row[] = $cash;
			$row[] = $credit;
            $row[] = $rec_amount;
			$row[] = (float) $bal ;
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function type() {
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/typereport', $data);
    }
	
	function sales_summary() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/sales_summary');
    }

    function category() {
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/categoryreport', $data);
    }

    function salesreport($typ ='') {
        $settings = $this->salereports->getCompanySettings();
        $data['settings'] = $settings;
        $data['saletype'] = 'sales';
        $data['typ'] = $typ;
        $data['title'] = 'Sales Report';
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salesreport', $data);
		}

    function salerefreport() {
        $settings = $this->salereports->getCompanySettings();
        $data['settings'] = $settings;
        $data['saletype'] = 'sales';
        $data['title'] = 'Sales Report';
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salerefreport', $data);
    }

    function saleorder() {
        $settings = $this->salereports->getCompanySettings();
        $data['settings'] = $settings;
        $data['saletype'] = 'estimate';
        $data['title'] = 'Sales Order Report';
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salerefreport', $data);
    }

    function salesreturn() {
        $settings = $this->salereports->getCompanySettings();
        $data['settings'] = $settings;
        $data['saletype'] = 'sales_return';
        $data['title'] = 'Sales Return Report';
        $data['types'] = $this->salereports->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/salerefreport', $data);
    }

    public function category_list() {
        $this->salereports->wherecategory();
        $list = $this->salereports->get_datatables();
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
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function get_taxreport(){
		$this->salereports->sales_gst_report();
        $list = $this->salereports->get_datatables();
		$data = array();
        $no = $this->input->post('start');
        $gbedtax = 0;
		$discount = 0;
		$beforetax = 0;
		$tax = 0;
		$total = 0;
		$sgst = 0 ;
        foreach ($list as $vouchers) {
			$gbedtax  = (float) $gbedtax  + (float) $vouchers->gbedtax;
			$discount  = (float) $discount  + (float) $vouchers->discount;
			$beforetax  = (float) $beforetax  + (float) $vouchers->beforetax;
			$tax  = (float) $tax  + (float) $vouchers->tax;
			$total  = (float) $total  + (float) $vouchers->total;
			$sgst  = (float) $sgst  + (float) $vouchers->sgst;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->GST;
            $row[] = $vouchers->gbedtax;
            $row[] = $vouchers->discount;
			$row[] = $vouchers->beforetax;
            $row[] = $vouchers->tax;
            $row[] = $vouchers->sgst;
            $row[] = $vouchers->sgst;
            $row[] = $vouchers->total;
            $data[] = $row;
        }
		$row = array();
            $row[] = '';
            $row[] = '';
            $row[] = round($gbedtax,$this->company_roundoff);
            $row[] = round($discount,$this->company_roundoff);
			$row[] = round($beforetax,$this->company_roundoff);
            $row[] = round($tax,$this->company_roundoff);
            $row[] = round($sgst);
            $row[] = round($sgst);
            $row[] = round($total);
            $data[] = $row;
       
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function get_summary(){
		$this->salereports->sales_summary_report();
        $list = $this->salereports->get_datatables();
		$data = array();
        $no = $this->input->post('start');
        $totalsales = 0;
		$salesadjust = 0;
		$creditamount = 0;
		$totalbank_amount = 0;
		$totalcash_amount = 0;
		$totalsalesreturn = 0;
		$collected = 0;
        foreach ($list as $vouchers) {
			$totalsales  = (float) $totalsales  + (float) $vouchers->totalsales;
			$salesadjust  = (float) $salesadjust  + (float) $vouchers->salesadjust;
			$creditamount  = (float) $creditamount  + (float) $vouchers->creditamount;
			$totalbank_amount  = (float) $totalbank_amount  + (float) $vouchers->totalbank_amount;
			$totalcash_amount  = (float) $totalcash_amount  + (float) $vouchers->totalcash_amount;
			$totalsalesreturn  = (float) $totalsalesreturn  + (float) $vouchers->totalsalesreturn;
			$col_amt = (float) $vouchers->totalcash_amount;
			$collected = $collected + $col_amt;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->totalsales;
            $row[] = $vouchers->salesadjust;
			$row[] = $vouchers->creditamount;
            $row[] = $vouchers->totalbank_amount;
            $row[] = $vouchers->totalcash_amount;
            $row[] = $vouchers->totalsalesreturn;
            $row[] = $vouchers->totalcash_amount- $vouchers->totalsalesreturn;
            $data[] = $row;
        }
		 $no++;
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
            $data[] = $row;
		 $no++;
            $row = array();
            $row[] = '';
            $row[] = 'Total Amounts';
            $row[] = $totalsales;
            $row[] = $salesadjust;
			$row[] = $creditamount;
            $row[] = $totalbank_amount;
            $row[] = $totalcash_amount;
            $row[] = $totalsalesreturn;
            $row[] =0;
            $data[] = $row;
       
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function ajax_list() {
        $this->salereports->where();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = $distotal = 0;
        foreach ($list as $vouchers) {
            $no++;
            $total = $total + $vouchers->tot;
            $distotal = $distotal + $vouchers->disamt;
            $row = array();
            $row[] = $no;
            $row[] = $this->salereports->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->name;
            $row[] = round($vouchers->dis,$this->company_roundoff);
            $row[] = round($vouchers->disamt,$this->company_roundoff);
            $row[] = round($vouchers->tot,$this->company_roundoff);
            $data[] = $row;
        }$no++;
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total';
        $row[] = $this->number_fm($distotal);
        $row[] = $this->number_fm($total);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_salesreport() {
        $this->salereports->wherecondition();
        $list = $this->salereports->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $totalroundoff = 0;
		$total_dis = 0;
		$before_tax = 0 ;
        foreach ($list as $vouchers) {
            $ctype = $vouchers->cash_type;
            if ($ctype == 'COB') {
                $ctype = 'Cash/Bank';
            } else if ($ctype == 'Ba_Ca_Cr') {
                $ctype = 'Bank/Cash/Credit';
            } else if ($ctype == 'Ca_Cr') {
                $ctype = 'Cash/Credit';
            } else if ($ctype == 'Ba_Cr') {
                $ctype = 'Bank/Credit';
            }

            $no++;
			$amt = $vouchers->total-$vouchers->tax+$vouchers->roundoff+$vouchers->discount;
			$before_tax = (float) $before_tax + (float) $amt;
			$total_dis = $total_dis + $vouchers->discount;
            $grandtotal = $grandtotal + $vouchers->total;
            $totaltax = $totaltax + $vouchers->tax;
            $totalroundoff = $totalroundoff + $vouchers->roundoff;
            $row = array();
            $row[] = $no;
            $row[] = $this->salereports->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->cusnames;
            $row[] = $vouchers->tin;
            $row[] = $ctype;
            if( $vouchers->ref != '' &&  $vouchers->ref != 'null'){
                $row[] = $vouchers->ref;
            }else{
                $row[] = $vouchers->ref_no;
            }
            $row[] = $vouchers->createduser;
            $row[] = $vouchers->user_name;
            $row[] = round($vouchers->total-$vouchers->tax+$vouchers->roundoff+$vouchers->discount,$this->company_roundoff);
            $row[] = $vouchers->tax;
            $row[] = $vouchers->discount;
            $row[] = $vouchers->roundoff;
            $row[] = $vouchers->total;

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
		$row[] = 'Total';
        $row[] = $this->number_fm($before_tax);
        $row[] = $this->number_fm($totaltax);
		$row[] = $this->number_fm($total_dis);
        $row[] = $this->number_fm($totalroundoff);
        $row[] = $this->number_fm($grandtotal);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salereports->count_all() + 1,
            "recordsFiltered" => $this->salereports->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
