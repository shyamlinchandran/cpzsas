<?php

class Department extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Department_model', 'Department');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/department/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/department/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/department/create', $data);
    }

    public function getsing($id) {
        $this->Department->getsing($id);
    }

    public function delete($dept_id) {
        $this->Department->delete($dept_id);
    }

    public function save() {
        $insert_id = $this->Department->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Department->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->dept_name;
            $row[] = $items->dept_description;
            $act = ' <a  back="' . base_url() . 'hr/department/list_all"  href="' . base_url() . 'hr/Department/create/' . $items->dept_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/department/list_all' . '"  success="Delete ' . $items->dept_name . ' successfuly "  message="Do you want Delete ' . $items->dept_name . '?"  href="' . base_url() . 'hr/department/delete/' . $items->dept_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/department/list_all"  href="' . base_url() . 'hr/department/view/' . $items->dept_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Department->count_all(),
            "recordsFiltered" => $this->Department->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
