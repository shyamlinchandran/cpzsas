<?php

class Paysettings_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'hr_paysettings';
        $this->column_order = array(null, 'pay_name'); //set column field database for datatable orderable
        $this->column_search = array('pay_name'); //set column field database for datatable searchable 
        $this->order = array('pay_id' => 'desc'); // default order 
    }

    public function getpaysettings($id) {
        $qry = "select * from hr_paysettings where pay_id = " . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function getsing($id) {
        $qry = "select a.*,b.*,c.pro_fname,d.pay_name from hr_emp_salary as a inner join hr_salary_components as b on a.sal_id =b.sal_id inner join hr_profile as c on c.emp_id =a.emp_id inner join hr_paysettings as d on d.pay_id=b.component_id where a.sal_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function where() {
        $this->select = ' *';
        $this->table = 'hr_emp_salary as a inner join users as b on a.created_by=b.Id inner join hr_profile as c on c.emp_id=a.emp_id';
        $this->column_order = array(null, 'pro_fname'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname'); //set column field database for datatable searchable 
        $this->order = array('pro_fname' => 'desc'); // default order 
    }

    function getemployee($search) {
        $qry = "select IFNULL(c.amount,0) as amount,a.*,a.pro_fname as label from hr_profile as a left join hr_salary_package as b on a.emp_id=b.emp_id and b.status='active' left join hr_sal_pack_components as c on c.sal_pack_id=b.package_id and component_id=6 where pro_fname like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }



    function setcomponent() {
        $id = $this->input->post('component_type');
        $qry = "select a.*,pay_name as label from hr_paysettings as a where pay_type='" . $id . "' ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["pay_id"] . '">' . $row["pay_name"] . '</option>';
        }
        print_r($option);
    }

    function delete($id) {
        $qry = 'delete from  hr_paysettings where pay_id =' . $id;
        $this->db->query($qry);
    }

    function save_salary() {
        $id = $this->input->post('sal_id');
        $emp_id = $this->input->post('emp_id');
        $type = $this->input->post('component_type', TRUE);
        $component = $this->input->post('component', TRUE);
        $amount = $this->input->post('amount', TRUE);
        $notes = $this->input->post('notes', TRUE);
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $salary = $this->input->post('salary');
        $data = array(
            'emp_id' => $emp_id,
            'created_by' => $userid,
            'total' => $salary,
        );
        if ($id == '0') {
            $qry = "update hr_emp_salary set published='no' where emp_id =" . $emp_id;
            $this->db->query($qry);
            $data['published'] = 'yes';
            $this->db->insert('hr_emp_salary', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->where('sal_id', $id);
            $this->db->update('hr_emp_salary', $data);
            $qry = "update hr_salary_components set published='no' where component_id =" . $insert_id;
            $this->db->query($qry);
        }
        $length = sizeof($component);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'sal_id' => $insert_id,
                'component_id' => $component[$i],
                'amount' => $amount[$i],
                'note' => $notes[$i],
                'component_type' => $type[$i]
            );
            $this->db->insert('hr_salary_components', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    function save() {
        $pay_name = $this->input->post('pay_name');
        $pay_type = $this->input->post('pay_type');
        $pay_enable = $this->input->post('pay_enable');
        $pay_id = $this->input->post('pay_id');
        $is_varying =  $this->input->post('is_varying');
        $data = array(
            'pay_name' => $pay_name,
            'pay_type' => $pay_type,
            'pay_enable' => $pay_enable,
            'is_varying'=>$is_varying
        );
        if ($pay_id == '0') {
            $this->db->insert('hr_paysettings', $data);
        } else {
            $this->db->where('pay_id', $pay_id);
            $this->db->update('hr_paysettings', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
