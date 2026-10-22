<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Material_product extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('material/materialproduct_model', 'item');
       }

    public function updatestatus() {
        $this->item->updatestatus();
    }

    public function listall() {
        $data['title'] = 'Finished Goods';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('material_product/listall', $data);
    }
    function create($id = '0') {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $gwn = $this->item->godown($godown);
        $re = $this->item->userlist();
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['user'] = $re;
        $data['id'] = $id;
        $data['godown'] = $gwn;
        $data['title'] = 'Finished Goods';
        $data['view'] = "create";
        $this->load->view('material_product/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }
     function getproductsing($id) {
        $this->item->getproductsing($id);
    }
    public function mainitem() {
        $search = strtolower($_GET['term']);
        return $this->item->mainitem($search);
    }

    public function subitems() {
        $search = strtolower($_GET['term']);
        return $this->item->subitems($search);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $gwn = $this->item->godown($godown);
        $re = $this->item->userlist();
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['user'] = $re;
        $data['id'] = $id;
        $data['godown'] = $gwn;
        $data['title'] = 'Finished Goods';
        $data['view'] = "edit";
        $this->load->view('material_product/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $godown = 1;
        $gwn = $this->item->godown($godown);
        $re = $this->item->userlist();
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['user'] = $re;
        $data['id'] = $id;
        $data['godown'] = $gwn;        $data['title'] = 'Finished Goods';
        $data['view'] = "view";
        $this->load->view('material_product/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function ajax_list() {
        //$this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->created_on;
            $row[] = $item->username;
            $row[] = $item->godown;
            //$row[] = $item->;
            $act = '<a  href="' . base_url() . 'material/material_product/edit/' . $item->fgm_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
              <a  class="btn btn-info "  href="' . base_url() . 'material/material_product/view/' . $item->fgm_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act. '<a tp="confirm" message="Do you want Delete product by ' . $item->username . '?" success="Delete ' . $item->username . ' successfuly "  href="' . base_url() . 'material/material_product/delete/' . $item->fgm_id . '" base="' . base_url() . 'material/material_product/listall/' . '"     data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->item->save();
    }

}
