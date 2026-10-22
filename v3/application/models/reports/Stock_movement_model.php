<?php
class Stock_movement_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function where()
    {
        $startdate = $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
       // $customer = $this->input->post('customer_id');
        $brand = $this->input->post('brand_id');

        $this->select ="IFNULL(led.purchasequantity,0) as purchasequantity,IFNULL(led.purchasereturn,0) as purchasereturn,IFNULL(led.salesreturn,0) as salesreturn,IFNULL(led.damage,0) as damage,IFNULL(led.received,0) as received,IFNULL(led.issued,0) as issued,IFNULL(led.salequantity,0) as salequantity,IFNULL(open,0)+IFNULL(stock,0) as open_stock,i.id,i.name,i.barcode,g.*,IFNULL(open,0)+IFNULL(stock,0)+IFNULL(purchasequantity,0)+IFNULL(salesreturn,0)+IFNULL(received,0)-IFNULL(purchasereturn,0)-IFNULL(salequantity,0)-IFNULL(damage,0)-IFNULL(issued,0) as closing_stock";
        $this->table ="item as i left join 
        (select sum(ig.open_stock) as open,ig.item_id as god_item_id from item_godown as ig GROUP by ig.item_id) as g on g.god_item_id = i.id 
        LEFT JOIN
        (select sum(case WHEN il.trans_date < '$startdate' and il.trans_type = 'dt' THEN quantity else 0 end)  -  sum(case WHEN il.trans_date < '$enddate' and il.trans_type = 'cr' 
        THEN quantity else 0 end) as stock,
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'sales' THEN quantity else 0 end)  as salequantity,
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'purchase' THEN quantity else 0 end)  as purchasequantity, 
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'purchase_return' THEN quantity else 0 end)  as purchasereturn,
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'sales_return' THEN quantity else 0 end)  as salesreturn,
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'damage' THEN quantity else 0 end)  as damage,
         
          sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'stock_journal' and il.trans_type='dt' THEN quantity else 0 end)  as received, 
        
         sum(case WHEN il.trans_date >= '$startdate' and il.trans_date <= '$enddate'  and il.trans_status = 'stock_journal' and il.trans_type='cr' THEN quantity else 0 end)  as issued, 
                 
         il.item_id as il_item_id FROM item_ledger as il where il.published ='yes' GROUP by il.item_id) as led on led.il_item_id =i.id 
         left join item_brand as ibr on ibr.ibr_id=i.brand_id";
         //left join suppliers as s on s.id = ibr.ibr_id
        $this->column_order = array('i.id','i.name');
        $this->column_search = array('i.name');
        //$this->group = array('')
        $this->order = array('led.salequantity'=>'asc');

        $this->wherecondition =' where i.published = "yes" group by i.id ';
        // if ($this->input->post('startdate')) {
        //     $this->wherecondition = $this->wherecondition . ' and item_ledger.trans_date>="' . $startdate . '"';
        // }
        // if ($this->input->post('enddate')) {
        //     $this->wherecondition = $this->wherecondition . ' and item_ledger.trans_date<="' . $enddate . '"';
        // }
        // if($this->input->post('supname')){
        //     // print_r($customer);
        //     $this->wherecondition = $this->wherecondition . 'and s.id ="'.$customer.'"';
        // }
        if($this->input->post('brand')){
            $this->wherecondition = $this->wherecondition . 'and ibr.ibr_id="'.$brand.'"';
        }
    }
	
	public function daily_list()
    {
		//SELECT sum(CASE WHEN type = 'damage' THEN quantity else 0 end  ) as damage_qty,sum(CASE WHEN type = 'damage' THEN total else 0 end  ) as damage_value,sum(CASE WHEN type = 'purchase' THEN total else 0 end  ) as purchase_value,sum(CASE WHEN type = 'purchase_return' THEN total else 0 end  ) as purchase_return_value,sum(CASE WHEN type = 'purchase' THEN total else 0 end  ) as purchase_value,sum(CASE WHEN type = 'sales_return' THEN total else 0 end  ) as sales_return_value,sum(CASE WHEN type = 'sales' THEN total else 0 end  ) as sales_value,sum(CASE WHEN type = 'purchase_return' THEN quantity else 0 end  ) as purchase_return_qty,sum(CASE WHEN type = 'purchase' THEN quantity else 0 end  ) as purchase_qty,sum(CASE WHEN type = 'sales_return' THEN quantity else 0 end  ) as sales_return_qty,sum(CASE WHEN type = 'sales' THEN quantity else 0 end  ) as sales_qty,a.name,x.* from item as a INNER join (SELECT s.invoice_date,s.created_by,s.customer_id,s.salesman,s.type,si.item_id,si.total,si.quantity from sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published ='yes' and si.published = 'yes' and s.type in ('sales','sales_return') UNION SELECT p.date,p.created_by,p.supplier_id,p.salesman,p.type,pi.item_id,pi.total,pi.quantity from purchase as p INNER JOIN purchase_items as pi on p.id =pi.purchase_id and p.published ='yes' and pi.published = 'yes' and p.type in ('purchase','purchase_return') UNION SELECT a.date,a.user,a.customer_id,a.salesman,'damage' as type,b.item_id,0 as total,b.quantity from damage as a INNER JOIN item_damage as b on a.damage_id = b.damage_id and a.published ='yes' and b.published ='yes') as x on x.item_id = a.id GROUP by item_id  
		//ORDER BY `damage_qty`  DESC
		//UNION SELECT p.date,p.created_by,p.supplier_id,p.salesman,p.type,pi.item_id,pi.total,pi.quantity from purchase as p INNER JOIN purchase_items as pi on p.id =pi.purchase_id and p.published ='yes' and pi.published = 'yes' and p.type in ('purchase','purchase_return')
		
		$this->table = "item as a INNER join (SELECT s.invoice_date,s.created_by,s.customer_id,s.salesman,s.type,si.item_id,si.total,si.quantity from sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published ='yes' and si.published = 'yes' and s.type in ('sales','sales_return')  UNION SELECT a.date,a.user,a.customer_id,a.salesman,'damage' as type,b.item_id,0 as total,b.quantity from damage as a INNER JOIN item_damage as b on a.damage_id = b.damage_id and a.published ='yes' and b.published ='yes') as x on x.item_id = a.id";
        $this->select ="sum(CASE WHEN type = 'damage' THEN quantity else 0 end  ) as damage_qty,sum(CASE WHEN type = 'damage' THEN total else 0 end  ) as damage_value,sum(CASE WHEN type = 'purchase' THEN total else 0 end  ) as purchase_value,sum(CASE WHEN type = 'purchase_return' THEN total else 0 end  ) as purchase_return_value,sum(CASE WHEN type = 'purchase' THEN total else 0 end  ) as purchase_value,sum(CASE WHEN type = 'sales_return' THEN total else 0 end  ) as sales_return_value,sum(CASE WHEN type = 'sales' THEN total else 0 end  ) as sales_value,sum(CASE WHEN type = 'purchase_return' THEN quantity else 0 end  ) as purchase_return_qty,sum(CASE WHEN type = 'purchase' THEN quantity else 0 end  ) as purchase_qty,sum(CASE WHEN type = 'sales_return' THEN quantity else 0 end  ) as sales_return_qty,sum(CASE WHEN type = 'sales' THEN quantity else 0 end  ) as sales_qty,a.name ";
        $this->column_order = array('a.id','a.name');
        $this->column_search = array('a.name');
        $this->wherecondition =' where 1 ';
		if($this->input->post('date')){
            $this->wherecondition = $this->wherecondition . ' and x.invoice_date ="'.$this->getDate($this->input->post('date')).'"';
        }
		if($this->input->post('customer_id')){
			$customer_id = $this->input->post('customer_id');
            $this->wherecondition = $this->wherecondition . 'and x.customer_id="'.$customer_id.'"';
        }
		 if($this->input->post('salesman')){
			$salesman = $this->input->post('salesman');
            $this->wherecondition = $this->wherecondition . 'and x.salesman="'.$salesman.'"';
        }
		 if($this->input->post('created_by')){
			$created_by = $this->input->post('created_by');
            $this->wherecondition = $this->wherecondition . 'and x.created_by="'.$created_by.'"';
        }
       $this->group = 'a.id';
    }
	
	
	
    public function customers($search,$type)
    {
        $ls = "";
        $com = " a.name  as label,";
        if ($type == 'sup') {
            $type = 'type ="sup" and ';
        } else {
            $type = '';
        }
        if ($this->multiple != 0) {
            $ls = " or a.name_lan like('%$search%')";
            $com = " concat(cast(ifnull(a.`name_lan`,' ') as char),' ','',name) as label,";
        }
        $qry = "select $com a.*,b.StateID,b.code from suppliers as a  left join state as b on a.cst=b.StateID where $type  (name like('%$search%') $ls or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    public function brand($search)
    {
        $qry = "SELECT ibr_id,ibr_name as label FROM item_brand where ibr_name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
}
