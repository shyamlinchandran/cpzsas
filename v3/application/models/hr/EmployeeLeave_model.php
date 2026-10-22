<?php

class EmployeeLeave_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.*,c.*,DATE_FORMAT(from_date, "%d/%m/%Y") as fromdate,DATE_FORMAT(to_date, "%d/%m/%Y") as todate';
        $this->table = 'hr_employee_leave as a inner join hr_leavetype as b on a.leave_type=b.leave_id inner join hr_profile as c on c.emp_id=a.emp_id ';
        $this->column_order = array(null, 'pro_fname','leave_name'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname','leave_name'); //set column field database for datatable searchable 
        $this->order = array('from_date' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_employee_leave as a inner join hr_profile as b on a.emp_id=b.emp_id where emp_leave_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function leavetype() {
        $qry = "select * from hr_leavetype order by leave_id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["leave_id"] . '" >' . $row["leave_name"] . '</option>';
        }
        print_r($option);
    }

    function delete($id) {
        $qry = 'delete from  hr_role where role_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $id = $this->input->post('id');
        $emp_id = $this->input->post('emp_id');
        $leave_type = $this->input->post('leave_type');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $days = $this->input->post('days');
        $note = $this->input->post('notes');
        $data = array(
            'emp_id' => $emp_id,
            'leave_type' => $leave_type,
            'from_date' => $this->getDate($from_date),
            'to_date' => $this->getDate($to_date),
            'no_of_days' => $days,
            'created_date' => date('Y-m-d H:i:s', time()),
            'created_by' => $userid,
            'notes'=>$note
        );
        if ($id == 0) {
            $this->db->insert('hr_employee_leave', $data);
        } else {
            $this->db->where('emp_leave_id', $id);
            $this->db->update('hr_employee_leave', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
