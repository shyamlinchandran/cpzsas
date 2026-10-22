<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Master
 *
 * @author Dimind
 */
class Master extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('ajax_model', 'ajax');
        $this->load->model('kaasma/api/Main_model', 'main');
    }

    public function index_get() {
        echo 'sad';
    }

    public function devicereg_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $this->main->createdevice($comid, $devid);
        $msg = [
            'status' => TRUE,
            'message' => 'Registred'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function login_post() {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        //$devid = $tmp['devid'];
        $username = $tmp['username'];
        $passord = $tmp['password'];
        $comid = "kaasma";
        $res = $this->main->login($comid, $username, $passord);
        if ($res['cnt'] != 0) {
            $msg = [
                'status' => TRUE,
                'result' => $res['user'],
                'message' => 'Login Successful'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } else {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => 'Invalid Login'
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function enquirylist_post() {
        $comid = "kaasma";
        //$userid = 3;
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $date = $tmp['myDate'];
        $userid = $tmp['Emp_Id'];
        try {
            $res = $this->main->getenqlist($comid, $userid, $date);
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'items are attached to the result'
            ];
            $this->response($msg, REST_Controller::HTTP_OK);
        } catch (Exception $ex) {
            $msg = [
                'status' => FALSE,
                'result' => '',
                'message' => $ex
            ];
            $this->response($msg, REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}
