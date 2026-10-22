<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Patients extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/patients_model', 'item');
        $this->config->load('config');
    }

    public function updatestatus() {
        $this->item->updatestatus();
    }

    public function listall() {
        $data['title'] = 'Patients';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/patients/list_all', $data);
    }

    public function calendar() {
        $this->load->view('_blocks/subpages/create');
       // $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/patients/calendar');
    }

    function create($id = '0') {
        $this->load->view('_blocks/subpages/create');
        //$settings = $this->item->getCompanySettings();
        //$states = $this->item->states();
        //$data['states'] = $states;
        $data['id'] = $id;
        $data['title'] = 'Patient';
        $data['view'] = "create";
        $this->load->view('clinic/patients/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    public function bloodgroup() {
        return $this->item->bloodgroup();
    }

    public function relationship() {
        return $this->item->relationship();
    }

    function getrelations($id) {
        $this->item->getrelations($id);
        // echo json_encode($result);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Patient';
        $data['view'] = "edit";

        $this->load->view('clinic/patients/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Patient';
        $data['view'] = "view";
        $data['details'] = $this->item->pattimeline($id);
        $data['patient'] = $this->item->patientdtls($id);
        $data['relative'] = $this->item->patrelative($id);
        $this->load->view('clinic/patients/view', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function ajax_list() {
        //$this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->Pat_Name;
            $row[] = $item->Pat_Phone;
            $row[] = $item->Pat_Email;
            $act = '<a base="' . base_url() . '/clinic/patients/listall/' . '" href="' . base_url() . 'clinic/patients/edit/' . $item->Pat_Id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info " base="' . base_url() . '/clinic/patients/listall/' . '" href="' . base_url() . 'clinic/patients/view/' . $item->Pat_Id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/clinic/patients/listall/' . '"  success="Delete ' . $item->Pat_Name . ' successfuly "  message="Do you want Delete ' . $item->Pat_Name . '?"  href="' . base_url() . 'clinic/patients/delete/' . $item->Pat_Id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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

    function save() {
        $this->item->save();
    }

}
