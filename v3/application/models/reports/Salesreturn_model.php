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
class Salesreturn_model extends DataTable {

   
	
	
    function where() {

        $this->select = 's.cusname as name,s.invoice,s.invoice_date,s.total,s.adjustment_amount,s.adjustment_ref,u.username as user,sa.username as salesman';
        $this->table = '`sales` as s  left JOIN users as u on u.Id = s.created_by  left JOIN users as sa on sa.Id = s.salesman';
        $this->column_order = array(null, 'invoice_date', 'invoice','s.cusname'); //set column field database for datatable orderable
        $this->column_search = array('s.invoice', 's.invoice_date', 's.cusname'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where s.published ='yes' and s.type ='sales' and adjustment_amount > 0  ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and s.bill_type <="' . $this->input->post('btype') . '"';
        }
		if($this->input->post('reference') ){
            $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
		}
		if($this->input->post('salesman') ){
            $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
		}
		if($this->input->post('user') ){
            $this->wherecondition = $this->wherecondition . ' and s.created_by ="' . $this->input->post('user') . '"';
		}
        

    }

   

}
