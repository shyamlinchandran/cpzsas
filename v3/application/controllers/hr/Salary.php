<?php

class Salary extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Salary_model', 'Salary');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salary/list');
    }
    
    
    public function getsing($id) {
        return $this->Salary->getsing($id);
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salary/create', $data);
    }

    public function save() {
        $insert_id = $this->Salary->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Salary->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->component_name;
            $row[] = $items->component_type;
            $row[] = $items->basic_amount;
            $act = ' <a  back="' . base_url() . 'hr/Salary/list_all"  href="' . base_url() . 'hr/Salary/create/' . $items->component_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/Salary/list_all' . '"  success="Delete ' . $items->component_name . ' successfuly "  message="Do you want Delete ' . $items->component_name . '?"  href="' . base_url() . 'hr/Salary/delete/' . $items->component_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/Salary/list_all"  href="' . base_url() . 'hr/Salary/view/' . $items->component_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Salary->count_all(),
            "recordsFiltered" => $this->Salary->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
