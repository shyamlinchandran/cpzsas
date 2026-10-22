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
class Goldreport_model extends DataTable {

        function billwise(){
            $this->select = 'a.tax as saletax,a.total as saletotal,a.invoice_date,a.invoice,a.cusname,b.*';
            $this->table = "sales as a inner join sales_items as b on a.sales_id = b.sales_id and b.published ='yes' and a.published = 'yes' ";
            $this->column_order = array(null, 'invoice','cusname','invoice_date'); //set column field database for datatable orderable
            $this->column_search = array('invoice', 'cusname','invoice_date'); //set column field database for datatable searchable 
            $this->order = array('a.sales_id' => 'desc'); // default order
            if ($this->input->post('startdate')) {
                $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
            }
            if ($this->input->post('enddate')) {
                $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
            }

        }

    function get_stock(){
            $where_start = ' and trans_date  < "2000-01-01" ';
            $where_end = ' and trans_date <= "2030-01-01" ';

            $wherecondition = '';
            if ($this->input->post('startdate')) {
                $where_start = ' and trans_date  < "' . $this->getDate($this->input->post('startdate')) . '" ';

                 $wherecondition = $wherecondition . ' and item_ledger.trans_date >="' . $this->getDate($this->input->post('startdate')) . '"';
            }
            if ($this->input->post('enddate')) {
                $wherecondition = $wherecondition. ' and item_ledger.trans_date <="' . $this->getDate($this->input->post('enddate')) . '"';
                $where_end = ' and trans_date <= "' . $this->getDate($this->input->post('enddate')) . '"';
            }
            $this->select = "a.item_id as itemid,a.open_stock,a.open_stock_wt,b.name,led.*,IFNULL(startwt,0) + a.open_stock_wt as wt, IFNULL(startqty,0) +a.open_stock as open";
            $this->table = "item_godown as a inner join item as b on a.item_id = b.id left join (select trans_date,item_id,sum(case when (trans_status = 'stock_journal' and trans_type ='dt' ".$wherecondition.") or  (trans_status = 'sales_return' and trans_type ='dt' ".$wherecondition.") then net_wt else 0 end) as rec_wt,sum(case when (trans_status = 'stock_journal' and trans_type ='dt' ".$wherecondition.") or (trans_status = 'sales_return' and trans_type ='dt' ".$wherecondition.") then quantity else 0 end) as rec_qty,sum(case when trans_status = 'stock_journal' and trans_type ='cr' ".$wherecondition." then net_wt else 0 end) as issue_wt,sum(case when trans_status = 'stock_journal' and trans_type ='cr' ".$wherecondition." then quantity else 0 end) as issue_qty,sum(case when trans_status = 'purchase' and trans_type ='dt' ".$wherecondition." then net_wt else 0 end) as purchase,sum(case when trans_status = 'purchase' and trans_type ='dt' ".$wherecondition." then quantity else 0 end) as purchaseqty,sum(case when trans_status = 'sales' and trans_type ='cr' ".$wherecondition." then quantity else 0 end) as salesqty,sum(case when trans_status = 'sales' and trans_type ='cr' ".$wherecondition." then net_wt else 0 end) as saleswt,sum(case when trans_type ='dt' ".$where_start." then quantity else 0  end) - sum(case when trans_type ='cr' ".$where_start." then quantity else 0  end)  as startqty,sum(case when trans_type ='dt' ".$where_start." then net_wt else 0  end) - sum(case when trans_type ='cr' ".$where_start." then net_wt else 0  end)  as startwt from item_ledger where published = 'yes'   group by item_id) as led on led.item_id = b.id";
            $this->column_order = array(null, 'b.name','a.open_stock','a.open_stock_wt','purchaseqty','purchase','salesqty','saleswt','issue_qty','issue_wt','rec_qty','rec_wt'); //set column field database for datatable orderable
            $this->column_search = array('b.name'); //set column field database for datatable searchable 
            $this->order = array('trans_date' => 'desc'); // default order
            if ($this->input->post('material_type')) {
                $this->wherecondition = ' where b.material_type = '.$this->input->post('material_type');
            }

    }
      function where1() {
       
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales_items as a INNER JOIN sales as b on a.sales_id=b.sales_id left JOIN suppliers as s on b.customer_id=s.id left join taxgst as g on g.gstid=a.tax_id';
        $this->column_order = array(null, 'invoice','cusname','invoice_date'); //set column field database for datatable orderable
        $this->column_search = array('invoice', 'cusname','invoice_date'); //set column field database for datatable searchable 
        $this->select = 'cusemail,b.discount,b.type as stype,b.sales_id as sid,b.invoice,b.total as tot,sum(a.total),sum(a.total-a.tax) as bef,sum(a.tax) as tax,cusname,s.tin,invoice_date';
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes'";
        $this->wherecondition = $this->wherecondition ." and b.published ='yes' and b.type='sales'";

		
		
		 if ($this->input->post('type')) {
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and s.tin !="" and s.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (s.tin ="" or s.tin is null) ';
            }
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
}
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
          if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.customer_id  =' . $this->input->post('toid');
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
               $this->wherecondition = $this->wherecondition ."  group by b.sales_id";
                // $this->wherecondition = " where b.id=".$id;

        // if ($this->input->post('type')) {
        //     $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type')  . '"';
        // }
        
    }  

}
