<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of masters
 *
 * @author u43255
 */
class Vehicle_masters extends MY_Controller {

//put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('ledgers_model', 'ledger');
        $this->load->library('excel'); //load PHPExcel library 
        $this->load->model('excel_data_insert_model', 'itemexcel');
    }

    var $sup = 24;
    var $cus = 25;
    var $Sales = 21;
    var $Purchase = 19;
    var $Tax = 10;
    var $ref = 11; //ref id 

    public function vehicle() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('veh_details');
            $crud->set_subject('Vehicle');
            $crud->required_fields('veh_id', 'veh_number', 'veh_type');
            $crud->columns('veh_number', 'veh_type', 'veh_engine', 'veh_regdate', 'veh_expdate');
            $crud->unique_fields('veh_number');
            $crud->display_as('veh_number', 'Vehicle Number');
            $crud->display_as('veh_engine', 'Vehicle Engine');
            $crud->display_as('veh_type', 'Vehicle Type');
            $crud->display_as('veh_regdate', 'Registered Date');
            $crud->display_as('veh_expdate', 'Expiry Date');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vehicle_insurance() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('veh_insurance');
            $crud->set_subject('Vehicle Insurance');
            $crud->required_fields('insurance_company', 'veh_start_date', 'veh_end_date');
            $crud->columns('insurance_company', 'veh_start_date', 'veh_end_date');
            $crud->display_as('veh_start_date', 'Start Date');
            $crud->set_relation('veh_id', 'veh_details', 'veh_number');
            $crud->set_relation('insurance_company', 'veh_insurance_company', 'comp_name');
            $crud->display_as('veh_end_date', 'End Date');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vehicle_insurance_company() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('veh_insurance_company');
            $crud->set_subject('Insurance Company');
            $crud->required_fields('comp_name');
            $crud->columns('comp_name');
            $crud->display_as('comp_name', 'Name');
            $crud->display_as('comp_description', 'Description');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function visa_type() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_visa_type');
            $crud->set_subject('Visa Type');
            $crud->required_fields('type_name', 'type_code');
            $crud->columns('type_name', 'type_code');
            $crud->display_as('type_name', 'Name');
            $crud->display_as('type_code', 'Code');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vehicle_manufacture() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('veh_manufacture');
            $crud->set_subject('Vehicle Manufacture');
            $crud->required_fields('name');
            $crud->columns('name');
            $crud->display_as('name', 'Name');
            $crud->display_as('description', 'Description');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function vehicle_drivers() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('veh_drivers');
            $crud->set_subject('Vehicle Drivers');
            $crud->required_fields('veh_id', 'emp_id', 'daily_Km', 'incentive_km', 'driver_start_date', 'driver_end_date');
            $crud->columns('veh_id', 'emp_id', 'driver_start_date', 'driver_end_date');
            $crud->display_as('veh_id', 'Vehicle');
            $crud->set_relation('veh_id', 'veh_details', 'veh_number');
            $crud->set_relation('emp_id', 'hr_profile', 'pro_fname');
            $crud->display_as('emp_id', 'Employee');
            $crud->display_as('driver_start_date', 'Start Date');
            $crud->display_as('driver_end_date', 'End Date');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function member_category() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('member_category');
            $crud->set_subject('Member Category');
            $crud->required_fields('name', 'rank');
            $crud->columns('name', 'rank');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unique_fields('name', 'rank');
            $crud->unset_columns(array('updatedate'));
            $output = $crud->render();

            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_employees() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_employees');
            $crud->set_subject('Employees');
            $crud->required_fields('employee_id');
            $crud->set_relation('manager_id', 'hr_employees', 'first_name');
            $crud->set_relation('department_id', 'hr_departments', 'department_name');
            $crud->set_relation('job_id', 'hr_jobs', 'job_title');
            $crud->unique_fields('first_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_departments() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_departments');
            $crud->set_subject('Departments Master');
            $crud->required_fields('department_name');
            $crud->set_relation('manager_id', 'hr_employees', 'first_name');
            $crud->set_relation('location_id', 'hr_locations', 'address');
            $crud->display_as('department_name', 'Department');
            $crud->unique_fields('department_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_jobs() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_jobs');
            $crud->set_subject('Jobs Master');
            $crud->required_fields('job_title');
            $crud->display_as('job_title', 'Job Title');
            $crud->unique_fields('job_title');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_regions() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_regions');
            $crud->set_subject('Region Master');
            $crud->required_fields('region_name');
            $crud->display_as('region_name', 'Region');
            $crud->unique_fields('region_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_countries() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_countries');
            $crud->set_subject('Country Master');
            $crud->required_fields('country_name');
            $crud->display_as('country_name', 'Country');
            $crud->set_relation('region_id', 'hr_regions', 'region_name');
            $crud->unique_fields('country_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function hr_locations() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hr_locations');
            $crud->set_subject('Location Master');
            $crud->required_fields('address');
            $crud->display_as('address', 'Location Address');
            $crud->set_relation('country_id', 'hr_countries', 'country_name');
            $crud->unique_fields('address');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function unit_before_delete($primary_key) {
        $this->db->where('unit_id', $primary_key);
        $used = $this->db->get('item')->row();
        if (empty($used)) {
            return "no";
        } else {
            return "yes";
        }
    }

    public function units() {
        try {
            $required = '';
            if ($this->input->post('unit_id')) {
                $required = 'required';
            }
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('units');
            $crud->set_subject(label('Units', $this, $this->user));
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->required_fields('name');
            $crud->unique_fields('code');
            $crud->unique_fields('name');
            $crud->set_rules('unit_count', 'Count', $required);
            $crud->display_as('unit_id', 'Parent');
            $crud->set_rules('unit_count', 'unit_count', 'required|numeric');
            $crud->set_relation('unit_id', 'units', 'name');
            $check = $crud->callback_before_delete(array($this, 'unit_before_delete'));
            if ($check == 'no') {
                $crud->unset_delete();
            }
            $crud->unset_delete();
            $crud->columns('name', 'type_code', 'unit_id', 'unit_count');
            if ($this->multiple == 0) {
                $crud->fields('name', 'code', 'unit_count', 'unit_id');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'code', 'unit_count', 'unit_id');
                }
            }
            $columns = array('name', 'code', 'unit_id', 'unit_count', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->callback_before_update(array($this, "_callback_tag_update"));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function taxes() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('tax');
            $crud->set_subject('Tax');
            $crud->required_fields('name', 'percent');
//$crud->columns('name', 'percent');
            $crud->unique_fields('name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_rules('percent', 'percent', 'required|numeric');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->callback_after_insert(array($this, 'create_ledger_tax'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function gst() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('taxgst');
            $crud->set_rules('GST', 'GST', 'required|numeric');
            $crud->field_type('published', 'hidden', 0);
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unique_fields('GST');
            $settings = $this->ledger->getCompanySettings();
            if ($settings[0]['com_tax_type'] == 'GST') {
                $crud->columns('cgst', 'igst', 'sgst', 'GST');
                $crud->display_as('cgst', 'CGST');
                $crud->display_as('igst', 'IGST');
                $crud->display_as('sgst', 'SGST');
                $crud->display_as('GST', 'GST');
                $crud->set_rules('cgst', 'cgst', 'required|numeric');
                $crud->set_rules('igst', 'igst', 'required|numeric');
                $crud->set_rules('sgst', 'sgst', 'required|numeric');
                $crud->set_subject(label('GST', $this, $this->user));
                $columns = array('cgst', 'igst', 'sgst', 'GST');
            } else {
                $crud->columns('GST');
                $crud->set_subject(label('VAT', $this, $this->user));
                $crud->unset_fields('cgst', 'igst', 'sgst');
                $crud->display_as('GST', 'VAT');
                $columns = array('GST');
            }
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->callback_after_insert(array($this, 'create_ledger_tax'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function cess() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('cess_tbl');
            $crud->set_subject(label('Cess', $this, $this->user));
            $crud->columns('ces_name', 'ces_percent');
            $crud->unique_fields('ces_name');
            $crud->field_type('published', 'hidden', 0);
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_rules('ces_percent', 'required|numeric');
            $crud->callback_after_insert(array($this, 'create_ledger_cess'));
            $columns = array('ces_name', 'ces_percent');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();

            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger_cess($post_array, $primary_key) {

        $percent = $post_array['ces_percent'];
        $settings = $this->ledger->getCompanySettings();
        //$name =  $settings[0]['com_tax_type'] .'-' . $percent;
        $this->createled("Cess " . $percent, $percent, $primary_key, 'Cess', $this->Tax);
        return TRUE;
    }

    public function vat_tax() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('taxgst');
            $crud->set_subject('Tax');
            $crud->columns('GST');
            $crud->unique_fields('GST');
            $crud->field_type('published', 'hidden', 0);
            $crud->unset_columns(array('published', 'updatedate', 'igst', 'sgst', 'cgst'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            //$crud->set_rules('cgst', 'cgst', 'required|numeric');
            //$crud->set_rules('igst', 'igst', 'required|numeric');
            //$crud->set_rules('sgst', 'sgst', 'required|numeric');
            $crud->unset_fields('igst', 'cgst', 'sgst');
            $crud->set_rules('GST', 'GST', 'required|numeric');
            $crud->display_as('GST', 'Tax');
            $crud->callback_after_insert(array($this, 'create_ledger_tax'));
            $output = $crud->render();

            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_hsn($value, $row) {
        if ($row->name_lan == '') {
            return $row->hsncode;
        } else {
            return $row->name_lan;
        }
    }

    public function hsncode() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('hsncode');
            $crud->set_subject(label('HSN Code', $this, $this->user));
            $crud->columns('hsncode');
            $crud->required_fields('hsncode');
            $crud->display_as('hsncode', 'Hsn Code');
            $crud->unique_fields('hsncode');
            $crud->field_type('published', 'hidden', 1);
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $columns = array('hsncode', 'name_lan');
            if ($this->multiple == 0) {
                $crud->fields('hsncode');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan');
                }
            }
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger_tax($post_array, $primary_key) {

        $percent = $post_array['GST'];
        $settings = $this->ledger->getCompanySettings();
        $name = $settings[0]['com_tax_type'] . '-' . $percent;
        $this->createled($name, $percent, $primary_key, 'Tax', $this->Tax);
        $this->createled('Sales-' . $percent, $percent, $primary_key, 'SaleTax', $this->Sales);
        $this->createled('Purchase-' . $percent, $percent, $primary_key, 'PurTax', $this->Purchase);
        return TRUE;
    }

    public function roomtype() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('room_type');
            $crud->set_subject('Room Types');
            $crud->required_fields('name', 'short', 'tax_id');
//$crud->columns('name', 'short','price');
            $crud->display_as('tax_id', 'Tax');
            $crud->set_relation('tax_id', 'tax', 'name');
            $crud->unique_fields('name', 'short');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_rules('price', 'price', 'required|numeric');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function room() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('room');
            $crud->set_subject('Room');
            $crud->required_fields('no', 'short', 'tax_id', 'room_type_id');
//$crud->columns('name', 'short','price');
            $crud->display_as('tax_id', 'Tax');
            $crud->set_relation('tax_id', 'tax', 'name');
            $crud->display_as('room_type_id', 'Room Type');
            $crud->set_relation('room_type_id', 'room_type', 'name');
            $crud->unique_fields('name', 'short');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_rules('price', 'price', 'required|numeric');
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

    public function _callback_address($value, $row) {
        if ($row->address_lan == '') {
            return $row->address;
        } else {
            return $row->address_lan;
        }
    }

    public function reference() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('reference');
            $crud->set_subject(label('Reference', $this, $this->user));
            $crud->required_fields('name', 'address', 'percent_type', 'percent');
            $crud->display_as('percent_type', 'is Percentage');
            $crud->set_rules('percent', 'percent', 'required|numeric');
            $crud->unset_columns(array('updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'create_ledger_ref'));
            $crud->columns('name', 'address', 'percent_type', 'percent', 'details');
            if ($this->multiple == 0) {
                $crud->fields('name', 'address', 'percent_type', 'percent', 'details');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'address_lan', 'percent_type', 'percent', 'details');
                    $crud->callback_column('name_lan', array($this, '_callback_name'));
                    $crud->callback_column('address_lan', array($this, '_callback_address'));
                }
            }
            $columns = array('name', 'address', 'percent_type', 'percent', 'details', 'name_lan', 'address_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function bank() {

        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('bank');
            $crud->set_subject('Bank');
            $crud->required_fields('bank_name', 'bank_ifsc_code', 'bank_acc_no', 'bank_branch');
            $crud->display_as('bank_name', 'Bank');
            $crud->display_as('bank_ifsc_code', 'IFSC CODE');
            $crud->display_as('bank_acc_no', 'Account Number');
            $crud->display_as('bank_branch', 'Branch');
            $crud->unique_fields('bank_ifsc_code', 'bank_acc_no');
            $crud->callback_after_insert(array($this, 'create_ledger_bank'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_ledger_bank($post_array, $primary_key) {
        $data = array(
            "name" => $post_array['bank_name'],
            "code" => $post_array['bank_ifsc_code'],
            "ref_id" => $primary_key,
            "ref_code" => 'Bank',
            "is_default" => true,
            "acc_main_id" => 1,
            "openning_bal" => 0,
            "published" => 'yes'
        );
        $this->ledger->create_ledger($data);
        return TRUE;
    }

    public function create_ledger_ref($post_array, $primary_key) {
        $data = array(
            "name" => $post_array['name'],
            "code" => $post_array['address'],
            "ref_id" => $primary_key,
            "ref_code" => 'ref',
            "is_default" => true,
            "acc_main_id" => $this->ref,
            "openning_bal" => 0,
            "published" => 'yes'
        );
        $this->ledger->create_ledger($data);
        return TRUE;
    }

    public function roomrate() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('room_rate');
            $crud->set_subject('Room Rate');
            $crud->required_fields('room_id', 'member_category_id', 'rate', 'type', 'rank');
            $crud->display_as('room_id', 'Room Categories');
            $crud->display_as('member_category_id', 'Member Category');
            $crud->set_relation('room_id', 'room_categories', 'name');
            $crud->set_relation('member_category_id', 'member_category', 'name');
            $crud->set_rules('rate', 'rate', 'required|numeric');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function company() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('name', 'comkey', 'phone', 'tin', 'address');
            $crud->set_table('company');
            $crud->display_as('tin', 'GSTIN');
            $crud->display_as('comkey', 'Login key');
            $crud->required_fields('name', 'phone', 'company_master', 'email', 'menutype');
            $crud->unique_fields('email', 'phone', 'name');
            //$crud->display_as('company_master', 'Domain');
            $crud->set_subject('Company');
            $crud->set_field_upload('logo', 'assets/uploads/files');
            //$crud->set_field_upload('header', 'assets/uploads/files');
            $crud->unset_fields('header');
            $crud->set_rules('email', 'Email', 'trim|valid_email');
            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->set_relation('company_master', 'company_master', 'grp_name');
            $crud->set_relation('menutype', 'company_subcription', 'subcription_name');
            $crud->field_type('published', 'hidden', 'yes');
            //$crud->field_type('logo', 'hidden', 'yes');
            $crud->field_type('is_multiplegodown', 'hidden', 'yes');
            $crud->field_type('company_master', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $columns = array('name', 'phone', 'company_master', 'email', 'menutype', 'comkey', 'logo', 'address', 'tin', 'details');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            //$crud->callback_after_insert(array($this, 'create_godown'));

            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function company_settings() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject(label('Company Settings', $this, $this->user));
            $crud->columns('com_id', 'comset_state', 'comset_bank', 'address');
            $crud->set_table('company_settings');
            $crud->unset_add();
            $crud->unset_delete();
            $crud->required_fields('com_id' /* ,'comset_statecode', 'comset_account_no', 'comset_ifsccode', 'comset_bank', 'comset_state' */);
            $crud->display_as('Is Background Print', 'Company');
            $crud->display_as('com_id', 'Company');
            $crud->display_as('comset_statecode', 'State Code');
            $crud->display_as('comset_currency', 'Currency');
            $crud->display_as('comset_currrncy_symbol', 'Currency Symbol');
            $crud->display_as('comset_account_no', 'Account Number');
            $crud->display_as('comset_ifsccode', 'IFSC Code');
            $crud->display_as('comset_bank', 'Bank');
            $crud->display_as('comset_declaration', 'Declaration');
            $crud->display_as('is_godown', 'Multiple Godowns');
            $crud->display_as('is_unit', 'Multiple Units');
            $crud->display_as('is_billtype', 'Multiple Billtypes');
            $crud->display_as('is_bankac', 'Bank Account');
            $crud->display_as('is_batch', 'Item Batch');
            $crud->display_as('item_rack', 'Item Rack');
            $crud->display_as('is_taxincluded', 'Tax included?');
            $crud->display_as('is_itemcode', 'Item Code');
            $crud->display_as('is_discription', 'Item Description');
            $crud->display_as('is_ageing', 'Aging enabled');
            $crud->display_as('item_min_rate', 'Item Minimum Rate?');
            $crud->display_as('comset_state', 'State');
            $crud->display_as('com_tax_type', 'Tax Type');
            $crud->display_as('is_production', 'Item Production');
            $crud->display_as('is_analytics', 'Analytics Center?');
            $crud->display_as('is_costcenter', 'Cost Center?');
            $crud->display_as('is_multipletax', 'Multiple tax');
            $crud->set_relation('com_id', 'company', 'name');
            $crud->set_relation('comset_currency', 'currency_tbl', 'crr_name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $columns = array('address', 'com_id', 'comset_statecode', 'comset_currency', 'comset_currrncy_symbol', 'terms_condition', 'comset_account_no', 'comset_ifsccode', 'comset_bank', 'comset_declaration', 'comset_state', 'select_master', 'is_godown', 'item_rack', 'is_unit', 'is_itemcode', 'is_discription', 'is_billtype', 'is_bankac', 'is_batch', 'is_taxincluded', 'item_commission', 'item_min_rate', 'is_ageing', 'com_tax_type', 'is_production', 'is_kitgroup', 'is_kitcustomer', 'is_autobarcode', 'auto_barcode', 'is_analytics', 'is_costcenter', 'is_multipletax', 'item_image', 'item_video', 'item_alternate', 'is_bkground_print', 'is_cess', 'terms_condition');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function company_master() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject('Company Master');
            $crud->columns('grp_name', 'contact_person', 'contact_number', 'address');
            $crud->set_table('company_master');
            $crud->required_fields('grp_name', 'contact_person', 'subcription');
            $crud->unset_columns(array('updatedate'));
            $crud->display_as('grp_name', 'Company Name');
            $crud->display_as('no_sub_company', 'Number Of Companies');
            $crud->display_as('contact_person', 'Contact Person');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->set_relation('subcription', 'company_subcription', 'subcription_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function company_main() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->columns('name', 'comkey', 'phone', 'tin', 'address');
            $crud->set_table('company');
            $crud->display_as('tin', 'GSTIN');
            $crud->display_as('comkey', 'Login key');
            $crud->required_fields('name', 'phone', 'company_master', 'email', 'menutype');
            $crud->unique_fields('email', 'phone', 'name');
            //$crud->display_as('company_master', 'Domain');
            $crud->set_subject('Company');
            //$crud->set_field_upload('logo', 'assets/uploads/files');
            //$crud->set_field_upload('header', 'assets/uploads/files');
            $crud->unset_fields('header');
            $crud->set_rules('email', 'Email', 'trim|valid_email');
            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->set_relation('subcription', 'company_subcription', 'subcription_name');
            $crud->set_relation('version', 'software_version', 'version_name');

            $crud->set_relation('menutype', 'company_subcription', 'subcription_name');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('logo', 'hidden', 'yes');
            $crud->field_type('is_multiplegodown', 'hidden', 'yes');
            $crud->field_type('company_master', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $columns = array('name', 'phone', 'company_master', 'email', 'menutype', 'comkey', 'logo', 'address', 'tin', 'details');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->callback_after_insert(array($this, 'company_ledger'));

            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function _callback_states($value, $row) {
        if ($row->name_lan == '') {
            return $row->StateName;
        } else {
            return $row->name_lan;
        }
    }

    public function states() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_subject(label('States', $this, $this->user));
            $crud->columns('StateName', 'code');
            $crud->set_table('state');
            $crud->required_fields('StateName', 'code');
            $crud->unset_columns(array('ChangeDate'));
            $crud->field_type('CountryID', 'hidden', 1);
            $crud->unique_fields('StateName', 'code');
            if ($this->multiple == 0) {
                $crud->fields('StateName', 'code');
            } else {
                if ($this->language != 'en') {
                    $crud->columns('name_lan', 'code');
                    $crud->callback_column('name_lan', array($this, '_callback_states'));
                }
            }
            $columns = array('StateName', 'code', 'Notes', 'name_lan');
            foreach ($columns as $column) {
                $crud->display_as($column, label($column, $this, $this->user));
            }
            $crud->field_type('ChangeDate', 'hidden', date('Y/m/d h:i:s', time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function roomratesettings() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('room_rate_settings');
            $crud->set_subject('Room Rate Settings');
            $crud->required_fields('nodays', 'member_category_id', 'value', 'type', 'rank');
            $crud->display_as('member_category_id', 'Member Category');
            $crud->set_relation('member_category_id', 'member_category', 'name');
            $crud->set_rules('rate', 'rate', 'required|numeric');
            $crud->set_rules('value', 'value', 'required|numeric');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function supplier() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->where('type', 'sup');
            $crud->set_table('suppliers');
            $crud->set_subject('Suppliers');
            //$crud->required_fields('name', 'phone', 'address_line1');
            $crud->required_fields('name', 'address_line1');
            $crud->columns('name', 'phone', 'tin', 'email', 'address_line1');
            $crud->display_as('tin', 'GSTIN');
            $crud->display_as('cst', 'State');
            $crud->display_as('gst', 'State Code');
            $crud->display_as('details', 'Remarks');
            $crud->unique_fields('name');
            $crud->set_rules('email', 'Email', 'trim|valid_email');
            $crud->set_relation('cst', 'state', 'StateName');
            //$crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('type', 'hidden', 'sup');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'create_ledger_sup'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function customers() {
        try {

            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->where('type', 'cus');
            $crud->set_table('suppliers');
            $crud->set_subject('Customers');
            $crud->required_fields('name', 'phone', 'address_line1');
            $crud->columns('name', 'phone', 'tin', 'email', 'address_line1');
            $crud->unique_fields('email', 'phone');
            $crud->display_as('tin', 'GSTIN');
            $crud->display_as('cst', 'State');
            $crud->display_as('gst', 'State Code');
            $crud->display_as('details', 'Remarks');
            $crud->set_relation('cst', 'state', 'StateName');
            $crud->set_rules('email', 'Email', 'trim|valid_email');
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->set_rules('phone', 'Phone Number', 'required|min_length[10]|max_length[12]|integer');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->field_type('type', 'hidden', 'cus');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->callback_after_insert(array($this, 'create_ledger'));
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function create_godown($post_array, $primary_key) {
        $this->creategodown($post_array['name'], $post_array['phone'], $post_array['address'], $post_array['email'], $primary_key);
        return TRUE;
    }

    public function creategodown($name, $phone, $address, $email, $primary_key) {
        $username = admin;
        $user_password = admin;
        $data1 = array(
            "user_name" => $name,
            "user_phone" => $phone,
            "user_email" => $email,
            "company" => $primary_key,
            "user_address" => $address,
            "username" => $username,
            "user_password" => $user_password,
        );
        $data = array(
            "godown_name" => $name,
            "godown_contactno" => $phone,
            "company" => $primary_key,
            "godown_address" => $address,
        );
        $this->ledger->create_godown($data);
        $this->ledger->create_user($data1);
    }

    public function create_ledger_sup($post_array, $primary_key) {
        $this->createled($post_array['name'], $post_array['phone'] . '-' . $post_array['email'], $primary_key, 'sup', $this->sup);
        return TRUE;
    }

    public function company_ledger($post_array, $primary_key) {
        $this->createled($post_array['name'], $post_array['comkey'], $primary_key, 'com', 25);
        return TRUE;
    }

    public function create_ledger($post_array, $primary_key) {
        $this->createled($post_array['name'], $post_array['phone'] . '-' . $post_array['email'], $primary_key, 'cus', $this->cus);
        return TRUE;
    }

    function _callback_tag_update($post_array, $primary_key) {
        if ($post_array['unit_id'] !== "") {
            $count = $this->ledger->getcount($primary_key, $post_array['unit_id']);
        } else {
            $count = 0;
        }
        if ($count === 0 || $count === '0') {
            return $post_array;
        } else {
            return FALSE;
        }
    }

//created ledger
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

    public function excel() {

        $this->load->view('_blocks/subpages/create');
        $data['page'] = 'masters';
        $data['title'] = 'Customers';
        $data['mymsg'] = '';
        $this->load->view('excelupload', $data);
    }

    public function ExcelDataAdd() {
        //upload file
        $config['upload_path'] = 'uploads/excel';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        //$config['encrypt_name'] = TRUE;
        $config['max_size'] = '1024'; //1 MB
        $this->load->library('upload', $config);
        $this->upload->do_upload('file');
        $upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
        $file_name = $upload_data['file_name']; //uploded file name
        $extension = $upload_data['file_ext'];
        //echo 'File successfully uploaded : uploads/excel' . $_FILES['file']['name'];
        //$objReader =PHPExcel_IOFactory::createReader('Excel5');     //For excel 2003 
        $objReader = PHPExcel_IOFactory::createReader('Excel2007'); // For excel 2007     
        //Set to read only
        $objReader->setReadDataOnly(true);
        //Load excel file
        $objPHPExcel = $objReader->load(FCPATH . 'uploads/excel/' . $file_name);
        $totalrows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();   //Count Numbe of rows avalable in excel         
        $objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
        //loop from first data until last data
        for ($i = 2; $i <= $totalrows; $i++) {
            $name = $objWorksheet->getCellByColumnAndRow(0, $i)->getValue();
            $phone = $objWorksheet->getCellByColumnAndRow(1, $i)->getValue(); //Excel Column 1
            $tin = $objWorksheet->getCellByColumnAndRow(2, $i)->getValue(); //Excel Column 2
            $cst = $objWorksheet->getCellByColumnAndRow(3, $i)->getValue(); //Excel Column 3
            $gst = $objWorksheet->getCellByColumnAndRow(4, $i)->getValue(); //Excel Column 4
            $email = $objWorksheet->getCellByColumnAndRow(5, $i)->getValue(); //Excel Column 5
            $address_line1 = $objWorksheet->getCellByColumnAndRow(6, $i)->getValue(); //Excel Column 6
            $address_line2 = $objWorksheet->getCellByColumnAndRow(7, $i)->getValue(); //Excel Column 7
            $details = $objWorksheet->getCellByColumnAndRow(9, $i)->getValue(); //Excel Column 9
            $credit_period = $objWorksheet->getCellByColumnAndRow(10, $i)->getValue(); //Excel Column 10

            $data_cus = array('name' => $name, 'phone' => $phone, 'tin' => $tin, 'cst' => $cst, 'gst' => $gst, 'email' => $email, 'address_line1' => $address_line1, 'address_line2' => $address_line2, 'details' => $details, 'credit_period' => $credit_period);
            $data_ledger = array('name' => $name, 'code' => $phone, ' ref_id' => 111, 'ref_code' => 'cus', 'is_default' => 1, 'trans_id' => 1, 'acc_main_id' => 1, 'openning_bal' => 0);
            //print_r($data_ledger);

            $this->itemexcel->Add_customer($data_cus);
            /* $insert_id = $this->db->insert_id();
              $data_ledger=array('name'=>$name,'code'=>$code,' ref_id'=>$insert_id,'ref_code'=>'cus','is_default'=>1,'trans_id'=>1,'acc_main_id'=>1,'openning_bal'=>0);
              $this->itemexcel->Add_item_ledger($data_ledger); */
        }
        unlink('././uploads/excel/' . $file_name); //File Deleted After uploading in database .           
        //redirect(base_url() . "dashboard/main");
    }

}
