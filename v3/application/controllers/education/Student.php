<?php

defined('BASEPATH') OR exit('No direct script access allowed');
    
class student extends MY_Controller{

    public function __construct() {
        parent::__construct();
        $this->load->model('education/Student_model', 'student');
        $this->load->library('excel'); //load PHPExcel library 
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }
	
	function getalldatebyMonth($id ,$course_id,$start_date,$end_date){
		 $this->student->getalldates($id ,$course_id,$start_date,$end_date);
	}

    public function listall() {
        $data['title'] = 'customers';
        $data['settings'] = $this->student->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('student/list_all', $data); 
    }

    public function saveDoc()
    {
        $this->student->saveDoc();
    }

    /*
     ***********************************************************************************************
     * 
     * feeStructure: for retrieving fee structure
     * 
     * @author Althaf
     * @created on: 14-10-2019
     * 
     * *******************************************************************************************
     */

    public function feeStructure() {
        $data['title'] = 'customers';
        $data['settings'] = $this->student->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('student/feestructure', $data); 
    }

    public function feeSchedule() {
        $data['title'] = 'Fee Schedule';
        $data['settings'] = $this->student->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('student/feeschedule', $data); 
    }

    public function listDoc()
    {
        $data['settings'] = $this->student->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('student/list_document', $data); 
    }

    public function addDoc($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = $id;
        $data['enq_id'] = 0;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['eid'] = '';
        $data['option'] = 'create';
        $data['view'] = "create";
        $this->load->view('student/addDoc', $data);
    }

    public function deleteDoc($id)
    {
        $this->student->deleteDoc($id);
    }

    public function getDoc($id)
    {
        $this->student->getDoc($id);
    }

    function create($id = 0, $type = '') {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = $id;
        $data['enq_id'] = 0;

        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['eid'] = '';
        $data['option'] = $type;
        $data['view'] = "create";
        $this->load->view('student/create', $data);
    }

    function view($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['eid'] = '';
        $data['view'] = "view";
        $this->load->view('student/student_profile', $data);
    }



    function join($eid = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = 0;
        $data['eid'] = $eid;
        $data['enq_id'] = $eid;
        $data['option'] = 'join';
        $data['title'] = 'customer create';
        $data['type'] = 'stud_join';
        $data['view'] = "join";
        $this->load->view('student/create', $data);
    }
    public function getcourse($unid = 0)
    {
        return $this->student->getcourse($unid);
    }
	 public function getcourses($unid = 0)
    {
        return $this->student->getcourses($unid);
    }
	
	
    public function getAdmType()
    {
        return $this->student->getAdmType();
    }

    public function addAdmode()
    {
        $data = array(
            'name' => $this->input->post('adname'),
            'code' => $this->input->post('adid'),
        );
        return $this->student->addAdmode($data);
    }


    public function batch()
    {   
        $data['title'] = 'customers';
        $data['settings'] = $this->student->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'cus';
        $this->load->view('student/list_batch', $data); 
    }

    public function addBatch($batch = '')
    {
        $this->load->view('_blocks/subpages/create');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = $batch;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['view'] = "create";
        $data['option'] = "craete";
        $this->load->view('student/createBatch', $data);
    }

    public function getbatch($batch)
    {
       
        return $this->student->getbatch($batch);
    }

    public function save_fee(){
        $output = $this->student->save_fee();
        echo json_encode($output);

    }
    public function saveBatch()
    {
        $selMonth = $this->input->post('selMonth');
        $selYear = $this->input->post('selYear');
        $notes = $this->input->post('note');
        $start_date = $this->student->getDate($this->input->post('start_date'));
        $end_date = $this->student->getDate($this->input->post('end_date'));

        $batch = $selMonth.'-'.$selYear;

        $data = array(
            'month'=>$selMonth,
            'year'=>$selYear,
            'batch' => $batch,
            'note' => $notes,
            'start_date'=> $start_date,
            'end_date'=> $end_date 
        );

        return $this->student->saveBatch($data);
    }

    public function deleteBatch($id)    
    {
        return $this->student->deleteBatch($id);
    }

