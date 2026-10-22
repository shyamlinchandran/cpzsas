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
class Ledger_balance_model extends DataTable {

    function where() {
		$text = '';
		if($this->input->post('area') ){
			$text = " and a.area = ".$this->input->post('area');
		}
		if($this->input->post('route') ){
			$text = " and a.route = ".$this->input->post('route');
		}
		if($this->input->post('customer_type') ){
			$text = " and a.customer_type = ".$this->input->post('customer_type');
		}
        $this->select = "b.type as baltype,ia.area as areaname,route_name,b.id as ledid,IFNULL(credit,0) as credit,IFNULL(debit,0) as debit,b.type,b.id,IFNULL(d.bal,0) as tran_amt ,IFNULL(d.bal,0)  as Closing_balance,a.name,IFNULL(b.openning_bal,0) as openning_bal,phone ";
        if ($this->input->post('type') == "all") {
            $this->table = "suppliers as a left  join ims_area as ia on ia.id = a.area left join ims_route as ir on ir.id = a.route  inner join acc_ledgers as b on a.id=b.ref_id ".$text." and b.ref_code in('sup','cus')  left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes' and c.tran_date<='" . $this->getDate($this->input->post('date')) . "' GROUP by c.ledger_id ) as d on d.ledger_id=b.id  ";
        } else {
            $this->table = "suppliers as a left join ims_area as ia on ia.id = a.area left join ims_route as ir on ir.id = a.route  inner join acc_ledgers as b on a.id=b.ref_id ".$text." and b.ref_code in('" . $this->input->post('type') . "')  left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes' and c.tran_date<='" . $this->getDate($this->input->post('date')) . "' GROUP by c.ledger_id ) as d on d.ledger_id=b.id  ";
        }
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.name' => 'asc'); // default order  
		if($this->input->post('bal_type') ){
			$this->wherecondition = ' where a.name != "" and a.name is not null and IFNULL(debit,0) - IFNULL(credit,0) + case when b.type = "Dr" then b.openning_bal else b.openning_bal*-1 end  != 0  ';
		}else{
			$this->wherecondition = ' where a.name != "" and a.name is not null  ';

		}
		
	}
	
	function receivable_list(){
		$this->select = "s.invoice,s.invoice_date,total,ae.debit,ae.paid,s.total - ae.paid as balance,sup.name,s.due_date,DATEDIFF ( due_date,invoice_date )  as day";
		$this->table  ="sales as s inner join set_billtype as sb on sb.id = s.bill_type INNER join acc_ageing as ae on s.sales_id = ae.tb_id and ae.tb_name = 'sales' and s.cash_type = 'credit' INNER JOIN suppliers as sup on sup.id = s.customer_id";
		$this->column_order = array(null, 's.invoice_date','s.invoice','sup.name'); //set column field database for datatable orderable
        $this->column_search = array('s.invoice_date','s.invoice','sup.name'); //set column field database for datatable searchable 
        $this->order = array('s.sales_id' => 'asc'); // default order    
		$this->wherecondition  = ' where 1';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
		if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . ' and  s.bill_type  =' . $this->input->post('btype');
        }
		if ($this->input->post('cusid')) {
            $this->wherecondition = $this->wherecondition . ' and  s.customer_id  =' . $this->input->post('cusid');
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
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
		if ($this->input->post('branch')) {
			$this->wherecondition = $this->wherecondition . ' and  sb.branch_id  ="' . $this->input->post('branch').'"';
		}
	}
	
	 function transaction_list() {

        $this->select = "al.id as supledgerid,al.name,sum(alt.tran_debit) as debit,sum(alt.tran_credit) as credit,sum(alt.tran_debit) - sum(alt.tran_credit) as balance";
		$this->table  ="acc_ledgers as al INNER JOIN acc_ledger_trans as alt on al.id = alt.ledger_id and alt.published = 'yes' and acc_main_id =  ".$this->input->post('acc_main_id')." ";
		$this->column_order = array(null, 'al.name'); //set column field database for datatable orderable
        $this->column_search = array('al.name'); //set column field database for datatable searchable 
        $this->order = array('al.name' => 'asc'); // default order    
		$this->wherecondition  = ' where 1';
		$this->group = '  al.id '; 
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }

        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
    }
	
	function new_ajax_list() {
		$txt = '';
		if($this->input->post('type')){
			$txt = ' and ref_code = "'.$this->input->post('type').'" ';
		}
        $this->select = "ia.area as areaname,route_name,b.openning_bal,b.type as bal_type,sup.credit_period,sup.credit_amount,b.openning_bal,sum(CASE WHEN tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -15 DAY) then debit - paid else 0 end) as first,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -15 DAY) and tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -30 DAY)  then debit  - paid else 0 end) as second,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -30 DAY) and tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -45 DAY)  then debit  - paid else 0 end) as third,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -45 DAY) and tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -60 DAY)  then debit  - paid else 0 end) as fourth,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -60 DAY) and tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -90 DAY)  then debit  - paid else 0 end) as fifth,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -90 DAY) and tb_crdate >= DATE_ADD(CURDATE(), INTERVAL -120 DAY)  then debit  - paid else 0 end) as sixth,sum(CASE WHEN tb_crdate < DATE_ADD(CURDATE(), INTERVAL -120 DAY)  then debit  - paid else 0 end) as seventh,a.*,b.name,IFNULL(x.balance,0) + CASE WHEN b.type = 'Dr' then b.openning_bal else b.openning_bal*-1 end as customer_balance ";
		$this->table  ="suppliers as sup left join ims_area as ia on ia.id = sup.area left join ims_route as ir on ir.id = sup.route  INNER JOIN acc_ledgers as b on sup.id = b.ref_id ".$txt ." and b.ref_code in ('cus','sup')  left join `acc_ageing` as a  on a.led_id = b.id and (a.debit > 0 or a.credit > 0 )    LEFT JOIN (SELECT sum(c.tran_debit) -sum(c.tran_credit) as balance,c.ledger_id from acc_ledger_trans as c WHERE c.published ='yes' GROUP by c.ledger_id) as x on x.ledger_id = b.id ";
		$this->column_order = array(null, 'al.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'asc'); // default order    
		$this->wherecondition  = ' where 1';
		$this->group = '  b.id '; 
		$this->wherecondition  = ' where 1';
		if($this->input->post('area')){
			$this->wherecondition  = $this->wherecondition  .' and sup.area = '.$this->input->post('area').' ';
		}
		if($this->input->post('route')){
			$this->wherecondition  = $this->wherecondition  .' and sup.route = '.$this->input->post('route').' ';
		}
		if($this->input->post('bal_type')){
			$this->having  = ' customer_balance > 0 or customer_balance < 0 ';
		}
		
    }

}
