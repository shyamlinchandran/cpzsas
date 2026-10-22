<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sliders
 *
 * @author dimind
 */
class Sliders extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('sliders_model', 'slider');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('settings/sliders/list_all');
    }

    function getsing($id) {
        $this->slider->getsing($id);
    }

    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "create";
        $data['settings'] = $this->slider->getCompanySettings();
        $this->load->view('settings/sliders/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "edit";
        $data['settings'] = $this->slider->getCompanySettings();
        $this->load->view('settings/sliders/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "view";
        $data['settings'] = $this->slider->getCompanySettings();
        $this->load->view('settings/sliders/create', $data);
    }

    public function ajax_list() {
        $list = $this->slider->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $slider) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $slider->sli_title;
            $row[] = $slider->sli_description;
            $pic = "<img width='200px' height = '180px' src = '" . base_url() . 'uploads/sliders/' . $slider->sli_image . "'>";
            $row[] = $pic;
            if($slider->published == '1')
            {
                $row[] = 'yes';
            }
            else
            {
                $row[] = 'no';
            }
            $act = '<a   href="' . base_url() . 'settings/sliders/view/' . $slider->sli_id . '"  back="' . site_url("settings/sliders/listall") . '"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'settings/sliders/edit/' . $slider->sli_id . '" back="' . site_url("settings/sliders/listall") . '"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->slider->count_all(),
            "recordsFiltered" => $this->slider->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/sliders/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB
            //$config['max_width'] = '1024';
            //$config['max_height'] = '768';
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
            $this->slider->save($new_name);
        } else {
            $this->slider->save('');
        }
    }

}
