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
 * @author Dimind
 */
class Masters extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/ecom/Main_model', 'main');
    }
     public function sliders_get()
    {         
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        try
        {
           $res = $this->main->get_sliders();
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'slider data are attached to the result'
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

     public function offers_get()
    {         
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        try
        {
           $res = $this->main->get_offers();
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'offer data are attached to the result'
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
