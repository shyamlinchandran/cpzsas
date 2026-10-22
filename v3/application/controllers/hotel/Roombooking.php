<?php

class Roombooking extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hotel/Roombooking_model', 'Roombooking');
    }

    public function list_all() {
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roombooking/list');
    }

    public function getrooms() {
        $search = $_GET['term'];
        return $this->Roombooking->getrooms($search);
    }

    public function create($id = 0, $type = 'booking') {
        $data['type'] = 'create';
        $data['title'] = 'Room Booking';
        $data['status'] = $type;
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roombooking/create', $data);
    }

    public function checkin($id = 0, $type = 'check') {
        $data['type'] = 'create';
        $data['title'] = 'Room Checkins';
        $data['status'] = $type;
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roombooking/create', $data);
    }

    public function view($id = 0, $type = '') {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hotel/roombooking/create', $data);
    }

    public function book_details($id) {
        return $this->Roombooking->book_details($id);
    }

    public function getsing($id) {
        $this->Roombooking->getsing($id);
    }

    public function delete($id) {
        $this->Roombooking->delete($id);
    }

    function itemuploads($file, $fileid) {
        $config['upload_path'] = 'assets/images/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '1024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
        return;
    }

    public function save() {
        $image_a = "";
        $id_proof_a = "";
        if (isset($_FILES['image_a'])) {
            $file = $_FILES['image_a'];
            $fileid = 'image_a';
            $this->itemuploads($file, $fileid);
            $image_a = $_FILES['image_a']['name'];
        }
        if (isset($_FILES['id_proof_a'])) {
            $file = $_FILES['id_proof_a'];
            $fileid = 'id_proof_a';
            $this->itemuploads($file, $fileid);
            $id_proof_a = $_FILES['id_proof_a']['name'];
        }
        $insert_id = $this->Roombooking->save($image_a, $id_proof_a);
    }

    public function ajax_list() {
        $status = $this->input->post('status');
        if ($this->input->post('status') == "Created") {
            $status = 'booking';
        }
        if ($this->input->post('status') == "Checkin") {
            $status = 'check';
        }   

        $this->Roombooking->where();
        $list = $this->Roombooking->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->bok_start_date;
            $row[] = $items->name;
            $row[] = $items->bok_end_date;
            $row[] = $items->booking_amount;
            $row[] = $items->booking_advance;
            $act = ' <a  back="' . base_url() . 'hotel/roombooking/list_all"  href="' . base_url() . 'hotel/roombooking/create/' . $items->id . '/' . $status . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hotel/roombooking/list_all' . '"  success="Delete ' . $items->booking_date . ' successfuly "  message="Do you want Delete ' . $items->booking_date . '?"  href="' . base_url() . 'hotel/roombooking/delete/' . $items->customer_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hotel/roombooking/list_all"  href="' . base_url() . 'hotel/roombooking/view/' . $items->customer_id . '/' . $status . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            if ($this->input->post('status') == "Created") {
                $act = $act . ' <a  back="' . base_url() . 'hotel/roombooking/list_all"  href="' . base_url() . 'hotel/roombooking/create/' . $items->id . '/' . $items->booking_status . '" data-toggle="tooltip" title="edit" class="btn btn-info ">Checkin</span></a>';
            }
            if ($this->input->post('status') == "Checkin") {
                $act = $act . ' <a  back="' . base_url() . 'hotel/roombooking/list_all"  href="' . base_url() . 'hotel/roombooking/create/' . $items->id . '/' . $items->booking_status . '" data-toggle="tooltip" title="edit" class="btn btn-info ">Check Out</span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Roombooking->count_all(),
            "recordsFiltered" => $this->Roombooking->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
