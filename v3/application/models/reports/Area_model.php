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
class Area_model extends DataTable {


	function ItemwiseInvoice(){
		$txt_salesman = '';
		$txt_area = '';
		if($this->input->post('salesarea')){
			$salesarea = $this->input->post('salesarea',true);
			$length = sizeof($salesarea);
			for($i = 0 ;$i<$length;$i++){
				if($txt_area == ''){
					$txt_area = $txt_area . ' and ( ';
				}else{
					$txt_area = $txt_area . ' or ';
				}
				$txt_area  = $txt_area  . ' cus.area = '.$salesarea[$i].'  ';
			}$txt_area = $txt_area . ') ';
		}
		if($this->input->post('salesman')){
			$salesman = $this->input->post('salesman',true);
			$length = sizeof($salesman);
			for($i = 0 ;$i<$length;$i++){
				if($txt_salesman == ''){
					$txt_salesman = $txt_salesman . ' and ( ';
				}else{
					$txt_salesman = $txt_salesman . ' or ';
				}
				$txt_salesman  = $txt_salesman  . ' s.salesman = '.$salesman[$i].'  ';
			}$txt_salesman = $txt_salesman . ') ';
		}
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$area = $this->input->post('area');
		$route = $this->input->post('route');
        $this->select = 'i.unit_id,sub_unit_one,sub_unit_two,sum(si.quantity * box.base_unit_count) as quantitys ,u.code,i.name,sum(si.base_quantity) as quantity,sum(si.base_free_quantity) as free_quantity ';
		$this->table = " sales as s  inner join set_billtype as sb on sb.id =s.bill_type and s.published = 'yes' and s.type= 'sales' INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' LEFT JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id INNER JOIN units as box on box.id =si.unit_id " ;
		 $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( 'i.name' => 'asc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('area')) {
			//$this->wherecondition = ' where cus.area = "'.$area.'" ';
		}
		if ($this->input->post('startdate')) {
          //  $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
         //   $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if ($this->input->post('vehicle')) {
			// $this->wherecondition = $this->wherecondition . ' and s.vehicle ='.$this->input->post('vehicle').' ';
		}
		if ($this->input->post('toid')) {
			// $this->wherecondition = $this->wherecondition . ' and i.id ='.$this->input->post('toid').' ';
		}
		if ($this->input->post('branch')) {
			// $this->wherecondition = $this->wherecondition . ' and sb.branch_id ='.$this->input->post('branch').' ';
		}
		
		if ($this->input->post('invoices')) {
			$this->wherecondition = $this->wherecondition . ' and s.sales_id in( '.str_replace("_",",",$this->input->post('invoices')).')  ';
		}else{
			 $this->wherecondition = $this->wherecondition . ' and s.sales_id = 0  ';
		}
		$this->wherecondition = $this->wherecondition .$txt_salesman.$txt_area;
		$this->group = ' i.id';

	}

   function Itemwise(){
		$txt_salesman = '';
		$txt_area = '';
		if($this->input->post('salesarea')){
			$salesarea = $this->input->post('salesarea',true);
			$length = sizeof($salesarea);
			for($i = 0 ;$i<$length;$i++){
				if($txt_area == ''){
					$txt_area = $txt_area . ' and ( ';
				}else{
					$txt_area = $txt_area . ' or ';
				}
				$txt_area  = $txt_area  . ' cus.area = '.$salesarea[$i].'  ';
			}$txt_area = $txt_area . ') ';
		}
		if($this->input->post('salesman')){
			$salesman = $this->input->post('salesman',true);
			$length = sizeof($salesman);
			for($i = 0 ;$i<$length;$i++){
				if($txt_salesman == ''){
					$txt_salesman = $txt_salesman . ' and ( ';
				}else{
					$txt_salesman = $txt_salesman . ' or ';
				}
				$txt_salesman  = $txt_salesman  . ' s.salesman = '.$salesman[$i].'  ';
			}$txt_salesman = $txt_salesman . ') ';
		}
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$area = $this->input->post('area');
		$route = $this->input->post('route');
        $this->select = 'u.code,i.name,sum(si.base_quantity) as quantity,sum(si.base_free_quantity) as free_quantity ';
		$this->table = " sales as s  inner join set_billtype as sb on sb.id =s.bill_type and s.published = 'yes' and s.type= 'sales' INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' INNER JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =i.unit_id " ;
		 $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( 'i.name' => 'asc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('area')) {
			$this->wherecondition = ' where cus.area = "'.$area.'" ';
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if ($this->input->post('vehicle')) {
			 $this->wherecondition = $this->wherecondition . ' and s.vehicle ='.$this->input->post('vehicle').' ';
		}
		if ($this->input->post('toid')) {
			 $this->wherecondition = $this->wherecondition . ' and i.id ='.$this->input->post('toid').' ';
		}
		if ($this->input->post('branch')) {
			 $this->wherecondition = $this->wherecondition . ' and sb.branch_id ='.$this->input->post('branch').' ';
		}
		$this->wherecondition = $this->wherecondition .$txt_salesman.$txt_area;
		$this->group = ' i.id';

	}

	function Invoice(){
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$this->select = 'a.*,b.name ';
		$this->table = " sales as  a LEFT JOIN suppliers as b on a.customer_id  = b.id and a.published = 'yes' ";
		$this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array( 'b.name'); //set column field database for datatable searchable 
        $this->order = array( 'a.invoice_date' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }

		if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('type') . '"';
        }
	}
	function Customerwise(){
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$area = $this->input->post('area');
		$route = $this->input->post('route');
        $this->select = 's.total,cus.name,s.invoice ';
		$this->table = " sales as s inner join set_billtype as sb on sb.id =s.bill_type and s.published = 'yes'  and s.type= 'sales' INNER JOIN suppliers as cus on cus.id =s.customer_id  ";
		$this->column_order = array(null, 'cus.name'); //set column field database for datatable orderable
        $this->column_search = array( 'cus.name'); //set column field database for datatable searchable 
        $this->order = array( 'cus.name' => 'asc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('area')) {
			$this->wherecondition = ' where cus.area = "'.$area.'" ';
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if ($this->input->post('vehicle')) {
			 $this->wherecondition = $this->wherecondition . ' and s.vehicle ='.$this->input->post('vehicle').' ';
		}
		if ($this->input->post('branch')) {
			 $this->wherecondition = $this->wherecondition . ' and sb.branch_id ='.$this->input->post('branch').' ';
		}
	}
 

}
