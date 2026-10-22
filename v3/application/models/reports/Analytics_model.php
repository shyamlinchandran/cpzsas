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
class Analytics_model extends DataTable {

	function edited_list(){
		$this->select = 'sa.user_name as salemanname,r.name as agentname,ed.user_name as edited,cr.user_name as created,a.* ';
		$this->table  = '`voucherAudit` as a LEFT JOIN users as cr on cr.Id = a.created_by left JOIN users as ed on ed.Id = a.edited_by LEFT JOIN users as sa on sa.Id =a.sales_man  left join reference as r on r.ref_id = a.agent';
		$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
        $this->column_search = array( 'a.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('a.last_edited_date' => 'desc'); // default order 
		$this->wherecondition = ' where edited_count > 0 ';
		
		if($this->input->post('start_date')){
			$this->wherecondition = $this->wherecondition . ' and DATE(last_edited_date) >= "'.$this->getDate($this->input->post('start_date')).'"  ';
		}
		if($this->input->post('end_date')){
			$this->wherecondition = $this->wherecondition .  ' and DATE(last_edited_date) <= "'.$this->getDate($this->input->post('end_date')).'"  ';
		}
		if($this->input->post('user')){
			$this->wherecondition = $this->wherecondition   .' and edited_by = '.$this->input->post('user');
		}
		
		if($this->input->post('voucher_type')){
			$this->wherecondition = $this->wherecondition   .' and trn_tp = "'.$this->input->post('voucher_type').'" ' ;
		}
		
	}
   function ItemAnalytics(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$text = '';
		if($this->input->post('start_date')){
			$text =  $text . ' and s.invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
		}
		if($this->input->post('end_date')){
			$text =  $text . ' and s.invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
		}
		$this->select = 'i.name,i.barcode,IFNULL(item.quantity,0) as quantity,IFNULL(item.total,0) as total ';
		$this->table  = 'item as i left join (SELECT si.item_id,sum(si.base_quantity) as quantity,sum(si.total) as total from sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published = "yes" and si.published ="yes" '.$text.' GROUP by si.item_id) as item on item.item_id = i.id';
		$this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( $this->input->post('orderBy') => $this->input->post('orderType')); // default order 
		$this->group = ' i.id';
		$this->wherecondition = ' where 1 ';
		if($this->input->post('item_movement')){
			$this->wherecondition = $this->wherecondition   .$this->input->post('item_movement');
		}
	}
	function CustomerAnalytics(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$text = '';
		if($this->input->post('start_date')){
			$text =  $text . ' and s.invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
		}
		if($this->input->post('end_date')){
			$text =  $text . ' and s.invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
		}
		$this->select = 'c.phone,c.name,IFNULL(sale.sales_count,0) as count,IFNULL(sale.sales_total,0) as total ';
		$this->table  = 'suppliers as c left join (SELECT s.customer_id,COUNT(s.sales_id) sales_count,sum(s.total) as sales_total from sales as s WHERE s.published = "yes" '.$text.' GROUP by s.customer_id) as sale on sale.customer_id = c.id';
		$this->column_order = array(null, 'c.name'); //set column field database for datatable orderable
        $this->column_search = array( 'c.name'); //set column field database for datatable searchable 
        $this->order = array( $this->input->post('orderBy') => $this->input->post('orderType')); // default order 
		$this->group = ' c.id';
		$this->wherecondition = ' where 1 ';
		if($this->input->post('item_movement')){
			$this->wherecondition = $this->wherecondition   .$this->input->post('item_movement');
		}
	}
 

}
