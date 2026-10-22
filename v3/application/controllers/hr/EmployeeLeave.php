<?php

class EmployeeLeave extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/EmployeeLeave_model', 'leave');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leave/list');
    }

    
        
    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leave/create', $data);
    }

    public function leavetype() {
        return $this->leave->leavetype();
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/leave/create', $data);
    }

    public function getsing($id) {
        $this->leave->getsing($id);
    }

    public function delete($id) {
        $this->leave->delete($id);
    }

    public function save() {
        $insert_id = $this->leave->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->leave->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pro_fname;
            $row[] = $items->leave_name;
            $row[] = $items->fromdate;
            $row[] = $items->todate;
            $row[] = $items->no_of_days;
            $act = ' <a  back="' . base_url() . 'hr/EmployeeLeave/list_all"  href="' . base_url() . 'hr/EmployeeLeave/create/' . $items->emp_leave_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/EmployeeLeave/list_all' . '"  success="Delete ' . $items->pro_fname . ' successfuly "  message="Do you want Delete ' . $items->pro_fname . '?"  href="' . base_url() . 'hr/EmployeeLeave/delete/' . $items->emp_leave_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/EmployeeLeave/list_all"  href="' . base_url() . 'hr/EmployeeLeave/view/' . $items->emp_leave_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->leave->count_all(),
            "recordsFiltered" => $this->leave->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
