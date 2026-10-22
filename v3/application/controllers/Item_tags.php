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
class Item_tags extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Item_tag_model', 'tags');
    }

    function list_all() {
        $data['title'] = 'Item Tags';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('item_tags/listall', $data);
    }

    function list_tag() {
        $data['title'] = 'Item Tags';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('item_tags/list_all', $data);
    }

    public function gesing($id) {
        return $this->tags->gesing($id);
    }

    public function save() {
        $id = $this->tags->save();
        if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }
    }

    function create($id = 0) {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('item_tags/create', $data);
    }

    function addtag($id = 0) {
        $data['tags'] = $this->tags->getalltags();
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('item_tags/add', $data);
    }

    function getalltags($id=0) {
        return $this->tags->getalltags($id);
    }

    public function tag_list() {
        $this->tags->where_tag();
        $list = $this->tags->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = '<a  href="' . base_url() . 'Item_tags/addtag/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->tags->count_all() + 1,
            "recordsFiltered" => $this->tags->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->tags->where();
        $list = $this->tags->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->tag_name;
            $row[] = '<a  href="' . base_url() . 'Item_tags/create/' . $vouchers->tag_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->tags->count_all() + 1,
            "recordsFiltered" => $this->tags->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
