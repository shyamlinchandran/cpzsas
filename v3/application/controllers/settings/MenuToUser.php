<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuToUser
 *
 * @author dimind
 */
class MenuToUser extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('MenuToUser_model', 'Menu');
        $this->load->model('menusettings_model', 'UMenu');
    }

    //put your code here
    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/MenuToUser/list_all');
    }

    function create($id = 0, $type = '') {
        
    }

    function edit($id) {
        $result = $this->Menu->getmenus($id);
        $data['list'] = $result;
        $re = $this->Menu->user($id);
        $data['user'] = $re;
        $this->load->view('settings/MenuToUser/editusermenu', $data);
    }

    public function ajax_list() {
        $this->Menu->where();
        $list = $this->Menu->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $menus) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $menus->user_name;
            $row[] = '<a  href="' . base_url() . 'settings/MenuToUser/edit/' . $menus->uid . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   ';
//<a  class="btn btn-info "  href="' . base_url() . 'settings/MenuToUser/view/' . $menus->uid . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Menu->count_all(),
            "recordsFiltered" => $this->Menu->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function menuuser() {
        $data['list'] = $this->Menu->menus();
        $re = $this->Menu->userlist();
        $data['user'] = $re;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('settings/usermenu', $data);
    }

    function save() {
        $this->UMenu->save();
    }

}
