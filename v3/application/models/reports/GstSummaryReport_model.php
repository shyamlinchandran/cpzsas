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
class GstSummaryReport_model extends DataTable {

   public function tax_details(){
		$qry = "select * from taxgst as a";
		$tax_details = $this->db->query($qry)->result_array();
		return $tax_details;
   }
   
   public function getpurchase_data($comset_statecode){
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$txt_where = '';
		if($this->input->post('startdate')){
			$txt_where = " and date >= '".$this->getDate($startdate)."' ";
		}
		
		if($this->input->post('enddate')){
			$txt_where = $txt_where . " and date <= '".$this->getDate($enddate)."' ";
		}
		$qry = "SELECT tax_id,sum(total) -sum(tax+itm_raw_ces) as beforetax ,sum(tax) as tax,sum(itm_raw_ces) as cess,sum(total) as total,state,ptype as stype from (SELECT IFNULL(s.statecode,45) as state,b.*,a.date,a.type as ptype FROM purchase as a INNER JOIN purchase_items as b on a.id = b.purchase_id and a.published ='yes' and b.published ='yes' and a.type != 'order' LEFT JOIN (SELECT sup.*,CASE WHEN sup.cst = '' or sup.cst is null or sup.cst = 0 or sup.cst ='0' then 45 else sup.cst end as statecode from suppliers as sup ) as s on s.id = a.supplier_id) as x  where x.state = '".$comset_statecode."' ".$txt_where."  GROUP by tax_id,ptype";
		$result = $this->db->query($qry)->result_array();
		return $result;
 }
 
  public function getpurchaseIgst_data($comset_statecode){
			$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$txt_where = '';
		if($this->input->post('startdate')){
			$txt_where = " and date >= '".$this->getDate($startdate)."' ";
		}
		
		if($this->input->post('enddate')){
			$txt_where = $txt_where ." and date <= '".$this->getDate($enddate)."' ";
		}
		$qry = "SELECT tax_id,sum(total) -sum(tax+itm_raw_ces) as beforetax ,sum(tax) as tax,sum(itm_raw_ces) as cess,sum(total) as total,state,ptype as stype from (SELECT IFNULL(s.statecode,45) as state,b.*,a.date,a.type as ptype FROM purchase as a INNER JOIN purchase_items as b on a.id = b.purchase_id and a.published ='yes' and b.published ='yes' and a.type != 'order' LEFT JOIN (SELECT sup.*,CASE WHEN sup.cst = '' or sup.cst is null or sup.cst = 0 or sup.cst ='0' then 45 else sup.cst end as statecode from suppliers as sup ) as s on s.id = a.supplier_id) as x  where x.state != '".$comset_statecode."' ".$txt_where." GROUP by tax_id,ptype";
	   $result = $this->db->query($qry)->result_array();
		return $result;
 }
	
	public function getsales_data($comset_statecode){
		$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$txt_where = '';
		if($this->input->post('startdate')){
			$txt_where = " and invoice_date >= '".$this->getDate($startdate)."' ";
		}
		
		if($this->input->post('enddate')){
			$txt_where = $txt_where ." and invoice_date <= '".$this->getDate($enddate)."' ";
		}
		$qry = "select  stype,sum(total) - sum(tax+itm_raw_ces) as beforetax,sum(total) as total,sum(itm_raw_ces) as cess,sum(x.tax) as tax,state,tax_id,invoice,customer_id from (SELECT  a.customer_id,a.invoice,IFNULL(s.statecode,45) as state,b.*,a.type as stype from sales as a INNER JOIN sales_items as b on a.sales_id = b.sales_id and a.published ='yes' and b.published ='yes' ".$txt_where." LEFT JOIN (SELECT sup.*,CASE WHEN sup.cst = '' or sup.cst is null or sup.cst = 0 or sup.cst ='0' then 45 else sup.cst end as statecode from suppliers as sup ) as s on s.id = a.customer_id) as x where x.state = '".$comset_statecode."'  GROUP by state,tax_id,stype";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}


	public function getsalesIGST_data($comset_statecode){
	$startdate = $this->input->post('startdate');
		$enddate = $this->input->post('enddate');
		$txt_where = '';
		if($this->input->post('startdate')){
			$txt_where = " and invoice_date >= '".$this->getDate($startdate)."' ";
		}
		
		if($this->input->post('enddate')){
			$txt_where = $txt_where ." and invoice_date <= '".$this->getDate($enddate)."' ";
		}
		$qry = "select  stype,sum(total) - sum(tax+itm_raw_ces) as beforetax,sum(total) as total,sum(itm_raw_ces) as cess,sum(x.tax) as tax,state,tax_id,invoice,customer_id from (SELECT  a.customer_id,a.invoice,IFNULL(s.statecode,45) as state,b.*,a.type as stype from sales as a INNER JOIN sales_items as b on a.sales_id = b.sales_id and a.published ='yes' and b.published ='yes' ".$txt_where." LEFT JOIN (SELECT sup.*,CASE WHEN sup.cst = '' or sup.cst is null or sup.cst = 0 or sup.cst ='0' then 45 else sup.cst end as statecode from suppliers as sup ) as s on s.id = a.customer_id) as x where x.state != '".$comset_statecode."'  GROUP by tax_id,stype";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}

   

}
