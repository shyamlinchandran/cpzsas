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
class Totinvereport_model extends DataTable {

    function getType() {
        $qry = 'select * from item';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function purchase() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'purchase as a left join set_billtype as b on a.bill_type=b.id left join suppliers as s on a.supplier_id=s.id';
        $this->column_order = array(null, 'invoice', 'name', 'date'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'name', 'date'); //set column field database for datatable searchable 
        $this->select = 'a.id as pid,a.type as ptype,a.total,b.type as btype,a.date,invoice,s.name';
        $this->order = array('a.id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and a.type='purchase'";

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        //   if ($this->input->post('toid')) {
        //     $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');
        // }      

        if ($this->input->post('supid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.id  =' . $this->input->post('supid');
        }

        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

    function getgst($tid, $id) {

        $qry = 'select sum(total) as tot,sum(tax) as tax from sales_items where published="yes" and tax_id=' . $tid . " and sales_id='" . $id . "'";

        $query = $this->db->query($qry)->row_array();
        return $query['tax'];
    }

    function sales() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales as a left join suppliers as s on a.customer_id=s.id left join set_billtype as c on c.id=a.bill_type';
        $this->column_order = array(null, 'a.invoice', 'a.cusname', 'invoice_date'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'a.cusname', 'invoice_date'); //set column field database for datatable searchable 
        $this->select = 'a.cash_type,a.type as stype,a.sales_id as sid,invoice_date,invoice,a.cusname as name,c.type as btype,a.total';
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and a.type='sales'";
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and a.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        //   if ($this->input->post('toid')) {
        //     $this->wherecondition = $this->wherecondition . ' and  i.id  =' . $this->input->post('toid');
        // }
        if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.id  =' . $this->input->post('cusid');
        }
        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

}
