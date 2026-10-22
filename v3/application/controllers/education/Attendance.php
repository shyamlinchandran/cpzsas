<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Attendance extends MY_Controller{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('education/Attendance_model', 'attendance');
    }

    /*
     *************************************************************************************************
     * Fn for listing all Courses
     * 
     * 
     * @author Althaf
     * @Updated on 12-10-2019
     * 
     * 
     ******************************************************************************************************
     */

    public function listall($class = 0 , $time = 0  )
    {
		$data['class'] = $class;
		$data['time'] = $time;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('student/list_attendance',$data);
    }

	public function getallstudentpackage($id){
		return $this->attendance->getallstudentpackage($id);
	}
	public function changestatus(){
		return $this->attendance->changestatus();
	}
	
	public function getallstudent(){
		return $this->attendance->getallstudent();
	}
	
	public function getallclasses(){
		return $this->attendance->getallclasses();
	}


    public function ajax_list()
    {
		$this->attendance->where();
        $list = $this->attendance->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
			
            $row[] = $no;
            $row[] = $item->name;
           // $row[] = $item->coursename;
			$class = "btn-success";
			if($item->status != 'present'){
				$class = "btn-danger";
			}
            $row[] = '<button time="'.$item->times.'" status = "'.$item->status.'" date="'.$item->attendance_date.'" package="'.$item->package.'" course="'.$item->course.'" student="'.$item->student.'" classid = "'.$item->class.'" class="updateattendance btn '.$class.'" >'.$item->status.'</button>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->attendance->count_all(),
            "recordsFiltered" => $this->attendance->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	public function ajax_list_all()
    {
		$this->attendance->where_all();
        $list = $this->attendance->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->student;
            $row[] = $item->cls_name;
            $row[] = $item->date;
			$row[] = $item->time;
           // $row[] = $item->course;
			$data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->attendance->count_all(),
            "recordsFiltered" => $this->attendance->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

   

    
}