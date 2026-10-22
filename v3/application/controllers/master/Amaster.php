<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Amaster
 *
 * @author Dimind
 */
class Amaster extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('items_model', 'item');
    }

    public function _callback_material($value, $row) {
        if ($row->name_lan == '') {
            return $row->mty_name;
        } else {
            return $row->name_lan;
        }
    }
	
	public function purity() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('purity');
            $crud->set_subject(label('Purity', $this, $this->user));
            $crud->required_fields('purity'); //crr_name crr_symbol
            $crud->display_as('purity', 'Purity');
            $crud->columns('purity');
            $columns = array('purity');
            $crud->unset_delete();

            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function material_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('material_type');
            $crud->set_subject(label('Material Type', $this, $this->user));
            $crud->required_fields('mty_name');
            $crud->display_as('mty_name', 'Name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->columns('mty_name');
            if ($this->multiple == 0) {
                $crud->fields('mty_name');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan');
                    $crud->callback_column('name_lan', array($this, '_callback_material'));
                }
            }
            $crud->unset_columns(array('updatedate'));
            $columns = array('mty_name', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->unset_add();
            $crud->unset_edit();
            $crud->unset_delete();
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_brands($value, $row) {
        if ($row->name_lan == '') {
            return $row->ibr_name;
        } else {
            return $row->name_lan;
        }
    }

    public function brands_master() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('item_brand');
            $crud->set_subject(label('Brands', $this, $this->user));
            $crud->required_fields('ibr_name'); //crr_name crr_symbol
            $crud->unique_fields('ibr_name');
            $crud->display_as('ibr_name', 'Name');
            $crud->display_as('ibr_description', 'Description');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_relation('discount', 'item_group', 'name');
            $crud->unset_columns(array('updatedate'));
            $crud->columns('ibr_name', 'ibr_description','discount');
            if ($this->multiple == 0) {
                $crud->fields('ibr_name', 'ibr_description','discount');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'ibr_description','discount');
                    $crud->callback_column('name_lan', array($this, '_callback_brands'));
                }
            }
            $columns = array('ibr_name', 'ibr_description', 'name_lan','discount');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_currency($value, $row) {
        if ($row->name_lan == '') {
            return $row->crr_name;
        } else {
            return $row->name_lan;
        }
    }

    public function currency_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('currency_tbl');
            $crud->set_subject(label('Currency', $this, $this->user));
            $crud->required_fields('crr_name', 'crr_symbol'); //crr_name crr_symbol
            $crud->display_as('crr_name', 'Name');
            $crud->display_as('crr_symbol', 'Symbol');
            $crud->display_as('crr_value', 'Exchange Amount');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->columns('crr_name', 'crr_symbol', 'crr_value','crr_major_unit','crr_minor_unit');
            if ($this->multiple == 0) {
                $crud->fields('crr_name', 'crr_symbol', 'crr_value','crr_major_unit','crr_minor_unit');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'crr_symbol', 'crr_value','crr_major_unit','crr_minor_unit');
                    $crud->callback_column('name_lan', array($this, '_callback_currency'));
                }
            }
            $columns = array('crr_name', 'crr_symbol', 'name_lan', 'crr_value','crr_major_unit','crr_minor_unit');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function printers() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('printers');
            $crud->set_subject(label('Printers', $this, $this->user));
            $crud->required_fields('prn_name', 'prn_type'); //crr_name crr_symbol
            $crud->display_as('prn_name', 'Name');
            $crud->display_as('prn_type', 'Type');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->columns('prn_name', 'prn_type');
            $columns = array('prn_name', 'prn_type');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function material_types() {
        return $this->item->material_types();
    }

    function item_size() {
        return $this->item->item_size();
    }

    function hsn_code() {
        return $this->item->Hsncode();
    }

    function item_category() {
        return $this->item->get_category();
    }

    function item_group() {
        return $this->item->Group();
    }

    function unit() {
        return $this->item->unit();
    }

    function tax() {
        return $this->item->tax();
    }

    function cess() {
        return $this->item->cess();
    }

    function racks() {
        return $this->item->racks();
    }

    function brands() {
        return $this->item->brands();
    }

    function states() {
        $this->load->model('customers_model', 'customers');
        return $this->customers->states();
    }

}
