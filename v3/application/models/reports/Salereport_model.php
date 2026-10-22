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
class Salereport_model extends DataTable {

    function getType() {
        $qry = 'select * from item_group';
        $res = $this->db->query($qry);
        return $res->result_array();
    }
	
	function sales_summary_report(){
		$sttxt = '';
		$entxt ='';
		if ($this->input->post('startdate')) {
            $sttxt = ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '" ';
        }
        if ($this->input->post('enddate')) {
            $entxt =  ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }

        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $br_text = '';
        if($tmp['utype'] != 'Admin' &&  $this->session->userdata('login_comid') == 'msa'){
             $br_text= ' and a.branch = "'.$branch.'"';
        }
		$this->select = 'sale.*,user_name';
        $this->table = 'users as a INNER JOIN (select sum(case when s.type="sales" then s.discount else 0 end) as salesadjust,sum(case when s.type="sales" then s.total else 0 end) as totalsales,sum(case when s.type="sales_return" then s.total else 0 end) as totalsalesreturn,sum(case when s.type="sales" then s.cash_amount else 0 end) as totalcash_amount,sum(case when s.type="sales" then s.bank_amount else 0 end) as totalbank_amount,sum(case when s.type="sales" then s.total-s.bank_amount-s.cash_amount else 0 end) as creditamount,s.created_by from sales as s WHERE s.published="yes" '.$sttxt.'  '.$entxt.' GROUP by s.created_by) as sale on sale.created_by =a.id '.$br_text.' ';
        $this->column_order = array('user_name'); //set column field database for datatable orderable
        $this->column_search = array('user_name'); //set column field database for datatable searchable 
        $this->order = array('user_name' => 'desc'); // default order 
		
	}
	
