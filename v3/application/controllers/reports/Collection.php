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
class Collection extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Collection_model', 'collection');
    }
	
	public function totalcollectionlist(){
		return $this->collection->collectionvalues(); 
    }
	
	public function totalsalescollectionlist(){
		return $this->collection->totalsalescollectionlist(); 
    }
	
	
	public function collection_data(){
		return $this->collection->collection_data(); 
	}
	
	public function sales_collection_data(){
		return $this->collection->sales_collection_data(); 
	}
	
	public function sales_collection(){
		$data['title'] = 'Sales  Report';
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/collection/sales_collection', $data);
	}
	
	function period_collection(){
		$data['title'] = 'Collection Report';
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/collection/period_collection', $data);
	}

    function collection() {
        $data['settings'] = $this->collection->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/collection/collection', $data);
    }

    public function ajax_list() {
        $this->collection->wherecondition();
        $list = $this->collection->get_datatables();
        $sale_type = "sales_return,sales";
        if ($this->input->post('sale_type')) {
            $sale_type = "sale";
        }
        $data = array();
        $no = $this->input->post('start');
        $credit = $tot_credit = 0;
        $debit = $tot_debit = 0;
        foreach ($list as $vouchers) {
            if ($vouchers->stype == "sales") {
                $credit = 0;
                $debit = $vouchers->invoicetotal;
                $tot_debit = $tot_debit + $vouchers->invoicetotal;
            } else {
                $debit = 0;
                $credit = $vouchers->invoicetotal;
                $tot_credit = $tot_credit + $vouchers->invoicetotal;
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice_date;
            $row[] = $this->collection->get_url($vouchers->sid, $vouchers->invoice, $vouchers->stype);
            $row[] = $vouchers->cash_type;
            $row[] = $vouchers->stype;
            $row[] = $vouchers->name;
            $row[] = $vouchers->tin;
            $row[] = $credit;

            $row[] = $debit;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '<b>Totals</b>';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . $tot_credit . '</b>';
        $row[] = '<b>' . $tot_debit . '</b>';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->collection->count_all() + 1,
            "recordsFiltered" => $this->collection->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
