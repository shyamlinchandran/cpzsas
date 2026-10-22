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
require_once('dataTable.php');

class Itemreg_model extends DataTable {

    //put your code here
    function __construct() {
        parent::__construct();
		$where = '';
		$wheregodown = '';
		if($this->input->post('item_godown') ){
			$where = ' and a.godown = '.$this->input->post('item_godown');
			$wheregodown = ' where c.godown_id = '.$this->input->post('item_godown');
		}
        $this->select = ' img.godown_name,godownopen,a.open_stock as openstock,b.open_stock as stock,a.*,b.*';
        $this->table = 'item_ledger as a inner join item as b on a.item_id =b.id '.$where.' left join ims_godown as img on img.id=a.godown left join (select sum(open_stock) as godownopen,item_id as iid from item_godown as c  '.$wheregodown.' GROUP by item_id
) as d on d.iid=item_id ';
        $this->column_order = array(null, 'name', 'barcode', 'open_stock', 'trans_date'); //set column field database for datatable orderable
        $this->column_search = array('name', 'barcode', 'open_stock', 'trans_date'); //set column field database for datatable searchable 
        $this->order = array('trans_date' => 'asc'); // default order 
    }
        function stocknow() {

        $this->select = 'a.*,b.name as catname';
        $this->table = 'item as a left JOIN item_category as b on a.item_category_id=b.id ';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 

        if ($this->input->post('cid')) {
            $this->wherecondition ="where a.item_category_id = ".$this->input->post('cid');
        }
        
    }
	
	
	function day_stock(){
		$date = $this->getDate($this->input->post('date'));
		$this->select ="godown_name,i.name,il.*,ig.current_stock,u.name as unit,h.hsncode as hsn,t.GST";
		$this->table = "item as i INNER JOIN item_godown as ig on ig.item_id = i.id  inner join ims_godown as g on g.id = ig.godown_id left JOIN (SELECT a.godown,a.item_id,sum(CASE WHEN a.trans_type = 'dt' and a.trans_date <= '".$date."' then a.quantity else 0 end) - sum(CASE WHEN a.trans_type = 'cr' and a.trans_date <= '".$date."' then a.quantity else 0 end) as stock,sum(CASE WHEN a.trans_type = 'dt' and a.trans_date < '".$date."' then a.quantity else 0 end) - sum(CASE WHEN a.trans_type = 'cr' and a.trans_date < '".$date."'   then a.quantity else 0 end) as day_stock,sum(CASE WHEN a.trans_type = 'dt' and a.trans_date = '".$date."'  then a.quantity else 0 end) as stock_in,sum(CASE WHEN a.trans_type = 'cr' and a.trans_date = '".$date."'  then a.quantity else 0 end) as stock_out from item_ledger as a WHERE a.published = 'yes' GROUP by a.item_id,a.godown) as il on ig.item_id = il.item_id and ig.godown_id = il.godown LEFT JOIN units as u on u.id = i.unit_id left JOIN hsncode  as h on h.hsnid = i.hsncode LEFT JOIN taxgst as t on t.gstid = i.tax_id";
		$this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.name'); //set column field database for datatable searchable 
        $this->order = array('i.id' => 'asc'); // default order
		 $this->wherecondition = ' where i.published = "yes" ';
		 if ($this->input->post('gid')) {
            $this->wherecondition =  $this->wherecondition . " and ig.godown_id = ".$this->input->post('gid');
        }
         if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . " and i.id = ".$this->input->post('toid');
        }
		
		if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . " and i.item_category_id = ".$this->input->post('category_id');
        }
		
		if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition ."  and i.brand_id = ".$this->input->post('brand');
        }
		
		$this->having = ' stock > 0 ';
	}



       function godownstock() { 

        $this->select = 'a.name,c.godown_name,b.open_stock+b.current_stock  as item_qty';
        $this->table = 'item as a left JOIN item_godown as b on a.id=b.item_id left JOIN ims_godown as c on c.id=b.godown_id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('a.name','c.godown_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 

        if ($this->input->post('gid')) {
            $this->wherecondition ="where b.godown_id = ".$this->input->post('gid');
        }
         if ($this->input->post('toid')) {
            $this->wherecondition ="where a.id = ".$this->input->post('toid');
        }
        
    } 
	
	function getamount(){
		$where = '';
		if ($this->input->post('startdate')) {
            $where = $where . " and  trans_date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $where = $where . " and  trans_date <='" . $this->getDate($this->input->post('enddate'))."'";
        }		
		$qry = "select sum(case WHEN trans_type ='cr' then quantity else 0 end) as cr, sum(case WHEN trans_type ='dt' then quantity else 0 end) as dt from item_ledger as a inner join item as b on a.item_id =b.id left join (select sum(open_stock) as godownopen,item_id as iid from item_godown as c GROUP by item_id ) as d on d.iid=item_id where a.published ='yes' and  item_id =".$this->input->post('toid')."  ".$where." order by trans_date";
		$cr = 0;
		$dt = 0;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$cr = $query['cr'];
			$dt = $query['dt'];
		}
		$data['cr'] = $cr;
		$data['dt'] = $dt;
		return $data;
	}

    function where() {
        $this->wherecondition = "where a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and  trans_date >='" . $this->getDate($this->input->post('startdate'))."'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and  trans_date <='" . $this->getDate($this->input->post('enddate'))."'";
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  item_id  =' . $this->input->post('toid');
        }
    }

}
