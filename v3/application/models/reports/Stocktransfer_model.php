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
class Stocktransfer_model extends DataTable {

    function where() {

        $this->select = ' f.godown_name as frmgdn,t.godown_name as togdn,a.date,qty,c.name as item ';
        $this->table = 'item_transfer as a inner join item_transfer_sub as b on a.id=b.transfer_id LEFT JOIN ims_godown as f on f.id=a.from_id LEFT JOIN ims_godown as t on t.id=b.to_id INNER JOIN item as c on c.id=b.item_id ';
        $this->column_order = array(null, 'item', 'f.godown_name'); //set column field database for datatable orderable
        $this->column_search = array('item', 'f.godown_name'); //set column field database for datatable searchable 
        $this->order = array('c.id' => 'desc'); // default order 

        $this->wherecondition = " where b.published ='yes'";
         if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and c.id ="' . $this->input->post('toid') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }

        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
      
    }

   

}
