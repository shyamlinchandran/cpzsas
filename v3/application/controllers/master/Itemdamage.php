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
class Itemdamage extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('itemdamage_model', 'items');
    }

    public function list_all() {
         $this->load->view('_blocks/subpages/list'); 
        $this->load->view('master/items/list_damage');
    }
     public function itemdamage($id = 0, $view = '') {
        $settings = $this->items->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/itemdamage', $data);
    }
     public function view($id) {
        $settings = $this->items->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/itemdamage', $data);
    }
     public function edit($id) {
        $settings = $this->items->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/itemdamage', $data);
    }
    public function save(){
        $this->items->save();

           }
    public function getdamage($id){
       return $this->items->getdamage($id);

    }


    public function ajax_list() { 
        $this->items->where();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no; 
            $row[] = $items->date; 
			$row[] = $items->invoice; 
            $row[] = $items->name;
            $row[] = $items->quantity; 
            $act = '<a   back="' . base_url() . 'master/Itemdamage/list_all" href="' . base_url() . 'master/itemdamage/view/' . $items->damage_id . '" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/itemdamage/list_all"  href="' . base_url() . 'master/itemdamage/edit/' . $items->damage_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
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
