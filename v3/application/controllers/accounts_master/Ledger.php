<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */
class Ledger extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('accounts_master/Ledgers_model', 'ledgers');
        $this->load->model('Accounts_model', 'accounts');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('accounts_master/ledgers/list_all');
    }

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Ledger';
        $data['view'] = 'create';
        $this->load->view('accounts_master/ledgers/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Ledger';
        $data['view'] = 'edit';
        $this->load->view('accounts_master/ledgers/create', $data);
    }

    function view($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Ledger';
        $data['view'] = 'view';
        $this->load->view('accounts_master/ledgers/create', $data);
    }

    public function delete($id) {
        $this->ledgers->delete($id);
    }

    public function getsing($id) {
        $this->ledgers->getsing($id);
    }

    public function save() {
        $this->ledgers->save_ledgers();
    }

    function main_ledger() {
        return $this->ledgers->main_ledger();
    }

    public function acctype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('acc_type');
            $crud->set_subject(label('Account Types', $this, $this->user));
            $crud->unique_fields('name');
            // $crud->fields('name');
            $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->required_fields('name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            // $crud->fields('name','type_code');
            $crud->display_as('type_code', 'Code');
            $crud->columns('name', 'type_code');
            if ($this->multiple == 0) {
                $crud->fields('name', 'type_code');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name', 'name_lan', 'type_code');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $crud->unset_back_to_list();

            $columns = array('name', 'name_lan', 'type_code');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_name($value, $row) {
        if ($row->name_lan == '') {
            return $row->name;
        } else {
            return $row->name_lan;
        }
    }

    public function accsubtype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('acc_sub_type');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_subject(label('Account Sub Types', $this, $this->user));
            $crud->required_fields('name', 'acc_type_id');
            $crud->display_as('acc_type_id', 'Type');
            $crud->display_as('sub_code', 'Code');
            $crud->set_relation('acc_type_id', 'acc_type', 'name');
            $crud->unique_fields('name');
            $crud->columns('name', 'acc_type_id', 'sub_code');
            if ($this->multiple == 0) {
                $crud->fields('name', 'acc_type_id', 'sub_code');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name', 'name_lan', 'acc_type_id', 'sub_code');
                    $crud->set_relation('acc_type_id', 'acc_type', "{name} - {name_lan}");
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $crud->unset_back_to_list();

            // $crud->unset_add();
            $crud->unset_delete();
            $crud->unset_columns(array('published', 'updatedate'));
            $columns = array('name', 'name_lan', 'acc_type_id', 'sub_code');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->set_rules('price', 'price', 'required|numeric');
            $crud->callback_after_insert(array($this, 'create_acc_sub_code'));
            $output = $crud->render();

            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function mainledgers() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('acc_main');
            $crud->set_subject(label('Main Ledgers', $this, $this->user));
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->required_fields('name', 'acc_sub_type_id');
            $crud->display_as('acc_sub_type_id', 'Sub Type');
            $crud->set_relation('acc_sub_type_id', 'acc_sub_type', 'name');
            $crud->unique_fields('name', 'code');
            $crud->set_relation('branch_id', 'company_branch', 'brc_name');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->columns('name', 'acc_sub_type_id', 'code');
            if ($this->multiple == 0) {
                $crud->fields('name', 'acc_sub_type_id', 'code');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name', 'name_lan', 'acc_sub_type_id', 'code');
                    $crud->set_relation('acc_sub_type_id', 'acc_sub_type', 'name_lan');
                }
            }
            $columns = array('name', 'code', 'acc_sub_type_id', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
//            $crud->set_rules('price', 'price', 'required|numeric');
            $crud->unset_back_to_list();

            $crud->callback_after_insert(array($this, 'create_acc_main_code'));

            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function ledgers() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('acc_ledgers');
            $crud->set_subject(label('Ledgers', $this, $this->user));
            $crud->required_fields('name', 'acc_main_id');
            $crud->display_as('acc_main_id', 'Main Ledger');
            $crud->set_relation('acc_main_id', 'acc_main', 'name');
            $crud->unique_fields('name', 'code');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->set_relation('tax_id', 'taxgst', 'GST');
            $crud->display_as('tax_id', 'Tax');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->field_type('ref_id', 'hidden', 0);
            $crud->field_type('ref_code', 'hidden', 'yes');
            $crud->field_type('is_default', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'ref_id', 'ref_code', 'is_default', 'updatedate'));
            $crud->display_as('openning_bal', 'Opening Balance');
            $crud->set_rules('openning_bal', 'openning_bal', 'numeric');
            $columns = array('name', 'name_lan', 'code', 'openning_bal', 'acc_main_id', 'tax_id', 'type', 'acc_ledger_code');
            $crud->fields('name', 'name_lan', 'code', 'openning_bal', 'acc_main_id', 'tax_id', 'type', 'acc_ledger_code');
            if ($this->multiple == 0) {
                $crud->fields('name', 'code', 'openning_bal', 'acc_main_id', 'tax_id', 'type', 'acc_ledger_code');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'code', 'openning_bal', 'acc_main_id', 'tax_id', 'type', 'acc_ledger_code');
                    $crud->set_relation('acc_main_id', 'acc_main', "{name} - {name_lan}");
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->unset_back_to_list();

            $crud->callback_after_insert(array($this, 'create_ledgers_code'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function unique_field_name($field_name) {
        return 's' . substr(md5($field_name), 0, 8); //This s is because is better for a string to begin               with a letter and not with a number
    }

    public function finacial() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('fin_year');
            $crud->set_subject(label('Financial Years', $this, $this->user));
            $crud->required_fields('name', 'start_date', 'end_date');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unique_fields('name');
            $crud->unset_columns(array('published', 'updatedate'));
            $columns = array('name', 'start_date', 'end_date');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            // $crud->display_as('openning_bal', 'Opening Balance');
            //$crud->set_rules('openning_bal', 'openning_bal', 'required|numeric');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function acc_sub_code($sub_type_id, $primary_key) {
        $this->accounts->acc_sub_code($sub_type_id, $primary_key);
        return TRUE;
    }

    public function create_acc_sub_code($post_array, $primary_key) {
        return $this->acc_sub_code($post_array['acc_type_id'], $primary_key);
    }

    public function create_acc_main_code($post_array, $primary_key) {
        return $this->acc_main_code($post_array['acc_sub_type_id'], $primary_key);
    }

    public function acc_main_code($acc_sub_type_id, $primary_key) {
        return $this->accounts->acc_main_code($acc_sub_type_id, $primary_key);
    }

    public function create_ledgers_code($post_array, $primary_key) {
        return $this->ledgers_code($post_array['acc_main_id'], $primary_key);
    }

    public function ledgers_code($acc_main_id, $primary_key) {
        return $this->accounts->ledgers_code($acc_main_id, $primary_key);
    }

    public function ajax_list() {
        $this->ledgers->where();
        $list = $this->ledgers->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $balance = 0;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            if ($this->multiple != 0) {
                $row[] = $vouchers->name_lan;
            }
            $row[] = $vouchers->code;
            $row[] = $vouchers->mainledger;
            $row[] = $vouchers->tax;
            $row[] = $vouchers->type;
            $row[] = $vouchers->openning_bal;
            if ($vouchers->type == "Dr") {
                $balance = (float) $vouchers->trans + (float) $vouchers->openning_bal ;
            } else {
                $balance =  (float) $vouchers->trans +  (float) $vouchers->openning_bal *  -1;
            }
            $row[] = $balance;
            $act = '<a back="' . base_url() . 'accounts_master/Ledger/listall" href="' . base_url() . 'accounts_master/Ledger/edit/' . $vouchers->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a back="' . base_url() . 'accounts_master/Ledger/listall" href="' . base_url() . 'reports/accounts/leadger/' . $vouchers->id . '" title="View" data-toggle="tooltip" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledgers->count_all() + 1,
            "recordsFiltered" => $this->ledgers->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
