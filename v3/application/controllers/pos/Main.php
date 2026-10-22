<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of main
 *
 * @author jijodileep
 */
class Main extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('items_model', 'item');
        $this->load->model('Pos_model', 'pos');
    }

    public function pos_register(){
        $qry = "select * from set_billtype where is_pos = 1 and transaction='sales'";
        $query = $this->db->query($qry)->result_array();
        $data['billtypes']  = $query;
		$data['type'] = 'sales';
		$data['title'] = 'Pos Register';
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('pos/pos_register', $data);
    }
    
	
	public function list_pos(){
		$qry = "select * from set_billtype where is_pos = 1 and transaction='sales'";
		$query = $this->db->query($qry)->result_array();
		$data['billtypes']  = $query;
		$data['type'] = 'sales';
		$data['title'] = 'Pos Invoice';
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('pos/list_pos', $data);
	}
	
	public function list_counter(){
		$data['title'] = 'Pos Counters';
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('pos/list_counter', $data);
	}
	
	public function create_counter($id =0 ){
		$qry = "select * from set_billtype where is_pos = 1 and transaction='sales'";
		$query = $this->db->query($qry)->result_array();
		$data['billtypes']  = $query;
		$data['id'] = $id;
		$data['title'] = 'Pos Counters';
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('pos/create_counter', $data);
	}
	
	public function save_counter_trans(){
		$insert_id = $this->pos->save_counter_trans();
		$response = array(
            'valid' => false,
			'id'=>$insert_id,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
		if((int) $insert_id < 1){
			$response['message'] = 'Already Logged in as another User';
		}
        echo json_encode($response);
	}
	public function counters() {
        return $this->pos->counters();
    }

	
	public function pendinglist(){
		$data['title'] = 'Complete Counter Transaction';
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
		$this->load->view('pos/pendinglist', $data);
	}
	
	public function complete($id){
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$data['settings_id'] = $id;
		$tmp = $this->session->userdata('user');
		$userid = $tmp['Id'];
		$data['userId'] = $userid;
		$data['userName'] = $tmp['user_name'];
		$qry = "select * from counter_trans as a inner join counter as b on a.counter_id=b.id where a.id='".$id."' " ;
		$query = $this->db->query($qry)->row_array();
		$qry = "SELECT COUNT(sales_id) as cnt,sum(total) as total,sum(cash_amount) as cash,sum(bank_amount) as bank FROM `sales` WHERE created_date >= '".$query['login_time']."' and bill_type ='".$query['bill_type']."' ";
		$data['result'] = $this->db->query($qry)->row_array();
		$this->load->view('_blocks/subpages/create');
		$this->load->view('_blocks/subpages/list');
		$this->load->view('pos/possettings',$data);
	}
	
	public function create_pos($id = 0) {
		date_default_timezone_set("Asia/Calcutta");   //India time (GMT+5:30)
		$tmp = $this->session->userdata('user');
		$data['settings_id'] = 0;
        $userid = $tmp['Id'];
		$data['userId'] = $userid ;
		$data['userName'] = $tmp['user_name'];
		$data['id'] = $id;
		$qry = "select * from counter_trans where user_id= ".$userid." and trans_date ='".date("Y-m-d")."' and status='0' limit 0,1";
		$query = $this->db->query($qry);
		$data['details'] = $query->row_array();
		if($query->num_rows()>0){
			$this->load->view('_blocks/subpages/create');
			$this->load->view('_blocks/subpages/list');
			$this->load->view('pos/sales',$data);
		}else{
			$this->load->view('_blocks/subpages/create');
			$this->load->view('_blocks/subpages/list');
			$this->load->view('pos/possettings',$data);
		}
		
        
    }

    public function listall($id = 0) {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('pos/sales',$data);
    }
    
    public function getsalesdata($id = 0){
        $saledata[0]['GST'] = 18;
        $saledata[0]['MRP'] = 0;
        $saledata[0]['disc'] = 0;
        $saledata[0]['id'] = 1;
        $saledata[0]['index'] = 1;
        $saledata[0]['name'] = 'Name';
        $saledata[0]['qty'] = 1;
        $saledata[0]['rowtotal'] = 200.175;
        $saledata[0]['srate'] = 169.640;
        $saledata[0]['tax_id'] = 2;
        $saledata[0]['tax_total'] = 30.53;
        $qry ="SELECT card_no,cusname,cusdetails,cusemail,bank_amount,cash_type,cash_amount, a.sales_id,0 as  `index`,d.GST,c.MRP,b.dis_amt as disc,c.name,c.id,b.quantity as qty,b.total as rowtotal,b.mrp as srate,b.tax_id,b.tax as tax_total from sales as a INNER JOIN sales_items as b on a.sales_id = b.sales_id and b.published = 'yes' INNER JOIN item as c on c.id = b.item_id INNER JOIN taxgst as d on d.gstid = b.tax_id WHERE a.sales_id = ".$id;
        $saledata = $this->db->query($qry)->result_array();
        $len = sizeof($saledata);
        for($i = 0;$i<$len;$i++){
            $saledata[$i]['qty'] = (float)$saledata[$i]['qty'];
            $saledata[$i]['index'] = $i + 1 ;
        }
        print_r(json_encode($saledata));
    }
	public function save_counter(){
		$insert_id = $this->pos->save_counter();
		$response = array(
            'valid' => false,
			'id'=>$insert_id,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
	
	public function save(){
		$insert_id = $this->pos->save();
		$printtype =4;
		$response = array(
            'valid' => false,
			'id'=>$insert_id,
			'bill' => base_url() . 'transaction/sales/bill/' . $insert_id . '/' . $printtype,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
	
	public function getpending($id){
		$this->pos->getpending($id);
	}
	
	public function getsing($id){
		$this->pos->getsing($id);
	}
	
	public function pending_list(){
        $data = array();
		$this->pos->getpendinglist();
		$list = $this->pos->get_datatables();
        $no = $this->input->post('start');
		foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->trans_date;
            $row[] = $vouchers->name;
            $row[] = $vouchers->opening_balance;
            $row[] = $vouchers->closing_balance;
            $act = ' <a href="' . base_url() . 'pos/Main/complete/' . $vouchers->id . '" data-toggle="tooltip" title="Edit" class="btn btn-success">Complete</a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function pos_list(){
		$this->pos->getpos();
        $max = $this->pos->max();
        $max_id = $max['max_id'];
        $list = $this->pos->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->in_date;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->total;

            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    public function pos_ajax_list()
    {
        $is_location = 0;
        $settings = $this->pos->getCompanySettings();
        if (isset($settings[0]['is_location'])) {
            $is_location = $settings[0]['is_location'];
        }
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $user_type  = $tmp['user_type'];
        $this->pos->where_register();
        $max = $this->pos->max();
        $max_id = $max['max_id'];
        $this->pos->pos_register();
        $list = $this->pos->get_datatables();
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
            $row = array();
            $row[] = $chk_assign . $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->ref_no;
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
            if ($vouchers->is_assigned  < 1 && $vouchers->refs < 1 ) {
                $act = $act . ' <a href="' . base_url() . 'pos/main/listall/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success sale_edit"><span class="glyphicon glyphicon-edit"></span></a>';
            } else {
                if ($vouchers->salesman == $userid && $vouchers->refs < 1 ) {
                    $act = $act . ' <a href="' . base_url() . 'pos/main/listall/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success sale_edit"><span class="glyphicon glyphicon-edit"></span></a>';
                }
            }
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
            }
            if ($vouchers->is_assigned < 1 && $vouchers->stype == 'estimate') {
                $act .= ' <a  ' . $vouchers->type . ' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="' . $vouchers->invoice . '" assign_id = "' . $vouchers->sales_id . '" data-target="#myAssignModal">Assign</span></a>';
            } else if ((int) $user_type < 2 && $vouchers->stype == 'estimate') {
                $act .= ' <a  ' . $vouchers->type . ' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="' . $vouchers->invoice . '" assign_id = "' . $vouchers->sales_id . '" data-target="#myAssignModal">ReAssign</span></a>';
            }
            if ($vouchers->stype == 'delivery_note' && $vouchers->status != 'completed' && $vouchers->pub == 'yes') {
                $act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/sales/0/no/' . $vouchers->sales_id . '-delivery_note" data-toggle="tooltip" title="Edit" class="btn btn-success">Add Sales</span></a>';
            }
            if ($vouchers->stype == 'estimate' && $vouchers->status != 'completed' && $vouchers->pub == 'yes') {
                $act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/sales/0/no/' . $vouchers->sales_id . '-estimate" data-toggle="tooltip" title="Edit" class="btn btn-success">Add Sales</span></a>';
            }
            if ((float) $is_location > 0 && $latitude != '0.00') {
                $act = $act . ' <button id="location" longitude = "' . $vouchers->salelongitude . '" latitude = "' . $vouchers->salelatitude . '" class="btn btn-success location" type="button" name="set_iframe" id="set_iframe" title = "Location" ><span class="fa fa-map-marker"></span></button>';
            }
            $act = $act . '  <button  sales_id = "'. $vouchers->sales_id.'"  role="button" id="excell_add" name="excell_add" tp="new" target="_blank" class="excell_add btn  btn-success align-bottom" href="#" title = "E-Way Info"><span class="glyphicon glyphicon-download"></button>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pos->count_all_sales(),
            "recordsFiltered" => $this->pos->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	public function ajax_list(){
		$this->pos->where();
        $list = $this->pos->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = $vouchers->billtype;
            $act = ' <a href="' . base_url() . 'pos/Main/create_counter/' . $vouchers->id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

    public function getProducts($search = '') {
        $data['products'] = $this->item->getproductslist($search);
        $data['categories'] = $this->item->ItemsCategory();
        echo json_encode($data);
    }
     public function getProductsbc($search = '') {
        $data['products'] = $this->item->getproductslistbc($search);
        $data['categories'] = $this->item->ItemsCategory();
        echo json_encode($data);
    }

    public function getcustomer($search = '') {
        $data['customerdata'] = $this->pos->getcustomerdata($search);
        echo json_encode($data);
    }
     public function getitems($id) {
        $data['products'] = $this->item->getitems($id); 
        echo json_encode($data);
    }

    public function getsubactegory($id) {
        $data['subcategories'] = $this->item->ItemsSubCategory($id);
        echo json_encode($data);
    }

}
