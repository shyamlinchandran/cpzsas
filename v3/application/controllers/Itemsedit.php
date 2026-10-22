<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Itemsedit extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Itemedit_model', 'item');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('items/edititem');
    }

    public function ajax_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $option = $this->item->tax();
		$opt_cess = $this->item->cess();
        $discounts = $this->item->discount();
		$categories = $this->item->category();
		$im_godown = $this->item->ims_godown();
		$hsncode = $this->item->hsncode();
		$brand = $this->item->brand();
//        print_r($option);
        foreach ($list as $item) {
            $active_selected = ($item->is_active == 1) ? 'selected' : '';
            $inactive_selected = ($item->is_active == 0) ? 'selected' : '';
            $myoption = $option;
			$option_hsncode = str_replace('value="' . $item->hsncode . '"', 'value="' . $item->hsncode . '" selected', $hsncode);
			$option_brand = str_replace('value="' . $item->brand_id . '"', 'value="' . $item->brand_id . '" selected', $brand);
			$option_cess = str_replace('value="' . $item->cess_id . '"', 'value="' . $item->cess_id . '" selected', $opt_cess);
			$ims_godown = str_replace('value="' . $item->godown . '"', 'value="' . $item->godown . '" selected', $im_godown);
			$category = str_replace('value="' . $item->item_category_id . '"', 'value="' . $item->item_category_id . '" selected', $categories);
            $discount = str_replace('value="' . $item->item_group_id . '"', 'value="' . $item->item_group_id . '" selected', $discounts);
            $myoption = str_replace('value="' . $item->tax_id . '"', 'value="' . $item->tax_id . '" selected', $myoption);
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = '<input readonly style="width:120px;" type="text" name="txtBARCODE[]" class="form-control text-right two-digits" value="' . $item->barcode . '"/>';
            $row[] = '<input style="width:100px;" type="text" name="txtwh_rate[]" class="form-control text-right two-digits" value="' . $item->wh_rate . '"/>';
            $row[] = '<input type="hidden" name="txtItemId[]" value="' . $item->id . '"/> <input style="width:100px;"  type="text" name="txtPrate[]" class="form-control text-right two-digits" value="' . $item->prate . '"/>';
            $row[] = '<input style="width:100px;" type="text" name="txtMrp[]" class="form-control text-right two-digits" value="' . $item->MRP . '"/>';
            $row[] = '<input style="width:100px;" type="text" name="txtSrate[]" class="form-control text-right two-digits" value="' . $item->srate . '"/>';
            
            $row[] = '<input style="width:100px;" type="text" name="txtlandingcost[]" class="form-control text-right two-digits" value="' . $item->landing_cost . '"/>';
            $row[] = '<input style="width:100px;" type="text" name="txtspecialrate[]" class="form-control text-right two-digits" value="' . $item->special_rate . '"/>';

			$row[] = '<select style="width:100px;"  data-validation="required"  id="itemhsn[]"  name="itemhsn[]" class="form-control select2" >' . $option_hsncode . ' </select>';
			$row[] = '<select style="width:100px;"  data-validation="required"  id="itemgodown[]"  name="itemgodown[]" class="form-control" >' . $ims_godown . ' </select>';
			$row[] = '<select style="width:100px;"  data-validation="required"  id="itemcategory[]"  name="itemcategory[]" class="form-control" >' . $category . ' </select>';
			$row[] = '<select style="width:100px;"  data-validation="required"  id="itembrand[]"  name="itembrand[]" class="form-control" >' . $option_brand . ' </select>';
            $row[] = '<select style="width:100px;"  data-validation="required"  id="itemdiscount[]"  name="itemdiscount[]" class="form-control" >' . $discount . ' </select>';
            $row[] = '<select style="width:100px;"  data-validation="required"  id="itemtax[]"  name="itemtax[]" class="form-control" >' . $myoption . ' </select>';
            $row[] = '<select style="width:100px;"    id="itemcess[]"  name="itemcess[]" class="form-control" >' . $option_cess . ' </select>';

            $status_select = '<select style="width:80px;" name="item_active[]" class="form-control">';
            $status_select .= '<option value="1" ' . $active_selected . '>Yes</option>';
            $status_select .= '<option value="0" ' . $inactive_selected . '>No</option>';
            $status_select .= '</select>';

            $row[] = $status_select;
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

    function save() {
		$txtwh_rate = $this->input->post('txtwh_rate', TRUE);
        $txtPrate = $this->input->post('txtPrate', TRUE);
        $txtMrp = $this->input->post('txtMrp', TRUE);
        $txtSrate = $this->input->post('txtSrate', TRUE);
        $txtItemId = $this->input->post('txtItemId', TRUE);
        $tax_id = $this->input->post('itemtax', TRUE);
        $itemdiscount = $this->input->post('itemdiscount', TRUE);
		$txtBARCODE = $this->input->post('txtBARCODE',TRUE);
		$itemcategory = $this->input->post('itemcategory',TRUE);
		$itemgodown = $this->input->post('itemgodown',TRUE);
		$itemcess =  $this->input->post('itemcess',TRUE);
		$itembrand = $this->input->post('itembrand',TRUE);
		$itemhsn = $this->input->post('itemhsn',TRUE);
		$sel_item_active = $this->input->post('item_active',TRUE);
		
		$landing_cost = $this->input->post('txtlandingcost',TRUE);
		$special_rate = $this->input->post('txtspecialrate',TRUE);
        $length = sizeof($txtItemId);
        for ($i = 0; $i < $length; $i++) {
            $item_id = $txtItemId[$i];
            $prate = $txtPrate[$i];
            $MRP = $txtMrp[$i];
            $srate = $txtSrate[$i];
            $discount = $itemdiscount[$i];
			$BARCODE  = $txtBARCODE[$i];
			$category = $itemcategory[$i];
			$godown = $itemgodown[$i];
            $item_active = $sel_item_active[$i];
            $this->item->updaterate($item_id, $prate, $MRP, $srate, $tax_id[$i],$discount,$BARCODE,$category,$godown,$txtwh_rate[$i],$itemcess[$i],$itembrand[$i],$itemhsn[$i],$landing_cost[$i],$special_rate[$i],$item_active);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
