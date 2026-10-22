<?php
header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Max-Age: 1000");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
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
 * @author jijodileep
 */
class User extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        //$this->load->model('ajax_model', 'ajax');
        $this->load->model('api/ecom/Main_model', 'main');
    }

    public function userreg_post() {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $email = $tmp['email'];
        $phone = $tmp['phone'];
        $pass = $tmp['password'];
        $password  = md5($pass);
        $data = array(
            'name' => $tmp['name'],
            'email' => $tmp['email'],
            'phone' => $tmp['phone'],
            'password' => $password
        );
        $check = $this->main->checkuser($email, $phone);
        if($check==0)
        {
            $this->main->createuser($data);
            $status = TRUE;
            $message = "success";
        }
        else
        {
            $message = "email or phone no. exists";
            $status = FALSE;
        }
        $msg = [
            'status' => $status,
            'message' => $message
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function login_post() {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $username = $tmp['username'];
        $pass = $tmp['password'];
        $password  = md5($pass);
        $res = $this->main->login($username, $password);
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

   

    public function config_post() {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $device = $this->main->getdevice($devid); //device details        
        try {
            $items = $this->main->getitems($device['godown_id']); //godown wise  items details 
            $res ['items'] = $items;
            $res ['customers'] = $this->main->getcustomer($device['bill_id']);
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
