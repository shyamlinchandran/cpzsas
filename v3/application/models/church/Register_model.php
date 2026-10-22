<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Register_model
 *
 * @author dimind
 */
class Register_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select ='count(*) as bapcnt'; 
        $this->table = 'chr_baptism_register ';
        $this->column_order = array(null, 'bapcnt'); //set column field database for datatable orderable
        $this->column_search = array(); //set column field database for datatable searchable 
        //$this->order = array(); // default order 
        $this->wherecondition =" where ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' bap_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and bap_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        $this->db->select($this->select);
    }

    function baptism_cnt() {
    	$where ="";
        if ($this->input->post('startdate')) {
        	
            $where =' where  bap_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $where = $where . ' and bap_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        $qry = "select count(*) as bapcnt from chr_baptism_register ".$where;
        $query = $this->db->query($qry);
        return $query->row()->bapcnt;
    }
    function getbaptised() {
    	$where = $mwhere = $dwhere = "";
        if ($this->input->post('startdate')) {
            $where =' where  bap_date >="' . $this->getDate($this->input->post('startdate')) . '"';
            $dwhere =' where  crr_death_date >="' . $this->getDate($this->input->post('startdate')) . '"';
            $mwhere =' where  wedding_date  >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $where = $where . ' and bap_date <="' . $this->getDate($this->input->post('enddate')) . '"';
            $dwhere = $dwhere . ' and crr_death_date <="' . $this->getDate($this->input->post('enddate')) . '"';
            $mwhere = $mwhere . ' and wedding_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        $qry = "select count(*) as bapcnt from chr_baptism_register ". $where; //Baptitsm total
        $query = $this->db->query($qry);
        $data['baptised'] = $query->row_array();

        $dqry = "select count(*) as dthcnt from chr_cremation_register ". $dwhere; //Death count
        $dquery = $this->db->query($dqry);
        $data['death'] = $dquery->row_array();

        $mqry = "select count(*) as mrgcnt from chr_marriage_register ". $mwhere; //Marriage count
        $mquery = $this->db->query($mqry);
        $data['marriage'] = $mquery->row_array();

        echo json_encode($data);
    }
    function marriage_cnt() {
        $qry = "select count(*) as bapcnt from chr_marriage_register";
        $query = $this->db->query($qry);
        return $query->row()->bapcnt;
    }
    function death_cnt() {
        $qry = "select count(*) as bapcnt from chr_cremation_register";
        $query = $this->db->query($qry);
        return $query->row()->bapcnt;
    }
}