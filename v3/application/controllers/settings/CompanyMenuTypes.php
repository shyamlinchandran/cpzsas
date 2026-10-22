<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMenuTypes
 *
 * @author admin
 */
class CompanyMenuTypes extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MenuTypes_model', 'type');
        $this->load->helper('url');
    }

    public function listall() {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
//       // $data['type'] = $type;
        $this->load->view('settings/list_all');
    }

    function edit($id) {
        $result = $this->type->get_menu_byid($id);
        $data['result'] = $result;
        
        $data['id'] = $id;
        $data['typename'] = $result;
        $this->load->view('settings/edit', $data);
    }
    function delete($id) {
        $this->type->delete($id);
        
    }

    public function ajax_list() {
        $this->type->where();
        $list = $this->type->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $type) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $type->type;

            $row[] = '<a  href="' . base_url() . 'settings/CompanyMenuTypes/edit/' . $type->id .'" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/CompanyMenuTypes/delete/' . $type->id . '" title="delete"  data-toggle="tooltip"><span class="glyphicon glyphicon-remove-sign"></span></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->type->count_all(),
            "recordsFiltered" => $this->type->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
