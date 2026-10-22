<?php

class Holidays extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Holidays_model', 'Holidays');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/holidays/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/holidays/create', $data);
    }

    public function view($holi_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $holi_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/Holidays/create', $data);
    }

    public function getsing($id) {
        $this->Holidays->getsing($id);
    }

    public function delete($holi_id) {
        $this->Holidays->delete($holi_id);
    }

    public function save() {
        $insert_id = $this->Holidays->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Holidays->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->holi_name;
            $row[] = $items->start;
            $row[] = $items->end;
            $act = ' <a  back="' . base_url() . 'hr/holidays/list_all"  href="' . base_url() . 'hr/Holidays/create/' . $items->holi_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/holidays/list_all' . '"  success="Delete ' . $items->holi_name . ' successfuly "  message="Do you want Delete ' . $items->holi_name . '?"  href="' . base_url() . 'hr/Holidays/delete/' . $items->holi_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/holidays/list_all"  href="' . base_url() . 'hr/Holidays/view/' . $items->holi_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Holidays->count_all(),
            "recordsFiltered" => $this->Holidays->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
