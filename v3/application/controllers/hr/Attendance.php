<?php

class Attendance extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Attendance_model', 'attendance');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/attendance/list');
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/attendance/create', $data);
    }

    public function view($blood_id = 0) {
        $data['type'] = 'view';
        $data['id'] = $blood_id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/attendance/create', $data);
    }

   

    public function save() {
        $insert_id = $this->attendance->save();
    }

    public function ajax_list() {
        $list = $this->attendance->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $items) {
		$is_checked = 'checked';
			$present = 'selected';
			$leave = '';
			if($items->status == 'leave'){
				$present = '';
				$leave = 'selected';
				$is_checked = '';
			}
			$array_leave_type = array("half", "full", "quarter");
			$option_leave_type = '<option value = "" >Select Leave Type</option>';
			foreach($array_leave_type as $itm){
				$sel = '';
				if($itm == $items->leave_type){
					$sel = 'selected';
				}
				$option_leave_type = $option_leave_type . '<option  '.$sel.' value = "'.$itm.'" >'.ucfirst($itm).'</option>';
			}
			
			$array_shift = array("BN", "AN");
			$option_shift = '<option value = "" >Select Leave Type</option>';
			foreach($array_shift as $itm){
				$sel = '';
				if($itm == $items->shift){
					$sel = 'selected';
				}
				$option_shift = $option_shift . '<option  '.$sel.' value = "'.$itm.'" >'.ucfirst($itm).'</option>';
			}
			
			
			$status = '<option value= "present"  '.$present.'>Present</option> ';
			$status = $status . '<option value= "leave" '.$leave.' >Leave</option> ';
			$no++;
            $row = array();
            $row[] = $no;
            $row[] = '<input type = "hidden" name = "employee[]" value = "'.$items->emp_id.'" ><img style="max-height:30px !important;width:100%;" src="' . base_url() . 'uploads/images/'.$items->pro_image.'">';
            $row[] = $items->pro_fname;
            $row[] = $items->pro_mobile;
            //$row[] = '<select id = "" name = "status[]"  class = "form-control" >'.$status.'</select>';
            $row[] = '<label class="switch">
						<input name = "chkpresent'.$items->emp_id.'"  type="checkbox" '.$is_checked.'>
						<span class="slider round"></span>
					</label>';
			$row[] = '<input type = "time"  value = "'.$items->in_time.'" name = "in_time[]" class = "form-control"  >';
            $row[] = '<input type = "time"  value = "'.$items->out_time.'"  name = "out_time[]" class = "form-control"  >';
            $row[] = '<select id = "" name = "leave_type[]"  class = "form-control" >'.$option_leave_type.'</select>';
            $row[] = '<select id = "" name = "shift[]"  class = "form-control" >'.$option_shift.'</select>';
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
