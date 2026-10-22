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
class EmpReport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('hr/EmpReport_model', 'emp');
    }

    function getchild($list, $sal_dis_id, $pay_id) {
        $filter_rules = array(
            'sal_dis_id' => $sal_dis_id,
            'pay_id' => $pay_id
        );
        $filter = function ($player) use ($filter_rules) {
            foreach ($filter_rules as $rulekey => $rulevalue) {
                if ($player[$rulekey] != $rulevalue) {
                    return false;
                }
            }
            return true;
        };
        $filtered = array_filter($list, $filter);
        return $filtered;
    }

    function emp_report() {
        $data['title'] = 'Employee Report';
        $components = $this->emp->components();
        $data['components'] = $components;
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('hr/emp_report/emp_report', $data);
    }

    public function ajax_list() {
        $employee = $this->emp->employeedetails();
        $components = $this->emp->components();
        $salary_components = $this->emp->salary_components();
        $i = 0;
        $emp_salary = 0;
        $employee_paid = 0;
        $data = [];
        foreach ($employee as $emp) {
            $emp_salary = (float) $emp['emp_salary'] + (float) $emp_salary;
            $employee_paid = (float) $emp['employee_paid'] + (float) $employee_paid;
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $emp['pro_fname'];
            $row[] = $emp['year'];
            $row[] = $emp['monthname'];
            foreach ($components as $item) {
                $component_list = $this->getchild($salary_components, $emp['distribution_id'], $item["pay_id"]);
                $amount = 0;
                if (isset($component_list)) {
					$amt =0 ;
                    foreach ($component_list as $comp_list) {
                        $amt = $comp_list['amount'];
                        $amount = $comp_list['amount'];
                    }
					$row[] = $amt;
                } else {
                    $row[] = 0;
                }
                if (isset($component_total[$item["pay_id"]])) {
                    $component_total[$item["pay_id"]] = (float) $component_total[$item["pay_id"]] + (float) $amount;
                } else {
                    $component_total[$item["pay_id"]] = (float) $amount;
                }
            }
            $row[] = $emp['emp_salary'];
            $row[] = $emp['employee_paid'];
            $row[] = ' <a tp="pdf" href="' . base_url() . 'hr/Employee/receipt/' . $emp['id'] . '" data-toggle="tooltip" title="Print Slip" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = 'Totals';
        $row[] = '';
        foreach ($components as $item) {
            if (isset($component_total[$item["pay_id"]])) {
                $row[] = number_format($component_total[$item["pay_id"]], 2);
            } else {
                $row[] = 0;
            }
        }
        $row[] = $emp_salary;
        $row[] = $employee_paid;
        $row[] = '';
        $data[] = $row;
        $output = array(
            "draw" => $i,
            "recordsTotal" => $i,
            "recordsFiltered" => $i,
            "data" => $data,
        );
        echo json_encode($output);
    }

}
