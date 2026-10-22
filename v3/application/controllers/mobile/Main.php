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
        $this->load->model('mobile_model', 'mobile');
    }

    public function sales($sales_id = 0 ){
        $data['title'] = 'Sales Order';
        $data['sales_id'] = $sales_id;
        $tmp = $this->session->userdata('user'); 
        $created_by = $tmp['Id'];
        $qry = "select user_settings.default_sorder_billtype from user_settings where user_id = ".$created_by;
        $data_user = $this->db->query($qry)->row_array();
        $billtype = $data_user['default_sorder_billtype'];
        $invoice_no = $this->mobile->getinoviceno($billtype);
        $data['invoice_no'] = $invoice_no;
        $settings = $this->mobile->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/lte_layout/header_mobile',$data);
		$this->load->view('mobile/index',$data);
    }


    public function receipt($id = 0 ){
        $data['title'] = 'Receipt';
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $qry = "select user_settings.default_rec_billtype from user_settings where user_id = ".$created_by;
        $data_user = $this->db->query($qry)->row_array();
        $billtype = $data_user['default_rec_billtype'];
        $data['id'] = $id;
        $invoice_no = $this->mobile->getrecinoviceno($billtype);
        $data['invoice_no'] = $invoice_no;
        $settings = $this->mobile->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/lte_layout/header_mobile',$data);
		$this->load->view('mobile/receipt',$data);
        
    }

    public function Orderlist(){
        $data['title'] = 'Sales Order List';
        $settings = $this->mobile->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/lte_layout/header_mobile',$data);
		$this->load->view('mobile/listorder');
    }

    public function order_list(){
        $this->mobile->where();
        $list = $this->mobile->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->invoice_date;
            $row[] = $item->invoice;
            $row[] = $item->cusname;
            $row[] = $item->total;
            $row[] = $item->status;
            $act = '';
            if($item->status =='pending'){
                $act = ' <a style ="font-size:10px;height:20px;width:30px;padding:0px;margin-bottom:5px;padding-top:2px;"   back="' . base_url() . 'mobile/main/orderlist"  href="' . base_url() . 'mobile/main/sales/' . $item->sales_id . '" data-toggle="tooltip" title="edit" class="btn btn-success "><span>Edit</span></a>';
                $act  = $act .'&nbsp;&nbsp;&nbsp;<button sales_id = ' . $item->sales_id . ' type="button" style ="font-size:10px;height:20px;width:60px;padding:0px;margin:0px;padding-top:2px;"  id ="cancelbutton" class ="btn btn-warning btn-cancel-sales">Cancel</button> ';
                
            }else{
                //$row[] = '';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mobile->count_all(),
            "recordsFiltered" => $this->mobile->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function voucherlist(){
        $data['title'] = 'Recipt List';
        $settings = $this->mobile->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/lte_layout/header_mobile',$data);
		$this->load->view('mobile/listvoucher');
    }
    public function voucher_list(){
        $this->mobile->voucherslist();
        $list = $this->mobile->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->tran_date;
			if ($vouchers->vourcher_type == "receipt") {
                $row[] = $vouchers->created_date;
            }
            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->invoice;
            } else {
                $row[] = $vouchers->voucher_no;
            }
			$row[] = str_replace(',', '<br/>', $vouchers->names);

            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->naration;
            }
            $row[] = str_replace(';', '<br/>', $vouchers->credit_amounnts);
            $row[] = str_replace(';', '<br/>', $vouchers->debit_amounts);
            $act =  ' <a href="' . base_url() . 'mobile/Main/receipt/' . $vouchers->v_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success">EDIT</a>';
			if((float) $vouchers->sales_ref_id < 1){	
			}

          

            if ($vouchers->pub == 'yes') {
				
                $row[] = $act; //$vouchers->naration;
            } else {
                $row[] =''; //$vouchers->naration;
            }
			
			
			
			
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mobile->count_all(),
            "recordsFiltered" => $this->mobile->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    
    
	
    public function getitembyId($item_id,$customer) {
        return $this->mobile->getitembyId($item_id,$customer);
    }
	


	public function itemssearch($item_category_id = 0, $customer = 0) {
        $search = strtolower($_GET['term']);
        $brand_id = isset($_GET['brand_id']) ? $_GET['brand_id'] : 0;
        return $this->mobile->itemssearch($search, $item_category_id, $customer, $brand_id);
    }
	

	public function savereceipt(){
		$insert_id = $this->mobile->savereceipt();
		$printtype =1;
        redirect(base_url().'mobile/Main/receipt');
	}


	public function save(){
		$insert_id = $this->mobile->save();
		$printtype =1;
        redirect(base_url().'mobile/Main/sales');
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
