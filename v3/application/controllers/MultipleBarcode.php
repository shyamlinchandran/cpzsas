<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class MultipleBarcode extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('MultipleBarcode_model', 'barcode');
    }

    function list_all() {
        $data['title'] = 'Multiple barcode Batch';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('multiplebarcode/listall', $data);
    }

    function delete($id) {
        $qry = "delete from barcode_batch where barcode_batch_id=" . $id;
        $this->db->query($qry);
        $qry = "delete from barcode_batch_items where batch_id=" . $id;
        $this->db->query($qry);
    }

    public function ajax_list() {
        $this->barcode->where();
        $list = $this->barcode->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->batch_name;
            $act = ' <a tp="pdf" href="' . base_url() . 'item/print_item_barcode/' . $vouchers->barcode_batch_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a><a href="' . base_url() . 'item/barcode_print/' . $vouchers->barcode_batch_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
//            $act = $act + '<a tp="pdf" href="' . base_url() . 'item/print_item_barcode/' . $vouchers->barcode_batch_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/MultipleBarcode/list_all/' . $vouchers->barcode_batch_id . '"  success="Delete ' . $vouchers->batch_name . ' successfuly "  message="Do you want Delete ' . $vouchers->batch_name . '?"  href="' . base_url() . 'MultipleBarcode/delete/' . $vouchers->barcode_batch_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->barcode->count_all() + 1,
            "recordsFiltered" => $this->barcode->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
