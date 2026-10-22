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
class Pos_model extends DataTable {
    function where() {
        $this->select = ' IFNULL(u.user_name,"") as user,a.name as counter,b.invoice,b.invoice_date,b.cash_amount,b.bank_amount,b.total,b.cusname';
        $this->table = "`counter` as a INNER join sales as b on a.bill_type=b.bill_type and b.published='yes' left join users as u on u.Id=b.created_by ";
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('b.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where b.published ='yes' and b.type='sales'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and b.bill_type ="' . $this->input->post('type') . '"';
        }

    }

	function  getdayreport(){
		$this->select = ' b.name,a.*,sum(c.total) as total,sum(c.cash_amount) as cash,sum(c.bank_amount) as bank,u.user_name,count(a.id) as cnt ';
        $this->table = "`counter_trans` as a INNER JOIN counter as b on a.counter_id=b.id inner join sales as c on c.bill_type=b.bill_type inner join users as u on u.ID=c.created_by ";
        $this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
		$this->wherecondition = " where  c.created_date >= a.login_time and (c.created_date <=a.logouttime or logouttime like'%0000-00-00%') ";
		if ($this->input->post('date')) {
            $this->wherecondition = $this->wherecondition . ' and a.trans_date ="' . $this->getDate($this->input->post('date')) . '"';
        }
		if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and c.bill_type ="' . $this->input->post('btype') . '"';
        }
		$this->group = ' a.id';
	}

}
