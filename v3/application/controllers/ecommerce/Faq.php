<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of costm2
 *
 * @author dimind
 */
class Faq extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('ecommerce/Faq_model', 'ecommerce');
    }

    public function listall() {
//        $this->load->view('_blocks/subpages/list');
        $this->load->view('ecommerce/faq');
    }

//
//    function getsing_cost($id) {
//        $this->costm->getsing_cost($id);
//    }
//    function create($id = 0) {
//        $this->load->view('_blocks/subpages/create');
//        //$location = $this->crm->location();
//        /* $source = $this->crm->enquiry();
//          $btype = $this->crm->business();
//          $product = $this->crm->product();
//          $data['enquiry'] = $source;
//          $data['btype'] = $btype;
//          $data['product'] = $product; */
//        //$isbatch = $this->getKey('isbatch');
//        $data['id'] = $id;
//        $data['title'] = 'Cost Centre';
//        $data['view'] = 'create';
//        $this->load->view('cost_analytics/create_costc', $data);
//    }
//    function edit($id) {
//        $this->load->view('_blocks/subpages/create');
//        $data['id'] = $id;
//        $data['title'] = 'Cost Center';
//        $data['view'] = 'edit';
//        $this->load->view('cost_analytics/create_costc', $data);
//    }
//    function view($id) {
//        $this->load->view('_blocks/subpages/create');
//        $data['id'] = $id;
//        $data['title'] = 'Cost Center';
//        $data['view'] = 'view';
//        $this->load->view('cost_analytics/create_costc', $data);
//    }
//
//    public function cost_centres() {
//        $search = strtolower($_GET['term']);
//        return $this->costm->cost_centres($search);
//    }
//    public function callback_name($row) {
//        if ($row == '') {
//            return 'cost_name';
//        } else {
//            return 'name_lan';
//        }
//    }

    public function ajax_list() {
        //$this->items->where();

        $list = $this->ecommerce->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $costm) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($this->multiple == 0) {
                $row[] = $costm->cost_name;
            } else {
                if ($this->language != 'en') {
                    $name = $this->callback_name($costm->name_lan);
                    $row[] = $costm->$name;
                } else {
                    $row[] = $costm->cost_name;
                }
            }
            $row[] = $costm->Question;
            $row[] = $costm->Answer;
            $row[] = $costm->Published;
            $act = '<a   href="' . base_url() . 'ecommerce/Faq/view/' . $costm->cost_id . '"  back="' . site_url("ecommerce/Faq/listall") . '"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'ecommerce/Faq/edit/' . $costm->cost_id . '" back="' . site_url("ecommerce/Faq/listall") . '"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'ecommerce/Faq/listall/' . '"  success="Delete ' . $costm->cost_name . ' successfuly "  message="Do you want Delete ' . $costm->cost_name . '?"  href="' . base_url() . 'ecommerce/Faq/delete/' . $costm->cost_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ecommerce->count_all(),
            "recordsFiltered" => $this->ecommerce->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

//
//    function save() {
//        $this->costm->save();
//    }
//    public function delete($id) {
//        $this->costm->delete($id);
//    }
}
