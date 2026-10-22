<?php

class Roomtype extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hotel/Roomtype_model', 'Roomtype');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomtype/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomtype/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomtype/create', $data);
    }

    public function getsing($id) {
        $this->Roomtype->getsing($id);
    }

    public function delete($id) {
        $this->Roomtype->delete($id);
    }

    public function save() {
        $insert_id = $this->Roomtype->save();
    }

    public function floor() {
        return $this->Roomtype->floor();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Roomtype->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->type_name;
            $act = ' <a  back="' . base_url() . 'hotel/roomtype/list_all"  href="' . base_url() . 'hotel/roomtype/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hotel/roomtype/list_all' . '"  success="Delete ' . $items->type_name . ' successfuly "  message="Do you want Delete ' . $items->type_name . '?"  href="' . base_url() . 'hotel/roomtype/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hotel/roomtype/list_all"  href="' . base_url() . 'hotel/roomtype/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Roomtype->count_all(),
            "recordsFiltered" => $this->Roomtype->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