	function freequantity_list(){
		$this->select ="s.type,s.sales_id,ifnull(sup.name ,  CASE WHEN s.cusname ='' then 'cash' else s.cusname end) as customer,s.invoice_date,s.invoice,i.name,i.barcode,si.free_quantity,si.base_free_quantity,sb.branch_id";
		$this->table = "sales as s INNER JOIN sales_items as si on si.sales_id = s.sales_id and si.published = 'yes' and s.published ='yes' and si.base_free_quantity > 0 INNER JOIN item as i on i.id =si.item_id INNER JOIN set_billtype as sb on sb.id =s.bill_type LEFT JOIN suppliers as sup on sup.id = s.customer_id";
		$this->column_order = array('s.date','s.invoice'); //set column field database for datatable orderable
        $this->column_search = array('s.date','s.invoice','sup.name','s.cusname','i.name','i.barcode'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'desc'); // default order
		$this->wherecondition = " where 1";
		if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
		if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
		}
		if($this->input->post('btype') ){
            $this->wherecondition = $this->wherecondition . ' and s.bill_type ="' . $this->input->post('btype') . '"';
		}else{
		
		}
		if($this->input->post('customer_id') ){
            $this->wherecondition = $this->wherecondition . ' and s.customer_id ="' .$this->input->post('customer_id') . '"';
		}
		if($this->input->post('type') ){
            $this->wherecondition = $this->wherecondition . ' and s.cash_type ="' . $this->input->post('type'). '"';
		}
		if($this->input->post('reference') ){
            $this->wherecondition = $this->wherecondition . ' and s.ref_id ="' . $this->input->post('reference') . '"';
		}
		if($this->input->post('salesman') ){
            $this->wherecondition = $this->wherecondition . ' and s.salesman ="' . $this->input->post('salesman') . '"';
		}
		if($this->input->post('user') ){
            $this->wherecondition = $this->wherecondition . ' and s.created_by ="' . $this->input->post('user') . '"';
		}
		if($this->input->post('toid') ){
            $this->wherecondition = $this->wherecondition . ' and si.item_id ="' . $this->input->post('toid') . '"';
		}
	}
	
	function customersalesreport(){
		$this->select = 'supledgerid,ifnull(discount,0) as discount,ifnull(bal,0) as bal,acc_ledgers_id,rec.trans_date,ifnull(rec_amount,0) as rec_amount,sale.name,sale.customer,sale.invoice_date,ifnull(sale.total,0) as total,ifnull(sale.cash,0) as cash,ifnull(sale.credit,0) as credit';
        $this->table = " (SELECT sup.name,sup.id as customer,s.invoice_date,s.customer_id,sum(s.discount) as discount,sum(s.total) as total,sum(case WHEN s.cash_type='cash' or s.cash_type ='bank' then s.total else 0 end) as cash,sum(case WHEN s.cash_type='credit'  then s.total else 0 end) as credit from sales as s left JOIN suppliers as sup  on s.customer_id = sup.id and s.published ='yes' where s.published='yes' and s.type='sales' group by s.invoice_date,s.customer_id) as sale left join(SELECT v.trans_date,al.ref_id,al.ref_code,vt.acc_ledgers_id,sum(vt.credit_amounnt) as rec_amount from acc_ledgers as al INNER JOIN voucher_trans as vt on vt.acc_ledgers_id = al.id and al.ref_code in('cus','sup') and vt.published ='yes' INNER JOIN voucher as v on v.id=vt.voucher_id and v.published ='yes' and v.vourcher_type='receipt' GROUP by vt.acc_ledgers_id,v.trans_date) as rec on rec.ref_id = sale.customer and rec.trans_date =sale.invoice_date left join ( SELECT sum(tran_debit) - sum(tran_credit) + case when acc.type = 'Dr' then acc.openning_bal else -1*acc.openning_bal end as bal,ledger_id,acc.ref_id,acc.id as supledgerid from acc_ledgers as acc left join  acc_ledger_trans  as alt on alt.ledger_id = acc.id and acc.ref_code in('cus','sup') and alt.published='yes'  WHERE  acc.ref_code in('cus','sup')  GROUP by acc.id ) as ledbal on ledbal.ref_id =sale.customer ";
        //$this->table = " ( SELECT sum(tran_debit) - sum(tran_credit) + case when acc.type = 'Dr' then acc.openning_bal else -1*acc.openning_bal end as bal,ledger_id,case when acc.id > 1 then acc.ref_id else 0 end as ref_id,acc.id as supledgerid from acc_ledgers as acc left join  acc_ledger_trans  as alt on alt.ledger_id = acc.id and acc.ref_code in('cus','sup') and alt.published='yes'  WHERE  acc.ref_code in('cus','sup') or acc.id = 1  GROUP by acc.id ) as ledbal left join  (SELECT sup.name,IFNULL(sup.id,0) as customer,s.invoice_date,s.customer_id,sum(s.discount) as discount,sum(s.total) as total,sum(case WHEN s.cash_type='cash' or s.cash_type ='bank' then s.total else 0 end) as cash,sum(case WHEN s.cash_type='credit'  then s.total else 0 end) as credit from sales as s left JOIN suppliers as sup  on s.customer_id = sup.id and s.published ='yes' group by s.invoice_date,s.customer_id) as sale on sale.customer = ledbal.ref_id left join(SELECT al.id as leid,v.trans_date,al.ref_id,al.ref_code,vt.acc_ledgers_id,sum(vt.credit_amounnt) as rec_amount from acc_ledgers as al INNER JOIN voucher_trans as vt on vt.acc_ledgers_id = al.id and al.ref_code in('cus','sup') and vt.published ='yes' INNER JOIN voucher as v on v.id=vt.voucher_id and v.published ='yes' and v.vourcher_type='receipt' GROUP by vt.acc_ledgers_id,v.trans_date) as rec on rec.leid = ledbal.id and rec.trans_date =sale.invoice_date ";
		
		$this->column_order = array('sale.name'); //set column field database for datatable orderable
        $this->column_search = array('sale.name'); //set column field database for datatable searchable 
        $this->order = array('sale.name' => 'asc'); // default order
		$this->wherecondition = " where 1";
		if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
			}
		if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition . ' and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
		}
		$this->having = ' total>0 or rec_amount>0';
	}
	
	function sales_gst_report(){
		$this->select = 'round(sum(b.tax)/2,2) as sgst,sum(b.total)-sum(b.tax)+sum(b.dis_amt) as gbedtax,sum(b.dis_amt) as discount,sum(b.total)-sum(b.tax) as beforetax,c.GST,sum(b.tax) as tax,sum(b.total) as total';
        $this->table = 'sales as a inner join sales_items as b on a.sales_id=b.sales_id INNER JOIN taxgst as c on c.gstid=b.tax_id';
        $this->column_order = array('c.GST'); //set column field database for datatable orderable
        $this->column_search = array('c.GST'); //set column field database for datatable searchable 
        $this->order = array('c.GST' => 'asc'); // default order 
		$this->wherecondition = " where a.published ='yes' and b.published ='yes' and a.type='sales'";
		 if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('btype')){
            $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		$this->group = 'c.gstid';
	}
	
	function get_consoled($startdate, $enddate,$btype){
		$qry = "select count(sales_id) as cnt from sales as a ";
		$where = " where a.published='yes' and a.type='sales' ";
		if ($this->input->post('startdate')) {
            $where = $where . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $where = $where . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('btype')){
            $where = $where . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		$qry = $qry . $where;
		$result = $this->db->query($qry)->result_array();
		$qry = "select group_concat(c.type,':',invoice) as invoice from sales as s  inner join (SELECT max(sales_id) as max_sale from sales as a ".$where."  group by bill_type) as s on max_sale =s.sales_id INNER join set_billtype as c on c.id=s.bill_type";
		$query = $this->db->query($qry);
		if($query->num_rows()>0){
			$query  = $query->row_array();
			$result[0]['last_invoice'] =$query['invoice'];
		}
		echo json_encode($result);
	}

    function where() {

        $this->select = 'c.type as stype,sum(rate) as dis,c.sales_id as sid,sum(a.total) as tot,sum(a.dis_amt) as disamt, a.*,b.*,c.*';
        $this->table = 'sales as c inner join sales_items as a on a.sales_id=c.sales_id inner join item as b on a.item_id =b.id';
        $this->column_order = array(null, 'name', 'tot'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'tot', 'name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes' and a.published ='yes' and c.type='sales'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type') . '"';
        }
        $this->wherecondition = $this->wherecondition ." group by item_id,a.sales_id";

    }

    function wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        $this->select = 'a.tin,c.cash_type,case when  a.name = "" or  a.name is null then cusname else  a.name end  as cusnames,d.name as ref,u.user_name,c.type as stype,c.sales_id as sid,c.*,a.*,cu.user_name as createduser';
        $this->table = 'sales as c inner join set_billtype as sb on sb.id =c.bill_type  left join suppliers as a on a.id=c.customer_id  left join reference as d on d.ref_id=c.ref_id left join users as u on u.id=c.salesman left join users as cu on cu.id=c.created_by';
        $this->column_order = array(null, 'c.cusname', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('c.invoice', 'a.email', 'a.phone', 'c.cusname'); //set column field database for datatable searchable 
        $this->order = array('c.sales_id' => 'desc'); // default order 

        // $this->wherecondition = " where c.published ='yes'";
        if($this->input->post('cancelled')){
			$this->wherecondition = " where c.published ='no'";
		}else{
			$this->wherecondition = " where c.published ='yes'";
        }

		 if ($this->input->post('stype')) {
            if ($this->input->post('stype') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and a.tin !="" and a.tin is not  null ';
            }
            if ($this->input->post('stype') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (a.tin ="" or a.tin is null) ';
            }
        }
		
		
		if ($this->input->post('bank_pay_method')) {
            $this->wherecondition = $this->wherecondition . ' and c.bank_pay_method ="' . $this->input->post('bank_pay_method') . '"';
        }
		
        if ($this->input->post('saletype')) {
            $this->wherecondition = $this->wherecondition . " and c.type ='".$this->input->post('saletype')."'";
        }
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . " and c.bill_type ='".$this->input->post('btype')."'";
			}
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and c.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and c.customer_id ="' . $this->input->post('customer_id') . '"';
        }
         if ($this->input->post('salesman')) {
            $this->wherecondition = $this->wherecondition . ' and c.salesman ="' . $this->input->post('salesman') . '"';
        }
		if($this->input->post('user')){
            $this->wherecondition = $this->wherecondition . ' and  c.created_by  =' . $this->input->post('user');
		}
        if ($this->input->post('reference')) {
            $this->wherecondition = $this->wherecondition . ' and c.ref_id ="' . $this->input->post('reference') . '"';
        }
		if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . ' and sb.branch_id ="' . $this->input->post('branch') . '"';
        }
		
         if($this->input->post('taxtype') ){
            $this->wherecondition = $this->wherecondition . ' and saletype ="' . $this->input->post('taxtype'). '"';
		}

    }

    function tyrwherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'tyr_sales as c inner join tyr_customer as a on a.id=c.customer_id ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('c.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('c.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and c.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and c.customer_id ="' . $this->input->post('customer_id') . '"';
        }
    }

    function wherecategory() {
        $category = $this->input->post('category');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales as s inner join sales_items as a on s.sales_id =a.sales_id  inner join item as b on a.item_id=b.id inner join item_category as c on c.id = b.item_category_id ';
        $this->select = 'b.name as item,c.name,sum(quantity) as quantity,a.rate';
        $this->column_order = array(null, 'b.name', 'c.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name', 'c.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'desc'); // default order 

        $this->wherecondition = " where a.published ='yes' and s.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and s.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
         if ($this->input->post('group')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('group') . '"';
        }
        if ($this->input->post('category')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_category_id ="' . $this->input->post('category') . '"';
        }
        $this->wherecondition = $this->wherecondition . 'group by c.id,b.id';
    }

}
