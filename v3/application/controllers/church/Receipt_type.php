<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 * Church Receipts Controller
 * @author dimind
 */
class Receipt_type extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/receipttype_model', 'item');
    }
    public function listall() {
        $data['title'] = 'Receipt types';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = '0';
        $this->load->view('church/receipts/list_all',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'Receipt-type create';
        $data['type'] = '';
        $data['view'] = "create";
        
        $this->load->view('church/receipts/create', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Receipt-type';
        $data['type'] = '';
        $data['view'] = "edit";
        
        $this->load->view('church/receipts/create', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Receipt-type';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/receipts/create', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
    }
    public function ajax_list() {
        //$this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->rtp_name;
            $row[] = $item->allfamily;
            $act = '<a  href="' . base_url() . 'church/receipt_type/edit/'.$item->rtp_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/receipt_type/view/' . $item->rtp_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/receipt_type/listall'.'"  success="Delete ' . $item->rtp_name . ' successfuly "  message="Do you want Delete ' . $item->rtp_name . '?"  href="' . base_url() . 'church/receipt_type/delete/' . $item->rtp_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
