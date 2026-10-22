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
class purchasereport_model extends DataTable {

    function getType() {
        $qry = 'select * from item_group';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function where() {
        $company = $this->getCompany();
		$com_state = substr($company['tin'],0,2);


        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        $is_cigarette_cess = $this->input->post('is_cigarette_cess');
		$txt_join = '';
		$sel_txt = '';
		$sel_txt_union = '';
        $sum_sel = '';
		if($is_cigarette_cess > 0 ){
			$txt_join = ' ,cig_ces_amt+cig_ces_per_amount AS cessamt ';
			$sel_txt = ' cessamt,';
		    $sel_txt_union = ' 0 as cessamt, ';
            $sum_sel = ' sum(cessamt) as cessamt, ';
		}
        $this->select = ''.$sel_txt.'cu.user_name as createduser, DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,c.type as ptype, a.*,c.*,Ptotal,ptax';
      //  $this->table = 'purchase as c left join (SELECT SUM(total)  as Ptotal,SUM(tax) AS Ptax,purchase_id from purchase_items WHERE  published ="yes" GROUP BY purchase_id) as x on x.purchase_id = c.id inner join suppliers as a on a.id=c.supplier_id left join users as cu on cu.id=c.created_by';
        //SELECT a.id,a.purchase_id,a.quantity,a.tax_id,a.tax AS ptax,a.total AS Ptotal,a.unit_id,a.base_unit_id,a.item_id,published FROM purchase_items a  WHERE a.published ='yes' UNION All SELECT a.id,a.purchase_id,1 as quantity,a.tax_id,a.tax AS ptax,a.amount AS Ptotal,0 as unit_id,0 base_unit_id,a.ledger_id,published  FROM purchase_ledgers a 
        $this->table = 'purchase as c left join (select '.$sum_sel.'purchase_id,SUM(Ptotal) AS Ptotal,SUM(ptax) AS ptax FROM( SELECT a.id,a.purchase_id,a.quantity,a.tax_id,a.tax AS ptax,a.total AS Ptotal,a.unit_id,a.base_unit_id,a.item_id,published'.$txt_join.' FROM purchase_items a  WHERE a.published ="yes" UNION All SELECT '.$sel_txt_union.'a.id,a.purchase_id,1 as quantity,a.tax_id,a.tax AS ptax,a.amount AS Ptotal,0 as unit_id,0 base_unit_id,a.ledger_id,published  FROM purchase_ledgers a WHERE a.published ="yes" 
) AS a GROUP BY purchase_id) as x on x.purchase_id = c.id inner join suppliers as a on a.id=c.supplier_id left join users as cu on cu.id=c.created_by';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'email', 'phone', 'name'); //set column field database for datatable searchable 
        $this->order = array('c.date' => 'asc'); // default order 

        $this->wherecondition = " where c.published ='yes'  ";
        if ($this->input->post('purtype')) {
            $this->wherecondition = $this->wherecondition . " and c.type ='" . $this->input->post('purtype') . "'";
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  c.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and c.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and c.supplier_id ="' . $this->input->post('supid') . '"';
        }

        if ($this->input->post('gst_type')) {
            if($this->input->post('gst_type') == 'Inter State'){
            $this->wherecondition = $this->wherecondition . " and SUBSTRING(a.tin, 1, 2) = '" . $com_state . "'";
            }else{
            $this->wherecondition = $this->wherecondition . " and SUBSTRING(a.tin, 1, 2) != '" . $com_state . "'";
            }
        }

    }

    function wherecategory() {
        $category = $this->input->post('category');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'purchase as s inner join purchase_items as a on s.id =a.purchase_id  inner join item as b on a.item_id=b.id inner join item_category as c on c.id = b.item_category_id ';
        $this->select = 'b.name as item,c.name,sum(quantity) as quantity';
        $this->column_order = array(null, 'b.name', 'c.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name', 'c.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and s.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('group')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('group') . '"';
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_category_id ="' . $this->input->post('category') . '"';
        }
        $this->wherecondition = $this->wherecondition . 'group by c.id,b.id';
    }

    function purchase_barcode() {
        $this->table = 'purchase_items_barcode as a left join suppliers as sup on sup.id = a.customer_id inner join item as i on i.id = a.item_id left join sales as b on a.sales_id = b.sales_id ';
        $this->select = 'a.barcode,i.barcode as ibarcode,i.name,sup.name as supname,b.invoice ';
        $this->column_order = array(null, 'i.name', 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.name', 'i.name'); //set column field database for datatable searchable 
        $this->order = array('a.date' => 'desc'); // default order 

        $this->wherecondition = " where is_deleted =0 ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_id ="' . $this->input->post('item_id') . '"';
        }
    }



}
