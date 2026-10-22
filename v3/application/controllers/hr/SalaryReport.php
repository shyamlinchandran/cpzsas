<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class SalaryReport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('hr/SalaryReport_model', 'salary');
    }

    function salary_report() {
        $data['title'] = 'Salary Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('hr/salaryreport/salaryreport', $data);
    }

    public function ajax_list() {
        $this->salary->where();
        $list = $this->salary->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $emp_salary = 0;
        $employee_paid = 0;
        foreach ($list as $vouchers) {
            $emp_salary = (float) $emp_salary + (float) $vouchers->emp_salary;
            $employee_paid = (float) $employee_paid + (float) $vouchers->employee_paid;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->pro_fname;
            $row[] = $vouchers->year;
            $row[] = $vouchers->monthname;
            $row[] = $vouchers->leave_days;
            $row[] = $vouchers->emp_salary;
            $row[] = $vouchers->employee_paid;
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '';
        $row[] = '<b>' . $emp_salary . '</b>';
        $row[] = '<b>' . $employee_paid . '</b>';
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salary->count_all(),
            "recordsFiltered" => $this->salary->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
