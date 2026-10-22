<?php

class EmployeeReport extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('hr/EmployeeReport_model', 'Employee');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('hr/employeereport/list');
    }

    public function ajax_list() {
        $this->Employee->where();
        $list = $this->Employee->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->pro_fname;
            $row[] = '<font style="' . $items->iqama . '" >' . $items->iqama_end_date . '</font >';
            $row[] = '<font style="' . $items->lice . '" >' . $items->licence_end_date . '</font >';
            $row[] = '<font style="' . $items->insu . '" >' . $items->insurence_end_date . '</font >';
            $row[] = $items->pro_mobile;
            $row[] = $items->iqama_no;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Employee->count_all(),
            "recordsFiltered" => $this->Employee->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
