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
class marginreport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/marginreport_model', 'marginreport');
    }

	function average_margin_report(){
		$data['title'] = 'Average Margin Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/average_margin_report',$data);
	}
    function landing_cost() {
        $data['title'] = 'Item wise Landing Cost  Margin Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/landing_cost',$data);
    }
	
    function itemwise() {
        // $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/itemwise');
    }
	
	 function itemwise_lc() {
        $data['title'] = 'Item wise Landing Cost  Margin Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/itemwise_lc',$data);
    }
	
	function custom_report() {
        // $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/custom_report');
    }
     function billwise() {
        // $data['types'] = $this->itemereport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/marginreport/billwise');
    }
	
	  public function landing_cost__list() {
        $this->marginreport->landing_cost();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$lcvalue = $salesrate = $tot = $margin = 0;
        foreach ($list as $vouchers) {
			$tot = (float) $tot + (float) $vouchers->tot;
			$salesrate = (float) $salesrate + (float) $vouchers->salesrate;
			$margin = (float) $margin + (float) $vouchers->margin;
			$lcvalue = (float) $lcvalue + (float) $vouchers->lcvalue;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->item;
            $row[] = $vouchers->unit;
            $row[] = number_format($vouchers->base,$this->company_roundoff);
            $row[] = number_format($vouchers->landing_cost,$this->company_roundoff);
            $row[] = number_format($vouchers->lcvalue,$this->company_roundoff);
			
			$row[] = number_format($vouchers->salesrate,$this->company_roundoff);
            $row[] = number_format($vouchers->tot,$this->company_roundoff);
            $row[] = number_format($vouchers->margin,$this->company_roundoff);
           

            $data[] = $row;
        }     
		$row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = number_format($lcvalue,$this->company_roundoff);
			
			$row[] = number_format($salesrate,$this->company_roundoff);
            $row[] = number_format($tot,$this->company_roundoff);
            $row[] = number_format($margin,$this->company_roundoff);
           

            $data[] = $row;
            $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

  public function billwise_list() {
        $this->marginreport->billwise();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $total=$bill_margin=0;
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            
            $no++;
            $bill_margin=$bill_margin+$vouchers->bill_margin;
            $total=$total+$vouchers->total;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->marginreport->get_url($vouchers->sid,$vouchers->invoice,$vouchers->stype);
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->total;
            $row[] = $vouchers->bill_margin;
           

            $data[] = $row;
        }
         $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = number_format($total,$this->company_roundoff);
            $row[] = number_format($bill_margin,$this->company_roundoff);
           
            
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function average_list(){
		$this->marginreport->get_average_list();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$tot_margin = 0;
		$tot_sales_value = 0;
		$tot_purchase_value = 0;
        foreach ($list as $vouchers) {
			
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a name= "'.$vouchers->name.'" id="'.$vouchers->iid.'" onclick = "showstockledeger(this)" >'.$vouchers->name.'</a>';
           // $row[] = $vouchers->barcode;
            $row[] = (float) $vouchers->bef_stock + $vouchers->open_stock;
            $row[] = $vouchers->avgpratebrfore;
            $row[] = ((float) $vouchers->bef_stock + $vouchers->open_stock ) * $vouchers->avgpratebrfore;
            $row[] = $vouchers->purqty;
            $row[] = $vouchers->avgprate;
            $row[] = $vouchers->purqty * $vouchers->avgprate;
			$row[] = $vouchers->saleqty;
            $row[] = $vouchers->avgsrate;
            $row[] = $vouchers->saleqty * $vouchers->avgsrate;
            $row[] = $vouchers->saleqty * $vouchers->avgprate;
            $row[] = ($vouchers->saleqty * $vouchers->avgsrate) - ($vouchers->saleqty * $vouchers->avgprate);
			$row[] = ((float)($vouchers->saleqty * (float) $vouchers->avgsrate) - ((float)$vouchers->saleqty * (float)$vouchers->avgprate)) *100 / (float) ((float)$vouchers->saleqty * (float)$vouchers->avgsrate) ;
			$row[] = (float) $vouchers->c_stock +  (float)$vouchers->open_stock;
            $row[] = $vouchers->avgprate;
            $row[] = $vouchers->avgprate * ($vouchers->c_stock + $vouchers->open_stock) ;
            $data[] = $row;
			
        }
		
		
	
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function custome_list() {
        $this->marginreport->customisedreport();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$tot_margin = 0;
		$tot_sales_value = 0;
		$tot_purchase_value = 0;
        foreach ($list as $vouchers) {
			$sales_value = (float) $vouchers->avgsalequantity *  (float) $vouchers->avgsalesrate;
			$avg_prates = $vouchers->open_stk_rates;
			if((float) $vouchers->prates > 0 ){
				$avg_prates = $vouchers->prates; 
			}
			if((float) $vouchers->avg_prates > 0 ){
				$avg_prates = $vouchers->avg_prates; 
			}
			if((float) $avg_prates > 0 ){
				$purchase_value = (float) $vouchers->pur_quantity *  (float) $avg_prates;
			}else{
				$purchase_value = (float) $vouchers->pur_quantity *  (float) $vouchers->stk_rate;
			}
			$tot_purchase_value = (float) $tot_purchase_value + (float) $purchase_value;
			$tot_sales_value = (float) $tot_sales_value + $sales_value;
			$rate = $vouchers->avgsalesrate - $avg_prates;
			//$margin =(float) $sales_value- (float) $purchase_value;
			$margin = $vouchers->avgsalequantity * $rate;
			$tot_margin = (float) $tot_margin + (float) $margin;
			$profit = 0;
			if((float) $margin > 0 && (float)$sales_value > 0 ){
				$profit = (float) ($margin *100)/$sales_value;
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a name= "'.$vouchers->name.'" id="'.$vouchers->item_id.'" onclick = "showstockledeger(this)" >'.$vouchers->name.'</a>';
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->stk_rate;
            $row[] = $vouchers->pur_quantity;
            $row[] = number_format($avg_prates,$this->company_roundoff);
            $row[] = number_format($purchase_value,$this->company_roundoff);
            $row[] = $vouchers->avgsalequantity;
            $row[] = number_format($vouchers->avgsalesrate,$this->company_roundoff);
            $row[] = number_format($sales_value,$this->company_roundoff);
			$row[] = number_format($margin,$this->company_roundoff);
			$row[] = number_format($profit,$this->company_roundoff);
            $data[] = $row;
        }
		if((float) $tot_margin > 0 && $tot_sales_value > 0 ){
			$profit = (float) ($tot_margin *100)/$tot_sales_value;
		}else{
			$profit = 0;
		}
		
		$row = array();
            $row[] = $no;
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = number_format($tot_purchase_value,$this->company_roundoff);
            $row[] = '';
            $row[] = '';
            $row[] = number_format($tot_sales_value,$this->company_roundoff);
			$row[] = number_format($tot_margin,$this->company_roundoff);
			$row[] = number_format($profit,$this->company_roundoff);
            $data[] = $row;
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
		
        $this->marginreport->itemwise();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $tot=$item_margin=0;
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $tot= $tot+$vouchers->tot;
            $item_margin=$item_margin+$vouchers->item_margins;
			$mar_pur_rate = $vouchers->mar_pur_rate;
			$total = $vouchers->tot;
			$margin =  $vouchers->item_margins;
			$value = $vouchers->total - $vouchers->ctax -  $vouchers->item_margins;
			if($value > 0 && (float) $mar_pur_rate > 0 ){
				$precentage = ($margin *100)/$value;
				$precentage = round($precentage,$this->company_roundoff);
				
			}else{
				$precentage = "Zero Cost";
			}
			if($vouchers->item_margins > 0 && $vouchers->total>0 && (float)$mar_pur_rate > 0 ){
				$saleprecentage = $vouchers->item_margins *100/$vouchers->total;
				$saleprecentage = round($saleprecentage,$this->company_roundoff);
			}else{
				$saleprecentage = 0;
			}
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->marginreport->get_url($vouchers->sid,$vouchers->invoice,$vouchers->stype);
            $row[] = $vouchers->item;
            $row[] = round($vouchers->sr /$vouchers->quantity,2)  ;
            $row[] = $vouchers->mar_pur_rate;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->tot;
            $row[] = $vouchers->item_margins;
            $row[] = $precentage;
           $row[]=$saleprecentage ;

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
            $row[] = number_format($tot,$this->company_roundoff);
            $row[] = number_format($item_margin,$this->company_roundoff);
            $row[] = '';
            $row[] = '';
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	    public function ajax_list_lc() {
		
         $this->marginreport->landing_cost_lc();
        $list = $this->marginreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$lcvalue = $salesrate = $tot = $margin = 0;
        foreach ($list as $vouchers) {
			$tot = (float) $tot + (float) $vouchers->tot;
			$salesrate = (float) $salesrate + (float) $vouchers->salesrate;
			$margin = (float) $margin + (float) $vouchers->margin;
			$lcvalue = (float) $lcvalue + (float) $vouchers->lcvalue;
            $no++;
            $row = array();
            $row[] = $no;
			$row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->item;
            $row[] = $vouchers->unit;
            $row[] = number_format($vouchers->base,$this->company_roundoff);
            $row[] = number_format($vouchers->landing,$this->company_roundoff);
            $row[] = number_format($vouchers->lcvalue,$this->company_roundoff);
			
			$row[] = number_format($vouchers->salesrate,$this->company_roundoff);
            $row[] = number_format($vouchers->tot,$this->company_roundoff);
            $row[] = number_format($vouchers->margin,$this->company_roundoff);
           

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
            $row[] = number_format($lcvalue,$this->company_roundoff);
			
			$row[] = number_format($salesrate,$this->company_roundoff);
            $row[] = number_format($tot,$this->company_roundoff);
            $row[] = number_format($margin,$this->company_roundoff);
           

            $data[] = $row;
            $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->marginreport->count_all()+1,
            "recordsFiltered" => $this->marginreport->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
}
