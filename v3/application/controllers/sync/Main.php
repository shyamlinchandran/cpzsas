<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Main
 *
 * @author jijodileep
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
class Main extends REST_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
         $global_data['hostname'] = 'localhost';
        $global_data['username'] = 'root';
        $global_data['password'] = '';
        $global_data['database'] = 'sync_clinic';
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);
        $this->load->model('sync/clinic/Main_model', 'main');
    }

    public function index() {
        echo 'jij0';
    }
    public function updatebooking_get(){
        $msg = $this->main->getallbookingupdates();
          foreach ($msg as $key=>$ms) {
            $ms['diagnose'] = $this->main->getalldiagnosebyid($ms['Bok_Id']);
            $ms['observation'] = $this->main->getallobservationbyid($ms['Bok_Id']);
            $ms['procedures'] = $this->main->getallproceduresbyid($ms['Bok_Id']);
            $msg[$key]=$ms;
             $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
           ];
           $this->file_post_contents($this->main->sync_url.'updatebooking',$msg);
           $this->main->updatebooking($ms['Bok_Id']);
          }
    }
     public function getallbooking_get() {
        $msg = $this->main->getallbooking();
          foreach ($msg as $key=>$ms) {
            $ms['diagnose'] = $this->main->getalldiagnosebyid($ms['Bok_Id']);
            $ms['observation'] = $this->main->getallobservationbyid($ms['Bok_Id']);
            $ms['procedures'] = $this->main->getallproceduresbyid($ms['Bok_Id']);
            $msg[$key]=$ms;
             $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
           ];
           $this->file_post_contents($this->main->sync_url.'savebooking',$msg);
           $this->main->updatesyncbooking($ms['Bok_Id']);
          }
         

    }

    public function getallbookingsub_get($id) {
        $diagnose = $this->main->getalldiagnosebyid($id);
        $observation = $this->main->getallobservationbyid($id);
        $procedures = $this->main->getallproceduresbyid($id);
         $msg = [
            'status' => TRUE,
            'diagnose' => $diagnose,
            'observation' => $observation,
            'procedures' => $procedures,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function updatesyncbooking_get($id) {
        $this->main->updatesyncbooking($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    function file_post_contents($url, $data, $username = null, $password = null){


    $data_string = json_encode($data);

    $curl = curl_init($url);

    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen($data_string))
    );

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);  // Make it so the data coming back is put into a string
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);  // Insert the data

    // Send the request
    $result = curl_exec($curl);

    // Free up the resources $curl is using
    curl_close($curl);

    echo $result;
    }
    public function getallbloodgroup_get() {
        set_time_limit(0);
        $result = $this->main->getallbloodgroup();
          foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
           $this->file_post_contents($this->main->sync_url.'insertbloodgroup',$msg);
           $this->main->updatesyncblood($ms['Blo_Id']);
          }
       

    }

    public function updatesyncblood_get($id) {
        $this->main->updatesyncblood($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
 function syncbooking_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallbooking');
        $tmp = (array) json_decode($res);
        foreach ($tmp['result'] as $bok) {
        $Cus_details=$this->main->getsyncid('cli_patient',$bok->Cus_Id,'Pat_Id');
        $Shedule_details=$this->main->getsyncid('cli_timeschedule',$bok->Shedule_id,'TimeSch_Id');
        $inv_details=$this->main->getsyncid('cli_time_intervell',$bok->Intervell_id,'Ti_id');
        $proc_details=$this->main->getsyncid('cli_procedures',$bok->Bok_Proc_id,'Pro_Id');
        $doc_details=$this->main->getsyncid('cli_doctor',$bok->Doc_Id,'Doc_Id');         
            $data = array(
                'sync_id' => $bok->Bok_Id,
                'is_synced' => 1,
                'sync_type' => 'server',
                'no_gen_in_creation' => $bok->no_gen_in_creation,
                'Cus_Id' => $this->main->getfield($Cus_details['id']),
                'Cat_Id' => $bok->Cat_Id,
                'Bok_Mob' => $this->main->getfield($bok->Bok_Mob),
                'Bok_Email' => $this->main->getfield($bok->Bok_Email),
                'Bok_Date' => $this->main->getfield($bok->Bok_Date),
                'Shedule_id' => $this->main->getfield($Shedule_details['id']),
                'Intervell_id' => $this->main->getfield($inv_details['id']),
                'Bok_Proc_id' =>$this->main->getfield($proc_details['id']),
                'Bok_Starttime' => $this->main->getfield($bok->Bok_Starttime),
                'Bok_EndTime' => $this->main->getfield($bok->Bok_EndTime),
                'Bok_Approved' => $this->main->getfield($bok->Bok_Approved),
                'Doc_Id' => $this->main->getfield($doc_details['id']),
                'Bok_Note' => $this->main->getfield($bok->Bok_Note),
                'Apr_Note' => $this->main->getfield($bok->Apr_Note),
                'Bok_ReptNote' => $this->main->getfield($bok->Bok_ReptNote),
                'Pre_note' => $this->main->getfield($bok->Pre_note),
                'Bok_Cashtype' => $bok->Bok_Cashtype,
                'Bok_ReptComplete' => $this->main->getfield($bok->Bok_ReptComplete),
                'Bok_Amount' => $this->main->getfield($bok->Bok_Amount),
                'Bok_IsPaid' => $bok->Bok_IsPaid,
                'Bok_DoctDescription' => $bok->Bok_DoctDescription,
                'Bok_Priscription' => $this->main->getfield($bok->Bok_Priscription),
                'Bok_Ref' => $this->main->getfield($bok->Bok_Ref),
                'Bok_DocNote' => $bok->Bok_DocNote,
                'Bok_Labnote' => $bok->Bok_Labnote,
                'Bok_Summery' => $bok->Bok_Summery,
                'Bok_Completed' => $bok->Bok_Completed
            );
          $insert_id=$this->main->insertbooking($data);
          file_get_contents($this->main->sync_url.'updatesyncbooking_get/'.$bok->Bok_Id);

        $res_sub = file_get_contents($this->main->sync_url.'getallbookingsub/'.$bok->Bok_Id);
        $sub = (array) json_decode($res_sub);
        foreach ($sub['diagnose'] as $diagnose) {
            $diagnose_details=$this->server->getsyncid('cli_diagnose',$diagnose->Dig_Id,'Dig_id');
             $data_diagnose = array(
                    'Bok_Id' => $insert_id,
                    'Dig_Id' => $this->server->getfield($diagnose_details['id'])
                );
            $this->main->InsertDiagnose($data_diagnose);
        }
         foreach ($sub['observation'] as $observation) {
            $observation_details=$this->server->getsyncid('cli_observation',$observation->Obv_id,'Obs_Id');
             $data_observation = array(
                    'Bok_Id' => $insert_id,
                    'Obv_id' =>$this->server->getfield($observation_details['id'])
                );
            $this->main->InsertObservation($data_observation);
        }
         foreach ($sub['procedures'] as $procedures) {
             $procedure_details=$this->server->getsyncid('cli_procedures',$procedures->Pro_Id,'Pro_Id');
             $data_procedures = array(
                    'Bok_Id' => $insert_id,
                    'Pro_Id' => $this->server->getfield($procedure_details['id'])
                );
            $this->main->InsertProcedures($data_procedures);
        }
        file_get_contents($this->main->sync_url.'updatesyncbooking/'.$bok->Bok_Id);


        }
        
    }
    function syncpatient_get(){
        set_time_limit(0);
        $res = file_get_contents($this->main->sync_url.'getallPatient');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Pat_Id,
              'Pat_Name' => $tm->Pat_Name,
              'Pat_Regno' => $this->main->getfield($tm->Pat_Regno),
              'Pat_Phone' => $this->main->getfield($tm->Pat_Phone),
              'is_synced' => 1,
              'sync_type' => 'server',
              'Pat_Sms' => $this->main->getfield($tm->Pat_Sms),
              'Pat_Email' => $this->main->getfield($tm->Pat_Email),
              'Pat_Email_Notify' => $this->main->getfield($tm->Pat_Email_Notify),
              'Pat_Gender' => $tm->Pat_Gender,
              'Pat_Dob' => $tm->Pat_Dob,
              'Pat_Age' => $tm->Pat_Age,
              'Pat_Blood' => $tm->Pat_Blood,
              'Pat_Occupation' => $this->main->getfield($tm->Pat_Occupation),
              'Pat_Groups' => $this->main->getfield($tm->Pat_Groups),
              'Pat_Refered' => $this->main->getfield($tm->Pat_Refered),
              'Pat_Address' => $this->main->getfield($tm->Pat_Address),
              'Pat_Notes' => $this->main->getfield($tm->Pat_Notes),
              // 'updatedate' => $tm->updatedate,
              'no_gen_in_creation' => $tm->no_gen_in_creation
              );
          $insert_id=$this->main->insertpatient($data);
        $res_sub = file_get_contents($this->main->sync_url.'getallPatRelation/'.$tm->Pat_Id);
        $sub = (array) json_decode($res_sub);
          file_get_contents($this->main->sync_url.'updatesyncPatient/'.$tm->Pat_Id);
        foreach ($sub['patient'] as $patient) {
             $data_patient = array(
                    'pat_id' => $insert_id,
                    'Relation_type' => $patient->Relation_type,
                    'relativ_id' => $patient->relativ_id,
                    'name' => $patient->name,
                    'phone' => $patient->phone,
                );
            $this->main->InsertRelation($data_patient);
        }
    }
}

    function sync_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallbloodgroup');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Blo_Id,
              'Blo_Name' => $tm->Blo_Name,
              'sync_type' => $tm->sync_type,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->insertblood($data);
          file_get_contents($this->main->sync_url.'updatesyncblood/'.$tm->Blo_Id);
        }

    }
     function synccategory_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallcategory');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->cat_id,
              'cat_name' => $tm->cat_name,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertcategory($data);
          file_get_contents($this->main->sync_url.'updatesynccategory/'.$tm->cat_id);
        }

    }
       function syncclinic_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallclinic');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Cli_id,
              'name' => $tm->name,
              'logo' => $this->main->getfield($tm->logo),
              'header' => $this->main->getfield($tm->header),
              'address' => $this->main->getfield($tm->address),
              'phone' => $this->main->getfield($tm->phone),
              'tin' => $this->main->getfield($tm->tin),
              'details' => $this->main->getfield($tm->details),
              'menutype' => $tm->menutype,
              'company_master' => $this->main->getfield($tm->company_master),
              'email' => $tm->email,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertclinic($data);
          file_get_contents($this->main->sync_url.'updatesyncclinic/'.$tm->Cli_id);
        }
            $this->syncdoctor_get();
            $this->syncdiagnose_get();
            $this->sync_get();
            $this->syncobservation_get();
            $this->synccategory_get();
            $this->syncpotency_get();
            $this->syncprocedures_get();
            $this->synctimeschedule_get();
            $this->syncintervell_get();
            $this->syncpatient_get();
            $this->syncbooking_get();
                   
    }
    function syncdiagnose_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getalldiagnose');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Dig_id,
              'Diagnose' => $tm->Diagnose,
              'Details' => $this->main->getfield($tm->Details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertcli_diagnose($data);
          file_get_contents($this->main->sync_url.'updatesyncdiagnose/'.$tm->Dig_id);
        }

    }
    function syncdoctor_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getalldoctor');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Doc_Id,
              'Doc_Name' => $tm->Doc_Name,
              'Doc_Phone' => $this->main->getfield($tm->Doc_Phone),
              'Doc_Email' => $this->main->getfield($tm->Doc_Email),
              'Doc_Regno' => $this->main->getfield($tm->Doc_Regno),
              'Doc_Qualify' => $this->main->getfield($tm->Doc_Qualify),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertdoctor($data);
          file_get_contents($this->main->sync_url.'updatesyncdoctor/'.$tm->Doc_Id);
        }

    }
    function syncobservation_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallobservation');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Obs_Id,
              'Observation' => $tm->Observation,
              'details' => $this->main->getfield($tm->details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertcli_observation($data);
          file_get_contents($this->main->sync_url.'updatesyncobservation/'.$tm->Obs_Id);
        }

    }
    function syncpotency_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallpotency');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Pot_Id,
              'Potency' => $tm->Potency,
              'Details' => $this->main->getfield($tm->Details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertpotency($data);
          file_get_contents($this->main->sync_url.'updatesyncpotency/'.$tm->Pot_Id);
        }

    }
    function syncprocedures_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallprocedures');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Pro_Id,
              'Pro_Name' => $tm->Pro_Name,
              'Pro_Details' => $this->main->getfield($tm->Pro_Details),
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertcli_procedures($data);
          file_get_contents($this->main->sync_url.'updatesyncprocedures/'.$tm->Pro_Id);
        }

    }
    function synctimeschedule_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getalltimeschedule');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->TimeSch_Id,
              'Schedule_Time' => $tm->Schedule_Time,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertschedule($data);
          file_get_contents($this->main->sync_url.'updatesyncschedule/'.$tm->TimeSch_Id);
        }

    }
        function syncintervell_get() {
        set_time_limit(0);
        //$this->load->view('sync/main');
        $res = file_get_contents($this->main->sync_url.'getallintervell');
        $tmp = (array) json_decode($res);

        foreach ($tmp['result'] as $tm) {
             $data = Array(
              'sync_id' => $tm->Ti_id,
              'Intervell' => $tm->Intervell,
              'no_gen_in_creation' => $tm->no_gen_in_creation,
              'is_synced' => 1,
              'sync_type' => 'server'
              );
          $this->main->Insertintervell($data);
          file_get_contents($this->main->sync_url.'updatesyncintervell/'.$tm->Ti_id);
        }

    }

      public function getallcategory_get() {
        set_time_limit(0);
        $result = $this->main->getallcategory();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'savecategory',$msg);
           $this->main->updatesynccategory($ms['cat_id']);
          }
    }

    public function updatesynccategory_get($id) {
        $this->main->updatesynccategory($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

     public function getallclinic_get() {
        set_time_limit(0);
        $result = $this->main->getallclinic();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
           $this->file_post_contents($this->main->sync_url.'saveclinic',$msg);
           $this->main->updatesyncclinic($ms['Cli_id']);
          }
            $this->getalldoctor_get();
            $this->getalldiagnose_get();
            $this->getallbloodgroup_get();
            $this->getallobservation_get();
            $this->getallcategory_get();
            $this->getallpotency_get();
            $this->getallprocedures_get();
            $this->getalltimeschedule_get();
            $this->getallintervell_get();
            $this->getallPatient_get();
            $this->getallbooking_get();

    }

    public function updatesyncclinic_get($id) {
        $this->main->updatesyncclinic($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
      public function getalldiagnose_get() {
        set_time_limit(0);
        $result = $this->main->getalldiagnose();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'savediagnose',$msg);
           $this->main->updatesyncdiagnose($ms['Dig_id']);
        }

    }

    public function updatesyncdiagnose_get($id) {
        $this->main->updatesyncdiagnose($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
        public function getalldoctor_get() {
        set_time_limit(0);
        $result = $this->main->getalldoctor();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'savedoctor',$msg);
            $this->main->updatesyncdoctor($ms['Doc_Id']);
        }
    }

    public function updatesyncdoctor_get($id) {
        $this->main->updatesyncdoctor($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallobservation_get() {
        set_time_limit(0);
        $result = $this->main->getallobservation();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'saveobservation',$msg);
            $this->main->updatesyncobservation($ms['Obs_Id']);
        } 
    }

    public function updatesyncobservation_get($id) {
        $this->main->updatesyncobservation($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallpotency_get() {
        set_time_limit(0);
        $result = $this->main->getallpotency();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'savepotency',$msg);
            $this->main->updatesyncpotency($ms['Pot_Id']);
        }
    }

    public function updatesyncpotency_get($id) {
        $this->main->updatesyncpotency($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getallprocedures_get() {
        set_time_limit(0);
        $result = $this->main->getallprocedures();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'saveprocedures',$msg);
            $this->main->updatesyncprocedures($ms['Pro_Id']);
        }
    }

    public function updatesyncprocedures_get($id) {
        $this->main->updatesyncprocedures($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
    public function getalltimeschedule_get() {
        set_time_limit(0);
        $result = $this->main->getalltimeschedule();
        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
             $this->file_post_contents($this->main->sync_url.'savetimeschedule',$msg);
            $this->main->updatesyncschedule($ms['TimeSch_Id']);
        } 
    }

    public function updatesyncschedule_get($id) {
        $this->main->updatesyncschedule($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
        public function getallintervell_get() {
        set_time_limit(0);
        $result = $this->main->getallintervell();

        foreach ($result as $key=>$ms) {
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
             ];
            $this->file_post_contents($this->main->sync_url.'saveintervell',$msg);
            $this->main->updatesyncintervell($ms['Ti_id']);
        } 
    }

    public function updatesyncintervell_get($id) {
        $this->main->updatesyncintervell($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
      public function getallPatient_get() {
        set_time_limit(0);
        $result = $this->main->getallPatient();
           foreach ($result as $key=>$ms) {
            $ms['relation'] = $this->main->getallPatRelation($ms['Pat_Id']);
            $result[$key]=$ms;
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
        ];
          $this->file_post_contents($this->main->sync_url.'savepatient',$msg);     
          $this->main->updatesyncPatient($ms['Pat_Id']);
        }
       
    }
    public function updatePatient_get() {
        set_time_limit(0);
        $result = $this->main->getallPatientupdates();
           foreach ($result as $key=>$ms) {
            $ms['relation'] = $this->main->getallPatRelation($ms['Pat_Id']);
            $result[$key]=$ms;
            $msg = [
            'status' => TRUE,
            'result' => $ms,
            'message' => 'Login Successful'
        ];
          $this->file_post_contents($this->main->sync_url.'updatepatient',$msg);     
          $this->main->updatesyncPatient($ms['Pat_Id']);
        }
          $this->updatebooking_get();

       
    }
     public function getallPatRelation_get($id) {
        $result = $this->main->getallPatRelation($id);
        $msg = [
            'status' => TRUE,
            'patient' => $result,
            'message' => 'Login Successful'
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }
     public function updatesyncPatient_get($id) {
        $this->main->updatesyncPatient($id);
        $msg = [
            'status' => TRUE,
        ];
        $this->response($msg, REST_Controller::HTTP_OK);
    }

}
