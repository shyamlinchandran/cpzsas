<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SoftwareVersion
 *
 * @author admin
 */
class SoftwareVersion extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('SoftwareVersion_model', 'SoftwareVersion');
    }

    public function Version() {
        try {
            $type = 3;
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('software_version');
            $crud->set_subject('Software Version');


            //////////////////////Textbox hide when value=1///////////////////////////////////
            $isbatch = $this->getKey('isbatch');
            if ($isbatch != 0) {



                $crud->required_fields('version_name', 'folder_path', 'db_path');
            } else {
                $crud->columns('version_name', 'folder_path', 'db_path');
                $crud->required_fields('version_name', 'folder_path', 'db_path');
            }
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->field_type('created_by', 'hidden',0);
            $crud->unset_columns(array('updatedate','created_by'));
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
        $this->load->view('settings/SoftwareVersion/list_all', $data);
    }

    public function batch() {
        try {
            $crud = new grocery_CRUD();
            $crud->set_theme('datatables');
            $crud->set_table('software_version');
            $crud->set_subject('Software Version');
            $crud->columns('version_name', 'folder_path', 'db_path');
            $crud->field_type('updatedate', 'hidden',date('Y/m/d h:i:s',time()));
            $crud->unset_columns(array('published','updatedate'));

            $crud->required_fields('version_name', 'folder_path', 'contact_person', 'created_by', 'end_date');
            $crud->unique_fields('version_name');
            $output = $crud->render();
            $this->load->view('masters/masters', $output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    public function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/SoftwareVersion/list_all');
    }

    function create() {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['view'] = 'create';
        $this->load->view('settings/SoftwareVersion/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('settings/SoftwareVersion/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('settings/SoftwareVersion/create', $data);
    }

    public function ajax_list() {
        $this->SoftwareVersion->where();
        $list = $this->SoftwareVersion->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $SoftwareVersion) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $SoftwareVersion->version_name;
            $row[] = $SoftwareVersion->folder_path;
            $row[] = $SoftwareVersion->db_path;
            $row[] = $SoftwareVersion->created_date;
            $row[] = $SoftwareVersion->created_by;
            $row[] = '<a   back="' . base_url() . 'settings/SoftwareVersion/listall" href="' . base_url() . 'settings/SoftwareVersion/Version/read/' . $SoftwareVersion->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'settings/SoftwareVersion/listall"  href="' . base_url() . 'settings/SoftwareVersion/Version/edit/' . $SoftwareVersion->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->SoftwareVersion->count_all(),
            "recordsFiltered" => $this->SoftwareVersion->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->SoftwareVersion->save();
    }

}
