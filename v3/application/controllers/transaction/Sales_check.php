<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of analyt2
 *
 * @author dimind
 */
class Sales_check extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('salescheck_model', 'salesc');
    }

    function check_items($id) {
        return $this->salesc->check_items($id);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        //$data['sales_items']= $this->sales->check_items($id);
        $data['title'] = 'Sales Items';
        $data['view'] = 'edit';
        $this->load->view('transaction/sales/sales_check', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Sales Items';
        $data['view'] = 'view';
        $this->load->view('transaction/sales/sales_check', $data);
    }

    function save() {
        $this->salesc->save();
    }

}
