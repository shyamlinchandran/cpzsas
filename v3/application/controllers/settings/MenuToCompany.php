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
class MenuToCompany extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MenuToCompany_model', 'MenuToCompany');
        $this->load->helper('url');
    }

    public function listall() {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
//       // $data['type'] = $type;
        $this->load->view('settings/list_all');
    }
     function save()
    {
     $this->MenuToCompany->Save();
       }

 function add() {
        $id=0;
        $data['list'] = $this->MenuToCompany->menus();
        $re = $this->MenuToCompany->Company($id);
        $data['drs'] = $re;
        $this->load->view('settings/create', $data);
    }
    function edit($id) {
        $data['list'] = $this->MenuToCompany->menu($id);
        $re = $this->MenuToCompany->Company($id);
        $data['drs'] = $re;
        $this->load->view('settings/create', $data);
    }
    function delete($id) {
        $this->MenuToCompany->delete($id);
        
    }

    public function ajax_list() {
        $this->MenuToCompany->where();
        $list = $this->MenuToCompany->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $type) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $type->name;

            $row[] = '<a  href="' . base_url() . 'settings/MenuToCompany/edit/' . $type->com_id .'" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/MenuToCompany/delete/' . $type->com_id . '" title="delete"  data-toggle="tooltip"><span class="glyphicon glyphicon-remove-sign"></span></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->MenuToCompany->count_all(),
            "recordsFiltered" => $this->MenuToCompany->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
