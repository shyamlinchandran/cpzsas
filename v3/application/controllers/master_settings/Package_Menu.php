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
class Package_Menu extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('master_settings/Package_Menu_model', 'package');
        $this->load->model('MenuToCompany_model', 'MenuToCompany');
        $this->load->helper('url');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master_settings/package/list_all');
    }

    function package_menu($id = "0") {
        $data['list'] = $this->package->menus($id);
        $package = $this->package->packagelist();
        $data['package'] = $package;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('master_settings/package/create', $data);
    }

    function ajax_list() {
        $this->package->where();
        $list = $this->package->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $menus) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $menus->package;
            $row[] = '<a  href="' . base_url() . 'master_settings/Package_Menu/package_menu/' . $menus->package_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   ';
//<a  class="btn btn-info "  href="' . base_url() . 'settings/MenuToUser/view/' . $menus->uid . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->package->count_all(),
            "recordsFiltered" => $this->package->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->package->save();
    }

}
