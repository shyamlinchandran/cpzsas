<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajaxcall
 *
 * @author u43255
 */
class Ajaxcall extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('json/ajax_model', 'ajax');
    }

    public function getpurchaseitems($type = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->getpurchaseitems($search, $type);
    }

    function itemgroup() {
        return $this->ajax->itemgroup();
    }

    function customer($id) {
        return $this->ajax->customer($id);
    }
      public function gettaxledger($sal_tax_id) {
        return $this->ajax->gettaxledger($sal_tax_id);
    }

    function Patientbyid($id) {
        return $this->ajax->Patientbyid($id);
    }

    function tyr_customer($id) {
        return $this->ajax->tyr_customer($id);
    }

    public function estimates($type = 0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->estimates($search, $type);
    }

    public function category() {
        $search = strtolower($_GET['term']);
        return $this->ajax->category($search);
    }

    public function quotation_items($id) {
        return $this->ajax->quotation_items($id);
    }

    public function service_items($id) {
        return $this->ajax->service_items($id);
    }

    public function pur_service_items($id) {
        return $this->ajax->pur_service_items($id);
    }

    public function sales_items($id) {
        return $this->ajax->sales_items($id);
    }

    public function cli_salesitems($id) {
        return $this->ajax->cli_salesitems($id);
    }

    public function cli_diagonise($id) {
        return $this->ajax->cli_diagonise($id);
    }

    public function cli_observation($id) {
        return $this->ajax->cli_observation($id);
    }

    public function tyrsales_items($id) {
        return $this->ajax->tyrsales_items($id);
    }

    public function purchase($id) {
        return $this->ajax->purchase($id);
    }

    public function suppliers($type = '') {
        $search = strtolower($_GET['term']);
        return $this->ajax->suppliers($search, $type);
    }

    public function hsn() {
        $search = strtolower($_GET['term']);
        return $this->ajax->hsn($search);
    }

    public function Observation() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Observation($search);
    }

    public function Diagonise() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Diagonise($search);
    }

    public function Patient() {
        $search = strtolower($_GET['term']);
        return $this->ajax->Patient($search);
    }

    public function members() {
        $search = strtolower($_GET['term']);
        return $this->ajax->members($search);
    }

    public function ledgers() {
        $search = strtolower($_GET['term']);
        return $this->ajax->ledgers($search);
    }

    public function items($check=0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->items($search);
    }

    public function mainledger() {
        $search = strtolower($_GET['term']);
        return $this->ajax->mainledger($search);
    }

    public function itemssearch($check=0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->itemssearch($search, $check);
    }

    public function pestimates($type = 0) {
        $search = strtolower($_GET['term']);
        return $this->ajax->pestimates($search, $type);
    }

    public function states() {
        return $this->ajax->states();
    }

    public function godownstock($search) {
        return $this->ajax->godownstock($search);
    }

    public function get_saleskey($type) {
        return $this->ajax->get_saleskey($type);
    }

    public function units($search) {
        return $this->ajax->units($search);
    }

    public function cliunits($search) {
        return $this->ajax->cliunits($search);
    }

    public function tax() {
        return $this->ajax->tax();
    }

    public function godown() {
        return $this->ajax->godown();
    }

    public function godownjson() {
        return $this->ajax->godownjson();
    }

    public function billtype($type) {
        return $this->ajax->billtype($type);
    }

    public function billtypes($type) {
        return $this->ajax->billtypes($type);
    }

    public function Doctor() {
        return $this->ajax->Doctor();
    }

    public function Intervel() {
        return $this->ajax->Intervel();
    }

    public function Cat() {
        return $this->ajax->Cat();
    }

    public function analyticscenter() {
        return $this->ajax->analyticscenter();
    }

    public function costcenter() {
        return $this->ajax->costcenter();
    }

    public function Procedure() {
        return $this->ajax->Procedure();
    }

    public function Schedule($id, $date) {
        return $this->ajax->Schedule($id, $date);
    }

    public function salesman() {
        return $this->ajax->salesman();
    }

    public function potency() {
        return $this->ajax->potency();
    }

    public function area() {
        return $this->ajax->area();
    }

    public function printtype($type) {
        return $this->ajax->printtype($type);
    }

    public function route() {
        return $this->ajax->route();
    }

    public function messagetype($id) {
        return $this->ajax->messagetype($id);
    }

    public function emailtype($id) {
        return $this->ajax->emailtype($id);
    }

    public function reference() {
        return $this->ajax->reference();
    }

    public function vehicle() {
        return $this->ajax->vehicle();
    }

    public function room_category() {
        return $this->ajax->room_category();
    }

    public function member_category() {
        return $this->ajax->member_category();
    }

    public function room() {
        $type = $_GET['type'];
        return $this->ajax->room($type);
    }

}
