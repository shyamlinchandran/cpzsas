<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */

defined('BASEPATH') or exit('No direct script access allowed');

use AliAbdalla\Tafqeet\Core\Tafqeet;

class Sales extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }
	
	public function get_group_discount(){
		$discount_on = $this->input->post('discount_on');
		$item_id = $this->input->post('item_id');
		$result = $this->sales->get_group_discount($item_id,$discount_on);
		echo json_encode($result);
	}

    public function check_customer()
    {
        $name = $this->input->post('supname');
        $qry = "select * from suppliers where name ='" . $name . "'";
        $result = $this->db->query($qry)->result_array();
        echo json_encode($result);
    }

    public function get_cashcustomer(){
        $search = strtolower($_GET['term']);
		$result = $this->sales->get_cashcustomer($search);
		echo json_encode($result);
	}

    public function get_old_rate()
    {
        $this->sales->get_old_rate();
    }
    public function assign()
    {
        $this->sales->assign();
    }

    public function listall($type)
    {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/sales/list_all', $data);
    }

    public function getinoviceno($type)
    {
        print_r($this->sales->getinoviceno($type));
    }

    public function upload_image()
    {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/company/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '10240'; //1 MB
            $new_name = time() . $_FILES["file"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('file');
            echo $new_name;
        }
    }

    public function alreadyexistcheck()
    {
        print_r($this->sales->alreadyexistcheck());
    }

    public function getnewinoviceno($type)
    {
        print_r($this->sales->getnewinoviceno($type));
    }

    public function getcoupon()
    {
        $search = strtolower($_GET['term']);
        return $this->sales->getcoupon($search);
    }

    function delete($type, $id)
    {
        $this->sales->delete($type, $id);
    }

    function ledbal($id)
    {
        $data = $this->sales->ledbalid($id);

        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $data['id'], 'cl');
        if ($data['type'] == 'Dr') {
            if ($amt < 0) {
                echo $amt * -1 . 'Cr';
            } else {
                echo $amt . 'Dr';
            }
        }
        if ($data['type'] == 'Cr') {
            if ($amt < 0) {
                echo $amt * -1 . 'Dr';
            } else {
                echo $amt . 'Cr';
            }
        }
    }

    function cancel($type, $id)
    {
        $this->sales->cancel($type, $id);
    }


    public function ajax_list()
    {
        $is_location = 0;
        $tmp = $this->session->userdata('user');
        $utype = $tmp['utype'];
        $is_einvoice = 0 ;
        $settings = $this->sales->getCompanySettings();

        $is_export_invoice = 0;
        if (isset($settings[0]['is_export_invoice'])) {
            $is_export_invoice = $settings[0]['is_export_invoice'];
        }


        $restore_sales = 0;
        if (isset($settings[0]['restore_sales'])) {
            $restore_sales = $settings[0]['restore_sales'];
        }
        if (isset($settings[0]['is_einvoice'])) {
            $is_einvoice = $settings[0]['is_einvoice'];
        }
        if (isset($settings[0]['is_location'])) {
            $is_location = $settings[0]['is_location'];
        }
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $user_type  = $tmp['user_type'];
        $this->sales->where();
        $max = $this->sales->max();
        $max_id = $max['max_id'];
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $latitude = '0.00';
            $longitude = '0.00';
            if (isset($vouchers->latitude)) {
                $latitude = $vouchers->latitude;
            }
            if (isset($vouchers->longitude)) {
                $longitude = $vouchers->longitude;
            }
            $chk_assign = '<input  class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->sales_id . '"> ';
            if ($vouchers->is_assigned < 1 && $vouchers->stype == 'estimate') {
                $chk_assign = '<input class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->sales_id . '"> ';
            } else if ((int) $user_type < 2 && $vouchers->stype == 'estimate') {
                $chk_assign = '<input class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->sales_id . '"> ';
            }
            $no++;
            $ref_no = $vouchers->ref_no;
            if( $vouchers->estimate_id > 0 ){
                $qry = "select invoice from sales where sales_id = ".$vouchers->estimate_id;
                $s_data = $this->db->query($qry);
                if($s_data->num_rows() > 0 ){
                    $s_data = $s_data->row_array();
                    $ref_no = $s_data['invoice'];
                }
            }
            $row = array();
            $row[] = $chk_assign . $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->saletype;
            if( $vouchers->stype == 'estimate'){
                $row[] = $vouchers->ref_no;
            }else if($vouchers->xinvoice != '' && $vouchers->xinvoice != 'null'){
                $row[] = $vouchers->xinvoice;
            }else{
                $row[] =$ref_no;
            }
            $row[] = $vouchers->in_date;
			$row[] =  $vouchers->created_time;
            if ($vouchers->customer_id == 0) {
                $row[] = $vouchers->cusname;
            } else {
                $row[] = $vouchers->name;
            }

            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            if ($vouchers->cash_status == 0) {
                // $row[] = 'Cash Not Collected';
            } else {
                // $row[] = 'Cash  Collected';
            }
            $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act = $act . ' <a   tp="new" target="_blank"  href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/' . $vouchers->printtype . '/download" data-toggle="tooltip" title="Download bill" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span></a>';
            $act = $act . ' <a  href="' . base_url() . 'transaction/sales/viewbill/' . $vouchers->stype . '/'  . $vouchers->sales_id . '/' . $vouchers->printtype . '"   title="View" class="btn btn-info sale_edit"><span class="glyphicon glyphicon-eye-open"></span></a>';
            if(strtolower($this->session->userdata('login_base_comid')) == 'asekar' ){
                $act = $act . ' <a  target = "_blank" tp="pdf" href="' . base_url() . 'sales/bill/' . $vouchers->sales_id . '/1" data-toggle="tooltip" title="Print Slip" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
            }else{
                $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/5" data-toggle="tooltip" title="Print Slip" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
            }
            if ($vouchers->is_assigned  < 1) {
                if( $vouchers->stype == 'estimate' && $vouchers->status != 'pending'  ){

                }else{
                    $act = $act . ' <a 1 href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success sale_edit"><span class="glyphicon glyphicon-edit"></span></a>';
                }   
            } else {
                if ($vouchers->salesman == $userid) {
                    //$act = $act . ' <a 2 href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success sale_edit"><span class="glyphicon glyphicon-edit"></span></a>';
                }
            }
            $act = $act . ' <a href="' . base_url() . 'transaction/sales_check/edit/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Verify" class="btn btn-info"><span class="fa fa-barcode"></span></a>';
            if ($vouchers->sales_id == $max_id) {
                //  if ($vouchers->sales_id == $vouchers->sales_id) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"  success="Delete ' . $vouchers->invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/delete/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            } else {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            }
            if ($vouchers->pub != 'yes') {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/sales/sales/view/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
                if((int) $restore_sales > 0 && ucfirst($utype) == "Admin" ){
                    $act = $act . ' <a 1 href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success sale_edit">Restore Voucher</a>';
                }
            }
            if ($vouchers->is_assigned < 1 && $vouchers->stype == 'estimate') {
                $act .= ' <a  ' . $vouchers->type . ' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="' . $vouchers->invoice . '" assign_id = "' . $vouchers->sales_id . '" data-target="#myAssignModal">Assign</span></a>';
            } else if ((int) $user_type < 2 && $vouchers->stype == 'estimate') {
                $act .= ' <a  ' . $vouchers->type . ' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="' . $vouchers->invoice . '" assign_id = "' . $vouchers->sales_id . '" data-target="#myAssignModal">ReAssign</span></a>';
            }
            if ($vouchers->stype == 'delivery_note' && $vouchers->status != 'completed'  && $vouchers->pub == 'yes') {
                $act = $act . ' <a 3 href="' . base_url() . 'transaction/sales/sales/sales/0/no/' . $vouchers->sales_id . '-delivery_note" data-toggle="tooltip" title="Edit" class="btn btn-success">Add Sales</span></a>';
            }
            if ($vouchers->stype == 'estimate' && $vouchers->status != 'completed'  && $vouchers->pub == 'yes') {
                $act = $act . ' <a 33 href="' . base_url() . 'transaction/sales/sales/sales/0/no/' . $vouchers->sales_id . '-estimate" data-toggle="tooltip" title="Edit" class="btn btn-success">Add Sales</span></a>';
            }
            if ((float) $is_location > 0 && $latitude != '0.00') {
                $act = $act . ' <button id="location" longitude = "' . $vouchers->salelongitude . '" latitude = "' . $vouchers->salelatitude . '" class="btn btn-success location" type="button" name="set_iframe" id="set_iframe" title = "Location" ><span class="fa fa-map-marker"></span></button>';
            }

            if (($vouchers->stype == 'sales' || $vouchers->stype == 'sales_return' ) && (float) $is_einvoice > 0   && $vouchers->saletype == 'b2b'  ){
                
                if($vouchers->e_invoice_status < 1 && $vouchers->pub == 'yes'){
                    $act = $act . ' <button sales_id = "'. $vouchers->sales_id.'" data-toggle="tooltip" title="Edit" class="btn btn-success e-invoice">Generate e-invoice</span></button>';
                }else if($vouchers->e_way_status < 1 && $vouchers->total >= 50000  && $vouchers->pub == 'yes' ){
                    $act = $act . ' <button sales_id = "'. $vouchers->sales_id.'" data-toggle="tooltip" title="Edit" class="btn btn-success e-way">Generate e-way</span></button>';
                }
            }

            if($vouchers->e_way_status < 1 && $vouchers->total >= 50000  && $vouchers->pub == 'yes' ){
                $act = $act . ' <button sales_id = "'. $vouchers->sales_id.'" data-toggle="tooltip" title="Edit" class="btn btn-success d-e-way">&nbsp;e-way&nbsp;</span></button>';
            }
            
            $act = $act . '  <button  sales_id = "'. $vouchers->sales_id.'"  role="button" id="excell_add" name="excell_add" tp="new" target="_blank" class="excell_add btn  btn-success align-bottom" href="#" title = "E-Way Info"><span class="glyphicon glyphicon-download"></button>';
            if($is_export_invoice > 0){
                 $act = $act .'<div class="dropdown">
            <button onclick="myFunction('.$vouchers->sales_id.')" class="dropbtn btn btn-success"><span class="glyphicon glyphicon-option-vertical"></span></button>
                <div id="myDropdown'.$vouchers->sales_id.'" class="dropdown-content">
                     <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/exp_invoice/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Commercial Invoice</a>
                     <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/exp_packing/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Packing List</a>
                     <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/exp_ingredients/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Products</a>
                      <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/food_declaration/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Food Declaration</a>

                        </div>
                 </div>';
                //   <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/appendix/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Appendix</a>
                //      <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/disposal/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Disposal</a>
                //      <a  tp="new" target = "_blank" href="' . base_url() . 'transaction/Salesbill/bill/annexure/' . $vouchers->sales_id . '/' . $vouchers->printtype . '">Annexure</a>
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all_sales(),
            "recordsFiltered" => $this->sales->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function ajax_list_view()
    {
        $is_location = 0;
        $settings = $this->sales->getCompanySettings();
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $user_type  = $tmp['user_type'];
        $this->sales->where();
        $max = $this->sales->max();
        $max_id = $max['max_id'];
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $latitude = '0.00';
            $longitude = '0.00';
            if (isset($vouchers->latitude)) {
                $latitude = $vouchers->latitude;
            }
            if (isset($vouchers->longitude)) {
                $longitude = $vouchers->longitude;
            }

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<a onclick ="view('.$vouchers->sales_id.')">' .$vouchers->invoice .'</a>';
            $row[] = $vouchers->in_date;
            if ($vouchers->customer_id == 0) {
                $row[] = $vouchers->cusname;
            } else {
                $row[] = $vouchers->name;
            }

            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            if ($vouchers->cash_status == 0) {
                // $row[] = 'Cash Not Collected';
            } else {
                // $row[] = 'Cash  Collected';
            }
            $act = '';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all_sales(),
            "recordsFiltered" => $this->sales->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getprinttype($printtype_id)
    {
        return $this->sales->getprinttype($printtype_id);
    }
	
	public function cess_details(){
		$qry = "SELECT DATE_FORMAT(CASE WHEN b.ces_end_date like'%0000%' then '2021-07-31' else b.ces_end_date end , '%d/%m/%Y' ) as enddate FROM `taxgst`as a INNER JOIN cess_tbl as b on a.cess_type = b.ces_id WHERE cess_type != 0 GROUP by b.ces_id order by b.ces_id asc";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$date = $query['enddate'];
		}else{
			$date = '31/07/2021';
		}
		print_r($date);
	}

    public function sales($type, $id = 0, $copy = 'no', $deliver_note = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $is_edit = $this->sales->GetUserPermission($type);
        $data['is_edit'] = $is_edit;
        if($id < 1 ){
            $data['is_edit'] = 1 ;
        }
        
        $data['id'] = $id;
        $data['copy'] = $copy;
        $data['est_type'] = '';
        $data['deliver_note'] = $deliver_note;
        $data['copy_id'] = 0;
        if ($deliver_note != 0) {

            $deliver_notes = explode("-", $deliver_note);
            if( $deliver_notes[1] == 'copy'){
                $data['deliver_note'] = 0;
                $data['copy_id'] = $deliver_notes[0];
            }else{
                $data['deliver_note'] = $deliver_notes[0];
                $data['est_type']    = $deliver_notes[1];
            }
        }

        $data['type'] = $type;
        $data['viewtype'] = $type;
        if ($copy == "view") {
            $data['viewtype'] = $copy;
        }
        $qry = "SELECT IFNULL(sum(case when type='sales' then total else 0 end ) - sum(case when type='sales_return' then total else 0 end ),0) as returntotal from sales where published='yes' and invoice_date = CURDATE()";
        $query = $this->db->query($qry)->row_array();
        $data['daybalance'] = $query['returntotal'];
        $zeroindex = $this->sales->zeroindex();
        $settings = $this->sales->getCompanySettings();
        $data['zeroindex'] = $zeroindex;
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales', $data);
    }

    /* estimate start */

    public function estimate($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $zeroindex = $this->sales->zeroindex();
        $settings = $this->sales->getCompanySettings();
        $data['zeroindex'] = $zeroindex;
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/estimate', $data);
    }

    /* estimate End */

    public function sales8b($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8b', $data);
    }

    public function sales8($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8', $data);
    }

    public function sales_return($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $this->load->view('transaction/sales/salesr', $data);
    }

    public function view($id)
    {
        $data['id'] = $id;
        $data['type'] = 'View';
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/sales/view', $data);
    }


    public function converttosales($billtype,$id){
        $qry = "select * from sales where  status != 'completed' and sales_id in(".str_replace("_",",",$id).") ";
        $data = $this->db->query($qry)->result_array();
        foreach($data as $it){
            $qry = "select * from sales_items where published ='yes' and (estimate_quantity > 0 or mrp > 2000) and sales_id =  ".$it['sales_id'];
            $is_exist = $this->db->query($qry);
            if($is_exist->num_rows() < 1 ){
                $this->sales->converttosales($it['sales_id'],$billtype);
            }
            
        }

    }

    public function save($type)
    {
        $is_bkground_print = $this->input->post('is_bkground_print');
        $sale_id = $this->input->post('id');
        $printtype = $this->input->post('printtype');
        $id = $this->sales->save($type);

        if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            if ($is_bkground_print == 1) {
                $response['bill'] = base_url() . 'transaction/sales/bill/' . $id . '/' . $printtype;
            }
            echo json_encode($response);
        }
    }
    public function viewbill($type, $id, $size)
    {
        $data['id'] = $id;
        $data['type'] = $type;
        $data['size'] = $size;
        $this->load->view('transaction/sales/viewbill', $data);
    }
    	
	public function delete_multiple($text){
		$qry = "select * from sales where sales_id in(".str_replace("_",",",$text).") ";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			$this->sales->delete($item['type'], $item['sales_id']);
		}
		$response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Deleted Successfully.'
            );
			echo json_encode($response);
	}
 
    public function bill($id, $size, $is_download = 'view')
    {
        $qry = "update sales set printtype = 1 where printtype  = 0 " ;
        $this->db->query($qry);
        $this->generateBill($id, $size, $is_download);
		if($this->session->userdata('login_base_comid') == 'vismaya'){
			$this->generateBill($id, $size, $is_download);
		}
    }
    public function bill_multiple($text)
    {
        $qry = "update sales set printtype = 1 where printtype  = 0 " ;
        $this->db->query($qry);
		$paper = 'A4';
        $is_download = 'view';
        $qry = "select * from sales as a  where a.sales_id in(" . str_replace("_", ",", $text) . ") ";
        $query = $this->db->query($qry)->result_array();
        if((float) $query[0]['printtype'] < 1){
            $query[0]['printtype'] = 1;
        }
        $qry ='SELECT * FROM set_billtype WHERE id = '. $query[0]['bill_type'];
        $billdata = $this->db->query($qry)->row_array();
        $query[0]['printtype'] = $billdata['print_type'];
        
        $bill_format = $this->sales->getformat($query[0]['printtype']);
        $pdf_type = $bill_format['pdf_type'];
        if ($pdf_type == "Mpdf") {
            $this->load->library('M_pdf');
            $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
            $this->m_pdf->load();
            $pdf = $this->m_pdf->pdf;
            if ($bill_format['language'] == 'Arabic') {
                $this->lang->load('ac_site', 'ac');
                $this->language = "ac";
            } else {
                $this->lang->load('en_site', 'en');
                $this->language = "en";
            }
            if ($this->language == 'ac') {
                $pdf->SetDirectionality('rtl');
            }
        } else {
            $this->load->library('Pdf');
            if(strtolower($this->session->userdata('login_base_comid') == 'asekar' )){
                $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
            }else{
                $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
            }
            
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetCreator(PDF_CREATOR);
            $com = $this->sales->getCompany();
            $pdf->SetAuthor($com['name']);
            $pdf->SetTitle($com['name']);
            $pdf->SetSubject($com['name']);
            $img_file = base_url() . 'assets/images/Desert.jpg';
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->SetMargins(5, 0, 5, 0);
            $pdf->SetAutoPageBreak(TRUE, 0);
        }
        foreach ($query as $item) {
            $id = $item['sales_id'];
            $qry = "SELECT sum(ces_amt) as ces,sum(quantity) as qty FROM `sales_items` WHERE published ='yes' and sales_id = " . $id;
            $query = $this->db->query($qry)->row_array();
            $xqty =  $query['qty'];
            $qty = $query['qty'];
            $qty = (float) $qty /2 ;
            $qty = ceil($qty);
            if($item['type'] =='sales'){
                $item['printtype'] = 1;
            }
            if((float) $item['printtype'] < 1){
                $item['printtype'] = 1;
            }
            $size = $item['printtype'];
            $bill_format = $this->sales->getformat($size);
            $format = $bill_format['code'];
            $size = $bill_format['pagesize'];
            $size_half = $size;
            if (isset($bill_format['half_pagesize'])) {
                if ((int) $bill_format['half_pagesize'] > 0) {
                    $size_half = $bill_format['half_pagesize'];
                }
            }
            $orient = $bill_format['page'];
            $paper = $bill_format['paper'];
            $pdf_type = $bill_format['pdf_type'];
            $print_settings  = '[{"Field":"item_name","Field_name":"item_name","Isvisible":"YES","display_as":"Item","width":"120px"},{"Field":"item_barcode","Field_name":"item_barcode","Isvisible":"YES","display_as":"Barcode","width":"40px"},{"Field":"hsn_code","Field_name":"hsn_code","Isvisible":"NO","display_as":"HSN","width":"40px"},{"Field":"item_quantity","Field_name":"item_quantity","Isvisible":"YES","display_as":"Quantity","width":"40px"},{"Field":"MRP","Field_name":"MRP","Isvisible":"NO","display_as":"MRP","width":"40px"},{"Field":"Rate","Field_name":"Rate","Isvisible":"YES","display_as":"Rate","width":"40px"},{"Field":"discount","Field_name":"discount","Isvisible":"NO","display_as":"Discount","width":"40px"},{"Field":"beforetax","Field_name":"beforetax","Isvisible":"NO","display_as":"Amount","width":"40px"},{"Field":"taxpercentage","Field_name":"taxpercentage","Isvisible":"NO","display_as":"GST %","width":"40px"},{"Field":"SGST","Field_name":"SGST","Isvisible":"YES","display_as":"SGST","width":"40px"},{"Field":"CGST","Field_name":"CGST","Isvisible":"YES","display_as":"CGST","width":"40px"},{"Field":"item_cess","Field_name":"item_cess","Isvisible":"YES","display_as":"Item Cess","width":"40px"},{"Field":"Total","Field_name":"Total","Isvisible":"YES","display_as":"Total","width":"40px"}]';
            $footer_settings = '[{"Field":"Before_Tax","Isvisible":"YES","display_as":"Before Tax"},{"Field":"SGST","Isvisible":"YES","display_as":"SGST"},{"Field":"CGST","Isvisible":"YES","display_as":"CGST"},{"Field":"Total_tax","Isvisible":"YES","display_as":"Tax"},{"Field":"Item_cess","Isvisible":"YES","display_as":"Item Cess"},{"Field":"KFC","Isvisible":"YES","display_as":"KFC"},{"Field":"Bill_discount","Isvisible":"YES","display_as":"Bill Discount"},{"Field":"Bill_total","Isvisible":"YES","display_as":"Bill Total"},{"Field":"Terms","Isvisible":"YES","display_as":"Terms"},{"Field":"Bank_details","Isvisible":"YES","display_as":"Bank Details"}]';
            if (isset($bill_format['print_settings'])) {
                $print_settings = $bill_format['print_settings'];
                $footer_settings = $bill_format['footer_settings'];
            }
            $img_file = base_url() . 'assets/images/Desert.jpg';
            $sale = $this->sales->getSales($id);
            if ($sale[0]['paper_size'] != 'full') {
                $size = $size_half;
            }


            $amt = 0;
            if ($sale[0]['cusid'] > 0) {
                $ledb = $this->sales->ledbalid($sale[0]['cusid']);
                if ($ledb['id'] != "") {
                    $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
                }
            }
            if ($amt < 0) {
                $amt = round(($amt * -1), 2);
            } else {
                $amt = $amt;
            }

            $previous = $amt;


            // if ($amt < 0) {
            //     $amt = round(($amt * -1), 2);
            // } else {
            //     $amt = $amt;
            // }
            // $previous = $amt;
            // if ($sale[0]['cash_type'] == 'Credit') {
            //     if($sale[0]['stype'] != 'estimate'){
            //         if($sale[0]['stype'] == 'sales'){
            //             $previous = $amt - $sale[0]['total'];
            //         }else{
            //              $previous = $amt + $sale[0]['total'];
            //         }
            //     }
            // }




            if ($sale[0]['cash_type'] == 'Credit') {
                $previous = $amt - $sale[0]['total'];
            }
            $sale[0]['paper'] = $bill_format['paper'];
            $sale[0]['pending'] = $amt;
            $amt = $amt;
            $sale[0]['gtot'] = $amt;
            $sale[0]['qty'] = $xqty;
            $sale[0]['previous'] = $previous;
            $tcnt = $this->sales->getSalesItemscnt($id);
            $hcnt = $this->sales->getHsnItemscnt($id);
            $papersiize = $this->sales->getValue('paper');
            $hsn = $this->sales->getHsnItems($id);
            $hsndetails = $this->sales->getHsndetails($id);
            $gst = $this->sales->getgstItems($id);
            $taxparticulars = $this->sales->gettaxparticulars($id);
            $sales_ledgers = $this->sales->getsales_ledgers($id);

            if ($papersiize == '[65, 5000]') {
                $size = $tcnt;
            }
            if ($papersiize == 'A4') {
                if ($size == 'half') {
                    $size = 8;
                }
                if ($size == 'full') {
                    $size = 40;
                }
            }
            $inc = number_format(($tcnt) / $size, 2);
            $page = explode(".", $inc);
            $mode = (int) $page[1];
            $inc = (int) $page[0];
            if ($mode > 0) {
                $inc = $inc + 1;
            }
            if ($inc == 0) {
                $inc = $inc + 1;
            }
            $pri_type = 'Customer Copy';
            for ($q = 0; $q < 1; $q++) {
                if ($q > 0) {
                    $pri_type = 'Duplicate';
                }
                for ($i = 0; $i < $inc; $i++) {
                    $len = $size * $i;
                    $list = $this->sales->getSalesItems($id, $len, $size);
                    $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings);
                }
            }
        }
        $pdf->Output('example_021.pdf', 'I');
    }

    function generateEway($id)
    {
        $val =  $this->sales->generateEway($id);
        print_r($val);
    }

    function generateDirectEway($id)
    {
        $val =  $this->sales->generateDirectEway($id);
        print_r($val);
    }


    function generateEInvoice($id)
    {
        $val = $this->sales->generate_EInvoice($id);
        echo $val;
    }


    private function generateBill($id, $size, $is_download = 'view')
    {
        $settings = $this->sales->getCompanySettings();
        $cig_cess_txt = ',0 as cig_ces_per_amount,0 as cig_ces_amt';
        $is_cigarette_cess = 0 ;
        if(isset($settings[0]['is_cigarette_cess']) ){
            $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
        }
        if($is_cigarette_cess > 0 ){
            $cig_cess_txt = ",sum(cig_ces_per_amount) as cig_ces_per_amount,sum(cig_ces_amt) as cig_ces_amt ";
        }
		$qry = "select IFNULL(sum(amount),0) as amt from sales_ledgers where published ='yes' and sales_id = ".$id." ";
		$add_amount = $this->db->query($qry)->row_array();
		$add_amount = $add_amount['amt'];
        $qry = "SELECT sum(ces_amt) as ces,sum(quantity) as qty,sum(dis_amt) as itemdis$cig_cess_txt FROM `sales_items` WHERE published ='yes' and sales_id = " . $id;
        $query = $this->db->query($qry)->row_array();
        $cig_ces_per_amount = $query['cig_ces_per_amount'];
        $cig_ces_amt = $query['cig_ces_amt'];
        $qty = $query['qty'];
        $itemdis = $query['itemdis'];
        $bill_kfc = $query['ces'];
        $bill_format = $this->sales->getformat($size);
        $format = $bill_format['code'];
        $size = $bill_format['pagesize'];
        $size_half = $size;
        $qry = "select AckNo, irn from e_invoice where sales_id = ".$id." and status > 0 ";
        $e_invoice_data = $this->db->query($qry);
        if($e_invoice_data->num_rows() > 0 ){
            $size =  $size - 8;
            $size_half = $size;
        }
        if (isset($bill_format['half_pagesize'])) {
            if ((int) $bill_format['half_pagesize'] > 0) {
                $size_half = $bill_format['half_pagesize'];
            }
        }
        $orient = $bill_format['page'];
        $paper = $bill_format['paper'];
        $pdf_type = $bill_format['pdf_type'];
        $print_settings  = '[{"Field":"item_name","Field_name":"item_name","Isvisible":"YES","display_as":"Item","width":"120px"},{"Field":"item_barcode","Field_name":"item_barcode","Isvisible":"YES","display_as":"Barcode","width":"40px"},{"Field":"hsn_code","Field_name":"hsn_code","Isvisible":"NO","display_as":"HSN","width":"40px"},{"Field":"item_quantity","Field_name":"item_quantity","Isvisible":"YES","display_as":"Quantity","width":"40px"},{"Field":"MRP","Field_name":"MRP","Isvisible":"NO","display_as":"MRP","width":"40px"},{"Field":"Rate","Field_name":"Rate","Isvisible":"YES","display_as":"Rate","width":"40px"},{"Field":"discount","Field_name":"discount","Isvisible":"NO","display_as":"Discount","width":"40px"},{"Field":"beforetax","Field_name":"beforetax","Isvisible":"NO","display_as":"Amount","width":"40px"},{"Field":"taxpercentage","Field_name":"taxpercentage","Isvisible":"NO","display_as":"GST %","width":"40px"},{"Field":"SGST","Field_name":"SGST","Isvisible":"YES","display_as":"SGST","width":"40px"},{"Field":"CGST","Field_name":"CGST","Isvisible":"YES","display_as":"CGST","width":"40px"},{"Field":"item_cess","Field_name":"item_cess","Isvisible":"YES","display_as":"Item Cess","width":"40px"},{"Field":"Total","Field_name":"Total","Isvisible":"YES","display_as":"Total","width":"40px"}]';
        $footer_settings = '[{"Field":"Before_Tax","Isvisible":"YES","display_as":"Before Tax"},{"Field":"SGST","Isvisible":"YES","display_as":"SGST"},{"Field":"CGST","Isvisible":"YES","display_as":"CGST"},{"Field":"Total_tax","Isvisible":"YES","display_as":"Tax"},{"Field":"Item_cess","Isvisible":"YES","display_as":"Item Cess"},{"Field":"KFC","Isvisible":"YES","display_as":"KFC"},{"Field":"Bill_discount","Isvisible":"YES","display_as":"Bill Discount"},{"Field":"Bill_total","Isvisible":"YES","display_as":"Bill Total"},{"Field":"Terms","Isvisible":"YES","display_as":"Terms"},{"Field":"Bank_details","Isvisible":"YES","display_as":"Bank Details"}]';
        if (isset($bill_format['print_settings'])) {
            $print_settings = $bill_format['print_settings'];
            $footer_settings = $bill_format['footer_settings'];
        }
        $img_file = base_url() . 'assets/images/Desert.jpg';
        $sale = $this->sales->getSales($id);
        $sale[0]['bill_kfc'] = 0;
        $sale[0]['qty'] = $qty;
        if ($sale[0]['saletype'] == 'b2c') {
            $sale[0]['bill_kfc'] = $bill_kfc;
        }
        if ($sale[0]['paper_size'] != 'full') {
            $size = $size_half;
        }
        if ($pdf_type == "Mpdf") {
            $this->load->library('M_pdf');
            $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
            $this->m_pdf->load();
            $pdf = $this->m_pdf->pdf;
            if ($bill_format['language'] == 'Arabic') {
                $this->lang->load('ac_site', 'ac');
                $this->language = "ac";
            } else {
                $this->lang->load('en_site', 'en');
                $this->language = "en";
            }
            if ($this->language == 'ac') {
                $pdf->SetDirectionality('rtl');
            }
        } else {
            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', $paper, false, 'UTF-8', false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetCreator(PDF_CREATOR);
            $com = $this->sales->getCompany();
            $pdf->SetAuthor($com['name']);
            $pdf->SetTitle($com['name']);
            $pdf->SetSubject($com['name']);
            $img_file = base_url() . 'assets/images/Desert.jpg';
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->SetMargins(5, 0, 5, 0);
            $pdf->SetAutoPageBreak(TRUE, 0);
        }

        $amt = 0;
        $bf = 0 ;
        if ($sale[0]['cusid'] > 0) {
            $ledb = $this->sales->ledbalid($sale[0]['cusid']);
            if ($ledb['id'] != "") {
                $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
            }

         //   $qry = 'select sum(total) as bf from sales where type ="sales" and published ="yes" and cash_type = "Credit"  and invoice_date = "'.$sale[0]['invoice_date'].'" and sales_id < '.$sale[0]['sales_id'].' and customer_id = '.$sale[0]['customer_id'].'  ';
          //  $bf_data = $this->db->query($qry)->row_array();
           // $bf = $bf_data['bf'];

        }
        if ($amt < 0) {
            $amt = round(($amt * -1), 2);
        } else {
            $amt = $amt;
        }
        $amt = (float) $amt + (float) $bf;
        $previous = $amt;
        if ($sale[0]['cash_type'] == 'Credit') {
            $previous = $amt - $sale[0]['total'];
        }
        $sale[0]['itemdis'] = $itemdis;
		$sale[0]['add_amount'] = $add_amount;
        $sale[0]['paper'] = $bill_format['paper'];
        $sale[0]['pending'] = $amt;
        $amt = $amt;
        $sale[0]['gtot'] = $amt;
        $sale[0]['previous'] = $previous;
        $tcnt = $this->sales->getSalesItemscnt($id);
        // $hcnt = $this->sales->getHsnItemscnt($id);
        $papersiize = $this->sales->getValue('paper');
        $hsn = $this->sales->getHsnItems($id);
        $hsndetails = $this->sales->getHsndetails($id);
        $gst = $this->sales->getgstItems($id);
        $taxparticulars = $this->sales->gettaxparticulars($id);
        $sales_ledgers = $this->sales->getsales_ledgers($id);

        if ($papersiize == '[65, 5000]') {
            $size = $tcnt;
        }
        if ($papersiize == 'A4') {
            if ($size == 'half') {
                $size = 8;
            }
            if ($size == 'full') {
                $size = 40;
            }
        }
		if($sale[0]['stype'] == 'estimate' && $format == 'raj'){
			$size = $size + 12;
		}
        $inc = number_format(($tcnt) / $size, 2);
        $page = explode(".", $inc);
        $mode = (int) $page[1];
        $inc = (int) $page[0];
        if ($mode > 0) {
            $inc = $inc + 1;
        }
        if ($inc == 0) {
            $inc = $inc + 1;
        }
        $pri_type = 'Original';
		$cntl = 1;
		if($this->session->userdata('login_base_comid') == 'joish' && $sale[0]['stype'] != 'estimate' && $sale[0]['bill_type'] == 23 ){
			$cntl = 3;
		}
		$page_function  = 0;
        for ($q = 0; $q < $cntl; $q++) {
            if ($q > 0) {
                $pri_type = 'Duplicate';
            }
			if ($q > 1) {
                $pri_type = 'Triplicate';
            }
            for ($i = 0; $i < $inc; $i++) {
                $len = $size * $i;
                $list = $this->sales->getSalesItems($id, $len, $size);
                $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function,$cig_ces_per_amount,$cig_ces_amt);
				$page_function = $page_function + 1 ;
			}
        }
        if ($is_download == 'download') { 
            $pdf->Output($sale[0]['invoice'] . '.pdf', 'D');
        }else if ($is_download == 'qz') {
            $pdf_string = $pdf->Output('', 'S');
            $response = array('valid' => true, 'data' => base64_encode($pdf_string));
            echo json_encode($response);
        }else {
            $pdf->Output('example_021.pdf', 'I');
        }
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function = 1,$cig_ces_per_amount =0 ,$cig_ces_amt =0)
    {
        if (count($list) != 0 || count($list) == 0) {
            $sale_previous= 0;
            $sale_outstand = 0;
            $sale[0]['sale_previous'] = $sale_previous;
            $sale[0]['sale_outstand'] = $sale_outstand;
            $balnew = 0;
            $balold = 0 ;
            // if($sale[0]['customer_id']> 0 ){
            //     $res = $this->sales->getLedgers($sale[0]['customer_id'], '', ' in ("cus","sup")');
            //     $customerLedgerid = $res['id'];
            //     $qry = "SELECT SUM(IFNULL(al.tran_debit,0)) - SUM(IFNULL(al.tran_credit,0)) + case when a.`type`='Cr' then a.openning_bal * -1 ELSE a.openning_bal END  as bal FROM (select id,ref_code,ref_id,type,openning_bal  from acc_ledgers where id =".$customerLedgerid.") AS a  left join  (select  published,ledger_id,tran_debit,tran_credit,tran_date  from  acc_ledger_trans where published ='yes' and ledger_id  =".$customerLedgerid." ) al ON  al.published = 'yes' AND al.tran_date < '".$sale[0]['invoice_date']."'  and ledger_id = a.id WHERE a.ref_id = ".$sale[0]['customer_id']." and a.ref_code in ('cus','sup') ";
            //     $qry_previous = $this->db->query($qry)->row_array();
            //     $bal = $qry_previous['bal'];

                
            //     $sale[0]['f_balance'] = $bal ;
            //     $balold = $bal ;
            //      $qry = "SELECT SUM(tran_debit) - SUM(tran_credit)  AS bal FROM (select tb_id,tb_name, published,ledger_id,tran_debit,tran_credit,tran_date  from  acc_ledger_trans where published ='yes' and ledger_id  =".$customerLedgerid." ) AS a INNER JOIN (select id,ref_code,ref_id,type,openning_bal  from acc_ledgers where id =".$customerLedgerid.") AS b ON a.ledger_id = b.id  WHERE a.published ='yes' AND ref_id =".$sale[0]['customer_id']." AND tran_date = '".$sale[0]['invoice_date']."' and tb_name != 'sales' and tb_name != 'sales_return' ";
            //     $qry_prev = $this->db->query($qry)->row_array();
            //     $balnew = $qry_prev['bal'];

            //     $sale[0]['rec_balance'] = $balnew ;
            //     $bal = $bal + $balnew;
            //     $sale[0]['rec_balance_plus'] = $bal ;

            //   //  $qry = 'select sum(case when type = "sales" then total else total * -1 end) as bf from sales where type in ("sales","sales_return") and published ="yes" and cash_type = "Credit"  and invoice_date = "'.$sale[0]['invoice_date'].'" and sales_id < '.$sale[0]['sales_id'].'  and customer_id = '.$sale[0]['customer_id'].' ';
            //     $qry = "SELECT SUM(tran_debit) - SUM(tran_credit)  AS bf FROM (select tb_id,tb_name, published,ledger_id,tran_debit,tran_credit,tran_date  from  acc_ledger_trans where published ='yes' and ledger_id  =".$customerLedgerid." ) AS a INNER JOIN (select id,ref_code,ref_id,type,openning_bal  from acc_ledgers where id =".$customerLedgerid.") AS b ON a.ledger_id = b.id  WHERE a.published ='yes' AND ref_id =".$sale[0]['customer_id']." AND tran_date = '".$sale[0]['invoice_date']."' and (tb_name = 'sales' or tb_name = 'sales_return') and tb_id < ".$sale[0]['sales_id'];
            //     $bf_data = $this->db->query($qry)->row_array();
            //     $bf = $bf_data['bf'];
            //     //$bf = 0 ;
            //     $sale[0]['bf'] = $bf ;
            //     $sale_previous= $bal + $bf ;
            //     $sale[0]['rec_balance_final'] = $sale_previous ;
            //     $sale_outstand = $bal + $bf ;
            //     if($sale[0]['cash_type'] == 'Credit'){
            //         if($sale[0]['stype'] == 'sales_return'){
            //             $sale_outstand = $sale_outstand - $sale[0]['total'];
            //         }else{
            //             $sale_outstand = $sale_outstand + $sale[0]['total'];
            //         }
            //      }

            //     if($sale[0]['cash_type'] == 'COB' || $sale[0]['cash_type'] == 'Ca_Cr' || $sale[0]['cash_type'] == 'Ba_Cr' || $sale[0]['cash_type'] == 'Ba_Ca_Cr' || $sale[0]['cash_type'] == 'COB'){
            //         $salet = $sale[0]['total'] -  $sale[0]['bank_amount'] -  $sale[0]['cash_amount'];
            //         if($sale[0]['stype'] == 'sales_return'){
            //             $sale_outstand = $sale_outstand - $salet;
            //         }else{
            //             $sale_outstand = $sale_outstand + $salet;
            //         }
            //      }
            //     $sale[0]['sale_previous'] = $sale_previous;
            //     $sale[0]['sale_outstand'] = $sale_outstand;
            //     if($sale[0]['cash_type'] == 'Credit'){
            //         if($sale[0]['stype'] == 'sales'){
            //             $sale[0]['sale_previous'] = $sale_previous;
            //            // $sale_previous = $sale_previous - $sale[0]['total'];
            //          if(strtolower($this->session->userdata('login_base_comid') == 'palack' )){
            //             //print_r($balold );exit;
            //         }
            //             // if($balnew < 0){
            //             //     $balnew  = $balnew  * -1;
            //             // }
            //            if($balnew >  ($balold + $bf )){
            //                // $sale[0]['sale_previous'] = $sale_previous * -1;
            //            }
            //             $sale[0]['sale_outstand'] = $sale_outstand;
            //         }
            //         if($sale[0]['stype'] == 'sales_return'){
            //            // $sale_previous = $sale_previous + $sale[0]['total'];
            //             $sale[0]['sale_previous'] = $sale_previous;
            //         //       if($balnew < 0){
            //         //         $balnew  = $balnew  * -1;
            //         //     }
            //         //    if(!$balnew >  ($balold + $bf )){
            //         //         $sale_outstand = $sale_outstand * -1;
            //         //    }
            //             $sale[0]['sale_outstand'] = $sale_outstand;
            //         }
            //     }
            // }
           
            if ($sale[0]['customer_id'] > 0) {

    /* Get customer ledger */
    $res = $this->sales->getLedgers(
        $sale[0]['customer_id'],
        '',
        ' in ("cus","sup")'
    );
    $ledgerId = $res['id'];

    /* Single optimized query */
    $sql = "
        SELECT
            l.type,
            l.openning_bal,

            SUM(
                CASE 
                    WHEN t.tran_date < ? 
                    THEN IFNULL(t.tran_debit,0) - IFNULL(t.tran_credit,0)
                    ELSE 0 
                END
            ) AS bal_before,

            SUM(
                CASE 
                    WHEN t.tran_date = ?
                     AND t.tb_name NOT IN ('sales','sales_return')
                    THEN IFNULL(t.tran_debit,0) - IFNULL(t.tran_credit,0)
                    ELSE 0
                END
            ) AS rec_bal,

            SUM(
                CASE 
                    WHEN t.tran_date = ?
                     AND t.tb_name IN ('sales','sales_return')
                     AND t.tb_id < ?
                    THEN IFNULL(t.tran_debit,0) - IFNULL(t.tran_credit,0)
                    ELSE 0
                END
            ) AS bf

        FROM acc_ledgers l
        LEFT JOIN acc_ledger_trans t
            ON t.ledger_id = l.id
           AND t.published = 'yes'
        WHERE l.id = ?
          AND l.ref_id = ?
          AND l.ref_code IN ('cus','sup')
        GROUP BY l.id
    ";

    $row = $this->db->query($sql, [
        $sale[0]['invoice_date'],
        $sale[0]['invoice_date'],
        $sale[0]['invoice_date'],
        $sale[0]['sales_id'],
        $ledgerId,
        $sale[0]['customer_id']
    ])->row_array();

    /* Opening balance adjustment */
    $opening = ($row['type'] == 'Cr')
        ? $row['openning_bal'] * -1
        : $row['openning_bal'];

    /* Previous balance */
    $balold = $opening + $row['bal_before'];
    $sale[0]['f_balance'] = $balold;

    /* Receipt balance */
    $balnew = $row['rec_bal'];
    $sale[0]['rec_balance'] = $balnew;

    $bal = $balold + $balnew;
    $sale[0]['rec_balance_plus'] = $bal;

    /* BF */
    $bf = $row['bf'];
    $sale[0]['bf'] = $bf;

    /* Sale previous */
    $sale_previous = $bal + $bf;
    $sale[0]['sale_previous'] = $sale_previous;

    /* Outstanding calculation */
    $sale_outstand = $sale_previous;

    if ($sale[0]['cash_type'] == 'Credit') {
        $sale_outstand += ($sale[0]['stype'] == 'sales_return')
            ? -$sale[0]['total']
            :  $sale[0]['total'];
    }

    if (in_array($sale[0]['cash_type'], ['COB','Ca_Cr','Ba_Cr','Ba_Ca_Cr'])) {
        $salet = $sale[0]['total']
               - $sale[0]['bank_amount']
               - $sale[0]['cash_amount'];

        $sale_outstand += ($sale[0]['stype'] == 'sales_return')
            ? -$salet
            :  $salet;
    }

    $sale[0]['sale_outstand'] = $sale_outstand;
}

            
            $qry = "select AckNo, irn from e_invoice where sales_id = ".$sale[0]['sales_id']." and status > 0 ";
            $e_invoice_data = $this->db->query($qry);
            if($e_invoice_data->num_rows() > 0 ){
                $e_invoice_data= $e_invoice_data->row_array();
                $sale[0]['einvoiceirn'] = $e_invoice_data['irn'];
                $sale[0]['AckNo'] = $e_invoice_data['AckNo'];

            }

            $papersiize = $sale[0]['paper'];
            $paperorient = $this->sales->getValue('paperorient');
            if ($orient != 'L') {
                $orient =  $paperorient;
            }
			
            if(strtolower($this->session->userdata('login_base_comid') == 'asekar' )){
                $orient = 'P';
            }
            $pdf->AddPage($orient, $papersiize);
            //$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            // $pdf->AddPage($paperorient, $papersiize);
            //$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            $img_file2 = base_url() . 'assets/images/15371797581022381971536753.png';
            $data['msd'] = $this->Show_Amount_In_Words(round($sale[0]['total'], 0));
            //$data['msd_ac'] = $this->Show_Amount_In_Words($sale[0]['total'],'ac');
            //$data['msd_ac'] = Tafqeet::arablic($sale[0]['total']);
			$data['page_function']= $page_function;
            $data['sales'] = $sale;
            $data['taxparticulars'] = $taxparticulars;
            $data['sales_ledgers'] = $sales_ledgers;
            $data['size'] = $size;
            $data['cig_ces_per_amount']  =$cig_ces_per_amount;
            $data['cig_ces_amt'] = $cig_ces_amt;
            $data['pri_type'] = $pri_type;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            $data['hsndetails'] = $hsndetails;
            $data['gst'] = $gst;
            $data['inc'] = $inc;
            $data['cpz'] = $i;
            if ($pdf_type == 'Mpdf') {
                $pdf->SetDefaultBodyCSS('background', "url('" . base_url() . "assets/images/thumbnail_IMG-20200919-WA0009.jpg')");
                $pdf->SetDefaultBodyCSS('background-image-resize', 6);
            }
            if ($sale[0]['pub'] == 'no') {
                $img_file = base_url() . 'assets/images/cancelled.png';
                $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
            }
            $data['footer_settings'] = json_decode($footer_settings);
            $data['print_settings'] = json_decode($print_settings);
            $data['sales_items'] = $list;
            $data['company'] = $this->sales->getCompany();
            if (isset($data['company']['watermark'])) {
                $pdf->SetWatermarkImage(base_url() . 'assets/images/watermark.jpg', 0.02, [210, 180], [0, 0]);
                $pdf->showWatermarkImage = true;
            }
            if(strtolower($this->session->userdata('login_base_comid')) == 'acs' ){
                $pdf->SetWatermarkImage(base_url() . 'uploads/company/acswatermark.jpg', 0.1, [210, 180], [0, 0]);
                $pdf->showWatermarkImage = true;
            }
			
			$qry = "SELECT sum(ifnull(b.tax,0)) as tax,a.GST,sum(IFNULL(b.total,0)-IFNULL(b.tax,0)-IFNULL(CASE WHEN sale.cess > 0 then b.ces_amt else 0 end,0) -IFNULL(itm_raw_ces,0)) as total,sum(itm_raw_ces ) as ces_amt from taxgst as a left join (select * from sales_items where sales_id = ".$sale[0]['sales_id'].") as b on a.gstid = b.tax_id and b.published ='yes' and b.sales_id=".$sale[0]['sales_id']." left join (select * from  sales where sales_id =".$sale[0]['sales_id'].") as sale on sale.sales_id = b.sales_id where 1 GROUP by a.gstid order by a.gst asc";
			$data['new_taxparticulars'] = $this->db->query($qry)->result_array();
		

            $qry = "select * from e_way where sales_id = ".$sale[0]['sales_id']." and status > 0 ";
            $e_way_data = $this->db->query($qry);
			$data['e_way_data'] = $e_way_data;


            $qry = "select * from e_invoice where sales_id = ".$sale[0]['sales_id']." and status > 0 ";
            $e_invoice_data = $this->db->query($qry);
			$data['e_invoice_data'] = $e_invoice_data;
            if($e_invoice_data->num_rows() > 0 ){
                $e_invoice_data= $e_invoice_data->row_array();
                if($e_invoice_data['SignedQrCode'] != '' && $e_invoice_data['SignedQrCode'] != 'NULL' ){
                    if($sale[0]['einvoiceqrcode'] =='' ){
                        $this->load->library('ciqrcode');
                        $qr_image = rand() . '.png';
                        $params['data'] = $e_invoice_data['SignedQrCode'];
                        $params['level'] = 'H';
                        $params['size'] = 8;
                        $params['savename'] = FCPATH . "uploads/" . $qr_image;
                        if ($this->ciqrcode->generate($params)) {
                            $qry = "update sales set einvoiceqrcode ='".$qr_image."' where sales_id =  ".$sale[0]['sales_id'];
                            $this->db->query($qry);
                            $sale[0]['einvoiceqrcode'] = $qr_image;
                        }else{
                            print_r('error');exit;
                        }
                    }
                }
            }
            if(strtolower($this->session->userdata('login_base_comid')) == 'pushpa' ){

                $data['taxableamountinwords'] = $this->numberTowords($sale[0]['tax']);
            }
            
            $settings = $this->sales->getCompanySettings();
            $data['settings'] = $settings;
            $Is_SQFT = 0 ;
            if(isset($settings[0]['Is_SQFT']) ){
                $Is_SQFT = $settings[0]['Is_SQFT'];
            
            }
            if($Is_SQFT > 0 ){
                $qry ="SELECT sum(case when b.SQFTNO = 0 then quantity ELSE SQFTNO end) AS SQFTNO,Sum(b.ItemSQFT * SQFTNO) AS ItemSQFT FROM sales_items AS b WHERE b.published ='yes' and sales_id = ".$sale[0]['sales_id'];
                $sqft = $this->db->query($qry)->row_array();
                $data['sqft'] = $sqft;
            }
            //$this->load->view('transaction/sales/bill1', $data);       
            $html = $this->load->view('transaction/sales/' . $format, $data, true);
			$repeat_bill = 0 ;
			if(isset($settings[0]['repeat_bill']) ){
				$repeat_bill = $settings[0]['repeat_bill'];
			}
			if((float)$repeat_bill > 0  ){
				$html = $this->load->view('transaction/sales/disha_header', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishabody1', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishabody2', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishafooter', $data, true);
			}
            $pdf->writeHTML($html);
        }
    }


 function numberTowords($num) {
    $ones = array(
        0 => "ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN" // you probably meant this to be 14, double check if needed
    );
    $tens = array( 
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY", 
        4 => "FORTY", 
        5 => "FIFTY", 
        6 => "SIXTY", 
        7 => "SEVENTY", 
        8 => "EIGHTY", 
        9 => "NINETY"
    ); 
    $hundreds = array( 
        "HUNDRED", 
        "THOUSAND", 
        "MILLION", 
        "BILLION", 
        "TRILLION", 
        "QUARDRILLION"
    ); /*limit to quadrillion*/

    $num = number_format($num, 2, ".", ",");
    $num_arr = explode(".", $num);
    $wholenum = $num_arr[0];
    $decnum = $num_arr[1];
    $whole_arr = array_reverse(explode(",", $wholenum));
    krsort($whole_arr, 1);
    $rettxt = "";

    foreach ($whole_arr as $key => $i) {
        while (substr($i, 0, 1) == "0") {
            $i = substr($i, 1, 5);
        }

        if ($i < 20) {
            // Ensure $i is a valid index in $ones
            if (isset($ones[$i])) {
                $rettxt .= $ones[$i];
            } else {
                $rettxt .= "Invalid number"; // handle invalid cases if necessary
            }
        } elseif ($i < 100) {
            if (substr($i, 0, 1) != "0") {
                $rettxt .= $tens[substr($i, 0, 1)];
            }
            if (substr($i, 1, 1) != "0") {
                $rettxt .= " " . $ones[substr($i, 1, 1)];
            }
        } else {
            if (substr($i, 0, 1) != "0") {
                $rettxt .= $ones[substr($i, 0, 1)] . " " . $hundreds[0];
            }
            if (substr($i, 1, 1) != "0") {
                $rettxt .= " " . $tens[substr($i, 1, 1)];
            }
            if (substr($i, 2, 1) != "0") {
                $rettxt .= " " . $ones[substr($i, 2, 1)];
            }
        }

        if ($key > 0) {
            $rettxt .= " " . $hundreds[$key] . " ";
        }
    }

    $rettxt = strtolower($rettxt) . ' Rupees';
    if ($decnum > 0) {
        $rettxt .= " and ";
        if ($decnum < 20) {
            $decnum = (int) $decnum;
            $rettxt .= $ones[$decnum];
        } elseif ($decnum < 100) {
            $rettxt .= strtolower($tens[substr($decnum, 0, 1)]);
            $rettxt .= " " . strtolower($ones[substr($decnum, 1, 1)]) . ' paise';
        }
    }
    return $rettxt;
}

}


