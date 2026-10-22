<?php

class Course extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Course_model', 'Course');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/course/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/course/create', $data);
    }

    public function view($course_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $course_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/course/create', $data);
    }

    public function getsing($id) {
        $this->Course->getsing($id);
    }

    public function delete($course_id) {
        $this->Course->delete($course_id);
    }

    public function save() {
        $insert_id = $this->Course->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Course->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->course_name;
            $act = ' <a  back="' . base_url() . 'hr/course/list_all"  href="' . base_url() . 'hr/Course/create/' . $items->course_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/course/list_all' . '"  success="Delete ' . $items->course_name . ' successfuly "  message="Do you want Delete ' . $items->course_name . '?"  href="' . base_url() . 'hr/course/delete/' . $items->course_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/course/list_all"  href="' . base_url() . 'hr/course/view/' . $items->course_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Course->count_all(),
            "recordsFiltered" => $this->Course->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
