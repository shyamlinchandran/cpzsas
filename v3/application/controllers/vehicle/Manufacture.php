<?php

class Manufacture extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('vehicle/Manufacture_model', 'Manufacture');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/manufacture/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/manufacture/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/manufacture/create', $data);
    }

    public function getsing($id) {
        $this->Manufacture->getsing($id);
    }

    public function delete($id) {
        $this->Manufacture->delete($id);
    }

    public function save() {
        $insert_id = $this->Manufacture->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Manufacture->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->veh_name;
            $row[] = $items->veh_description;
            $act = ' <a  back="' . base_url() . 'vehicle/manufacture/list_all"  href="' . base_url() . 'vehicle/manufacture/edit/' . $items->veh_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/vehicle/manufacture/list_all' . '"  success="Delete ' . $items->veh_name . ' successfuly "  message="Do you want Delete ' . $items->veh_name . '?"  href="' . base_url() . 'vehicle/manufacture/delete/' . $items->veh_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'vehicle/manufacture/list_all"  href="' . base_url() . 'vehicle/manufacture/view/' . $items->veh_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Manufacture->count_all(),
            "recordsFiltered" => $this->Manufacture->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
