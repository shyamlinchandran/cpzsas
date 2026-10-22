<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Server
 *
 * @author jijodileep
 */
class Server extends REST_Controller {

    function __construct() {
        parent::__construct();
        $global_data['hostname'] = 'localhost';
        $global_data['username'] = 'root';
        $global_data['password'] = '';
        $global_data['database'] = 'dims';
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('clinic/api/Server_model', 'server');
    }

    public function index_get() {
        // Display all books
    }

    public function getallbloodgroup_get() {
        $result = $this->server->getallbloodgroup();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
