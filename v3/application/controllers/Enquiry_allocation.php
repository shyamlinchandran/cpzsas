<?php

class Enquiry_allocation extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('Enquiryallocation_model', 'Enquiry_allocation');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_allocation/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_allocation/create', $data);
    }

//    public function create_followup($id) {
//        $data['type'] = 'create';
//        $data['id'] = $id;
//        $this->load->view('_blocks/subpages/create');
//        $this->load->view('_blocks/subpages/list');
//        $this->load->view('Enquiry_followup/create', $data);
//    }
//    public function create_closure($id) {
//        $data['type'] = 'create';
//        $data['id'] = $id;
//        $this->load->view('_blocks/subpages/create');
//        $this->load->view('_blocks/subpages/list');
//        $this->load->view('Enquiry_closure/create', $data);
//    }

    public function view($id) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_allocation/create', $data);
    }

    function edit($id) {
        $data['type'] = 'edit';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_allocation/create', $data);
    }

    public function getsing($id) {
        $this->Enquiry_allocation->getsing($id);
    }

    function delete($id) {
        $qry = "delete from  enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    public function save() {
        $insert_id = $this->Enquiry_allocation->save();
    }

    public function save_allocation() {
        $this->Enquiry_allocation->save_allocation();
    }

    public function save_followup() {
        $this->Enquiry_allocation->save_followup();
    }

    public function save_closure() {
        $this->Enquiry_allocation->save_closure();
    }

    public function save_product() {
        $this->enquiry_product->save_product();
    }

    public function user() {
        $this->Enquiry_allocation->user();
    }

    public function company() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_allocation->company($search);
    }

    public function product() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->product($search);
    }

    function otheritem($id) {
        $this->Enquiry_allocation->otheritem($id);
    }

    public function ajax_list() {
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_allocation->get_datatables();
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
            $act = ' <a  back="' . base_url() . 'Enquiry_allocation/list_all"  href="' . base_url() . 'Enquiry_allocation/edit/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/Enquiry_allocation/list_all' . '"  success="Delete ' . $items->companyName . ' successfuly "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'Enquiry_allocation/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'Enquiry_allocation/list_all"  href="' . base_url() . 'Enquiry_allocation/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act .= ' <a  back="' . base_url() . 'Enquiry_register/list_all"  data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->id . '"    class="btn btn-primary test"  data-toggle="modal" data-target="#myEnquiryModal">Allocation</span></a>';
            $act .= ' <a  back="' . base_url() . 'Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" data-target="#myFollowupModal">closure</span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_allocation->count_all(),
            "recordsFiltered" => $this->Enquiry_allocation->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
