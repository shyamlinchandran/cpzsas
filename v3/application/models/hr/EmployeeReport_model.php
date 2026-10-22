<?php

class EmployeeReport_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.*,a.emp_id as empid,c.type_name,IF(CURRENT_DATE>iqama_end_date, "color:red", "color:green") as iqama,IF(CURRENT_DATE>licence_end_date, "color:red", "color:green") as lice,IF(CURRENT_DATE>insurence_end_date, "color:red", "color:green") as insu';
        $this->table = '`hr_profile` as a left join hr_visa_passport_details b on a.emp_id=b.emp_id left join 	hr_visa_type as c on c.id=b.visa_type';
        $this->column_order = array(null, 'pro_fname','pro_mobile'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname','pro_mobile'); //set column field database for datatable searchable 
        $this->order = array('a.emp_id' => 'desc'); // default order 
    }

    function where() {
        if ($this->input->post('type')) {
            $this->wherecondition = ' where ' . $this->input->post('type') . ' <="' . $this->getDate($this->input->post('enddate')) . '" and  ' . $this->input->post('type') . ' >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
    }

}
