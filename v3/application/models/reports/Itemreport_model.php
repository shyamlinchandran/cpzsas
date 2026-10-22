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
class Itemreport_model extends DataTable {

    function getType() {
        $qry = 'select * from item';
        $res = $this->db->query($qry);
        return $res->result_array();
    }
	
	function get_item_list(){
		$this->select = 'srate,part_no,sup.name as supname,i.name,i.barcode,h.hsncode,u.name as unitname,t.GST as itemtax,ct.ces_name,dis.name as discount,ic.name as catname,ib.ibr_name,i.prate,i.MRP,i.special_rate,i.wh_rate,i.landing_cost,mt.mty_name,stk';
		$this->table = 'item as i left join suppliers as sup on sup.id = i.supplier LEFT JOIN hsncode as h on i.hsncode = h.hsnid LEFT JOIN item_category as ic on ic.id = i.item_category_id LEFT JOIN item_brand as ib on ib.ibr_id = i.brand_id  LEFT JOIN taxgst as t on t.gstid = i.tax_id LEFT JOIN units as u on u.id = i.unit_id LEFT JOIN cess_tbl as ct on ct.ces_id = i.cess_id LEFT JOIN item_group as dis on dis.id = i.item_group_id LEFT JOIN material_type as mt on mt.mty_id = i.material_type LEFT JOIN(SELECT ig.item_id,sum(ig.current_stock) + sum(ig.open_Stock) as stk from item_godown as ig GROUP by ig.item_id) as stock on stock.item_id = i.id';
		$this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.name', 'i.barcode', 'ic.name'); //set column field database for datatable searchable 
        $this->order = array('i.name' => 'asc'); // default order 
	}

      function wherep() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'item as a left join purchase_items as s on s.item_id=a.id inner join purchase as z on z.id=s.purchase_id  left join set_billtype as sb on sb.id= z.bill_type left join hsncode as h on a.hsncode=h.hsnid left join taxgst as t on a.tax_id=t.gstid left join units as u on 

u.id=a.unit_id';
        $this->column_order = array(null, 'a.name', 'h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'h.hsncode','a.barcode'); //set column field database for datatable searchable 
        $this->select = 'AVG(s.total /s.quantity) as avg,a.name as item,h.hsncode as hsn,t.GST as gst,u.code as unit,a.id as id,sum(s.total) as total,sum(s.tax) as tax,sum(s.total-s.tax) as bef,sum(s.quantity) as quantity,sum(s.free_quantity) as free_quantity';
        $this->order = array('a.id' => 'asc'); // default order 
        $this->wherecondition = " where s.published ='yes' ";
        if ($this->input->post('saletype')) {
			$this->wherecondition = $this->wherecondition . ' and  z.type  ="' . $this->input->post('saletype').'"';
		}
		if ($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
        $this->wherecondition = $this->wherecondition . " and z.published ='yes'";
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.item_id  =' . $this->input->post('toid');
        }
		 if ($this->input->post('vehicle')) {
            $this->wherecondition = $this->wherecondition . ' and  z.vehicle  =' . $this->input->post('vehicle');
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  z.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and z.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and z.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		 if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and  a.item_category_id  =' . $this->input->post('category');
        }
		
		if ($this->input->post('brand')) {
           // $this->wherecondition = $this->wherecondition . ' and  a.brand_id  =' . $this->input->post('brand');
		   $brand = $this->input->post('brand',true);
			$brand_text = '';
			foreach($brand as $brnd){
				if($brand_text != '' ){
					$brand_text = $brand_text .' or ';
				}
				$brand_text = $brand_text . '  a.brand_id = '.$brnd.'  ';
			}
            $this->wherecondition = $this->wherecondition . ' and('.$brand_text.')';
        }
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and  z.area  =' . $this->input->post('area');
        }
		 if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and  z.route  =' . $this->input->post('route');
        }
		 if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and z.salesman ="' . $this->input->post('salesman') . '"';
        }
		 if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and z.supplier_id ="' . $this->input->post('cusid') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  z.created_by  =' . $this->input->post('user');
		}
        //if ($this->input->post('reference')) {
         //   $this->wherecondition = $this->wherecondition . ' and z.ref_id ="' . $this->input->post('reference') . '"';
        //}

        $this->group = "  a.id,s.tax_id";
        //  $this->wherecondition = " ";
        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }
	
	function item_list_where() {
        $this->wherecondition = "where i.published ='yes' ";
       
        if ($this->input->post('hsn')) {
            $this->wherecondition = $this->wherecondition . ' and i.hsncode =' . $this->input->post('hsn');
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and i.item_category_id =' . $this->input->post('category');
        }
		 if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and i.id =' . $this->input->post('toid');
        }
        if ($this->input->post('tax')) {
            $this->wherecondition = $this->wherecondition . ' and i.tax_id  =' . $this->input->post('tax');
        }
		 if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and i.material_type  =' . $this->input->post('material_type');
        }
		
		 if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and i.brand_id  =' . $this->input->post('brand');
        }

        if ($this->input->post('umt')) {
            $this->wherecondition = $this->wherecondition . $this->input->post('umt');
        }
		
		
    }

    function stocklevel() {

        $this->select = '*';
        $this->table = '(select a.supplier,a.published,min_level,reorder_point,max_level,sum(ig.open_stock+ig.current_stock) as stock,b.name as unit,a.name,a.barcode as item,brand_id,a.item_category_id,ic.name as catname,ibr_name from item as a left join item_category as ic on ic.id = a.item_category_id left join item_brand as ib on ib.ibr_id = brand_id left join units as b on a.unit_id=b.id inner join item_godown as ig on ig.item_id = a.id group by a.id ) as x';
        $this->column_order = array(null, 'x.name'); //set column field database for datatable orderable
        $this->column_search = array('x.name'); //set column field database for datatable searchable 
        $this->order = array('x.name' => 'asc'); // default order 
        $this->wherecondition = " where x.published ='yes'  and (reorder_point > 0 or min_level > 0 ) ";
        if ($this->input->post('toid')) {
			if ($this->input->post('toid') == 'max'){
				$this->wherecondition = $this->wherecondition . ' and x.stock >= max_level';
			}else{
				$this->wherecondition = $this->wherecondition . ' and x.stock <= reorder_point';
			}
        } else {
            $this->wherecondition = $this->wherecondition . ' and x.stock <= min_level';
        }
		if ($this->input->post('supid')) {
            $this->wherecondition = $this->wherecondition . ' and supplier ='.$this->input->post('supid');
		}
        if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and brand_id ='.$this->input->post('brand');
		}
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and item_category_id ='.$this->input->post('category');
		}
    }

 function where() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'item as a left join sales_items as s on s.item_id=a.id inner join sales as z on z.sales_id=s.sales_id  left join set_billtype as sb on sb.id= z.bill_type left join hsncode as h on a.hsncode=h.hsnid left join taxgst as t on a.tax_id=t.gstid left join units as u on 

