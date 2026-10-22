<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Order
 *
 * @author dimind
 */
class Order extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Trasportorder_model', 'trasport');
        $this->load->model('Trasport_model', 'tras');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transport/order/list_all');
    }

    function order($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        if ($id != 0) {
            $data['pall'] = $this->trasport->getorder($id);
        }
        $data['fwdr'] = $this->tras->tra_forworder();
        $data['line'] = $this->tras->tra_line();
        $data['consignee'] = $this->tras->tra_consignee();
        $data['consigner'] = $this->tras->tra_consigner();
        $data['transopter'] = $this->tras->tra_transport();
        $data['delivery'] = $this->tras->tra_delivery();
        $data['pickup'] = $this->tras->tha_pickup();
        $this->load->view('transport/transaction/order', $data);
    }

    function ordertwo($id = 0) {
        $this->load->view('_blocks/subpages/create');

        $data['id'] = $id;
        if ($id != 0) {
            $data['pall'] = $this->trasport->getorder($id);
        }
        $data['fwdr'] = $this->tras->tra_forworder();
        $data['line'] = $this->tras->tra_line();
        $data['consignee'] = $this->tras->tra_consignee();
        $data['consigner'] = $this->tras->tra_consigner();
        $data['transopter'] = $this->tras->tra_transport();
        $this->load->view('transport/transaction/ordertwo', $data);
    }

    public function ajax_list() {
        $this->trasport->where();
        $list = $this->trasport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->cone;
            $row[] = $vouchers->con;
            if ($vouchers->ordr_sts == 0) {
                $row[] = 'Pending';
            }
            if ($vouchers->ordr_sts == 1) {
                $row[] = 'Confirmed';
            }
            if ($vouchers->ordr_sts == 2) {
                $row[] = 'Purchased';
            }
            $act = ' <a href="' . base_url() . 'transport/order/order/' . $vouchers->ord_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'transport/order/ordertwo/' . $vouchers->ord_id . '" data-toggle="tooltip" title="Conform" class="btn btn-info "><span class="glyphicon glyphicon-share-alt"></span></a>';
            if ($vouchers->ordr_sts == 0) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . 'transport/order/listall" message="Do you want Delete ' . $vouchers->cone . ' ?" success="Delete  ' . $vouchers->cone . ' successfuly " href="' . base_url() . 'transport/order/orderdel/' . $vouchers->ord_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            }
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

    function orderdel($id) {
        $this->trasport->order_del($id);
    }

    function order_save() {
        $this->trasport->order_save();
    }

    function order_savetwo() {
        $this->trasport->order_savetwo();
    }

    function getcont($id) {
        $this->trasport->getcont($id);
    }

}
