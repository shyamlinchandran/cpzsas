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
class Quotationreport_model extends DataTable {

    function where() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'quotation as c left join suppliers as b on c.customer_id =b.id';
        $this->column_order = array(null, 'c.invoice','name', 'email', 'b.phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('c.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('c.id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes'";
         if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . ' and c.customer_id ="' . $this->input->post('customer_id') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }

        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
      
    }

   

}
