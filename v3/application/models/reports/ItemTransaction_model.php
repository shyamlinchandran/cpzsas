<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of itemreg_model
 *
 * @author jijodileep
 */
//require_once('dataTable.php');

class ItemTransaction_model extends DataTable {

    //put your code here
    function __construct() {
        parent::__construct();
        $this->select = 'a.barcode,GST,a.tax_id,open_stk_rate,IFNULL(crqty,0) as credit,IFNULL(dtqty,0) as debit,open_stk_rate, a.srate as salerate,case when a.prate<1 then a.open_stk_rate else a.prate end as purchaserate, a.MRP,a.name as item,c.godown_name as godown,d.name as unit,e.hsncode as hsn,c.id,b.item_id,b.open_stock as stock,b.current_stock,b.open_stock+b.current_stock as quantity';
        $this->table = 'item as a left join taxgst as tax on tax.gstid=a.tax_id LEFT JOIN  item_godown as b on a.id=b.item_id LEFT JOIN ims_godown as c on c.id=b.godown_id left JOIN units as d on d.id=a.unit_id left JOIN hsncode as e on e.hsnid=a.hsncode left join (SELECT z.item_id,sum(case when z.trans_type="cr" then z.quantity else 0 end) as crqty,sum(case when z.trans_type="dt" then z.quantity else 0 end) as dtqty,z.godown FROM item_ledger as z WHERE z.published="yes" and  z.trans_date<="'.$this->getDate($this->input->post('date')).'" GROUP by z.item_id,z.godown) as credit on credit.item_id=a.id and credit.godown=c.id';
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'a.barcode', 'c.godown_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
    }
	
