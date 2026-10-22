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
class Invoice extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/invoicereport_model', 'invoicereport');
    }

    function invoicereport() {
        // $data['types'] = $this->itemereport->getType();
        $settings = $this->invoicereport->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/invoicereport/invoicereport', $data);
    }
	
	function customereisereport(){
		$title= 'Customer Sales Report';
		$data['title'] = $title;
		 $settings = $this->invoicereport->getCompanySettings();
        $data['settings'] = $settings;
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/invoicereport/customereisereport', $data);
		
	}
	
	function sales_forecast(){
		$title= 'Sales Forecast Report';
		$data['title'] = $title;
		$settings = $this->invoicereport->getCompanySettings();
        $data['settings'] = $settings;
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/invoicereport/sales_forecast', $data);
	}
	
	function salescashreport() {
        // $data['types'] = $this->itemereport->getType();
        $settings = $this->invoicereport->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/invoicereport/salescashreport', $data);
    }
	
	
	public function forecast_list(){
		$no = $this->input->post('start');
        $this->invoicereport->sales_forecast();
        $list = $this->invoicereport->get_datatables();
        $data = array();
		$ratevalue = $lcvalue = $pratevalue  =  $lcmargin = $pratemargin = 0;
		foreach ($list as $vouchers) {
			$ratevalue = (float) $ratevalue + (float) $vouchers->ratevalue;
			$lcvalue = (float) $lcvalue + (float) $vouchers->lcvalue;
			$pratevalue = (float) $pratevalue + (float) $vouchers->pratevalue;
			$lcmargin = (float) $lcmargin + (float) $vouchers->lcmargin;
			$pratemargin = (float) $pratemargin + (float) $vouchers->pratemargin;
			$no++;
            $row = array();
            $row[] = $no;
			$row[] = $vouchers->name;
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->code;
			$row[] = $vouchers->stock;
            $row[] = $vouchers->landing_cost;
            $row[] =$vouchers->prate;
            $row[] =$vouchers->rate;
			$row[] = number_format($vouchers->ratevalue,$this->company_roundoff);
			$row[] = number_format($vouchers->lcvalue,$this->company_roundoff);
            $row[] = number_format($vouchers->pratevalue,$this->company_roundoff);
            $row[] =number_format($vouchers->lcmargin,$this->company_roundoff);
            $row[] =number_format($vouchers->pratemargin,$this->company_roundoff);
			
			
			
			$data[] = $row;
		}
		
		$row = array();
            $row[] = $no;
			$row[] ='';
			$row[] ='';
			$row[] ='';
			$row[] ='';
			$row[] ='';
			$row[] ='';
			$row[] ='';
			$row[] = number_format($ratevalue,$this->company_roundoff);
			$row[] = number_format($lcvalue,$this->company_roundoff);
            $row[] = number_format($pratevalue,$this->company_roundoff);
            $row[] =number_format($lcmargin,$this->company_roundoff);
            $row[] =number_format($pratemargin,$this->company_roundoff);
			
			
			
			$data[] = $row;
		
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invoicereport->count_all() + 1,
            "recordsFiltered" => $this->invoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	 public function customereisereport_list() {
        $no = $this->input->post('start');
        $this->invoicereport->customer_sales();
        $list = $this->invoicereport->get_datatables();
		$cash_amount = 0 ;
		$bank_amount = 0 ;
		$credit = 0 ;
		$total = 0 ;
        $data = array();
		$tax = $discount = $taxable = 0;
		foreach ($list as $vouchers) {
			$cash_amount = (float) $cash_amount + (float)  $vouchers->cash_amount;
			$bank_amount = (float) $bank_amount + (float)  $vouchers->bank_amount;
			$credit = (float) $credit + (float)  $vouchers->credit;
			$total = (float) $total + (float)  $vouchers->total;
			
			$tax = (float) $tax + (float)  $vouchers->tax;
			$discount = (float) $discount + (float)  $vouchers->discount;
			$taxable = (float) $taxable + $vouchers->total - $vouchers->tax - $vouchers->discount;

			$no++;
            $row = array();
            $row[] = $no;
			$row[] = $vouchers->cusname;
            $row[] = $vouchers->tin;
            $row[] = $vouchers->total - $vouchers->tax - $vouchers->discount;
            $row[] = $vouchers->tax ;
            $row[] = $vouchers->discount ;
            $row[] = $vouchers->total;
			$row[] = $vouchers->cash_amount;
            $row[] = $vouchers->bank_amount;
            $row[] =$vouchers->credit;
			$data[] = $row;
		}
		$row = array();
            $row[] = 'Total';
            $row[] = '';
            $row[] = '';
			
            $row[] = $taxable;
            $row[] = $tax;
            $row[] = $discount;
            $row[] = $total;
			$row[] = $cash_amount;
            $row[] = $bank_amount;
            $row[] =$credit;
			$data[] = $row;
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invoicereport->count_all() + 1,
            "recordsFiltered" => $this->invoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	
    public function sales_list() {
        $no = $this->input->post('start');
        $this->invoicereport->getsaleslist();
        $list = $this->invoicereport->get_datatables();
		$cash_amount = 0 ;
		$bank_amount = 0 ;
		$credit = 0 ;
		$total = 0 ;
        $data = array();
		foreach ($list as $vouchers) {
			$cash_amount = (float) $cash_amount + (float)  $vouchers->cash_amount;
			$bank_amount = (float) $bank_amount + (float)  $vouchers->bank_amount;
			$credit = (float) $credit + (float)  $vouchers->credit;
			$total = (float) $total + (float)  $vouchers->total;
			$no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->invoicereport->get_url($vouchers->sales_id, $vouchers->invoice, $vouchers->type);
			$row[] = $vouchers->cusname;
            $row[] = $vouchers->tin;
            $row[] = $vouchers->total;
			$row[] = $vouchers->cash_amount;
            $row[] = $vouchers->bank_amount;
            $row[] =$vouchers->credit;
			$data[] = $row;
		}
		$row = array();
            $row[] = 'Total';
			$row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = $total;
			$row[] = $cash_amount;
            $row[] = $bank_amount;
            $row[] =$credit;
			$data[] = $row;
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invoicereport->count_all() + 1,
            "recordsFiltered" => $this->invoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function ajax_list() {
        $company = $this->invoicereport->getCompany();
		$com_state = substr($company['tin'],0,2);
        $amt = 0;
        $this->invoicereport->where1();
        $list = $this->invoicereport->get_datatables();
        $taxtype = $this->input->post('taxtype');
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $totalroundoff = 0;
        $taxablevalue = 0;
        $tot_sgst = 0 ;
        $tot_igst = 0 ;
        $tax = 0;
        $tottaxablevalue = 0;
		$beforediscount  = 0;
        $tottax =$totgst= 0;
		$totbeforediscount = 0;
		$totdis = 0 ;
        foreach ($list as $vouchers) {
            $cust_state = $vouchers->tin;
			$cust_state  = substr($cust_state,0,2);
            if($cust_state == '' ){
                $cust_state = $com_state;
            }

            $taxablevalue = $taxablevalue + $vouchers->bef;
            $sgst = 0;
			$beforediscount  = $vouchers->tot + $vouchers->discount ;
            $sgst = 0;
			if((float)$vouchers->tax > 0  ){

				$sgst = $vouchers->tax/2;
                if($com_state == $cust_state){
				$tot_sgst = (float) $tot_sgst + (float) $sgst;
                $totaltax = $totaltax + $sgst;

                }else{
                    $tot_igst = (float) $tot_igst + (float) $vouchers->tax;

                }
			}
			$totbeforediscount = $totbeforediscount + $beforediscount;
            $totgst =$totgst +$vouchers->tax;
            $grandtotal = $grandtotal + $vouchers->tot;
			$totdis = $totdis + $vouchers->discount;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->cusemail;
            $row[] = $vouchers->tin;
            $row[] = $this->invoicereport->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->invoice_date;
            
            //$row[] = $vouchers->GST;
            $row[] = $vouchers->AckNo;
            $row[] = $vouchers->EwbNo;
            $row[] = $vouchers->EwbDt;
            $row[] = $vouchers->bef;

            if ($taxtype == 'GST') {
                if($com_state == $cust_state){
                    $row[] = $sgst;
                    $row[] = $sgst;
                    $row[] = '0.00';
                }else{
                    $row[] = '0.00';
                    $row[] = '0.00';
                    $row[] = round($vouchers->tax*$vouchers->cur_exc_amt,$this->company_roundoff);
                }
           
                
              
            } else {
                $row[] = $vouchers->tax;
            }
			$row[] = round($beforediscount,$this->company_roundoff);
            $row[] = $vouchers->discount;
            $row[] = $vouchers->tot;
            $row[] = '';

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
        //$row[] = $vouchers->GST;
        // $row[] = $vouchers->hsn;
        $row[] = $this->number_fm($taxablevalue);
        if ($taxtype == 'GST') {
            $row[] = $this->number_fm($totaltax);
            $row[] = $this->number_fm($totaltax);
            $row[] = $this->number_fm($tot_igst);

        }
        else{
            $row[] = $this->number_fm($totgst);
        }
        $row[] = $this->number_fm($totbeforediscount);
        $row[] = $this->number_fm($totdis) ;
        $row[] = $this->number_fm($grandtotal);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->invoicereport->count_all() + 1,
            "recordsFiltered" => $this->invoicereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
