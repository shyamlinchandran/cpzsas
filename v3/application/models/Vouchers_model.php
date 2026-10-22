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

class Vouchers_model extends DataTable {

    function __construct() {
        parent::__construct();
		$txt = '';
		if($this->input->post('user') ){
			$txt = ' and a.created_by = ' .$this->input->post('user');
		}
        
        $txtamt = ', GROUP_CONCAT(c.name) AS names,GROUP_CONCAT(FORMAT(b.credit_amounnt,2) SEPARATOR \';\') AS credit_amounnts ,GROUP_CONCAT(FORMAT(b.debit_amount,2) SEPARATOR \';\') AS debit_amounts';
        if($this->input->post('type') == 'contra' ){
             $txtamt = ',c.name as names,FORMAT(b.credit_amounnt,2) AS credit_amounnts,FORMAT(b.debit_amount,2) AS debit_amounts,GROUP_CONCAT(case when  b.debit_amount >0 then c.name else null end) as toa,GROUP_CONCAT(case when  b.debit_amount = 0 then c.name else null end) as fr  ';
        }

        $this->select = 'cu.user_name as createduser,led.name as ledname,DATE_FORMAT(trans_date, "%d/%m/%Y")  as tran_date,voucher_no  as invoice, a.published as  pub, a.id as v_id,a.*'.$txtamt.'';
        $this->table = '`voucher` as a left join users as cu on cu.id=a.created_by  inner join acc_ledgers as led on led.id=a.ledger '.$txt.'  inner join voucher_trans as b on a.id =b.voucher_id and b.published = "yes" inner join  acc_ledgers as c on b.acc_ledgers_id=c.id';
        $this->column_order = array(null, 'name', 'naration', 'trans_date', 'amount', 'vourcher_type', 'voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'c.name', 'a.trans_date', 'naration'); //set column field database for datatable searchable
        $this->order = array('a.id' => 'desc'); // default order
        $this->group = "a.id"; // default order 
    }
	
	function check_invoice_exist($voucher_no,$bill_type){
		$qry = "SELECT * FROM `voucher` WHERE voucher_no = '".$voucher_no."' and bill_type = '".$bill_type."' and published = 'yes'";
		$query = $this->db->query($qry);
		return $query->num_rows();
		
	}
	function getreturnledgers($return_id){
		$qry = "select b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from  acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE  b.id in(".$return_id.")  ";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
// need to call where in ajax pagging 
    function where() {
        $this->wherecondition = '';
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        if ($this->input->post('type')) {
            $this->wherecondition = "where  vourcher_type = '" . $this->input->post('type') . "'";
            if ($this->input->post('type') != 'journal' && $this->input->post('type') != 'contra') {
                $this->wherecondition = $this->wherecondition . " and c.acc_main_id not in (1,4) and   b.acc_ledgers_id !=" . $this->cashaccount . "";
            }else if($this->input->post('type') == 'contra' ){
               // $this->wherecondition = $this->wherecondition . " and  b.acc_ledgers_id !=a.ledger";
			}
        }
		$this->wherecondition = $this->wherecondition . " and b.published= 'yes'";
         if ($this->input->post('main_acc')) {
			 $this->wherecondition =$this->wherecondition .  " and c.acc_main_id = '" . $this->input->post('main_acc') . "'";
		 }
		 if ($this->input->post('toid')) {
			 $this->wherecondition =$this->wherecondition .  " and b.acc_ledgers_id = '" . $this->input->post('toid') . "'";
		 }
		  if ($this->input->post('salesman')) {
			 $this->wherecondition =$this->wherecondition .  " and a.salesman = '" . $this->input->post('salesman') . "'";
		 }
		 if ($this->input->post('paytype')) {
			 $this->wherecondition =$this->wherecondition .  " and led.acc_main_id= '" . $this->input->post('paytype') . "'";
		 }

         if ($this->input->post('contra_type')) {
			 $this->wherecondition =$this->wherecondition .  " and contra_type= '" . $this->input->post('contra_type') . "'";
		 }
		 if ($this->input->post('btype')) {
			 $this->wherecondition =$this->wherecondition .  " and bill_type = '" . $this->input->post('btype') . "'";
		 }
		 if ($this->input->post('startdate')) {
			if ($this->wherecondition == '') {
                $this->wherecondition = "where a.trans_date >= '" . $this->getDate($this->input->post('startdate')) . "'";
            } else {
                $this->wherecondition = $this->wherecondition . " and a.trans_date >= '" . $this->getDate($this->input->post('startdate')) . "'";
            }
			
		}
		if ($this->input->post('enddate')) {
			if ($this->wherecondition == '') {
                $this->wherecondition = "where a.trans_date <= '" . $this->getDate($this->input->post('enddate')) . "'";
            } else {
                $this->wherecondition = $this->wherecondition . " and a.trans_date <= '" . $this->getDate($this->input->post('enddate')) . "'";
            }
			
		}
		
    }

    function wherecustomer() {
        $this->wherecondition = '';
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		$this->wherecondition  =  ' where a.published = "yes" ';
        if ($this->input->post('supid')) {

            if ($this->wherecondition == '') {
                $this->wherecondition = "where a.published = 'yes' and  c.ref_id = '" . $this->input->post('supid') . "'";
            } else {
                $this->wherecondition = $this->wherecondition . "and c.ref_id = '" . $this->input->post('supid') . "'";
            }
        }
		 if ($this->input->post('vourcher_type')) {
			 $this->wherecondition = $this->wherecondition . ' and  vourcher_type = "'.$this->input->post('vourcher_type').'"';
		}
    }
	function get_selected($id) {
		$qry = " select ifnull(GROUP_CONCAT(a.voucher_no),'') as vno from voucher as v left JOIN acc_ageing_trans as at on v.id = at.voucher_id and at.published='yes' and at.voucher_type = 'voucher' left JOIN acc_ageing as a on a.age_id = at.ageing_id WHERE v.id = ".$id." and at.paid > 0";
		$query = $this->db->query($qry);
        $query = $query->row_array();
		return $query;
	}

    function get_selected_ageing($id) {
		$qry = " SELECT b.voucher_no,a.paid,b.credit + b.debit - b.paid AS balance FROM acc_ageing_trans AS a  INNER  join acc_ageing AS b ON a.ageing_id = b.age_id AND  a.published = 'yes' AND a.voucher_type = 'voucher' AND a.voucher_id =  ".$id." and a.paid > 0";
		$query = $this->db->query($qry);
        $query = $query->result_array();
		return $query;
	}
    function getvouchers($id) {
        $qry = "select b.acc_main_id,a.* from voucher as a inner join acc_ledgers as b on a.ledger = b.id where a.id=" . $id;
        $query = $this->db->query($qry);
        $query = $query->row_array();
        $acc_main_id = $query['acc_main_id'];
        $qry = 'select ' . $acc_main_id . ' as acc_main,e.name as mainled,e.id as mainledid,DATE_FORMAT(a.trans_date, "%d/%m/%Y" ) as dtp, a.published as pub, a.*,b.*,c.* from voucher as a inner join voucher_trans as b on a.id =b.voucher_id  inner join acc_ledgers  as c on b.acc_ledgers_id =c.id left join acc_main as e on e.id=c.acc_main_id where b.published="yes" and voucher_id =' . $id . '   and c.acc_main_id not in (1,4) and b.acc_ledgers_id !=' . $this->cashaccount;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getjouvouchers($id) {
        $qry = 'select  e.name as mainled,e.id as mainledid,DATE_FORMAT(a.trans_date, "%d/%m/%Y" ) as dtp, a.published as pub, a.*,b.*,c.* from voucher as a inner join voucher_trans as b on a.id =b.voucher_id  inner join acc_ledgers  as c on b.acc_ledgers_id =c.id  left join acc_main as e on e.id=c.acc_main_id where b.published ="yes" and  voucher_id =' . $id;
        //echo $qry;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function max() {
        $qry = 'select max(id) as max_id from voucher where published = "yes"  and vourcher_type ="' . $this->input->post('type') . '"';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

   	function getcontraVoucher($id) {
		 $qry = "SELECT a.*,b.*,DATE_FORMAT(a.trans_date, '%d/%m/%Y' ) as dtp FROM `voucher` as a INNER JOIN voucher_trans as b on a.id=b.voucher_id and b.published='yes' and a.id=".$id;
		 $query = $this->db->query($qry);
        return $query->result_array();
	 }
	 
	function mobile_ageing_trans_save($type, $id, $tp,$ageing_id,$amount) {
	if ($type == 'pay') {
		
	}
	$data = array(
		'ageing_id' => $ageing_id,
		'voucher_id' => $id,
		'paid' => $amount,
		'published' => 'yes',
		);

	$this->db->insert('acc_ageing_trans', $data);
}

    function mobile_ageing_save($type, $id, $tp,$age_id,$paid) {
		if ($paid == '' || $paid == NULL) {
			$paid = 0;
		}
		$ls = " , last_paid=" . $paid . "";
		$qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=(credit+debit)-(paid+" . (float) $paid . "), pay_id= " . $id . ",paid = paid +" . $paid . "  $ls where age_id = " . $age_id;
		$this->db->query($qry);
	
	}


    function savecontra() {
        $vid = $this->input->post('vid');
        if($vid > 0 ){
            $this->checkvoucherAudit($vid,'voucher');
        }
		$invoice = $this->input->post('invoice');
		$btype = $this->input->post('btype');
		$date =$this->getDate($this->input->post('date', true));
		$contra_type = $this->input->post('contra_type');
		$frm_act = $this->input->post('frm_act');
		$to_act = $this->input->post('to_act');
		$amount = $this->input->post('amount');
		$narration = $this->input->post('narration');
		$tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		$data = array(
            'amount' => $amount,
            'bill_type' => $btype,
            'naration' => $narration,
			'contra_type'=>$contra_type,
            'trans_date' => $date,
            'vourcher_type' => "contra",
            'created_by' => $created_by,
            'created_date' => date('Y-m-d'),
            'is_post' => "yes",
            'published' => "yes"
        );
		if ($vid == 0) {
            $data['voucher_no'] = $invoice;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
            $this->checkvoucherAudit($insert_id,'voucher');
        } else {
            $qry = 'select * from voucher where id =' . $vid;
            $query = $this->db->query($qry)->row_array();
            $voucher_no = $query['voucher_no'];
			$invoice = $query['voucher_no'];
            $tp = 'e';
            $insert_id = $vid;
            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher'  and trn_tp !='Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
            $this->updatevoucherAudit($vid,'voucher','contra',$voucher_no,$data['amount'],'',0,0,$data['created_by']);

        }
		$qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $to_act . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($invoice, $insert_id, "voucher", "contra", $frm_act, $to_act, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], 1, 1);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $frm_act . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);
        $this->trans_save($invoice, $insert_id, "voucher", "contra", $to_act, $frm_act, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], 1, 1);
        
        $response = array(
            'valid' => false,
            'message' => $this->msgcheck($insert_id, 'voucher')
        );
        return $response;
    }

    function savejournel() {
        //$voucher_no = $this->generatenumber('jou');
        $billtype = $this->input->post('btype');
		$voucher_no = $this->vouchers->generatevouchernumber($billtype);
        $branch = $this->getbranch($billtype);
        $tmp = $this->session->userdata('user');
        $narration_sub = $this->input->post('narration_sub', true);
        $created_by = $tmp['Id'];
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $date = $this->getDate($this->input->post('date', true));
        $debit = $this->input->post('debit', true);
        $credit = $this->input->post('credit', true);
        $credit = $this->input->post('credit', true);
        $total = 0.00;
        $vid = $this->input->post('vid');
        if($vid > 0 ){
            $this->checkvoucherAudit($vid,'voucher');
         }
        $id = $this->input->post('id', true);
        $narration = $this->input->post('narration');
        $length = sizeof($debit);
        for ($i = 0; $i < $length; $i++) {
            $total = $total + $credit[$i];
        }
        $tp = 'n';
        $data = array(
            'amount' => $total,
            'cost_center' => $costcenter,
            'bill_type' => $billtype,
            'naration' => $narration,
            'trans_date' => $date,
            'vourcher_type' => "journal",
            'created_by' => $created_by,
            'created_date' => date('Y-m-d'),
            'is_post' => "yes",
            'published' => "yes"
        );
        $insert_id = 0;
        if ($vid == 0) {
            $data['voucher_no'] = $voucher_no;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
            $this->checkvoucherAudit($insert_id,'voucher');
        } else {
            $qry = 'select * from voucher where id =' . $vid;
            $query = $this->db->query($qry)->row_array();
            $voucher_no = $query['voucher_no'];
            $tp = 'e';
            $insert_id = $vid;
            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and trn_tp !='Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
            $this->updatevoucherAudit($vid,'voucher','journal',$voucher_no,$data['amount'],'',0,0,$data['created_by']);

        }

        $cr_ld = 0;
        $dr_ld = 0;
        $cr_amt = 0;
        $dr_amt = 0;
        for ($i = 0; $i < $length; $i++) {
            if((float)$credit[$i] > 0 ){
                if((float)$credit[$i] >  $cr_amt ){
                    $cr_amt = $credit[$i];
                    $cr_ld = $id[$i];
                }
            }

            if((float)$debit[$i] > 0 ){
                if((float)$debit[$i] >  $dr_amt ){
                    $dr_amt = $debit[$i];
                    $dr_ld = $id[$i];
                }
            }
        }


        for ($i = 0; $i < $length; $i++) {
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount,sub_narration) values  (' . $insert_id . ',' . $id[$i] . ',' . $credit[$i] . ',' . $debit[$i] . ',"' . $narration_sub[$i] . '")';
            $this->getSaved($qry);
            if($credit[$i] > 0 ){
                $toids = $dr_ld;
            }else{
                $toids = $cr_ld;
               
            }
            
            $this->trans_save($voucher_no, $insert_id, 'voucher', "journal", $toids, $id[$i], $date, $credit[$i], $debit[$i], $narration_sub[$i], $created_by, $costcenter, $branch);
        }
        $response = array(
            'valid' => false,
            'message' => $this->msgcheck($insert_id, 'voucher')
        );
        $this->ageing_save_jour($insert_id, $tp);
        return $response;
    }

