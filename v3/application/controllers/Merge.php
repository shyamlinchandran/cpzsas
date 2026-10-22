<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of customermerge
 *
 * @author DELL
 */
class Merge extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Merge_model', 'item');
    }

    public function Customer() {
        $this->item->merge();
    }

    public function Product() {
        $this->item->product_merge();
    }

    public function Ledger() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = '';
        $this->load->view('merge/ledger', $data);
    }
    
     public function product_Ledger() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = '';
        $this->load->view('merge/product_Ledger', $data);
    }

    public function ledgermerge() {
        $this->item->mergeledger();
    }

}
