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
class GstSummary extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/GstSummaryReport_model', 'Gstreport');
    }

    function gstsummary() {
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstsummary/gstsummary', $data);
    }
	
	function getchild($list, $val,$tax_id) {
        $filter_rules = array(
            'stype' => $val,
			'tax_id'=>$tax_id
        );
        $filter = function ($player) use ($filter_rules) {
            foreach ($filter_rules as $rulekey => $rulevalue) {
                if ($player[$rulekey] != $rulevalue) {
                    return false;
                }
            }
            return true;
        };
        $filtered = array_filter($list, $filter);
        return $filtered;
    }
	
	function loadrow($text = 'Total'){
		$row = array();
		$row[] = '';
		$row[] = $text;
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		$row[] = '';
		return $row;
	}

    public function ajax_list() {
			$settings = $this->Gstreport->getCompanySettings();
			$comset_statecode = $settings[0]['comset_statecode'];
			$tax_details = $this->Gstreport->tax_details();
			$data = array();
			$i = 0;
			$data[] = $this->loadrow('INPUT GST (LOCAL)');
			foreach($tax_details as $item){
			$net_amt = $net_sgst = $net_cgst = $net_igst = $net_GST = $net_gst_total = $net_cess = $net_tax=0;
				$i++;
				$row = array();
				$row[] = $i;
				$row[] = $item['GST'];
				$sales_data = $this->Gstreport->getsales_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'sales', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
						$row[] = $gst['beforetax'];
						$net_amt = (float) $net_amt + (float)$gst['beforetax'];
						if((float) $gst['tax'] > 0 ){
							$net_sgst = (float) $net_sgst + (float)$gst['tax']/2;
							$net_cgst = (float) $net_cgst + (float)$gst['tax']/2;
							$net_tax = (  float) $net_tax + (float)$gst['tax'];
							$row[] = $gst['tax']/2;
							$row[] = $gst['tax']/2;
						}else{
							$row[] = '0';
							$row[] = '0';
						}
						$row[] = 0;
						$row[] = $gst['cess'];
						$net_cess = (float) $net_cess + (float) $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$sales_data = $this->Gstreport->getsales_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'sales_return', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
						$row[] = $gst['beforetax'];
						$net_amt = (float) $net_amt + (float)$gst['beforetax'];
						if((float) $gst['tax'] > 0 ){
							$net_sgst = (float) $net_sgst + (float)$gst['tax']/2;
							$net_cgst = (float) $net_cgst + (float)$gst['tax']/2;
							$net_tax = (  float) $net_tax + (float)$gst['tax'];
							$row[] = $gst['tax']/2;
							$row[] = $gst['tax']/2;
						}else{
							$row[] = '0';
							$row[] = '0';
						}
						$row[] = 0;
						$row[] = $gst['cess'];
						$net_cess = (float) $net_cess + (float) $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$row[] = $net_amt;
				$row[] = $net_cgst;
				$row[] = $net_sgst;
				$row[] = $net_igst;
				$row[] = $net_cess;
				$row[] = $net_tax;
				$data[] = $row;
			}
			$data[] = $this->loadrow();
			$data[] = $this->loadrow('INPUT GST (INTERSTATE)');
			$i = 0;
			foreach($tax_details as $item){
			$net_amt = $net_sgst = $net_cgst = $net_igst = $net_GST = $net_gst_total = $net_cess = $net_tax=0;
				$i++;
				$row = array();
				$row[] = $i;
				$row[] = $item['GST'];
				$sales_data = $this->Gstreport->getsalesIGST_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'sales', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
							$net_amt = (float) $net_amt + (float)$gst['beforetax'];
							$row[] = $gst['beforetax'];
							$row[] = '0';
							$row[] = '0';
							$net_igst = (float) $net_igst + (float)$gst['tax'];
							$row[] = $gst['tax'];
							 $net_cess =  (float) $net_cess + (float)$gst['cess'];
							$row[] = $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$sales_data = $this->Gstreport->getsalesIGST_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'sales_return', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
							$net_amt = (float) $net_amt + (float)$gst['beforetax'];
							$row[] = $gst['beforetax'];
							$row[] = '0';
							$row[] = '0';
							$net_igst = (float) $net_igst + (float)$gst['tax'];
							$row[] = $gst['tax'];
							 $net_cess =  (float) $net_cess + (float)$gst['cess'];
							$row[] = $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$row[] = $net_amt;
				$row[] = $net_cgst;
				$row[] = $net_sgst;
				$row[] = $net_igst;
				$row[] = $net_cess;
				$row[] = $net_igst;
				$data[] = $row;
			}
			
						$i = 0;
			$data[] = $this->loadrow();
			$data[] = $this->loadrow('OUTPUT GST (LOCAL)');
			foreach($tax_details as $item){
			$net_amt = $net_sgst = $net_cgst = $net_igst = $net_GST = $net_gst_total = $net_cess = $net_tax=0;
				$i++;
				$row = array();
				$row[] = $i;
				$row[] = $item['GST'];
				$sales_data = $this->Gstreport->getpurchase_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'purchase', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
						$row[] = $gst['beforetax'];
						$net_amt = (float) $net_amt + (float)$gst['beforetax'];
						if((float) $gst['tax'] > 0 ){
							$net_sgst = (float) $net_sgst + (float)$gst['tax']/2;
							$net_cgst = (float) $net_cgst + (float)$gst['tax']/2;
							$net_tax = (  float) $net_tax + (float)$gst['tax'];
							$row[] = $gst['tax']/2;
							$row[] = $gst['tax']/2;
						}else{
							$row[] = '0';
							$row[] = '0';
						}
						$row[] = 0;
						$row[] = $gst['cess'];
						$net_cess = (float) $net_cess + (float) $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$sales_data = $this->Gstreport->getpurchase_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'purchase_return', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
						$row[] = $gst['beforetax'];
						$net_amt = (float) $net_amt + (float)$gst['beforetax'];
						if((float) $gst['tax'] > 0 ){
							$net_sgst = (float) $net_sgst + (float)$gst['tax']/2;
							$net_cgst = (float) $net_cgst + (float)$gst['tax']/2;
							$net_tax = (  float) $net_tax + (float)$gst['tax'];
							$row[] = $gst['tax']/2;
							$row[] = $gst['tax']/2;
						}else{
							$row[] = '0';
							$row[] = '0';
						}
						$row[] = 0;
						$row[] = $gst['cess'];
						$net_cess = (float) $net_cess + (float) $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$row[] = $net_amt;
				$row[] = $net_cgst;
				$row[] = $net_sgst;
				$row[] = $net_igst;
				$row[] = $net_cess;
				$row[] = $net_tax;
				$data[] = $row;
			}
			$data[] = $this->loadrow();
			$data[] = $this->loadrow('OUTPUT GST (INTERSTATE)');
			$i = 0;
			foreach($tax_details as $item){
			$net_amt = $net_sgst = $net_cgst = $net_igst = $net_GST = $net_gst_total = $net_cess = $net_tax=0;
				$i++;
				$row = array();
				$row[] = $i;
				$row[] = $item['GST'];
				$sales_data = $this->Gstreport->getpurchaseIgst_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'purchase', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
							$net_amt = (float) $net_amt + (float)$gst['beforetax'];
							$row[] = $gst['beforetax'];
							$row[] = '0';
							$row[] = '0';
							$net_igst = (float) $net_igst + (float)$gst['tax'];
							$row[] = $gst['tax'];
							 $net_cess =  (float) $net_cess + (float)$gst['cess'];
							$row[] = $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$sales_data = $this->Gstreport->getpurchaseIgst_data($comset_statecode);
				$gstdata = $this->getchild($sales_data,'purchase_return', $item['gstid']);
				if(sizeof($gstdata) > 0 ){
					foreach($gstdata as $gst){
							$net_amt = (float) $net_amt + (float)$gst['beforetax'];
							$row[] = $gst['beforetax'];
							$row[] = '0';
							$row[] = '0';
							$net_igst = (float) $net_igst + (float)$gst['tax'];
							$row[] = $gst['tax'];
							 $net_cess =  (float) $net_cess + (float)$gst['cess'];
							$row[] = $gst['cess'];
					}
				}else{
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
					$row[] = 0;
				}
				$row[] = $net_amt;
				$row[] = $net_cgst;
				$row[] = $net_sgst;
				$row[] = $net_igst;
				$row[] = $net_cess;
				$row[] = $net_igst;
				$data[] = $row;
			}
			
			
			
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => 1,
            "recordsFiltered" => 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

   
}
