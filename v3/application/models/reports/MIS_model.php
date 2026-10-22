<?php
class MIS_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function get_monthly_list()
    {
		
		$voucher = $this->input->post('voucher');
		$year_start = $this->input->post('year_start');
		$month_start = $this->input->post('month_start');
		$year_end = $this->input->post('year_end');
		$month_end = $this->input->post('month_end');	
		$start_date = $year_start.'-'.$month_start.'-01';
		$end_date = $year_end.'-'.$month_end.'-01';
		$end_date = date("Y-m-t", strtotime($end_date));
		if($voucher == 'sales' || $voucher == 'sales_return' ||  $voucher == 'sales_order' ){
			$this->select = "DATE_FORMAT('".$end_date."', '%d/%m/%Y') as rpt_end_date,DATE_FORMAT('".$start_date."', '%d/%m/%Y') as rpt_start_date,s.type,YEAR(s.invoice_date) as year,MONTHNAME(s.invoice_date) as month,sum(total) as total,sum(case WHEN cash_type = 'Cash' then total else 0 end) as cash_amount,sum(case WHEN cash_type = 'Bank' then total else 0 end) as bank_amount,sum(case WHEN cash_type = 'Credit' then total else 0 end) as Credit_amount";
			$this->table = "sales as s";
			$this->column_order = array(null,'MONTHNAME(s.invoice_date)','sum(total)'); //set column field database for datatable orderable
			$this->column_search = array('MONTHNAME(s.invoice_date)'); //set column field database for datatable searchable 
			$this->order = array('invoice_date' => 'desc'); // default order 
			$this->wherecondition  =' where invoice_date >= "'.$start_date.'" and invoice_date <="'.$end_date.'" ';
			if($voucher == 'sales'){
				$this->wherecondition = $this->wherecondition  . ' and type= "sales" ';
			}
			if($voucher == 'sales_return'){
				$this->wherecondition = $this->wherecondition  . ' and type= "sales_return" ';
			}
			if($voucher == 'sales_order'){
				$this->wherecondition = $this->wherecondition  .' and type= "estimate" ';
			}
			$this->group = 'YEAR(s.invoice_date),MONTHNAME(s.invoice_date)';
		}
		
		if($voucher == 'purchase' || $voucher == 'purchase_return' || $voucher == 'purchase_order' ){
			$this->select = "DATE_FORMAT('".$end_date."', '%d/%m/%Y') as rpt_end_date,DATE_FORMAT('".$start_date."', '%d/%m/%Y') as rpt_start_date,s.type,YEAR(s.date) as year,MONTHNAME(s.date) as month,sum(total) as total,sum(case WHEN cash_type = 'Cash' then total else 0 end) as cash_amount,sum(case WHEN cash_type = 'Bank' then total else 0 end) as bank_amount,sum(case WHEN cash_type = 'Credit' then total else 0 end) as Credit_amount";
			$this->table = "purchase as s";
			$this->column_order = array(null,'MONTHNAME(s.date)','sum(total)'); //set column field database for datatable orderable
			$this->column_search = array('MONTHNAME(s.date)'); //set column field database for datatable searchable 
			$this->order = array('date' => 'desc'); // default order 
			$this->wherecondition  =' where date >= "'.$start_date.'" and date <="'.$end_date.'" ';
			if($voucher == 'purchase'){
				$this->wherecondition = $this->wherecondition  . ' and type= "purchase" ';
			}
			if($voucher == 'purchase_return'){
				$this->wherecondition = $this->wherecondition  . ' and type= "purchase_return" ';
			}
			if($voucher == 'purchase_order'){
				$this->wherecondition = $this->wherecondition  .' and type= "order" ';
			}
			$this->group = 'YEAR(s.date),MONTHNAME(s.date)';
		}
		
		if($voucher == 'rec' || $voucher == 'pay' ){
			$this->select = "DATE_FORMAT('".$end_date."', '%d/%m/%Y') as rpt_end_date,DATE_FORMAT('".$start_date."', '%d/%m/%Y') as rpt_start_date,vourcher_type as type,acc_main_id,YEAR(trans_date) as year,MONTHNAME(trans_date) as month,sum(amount) as total,sum(case WHEN acc_main_id =1 then amount else  0 end) as cash, sum(case WHEN acc_main_id =4 then amount else  0 end) as  bank";
			$this->table = "voucher as v INNER JOIN acc_ledgers as al on  v.ledger = al.id and v.published ='yes'";
			$this->column_order = array(null,'MONTHNAME(trans_date)','sum(amount)'); //set column field database for datatable orderable
			$this->column_search = array('MONTHNAME(trans_date)'); //set column field database for datatable searchable 
			$this->order = array('trans_date' => 'desc'); // default order 
			$this->wherecondition  =' where trans_date >= "'.$start_date.'" and trans_date <="'.$end_date.'" ';
			if($voucher == 'pay'){
				$this->wherecondition = $this->wherecondition  . ' and vourcher_type= "payment" ';
			}
			if($voucher == 'rec'){
				$this->wherecondition = $this->wherecondition  . ' and vourcher_type= "receipt" ';
			}
			
			$this->group = 'YEAR(trans_date),MONTHNAME(trans_date)';
		}
		
		if($voucher == 'cash' || $voucher == 'customer' || $voucher == 'supplier'  ){
			$txt  = ' and acc_main_id = 4';
			if($voucher == 'customer'){
				$txt  = ' and acc_main_id = 25';
			}
			if($voucher == 'supplier'){
				$txt  = ' and acc_main_id = 24';
			}
			
			$this->select = "DATE_FORMAT('".$end_date."', '%d/%m/%Y') as rpt_end_date,DATE_FORMAT('".$start_date."', '%d/%m/%Y') as rpt_start_date,YEAR(tran_date) as year,MONTHNAME(tran_date) as month ,sum(tran_debit) as debit,sum(tran_credit) as credit,sum(tran_debit) - sum(tran_credit) as balance,'Nil' as total,acc_main_id as type";
			$this->table = "acc_ledger_trans as alt INNER JOIN acc_ledgers as al on al.id =alt.ledger_id and alt.published ='yes' ".$txt." ";
			$this->column_order = array(null,'MONTHNAME(tran_date)'); //set column field database for datatable orderable
			$this->column_search = array('MONTHNAME(tran_date)'); //set column field database for datatable searchable 
			$this->order = array('tran_date' => 'desc'); // default order 
			$this->wherecondition  =' where tran_date >= "'.$start_date.'" and tran_date <="'.$end_date.'" ';
			$this->group = 'YEAR(tran_date),MONTHNAME(tran_date)';
			
			
		}
		
       
    }
	public function agent_list(){
		$this->select = "IFNULL(u.Id,0) as salesmanid,IFNULL(r.ref_id,0) as ref_id,user_name,IFnull(r.name,'') as agent,u.user_name as salesman,sum(case WHEN a.type ='sales' then a.total else 0 end) as salestotal,sum(case WHEN a.type ='sales_return' then a.total else 0 end) as returntotal,sum(case WHEN a.type ='estimate' then a.total else 0 end) as ordertotal,a.salesman,sum(IFNULL(case when a.type='sales' then ae.paid else 0 end,0)) + sum(case WHEN a.type='sales' and a.cash_type='Cash' or a.cash_type='Bank' then a.total else 0 end) as collection ,sum(IFNULL(case when a.type='sales' then ae.paid else 0 end ,0)) as rec_amount,sum(case WHEN a.type='sales' and a.cash_type='Credit' then a.total else 0 end) as creditsale,sum(case WHEN a.type='sales' and a.cash_type='Cash' then a.total else 0 end) as cashsale,sum(case WHEN a.type='sales' and a.cash_type='Bank' then a.total else 0 end) as banktotal";
		$this->table = "sales as a left join users as u on u.Id = a.salesman left join reference as r on r.ref_id = a.ref_id LEFT JOIN acc_ageing as ae on a.sales_id = ae.tb_id and tb_name = 'sales' and (ae.debit >0 or ae.credit > 0 )";
		$this->wherecondition  =' where 1';
		if($this->input->post('enddate') ){
			$this->wherecondition  = $this->wherecondition  . " and invoice_date <=  '".$this->getDate($this->input->post('enddate'))."'  ";
		}
		if($this->input->post('startdate') ){
			$this->wherecondition  = $this->wherecondition  . " and invoice_date >=  '".$this->getDate($this->input->post('startdate'))."'  ";
		}
		if($this->input->post('selfilter') == 'agent' ){
			$this->column_order = array(null,'r.name'); //set column field database for datatable orderable
			$this->column_search = array('r.name'); //set column field database for datatable searchable 
			$this->order = array('r.name' => 'asc'); // default order 
			$this->group = ' r.ref_id';
		}else{
			$this->column_order = array(null,'u.user_name'); //set column field database for datatable orderable
			$this->column_search = array('u.user_name'); //set column field database for datatable searchable 
			$this->order = array('user_name' => 'asc'); // default order 
			$this->group = ' u.Id';
		}
	}
	public function route_summary(){
			$txt_sales = '';
			$txt_voucher = '';
			if($this->input->post('startdate') ){
				$txt_sales = " and invoice_date >= '".$this->getDate($this->input->post('startdate'))."'  ";
				$txt_voucher  = " and v.trans_date >= '".$this->getDate($this->input->post('startdate'))."'  ";
			}
			if($this->input->post('enddate') ){
				$txt_sales = $txt_sales . " and invoice_date <=  '".$this->getDate($this->input->post('enddate'))."'  ";
				$txt_voucher  = $txt_voucher .  " and v.trans_date <=  '".$this->getDate($this->input->post('enddate'))."'  ";
			}
			$this->select = "u.Id,ifnull(rec_amount,0) as rec_amount,ifnull(pay_amount,0) as pay_amount,u.user_name,IFNULL(returntotal,0) as returntotal,ifnull(ordertotal,0) as ordertotal,ifnull(salestotal,0) as salestotal,ifnull(cashsale,0) as cashsale,ifnull(creditsale,0) as creditsale";
			$this->table = "users as u left join (select s.created_by,sum(CASE WHEN s.type ='sales_return' then s.total else 0 end) as returntotal,sum(CASE WHEN s.type ='estimate' then s.total else 0 end) as ordertotal,sum(CASE WHEN s.type ='sales' then s.total else 0 end) as salestotal,sum(case WHEN s.cash_type = 'cash' and s.type ='sales' then s.total else 0 end ) as cashsale,sum(case WHEN s.cash_type = 'credit' and s.type ='sales' then s.total else 0 end ) as creditsale from sales s  WHERE s.published ='yes' ".$txt_sales." GROUP by s.created_by) as sale on sale.created_by = u.id left join (SELECT sum(case WHEN v.vourcher_type ='receipt' then v.amount else  0 end) as rec_amount,sum(case WHEN v.vourcher_type ='payment' then v.amount else  0 end) as pay_amount,v.created_by FROM voucher as v WHERE v.published ='yes' ".$txt_voucher." GROUP by v.created_by) as vou on vou.created_by = u.Id";
			$this->column_order = array(null,'user_name'); //set column field database for datatable orderable
			$this->column_search = array('user_name'); //set column field database for datatable searchable 
			$this->order = array('user_name' => 'asc'); // default order 
			$this->wherecondition  =' where 1';
			if($this->input->post('user') ){
				$this->wherecondition  =' where u.Id='.$this->input->post('user');
			}
	}

}
