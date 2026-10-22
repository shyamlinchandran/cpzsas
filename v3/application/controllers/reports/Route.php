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
class Route extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Route_model', 'route');
    }
	
	 function Dayreport($type ="") {
		$data['title'] = 'Item Wise Day Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/route/dayreport',$data);
    }

	function itemwise_dayreport(){
		$data['title'] = 'Daily Statement';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/route/itemreport',$data);
	}
	
	public function ajax_list() {
        $this->route->Dayreport();
        $list = $this->route->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->quantity;
            $row[] = $items->code;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->route->count_all(),
            "recordsFiltered" => $this->route->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function day_list() {
        $this->route->item_dayreport();
        $list = $this->route->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$shop_balance = 0;
        foreach ($list as $items) {
            $no++;
            $row = array();
			$shop_balance = (float) $items->openstock + (float) $items->gstock + (float) $items->purchase_qty - (float)   $items->routedamageqty - (float) $items->routeqty;
            $row[] = $no;
			$row[] = $items->name;
            $row[] = $items->openstock + $items->gstock;
            $row[] = $items->purchase_qty;
            $row[] = $items->routeqty;
			$row[] = $items->out_qty;
			$row[] = $items->in_qty;
			$row[] = $items->routedamageqty;
			$row[] = $shop_balance;
			$row[] = $items->whquantity;
			$row[] = $items->retquantity;
			$row[] = $items->damageqty;
            $row[] = $items->closing + $items->gstock;
			$row[] = $items->whamount;
			$row[] = $items->retamount;
			$row[] = $items->routeamount;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->route->count_all(),
            "recordsFiltered" => $this->route->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
}
