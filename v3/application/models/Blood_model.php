<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Blood_model
 *
 * @author dimind
 */
class Blood_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select ='a.Id as bid,a.*,b.*'; 
        $this->table = 'donners as a inner join blood as b on a.Bldgrp =b.Id';
        $this->column_order = array(null, 'Name', 'Email', 'Mob', 'Address','Bldgrp'); //set column field database for datatable orderable
        $this->column_search = array('b.Bldgrp'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
}