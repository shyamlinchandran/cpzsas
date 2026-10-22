<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Althaf
 */
class Transactions_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
       
    }
	
	function damage()
    {
		$this->select = "a.damage_id,date,invoice,g.godown_name,quantity";
        $this->table = "`damage` as a INNER JOIN item_damage as b on a.damage_id = b.damage_id and a.published='yes' and b.published ='yes' INNER JOIN ims_godown as g on g.id = b.godown_id ";
        $this->column_order = array(null, 'date', 'invoice'); //set column field database for datatable orderable   
        $this->column_search = array(null, 'invoice', 'date');  //set column field database for datatable searchable 
        $this->order = array('date' => 'desc'); // default order 
		$this->wherecondition = ' where b.item_id = '.$this->input->post('item_id').' ';
    }
	
	function stockjournal()
    {
		$this->select = "a.id,date,voucher_no,sum(case WHEN type = 'increase' then quantity else 0 end ) as received ,sum(case WHEN type = 'decrease' then quantity else 0 end ) as issued";
        $this->table = "`stock_journal` as a INNER JOIN stock_journal_items as b on a.id =b.stock_journal_id and a.published='yes' and b.published ='yes'";
        $this->column_order = array(null, 'date', 'voucher_no'); //set column field database for datatable orderable   
        $this->column_search = array(null, 'voucher_no', 'date');  //set column field database for datatable searchable 
        $this->order = array('date' => 'desc'); // default order 
		$this->wherecondition = ' where b.item_id = '.$this->input->post('item_id').' ';
		$this->group = ' a.id';
    }
	
	function man_journal(){
		$item_id = $this->input->post('item_id');
		$qry = "select * from item where id = ".$item_id;
		$query = $this->db->query($qry)->row_array();
		$material_type = $query['material_type'];
		if((float) $material_type  < 2 ){
			$this->select ="a.date,a.voucher_no,b.quantity,c.godown_name,a.id";
			$this->table = "`production_process_main` as a INNER JOIN production_process_products as b on a.id = b.main_id and a.is_available = 'yes' and b.is_available ='yes' INNER JOIN ims_godown as c on c.id = b.godown_id";
			$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
			$this->column_search = array('a.voucher_no', 'godown_name'); //set column field database for datatable searchable 
			$this->order = array('a.id' => 'asc'); // default order 
			$this->wherecondition  =' where b.item_id= '.$item_id;
			if ($this->input->post('startdate')) {
				$this->wherecondition = $this->wherecondition . " and  a.date >='" . $this->getDate($this->input->post('startdate'))."'";
			}
			if ($this->input->post('enddate')) {
				$this->wherecondition = $this->wherecondition . " and  a.date <='" . $this->getDate($this->input->post('enddate'))."'";
			}
		}else{
			$this->select ="a.date,a.voucher_no,b.material_quantity as quantity,c.godown_name,a.id";
			$this->table = "`production_process_main` as a INNER join production_process_material_table as b on a.id =b.main_table_id and a.`is_available`='yes' and b.is_available ='yes' INNER JOIN ims_godown as c on c.id =b.godown_id";
			$this->column_order = array(null, 'a.voucher_no'); //set column field database for datatable orderable
			$this->column_search = array('a.voucher_no', 'godown_name'); //set column field database for datatable searchable 
			$this->order = array('a.id' => 'asc'); // default order 
			$this->wherecondition  =' where b.material_id= '.$item_id;
			if ($this->input->post('startdate')) {
				$this->wherecondition = $this->wherecondition . " and  a.date >='" . $this->getDate($this->input->post('startdate'))."'";
			}
			if ($this->input->post('enddate')) {
				$this->wherecondition = $this->wherecondition . " and  a.date <='" . $this->getDate($this->input->post('enddate'))."'";
			}
		}
		
	}

    function sales()
    {
		$this->select = "s.type,s.sales_id,s.invoice,s.invoice_date,ifnull(su.name,s.cusname) as customer,s.customer_id,si.quantity,u.name as unit,si.mrp,si.total";
        $this->table = "sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and si.published ='yes' and s.published ='yes' left JOIN suppliers as su on su.id = s.customer_id INNER JOIN units as u on u.id = si.unit_id";
        $this->column_order = array(null, 'invoice_date', 'invoice'); //set column field database for datatable orderable   
        $this->column_search = array(null, 'invoice_date', 'invoice');  //set column field database for datatable searchable 
        $this->order = array('s.invoice_date' => 'desc'); // default order 
		$this->wherecondition = ' where si.item_id = '.$this->input->post('item_id').' and s.type="'.$this->input->post('type').'"';
    }
	
	function purchase()
    {
		$this->select = "p.type,p.id,p.invoice,p.date,ifnull(su.name,'') as supplier,p.supplier_id,pi.quantity,u.name as unit,pi.rate,pi.total";
        $this->table = "purchase as p INNER JOIN purchase_items as pi on p.id = pi.purchase_id and pi.published ='yes' and p.published ='yes' left JOIN suppliers as su on su.id = p.supplier_id INNER JOIN units as u on u.id = pi.unit_id";
        $this->column_order = array(null, 'date', 'invoice'); //set column field database for datatable orderable   
        $this->column_search = array(null, 'date', 'invoice');  //set column field database for datatable searchable 
        $this->order = array('p.date' => 'desc'); // default order 
		$this->wherecondition = ' where pi.item_id = '.$this->input->post('item_id').' and p.type="'.$this->input->post('type').'"';
    }
  
}