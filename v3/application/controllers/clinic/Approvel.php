<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Approvel extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Booking_model', 'Booking');
    }

    public function listall() {
        $data['title'] = 'Approvel';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/approvel/list_all',$data);
    }
    function create() {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['title'] = 'Approvel';
        $data['view'] = "create";
        $this->load->view('clinic/approvel/create', $data);
    }
     function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Approvel';
        $data['view'] = "create";
        $this->load->view('clinic/approvel/create', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Approvel';
        $data['view'] = "view";
        $this->load->view('clinic/approvel/create', $data);
    }
    public function delete($id){
        $this->Booking->deleteapp($id);
    }
    public function save(){
        $this->Booking->approve();
    }
    
    function getsing($id) {
        $this->Booking->getsing($id);
    }
    public function ajax_list() {
        $this->Booking->where();
        $list = $this->Booking->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->Bok_Id;
            $row[] = $item->Pat_Name;
            $row[] = $item->Pat_Phone;
            $row[] = $item->Bok_Date;
            $row[] = $item->Bok_Approved;
            $act = '<a  href="' . base_url() . 'clinic/approvel/edit/'.$item->Bok_Id . '" title="Approve" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'clinic/approvel/view/' . $item->Bok_Id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/clinic/approvel/listall/'.'"  success="Delete ' . $item->Pat_Name . ' successfuly "  message="Do you want Delete ' . $item->Pat_Name . '?"  href="' . base_url() . 'clinic/approvel/delete/' . $item->Bok_Id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Booking->count_all(),
            "recordsFiltered" => $this->Booking->count_filtered(),
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
            $act = '<a  href="' . base_url() . 'suppliers/editcust/'.$item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'suppliers/viewcust/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/suppliers/customers/'.'"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'suppliers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