    public function alreadyexistcheck() {
        $invoice = $this->input->post('field1');
        $qry = "select count(*) as cnt from voucher where voucher_no='$invoice'";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    function getnewinoviceno($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['startnumber'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
//        $qry = "SELECT voucher_no FROM  voucher where  bill_type='" . $type . "' order by id desc limit 0,1";
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
                . " c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            return $query['top'] + 1;
        }
    }

    function generatevouchernumber($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
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

    function generatenumber($type) {
        $paycode = $this->getValue('paycode');
        $reccode = $this->getValue('reccode');
        $joucode = $this->getValue('joucode');
        if ($type == 'pay') {
            $code = $paycode;
            $mtype = 'payment';
        }
        if ($type == 'rec') {
            $code = $reccode;
            $mtype = 'receipt';
        }
        if ($type == 'jou') {
            $code = $joucode;
            $mtype = 'journal';
        }
        $qry = "SELECT voucher_no FROM  voucher where  vourcher_type='" . $mtype . "' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = explode("-", $query['voucher_no']);
            $num = $res[0] . '-' . ($res[1] + 1);
            return $num;
        }
    }

    function delete($id) {
        $settings = $this->getCompanySettings();
        $ageing_adjustment = 0 ;
        if (isset($settings[0]['ageing_adjustment'])) {
            $ageing_adjustment = $settings[0]['ageing_adjustment'];
        }
        $qry = "delete from voucher where id =" . $id;
        $this->db->query($qry);
        $qry = "delete from voucher_trans  where voucher_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from acc_ledger_trans  where tb_name='voucher' and trn_tp !='Cheque' and tb_id =" . $id;
        $this->db->query($qry);
		$qry = "SELECT * FROM `acc_ageing_trans` where voucher_type = 'voucher' and  published ='yes' and voucher_id = ".$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->result_array();
			foreach($query as $item){
				$qry = "update acc_ageing set paid = paid - ".$item['paid'] ." where age_id = ".$item['ageing_id']." ";
				$this->db->query($qry);
				$qry = "update acc_ageing set balance = balance + ".$item['paid'] ." where age_id = ".$item['ageing_id']." ";
				$this->db->query($qry);

                if($ageing_adjustment > 0 ){
                    $qry = "update acc_ageing set adjustment_amount = adjustment_amount - ".$item['adjustment'] ." where age_id = ".$item['ageing_id']." ";
				    $this->db->query($qry);
                }


			}
		}
    }

