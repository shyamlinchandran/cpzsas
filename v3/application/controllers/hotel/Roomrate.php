<?php

class Roomrate extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hotel/Roomrate_model', 'Roomrate');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomrate/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomrate/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roomrate/create', $data);
    }

    public function getsing($id) {
        $this->Roomrate->getsing($id);
    }

    public function delete($id) {
        $this->Roomrate->delete($id);
    }

    public function save() {
        $insert_id = $this->Roomrate->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Roomrate->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->rate_amount;
            $row[] = $items->room_extrabed;
            $act = ' <a  back="' . base_url() . 'hotel/roomrate/list_all"  href="' . base_url() . 'hotel/roomrate/edit/' . $items->room_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hotel/roomrate/list_all' . '"  success="Delete ' . $items->rate_amount . ' successfuly "  message="Do you want Delete ' . $items->rate_amount . '?"  href="' . base_url() . 'hotel/roomrate/delete/' . $items->room_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hotel/roomrate/list_all"  href="' . base_url() . 'hotel/roomrate/view/' . $items->room_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Roomrate->count_all(),
            "recordsFiltered" => $this->Roomrate->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
