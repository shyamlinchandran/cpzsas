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
class Godown_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = '*';
        $this->table = 'ims_godown as c left join(SELECT COUNT(b.godown_id) as count, a.id as aid FROM ims_godown as a left JOIN item_godown as b on a.id=b.godown_id GROUP by a.id) as d on d.aid=c.id';
        $this->column_order = array(null, 'godown_name'); //set column field database for datatable orderable
        $this->column_search = array('godown_name', 'godown_address'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }







   

}
