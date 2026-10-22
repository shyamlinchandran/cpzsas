<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 * Church Receipts Controller
 * @author dimind
 */
class Receipt_generate extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/receiptgen_model', 'item');
    }
    public function listall() {
        $data['title'] = 'Receipt Generate';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = '0';
        $this->load->view('church/receipts/list_generated',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['id'] = $id;
        $data['title'] = 'Receipt-generate create';
        $data['type'] = '';
        $data['view'] = "create";
        
        $this->load->view('church/receipts/create_generated', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['id'] = $id;
        $data['title'] = 'Receipt-generate Edit';
        $data['type'] = '';
        $data['view'] = "edit";
        
        $this->load->view('church/receipts/create_generated', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $receipt_type = $this->item->getreceiptype();
        $data['receipt_type'] = $receipt_type;
        $data['title'] = 'Receipt-generate View';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/receipts/create_generated', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
    }
     public function getreceipt_type($id) {
        return $this->item->getreceipt_type($id);
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
            $row[] = $item->mnth;
            $row[] = $item->rtp_name;
            $row[] = $item->reg_createdon;
            $row[] = $item->reg_amount;
            $act = '<a  href="' . base_url() . 'church/receipt_generate/edit/'.$item->reg_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/receipt_generate/view/' . $item->reg_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/receipt_generate/listall'.'"  success="Delete ' . $item->rtp_name . ' successfuly "  message="Do you want Delete ' . $item->rtp_name . '?"  href="' . base_url() . 'church/receipt_generate/delete/' . $item->reg_id. '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
