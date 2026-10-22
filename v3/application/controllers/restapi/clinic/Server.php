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
        $global_data['username'] = 'arogyahomeoclini_main';
        $global_data['password'] = 'dimind@8891';
        $global_data['database'] = 'arogyahomeoclini_clinic';
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('clinic/api/Server_model', 'server');
    }

    public function index_get() {
        echo 'Invalid';
    }
     public function getallbookingsub_get($id) {
        $diagnose = $this->server->getalldiagnosebyid($id);
        $observation = $this->server->getallobservationbyid($id);
        $procedures = $this->server->getallproceduresbyid($id);
         $msg = [
            'status' => TRUE,
            'diagnose' => $diagnose,
            'observation' => $observation,
            'procedures' => $procedures,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

        public function updatebooking_post(){
        set_time_limit(0);
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $bok=$tmp['result'];
              $data = array(
                'no_gen_in_creation' => $bok->no_gen_in_creation,
                'Cat_Id' => $bok->Cat_Id,
                'Bok_Mob' => $this->server->getfield($bok->Bok_Mob),
                'Bok_Email' => $this->server->getfield($bok->Bok_Email),
                'Bok_Date' => $this->server->getfield($bok->Bok_Date),
                'Bok_Starttime' => $this->server->getfield($bok->Bok_Starttime),
                'Bok_EndTime' => $this->server->getfield($bok->Bok_EndTime),
                'Bok_Approved' => $this->server->getfield($bok->Bok_Approved),
                'Bok_Note' => $this->server->getfield($bok->Bok_Note),
                'Apr_Note' => $this->server->getfield($bok->Apr_Note),
                'Bok_ReptNote' => $this->server->getfield($bok->Bok_ReptNote),
                'Pre_note' => $this->server->getfield($bok->Pre_note),
                'Bok_Cashtype' => $bok->Bok_Cashtype,
                'Bok_ReptComplete' => $this->server->getfield($bok->Bok_ReptComplete),
                'Bok_Amount' => $this->server->getfield($bok->Bok_Amount),
                'Bok_IsPaid' => $bok->Bok_IsPaid,
                'Bok_DoctDescription' => $bok->Bok_DoctDescription,
                'Bok_Priscription' => $this->server->getfield($bok->Bok_Priscription),
                'Bok_Ref' => $this->server->getfield($bok->Bok_Ref),
                'Bok_DocNote' => $bok->Bok_DocNote,
                'Bok_Labnote' => $bok->Bok_Labnote,
                'Bok_Summery' => $bok->Bok_Summery,
                'Bok_Completed' => $bok->Bok_Completed
            );

              if($bok->sync_type=='localupdate'){
                $sync_details=$this->server->getsyncid('cli_booking',$bok->Bok_Id,'Bok_Id');  
                $bok->sync_id= $this->server->getfield($sync_details['id']);
              }
        $this->server->updatebooking($bok->sync_id,$data);
        $insert_id=$bok->sync_id;
        foreach ($bok->diagnose as $diagnose) {
        $diagnose_details=$this->server->getsyncid('cli_diagnose',$diagnose->Dig_Id,'Dig_id');
             $data_diagnose = array(
                    'Bok_Id' => $insert_id,
                    'Dig_Id' => $this->server->getfield($diagnose_details['id'])
                );
            $this->server->InsertDiagnose($data_diagnose);
        }
        foreach ($bok->observation as $observation) {
            $observation_details=$this->server->getsyncid('cli_observation',$observation->Obv_id,'Obs_Id');
             $data_observation = array(
                    'Bok_Id' => $insert_id,
                    'Obv_id' => $this->server->getfield($observation_details['id'])
                );
            $this->server->InsertObservation($data_observation);
        }
        foreach ($bok->procedures as $procedures) {
             $procedure_details=$this->server->getsyncid('cli_procedures',$procedures->Pro_Id,'Pro_Id');
             $data_procedures   = array(
                    'Bok_Id' => $insert_id,
                    'Pro_Id' => $this->server->getfield($procedure_details['id'])
                );
            $this->server->InsertProcedures($data_procedures);
        }

        // file_get_contents('http://localhost/dims/sync/Main/updatesyncbooking/'.$bok->Bok_Id);  
              // $this->response($tmp['result'], REST_Controller::HTTP_OK);

    }
    
    public function savebooking_post(){
        set_time_limit(0);
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $bok=$tmp['result'];
        $Cus_details=$this->server->getsyncid('cli_patient',$bok->Cus_Id,'Pat_Id');
        $Shedule_details=$this->server->getsyncid('cli_timeschedule',$bok->Shedule_id,'TimeSch_Id');
        $inv_details=$this->server->getsyncid('cli_time_intervell',$bok->Intervell_id,'Ti_id');
        $proc_details=$this->server->getsyncid('cli_procedures',$bok->Bok_Proc_id,'Pro_Id');
        $doc_details=$this->server->getsyncid('cli_doctor',$bok->Doc_Id,'Doc_Id'); 
              $data = array(
                'sync_id' => $bok->Bok_Id,
                'is_synced' => 1,
                'sync_type' => 'local',
                'no_gen_in_creation' => $bok->no_gen_in_creation,
                'Cus_Id' => $this->server->getfield($Cus_details['id']),
                'Cat_Id' => $bok->Cat_Id,
                'Bok_Mob' => $this->server->getfield($bok->Bok_Mob),
                'Bok_Email' => $this->server->getfield($bok->Bok_Email),
                'Bok_Date' => $this->server->getfield($bok->Bok_Date),
                'Shedule_id' => $this->server->getfield($Shedule_details['id']),
                'Intervell_id' => $this->server->getfield($inv_details['id']),
                'Bok_Proc_id' =>$this->server->getfield($proc_details['id']),
                'Bok_Starttime' => $this->server->getfield($bok->Bok_Starttime),
                'Bok_EndTime' => $this->server->getfield($bok->Bok_EndTime),
                'Bok_Approved' => $this->server->getfield($bok->Bok_Approved),
                'Doc_Id' => $this->server->getfield($doc_details['id']),
                'Bok_Note' => $this->server->getfield($bok->Bok_Note),
                'Apr_Note' => $this->server->getfield($bok->Apr_Note),
                'Bok_ReptNote' => $this->server->getfield($bok->Bok_ReptNote),
                'Pre_note' => $this->server->getfield($bok->Pre_note),
                'Bok_Cashtype' => $bok->Bok_Cashtype,
                'Bok_ReptComplete' => $this->server->getfield($bok->Bok_ReptComplete),
                'Bok_Amount' => $this->server->getfield($bok->Bok_Amount),
                'Bok_IsPaid' => $bok->Bok_IsPaid,
                'Bok_DoctDescription' => $bok->Bok_DoctDescription,
                'Bok_Priscription' => $this->server->getfield($bok->Bok_Priscription),
                'Bok_Ref' => $this->server->getfield($bok->Bok_Ref),
                'Bok_DocNote' => $bok->Bok_DocNote,
                'Bok_Labnote' => $bok->Bok_Labnote,
                'Bok_Summery' => $bok->Bok_Summery,
                'Bok_Completed' => $bok->Bok_Completed
            );
        $insert_id=$this->server->insertbooking($data);
        foreach ($bok->diagnose as $diagnose) {
        $diagnose_details=$this->server->getsyncid('cli_diagnose',$diagnose->Dig_Id,'Dig_id');
             $data_diagnose = array(
                    'Bok_Id' => $insert_id,
                    'Dig_Id' => $this->server->getfield($diagnose_details['id'])
                );
            $this->server->InsertDiagnose($data_diagnose);
        }
         foreach ($bok->observation as $observation) {
            $observation_details=$this->server->getsyncid('cli_observation',$observation->Obv_id,'Obs_Id');
             $data_observation = array(
                    'Bok_Id' => $insert_id,
                    'Obv_id' => $this->server->getfield($observation_details['id'])
                );
            $this->server->InsertObservation($data_observation);
        }
         foreach ($bok->procedures as $procedures) {
             $procedure_details=$this->server->getsyncid('cli_procedures',$procedures->Pro_Id,'Pro_Id');
             $data_procedures   = array(
                    'Bok_Id' => $insert_id,
                    'Pro_Id' => $this->server->getfield($procedure_details['id'])
                );
            $this->server->InsertProcedures($data_procedures);
        }

        // file_get_contents('http://localhost/dims/sync/Main/updatesyncbooking/'.$bok->Bok_Id);  
              // $this->response($tmp['result'], REST_Controller::HTTP_OK);

    }
    //     public function getallbookingsub_get($id) {
    //     $diagnose = $this->server->getalldiagnose($id);
    //     $observation = $this->server->getallobservation($id);
    //     $procedures = $this->server->getallprocedures($id);
    //      $msg = [
    //         'status' => TRUE,
    //         'diagnose' => $diagnose,
    //         'observation' => $observation,
    //         'procedures' => $procedures,
    //         'message' => 'Login Successful'
    //     ];
    //     $this->response($msg, REST_Controller::HTTP_OK);
    // }
        public function updatepatient_post(){
        set_time_limit(0);
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'Pat_Name' => $tm->Pat_Name,
              'Pat_Regno' => $this->server->getfield($tm->Pat_Regno),
              'Pat_Phone' => $this->server->getfield($tm->Pat_Phone),
              'Pat_Sms' => $this->server->getfield($tm->Pat_Sms),
              'Pat_Email' => $this->server->getfield($tm->Pat_Email),
              'Pat_Email_Notify' => $this->server->getfield($tm->Pat_Email_Notify),
              'Pat_Gender' => $this->server->getfield($tm->Pat_Gender),
              'Pat_Dob' => $tm->Pat_Dob,
              'Pat_Age' => $tm->Pat_Age,
              'Pat_Blood' => $tm->Pat_Blood,
              'Pat_Occupation' => $this->server->getfield($tm->Pat_Occupation),
              'Pat_Groups' => $this->server->getfield($tm->Pat_Groups),
              'Pat_Refered' => $this->server->getfield($tm->Pat_Refered),
              'Pat_Address' => $this->server->getfield($tm->Pat_Address),
              'Pat_Notes' => $this->server->getfield($tm->Pat_Notes),
              'no_gen_in_creation' => $tm->no_gen_in_creation
              );
             if($tm->sync_type=='localupdate'){
                $sync_details=$this->server->getsyncid('cli_patient',$tm->Pat_Id,'Pat_Id');  
                $tm->sync_id= $this->server->getfield($sync_details['id']);
              }
         $this->server->updatepatient($tm->sync_id,$data);
         foreach ($tm->relation as $relation) {
                $data_patient = array(
                    'pat_id' => $tm->sync_id,
                    'Relation_type' => $relation->Relation_type,
                    'relativ_id' => $relation->relativ_id,
                    'name' => $relation->name,
                    'phone' => $relation->phone,
                );
               $this->server->InsertRelation($data_patient);
            }
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncPatient/'.$tm->Pat_Id);
    }
    
    public function savepatient_post(){
        set_time_limit(0);
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Pat_Id,
              'Pat_Name' => $tm->Pat_Name,
              'Pat_Regno' => $this->server->getfield($tm->Pat_Regno),
              'Pat_Phone' => $this->server->getfield($tm->Pat_Phone),
              'is_synced' => 1,
              'sync_type' => 'local',
              'Pat_Sms' => $this->server->getfield($tm->Pat_Sms),
              'Pat_Email' => $this->server->getfield($tm->Pat_Email),
              'Pat_Email_Notify' => $this->server->getfield($tm->Pat_Email_Notify),
              'Pat_Gender' => $this->server->getfield($tm->Pat_Gender),
              'Pat_Dob' => $tm->Pat_Dob,
              'Pat_Age' => $tm->Pat_Age,
              'Pat_Blood' => $tm->Pat_Blood,
              'Pat_Occupation' => $this->server->getfield($tm->Pat_Occupation),
              'Pat_Groups' => $this->server->getfield($tm->Pat_Groups),
              'Pat_Refered' => $this->server->getfield($tm->Pat_Refered),
              'Pat_Address' => $this->server->getfield($tm->Pat_Address),
              'Pat_Notes' => $this->server->getfield($tm->Pat_Notes),
              'no_gen_in_creation' => $tm->no_gen_in_creation
              );
          $insert_id=$this->server->insertpatient($data);
         foreach ($tm->relation as $relation) {
                $data_patient = array(
                    'pat_id' => $insert_id,
                    'Relation_type' => $relation->Relation_type,
                    'relativ_id' => $relation->relativ_id,
                    'name' => $relation->name,
                    'phone' => $relation->phone,
                );
               $this->server->InsertRelation($data_patient);
            }
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncPatient/'.$tm->Pat_Id);
    }
    function savecategory_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->cat_id,
              'cat_name' => $tm->cat_name,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->server->Insertcategory($data);

    }
       function saveclinic_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Cli_id,
              'name' => $this->server->getfield($tm->name),
              'logo' => $this->server->getfield($tm->logo),
              'header' => $this->server->getfield($tm->header),
              'address' => $this->server->getfield($tm->address),
              'phone' => $this->server->getfield($tm->phone),
              'tin' => $this->server->getfield($tm->tin),
              'details' => $this->server->getfield($tm->details),
              'menutype' => $this->server->getfield($tm->menutype),
              'company_master' => $this->server->getfield($tm->company_master),
              'email' => $this->server->getfield($tm->email),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertclinic($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncclinic/'.$tm->Cli_id);
        

    }
    function savediagnose_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Dig_id,
              'Diagnose' => $this->server->getfield($tm->Diagnose),
              'Details' => $tm->Details,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertcli_diagnose($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncdiagnose/'.$tm->Dig_id);

    }
    function savedoctor_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Doc_Id,
              'Doc_Name' => $tm->Doc_Name,
              'Doc_Phone' => $this->server->getfield($tm->Doc_Phone),
              'Doc_Email' => $this->server->getfield($tm->Doc_Email),
              'Doc_Regno' => $this->server->getfield($tm->Doc_Regno),
              'Doc_Qualify' => $this->server->getfield($tm->Doc_Qualify),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertdoctor($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncdoctor/'.$tm->Doc_Id);
        
    }
    function saveobservation_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Obs_Id,
              'Observation' => $tm->Observation,
              'details' => $this->server->getfield($tm->details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertcli_observation($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncobservation/'.$tm->Obs_Id);

    }
    function savepotency_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Pot_Id,
              'Potency' => $tm->Potency,
              'Details' => $this->server->getfield($tm->Details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertpotency($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncpotency/'.$tm->Pot_Id);
        
    }
    function saveprocedures_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Pro_Id,
              'Pro_Name' => $tm->Pro_Name,
              'Pro_Details' => $this->server->getfield($tm->Pro_Details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertcli_procedures($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncprocedures/'.$tm->Pro_Id);

    }
    function savetimeschedule_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->TimeSch_Id,
              'Schedule_Time' => $tm->Schedule_Time,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertschedule($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncschedule/'.$tm->TimeSch_Id);

    }
        function saveintervell_post() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $json_request_body = file_get_contents('php://input');
        $tmp = (array) json_decode($json_request_body);
        $tm=$tmp['result'];
             $data = Array(
              'sync_id' => $tm->Ti_id,
              'Intervell' => $tm->Intervell,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'local'
              );
          $this->server->Insertintervell($data);
          // file_get_contents('http://localhost/dims/restapi/clinic/main/updatesyncintervell/'.$tm->Ti_id);

    }

    public function getallPatient_get() {
        $result = $this->server->getallPatient();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
     public function getallPatRelation_get($id) {
        $result = $this->server->getallPatRelation($id);
        $msg = [
            'status' => TRUE,
            'patient' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
     public function updatesyncPatient_get($id) {
        $this->server->updatesyncPatient($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    
    public function getallbooking_get() {
        $result = $this->server->getallbooking();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncbooking_get($id) {
        $this->server->updatesyncbooking($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
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

    public function updatesyncblood_get($id) {
        $this->server->updatesyncblood($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function insertbloodgroup_post() {
       $json_request_body = file_get_contents('php://input');
       $tmp = (array) json_decode($json_request_body);
       $tm=$tmp['result'];

             $data = Array(
              'sync_id' => $tm->Blo_Id,
              'Blo_Name' => $tm->Blo_Name,
              'sync_type' => 'local',
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              );
        $this->server->insertblood($data);
        // $this->server->updatebloodgroup($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

     public function getallcategory_get() {
        $result = $this->server->getallcategory();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesynccategory_get($id) {
        $this->server->updatesynccategory($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

     public function getallclinic_get() {
        $result = $this->server->getallclinic();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncclinic_get($id) {
        $this->server->updatesyncclinic($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
      public function getalldiagnose_get() {
        $result = $this->server->getalldiagnose();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncdiagnose_get($id) {
        $this->server->updatesyncdiagnose($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
        public function getalldoctor_get() {
        $result = $this->server->getalldoctor();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncdoctor_get($id) {
        $this->server->updatesyncdoctor($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallobservation_get() {
        $result = $this->server->getallobservation();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncobservation_get($id) {
        $this->server->updatesyncobservation($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallpotency_get() {
        $result = $this->server->getallpotency();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncpotency_get($id) {
        $this->server->updatesyncpotency($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallprocedures_get() {
        $result = $this->server->getallprocedures();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncprocedures_get($id) {
        $this->server->updatesyncprocedures($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getalltimeschedule_get() {
        $result = $this->server->getalltimeschedule();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncschedule_get($id) {
        $this->server->updatesyncschedule($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
        public function getallintervell_get() {
        $result = $this->server->getallintervell();
        $msg = [
            'status' => TRUE,
            'result' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

    public function updatesyncintervell_get($id) {
        $this->server->updatesyncintervell($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
