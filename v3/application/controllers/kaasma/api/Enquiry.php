<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//C:\Program Files (x86)\Foxit Software\Foxit PDF Reader DRIVER CABIN CHOCOLATE
/**
 * Description of sales
 *
 * @author dimind
 */
class Enquiry extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    function create_post() {
        //database 
        $global_data['hostname'] = 'localhost';
        $global_data['username'] = 'root';
        $global_data['password'] = '';
        $global_data['database'] = 'kaasma_db';
        $global_data['isexcute'] = '1';
        //$user_id = 3;
        $this->load->vars($global_data);
        $this->load->model('kaasma/enquiry_model', 'enquiry');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
            $name = $tmp['enq_contact_person'];
            $phone = $tmp['enq_phone'];
            $enq_date = $tmp['enq_created_on'];
            $email = $tmp['enq_email'];
            $coname = $tmp['enq_company'];
            $cophone = $tmp['enq_co_phone'];
            $tot_branch = $tmp['enq_total_branches'];
            $owner_name = $tmp['enq_co_owner'];
            $enq_status = $tmp['enq_status'];
            $user_id = $tmp['Emp_Id'];
            $remarks = $tmp['enq_remarks'];
            $updated_on = $tmp['enq_updated'];
            $published = "yes";
            $data = array(
                'enq_contact_person' => $name,
                'enq_phone' => $phone,
                'enq_created_on' => $enq_date,
                'enq_email' => $email,
                'enq_company' => $coname,
                'enq_co_phone' => $cophone,
                'enq_total_branches' => $tot_branch,
                'enq_co_owner' => $owner_name,
                'enq_status' => $enq_status,
                'enq_remarks'=>$remarks,
                'user_id'=>$user_id,
                'enq_updated'=>$updated_on,
                'published'=>$published,
            );
            $id = 0;
            if ($id == 0) {
                $insert_id = $this->enquiry->InsertEnquiry($data);
            }/* else {
                $this->enquiry->UpdateEnquiry($data, $id);
                $insert_id = $id;
            }*/
                $msg = [
            'status' => TRUE, 
            'message' => 'items are attached to the result'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
