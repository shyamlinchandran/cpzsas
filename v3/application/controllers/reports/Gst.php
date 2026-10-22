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
class Gst extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Gstreport_model', 'Gstreport');
    }

    function type() {
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $data['types'] = $this->Gstreport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/typereport', $data);
    }

    function gstreport() {
        $data['types'] = $this->Gstreport->getType();
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/gstreport', $data);
    }
	
	function b2breport() {
        $data['types'] = $this->Gstreport->getType();
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/b2breport', $data);
    }
	
	function b2creport() {
        $data['types'] = $this->Gstreport->getType();
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/b2creport', $data);
    }

    function gstreport_custome() {
        $data['types'] = $this->Gstreport->getType();
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/custome_gstreport', $data);
    }

    function gstreprt_custome() {
        $data['types'] = $this->Gstreport->getType();
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/custome_gstreprt', $data);
    }

    function gstr2report() {
        $data['types'] = $this->Gstreport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/gstreport/gstr2report', $data);
    }

    function tyrsalesreport() {
        $data['settings'] = $this->Gstreport->getCompanySettings();
        $data['types'] = $this->Gstreport->getType();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/salereport/tyrsalereport', $data);
    }

    public function ajax_list() {
        $this->Gstreport->where();
        $list = $this->Gstreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $vouchers) {
            $no++;

            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->name;
            $row[] = $vouchers->total;
            $data[] = $row;
        }$no++;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all(),
            "recordsFiltered" => $this->Gstreport->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function custome_gstreprt() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->gstr_wherecondition();
        $list = $this->Gstreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $tottaxableamt = 0;
        $totalroundoff = 0;
        $grand = 0;
        foreach ($list as $vouchers) {
            if ($vouchers->stype == "sales_return") {
                $vouchers->invoicetotal = $vouchers->invoicetotal * -1;
                $vouchers->taxableamt = $vouchers->taxableamt * -1;
                $vouchers->tax = $vouchers->tax * -1;
                $vouchers->gst = $vouchers->gst * -1;
                $vouchers->TOTAL = $vouchers->TOTAL * -1;
            }
            $grand = $grand + $vouchers->TOTAL;
            $grandtotal = $grandtotal + $vouchers->invoicetotal;
            $tottaxableamt = $tottaxableamt + $vouchers->taxableamt;
            $totaltax = $totaltax + $vouchers->tax;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->gst;
            $row[] = $vouchers->taxableamt;
            if ($taxtype == 'GST') {
                $row[] = $vouchers->tax / 2;
                $row[] = $vouchers->tax / 2;
            }
            $row[] = $vouchers->tax;
            $row[] = $vouchers->TOTAL;
            $data[] = $row;
        }
        $row = array();
        $row[] = 'Total';
        $row[] = '';
        $row[] = $this->number_fm($tottaxableamt);
        if ($taxtype == 'GST') {
            $row[] = $this->number_fm($totaltax / 2);
            $row[] = $this->number_fm($totaltax / 2);
        }
        $row[] = $this->number_fm($totaltax);
        // $row[] = $vouchers->gst;
        $row[] = $this->number_fm($grand);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function custome_gstreport() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->gst_wherecondition();
        $list = $this->Gstreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $tottaxableamt = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            if ($vouchers->stype == "sales_return") {
                $vouchers->invoicetotal = $vouchers->invoicetotal * -1;
                $vouchers->taxableamt = $vouchers->taxableamt * -1;
                $vouchers->tax = $vouchers->tax * -1;
                $vouchers->gst = $vouchers->gst * -1;
                $vouchers->TOTAL = $vouchers->TOTAL * -1;
            }
            $grandtotal = $grandtotal + $vouchers->TOTAL;
            $tottaxableamt = $tottaxableamt + $vouchers->taxableamt;
            $totaltax = $totaltax + $vouchers->tax;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->Gstreport->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->name;
            $row[] = $vouchers->tin;
            $row[] = $vouchers->taxableamt;
            $row[] = $vouchers->gst;
            if ($taxtype == 'GST') {
                $row[] = $vouchers->tax / 2;
                $row[] = $vouchers->tax / 2;
            }
            $row[] = $vouchers->tax;
            // $row[] = $vouchers->gst;
            $row[] = $vouchers->TOTAL;
            $row[] = $vouchers->invoicetotal;
            $data[] = $row;
        }
        $row = array();
        $row[] = $no;
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = $this->number_fm($tottaxableamt);
        $row[] = '';
        if ($taxtype == 'GST') {
            $row[] = $this->number_fm($totaltax / 2);
            $row[] = $this->number_fm($totaltax / 2);
        }
        $row[] = $this->number_fm($totaltax);
        // $row[] = $vouchers->gst;
        $row[] = $this->number_fm($grandtotal);
        $row[] = '';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
	  public function get_b2breport() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->wherecondition();
        $list = $this->Gstreport->get_datatables();
        $sale_type = "sales_return,sales";
        if ($this->input->post('sale_type')) {
            $sale_type = "sale";
        }
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $tottaxableamt = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->tin;
            $row[] = $vouchers->name;
            $row[] = $this->Gstreport->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->in_date;
            $row[] = $vouchers->invoicetotal;
            $row[] = $vouchers->place;
            $row[] = 'N';
            $row[] = 'Regular';
            $row[] = '';
            $row[] = $vouchers->gst;
            $row[] = $vouchers->taxableamt;
            $row[] = $vouchers->item_cess;
            
            
            $data[] = $row;
        }
      
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function get_b2creport() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->wherecondition();
        $list = $this->Gstreport->get_datatables();
        $sale_type = "sales_return,sales";
        if ($this->input->post('sale_type')) {
            $sale_type = "sale";
        }
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $tottaxableamt = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = 'OE';
            $row[] = $vouchers->place;
            $row[] = $vouchers->gst;
            $row[] = $vouchers->taxableamt;
            $row[] = $vouchers->item_cess;
            $row[] = '';
            
            $data[] = $row;
        }
      
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_gstreport() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->wherecondition();
        $list = $this->Gstreport->get_datatables();
        $sale_type = "sales_return,sales";
        if ($this->input->post('sale_type')) {
            $sale_type = "sale";
        }
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $tottaxableamt = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            if ($vouchers->stype == "sales_return" && $sale_type == "sales_return,sales") {
                $vouchers->invoicetotal = $vouchers->invoicetotal * -1;
                $vouchers->taxableamt = $vouchers->taxableamt * -1;
                $vouchers->tax = $vouchers->tax * -1;
                $vouchers->gst = $vouchers->gst * -1;
                $vouchers->TOTAL = $vouchers->TOTAL * -1;
            }
            $grandtotal = $grandtotal + $vouchers->invoicetotal;
            $tottaxableamt = $tottaxableamt + $vouchers->taxableamt;
            $totaltax = $totaltax + $vouchers->tax;
            $no++;
            $row = array();
            $row[] = $no;
            if ($this->input->post('taxwise') == "taxwise") {
                $row[] = '';
                $row[] = '';
                $row[] = '';
                $row[] = '';
            } else {
                $row[] = $vouchers->in_date;
                $row[] = $this->Gstreport->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
                $row[] = $vouchers->name;
                $row[] = $vouchers->tin;
            }

            $row[] = $vouchers->taxableamt;
            $row[] = $vouchers->gst;
            if ($taxtype == 'GST') {
                $row[] = $vouchers->tax / 2;
                $row[] = $vouchers->tax / 2;
            }
            $row[] = $vouchers->tax;
            $row[] = $vouchers->kfc;
            $row[] = $vouchers->item_cess;
            // $row[] = $vouchers->gst;
            $row[] = $vouchers->TOTAL;
            if ($this->input->post('taxwise') == "taxwise") {
                $row[] = '';
            } else {
                $row[] = $vouchers->invoicetotal;
            }
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '';
        $row[] = '';
        $row[] = $this->number_fm($tottaxableamt);
        $row[] = '';
        if ($taxtype == 'GST') {
            $row[] = $this->number_fm($totaltax / 2);
            $row[] = $this->number_fm($totaltax / 2);
        }
        $row[] = $this->number_fm($totaltax);
        $row[] = '';
        $row[] = '';
        // $row[] = $vouchers->gst;
        if ($this->input->post('taxwise') == "taxwise") {
            $row[] =  $this->number_fm($totaltax+$tottaxableamt);
        } else {
            $row[] = $this->number_fm($totaltax+$tottaxableamt);
        }
        $row[] = '';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_gstr2report() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->gstr2wherecondition();
        $list = $this->Gstreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $beftax = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            if ($vouchers->ptype == "purchase_return") {
                $vouchers->beftax = $vouchers->beftax * -1;
                $vouchers->tax = $vouchers->tax * -1;
                $vouchers->tot = $vouchers->tot * -1;
                $vouchers->invtot = $vouchers->invtot * -1;
            }
            $beftax = $beftax + $vouchers->beftax*$vouchers->cur_exc_amt;
            $totaltax = $totaltax + $vouchers->tax*$vouchers->cur_exc_amt;
            $grandtotal = $grandtotal + $vouchers->tot*$vouchers->cur_exc_amt;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->in_date;
            $row[] = $vouchers->tin;
            $row[] = $this->Gstreport->get_url($vouchers->purchase_id, $vouchers->invoice, $vouchers->ptype);
            $row[] = $vouchers->name;
            $row[] = $vouchers->invtot*$vouchers->cur_exc_amt;
            $row[] = $vouchers->GST;
            $row[] = '';
            $row[] = $vouchers->beftax*$vouchers->cur_exc_amt;
            if ($taxtype == 'GST') {
                $row[] = round(($vouchers->tax / 2)*$vouchers->cur_exc_amt,$this->company_roundoff);
                $row[] = round(($vouchers->tax / 2)*$vouchers->cur_exc_amt,$this->company_roundoff);
            }
            $row[] = round($vouchers->tax*$vouchers->cur_exc_amt,$this->company_roundoff);
            $row[] = round($vouchers->tot*$vouchers->cur_exc_amt,$this->company_roundoff);
            // $row[] = $vouchers->gst;
            $row[] = round($vouchers->cur_exc_amt*$vouchers->item_cess,$this->company_roundoff);
            $data[] = $row;
        }
        $row = array();
        $row[] = $no;
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = $this->number_fm($beftax,$this->company_roundoff);
        if ($taxtype == 'GST') {
            $row[] = $this->number_fm(($totaltax / 2),$this->company_roundoff);
            $row[] = $this->number_fm(($totaltax / 2),$this->company_roundoff);
        }
        $row[] = $this->number_fm(($totaltax),$this->company_roundoff);
        $row[] = $this->number_fm(($grandtotal),$this->company_roundoff);
        // $row[] = $vouchers->gst;
        $row[] = 0;
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function get_tyrsalesreport() {
        $taxtype = $this->input->post('taxtype');
        $this->Gstreport->tyrwherecondition();
        $list = $this->Gstreport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $grandtotal = 0;
        $totaltax = 0;
        $totalroundoff = 0;
        foreach ($list as $vouchers) {
            $no++;
            $grandtotal = $grandtotal + $vouchers->total;
            $totaltax = $totaltax + $vouchers->tax;
            $totalroundoff = $totalroundoff + $vouchers->roundoff;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->name;
            $row[] = $vouchers->invoice_date;
            $row[] = $vouchers->tax;
            $row[] = $vouchers->roundoff;
            $row[] = $vouchers->total;

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total ';
        $row[] = $this->number_fm($totaltax);
        $row[] = $this->number_fm($totalroundoff);
        $row[] = $this->number_fm($grandtotal);
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Gstreport->count_all() + 1,
            "recordsFiltered" => $this->Gstreport->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
