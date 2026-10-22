<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemreg_model
 *
 * @author jijodileep
 */
//require_once('dataTable.php');

class Itemdetails_model extends DataTable {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->select = 'barcode,i.name as item,h.hsncode as hsn,case when open_stk_rate =0 then open_stk_rate else open_stk_rate end as open_stk_rate,g.open_stock,u.name as unit,o.godown_name as godown,(g.item_qty+g.current_stock) as quantity,i.srate as salerate,i.MRP';
        $this->table = '(select prate,id,name,barcode,hsncode,open_stk_rate,srate,Mrp,unit_id from item as a ) as i LEFT JOIN hsncode as h on i.hsncode=h.hsnid LEFT JOIN  units as u on i.unit_id=u.id INNER JOIN (select item_qty, id,item_id,godown_id,open_stock,current_stock,batch from item_godown where open_stock > 0  ) as g on i.id=g.item_id LEFT JOIN ims_godown as o on g.godown_id=o.id';
        $this->column_order = array(null, 'i.name', 'h.hsncode', 'o.godown_name'); //set column field database for datatable orderable
        $this->column_search = array('i.name', 'h.hsncode', 'o.godown_name'); //set column field database for datatable searchable 
        $this->order = array('i.id' => 'asc'); // default order 
    }
       function where() {
        $this->wherecondition = "where a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and  trans_date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and  trans_date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  item_id  =' . $this->input->post('toid');
        }
    }

}
