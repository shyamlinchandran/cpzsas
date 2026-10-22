<?php

class SalaryPackage_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.*, DATE_FORMAT(renewal_date, "%d/%m/%Y") as renewal,c.amount';
        $this->table = 'hr_salary_package as a inner join hr_profile as b on a.emp_id=b.emp_id inner join hr_sal_pack_components as c on c.sal_pack_id=a.package_id and component_id=6';
        $this->column_order = array(null, 'pro_fname', 'renewal_date'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname'); //set column field database for datatable searchable 
        $this->order = array('renewal_date' => 'asc'); // default order 
    }

    public function where() {
        if($this->input->post('status')) {
            $this->wherecondition = 'where c.published="yes" and   a.status="' . $this->input->post('status') . '"';
        }else{
            $this->wherecondition = 'where c.published="yes" ';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and renewal_date>="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and renewal_date<="' . $this->getDate($this->input->post('enddate')) . '"';
        }
    }

    public function getsing($id, $package) {
        $qry = "SELECT DATE_FORMAT(renewal_date, '%d/%m/%Y') as renewal,a.*,IFNULL(amount,0) as totalamount ,IFNULL(notes,'') as notes,d.*,IFNULL(pro_fname,'') as employee,IFNULL(emp_id,'') as employee_id FROM hr_paysettings as a left join (select b.*,c.amount,c.component_id,p.pro_fname,b.note as notes FROM hr_salary_package as b inner JOIN hr_sal_pack_components as c on b.package_id=c.sal_pack_id inner join hr_profile as p on p.emp_id=b.emp_id WHERE c.published ='yes' and b.package_id =" . $package . ") as d on d.component_id=a.pay_id where pay_type='" . $id . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getemployeePackage($id, $employee) {
        $qry = "SELECT a.*,IFNULL(package_id,0) as package,IFNULL(amount,0) as totalamount ,d.*,IFNULL(pro_fname,'') as employee,IFNULL(emp_id,'') as employee_id FROM hr_paysettings as a left join (select b.*,c.amount,c.component_id,p.pro_fname FROM hr_salary_package as b inner JOIN hr_sal_pack_components as c on b.package_id=c.sal_pack_id inner join hr_profile as p on p.emp_id=b.emp_id WHERE b.status='active' and c.published ='yes' and b.emp_id =" . $employee . ") as d on d.component_id=a.pay_id where pay_type='" . $id . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getemployee($search) {
        $qry = "select a.*,a.pro_fname as label from hr_profile as a where pro_fname like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function delete($id) {
        $qry = 'delete from  hr_paysettings where pay_id =' . $id;
        $this->db->query($qry);
    }

    function save() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $package_id = $this->input->post('package_id');
        $note = $this->input->post('note');
        $emp_id = $this->input->post('emp_id');
        $renewel_date = $this->input->post('rndate');
        $earning_amount = $this->input->post('earning_amount', TRUE);
        $earning_comp = $this->input->post('earning_comp', TRUE);
        $deduction_amount = $this->input->post('deduction_amount', TRUE);
        $deduction_comp = $this->input->post('deduction_comp', TRUE);
        $tot_amount = $this->input->post('tot_amount');
        $data = array(
            'note' => $note,
            'emp_id' => $emp_id,
            'created_by' => $userid,
            'total' => $tot_amount,
            'renewal_date' => $this->getDate($renewel_date),
            'published' => 'yes'
        );
        if ($package_id == "0") {
            $qry = "update hr_salary_package set status='inactive' where status='active' and emp_id=" . $emp_id;
            $this->db->query($qry);
            $qry = "update hr_salary_package set disabled_date='" . date('Y-m-d H:i:s', time()) . "' where status='active' and emp_id=" . $emp_id;
            $this->db->query($qry);
            $data['created_date'] = date('Y-m-d H:i:s', time());
            $this->db->insert('hr_salary_package', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $package_id;
            $qry = "update hr_sal_pack_components set published='no' where sal_pack_id=" . $package_id;
            $this->db->query($qry);
            $data['updated_date'] = date('Y-m-d H:i:s', time());
            $this->db->where('package_id', $package_id);
            $this->db->update('hr_salary_package', $data);
        }
        $length = sizeof($earning_comp);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'sal_pack_id' => $insert_id,
                'component_id' => $earning_comp[$i],
                'component_type' => 'Earnings', //Deductions
                'amount' => $earning_amount[$i],
                'published' => 'yes'
            );
            $this->db->insert('hr_sal_pack_components', $data);
        }
        $length = sizeof($deduction_comp);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'sal_pack_id' => $insert_id,
                'component_id' => $deduction_comp[$i],
                'component_type' => 'Deductions', //Deductions
                'amount' => $deduction_amount[$i],
                'published' => 'yes'
            );
            $this->db->insert('hr_sal_pack_components', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
