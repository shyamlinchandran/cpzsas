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
class Hsn_model extends DataTable {
	
	function eway(){
		$this->table = "sales as a left join suppliers as b on b.id=a.customer_id";
		$this->select = " a.*,b.name,b.tin";
		$this->column_order = array('b.name','a.invoice'); //set column field database for datatable orderable
        $this->column_search = array('b.name','a.invoice'); //set column field database for datatable searchable 
        $this->order = array('a.invoice_date' => 'desc'); // default order 
		$this->wherecondition = ' where a.published="yes" and  ewb_no != "" ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
		}
	}
	
	function getinvoice($search){
		$qry = "select a.invoice as label, a.* from sales as a where invoice like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	  function saleshsn(){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$this->table = "sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join (SELECT pi.unit_id,pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT 0 as unit_id,0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes')  as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' inner join taxgst on taxgst.gstid = s.tax_id INNER JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id";
		$this->select = "taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax - s.itm_raw_ces) as beforetax";
		$this->column_order = array('i.name','h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('i.name','h.hsncode'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if($this->input->post('sales_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.sales_id ="' . $this->input->post('sales_id') . '"';
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and sale.type ="' . $this->input->post('saletype') . '"';
		}
		
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('salestype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.saletype = "'.$this->input->post('salestype').'"';
		}
		
		$this->group = 'h.hsnid,s.item_id,s.tax_id';

	}
	

	  function salesexport(){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$this->table = "sales as sale  left join set_billtype as sb on sb.id = sale.bill_type left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join (SELECT CONCAT(sal_itms_id,'-',0) AS unique_id,(total - tax ) / quantity as rate,total-tax as amount ,sal_itms_id,0 as lid,pi.unit_id,pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt,'' as ledgername from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT CONCAT(pl.id,'-',0) AS unique_id,amount as rate,amount,0 as sal_itms_id,pl.id as lid, 0 as unit_id,0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt,al.name as ledgername from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes')  as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' inner join taxgst on taxgst.gstid = s.tax_id left JOIN item as i on i.id =s.item_id and s.published ='yes'  left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id";
		$this->select = "s.rate,s.amount,DATE_FORMAT(invoice_date, '%d-%m-%Y' ) as invoice_date,invoice,sup.name as supname,sup.tin as suptin,sb.type as btype,taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,IFNULL(i.name,ledgername) as name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax - s.itm_raw_ces) as beforetax";
		$this->column_order = array('i.name','h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('i.name','h.hsncode'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if($this->input->post('sales_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.sales_id ="' . $this->input->post('sales_id') . '"';
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and sale.type ="' . $this->input->post('saletype') . '"';
		}
		
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('salestype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.saletype = "'.$this->input->post('salestype').'"';
		}
		
		$this->group = 'unique_id';

	}
	function saleshsn_consoidate(){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$this->table = "sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join (SELECT pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt,pi.unit_id from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT 0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt,0 as unit_id from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes')  as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' inner join taxgst on taxgst.gstid = s.tax_id left JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=s.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id";
		$this->select = "taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax - itm_raw_ces) as beforetax";
		$this->column_order = array('i.name','h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('i.name','h.hsncode'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'desc'); // default order 
		$this->wherecondition = ' where sale.published = "yes"  ';
		if($this->input->post('sales_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.sales_id ="' . $this->input->post('sales_id') . '"';
		}
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and sale.type ="' . $this->input->post('saletype') . '"';
		}
		
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('salestype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.saletype = "'.$this->input->post('salestype').'"';
		}
		
		$this->group = 'h.hsnid,s.tax_id';

	}
	
	
	function purchasehsn(){
		
		$this->table = "purchase as p inner join purchase_items as  pi on pi.purchase_id = p.id and p.published='yes' and pi.published='yes' inner join taxgst on taxgst.gstid = pi.tax_id INNER JOIN item as i on i.id =pi.item_id and p.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=pi.unit_id";
		$this->select = "taxgst.GST as GSTRATE,sum(pi.quantity) as quantity,sum(pi.tax/2) as sgst,u.code,it.name as itemtype,i.name,h.hsncode,sum(pi.total) as total,sum(pi.tax) as tax,sum(pi.total - pi.tax) as beforetax";
		$this->column_order = array('i.name','h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('i.name','h.hsncode'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and p.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and p.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('purtype')){
            $this->wherecondition = $this->wherecondition . ' and p.type ="' . $this->input->post('purtype') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and p.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and p.supplier_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		
		$this->group = 'h.hsnid,pi.item_id,pi.tax_id';

	}

   function hsn(){
		
		$this->table = "sales as sale inner join sales_items as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' INNER JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id";
		$this->select = "sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(s.tax/2) as sgst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax - itm_raw_ces ) as beforetax";
		$this->column_order = array('i.name','h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('i.name','h.hsncode'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'desc'); // default order 
		$this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and sale.type ="' . $this->input->post('saletype') . '"';
		}
		
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and sale.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('salestype') ){
			$this->wherecondition = $this->wherecondition . ' and sale.saletype = "'.$this->input->post('salestype').'"';
		}
		
		$this->group = 'h.hsnid,s.item_id';

	}
	
	function billwise(){
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.itm_raw_ces else 0 end ) as cess',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax-itm_raw_ces else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then 0 else 0 end) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =";
		$qry = $qry . '"1" and a.saletype = "b2c" and a.cess > 0 ';
		$qry = $qry . "then 0 else 0 end) ";
		$qry = $qry . " as taxable',gstid)) as ary FROM `taxgst`";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			if($ary != ''){
				$ary  = $ary  .',';
			}
			$ary = $ary . $item['ary'];
		}

		$is_cigarette_cess = $this->input->post('is_cigarette_cess');
		$txt_join = '';
		$sel_txt = '';
		$sel_txt_union = '';
        $sum_sel = '';
		if($is_cigarette_cess > 0 ){
			$txt_join = ' ,cig_ces_amt+cig_ces_per_amount AS cessamt ';
			$sel_txt = ' sum(cig_ces_amt+cig_ces_per_amount) AS cessamt,';
		    $sel_txt_union = ' 0 as cessamt, ';
            $sum_sel = ' sum(cessamt) as cessamt, ';
		}
		
		//print_r($ary);
		//$ary  = $query['ary'];
        $this->table = 'sales as a left join suppliers as s on s.id=a.customer_id left join state on state.StateID = s.cst inner join (SELECT pi.item_id'.$txt_join.',pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = "yes" UNION ALL SELECT '.$sel_txt_union.'0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = "yes")  as b on a.sales_id=b.sales_id and b.published="yes" and a.published ="yes" left join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode ';
		$this->select = ''.$sum_sel.'IFNULL(state.code,"") as stateCodes,DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,a.published as salepub,a.sales_id,IFNULL(s.tin,"") as tin,a.discount,additional_cess,a.cess as ces_amt,IFNULL(s.tin,0) as custstate,a.total as tot,a.roundoff,a.invoice,s.name as customer,a.invoice_date,h.hsncode,a.type,'.$ary.' ';
		$this->column_order = array('a.invoice','s.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','s.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'asc'); // default order 
        $this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('salestype') ){
            $this->wherecondition = $this->wherecondition . ' and a.saletype ="' . $this->input->post('salestype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		if($this->input->post('btype')){
            $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		
		$this->group = 'a.sales_id';
	}
	
	function daywise(){
		$concat_qry = "SELECT GROUP_CONCAT(concat('sum(taxable',gstid,') as taxables',gstid,',sum(tax',gstid,') as taxes',gstid,',sum(tax',gstid,') as tottaxes',gstid)) as txt FROM `taxgst`";
		$concat_query = $this->db->query($concat_qry)->row_array();
		$concat_where = $concat_query['txt'];
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax - itm_raw_ces else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then 0 else 0 end) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =";
		$qry = $qry . '"1" and a.saletype = "b2c"';
		$qry = $qry . "then b.ces_amt else 0 end) ";
		$qry = $qry . " as taxable',gstid)) as ary FROM `taxgst`";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			if($ary != ''){
				$ary  = $ary  .',';
			}
			$ary = $ary . $item['ary'];
		}
		//print_r($ary);
		//$ary  = $query['ary'];
		$txt_where =  ' where a.published = "yes" ';
		if ($this->input->post('startdate')) {
            $txt_where = $txt_where . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $txt_where = $txt_where . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $txt_where = $txt_where . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('salestype') ){
            $txt_where = $txt_where . ' and a.saletype ="' . $this->input->post('salestype') . '"';
		}
		if($this->input->post('customer_id')){
            $txt_where = $txt_where . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $txt_where = $txt_where . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		if($this->input->post('btype')){
            $txt_where = $txt_where . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
        $this->table = '(select a.sales_id,IFNULL(s.tin,"") as tin,a.discount,additional_cess,a.cess as ces_amt,IFNULL(s.cst,0) as custstate,a.total as tot,a.roundoff,a.invoice,s.name as customer,a.invoice_date,h.hsncode,a.type,'.$ary.' from sales as a left join suppliers as s on s.id=a.customer_id inner join sales_items as b on a.sales_id=b.sales_id and a.published="yes" and b.published="yes" inner join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode '.$txt_where.' group by a.sales_id ) as x ';
		$this->select = 'x.*,sum(additional_cess) as additional,sum(ces_amt) as cesamt,sum(roundoff) as rount,sum(discount) as salediscount,sum(tot) as saletot,'.$concat_where.' ';
		$this->column_order = array('x.invoice_date'); //set column field database for datatable orderable
        $this->column_search = array('x.invoice_date'); //set column field database for datatable searchable 
        $this->order = array('x.invoice_date' => 'asc'); // default order 
        $this->wherecondition = ' where 1 ';
		
		
		$this->group = 'x.invoice_date';
	}
	
	function billwise_purchase(){
		$ary_add = '';
		$qry_add = "SELECT concat('SUM(CASE when pl.tax_id = ',gstid ,' then pl.amount else 0 end ) as pltotal',gstid,',','SUM(CASE when pl.tax_id = ',gstid ,' then pl.tax else 0 end ) as pltax',gstid,',','SUM(CASE when pl.tax_id = ',gstid ,' then pl.amount else 0 end ) - SUM(CASE when pl.tax_id = ',gstid ,' and pl.is_taxincluded = 1 then pl.tax else 0 end )  as pltaxable',gstid)  as ary from taxgst";
		$query = $this->db->query($qry_add)->result_array();
		foreach($query as $item){
			if($ary_add != ''){
				$ary_add  = $ary_add  .',';
			}
			$ary_add = $ary_add . $item['ary'];
		}
		
		
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax-itm_raw_ces else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then 0 else 0 end) ";
		$qry = $qry . " as taxable',gstid)) as ary FROM `taxgst`";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			if($ary != ''){
				$ary  = $ary  .',';
			}
			$ary = $ary . $item['ary'];
		}
        $is_cigarette_cess = $this->input->post('is_cigarette_cess');
		$txt_join = '';
		$sel_txt = '';
		$sel_txt_union = '';
        $sum_sel = '';
		if($is_cigarette_cess > 0 ){
			$txt_join = ' ,cig_ces_amt+cig_ces_per_amount AS cessamt ';
			$sel_txt = ' sum(cig_ces_amt+cig_ces_per_amount) AS cessamt,';
		    $sel_txt_union = ' 0 as cessamt, ';
            $sum_sel = ' sum(cessamt) as cessamt, ';
		}


        $this->table = 'purchase as a left join (SELECT pl.purchase_id as plpurchase_id,'.$ary_add.' from purchase_ledgers as pl WHERE pl.published ="yes" GROUP by pl.purchase_id) as x on x.plpurchase_id = a.id  left join suppliers as s on s.id=a.supplier_id left join purchase_items as b on a.id=b.purchase_id and b.published="yes" left join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode ';
		$this->select = ''.$sel_txt.'x.*,DATE_FORMAT(a.date, "%d/%m/%Y" ) as in_date,a.id,additional_cess,IFNULL(s.tin,"") as tin,a.discount,IFNULL(s.cst,0) as custstate,a.total as tot,a.roundoff,a.invoice,s.name as customer,a.date,h.hsncode,a.type,'.$ary.' ';
		$this->column_order = array('a.invoice','s.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','s.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->wherecondition = ' where a.published = "yes" ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('purtype') . '"';
		}
		
		if($this->input->post('purtype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('purtype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.supplier_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		if($this->input->post('btype')){
            $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		
		$this->group = 'a.id';
	}

   function where(){
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.quantity else 0 end ) as quantity',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax-itm_raw_ces else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then 0 else 0 end) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =";
		$qry = $qry . '"1" and a.saletype = "b2c" and a.cess > 0 ';
		$qry = $qry . "then b.ces_amt else 0 end) ";
		$qry = $qry . " as taxable',gstid)) as ary FROM `taxgst`";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			if($ary != ''){
				$ary  = $ary  .',';
			}
			$ary = $ary . $item['ary'];
		}
        $this->table = 'sales as a left join suppliers as s on s.id=a.customer_id inner join sales_items as b on a.sales_id=b.sales_id and a.published="yes" and b.published="yes" inner join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode ';
		$this->select = 'sum(b.quantity) as hsnqty,DATE_FORMAT(a.invoice_date, "%d/%m/%Y" ) as in_date,s.tin as cusgstin,IFNULL(s.tin,0) as custstate,invoice_date,sum(b.total) as tot,a.invoice,s.name,a.invoice_date,h.hsncode,a.type,'.$ary.' ';
		$this->column_order = array('a.invoice','s.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','s.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
        $this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		if($this->input->post('btype') ){
			$this->wherecondition = $this->wherecondition . ' and a.bill_type = "'.$this->input->post('btype').'"';
		}
		if($this->input->post('salestype') ){
			$this->wherecondition = $this->wherecondition . ' and a.saletype = "'.$this->input->post('salestype').'"';
		}
		
		$this->group = 'h.hsncode,a.invoice';

  }
  
     function where_hsn(){
		$where = '';
		if($this->input->post('startdate') ){
			$where = $where . ' and invoice_date >= "'.$this->getDate($this->input->post('startdate')).'"';
		}
		if($this->input->post('enddate') ){
			$where = $where . ' and invoice_date <= "'.$this->getDate($this->input->post('enddate')).'"';
		}
		if($this->input->post('saletype') ){
			$where = $where . ' and saletype = "'.$this->input->post('saletype').'"';
		}
		if($this->input->post('hsn') ){
			$where = $where . ' and i.hsncode = "'.$this->input->post('hsn').'"';
		}
		
		$company = $this->hsn->getCompany();
		$com_state = substr($company['tin'],0,2);
        $this->table = "(SELECT case when is_taxincluded ='1' and saletype = 'b2c' then ces_amt else 0 end as kfc,si.total - si.tax - si.itm_raw_ces  - case WHEN s.saletype  ='b2c' and si.is_taxincluded = '1' then ces_amt else 0 end as taxable ,".$com_state." as company_tin,case when c.tin !='' then SUBSTR(IFNULL(c.tin,".$com_state."), 1, 2) else ".$com_state." end as customer_tin,IFNULL(hsnid,0) as hsnid,IFNULL(h.hsncode,'Nil') as hsn,si.quantity,si.total,si.tax,IFNULL(c.tin,'') as cusgst,si.itm_raw_ces,si.ces_amt,si.base_quantity,saletype,si.is_taxincluded from sales as s LEFT JOIN suppliers as c on c.id = s.customer_id and s.published ='yes' INNER JOIN sales_items as si on s.type = 'sales' and si.sales_id = s.sales_id and si.published ='yes' and s.published ='yes' INNER JOIN item as i on i.id = si.item_id left JOIN hsncode as h on h.hsnid = i.hsncode where 1 ".$where." ) as x  ";
		$this->select = " sum(IFNULL(kfc,0)) as kfc,sum(IFNULL(itm_raw_ces,0)) as itm_raw_ces,sum(total) as total,hsn,hsnid,sum(quantity) as quantity,sum(case WHEN customer_tin = company_tin then taxable else 0 end ) as taxable,sum(case WHEN customer_tin = company_tin then tax else 0 end ) as tax,sum(case WHEN customer_tin != company_tin then taxable else 0 end ) as taxable_igst,sum(case WHEN customer_tin != company_tin then tax else 0 end ) as tax_igst ";
		$this->column_order = array('hsn'); //set column field database for datatable orderable
        $this->column_search = array('hsn'); //set column field database for datatable searchable 
        $this->order = array('hsn' => 'asc'); // default order 
		$this->group = 'hsnid';

  }

}
