<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Medicine  extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Medicine_model', 'medicine');
    }
    public function book() {
        return $this->medicine->book();
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/medicine/list_all');
    }
    public function add($id=0) {
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/medicine/add',$data);
    }
    public function getquestion($id) {
        return $this->medicine->getquestion($id);
    }

    public function  Medicine($id){
        return  $this->medicine->Medicine($id);
    }

    public function ajax_list() {
        $this->medicine->where();
        $list = $this->medicine->get_datatables();
        $data = array();
        $no = $this->input->post('start');
         foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->bok_name;
            $row[] = $item->part;
            $act = '<a  href="' . base_url() . 'clinic/medicine/add/' . $item->id . '" title="Check" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->medicine->count_all(),
            "recordsFiltered" => $this->medicine->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function save() {
        $id = $this->medicine->save();
         if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
            echo json_encode($response);
        }
    }

}

