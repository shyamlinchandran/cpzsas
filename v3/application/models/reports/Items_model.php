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

class Items_model extends DataTable {

    //put your code here
    function __construct() {
        parent::__construct();
		 
    }

	function batch_stock(){
		$this->select ="batch,i.name,SUM(case when TYPE IN( 'sales','purchase_return') then quantity ELSE 0 END) AS quantity_cr ,SUM(case when TYPE IN( 'sales_return','purchase') then quantity ELSE 0 END) AS quantity_dr ,SUM(case when TYPE IN( 'sales','purchase_return') then SQFTNO ELSE 0 END) AS nos_cr ,SUM(case when TYPE IN( 'sales_return','purchase') then SQFTNO ELSE 0 END) AS nos_dr";
		$this->table = "(SELECT * FROM (SELECT type,a.invoice_date ,invoice,a.customer_id,sales_id FROM sales a WHERE TYPE IN('sales','sales_return') AND published ='yes') AS sales INNER JOIN (SELECT sales_id AS salesid,item_id,si.quantity,si.SQFTNO,si.ItemSQFT,si.batch  FROM sales_items AS si WHERE si.published ='yes' ) AS si ON si.salesid = sales_id  UNION ALL SELECT * FROM (SELECT type,a.date invoice_date,a.invoice,a.supplier_id AS customer_id,id  FROM purchase a WHERE a.type IN ('purchase','purchase_return') AND published ='yes' ) AS p INNER JOIN (SELECT purchase_id ,item_id,si.quantity,si.SQFTNO,si.ItemSQFT,si.batch  FROM purchase_items AS si WHERE si.published ='yes') AS si ON si.purchase_id = id) AS al INNER JOIN item AS i ON i.id = item_id ";
		$this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.name', 'i.barcode', 'batch'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'asc'); // default order 
		$this->group = ' i.id,batch ';

	}


	public function export_report_list(){
		$this->select ='db_download.*,DATE_FORMAT(CONVERT_TZ(createdtime,"+00:00","+05:30"),"%d/%m/%Y %H:%i:%S ") as createdat';
		$this->table = "db_download";
		$this->column_order = array(null, 'createdtime','type','status',null); //set column field database for datatable orderable
        $this->column_search = array('createdtime', 'type', 'status'); //set column field database for datatable searchable 
        $this->order = array('createdtime' => 'desc'); // default order
		$this->wherecondition = " where 1 ";
		if($this->input->post('status')){
			$this->wherecondition = $this->wherecondition .' and status = "'.$this->input->post('status').'" ';
		}
		if($this->input->post('type')){
			$this->wherecondition = $this->wherecondition .' and type = "'.$this->input->post('type').'" ';
		}
	}
    function where() {

	$settings = $this->getCompanySettings();
		$is_batch = 0 ;
		if(isset($settings[0]['is_batch'])){
			$is_batch = $settings[0]['is_batch'];
		}
		$txt_sel = 'a.name as itemname';
		$where = '';
		if($is_batch > 0 ){
			$txt_sel = 'concat(a.name," - ","<b>",IFNULL(b.batch,""),"</b>") as itemname';
		}
        
        $target_date = $this->input->post('date') ? $this->getDate($this->input->post('date')) : '2030-01-01';
        // Join item_ledger once in a grouped subquery instead of running 10,000 slow subqueries!
        $item_status = $this->input->post('item_status');
        $ledger_join = '';
        if ($item_status) {
            $batch_select = ($is_batch > 0) ? ', batch' : '';
            $batch_group = ($is_batch > 0) ? ', batch' : '';
            $batch_join = ($is_batch > 0) ? ' AND l.batch = b.batch ' : '';
            
            $ledger_join = ' LEFT JOIN (
                SELECT item_id, godown' . $batch_select . ',
                       SUM(CASE WHEN trans_type = "dt" THEN quantity ELSE 0.00 END) as debit,
                       SUM(CASE WHEN trans_type = "cr" THEN quantity ELSE 0.00 END) as credit
                FROM item_ledger
                WHERE published = "yes" AND trans_date <= "' . $target_date . '"
                GROUP BY item_id, godown' . $batch_group . '
            ) as l ON l.item_id = a.id AND l.godown = c.id' . $batch_join;
            
            $credit_sub = 'IFNULL(l.credit, 0)';
            $debit_sub  = 'IFNULL(l.debit, 0)';
        } else {
            $credit_sub = '0';
            $debit_sub  = '0';
        }