	function physical_stk_update(){
		$this->select = "psu.*,i.name,i.barcode,x.open_stock,case when psui.type= 'dt' then psui.quantity else 0 end as Increase,case when psui.type= 'cr' then psui.quantity else 0 end as Decrease,x.stock,g.godown_name";
		$this->table = "`physical_stk_update_items` as psui INNER JOIN physical_stk_update as psu on psui.phy_stk_upd_id = psu.id INNER JOIN item as i on i.id = psui.item_id and psui.quantity > 0 INNER JOIN ims_godown as g on g.id = psui.godown_id INNER JOIN (select ig.open_stock,ig.current_stock,ig.open_stock+ig.current_stock as stock,ig.godown_id,ig.item_id from item_godown as ig GROUP by ig.godown_id , ig.item_id) as x on x.godown_id = psui.godown_id and x.item_id =psui.item_id";
		$this->column_order = array(null, 'i.name','psu.voucher_no','psu.voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('i.name', 'voucher_no', 'godown_name'); //set column field database for datatable searchable 
        $this->order = array('psu.id' => 'asc'); // default order 
		$this->wherecondition = "where psu.published ='yes' ";
		if ($this->input->post('startdate')) {
			$this->wherecondition = $this->wherecondition  . " and voucher_date >='" . $this->getDate($this->input->post('startdate'))."' ";
		}
		if ($this->input->post('enddate')) {
			$this->wherecondition = $this->wherecondition  . " and voucher_date <='" . $this->getDate($this->input->post('enddate'))."' ";
		}
		if ($this->input->post('toid')) {
			$this->wherecondition = $this->wherecondition  . " and i.id ='" .$this->input->post('toid')."' ";
		}
	}
	function stock_movement(){
		$txt = '';
		$txt_open = '';
		if ($this->input->post('startdate')) {
			$txt_open = "  trans_date < '" . $this->getDate($this->input->post('startdate'))."' and ";
			$txt = $txt . "   trans_date >='" . $this->getDate($this->input->post('startdate'))."'";
        }else{
			$txt_open = "  trans_date != trans_date and ";
		}
        if ($this->input->post('enddate')) {
			if($txt != ''){
				$txt = $txt . " and ";
			}
			$txt = $txt . "   trans_date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
		$this->select ="IFNULL(stock,0) as stock,IFNULL(god.open_stock,0) + IFNULL(open,0) as itemopen,IFNULL(god.open_stock,0) as open_stock,i.name,i.barcode,i.part_no1,i.part_no2,IFNULL(open,0) as open,IFNULL(mjissue,0) as mjissue,IFNULL(mjrec,0) as mjrec,IFNULL(sjissue,0) as sjissue,IFNULL(sjrec,0) as sjrec,IFNULL(purchase_return,0) as purchase_return,IFNULL(purchase,0) as purchase,IFNULL(sales,0) as sales,IFNULL(sreturn,0) as sreturn,IFNULL(damage,0) as damage";
		$this->table = "item as i left join (SELECT li.item_id,SUM(CASE WHEN ".$txt_open."  trans_type = 'dt' then quantity else 0 end) - SUM(CASE WHEN ".$txt_open."  trans_type = 'cr' then quantity else 0 end) as open,SUM(CASE WHEN ".$txt." and trans_status = 'man_journal' and trans_type='cr' then quantity else 0 end) as mjissue,SUM(CASE WHEN ".$txt." and trans_status = 'man_journal' and trans_type='dt' then quantity else 0 end) as mjrec,SUM(CASE WHEN ".$txt." and trans_status = 'stock_journal' and trans_type='cr' then quantity else 0 end) as sjissue,SUM(CASE WHEN ".$txt." and trans_status = 'stock_journal' and trans_type='dt' then quantity else 0 end) as sjrec,SUM(CASE WHEN ".$txt." and trans_status ='purchase_return' then quantity else 0 end) as purchase_return,SUM(CASE WHEN ".$txt." and trans_status ='purchase' then quantity else 0 end) as purchase,SUM(CASE WHEN ".$txt." and trans_status ='sales' then quantity else 0 end) as sales,SUM(CASE WHEN ".$txt." and trans_status ='sales_return' then quantity else 0 end) as sreturn,SUM(case WHEN trans_status='damage' then quantity else 0 end) as damage from item_ledger as li WHERE li.published ='yes' GROUP by li.item_id) as led on led.item_id = i.id left join (SELECT ig.item_id,sum(open_stock) as open_stock,sum(open_stock) + sum(current_stock) as stock from item_godown as ig GROUP by ig.item_id ) as god on god.item_id = i.id";
		$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('i.name'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'asc'); // default order 
		
		
	}
	

    function where() {
        $this->wherecondition = "where a.published ='yes'";
        if ($this->input->post('godown')) {
            $this->wherecondition = $this->wherecondition . ' and b.godown_id =' . $this->input->post('godown');
        }
        if ($this->input->post('hsn')) {
            $this->wherecondition = $this->wherecondition . ' and a.hsncode =' . $this->input->post('hsn');
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_category_id =' . $this->input->post('category');
        }
		 if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and a.id =' . $this->input->post('toid');
        }
        if ($this->input->post('tax')) {
            $this->wherecondition = $this->wherecondition . ' and a.tax_id  =' . $this->input->post('tax');
        }
		if( $this->input->post('item_status') ){
			if( $this->input->post('item_status') == 'movable' ){
				$this->wherecondition = $this->wherecondition .' and ( IFNULL(crqty,0) > 0 or IFNULL(dtqty,0) >0 ) ';
			}
			if( $this->input->post('item_status') == 'not_movable' ){
				$this->wherecondition = $this->wherecondition .' and ( IFNULL(crqty,0) < 1 and IFNULL(dtqty,0) < 1 ) ';
			}
			if( $this->input->post('item_status') == 'zero_stock' ){
				$this->wherecondition = $this->wherecondition .' and  b.open_stock + IFNULL(dtqty,0) - IFNULL(crqty,0) = 0';
			}
			if( $this->input->post('item_status') == 'minus_stock' ){
				$this->wherecondition = $this->wherecondition .' and  b.open_stock + IFNULL(dtqty,0) - IFNULL(crqty,0) < 0';
			}
		}
		
    }
	
	function stock_journal(){
		$this->select ="a.id,c.name,a.voucher_no,a.date,b.quantity,case WHEN b.type = 'increase' then 'received' else 'issued' end as type ,g.godown_name,b.srate,b.prate,b.stock_value";
		$this->table = "stock_journal as a inner JOIN stock_journal_items as b on a.id = b.stock_journal_id and b.published ='yes' and a.published ='yes' inner JOIN item as c on c.id = b.item_id left JOIN ims_godown as g on g.id = b.godown_id";
		$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'godown_name','c.name','c.barcode'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
		$this->wherecondition  =' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
		if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . " and  b.type ='" . $this->input->post('type')."'";
        }
		if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . " and  b.item_id <='" . $this->input->post('toid')."'";
        }
	}
	
	function man_journal(){
		$this->select ="a.date,a.voucher_no,b.quantity,c.godown_name,a.id";
		$this->table = "`production_process_main` as a INNER JOIN production_process_products as b on a.id = b.main_id and a.is_available = 'yes' and b.is_available ='yes' INNER JOIN ims_godown as c on c.id = b.godown_id";
		$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'godown_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
		$this->wherecondition  =' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
		
	}
	
	function godown_transfer(){
		$this->select ="a.id,u.name as unit,i.name,a.invoice,a.date,g.godown_name as from_godown,b.qty,ig.godown_name as to_godown";
		$this->table = "item_transfer as a INNER JOIN item_transfer_sub as b on a.id = b.transfer_id and a.published ='yes' and b.published ='yes' INNER JOIN item as i on i.id = b.item_id INNER JOIN ims_godown as g on g.id = a.from_id  INNER JOIN ims_godown as ig on ig.id = b.to_id left join units as u on u.id = b.unit_id";
		$this->column_order = array(null, 'a.invoice'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'g.godown_name','ig.godown_name','i.barcode','i.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
		$this->wherecondition  =' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and  a.date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
		if ($this->input->post('from_godown')) {
            $this->wherecondition = $this->wherecondition . " and  a.from_id ='" . $this->input->post('from_godown')."'";
        }
		if ($this->input->post('to_godown')) {
            $this->wherecondition = $this->wherecondition . " and  b.to_id ='" . $this->input->post('to_godown')."'";
        }
		if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . " and  b.item_id ='" . $this->input->post('toid')."'";
        }

	}
}
