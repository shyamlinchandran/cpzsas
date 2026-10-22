<?php
header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: append,delete,entries,foreach,get,has,keys,set,values,Authorization');
/*header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Methods: GET, POST, DELETE, PUT, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, Accept, Authorization, X-Request-With');
header('Access-Control-Allow-Credentials: true');*/
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Credentials: true");
//header("Access-Control-Max-Age: 1000");
//header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
//header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
//header("Access-Control-Allow-Origin: *");
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
class Item extends REST_Controller {

    //put your code here
    function __construct() {
        // Construct the parent class
        parent::__construct();
        $this->load->model('api/ecom/Main_model', 'main');
    }
     public function allitems_get()
    {         
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        try
        {
           $res = $this->main->allitems();
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
     public function subitem_post()
    {         
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $category_id = $tmp['category_id'];
        try
        {
           $res = $this->main->subitems($category_id);
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
     public function itemdetails_post()
    {         
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $id = $tmp['id'];
        try
        {
           $res = $this->main->item_details($id);
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
    public function itemlist_post()
    {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $barcode = $tmp['barcode'];
        //$devid = $tmp['devid'];
        try
        {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $config ['is_taxincluded'] = FALSE;
            //$device = $this->main->getdevice($comid, $devid); //device details
            $res = $this->main->getitems($barcode);
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
    public function categorylist_get()
    {
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        //$devid = $tmp['devid'];
        try
        {
            $config ['name'] = "DIMS";
            $config ['logo'] = "DIMS";
            $config ['is_taxincluded'] = FALSE;
            //$device = $this->main->getdevice($comid, $devid); //device details
            $res = $this->main->getcategory();
            $msg = [
                'status' => TRUE,
                'result' => $res,
                'message' => 'catgories are attached to the result'
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
