<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 * Church Receipts Controller
 * @author dimind
 */
class Receipt_complete extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/receiptcomplete_model', 'item');
    }
    public function listall() {
        $data['title'] = 'Receipt Status';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = '0';
        $this->load->view('church/receipts/list_completed',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['id'] = $id;
        $data['title'] = 'Receipt-Status create';
        $data['type'] = '';
        $data['view'] = "create";
        
        $this->load->view('church/receipts/create_completed', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['id'] = $id;
        $data['title'] = 'Receipt-Status';
        $data['type'] = '';
        $data['view'] = "edit";
        
        $this->load->view('church/receipts/create_completed', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['id'] = $id;
        $data['title'] = 'Receipt-type';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/receipts/create_completed', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
    }
    public function family_name() {
        $search = strtolower($_GET['term']);
        return $this->item->family_name($search);
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
            //$row[] = $item->rtp_name;
            $row[] = $item->rtp_name;
            $row[] = $item->family;
            $row[] = $item->rec_amount;
            $row[] = $item->paidmoney;
            $act = '<a  href="' . base_url() . 'church/receipt_complete/edit/'.$item->rec_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/receipt_complete/view/' . $item->rec_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'church/receipt_complete/listall'.'"  success="Delete ' . $item->family . ' successfuly "  message="Do you want Delete ' . $item->family . '?"  href="' . base_url() . 'church/receipt_complete/delete/' . $item->rec_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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