<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Newmasters
 *
 * @author jijodileep
 */
class Newmasters extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
    }

    var $sup = 5;
    var $cus = 1;
    var $Sales = 9;
    var $Purchase = 11;
    var $Tax = 7;
    var $ref = 34; //ref id 

    public function keys() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('keys');
            $crud->set_subject('Keys');
            $crud->required_fields('key', 'value', 'details');
            $crud->columns('key', 'value', 'details');
            $crud->unique_fields('key');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            //$crud->field_type('published', 'hidden', 'yes');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
	


    public function tra_charges() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_charges');
            $crud->set_subject('Tra Charges');
            $crud->required_fields('Name', 'details');
            $crud->unset_columns(array('updatedate'));
            $crud->set_relation('fk_charge', 'tra_charges', 'Name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'create_ledger_tra'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_leavetype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_leavetype');
            $crud->set_subject('Databases');
            $crud->required_fields('leave_name', 'leave_days', 'max_deduction_precentage', 'max_earning_percentage','primary_deduction_precentage','sec_deduction_percentage','pri_deduction_period','pri_earning_percentage','deduction_base');
            $crud->display_as('leave_name', 'Leave Name');
            $crud->display_as('leave_days', 'Allowed Days');
            $crud->display_as('max_deduction_precentage', 'Maximum Deduction Percentage');
            $crud->display_as('max_earning_percentage', 'Maximum Earning Percentage');
            $crud->display_as('primary_deduction_precentage', 'Primary Deduction Percentage');
            $crud->display_as('sec_deduction_percentage', 'Secondary Deduction Percentage');
            $crud->display_as('pri_deduction_period', 'Primary Deduction Period');
            $crud->display_as('pri_earning_percentage', 'Primary Earning Period');
            $crud->display_as('deduction_base', 'Base Of Bonus change');
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
	
	public function district() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('district');
            $crud->set_subject('Districts');
            $crud->required_fields('district_name');
            $crud->display_as('district_name', 'District');
            $crud->display_as('district_state', 'State');
            $crud->set_relation('district_state', 'state', 'StateName');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

	
	public function customer_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('customer_type');
            $crud->set_subject('Customer Types');
            $crud->required_fields('type');
            $crud->display_as('type', 'Customer Type');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function set_database() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_database');
            $crud->set_subject('Databases');
            $crud->required_fields('sdb_name', 'sdb_username', 'com_id', 'sdb_server');
            $crud->display_as('com_id', 'Company Name');
            $crud->display_as('sdb_name', 'Database');
            $crud->display_as('sdb_username', 'User Name');
            $crud->display_as('sdb_password', 'Password');
            $crud->display_as('sdb_server', 'Server');
            $crud->set_relation('com_id', 'company', 'name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function year_database() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_database');
            $crud->set_subject('Databases');
            $crud->required_fields('sdb_name', 'sdb_username', 'com_id', 'sdb_server');
            $crud->display_as('year_id', 'Year');
            $crud->display_as('sdb_name', 'Database');
            $crud->display_as('sdb_username', 'User Name');
            $crud->display_as('sdb_password', 'Password');
            $crud->display_as('sdb_server', 'Server');
            $crud->display_as('sdb_curnt', 'Current');
            $crud->set_relation('year_id', 'fin_year', 'name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger_tra($post_array, $primary_key) {
        if ($post_array['is_ledger'] == '1') {
            $this->createled($post_array['Name'], $post_array['details'], $primary_key, 'cha', $this->cus);
        }
        return TRUE;
    }

    public function consigne() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_consignee');
            $crud->set_subject('Consignee');
            $crud->required_fields('Name', 'address_line1', 'Credit_period', 'ContactP', 'pan');
            $crud->columns('Name', 'mobile', 'tin', 'Email', 'address_line1', 'ContactP');
            $crud->display_as('ContactP', 'Personal Contact');
            $crud->display_as('pan', 'PAN');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            //$crud->unique_fields('email', 'phone');
