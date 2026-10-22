<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class SalaryReport_model extends DataTable {

    function where() {

        $this->select = " MONTHNAME(STR_TO_DATE(month, '%m')) as monthname,month,year,emp_salary,employee_paid,leave_days,c.pro_fname";
        $this->table = 'hr_salary_distribution as a inner join hr_emp_dist_details as b on a.distribution_id =b.distribution_id INNER JOIN hr_profile as c on c.emp_id=b.employee_id  ';
        $this->column_order = array(null, 'pro_fname'); //set column field database for datatable orderable
        $this->column_search = array('pro_fname'); //set column field database for datatable searchable 
        $this->order = array('month' => 'desc'); // default order 
        $this->wherecondition = " where b.published='yes'";
        if ($this->input->post('emp_id')) {
            $this->wherecondition = $this->wherecondition . " and b.published='yes' and b.employee_id='" . $this->input->post('emp_id') . "'";
        }
        if ($this->input->post('month')) {
            $this->wherecondition = $this->wherecondition . " and month='" . $this->input->post('month') . "'";
        }
        if ($this->input->post('year')) {
            $this->wherecondition = $this->wherecondition . " and year='" . $this->input->post('year') . "'";
        }
    }

}
