<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author Shyamlin
 */
class Brandreport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Brandreport_model', 'brand');
    }

	function brand_sales() {
        $data['title'] = 'Brand sales Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/brandreport/brand_sales',$data);
    }
	
	
    function brand_category() {
        $data['title'] = 'Item Group sales Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/brandreport/brand_category',$data);
    }
	
	public function brand_category_list(){
		$this->brand->brand_category_list();
        $list = $this->brand->get_datatables();
        $data = array();
        $no = $this->input->post('start');	
		$tax = $cess = $total = $taxable =  0 ;
        foreach ($list as $items) {
			$taxable = (float) $taxable  + (float) $items->taxable;
			$tax = (float) $tax  + (float) $items->tax;
			$cess = (float) $cess  + (float) $items->cess;
			$total = (float) $total  + (float) $items->total;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->customer;
            $row[] = $items->taxable;
            $row[] = $items->tax;
            $row[] = $items->cess;
            $row[] = $items->total;
            $data[] = $row;
        }
		$row = array();
        $row[] = $no;
		$row[] = '';
        $row[] = $taxable;
        $row[] = $tax;
		$row[] = $cess;
        $row[] = $total;
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->brand->count_all(),
            "recordsFiltered" => $this->brand->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}
	
	public function brand_list(){
		$this->brand->brand_list();
        $list = $this->brand->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$tax = $cess = $total = $taxable = $dis_amt = $gtotal =  0 ;
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
			if($this->input->post('filter_by') == 'brand' ){
				$row[] = $items->brand;
			}else{
				$row[] = $items->categoryname;	
			}
            $taxable = (float) $taxable  + (float) $items->taxable;
			$tax = (float) $tax  + (float) $items->tax;
			$cess = (float) $cess  + (float) $items->cess;
			$total = (float) $total  + (float) $items->total;
			$dis_amt = (float) $dis_amt  + (float) $items>dis_amt;
			$gtotal = (float) $gtotal  + (float) $items->total + (float) $items->dis_amt;
            $row[] = $items->total + $items->dis_amt;
            $row[] = $items->dis_amt;
            $row[] = $items->taxable;
            $row[] = $items->tax;
            $row[] = $items->cess;
            $row[] = $items->total;
            $data[] = $row;
        }
		$row = array();
        $row[] = $no;
		$row[] = '';	
		$row[] = $gtotal;
        $row[] = $dis_amt;
        $row[] = $taxable;
        $row[] = $tax;
        $row[] = $cess;
        $row[] = $total;
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->brand->count_all(),
            "recordsFiltered" => $this->brand->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}
}
