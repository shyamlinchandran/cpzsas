<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item_model
 *  
 * @author DELL
 */
class Item_model extends DataTable {

    function top_selling() {

        $this->select = 'sum(b.quantity) as cnt,count(*),a.id,a.name,ROUND(AVG(b.mrp),2) as rate';
        $this->table = ' item as a inner join sales_items as b on b.item_id=a.id inner join sales as c on b.sales_id=c.sales_id';
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('cnt' => 'desc'); // default order 
        $this->wherecondition = " where a.published ='yes' and b.published='yes' ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        $this->wherecondition = $this->wherecondition . " GROUP by a.id,a.name";
    }

    function not_selling() {

        $this->select = 'a.id,a.name,MRP as rate';
        $this->table = ' item as a';
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'asc'); // default order 
        $this->wherecondition = " where a.published ='yes' and id not in (select distinct item_id from sales_items) ";
    }

}
