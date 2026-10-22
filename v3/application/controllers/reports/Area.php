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
class Area extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Area_model', 'area');
    }
	

    function Invoice($type ="") {
		$data['title'] = 'Load Sheet Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/area/invoice',$data);
    }


	function Itemwise($type ="") {
		$data['title'] = 'Area Wise Item Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/area/itemwise',$data);
    }

    function Customerwise($type = "") {
		$data['title'] = 'Route Customer Bill Details';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/area/customerwise',$data);
    }

	

    public function invoice_list() {
        $this->area->Invoice();
        $list = $this->area->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $chk_assign = '<input  class="enquiry" type="checkbox" name="check[]" value="' . $items->sales_id . '"> ';

            $row[] = $chk_assign.$no;
            $row[] = $items->invoice;
            $row[] = $items->invoice_date;
            $row[] = $items->name;
            $row[] = (float) $items->total ;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->area->count_all(),
            "recordsFiltered" => $this->area->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function invoice_ajax_list() {

        $qry = "SELECT * FROM `units` WHERE unit_id = 0 or unit_id is null ";
		//$qry = "SELECT * FROM `units` WHERE  name = 'No' ";
		$query = $this->db->query($qry)->result_array();
		$unit_data = [];
       
		foreach($query as $item){
			$qry = "SELECT * FROM units WHERE `unit_id` = ".$item['id']." UNION SELECT * FROM units WHERE unit_id IN (SELECT id FROM units WHERE unit_id = ".$item['id'].") order by unit_count desc";
			$result = $this->db->query($qry);
			$unit_array = [];
			if($result->num_rows() > 0 ){
				$result = $result->result_array();
				$i  = 0 ;
				foreach($result as $items){
					$unit_array[$i]['name'] = $items['name'];
					$unit_array[$i]['count'] = $items['unit_count'];
					$unit_array[$i]['id'] = $items['id'];
					$i++;
				}
				$unit_data[$item['id']] = $unit_array;
			}
		}


        $this->area->ItemwiseInvoice();
        $list = $this->area->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $tot_boxes = 0;
        $gtot = 0;
        foreach ($list as $items) {
             $boxes =0;
            $chk = $items->sub_unit_one + $items->sub_unit_two;
			$i_stock = $items->quantitys;
			$text = '';
			if((int) $i_stock > 0 ){
				if(isset($unit_data[$items->unit_id]) ){
					$datas = $unit_data[$items->unit_id];
					foreach($datas as $ustock){
						if($i_stock >= $ustock['count']){
							if($chk < 1 || (int) $items->sub_unit_one == (int)$ustock['id'] || (int) $items->sub_unit_two == (int)$ustock['id'] ){
								$calc = $i_stock / $ustock['count'];
								$calc = floor($calc);
								$i_stock = $i_stock % $ustock['count'];
						
								if($text !=''){
									$text = $text .',';
								}
								$text = $text.' ' . $ustock['name'].' : '.$calc;
                                if($ustock['count'] >1 ){
                                     $boxes  = $calc;
                                     $tot_boxes =  (float) $tot_boxes + (float)$calc;
                                }
							}
							if($i_stock < 2){
								 break;
							}
						}
					}
				}
			}
			if($text !=''){
				$text = $text .',';
			}
			$text = $text.' ' . $items->code.' : '.$i_stock;

            $gtot = (float) $gtot +  (float) $items->free_quantity + (float) $items->quantitys;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->quantitys;
            $row[] = $items->free_quantity;
            $row[] = (float) $items->free_quantity + (float) $items->quantitys;
            $row[] = $items->code;
            $row[] = $boxes;
            $row[] = $text;
            $data[] = $row;
        }
        $row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = '';
            $row[] = '';
            $row[] = $gtot;
            $row[] = '';
            $row[] = $tot_boxes;
            $row[] = '';
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->area->count_all(),
            "recordsFiltered" => $this->area->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function ajax_list() {
        $this->area->Itemwise();
        $list = $this->area->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->quantity;
            $row[] = $items->free_quantity;
            $row[] = (float) $items->free_quantity + (float) $items->quantity;
            $row[] = $items->code;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->area->count_all(),
            "recordsFiltered" => $this->area->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function payment_list() {
        $this->area->Customerwise();
        $list = $this->area->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$total = 0;
        foreach ($list as $items) {
			$total = (float) $total + (float) $items->total;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->invoice;
            $row[] = $items->total;
            $row[] = '';
            $data[] = $row;
        }
			$row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = $total;
            $row[] = '';
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->area->count_all(),
            "recordsFiltered" => $this->area->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	


	


}
