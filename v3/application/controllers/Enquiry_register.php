<?php

class Enquiry_register extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('Enquiryregister_model', 'Enquiry_register');
    }

    public function listall($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_register/create', $data);
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_register/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_register/create', $data);
    }

    public function create_followup($id) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_followup/create', $data);
    }

    public function create_closure($id) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_closure/create', $data);
    }

    public function view($id) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('enquiry_register/create', $data);
    }

    function edit($id) {
        $data['type'] = 'edit';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('enquiry_register/create', $data);
    }

    public function getsing($id) {
        $this->Enquiry_register->getsing($id);
    }

    function delete($id) {
        $qry = "delete from  enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    public function save() {
        $insert_id = $this->Enquiry_register->save();
    }

    public function save_allocation() {
        $this->Enquiry_register->save_allocation();
    }

    public function save_followup() {
        $this->Enquiry_register->save_followup();
    }

    public function save_closure() {
        $this->Enquiry_register->save_closure();
    }

    function closure_request($id) {
        $qry = "update   enquiry_register set status=3 where id =" . $id;
        $this->db->query($qry);
    }

    public function user() {
        $this->Enquiry_register->user();
    }

    public function company() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->company($search);
    }

    public function product() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->product($search);
    }

    public function ajax_list() {
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_register->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = $items->companyName;
            $row[] = $items->contactPerson;
            $row[] = $items->contactNumber;
            $row[] = $items->location;
            $act = ' <a  back="' . base_url() . 'Enquiry_register/list_all"  href="' . base_url() . 'Enquiry_register/edit/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/Enquiry_register/list_all' . '"  success="Delete ' . $items->companyName . ' successfully "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'Enquiry_register/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'Enquiry_register/list_all"  href="' . base_url() . 'Enquiry_register/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
//            $act .= ' <a  back="' . base_url() . 'Enquiry_register/list_all"  data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->id . '"    class="btn btn-primary test"  data-toggle="modal" data-target="#myEnquiryModal">Allocation</span></a>';
            $act .= ' <a  back="' . base_url() . 'Enquiry_register/list_all"  href="' . base_url() . 'Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/Enquiry_register/list_all' . '"  success="Closure Requested' . $items->companyName . ' successfull y "  message="Closure Request' . $items->companyName . '?"  href="' . base_url() . 'Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning request" data-toggle="modal" data-target="#myFollowupModal">Closure Request</span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_register->count_all(),
            "recordsFiltered" => $this->Enquiry_register->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}

