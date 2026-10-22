<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Itemstock_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.id,a.created_date,a.total_quantity,b.name';
        $this->table = 'prd_stock as a inner join item as b on a.product_id =b.id';
        $this->column_order = array(null, 'created_date', 'name'); //set column field database for datatable orderable
        $this->column_search = array('b.name', 'a.created_date'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }







   

}
