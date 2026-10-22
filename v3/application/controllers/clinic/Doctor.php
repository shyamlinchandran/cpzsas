<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind   
 */
class Doctor extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Doctors_model', 'Doctor');
        //$this->config->load('config');
    }

    public function listall() {
        $data['title'] = 'My Patients';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/doctor/list_all', $data);
    }

    function create() {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['title'] = 'Approvel';
        $data['view'] = "create";
        $this->load->view('clinic/doctor/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Doctor';
        $data['view'] = "create";
        $isinventory = $this->Doctor->isinventory();
        $data['isinventory'] = $isinventory;
        $obsdate = $this->Doctor->Obsdate($id);
        $data['obsdate'] = $obsdate;
        $details = $this->Doctor->Details($id);
        $data['details'] = $details;
        $this->load->view('clinic/doctor/create', $data);
    }

    function calendar($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Doctor';
        $data['view'] = "calendar";
        $obsdate = $this->Doctor->Obsdate($id);
        $isinventory = $this->Doctor->isinventory();
        $data['isinventory'] = $isinventory;
        $data['obsdate'] = $obsdate;
        $details = $this->Doctor->Details($id);
        $data['details'] = $details;
        $this->load->view('clinic/doctor/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Doctor';
        $data['view'] = "view";
        $obsdate = $this->Doctor->Obsdate($id);
        $data['obsdate'] = $obsdate;
        $details = $this->Doctor->Details($id);
        $data['details'] = $details;
        $this->load->view('clinic/doctor/create', $data);
    }

    public function save() {
        $this->Doctor->approve();
    }

    function getsing($id) {
        $this->Doctor->getsing($id);
    }

    public function ajax_list() {
        $this->Doctor->where();
        $list = $this->Doctor->get_datatables();
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
            $act = '<a  href="' . base_url() . 'clinic/Doctor/edit/' . $item->Bok_Id . '" title="Check" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Doctor->count_all(),
            "recordsFiltered" => $this->Doctor->count_filtered(),
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
            $act = '<a  href="' . base_url() . 'suppliers/editcust/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'suppliers/viewcust/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/suppliers/customers/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'suppliers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
