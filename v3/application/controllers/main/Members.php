<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of members
 *
 * @author u43255
 */
class Members extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('members_model', 'members');
        $this->load->model('membertypes_model', 'membertypes');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('main/members/index');
    }

    public function create() {
        $this->load->view('_blocks/subpages/create');
        $data['membertype'] = $this->membertypes->list_items();
        $data['membercategory'] = $this->members->getcategory();
        $this->load->view('main/members/create', $data);
    }

    public function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['membertype'] = $this->membertypes->list_items();
        $prm = $this->members->list_by_family($id);
        $data['membercategory'] = $this->members->getcategory();
        $data['details'] = $this->members->list_by_id($id);
        $data['family'] = $this->members->list_by_family($id);
        $this->load->view('main/members/edit', $data);
    }

    public function delete($id) {
        $data['membertype'] = $this->membertypes->list_items();
        $this->load->view('main/members/create', $data);
    } 

    public function ajax_list() {
        $list = $this->members->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $members) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $members->name;
            $row[] = $members->email;
            $row[] = $members->phone;
            $row[] = $members->address_line1;
            $row[] = '<a class="btn btn-sm btn-primary" href="' . base_url() . 'main/members/edit/' . $members->id . '" title="Edit" data-toggle="tooltip"><i class="glyphicon glyphicon-pencil"></i></a>
                  <a class="btn btn-sm btn-danger" href="' . base_url() . 'main/members/delete/' . $members->id . '" title="Delete"  data-toggle="tooltip"><i class="glyphicon glyphicon-trash"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->members->count_all(),
            "recordsFiltered" => $this->members->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $save = $this->members->saveall();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function phone() {
        $response = array(
            'valid' => false,
            'message' => 'Post argument "phone" is missing.'
        );
        $phone = $this->input->post('phone');
        $id = $this->input->post('id');
        if (isset($phone)) {
            $phone = $this->members->count($phone, 'phone', $id);
            if ($phone != 0) {
                // User name is registered on another account
                $response = array('valid' => false, 'message' => 'This phone is already registered.');
            } else {
                // User name is available
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

    public function email() {
        $response = array(
            'valid' => false,
            'message' => 'Post argument email is missing.'
        );
        $email = $this->input->post('email');
        $id = $this->input->post('id');

        if (isset($email)) {
            $email = $this->members->count($email, 'email', $id);
            if ($email != 0) {
                // User name is registered on another account
                $response = array('valid' => false, 'message' => 'This email id is already registered.');
            } else {
                // User name is available
                $response = array('valid' => true);
            }
        }
        echo json_encode($response);
    }

}

?>
