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
class Marginreport_model extends DataTable {

    function getType() {
        $qry = 'select * from item';
        $res = $this->db->query($qry);
        return $res->result_array();
    }
	
	
	    function landing_cost() {

        $this->table = 'sales_items as c inner join sales as a on a.sales_id=c.sales_id left join set_billtype as sb on sb.id = a.bill_type inner join item as i on i.id=c.item_id left join units as u on u.id= i.unit_id left join suppliers as b on a.customer_id=b.id inner join taxgst as t on t.gstid = c.tax_id';
        $this->column_order = array(null, 'a.invoice', 'invoice_date', 'item', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.name', 'invoice_date', 'item', 'b.name'); //set column field database for datatable searchable 
        $this->select = 't.GST,sum(base_quantity) as base,u.code as unit,sum(c.total) - (sum(base_quantity) *  sum(case when item_landing_cost > 0 then item_landing_cost else landing_cost end) /count(base_quantity)) as margin,sum(base_quantity) *  sum(case when item_landing_cost > 0  then item_landing_cost else landing_cost end) /count(base_quantity) as lcvalue,sum(c.total) / sum(base_quantity) as salesrate,a.type as stype,a.sales_id as sid,i.name as item,sum(c.total) as tot,a.*,b.*,c.*,i.*';
        $this->order = array('c.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and c.published ='yes' and a.type='sales'";
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and b.area >="' .$this->input->post('area') . '"';
        }
        if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and b.route <="' .$this->input->post('route') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.id  =' . $this->input->post('cusid');
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');
        }
		if($this->input->post('salesman')){
            $this->wherecondition = $this->wherecondition . ' and  a.salesman  =' . $this->input->post('salesman');
		}
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
		if($this->input->post('reference')){
            $this->wherecondition = $this->wherecondition . ' and  a.ref_id  =' . $this->input->post('reference');
		}
		if($this->input->post('branch')){
            $this->wherecondition = $this->wherecondition . ' and  sb.branch_id  =' . $this->input->post('branch');
		}
        $this->wherecondition = $this->wherecondition . "  group by c.item_id";

        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }
	
