<?php

class SalaryDistribution extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/SalaryDistribution_model', 'distribution');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarydistribution/list_all');
    }

    public function getemployees() {
        return $this->distribution->getemployees();
    }

    public function loadleaves($distribution_id) {
        return $this->distribution->loadleaves($distribution_id);
    }

    public function create($id = 0) {
        $employee = $this->distribution->salaryemployee($id);
        $data['employee'] = $employee;
        $components = $this->distribution->components();
        $data['components'] = $components;
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['is_view'] = 0;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarydistribution/create', $data);
    }

    public function payment($id = 0) {
        $employee = $this->distribution->salaryemployee($id);
        $data['employee'] = $employee;
        $components = $this->distribution->components();
        $data['components'] = $components;
        $data['type'] = 'pay';
        $data['id'] = $id;
        $data['is_view'] = 0;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarydistribution/create', $data);
    }

    public function view($id = 0) {
        $employee = $this->distribution->employee();
        $data['employee'] = $employee;
        $components = $this->distribution->components();
        $data['components'] = $components;
        $data['type'] = 'pay';
        $data['is_view'] = 1;
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarydistribution/create', $data);
    }

    public function getsing($id) {
        return $this->distribution->getsing($id);
    }

    public function delete($pay_id) {
        
    }

    public function list_distribution($id = 0) {
        $employee = $this->distribution->employee();
        $data['employee'] = $employee;
        $components = $this->distribution->components();
        $data['components'] = $components;
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarydistribution/list_distribution', $data);
    }

    public function save() {
        $insert_id = $this->distribution->save();
    }

    public function save_payment() {
        $insert_id = $this->distribution->save_payment();
    }

    function getchild($list, $component_id, $emp_id) {
        $filter_rules = array(
            'component_id' => $component_id,
            'emp_id' => $emp_id
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

    public function distribution_list() {
        $distribution_id = $this->input->post('distribution_id');
        $employee = $this->distribution->employeedetails($distribution_id);
        $components = $this->distribution->components();
        $employee_components = $this->distribution->employee_components($distribution_id);
        $data = array();
        $no = $this->input->post('start');
        $i = 0;
        $grand_total = 0;
        $grand_emp_salary = 0;
        $grand_employee_paid = 0;
        $grand_leave = 0;
        $component_total = [];
        foreach ($employee as $emp) {
            $emp_salary = $emp["emp_salary"];
            $total = $emp["total"];
            $leave = (float) $total - (float) $emp_salary;
            $grand_total = (float) $grand_total + (float) $emp["total"];
            $grand_emp_salary = (float) $grand_emp_salary + (float) $emp["emp_salary"];
            $grand_employee_paid = (float) $grand_employee_paid + (float) $emp["employee_paid"];
            $grand_leave = (float) $grand_leave + (float) $leave;
            $i++;
            $row = array();
            $row[] = $i;
            $row[] = $emp['pro_fname'];
            $row[] = $emp["leave_days"];
            $row[] = $emp["extra_leaves"];
            foreach ($components as $item) {
                $component_list = $this->getchild($employee_components, $item["pay_id"], $emp['emp_id']);
                if (isset($component_list)) {
                    foreach ($component_list as $comp_list) {
                        if (isset($component_total[$item["pay_id"]])) {
                            $component_total[$item["pay_id"]] = $component_total[$item["pay_id"]] + $comp_list['amount'];
                        } else {
                            $component_total[$item["pay_id"]] = $comp_list['amount'];
                        }
                        $row[] = $comp_list['amount'];
                    }
                } else {
                    if (isset($component_total[$item["pay_id"]])) {
                        $component_total[$item["pay_id"]] = $component_total[$item["pay_id"]] + 0;
                    } else {
                        $component_total[$item["pay_id"]] = 0;
                    }
                    $row[] = 0;
                }
            }
            $row[] = number_format($emp["total"], 3);
            $row[] = number_format($leave, 3);
            $row[] = number_format($emp["emp_salary"], 3);
            $row[] = $emp["employee_paid"];

            $data[] = $row;
        }
        $row = array();
        $row[] = '';
        $row[] = 'Total';
        $row[] = '';
        $row[] = '';
        foreach ($components as $item) {
            if (isset($component_total[$item["pay_id"]])) {
                $row[] = number_format($component_total[$item["pay_id"]], 2);
            } else {
                $row[] = 0;
            }
        }
        $row[] = number_format($grand_total, 3);
        $row[] = number_format($grand_leave, 3);
        $row[] = number_format($grand_emp_salary, 3);
        $row[] = number_format($grand_employee_paid, 3);

        $data[] = $row;
        $output = array(
            "draw" =>$i,
            "recordsTotal" => $i,
            "recordsFiltered" => $i,
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->distribution->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->monthname;
            $row[] = $items->year;
//            $row[] = $items->paid;
//            $row[] = $items->balance;
            $act = ' <a  back="' . base_url() . 'hr/SalaryDistribution/list_all"  href="' . base_url() . 'hr/SalaryDistribution/create/' . $items->distribution_id . '" data-toggle="tooltip" title="edit" class="btn btn-warning "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/SalaryDistribution/list_all"  href="' . base_url() . 'hr/SalaryDistribution/view/' . $items->distribution_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/SalaryDistribution/list_all"  href="' . base_url() . 'hr/SalaryDistribution/payment/' . $items->distribution_id . '" data-toggle="tooltip" title="view" class="btn btn-primary ">Make Payment</span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/SalaryDistribution/list_all"  href="' . base_url() . 'hr/SalaryDistribution/list_distribution/' . $items->distribution_id . '" data-toggle="tooltip" title="view" class="btn btn-success ">Excel Export</span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->distribution->count_all(),
            "recordsFiltered" => $this->distribution->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
