<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author jijodileep
 */
class Booking extends REST_Controller {

    function __construct() {
        // Construct the parent class
        parent::__construct();

        // Configure limits on our controller methods
        // Ensure you have created the 'limits' table and enabled 'limits' within application/config/rest.php
//        $this->methods['users_get']['limit'] = 500; // 500 requests per hour per user/key
//        $this->methods['users_post']['limit'] = 100; // 100 requests per hour per user/key
//        $this->methods['users_delete']['limit'] = 50; // 50 requests per hour per user/key
    }

    public function index_get() {
        echo 'sad';
    }

    function create_post($comid) {
        //database 
        $global_data['hostname'] = 'localhost';
        $global_data['username'] = 'root';
        $global_data['password'] = '';
        $global_data['database'] = 'dims';
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('clinic/api/Booking_model', 'booking');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        for ($i = 0; $i < count($tmp); $i++) {
            $obj = $tmp[$i];
            $no_gen_in_creation = $obj->no_gen_in_creation;
            $sync_type = $obj->sync_type;
            $sync_id = $obj->sync_id;
            $is_synced = $obj->is_synced;
            $Cus_Id = $obj->Cus_Id;
            $Bok_Mob = $obj->Bok_Mob;
            $Bok_Email = $obj->Bok_Email;
            $Bok_Date = $this->booking->getDate($obj->Bok_Date, '-');
            $Bok_Starttime = $this->booking->getDate($obj->Bok_Starttime, '-');
            $Bok_Note = $obj->Bok_Note;
            $Shedule_id = $obj->Shedule_id;
            $Cat_Id = $obj->Cat_Id;
            $Intervell_id = $obj->Intervell_id;
            $Doc_Id = $obj->Doc_Id;
            $Bok_Approved = $obj->Bok_Approved;
            $Bok_Proc_id = $obj->Bok_Proc_id;
            $Bok_Ref = $obj->Bok_Ref;
            $data = array(
                'sync_id' => $obj->Bok_Id,
                'is_synced' => 1,
                'sync_type' => $obj->sync_type,
                'no_gen_in_creation' => $obj->no_gen_in_creation,
                'Cus_Id' => $obj->Cus_Id,
                'Cat_Id' => $obj->Cat_Id,
                'Bok_Mob' => $obj->Bok_Mob,
                'Bok_Email' => $obj->Bok_Email,
                'Bok_Date' => $this->booking->getDate($obj->Bok_Date, '-'),
                'Shedule_id' => $obj->Shedule_id,
                'Intervell_id' => $obj->Intervell_id,
                'Bok_Proc_id' => $obj->Bok_Proc_id,
                'Bok_Starttime' => $this->booking->getDate($obj->Bok_Starttime, '-'),
                'Bok_EndTime' => $this->booking->getDate($obj->Bok_EndTime, '-'),
                'Bok_Approved' => $obj->Bok_Approved,
                'Doc_Id' => $obj->Doc_Id,
                'Bok_Note' => $obj->Bok_Note,
                'Apr_Note' => $obj->Apr_Note,
                'Bok_ReptNote' => $obj->Bok_ReptNote,
                'Pre_note' => $obj->Pre_note,
                'Bok_Cashtype' => $obj->Bok_Cashtype,
                'Bok_ReptComplete' => $Bok_ReptComplete,
                'Bok_Amount' => $obj->Bok_Amount,
                'Bok_IsPaid' => $obj->Bok_IsPaid,
                'Bok_DoctDescription' => $obj->Bok_DoctDescription,
                'Bok_Priscription' => $obj->Bok_Priscription,
                'Bok_Ref' => $obj->Bok_Ref,
                'Bok_DocNote' => $obj->Bok_DocNote,
                'Bok_Labnote' => $obj->Bok_Labnote,
                'Bok_Summery' => $obj->Bok_Summery,
                'Bok_Completed' => $obj->Bok_Completed
            );
            $insert_id = 0;
            if ($is_synced == 0) {
                $insert_id = $this->booking->InsertBooking($data);
            } else {
                $this->booking->UpdateBooking($data);
                $insert_id = $obj->Bok_Id;
            }

            foreach ($obj->bok_diagnose as $diagnose) {
                $data_diagnose = array(
                    'Bok_Id' => $insert_id,
                    'Dig_Id' => $diagnose->Dig_Id
                );
                $insert_id = $this->booking->InsertDiagnose($data);
                $this->db->insert('cli_bok_diagnose', $data_diagnose);
            }
            foreach ($obj->bok_observation as $observation) {
                $data_observation = array(
                    'Bok_Id' => $insert_id,
                    'Obv_id' => $observation->Obv_id
                );
                $this->db->insert('InsertObservation', $data_observation);
            }
            foreach ($obj->cli_bookingprocedures as $bookingprocedures) {
                $data_procedures = array(
                    'Bok_Id' => $insert_id,
                    'Pro_Id' => $bookingprocedures->Pro_Id
                );
                $this->db->insert('InsertProcedures', $data_procedures);
            }
        }
        $msg = [
            'status' => TRUE,
            'message' => 'items are attached to the result'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
