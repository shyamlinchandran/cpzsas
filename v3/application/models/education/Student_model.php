<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep 
 */
class Student_model extends DataTable
{

    /***************************************************************************************************
     * Ajax call function 
     * 
     * @author Althaf
     * @updated at 11-10-2019
     * 
     * 
     ***************************************************************************************************/

    public function __construct()
    {
        parent::__construct();
        $this->select = 's.*,a.qualification';
        //,c.name as group_name,d.name as unit,e.name as tax 
        $this->table = 'crm_student as s left join qualification as a on s.qualify = a.id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable   
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('s.id' => 'desc'); // default order 
    }


    /***************************************************************************************************
     * fee structure call function 
     * 
     * @author Althaf
     * 
     * @created on : 11-10-2019
     * @updated at : 18-10-2019
     * 
     * 
     ***************************************************************************************************/

    public function feeStructure()
    {

        $this->select = 'f.id as feesid, u.name as univname, b.batch as batches, f.*, i.name as coursename,cs.*, cs.name as stud_name';
        $this->table = 'feestructure as f inner join item as i on f.course = i.id inner join crm_student as cs on f.stud_id = cs.id left join university_type as u on u.id = f.university left join crm_batch as b on b.id = f.batch';
        $this->column_order = array(null, 'stud_name'); //set column field database for datatable orderable   
        $this->column_search = array('cs.name', 'i.name', 'u.name'); //set column field database for datatable searchable 
        $this->order = array('f.id' => 'desc'); // default order 
    }

    public function where_fee_balance()
    {
        $id = $this->input->post('supid');
        $this->wherecondition = 'where f.stud_id = '.$id;
    }

    /***************************************************************************************************
     * batch call function 
     * 
     * @author Althaf
     * @created at 18-10-2019
     * 
     * 
     ***************************************************************************************************/

    public function batch()
    {
		
        $this->select = '*, crm.id as crmid';
        $this->table = 'crm_batch as crm';
        $this->column_order = array(null, 'batch'); //set column field database for datatable orderable   
        $this->column_search = array('batch'); //set column field database for datatable searchable 
        $this->order = array('crmid' => 'desc'); // default order 
    }

    public function saveBatch($data)
    {
		if($this->input->post('start_hours')){
			$data['start_time'] = $this->input->post('start_hours').':'.$this->input->post('start_min');
			$data['start_hours'] = $this->input->post('start_hours');
		}
		if($this->input->post('start_min')){
			$data['start_min'] = $this->input->post('start_min');
		}
		if($this->input->post('end_hours')){
			$data['end_time'] = $this->input->post('end_hours').':'.$this->input->post('end_min');
			$data['end_hours'] = $this->input->post('end_hours');
		}
		if($this->input->post('end_min')){
			$data['end_min'] = $this->input->post('end_min');
		}
		$id = $this->input->post('id');
        if ($id) {
            $this->db->where('id', $id);
            $this->db->update('crm_batch', $data);

            $data2 = array(
                'batch' => $id,
            );
            // $this->db->where('batch', $id);
            // $this->db->update('feestructure', $data2);

            // $this->db->where('batch', $id);
            // $this->db->update('crm_student', $data2);

            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully',
            );

            echo json_encode($response);
        } else {

            $this->db->insert('crm_batch', $data);
            $insert_id = $this->db->insert_id();

            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully',
            );

