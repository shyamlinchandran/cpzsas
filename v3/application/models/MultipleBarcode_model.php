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
class MultipleBarcode_model extends DataTable {

    function where() { 
        $this->select = '*';
        $this->table = 'barcode_batch ';
        $this->column_order = array(null, 'batch_name'); //set column field database for datatable orderable
        $this->column_search = array('batch_name'); //set column field database for datatable searchable 
        $this->order = array('barcode_batch_id' => 'desc'); // default order 
        $this->wherecondition = "  where  published ='yes' ";
    }
    
    

}
