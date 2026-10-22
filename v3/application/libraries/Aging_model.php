<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aeging_Model
 *
 * @author jijodileep
 */
class Aging_model extends DataTable {

//put your code here
//acc_ageing

    public function __construct() {
        parent::__construct();
        $this->select = '0 as adjustment ,0 as is_adjust ,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdates,0 as lastpaid ,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name,tb_id, age_id,voucher_no,paid,balance,last_paid, `tb_name`,`tb_crdate`, CASE WHEN `credit` <>0 THEN credit -`paid` ELSE 0 END AS credit , CASE WHEN `debit` <>0 THEN debit -`paid` ELSE 0 END AS debit';
        $this->table = ' `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
    }

    /*
     * 
     * a.status!=5  deleted items 
     */

    // function whereedit($vid) {
    //     $this->wherecondition = " WHERE a.published='yes' and a.voucher_id =".$vid." ";
    //     $this->select = 'tb_crdate,a.paid as lastpaid,last_paid,b.paid-a.paid as paid,age_id,tb_id,tb_name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,b.voucher_no, CASE WHEN b.`credit` <>0 THEN b.credit -b.`paid`+a.paid ELSE 0 END AS credit,CASE WHEN b.`debit` <>0 THEN b.debit -b.`paid`+a.paid ELSE 0 END AS debit';
    //     $this->table = ' `acc_ageing_trans` as a INNER JOIN acc_ageing as b on a.ageing_id =b.age_id and a.voucher_type ="voucher"';
    //     $this->column_order = array(null, 'tb_crdate'); //set column field database for datatable orderable
    //     $this->column_search = array('b.voucher_no'); //set column field database for datatable searchable 
    //     $this->order = array('a.id' => 'asc'); // default order 
	// 	 if($this->input->post('voucher_type') ){
	// 	   if($this->input->post('voucher_type') == 'cheque'){
	// 			$this->table = ' `acc_ageing_trans` as a INNER JOIN acc_ageing as b on a.ageing_id =b.age_id and a.voucher_type ="cheque"';
	// 		}
	// 	}
    // }

