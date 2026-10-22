<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Com_info
 *
 * @author dimind
 */
class Com_info extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('company/cominfo_model', 'company');
    }

    public function listall() {
        $data['settings'] = $this->company->getCompanySettings();
        $this->load->view('_blocks/subpages/list');
        $this->load->view('company/list_all', $data);
    }
	
	public function listall_company() {
        $data['settings'] = $this->company->getCompanySettings();
        $this->load->view('_blocks/subpages/list');
        $this->load->view('company/list_company', $data);
    }
	
	public function company_list() {
        //$this->items->where();
        $list = $this->company->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $company) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $company->name;
            $row[] = $company->comkey;
            $row[] = $company->phone;
            $row[] = $company->created_date;
            $row[] = $company->end_date;
            $act = '<button type="button"    data-toggle="tooltip" comid = "'.$company->com_id.'" comkey = "'.$company->comkey.'" onclick="load_sms_modal(this)" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->company->count_all(),
            "recordsFiltered" => $this->company->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function getsing($id) {
        $this->company->getsing($id);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "edit";
        $data['settings'] = $this->company->getCompanySettings();
        $this->load->view('company/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "view";
        $data['settings'] = $this->company->getCompanySettings();
        $this->load->view('company/create', $data);
    }

    public function ajax_list() {
        //$this->items->where();
        $list = $this->company->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $company) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $company->name;
            $row[] = $company->comkey;
            $pic = "<img width='200px' height = '180px' src = '" . base_url() . 'uploads/company/' . $company->logo . "'>";
            $row[] = $pic;
            $row[] = $company->phone;
            $row[] = $company->address;
            $act = '<a   href="' . base_url() . 'company/com_info/view/' . $company->com_id . '"  back="' . site_url("company/com_info/listall") . '"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'company/com_info/edit/' . $company->com_id . '" back="' . site_url("company/com_info/listall") . '"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->company->count_all(),
            "recordsFiltered" => $this->company->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/company/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB
            $new_name = time() . $_FILES["file"]['name'];
            $config['file_name'] = $new_name; 
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            }
            $this->company->save($new_name);
        } else {
            $this->company->save('');
        }
    }

}
