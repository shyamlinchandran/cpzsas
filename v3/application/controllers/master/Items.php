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
class Items extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('items_model', 'items');
    }

    public function list_all($type) {
        $data['isbatch'] = $this->getKey('isbatch');
        $this->load->view('_blocks/subpages/list');
        $data['sale_type'] = $type;
        $this->load->view('master/items/list_all', $data);
    }

    public function Productscreate($id = 0, $view = '') {
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/Productscreate', $data);
    }

    public function ProductTransfer($id = 0, $view = '') {
		 $settings = $this->items->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/create', $data);
    }

    public function getproducts($id) {
        $pdt = $this->items->getproducts($id);
        echo json_encode($pdt);
    }

    public function gettransfer($id) {
        $pdt = $this->items->gettransfer($id);
        echo json_encode($pdt);
    }

    public function getpitem($id) {
        $pdt = $this->items->getpitem($id);
        echo json_encode($pdt);
    }

    public function search($type) {

        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
            $this->items->getautocomplete($q, $type);
        }
    } 
    public function save_sitem() {
        $this->items->save_sitem();
    } 
    public function save_transfer() {
        $this->items->save_transfer();
    } 
    public function batch() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('batch');
            $crud->set_subject(label('Batch', $this, $this->user));
            $crud->columns('Code', 'Barcode', 'Item', 'mrp');
            $crud->required_fields('Code', 'Barcode', 'Openstock', 'Prate', 'Item', 'mrp');
            $crud->display_as('Prate', 'Purchase Rate');
            $crud->display_as('Openstock', 'Open Stock');
            $crud->display_as('mrp', 'MRP');
            $crud->display_as('Whol_salerte', 'Whole Sale Rate');
            $crud->set_relation('Item', 'item', 'name');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));
            $columns = array('Code', 'Barcode', 'Openstock', 'Prate', 'Item', 'mrp','Whol_salerte');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function ajax_list() {

        $isbatch = $this->getKey('isbatch');
        $this->items->where();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->itemname;
            ///////////////////////////////////////////Barcode colmn hide//////////////////////////////////////////////////
            if ($isbatch == 0) {
                $row[] = $items->barcode;
            }
            $row[] = $items->category;
            $row[] = $items->group_name;
            $row[] = $items->unit;
            $row[] = $items->tax;

            $act = '<a   back="' . base_url() . 'master/items/list_all" href="' . base_url() . 'items/item/read/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/items/list_all"  href="' . base_url() . 'items/item/edit/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
