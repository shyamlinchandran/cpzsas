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
        $this->select = 'x.invoice as xinvoice,a.longitude as salelongitude,a.latitude as salelatitude,0 as ref,a.published as pub, a.type as stype, DATE_FORMAT(a.invoice_date, "%d/%m/%Y" ) as in_date,  a.*,b.*,DATE_FORMAT(CONVERT_TZ(a.created_date,"+00:00","+05:30"),"%d/%m/%Y %H:%i:%S ") as created_time';
        $this->table = 'sales as a left join suppliers as b on a.customer_id =b.id left join sales as x on x.sales_id = a.estimate_id  ';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','a.total','b.email', 'b.phone', 'b.name', 'a.cusname', 'a.cusdetails'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
    }
	
	function get_group_discount($item_id,$discount_on){
		$qry = "select * from item where id = ".$item_id;
		$item = $this->db->query($qry);
		if($item->num_rows() > 0 ){
			$item = $item->row_array();
			$item_category_id = $item['item_category_id'];
			$brand_id = $item['brand_id'];
			if($discount_on == 'category'){
				$qry = "SELECT IFNULL(b.discount,0) as discount FROM `item_category` as a INNER JOIN item_group as b on a.discount = b.id where a.id =  '".$item_category_id."' ";
				$query = $this->db->query($qry)->result_array();
				return $query;
			}
			
			else if($discount_on == 'brand'){
				$qry = "SELECT IFNULL(b.discount,0) as discount FROM `item_brand` as a INNER JOIN item_group as b on a.discount = b.id where a.ibr_id =  '".$brand_id."' ";
				$query = $this->db->query($qry)->result_array();
				return $query;
			}else{
				$qry = "select * from item_brand where ibr_id = 'abc' ";
				$query = $this->db->query($qry)->result_array();
				return $query;
			}
		}else{
			$qry = "select * from item_brand where ibr_id = 'abc' ";
			$query = $this->db->query($qry)->result_array();
			return $query;
		}
	}
	
	function get_order_id($invoice){
		$qry = "SELECT * FROM `sales` WHERE published ='yes' and type='estimate' and invoice ='".$invoice."' ";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			return $query['sales_id'];
		}else{
			return 0;
		}
	}
	
	function check_invoice_exist($invoice,$bill_type){
		$qry = "select * from sales where bill_type = '".$bill_type."' and  invoice = '".$invoice."' and published ='yes'";
		$query = $this->db->query($qry);
		return $query->num_rows();
	}
	
	function update_order($estimate_id){
		$qry = "UPDATE `sales` SET `status` = 'completed' WHERE `sales`.`sales_id` = ".$estimate_id;
		$this->db->query($qry);
	}
	
	function update_bill_margin($data_sales,$insert_id){
		$this->db->where('sales_id',$insert_id);
		$this->db->update('sales',$data_sales);
		$qry = "SELECT sum(si.itm_raw_ces) as additional_cess FROM `sales_items` as si WHERE sales_id =  ".$insert_id;
		$query = $this->db->query($qry)->row_array();
		$data = array(
			'additional_cess'=>$query['additional_cess']
		);
		$this->db->where('sales_id',$insert_id);
		$this->db->update('sales',$data);
	}
	
	function getreturnledgers($return_id){
		$qry = "select b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from  acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE b.ref_code in('cus','sup') and b.ref_id in(".$return_id.")  ";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	
	function getces($id){
		$qry = "select * from cess_tbl where ces_id = ".$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			return $query['cess_on_tax'];
		}else{
			if((float) $id < 1 ){
				return 0;
			}else{
				return 1;
			}
		}
	}
	
	function getsales_ledgers($id){
		$qry = "SELECT GST,b.name,a.* FROM `sales_ledgers` as a INNER JOIN acc_ledgers as b on a.ledger_id = b.id left join taxgst as t on t.gstid = a.tax_id WHERE a.published ='yes' and sales_id =".$id;
		$query = $this->db->query($qry);
		return $query;
	}
	
	function get_old_rate(){
		$supid = $this->input->post('supid');
		$item_id = $this->input->post('item_id');
		$qry = "SELECT * from item as a INNER JOIN sales_items as b on a.id=b.item_id INNER JOIN sales as c on c.sales_id =b.sales_id WHERE a.id = ".$item_id." and customer_id = '".$supid."' limit 0,5";
		//$qry = "SELECT a.name,c.invoice,c.invoice_date,b.mrp from item as a INNER JOIN sales_items as b on a.id=b.item_id INNER JOIN sales as c on c.sales_id =b.sales_id and b.published='yes' WHERE a.id = ".$item_id." order by c.sales_id desc limit 0,5";
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
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
		 if ($this->input->post('status')) {
            $this->wherecondition = $this->wherecondition . " and a.status ='" . $this->input->post('status')."'";
		}

        if ($this->input->post('saletype')) {
            $this->wherecondition = $this->wherecondition . " and a.saletype ='" . $this->input->post('saletype')."'";
		}
		 if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . " and a.invoice_date >='" . $this->getDate($this->input->post('startdate'))."'";
		}
		if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . " and a.invoice_date <='" . $this->getDate($this->input->post('enddate'))."'";
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
            $this->wherecondition = "where a.type = '" . $this->input->post('stype') . "' and  a.customer_id = " . $id;
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
        $txt = '"" as schemetill,"" as schemefrom,"" as schemedesc,';
        $settings = $this->getCompanySettings();
        $Scheme_Discount = 0;
        if(isset($settings[0]['Scheme_Discount'])){
            $Scheme_Discount  = $settings[0]['Scheme_Discount'];
        }
        if($Scheme_Discount > 0 ){
            $txt = "DATE_FORMAT(scheme_till,'%d-%m-%Y') as schemetill,DATE_FORMAT(scheme_from,'%d-%m-%Y') as schemefrom,scheme_desc as schemedesc,";
        }
        $qry = "select $txt IFNULL(b.name,cusname) as cuname,dr.Driver_name,case when cusname is not null and cusname != '' then cusname else b.name end as customername,IFNULL(Vehicle_num,'') as vhl,IFNULL(ima.area,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') as areaname,IFNULL(u.user_name,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') as salesmanname,DATE_FORMAT(CONVERT_TZ(created_date,'+00:00','+05:30'),'%d/%m/%Y %H:%i:%S ') AS in_cdate,u.user_name as salesman_name,IFNULL(state.code,'') as custstatecode,c.code as statecode,IFNULL(const.StateName,'') as constatename,c.StateName,DATE_FORMAT(CONVERT_TZ(created_date,'+00:00','+05:30'),'%d/%m/%Y %H:%i:%S ') AS in_cdate,t.brc_name,t.brc_address,brc_phone,IFNULL(customer_id,0) as cusid,l.name as Bank,IFNULL(adjustment_amount,0) as adjustment,DATE_FORMAT(created_date, '%Y-%m-%d  %T') AS createdate,DATE_FORMAT(created_date, '%d/%m/%Y %H:%i:%s') AS createdat,user_name,a.type as stype,a.published as pub,IFNULL(c.StateName,'Kerala') as StateNames,IFNULL(c.code,'32') as StateCodes, DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date,  a.type as stp, a.*,b.* from sales as a  left join set_billtype as s on s.id=a.bill_type left join  company_branch as t on t.brc_id=s.branch_id left join suppliers as b on a.customer_id=b.id left join acc_ledgers as l on l.id=a.bank_id left join users as u on u.id=a.salesman left join state as c on c.StateID=b.cst left join state as const on const.StateID = a.con_state left join state on state.StateID = a.cusstate  left join ims_area as ima on ima.id = b.area  left join ims_vehicle as iv on iv.Id = a.vehicle left join ims_driver as dr on dr.Id = a.driver where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function gettaxparticulars($id) {
        $qry = "select sum(total-tax) as taxable,sum(tax) as total,GST from sales_items as a inner join taxgst as b on a.tax_id=b.gstid where a.published='yes' and a.sales_id=" . $id . " group by tax_id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getSalesItems($id, $len, $size) {
        $qry = "select IFNULL(DATE_FORMAT(ig.expiry_date, '%d/%m/%Y' ),'') as exp,ic.name as cat,uqc.uqc_name,a.rate as discount_percentage, case when item_mrp > 0  then item_mrp  else b.MRP end as imrp,	ct.ces_percent,IFNULL(u.code,'') as ucode,g.*, h.hsncode as hsncd,a.mrp as mrps,IFNULL(u.name,'') as uname, a.*,b.* from sales_items as a left join item_godown as ig on ig.item_id = a.item_id and ig.batch = a.batch and ig.godown_id = a.godown left join cess_tbl as ct on ct.ces_id =a.ces inner join item as b on a.item_id= b.id left join item_category as ic on ic.id = b.item_category_id  left join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid left join units as u on u.id= a.unit_id left join uqc on uqc.uqc_id = u.uqc where sales_id= $id and a.published='yes' order by sal_itms_id desc limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getgstItems($id) {
        // $qry = " SELECT sum(total) as tot,sum(total-tax) as beforetax,sum(tax) as tax,gst,sum(dis_amt) as dis_amt FROM sales_items as a INNER JOIN taxgst as b on a.tax_id=b.gstid WHERE `sales_id`=$id AND  a.published='yes' and a.tax!=0 order by a.tax_id";
        $qry = " SELECT sum(total-tax+dis_amt-itm_raw_ces-ces_amt) as tot,sum(total-tax-itm_raw_ces-ces_amt) as beforetax,sum(tax) as tax,gst,sum(dis_amt) as dis_amt FROM sales_items as a INNER JOIN taxgst as b on a.tax_id=b.gstid WHERE `sales_id`=$id AND  a.published='yes' ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
	
	function getHsndetails($id){
		$qry = "SELECT h.hsncode,t.GST/2 as GST,sum(total-tax) as taxable,sum(tax/2) as cgst,sum(tax/2) as sgst,sum(tax) as tax from sales_items as a INNER JOIN item as b on a.item_id =b.id and a.published ='yes' left JOIN hsncode as h on h.hsnid =b.hsncode INNER JOIN taxgst as t on t.gstid =a.tax_id WHERE sales_id =".$id." GROUP by h.hsnid,t.gstid";
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
        $qry = 'select a.*,percent,percent_type from acc_ledgers as a inner join reference as b on a.ref_id =  b.ref_id and a.ref_code ="ref"  where a.ref_id=' . $id . ' and a.ref_code ="ref"';
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function delete($type, $id) {
        if ($type == 'sales_return') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'cr');

            $qry = 'select * from return_ageing_trans where status = 1 and   sales_return_id = '.$id;
            $old = $this->db->query($qry);
            if($old->num_rows() > 0 ){
                $old = $old->row_array();
                $qry = 'update acc_ageing set return_amount = return_amount - '.$old['amount'].' , debit = debit + '.$old['amount'].' where tb_name = "Sales" and tb_id  = '.$old['sales_id'].' ';
                $this->db->query($qry);
                $qry = 'update  return_ageing_trans set  status = 0 where sales_return_id =  '.$id;
                $this->db->query($qry);
            }


        }
        if ($type == 'sales') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'dt');
        }
		 if ($type == 'delivery_note') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'dt');
        }
		
		$qry = "SELECT * FROM `sales` WHERE estimate_id > 0 and sales_id =".$id;
		$query = $this->db->query($qry);
		if( $query->num_rows() > 0 ){
			$query = $query->row_array();
			$this->restoreestimate($id,$query['estimate_id']);
		}
		
        $old_qry = "select * from sales where sales_id = ".$id." ";
		$old_data = $this->db->query($old_qry)->row_array();
		$old_date = $old_data['invoice_date'];
			

		$qry = "update acc_ageing set  credit = 0 ,debit =0 where tb_crdate = '".$old_date."' and tb_id = ".$id." and tb_name = 'Sales'";
		$this->db->query($qry);
        $qry = "delete from  sales where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  sales_items set published ='no' where sales_id =" . $id;
		$this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  item_ledger  where trans_status='Sales' and trans_id =" . $id;
        $this->db->query($qry);

        $qry = "select * from voucher where  sales_ref_id=".$id;
        $query = $this->db->query($qry);
        $cnt = $query->num_rows();
        if((float) $cnt > 0 ){
            $query = $query->result_array();
            foreach($query as $it){
                $old = $it['id'];
                $old_no = $it['voucher_no']; 
                $qry = 'update voucher set published="no" where id ='.$old;
                $this->db->query($qry);
               
                $qry = "update  acc_ledger_trans set published ='no' where trn_tp  != 'Cheque' and  tb_name='voucher' and tb_id =" . $old;
                $this->db->query($qry);
            }


            

        }
    }

    function cancel($type, $id) {
        if ($type == 'sales_return') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'cr');

            $qry = 'select * from return_ageing_trans where status = 1 and   sales_return_id = '.$id;
            $old = $this->db->query($qry);
            if($old->num_rows() > 0 ){
                $old = $old->row_array();
                $qry = 'update acc_ageing set return_amount = return_amount - '.$old['amount'].' , debit = debit + '.$old['amount'].' where tb_name = "Sales" and tb_id  = '.$old['sales_id'].' ';
                $this->db->query($qry);
                $qry = 'update return_ageing_trans set    status = 0 where sales_return_id =  '.$id;
                $this->db->query($qry);
            }


        }
        if ($type == 'sales') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'dt');
        }
		 if ($type == 'delivery_note') {
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, 'dt');
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
        $old_qry = "select * from sales where sales_id = ".$id." ";
		$old_data = $this->db->query($old_qry)->row_array();
		$old_date = $old_data['invoice_date'];
		$qry = "update acc_ageing set  credit = 0 ,debit =0 where tb_crdate = '".$old_date."' and tb_id = ".$id." and tb_name = 'Sales'";
		$this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger  set published ='no' where trans_status='Sales' and trans_id =" . $id;
        $this->db->query($qry);



            $qry = "select * from voucher where  sales_ref_id=".$id;
            $query = $this->db->query($qry);
            $cnt = $query->num_rows();
            if((float) $cnt > 0 ){
                $query = $query->result_array();
                foreach($query as $it){
                    $old = $it['id'];
                    $old_no = $it['voucher_no']; 
                    $qry = 'update voucher set published="no" where id ='.$old;
                    $this->db->query($qry);
                   
                    $qry = "update  acc_ledger_trans set published ='no' where trn_tp  != 'Cheque' and  tb_name='voucher' and tb_id =" . $old;
                    $this->db->query($qry);
                }


                

            }
    }

    function InsertSales($data,$type = 0 ) {
		if((float) $type > 0 ){
			$this->data = array();
			$this->cesdata = array();
		}
        $this->db->insert('sales', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function UpdateSales($data, $id, $or_type) {
        $this->updatevoucherAudit($id,'Sales',$data['type'],$data['invoice'],$data['total'],'',0,0,$data['created_by']);
		$qry = "select * from sales where sales_id = ". $id;
		$query = $this->db->query($qry)->row_array();
		$redeemed_points = $query['redeemed_points'];
		if((float) $redeemed_points > 0 ){
			$qry = "update suppliers set redeemed_points = redeemed_points - ".$redeemed_points ." where id= '".$query['customer_id']."' ";
			$this->db->query($qry);
		}
        if ($or_type == 'sales' || $or_type == 'delivery_note' ) {
            $ttp = 'dt';
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, $ttp);
        } else if ($or_type == 'sales_return') {
            $ttp = 'cr';
            $this->restorestock($id, 'sales');
            $this->restore_godown_stock($id, $ttp);
        }
        $this->db->where('sales_id', $id);
        $this->db->update('sales', $data);
		$qry = "select * from sales_items where published = 'yes' and sales_id =" . $id;
		$result = $this->db->query($qry)->result_array();
		foreach($result as $item){
			if($item['emei'] != ''){
				$qry = "UPDATE `purchase_items_imei` SET `status` = '1' WHERE imei =  '".$item['emei']."'";
				$this->db->query($qry);
			}
		}
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
                $this->trans_save($data_sales['invoice'], $data['sales_id'], 'Sales', $or_type, $this->paytype, $data['ledger_id'], $data_sales['invoice_date'], $total, '0.00', $data_sales['narration'].';;'.$data_sales['ref_no'], 1, $data_sales['cost_center'], $branch);
            } else {
                $res = $this->getLedgers($data_sales['customer_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($data_sales['invoice'], $data['sales_id'], 'Sales', $or_type, $res['id'], $data['ledger_id'], $data_sales['invoice_date'], $total, '0.00', $data_sales['narration'].';;'.$data_sales['ref_no'], 1, $data_sales['cost_center'], $branch);
            }

            if ($data['tax'] != 0) {
                $this->tax_add($data['tax_id'], $data['amount'], $data['tax'], $data['amount'] - $data['tax']);
            }
        }
    }

    function InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $invoice = "",$saletype ='b2c',$cess_total = 0 ) {
		$damage_qty = 0;
		if(isset($data['damage_quantity'])){
			$damage_qty = $data['damage_quantity'];
		}
        $qty = $this->getquantity($data['unit_id'], $data['quantity'], $data['item_id']);
        if ((int) $data['free_quantity'] > 0 && $data['sales_ref_type'] != 'delivery_note') {
            $fre_qty = $this->getquantity($data['unit_id'], $data['free_quantity'], $data['item_id']);
			$data['base_free_quantity'] = $fre_qty;
        }
		if ((int) $damage_qty > 0 && $data['sales_ref_type'] != 'delivery_note' && $damage_qty !='') {
            $damage_qty = $this->getquantity($data['unit_id'], $damage_qty,$data['item_id']);
			$data['base_damage_quantity'] = $damage_qty;
        }
		
		$data['base_quantity'] = $qty;
        $this->db->insert('sales_items', $data);
        if ($or_type != 'estimate') {
			if((int) $data['itm_ces_id'] > 0 ){
				$this->ces_add($data['itm_ces_id'],$data['itm_raw_ces']);
			}
			if($saletype =='b2c' && (int) (int) $data['is_taxincluded'] > 0  && (float) $cess_total > 0  ){
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
				$this->godown_stock_trans(0, $data['item_id'], $qty, $ttp, $or_type, $data['godown'], $data['batch']);
				if ((int) $data['free_quantity'] > 0) {
					$this->stock_trans(0, $data['item_id'], $fre_qty, $invoicedate, $ttp, $or_type, $data['sales_id'], $data['rate'], $data['mrp'], $data['tax_id'], $data['godown'], $invoice, $data['batch']);
					$this->godown_stock_trans(0, $data['item_id'], $fre_qty, $ttp, $or_type, $data['godown'], $data['batch']);
				}
				if(isset($data['damage_quantity'])){
					if ((int) $data['damage_quantity'] > 0) {
						$this->stock_trans(0, $data['item_id'], $damage_qty, $invoicedate, $ttp, $or_type, $data['sales_id'], $data['rate'], $data['mrp'], $data['tax_id'], $data['godown'], $invoice, $data['batch']);
						$this->godown_stock_trans(0, $data['item_id'], $damage_qty, $ttp, $or_type, $data['godown'], $data['batch']);
					}
				}
			}
        }
    }

    function update_return_aeging($sales_id,$return_id){
        $qry = "select * from sales where sales_id = ".$return_id;
        $data = $this->db->query($qry)->row_array();
        $dat = array(
            'sales_id'=>$sales_id,
            'sales_return_id'=>$return_id,
            'amount'=>$data['total'],
            'status'=>1
        );
        if($data['cash_type'] == 'Credit'){
            if($sales_id > 0 ){
                $qry = 'select * from return_ageing_trans where status = 1 and  sales_return_id = '.$return_id;
                $old = $this->db->query($qry);
                if($old->num_rows() > 0 ){
                    $old = $old->row_array();
                    $qry = 'update acc_ageing set return_amount = return_amount - '.$old['amount'].' , debit = debit + '.$old['amount'].' where tb_name = "Sales" and tb_id  = '.$old['sales_id'].' ';
                    $this->db->query($qry);
                    $this->db->where('id',$old['id']);
                    $this->db->update('return_ageing_trans',$dat);
                    $qry = 'update acc_ageing set return_amount = return_amount + '.$dat['amount'].' , debit = debit - '.$dat['amount'].' where tb_name = "Sales" and tb_id =  '.$dat['sales_id'].' ';
                    $this->db->query($qry);
                }else{
                    $this->db->insert('return_ageing_trans',$dat);
                    $qry = 'update acc_ageing set return_amount = return_amount + '.$dat['amount'].' , debit = debit - '.$dat['amount'].' where tb_name = "Sales" and tb_id =  '.$dat['sales_id'].' ';
                    $this->db->query($qry);
                }


            }

        }else{
            $qry = 'select * from return_ageing_trans where status = 1 and   sales_return_id = '.$return_id;
            $old = $this->db->query($qry);
            if($old->num_rows() > 0 ){
                $old = $old->row_array();
                $qry = 'update acc_ageing set return_amount = return_amount - '.$old['amount'].' , debit = debit + '.$old['amount'].' where tb_name = "Sales" and tb_id  = '.$old['sales_id'].' ';
                $this->db->query($qry);
                $qry = 'update  return_ageing_trans set  status = 0 where sales_return_id =  '.$return_id;
                $this->db->query($qry);
            }

        }

    }


    

    function savesub($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id, $is_mul_led, $branch,$receipt_amount=0,$old_date ='') {
        if($or_type == 'sales_return' ) {
            $this->update_return_aeging($data['estimate_id'],$insert_id);
        }
        if (isset($data['ref_id']) && $data['ref_id'] != 0) {
            $refs = $this->getRefLedger($data['ref_id']);
			$percent = $refs['percent'];
			$percent_type = $refs['percent_type'];
			if((float)$percent > 0 && (float) $percent_type > 0   ){
				$amount_ref = (float) $data['total'] * (float) $percent / 100;
				$this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $refs['id'], $this->ref, $data['invoice_date'], '0.00', $amount_ref, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
				$this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->ref, $refs['id'], $data['invoice_date'], $amount_ref, '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
			}else if( (float) $percent_type > 0  ){
			
			}
	    }
        $toid = 0;
        if (strtolower($data['cash_type']) == 'cash' || strtolower($data['cash_type']) == 'bank') {
            $toid = $this->paytype;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $data['total'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
			if($old_date != ''){
                $qry = "UPDATE `acc_ageing` SET `debit` = '0',credit ='0' WHERE tb_crdate = '".$old_date."' and  tb_name = 'Sales' and tb_id = ".$insert_id;
			    $this->db->query($qry);
            }
            
        } else if (strtolower($data['cash_type']) == 'cob' || strtolower($data['cash_type']) == 'ba_ca_cr') {
            $toid = $this->paytype;
            if ($this->input->post('bank_account') && $this->input->post('bank_amount')) {
                $bank_amount = $this->input->post('bank_amount');
                $bank_account = $this->input->post('bank_account');
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $bank_account, $data['invoice_date'], '0.00', $bank_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
            $cash_amount = $this->input->post('cash_amount');
            if ($this->input->post('cash_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
            $bank_amount = 0;
            if ($this->input->post('bank_amount')) {
                $bank_amount = $this->input->post('bank_amount');
            }
            $tot_amt = $cash_amount + $bank_amount;
            if (strtolower($data['cash_type']) == 'ba_ca_cr') {
                $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
                $toid = $res['id'];
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $tot_amt, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
                if($or_type != 'sales_return' ) {
                    $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $tot_amt - $receipt_amount, 0, 0, 0,$old_date);
                }
            }else{
                if($old_date != ''){
                    $qry = "UPDATE `acc_ageing` SET `debit` = '0',credit ='0' WHERE tb_crdate = '".$old_date."' and  tb_name = 'Sales' and tb_id = ".$insert_id;
				    $this->db->query($qry);
                }
			}
        } else if (strtolower($data['cash_type']) == 'ca_cr') {
            $cash_amount = $this->input->post('cash_amount');
            if ($this->input->post('cash_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $cash_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            if($or_type != 'sales_return' ) {
                $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $cash_amount - $receipt_amount, 0, 0, 0,$old_date);
            }
        } else if (strtolower($data['cash_type']) == 'ba_cr') {
            $cash_amount = $this->input->post('bank_amount');
            if ($this->input->post('bank_amount')) {
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $cash_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'] - $cash_amount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            if($or_type != 'sales_return' ) {
                $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'] - $cash_amount - $receipt_amount, 0, 0, 0,$old_date);
            }
        } else {
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            if($or_type != 'sales_return' ) {
                $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total']- $receipt_amount, 0, 0, 0,$old_date);
            }
        }
        if (is_numeric($data['discount']) == true && $data['discount'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['discount'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['redeemed_amount']) == true && $data['redeemed_amount'] != 0) {
			$qry = 'update suppliers set redeemed_points = redeemed_points + '.$data['redeemed_points'].' where id =  "'.$data['customer_id'].'" ';
			$this->db->query($qry);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['redeemed_amount'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
        if (is_numeric($data['freight']) == true && $data['freight'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesFr, $data['invoice_date'], $data['freight'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['other']) == true && $data['other'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesCoolie, $data['invoice_date'], $data['freight'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }

        // if(isset($data['bata']) ){
        //     if ( (float) $data['bata'] >  0) {
        //         $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, 5, $data['invoice_date'], $data['bata'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        //     }
        // }

        // if(isset($data['transit_fee']) ){
        //     if ((float) $data['transit_fee'] >  0) {
        //         $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, 6, $data['invoice_date'], $data['transit_fee'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        //     }
        // }

        $salesamount = $subtot;
        if ($is_mul_led == 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $salesamount, '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        } else {
            $this->tax_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'].';;'.$data['ref_no'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);
        }
        if ($rount > 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], $rount, '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], '0.00', $rount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }

        if ($data['cess'] > 0 && $data['saletype'] == "b2c") {
            $qry = 'select * from acc_ledgers where name like"%cess%"';
            $query = $this->db->query($qry);
            if ($query->num_rows() > 0) {
                $query = $query->row_array();
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $query['id'], $data['invoice_date'], $data['cess'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
        }
        $this->ces_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'].';;'.$data['ref_no'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);

		
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
	
	public function get_sales_point($total,$customer_id,$insert_id){
		$settings = $this->getCompanySettings();
		$sales_point = 0;
		if(isset($settings[0]['customer_points']) ){
			$customer_points = $settings[0]['customer_points'];
			if((float) $customer_points > 0 && (float) $customer_id > 0  ){
				$qry ="select * from point_settings ";
				$query = $this->db->query($qry);
				$one_point_equivalent = 0;
				if($query->num_rows()>0){
					$query = $query->row_array();
					$one_point_equivalent = $query['one_point_equivalent'];
				}
				if((float) $one_point_equivalent > 0 && (float) $total > 0 ){
					$total_sales_amount = $total;
					$sales_point = $total_sales_amount / $one_point_equivalent;
					$sales_point= $pieces = explode(".", $sales_point);
					$sales_point = $sales_point[0];
				}
				$this->update_customer_point($customer_id,$sales_point,$insert_id,$total);
			}
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



    function batapayment($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch){
        $toid = 1;
        $ledger = 5;
        $qry = "select * from voucher where vourcher_type = 'payment' and  sales_ref_id=".$insert_id;
        $query = $this->db->query($qry);
        $cnt = $query->num_rows();
        if((float) $cnt > 0 ){
            $query = $query->row_array();
            $old = $query['id'];
            $old_no = $query['voucher_no']; 
        }
        $qry = "SELECT * FROM `set_billtype` WHERE transaction ='pay' order by id asc limit 0,1";
        $query = $this->db->query($qry)->row_array();
        $billtype = $query['id'];
        if((float) $cnt < 1){
             $voucher_no = $this->generatevouchernumber($billtype);
             $data = array(
                'voucher_no'=>$voucher_no,
                'sales_ref_id'=>$insert_id,
                'ledger' => 1,
                'amount' => $receipt_amount,
                'vourcher_type'=>'payment',
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
            $this->trans_save($voucher_no, $insert_id, 'voucher', "payment", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], $costcenter, $branch);
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
            $this->getSaved($qry);
            $this->trans_save($voucher_no, $insert_id, 'voucher', "payment", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], $costcenter, $branch);
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
            $qry = "update  acc_ledger_trans set published ='no' where trn_tp  = 'payment' and tb_name='voucher' and tb_id =" . $old;
            $this->db->query($qry);
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $old;
            $this->db->query($qry);
            $this->trans_save($old_no, $insert_id, 'voucher', "payment", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], $costcenter, $branch);
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
            $this->getSaved($qry);
            $this->trans_save($old_no, $insert_id, 'voucher', "payment", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], $costcenter, $branch);
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
            $this->getSaved($qry);
        }
    }

    
	function transitreceipt($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch){
        $toid = 6;
        $ledger = 1;
        $qry = "select * from voucher where vourcher_type = 'receipt' and sales_ref_id=".$insert_id;
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
            $this->trans_save($old_no, $insert_id, 'voucher', "receipt", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'], $data['created_by'], $costcenter, $branch);
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',0.00,' . $data['amount'] . ')';
            $this->getSaved($qry);
            $this->trans_save($old_no, $insert_id, 'voucher', "receipt", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'], $data['created_by'], $costcenter, $branch);
            $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
            $this->getSaved($qry);
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

    public function converttosales($sales_id,$billtype){
        $settings = $this->getCompanySettings();
        $onsync_discount = 0 ;
        if(isset($settings[0]['onsync_discount'] ) ){
            $onsync_discount = $settings[0]['onsync_discount'];
        }
        $qry = "select * from sales where sales_id = ".$sales_id;
        $sales_data = $this->db->query($qry)->row_array();
        $or_type = 'sales';
        $type = $sales_data['cash_type'];
        if (strtolower($type) != 'credit') {
            if(strtolower($type) == 'cash'){
                $this->paytype = 1; 
            }else{
                $this->paytype =  $sales_data['bank_id']; 
                $qry = "SELECT * FROM `acc_ledgers` WHERE ref_code = 'bank' and ref_id =".$sales_data['bank_id']." ";
                $bankarray = $this->db->query($qry);
                if($bankarray->num_rows() > 0 ){
                    $bankarray = $bankarray->row_array();
                    $this->paytype = $bankarray['id'];
                }
            }
            
        }


        $costcenter = $sales_data['cost_center'];
        $adjustment_amount = 0;
        $collected = 0;
        $id = 0;
        // $qry = "select * from set_billtype where transaction = 'sales' ";
        // $billtype = $this->db->query($qry)->row_array();
        // $billtype = $billtype['id'];
        $this->data = array();
        $this->taxdata = array();
        $invoice = $this->getinoviceno($billtype);
		$txtglobalmrp  = 0 ;
        $branch = $this->getbranch($billtype);
        $is_mul_led = 1;
        $ewb_no = $sales_data['ewb_no'];
        $ewb_details = $sales_data['ewb_details'];
        $route = $sales_data['route'];

        $printtype = $sales_data['printtype'];

        $gst = $sales_data['cusgst'];
        $state = $sales_data['cusstate'];
        $salesman = $sales_data['salesman'];
        $area = $sales_data['area'];
        $deldate = date('Y-m-d'); //delivery date
        $cdate =date('Y-m-d'); //delivery date
        $invoicedate = date('Y-m-d'); //delivery date
        $invoicedate = date('Y-m-d'); //delivery date

        $date = new DateTime(null, new DateTimezone("Asia/Kolkata"));
        $invoicedate = $date->format('Y-m-d');


        $commi_amt_hi = 0;
       
		$packing_details = $sales_data['packing_details'];
        $saletype = $sales_data['saletype'];
        $txtEstimate_id = $sales_id;
        $terms_condition = $sales_data['terms_condition'];
        // $despatch_details = $this->input->post('des_det');
        $con_name = $sales_data['con_name'];
        $tot_cess = $sales_data['cess'];
        $con_addr = $sales_data['con_addr'];
        $con_contact = $sales_data['con_contact'];
        $con_gst = $sales_data['con_gst'];
        $con_state =$sales_data['con_state'];
        $reference ='';
        $freight = $sales_data['freight'];
        $advance = $sales_data['advance'];
        $bill_margin = $sales_data['bill_margin'];
        $other =$sales_data['other'];
        $discount = $sales_data['discount'];
        $rount = $sales_data['roundoff'];
        $tax = $sales_data['tax'];
        $vehicle =$sales_data['vehicle'];
        $gtotal = $sales_data['total'];
        $customer_id = $sales_data['customer_id'];
		// if($type !="Cash" && $type !="Bank" && $type!="COB"){
		// 	if($customer_id ==0 || $customer_id =='0' || $customer_id ==""){
		// 		$customer_details = array(
		// 			'name'=>$sales_data['cusname'],
		// 			'phone'=>$sales_data['cusdetails'],
		// 			'address_line1'=>$sales_data['cusemail'],
		// 			'tin'=>$sales_data['cusgst'],
		// 			'type'=>'cus'
		// 		);
		// 		$customer_id = $this->insert_customerdetails($customer_details);
		// 	}
		// }
        $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
        $supname = $sales_data['cusname'];
		
        $phone = $sales_data['cusdetails'];
        $email =$sales_data['cusemail'];
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		$cash_status  = '';
		$redeem_amount = 0 ;
		$redeemed_points = 0;
		$itm_net_ces = $sales_data['additional_cess'];
		
		$receipt_amount = 0;
		
		$vehicle_no = '';
		$transport_mode = '';
		$ref_no = '';
		$place  ='';
		$ref_no = $sales_id;
		
		
		$paper_size = 'full';
		
		$con_state = $sales_data['con_state'];
		
		$bank_pay_method = $sales_data['bank_pay_method'];
		$gpay_no =$sales_data['gpay_no'];
        $data_sales = array(
			'ref_no'=>$ref_no,
			'gpay_no'=>$gpay_no,
			'bank_pay_method'=>$bank_pay_method,
			'place'=>$place,
			'con_state'=>$con_state,
            'remarks'=>$sales_data['remarks'],
			'vehicle_no'=>$vehicle_no,
			'transport_mode'=>$transport_mode,
			'paper_size'=>$paper_size,
			'estimate_id'=>$txtEstimate_id,
			'additional_cess'=>$itm_net_ces,
            'invoice_date' => $invoicedate,
            'bill_margin' => $bill_margin,
            'cess' => $tot_cess,
			'packing_details'=>$packing_details,
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
            'delivery_date' => $deldate,
            'credit_eod' => $cdate,
            'total' => $gtotal,
            'ewb_no' => $ewb_no,
            'cash_amount' => 0,
            'bank_amount' => 0,
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
           // 'created_date' => date('Y-m-d H:i:s', time()),
            'narration' => $narration,
            'created_by' => $created_by,
            'type' => $or_type,
            'bill_type' => $billtype,
			'receipt_amount'=>$receipt_amount,
            'cusname' => $supname,
            'cusdetails' => $phone,
            'cusemail' => $email,
			'customer_id'=>$customer_id,
            'published' => 'yes',
            'printtype'=>1
        );
        $data_sales['ref_id'] = 'sales_id';
        
        $data_sales['area'] = $sales_data['area'];
        $data_sales['vehicle'] = $sales_data['vehicle'];
        
        
        $insert_id = 0;
		
		$receipt_amount = 0;
		
        if ($id == 0) {
            $data_sales['printtype'] =  $printtype;
            $data_sales['invoice'] = $invoice;
            $insert_id = $this->InsertSales($data_sales);
			
        } 
		
		$sales_items_array = 'select * from sales_items where   published = "yes" and sales_id =  '.$sales_id;
        if((int)  $onsync_discount  > 0  ){

        }
        $sales_items_array = $this->db->query($sales_items_array)->result_array();
        $subtot = 0 ;
       
        foreach ($sales_items_array as $sitem) {
			
            $data = array(
                'analytics' => 0,
                'sales_id' => $insert_id,
				'item_landing_cost'=>$sitem['item_landing_cost'],
                'item_id' => $sitem['item_id'],
				'itm_ces_id'=>$sitem['itm_ces_id'],
				'mar_pur_rate'=>$sitem['mar_pur_rate'],
				'item_commission'=>$sitem['item_commission'],
				'itm_ces_name'=>$sitem['itm_ces_name'],
				'add_dis_per'=>$sitem['add_dis_per'],
				'add_dis_amt'=>$sitem['add_dis_amt'],
				'itm_ces_per'=>$sitem['itm_ces_per'],
				'itm_raw_ces'=>$sitem['itm_raw_ces'],
                'ces_amt' =>$sitem['ces_amt'],
                'batch' => $sitem['batch'],
                'ces' => $sitem['ces'],
				'item_rate'=>$sitem['item_rate'],
                'size_id' => $sitem['size_id'],
                'item_margin' => $sitem['item_margin'],
                'item_discription' => $sitem['item_discription'],
                'is_taxincluded' => $sitem['is_taxincluded'],
				'sales_ref_type'=>$sitem['sales_ref_type'],
				'sales_ref_id'=>$sitem['sales_ref_id'],
                'godown' => $sitem['godown'],
                'unit_id' =>$sitem['unit_id'],
                'base_unit_id' => $sitem['base_unit_id'],
                'quantity' => $sitem['quantity'],
                'rate' =>$sitem['rate'],
                'mrp' => $sitem['mrp'],
				'unit_qty'=>$sitem['unit_qty'],
                'tax_id' => $sitem['tax_id'],
                'tax' => $sitem['tax'],
                'dis_amt' => $sitem['dis_amt'],
                'discount' => 0,
                'total' => $sitem['total'],
                'unit_qty' => $sitem['unit_qty'],
                'published' => 'yes',
                'sales_ref_type'=>'estimate',
                'sales_ref_id'=>$sales_id,
                'free_quantity'=>$sitem['free_quantity'],
                'itm_fre_qty'=>$sitem['itm_fre_qty'],
                'itm_fre_qty_for'=>$sitem['itm_fre_qty_for'],
                'analytics'=>$sitem['analytics'],
            );
            $qry = "SELECT dis_amt as dis_amtx,IFNULL(discount,0) discountx,tax taxx,cess cessx,total as tot,is_taxincluded,CASE WHEN is_taxincluded ='0' then totalc + cess + tax else totalc end as totalx from (select * from (SELECT a.mrp*quantity*IFNULL(itg.discount,0)/100 as dis_amt,itg.discount,a.is_taxincluded,total, CASE WHEN is_taxincluded = '0' then (a.mrp*quantity -( a.mrp*quantity*IFNULL(itg.discount,0)/100 ) ) else (a.mrp*quantity -( a.mrp*quantity*IFNULL(itg.discount,0)/100 )) end totalc, CASE WHEN is_taxincluded = '0' then (a.mrp*quantity -( a.mrp*quantity*IFNULL(itg.discount,0)/100 )) * b.GST/100 else (((a.mrp*quantity- (   a.mrp*quantity*IFNULL(itg.discount,0)/100  ) )*100) / (100+b.gst+ifnull(itm_ces_per,0))) *b.GST/100 end as tax,CASE WHEN is_taxincluded = '0' then (a.mrp*quantity - ( a.mrp*quantity*IFNULL(itg.discount,0)/100 )) * ifnull(itm_ces_per,0)/100 else (((a.mrp*quantity-( a.mrp*quantity*IFNULL(itg.discount,0)/100 ))*100) / (100+b.gst+ifnull(itm_ces_per,0))) *ifnull(itm_ces_per,0)/100 end as cess FROM `sales_items` as a inner join item as i on i.id = a.item_id  left join item_group as itg on itg.id = i.item_group_id  JOIN taxgst as b on b.gstid = a.tax_id LEFT JOIN taxgst as t on t.gstid = a.itm_ces_per WHERE sal_itms_id  = ".$sitem['sal_itms_id']." and a.published = 'yes' ORDER BY `sal_itms_id` DESC) as a) as x";
            if((int)  $onsync_discount  > 0  ){
                //$change_data = $this->db->query($qry)->row_array();
               // $data['tax'] = $change_data['taxx'];
                //$data['total'] = $change_data['totalx'];
               // $data['rate'] = $change_data['discountx'];
                //$data['dis_amt'] = $change_data['dis_amtx'];
                //$data['itm_raw_ces'] = $change_data['cessx'];
            }
            $this->InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $data_sales['invoice'],$saletype,$data_sales['cess']);

            $qry = "update sales_items set estimate_quantity=estimate_quantity+" . $sitem['quantity'] . " where published ='yes' and sales_id= " . $data['sales_ref_id'] . " and item_id=" . $sitem['sal_itms_id'];
			$this->db->query($qry);
            $subtot  = (float) $subtot  + (float) $sitem['total'];
        }
        $qry ="select sum(tax) as tax ,round(sum(total) ,0) as total ,round(sum(total) ,0) - sum(total) as roundoff,sum(itm_raw_ces) as cess from sales_items where sales_id = ".$insert_id;
        $sdata = $this->db->query($qry)->row_array();
        $saledata = array(
            'tax'=>$sdata['tax'],
            'total'=>$sdata['total'],
            'additional_cess'=>$sdata['cess'],
            'roundoff'=>$sdata['roundoff'],
        );
        $this->db->where('sales_id',$insert_id);
        $this->db->update('sales',$saledata);
        $qry = "update sales set status = 'completed' where sales_id =  ".$sales_id;
        $this->db->query($qry);
       
        if ($or_type != 'estimate' && $or_type !='delivery_note') {
            
            $this->savesubs($data_sales, $or_type, $insert_id, $subtot, $sales_data['cusname'], $rount, $id, $is_mul_led, $branch,$receipt_amount);
        }
        return $insert_id;





    }

    function generateDirectEway($id){
        $qry = "SELECT a.total as tot,ims_area.area as areaname,distance,a.invoice,DATE_FORMAT(invoice_date,'%d/%m/%Y') as date,b.* from sales as a INNER JOIN suppliers as b on a.customer_id = b.id left join ims_area on ims_area.id = b.area   where sales_id = ".$id;
        $sale_data = $this->db->query($qry)->row_array();
        $settings = $this->getCompanySettings();
        $qry_com ="select * from company order by id asc limit 0,1";
        $com_data = $this->db->query($qry)->row_array();
        $invoice_date = $sale_data['date'];
        //$qry = "select * from e_invoice where sales_id = ".$id." and status > 0 ";
       // $e_invoice_data = $this->db->query($qry);
        //if( $e_invoice_data->num_rows() > 0 ){
            // $e_invoice_data = $e_invoice_data->row_array();
            // $Irn = $e_invoice_data['Irn'];
            // $EwbDtls['Irn'] =  $Irn;
            // $EwbDtls['TransId'] =  $settings[0]['tin'];
        //  $EwbDtls['TransName'] = '';
        // $EwbDtls['TransMode'] = '';
            // if( $sale_data['distance'] ==  '' || $sale_data['distance']  == 'NULL' ){
            //     $sale_data['distance'] = 0 ;
            // }
            // $EwbDtls['Distance'] = $sale_data['distance'];
            // $EwbDtls['TransDocDt'] = $invoice_date;
        //  $EwbDtls['VehNo'] = '';
        //  $EwbDtls['VehType'] = '';
        // $EwbDtls['TransDocNo'] = '';
            // $data['EwayBillDetails'] = $EwbDtls;
            // $data['Irn'] = $Irn;
            // $data['TransId'] = $settings[0]['tin'];
            $data['supplyType'] = 'O';
            $data['subSupplyType'] = 1;
            $data['subSupplyDesc'] = "";
            $data['docType'] = "INV";
            $data['docNo'] = $sale_data['invoice'];
            $data['docDate'] = $invoice_date;
            $data['fromStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['actFromStateCode'] = substr($settings[0]['tin'], 0, 2);
            $data['fromGstin'] = $settings[0]['tin'];
            $data['fromAddr1'] = $settings[0]['address'];
            $data['fromAddr2'] = $settings[0]['address'];
            // $data['fromPlace'] = $settings['location'];
            $data['fromPlace'] = 'aluva';

            $data['fromPincode'] = $com_data['pincode'];
            //$data['fromPincode'] = '686665';

            $data['toGstin'] = 'URP';
            $data['toTrdName'] = $sale_data['name'];
            $data['toAddr1'] = $sale_data['address_line1'];
            $data['toAddr2'] = $sale_data['address_line2'];

            $data['toPlace'] = $sale_data['areaname'];
            $data['toPincode'] = $sale_data['pincode'];
            $data['actToStateCode'] = substr($sale_data['tin'], 0, 2);
            $data['toStateCode'] = substr($sale_data['tin'], 0, 2);
            $data['transactionType'] = 1;
            $data['otherValue'] = 0;

            $qry = "SELECT b.name,itm_raw_ces,itm_ces_per,b.name,quantity,(total-tax-itm_raw_ces)/quantity as rate, total-tax-itm_raw_ces as bef,tax,total,c.GST,u.code,IFNULL(h.hsncode,'9405') as hsncode from sales_items as a INNER JOIN item as b on a.item_id = b.id and a.published = 'yes' INNER JOIN taxgst as c on c.gstid = a.tax_id INNER JOIN units as u on u.id = b.unit_id LEFt JOIN hsncode as h on h.hsnid = b.hsncode where a.published ='yes' and a.sales_id= ".$id;
            $data_itwm = $this->db->query($qry)->result_array();
              $length = sizeof($data_itwm );
              $AssVal = 0;
              $TotInvVal = 0;
              $CgstVal = 0;
              $SgstVal = 0;
              $CesAmt = 0 ;
              $IgstVal =0;
              for($i = 0;$i<$length;$i++){
                  $ItemList[$i]['name']= $data_itwm[$i]['name'];
                  $ItemList[$i]['productDesc']= $data_itwm[$i]['name'];
                  $ItemList[$i]['hsnCode']= $data_itwm[$i]['hsncode'];
                  $ItemList[$i]['quantity']= $data_itwm[$i]['quantity'];
                  $ItemList[$i]['qtyUnit']= $data_itwm[$i]['code'];
                  $ItemList[$i]['taxableAmount']= $data_itwm[$i]['bef'];
                  $ItemList[$i]['cessRate']= $data_itwm[$i]['itm_ces_per'];

                  $CesAmt = (float)$CesAmt + (float)  $data_itwm[$i]['itm_raw_ces'];
                  $AssVal = (float) $AssVal + $data_itwm[$i]['bef'];
                  $TotInvVal = (float) $TotInvVal + (float) $data_itwm[$i]['total'];


                  if(substr($settings[0]['tin'], 0, 2) == substr($sale_data['tin'], 0, 2)){
                      if($data_itwm[$i]['tax'] > 0 ){
                          $ItemList[$i]['cgstRate']= round($data_itwm[$i]['GST']/2,2);
                          $ItemList[$i]['GST']= round($data_itwm[$i]['GST']/2,2);
                          $CgstVal = (float)  $CgstVal + (float) $data_itwm[$i]['tax']/2;
                          $SgstVal = (float)  $SgstVal + (float) $data_itwm[$i]['tax']/2;
                      }else{
                          $ItemList[$i]['TotItemVal']= $data_itwm[$i]['total'];
                      }
                      $ItemList[$i]['igstRate']= 0;
                  }else{
                         $ItemList[$i]['cgstRate']= round($data_itwm[$i]['GST']/2,2);
                            $ItemList[$i]['GST']= round($data_itwm[$i]['GST']/2,2);
                          $IgstVal = (float) $IgstVal + (float)$data_itwm[$i]['tax'];
                          $ItemList[$i]['igstRate']= round($data_itwm[$i]['GST'],2);
                  }
                  
                  
              }
              //  print_r( $ItemList);
              $data['ItemList'] = $ItemList;
              $data['totalValue'] = $TotInvVal;
              $data['cgstValue'] = $CgstVal;
              $data['sgstValue'] = $CgstVal;
              $data['igstValue'] = $IgstVal;
              $data['cessValue'] = $CesAmt;
              $data['cessNonAdvolValue'] = $CesAmt;
              $data['totInvValue'] =$sale_data['tot'];


              $data['transporterId'] = "";
              $data['transporterId'] = "";
              $data['transDocNo'] = "";
              $data['transMode'] =1;
              $data['transDistance'] =$sale_data['distance'];
              $data['transDocDate'] = $invoice_date;
              $data['vehicleNo'] ="PVC1234";
              $data['vehicleType'] = "R";
              
            $ch = curl_init();  
            $headers  = [
				'Content-Type: application/json',
				'Accept: application/json',
                'GSTIN:'.$settings[0]['tin'],
                'CustomerId:ASP10515',
                'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
                'APISecret:F6MemwSp9TaygzOT',
                'Source:API',
                'Environment-type:production',
                'Username:'.$settings[0]['apiusername'],
                'Password:'.$settings[0]['apipassword']

			];
            // $headers  = [
			// 	'Content-Type: application/json',
			// 	'Accept: application/json',
            //     'GSTIN:32AAFCP0535R015',
            //     'CustomerId:ASP10515',
            //     'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
            //     'APISecret:F6MemwSp9TaygzOT',
            //     'Source:API',
            //     'Environment-type:Sandbox',
            //     'Username:speaktosatishkr',
            //     'Password:India@123'

			// ];
            $postData = json_encode($data);
            curl_setopt($ch, CURLOPT_URL,"https://ewayapi.mygstcafe.com/managed/v1.03/GenerateEwayBill");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );           
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result     = curl_exec ($ch);
            // print_r($postData);
            // print_r('/n');
            // print_r($result);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $status  = 0 ;
            $error = 'Api Error';
            $return = '';
            $EwbNo = '';
            $EwbDt = '';
            $EwbValidTill = '';
            if($statusCode ==200 ){
                $result_php = json_decode($result);
                print_r($result_php );
                if($result_php->status > 0 ){
                    $status  = 1 ;
                    $error = '';
                    $res = $result_php->data;
                    $return = 'e-way generated Successfully';

                    $EwbNo = $res->ewayBillNo;
                    $EwbDt = $res->ewayBillDate;
                    $EwbValidTill = $res->validUpto;
                    $qry = 'UPDATE sales SET e_way_status=1  WHERE  sales_id='.$id ;
                    $this->db->query($qry);

                }else{
                    $error = 'Information  Error';
                    $res = $result_php->Error;
                    print_r($result_php);
                    if(isset($res[0])){
                        if(isset($res[0]->ErrorMessage)){
                            $return = $res[0]->ErrorMessage;
                        }
                    }
                    
                }
            }

            $e_way_data = array(
                'result'=>$result,
                'sales_id'=>$id,
                'status'=>$status,
                'error'=>$error,
                'EwbNo'=>$EwbNo,
                'EwbDt'=>$EwbDt,
                'EwbValidTill'=>$EwbValidTill,
            );
            $this->db->insert('e_way',$e_way_data);
       // }else{
            
        //}
        return  $return;
    }


    function generateEway($id){
        $qry = "SELECT distance,a.invoice,DATE_FORMAT(invoice_date,'%d/%m/%Y') as date,b.* from sales as a INNER JOIN suppliers as b on a.customer_id = b.id    where sales_id = ".$id;
        $sale_data = $this->db->query($qry)->row_array();
        $settings = $this->getCompanySettings();
        $invoice_date = $sale_data['date'];
        $qry = "select * from e_invoice where sales_id = ".$id." and status > 0 ";
        $e_invoice_data = $this->db->query($qry);
        if( $e_invoice_data->num_rows() > 0 ){
            $e_invoice_data = $e_invoice_data->row_array();
            $Irn = $e_invoice_data['Irn'];
            $EwbDtls['Irn'] =  $Irn;
            $EwbDtls['TransId'] =  $settings[0]['tin'];
        //  $EwbDtls['TransName'] = '';
        // $EwbDtls['TransMode'] = '';
            if( $sale_data['distance'] ==  '' || $sale_data['distance']  == 'NULL' ){
                $sale_data['distance'] = 0 ;
            }
            $EwbDtls['Distance'] = $sale_data['distance'];
            $EwbDtls['TransDocDt'] = $invoice_date;
        //  $EwbDtls['VehNo'] = '';
        //  $EwbDtls['VehType'] = '';
        // $EwbDtls['TransDocNo'] = '';
            $data['EwayBillDetails'] = $EwbDtls;
            $data['Irn'] = $Irn;
            $data['TransId'] = $settings[0]['tin'];
            $data['distance'] = $sale_data['distance'];
            $ch = curl_init();
            $headers  = [
				'Content-Type: application/json',
				'Accept: application/json',
                'GSTIN:'.$settings[0]['tin'],
                'CustomerId:ASP10515',
                'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
                'APISecret:F6MemwSp9TaygzOT',
                'Source:API',
                'Username:'.$settings[0]['apiusername'],
                'Password:'.$settings[0]['apipassword']

			];
            // $headers  = [
            //     'Content-Type: application/json',
            //     'Accept: application/json',
            //     'GSTIN:27AAFCP0535R012',
            //     'CustomerId:C30026',
            //     'APIId:f7KWT4e0-iQUb-bpf2-G1lY-uUGDebdP',
            //     'APISecret:f7KWT4e0iQUbbpf2',
            //     'Source:API',
            //     'Username:speaktosatishmh',
            //     'Password:Satish@9044'

            // ];
            $postData = json_encode($data);
            curl_setopt($ch, CURLOPT_URL,"https://api.mygstcafe.com/eicore/v1.03/einvewb/ewaybill");
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );           
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $result     = curl_exec ($ch);
            // print_r($postData);
            // print_r('/n');
            // print_r($result);
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $status  = 0 ;
            $error = 'Api Error';
            $return = '';
            $EwbNo = '';
            $EwbDt = '';
            $EwbValidTill = '';
            if($statusCode ==200 ){
                $result_php = json_decode($result);
                if($result_php->status_cd > 0 ){
                    $status  = 1 ;
                    $error = '';
                    $res = $result_php->response_data;
                    $return = 'e-way generated Successfully';

                    $EwbNo = $res->EwbNo;
                    $EwbDt = $res->EwbDt;
                    $EwbValidTill = $res->EwbValidTill;
                    $qry = 'UPDATE sales SET e_way_status=1  WHERE  sales_id='.$id ;
                    $this->db->query($qry);

                }else{
                    $error = 'Information  Error';
                    $res = $result_php->Error;
                    print_r($result_php);
                    if(isset($res[0])){
                        if(isset($res[0]->ErrorMessage)){
                            $return = $res[0]->ErrorMessage;
                        }
                    }
                    
                }
            }

            $e_way_data = array(
                'result'=>$result,
                'sales_id'=>$id,
                'status'=>$status,
                'error'=>$error,
                'EwbNo'=>$EwbNo,
                'EwbDt'=>$EwbDt,
                'EwbValidTill'=>$EwbValidTill,
            );
            $this->db->insert('e_way',$e_way_data);
        }else{
            
        }
        return  $return;
    }
    
    function generate_EInvoice($id){
        $qry = "SELECT ims_area.area as areaname,distance,a.invoice,DATE_FORMAT(invoice_date,'%d/%m/%Y') as date,b.* from sales as a INNER JOIN suppliers as b on a.customer_id = b.id left join ims_area on ims_area.id = b.area   where sales_id = ".$id;
        $sale_data = $this->db->query($qry)->row_array();
        $settings = $this->getCompanySettings();

        $data["Version"] = "1.1";
        $invoice = $sale_data['invoice'];
        $invoice_date = $sale_data['date'];
        $TranDtls['TaxSch'] = "GST";
        $TranDtls['SupTyp'] = "B2B";
        $TranDtls['RegRev'] = "N";
      //  $TranDtls['EcmGstin'] = "27AAFCP0535R012";
        
        $TranDtls['IgstOnIntra'] = "N";

        $data['TranDtls'] = $TranDtls;

        $DocDtls['Typ'] = "INV";
        if($sale_data['type'] == 'sales_return' ){
            $DocDtls['Typ'] = "CRN";
        }
        $DocDtls['No'] = $invoice;
        $DocDtls['Dt'] = $invoice_date;

        $data['DocDtls'] = $DocDtls;
       
        //print_r($sale_data);
       // print_r($settings);
        $Gstin = $sale_data['tin'];
        $LglNm = $sale_data['name'];
        $TrdNm = $sale_data['name'];
        $Pos = substr($sale_data['tin'], 0, 2);
        $Addr1 = $sale_data['address_line1'];
        $Addr2 = $sale_data['address_line2'];
        // $Loc = 'AluvaS';
        // $Pin = '670103';
        $Loc = $sale_data['areaname'];
        $Pin =  $sale_data['pincode'];
        $Stcd  =substr($sale_data['tin'], 0, 2);
        $Ph = $sale_data['phone'];
        $Em = $sale_data['email'];
        $BuyerDtls['Gstin'] = $Gstin;
        $BuyerDtls['LglNm'] = $LglNm;
        $BuyerDtls['TrdNm'] = $TrdNm;
        $BuyerDtls['Pos'] = $Pos;
        $BuyerDtls['Addr1'] = $Addr1;
        $BuyerDtls['Addr2'] = $Addr2;
        $BuyerDtls['Loc'] = $Loc;
        $BuyerDtls['Pin'] = $Pin;
        $BuyerDtls['Stcd'] = $Stcd;
       // $BuyerDtls['Ph'] = $Ph;
        //$BuyerDtls['Em'] = $Em;

        $data['BuyerDtls'] = $BuyerDtls;
        $Gstin = $settings[0]['tin'];
        $LglNm = $settings[0]['name'];
        $TrdNm = $settings[0]['name'];
        $Addr1 = $settings[0]['address'];
        $Addr2 = $settings[0]['address'];
        // $Loc = 'Aluva';
        // $Pin = '431701';
        $Loc = $settings[0]['location'];
        $Pin = $settings[0]['pincode'];
        $Stcd  =substr($settings[0]['tin'], 0, 2);
        $Ph = $settings[0]['phone'];
        $Em = $settings[0]['email'];
        $SellerDtls['Gstin'] = $Gstin;
        $SellerDtls['LglNm'] = $LglNm;
        $SellerDtls['TrdNm'] = $TrdNm;
        $SellerDtls['Addr1'] = $Addr1;
        $SellerDtls['Addr2'] = $Addr2;
        $SellerDtls['Loc'] = $Loc;
        $SellerDtls['Pin'] = $Pin;
        $SellerDtls['Stcd'] = $Stcd;
        $SellerDtls['Ph'] = $Ph;
        $SellerDtls['Em'] = $Em;

        $data['SellerDtls'] = $SellerDtls;
        

        $Nm = $sale_data['name'];
        $Addr1 = $settings[0]['address'];
        $Addr2 = $settings[0]['address'];
        $Loc = $sale_data['areaname'];
        $Pin =  $sale_data['pincode'];
        $Stcd = substr($settings[0]['tin'], 0, 2);
        $DispDtls['Nm'] = $Nm;
        $DispDtls['Addr1'] = $Addr1;
        $DispDtls['Addr2'] = $Addr2;
        $DispDtls['Loc'] = $Loc;
        $DispDtls['Pin'] = $Pin;
        $DispDtls['Stcd'] = $Stcd;
        $data['DispDtls'] = $DispDtls;


        


        $Gstin = $sale_data['tin'];
        $LglNm = $sale_data['name'];
        $TrdNm = $sale_data['name'];
        $Stcd  =substr($sale_data['tin'], 0, 2);
        $Addr1 = $sale_data['address_line1'];
        $Addr2 = $sale_data['address_line2'];
        $Loc = $sale_data['areaname'];
        $Pin =  $sale_data['pincode'];
        
       
        $ShipDtls['Gstin'] = $Gstin;
        $ShipDtls['LglNm'] = $LglNm;
        $ShipDtls['TrdNm'] = $TrdNm;
        $ShipDtls['Addr1'] = $Addr1;
        $ShipDtls['Addr2'] = $Addr2;
        $ShipDtls['Loc'] = $Loc;
        $ShipDtls['Pin'] = $Pin;
        $ShipDtls['Stcd'] = $Stcd;

        $data['ShipDtls'] = $ShipDtls;

      //  $EwbDtls['TransId'] = '12AWGPV7107B1Z1';
       // $EwbDtls['TransName'] = 'XYZ EXPORTS';
        //$EwbDtls['TransMode'] = '1';
        $EwbDtls['Distance'] = $sale_data['distance'];
        $EwbDtls['TransDocDt'] = $invoice_date;
       // $EwbDtls['VehNo'] = 'ka123456';
       // $EwbDtls['VehType'] = 'R';
       // $EwbDtls['TransDocNo'] = 'DOC01';
       // $data['EwbDtls'] = $EwbDtls;


        $ExpDtls['ShipBNo'] = $sale_data['invoice'];
        $ExpDtls['ShipBDt'] = $invoice_date;
        $ExpDtls['CntCode'] = 'IN';
        $ExpDtls['ForCur'] = 'INR';
        // $ExpDtls['Port'] = '';
        $ExpDtls['RefClm'] = 'N';
        $ExpDtls['ExpDuty'] = 0;
        $data['ExpDtls'] = $ExpDtls;
      //  $qry = "SELECT b.name,quantity,total-tax/quantity as rate, total-tax as bef,tax,total,c.GST,u.code,IFNULL(h.hsncode,'9405') as hsncode from sales_items as a INNER JOIN item as b on a.item_id = b.id and a.published = 'yes' INNER JOIN taxgst as c on c.gstid = a.tax_id INNER JOIN units as u on u.id = b.unit_id LEFt JOIN hsncode as h on h.hsncode = b.hsncode where a.published ='yes' and a.sales_id= ".$id;
        $qry = "SELECT itm_raw_ces,itm_ces_per,b.name,quantity,(total-tax-itm_raw_ces)/quantity as rate, total-tax-itm_raw_ces as bef,tax,total,c.GST,u.code,IFNULL(h.hsncode,'9405') as hsncode from sales_items as a INNER JOIN item as b on a.item_id = b.id and a.published = 'yes' INNER JOIN taxgst as c on c.gstid = a.tax_id INNER JOIN units as u on u.id = b.unit_id LEFt JOIN hsncode as h on h.hsnid = b.hsncode where a.published ='yes' and a.sales_id= ".$id;
      $data_itwm = $this->db->query($qry)->result_array();
        $length = sizeof($data_itwm );
        $AssVal = 0;
        $TotInvVal = 0;
        $CgstVal = 0;
        $SgstVal = 0;
        $CesAmt = 0 ;
        $IgstVal =0;
        for($i = 0;$i<$length;$i++){
            $AttribDtls['Nm'] = $data_itwm[$i]['name'];
            $AttribDtls['Val'] = '';
            $ItemList[$i]['AttribDtls']= $AttribDtls;
            $ItemList[$i]['SlNo']= $i;
            $ItemList[$i]['Unit']= $data_itwm[$i]['code'];
            $ItemList[$i]['Qty']= $data_itwm[$i]['quantity'];
            $ItemList[$i]['IsServc']= 'N';
            $ItemList[$i]['HsnCd']= $data_itwm[$i]['hsncode'];
        
            $BchDtls['Nm'] = '123456';
            $ItemList[$i]['BchDtls']= $BchDtls;

            $ItemList[$i]['UnitPrice']= round($data_itwm[$i]['rate'],3);
            $ItemList[$i]['TotAmt']= $data_itwm[$i]['bef'];

            $ItemList[$i]['AssAmt']= $data_itwm[$i]['bef'];
            $ItemList[$i]['GstRt']= $data_itwm[$i]['GST'];
           
            $ItemList[$i]['CesAmt']= $data_itwm[$i]['itm_raw_ces'];
            $ItemList[$i]['CesRt']= $data_itwm[$i]['itm_ces_per'];
            $ItemList[$i]['AssAmt']= $data_itwm[$i]['bef'];
            $CesAmt = (float)$CesAmt + (float)  $data_itwm[$i]['itm_raw_ces'];
            $AssVal = (float) $AssVal + $data_itwm[$i]['bef'];
            $TotInvVal = (float) $TotInvVal + (float) $data_itwm[$i]['total'];
            if(substr($settings[0]['tin'], 0, 2) == substr($sale_data['tin'], 0, 2)){
                if($data_itwm[$i]['tax'] > 0 ){
                    $ItemList[$i]['SgstAmt']= round($data_itwm[$i]['tax']/2,2);
                    $ItemList[$i]['CgstAmt']= round($data_itwm[$i]['tax']/2,2);
                    $ItemList[$i]['TotItemVal']= $data_itwm[$i]['total'];
                    $CgstVal = (float)  $CgstVal + (float) $data_itwm[$i]['tax']/2;
                    $SgstVal = (float)  $SgstVal + (float) $data_itwm[$i]['tax']/2;
                }else{
                    $ItemList[$i]['SgstAmt']=0;
                    $ItemList[$i]['CgstAmt']= 0;
                    $ItemList[$i]['TotItemVal']= $data_itwm[$i]['total'];
                }
                $ItemList[$i]['IgstAmt']= 0;
            }else{
                     $ItemList[$i]['SgstAmt']=0;
                    $ItemList[$i]['CgstAmt']= 0;
                    $ItemList[$i]['IgstAmt']= $data_itwm[$i]['tax'];
                    $IgstVal = (float) $IgstVal + (float)$data_itwm[$i]['tax'];
                    $ItemList[$i]['TotItemVal']= $data_itwm[$i]['total'];
            }
            
            
        }
        //  print_r( $ItemList);
        $data['ItemList'] = $ItemList;
        $ValDtls["AssVal"] = round($AssVal,2);
        $ValDtls["TotInvVal"] =round($TotInvVal,2);
        $ValDtls["CesVal"] = $CesAmt;
        $ValDtls["CgstVal"] = round($CgstVal,2);
        $ValDtls["SgstVal"] = round($SgstVal,2);
        $ValDtls["IgstVal"] = round($IgstVal,2);
        $data['ValDtls'] = $ValDtls;

        $RefDtls['InvStDt'] = $invoice_date;
        $RefDtls['InvEndDt'] = $invoice_date;
        $RefDtls['PrecDocDtls']['InvNo'] = 'MS1';
        $RefDtls['PrecDocDtls']['InvDt'] = $invoice_date;
        $data['RefDtls'] = $RefDtls;

        $EwbDtls['Distance'] = 3333;
        $data['EwbDtls'] = $EwbDtls;

        $ch = curl_init();
            $headers  = [
                'Content-Type: application/json',
                'Accept: application/json',
                'GSTIN:'.$settings[0]['tin'],
                'CustomerId:ASP10515',
                'APIId:F6MemwSp-9Tay-gzOT-iQ6Q-qk0uLWqB',
                'APISecret:F6MemwSp9TaygzOT',
                'Source:API',
                'Username:'.$settings[0]['apiusername'],
                'Password:'.$settings[0]['apipassword']

            ];
			$postData = json_encode($data);
			curl_setopt($ch, CURLOPT_URL,"https://api.mygstcafe.com/eicore/v1.03/Invoice");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS,$postData );           
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			$result     = curl_exec ($ch);
			//print_r($postData);
			//print_r('/n');
            $return = '';
            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $status  = 0 ;
            $error = 'Api Error';
            $Irn = '';
            $SignedInvoice = '';
            $AckNo = '';
            $SignedQrCode = '';
            if($statusCode ==200 ){
                $result_php = json_decode($result);
                if($result_php->status_cd > 0 ){
                    $res = $result_php->response_data;
                    $Irn = $res->Irn;
                    $SignedInvoice = $res->SignedInvoice;
                    $AckNo = $res->AckNo;
                    $SignedQrCode = $res->SignedQrCode;
                    $status  = 1 ;
					$error = '';
                    $qry = 'UPDATE sales SET e_invoice_status=1  WHERE  sales_id='.$id ;
                    $this->db->query($qry);
                    $return = 'e-invoice generated Successfully';
                }else{
                    $error = 'Information  Error';
                    $res = $result_php->Error;
                    $return = $res[0]->ErrorMessage;
                }
            }

            $e_invoice_data = array(
                'e_invoice_data'=>$result,
                'sales_id'=>$id,
                'status'=>$status,
                'error'=>$error,
                'Irn'=>$Irn,
                'SignedInvoice'=>$SignedInvoice,
                'AckNo'=>$AckNo,
                'SignedQrCode'=>$SignedQrCode,
            );
            $this->db->insert('e_invoice',$e_invoice_data);
            return  $return;
    }

    function savesubs($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id, $is_mul_led, $branch,$receipt_amount=0,$old_date ='') {

       
        $toid = 0;
        if (strtolower($data['cash_type']) == 'credit'){
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            if($or_type != 'sales_return' ) {
                $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total']- $receipt_amount, 0, 0, 0,$old_date);
            }
        }
        if (strtolower($data['cash_type']) == 'cash' ||  strtolower($data['cash_type']) == 'bank' ){
            $toid = $this->paytype;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->paytype, $data['invoice_date'], '0.00', $data['total'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
           
        }
        
        if (is_numeric($data['discount']) == true && $data['discount'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['discount'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['redeemed_amount']) == true && $data['redeemed_amount'] != 0) {
			$qry = 'update suppliers set redeemed_points = redeemed_points + '.$data['redeemed_points'].' where id =  "'.$data['customer_id'].'" ';
			$this->db->query($qry);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['redeemed_amount'], $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
        if (is_numeric($data['freight']) == true && $data['freight'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesFr, $data['invoice_date'], $data['freight'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
		if (is_numeric($data['other']) == true && $data['other'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesCoolie, $data['invoice_date'], $data['freight'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }

        // if(isset($data['bata']) ){
        //     if (is_numeric($data['bata']) == true && $data['bata'] != 0) {
        //         $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, 5, $data['invoice_date'], $data['bata'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        //     }
        // }

        // if(isset($data['transit_fee']) ){
        //     if (is_numeric($data['transit_fee']) == true && $data['transit_fee'] != 0) {
        //         $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, 6, $data['invoice_date'], $data['transit_fee'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        //     }
        // }
        
        

        $salesamount = $subtot;
        if ($is_mul_led == 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $salesamount, '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        } else {
            $this->tax_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'].';;'.$data['ref_no'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);
        }
        if ($rount > 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], $rount, '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], '0.00', $rount, $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
        }

        if ($data['cess'] > 0 && $data['saletype'] == "b2c") {
            $qry = 'select * from acc_ledgers where name like"%cess%"';
            $query = $this->db->query($qry);
            if ($query->num_rows() > 0) {
                $query = $query->row_array();
                $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $query['id'], $data['invoice_date'], $data['cess'], '0.00', $data['narration'].';;'.$data['ref_no'], 1, $data['cost_center'], $branch);
            }
        }
        $this->ces_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'].';;'.$data['ref_no'], 'sale', $data['cost_center'], $is_mul_led, $branch, $data['discount']);

		
    }

    public function save($or_type) {
//  $cons = new Common_db(); 
        $id = $this->input->post('id');
            if($id  == 0 ){

            }else{
            // if($this->session->userdata('login_base_comid') == 'raj'){
                    $this->checkvoucherAudit($id,'Sales');
            //  }
            }
		$item_damage = $this->input->post('item_damage');
        $Is_SQFT = $this->input->post('Is_SQFT');
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
        $distance = $this->input->post('distance');
        $invoicedate = $this->getDate($invoicedate);
        $commi_amt_hi = $this->input->post('commi_amt_hi');
        if ($commi_amt_hi == "NaN") {
            $commi_amt_hi = 0;
        }
		$packing_details = $this->input->post('packing_details');
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
		$paper_size = 'full';
		if($this->input->post('paper_size')){
			$paper_size = $this->input->post('paper_size');
		}
		$con_state = 0;
		if ($this->input->post('con_state')) {
            $con_state = $this->input->post('con_state');
        }
		$bank_pay_method = $this->input->post('bank_pay_method');
		$gpay_no = $this->input->post('gpay_number');
        if((int) $customer_id > 0 ){
            $qry ='SELECT IFNULL(tin,"") as tin FROM suppliers where id = '.$customer_id;
            $su = $this->db->query($qry)->row_array();
            if($su['tin'] != ''){
                $saletype = 'b2b';
            }else{
                $saletype = 'b2c';
            }
        }else{
            $saletype = 'b2c';   
        }
        $data_sales = array(
			'ref_no'=>$ref_no,
			'gpay_no'=>$gpay_no,
			'bank_pay_method'=>$bank_pay_method,
			'place'=>$place,
            'distance'=>$distance,
			'con_state'=>$con_state,
			'vehicle_no'=>$vehicle_no,
            'published'=>'yes',
			'transport_mode'=>$transport_mode,
			'paper_size'=>$paper_size,
			'estimate_id'=>$txtEstimate_id,
			'additional_cess'=>$itm_net_ces,
            'invoice_date' => $invoicedate,
            'bill_margin' => $bill_margin,
            'cess' => $tot_cess,
			'packing_details'=>$packing_details,
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
           // 'created_date' => date('Y-m-d H:i:s', time()),
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

        if($this->input->post('scheme_desc')){
            $scheme_desc = $this->input->post('scheme_desc');
            $data_sales['scheme_desc'] =  $scheme_desc;
        }

        if($this->input->post('scheme_from')){
            $scheme_from = $this->getDate($this->input->post('scheme_from'));
            $data_sales['scheme_from'] =  $scheme_from;
        }

        if($this->input->post('scheme_till')){
            $scheme_till = $this->getDate($this->input->post('scheme_till'));
            $data_sales['scheme_till'] =  $scheme_till;
        }


        if($this->input->post('driver')){
            $driver = $this->input->post('driver');
            $data_sales['driver'] =  $driver;
        }
        $bata = 0 ;
        if($this->input->post('bata')){
            $bata = $this->input->post('bata');
            $data_sales['bata'] = (float) $bata;
            if($bata == ''){
                $bata = 0;
            }
        }
        $transit_fee = 0;
        if($this->input->post('transit_fee')){
            $transit_fee = $this->input->post('transit_fee');
            $data_sales['transit_fee'] = (float) $transit_fee;
            if($transit_fee == ''){
                $transit_fee = 0;
            }
        }

		if($this->input->post('remarks')){
			$remarks = $this->input->post('remarks');
			$data_sales['remarks'] = $remarks;
		
		}
		
		if($this->input->post('due_date') ){
				$data_sales['due_date'] = $this->getDate($this->input->post('due_date'));
		}
			
			
		
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
		$old_date = '';
		$receipt_amount = 0;
		if($this->input->post('receipt_amount')){
			$receipt_amount =  $this->input->post('receipt_amount');
		}
        if ($id == 0) {
            $data_sales['printtype'] =  $printtype;
            $data_sales['invoice'] = $invoice;
            $data_sales['status'] = 'pending';
            $insert_id = $this->InsertSales($data_sales);
            $this->checkvoucherAudit($insert_id,'Sales');
			if((float) $receipt_amount > 0 && $or_type =='sales' && $customer_id !=0 && $customer_id !='0' && $customer_id !="" ){
				$res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
				$supid = $res['id'];
				$this->updatereceipt($id,$insert_id,$receipt_amount,$invoice,$invoicedate,$supid,$costcenter,$created_by,$branch);
			}

                if($transit_fee > 0 ){
                    $this->transitreceipt($id,$insert_id,$transit_fee,$invoice,$invoicedate,0,$costcenter,$created_by,$branch);
                }
                if($bata > 0 ){
                    $this->batapayment($id,$insert_id,$bata,$invoice,$invoicedate,0,$costcenter,$created_by,$branch);
                }
                
            } else {
			$qry = "select * from sales where sales_id = ".$id;
			$s_sata = $this->db->query($qry)->row_array();
            $data_sales['invoice'] = $s_sata['invoice'];
            $data_sales['bill_type'] = $s_sata['bill_type'];
            $data_sales['printtype'] = $s_sata['printtype'];
            if (!$txtEstimate_id == 0) {
                $this->restoreestimate($id, $txtEstimate_id);
            }
            $old_qry = "select * from sales where sales_id = ".$id." ";
			$old_data = $this->db->query($old_qry)->row_array();
			$old_date = $old_data['invoice_date'];
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
        if($transit_fee > 0 ){
            $this->transitreceipt($id,$insert_id,$transit_fee,$invoice,$invoicedate,0,$costcenter,$created_by,$branch);
        }else{
            $qry = "select * from voucher where vourcher_type = 'receipt' and  sales_ref_id=".$insert_id;
            $query = $this->db->query($qry);
            $cnt = $query->num_rows();
            if((float) $cnt > 0 ){
                $query = $query->row_array();
                $old = $query['id'];
                $old_no = $query['voucher_no']; 
                $qry = 'update voucher set published="no" where id ='.$old;
                $this->db->query($qry);
                // $qry = 'update voucher_trans set published="no" where voucher_id = '.$old;
                // $this->db->query($qry);
                $qry = "update  acc_ledger_trans set published ='no' where trn_tp  != 'Cheque' and  tb_name='voucher' and tb_id =" . $old;
                $this->db->query($qry);

            }
        }


        if($bata > 0 ){
            $this->batapayment($id,$insert_id,$bata,$invoice,$invoicedate,0,$costcenter,$created_by,$branch);
        }else{
            $qry = "select * from voucher where vourcher_type = 'payment' and  sales_ref_id=".$insert_id;
            $query = $this->db->query($qry);
            $cnt = $query->num_rows();
            if((float) $cnt > 0 ){
                $query = $query->row_array();
                $old = $query['id'];
                $old_no = $query['voucher_no']; 
                $qry = 'update voucher set published="no" where id ='.$old;
                $this->db->query($qry);
                // $qry = 'update voucher_trans set published="no" where voucher_id = '.$old;
                // $this->db->query($qry);
                $qry = "update  acc_ledger_trans set  published ='no' where trn_tp  != 'Cheque' and  tb_name='voucher' and tb_id =" . $old;
                $this->db->query($qry);

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

        if($Is_SQFT > 0 ){
            $itemSQFTNO =  $this->input->post('itemSQFTNO', TRUE);
            $itemItemSQFT = $this->input->post('itemItemSQFT', TRUE);
        }
		$item_rate =  $this->input->post('item_rate', TRUE);
        $free_qty = $this->input->post('free_qty', TRUE);
		$mar_pur_rate = $this->input->post('mar_pur_rate', TRUE);
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
		$emei_item = $this->input->post('emei_item', TRUE);
		$emei_item_pur_id = $this->input->post('emei_item_pur_id', TRUE);
        $is_taxincluded = $this->input->post('is_taxincuded', TRUE);
        $rowTotal = $this->input->post('rowTotal', TRUE);
		$add_dis_per = $this->input->post('adddisper', TRUE);
		$add_dis_amt = $this->input->post('adddisamt', TRUE);
		$unit_qty = $this->input->post('unitqty', TRUE);
		$pindex = $this->input->post('pindex', TRUE);
		$purchase_barcode =  $this->input->post('purchase_barcode');
        $item_margin = $this->input->post('margin', TRUE);
        $subtot = $this->input->post('subtot');
        $taxtotal = $this->input->post('taxtotal');
		$item_commission = $this->input->post('item_commission');
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
		$length = 0 ;
		if($this->input->post('mrp_item', TRUE)){
			$length = sizeof($mrp_item);
		}
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
			$item_landing_cost = $this->input->post('landing_cost', TRUE);
            $data = array(
                'analytics' => 0,
                'sales_id' => $insert_id,
				'item_landing_cost'=>$item_landing_cost[$i],
                'item_id' => $item_id[$i],
				'itm_ces_id'=>$itm_ces_id,
				'mar_pur_rate'=>$mar_pur_rate[$i],
				'item_commission'=>$item_commission[$i],
				'itm_ces_name'=>$itm_ces_name,
				'add_dis_per'=>$add_dis_per[$i],
				'add_dis_amt'=>$add_dis_amt[$i],
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
				'unit_qty'=>$unit_qty[$i],
                'tax_id' => $tax_item[$i],
                'tax' => $tax_amount[$i],
                'dis_amt' => $dis_amt[$i],
                'discount' => 0,
                'total' => $rowTotal[$i],
                'published' => 'yes'
            );

            if($Is_SQFT > 0 ){
                $data['SQFTNO'] =  $itemSQFTNO[$i];
                $data['ItemSQFT'] = $itemItemSQFT[$i];
            }

            if((int) $purchase_barcode > 0 ){
                $data['pindex'] = $pindex[$i];
                if($pindex[$i] > 0 ){

                }
                    $data_sub  = array(
                        'sales_id'=>$insert_id,
                        'customer_id'=>$data_sales['customer_id'],
                        'status'=>0
                    );
                    $this->db->where('id',$pindex[$i]);
                    $this->db->update('purchase_items_barcode',$data_sub);
            }
			
			if( $this->input->post('unitqty', TRUE) ){
				if($unit_qty[$i] != '' ){
					$data['unit_qty'] = $unit_qty[$i];
				}
			}
			if( $this->input->post('emei_item', TRUE) ){
				if($emei_item[$i] != ''  ){
					$data['emei'] = $emei_item[$i];
					$data['emei_pur_id'] = $emei_item_pur_id[$i];
					if($data['emei'] != ''){
						$qry = "UPDATE `purchase_items_imei` SET `status` = '0' WHERE imei =  '".$emei_item[$i]."'";
						$this->db->query($qry);
					}
				}
			}
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
            $this->InsertSales_items($data, $or_type, $invoicedate, $is_mul_led, $branch, $data_sales['invoice'],$saletype,$data_sales['cess']);
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
            $this->savesub($data_sales, $or_type, $insert_id, $subtot, $saletaxtot, $rount, $id, $is_mul_led, $branch,$receipt_amount,$old_date);
        }
        return $insert_id;
    }

}
