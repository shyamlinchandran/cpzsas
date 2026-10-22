<?php

class Attendance_model extends Datatable{

    public function __construct() {
        parent::__construct();
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        
    }
	
	public function getallstudent(){
		$qry = "SELECT concat(b.name,'-',c.name) as label,a.id as item FROM `feestructure` as a INNER JOIN crm_student as b on a.stud_id = b.id INNER JOIN item as c on c.id = a.course";
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	public function getallclasses(){
		$qry = "select * from yoga_classes ";
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	
	}

	public function where_all(){
		$this->select =  " b.name as student,e.cls_name,a.date ,c.time,d.name as course";
		$this->table =  "`attendance` as a INNER join crm_student as b on a.student = b.id INNER JOIN yoga_times as c on c.time_id = a.time INNER JOIN item as d on d.id = a.course INNER join yoga_classes as e on e.cls_id =a.class";
		$this->wherecondition = " WHERE a.published ='yes'";
		$this->wherecondition = $this->wherecondition ." and e.cls_id = ".$this->input->post('class');
		$this->wherecondition = $this->wherecondition ." and c.time_id  = ".$this->input->post('time');
		$this->wherecondition = $this->wherecondition ." and a.date  = '".$this->getDate($this->input->post('date'))."' ";
		$this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array(null, 'b.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'asc'); // default order 
	}
	public function where(){
		
		$this->select = ''.$this->input->post('class').' as class,'.$this->input->post('time').' as times,"'.$this->getDate($this->input->post('date')).'" as attendance_date,CASE WHEN d.attendance_id is null then "absent" else "present" end as "status" ,a.id as package,b.id as student,c.id as course,b.name,c.name as  coursename';
		$this->table = '  `feestructure` as a INNER JOIN crm_student as b on a.stud_id = b.id INNER JOIN item as c on c.id =a.course left join attendance as d on d.package = a.id and d.date= "'.$this->getDate($this->input->post('date')).'" and class  = '.$this->input->post('class').'  and time  = '.$this->input->post('time').' ';
		if($this->input->post('student')){
			$this->wherecondition = $this->wherecondition .' where b.id = '.$this->input->post('student');
		}
		if($this->input->post('class')){
			//$this->wherecondition = $this->wherecondition .' and c.id = '.$this->input->post('class');
		}
		if($this->input->post('date')){
			//$this->wherecondition = $this->wherecondition .' and fulldate = "'.$this->getDate($this->input->post('date')).'"';
		}
		//$this->wherecondition = $this->wherecondition .' and NOT FIND_IN_SET(idDate,leave_days) ';
		$this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array(null, 'b.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'asc'); // default order 
	}
	
	public function getallstudentpackage($id){
		$qry = "SELECT b.no_of_classes - b.attended_classes as balance,c.name,b.* FROM `crm_student` as a INNER JOIN feestructure as b on a.id = b.stud_id INNER JOIN item as c on c.id = b.course WHERE b.attended_classes < b.no_of_classes and a.id = ".$id;
		$result = $this->db->query($qry)->result_array();
		$op = '<option balance="0" value="" >Select </option>';
		foreach($result as $item){
			$op = $op . '<option balance = "'.$item['balance'].'" value="'.$item['id'].'" >'.$item['name'].' </option>';
			
		}
		print_r($op);
	}
	
	public function changestatus(){
		$status = $this->input->post('status');
		$date = $this->input->post('date');
		$time = $this->input->post('time');
		$package_id = $this->input->post('package_id');
		$course = $this->input->post('course');
		$student = $this->input->post('student');
		$classid = $this->input->post('classid');
		$qry = "delete FROM `attendance` where package = ".$package_id."  and date= '".$date."' and class = ".$classid." and time = ".$time." ";
		$this->db->query($qry);
		$return_status = 'absent' ;
		if($status == 'present'){
			$data = array(
				'package'=>$package_id,
				'date'=>$date,
				'time'=>$time,
				'class'=>$classid,
				'course'=>$course,
				'student'=>$student
			);
			$this->db->insert('attendance',$data);
			$return_status = 'present';
		}
		$qry = "select * from attendance where package = " .$package_id;
		$query = $this->db->query($qry);
		$qry = 'update feestructure set attended_classes = '.$query->num_rows() .' where id= '.$package_id;
		$this->db->query($qry);
		print_r($return_status);
	}

    /*
    *****************************************************************************************************
     * where discount:  retriving discount rates from discount table
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

}