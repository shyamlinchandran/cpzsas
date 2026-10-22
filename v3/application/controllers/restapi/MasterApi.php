<?php
header("Access-Control-Allow-Origin: *");
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
class MasterApi extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/MainApi_model', 'main');
    }
	
	public function login_post($comid) {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $devid = $tmp['devid'];
        $username = $tmp['username'];
        $passord = $tmp['password'];
        $res = $this->main->login($comid, $devid, $username, $passord);
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
	
	public function CustomerList_post($comid){
		
	}
	
	
 
}