		    function landing_cost_lc() {

        $this->table = 'sales_items as c inner join sales as a on a.sales_id=c.sales_id left join set_billtype as sb on sb.id = a.bill_type inner join item as i on i.id=c.item_id left join units as u on u.id= i.unit_id left join suppliers as b on a.customer_id=b.id inner join taxgst as t on t.gstid = c.tax_id';
        $this->column_order = array(null, 'a.invoice', 'invoice_date', 'item', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.name', 'invoice_date', 'item', 'b.name'); //set column field database for datatable searchable 
        $this->select = 'case when item_landing_cost > 0 then item_landing_cost	else landing_cost end as landing,t.GST,sum(base_quantity) as base,u.code as unit,sum(c.total) - (sum(base_quantity) * case when item_landing_cost > 0 then item_landing_cost	else landing_cost end	) as margin,sum(base_quantity) * case when item_landing_cost > 0 then item_landing_cost	else landing_cost end as lcvalue,sum(c.total) / sum(base_quantity) as salesrate,a.type as stype,a.sales_id as sid,i.name as item,sum(c.total) as tot,a.*,b.*,c.*,i.*';
        $this->order = array('c.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and c.published ='yes' and a.type='sales'";
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and b.area >="' .$this->input->post('area') . '"';
        }
        if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and b.route <="' .$this->input->post('route') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.id  =' . $this->input->post('cusid');
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');
        }
		if($this->input->post('salesman')){
            $this->wherecondition = $this->wherecondition . ' and  a.salesman  =' . $this->input->post('salesman');
		}
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
		if($this->input->post('reference')){
            $this->wherecondition = $this->wherecondition . ' and  a.ref_id  =' . $this->input->post('reference');
		}
		if($this->input->post('branch')){
            $this->wherecondition = $this->wherecondition . ' and  sb.branch_id  =' . $this->input->post('branch');
		}
        $this->wherecondition = $this->wherecondition . "  group by c.item_id,a.sales_id";

        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }
	
	
	
	
	function get_average_list(){
		$normal = '';
		$before = '';
		
		if( $this->input->post('startdate') ){
			$normal = $normal . ' and il.trans_date >=  "'.$this->getDate($this->input->post('startdate')).'" ';
			$before = $before . ' and il.trans_date <  "'.$this->getDate($this->input->post('startdate')).'" ';
		}else{
			$before = $before . ' and il.trans_date <  "2000-01-01" ';
		}
		if( $this->input->post('enddate') ){
			$normal = $normal . ' and il.trans_date <=  "'.$this->getDate($this->input->post('enddate')).'" ';
		}
		
		
		
		$this->table ="item as i LEFT JOIN (SELECT SUM(CASE WHEN il.trans_type = 'dt' ".$before." then il.quantity else 0 end) - SUM(CASE WHEN il.trans_type = 'cr' ".$before." then il.quantity else 0 end) as bef_stock ,il.item_id, SUM(CASE WHEN il.trans_type = 'dt' then il.quantity else 0 end) - SUM(CASE WHEN il.trans_type = 'cr' then il.quantity else 0 end) as c_stock ,

 SUM(CASE WHEN il.trans_status = 'sales' and il.trans_type = 'cr' and il.quantity > 0   ".$normal."  and il.mrp > 0 then il.quantity else 0 end) as saleqty,

 SUM(CASE WHEN il.trans_status = 'purchase' and il.trans_type = 'dt' and il.quantity > 0  ".$normal."   and il.rate > 0 then il.quantity else 0 end) as purqty,


SUM(CASE WHEN il.trans_status = 'sales' and il.trans_type = 'cr' and il.quantity > 0  ".$normal."   and il.mrp > 0 then il.mrp * il.quantity else 0 end) / SUM(CASE WHEN il.trans_status = 'sales' and il.trans_type = 'cr' and il.quantity > 0   ".$normal."  and il.mrp > 0 then il.quantity else 0 end) as avgsrate,

SUM(CASE WHEN il.trans_status = 'sales' and il.trans_type = 'cr' and il.quantity > 0  ".$before."  and il.mrp > 0 then il.mrp * il.quantity else 0 end) / SUM(CASE WHEN il.trans_status = 'sales' and il.trans_type = 'cr' and il.quantity > 0 ".$before."   and il.mrp > 0 then il.quantity else 0 end) as avgsratebefore,

SUM(CASE WHEN il.trans_status = 'purchase' and il.trans_type = 'dt' and il.quantity > 0   ".$normal."   and il.rate > 0 then il.rate * il.quantity else 0 end) / SUM(CASE WHEN il.trans_status = 'purchase' and il.trans_type = 'dt' and il.quantity > 0  ".$normal."   and il.rate > 0 then il.quantity else 0 end) as avgprate,

SUM(CASE WHEN il.trans_status = 'purchase' and il.trans_type = 'dt' and il.quantity > 0   ".$before." and il.rate > 0 then il.rate * il.quantity else 0 end) / SUM(CASE WHEN il.trans_status = 'purchase' and il.trans_type = 'dt' and il.quantity > 0  ".$before."   and il.rate > 0 then il.quantity else 0 end) as avgpratebrfore

FROM `item_ledger` as il WHERE il.published = 'yes' and  il.trans_status in ('sales','purchase') GROUP by il.item_id ) as x on x.item_id = i.id  left JOIN (SELECT SUM(ig.open_stock) as open_stock,ig.item_id FROM `item_godown` as ig WHERE 1 GROUP by  ig.item_id) as g on g.item_id = i.id";
		$this->column_order = array(null, 'i.name', 'i.barcode');
		$this->column_search = array( 'i.barcode', 'i.name');
		$this->select = "x.*,g.*,i.name,i.barcode,i.unit_id,i.item_category_id,i.brand_id,i.id as iid ";
		$this->wherecondition = " where  i.published = 'yes' ";
		$this->having = "  ifnull(saleqty,0) > 0  ";
	}



	function customisedreport(){
		$sale = '';
		$pur = '';
		$sales_item = '';
		$txt = '';
		if( $this->input->post('startdate') ){
			$startdate  = $this->getDate($this->input->post('startdate'));
			$pur = " and led.trans_date <='".$startdate."' ";
			$sale = " and sale.invoice_date >= '".$startdate."' ";
			$sales_item = " and led.trans_date >= '".$startdate."' ";

		}
		if( $this->input->post('enddate') ){
			$enddate  = $this->getDate($this->input->post('enddate'));
			$sale = $sale . " and sale.invoice_date <= '".$enddate."' ";
			$sales_item = $sales_item . " and led.trans_date <= '".$enddate."' ";
		}
		 if ($this->input->post('btype')) {
            $sale = $sale . ' and  sale.bill_type  =' . $this->input->post('btype');
        }
		 if ($this->input->post('btype')) {
            $sale = $sale . ' and  sale.bill_type  =' . $this->input->post('btype');
        }
		if ($this->input->post('salesman')) {
            $sale = $sale . ' and  sale.salesman  =' . $this->input->post('salesman');
        }
		if ($this->input->post('user')) {
            $sale = $sale . ' and  sale.created_by  =' . $this->input->post('user');
        }
		if ($this->input->post('branch')) {
            $sale = $sale . ' and  sb.branch_id  =' . $this->input->post('branch');
        }
		
		$this->table ="(SELECT sum(sa.mrp)/count(sa.sales_id) as avgsalesrate,sum(sa.quantity) as avgsalequantity,sum(sa.quantity) as quantity,sa.item_id as sale_item from sales as sale inner join set_billtype as sb on sb.id =sale.bill_type INNER join sales_items as sa on sale.sales_id=sa.sales_id ".$sale." WHERE sa.published='yes' and sale.published='yes' GROUP by item_id) as margin INNER join  item as a on a.id=margin.sale_item left join (SELECT IFNULL(SUM(case when led.trans_status in('purchase','stock_journal') and led.trans_type='dt' ".$pur." then led.quantity else 0 end ),0) as pur_quantity,IFNULL(SUM(case when led.trans_status in('sales') and led.trans_type='cr' ".$sales_item." then led.quantity else 0 end ),0) as sale_quantity,IFNULL(SUM(case when led.trans_status in('purchase','stock_journal') and led.trans_type='dt' ".$pur." then led.rate else 0 end )/count(case when led.trans_status in('purchase','stock_journal') and led.trans_type='dt' ".$pur." then led.quantity else null end ),0) as avg_prate,led.item_id,IFNULL(sum(case when led.trans_status = 'sales' and led.trans_type='cr' ".$sales_item." then led.MRP else 0 end )/count(case when led.trans_status = 'sales' and led.trans_type='cr' ".$sales_item." then led.quantity else Null end ),0) as avg_srate FROM `item_ledger` as led WHERE led.published='yes'  GROUP by led.item_id) as item_ledgers on a.id=item_ledgers.item_id";
		$this->column_order = array(null, 'a.barcode', 'a.name');
		$this->column_search = array( 'a.barcode', 'a.name');
		$this->select = "avgsalesrate,avgsalequantity,a.open_stk_rate as open_stk_rates,a.prate as prates,avg_prate as avg_prates,a.barcode,margin.quantity,IFNULL(a.prate,a.open_stk_rate) as stk_rate,a.name ,item_ledgers.*";
		$this->wherecondition = " where  item_ledgers.item_id is not null and  avg_srate > 0 ";
	}

    function itemwise() {

        $this->table = 'sales_items as c inner join sales as a on a.sales_id=c.sales_id left join set_billtype as sb on sb.id = a.bill_type inner join item as i on i.id=c.item_id left join suppliers as b on a.customer_id=b.id inner join taxgst as t on t.gstid = c.tax_id';
        $this->column_order = array(null, 'a.invoice', 'invoice_date', 'item', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.name', 'invoice_date', 'item', 'b.name'); //set column field database for datatable searchable 
        $this->select = '(c.total - c.tax -c.itm_raw_ces) - (mar_pur_rate * quantity) as item_margins  ,mar_pur_rate,c.tax as ctax,c.quantity,c.total - c.tax -c.itm_raw_ces as sr,t.GST,a.type as stype,a.sales_id as sid,i.name as item,c.total as tot,a.*,b.*,c.*,i.*';
        $this->order = array('c.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and c.published ='yes' and a.type='sales'";
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and b.area >="' .$this->input->post('area') . '"';
        }
        if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and b.route <="' .$this->input->post('route') . '"';
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.id  =' . $this->input->post('cusid');
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');
        }
		if($this->input->post('salesman')){
            $this->wherecondition = $this->wherecondition . ' and  a.salesman  =' . $this->input->post('salesman');
		}
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
		if($this->input->post('reference')){
            $this->wherecondition = $this->wherecondition . ' and  a.ref_id  =' . $this->input->post('reference');
		}
		if($this->input->post('branch')){
            $this->wherecondition = $this->wherecondition . ' and  sb.branch_id  =' . $this->input->post('branch');
		}
        $this->wherecondition = $this->wherecondition . "  group by c.item_id,a.sales_id";

        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

    function getgst($tid, $id) {

        $qry = 'select sum(total) as tot,sum(tax) as tax from sales_items where published="yes" and tax_id=' . $tid . " and sales_id='" . $id . "'";

        $query = $this->db->query($qry)->row_array();
        return $query['tax'];
    }

    function billwise() {

        $this->select = 'a.type as stype,a.sales_id as sid,a.*,b.*';
        $this->table = 'sales as a left join suppliers as b on a.customer_id=b.id left join set_billtype as sb on sb.id = a.bill_type';
        $this->column_order = array(null, 'a.invoice', 'name', 'cusname'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'name', 'cusname'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and a.type='sales'";
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and a.cash_type ="' . $this->input->post('type') . '"';
        }
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and b.area >="' .$this->input->post('area') . '"';
        }
        if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and b.route <="' .$this->input->post('route') . '"';
        }

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.id  =' . $this->input->post('toid');
        }
		if($this->input->post('salesman')){
            $this->wherecondition = $this->wherecondition . ' and  a.salesman  =' . $this->input->post('salesman');
		}
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  a.created_by  =' . $this->input->post('user');
		}
		if($this->input->post('reference')){
            $this->wherecondition = $this->wherecondition . ' and  a.ref_id  =' . $this->input->post('reference');
		}
		if($this->input->post('branch')){
            $this->wherecondition = $this->wherecondition . ' and  sb.branch_id  =' . $this->input->post('branch');
		}
        $this->wherecondition = $this->wherecondition . "  group by a.sales_id";

        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

}
