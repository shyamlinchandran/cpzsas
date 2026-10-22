<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Coupons
 *
 * @author dimind
 */
class Coupons extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coupons_model', 'coupon');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/coupons/list_all');
    }

    function getsing($id) {
        $this->coupon->getsing($id);
    }

    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "create";
        $data['settings'] = $this->coupon->getCompanySettings();
        $this->load->view('master/coupons/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "edit";
        $data['settings'] = $this->coupon->getCompanySettings();
        $this->load->view('master/coupons/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = "view";
        $data['settings'] = $this->coupon->getCompanySettings();
        $this->load->view('master/coupons/create', $data);
    }

    public function ajax_list() {
        $list = $this->coupon->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $coupon) {
            $no++;
            $row = array();
            $row[] = $no;
                                /*cou_id  cou_code    cou_image   date_from   date_to cou_discountp   cou_discount    created_by  created_date    published   updatedate  name_lan*/
            $row[] = $coupon->cou_code;            
            $pic = "<img width='200px' height = '180px' src = '" . base_url() . 'uploads/coupons/' . $coupon->cou_image . "'>";
            $row[] = $pic;
            $row[] = $coupon->cou_discount;
            $row[] = $coupon->cou_discountp;
            if($coupon->published == '1')
            {
                $row[] = 'yes';
            }
            else
            {
                $row[] = 'no';
            }
            $act = '<a   href="' . base_url() . 'master/coupons/view/' . $coupon->cou_id . '"  back="' . site_url("master/coupons/listall") . '"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'master/coupons/edit/' . $coupon->cou_id . '" back="' . site_url("master/coupons/listall") . '"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'master/coupons/listall/' . '"  success="Delete ' . $coupon->cou_code . ' successfuly "  message="Do you want Delete ' . $coupon->cou_code . '?"  href="' . base_url() . 'master/coupons/delete/' . $coupon->cou_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->coupon->count_all(),
            "recordsFiltered" => $this->coupon->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/coupons/';
            $config['allowed_types'] = 'jpg|png';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB
            $config['max_width'] = '1024';
            $config['max_height'] = '768';
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
            $this->coupon->save($new_name);
        } else {
            $this->coupon->save('');
        }
    }

     public function delete($id) {
        $this->coupon->delete($id);
    }

}
