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
class Itemdamagereport_model extends DataTable {

    function where() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'item_damage as a inner join item as b on a.item_id=b.id inner join damage as c on c.damage_id=a.damage_id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name', 'Date'); //set column field database for datatable searchable 
        $this->order = array('Date' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and  c.published ='yes'";
         if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and item_id ="' . $this->input->post('toid') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }

        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
      
    }

   

}
