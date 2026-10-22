<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of analyt2
 *
 * @author dimind
 */
class Analytics_centre extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('cost_analytics/analytics_model', 'analyt');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('cost_analytics/list_analytics');
    }

    function getsing_any($id) {
        $this->analyt->getsing_any($id);
    }

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Analytics Center';
        $data['view'] = 'create';
        $this->load->view('cost_analytics/create_analytics', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Analytics Center';
        $data['view'] = 'edit';
        $this->load->view('cost_analytics/create_analytics', $data);
    }

    function view($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Analytics Center';
        $data['view'] = 'view';
        $this->load->view('cost_analytics/create_analytics', $data);
    }

    public function analyt_centres() {
        $search = strtolower($_GET['term']);
        return $this->analyt->analyt_centres($search);
    }

    public function ajax_list() {
        //$this->items->where(); 
        $list = $this->analyt->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $analyt) {
            $no++;
            $row = array();
            $row[] = $no; //          any_description
            if ($this->language == 'en') {
                $row[] = $analyt->any_name;
            } else {
                if ($analyt->name_lan == '') {
                    $row[] = $analyt->any_name;
                } else {
                    $row[] = $analyt->name_lan;
                }
            }

            $row[] = $analyt->mainanname;
            $act = '<a   href="' . base_url() . 'cost_analytics/analytics_centre/view/' . $analyt->any_id . '"  back="' . site_url("cost_analytics/analytics_centre/listall") . '"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'cost_analytics/analytics_centre/edit/' . $analyt->any_id . '" back="' . site_url("cost_analytics/analytics_centre/listall") . '"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'cost_analytics/analytics_centre/listall/' . '"  success="Delete ' . $analyt->any_name . ' successfuly "  message="Do you want Delete ' . $analyt->any_name . '?"  href="' . base_url() . 'cost_analytics/analytics_centre/delete/' . $analyt->any_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->analyt->count_all(),
            "recordsFiltered" => $this->analyt->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->analyt->save();
    }

    public function delete($id) {
        $this->analyt->delete($id);
    }

}
