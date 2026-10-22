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
class Outstandreport_model extends DataTable {

   

    function where() {
	

        $this->select = 'sum(tran_debit)-sum(tran_credit) as credit,s.name,phone,b.openning_bal,b.type';
        $this->table = 'acc_ledgers as b left JOIN  acc_ledger_trans as a on a.ledger_id=b.id   inner join suppliers as s on s.id=b.ref_id ';
        $this->column_order = array(null, 's.name'); //set column field database for datatable orderable
        $this->column_search = array('s.name'); //set column field database for datatable searchable 
        $this->order = array('s.name' => 'asc'); // default order 
        $this->wherecondition = " where  ref_code in('sup','cus')";
        if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . ' and ref_id =' . $this->input->post('customer_id') ;
        }
        if ($this->input->post('ledtype')) {
            $this->wherecondition = $this->wherecondition . " and ref_code ='".$this->input->post('ledtype')."'";
        }
        $this->wherecondition = $this->wherecondition ." GROUP by b.id";
    }



}