u.id=a.unit_id';
        $this->column_order = array(null, 'a.name', 'h.hsncode'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'h.hsncode','a.barcode'); //set column field database for datatable searchable 
        $this->select = 'a.name as item,h.hsncode as hsn,t.GST as gst,u.code as unit,a.id as id,sum(s.total) as total,sum(s.tax) as tax,sum(s.total-s.tax) as bef,sum(s.quantity) as quantity,sum(s.free_quantity) as free_quantity';
        $this->order = array('a.id' => 'asc'); // default order 
        $this->wherecondition = " where s.published ='yes' ";
        if ($this->input->post('saletype')) {
			$this->wherecondition = $this->wherecondition . ' and  z.type  ="' . $this->input->post('saletype').'"';
		}
		if ($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
        $this->wherecondition = $this->wherecondition . " and z.published ='yes'";
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.item_id  =' . $this->input->post('toid');
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  z.bill_type  =' . $this->input->post('btype');
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and z.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and z.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		 if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and  a.item_category_id  =' . $this->input->post('category');
        }
		
		if ($this->input->post('brand')) {
           // $this->wherecondition = $this->wherecondition . ' and  a.brand_id  =' . $this->input->post('brand');
		   $brand = $this->input->post('brand',true);
			$brand_text = '';
			foreach($brand as $brnd){
				if($brand_text != '' ){
					$brand_text = $brand_text .' or ';
				}
				$brand_text = $brand_text . '  a.brand_id = '.$brnd.'  ';
			}
            $this->wherecondition = $this->wherecondition . ' and('.$brand_text.')';
        }
		 if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . ' and  z.area  =' . $this->input->post('area');
        }
		 if ($this->input->post('route')) {
            $this->wherecondition = $this->wherecondition . ' and  z.route  =' . $this->input->post('route');
        }
		 if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and z.salesman ="' . $this->input->post('salesman') . '"';
        }
		 if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and z.customer_id ="' . $this->input->post('cusid') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  z.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and z.ref_id ="' . $this->input->post('reference') . '"';
        }

        $this->group = "  a.id,s.tax_id";
        //  $this->wherecondition = " ";
        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

    function getitem($id) {
        $qry = 'select a.name as name,h.hsncode as hsncode,t.GST as gst,u.code as code from item as a  left join hsncode as h on a.hsncode=h.hsncode left join taxgst as t on t.gstid=a.tax_id left join units as u on u.id=a.unit_id where 

a.id=' . $id;

        $query = $this->db->query($qry)->result();
        return $query;
    }

    function getvalue($id) {
        $qry = "Select sum(a.quantity) as quantity,sum(a.total) as total,sum(a.tax) as tax,sum(a.total-a.tax) as taxable from sales_items as  a inner join sales as b on a.sales_id=b.sales_id  where  a.published ='yes' and  

invoice_date >=  '" . $this->getDate($this->input->post('startdate')) . "' and  invoice_date  < '" . $this->getDate($this->input->post('enddate')) . "' and item_id =" . $id;
        $query = $this->db->query($qry)->result();
        return $query;
    }

    function where1() {

        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales_items as a inner join sales as b on  a.sales_id=b.sales_id';
        $this->column_order = array(null, 'a.sales_id'); //set column field database for datatable orderable
        $this->column_search = array('a.sales_id'); //set column field database for datatable searchable 
        $this->select = 'sum(a.total) as total,sum(a.tax) as tax,sum(a.total-a.tax) as beforetax,sum(a.quantity) as quantity';
        // $this->order = array('a.id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and b.published='yes'";

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  a.item_id  =' . $this->input->post('toid');
        }




        // $this->wherecondition = " where b.id=".$id;
        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
    }

}
