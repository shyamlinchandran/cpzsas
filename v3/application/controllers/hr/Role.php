<?php

class Role extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Role_model', 'Role');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/role/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/role/create', $data);
    }

    public function view($role_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $role_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/role/create', $data);
    }

    public function getsing($id) {
        $this->Role->getsing($id);
    }

    public function delete($role_id) {
        $this->Role->delete($role_id);
    }

    public function save() {
        $insert_id = $this->Role->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Role->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->role_name;
            $row[] = $items->role_description;
            $act = ' <a  back="' . base_url() . 'hr/role/list_all"  href="' . base_url() . 'hr/Role/create/' . $items->role_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/role/list_all' . '"  success="Delete ' . $items->role_name . ' successfuly "  message="Do you want Delete ' . $items->role_name . '?"  href="' . base_url() . 'hr/role/delete/' . $items->role_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/role/list_all"  href="' . base_url() . 'hr/role/view/' . $items->role_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Role->count_all(),
            "recordsFiltered" => $this->Role->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
