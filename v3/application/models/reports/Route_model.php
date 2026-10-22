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
class Route_model extends DataTable {

   function Dayreport(){
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$area = $this->input->post('area');
		$route = $this->input->post('route');
        $this->select = 'u.code,i.name,si.quantity ';
		$this->table = " sales as s INNER JOIN sales_items as si on s.sales_id =si.sales_id and si.published ='yes' INNER JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =si.unit_id " ;
		 $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( 'i.name' => 'asc'); // default order 
		$this->wherecondition = ' where cus.area = "'.$area.'" ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }

	}
	
	function item_dayreport(){
		$startdate = $this->input->post('startdate');
		$this->select = 'IFNULL(closing,0) as closing,IFNULL(damageqty,0) as damageqty,IFNULL(routedamageqty,0) as routedamageqty,IFNULL(purchase_qty,0) as purchase_qty,IFNULL(in_qty,0) as in_qty,IFNULL(out_qty,0) as out_qty,IFNULL(open,0) as openstock,IFNULL(sale.retamount,0) as retamount,IFNULL(sale.retquantity,0) as retquantity,IFNULL(sale.whquantity,0) as whquantity,IFNULL(sale.whamount,0) as whamount,IFNULL(sale.routeamount,0) as routeamount,IFNULL(sale.routeqty,0) as routeqty,gdw.gstock,i.name,i.barcode';
		$this->table = "  item as i left join (SELECT sum(CASE WHEN il.trans_date ='2020-12-03' and il.trans_status = 'purchase' then quantity else 0 end) as purchase_qty ,sum(case WHEN il.trans_date <='2020-12-03' and il.trans_type = 'dt' then il.quantity else 0 end) -sum(case WHEN il.trans_date <='2020-12-03' and il.trans_type = 'cr' then il.quantity else 0 end) as closing,sum(case WHEN il.trans_date <'2020-12-03' and il.trans_type = 'dt' then il.quantity else 0 end) -sum(case WHEN il.trans_date <'2020-12-03' and il.trans_type = 'cr' then il.quantity else 0 end) as open,il.item_id,sum(CASE WHEN trans_status ='transfer' and godown != 1 and trans_type = 'dt' THEN quantity else 0 end ) as out_qty,sum(CASE WHEN trans_status ='transfer' and godown = 1 and trans_type = 'dt' THEN quantity else 0 end ) as in_qty,il.item_id as il_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id ORDER BY `purchase_qty` DESC) as led on led.il_id = i.id LEFT JOIN (SELECT sum(ig.open_stock) as gstock,ig.item_id as igid from item_godown as ig GROUP by ig.item_id ) as gdw on gdw.igid =i.id left join (SELECT si.item_id as salesitemid,sum(case WHEN s.is_mobile = 1 then quantity else 0 end ) as routeqty,sum(case WHEN s.is_mobile = 1 then damage_quantity else 0 end ) as routedamageqty,sum(case WHEN s.is_mobile = 0 then damage_quantity else 0 end ) as damageqty,sum(case WHEN s.is_mobile = 1 then si.total else 0 end ) as routeamount,sum(case WHEN s.bill_type = '23' then si.total else 0 end ) as whamount,sum(case WHEN s.bill_type = 23 then si.quantity else 0 end ) as whquantity,sum(case WHEN s.bill_type = '24' then si.total else 0 end ) as retamount,sum(case WHEN s.bill_type = 24 then si.quantity else 0 end ) as retquantity FROM sales as s INNER JOIN sales_items as si on si.sales_id=s.sales_id and s.invoice_date = '2020-12-03' and si.published ='yes' GROUP by si.item_id) as sale on sale.salesitemid = i.id " ;
		 $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( 'i.name' => 'asc'); // default order 
		
	}

}