            echo json_encode($response);
        }
    }

    public function deleteBatch($id)
    {
        $qry = "DELETE FROM crm_batch where id = " . $id;
        $this->db->query($qry);
    }
	
    public function getTotals($id)
    {
        $qry = "SELECT SUM(totalfee) as fee, SUM(discountpercent) as discount, SUM(discountedfee) as total from feestructure as fee where stud_id = ".$id;
        $result = $this->db->query($qry);
        $qry = "SELECT id from acc_ledgers where ref_code = 'stud' and ref_id = " .$id;
        $res = $this->db->query($qry)->row_array();
        $ledger_id = $res['id'];
        $amt = $this->getLedegerbalance(date('d/m/Y'), $ledger_id, 'cl', 0);
            if ($amt < 0) {
                round(($amt * -1), 2) . ' Cr';
            } else {
                $amt . ' Cr';
            }

        
        
        $r = $result->row_array();
        $r['balance'] = $amt;
        echo json_encode($r);
    }

    public function deleteFee($id)
    {
        $qry = "DELETE FROM feestructure where id = " . $id;
        $this->db->query($qry);

        $data = array(
            'published' => 'no'
        );

        $this->db->where('tb_id', $id);
        $this->db->update('acc_ledger_trans', $data);
    }

    public function deleteStudent($id)
    {
        $qry = "DELETE FROM crm_student where id = " . $id;
        $this->db->query($qry);

        $qry = "DELETE FROM feestructure where stud_id = " . $id;
        $this->db->query($qry);
    }

    var $sup = 5;
    var $cus = 1;

    /**
     ****************************************************************************************************
     * 
     * Where function call from ajax
     * 
     * @author Althaf
     * @updated on 11-10-2019
     * 
     * 
     ****************************************************************************************************
     */

     public function saveDoc()
     {
        $type = $this->input->post('type');
        $note = $this->input->post('note');

        $status = '';
        $data = array(
            'document_name' => $type,
            'note' => $note,
        );

        if($this->input->post('id') > 0){
            $this->db->where('document_id', $this->input->post('id'));
            $this->db->update('document_type', $data);
            $status = 'Updated';

        }
        else{
            $this->db->insert('document_type', $data);
            $status = 'Saved';
        }

        $response = array(
            'status' => TRUE,
            'message' => $status . 'Successfully',
        );

        echo json_encode($response);
     }

     public function deleteDoc($id) 
     {
            $qry = "delete from document_type where document_id = " .$id;
            $this->db->query($qry);
     }

    function where()
    {


        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];

        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];

        $batch = $this->input->post('batch');

        $university = $this->input->post('university');

        // print_r($usertype);
        $this->wherecondition = " where 1 ";
        $this->wherecondition = $this->wherecondition . " and acc.ref_code = 'stud' ";

        if ($this->input->post('batch')) {
            $this->wherecondition =  $this->wherecondition . " and s.batch = '" . $batch . "'";
        }
        if ($this->input->post('university')) {

            $this->wherecondition =  $this->wherecondition . " and s.area = '" . $university . "'";
        }
    }

    /**
     ****************************************************************************************************
     * 
     * getAllBatch function will retrive all batches from student table
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ****************************************************************************************************
     */

    public function checkPhone($phn)
    {
        // $phn = $this->input->post('phone');
        $qry = "Select * from crm_student where phone = " . $phn;
        $res = $this->db->query($qry);
        // echo json_encode($res->row_array());
        if ($res->num_rows() > 0) {
            $response = array(
                'status' => true,
            );
            echo json_encode($response);
        } else {
            $response = array(
                'status' => false,
            );
            echo json_encode($response);
        }
    }

    /**
     ****************************************************************************************************
     * 
     * getAllBatch function will retrive all batches from student table
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ****************************************************************************************************
     */

    public function getAllBatch()
    {
        $qry = "select note,start_time,end_time,id, batch,DATE_FORMAT(start_date,'%d/%m/%Y') as start_date,DATE_FORMAT(end_date,'%d/%m/%Y') as end_date  from crm_batch";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getDoc($id)
    {
        $qry = "select * from document_type where document_id = " .$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

   
    public function  document_list()
    {
        $this->select = '*';
        $this->table = 'document_type';
        $this->column_order = array(null, 'document_id'); //set column field database for datatable orderable   
        $this->column_search = array('document_name'); //set column field database for datatable searchable 
        $this->order = array('document_id' => 'desc'); // default order 
    }

    /**
     ****************************************************************************************************
     * 
     * fetchCourse function will retrive all batches from student table
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ****************************************************************************************************
     */

    public function fetchCourse()
    {
        $id = $this->input->post('supid');
        $this->select = 'f.*, i.name as coursename, u.name as universityname, c.batch as nbatch';
        $this->table = 'feestructure as f inner join item as i on f.course = i.id left join university_type as u on f.university = u.id left join crm_batch as c on c.id = f.batch';
        $this->wherecondition = 'where f.stud_id = '.$id;
        $this->column_order = array(null, 'stud_name'); //set column field database for datatable orderable   
        $this->column_search = array('cs.name', 'i.name', 'u.name'); //set column field database for datatable searchable 
        $this->order = array('f.id' => 'desc'); // default order 
    }

    /**
     ****************************************************************************************************
     * 
     * fetchFee function will retrive all batches from student table
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ****************************************************************************************************
     */

    public function fetchFee()
    {
        $this->select = 'voucher_no  as invoice, a.published as  pub, a.id as v_id,a.*, GROUP_CONCAT(c.name) AS names ,GROUP_CONCAT(FORMAT(b.credit_amounnt,2) SEPARATOR \';\') AS credit_amounnts ,GROUP_CONCAT(FORMAT(b.debit_amount,2) SEPARATOR \';\') AS debit_amounts';
        $this->table = '`voucher` as a inner join voucher_trans as b on a.id =b.voucher_id inner join  acc_ledgers as c on b.acc_ledgers_id=c.id';
        $this->column_order = array(null, 'name', 'naration', 'trans_date', 'amount', 'vourcher_type', 'voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'c.name', 'a.trans_date'); //set column field database for datatable searchable
        $this->order = array('a.id' => 'desc'); // default order
        $this->group = "a.id"; // default order
    } 

    function wheres() {
        $id = $this->input->post('supid');
        $this->wherecondition = 'where 1';
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        // if ($this->input->post('type')) {
        $this->wherecondition = $this->wherecondition . " and  b.published ='yes' and vourcher_type = 'receipt'";
            // if ($this->input->post('type') != 'journal') {
            //     $this->wherecondition = $this->wherecondition . " and   b.acc_ledgers_id !=" . $this->cashaccount . "";
            // }
        // }
        $this->wherecondition = $this->wherecondition . " and c.ref_id = " .$id;
        // if ($this->input->post('supid')) {

        //     if ($this->wherecondition == '') {
        //         $this->wherecondition = "where a.id = '" . $this->input->post('supid') . "'";
        //     } else {
        //         $this->wherecondition = $this->wherecondition . "and a.id = '" . $this->input->post('supid') . "'";
        //     }
        // }
    }

    function max() {
        $qry = 'select max(id) as max_id from voucher where vourcher_type ="' . $this->input->post('type') . '"';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    public function getbatch($batch)
    {
        $qry = "select a.*,DATE_FORMAT(start_date,'%d/%m/%Y') as start_dates,DATE_FORMAT(end_date,'%d/%m/%Y') as end_dates from crm_batch as a where id = '" . $batch . "'";
        $result = $this->db->query($qry);
        // print_r($qry);
        // exit();
        echo json_encode($result->row_array());
    }


    /**
     ****************************************************************************************************
     * 
     * saveNextYear function will save all next year fee details
     * 
     * @author Althaf
     * @created on 12-10-2019
     * 
     * 
     ****************************************************************************************************
     */

    public function saveNextYear($data)
    {
        $id = $this->input->post('id');
        $insert_id  = $id;


        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $stid = $this->input->post('myid');

        $qry = "SELECT acc.id as ledgerid, s.*, s.id as studid from crm_student as s inner join acc_ledgers as acc on acc.ref_id = s.id  where s.id = " . $stid;
        $res = $this->db->query($qry)->row_array();
        $ledgerid = $res['ledgerid'];

        $date = date('y-m-d');
        $total = $this->input->post('cost');
        $stuid = $this->input->post('myid');

        $payment_date = $this->input->post('fee_date',TRUE);
        $payment_amount = $this->input->post('payment_amount',TRUE);
        $payment_duration = $this->input->post('mnths');
		$batch = 11;
		if($this->input->post('batch')){
			$batch = $this->input->post('batch');
		}


        if ($id > 0) {
			
            $data2 = array(
                'stud_id' => $stid,
                'course' => $this->input->post('course'),
                'batch' => $batch,
                'totalfee' => $this->input->post('totalfees'),
                'discountpercent' => $this->input->post('discountpercs'),
                'discountedfee' => $total,
                'payment_type'=> $this->input->post('payment_type'),
                'payment_duration'=> $this->input->post('mnths'),
    
            );
			if($this->input->post('payment_method')){
				$data2['payment_method'] = $this->input->post('payment_method');
			}
			if($this->input->post('payment_note')){
				$data2['payment_note'] = $this->input->post('payment_note');
			}
			if($this->input->post('duration')){
				$data2['no_of_classes'] = $this->input->post('duration');
			}
			if($this->input->post('tutfee')){
				$data2['fee_tutfee'] = $this->input->post('tutfee');
			}
			if($this->input->post('discount_per')){
				$data2['fee_discount_per'] = $this->input->post('discount_per');
			}
			if($this->input->post('discount_amount')){
				$data2['fee_discount_amount'] = $this->input->post('discount_amount');
			}
			
			if($this->input->post('fees')){
				$data2['fees_amount'] = $this->input->post('fees');
			}
			
			if($this->input->post('fee_end_date')){
				$data2['fee_end_date'] = $this->getDate($this->input->post('fee_end_date'));
			}
			if($this->input->post('fee_start_date')){
				$data2['fee_start_date'] = $this->getDate($this->input->post('fee_start_date'));
			}
			if($this->input->post('universe')){
				$data2['university'] = $this->input->post('universe');
			}
			if($this->input->post('txtabsent') ){
				$data2['leave_days'] = $this->input->post('txtabsent');
			}
          
            $this->db->where('id', $id);
            $this->db->update('feestructure', $data2);

           
            $updatedata = array(
                'published' => 'no'
            );

            $this->db->where('tb_name', 'fee');
            $this->db->where('tb_id', $id);
            $this->db->update('acc_ledger_trans', $updatedata);
            $this->db->where('tb_name', 'stud');
            $this->db->where('tb_id', $id);
            $this->db->update('acc_ledger_trans', $updatedata);
        }

         else {
			if($this->input->post('payment_method')){
				$data['payment_method'] = $this->input->post('payment_method');
			}
			if($this->input->post('payment_note')){
				$data['payment_note'] = $this->input->post('payment_note');
			}
			if($this->input->post('duration')){
				$data['no_of_classes'] = $this->input->post('duration');
			}
			if($this->input->post('txtabsent') ){
				$data['leave_days'] = $this->input->post('txtabsent');
			}
			if($this->input->post('fee_end_date')){
				$data['fee_end_date'] = $this->getDate($this->input->post('fee_end_date'));
			}
			if($this->input->post('fee_start_date')){
				$data['fee_start_date'] = $this->getDate($this->input->post('fee_start_date'));
			}
			if($this->input->post('tutfee')){
				$data['fee_tutfee'] = $this->input->post('tutfee');
			}
			if($this->input->post('discount_per')){
				$data['fee_discount_per'] = $this->input->post('discount_per');
			}
			if($this->input->post('discount_amount')){
				$data['fee_discount_amount'] = $this->input->post('discount_amount');
			}
			
			if($this->input->post('fees')){
				$data['fees_amount'] = $this->input->post('fees');
			}
			
            $this->db->insert('feestructure', $data);
            $insert_id = $this->db->insert_id();
            $total = $data['discountedfee'];
        }
        
        $this->db->where('fee_table_id',$insert_id);
        $this->db->delete('crm_student_feeschedules');


        for($i=0; $i<$payment_duration;$i++){

            $fee_data=[

                'stud_id'=>$stuid,
                'fee_table_id'=>$insert_id,
                'date'=>$payment_date[$i],
                'amount'=>$payment_amount[$i]
            ];
            $this->db->insert('crm_student_feeschedules', $fee_data);

        }
      

        $this->trans_save($name, $insert_id, 'fee', 'stud', $this->sales, $ledgerid, $date, '0.00', $total, 'narration', 1, 0, 0);
        $this->trans_save($name, $insert_id, 'fee', 'stud', $ledgerid, $this->sales, $date, $total, '0.00', 'narration', 1, 0, 0);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response); 
        return 0;
    }


	 public function getcourses($unid = 0)
    {
        $qry = "select * from item where item_type_id = 3  ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    public function getcourse($unid = 0)
    { 
		$settings = $this->getCompanySettings();
        $qry = "select * from item where item_type_id = 3 and university = " . $unid;
		if(isset($settings[0]['is_calendar']) ){
			if((float) $settings[0]['is_calendar'] > 0 ){
				$qry = "select * from item where item_type_id = 3 " ;
			}
		}
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getDetails($id)
    {
        $qry = "select * from crm_student where id =".$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function getlocation()
    {
        $qry = "select * from state where 1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function addAdmode($data)
    {
        $this->db->insert('admit_type', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $response = array(
                'valid' => true,
                'type' => $insert_id,
                'message' => 'Saved Successfully',
            );
        } else {
            $response = array(
                'valid' => false,
                'type' => 0,
                'message' => 'Something Went Wrong',
            );
        }

        echo json_encode($response);
    }

    public function deleterow($id)
    {
        $qry = "delete from document_upload where id = " . $id;
        $result = $this->db->query($qry);
    }

    function doc_type() {
        $qry = "select a.* from document_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["document_id"] . '">' . $row["document_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    public function savedocumenttotable($name)
    {
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];

        $stud = $this->input->post('stud_id');
        $doc_type = $this->input->post('doc');

        $data = array(
            'stud_id' => $stud,
            'user' => $userid,
            'document_type' => $doc_type,
            'document' => $name,
        );

        $this->db->insert('document_upload', $data);
    }

    public function getAlldocuments($stud)
    {
        $qry = "select du.*,dt.document_name as dname from document_upload as du inner join document_type as dt on du.document_type = dt.document_id where stud_id = " .$stud;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getAdmType()
    {
        $qry = "select * from admit_type";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getfee($id)
    {
        $qry = "select * from item where id = " . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getFeeDetails($id)
    {

        $qry = "select fee.*,fee.university as universe, fee.course as courses, crm.name as studname, crm.phone as mob,items.name as coursename, crm.batch as batches, u.name as univname from feestructure as fee inner join crm_student as crm on fee.stud_id = crm.id inner join item as items on fee.course = items.id left join university_type as u on fee.university = u.id where fee.id =" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
	
	function getalldates($id ,$course_id,$start_date,$end_date){
		//$qry = "select * from crm_batch where id = ".$batch;
		//$query = $this->db->query($qry)->row_array();
		//$start = $query['start_time'];
		//$end = $query['end_time'];
		$qry = "select * from feestructure where course = ".$course_id." and   id = ".$id; 
		$query = $this->db->query($qry);
		$in = '0';
		if($query->num_rows() > 0 ){
			$query= $query->row_array();
			if($query['leave_days'] != ''){
				$in = $query['leave_days'];
			}
		}
		$start = '';
		$qry = "SELECT idDate as id,concat(b.fulldate) as start,concat(b.fulldate) as end,b.dayOfWeek,b.weekend,a.course_start_date,a.name as title,case when idDate in (".$in.") then 'Absent'  else 'Working' end as type,case when idDate in (".$in.") then 'Red'  else 'green' end as backgroundColor FROM `item` as a INNER JOIN dates as b on b.fulldate >= '".$start_date."' and b.fulldate <= '".$end_date."' WHERE id = ".$course_id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
    
    public function getFeeSchedules($id)
    {

         $this->db->where('fee_table_id',$id);
         $result =$this->db->get('crm_student_feeschedules');
        echo json_encode($result->result_array());
    }



    /**
     * Function For get all student from crm_student table
     * 
     * @author Althaf
     * @updated on 14-10-2019
     * 
     */

    function getAll($search)
    {
        $qry = "select b.id as ledger_id,a.id,a.name as label,a.* from crm_student as a inner join acc_ledgers as b on b.ref_id = a.id and b.ref_code in ('stud') where  a.name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function save($data)
    {

        $cost = $this->input->post('cost');
        $course = $this->input->post('course');
        $discountpercent = $this->input->post('discountpercs');
        $totalwithoutdisc = $this->input->post('totalfees');
        $batch = $this->input->post('batch');
        $id = $this->input->post('id');

        // if($id > 0){
        //     $this->db->where('id', $id);
        //     $this->db->update('crm_student', $data);
        // }

        $qry = "select * from crm_student where phone = " . $data['phone'];
        $result = $this->db->query($qry);
        if ($result->num_rows() > 0 && $id < 1) {

            $response = array(
                'valid' => false,
                'type' => 0,
                'message' => 'customer phone exists'
            );
            echo json_encode($response);
            return;
        } else {

            $data2 = array(
                'allocid' => $data['allocid'],
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'],
                'cst' => $data['cst'],
                'pincode' => $data['pincode'],
                'lan' => $data['lan'],
                'address_line1' => $data['address_line1'],
                'address_line2' => $data['address_line2'],
                'qualify' => $data['qualify'],
                'route' => $data['route'],
                'remarks' => $data['remarks'],
                'adhar' => $data['adhar'],
                'gender' => $data['gender'],
                'age' => $data['age'],
                'father' => $data['father'],
                'mother' => $data['mother'],
                'enrollment' => $data['enrollment'],
                'materials' => $data['materials'],
                'stud_status' => $data['stud_status'],
                
            );
			if($this->input->post('last_name')){
				$data2['last_name'] = $this->input->post('last_name');
			}
			if($this->input->post('medical_condition')){
				$data2['medical_condition'] = $this->input->post('medical_condition');
			}
			if($this->input->post('contact_name')){
				$data2['contact_person'] = $this->input->post('contact_name');
			}
			if($this->input->post('contact_no')){
				$data2['contact_number'] = $this->input->post('contact_no');
			}
			if($this->input->post('emergency_contact')){
				$data2['emergency_contact'] = $this->input->post('emergency_contact');
			}
            if($data['image'] != 'noimage'){
                $data2['image'] = $data['image'];
            }

            if ($id > 0) {
                $this->db->where('id', $id);
                $this->db->update('crm_student', $data2);
                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Updated Successfully',
                );
                echo json_encode($response);


                return;
            }

            

            $this->db->insert('crm_student', $data);
            $insert_id = $this->db->insert_id();
           
            $ledger_data = array(
                "name" => $data['name'],
                "name_lan" => 0,
                "code" => $data['phone'],
                "ref_id" => $insert_id,
                "ref_code" => 'stud',
                "is_default" => true,
                "acc_main_id" => 25,
                "openning_bal" => 0,
                "type" => 0,
                "published" => 'yes'
            );

            $this->db->insert('acc_ledgers', $ledger_data);
           // $ledgers_code = $this->db->insert_id();

             //sending sms
            // $date = date('Y-m-d');
            // $qq = "SELECT i.name as coursename from item as i where i.id = " .$course;
            // $res = $this->db->query($qq)->row_array();
            // $cour = $res['coursename'];

            // $this->sendsms($data['phone'], $cour,  1, $data['name'], $date);


            // if($this->input->post('eid')){
            //     $d = array(
            //         'status' => 5,
            //         'stud_id' => $insert_id,
            //     );
            //     $this->db->where('id', $this->input->post('eid'));
            //     $this->db->update('enquiry_register', $d);
            // }



            // $data2 = array(
            //     'stud_id' => $insert_id,
            //     'batch' => $batch,
            //     'course' => $course,
            //     'university' => $data['area'],
            //     'totalfee' => $totalwithoutdisc,
            //     'discountpercent' => $discountpercent,
            //     'discountedfee' => $cost,
            //     'refname' => $data['refby'],
            //     'refmob' => $data['refmob']

            // );

            // $this->db->insert('feestructure', $data2);
            // $insert_id2 = $this->db->insert_id();

          
        //     $updatedata = array(
        //         'published' => 'no'
        //     );
        //     $date = date('y-m-d');
        //     $this->db->where('tb_name', 'stud');
        //     $this->db->where('tb_id', $insert_id);
        //     $this->db->update('acc_ledger_trans', $updatedata);
        //     $this->trans_save($data['name'], $insert_id2, 'stud', $data['name'], $this->sales, $ledgers_code, $date, '0.00', $data['price_list'], 'narration', 1, 0, 0);
        //     $this->trans_save($data['name'], $insert_id2, 'stud', $data['name'], $ledgers_code, $this->sales, $date, $data['price_list'], '0.00', 'narration', 1, 0, 0);

            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully',
            );
            echo json_encode($response);
            return;
        }
    }




    public function sms_config()
    {
        $qry = "SELECT * from sms_settings ";
        $res = $this->db->query($qry);
        return $res->row_array();
    }

    public function sms_content($type)
    {
        $qry = "SELECT * from sms as sm inner join sms_type as smtype where smtype.id =" .$type;
        $res = $this->db->query($qry);
        return $res->row_array();
    }

    function sendsms($phone, $course, $type , $name , $date, $otp = "", $companyid = "", $amount = 0,$ref_id = 0,$bill_url = "") {
        //type 1 for otp , type 2 for welcome message
        $this->load->model('education/Student_model', 'student');
        /* json_request_body = file_get_contents('php://input');
          $tmp = (array) json_decode($json_request_body); */
        //$type = $tmp['type'];
        //$type = 1;
        $sms_config = $this->sms_config();
        $username = $sms_config['username'];
        // $username = 'ppta';
        $api_password = $sms_config['api_password'];
        // $api_password = '75ae624jkltrx7wpc';
        $sender = $sms_config['sender'];
        // $sender = 'PPTAKD';
        $priority = $sms_config['priority'];
        // $priority = 11;
        $is_default = $sms_config['is_default'];
        $url = $sms_config['url'];
        // $url = 'http://alert.winhosting.in/pushsms.php?';
        $to = $phone;
        $sms_data = $this->sms_content($type);
        $sms_content = $sms_data['sms'];
        $message = str_replace('#otp#', $otp, $sms_content); //replace otp with value
        $message = str_replace('#course#', $course, $message);
        $message = str_replace('#name#', $name, $message);
        $message = str_replace('#companyid#', $companyid, $message);
        $message = str_replace('#date#', $date, $message);
        $message = str_replace('#amount#', $amount, $message);
        $message = str_replace('#url#', $bill_url, $message);
        $full_path = $url . 'username=' . $username . '&api_password=' . $api_password . '&sender=' . $sender . '&to=' . $to . '&message=' . $message . '&priority=' . $priority;
        $full_path = preg_replace("/ /", "%20", $full_path);
        $fp = fopen($full_path, "r");
        $response = stream_get_contents($fp);
        fpassthru($fp);
        fclose($fp);
        $sms_data = array(
            'phone' => $phone,
            'message' => $message,
            'reference_id' => $ref_id,
//            'sms_type' => $type
        );
        // $this->student->sms_log($sms_data);
    }

    public function getStudentCourse($id){

        $this->db->where('stud_id',$id);
        $result = $this->db->select('a.course as course_id,c.name as course')->from('feestructure as a')->join('crm_student as b', 'a.stud_id = b.id')->join('item as c', 'a.course = c.id')->get()->result_array();
        echo json_encode($result);
    }

    public function getPaymentData(){


        $this->select = ' sum(a.amount- a.paid) as balance,c.name,a.date ,a.amount,a.paid,a.id as payid';
        $this->table = 'crm_student_feeschedules  as a inner join feestructure as b on a.fee_table_id = b.id inner join  item as c on b.course=c.id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array(); //set column field database for datatable searchable
        $this->order = array('a.id' => 'asc'); // default order
        $this->group = "a.id";
        $course = $this->input->post('course_id');
        $stud_id = $this->input->post('stud_id');
        $this->wherecondition = 'where b.stud_id ='.$stud_id.' and   b.course ='.$course;

    }

    public function save_fee(){
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $date = $this->getDate($this->input->post('date'));
        $btype = $this->input->post('btype');
        $new_invoice =  $this->input->post('new_invoice');
        $student_id =  $this->input->post('student_id');
        $ledger_id =  $this->input->post('ledger_id');
        $course =  $this->input->post('course');
        $narration =  $this->input->post('narration');
        $table_id = $this->input->post('table_id',true);
        $paying_amount = $this->input->post('paying_amount',true);
        $ledger = $this->input->post('frmact');
        $amount = $this->input->post('amount');
		$total = 0;
		$insert_id = 0;
		if($this->input->post('table_id',true)){
			$length = sizeof($table_id);
			for($i=0;$i<$length;$i++){
				$paid = $paying_amount [$i];
				if($paid == ''){
					$paid = 0;
				}
				$total = (float) $total + (float) $paid;
				$qry = "update crm_student_feeschedules set paid = paid+".$paid." where id=".$table_id[$i];
				$this->db->query($qry);
			}
		}           
        if((float) $amount > 0 ){
            $data = array(
                'ledger' => $ledger_id,
                'amount' => $amount,
                'cost_center' => 0,
                'vourcher_type'=>'course',
                'naration' => $narration,
                'trans_date' => $date,
                'created_by' => $created_by,
                'created_date' => date('Y-m-d'),
                'is_post' => "yes",
                'bill_type' => $btype,
                'published' => "yes",
                'voucher_invoice'=>$new_invoice,
                'voucher_no'=>$new_invoice
            );
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
            $this->trans_save($new_invoice, $insert_id, 'voucher', "course", $ledger_id, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], 1, 1);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($new_invoice, $insert_id, 'voucher', "course", $ledger, $ledger_id, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], 1, 1);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $student_id . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);
        }
        $response = array(
            'valid' => true,
            'message' => $this->msgcheck($insert_id, 'voucher'),
            'id' => $insert_id
        );
        return $response;

    }
	
	public function getpaymentBalanceRrport(){
		$this->select = "d.name,d.phone,d.address_line1,c.name as course,a.stud_id,a.date,a.amount,a.paid,a.amount-a.paid as balance";
		$this->table = " crm_student_feeschedules as a inner join feestructure as b on a.fee_table_id = b.id inner join item as c on b.course=c.id INNER JOIN crm_student as d on d.id =a.stud_id";
		$this->column_order = array('a.date','d.name','c.name'); //set column field database for datatable orderable
        $this->column_search = array('d.name','c.name','a.date'); //set column field database for datatable searchable
		$this->wherecondition = ' where 1';
		$this->order = array('a.date' => 'asc'); // default order
		$start_date = $this->getDate($this->input->post('start_date'));
        $end_date =  $this->getDate($this->input->post('end_date'));
        $student_id =$this->input->post('student_id');
        $course_id =$this->input->post('course_id');
		if( $start_date ){
			$this->wherecondition =  $this->wherecondition .' and a.date >="'.$start_date .'"';      
        }
		if($end_date){
			 $this->wherecondition =  $this->wherecondition .' and a.date <="'.$end_date .'"';
		}
		if($course_id){     
			$this->wherecondition =  $this->wherecondition .' and b.course ="'.$course_id .'"';
		}
		if($student_id){ 
			$this->wherecondition =  $this->wherecondition .' and a.stud_id ="'.$student_id .'"';
         }
	}

    public function getPaymentReport(){


        $this->select = 'sum(a.amount- a.paid) as balance , a.date,a.amount,c.name as course,d.name as student';
        $this->table = 'crm_student_feeschedules  as a inner join feestructure as b on a.fee_table_id = b.id inner join  item as c on b.course=c.id inner join acc_ledgers as d on a.stud_id= d.ref_id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array('d.name','c.name'); //set column field database for datatable searchable
        $this->group = "a.id";
        $this->order = array('a.id' => 'asc'); // default order
        $this->wherecondition = '';
            $start_date = $this->getDate($this->input->post('start_date'));
            $end_date =  $this->getDate($this->input->post('end_date'));
            $student_id =$this->input->post('student_id');
            $course_id =$this->input->post('course_id');

            $status =$this->input->post('status');

            if( $start_date ){

                $this->wherecondition =  $this->wherecondition .' where a.date >="'.$start_date .'"';
                
            }
            if($end_date){

                if($this->wherecondition ){

                    $this->wherecondition =  $this->wherecondition .' and a.date <="'.$end_date .'"';

                }else{
                    $this->wherecondition =  $this->wherecondition .' where a.date <="'.$end_date .'"';

                }

            }
            if($student_id){ 

                if($this->wherecondition ){

                    $this->wherecondition =  $this->wherecondition .' and a.stud_id ="'.$student_id .'"';

                }
                else{
                    $this->wherecondition =  $this->wherecondition .' where a.stud_id ="'.$student_id .'"';

                }
            }
                if($course_id){ 

                    if($this->wherecondition ){
    
                        $this->wherecondition =  $this->wherecondition .' and b.course ="'.$course_id .'"';
    
                    }
                    else{
                        $this->wherecondition =  $this->wherecondition .' where b.course ="'.$course_id .'"';
    
                    }

            }
            if($status == 'completed'){

                $this->having = 'balance = 0';

            }
            if($status == 'pending'){
                $this->having = 'balance > 0';

            }
        // $this->group = "a.id";
        // $course = $this->input->post('course_id');
        // $stud_id = $this->input->post('stud_id');
        // $this->wherecondition = 'where b.stud_id ='.$stud_id.' and   b.course ='.$course;

    }

    public function getAllCourse($search){
        $qry = "select a.id,a.name as label from item as a where  a.name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());

    }


}