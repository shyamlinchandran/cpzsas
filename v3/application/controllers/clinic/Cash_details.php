<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Cash_details extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/cash_model', 'cash');
    }

    public function listall() {
        $data['title'] = 'cash report';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/cash/list_all',$data);
    }
  
    public function ajax_list() {
        $this->cash->where();
        $list = $this->cash->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        $total = $ctotal = 0;
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->Bok_Id;
            $row[] = $item->Pat_Name;
            $row[] = $item->Pat_Phone;
            $row[] = $item->Bok_Date;
            if($item->Bok_Cashtype=="Cash")
            {
                
                $row[] = $item->Bok_Amount;
                $row[] = '';
                $total=$total+$item->Bok_Amount;
            }
            else
            {
                $row[] = '';
                $row[] = $item->Bok_Amount;
                $ctotal = $ctotal+$item->Bok_Amount;
            }
            $row[] = $item->Bok_Cashtype;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total ';
        $row[] = $total;
        $row[] = $ctotal;
        $row[] = '';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->cash->count_all(),
            "recordsFiltered" => $this->cash->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function customer_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->tin;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] = $item->address_line1;
            
                  $act = '&nbsp;<a tp="confirm" base="' . base_url() . '/suppliers/customers/'.'"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'suppliers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
   
}
