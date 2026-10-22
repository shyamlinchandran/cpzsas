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
        $this->select = '0 as lastpaid ,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name,tb_id, age_id,voucher_no,paid,balance,last_paid, `tb_name`,`tb_crdate`, CASE WHEN `credit` <>0 THEN credit -`paid` ELSE 0 END AS credit , CASE WHEN `debit` <>0 THEN debit -`paid` ELSE 0 END AS debit';
        $this->table = ' `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
    }

    /*
     * 
     * a.status!=5  deleted items 
     */

    function whereedit($vid) {
        $this->wherecondition = " WHERE a.published='yes' and a.voucher_id =".$vid." ";
        $this->select = 'tb_crdate,a.paid as lastpaid,last_paid,b.paid-a.paid as paid,age_id,tb_id,tb_name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,b.voucher_no, CASE WHEN b.`credit` <>0 THEN b.credit -b.`paid`+a.paid ELSE 0 END AS credit,CASE WHEN b.`debit` <>0 THEN b.debit -b.`paid`+a.paid ELSE 0 END AS debit';
        $this->table = ' `acc_ageing_trans` as a INNER JOIN acc_ageing as b on a.ageing_id =b.age_id';
        $this->column_order = array(null, 'tb_crdate'); //set column field database for datatable orderable
        $this->column_search = array('b.voucher_no'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
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
        if ($this->input->post('toid')) {
            $this->wherecondition = "where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.led_id =" . $this->input->post('toid');
        }
        if ($this->input->post('ledtype')) {
            $this->wherecondition = $this->wherecondition . " and ref_code ='" . $this->input->post('ledtype') . "'";
        }
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
        $this->select = 'datediff(CURDATE(), tb_crdate) as outdate,tb_id, b.name,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name, age_id,voucher_no,paid,balance,last_paid, `tb_name`,  CASE WHEN `credit` <>0 THEN credit  ELSE paid END AS credit , CASE WHEN `debit` <>0 THEN debit ELSE paid END AS debit';
        $this->table = ' `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
    }

    function where() {
        $id = $this->input->post('id');
        $payid = $this->input->post('payid');
        $this->wherecondition = "where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and  a.status!=5 and a.led_id =" . $id;
        if ($payid != 0) {
            $this->wherecondition = "where ( pay_id=$payid or ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0) and  a.status!=5 and a.led_id =" . $id;
        }
    }

    function get_josn() {
        $qery = "select a.*,b.* from `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id order by b.id desc";
        $query = $this->db->query($qery);
        return $query->result();
    }

}
