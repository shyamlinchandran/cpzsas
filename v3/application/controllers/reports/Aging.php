<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aeging
 *
 * @author jijodileep
 */
class Aging extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('reports/aging_model', 'aging');
    }

    public function listall() {
        $data['title'] = 'Aging Reports';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/aging/aging');
    }
	
	public function outstanding_report() {
        $data['title'] = 'Billwise Outstanding Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/aging/outstanding_report', $data);
    }


    public function outstand() {
        $data['title'] = 'Billwise Outstanding Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/aging/outstand', $data);
    }

    public function fortable() {
        $list = $this->aging->get_josn();
        echo json_encode($list);
    }

    public function ajax_list() {
        $ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
        $vid = $this->input->post('vid');
        if ($vid != 0) {
            $this->aging->whereedit($vid);
            $list = $this->aging->get_datatables();
        } else {
            $this->aging->where();
            $list = $this->aging->get_datatables();
        }
        $data = array();
        $id = 0;
        $type = $this->input->post('type');
        foreach ($list as $members) {
            $id = $id + 1;
            $credit = $members->credit;
            $debit = $members->debit;
            if ($vid != 0) {
//                if ($type == 'rec') {
//                    $debit = $members->balance;
//                }
//                if ($type == 'pay') {
//                    $credit = $members->balance;
//                }
//                if ($type == 'jou') {
//                    if ($credit == 0) {
//                        $debit = $members->balance;
//                        $credit = 0;
//                    } else {
//                        $credit = $members->balance;
//                        $debit = 0;
//                    }
//                }
            }

            $row = array();
            $row[] = '<input type="checkbox" name="chck[]" class="chkchg" id="' . $id . '"   name="age[]" value="' . $members->age_id . '"/>';
            $row[] = '<label id="lblvoucher' . $id . '" >'.$members->voucher_no.' ( '.$members->tb_crdates.' )</label>	';
            $hidden = "<input type='hidden' name='hdcrdt[]' id='hdcrdt" . $id . "' value='" . $credit . "' />";
            $hidden .= "<input type='hidden' name='tbid[]'  id='tbid" . $id . "' value='" . $members->tb_id . "' />";
            $hidden .= "<input type='hidden' name='hddbt[]'  id='hddbt" . $id . "' value='" . $debit . "' />";
            $hidden .= "<input type='hidden' name='age_id[]' id='rosid" . $id . "' value='" . $members->age_id . "' />";
            $hidden .= "<input type='hidden' name='last_paid[]' id='last_paid" . $id . "' value='" . $members->lastpaid . "' />";
            if ($type == 'rec') {
                $row[] = $debit;
                $row[] = $hidden . '<input ref="'.$id.'" type="text" id="txtamt' . $id . '" style="width: 82px;" class="form-control txtamt" name="txtamt[]"  />';
            }
            if ($type == 'pay') {
                $row[] = $hidden . '<input ref="'.$id.'" type="text" id="txtamt' . $id . '" style="width: 82px;" class="form-control txtamt" name="txtamt[]"  />';
                $row[] = $credit;
            }
            if ($type == 'jou') {
                $hidden = $hidden . "<input type='hidden' name='mpaid[]'  value='" . $members->last_paid . "' />";
                $row[] = $hidden . '<input type="text" id="txtamtd' . $id . '" value="' . $debit . '" style="width: 82px;" class="txtamt" name="txtamtd[]"  />';
                $row[] = '<input type="text" id="txtamtc' . $id . '" value="' . $credit . '" style="width: 82px;" class="txtamt" name="txtamtc[]"  />';
            }
            //$row[] = $members->debit; 
           
            $row[] = '<input type="text" id="txtbal' . $id . '" style="width: 82px;" readonly   name="txtbal[]"  />';
            if($ageing_adjustment > 0 ){
                $txt = '';
                if($members->is_adjust > 0 ){
                    $txt = 'checked';
                }
$row[] = '
    <div style="display: flex; align-items: center; gap: 5px;">
        <input '.$txt.'  type="checkbox" attr ="' . $id . '"  class ="chkadjust" id="chkadjust' . $id . '" name="chkadjust[]" value="' . $id . '" />
        <input value ="'.$members->adjustment.'" type="text" id="txtadjust' . $id . '" name="txtadjust[]" style="width: 82px;" readonly />
    </div>
';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->aging->count_all() + 1,
            "recordsFiltered" => $this->aging->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
