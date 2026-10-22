<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Goldpurchase_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = 'purchase as a  left join (select distinct sales.old_pur_id  from sales where old_pur_id != 0) as purchase on purchase.old_pur_id = a.id left join suppliers as b on a.supplier_id =b.id left join acc_ledgers as c on c.ref_id=b.id and c.ref_code in ("cus","sup")';
        $this->column_order = array(null, 'b.name', 'invoice', 'date', 'total', null); //set column field database for datatable orderable
        $this->column_search = array('b.name', 'invoice', 'rdate'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->select = 'a.id as pid, IFNULL(purchase.old_pur_id,0) as old_pur_id, DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,c.id as ref,a.type as ptype, a.id as pid,a.published as pub,a.*,b.*';
    }

    function wheresupplier() {
//        $tmp = $this->session->userdata('user');
//        $userid = $tmp['Id'];
        $id = $this->input->post('supid');
        if ($this->input->post('stype')) {
            $this->wherecondition = "where a.published = 'yes' and a.type = '" . $this->input->post('stype') . "'  and a.supplier_id = " . $id;
        }
    }

//add custom filter here
    function delete($id, $type) {
        if ($type == "purchase") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'cr');
        }
        if ($type == "purchase_return") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'dt');
        }
		$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_id = ".$id." and tb_name = 'purchase'";
		$this->db->query($qry);
        $qry = "delete from  purchase where id =" . $id;
        $this->db->query($qry);
        $qry = "delete from purchase_items  where purchase_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='purchase' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='purchase_return' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='purchase' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='purchase_return' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function zeroindex() {
        $qry = 'select * from taxgst where GST="0" limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function InsertService($data, $pur_data, $or_type, $branch, $curr_value = 1,$purchase_cashaccount) {
        $total = $data['amount'];
        if ($data['tax'] != 0) {
            $total = $total - $data['tax'];
        }
        $this->db->insert('purchase_ledgers', $data);
        if ($or_type != 'purchase_order' && $or_type != 'order') {
            if (strtolower($pur_data['cash_type']) == 'cash') {
                //$toid = $this->cashaccount;
				$toid = $purchase_cashaccount;
                $this->trans_save($pur_data['invoice'], $data['purchase_id'], 'purchase', $or_type, $this->purchase, $data['ledger_id'], $pur_data['date'], '0.00', round($total * $curr_value, 2), $pur_data['narration'], 1, $pur_data['cost_center'], $branch);
            } else {
                $res = $this->getLedgers($pur_data['supplier_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($pur_data['invoice'], $data['purchase_id'], 'purchase', $or_type, $res['id'], $data['ledger_id'], $pur_data['date'], '0.00', round($total * $curr_value, 2), $pur_data['narration'], 1, $pur_data['cost_center'], $branch);
            }

            if ($data['tax'] != 0) {
                $this->tax_add($data['tax_id'], $data['amount'], $data['tax'], $data['amount'] - $data['tax']);
            }
        }
    }

    function max() {
        $qry = 'select max(id) as max_id from purchase';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function cancel($id, $type) {
        if ($type == "purchase") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'cr');
        }
        if ($type == "purchase_return") {
            $this->restorestock($id, 'pur');
            $this->restore_godown_stock_trans($id, 'dt');
        }
		$qry = "update acc_ageing set  credit = 0 ,debit =0 where  tb_id = ".$id." and tb_name = 'purchase'";
		$this->db->query($qry);
        $qry = "update  purchase set published ='no'  where id =" . $id;
        $this->db->query($qry);
        $qry = "update  purchase_items set published ='no' where purchase_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='purchase' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='purchase_return' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='purchase' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='purchase_return' and trans_id =" . $id;
        $this->db->query($qry);
    }

    function where() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $this->wherecondition = ' where  1';
        if ($this->input->post('type')) {
            $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
        }
        if ($this->input->post('btype')) {
			$this->wherecondition = $this->wherecondition . " and  a.bill_type = '" . $this->input->post('btype') . "'";
		}
		 if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and a.date >='" . $this->getDate($this->input->post('startdate'))."'";
		}
		if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and a.date <='" . $this->getDate($this->input->post('enddate'))."'";
		}

        if($this->input->post('purchase_type')){
            if($this->input->post('purchase_type') == 'O'){
                $this->wherecondition = $this->wherecondition.' and is_oldpurchase = "1" ';
            }else{
                $this->wherecondition = $this->wherecondition.' and is_oldpurchase = "0" ';
            }
        }else{
            $this->wherecondition = $this->wherecondition.' and is_oldpurchase = "1" ';
        }

    }

    function getpurchaseItems($id, $len, $size) {
        $qry = "select  g.*, h.hsncode as hsncd,a.mrp as mrps, a.*,b.* from purchase_items as a inner join item as b on a.item_id= b.id left join hsncode as h on h.hsnid=b.hsncode left join taxgst as g on a.tax_id=g.gstid where purchase_id= $id and a.published='yes' order by a.id desc limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchase($id) {
        $qry = "select c.code as statecode,a.published as pub, DATE_FORMAT(date,'%d-%m-%Y') as in_date,  a.type as ptp, a.*,b.* from purchase as a left join suppliers as b on a.supplier_id=b.id left join state as c on c.StateID=b.cst where a.id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItems($id) {
        $qry = " select h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = " select  h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

     function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT bill_no FROM  purchase  where  bill_type='" . $type . "' and published='yes'  order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['bill_no']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }

    function getorderdetails($id) {
        $qry = "select a.total,a.tax,a.invoice,a.date from purchase as a left join suppliers as b on a.supplier_id=b.id where a.id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchaseItemscnt($id) {
        $qry = "select  * from purchase_items as a inner join item as b on a.item_id= b.id  where a.published='yes' and purchase_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    public function alreadyexistcheck($invoice, $supplier) {
        $qry = "select count(*) as cnt from purchase where published='yes' and invoice='$invoice' and supplier_id =$supplier";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }
	
	public function purchase_emei($id){
		$qry = "select * from purchase_items_imei where published = 'yes' and pur_itms_id = ".$id;
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function insert_supplierdetails($data){
		$this->db->insert('suppliers',$data);
		$id = $this->db->insert_id();
		$ledger_data = array(
                        "name" => $data['name'],
                        "code" => $data['phone'],
                        "ref_id" => $id,
                        "ref_code" => 'cus',
                        "is_default" => true,
                        "acc_main_id" => 24,
                        "openning_bal" => 0,
                        "type" => 'Cr',
                        "published" => 'yes'
                    );
        $this->db->insert('acc_ledgers', $ledger_data);
		return $id;
	}

	public function updatepurchasebarcode($pindex,$purchase_id,$item_id,$quantity,$code,$date){
		$qry = 'select * from purchase_items_barcode where date = "'.$date.'" order by id desc limit 0,1 ';
		$d = $this->db->query($qry);
		if($d->num_rows() > 0 ){
			$d = $d->row_array();
			$start = (int) $d['cnt'] ;
		}else{
			$start =  0 ;
		}
		for($i = 0; $i  < $quantity; $i++){
			$start = (int) $start + 1;
			$data = array(
				'purchase_id'=>$purchase_id,
				'pindex'=>$pindex,
				'cnt'=>$start,
				'item_id'=>$item_id,
				'date'=>$date,
				'barcode'=>$code.$start
			);
			$this->db->insert('purchase_items_barcode',$data);
		}

	}

    public function save($or_type ='purchase') {
        $purchase_type =  $this->input->post('purchase_type');
        $tax_id = 0 ;
        $tax = 0 ;
        $is_oldpurchase = 1;
        if($purchase_type == 'N'){
            $tax_id =  $this->input->post('purtax_id');
            $tax =  $this->input->post('PurTax');
            $is_oldpurchase = 0;
        }
		$oldPAmt = $this->input->post('oldPAmt');
        if($oldPAmt ==''){
            $oldPAmt = 0 ;
        }
		$date = $this->input->post('date');
		$id = $this->input->post('id');
		$old_pur_id = $id;
        $date = $this->getDate($date);
		$supname = $this->input->post('cusname');
        $supaddress = $this->input->post('cusdetails');
        $supphone = $this->input->post('con_contact');
        if($supname ==''){
            $supname = $this->input->post('customername');
        }
		$btype = $this->input->post('btype');
		$billno = $this->getinoviceno($btype);
		$cash_type = $this->input->post('cash_type');
        $btype = $this->input->post('btype');
        $customer_id = $this->input->post('customer_id');
        $area = $this->input->post('area');
		$pur_data = array(
			'date'=>$date,
            'is_oldpurchase'=>$is_oldpurchase,
			'total'=>$oldPAmt,
            'tax_id'=>$tax_id,
            'tax'=>$tax,
			'supplier_id'=>$customer_id,
			'cash_type'=>$cash_type,
			'area'=>$area,
			'sales_refid'=>0,
			'supname'=>$supname,
			'supaddress'=>$supaddress,
			'supphone'=>$supphone,
		);
		if($id > 0 ){
			$ttp = 'cr';
			$this->restore_godown_stock_trans($old_pur_id, $ttp);
			$or_type = 'purchase';
			$qry = "update  purchase_items set published ='no' where purchase_id =" . $old_pur_id;
			$this->db->query($qry);
			$qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $old_pur_id;
			$this->db->query($qry);
			$qry = "update  acc_ledger_trans set published ='no' where tb_name='Purchase' and tb_id =" . $old_pur_id;
			$this->db->query($qry);
			$qry = "update  purchase_ledgers set published ='no'  where purchase_id =" . $old_pur_id;
			$this->db->query($qry);


			$qry ="select * from purchase where id = ".$old_pur_id;
			$p_data = $this->db->query($qry)->row_array();
			$billno = $p_data['bill_no'];
			$invoice = $p_data['invoice'];
			$this->db->where('id',$old_pur_id);
			$this->db->update('purchase',$pur_data);
		}else{
			$pur_data['bill_type'] = $btype;
			$invoice = $billno;
			$pur_data['invoice'] = $billno;
			$pur_data['bill_no'] = $billno;
			$this->db->insert('purchase',$pur_data);
			$old_pur_id = $this->db->insert_id();
		}


		
		$or_type = 'purchase';
		$toid = 1;;
		if($cash_type =='Credit'){
			$res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
			$toid = $res['id'];
		}

		if($cash_type =='Bank'){
			$Qry = 'select a.* ,b.id as ledid from  bank  as a inner join acc_ledgers as b on a.id = b.ref_id and ref_code = "Bank" ' ;
            $bank = $this->db->query($Qry);
            if($bank->num_rows() > 0 ){
                $bank = $bank->row_array();
                $toid =  $bank['ledid'];
                $qry = 'update purchase ase set bank_id = '.$bank['id'].'  where id = '.$old_pur_id;
                $this->db->query($qry);
            }
		}
		
		$this->trans_save($invoice, $old_pur_id, 'purchase', $or_type, $this->purchase, $toid, $date, round($oldPAmt * 1, 2), '0.00', '', 1, 1, 1);
		$this->trans_save($invoice, $old_pur_id, 'purchase', $or_type, $toid, $this->purchase, $date, '0.00', round($oldPAmt * 1, 2), '', 1, 1, 1);
		
		$oldpuritemid = $this->input->post('oldpuritemid',true);
		$purchasepurity = $this->input->post('purchasepurity',true);
		$oldpurhudid = $this->input->post('oldpurhudid',true);
		$oldpurpcs = $this->input->post('oldpurpcs',true);
		$oldpurgrosswt = $this->input->post('oldpurgrosswt',true);
		$oldpurstonewt = $this->input->post('oldpurstonewt',true);
		$oldpurmeltper = $this->input->post('oldpurmeltper',true);
		$oldpurmeltwt = $this->input->post('oldpurmeltwt',true);
		$oldpurnewwt = $this->input->post('oldpurnewwt',true);
		$oldpurrate = $this->input->post('oldpurrate',true);
        $oldpurmakingchg = $this->input->post('oldpurmakingchg',true);
        $oldpurstonechg = $this->input->post('oldpurstonechg',true);
		$oldpuramt = $this->input->post('oldpuramt',true);
		$len = sizeof($oldpuritemid);
		for($i =0;$i<$len;$i++){
			$puritem_data = array(
				'purchase_id'=> $old_pur_id,
				'item_id'=>$oldpuritemid[$i],
                'making_chg'=>$oldpurmakingchg[$i],
                'stone_chg'=>$oldpurstonechg[$i],
				'quantity'=>$oldpurpcs[$i],
				'purity'=>$purchasepurity[$i],
				'rate'=>$oldpurrate[$i],
				'hudid'=>$oldpurhudid[$i],
				'gross_wt'=>$oldpurgrosswt[$i],
				'stone_wt'=>$oldpurstonewt[$i],
				'melt_loss_per'=>$oldpurmeltper[$i],
				'melt_loss_wt'=>$oldpurmeltwt[$i],
				'net_wt'=>$oldpurnewwt[$i],
				'total'=>$oldpuramt[$i],
			);
			$this->db->insert('purchase_items',$puritem_data);
			$ttp = 'dt';
			$or_type = 'purchase';
			$this->stock_gold_trans(0, $oldpuritemid[$i],$oldpurpcs[$i],$oldpurnewwt[$i],$oldpurgrosswt[$i], $date, $ttp, $or_type, $old_pur_id, 0, 0, 0, 1, $invoice, '');
			$this->godown_gold_stock_trans(0, $oldpuritemid[$i],$oldpurpcs[$i], $ttp, $or_type, 1, 1);
		}
	



    }

	function getsing($id){
        

        $qry = 'select DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,a.*,b.*,i.name,s.name as supname from purchase as a inner join purchase_items as b on a.id = b.purchase_id and b.published ="yes" left join item as i on i.id = b.item_id left join suppliers as s on s.id = a.supplier_id where a.id = '.$id;
        $purchase = $this->db->query($qry)->result_array();
        $data['purchase'] = $purchase;

        echo json_encode($data);


    }


}
