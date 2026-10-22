<?php

class Designation extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Designation_model', 'Designation');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/designation/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/designation/create', $data);
    }

    public function view($desig_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $desig_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/designation/create', $data);
    }

    public function getsing($id) {
        $this->Designation->getsing($id);
    }

    public function delete($desig_id) {
        $this->Designation->delete($desig_id);
    }

    public function save() {
        $insert_id = $this->Designation->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Designation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->desig_name;
            $row[] = $items->desig_description;
            $act = ' <a  back="' . base_url() . 'hr/designation/list_all"  href="' . base_url() . 'hr/Designation/create/' . $items->desig_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/designation/list_all' . '"  success="Delete ' . $items->desig_name . ' successfuly "  message="Do you want Delete ' . $items->desig_name . '?"  href="' . base_url() . 'hr/designation/delete/' . $items->desig_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/designation/list_all"  href="' . base_url() . 'hr/designation/view/' . $items->desig_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Designation->count_all(),
            "recordsFiltered" => $this->Designation->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
