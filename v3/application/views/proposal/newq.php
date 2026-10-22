<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales_model
 *
 * @author u43255
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Sales_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.published as pub, a.type as stype, DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,  a.*,b.*';
        $this->table = 'sales as a left join suppliers as b on a.customer_id =b.id';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name', 'a.cusname', 'a.cusdetails'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
    }
	
	function assign(){
		$isbulk = $this->input->post('isbulk');
		$mdlsalesman = $this->input->post('mdlsalesman');
		$invoice_id = 	$this->input->post('invoice_id');
		if(!$this->input->post('isbulk')){
			
			$data = array(
				'is_assigned'=>1,
				'salesman'=>$mdlsalesman
			);
			$this->db->where('sales_id',$invoice_id);
			$this->db->update('sales',$data);
		}else {
			$text = $this->input->post('text');
			if($this->input->post('text')){
				$qry = "update sales set is_assigned =1 ,salesman=".$mdlsalesman."  where sales_id in (".$text.")";
				$this->db->query($qry);
			}
		}
	}

    function zeroindex() {
        $qry = 'select * from taxgst where GST="0" limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function getcoupon($search) {
        $qry = "select cou_code as label,a.* from coupons as a where cou_code like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function where() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $this->wherecondition = " where a.type = '" . $this->input->post('type') . "' ";
        if ($this->input->post('btype')) {
            $this->wherecondition = $this->wherecondition . " and a.bill_type =" . $this->input->post('btype');
        }
//        if ($this->input->post('type')) {
//            $this->wherecondition = $this->wherecondition . " and a.type = '" . $this->input->post('type') . "' and a.created_by = " . $userid;
//        }
// print_r($this->wherecondition);
    }

    public function alreadyexistcheck() {
        $invoice = $this->input->post('field1');
        $qry = "select count(*) as cnt from sales where invoice='$invoice'";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    function wherecustomer() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $id = $this->input->post('supid');
        if ($this->input->post('stype')) {
            $this->wherecondition = "where a.type = '" . $this->input->post('stype') . "' and a.created_by = " . $userid . " and a.customer_id = " . $id;
        }
    }

    function getpttype($size) {
        $qry = "SELECT * FROM `set_printtype`  where `id`=" . $size;
        $query = $this->db->query($qry)->row_array();
        return $query['page'];
    }

    function getprinttype($id) {
        $qry = "SELECT b.id,b.name FROM set_billtype as a INNER JOIN set_printtype as b on a.print_type=b.id WHERE a.id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getformat($size) {
        $qry = "SELECT * FROM `set_printtype` as a  where a.`id`=" . $size;
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function max() {
        $qry = 'select max(Sales_id) as max_id from sales where type ="' . $this->input->post('type') . '"';
        if ($this->input->post('btype')) {
            $qry = 'select max(Sales_id) as max_id from sales where bill_type= ' . $this->input->post('btype') . ' and type ="' . $this->input->post('type') . '"';
        }
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function ledbalid($id) {
        $qry = 'select id,openning_bal,ref_code,type from acc_ledgers where ref_code in ("sup","cus") and ref_id = ' . $id . ' limit 1';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function count_all_sales() {
        $qry = 'select * from ' . $this->table . ' ' . $this->wherecondition;
        $query = $this->db->query($qry);
        return $query->num_rows();
    }

    public function count_filtered_sales() {
        $this->getQueryDt();
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }

    public function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM sales as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,sales_id from sales as b WHERE bill_type='" . $type . "') as c on c.sales_id=a.sales_id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['invoice']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];

            return $num;
        }
    }

    public function getnewinoviceno($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM sales as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,sales_id from sales as b WHERE bill_type=" . $type . ") as c on c.sales_id=a.sales_id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $query1['startnumber'];
        } else {
            $query = $query->row_array();
            return $query['top'] + 1;
        }
    }

    function getSales($id) {
        $qry = "select t.brc_name,t.brc_address,IFNULL(customer_id,0) as cusid,l.name as Bank,IFNULL(adjustment_amount,0) as adjustment,DATE_FORMAT(created_date, '%Y-%m-%d  %T') AS createdate,user_name,a.type as stype,a.published as pub,c.StateName, DATE_FORMAT(invoice_date,'%d-%m-%Y') as in_date,  a.type as stp, a.*,b.* from sales as a  left join set_billtype as s on s.id=a.bill_type left join  company_branch as t on t.brc_id=s.branch_id left join suppliers as b on a.customer_id=b.id left join acc_ledgers as l on l.id=a.bank_id left join users as u on u.id=a.salesman left join state as c on c.StateID=b.cst where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function gettaxparticulars($id) {
        $qry = "select sum(tax) as total,GST from sales_items as a inner join taxgst as b on a.tax_id=b.gstid where a.published='yes' and a.sales_id=" . $id . " group by tax_id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getSalesItems($id, $len, $size) {
        $qry = "select  g.*, h.hsncode as hsncd,a.mrp as mrps,IFNULL(u.name,'') as uname, a.*,b.* from sales_items as a inner join item as b on a.item_id= b.id left join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid left join units as u on u.id= a.unit_id where sales_id= $id and a.published='yes' limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getgstItems($id) {
        // $qry = " SELECT sum(total) as tot,sum(total-tax) as beforetax,sum(tax) as tax,gst,sum(dis_amt) as dis_amt FROM sales_items as a INNER JOIN taxgst as b on a.tax_id=b.gstid WHERE `sales_id`=$id AND  a.published='yes' and a.tax!=0 order by a.tax_id";
        $qry = " SELECT sum(total-tax+dis_amt-itm_raw_ces-ces_amt) as tot,sum(total-tax-itm_raw_ces-ces_amt) as beforetax,sum(tax) as tax,gst,sum(dis_amt) as dis_amt FROM sales_items as a INNER JOIN taxgst as b on a.tax_id=b.gstid WHERE `sales_id`=$id AND  a.published='yes' ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItems($id) {
        $qry = " select SUM(`total`)as tot ,sum(total-tax) as amt ,round(sum((total-tax)*tg.cgst/100),2) as camt ,round(sum((total-tax)*tg.sgst/100),2) as samt ,round(sum((total-tax)*tg.igst/100),2) as iamt , h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.sales_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = " select SUM(`total`)as tot ,sum(total-tax) as amt ,round(sum((total-tax)*tg.cgst/100),2) as camt ,round(sum((total-tax)*tg.sgst/100),2) as samt ,round(sum((total-tax)*tg.igst/100),2) as iamt , h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.sales_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function getSalesItemscnt($id) {
        $qry = "select  * from sales_items as a inner join item as b on a.item_id= b.id  where a.published='yes' and sales_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function getRefLedger($id) {
        $qry = 'select * from acc_ledgers where ref_id=' . $id . ' and ref_code ="ref"';
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function delete($type, $id) {
        if ($type == 'sales_return') {
           // $this->restorestock($id, 'pur');
            //$this->restore_godown_stock($id, 'cr');
        }
        if ($type == 'sales') {
          //  $this->restorestock($id, 'sales');
           // $this->restore_godown_stock($id, 'dt');
        }
		 if ($type == 'delivery_note') {
           // $this->restorestock($id, 'sales');
          //  $this->restore_godown_stock($id, 'dt');
        }
		
		$qry = "SELECT * FROM `sales` WHERE estimate_id > 0 and sales_id =".$id;
		$query = $this->db->query($qry);
		if( $query->num_rows() > 0 ){
			$query = $query->row_array();
			$this->restoreestimate($id,$query['estimate_id']);
		}
		
        $qry = "delete from  sales where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from sales_items  where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='Sales' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function cancel($type, $id) {
        if ($type == 'sales_return') {
          //  $this->restorestock($id, 'pur');
           // $this->restore_godown_stock($id, 'cr');
        }
        if ($type == 'sales') {
            //$this->restorestock($id, 'sales');
            //$this->restore_godown_stock($id, 'dt');
        }
		 if ($type == 'delivery_note') {
           // $this->restorestock($id, 'sales');
           // $this->restore_godown_stock($id, 'dt');
        }
		$qry = "SELECT * FROM `sales` WHERE estimate_id > 0 and sales_id =".$id;
		$query = $this->db->query($qry);
		if( $query->num_rows() > 0 ){
			$query = $query->row_array();
			$this->restoreestimate($id,$query['estimate_id']);
		}
        $qry = "update  sales set published ='no'  where sales_id =" . $id;
        $this->db->query($qry);
        /* $qry = "update  sales_items set published ='no' where sales_id =" . $id;
          $this->db->query($qry); */
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='Sales' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function InsertSales($data) {
        $this->db->insert('sales', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function UpdateSales($data, $id, $or_type) {
		$qry = "select * from sales where sales_id = ". $id;
		$query = $this->db->query($qry)->row_array();
		$redeemed_points = $query['redeemed_points'];
		if((float) $redeemed_points > 0 ){
			$qry = "update suppliers set redeemed_points = redeemed_points - ".$redeemed_points ." where id= '".$query['customer_id']."' ";
			$this->db->query($qry);
		}
        if ($or_type == 'sales') {
            $ttp = 'dt';
           // $this->restorestock($id, 'sales');
          //  $this->restore_godown_stock($id, $ttp);
        } else if ($or_type == 'sales_return') {
            $ttp = 'cr';
           // $this->restorestock($id, 'pur');
           // $this->restore_godown_stock($id, $ttp);
        }
        $this->db->where('sales_id', $id);
        $this->db->update('sales', $data);
		
        $qry = "update  sales_items set published ='no' where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  sales_coupon set published ='no' where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  sales_ledgers set published ='no'  where sales_id =" . $id;
        $this->db->query($qry);
    }

    function InsertService($data, $data_sales, $or_type, $is_mul_led, $branch) {
        $total = $data['amount'];
        if ($data['tax'] != 0) {
            $total = $total - $data['tax'];
        }
        $this->db->insert('sales_ledgers', $data);
        if ($or_type != 'estimate') {
            if (strtolower($data_sales['cash_type']) == 'cash' || strtolower($data_sales['cash_type']) == 'bank') {
                $toid = $this->paytype;
                $this->trans_save($data_sales['invoice'], $data['sales_id'], 'Sales', $or_type, $this->paytype, $data['ledger_id'], $data_sales['invoice_date'], $total, '0.00', $data_sales['narration'], 1, $data_sales['cost_center'], $branch);
            } else {
                $res = $this->getLedgers($data_sales['customer_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($data_sales['invoice'], $data['sales_id'], 'Sales', $or_type, $res['id'], $data['ledger_id'], $data_sales['invoice_date'], $total, '0.00', $data_sales['narration'], 1, $data_sales['cost_center'], $branch);
            }

            if ($data['tax'] != 0) {
                $this->tax_add($data['tax_id'], $data['amount'], $data['tax'], $data['amount'] - $data['tax']);
            }
        }
    }

    function InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $invoice = "",$saletype ='b2c') {
        $qty = $this->getquantity($data['unit_id'], $data['quantity'], $data['item_id']);
        if ((int) $data['free_quantity'] > 0 && $data['sales_ref_type'] != 'delivery_note') {
            $fre_qty = $this->getquantity($data['unit_id'], $data['free_quantity'], $data['item_id']);
        }
        $this->db->insert('sales_items', $data);
        if ($or_type != 'estimate') {
			if((int) $data['itm_ces_id'] > 0 ){
				$this->ces_add($data['itm_ces_id'],$data['itm_raw_ces']);
			}
			if($saletype =='b2c' && (int) (int) $data['is_taxincluded'] > 0  ){
				$this->tax_add($data['tax_id'], $data['total'], $data['tax'], $data['total'] - $data['tax']-$data['itm_raw_ces']-$data['ces_amt']);
			}else{
				$this->tax_add($data['tax_id'], $data['total'], $data['tax'], $data['total'] - $data['tax']-$data['itm_raw_ces']);
			}
		    $ttp = 'cr';
            if ($or_type == 'sales_return') {
                $ttp = 'dt';
            }
			if($data['sales_ref_type'] != 'delivery_note'){
				$this->stock_trans(0, $data['item_id'], $qty, $invoicedate, $ttp, $or_type, $data['sales_id'], $data['rate'], $data['mrp'], $data['tax_id'], $data['godown'], $invoice, $data['batch']);
				//$this->godown_stock_trans(0, $data['item_id'], $qty, $ttp, $or_type, $data['godown'], $data['batch']);
				if ((int) $data['free_quantity'] > 0) {
					$this->stock_trans(0, $data['item_id'], $fre_qty, $invoicedate, $ttp, $or_type, $data['sales_id'], $data['rate'], $data['mrp'], $data['tax_id'], $data['godown'], $invoice, $data['batch']);
					//$this->godown_stock_trans(0, $data['item_id'], $fre_qty, $ttp, $or_type, $data['godown'], $data['batch']);
				}
			}
        }
    }

    function savesub($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id, $is_mul_led, $branch,$receipt_amount=0) {

        if (isset($data['ref_id']) && $data['ref_id'] != 0) {
            $refs = $this->getRefLedger($data['ref_id']);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $refs['id'], $this->ref, $data['invoice_date'], '0.00', $data['ref_amount'], $data['narration'], 1, $data['cost_center'], $branch);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->ref, $refs['id'], $data['invoice_date'], $data['ref_amount'], '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        }
        $toid = 0;
        if (strtolower($data['cash_type']) == 'cash' || strtolower($data['cash_type']) == 'bank') {
            $toid = $this->paytype;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1, $data['cost_center'], $branch);
			$qry = "UPDATE `acc_ageing` SET `debit` = '0',credit ='0' WHERE tb_name = 'Sales' and tb_id = ".$insert_id;
			$this->db->query($qry);
		} else if (strtolower($data['cash_type']) == 'cob' || strtolower($data['cash_type']) == 'ba_ca_cr') {
            $toid = $this->paytype;
            if ($this->input->post('bank_account') && $this->input->post('bank_amount')) {
                $bank_amount = $this->input->post('bank_amount');
                $bank_account = $this->input->post('bank_account');
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $bank_account, $data['invoice_date'], '0.00', $bank_amount, $data['narration'], 1, $data['cost_center'], $branch);
            }
            $cash_amount = $this->input->post('cash_amount');
            if ($this->input->post('cash_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'], 1, $data['cost_center'], $branch);
            }
            $bank_amount = 0;
            if ($this->input->post('bank_amount')) {
                $bank_amount = $this->input->post('bank_amount');
            }
            $tot_amt = $cash_amount + $bank_amount;
            if (strtolower($data['cash_type']) == 'ba_ca_cr') {
                $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $tot_amt, $data['narration'], 1, $data['cost_center'], $branch);
                $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $tot_amt - $receipt_amount, 0, 0, 0);
            }else{
				$qry = "UPDATE `acc_ageing` SET `debit` = '0',credit ='0' WHERE tb_name = 'Sales' and tb_id = ".$insert_id;
				$this->db->query($qry);
			}
        } else if (strtolower($data['cash_type']) == 'ca_cr') {
            $cash_amount = $this->input->post('cash_amount');
            if ($this->input->post('cash_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'], 1, $data['cost_center'], $branch);
            }
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $cash_amount, $data['narration'], 1, $data['cost_center'], $branch);
            $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $cash_amount - $receipt_amount, 0, 0, 0);
        } else if (strtolower($data['cash_type']) == 'ba_cr') {
            $cash_amount = $this->input->post('bank_amount');
            if ($this->input->post('bank_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'], 1, $data['cost_center'], $branch);
            }
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $cash_amount, $data['narration'], 1, $data['cost_center'], $branch);
            $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $cash_amount - $receipt_amount, 0, 0, 0);
        } else {
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1, $data['cost_center'], $branch);
            $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total']- $receipt_amount, 0, 0, 0);
        }
        if (is_numeric($data['discount']) == true && $data['discount'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['discount'], $data['narration'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['redeemed_amount']) == true && $data['redeemed_amount'] != 0) {
			$qry = 'update suppliers set redeemed_points = redeemed_points + '.$data['redeemed_points'].' where id =  "'.$data['customer_id'].'" ';
			$this->db->query($qry);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['redeemed_amount'], $data['narration'], 1, $data['cost_center'], $branch);
        }
        if (is_numeric($data['freight']) == true && $data['freight'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesFr, $data['invoice_date'], $data['freight'], '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['other']) == true && $data['other'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesCoolie, $data['invoice_date'], $data['freight'], '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        }

        $salesamount = $subtot;
        if ($is_mul_led == 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $salesamount, '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        } else {
            $this->tax_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);
        }
        if ($rount > 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], $rount, '0.00', $data['narration'], 1, $data['cost_center'], $branch);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], '0.00', $rount, $data['narration'], 1, $data['cost_center'], $branch);
        }

        if ($data['cess'] > 0 && $data['saletype'] == "b2c") {
            $qry = 'select * from acc_ledgers where name like"%cess%"';
            $query = $this->db->query($qry);
            if ($query->num_rows() > 0) {
                $query = $query->row_array();
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $query['id'], $data['invoice_date'], $data['cess'], '0.00', $data['narration'], 1, $data['cost_center'], $branch);
            }
        }
        $this->ces_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);

		
    }
	
	function insert_customerdetails($data){
		$this->db->insert('suppliers',$data);
		$id = $this->db->insert_id();
		$ledger_data = array(
                        "name" => $data['name'],
                        "code" => $data['phone'],
                        "ref_id" => $id,
                        "ref_code" => 'cus',
                        "is_default" => true,
                        "acc_main_id" => 25,
                        "openning_bal" => 0,
                        "type" => 'Dr',
                        "published" => 'yes'
                    );
        $this->db->insert('acc_ledgers', $ledger_data);
		return $id;
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
	
	function update_customer_point($customer_id,$sales_point,$sales_id,$total){
		$qry = "select * from point_transaction where sales_id = ".$sales_id."  and published='yes' ";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$old_customer = $query['customer_id'];
			$old_collected_point = $query['collected_point'];
			$qry = "update suppliers set total_points = total_points - ".$old_collected_point." where id= ".$old_customer." ";
			$this->db->query($qry);
			$qry = "update point_transaction set published ='no' where sales_id =".$sales_id." ";
			$this->db->query($qry);
		}
		if((int) $sales_point > 0 ){
				$data = array(
					'customer_id'=>$customer_id,
					'sales_id'=>$sales_id,
					'total_amount'=>$total,
					'collected_point'=>$sales_point
				);
				$this->db->insert('point_transaction',$data);
				$qry = "update suppliers set total_points = total_points + ".$sales_point." where id= ".$customer_id." ";
				$this->db->query($qry);
		}
	}
	
	function updatereceipt($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch){
			$toid = $supid;
			$ledger = 1;
			$qry = "select * from voucher where sales_ref_id=".$insert_id;
			$query = $this->db->query($qry);
			$cnt = $query->num_rows();
			if((float) $cnt > 0 ){
				$query = $query->row_array();
				$old = $query['id'];
				$old_no = $query['voucher_no']; 
			}
			$qry = "SELECT * FROM `set_billtype` WHERE transaction ='rec' order by id asc limit 0,1";
			$query = $this->db->query($qry)->row_array();
			$billtype = $query['id'];
			if((float) $cnt < 1){
				 $voucher_no = $this->generatevouchernumber($billtype);
				 $data = array(
					'voucher_no'=>$voucher_no,
					'sales_ref_id'=>$insert_id,
					'ledger' => 1,
					'amount' => $receipt_amount,
					'vourcher_type'=>'receipt',
					'cost_center' => $costcenter,
					'naration' => $invoice.' ON '. $invoicedate,
					'trans_date' => $invoicedate,
					'created_by' => $created_by,
					'created_date' => date('Y-m-d'),
					'is_post' => "yes",
					'bill_type' => $billtype,
					'published' => "yes"
				);
				$this->db->insert('voucher', $data);
				$insert_id = $this->db->insert_id();
				$this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], $costcenter, $branch);
				$qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
				$this->getSaved($qry);
				$this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], $costcenter, $branch);
				$qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
				$this->getSaved($qry);
				
			}else{
				$data = array(
					'sales_ref_id'=>$insert_id,
					'ledger' => 1,
					'amount' => $receipt_amount,
					'cost_center' => $costcenter,
					'naration' => $invoice.' ON '. $invoicedate,
					'trans_date' => $invoicedate,
					'created_by' => $created_by,
					'created_date' => date('Y-m-d'),
					'is_post' => "yes",
					'published' => "yes"
				);
				$voucher_no = $old;
				$this->db->where('id',$old);
				$insert_id = $old;
				$this->db->update('voucher',$data);
				$qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and tb_id =" . $old;
				$this->db->query($qry);
				$qry = "update  voucher_trans set published ='no' where voucher_id =" . $old;
				$this->db->query($qry);
				$this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], $costcenter, $branch);
				$qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
				$this->getSaved($qry);
				$this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], $costcenter, $branch);
				$qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
				$this->getSaved($qry);
			}
	}

    public function save($or_type) {
//  $cons = new Common_db(); 
		
		$item_damage = $this->input->post('item_damage');
		$customer_points = $this->input->post('customer_points');
		if((float) $customer_points > 0 ){
			$qry ="select * from point_settings ";
			$query = $this->db->query($qry);
			$one_point_equivalent = 0;
			if($query->num_rows()>0){
				$query = $query->row_array();
				$one_point_equivalent = $query['one_point_equivalent'];
			}
		}

        $type = $this->input->post('type');
        if (strtolower($type) != 'credit') {
            $this->paytype = $this->input->post('paytype');
        }
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
		
        $adjustment_amount = 0;
        $collected = 0;
        if ($this->input->post('adjustment')) {
            $adjustment_amount = $this->input->post('adjustment');
        }
        if ($this->input->post('col_amt')) {
            $collected = $this->input->post('col_amt');
        }
        $autoinvoice = $this->input->post('autoinvoice');
        $new_invoice = $this->input->post('new_invoice');
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $this->data = array();
        $this->taxdata = array();
        $billtype = $this->input->post('btype');
        if ($id == 0) {
            if ($billtype == '') {
                $invoice = $this->getinoviceno($or_type);
            } else {
                $invoice = $this->getinoviceno($billtype);
            }
        }
        if ($autoinvoice != $new_invoice) {
            $invoice = $new_invoice;
        }
		$txtglobalmrp  = 0 ;
		if($this->input->post('txtglobalmrp')){
			$txtglobalmrp =  $this->input->post('txtglobalmrp');
		}
        $branch = $this->getbranch($billtype);
        $is_mul_led = $this->input->post('is_multipletax');
        $ewb_no = $this->input->post('ewbno');
        $ewb_details = $this->input->post('ewbdetails');
        $route = $this->input->post('route');
        $printtype = $this->input->post('printtype');
        $base_unit = $this->input->post('base_unit');
        $gst = $this->input->post('gst');
        $state = $this->input->post('states');
        $salesman = $this->input->post('SalesMan');
        $area = $this->input->post('area');
        $deldate = $this->input->post('ddate'); //delivery date
        $cdate = $this->input->post('cdate'); //credit date 
        $invoicedate = $this->input->post('date');
        $invoicedate = $this->getDate($invoicedate);
        $commi_amt_hi = $this->input->post('commi_amt_hi');
        if ($commi_amt_hi == "NaN") {
            $commi_amt_hi = 0;
        }
        $saletype = $this->input->post('saletype');
        $txtEstimate_id = $this->input->post('txtEstimate_id');
        $terms_condition = $this->input->post('tms_con');
        // $despatch_details = $this->input->post('des_det');
        $con_name = $this->input->post('con_name');
        $tot_cess = $this->input->post('tot_cess');
        $con_addr = $this->input->post('con_addr');
        $con_contact = $this->input->post('con_contact');
        $con_gst = $this->input->post('con_gst');
        $con_state = $this->input->post('con_state');
        $reference = $this->input->post('reference');
        $freight = $this->input->post('freight'); //Transporting
        $advance = $this->input->post('advance');
        $bill_margin = $this->input->post('billmargin');
        $other = $this->input->post('other'); //Coolie
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $tax = $this->input->post('taxtotal');
        $vehicle = $this->input->post('vehicle');
        $gtotal = $this->input->post('gtotal');
        $customer_id = $this->input->post('customer_id');
		if($type !="Cash" && $type !="Bank" && $type!="COB"){
			if($customer_id ==0 || $customer_id =='0' || $customer_id ==""){
				$customer_details = array(
					'name'=>$this->input->post('supname'),
					'phone'=>$this->input->post('phone'),
					'address_line1'=>$this->input->post('email'),
					'tin'=>$this->input->post('gst'),
					'type'=>'cus'
				);
				$customer_id = $this->insert_customerdetails($customer_details);
			}
		}
        $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
        $supname = $this->input->post('bname');
		if($supname == ""){
			$supname = $this->input->post('supname');
		}
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		$cash_status  = '';
		if($this->input->post('cash_status')){
			$cash_status = $this->input->post('cash_status');
		}
		$redeem_amount = 0 ;
		if($this->input->post('redeem_amount')){
			$redeem_amount = $this->input->post('redeem_amount');
		}
		if($redeem_amount == ""){
			$redeem_amount = 0;
		}
		$redeemed_points = 0;
		if($this->input->post('redeem_points')){
			$redeemed_points = $this->input->post('redeem_points');
		}
		if($redeemed_points == ""){
			$redeemed_points = 0;
		}
		$itm_net_ces = 0 ;
		if( $this->input->post('itm_net_ces') ){
			$itm_net_ces = $this->input->post('itm_net_ces');
		}
		$receipt_amount = 0;
		if($this->input->post('receipt_amount')){
			$receipt_amount =  $this->input->post('receipt_amount');
		}
		$vehicle_no = '';
		$transport_mode = '';
		$ref_no = '';
		$place  ='';
		if($this->input->post('vehicle_txt')){
			$vehicle_no = $this->input->post('vehicle_txt'); 
		}
		if($this->input->post('mode_of_transport')){
			$transport_mode = $this->input->post('mode_of_transport'); 
		}
		if($this->input->post('sales_ref_no')){
			$ref_no = $this->input->post('sales_ref_no'); 
		}
		if($this->input->post('del_place')){
			$place = $this->input->post('del_place'); 
		}
		$room_id = 0;
		if($this->input->post('myrooms')){
			$room_id  = $this->input->post('myrooms');
		}
        $data_sales = array(
			'ref_no'=>$ref_no,
			'room_id'=>$room_id,
			'place'=>$place,
			'vehicle_no'=>$vehicle_no,
			'transport_mode'=>$transport_mode,
			'estimate_id'=>$txtEstimate_id,
			'additional_cess'=>$itm_net_ces,
            'invoice_date' => $invoicedate,
            'bill_margin' => $bill_margin,
            'cess' => $tot_cess,
            'terms_condition' => $terms_condition,
            'con_name' => $con_name,
            'con_addr' => $con_addr,
            'collected_amount' => $collected,
            'adjustment_amount' => $adjustment_amount,
            'con_contact' => $con_contact,
            'con_gst' => $con_gst,
            'cash_status' => $cash_status,
            'cost_center' => $costcenter,
			'redeemed_amount'=>$redeem_amount,
			'redeemed_points'=>$redeemed_points,
            'cash_type' => $type,
            'delivery_date' => $this->getDate($deldate),
            'credit_eod' => $this->getDate($cdate),
            'printtype' => $printtype,
            'total' => $gtotal,
            'ewb_no' => $ewb_no,
            'cash_amount' => $this->input->post('cash_amount'),
            'bank_amount' => $this->input->post('bank_amount'),
            'ewb_details' => $ewb_details,
            'cusgst' => $gst,
            'cusstate' => $state,
            'saletype' => $saletype,
            'salesman' => $salesman,
            'route' => $route,
            'tax' => $tax,
            'ref_amount' => $commi_amt_hi,
            'tax_id' => 0,
            'other' => $other,
            'freight' => $freight,
            'discount' => $discount,
            'roundoff' => $rount,
            'created_date' => date('Y-m-d H:i:s', time()),
            'narration' => $narration,
            'created_by' => $created_by,
            'type' => $or_type,
            'bill_type' => $billtype,
			'receipt_amount'=>$receipt_amount,
            'cusname' => $supname,
            'cusdetails' => $phone,
            'cusemail' => $email,
			'customer_id'=>$customer_id,
            'published' => 'yes'
        );
		if((float) $txtglobalmrp > 0){
			$data_sales['global_mrp']= $txtglobalmrp;
		}

        if ($this->input->post('card_number')) {
            $data_sales['card_no'] = $this->input->post('card_number');
        }
        if ($this->input->post('bank_ref_code')) {
            $data_sales['bank_ref'] = $this->input->post('bank_ref_code');
        }
        if ($this->input->post('exc_ref')) {
            $data_sales['adjustment_ref'] = $this->input->post('exc_ref');
        }
        if ($this->input->post('advance')) {
            $data_sales['advance'] = $advance;
        }

        if ($this->input->post('reference')) {
            $data_sales['ref_id'] = $this->input->post('reference');
        }
        if ($this->input->post('con_state')) {
            $data_sales['con_state'] = $this->input->post('con_state');
        }
        if ($this->input->post('area')) {
            $data_sales['area'] = $this->input->post('area');
        }
        if ($this->input->post('vehicle')) {
            $data_sales['vehicle'] = $this->input->post('vehicle');
        }
        if ($this->input->post('cash_amount')) {
            $data_sales['cash_amount'] = $this->input->post('cash_amount');
        }
        if ($this->input->post('bank_amount')) {
            $data_sales['bank_amount'] = $this->input->post('bank_amount');
        }
        if ($this->input->post('bank_account')) {
            $data_sales['bank_id'] = $this->input->post('bank_account');
        }
        $insert_id = 0;
		
		$receipt_amount = 0;
		if($this->input->post('receipt_amount')){
			$receipt_amount =  $this->input->post('receipt_amount');
		}
        if ($id == 0) {
            $data_sales['invoice'] = $invoice;
            $data_sales['status'] = 'pending';
            $insert_id = $this->InsertSales($data_sales);
			if((float) $receipt_amount > 0 && $or_type =='sales' && $customer_id !=0 && $customer_id !='0' && $customer_id !="" ){
				$res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
				$supid = $res['id'];
				$this->updatereceipt($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch);
			}
        } else {
            $data_sales['invoice'] = $invoice;
            if (!$txtEstimate_id == 0) {
                $this->restoreestimate($id, $txtEstimate_id);
            }
            $this->UpdateSales($data_sales, $id, $or_type);
            $insert_id = $id;
			if((float) $receipt_amount > 0 && $or_type =='sales' && $customer_id !=0 && $customer_id !='0' && $customer_id !="" ){
				$res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
				$supid = $res['id'];
				$this->updatereceipt($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch);
			}else{
					$qry = "select * from voucher where sales_ref_id=".$insert_id;
					$query = $this->db->query($qry);
					$cnt = $query->num_rows();
					if((float) $cnt > 0 ){
						$query = $query->row_array();
						$old = $query['id'];
						$old_no = $query['voucher_no']; 
						$qry = 'update voucher set published="no" where id ='.$old;
						$this->db->query($qry);
						$qry = 'update voucher_trans set published="no" where voucher_id = '.$old;
						$this->db->query($qry);
						$qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and tb_id =" . $old;
						$this->db->query($qry);

					}
			}
        }
		if($or_type == 'sales' && (float) $customer_points > 0  && $customer_id !=0 && $customer_id != null ){
			$qry ="select * from point_settings ";
			$query = $this->db->query($qry);
			$one_point_equivalent = 0;
			if($query->num_rows()>0){
				$query = $query->row_array();
				$one_point_equivalent = $query['one_point_equivalent'];
			}
			if((float) $one_point_equivalent > 0  ){
				$total_sales_amount = $data_sales['total'];
				$sales_point = $total_sales_amount / $one_point_equivalent;
				$sales_point= $pieces = explode(".", $sales_point);
				$sales_point = $sales_point[0];
			}
			$this->update_customer_point($customer_id,$sales_point,$insert_id,$data_sales['total']);
		}
		$item_rate =  $this->input->post('item_rate', TRUE);
        $free_qty = $this->input->post('free_qty', TRUE);
        $itm_fre_qty = $this->input->post('itm_fre_qty', TRUE);
        $itm_fre_qty_for = $this->input->post('itm_fre_qty_for', TRUE);
        $ces_amt = $this->input->post('ces_amt', TRUE);
        $ces = $this->input->post('ces', TRUE);
        $item_id = $this->input->post('item_id', TRUE);
        $itmdtn = $this->input->post('itmdtn', TRUE);
        $item_qty = $this->input->post('item_qty', TRUE);
        $godown = $this->input->post('godown', TRUE);
        $unit_item = $this->input->post('unit_item', TRUE);
        $tax_item = $this->input->post('tax_item', TRUE);
        $item_size_id = $this->input->post('item_size_id', TRUE);
        $mrp_item = $this->input->post('mrp_item', TRUE);
        $prate_item = $this->input->post('prate_item', TRUE);
        $dis_amt = $this->input->post('dis_amt', TRUE);
        $tax_amount = $this->input->post('tax_amount', TRUE);
        $is_taxincluded = $this->input->post('is_taxincuded', TRUE);
        $rowTotal = $this->input->post('rowTotal', TRUE);
        $item_margin = $this->input->post('margin', TRUE);
        $subtot = $this->input->post('subtot');
        $taxtotal = $this->input->post('taxtotal');
			
        $saletaxtot = $this->input->post('totsaletax');
        if ($this->input->post('analytics_id')) {
            $analytics = $this->input->post('analytics_id', TRUE);
        }
        if ($this->input->post('myprinter')) {
            $printers = $this->input->post('myprinter', TRUE);
            $no_printers = sizeof($printers);
            for ($i = 0; $i < $no_printers; $i++) {
                $priner_data = array(
                    'printer_id' => $printers[$i],
                    'sales_id' => $insert_id,
                    'bill_format_id' => $printtype,
                    'is_print' => 0,
                );
                $this->db->insert('sales_print', $priner_data);
            }
        }
		if((int) $item_damage > 0 ){
			$item_damage_quantity =  $this->input->post('item_damage_quantity', TRUE);
			$item_actual_quantity =  $this->input->post('item_actual_quantity', TRUE);
		}
			$rowItemCes = $this->input->post('rowItemCes', TRUE);
			$rowitm_ces_id = $this->input->post('itm_ces_id', TRUE);
			$rowitm_ces_name = $this->input->post('itm_ces_name', TRUE);
			$rowitm_ces_per = $this->input->post('itm_ces_per', TRUE);
        $itembatch_name = $this->input->post('itembatch_name');
        $length = sizeof($mrp_item);
        for ($i = 0; $i < $length; $i++) {
			$itm_ces_id = 0;
			$itm_ces_name = '';
			$itm_ces_per = 0;
			$itm_raw_ces = 0;
			$additional_cess = $this->input->post('additional_cess');
			if((int) $additional_cess > 0 ){
				$itm_ces_id = $rowitm_ces_id[$i];
				$itm_ces_name = $rowitm_ces_name[$i];
				$itm_ces_per = $rowitm_ces_per[$i];
				$itm_raw_ces = $rowItemCes[$i];
			}
			$sales_ref_type = $this->input->post('sales_ref_type', TRUE);
			$sales_ref_id =  $this->input->post('sales_ref_id', TRUE);
            $data = array(
                'analytics' => 0,
                'sales_id' => $insert_id,
                'item_id' => $item_id[$i],
				'itm_ces_id'=>$itm_ces_id,
				'itm_ces_name'=>$itm_ces_name,
				'itm_ces_per'=>$itm_ces_per,
				'itm_raw_ces'=>$itm_raw_ces,
                'ces_amt' => $ces_amt[$i],
                'batch' => $itembatch_name[$i],
                'ces' => $ces[$i],
				'item_rate'=>$item_rate[$i],
                'size_id' => $item_size_id[$i],
                'item_margin' => $item_margin[$i],
                'item_discription' => $itmdtn[$i],
                'is_taxincluded' => $is_taxincluded[$i],
				'sales_ref_type'=>$sales_ref_type[$i],
				'sales_ref_id'=>$sales_ref_id[$i],
                'godown' => $godown[$i],
                'unit_id' => $unit_item[$i],
                'base_unit_id' => $unit_item[$i],
                'quantity' => $item_qty[$i],
                'rate' => $prate_item[$i],
                'mrp' => $mrp_item[$i],
                'tax_id' => $tax_item[$i],
                'tax' => $tax_amount[$i],
                'dis_amt' => $dis_amt[$i],
                'discount' => 0,
                'total' => $rowTotal[$i],
                'published' => 'yes'
            );
			if( $this->input->post('sales_ref_type', TRUE) ){
				$data['sales_ref_type'] = $sales_ref_type[$i];
			}else{
				$data['sales_ref_type'] = "";
			}
			if( $this->input->post('sales_ref_id', TRUE) ){
				$data['sales_ref_id'] = $sales_ref_id[$i];
			}else{
				$data['sales_ref_id'] = 0;
			}
			if((int) $item_damage > 0 ){
				$data['actual_quantity'] = $item_actual_quantity[$i];
				$data['damage_quantity'] = $item_damage_quantity[$i];
			}
            $data['free_quantity'] = 0;
            if ($this->input->post('free_qty')) {
                if ($free_qty[$i] != '') {
                    $data['free_quantity'] = $free_qty[$i];
                }
            }
            if ($this->input->post('itm_fre_qty')) {
                $data['itm_fre_qty'] = $itm_fre_qty[$i];
            }
            if ($this->input->post('itm_fre_qty_for')) {
                $data['itm_fre_qty_for'] = $itm_fre_qty_for[$i];
            }

            if ($this->input->post('analytics_id')) {
                $data['analytics'] = $analytics[$i];
            }
            $this->InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $data_sales['invoice'],$saletype);
            if (!$txtEstimate_id == 0) {
				if($data['sales_ref_type'] =='' ){
					$qry = "update sales_items set estimate_quantity=estimate_quantity+" . $item_qty[$i] . " where published ='yes' and sales_id= " . $txtEstimate_id . " and item_id=" . $item_id[$i];
					$this->db->query($qry);
				}else if($data['sales_ref_type'] != 'Nil' ){
					$qry = "update sales_items set estimate_quantity=estimate_quantity+" . $item_qty[$i] . " where published ='yes' and sales_id= " . $data['sales_ref_id'] . " and item_id=" . $item_id[$i];
					$this->db->query($qry);
				}
            }
        }
        if (!$txtEstimate_id == 0) {
            $qry = "select count(sales_id) as count from sales_items where published ='yes' and sales_id=" . $txtEstimate_id . " and quantity > estimate_quantity ";
            $query = $this->db->query($qry)->row_array();
            if ($query['count'] == 0) {
                $qry = "update sales set status='completed' where sales_id=" . $txtEstimate_id;
                $this->db->query($qry);
            } else {
                $qry = "update sales set status='incompleted' where sales_id=" . $txtEstimate_id;
                $this->db->query($qry);
            }
        }
        if ($or_type != 'estimate' && $or_type !='delivery_note') {
            $serv_ledgerid = $this->input->post('serv_ledgerid', TRUE);
            $serv_taxid = $this->input->post('serv_taxid', TRUE);
            $serv_amt = $this->input->post('serv_amt', TRUE);
            $serv_taxamt = $this->input->post('serv_taxamt', TRUE);
            $sertaxtotal = $this->input->post('sertaxtotal', TRUE);
            $sergtotal = $this->input->post('sergtotal', TRUE);
            $serv_is_taxincuded = $this->input->post('serv_is_taxincuded', TRUE);
            if ($this->input->post('serv_ledgerid')) {
                $length = sizeof($serv_ledgerid);
                for ($i = 0; $i < $length; $i++) {
                    $data = array(
                        'sales_id' => $insert_id,
                        'ledger_id' => $serv_ledgerid[$i],
                        'amount' => $serv_amt[$i],
                        'tax_id' => $serv_taxid[$i],
                        'tax' => $serv_taxamt[$i],
                        'is_taxincluded' => $serv_is_taxincuded[$i],
                        'published' => 'yes'
                    );

                    $this->InsertService($data, $data_sales, $or_type, $is_mul_led, $branch);
                }
            }
            $this->savesub($data_sales, $or_type, $insert_id, $subtot, $saletaxtot, $rount, $id, $is_mul_led, $branch,$receipt_amount);
        }
        return $insert_id;
    }

}
