<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyGodown_model
 *
 * @author dimind
 */
class CompanyGodown_model extends DataTable {
    public function __construct() {
        parent::__construct();
        $this->table = 'company  as a inner join godown as b on a.com_id =b.company';
        $this->column_order = array(null, 'godown_name', 'godown_address','godown_contact_person','godown_contactno', 'company'); //set column field database for datatable orderable
        $this->column_search = array('godown_name', 'godown_contact_person', 'company'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
        $this->select = 'a.name,b.*';
    }
	 function where() {
        
    }
}