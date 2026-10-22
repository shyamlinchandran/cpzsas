<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxcall
 *
 * @author Dimind
 */
class Common_call extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('kaasma/common_model', 'cmodel');
    }

    public function getpurchaseitems($type = '') {
        $search = strtolower($_GET['term']);
        return $this->cmodel->getpurchaseitems($search, $type);
    }

    function getdistricts() {
        return $this->cmodel->getdistricts();
    }
    function getusers() {
        return $this->cmodel->getusers();
    }
    function getcusttype() {
        return $this->cmodel->getcusttype();
    }
    function getcontactp() {
        return $this->cmodel->getcontactp();
    }
    function getslabs() {
        return $this->cmodel->getslabs();
    }
}
