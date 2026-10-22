<?php

class Vehicledetails extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('vehicle/Vehicledetails_model', 'Vehicledetails');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/vehicledetails/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/vehicledetails/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/vehicledetails/create', $data);
    }

    public function getsing($id) {
        $this->Vehicledetails->getsing($id);
    }

    public function delete($id) {
        $this->Vehicledetails->delete($id);
    }

    public function save() {
        $insert_id = $this->Vehicledetails->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Vehicledetails->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->veh_number;
            $row[] = $items->veh_type;
            $row[] = $items->veh_regdate;
            $row[] = $items->veh_expdate;
            $act = ' <a  back="' . base_url() . 'vehicle/vehicledetails/list_all"  href="' . base_url() . 'vehicle/Vehicledetails/edit/' . $items->veh_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/vehicle/vehicledetails/list_all' . '"  success="Delete ' . $items->veh_number . ' successfuly "  message="Do you want Delete ' . $items->veh_number . '?"  href="' . base_url() . 'vehicle/vehicledetails/delete/' . $items->veh_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'vehicle/vehicledetails/list_all"  href="' . base_url() . 'vehicle/vehicledetails/view/' . $items->veh_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Vehicledetails->count_all(),
            "recordsFiltered" => $this->Vehicledetails->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
