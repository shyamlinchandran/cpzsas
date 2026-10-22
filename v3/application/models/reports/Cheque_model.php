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
class Cheque_model extends DataTable {

   function where(){
        $this->select = 'chq_status,chq_sdate,chq_trans,chq_no,chq_amount,b.name as fromname,c.name as toname,collected_by,chq_date';
		$this->table = "`chqdetails` as a left JOIN acc_ledgers as b on b.id = a.chq_frm   left JOIN acc_ledgers as c on c.id = a.chq_to  ";
		$this->column_order = array(null, 'chq_sdate'); //set column field database for datatable orderable
        $this->column_search = array( 'chq_sdate,b.name,c.name'); //set column field database for datatable searchable 
        $this->order = array( 'chq_sdate' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if($this->input->post('type') ){
			$this->wherecondition = ' where chq_trans = "'.$this->input->post('type').'" ';
		}
		if($this->input->post('user') ){
			if($this->input->post('user') != 0 && $this->input->post('user') != '0' ){
				$this->wherecondition = $this->wherecondition . ' and collected_by =  '.$this->input->post('user');
			}
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and chq_sdate >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and chq_sdate <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('status') ){
			$this->wherecondition = $this->wherecondition . ' and chq_status = "'.$this->input->post('status').'" ';
		}
	}
	

}
