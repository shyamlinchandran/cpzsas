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
class itemwisereport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/itemwisereport_model', 'itemwisereport');
    }

    function quantity() {
        // $data['types'] = $this->itemereport->getType();
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/quantity', $data);
    }

    function purchase() {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['purtype'] = 'purchase';
        $data['title'] = 'Item Wise Purchase Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/purchase', $data);
    }

    function purchaseorder() {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['purtype'] = 'order';
        $data['title'] = 'Item Wise Purchase Order Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/purchase', $data);
    }

    function purchasereturn() {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['purtype'] = 'purchase_return';
        $data['title'] = 'Item Wise Purchase Return Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/purchase', $data);
    }

    function sales($type = 'sales') {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['saletype'] = $type;
        $data['title'] = 'Item Wise Sales Report';
		if($type =='sales_return'){
			$data['title'] = 'Item Wise SR Report';
		}
		if($type =='estimate'){
			$data['title'] = 'Item Wise Sales Order Report';
		}
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/sales', $data);
    }

    function salesorder() {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['saletype'] = 'estimate';
        $data['title'] = 'Item Wise Sales Order Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/sales', $data);
    }

    function salesreturn() {
        $settings = $this->itemwisereport->getCompanySettings();
        $data['settings'] = $settings;
        // $data['types'] = $this->itemereport->getType();
        $data['saletype'] = 'sales_return';
        $data['title'] = 'Item Wise Sales Return Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemwisereport/sales', $data);
    }

    public function purchase_list() {
        $settings = $this->itemwisereport->getCompanySettings();
        $isbatch = 0 ;
        if(isset($settings[0]['is_batch'])){
            $isbatch = $settings[0]['is_batch'];
        }
        $amt = 0;
        $gst = 0;
        $sgst = $totsgst = $totgst = 0;
        $total = 0;
        $tot = 0;
		$quantity = $fquantity = 0;
        $this->itemwisereport->purchase();
        $list = $this->itemwisereport->get_datatables();
        $data = array();
        $taxtype = $this->input->post('taxtype');
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $gst = $vouchers->taxmain*$vouchers->cur_exc_amt;
			$quantity = (float) $quantity + (float) $vouchers->quantity;
			$fquantity = (float) $fquantity + (float) $vouchers->free_quantity;
            $tot = $tot + $vouchers->tot;
			$sgst = 0;
            if ((float) $gst > 0) {
                $sgst = $gst / 2;
            }
            $totsgst = $totsgst + $sgst;
            $totgst = $totgst + $gst;
            $total = ($vouchers->tot - $vouchers->taxmain - $vouchers->itmrawces + $vouchers->dis_amts);
            $total = $total*$vouchers->cur_exc_amt;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $this->itemwisereport->get_url($vouchers->purchase_id, $vouchers->invoice, $vouchers->ptype);
            $row[] = $vouchers->item ;
            $row[] = $vouchers->barcode ;
            if($isbatch > 0 ){
                $row[] = $vouchers->batch;
            }
            $row[] = $vouchers->quantity. ' ('.$vouchers->uname.')';
            $row[] = $vouchers->free_quantity;
            $row[] = $vouchers->supplier;
            $row[] = $vouchers->btype;
            $row[] = $vouchers->rate;
            $row[] = number_format(round($total,$this->company_roundoff),$this->company_roundoff);
            $row[] = number_format(round($vouchers->dis_amts*$vouchers->cur_exc_amt,$this->company_roundoff),$this->company_roundoff);
            $taxable = ($vouchers->tot - $vouchers->taxmain - $vouchers->itmrawces );
            $row[] = number_format(round($taxable,$this->company_roundoff),$this->company_roundoff);
            $row[] = $vouchers->gstname;
            if ($taxtype == 'GST') {
                $row[] = number_format($sgst,$this->company_roundoff);
                $row[] = number_format($sgst,$this->company_roundoff);
            }
            $row[] = $gst;

            $row[] = $vouchers->itm_ces_per;
            $row[] = $vouchers->itmrawces;
            $row[] = number_format(round($vouchers->other*$vouchers->cur_exc_amt,$this->company_roundoff),$this->company_roundoff);
            $row[] = number_format(round($vouchers->tot*$vouchers->cur_exc_amt,$this->company_roundoff),$this->company_roundoff);

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        if($isbatch > 0 ){
            $row[] = '';
        }
        $row[] = '';
        $row[] = 'Total';
        $row[] =$quantity;
        $row[] = $fquantity;
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        if ($taxtype == 'GST') {
            $row[] = number_format($totsgst,$this->company_roundoff);
            $row[] = number_format($totsgst,$this->company_roundoff);
        }
        $row[] = number_format($totgst,$this->company_roundoff);
        $row[] = '';

        $row[] = '';

        $row[] = '';
        $row[] = number_format($tot,$this->company_roundoff);

        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemwisereport->count_all() + 1,
            "recordsFiltered" => $this->itemwisereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function quantity_list() {
        $this->itemwisereport->quantity();
        $list = $this->itemwisereport->get_datatables();
        $taxtype = $this->input->post('taxtype');
        $data = array();
        $sales = $purchase = 0;
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $dates = $this->itemwisereport->getitemdate($this->input->post('startdate'), $this->input->post('enddate'), $vouchers->item_id);
            $no++;
            $purchase = $purchase + $vouchers->purchase;
            $sales = $sales + $vouchers->sales;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->stock;
            $row[] = $vouchers->sales;
            $row[] = $dates['sdate'];
            $row[] = $vouchers->purchase;
            $row[] = $dates['pdate'];

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = 'Total';
        $row[] = '';
        $row[] = number_format($sales,$this->company_roundoff);
        $row[] = '';
        $row[] = '';
        $row[] = number_format($purchase,$this->company_roundoff);


        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemwisereport->count_all() + 1,
            "recordsFiltered" => $this->itemwisereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $settings = $this->itemwisereport->getCompanySettings();
        $isbatch = 0 ;
        if(isset($settings[0]['is_batch'])){
            $isbatch = $settings[0]['is_batch'];
        }
        $amt = 0;
        $gst = $totcgst = $totsgst = $totgst = $v_total = 0;
        $sgst = 0;
        $total = 0;
        $tot = 0;
		$g_quantity = 0;
        $tottaxable = 0 ;
		$f_quantity = 0;
        $this->itemwisereport->sales();
        $list = $this->itemwisereport->get_datatables();
        $taxtype = $this->input->post('taxtype');
        $data = array();
        $itmrawces = 0;
        $dis_amt = 0 ;
        $add_dis_amt = 0 ;
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $gst = $vouchers->tax;
            $tot = $tot + $vouchers->total;
			$sgst = 0 ;
            if ($gst > 0) {
                $sgst = $gst / 2;
            }
            $add_dis_amt = (float) $add_dis_amt + (float) $vouchers->add_dis_amt;
			$dis_amt = (float) $dis_amt + (float) $vouchers->dis_amt;
			$itmrawces = (float) $itmrawces + (float) $vouchers->itmrawces;
			$f_quantity = (float) $f_quantity + (float) $vouchers->free_quantity;
			$g_quantity = (float) $g_quantity + (float) $vouchers->quantity;
            $totcgst = round($totcgst + $sgst,$this->company_roundoff);
            $totgst = round($totgst + $gst,$this->company_roundoff);
            $total = round($vouchers->total - $vouchers->tax  - $vouchers->itmrawces + $vouchers->dis_amt,$this->company_roundoff);
			$v_total = (float) $v_total + (float) $total;
            $taxable = 0 ;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->itemwisereport->get_url($vouchers->sales_id, $vouchers->invoice, $vouchers->saletype);
            $row[] = $vouchers->item;
            if($isbatch > 0 ){
                $row[] = $vouchers->batch;
            }
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->hsncodename;
            $row[] = $vouchers->sal_itms_mrp;
            $row[] = $vouchers->srate;
            $row[] = $vouchers->unitname;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->free_quantity;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->btype;
            $row[] = number_format($total ,$this->company_roundoff);
            $row[] = number_format(round($vouchers->dis_amt,$this->company_roundoff),$this->company_roundoff);
            $row[] = number_format(round($vouchers->add_dis_amt,$this->company_roundoff),$this->company_roundoff);
            $taxable =  round($vouchers->total - $vouchers->tax  - $vouchers->itmrawces,$this->company_roundoff);
            $tottaxable = (float) $tottaxable + (float) $taxable;
            $row[] = number_format(round($taxable,$this->company_roundoff),$this->company_roundoff);
            $row[] = $vouchers->gstname;
            if ($taxtype == 'GST') {
                $row[] = number_format($sgst,$this->company_roundoff);
                $row[] = number_format($sgst,$this->company_roundoff);
            }
            $row[] = number_format(round($vouchers->tax,$this->company_roundoff),$this->company_roundoff);
            $row[] = $vouchers->itm_ces_per;
            $row[] = number_format(round($vouchers->itmrawces,$this->company_roundoff),$this->company_roundoff);
            $row[] = number_format(round($vouchers->other,$this->company_roundoff),$this->company_roundoff);
            $row[] = number_format(round($vouchers->total,$this->company_roundoff),$this->company_roundoff);

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';

        if($isbatch > 0 ){
            $row[] = '';
        }
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = number_format($g_quantity,$this->company_roundoff);
        $row[] = number_format($f_quantity,$this->company_roundoff);
        $row[] = '';
        $row[] = '';    
        $row[] = number_format($v_total,$this->company_roundoff);
        $row[] = number_format(round($dis_amt,$this->company_roundoff),$this->company_roundoff);
        $row[] = number_format(round($add_dis_amt,$this->company_roundoff),$this->company_roundoff);
        $row[] = number_format($tottaxable,$this->company_roundoff);
        $row[] = '';
        if ($taxtype == 'GST') {
            $row[] = number_format($totcgst,$this->company_roundoff);
            $row[] = number_format($totcgst,$this->company_roundoff);
        }
        $row[] = number_format($totgst,$this->company_roundoff);
        $row[] = '';
        $row[] = number_format($itmrawces,$this->company_roundoff);
        $row[] = '';
        $row[] = number_format($tot,$this->company_roundoff);

        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->itemwisereport->count_all() + 1,
            "recordsFiltered" => $this->itemwisereport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function export_sales_csv() {
        // Map GET parameters to POST for the model
        $_POST = $_GET;
        if (!isset($_POST['search'])) {
            $_POST['search'] = array('value' => '');
        }

        $settings = $this->itemwisereport->getCompanySettings();
        $isbatch = 0;
        if (isset($settings[0]['is_batch'])) {
            $isbatch = $settings[0]['is_batch'];
        }

        $this->itemwisereport->sales();
        $this->itemwisereport->getQueryDt();
        $qery = $this->itemwisereport->qryfrm;

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Item_Wise_Sales_Report_' . date('Y-m-d') . '.csv');
        $output = fopen('php://output', 'w');

        $headers = array('SNo', 'Inv Date', 'Inv No', 'Item');
        if ($isbatch > 0) {
            $headers[] = 'Batch';
        }
        $headers = array_merge($headers, array('Barcode', 'Hsncode', 'Mrp', 'Rate', 'Unit', 'Quantity', 'F Qty', 'Customer', 'Salesman', 'Bill Type', 'Value', 'Discount', 'Add Dis.', 'Taxable', 'Tax%'));

        $taxtype = $this->input->post('taxtype');
        if ($taxtype == 'GST') {
            $headers[] = 'cgst';
            $headers[] = 'sgst';
        }
        $headers = array_merge($headers, array('Total Tax', 'Cess %', 'Cess', 'Other Expenses', 'Total'));
        fputcsv($output, $headers);

        $query = $this->db->query($qery);
        
        $no = 0;
        $gst = $totcgst = $totsgst = $totgst = $v_total = 0;
        $sgst = 0;
        $total = 0;
        $tot = 0;
        $g_quantity = 0;
        $tottaxable = 0;
        $f_quantity = 0;
        $itmrawces = 0;
        $dis_amt = 0;
        $add_dis_amt = 0;

        while ($vouchers = $query->unbuffered_row()) {
            $no++;
            $gst = $vouchers->tax;
            $tot = $tot + $vouchers->total;
            $sgst = 0;
            if ($gst > 0) {
                $sgst = $gst / 2;
            }
            $add_dis_amt = (float) $add_dis_amt + (float) $vouchers->add_dis_amt;
            $dis_amt = (float) $dis_amt + (float) $vouchers->dis_amt;
            $itmrawces = (float) $itmrawces + (float) $vouchers->itmrawces;
            $f_quantity = (float) $f_quantity + (float) $vouchers->free_quantity;
            $g_quantity = (float) $g_quantity + (float) $vouchers->quantity;
            $totcgst = round($totcgst + $sgst, $this->company_roundoff);
            $totgst = round($totgst + $gst, $this->company_roundoff);
            $total = round($vouchers->total - $vouchers->tax - $vouchers->itmrawces + $vouchers->dis_amt, $this->company_roundoff);
            $v_total = (float) $v_total + (float) $total;
            $taxable = round($vouchers->total - $vouchers->tax - $vouchers->itmrawces, $this->company_roundoff);
            $tottaxable = (float) $tottaxable + (float) $taxable;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->item;
            if ($isbatch > 0) {
                $row[] = $vouchers->batch;
            }
            $row[] = $vouchers->barcode;
            $row[] = $vouchers->hsncodename;
            $row[] = $vouchers->sal_itms_mrp;
            $row[] = $vouchers->srate;
            $row[] = $vouchers->unitname;
            $row[] = $vouchers->quantity;
            $row[] = $vouchers->free_quantity;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->user_name;
            $row[] = $vouchers->btype;
            $row[] = number_format($total, $this->company_roundoff);
            $row[] = number_format(round($vouchers->dis_amt, $this->company_roundoff), $this->company_roundoff);
            $row[] = number_format(round($vouchers->add_dis_amt, $this->company_roundoff), $this->company_roundoff);
            $row[] = number_format(round($taxable, $this->company_roundoff), $this->company_roundoff);
            $row[] = $vouchers->gstname;
            if ($taxtype == 'GST') {
                $row[] = number_format($sgst, $this->company_roundoff);
                $row[] = number_format($sgst, $this->company_roundoff);
            }
            $row[] = number_format(round($vouchers->tax, $this->company_roundoff), $this->company_roundoff);
            $row[] = $vouchers->itm_ces_per;
            $row[] = number_format(round($vouchers->itmrawces, $this->company_roundoff), $this->company_roundoff);
            $row[] = number_format(round($vouchers->other, $this->company_roundoff), $this->company_roundoff);
            $row[] = number_format(round($vouchers->total, $this->company_roundoff), $this->company_roundoff);

            fputcsv($output, $row);
        }

        $row = array('', '', '', '', '');
        if ($isbatch > 0) {
            $row[] = '';
        }
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = number_format($g_quantity, $this->company_roundoff);
        $row[] = number_format($f_quantity, $this->company_roundoff);
        $row[] = '';
        $row[] = '';
        $row[] = number_format($v_total, $this->company_roundoff);
        $row[] = number_format(round($dis_amt, $this->company_roundoff), $this->company_roundoff);
        $row[] = number_format(round($add_dis_amt, $this->company_roundoff), $this->company_roundoff);
        $row[] = number_format($tottaxable, $this->company_roundoff);
        $row[] = '';
        if ($taxtype == 'GST') {
            $row[] = number_format($totcgst, $this->company_roundoff);
            $row[] = number_format($totcgst, $this->company_roundoff);
        }
        $row[] = number_format($totgst, $this->company_roundoff);
        $row[] = '';
        $row[] = number_format($itmrawces, $this->company_roundoff);
        $row[] = '';
        $row[] = number_format($tot, $this->company_roundoff);
        
        fputcsv($output, $row);
        fclose($output);
        exit;
    }

}
