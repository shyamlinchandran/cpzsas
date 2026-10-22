<?php

class Bloodgroup extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Bloodgroup_model', 'Bloodgroup');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/bloodgroup/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/bloodgroup/create', $data);
    }

    public function view($blood_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $blood_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/bloodgroup/create', $data);
    }

    public function getsing($id) {
        $this->Bloodgroup->getsing($id);
    }

    public function delete($blood_id) {
        $this->Bloodgroup->delete($blood_id);
    }

    public function save() {
        $insert_id = $this->Bloodgroup->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Bloodgroup->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->blood_name;
            $row[] = $items->blood_description;
            $act = ' <a  back="' . base_url() . 'hr/bloodgroup/list_all"  href="' . base_url() . 'hr/Bloodgroup/create/' . $items->blood_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/bloodgroup/list_all' . '"  success="Delete ' . $items->blood_name . ' successfuly "  message="Do you want Delete ' . $items->blood_name . '?"  href="' . base_url() . 'hr/bloodgroup/delete/' . $items->blood_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/bloodgroup/list_all"  href="' . base_url() . 'hr/bloodgroup/view/' . $items->blood_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Bloodgroup->count_all(),
            "recordsFiltered" => $this->Bloodgroup->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
