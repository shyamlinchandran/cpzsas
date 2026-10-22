<?php

class SalaryPackage extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/SalaryPackage_model', 'package');
    }

    public function list_all() {
        $data['type'] = 'package';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarypackage/list_all', $data);
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarypackage/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/salarypackage/create', $data);
    }

    public function getsing($package) {
        $id = $this->input->post('component_type');
        return $this->package->getsing($id, $package);
    }

    public function getemployeePackage($employee) {
        $id = $this->input->post('component_type');
        return $this->package->getemployeePackage($id, $employee);
    }

    public function delete($pay_id) {
        $this->package->delete($pay_id);
    }

    public function save() {
        $insert_id = $this->package->save();
    }

    public function ajax_list() {
        $this->package->where();
        $list = $this->package->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<font id="name">' . $items->pro_fname . '</font>';
            $row[] = $items->status;
            $row[] = $items->renewal;
            $row[] = $items->note;
            $row[] = $items->amount;
            $act = ' <a  back="' . base_url() . 'hr/SalaryPackage/list_all"  href="' . base_url() . 'hr/SalaryPackage/create/' . $items->package_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/SalaryPackage/list_all' . '"  success="Delete ' . $items->pro_fname . ' successfuly "  message="Do you want Delete ' . $items->pro_fname . '?"  href="' . base_url() . 'hr/paysettings/delete/' . $items->package_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/SalaryPackage/list_all"  href="' . base_url() . 'hr/SalaryPackage/view/' . $items->package_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->package->count_all(),
            "recordsFiltered" => $this->package->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
