<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Questioner  extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Questioner_model', 'questioner');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/questioner/list_all');
    }
    public function add($id=0) {
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/questioner/add',$data);
    }
    public function getquestion($id) {
        return $this->questioner->getquestion($id);
    }

    public function ajax_list() {
        $this->questioner->where();
        $list = $this->questioner->get_datatables();
        $data = array();
        $no = $this->input->post('start');
         foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->question;
            $row[] = $item->part;
            $act = '<a  href="' . base_url() . 'clinic/Questioner/add/' . $item->id . '" title="Check" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->questioner->count_all(),
            "recordsFiltered" => $this->questioner->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function save() {
        $id = $this->questioner->save();
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

