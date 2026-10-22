<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items
 *
 * @author jijodileep
 */
class test extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('test/test_model', 'test');
    }
    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('test/listall');
    }

    public function ajax_list() {
        $this->test->where();
        $list = $this->test->get_datatables();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = $items->fromname;
            $row[] = $items->godown_name;
            $act = '<a   back="' . base_url() . 'master/ProductTransfer/list_all" href="' . base_url() . 'master/items/ProductTransfer/' . $items->cid . '/view" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/ProductTransfer/list_all"  href="' . base_url() . 'master/items/ProductTransfer/' . $items->cid . '/edit" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }


}