        $batch_select = ($is_batch > 0) ? 'batch' : '"" as batch';
        $batch_group = ($is_batch > 0) ? ', batch' : '';

        $b_subquery = '(
            SELECT godown_id, item_id, SUM(open_stock) as open_stock, SUM(current_stock) as current_stock, ' . $batch_select . ' 
            FROM item_godown
            GROUP BY godown_id, item_id' . $batch_group . '
        )';

        $this->select = ''.$txt_sel .',a.barcode,b.batch,GST,a.tax_id,open_stk_rate, '.$credit_sub.' as credit, '.$debit_sub.' as debit, open_stk_rate, a.srate as salerate,case when a.prate = 0 or a.prate is null  then a.open_stk_rate else a.prate end as purchaserate, a.MRP,a.name as item,c.godown_name as godown,d.name as unit,e.hsncode as hsn,c.id,b.item_id,IFNULL(b.open_stock, 0) as stock,b.current_stock,IFNULL(b.open_stock, 0)+IFNULL(b.current_stock, 0) as quantity';
        $this->table = '(select id,name,prate,srate,MRP,tax_id,unit_id,hsncode,item_category_id,brand_id,material_type,open_stk_rate,barcode,published FROM item a where published = "yes") as a left join taxgst as tax on tax.gstid=a.tax_id LEFT JOIN ' . $b_subquery . ' as b on a.id=b.item_id '.$where.' LEFT JOIN ims_godown as c on c.id=b.godown_id left JOIN units as d on d.id=a.unit_id left JOIN hsncode as e on e.hsnid=a.hsncode' . $ledger_join;
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'a.barcode', 'c.godown_name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order

        $this->wherecondition = "where a.published ='yes' ";
        if ($this->input->post('godown')) {
            $this->wherecondition = $this->wherecondition . ' and b.godown_id =' . $this->input->post('godown');
        }
        if ($this->input->post('hsn')) {
            $this->wherecondition = $this->wherecondition . ' and a.hsncode =' . $this->input->post('hsn');
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and a.item_category_id =' . $this->input->post('category');
        }
		if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and a.brand_id =' . $this->input->post('brand');
        }
		 if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and a.id =' . $this->input->post('toid');
        }
        if ($this->input->post('tax')) {
            $this->wherecondition = $this->wherecondition . ' and a.tax_id  =' . $this->input->post('tax');
        }
		 if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and a.material_type  =' . $this->input->post('material_type');
        }
        
		if( $this->input->post('item_status') ){
			if( $this->input->post('item_status') == 'movable' ){
				$this->having = ' (debit > 0 or credit > 0) ';
			}
			if( $this->input->post('item_status') == 'not_movable' ){
				$this->having = ' debit < 1 and credit < 1 ';
			}
			if( $this->input->post('item_status') == 'zero_stock' ){
				$this->having = ' stock + debit - credit = 0';
			}
			if( $this->input->post('item_status') == 'minus_stock' ){
				$this->having = ' stock + debit - credit < 0';
			}
			if( $this->input->post('item_status') == 'with_stock' ){
				$this->having = ' stock + debit - credit > 0';
			}
		}
    }
	
	function fifo_lifo(){
		if($this->input->post('status') == 'fifo' ){
			$this->table = "item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (min(case when il.trans_date >= '".$this->getDate($this->input->post('startdate'))."' and il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '2050-03-11' end)) like'%2050-03-11%' then max(case when il.trans_date < '".$this->getDate($this->input->post('startdate'))."'  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else min(case when il.trans_date >= '".$this->getDate($this->input->post('startdate'))."' and il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id";
		}else if($this->input->post('status') == 'lifo' ){
			$this->table = "item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when il.trans_date >= '".$this->getDate($this->input->post('startdate'))."' and il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < '".$this->getDate($this->input->post('startdate'))."'  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when il.trans_date >= '".$this->getDate($this->input->post('startdate'))."' and il.trans_date <= '".$this->getDate($this->input->post('enddate'))."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id";
		}
		if($this->input->post('status') != 'avg' ){
			$this->select ="CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp";
			$this->column_order = array('i.name','i.barcode'); //set column field database for datatable orderable
			$this->column_search = array('i.name'); //set column field database for datatable searchable 
			$this->order = array('i.name' => 'asc'); // default order 
			$this->wherecondition = " where i.published ='yes'";
		}
		if($this->input->post('status') == 'avg' ){
			$this->table = "item as i left JOIN (select sum(ig.open_stock) as open,ig.item_id from item_godown  as ig GROUP by ig.item_id) as g on g.item_id = i.id left JOIN(select sum(case when il.trans_date <= '2021-03-17' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '2021-03-12' and il.trans_type ='cr' then il.rate else 0 end) as Stock,il.item_id,avg(case when il.trans_type='dt' and il.trans_status='purchase' then il.rate else null end) as rate from item_ledger as il WHERE il.published ='yes' GROUP by il.item_id) as x on x.item_id = i.id";
			$this->select = "i.published,i.id,IFNULL(x.rate,i.prate) as rate,IFNULL(x.stock,0) as stock,i.name,i.barcode,ifnull(g.open,0) as open";
			$this->wherecondition = " where i.published ='yes'";
			$this->column_order = array('i.name','i.barcode'); //set column field database for datatable orderable
			$this->column_search = array('i.name'); //set column field database for datatable searchable 
			$this->order = array('i.name' => 'asc'); // default order 
			
		}
	}

	function unit_stock(){
		$this->table = " item as a INNER JOIN item_godown as b on a.id=b.item_id inner join units as c on c.id=a.unit_id";
		$this->select = "sub_unit_one,sub_unit_two,a.unit_id,c.name as code,a.name,a.barcode,sum(b.current_stock+b.open_stock) as stock";
		$this->column_order = array('a.name'); //set column field database for datatable orderable
		$this->column_search = array('a.name'); //set column field database for datatable searchable 
		$this->order = array('a.name' => 'asc'); // default order 
		$this->group = ' a.id ';
		$this->wherecondition = " where a.published ='yes'";
		if($this->input->post('toid')){
			 $this->wherecondition = $this->wherecondition .' and  a.id = '.$this->input->post('toid');
		}
		if($this->input->post('hsnid')){
			 $this->wherecondition = $this->wherecondition .' and  a.hsncode = '.$this->input->post('hsnid');
		}
		if($this->input->post('category_id')){
			 $this->wherecondition = $this->wherecondition .' and  a.item_category_id = '.$this->input->post('category_id');
		}
		if($this->input->post('brand')){
			 $this->wherecondition = $this->wherecondition .' and  a.brand_id = '.$this->input->post('brand');

		}
		
	}
	
	function order_items(){
		$text = " and s.type='estimate' ";
		if($this->input->post('type')){
			$text = " and s.type='".$this->input->post('type')."' ";
		}
		$startdate = $this->input->post('startdate');
		$enddate =  $this->input->post('enddate');
		$area = $this->input->post('area');
		$route = $this->input->post('route');
        $this->select = 'i.unit_id,sub_unit_one,sub_unit_two,u.code,i.name,sum(si.base_quantity) as quantity';
		$this->table = " sales as s INNER JOIN sales_items as si on s.sales_id =si.sales_id and s.published ='yes' and si.published ='yes' ".$text." left JOIN suppliers as cus on cus.id =s.customer_id INNER JOIN item as i on i.id =si.item_id INNER JOIN units as u on u.id =si.unit_id " ;
		 $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array( 'i.name'); //set column field database for datatable searchable 
        $this->order = array( 'i.name' => 'asc'); // default order 
		$this->group = 'si.item_id';
		$this->wherecondition = " where si.published ='yes'";
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if ($this->input->post('customer_id')) {
            $this->wherecondition = $this->wherecondition . ' and s.customer_id ="' . $this->input->post('customer_id') . '"';
			}
         if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  s.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
        }
	}

    public function count_filtered() {
        $old_select = $this->select;
        if ($this->having == '') {
            $this->select = '1';
        }
        $this->getQueryDt();
        $this->select = $old_select;
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }

    public function count_all() {
        $old_select = $this->select;
        if ($this->having == '') {
            $this->select = '1';
        }
        $this->getQueryDt();
        $this->select = $old_select;
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }
}