	function whereedit($vid) {
		$id = $this->input->post('id');
        $this->wherecondition = " WHERE ((credit + debit) > b.paid or  a.paid is not null ) and credit +debit > 0   and b.led_id = ".$id."  ";
        $txt = '';
		$ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
		if($ageing_adjustment > 0 ){
			$txt = 'adjustment ,is_adjust ,';
		}
		$this->select = ''.$txt.' DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdates,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,IFNULL(a.paid,0) as lastpaid,last_paid,b.paid-IFNULL(a.paid,0) as paid,age_id,tb_id,tb_name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,b.voucher_no, CASE WHEN b.`credit` <>0 THEN b.credit -b.`paid`+IFNULL(a.paid,0) ELSE 0 END AS credit,CASE WHEN b.`debit` <>0 THEN b.debit -b.`paid`+IFNULL(a.paid,0) ELSE 0 END AS debit';
        $this->table = ' acc_ageing as b LEFT JOIN   `acc_ageing_trans` as a  on a.ageing_id =b.age_id and a.voucher_type ="voucher" and a.published="yes" and a.voucher_id ='.$vid.' ';
        $this->column_order = array(null, 'tb_crdate'); //set column field database for datatable orderable
        $this->column_search = array('b.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
		 if($this->input->post('voucher_type') ){
		   if($this->input->post('voucher_type') == 'cheque'){
				$this->table = ' acc_ageing as b  INNER JOIN `acc_ageing_trans` as a   on a.ageing_id =b.age_id and a.voucher_type ="cheque" and a.published="yes" and a.voucher_id ='.$vid.'';
			}
		}
		
		if($this->input->post('type') ){
			if($this->wherecondition != '' ){
				$this->wherecondition = $this->wherecondition . ' and';
			}
			if($this->input->post('type') == 'rec'){
				$this->wherecondition = $this->wherecondition . ' (debit -b.`paid` > 0 or a.id is not null) ';
			}else{
				$this->wherecondition = $this->wherecondition . ' (credit -b.`paid` > 0 or a.id is not null) ';
			}
		}
		$this->wherecondition = $this->wherecondition . ' and tb_name != "sales_return" and tb_name != "purchase_return" ' ;
		
    }

    function wherea() {
        if ($this->input->post('toid')) {
            $payid = $this->input->post('toid');
            if ($payid != 0) {
                $this->wherecondition = "where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.led_id =" . $payid;
            } else {
                $type = $this->input->post('typ');
                $this->wherecondition = "where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.tb_name ='" . $type . "'";
            }
        }
    }

    function outstanding() {
        
    }
	
	function wherecondition(){
		$this->wherecondition =  ' where 1 ';
		if ($this->input->post('reference')) {
			$this->wherecondition = $this->wherecondition.' and d.ref_id= '. $this->input->post('reference');
		}
		if ($this->input->post('salesman')) {
			$this->wherecondition =$this->wherecondition. ' and u.Id='.$this->input->post('salesman');
		}
		if ($this->input->post('user')) {
			$this->wherecondition =$this->wherecondition. ' and c.created_by='.$this->input->post('user');
		}
		if ($this->input->post('btype')) {
			$this->wherecondition =$this->wherecondition. ' and c.bill_type='.$this->input->post('btype');
		}
		if ($this->input->post('area')) {
			$this->wherecondition =$this->wherecondition. ' and c.area='.$this->input->post('area');
		}
		
	}
	
	function salesaging(){
		 $this->select = 'IFNULL(u.user_name,"") as user,IFNULL(d.name,"") as names,datediff(CURDATE(), tb_crdate) as outdate,tb_id, b.name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name, age_id,voucher_no,paid,balance,last_paid, `tb_name`,  CASE WHEN `credit` <>0 THEN credit  ELSE paid END AS credit , CASE WHEN `debit` <>0 THEN debit ELSE paid END AS debit';
        $this->table = ' `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id inner join sales as c on c.sales_id=a.tb_id and a.tb_name="Sales" left join reference as d on c.ref_id =d.ref_id left join users as u on u.Id=c.salesman ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
	}

    function age() {
		$ageing_adjustment = 0;
		$settings = $this->getCompanySettings();
		if(isset($settings[0]['ageing_adjustment'])){
			$ageing_adjustment = $settings[0]['ageing_adjustment'];
		}
		$ageing_adjustment_text = "";
		if($ageing_adjustment > 0 ){
			$ageing_adjustment_text = " and a.adjustment_amount <= 0 "; 
		}
		$filter_by = $this->input->post('filter_by');
		$where_sales = '';
		$where_purchase = '';
		if($this->input->post('startdate')){
			if($filter_by == 'invoice_date'){
				$where_sales  =  $where_sales  . ' and s.invoice_date >= "'.$this->getDate($this->input->post('startdate')).'" ' ;
				$where_purchase = $where_purchase. ' and p.date >= "'.$this->getDate($this->input->post('startdate')).'" ' ;
			}else{
				$where_sales  = $where_sales  . ' and s.due_date >= "'.$this->getDate($this->input->post('startdate')).'" ' ;
				$where_purchase = $where_purchase .' and p.due_date >= "'.$this->getDate($this->input->post('startdate')).'" ' ;
			}
		}
		
		if($this->input->post('enddate')){
			if($filter_by == 'invoice_date'){
				$where_sales  =  $where_sales . ' and s.invoice_date <= "'.$this->getDate($this->input->post('enddate')).'" ' ;
				$where_purchase =$where_purchase . ' and p.date <= "'.$this->getDate($this->input->post('enddate')).'" ' ;
			}else{
				$where_sales  =  $where_sales  .' and s.due_date <= "'.$this->getDate($this->input->post('enddate')).'" ' ;
				$where_purchase = $where_purchase. ' and p.due_date <= "'.$this->getDate($this->input->post('enddate')).'" ' ;
			}
		}
		
		
        $this->select = 'DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdates,route_name,ims_area.area as area_name,IFNULL(p.due_date,s.due_date) due,DATEDIFF ( IFNULL(p.due_date,s.due_date),IFNULL(s.invoice_date,p.date) )  as day,IFNULL(s.invoice,p.bill_no) as billno,s.due_date,p.due_date as pur_due_date,sb.branch_id,datediff(CURDATE(), tb_crdate) as outdate,tb_id, b.name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name, age_id,voucher_no,paid,balance,last_paid, `tb_name`,  CASE WHEN `credit` <>0 THEN credit  ELSE paid END AS credit , CASE WHEN `debit` <>0 THEN debit ELSE paid END AS debit,return_amount';
        $this->table = ' `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id left join sales as s on s.sales_id = a.tb_id and a.tb_name = "sales" '.$where_sales.'  left join suppliers as sup on sup.id =customer_id left join ims_area on ims_area.id = sup.area left join ims_route on ims_route.id = sup.route left join set_billtype as sb on sb.id = s.bill_type left join purchase as p on p.id = a.tb_id and a.tb_name = "purchase"  '.$where_purchase.' left join set_billtype as pb on pb.id = p.bill_type  ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
		$this->wherecondition = " where (s.sales_id is not null or p.id is not null) ";

		if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . " $ageing_adjustment_text and  ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.led_id =" . $this->input->post('toid');
        }
        if ($this->input->post('ledtype')) {
            $this->wherecondition = $this->wherecondition . " and ref_code ='" . $this->input->post('ledtype') . "'";
        }
		if ($this->input->post('salesman')) {
			$this->wherecondition =$this->wherecondition. ' and (s.salesman='.$this->input->post('salesman') .' or p.salesman = '.$this->input->post('salesman').' ) ';
		}
		if ($this->input->post('reference')) {
			$this->wherecondition =$this->wherecondition. ' and s.ref_id='.$this->input->post('reference');
		}
		if ($this->input->post('user')) {
			$this->wherecondition =$this->wherecondition. ' and (s.created_by='.$this->input->post('user') .' or p.created_by = '.$this->input->post('user').' ) ';
		}
		if ($this->input->post('btype')) {
			$this->wherecondition =$this->wherecondition. ' and (s.bill_type='.$this->input->post('btype') .' or p.bill_type = '.$this->input->post('btype').' ) ';
		}
		if ($this->input->post('branch')) {
			$this->wherecondition =$this->wherecondition. ' and (sb.branch_id='.$this->input->post('branch') .' or pb.branch_id = '.$this->input->post('branch').' ) ';
		}

		if ($this->input->post('area')) {
			$this->wherecondition =$this->wherecondition. ' and sup.area='.$this->input->post('area');
		}
		if ($this->input->post('route')) {
			$this->wherecondition =$this->wherecondition. ' and sup.route='.$this->input->post('route');
		}
		
			//$this->wherecondition =$this->wherecondition. ' and IFNULL(s.invoice,p.bill_no) is not null and IFNULL(s.invoice,p.bill_no) !="" and IFNULL(s.invoice,p.bill_no) != "null" ';
		

    }

    function where() {
        $id = $this->input->post('id');
        $payid = $this->input->post('payid');
        $this->wherecondition = "where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.led_id =" . $id;
        if ($payid != 0) {
            $this->wherecondition = "where ( pay_id=$payid or ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0) and  a.status!=5 and a.led_id =" . $id;
        }
		
		if($this->input->post('type') ){
			if($this->wherecondition != '' ){
				$this->wherecondition = $this->wherecondition . ' and';
			}
			if($this->input->post('type') == 'rec'){
				$this->wherecondition = $this->wherecondition . ' debit -`paid` > 0 ';
			}else{
				$this->wherecondition = $this->wherecondition . ' credit -`paid` > 0 ';
			}
		}

		$txt = '';
		$ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
		if($ageing_adjustment > 0 ){
				$this->wherecondition = $this->wherecondition . ' and adjustment_amount <= 0  ';
		}


    }

    function get_josn() {
        $qery = "select a.*,b.* from `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id order by b.id desc";
        $query = $this->db->query($qery);
        return $query->result();
    }

}
