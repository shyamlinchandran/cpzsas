<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class Package_model extends DataTable {
	
	function Package_sales(){
		$this->table = "`feestructure` as a INNER JOIN item as b on a.course = b.id INNER JOIN crm_student as c on c.id = a.stud_id ";
		$this->select = " payment_method,b.name as package,c.name as student,DATE_FORMAT(fee_start_date,'%d/%m/%Y') as fee_start_date,DATE_FORMAT(fee_end_date,'%d/%m/%Y') as fee_end_date,no_of_classes,attended_classes,no_of_classes - attended_classes as balance,discountedfee";
		$this->column_order = array('b.name','c.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name','c.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'desc'); // default order 
		
	}
	
	 

}
