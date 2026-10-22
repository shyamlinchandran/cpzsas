<?php

class Attendance_model extends DataTable {

    public function __construct() {
        parent::__construct();
		$date = $this->getDate($this->input->post('date'));
        $this->select = " e.emp_id,e.pro_fname,e.pro_lname,e.pro_mobile,case when e.pro_image = '' then 'no-image.jpg' else pro_image end as pro_image,IFNULL(ad.status,'present') as status,IFNULL(leave_type,'') as leave_type,IFNULL(shift,'') as shift,IFNULL(in_time,'') as in_time,IFNULL(out_time,'') as out_time";
        $this->table = ' hr_profile as e LEFT JOIN attendance as a on a.date = "'.$date.'" LEFT JOIN attendance_details as ad on ad.empid = e.emp_id  and a.id = ad.attendance_id';
        $this->column_order = array(null, 'pro_fname','pro_mobile'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname','pro_mobile'); //set column field database for datatable searchable 
        $this->order = array('pro_fname' => 'asc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_bloodgroup where blood_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_bloodgroup where blood_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $employee = $this->input->post('employee',true);
        $in_time = $this->input->post('in_time',true);
        $out_time = $this->input->post('out_time',true);
        $leave_type = $this->input->post('leave_type',true);
        $shift = $this->input->post('shift',true);
		$date = $this->getDate($this->input->post('date'));
		$qry = "select * from attendance where date = '".$date."' ";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$insert_id = $query['id'];
		}else{
			$data = array(
				'date'=>$date
			);
			$this->db->insert('attendance',$data);
			$insert_id = $this->db->insert_id();
		}
		$l = sizeof($employee);
		for($i=0;$i<$l;$i++){
			$empid = $employee[$i];
			$status = 'leave';
			if($this->input->post('chkpresent'.$empid) ){
				$status = 'present';
			}
			$data = array(
				'empid'=>$empid,
				'leave_type'=>$leave_type[$i],
				'shift'=>$shift[$i],
				'in_time'=>$in_time[$i],
				'out_time'=>$out_time[$i],
				'status'=>$status,
				'attendance_id'=>$insert_id
			);
			$qry = "select * from attendance_details where empid = '".$empid."' and attendance_id = '".$insert_id."' ";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0 ){
				$this->db->where('empid',$empid);
				$this->db->where('attendance_id',$insert_id);
				$this->db->update('attendance_details',$data);
			}else{
				$this->db->insert('attendance_details',$data);
			}
		}
		$response = array(
			'valid' => false,
			'type' => 1,
			'message' => 'Saved Successfully.'
		);
    
		echo json_encode($response);    
    }

}
