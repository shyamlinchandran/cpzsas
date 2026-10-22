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
class Godown extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('godown_model', 'godown');
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/list_godown');
    }

    function delete($id) {
        $qry = "delete from  ims_godown where id =" . $id;
        $this->db->query($qry);
    }

    public function ajax_list() {
        $this->godown->where();
        $list = $this->godown->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->godown_name;
            $row[] = $items->godown_address;
            $row[] = $items->godown_contactno;
            $row[] = $items->godown_contact_person;
            //$row[] = $items->godown_name; 
            $act = '<a   back="' . base_url() . 'master/godown/list_all" href="' . base_url() . 'master/godown/godown/read/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/godown/list_all"  href="' . base_url() . 'master/godown/godown/edit/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            if ($items->count == 0) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . 'master/godown/list_all"  success="Delete ' . $items->godown_name . ' successfuly "  message="Do you want Delete ' . $items->godown_name . '?"  href="' . base_url() . 'master/godown/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->godown->count_all(),
            "recordsFiltered" => $this->godown->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function _callback_name($value, $row) {
        if ($row->name_lan == '') {
            return $row->godown_name;
        } else {
            return $row->name_lan;
        }
    }

    public function godown() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ims_godown');
            $crud->set_subject(label('Godown', $this, $this->user));
            $crud->columns('godown_name' ,'godown_code', 'godown_address', 'godown_contactno', 'godown_contact_person', 'company');
            $crud->required_fields('godown_name', 'godown_address','company');
            $crud->display_as('godown_contactno', 'Contact No');
            $crud->unset_columns(array('updatedate'));
            $crud->set_rules('godown_contactno', 'Contact No', 'numeric');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_relation('company', 'company', 'name');
            $crud->unset_back_to_list();
            if ($this->multiple == 0) {
                $crud->fields('godown_name', 'godown_code','godown_address', 'godown_contactno', 'godown_contact_person', 'company');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'godown_code', 'godown_address', 'godown_contactno', 'godown_contact_person', 'company');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('godown_name', 'godown_code', 'godown_address', 'name_lan', 'godown_contact_person', 'godown_contactno', 'company');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
