<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accounts
 *
 * @author u43255
 */
class Loginsett extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('loginsett_model', 'login');
    }

    public function listall() {
        $data['users'] = $this->login->getUsers();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list', $data);
        $this->load->view('loginsett/list_all');
    }

    public function change_password() {
        //$data['users'] = $this->login->getUsers();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('loginsett/change_password');
    }

    public function new_password() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        //$password = $tmp['user_password'];
        $password = $this->login->getUserbyId($userid);
        $check = $this->input->post('pass');
        $new_password = $this->input->post('rpass');
        if ($check == $password) { //verify existing password
            $this->login->changepswd($userid, $new_password);
            //$newdata['user_password']= $new_password;
            //$this->session->set_userdata($tmp[''],$check);
        } else {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Incorrect Password.'
            );
            echo json_encode($response);
        }
    }

    public function logout() {
        $session = session_id();
        $login_url = $this->session->userdata('login_url');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $this->login->logoutuser($userid, $session);
        unset($_SESSION['username']);
        unset($_SESSION['pswd']);
        unset($_SESSION['logged_in']);
        session_destroy(); 
        echo'<meta http-equiv="refresh" content="0; url=' . $login_url . '">'; 
    }

    public function ajax_list() {
        $this->login->where();
        $list = $this->login->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $status = $item->status;
            if ($status != 0) {
                $online = "btn btn-success";
            } else {
                $online = "btn btn-danger";
            }
            $active = '<span class="' . $online . ' glyphicon glyphicon-off" disabled></span>';
            $row[] = $no;
            $row[] = $item->user;
            $row[] = $item->ip;
            $row[] = $active;
            $row[] = $item->login;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->login->count_all(),
            "recordsFiltered" => $this->login->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}

?>
