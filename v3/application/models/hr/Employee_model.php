<?php

class Employee_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.*,a.emp_id as empid,c.type_name,IF(CURRENT_DATE>iqama_end_date, "color:red", "color:green") as iqama,IF(CURRENT_DATE>licence_end_date, "color:red", "color:green") as lice,IF(CURRENT_DATE>insurence_end_date, "color:red", "color:green") as insu';
        $this->table = '`hr_profile` as a left join hr_visa_passport_details b on a.emp_id=b.emp_id left join 	hr_visa_type as c on c.id=b.visa_type';
        $this->column_order = array(null, 'pro_fname', 'pro_mobile'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname', 'pro_mobile'); //set column field database for datatable searchable 
        $this->order = array('a.emp_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from hr_profile where emp_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function visadetails($id) {
        $qry = 'select * from hr_visa_passport_details  where emp_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function jobdetails($id) {
        $qry = 'select * from hr_jobdetails  where emp_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function education($id) {
        $qry = "SELECT a.*,b.course_name FROM `hr_education` as a INNER JOIN hr_course as b on a.edu_course=b.course_id where emp_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getdocuments($id) {
        $qry = "SELECT a.* FROM `hr_employee_documents` as a  where employee=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function leave_types() {
        $qry = "SELECT a.* FROM `hr_leavetype` as a  where 1";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getemployee_leaves() {
        $employee = $this->input->post('emp_id');
        $start_date = $this->getDate($this->input->post('start_date'));
        $end_date = $this->getDate($this->input->post('end_date'));
        $qry = "select l.*,IFNULL(days.enddate,'') as ebddate,IFNULL(days.start,'') as start,IFNULL(emp_id,0) as employee ,sum(IFNULL(days.dif,0)) as days from hr_leavetype as l left join (SELECT CASE WHEN a.to_date > '" . $end_date . "' then '" . $end_date . "' else a.to_date end as enddate,CASE WHEN a.from_date <'" . $start_date . "' then '" . $start_date . "' else a.from_date end as start,a.emp_id,a.leave_type, DATEDIFF( CASE WHEN a.to_date > '" . $end_date . "' then '" . $end_date . "' else a.to_date end, CASE WHEN a.from_date <'" . $start_date . "' then '" . $start_date . "' else a.from_date end )+1 as dif FROM `hr_employee_leave` as a WHERE (a.to_date BETWEEN '" . $start_date . "' AND '" . $end_date . "' OR from_date BETWEEN '" . $start_date . "' AND '" . $end_date . "') and emp_id='" . $employee . "') as days on days.leave_type =l.leave_id GROUP by l.leave_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function department() {
        $qry = "select a.* from hr_department as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["dept_id"] . '">' . $row["dept_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function getDetails($distribution_id, $employee_id) {
        $qry = "SELECT * FROM `hr_emp_dist_details` where employee_id='" . $employee_id . "' and distribution_id='" . $distribution_id . "'";
        $query = $this->db->query($qry)->row_array();
        $salary = $query['emp_salary'];
        $qry = "SELECT a.*,b.*,$salary as salary FROM  hr_sal_dist_components as a INNER join hr_paysettings as b on a.component_id=b.pay_id where a.published='yes' and  a.emp_id='" . $employee_id . "' and a.sal_dis_id='" . $distribution_id . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

  function getpaymentDetails($pay_id) {
        $qry = "SELECT DATE_FORMAT(last_paid_date,'%d/%m/%Y') paid_date,c.pro_mobile,c.pro_permt_address,b.total as tot,b.total-b.emp_salary as deduction,extra_leaves+leave_days as leaves,b.*,b.id as pay_id,c.pro_fname,a.year,MONTHNAME(STR_TO_DATE(month, '%m')) as monthname FROM hr_salary_distribution as a inner JOIN hr_emp_dist_details as b on a.distribution_id=b.distribution_id INNER JOIN hr_profile as c on c.emp_id=b.employee_id WHERE b.published='yes' and b.id='" . $pay_id . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function where() {
        $this->select = " a.date,b.*,b.id as pay_id,c.pro_fname,a.year,MONTHNAME(STR_TO_DATE(month, '%m')) as monthname";
        $this->table = 'hr_salary_distribution as a inner JOIN hr_emp_dist_details as b on a.distribution_id=b.distribution_id INNER JOIN hr_profile as c on c.emp_id=b.employee_id ';
        $this->column_order = array(null, 'pro_fname'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname'); //set column field database for datatable searchable 
        $this->order = array('month' => 'desc'); // default order 
        $this->wherecondition = " where b.published='yes'";
        $this->wherecondition = $this->wherecondition . " and b.employee_id='" . $this->input->post('emp_id') . "'";
        if ($this->input->post('month')) {
            $this->wherecondition = $this->wherecondition . " and month='" . $this->input->post('month') . "'";
        }
        if ($this->input->post('year')) {
            $this->wherecondition = $this->wherecondition . " and year='" . $this->input->post('year') . "'";
        }
    }

    function visa_type() {
        $qry = "select a.* from hr_visa_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["type_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function course() {
        $qry = "select a.* from hr_course as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["course_id"] . '">' . $row["course_name"] . '</option>';
            $no++;
        }
        print_r($option);
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

    function role() {
        $qry = "select a.* from hr_role as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["role_id"] . '">' . $row["role_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function delete($id) {
        $qry = 'delete  from  hr_profile where emp_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $pro_fname = $this->input->post('pro_fname');
		$pro_status =  $this->input->post('pro_status');
        $pro_lname = $this->input->post('pro_lname');
        $pro_permt_address = $this->input->post('pro_permt_address');
        $pro_cur_address = $this->input->post('pro_cur_address');
        $pro_email = $this->input->post('pro_email');
        $edu_percent = $this->input->post('percent', true);
        $pro_mobile = $this->input->post('pro_mobile', true);
        $edu_course = $this->input->post('edu_course', true);
        $edu_start_date = $this->input->post('start_date', true);
        $edu_end_date = $this->input->post('end_date', true);
        $edu_type = $this->input->post('type', true);
        $id = $this->input->post('emp_id');
        $job_department = $this->input->post('job_department');
        $job_role = $this->input->post('job_role');
        $image = "";
        if ($this->input->post('pro_image_id')) {
            $image = $this->input->post('pro_image_id');
        }
        $job_email = $this->input->post('job_email');
        $job_date_joining = $this->input->post('job_date_joining');
        $job_date_leaving = $this->input->post('job_date_leaving');
        $emp_id = $this->input->post('emp_id');
        $visa_type = $this->input->post('visa_type');
        $iqama_no = $this->input->post('iqama_number');
        $iqama_issue_date = $this->input->post('iqama_issue_date');
        $iqama_end_date = $this->input->post('iqama_end_date');
        $passport_no = $this->input->post('visa_number');
        $pass_issue_date = $this->input->post('visa_issue_date');
        $pass_end_date = $this->input->post('visa_end_date');
        $licence = $this->input->post('license_number');
        $licence_issue_date = $this->input->post('license_issue_date');
        $licence_end_date = $this->input->post('license_end_date');
        $insurence = $this->input->post('insurence_number');
        $insurence_issue_date = $this->input->post('insurence_issue_date');
        $insurence_end_date = $this->input->post('insurence_end_date');
        $allowed_leaves = $this->input->post('no_of_leaves');
        if ($this->input->post('user') && $this->input->post('pwd')) {
            $user_data = array(
                'user_name' => $pro_fname,
                'user_type' => 1,
                'user_phone' => $pro_mobile,
                'username' => $this->input->post('user')
            );
        }
        $data_visa = array(
            'visa_type' => $visa_type,
            'passport_no' => $passport_no,
            'pass_issue_date' => $this->getDate($pass_issue_date),
            'pass_end_date' => $this->getDate($pass_end_date)
        );
        if ($this->input->post('license_number')) {
            $data_visa['licence'] = $licence;
            $data_visa['licence_issue_date'] = $this->getDate($licence_issue_date);
            $data_visa['licence_end_date'] = $this->getDate($licence_end_date);
        }
        if ($this->input->post('iqama_number')) {
            $data_visa['iqama_no'] = $iqama_no;
            $data_visa['iqama_issue_date'] = $this->getDate($iqama_issue_date);
            $data_visa['iqama_end_date'] = $this->getDate($iqama_end_date);
        }
        if ($this->input->post('insurence_number')) {
            $data_visa['insurence'] = $insurence;
            $data_visa['insurence_issue_date'] = $this->getDate($insurence_issue_date);
            $data_visa['insurence_end_date'] = $this->getDate($insurence_end_date);
        }
        $data_profile = array(
            'allowed_leaves' => $allowed_leaves,
			'pro_status'=>$pro_status,
            'pro_mobile' => $pro_mobile,
            'pro_fname' => ucfirst($pro_fname),
            'pro_lname' => ucfirst($pro_lname),
            'pro_permt_address' => ucfirst($pro_permt_address),
            'pro_cur_address' => $pro_cur_address,
            'pro_email' => $pro_email,
        );
        if ($this->input->post('pro_image_id')) {
            $data_profile['pro_image'] = $this->input->post('pro_image_id');
        }
        $data_job = array(
            'job_department' => $job_department,
            'job_role' => $job_role,
            'job_email' => $job_email,
        );
        if ($this->input->post('job_date_joining')) {
            $data_job['job_date_joining'] = $this->getDate($job_date_joining);
        }
        if ($this->input->post('job_date_leaving')) {
            $data_job['job_date_leaving'] = $this->getDate($job_date_leaving);
        }

        if ($emp_id == '0') {
            $this->db->insert('hr_profile', $data_profile);
            $insert_id = $this->db->insert_id();
            if ($this->input->post('user') && $this->input->post('pwd')) {
                $this->db->insert('users', $user_data);
                $users_id = $this->db->insert_id();
                $qry = "update users set user_password=AES_ENCRYPT('" . $this->input->post('pwd') . "','" . $this->pass_encryption . "') where Id=" . $users_id;
                $this->db->query($qry);
            }

            $data_visa['emp_id'] = $insert_id;
            if ($this->input->post('visa_type') && $this->input->post('visa_number') && $this->input->post('visa_issue_date') && $this->input->post('visa_end_date')) {
                $this->db->insert('hr_visa_passport_details', $data_visa);
            }
            $data_job['emp_id'] = $insert_id;
            $this->db->insert('hr_jobdetails', $data_job);
            $id = $insert_id;
            $ledger_data = array(
                "name" => ucfirst($pro_fname),
                "code" => $pro_mobile,
                "ref_id" => $insert_id,
                "ref_code" => 'employee',
                "is_default" => true,
                "acc_main_id" => 24,
                "openning_bal" => 0,
                "type" => 'Cr',
                "published" => 'yes'
            );
            $this->db->insert('acc_ledgers', $ledger_data);
        } else {
            $qry = "delete from hr_employee_documents where employee=" . $emp_id;
            $this->db->query($qry);
            $qry = "delete from hr_education where emp_id=" . $emp_id;
            $this->db->query($qry);
            $qry = "delete from hr_visa_passport_details where emp_id=" . $emp_id;
            $this->db->query($qry);
            $qry = "delete from hr_jobdetails where emp_id=" . $emp_id;
            $this->db->query($qry);
            $data_visa['emp_id'] = $emp_id;
            $data_job['emp_id'] = $emp_id;
            $this->db->where('emp_id', $emp_id);
            $this->db->update('hr_profile', $data_profile);
            if ($this->input->post('visa_type') && $this->input->post('visa_number') && $this->input->post('visa_issue_date') && $this->input->post('visa_end_date')) {
                $this->db->insert('hr_visa_passport_details', $data_visa);
            }
            $this->db->insert('hr_jobdetails', $data_job);
        }
        $edu_course = $this->input->post('course', true);
        if ($this->input->post('course', true)) {
            $alt_length = sizeof($edu_course);
            for ($i = 0; $i < $alt_length; $i++) {
                $alt_data = array(
                    'edu_course' => $edu_course[$i],
                    'edu_start_date' => $this->getDate($edu_start_date[$i]),
                    'edu_end_date' => $this->getDate($edu_end_date[$i]),
                    'edu_type' => $edu_type[$i],
                    'edu_percent' => $edu_percent[$i],
                    'emp_id' => $id
                );
                $this->db->insert('hr_education', $alt_data);
            }
        }
        $document_id = $this->input->post('document_id', true);
        if ($this->input->post('document_id', true)) {
            $doc_img = $this->input->post('doc_img', true);
            $alt_length = sizeof($document_id);
            for ($i = 0; $i < $alt_length; $i++) {
                $data = array(
                    'employee' => $id,
                    'document' => $doc_img[$i],
                    'document_type' => $document_id[$i]
                );
                $this->db->insert('hr_employee_documents', $data);
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
