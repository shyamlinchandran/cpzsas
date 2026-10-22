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
class SalesOrderMerge_model extends DataTable {

   

    function where() {

        $this->select = ' c.name,sum(b.quantity-b.estimate_quantity) as balance,sum(b.quantity) as total ';
        $this->table = ' item as c left join sales_items as b on c.id=b.item_id INNER JOIN sales as a on a.sales_id=b.sales_id';
        $this->column_order = array(null, 'c.name'); //set column field database for datatable orderable
        $this->column_search = array('c.name'); //set column field database for datatable searchable 
        $this->order = array('c.name' => 'asc'); // default order 
        $this->wherecondition = " where a.type='estimate' and b.published='yes' group by b.item_id";
       
    }



}