    public function deleteFee($id)
    {
        return $this->student->deleteFee($id);
    }
    public function deleteStudent($id)
    {
        return $this->student->deleteStudent($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * 
     * getAllBatch : Retriving every batches from the student table
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     * 
     **********************************************************************************************************
     */

    public function getAllBatch()
    {
        return $this->student->getAllBatch();
    }


    /**
     * *******************************************************************************************************
     * 
     * 
     * saveNextYear : save datas of student to the next year fee
     * 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     * 
     **********************************************************************************************************
     */

    public function saveNextYear($id = 0)
    {
		$batch = 11;
		if($this->input->post('batch')){
			$batch = $this->input->post('batch');
		}
        $stid = $this->input->post('myid');
        $data = array(
            'stud_id' => $stid,
            'course' => $this->input->post('course'),
            'batch' => $batch,  
            'refname' => $this->input->post('refby'),
            'refmob' => $this->input->post('refmob'),
            'totalfee' => $this->input->post('totalfees'),
            'university' => 0,
            'discountpercent' => $this->input->post('discountpercs'),
            'discountedfee' => $this->input->post('cost'),
            'payment_type'=> $this->input->post('payment_type'),
            'payment_duration'=> $this->input->post('mnths'),

        );
		if($this->input->post('universe')){
			$data['university'] = $this->input->post('universe');
		}
        

        return $this->student->saveNextYear($data);
    }

    public function getTotals($id)
    {
        return $this->student->getTotals($id);
    }
    

    

    public function getfee($id)
    {
        return $this->student->getfee($id);
    }

    public function getDetails($id)
    {
        return $this->student->getDetails($id);
    }

    /**
     * ********************************************************************************************************
     * addNextYear : Add student to the next year
     * 
     * 
     * @author Althaf
     * 
     * @created on: 17-10-2019
     * 
     * *********************************************************************************************************
     */


    public function addNextYear($id = 0)
    {

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['settings'] = $this->student->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['view'] = "create";
        $this->load->view('student/createNextYear', $data);

    }

    public function getFeeDetails($id){
        
        return $this->student->getFeeDetails($id);
    }

    public function getFeeSchedules($id){
        
        return $this->student->getFeeSchedules($id);
    }


    /**
     * **************************************************************************************************************
     * 
     * Function to get all details of student from student table
     * 
     * @author Althaf
     * 
     * @updated on 10-10-2019
     *  
     * ****************************************************************************************************************
     */

    public function getAll() {
        $search = strtolower($_GET['term']);
        return $this->student->getAll($search);
    }

    public function getlocation()
    {
        return $this->student->getlocation();
    }

    /**
     * **************************************************************************************************************
     * 
     * Function to get all details of student from student table
     * 
     * @author Althaf
     * 
     * @updated on 10-10-2019
     *  
     * ****************************************************************************************************************
     */

    public function checkPhone($phn = 0) {

        return $this->student->checkPhone($phn);
    }

    


    /**
     * Function for ssave the student into 'student' table
     * 
     * @author Althaf
     * @updated on 14-10-2019
     *  
     */

    public function save()
    {

    $new_name = "noimage";
    if (!isset($_FILES["file"]['name'])) {
                
        $new_name = "noimage";

    }
    else{       
        $ms = $_FILES['file'];

            $new_name = time() . $_FILES["file"]['name'];
            $config['upload_path'] = 'assets/images/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '2048';
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config); 
            if ($this->upload->do_upload('file')) {

                    $status = true;

            }
            
            else{

                $response = array(
                    'valid' => false,
                    'type' => 0,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;

            }
        }
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];

            $id = $this->input->post('id');
            

			
            $name = $this->input->post('name');
            $phone = $this->input->post('phone');
            $email = $this->input->post('email');
            $state = $this->input->post('states_cus');
            $pin = $this->input->post('stcode');
            $lan = $this->input->post('lan');
            $addr1 = $this->input->post('addr1');
            $addr2 = $this->input->post('addr2');
			 $qualify = 1;
			 if($this->input->post('qualify')){
				$qualify = $this->input->post('qualify');
			 }
            $qual = $this->input->post('qual');
            $adm_type = $this->input->post('adm_type');
            $universe = $this->input->post('universe');
            $course = $this->input->post('course');
            $remarks = $this->input->post('remarks');
            $aadhar = $this->input->post('aadhar');
            $dob = $this->input->post('dob');
            $gender = $this->input->post('gender');
            $age = $this->input->post('age');
            $father = $this->input->post('father');
            $mother = $this->input->post('mother');
            $enroll = $this->input->post('enroll');
            $mat = $this->input->post('mat');
            $status = $this->input->post('status');
            $ref = $this->input->post('ref');
            $refby = $this->input->post('refby');
            $refmob = $this->input->post('refmob');
            $cost = $this->input->post('cost');
            $batch = $this->input->post('batch');   
            $imageName = $new_name;



            
            $published = 'yes';
            $type = 'stud';

			

        
            

        $data = array(
            'allocid' => $userid,
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'cst' => $state,
            'pincode' => $pin,
            'lan' => $lan,
            'address_line1' => $addr1,
            'address_line2' => $addr2,
            'qualify' => $qualify,
            'course' => $course,
            'published' => $published,
            'plan' => $adm_type,
            'area' => $universe,
            'type' => $type,
            'route' => $qual,
            'price_list' => $cost,
            'batch' => $batch,
            'remarks' => $remarks,
            'adhar' => $aadhar,
            'dob' => $dob,
            'gender' => $gender,
            'age' => $age,
            'father' => $father,
            'mother' => $mother,
            'enrollment' => $enroll,
            'materials' => $mat,
            'stud_status' => $status,
            'reference' => $ref,
            'refby' => $refby,
            'refmob' => $refmob,
            'image' => $imageName,
        );
        if($this->input->post('last_name')){
			$data['last_name'] = $this->input->post('last_name');
		}
		 if($this->input->post('medical_condition')){
			$data['medical_condition'] = $this->input->post('medical_condition');
		}
		
		if($this->input->post('contact_name')){
			$data['contact_person'] = $this->input->post('contact_name');
		}
		if($this->input->post('contact_no')){
			$data['contact_number'] = $this->input->post('contact_no');
		}
        $this->student->save($data, $id);
   
    }


    public function ajax_list($ls = 0)
    {   
       // $this->student->where();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($item->name);
            $row[] = $item->phone;
            $row[] = $item->qualification;
            $row[] = $item->father;
            $row[] = $item->refby;

            
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Student/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/Student/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            // if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Student/listall' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'education/student/deleteStudent/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function fee_list($ls = 0)
    {   
        $this->student->feeStructure();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = ucfirst($item->stud_name);
          //  $row[] =ucfirst($item->coursename);
          //  $row[] = $item->univname;
         //   $row[] = $item->batches;
            $row[] = $item->totalfee;
            $row[] = $item->discountpercent;
            $row[] = $item->discountedfee;
            $act = '<a id = "edittor"  href="' . base_url() . 'education/Student/addNextYear/' . $item->feesid . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            // if ($itemcount == 0) {
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/Student/feeStructure' . '"  success="Delete ' . $item->stud_name . ' successfuly "  message="Do you want Delete ' . $item->feesid . '?"  href="' . base_url() . 'education/Student/deleteFee/' . $item->feesid . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function batch_list()
    {   
        $this->student->batch();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->batch;
                $act = '<a id = "edittor"  href="' . base_url() . 'education/Student/addBatch/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                &nbsp;<a tp="confirm" base="' . base_url() . '/education/Student/batch/' . '"  success="Delete ' . $item->batch . ' successfuly "  message="Do you want Delete ' . $item->id . '?"  href="' . base_url() . 'education/Student/deleteBatch/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }  

    /*
     ***********************************************************************************************
     * 
     * fetchCourse: for retrieving fetchCourse structure
     * 
     * @author Althaf
     * @created on: 14-10-2019
     * 
     * *******************************************************************************************
     */

    public function fetchCourse() {

        $this->student->fetchCourse();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $dates = substr($item->date,0,10);
            $row = array();
            $row[] = $no;
            $row[] = $item->coursename;
            $row[] = $item->universityname;
            $row[] = $dates;
            $row[] = $item->nbatch;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    /*
     ***********************************************************************************************
     * 
     * fetchCourse: for retrieving fetchCourse structure
     * 
     * @author Althaf
     * @created on: 14-10-2019
     * 
     * *******************************************************************************************
     */

    public function fetchFee() {

        $this->student->fetchFee();
        $this->student->wheres();
        $list = $this->student->get_datatables();
        $max = $this->student->max();
        $max_id = $max['max_id'];

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $student) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($student->vourcher_type != "journal") { 
                $row[] = $student->invoice;
            } else {
                $row[] = $student->voucher_no;
            }
            if ($student->vourcher_type != "journal") {
                $row[] = $student->naration;
            }
            $row[] = $student->trans_date;
            $row[] = str_replace(',', '<br/>', $student->names);
            $row[] = str_replace(';', '<br/>', $student->credit_amounnts);
            $row[] = str_replace(';', '<br/>', $student->debit_amounts);
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }

    public function doc_type() {
        return $this->student->doc_type();
    }
    
    public function savedocumenttotable($name)
    {
        return $this->student->savedocumenttotable($name);
    }

    public function getAlldocuments($stud)
    {
        return $this->student->getAlldocuments($stud);
    }

    public function deleterow($id)
    {
        return $this->student->deleterow($id);
    }

    function itemuploads($file, $type, $fileid) {
        $config['upload_path'] = 'uploads/images';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '6024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload($fileid);
    }

    public function savedocument() {
        if (isset($_FILES['document'])) {
            $file = $_FILES['document'];
            $type = 'image';
            //upload file  
            $fileid = 'document';

            $new_name = time() . str_replace(' ', '_', $_FILES['document']['name']);
            $_FILES['document']['name'] = $new_name;
            $imgname[0] = $new_name;
            $this->itemuploads($file, $type, $fileid);
            $fileid = 'document';
            print_r($new_name);
        } else {
            print_r('');
        }
    }

    public function fee_balance_list($ls = 0)
    {   
        $this->student->feeStructure();
        $this->student->where_fee_balance();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->coursename;
            $row[] = $item->univname;
            $row[] = $item->totalfee;
            $row[] = $item->discountpercent;
            $row[] = $item->discountedfee;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function document_list($ls = 0)
    {   
        $this->student->document_list();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->document_name;
            $row[] = $item->note;
            $act = ' <a  back="' . base_url() . 'education/Student/listDoc"  href="' . base_url() . 'education/Student/addDoc/' . $item->document_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'education/Student/listDoc' . '"  success="Delete ' . $item->document_name . ' successfuly "  message="Do you want to Delete ' . $item->document_name . '?"  href="' . base_url() . 'education/Student/deleteDoc/' . $item->document_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }


    public function getStudentCourse($id){

        $this->student->getStudentCourse($id);

    }


    public function getPaymentData(){


        $this->student->getPaymentData();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no.'&nbsp;<input   class="chk" type="checkbox" value="'.$item->payid.'" name="autoCheck"   id="chk'.$item->payid.'" /><input type="hidden" value="'.$item->balance.'" name="balance_amount[]" id="balance'.$item->payid.'" class="form-control">';
            $row[] = $item->name;
            $row[] = $item->date;
            $row[] = $item->amount;
            $row[] = $item->paid;

            if((float) $item->balance >0 ){
                $row[] = '<input type="hidden" value="'.$item->payid.'" name="table_id[]" class="form-control"><input  payid= "'.$item->payid.'" step="any" id="paying'.$item->payid.'" type="number" name="paying_amount[]"  class="form-control paying_amount" max="'.$item->balance.'" />';
            }else{ 
                $row[] = '<input type="hidden" value="'.$item->payid.'" name="table_id[]" class="form-control">Completed<input  ayid= "'.$item->payid.'"  id="paying'.$item->payid.'" type="hidden" name="paying_amount[]"  class="form-control paying" max="'.$item->balance.'" />';
            }

            $row[] = $item->balance;
          
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
	
	public function paymentBalanceRrport(){
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('student/pay_bal_report'); 
        
    }
	
	public function getpaymentBalanceRrport(){
        $this->student->getpaymentBalanceRrport();
        $list = $this->student->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] =  $no;
            $row[] = $item->name;
            $row[] = $item->phone;
            $row[] = $item->course;
            $row[] = $item->date;
			$row[] = $item->amount;
            $row[] = $item->paid;
            $row[] = $item->balance;
			$row[] = $item->balance;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        
    }
	
	
    public function paymentReport(){
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('student/crm_stud_report'); 
        
    }
    
    public function getPaymentReport(){

     
        $this->student->getPaymentReport();
        $list = $this->student->get_datatables();
        $data = array();
        $todat_date =date("Y-m-d");
        $today =   date_create(date("Y-m-d"));
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();

            $row[] =  $no;
            $row[] = $item->student;
            $row[] = $item->course;
            $row[] = $item->date;
            $date = date_create($item->date);
            if($todat_date > $item->date && $item->balance >0){

                $diff= date_diff($today,$date);
                $row[]= $diff->format("%a days");
            }
            else
                $row[]=0;
            $row[] = $item->amount;

            if($item->balance >0)
               $row[] = '<div class="btn btn-warning">Pending</div>';
            else
               $row[] = '<div class="btn btn-success">Completed</div>';


            // if((float) $item->balance >0 ){
            //     $row[] = '<input type="hidden" value="'.$item->payid.'" name="table_id[]" class="form-control"><input  payid= "'.$item->payid.'" step="any" id="paying'.$item->payid.'" type="number" name="paying_amount[]"  class="form-control paying_amount" max="'.$item->balance.'" />';
            // }else{ 
            //     $row[] = '<input type="hidden" value="'.$item->payid.'" name="table_id[]" class="form-control">Completed<input  ayid= "'.$item->payid.'"  id="paying'.$item->payid.'" type="hidden" name="paying_amount[]"  class="form-control paying" max="'.$item->balance.'" />';
            // }

            //$row[] = $item->balance;
          
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->student->count_all(),
            "recordsFiltered" => $this->student->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        
    }

    public function getAllCourse(){
        $search = strtolower($_GET['term']);
        return $this->student->getAllCourse($search);
    }
    

}