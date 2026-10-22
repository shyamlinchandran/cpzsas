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
class EmpReport_model extends DataTable {

    public function employeedetails() {
        $start_month = $this->input->post('start_month');
        $start_year = $this->input->post('start_year');
        $end_month = $this->input->post('end_month');
        $end_year = $this->input->post('end_year');
        $emp_id = $this->input->post('emp_id');
        $qry = 'SELECT MONTHNAME(STR_TO_DATE(month, "%m")) as monthname,year,b.pro_fname,a.* FROM `hr_emp_dist_details` as a INNER JOIN hr_profile as b on a.employee_id=b.emp_id INNER join(SELECT IFNULL(distribution_id,0) as dist,month,year FROM `hr_salary_distribution` where year>="' . $start_year . '" and year<="' . $end_year . '" and month >= (CASE WHEN year = "' . $start_year . '" then "' . $start_month . '" else 0 END) and month <=(CASE WHEN year = "' . $end_year . '" THEN ' . $end_month . ' else 13 end)) as c on c.dist=a.distribution_id WHERE a.employee_id =' . $emp_id . ' and a.published="yes" order by a.distribution_id asc ';
        $employee = $this->db->query($qry);
        return $employee->result_array();
    }

    public function components() {
        $qry = "select * from hr_paysettings order by pay_type desc";
        $components = $this->db->query($qry);
        return $components->result_array();
    }

    public function salary_components() {
        $emp_id = $this->input->post('emp_id');
        $qry = 'SELECT amount ,sal_dis_id,pay_id FROM `hr_sal_dist_components` as a INNER JOIN hr_paysettings as b on a.component_id =b.pay_id WHERE emp_id=' . $emp_id . ' and published="yes" GROUP by pay_id,component_id,sal_dis_id order by sal_dis_id asc';
        $components = $this->db->query($qry);
        return $components->result_array();
    }

}
