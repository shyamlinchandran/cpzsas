<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* * m
 * Description of CompanyMaster
 *
 * @author admin
 */

class CompanyMaster extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CompanyMaster_model', 'companymaster');
    }

    public function listall() {
        $data['isbatch'] = $this->getKey('isbatch');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companymaster/list_all', $data);
    }

    public function batch() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('company_master');
            $crud->set_subject('company master');
            $crud->unique_fields('grp_name');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('updatedate'));
            $crud->columns('grp_name', 'no_sub_company', 'no_sub_company', 'contact_person');
            $crud->display_as('grp_name', 'Group Name');
            $crud->required_fields('no_sub_company', 'grp_name', 'contact_person', 'contact_number', 'created_by', 'end_date');
            $crud->set_relation('subcription', 'company_subcription', 'subcription_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/companymaster/list_all');
    }

    

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('settings/companymaster/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('settings/companymaster/create', $data);
    }

    public function ajax_list() {
        $this->companymaster->where();
        $list = $this->companymaster->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $companymaster) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $companymaster->grp_name;
            $row[] = $companymaster->no_sub_company;
            $row[] = $companymaster->contact_person;
            $row[] = $companymaster->contact_number;
            $row[] = '<a   back="' . base_url() . 'settings/companymaster/list_all" href="' . base_url() . 'Cmaster/master/read/' . $companymaster->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'settings/companymaster/list_all"  href="' . base_url() . 'Cmaster/master/edit/' . $companymaster->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->companymaster->count_all(),
            "recordsFiltered" => $this->companymaster->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->companymaster->save();
    }

}