    function cancel($id) {
        $settings = $this->getCompanySettings();
        $ageing_adjustment = 0 ;
        if (isset($settings[0]['ageing_adjustment'])) {
            $ageing_adjustment = $settings[0]['ageing_adjustment'];
        }
        $qry = "update  voucher set published ='no'  where id =" . $id;
        $this->db->query($qry);
        $qry = "update  voucher_trans set published ='no' where voucher_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and trn_tp !='Cheque' and tb_id =" . $id;
        $this->db->query($qry);
		$qry = "SELECT * FROM `acc_ageing_trans` where published ='yes' and voucher_id = ".$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->result_array();
			foreach($query as $item){
				$qry = "update acc_ageing set paid = paid - ".$item['paid'] ." where age_id = ".$item['ageing_id']." ";
				$this->db->query($qry);
				$qry = "update acc_ageing set balance = balance + ".$item['paid'] ." where age_id = ".$item['ageing_id']." ";
				$this->db->query($qry);
                if($ageing_adjustment > 0 ){
                    $qry = "update acc_ageing set adjustment_amount = adjustment_amount - ".$item['adjustment'] ." where age_id = ".$item['ageing_id']." ";
				    $this->db->query($qry);
                }
			}
		}
    }

    function UpdatePaymentVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger) {
        $created_by  = 1;
        if ($this->session->has_userdata('user')) {
            $tmp = $this->session->userdata('user');
            $created_by = $tmp['Id'];
            // Now you can safely use $tmp
        } 
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $insert_id = 0;
        $cash = $this->getValue('cash');
        $data['vourcher_type'] = "payment";
        //$voucher_no = $this->generatenumber($type);
        if ($vid == 0) {
            $data['voucher_no'] = $voucher_no;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $tp = 'e';
            $insert_id = $vid;
            $voucher_no = $this->input->post('new_invoice');
            $this->updatevoucherAudit($vid,'voucher','payment',$voucher_no,$data['amount'],'',0,0, $created_by);

            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $data['created_by'] =  $created_by;
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and trn_tp !='Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }

        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, "voucher", "payment", $ledger, $toid, $data['trans_date'], '0.00', $data['amount'], $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, "voucher", "payment", $toid, $ledger, $data['trans_date'], $data['amount'], '0.00', $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $response = array(
            'valid' => true,
            'message' => $this->msgcheck($insert_id, 'voucher'),
            'id' => $insert_id
        );
        return $response;
    }

    function UpdateReceiptVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger) {
        $created_by  = 1;
        if ($this->session->has_userdata('user')) {
            $tmp = $this->session->userdata('user');
            $created_by = $tmp['Id'];
            // Now you can safely use $tmp
        } 
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $cash = $this->getValue('cash');
        //$voucher_no = $this->generatenumber($type);
        $data['vourcher_type'] = "receipt";
        $insert_id = 0;
        if ($vid == 0) {
            $data['voucher_no'] = $voucher_no;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $voucher_no = $this->input->post('new_invoice');
            $this->updatevoucherAudit($vid,'voucher','receipt',$voucher_no,$data['amount'],'',0,0,$created_by);

            $tp = 'e';
            $insert_id = $vid;
            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $data['created_by'] = $created_by;
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and trn_tp !='Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }
        $this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $cash . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);

        $response = array(
            'valid' => true,
            'message' => $this->msgcheck($insert_id, 'voucher'),
            'id' => $insert_id
        );
        return $response;
    }

    function save() {
        ///voucher_no
        $ledger = $this->input->post('frmact');
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $tp = 'n'; // this is for new save 
        $cash = $this->getValue('cash');
        $type = $this->input->post('type', true);
        $toid = $this->input->post('toid', true);
        $vid = $this->input->post('vid', true);
        $billtype = $this->input->post('btype');
        $branch = $this->getbranch($billtype);
        $date = $this->getDate($this->input->post('date', true));
        $amount = $this->input->post('amount', true);
        $narration = $this->input->post('narration', true);
        $response = array(
            'valid' => false,
            'message' => 'illegal Response'
        );
		$invoices = '';
		if( $this->input->post('invoices')  ){
			$invoices = $this->input->post('invoices');
		}
		$salesman = 0 ;
		if($this->input->post('salesman')){
			$salesman = $this->input->post('salesman');
		}
        $data = array(
            'ledger' => $ledger,
            'amount' => $amount,
			'salesman'=>$salesman,
			'invoices'=>$invoices,
            'cost_center' => $costcenter,
            'naration' => $narration,
            'trans_date' => $date,
            'created_date' => date('Y-m-d'),
            'is_post' => "yes",
            'bill_type' => $billtype,
            'published' => "yes"
        );
        if ($this->input->post('autoCheck')) {
            $data['is_autoCheck'] = 1;
        }
        if ($vid == 0) {
             $data['created_by'] = $created_by;
            if ($this->input->post('invoice')) {
                $data['voucher_invoice'] = $this->input->post('invoice');
            }
        }

        if ($this->input->post('reference')) {
            $reference = $this->input->post('reference');
            $data['reference'] = $reference;
        }else{
            $data['reference'] = '';
		}
        $autoinvoice = $this->input->post('autoinvoice');
        $new_invoice = $this->input->post('new_invoice');
        $voucher_no = $this->vouchers->generatevouchernumber($billtype);
        if ($autoinvoice != $new_invoice) {
            $voucher_no = $new_invoice;
        }
        if ($type == 'pay') {
            if($vid > 0 ){
                // if($this->session->userdata('login_comid') == 'raj'){
                  $this->checkvoucherAudit($vid,'voucher');
               //  }
             }
            $response = $this->UpdatePaymentVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger);
            $insert_id = $response['id'];
            if ($vid > 0) {
                $tp = 'e';
            }
        }
        if ($type == 'rec') {
            if($vid > 0 ){
                // if($this->session->userdata('login_comid') == 'raj'){
                  $this->checkvoucherAudit($vid,'voucher');
               //  }
             }
            $response = $this->UpdateReceiptVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger);
            $insert_id = $response['id'];
            if ($vid > 0) {
                $tp = 'e';
            }
        }
        $this->ageing_save($type, $insert_id, $tp);
        $this->ageing_trans_save($type, $insert_id, $tp);

        return $response;
    }

    private function ageing_trans_save($type, $id, $tp) {
		$hdcrdt = $this->input->post('hdcrdt', true);
		$check_list = $this->input->post('chck', true);
		$age_id = $this->input->post('age_id', true);
		$txtamt = $this->input->post('txtamt', true);
		$hddbt = $this->input->post('hddbt', true);
		$paid = $this->input->post('paid');
		$tb_id = $this->input->post('tbid', true);
        $ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
        if($ageing_adjustment > 0 ){
            $txtadjust = $this->input->post('txtadjust', true);
        }
		if ($tp == 'e') {
			$qry = "update  acc_ageing_trans set published ='no' where voucher_type = 'voucher' and voucher_id =" . $id;
			$this->db->query($qry);
		}
		if($this->input->post('hdcrdt', true)){
			$i = 0;
			$length = sizeof($hdcrdt);
			for ($i = 0; $i < $length; $i++) {
				$bal = 0;
				if ($type == 'pay') {
					$bal = $hdcrdt[$i];
				}
				if ($type == 'rec') {
					$bal = $hddbt[$i];
				}
				$paid = $txtamt[$i];

				$data = array(
					'ageing_id' => $age_id[$i],
					'voucher_id' => $id,
					'paid' => $txtamt[$i],
					'published' => 'yes',
				);
                if($ageing_adjustment > 0 ){
                    $adjust_amt = $txtadjust[$i];
                    if($adjust_amt ==''){
                        $adjust_amt = 0 ;
                    }
                    if($adjust_amt > 0 ){
                        $data['is_adjust'] = 1;
                        $data['adjustment'] = $adjust_amt;
                    }
                }
				$this->db->insert('acc_ageing_trans', $data);
			}
		}
    }

    function age_save($data, $type, $insert_id, $tp, $paid) {
        $ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
        if($ageing_adjustment > 0 ){
            $txtadjust = $this->input->post('txtadjust', true);
        }
        $check_list = $data['chck'];
        $txtamt = $data['txtamt'];
        $hdcrdt = $data['hdcrdt'];
        $hddbt = $data['hddbt'];
        $i = 0;
        $bal = 0;
        if ($type == 'pay') {
            $bal = $hdcrdt[$i];
        }
        if ($type == 'rec') {
            $bal = $hddbt[$i];
        }
        if ($tp == 'n') {
            $paid = $txtamt[$i];
        } else {
            $paid = $txtamt[$i] - $paid;
        }
        $qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=" . $bal . ", pay_id= " . $id . ",paid = paid +" . $paid . " , last_paid=" . $paid . " where age_id = " . $singlist;
        $this->db->query($qry);
        if($ageing_adjustment > 0 ){
            $adjust_amt = $txtadjust[$i];
            if($adjust_amt ==''){
                $adjust_amt = 0 ;
            }
            if($adjust_amt > 0 ){
                $qry = "update acc_ageing set adjustment_amount  = adjustment_amount  +" . $adjust_amt . " where age_id = " . $singlist;
                 $this->db->query($qry);
            }
        }


      
    }

    private function ageing_save($type, $id, $tp) {

        $ageing_adjustment = 0 ;
        if($this->input->post('ageing_adjustment')){
            $ageing_adjustment = $this->input->post('ageing_adjustment');
        }
        if($ageing_adjustment > 0 ){
            $txtadjust = $this->input->post('txtadjust', true);
        }


        if ($tp != 'n') {
            $qry = "select * from acc_ageing_trans where voucher_type  = 'voucher' and published='yes' and voucher_id=" . $id . " ";
            $restore = $this->db->query($qry)->result_array();
            foreach ($restore as $ms) {
                $restore_qry = "update acc_ageing set paid = paid-" . $ms['paid'] . " where   age_id = " . $ms['ageing_id'] . " ";
                $this->db->query($restore_qry);
                if($ageing_adjustment > 0 ){
                    $restore_qry = "update acc_ageing set adjustment_amount = adjustment_amount-" . $ms['adjustment'] . " where   age_id = " . $ms['ageing_id'] . " ";
                    $this->db->query($restore_qry);

                }

            }
        }
        $check_list = $this->input->post('chck', true);
        $age_id = $this->input->post('age_id', true);
        $txtamt = $this->input->post('txtamt', true);
        $hdcrdt = $this->input->post('hdcrdt', true);
        $hddbt = $this->input->post('hddbt', true);
        $paid = $this->input->post('paid');
        $i = 0;
		if($this->input->post('hdcrdt', true)){
			$length = sizeof($hdcrdt);
			for ($i = 0; $i < $length; $i++) {
				$ls = "";
				$qry = 'select IFNULL(b.paid,0) as paid FROM  voucher_trans as a inner join acc_ageing_trans as b on b.voucher_id=a.voucher_id and b.voucher_type ="voucher" inner join acc_ageing as c on c.age_id=ageing_id where a.published="yes" and  b.published="yes" and b.voucher_id=' . $id . ' and ageing_id=' . $age_id[$i];
				$query = $this->db->query($qry)->row_array();
				if ($query['paid'] == "") {
					$query['paid'] = 0;
				}
				$paid = $txtamt[$i];
				
				if ($paid == '' || $paid == NULL) {
					$paid = 0;
				}
				if ($tp == 'n') {
					$ls = " , last_paid=" . $paid . "";
				}
				$qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=(credit+debit)-(paid+" . (float) $paid . "), pay_id= " . $id . ",paid = paid +" . $paid . "  $ls where age_id = " . $age_id[$i];
				$this->db->query($qry);

                if($ageing_adjustment > 0 ){
                    $adjust_amt = $txtadjust[$i];
                    if($adjust_amt ==''){
                        $adjust_amt = 0 ;
                    }
                    if($adjust_amt > 0 ){
                        $qry = "update acc_ageing set adjustment_amount  = adjustment_amount  +" . $adjust_amt . " where age_id = " .  $age_id[$i];
                        $this->db->query($qry);
                    }
                }

			}
		}
    }

    private function ageing_save_jour($id, $tp) {
        $check_list = $this->input->post('chck', true);
        $txtbal = $this->input->post('txtbal', true);
        $hdcrdt = $this->input->post('hdcrdt', true);
        $hddbt = $this->input->post('hddbt', true);
        $txtamtc = $this->input->post('txtamtc', true);
        $txtamtd = $this->input->post('txtamtd', true);
        $mpaid = $this->input->post('mpaid', true);
        if ($this->input->post('chck', true)) {


            $length = sizeof($check_list);
            $i = 0;
            $paid = 0;
            $type = 'jou';
            if ($length > 0) {
                foreach ($check_list as $singlist) {
                    $crdt = $hdcrdt[$i];
                    $dbt = $hddbt[$i];
                    $amtc = $txtamtc[$i];
                    $amtd = $txtamtd[$i];
                    if (intval($crdt) == 0) {
                        $paid = $amtc;
                        $bal = $dbt;
                    } else {
                        $paid = $amtd;
                        $bal = $crdt;
                    }
                    if ($tp != 'n') {
                        $paid = $paid - $mpaid[$i];
                    }
                    $qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=" . $bal . ", pay_id= " . $id . ",paid = paid +" . $paid . " , last_paid=" . $paid . " where age_id = " . $singlist;
                    $this->db->query($qry);
                    $i++;
                }
            }
        }
    }

}
