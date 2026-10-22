<?php

class Floor extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hotel/Floor_model', 'Floor');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/floor/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/floor/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/Floor/create', $data);
    }

    public function getsing($id) {
        $this->Floor->getsing($id);
    }

    public function delete($id) {
        $this->Floor->delete($id);
    }

    public function save() {
        $insert_id = $this->Floor->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Floor->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->flr_name;
            $act = ' <a  back="' . base_url() . 'hotel/floor/list_all"  href="' . base_url() . 'hotel/floor/create/' . $items->flr_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hotel/floor/list_all' . '"  success="Delete ' . $items->flr_name . ' successfuly "  message="Do you want Delete ' . $items->flr_name . '?"  href="' . base_url() . 'hotel/floor/delete/' . $items->flr_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hotel/floor/list_all"  href="' . base_url() . 'hotel/floor/view/' . $items->flr_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Floor->count_all(),
            "recordsFiltered" => $this->Floor->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
