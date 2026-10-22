<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_expiry_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Item_expiry_report_model', 'expiry_model');
    }

    public function index() {
        $data['title'] = 'Item Expiry Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/item_expiry/item_expiry_report', $data);
    }

    public function ajax_list() {
        $this->expiry_model->where();
        $list = $this->expiry_model->get_datatables();
        $data = array();
        $no = $this->input->post('start');

        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->itemname;
            $row[] = $item->barcode;
            $row[] = $item->batch;

            $exp_date = $item->expiry_date;
            if ($exp_date && $exp_date != '0000-00-00') {
                $row[] = date('d-m-Y', strtotime($exp_date));
            } else {
                $row[] = '-';
            }

            $rem_days = (int)$item->remaining_days;
            if ($rem_days < 0) {
                $row[] = '<span class="label label-danger">' . abs($rem_days) . ' days ago (Expired)</span>';
            } else if ($rem_days == 0) {
                $row[] = '<span class="label label-warning">Expires Today</span>';
            } else if ($rem_days <= 7) {
                $row[] = '<span class="label label-warning">' . $rem_days . ' days remaining</span>';
            } else if ($rem_days <= 14) {
                $row[] = '<span class="label label-info">' . $rem_days . ' days remaining</span>';
            } else {
                $row[] = '<span class="label label-success">' . $rem_days . ' days remaining</span>';
            }

            $row[] = $item->godown_name;
            $row[] = $item->current_stock;

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->expiry_model->count_all(),
            "recordsFiltered" => $this->expiry_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
