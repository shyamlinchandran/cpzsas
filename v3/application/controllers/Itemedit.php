<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Itemedit extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Itemsedit_model', 'item');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/editstock');
    }
	
	 public function list() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/setfreeqty');
    }

    public function ajax_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->itemname;
            $row[] = $item->godown_name;
            $row[] = '<input type="hidden" name="txtItemId[]" value="' . $item->id . '"/> <input id = "txtOpStockRate' . $item->id . '" attr = "' . $item->id . '" type="text" name="txtOpStockRate[]" class="form-control text-right two-digits txtOpStockRate txtOpStockRate' . $item->id . '" value="' . $item->open_stk_rate . '"/>';
            $row[] = '<input type="hidden" name="txtId[]" value="' . $item->cid . '"/> <input type="text" name="txtOpStock[]" class="form-control text-right two-digits" value="' . $item->open_stock . '"/>';
            $row[] = $item->category;
            $row[] = $item->salerate;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

	public function ajaxlist() {
        $this->item->wherecondition();
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->barcode;
            $row[] = $item->name;
            $row[] = '<input type="hidden" name="txtItemId[]" value="' . $item->id . '"/> <input type="text" name="free_qty[]" class="form-control text-right two-digits" value="' . $item->free_qty . '"/>';
            $row[] = '<input type="text" name="free_qty_for[]" class="form-control text-right two-digits" value="' . $item->free_qty_for . '"/>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	function save_free(){
        $id = $this->input->post('txtItemId', TRUE);
		$free_qty = $this->input->post('free_qty', TRUE);
		$free_qty_for = $this->input->post('free_qty_for', TRUE);
		if($this->input->post('txtItemId', TRUE)){
			$length = sizeof($id);
			for ($i = 0; $i < $length; $i++) {
				$fre_qty = $free_qty[$i];
				if($fre_qty == ''){
					$fre_qty = 0;
				}
				$fre_qty_for = $free_qty_for[$i];
				if($fre_qty_for == ''){
					$fre_qty_for = 0;
				}
				$data = array(
					'free_qty'=>$fre_qty,
					'free_qty_for'=>$fre_qty_for
				);
				$this->db->where('id',$id[$i]);
				$this->db->update('item',$data);
			}
		}
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
    function save() {
        $OpStockRate = $this->input->post('txtOpStockRate', TRUE);
        $OpStock = $this->input->post('txtOpStock', TRUE);
        $cid = $this->input->post('txtId', TRUE);
        $txtItemId = $this->input->post('txtItemId', TRUE);
        $length = sizeof($cid);
        for ($i = 0; $i < $length; $i++) {
            $singcid = $cid[$i];
            $singStk = $OpStock[$i];
            $singRate = $OpStockRate[$i];
            $singItem = $txtItemId[$i];
            $this->item->updatestk($singcid, $singStk, $singRate, $singItem);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}

