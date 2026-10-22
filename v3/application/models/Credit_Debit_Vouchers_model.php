<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of voucher_model
 *
 * @author u43255
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('dataTable.php');

class Credit_Debit_Vouchers_model extends DataTable {

    function __construct() {
        parent::__construct();
		
        $this->select = "a.amount,a.id,a.type,led.name as mainledname,a.*,REPLACE(GROUP_CONCAT(al.name SEPARATOR '<br />'), ' ', '') as name,REPLACE(GROUP_CONCAT(credit SEPARATOR '<br />'), ' ', '') as credit,REPLACE(GROUP_CONCAT(debit SEPARATOR '<br />'), ' ', '') as debit";
		$this->table = 'credit_debit_voucher as a inner join acc_ledgers as led on led.id = a.main_ledger INNER JOIN credit_debit_voucher_trans as b on a.id = b.vid and a.published = "yes" and b.published = "yes" INNER JOIN acc_ledgers as al on al.id = b.ledger';
		$this->column_order = array(null, 'voucher_no', 'date', 'al.name', 'narration'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'date', 'al.name', 'narration'); //set column field database for datatable searchable
        $this->order = array('a.id' => 'desc'); // default order
        $this->group = "a.id"; // default order 
		if($this->input->post('type')){
			$this->wherecondition = ' where a.type = "'.$this->input->post('type').'" ';
		
		}
    }
	
	function delete($id) {
        $qry = "update  credit_debit_voucher set published ='no'   where id =" . $id;
        $this->db->query($qry);
        $qry = "update  credit_debit_voucher_trans  set published ='no'  where vid =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no'  where tb_name='credit_debit_voucher' and tb_id =" . $id;
        $this->db->query($qry);
		
    }
	
	function getsing($id){
		$qry = "SELECT IFNULL(sup.phone,'') as supphone,IFNULL(sup.tin,'') as suptin,IFNULL(sup.address_line1,'') as address,IFNULL(sup.name,'') as supname,DATE_FORMAT(date, '%d/%m/%Y')  as tran_date,a.*,c.debit,c.credit,al.name as ledgername,c.ledger,led.name as mainledgername from credit_debit_voucher as a INNER JOIN acc_ledgers as led on a.main_ledger = led.id Left join suppliers as sup on sup.id = led.ref_id and led.ref_code in ('cus','sup') INNER JOIN credit_debit_voucher_trans as c on c.vid = a.id and c.published ='yes' INNER JOIN acc_ledgers as al on al.id =c.ledger where a.id = ".$id;
		return $this->db->query($qry)->result_array();
	}
	
	function generatevouchernumber($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM credit_debit_voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from credit_debit_voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
                . " c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = $query['top'] + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }
	
	public function update_voucher($data,$id){
		$this->db->where('id',$id);
		$this->db->update('credit_debit_voucher',$data);
		$qry = "update acc_ledger_trans set published = 'no' where tb_name ='credit_debit_voucher' and tb_id = '".$id."' ";
		$this->db->query($qry);
		$qry = 'update credit_debit_voucher_trans set published = "no" where vid = "'.$id.'" ';
		$this->db->query($qry);
	}
	
	public function insert_voucher($data){
		$this->db->insert('credit_debit_voucher',$data);
		return $this->db->insert_id();
	}
	
	function getnewinoviceno($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['startnumber'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM credit_debit_voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from credit_debit_voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
                . " c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            return $query['top'] + 1;
        }
    }
	
	
	

}
