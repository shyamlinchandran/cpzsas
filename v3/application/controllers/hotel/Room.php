<?php

class Room extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hotel/Room_model', 'Room');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/room/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/room/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/room/create', $data);
    }

    public function getsing($id) {
        $this->Room->getsing($id);
    }

    public function delete($id) {
        $this->Room->delete($id);
    }

    public function save() {
        $insert_id = $this->Room->save();
    }

    public function tax() {
        return $this->Room->tax();
    }

    public function room_category() {
        return $this->Room->room_category();
    }

    public function roomtype($id=0) {
        return $this->Room->roomtype($id);
    }

    public function room_floor($id=0) {
        return $this->Room->room_floor($id);
    }

    public function hotel_room_rate($id) {
        return $this->Room->hotel_room_rate($id);
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Room->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->room_name;
            $row[] = $items->room_description;
            $row[] = $items->room_floor;
            $row[] = $items->room_max_num;
            $row[] = $items->room_category;
            $act = ' <a  back="' . base_url() . 'hotel/room/list_all"  href="' . base_url() . 'hotel/room/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hotel/room/list_all' . '"  success="Delete ' . $items->id . ' successfuly "  message="Do you want Delete ' . $items->room_name . '?"  href="' . base_url() . 'hotel/room/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hotel/room/list_all"  href="' . base_url() . 'hotel/room/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Room->count_all(),
            "recordsFiltered" => $this->Room->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
