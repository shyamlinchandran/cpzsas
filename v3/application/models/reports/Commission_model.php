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
class Commission_model extends DataTable {

    function wherecondition() {
        $this->select = 'b.user_name,sum(a.total) as total,b.percentage,sum(a.total)*percentage/100 as amount ';
        $this->table = 'sales as a inner join users as b on a.salesman=b.Id';
        $this->column_order = array(null, 'b.user_name'); //set column field database for datatable orderable
        $this->column_search = array('b.user_name'); //set column field database for datatable searchable 
        $this->order = array('b.user_name' => 'asc'); // default order 
        $this->wherecondition = " where a.published ='yes'  and a.type  in('sales')";

        if ($this->input->post('user')) {
            $this->wherecondition = $this->wherecondition . ' and a.salesman ="' . $this->input->post('user') . '"';
        }
        $this->wherecondition = $this->wherecondition . ' GROUP by a.salesman ';
    }

	
	function commissionanalysis(){
		if($this->input->post('reference')  == 's.ref_id'){
			$join_text = " inner join reference on reference.ref_id = s.ref_id ";
			$sel_text = " reference.name as refname ";
		}else{
			$join_text = " inner join users on users.Id  = s.salesman ";
			$sel_text = " users.user_name as refname ";
		}
		$company = $this->getCompanySettings();
		$commission_type = 'flat';
		if(isset($company[0]['commission_type']) ){
			$commission_type  = $company[0]['commission_type'];
		}
		if($commission_type == 'flat' ){
			$commission_text = 'sum(si.base_quantity * si.item_commission) as item_commission';
		}else{
			$commission_text =  'sum((si.total * si.item_commission)/100) as item_commission';
		}
		$commission_text =  'sum(((si.total-si.tax) * si.item_commission)/100) as item_commission';

		$this->select ="sum(case when s.type = 'sales' then item_commission else 0 end) as item_commission,sum(case when s.type = 'sales_return' then item_commission else 0 end) as return_commission,$sel_text";
		$this->table = "(select * from sales where type in('sales','sales_return')) as s $join_text INNER JOIN (SELECT si.sales_id,".$commission_text.",si.item_id from sales_items as si WHERE si.published ='yes' GROUP by si.sales_id ) as x on x.sales_id = s.sales_id and s.published = 'yes' INNER JOIN set_billtype as sb on sb.id =s.bill_type left JOIN suppliers as sup on sup.id = s.customer_id";
		$this->column_order = array('s.date','s.invoice'); //set column field database for datatable orderable
        $this->column_search = array('s.date','s.invoice','sup.name','s.cusname'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'desc'); // default order
		$this->wherecondition = " where 1";
		if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
		if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
		}
		if($this->input->post('btype') ){
            $this->wherecondition = $this->wherecondition . ' and s.bill_type ="' . $this->input->post('btype') . '"';
		}
		if($this->input->post('customer_id') ){
            $this->wherecondition = $this->wherecondition . ' and s.customer_id ="' .$this->input->post('customer_id') . '"';
		}
		if($this->input->post('type') ){
            $this->wherecondition = $this->wherecondition . ' and s.cash_type ="' . $this->input->post('type'). '"';
		}
		if($this->input->post('reference') ){
            // $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
			$this->group = $this->input->post('reference');
		}
		// if($this->input->post('salesman') ){
        //     $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
		// }
		// if($this->input->post('user') ){
        //     $this->wherecondition = $this->wherecondition . ' and s.created_by ="' . $this->input->post('user') . '"';
		// }
		
	}
	
	function billwise_list(){
		$company = $this->getCompanySettings();
		$commission_type = 'flat';
		if(isset($company[0]['commission_type']) ){
			$commission_type  = $company[0]['commission_type'];
		}
		if($commission_type == 'flat' ){
			$commission_text = 'sum(si.base_quantity * si.item_commission) as item_commission';
		}else{
			$commission_text =  'sum((si.total * si.item_commission)/100) as item_commission';
		}
		$commission_text =  'sum(((si.total-si.tax) * si.item_commission)/100) as item_commission';

		$this->select ="s.sales_id,s.type,s.cash_type,ifnull(sup.name ,  CASE WHEN s.cusname ='' then 'cash' else s.cusname end) as customer,s.invoice_date,s.invoice,s.total,x.item_commission";
		$this->table = "(select * from sales where type = '".$this->input->post('saletype')."' ) as s INNER JOIN (SELECT si.sales_id,".$commission_text.",si.item_id from sales_items as si WHERE si.published ='yes' GROUP by si.sales_id ) as x on x.sales_id = s.sales_id and s.published = 'yes' INNER JOIN set_billtype as sb on sb.id =s.bill_type left JOIN suppliers as sup on sup.id = s.customer_id";
		$this->column_order = array('s.date','s.invoice'); //set column field database for datatable orderable
        $this->column_search = array('s.date','s.invoice','sup.name','s.cusname'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'desc'); // default order
		$this->wherecondition = " where 1";
		if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
		if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
		}
		if($this->input->post('btype') ){
            $this->wherecondition = $this->wherecondition . ' and s.bill_type ="' . $this->input->post('btype') . '"';
		}
		if($this->input->post('customer_id') ){
            $this->wherecondition = $this->wherecondition . ' and s.customer_id ="' .$this->input->post('customer_id') . '"';
		}
		if($this->input->post('type') ){
            $this->wherecondition = $this->wherecondition . ' and s.cash_type ="' . $this->input->post('type'). '"';
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
	
	function itemwise_list(){
		$company = $this->getCompanySettings();
		$commission_type = 'flat';
		if(isset($company[0]['commission_type']) ){
			$commission_type  = $company[0]['commission_type'];
		}
		if($commission_type == 'flat' ){
			$commission_text = 'sum(si.base_quantity * si.item_commission) as item_commission';
		}else{
			$commission_text =  'sum((si.total * si.item_commission)/100) as item_commission';
		}
		$commission_text =  'sum(((si.total-si.tax) * si.item_commission)/100) as item_commission';

		$this->select =" icp,s.sales_id,s.type,x.quantity,i.name,i.barcode,s.cash_type,ifnull(sup.name ,  CASE WHEN s.cusname ='' then 'cash' else s.cusname end) as customer,s.invoice_date,s.invoice,x.total,x.item_commission";
		$this->table = "(select * from sales where type = '".$this->input->post('saletype')."' ) as s INNER JOIN (SELECT si.sales_id,".$commission_text.",si.item_id,sum(si.total -si.tax) as total,sum(si.base_quantity) as quantity,si.item_commission as icp from sales_items as si WHERE si.published ='yes' GROUP by si.sales_id,si.item_id ) as x on x.sales_id = s.sales_id and s.published = 'yes' INNER JOIN item as i on i.id = x.item_id INNER JOIN set_billtype as sb on sb.id =s.bill_type left JOIN suppliers as sup on sup.id = s.customer_id";
		$this->column_order = array('s.date','s.invoice'); //set column field database for datatable orderable
        $this->column_search = array('s.date','s.invoice','sup.name','s.cusname'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'desc'); // default order
		$this->wherecondition = " where 1";
		if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
		if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
		}
		if($this->input->post('btype') ){
            $this->wherecondition = $this->wherecondition . ' and s.bill_type ="' . $this->input->post('btype') . '"';
		}
		if($this->input->post('customer_id') ){
            $this->wherecondition = $this->wherecondition . ' and s.customer_id ="' .$this->input->post('customer_id') . '"';
		}
		if($this->input->post('type') ){
            $this->wherecondition = $this->wherecondition . ' and s.cash_type ="' . $this->input->post('type'). '"';
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
		if($this->input->post('toid') ){
            $this->wherecondition = $this->wherecondition . ' and x.item_id ="' . $this->input->post('toid') . '"';
		}
		
	}

}
