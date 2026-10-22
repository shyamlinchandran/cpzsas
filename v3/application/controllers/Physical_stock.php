<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Physical_stock extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Physical_stock_model', 'stock');
    }
	
	public function list(){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('physical_stock/list');
	}

    public function create($id = 0) {
		$data['settings'] = $this->stock->getCompanySettings();
		$data['id'] = $id; 
		$data['voucher_no'] = '';
		if((float) $id > 0 ){
			$qry = "select * from physical_stk_update where id = ".$id;
			$query = $this->db->query($qry)->row_array();
			$data['voucher_no'] =  $query['voucher_no'];
		}
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('physical_stock/create',$data);
    }
	
	
	public function list_all(){
		$settings = $this->stock->getCompanySettings();
		$is_batch = $settings[0]['is_batch'];
		$this->stock->where();
        $list = $this->stock->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->voucher_date;
            $row[] = $item->voucher_no;
            $act = ' <a  href="' . base_url() . 'physical_stock/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
			$data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}
    public function ajax_list() {
		$settings = $this->stock->getCompanySettings();
		$is_batch = $settings[0]['is_batch'];
        $this->stock->Physical_stock();
        $list = $this->stock->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->itemname;
            $row[] = $item->godown_name;
			if((float) $is_batch > 0 ){
				$row[] = $item->batch;
			}
            $row[] = $item->open_stock;
            $row[] = $item->stock;
			$actual = ''; 
			if($item->quantity != 0  && $item->quantity != null && $item->quantity != ''){
				$actual = (float) $item->stock + (float) $item->quantity;
			}
            $row[] = '<input type = "hidden" name = "batch[]" batch = "'.$item->batch.'"  value = "'. $item->batch.'"  ><input type = "hidden" name = "current[]" batch = "'.$item->batch.'"  value = "'. $item->stock.'"  ><input  name = "actualStk[]" value ="'.$item->actualStk.'" cnt =  "'.$no.'"  type= "number" id = "actualStk'.$no.'" class = "actualStk form-control" >  ';
			$row[] = '<input class = "clscurrent" type = "hidden" id = "currStk'.$no.'"  value = "'.$item->stock.'"  ><input type="hidden" name="godown_id[]" value="'.$item->godown_id.'"><input type="hidden" name="item_ids[]" value="'.$item->id.'"><input readonly type="number" value="'.$item->quantity.'" class="form-control uStk" id= "uStk'.$no.'" class="qty" name="quantity[]" >';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


	

    function save() {
        $this->stock->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
			);
        echo json_encode($response);
    }

}

