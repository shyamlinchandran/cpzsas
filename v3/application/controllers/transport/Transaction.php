<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of transaction
 *
 * @author jijodileep
 */
class Transaction extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Trasport_model', 'trasport');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transport/transaction/list_all');
    }

    public function getpurchase($id) {
        $this->trasport->getpurchase($id);
    }

    public function getsales($id) {
        $this->trasport->getsales($id);
    }

    public function getpurchaseitem($id) {
        $this->trasport->getpurchaseitem($id);
    }

    public function getsalesitem($id) {
        $this->trasport->getsalesitem($id);
    }

    public function getpurchaseauto() {
        $search = strtolower($_GET['term']);
        return $this->trasport->getpurchaseauto($search);
    }

    function sales($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        if ($id != 0) {
            $data['pall'] = $this->trasport->getsalesno($id);
        }
        $data['fwdr'] = $this->trasport->tra_forworder();
        $data['line'] = $this->trasport->tra_line();
        $data['pickup'] = $this->trasport->tha_pickup();
        $data['consignee'] = $this->trasport->tra_consignee();
        $data['consigner'] = $this->trasport->tra_consigner();
        $data['delivery'] = $this->trasport->tra_delivery();
        $data['tra_vessal'] = $this->trasport->tra_vessal();
        $data['tra_vehicle'] = $this->trasport->tra_vehicle();
        $data['tra_driver'] = $this->trasport->tra_driver();
        $data['tra_transport'] = $this->trasport->tra_transport();
        $this->load->view('transport/transaction/sales', $data);
    }

    function purchase_create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        if ($id != 0) {
            $data['pall'] = $this->trasport->getpurchaseno($id);
        }
        $data['fwdr'] = $this->trasport->tra_forworder();
        $data['line'] = $this->trasport->tra_line();
        $data['order'] = $this->trasport->getorder();
        $data['pickup'] = $this->trasport->tha_pickup();
        $data['consignee'] = $this->trasport->tra_consignee();
        $data['consigner'] = $this->trasport->tra_consigner();
        $data['delivery'] = $this->trasport->tra_delivery();
        $data['tra_vessal'] = $this->trasport->tra_vessal();
        $data['tra_transport'] = $this->trasport->tra_transport();
        $this->load->view('transport/transaction/purchase_create', $data);
    }

    function charges($id = 0) {
        $this->trasport->charges($id);
    }

    function save() {
        $this->trasport->save();
    }

    function sales_save() {
        $this->trasport->sales_save();
    }

    function tax($id) {
        $this->trasport->tax($id);
    }

    public function ajax_list() {

        // $max = $this->trasport->max();
        // $max_id = $max['max_id'];
        $list = $this->trasport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->container;
            $row[] = $vouchers->sdate;
            $row[] = $vouchers->rdate;
            $row[] = $vouchers->Name;
            $row[] = $vouchers->gtotal;

            $act =   ' <a href="' . base_url() . 'transport/transaction/purchase_create/' . $vouchers->pid . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
//            $act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
//            if ($vouchers->sales_id == $max_id) {
//                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"  success="Delete ' . $vouchers->invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/delete/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
//            } else {
//                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
//            }
//            if ($vouchers->pub != 'yes') {
//                $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
//                        . ' <a href="' . base_url() . 'transaction/sales/view/' . $vouchers->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
//                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
//            }

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trasport->count_all(),
            "recordsFiltered" => $this->trasport->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
