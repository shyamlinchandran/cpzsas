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
class Invoicereport_model extends DataTable {

    function getType() {
        $qry = 'select * from item';
        $res = $this->db->query($qry);
        return $res->result_array();
    }
	
	function customer_sales(){
				  //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales as a left JOIN suppliers as b on a.customer_id=b.id';
        $this->column_order = array(null, 'invoice','cusname','invoice_date','b.name'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'cusname','invoice_date','b.name'); //set column field database for datatable searchable 
        $this->select = 'sum(a.tax) as tax ,sum(a.discount)  as discount,a.type,a.sales_id,IFNULL(b.name,a.cusname) as cusname,IFNULL(b.tin,"Nil") as tin,a.invoice_date,a.invoice,sum(a.cash_amount) cash_amount,sum(a.bank_amount) bank_amount,sum(a.total) total,IFNULL(sum(a.total) -(sum(a.cash_amount)+sum(a.bank_amount)),0) as credit ';
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes'";
        $this->wherecondition = $this->wherecondition ."  and a.type='sales'";


        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
}
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
          if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  a.customer_id  =' . $this->input->post('toid');
        }
		if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and a.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and a.ref_id ="' . $this->input->post('reference') . '"';
        }
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and b.area ="' . $this->input->post('area') . '"';
        }
			$this->group = 'customer_id';
                // $this->wherecondition = " where b.id=".$id;

        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
	}
	
	function sales_forecast(){
		$based_on = $this->input->post('based_on');
		$this->table = 'item as a left join units as u on u.id = a.unit_id LEFT JOIN (select sum(b.current_stock+b.open_stock) as stock,b.item_id from item_godown as b GROUP by b.item_id ) as x on x.item_id = a.id';
		$this->column_order = array(null, 'a.name','a.barcode'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'a.barcode'); //set column field database for datatable searchable 
        $this->select = 'u.code,a.unit_id,a.name,a.barcode,IFNULL(x.stock,0) as stock,a.srate,a.prate,a.landing_cost,a.special_rate,'.$based_on.' as rate,'.$based_on.' * IFNULL(x.stock,0) as ratevalue ,landing_cost * IFNULL(x.stock,0) as lcvalue,prate * IFNULL(x.stock,0) as pratevalue,( IFNULL(x.stock,0) * '.$based_on.' ) - ( IFNULL(x.stock,0) * prate ) as pratemargin,( IFNULL(x.stock,0) * '.$based_on.' ) - ( IFNULL(x.stock,0) * landing_cost ) as lcmargin   ';
		$this->wherecondition = " where a.published ='yes' ";
		if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_category_id = "' . $this->input->post('category_id') . '"';
}
        if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and a.brand_id ="' . $this->input->post('brand'). '"';
        }
	}

	function getsaleslist(){
		  //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales as a left JOIN suppliers as b on a.customer_id=b.id';
        $this->column_order = array(null, 'invoice','cusname','invoice_date','b.name'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'cusname','invoice_date','b.name'); //set column field database for datatable searchable 
        $this->select = 'a.type,a.sales_id,IFNULL(b.name,a.cusname) as cusname,IFNULL(b.tin,"Nil") as tin,a.invoice_date,a.invoice,a.cash_amount,a.bank_amount,a.total,IFNULL(a.total -(a.cash_amount+a.bank_amount),0) as credit ';
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes'";
        $this->wherecondition = $this->wherecondition ."  and a.type='sales'";


        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
}
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
          if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  a.customer_id  =' . $this->input->post('toid');
        }
		if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and a.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and a.ref_id ="' . $this->input->post('reference') . '"';
        }
                // $this->wherecondition = " where b.id=".$id;

         if ($this->input->post('btype')) {
             $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype')  . '"';
         }
	}
 
     function where() { 

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales_items as c inner join sales as a on a.sales_id=c.sales_id left join taxgst as t on c.tax_id=t.gstid inner join suppliers as s on s.id=a.customer_id';
        $this->column_order = array(null, 's.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 's.name'); //set column field database for datatable searchable 
        $this->select = 'c.type as stype,c.sales_id as sid,a.total as gtotal,c.*,a.*,s.*';
         $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes'";

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
          if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');

        }
if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and a.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and a.ref_id ="' . $this->input->post('reference') . '"';
        }		
                // $this->wherecondition = " where b.id=".$id;
        
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
        
    }  
    function getgst($tid,$id){

        $qry = 'select sum(total) as tot,sum(tax) as tax from sales_items where published="yes" and tax_id=' . $tid . " and sales_id='" . $id . "'";

        $query = $this->db->query($qry)->row_array();
        return $query['tax'];

    }
      function where1() {
       
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales_items as a left join (SELECT e_invoice.AckNo,sales_id as isales_id FROM e_invoice WHERE   e_invoice.`status` =1) as ev on ev.isales_id =  a.sales_id left join (SELECT sales_id,e_way.EwbNo,e_way.EwbDt FROM e_way WHERE STATUS = 1) as ew on ew.sales_id = a.sales_id INNER JOIN sales as b on a.sales_id=b.sales_id left JOIN suppliers as s on b.customer_id=s.id left join taxgst as g on g.gstid=a.tax_id';
        $this->column_order = array(null, 'invoice','cusname','invoice_date'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'cusname','invoice_date'); //set column field database for datatable searchable 
        $this->select = 'AckNo,EwbNo,EwbDt,cusemail,b.discount,b.type as stype,b.sales_id as sid,b.invoice,b.total as tot,sum(a.total),sum(a.total-a.tax) as bef,sum(a.tax) as tax,cusname,s.tin,invoice_date';
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes'  ".$this->input->post('filter_by')." ";
        $this->wherecondition = $this->wherecondition ." and b.published ='yes' and b.type='sales'";

		
		
		 if ($this->input->post('type')) {
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and s.tin !="" and s.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (s.tin ="" or s.tin is null) ';
            }
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
}
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
          if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.customer_id  =' . $this->input->post('toid');
        }
		if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and b.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  b.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and b.ref_id ="' . $this->input->post('reference') . '"';
        }
               $this->wherecondition = $this->wherecondition ."  group by b.sales_id";
                // $this->wherecondition = " where b.id=".$id;

        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
        
    }  

}
