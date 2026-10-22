<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Material_bill extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('material/materialbill_model', 'item');
        //$this->load->model('Country_model', 'itemc');
    }

    public function updatestatus() {
        $this->item->updatestatus();
    }

    public function listall() {
        $data['title'] = 'Bill of Material';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('material_bill/listall', $data);
    }
    function create($id = '0') {
        $this->load->view('_blocks/subpages/create');
        //$settings = $this->item->getCompanySettings();
        //$states = $this->item->states();
        //$data['states'] = $states;
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['id'] = $id;
        $data['title'] = 'Bill of Materials';
        $data['view'] = "create";
        $this->load->view('material_bill/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
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
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['id'] = $id;
        $data['title'] = 'Bill of Materials';
        $data['view'] = "edit";
        $this->load->view('material_bill/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $unit = $this->item->unit();
        $data['unit'] = $unit;
        $data['id'] = $id;
        $data['title'] = 'Bill of Materials';
        $data['view'] = "view";
        $this->load->view('material_bill/create', $data);
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
            $row[] = $item->itemname;
            $row[] = $item->bmm_quantity;
            //$row[] = $item->;
            $act = '<a  href="' . base_url() . 'material/material_bill/edit/' . $item->bmm_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
              <a  class="btn btn-info "  href="' . base_url() . 'material/material_bill/view/' . $item->bmm_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act. '<a tp="confirm" message="Do you want Delete ' . $item->itemname . '?" success="Delete ' . $item->itemname . ' successfuly "  href="' . base_url() . 'material/material_bill/delete/' . $item->bmm_id . '" base="' . base_url() . 'material/material_bill/listall/' . '"     data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
