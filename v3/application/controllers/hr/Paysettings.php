<?php

class Paysettings extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/Paysettings_model', 'Paysettings');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/paysettings/list');
    }

    public function save_salary() {
        $insert_id = $this->Paysettings->save_salary();
    }

    public function setcomponent() {
        return $this->Paysettings->setcomponent();
    }

    public function getemployee() {
        $search = strtolower($_GET['term']);
        return $this->Paysettings->getemployee($search);
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/paysettings/list_all');
    }

    public function add($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/paysettings/emp_salary', $data);
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/paysettings/create', $data);
    }

    public function view($id = 0) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('hr/paysettings/create', $data);
    }
    
    public function getpaysettings($id) {
        return $this->Paysettings->getpaysettings($id);
    }

    public function getsing($id) {
        return $this->Paysettings->getsing($id);
    }

    public function delete($pay_id) {
        $this->Paysettings->delete($pay_id);
    }

    public function save() {
        $insert_id = $this->Paysettings->save();
    }

    public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Paysettings->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pay_name;
            $row[] = $items->pay_type;
            $row[] = $items->pay_enable;
            $act = ' <a  back="' . base_url() . 'hr/paysettings/list_all"  href="' . base_url() . 'hr/Paysettings/create/' . $items->pay_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/paysettings/list_all' . '"  success="Delete ' . $items->pay_name . ' successfuly "  message="Do you want Delete ' . $items->pay_name . '?"  href="' . base_url() . 'hr/paysettings/delete/' . $items->pay_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'hr/paysettings/list_all"  href="' . base_url() . 'hr/paysettings/view/' . $items->pay_id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Paysettings->count_all(),
            "recordsFiltered" => $this->Paysettings->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function sal_list() {
        $this->Paysettings->where();
        $list = $this->Paysettings->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pro_fname;
            $row[] = $items->user_name;
            $row[] = $items->created_date;
            $row[] = $items->total;
            $act = ' <a  back="' . base_url() . 'hr/paysettings/list_all"  href="' . base_url() . 'hr/Paysettings/add/' . $items->sal_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . '/hr/paysettings/listall' . '"  success="Delete ' . $items->pro_fname . ' successfuly "  message="Do you want Delete ' . $items->pro_fname . '?"  href="' . base_url() . 'hr/paysettings/deletesalary/' . $items->sal_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Paysettings->count_all(),
            "recordsFiltered" => $this->Paysettings->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
