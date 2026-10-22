<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanySubscription
 *
 * @author admin
 */
class CompanySubscription extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Companysubscription_model', 'companysubscription');
    }

    public function Subcription() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('company_subcription');
            $crud->set_subject('Company Subcription');


            //////////////////////Textbox hide when value=1///////////////////////////////////
            $isbatch = $this->getKey('isbatch');
            if ($isbatch != 0) {

                $crud->field_type('created_by', 'hidden', '0');
                $crud->field_type('end_date', 'hidden', '0');

                $crud->required_fields('subcription_name', 'subcription_version');
            } else {
                $crud->columns('subcription_name', 'subcription_version', 'details');
                $crud->required_fields('subcription_name', 'subcription_version');
            }
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('updatedate'));
            $crud->unset_back_to_list();
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function listall() {
        $data['isbatch'] = $this->getKey('isbatch');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companysubscription/list_all', $data);
    }

    public function package() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('package');
            $crud->set_subject('Company Package');
            $crud->columns('package','periods', 'start_day');
            $crud->field_type('published', 'hidden', 'yes');
            $crud->unset_columns(array('published'));
            $crud->required_fields('periods', 'start_day','package');
            $crud->display_as('start_day', 'Starting Day');
            $crud->display_as('periods', 'Period In Months');
            $crud->display_as('package', 'Package Name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function batch() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('company_subcription');
            $crud->set_subject('Company Subcription');
            $crud->columns('subcription_name', 'subcription_version', 'details');
            $crud->unique_fields('subcription_name', 'subcription_version');
            $crud->field_type('updatedate', 'hidden', date('Y/m/d h:i:s', time()));
            $crud->unset_columns(array('published', 'updatedate'));
            $crud->required_fields('subcription_name', 'subcription_version', 'details');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companysubscription/list_all');
    }

    function create() {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['view'] = 'create';
        $this->load->view('settings/companysubscription/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('settings/companysubscription/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('settings/companysubscription/create', $data);
    }

    public function ajax_list() {
        $this->companysubscription->where();
        $list = $this->companysubscription->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $companysubscription) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $companysubscription->subcription_name;
            $row[] = '<a   back="' . base_url() . 'settings/CompanySubscription/listall" href="' . base_url() . 'settings/CompanySubscription/Subcription/read/' . $companysubscription->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'settings/CompanySubscription/listall"  href="' . base_url() . 'settings/CompanySubscription/Subcription/edit/' . $companysubscription->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->companysubscription->count_all(),
            "recordsFiltered" => $this->companysubscription->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->companysubscription->save();
    }

}
