<?php

class Leavetype extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Leavetype_model', 'Leavetype');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leavetype/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leavetype/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leavetype/create', $data);
    }

    public function getsing($id) {
        $this->Leavetype->getsing($id);
    }

    public function delete($leave_id) {
        $this->Leavetype->delete($leave_id);
    }

    public function save() {
        $insert_id = $this->Leavetype->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Leavetype->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->leave_name;
            $row[] = $items->leave_days;
            $act = ' <a  back="' . base_url() . 'hr/leavetype/list_all"  href="' . base_url() . 'hr/Leavetype/Create/' . $items->leave_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/leavetype/list_all' . '"  success="Delete ' . $items->leave_name . ' successfuly "  message="Do you want Delete ' . $items->leave_name . '?"  href="' . base_url() . 'hr/leavetype/delete/' . $items->leave_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/leavetype/list_all"  href="' . base_url() . 'hr/leavetype/view/' . $items->leave_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Leavetype->count_all(),
            "recordsFiltered" => $this->Leavetype->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
