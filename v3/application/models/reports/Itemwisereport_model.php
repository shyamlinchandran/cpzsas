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
class Itemwisereport_model extends DataTable {

    function __construct() {
        parent::__construct();
    }

    function getType() {
        $qry = 'select * from item';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function purchase() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'purchase_items as c inner join purchase as a on a.id=c.purchase_id left join taxgst as t on c.tax_id=t.gstid inner join suppliers as s on s.id=a.supplier_id left join set_billtype as h on a.bill_type=h.id inner join item as i on c.item_id=i.id left join units as u on u.id = c.unit_id';
        $this->column_order = array(null, 'a.invoice', 's.name', 'item', 'supplier', 'tot'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 's.name', 'i.name', 's.name','i.barcode'); //set column field database for datatable searchable 
        $this->select = 'barcode,c.batch,u.name as uname,t.GST as gstname,sum(c.free_quantity) as free_quantity,sum(c.quantity) as quantity,cur_exc_amt,a.total as gtotal,i.name as item,s.name as supplier,h.type as btype,sum(c.tax) as taxmain,a.tax as t,sum(itm_raw_ces) as itmrawces,itm_ces_per,sum(c.total) as tot,a.type as ptype,sum(dis_amt) as dis_amts,c.*,a.*,s.*';
        $this->order = array('a.id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes' and  a.published ='yes'";
        if ($this->input->post('purtype')) {
            $this->wherecondition = $this->wherecondition . " and a.type ='" . $this->input->post('purtype') . "'";
        }

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  a.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  c.item_id  =' . $this->input->post('toid');
        }

        if ($this->input->post('supid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.id  =' . $this->input->post('supid');
        }
        if ($this->input->post('hsnid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.hsncode  =' . $this->input->post('hsnid');
        }

        $this->wherecondition = $this->wherecondition . "  group by c.item_id,c.purchase_id,c.id";

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

    function quantity() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'item_ledger as a left JOIN item as b on a.item_id=b.id left join (select sum(open_stock) as stock,item_id from item_godown where published="yes" group by item_id) as c on c.item_id=a.item_id';
        $this->column_order = array(null, 'purchase', 'sales', 'name'); //set column field database for datatable orderable
        $this->column_search = array('a.item_id', 'purchase', 'sales', 'b.name','b.barcode');
        $this->order = array('b.id' => 'asc'); // default order 
        //set column field database for datatable searchable 
        $this->select = 'stock,SUM(CASE WHEN `trans_status` = "sales" THEN `quantity` ELSE 0 END) sales, SUM(CASE WHEN `trans_status` = "purchase" THEN `quantity` ELSE 0 END) purchase,name,a.item_id';
        $this->wherecondition = " where a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.trans_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.trans_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        $this->wherecondition = $this->wherecondition . "  group by a.item_id";
    }

    function getitemdate($startdate, $enddate, $id) {
        $qry = 'select IFNULL(max(trans_date),"No Sales Occured") as date from item_ledger as a  where published="yes" and trans_status="sales" and item_id= ' . $id . ' and a.trans_date >="' . $this->getDate($startdate) . '" and a.trans_date <="' . $this->getDate($enddate) . '"';
        $res = $this->db->query($qry);
        $query = $res->row_array();
        $data['sdate'] = $query['date'];
        $qry = 'select IFNULL(max(trans_date),"No Purchase occured") as date from item_ledger as a  where published="yes" and trans_status="purchase" and item_id= ' . $id . ' and a.trans_date >="' . $this->getDate($startdate) . '" and a.trans_date <="' . $this->getDate($enddate) . '"';
        $res = $this->db->query($qry);
        $query = $res->row_array();
        $data['pdate'] = $query['date'];
        return $data;
    }

    function sales() {

        $this->wherecondition = " where a.published ='yes' and  b.published ='yes'";
        if ($this->input->post('saletype')) {
            $this->wherecondition = $this->wherecondition . " and b.type ='" . $this->input->post('saletype') . "'";
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  b.bill_type  =' . $this->input->post('btype');
        }

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.id  =' . $this->input->post('toid');
        }
        if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.id  =' . $this->input->post('cusid');
        }
        if ($this->input->post('hsnid')) {
            $this->wherecondition = $this->wherecondition . ' and  i.hsncode  =' . $this->input->post('hsnid');
        }
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and  s.area  =' . $this->input->post('area');
        }
        if ($this->input->post('batch')) {
            $this->wherecondition = $this->wherecondition . ' and  a.batch  ="' . $this->input->post('batch').'"';
        }
		 if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and  s.route  =' . $this->input->post('route');
        }
		
		 if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and  i.item_category_id  =' . $this->input->post('category');
        }
		if ($this->input->post('brand')) {
			$brand = $this->input->post('brand',true);
			$brand_text = '';
			foreach($brand as $brnd){
				if($brand_text != '' ){
					$brand_text = $brand_text .' or ';
				}
				$brand_text = $brand_text . '  i.brand_id = '.$brnd.'  ';
			}
            $this->wherecondition = $this->wherecondition . ' and('.$brand_text.')';
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
		if ($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
        $this->group = " sal_itms_id ,a.sales_id";
		
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales_items as a left join units on units.id = a.unit_id INNER JOIN sales as b on a.sales_id=b.sales_id left join users as uss on uss.Id = b.salesman  left join set_billtype as sb on sb.id= b.bill_type left JOIN suppliers as s on b.customer_id=s.id left join taxgst as g on g.gstid=a.tax_id left join set_billtype as h on b.bill_type=h.id inner join item as i on a.item_id=i.id left join hsncode as hc on hc.hsnid = i.hsncode';
        $this->column_order = array(null, 'b.invoice', 's.name', 'i.name', 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.barcode','b.invoice', 's.name', 'i.name','b.invoice_date','b.cusname' ); //set column field database for datatable searchable 
        $this->select = 'uss.user_name,sal_itms_mrp,a.batch,g.GST as gstname,itm_ces_per,sum(a.itm_raw_ces) as itmrawces,units.name as unitname,hc.hsncode as hsncodename,sum(a.free_quantity)as free_quantity,sum(a.quantity) as quantity,sum(a.total) as total,s.tin,s.id as sid,b.invoice_date,s.name,b.invoice,a.sales_id,g.GST,case when b.cusname != "" and  b.cusname is not null then b.cusname else s.name end as cusname ,h.type as btype,sum(a.tax) as tax,i.name as item,dis_amt,other,b.type as saletype,i.MRP,a.mrp as srate,i.barcode,add_dis_amt';
        $this->order = array('b.invoice_date' => 'desc'); // default order 
        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

}