//            $crud->set_rules('email', 'Email', 'trim|required|valid_email');
//            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
//            $crud->set_rules('mobile', 'Mobile Number', 'required|min_length[10]|max_length[12]|integer');
            // $crud->field_type('published', 'hidden', 'yes');
            // $crud->callback_after_insert(array($this, 'create_ledger'));

            $crud->callback_after_insert(array($this, 'create_ledger'));
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

    public function print_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_printtype');
            $crud->set_subject(label('Print Types', $this, $this->user));
            $crud->required_fields('name', 'page');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published'));
            $crud->columns('name', 'page', 'language');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            if ($this->multiple == 0) {
                $crud->fields('name', 'page', 'pagesize','half_pagesize', 'bill_default', 'bill_format', 'code', 'image', 'language');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'page');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                }
            }
            $columns = array('name', 'page', 'pagesize','half_pagesize', 'bill_default', 'bill_format', 'name_lan', 'code', 'image', 'language');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_bill($value, $row) {
        if ($row->name_lan == '') {
            return $row->type;
        } else {
            return $row->name_lan;
        }
    }

    public function bill_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('set_billtype');
            $crud->set_subject(label('Bill Type', $this, $this->user));
            $crud->required_fields('type', 'print_type', 'branch_id', 'cash', 'bank','is_pos','is_active');
            $crud->set_relation('print_type', 'set_printtype', 'name');
            $crud->set_relation('godown_id', 'ims_godown', 'godown_name');
            $crud->display_as('godown_id', 'Godown');
            $crud->display_as('is_pos', 'Is POS');

            $crud->columns('type','is_pos','print_type', 'godown_id', 'transaction','set_rate','preffix','startnumber','suffix','is_active');
            $crud->field_type("transaction", 'dropdown', array('sales' => 'Sales', 'sales_return' => 'Sales Return', 'estimate' => 'Sales Order', 'purchase' => 'Purchase', 'purchase_return' => 'Purchase Return', 'order' => 'Purchase Order', 'pay' => 'Payment', 'rec' => 'Receipt', 'jou' => 'Journal', 'contra' => 'Contra', 'quotation' => 'Quotation', 'trip' => 'Trip','online'=>'Online','delivery_note'=>'Delivery Note','replacement'=>'Replacement','credit_note'=>'Credit Note','debit_note'=>'Debit Note','quickreceipt'=>'Quick Receipt','quickpayment'=>'Quick Payment'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->callback_after_insert(array($this, 'create_key'));
            $crud->set_relation('branch_id', 'company_branch', 'brc_name');
            $crud->set_relation('cash', 'acc_ledgers', 'name', ['acc_ledgers.acc_main_id = ' => '4']);
            $crud->set_relation('bank', 'acc_ledgers', 'name', ['acc_ledgers.acc_main_id = ' => '1']);
            if ($this->multiple == 0) {
                $crud->fields('type','print_type', 'godown_id','set_rate', 'transaction', 'startnumber', 'seperator', 'suffix', 'preffix',  'is_pos','cash', 'bank', 'branch_id','is_active');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan','is_pos', 'print_type', 'godown_id', 'transaction','is_active');
                    $crud->set_relation('print_type', 'set_printtype', 'name_lan');
                    $crud->set_relation('godown_id', 'ims_godown', 'name_lan');
                    $crud->field_type("transaction", 'dropdown', array('sales' => 'Sales', 'sales_return' => 'Sales Return', 'estimate' => 'Sales Order', 'purchase' => 'Purchase', 'purchase_return' => 'Purchase Return', 'order' => 'Purchase Order', 'pay' => 'Payment', 'rec' => 'Receipt', 'jou' => 'Journal', 'contra' => 'Contra', 'quotation' => 'Quotation', 'trip' => 'Trip','online'=>'Online','replacement'=>'Replacement'));
                    $crud->field_type("set_rate", 'dropdown', array('srate' => 'Sales Rate', 'MRP' => 'MRP', 'wh_rate' => 'WholeSale Rate', 'special_rate' => 'Special Rate'));
                    $crud->set_relation('cash', 'acc_ledgers', 'name_lan', ['acc_ledgers.acc_main_id = ' => '4']);
                    $crud->set_relation('bank', 'acc_ledgers', 'name_lan', ['acc_ledgers.acc_main_id = ' => '1']);
                    $crud->callback_column('name_lan', array($this, '_callback_bill'));
                }
            }
            $columns = array('type', 'is_pos','print_type', 'godown_id','set_rate','transaction', 'startnumber', 'seperator', 'suffix', 'preffix', 'cash', 'bank', 'name_lan', 'branch_id','is_active');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function consiger() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_consigner');
            $crud->set_subject('Consigner');
            $crud->required_fields('Name', 'address_line1', 'ConatctP', 'pan');
            $crud->columns('Name', 'mobile', 'tin', 'Email', 'address_line1', 'ConatctP');
            $crud->display_as('ConatctP', 'Personal Contact');
            $crud->display_as('pan', 'PAN');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
//            $crud->unique_fields('Email', 'Phone');
//            $crud->set_rules('Email', 'Email', 'trim|required|valid_email');
//            $crud->set_rules('Phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
//            $crud->set_rules('mobile', 'Mobile Number', 'required|min_length[10]|max_length[12]|integer');
            // $crud->field_type('published', 'hidden', 'yes');
            // $crud->callback_after_insert(array($this, 'create_ledger'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function tra_forworder() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_forworder');
            $crud->set_subject('Forworder');
            $crud->required_fields('Name', 'address_line1', 'Credit_period', 'ConatctP', 'pan');
            $crud->columns('Name', 'mobile', 'tin', 'Email', 'address_line1', 'ConatctP');
            $crud->display_as('ConatctP', 'Personal Contact');
            $crud->display_as('pan', 'PAN');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
//            $crud->unique_fields('Email', 'Phone');
//            $crud->set_rules('Email', 'Email', 'trim|valid_email');
//            $crud->set_rules('Phone', 'Phone Number', 'required|min_length[10]|max_length[13]|integer');
//            $crud->set_rules('mobile', 'Mobile Number', 'min_length[10]|max_length[13]|integer');
            $crud->callback_after_insert(array($this, 'create_ledger_fwr'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function tra_transport() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_transport');
            $crud->set_subject('Transporter');
            $crud->required_fields('name', 'address_line1', 'credit_period', 'conatctp', 'pan');
            $crud->columns('name', 'mobile', 'tin', 'email', 'address_line1', 'conatctp');
            $crud->display_as('conatctp', 'Personal Contact');
            $crud->display_as('pan', 'PAN');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
//            $crud->unique_fields('Email', 'Phone');
//            $crud->set_rules('Email', 'Email', 'trim|valid_email');
//            $crud->set_rules('Phone', 'Phone Number', 'required|min_length[10]|max_length[13]|integer');
//            $crud->set_rules('mobile', 'Mobile Number', 'min_length[10]|max_length[13]|integer');
            $crud->callback_after_insert(array($this, 'create_ledger_trs'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function tra_line() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_line');
            $crud->set_subject('Line');
            $crud->required_fields('Name');
            $crud->columns('Name', 'freecode', 'freecode2');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function Delivery() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_delivery');
            $crud->set_subject('Delivery Master');
            $crud->required_fields('name');
            $crud->columns('name', 'details', 'free_code');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function PickUp() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tha_pickup');
            $crud->set_subject('Details Master');
            $crud->required_fields('Name');
            $crud->columns('Name', 'details', 'free_code');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vessal() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_vessal');
            $crud->set_subject('Vessal Master');
            $crud->required_fields('name');
            $crud->columns('name', 'details', 'free_code');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function tra_places() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_places');
            $crud->set_subject('Place');
            $crud->required_fields('Name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function drive() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_driver');
            $crud->set_subject('Driver');
            $crud->required_fields('Driver_name', 'Address', 'Mobile');
            $crud->set_rules('Mobile', 'Mobile Number', 'min_length[10]|max_length[13]|integer');
            $crud->unique_fields('Mobile');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger_fwr($post_array, $primary_key) {
        $this->createled($post_array['Name'], $post_array['Phone'] . '-' . $post_array['Email'], $primary_key, 'fwr', $this->sup);
        return TRUE;
    }

    public function create_ledger_trs($post_array, $primary_key) {
        $this->createled($post_array['name'], $post_array['phone'] . '-' . $post_array['email'], $primary_key, 'trs', $this->sup);
        return TRUE;
    }

    public function create_ledger($post_array, $primary_key) {
        $this->createled($post_array['Name'], $post_array['Phone'] . '-' . $post_array['Email'], $primary_key, 'con', $this->cus);
        return TRUE;
    }

    public function createled($name, $code, $primary_key, $ref_code, $acc_main_id) {
        $data = array(
            "name" => $name,
            "code" => $code,
            "ref_id" => $primary_key,
            "ref_code" => $ref_code,
            "is_default" => true,
            "acc_main_id" => $acc_main_id,
            "openning_bal" => 0,
            "published" => 'yes'
        );
        $this->ledger->create_ledger($data);
    }

    public function _callback_area($value, $row) {
        if ($row->name_lan == '') {
            return $row->area;
        } else {
            return $row->name_lan;
        }
    }

    public function Area() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ims_area');
            $crud->set_subject(label('Area', $this, $this->user));
            $crud->required_fields('area');
            $crud->unique_fields('area');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->columns('area', 'details');
            if ($this->multiple == 0) {
                $crud->fields('area', 'details');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'details');
                    $crud->callback_column('name_lan', array($this, '_callback_area'));
                }
            }
            $columns = array('area', 'details', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function SalesTypes() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('sales_types');
            $crud->set_subject('Sale Type');
            $crud->required_fields('start_no', 'sale_type');
            $crud->unset_columns(array('updatedate'));
            $crud->columns('sale_type', 'start_no', 'prifix', 'sufix');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_route($value, $row) {
        if ($row->name_lan == '') {
            return $row->route_name;
        } else {
            return $row->name_lan;
        }
    }

    public function Route() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ims_route');
            $crud->set_subject(label('Route', $this, $this->user));
            $crud->required_fields('route_name', 'area');
            $crud->unique_fields('route_name');
            $crud->set_relation('area', 'ims_area', 'area');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->columns('route_name', 'area');
            if ($this->multiple == 0) {
                $crud->fields('route_name', 'area');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'area');
                    //$crud->set_relation('area', 'ims_area', 'name_lan');
                    $crud->callback_column('name_lan', array($this, '_callback_route'));
                }
            }
            $columns = array('route_name', 'area', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
	
	public function uqc() {
         try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('uqc');
            $crud->set_subject('UQC');
            $crud->required_fields('uqc_name', 'uqc_details');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published'));
            $crud->columns('uqc_name', 'uqc_details');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
	
	public function ims_vehicle() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('ims_vehicle');
            $crud->set_subject('Vehicle');
            $crud->required_fields('Vehicle_num');
            $crud->set_relation('driver', 'ims_driver', 'Driver_name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->display_as('Vehicle_num', 'Vehicle Name');
            $crud->columns('Vehicle_num');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vehicle() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tra_vehicle');
            $crud->set_subject('Vehicle');
            $crud->required_fields('Vehicle_num', 'Contact_Person');
            $crud->set_relation('driver', 'tra_driver', 'Driver_name');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->columns('Vehicle_num', 'driver', 'Freecode');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

//    public function create_ledger_sup($post_array, $primary_key) {
//        $this->createled($post_array['name'], $post_array['phone'] . '-' . $post_array['email'], $primary_key, 'sup', $this->sup);
//        return TRUE;
//    }
//    public function create_ledger($post_array, $primary_key) {
//        $this->createled($post_array['name'], $post_array['phone'] . '-' . $post_array['email'], $primary_key, 'cus', $this->cus);
//        return TRUE;
//    }
//created ledger
//    public function createled($name, $code, $primary_key, $ref_code, $acc_main_id) {
//        $data = array(
//            "name" => $name,
//            "code" => $code,
//            "ref_id" => $primary_key,
//            "ref_code" => $ref_code,
//            "is_default" => true,
//            "acc_main_id" => $acc_main_id,
//            "openning_bal" => 0,
//            "published" => 'yes'
//        );
//        $this->ledger->create_ledger($data);
//    }
}

?>
