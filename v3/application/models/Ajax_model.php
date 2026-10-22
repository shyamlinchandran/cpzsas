<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax_model
 *
 * @author u43255
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Ajax_model extends DataTable {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
	
	function division($type){
		$qry = "select a.* from gold_division as a  where  div_type = '".$type."'";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["div_id"] . '">' . $row["div_name"] . '</option>';
        }
        print_r($option);
	}

    function checkCustomerstatus($id){
        $status = 1;
        $warning = 0;
        $ban = 0 ;
        $warning_text = '';
        $ban_text = '';
        $qry = 'select * from suppliers where id = '.$id;
        $sup = $this->db->query($qry)->row_array();

        $inv_cr_days = $sup['inv_cr_days'];
        $inv_cr_days_action = $sup['inv_cr_days_action'];

        if($inv_cr_days != ''){
            if($inv_cr_days > 0 ){
                $qry = "SELECT invoice_date,CURDATE(),DATEDIFF(  CURDATE(),a.invoice_date) AS DateDiff ,b.* from sales as a INNER JOIN acc_ageing as b on a.sales_id = b.tb_id and tb_name = 'sales' and b.debit - b.paid > 0 and a.customer_id =".$id."  and DATEDIFF(  CURDATE(),a.invoice_date) >= ".$inv_cr_days."  ";
                $dat = $this->db->query($qry);
                if($dat->num_rows() > 0 ){
                    $status = 0;
                    if($inv_cr_days_action ==''){
                        $inv_cr_days_action = 0;
                    }

                    if((int)$inv_cr_days_action > 0 ){
                        $ban = 1;
                        $ban_text = 'Customer Banned ! No of Credit days Exceeded Only Cash Bills Applicable for this customer';
                    }else{
                        $warning = 1;
                        $warning_text = 'No of Credit days Exceeded';
                    }
                }

            }
        }


        $credit_bills_count = $sup['credit_bills_count'];
        $credit_bills_count_action = $sup['credit_bills_count_action'];

        if($credit_bills_count != ''){
            if($credit_bills_count > 0 ){
                $qry = "SELECT  b.* from sales as a INNER JOIN acc_ageing as b on a.sales_id = b.tb_id and tb_name = 'sales' and b.debit - b.paid > 0 and a.customer_id = ".$id." ";
                $dat = $this->db->query($qry);
                if($dat->num_rows() >= $credit_bills_count){
                    if((int)$credit_bills_count_action > 0 ){
                        $ban = 1;
                        $ban_text = 'Customer Banned ! No of Credit Bills Exceeded Only Cash Bills Applicable for this customer';
                    }else{
                        $warning = 1;
                        $warning_text = 'No of Credit Bills Exceeded';
                    }
                }

            }
        }
        $qry = 'select * from acc_ledgers where ref_id = '.$id.' and ref_code in("cus","sup") ';
        $led_data = $this->db->query($qry)->row_array();
        $ledid = $led_data['id'];
        $qry = "select b.type as baltype,ia.area as areaname,route_name,b.id as ledid,IFNULL(credit,0) as credit,IFNULL(debit,0) as debit,b.type,b.id,IFNULL(d.bal,0) as tran_amt ,IFNULL(d.bal,0) + case when b.type = 'Dr' then b.openning_bal else b.openning_bal*-1 end  as Closing_balance,a.name,IFNULL(b.openning_bal,0) as openning_bal,phone from suppliers as a left join ims_area as ia on ia.id = a.area left join ims_route as ir on ir.id = a.route inner join acc_ledgers as b on a.id=b.ref_id and b.ref_code in('sup','cus') left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes' and ledger_id = ".$ledid." GROUP by c.ledger_id ) as d on d.ledger_id=b.id where b.id= ".$ledid." ";
        $bal_arr = $this->db->query($qry)->row_array();
        $bal = $bal_arr['Closing_balance'];

        $data['bal'] = $bal;
        $data['credit_amount'] = $sup['credit_amount'];
        
        $data['single_inv_cr_limit'] = $sup['single_inv_cr_limit'];
        $data['single_inv_cr_limit_action'] = $sup['single_inv_cr_limit_action'];
        
        $data['warning'] = $warning;
        $data['ban'] = $ban;
        $data['ban_text'] = $ban_text;
        $data['warning_text'] = $warning_text;
        echo json_encode($data);
    }
	
	function yoga_times(){
		$qry = "select a.* from yoga_times as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["time_id"] . '">' . $row["time"] . '</option>';
        }
        print_r($option);
	}
	
	function acc_main() {
        $qry = "select a.* from acc_main as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }
	
	function customer_type() {
        $qry = "select a.* from customer_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["type"] . '</option>';
        }
        print_r($option);
    }
	
	function district() {
        $qry = "select a.* from district as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["district_id"] . '">' . $row["district_name"] . '</option>';
        }
        print_r($option);
    }
	
	function uqc(){
		$qry = "select a.* from uqc as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["uqc_id"] . '">' . $row["uqc_name"] . '</option>';
        }
        print_r($option);
	}




	function last_purchaserate($id){
		$supid = $this->input->post('supid');
		$txt = '';
		if($this->input->post('supid')){
			if((int) $supid  > 0 ){
				$txt = ' and supplier_id = '.$supid;
			}
		}
		$qry = "SELECT * FROM `purchase` as  a INNER JOIN purchase_items as b on b.published ='yes' and a.id= b.purchase_id and b.item_id =".$id." wHERE 1 ".$txt." order by a.id desc limit 0,5";
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	function get_visible(){
		$hr = $this->input->post('hr');
		$qry = "SELECT * FROM `menus` WHERE Url = '".$hr."'";
		$query = $this->db->query($qry)->row_array();
		echo $query['visibility'];
	}

    function getpurchaseitems($search, $type) {

        $qry = "select CONCAT(a.name,' ',a.barcode) as label,a.id from item as a where name like('%$search%') or barcode like('%$search%') and item_type_id=2 limit 25";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	
	function load_items($search,$type){
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $res = explode(' ', $search);
        $ls = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
        }
        $qry = "select 0 as godown_id,'' as itembatch,CONCAT(a.name,'      ,  Barcode:',barcode) as label,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from  (select * from  item where published = 'yes') as a left join item_group as b on a.item_group_id =b.id where($ls)   or barcode like'%".$search."%' limit  50";
       	if((int) $isbatch  > 0){
			$qry = "select a.name,a.id,batches.godown_id,batches.batch as itembatch,CONCAT(a.name,', EAN:',IFNULL(batches.EAN,''),' , Srate:',IFNULL(item_srate,srate),' Godown: ',IFNULL(godown_name,'')) as label,IFNULL(item_srate,srate) as srate,b.discount as dis, (IFNULL(batches.current_stock,0)+batches.open_stock) as currentstk from (select * from  item where published = 'yes') as a left join item_godown as batches on batches.item_id=a.id left join ims_godown as ims on ims.id=batches.godown_id  left join item_group as b on a.item_group_id =b.id where($ls) or barcode like'%".$search."%' limit  50";
		}
	   $result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	function load_points($customer_id){
		$qry = "SELECT * FROM `suppliers` as a WHERE id=".$customer_id;
		$query = $this->db->query($qry)->row_array();
		$points = $query['total_points'] - $query['redeemed_points'];
		$qry = "SELECT a.*,".$points." as points FROM `point_settings` as a ";
		$result = $this->db->query($qry);
		echo json_encode($result->result_array());
	}
	
	function checkstatus($id) {
        $qry = "select a.credit_period,b.id,a.type  from suppliers as a inner join   acc_ledgers as b on a.id=b.ref_id where ref_id=" . $id . " and ref_code in('cus','sup')";
        $query = $this->db->query($qry)->row_array();
        $ledger = $query['id'];
		$type = $query['type'];
        $credit_period = $query['credit_period'];
        $qry = "SELECT DATEDIFF(CURRENT_DATE(),tb_crdate) as cnt,tb_crdate FROM `acc_ageing` as a WHERE led_id=" . $ledger . " and paid < case when credit=0 then debit else credit end HAVING DATEDIFF(CURRENT_DATE(),tb_crdate)>" . $credit_period . " ";
        $result = $this->db->query($qry);
		$is_exceed = 0;
		if($result->num_rows()>0){
			$is_exceed = 1;
		}
		$qry = "SELECT IFNULL(sum(debit)-sum(paid),0) as amount,".$is_exceed." as is_exceed FROM `acc_ageing` where led_id=".$ledger." and debit>0";
		$query = $this->db->query($qry);
        echo json_encode($query->result_array());
    }

    function Pestimates($search, $type) {
        $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.id as pid,a.*,b.* from purchase as a inner join  suppliers as b on a.supplier_id =b.id where status!='completed' and a.type='order' and (invoice like('%$search%') or b.name like ('%$search%') )";
        if (strtolower($type) == 'purchase_return') {
            $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.id as pid,a.*,b.* from purchase as a inner join  suppliers as b on a.supplier_id =b.id where a.type='purchase' and (invoice like('%$search%') or b.name like ('%$search%') )";
        }

        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function gettaxledger($id) {
        $qry = "select * from acc_ledgers where id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function godownstock($search) {
        $qry = "select IFNULL(c.stock,0) as item_stock, a.id as go_id,a.*,c.* from ims_godown as a left join(select sum(open_stock+current_stock) as stock,item_id,godown_id as gid from item_godown as b where item_id=" . $search . "  group by godown_id ) as c on c.gid=a.id";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        $qty = 0;
        foreach ($result as $row) {
            $qty = $qty + $row["item_stock"];
        }

        foreach ($result as $row) {

            $option .= '<option qty="' . $qty . '" stock="' . $row["item_stock"] . '" value="' . $row["go_id"] . '">' . $row["godown_code"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function cli_salesitems($id) {
        $qry = "SELECT c.name as name,c.id as id,b.Quantity as qty,Total,Rate,Med_note,b.Pot_Id,b.Unit_Id,u.name as uname,p.Potency FROM cli_booking as a INNER JOIN cli_sales_items as b on a.Bok_Id=b.Sales_Bok_Id INNER JOIN item as c on b.Item_Id=c.id left join units as u on u.id=b.Unit_Id left join cli_potency as p on p.Pot_Id=b.Pot_Id WHERE b.Published='yes' and Bok_Id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function service_items($id) {
        $qry = "SELECT a.*,b.name,t.GST from sales_ledgers as a inner join acc_ledgers as b on b.id=a.ledger_id inner join taxgst as t on t.gstid =a.tax_id  where a.published='yes' and  sales_id in(".str_replace("_",",",$id).")  ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function sale_coupon($id) {
        $qry = "select a.cou_id,amount,cou_discountp,cou_discount,cou_code FROM `sales_coupon` as a INNER JOIN coupons as b on a.cou_id=b.cou_id where a.sales_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function barcode_batch($id) {
        $qry = " select * from barcode_batch as a INNER JOIN barcode_batch_items as b on a.barcode_batch_id=b.batch_id WHERE b.published='yes' and barcode_batch_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function pur_service_items($id) {
        $qry = "select * from taxgst where gst = 0";
        $data = $this->db->query( $qry);
        if($data->num_rows() > 0 ){
            $data  =  $data->row_array();
            $qry = 'update purchase_ledgers set tax_id = '.$data['gstid'].' where  tax_id = 0 ';
            $this->db->query( $qry);
        }
        $qry = "SELECT a.*,b.name,t.GST from purchase_ledgers as a inner join acc_ledgers as b on b.id=a.ledger_id inner join taxgst as t on t.gstid =a.tax_id  where a.published='yes' and  purchase_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function get_unitcounts(){
        $qry = "select * from units";
        $result = $this->db->query($qry)->result_array();
        $data = array();
        foreach($result as $it){
            $data[$it['id']] = $it['base_unit_count'];
        }
        echo json_encode($data);
    }

    function sales_items($id) {
        $txt = '"" as schemetill,"" as schemefrom,"" as schemedesc,';
        $settings = $this->getCompanySettings();
        $Scheme_Discount = 0;
        if(isset($settings[0]['Scheme_Discount'])){
            $Scheme_Discount  = $settings[0]['Scheme_Discount'];
        }
        if($Scheme_Discount > 0 ){
            $txt = "DATE_FORMAT(scheme_till,'%d/%m/%Y') as schemetill,DATE_FORMAT(scheme_from,'%d/%m/%Y') as schemefrom,scheme_desc as schemedesc,";
        }

        $qry = "select case when sal_itms_mrp = 0 then c.MRP else sal_itms_mrp end as salitmsmrp,$txt IFNULL(item_group.discount,0) as itemdiscount,case when due_date != '' and due_date is not null then DATE_FORMAT(due_date,'%d/%m/%Y') else '' end as sale_due_date,   state.code as statecode,e.base_unit_count,b.godown as godown_id,b.unit_id as unitid,b.tax_id as taxid,b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date,DATE_FORMAT(delivery_date,'%d/%m/%Y') as ddate, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot,i.any_name as analyticsname, a.*,b.*,c.*,g.* from sales as a left join state on state.StateID = a.cusstate inner join  sales_items as b on a.sales_id =b.sales_id inner join item as c on b.item_id =c.id left join item_group on item_group.id = c.item_group_id inner join taxgst as d on b.tax_id =d.gstid inner join ims_godown as g on b.godown=g.id left join units as e on b.unit_id =e.id left join analytics_center as i on i.any_id=b.analytics  where b.published='yes' and  a.sales_id in(".str_replace("_",",",$id).") order by sal_itms_id desc";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function purity(){
		$qry = "select a.* from purity as a  where  active = 'yes' ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["purity"] . '</option>';
        }
        print_r($option);
	}

    function getprinters($id) {
        $qry = "select * from sales_print where   sales_id in(".str_replace("_",",",$id).") " ;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function quotation_items($id) {
        $qry = "select b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot, a.*,b.*,c.*,g.* from quotation as a inner join  quotation_items as b on a.id =b.qtn_id inner join item as c on b.item_id =c.id inner join taxgst as d on b.tax_id =d.gstid inner join ims_godown as g on b.godown=g.id inner join units as e on c.unit_id =e.id   where b.published='yes' and  a.id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function cli_diagonise($id) {
        $qry = "select a.Dig_Id,Diagnose from cli_bok_diagnose as a inner join cli_diagnose as b on a.Dig_Id=b.Dig_id where a.Bok_Id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function cli_observation($id) {
        $qry = "select Obv_id,Observation from cli_bok_observation as a inner join cli_observation as b on a.Obv_Id=b.Obs_Id where a.Bok_Id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tyrsales_items($id) {
        $qry = "select b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot, a.*,b.*,c.* from tyr_sales as a inner join  tyr_sales_items as b on a.sales_id =b.sales_id inner join item as c on b.item_id =c.id inner join taxgst as d on c.tax_id =d.gstid inner join units as e on c.unit_id =e.id   where b.published='yes' and  a.sales_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function purchase($id) {
        $qry = "select a.date as dates,a.supplier_id as supid,b.id as indexid,case when due_date != '' and due_date is not null then DATE_FORMAT(due_date,'%d/%m/%Y') else '' end as pur_due_date,b.id as pur_itm_id,DATE_FORMAT(manufacture_date,'%d/%m/%Y') as mdate, DATE_FORMAT(expiry_date,'%d/%m/%Y') as edate,c.srate as salerate_item,b.unit_id as unitid,b.godown as item_godown,d.GST as tname,e.name  as uname,g.godown_name,a.discount as dis,i.any_name as analyticsname,b.tax_id as txid, a.*,b.*,c.* from purchase as a left join  purchase_items as b on b.published='yes' and a.id =b.purchase_id left join item as c on b.item_id =c.id left join taxgst as d on b.tax_id =d.gstid left join units as e on b.unit_id =e.id left join ims_godown as g on g.id=b.godown  left join analytics_center as i on i.any_id=b.analytics where   a.id = $id order by b.id desc";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Patientbyid($id) {
        $qry = "select DATE_FORMAT(manufacture_date,'%d/%m/%Y') as mdate, DATE_FORMAT(expiry_date,'%d/%m/%Y') as edate,b.*,a.* from    cli_patient as b  inner join cli_booking as a on a.Cus_Id= b.Pat_Id where b.Pat_Id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function customer($id) {
        $qry = "select b.* from    suppliers as b left join state as a on b.cst=a.StateID where b.id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tyr_customer($id) {
        $qry = "select b.* from tyr_customer as b where b.id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function estimates($search, $type) {
        $qry = "select a.type as stype,CONCAT(a.invoice,' ', b.name) as label,a.*,b.* from sales as a inner join  suppliers as b on a.customer_id =b.id where status!='completed' and (a.type='estimate' or a.type='delivery_note') and invoice like('%$search%')";
        if (strtolower($type) == 'sales_return') {
            $qry = "select CONCAT(a.invoice,' ', IFNULL(b.name,a.cusname)) as label,a.*,b.* from sales as a left join  suppliers as b on a.customer_id =b.id where a.type='sales' and invoice like('%$search%')";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function category($search) {
        $qry = "select name as label,a.* from item_category as a  where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function suppliers($search, $type) {
        $ls = "";
        $branch_text = '';
        $com = "concat( a.name,' ',tin,case when phone !='' then '  phone :' else '' end,case when phone !='' then phone else '' end)  as label,";
        if ($type == 'sup') {
            $type = ' ( type ="sup"  or listed_in_supplier = 1 )  and ';

           
        } else {
            $type = '';
             $settings = $this->getCompanySettings();
            $tmp = $this->session->userdata('user');
            $customer_branch = 0 ;
            if(isset( $settings[0]['customer_branch']) && $tmp['utype'] != 'Admin'){
                $branch = $tmp['branch'];
             //   $branch_text = ' and a.branch = "'.$branch .'" ';
            }
        }
        if ($this->multiple != 0) {
            $ls = " or a.name_lan like('%$search%')";
            $com = " concat(cast(ifnull(a.`name_lan`,' ') as char),' ','',name,' ',tin) as label,";
        }

        
        $qry = "select $com a.*,b.StateID,b.code from suppliers as a  left join state as b on a.cst=b.StateID where  is_active =1 $branch_text and  $type   (name like('%$search%') $ls or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function hsn($search) {
        $qry = "select a.hsncode  as label,a.* from hsncode as a   where   hsncode like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Diagonise($search) {
        $qry = "select a.Diagnose as label, a.* from cli_diagnose as a where Diagnose like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Observation($search) {
        $qry = "select a.Observation as label, a.* from cli_observation as a where Observation like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Patient($search) {
        $qry = "select CONCAT(a.Pat_Name,' ', a.Pat_Phone) as label,a.* from cli_patient as a where Pat_Name like('%$search%') or Pat_Phone like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function mainledger($search) {
        $qry = "select name as label,a.* from acc_main as a where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function members($search) {
        $qry = "select a.name as label,a.* from member as a where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function ledgers($search,$type) {
		$ls ="";
		if($type=="sales"){
			$ls = " and is_for_sales ='1' ";
		}else if($type=="purchase"){
			$ls = " and is_for_purchase ='1' ";
		}
        $qry = "select *,name as label from acc_ledgers as a left join taxgst as b on a.tax_id=b.gstid where a.name like('%$search%') ".$ls." ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function alter_items($id) {
        $qry = "select sum(c.item_qty) as item_qty,a.*,b.* from item_alternates as a inner join item as b on a.alt_item_id=b.id LEFT JOIN item_godown as c on c.item_id=a.alt_item_id where a.item_id=" . $id . " group by a.alt_item_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function items($search) {
        $res = explode(' ', $search);
        $ls = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
        }
        $qry = "select IFNULL(b.discount as) dis,CONCAT(a.name,' : ', barcode ,'        mrp:',MRP) as label,a.*,(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a  left join item_group as b on a.item_group_id =b.id where name like('%$search%') or price_code like('%$search%')  or barcode like('%$search%')  limit  50";
        $grpdiscount = $this->getValue('grpdiscount');
        if ($grpdiscount == 1) {
            $qry = "select CONCAT(a.name,'      ,  Mrp:',MRP) as label,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join item_group as b on a.item_group_id =b.id where($ls) or price_code ='%$search%'     or barcode ='$search' limit  50";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function itemsearchbyid($id) {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $qry = "select IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,'' as itembatch,CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP, '  ,WRate:',wh_rate,'   SRate:', srate) as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id left join item_group as b on a.item_group_id =b.id where  a.id ='" . $id . "'";
		if((int) $isbatch  > 0){
			$qry = "select IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,batches.batch as itembatch,a.barcode,a.tax_sales_id,a.tax_purchase_id,a.unit_id,a.commission,a.tax_id,a.id,a.price_code,a.name,IFNULL(batches.item_whrate,a.wh_rate) as wh_rate,IFNULL(batches.item_mrp,a.MRP) as MRP,IFNULL(batches.item_srate,a.srate) as srate,IFNULL(batches.item_prate,a.prate) as prate,sum(batches.open_stock)+sum(batches.current_stock) as stk,CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP, '  ,WRate:',wh_rate,'   SRate:', srate) as label,barcode,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id left join item_godown as batches on batches.item_id = a.id left join item_group as b on a.item_group_id =b.id where  a.id ='" . $id . "' GROUP by a.id,batches.id ORDER by stk desc limit 0,1";
		}
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function barcodesearch($search) {
        $res = explode(' ', $search);
        $ls = $als = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " or  a.name_lan like('%$sd%')";
                    }
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " and a.name_lan like('%$sd%')";
                    }
                }
                $inc++;
            }
        }
        $qry = "select concat(a.barcode,'Unit :',IFNULL(c.name,d.name)) as label,a.name as name,a.id,IFNULL(b.barcode,a.barcode) as barcode,IFNULL(b.rate,a.srate) as rate,MRP from item as a left join item_barcode as b on a.id=b.item_id left join units as c on c.id=b.unit_id  left join units as d on d.id=a.unit_id WHERE $ls";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function itemssearchsale($sear, $id) {
        $qry = "SELECT b.name,b.barcode,a.quantity,a.sal_itms_id from sales_items as a INNER JOIN item as b on a.item_id=b.id WHERE a.sales_id=" . $id . " and b.barcode='" . $sear . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
	
	function load_get_packing_slip_items($id){
			$qry = "SELECT psi.*,ig.item_size,IFNULL(MRP,0) as p_srate,IFNULL(i.base_rate,0) as p_base_rate,IFNULL(i.special_rate,0) as special_rate,IFNULL(i.wh_rate,0) as p_wh_rate,IFNULL(i.MRP,0) as p_MRP,IFNULL(itg.discount,0) as p_dis,IFNULL(MRP,0) as salerate,0 as price_code,ig.current_stock as currentstk,'' as itembatch,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,concat(ig.EAN,' - ' ,i.name ,' - ',id.design_name ,' - ' , ic.color_name , ' - ',iz.size_code) as label,i.*,ig.EAN from  packing_slip_items as psi inner join  item_godown as ig on ig.EAN = psi.ean INNER JOIN item as i on ig.item_id = i.id LEFT JOIN item_color as ic on ic.color_id = ig.item_color left JOIN item_designs as id on id.design_id = ig.item_design left JOIN item_size as iz on iz.size_id = ig.item_size left JOIN taxgst as t on t.gstid = i.tax_id left join cess_tbl as cess on cess.ces_id = t.cess_type LEFT JOIN item_group as itg on itg.id = i.item_group_id where psi.published = 'yes' and psi.packing_slip_itms_pid = ".$id." ";
			$result = $this->db->query($qry);
			echo json_encode($result->result_array());
	}
	
	
	
	function  get_packing_slip($search, $customer){
		$qry = "select packing_slip.*,packing_slip_voucher_no as label from packing_slip where packing_slip_customer = ".$customer."  and packing_slip_status = 'created' and published = 'yes'";
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	function itemadvanced_search($search, $check, $customer){
		$qry = "SELECT ig.item_size,IFNULL(MRP,0) as p_srate,IFNULL(i.base_rate,0) as p_base_rate,IFNULL(i.special_rate,0) as special_rate,IFNULL(i.wh_rate,0) as p_wh_rate,IFNULL(i.MRP,0) as p_MRP,IFNULL(itg.discount,0) as p_dis,IFNULL(MRP,0) as salerate,0 as price_code,ig.current_stock as currentstk,'' as itembatch,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,concat(ig.EAN,' - ' ,i.name ,' - ',IFNULL(id.design_name,'NIL') ,' - ' , IFNULL(ic.color_name,'NIL') , ' - ',IFNULL(iz.size_code,'Nil')) as label,i.*,ig.EAN from  item_godown as ig INNER JOIN item as i on ig.item_id = i.id LEFT JOIN item_color as ic on ic.color_id = ig.item_color left JOIN item_designs as id on id.design_id = ig.item_design left JOIN item_size as iz on iz.size_id = ig.item_size left JOIN taxgst as t on t.gstid = i.tax_id left join cess_tbl as cess on cess.ces_id = t.cess_type LEFT JOIN item_group as itg on itg.id = i.item_group_id where i.name like'%".$search."%' ";
		if($check == "barcode"){
			$qry = "SELECT ig.item_size,IFNULL(MRP,0) as p_srate,IFNULL(i.base_rate,0) as p_base_rate,IFNULL(i.special_rate,0) as special_rate,IFNULL(i.wh_rate,0) as p_wh_rate,IFNULL(i.MRP,0) as p_MRP,IFNULL(itg.discount,0) as p_dis,IFNULL(MRP,0) as salerate,0 as price_code,ig.current_stock as currentstk,'' as itembatch,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,concat(ig.EAN,' - ' ,i.name ,' - ',id.design_name ,' - ' , ic.color_name , ' - ',iz.size_code) as label,i.*,ig.EAN from  item_godown as ig INNER JOIN item as i on ig.item_id = i.id LEFT JOIN item_color as ic on ic.color_id = ig.item_color left JOIN item_designs as id on id.design_id = ig.item_design left JOIN item_size as iz on iz.size_id = ig.item_size left JOIN taxgst as t on t.gstid = i.tax_id left join cess_tbl as cess on cess.ces_id = t.cess_type LEFT JOIN item_group as itg on itg.id = i.item_group_id where EAN ='".$search."' ";
		}
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}


    	function itemssearch_purchase($search, $check, $customer){
		$currentstk = '(IFNULL(a.current_stock,0)+a.open_stock)';
		$godown_stock_text = 'IFNULL(godown_stock,0) as godown_stock';
		$txt_batch = " '' as itembatch, ";
		$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(srate,0),' , Prate:',IFNULL(prate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),' , LC : ',IFNULL(round(landing_cost,2),0),')') as label ";
		$login_comid = $this->session->userdata('login_comid');
		if($login_comid =='playstore' || $login_comid =='Playstore' ){
			$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(srate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),'  ',')') as label ";
		}
        $batchcheck = '';
        if(strtolower($login_comid) =='msa'){
           // $batchcheck = ' and IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) > 0  ';
        }
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $purchase_barcode = 0 ;
        if (isset($settings[0]['purchase_barcode'])) {
            $purchase_barcode = $settings[0]['purchase_barcode'];
        }
		$res = explode(' ', $search);
        $ls = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                }
                $inc++;
            }
        }
		if (is_numeric($search)) {
           // $ls = " a.MRP  =$search";
           // $als = "";
        }
		$pricelist =" 0 as pricelistid,a.srate as p_srate,b.discount as p_dis,a.prate as p_prate,a.MRP as p_MRP,a.wh_rate as p_wh_rate, ";
		$pricelist_id = 0; 
		$pricelist_text = "";
		
		if ($customer != '') {
			$qry_pricelist = "SELECT * FROM `suppliers` WHERE id = '".$customer."' ";
			$query_pricelist = $this->db->query($qry_pricelist);
			if($query_pricelist->num_rows()>0){
				$query_pricelist = $query_pricelist->row_array();
				$pricelist_id    = $query_pricelist ['price_list'];
			}
			if((int) $pricelist_id >0){
				$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(p.sales_rate,a.srate),' , Prate:',IFNULL(prate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),')') as label ";
				$pricelist = " IFNULL(price_discount,0) as price_discount,p.price_list_id as pricelistid,IFNULL(p.sales_rate,a.srate) as 	 p_srate, IFNULL(p.price_discount,b.discount) as p_dis,a.prate as p_prate,a.MRP as p_MRP,a.wh_rate as p_wh_rate, ";
				$pricelist_text = " left join price_list_items as p on p.item_id = a.id and p.price_list_id ='".$pricelist_id."' ";
			}
        }
		$batch_txt = '';
		if((int) $isbatch > 0 ){
			$currentstk ='IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)';
			$godown_stock_text = 'IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as godown_stock';
			$txt_batch = " batches.batch as itembatch, ";
			$label = "  IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) as  currentstk,CONCAT(a.name,'(','Batch:',IFNULL(batches.batch,'Common'),' , BC:',a.barcode,',Qty:',IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) ,' ,Srate:',IFNULL(batches.item_srate,a.srate),' , Prate:',IFNULL(batches.item_prate,a.prate),', MRP : ',IFNULL(batches.item_mrp,a.MRP),', WHrate:',IFNULL(batches.item_whrate,a.wh_rate),')') as label ";
			$pricelist = "0 as pricelistid, IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as p_godown_stock,IFNULL(batches.item_srate,a.srate) as 	 p_srate, IFNULL(b.discount,0) as p_dis,IFNULL(batches.item_prate,a.prate) as p_prate,IFNULL(batches.item_mrp,a.MRP)  as p_MRP,IFNULL(batches.item_whrate,a.wh_rate) as p_wh_rate,  ";
			$pricelist_text = " left join item_godown as batches on batches.item_id=a.id and batches.batch not in('0') $batchcheck ";
			$batch_txt = '  or batches.batch = "'.$search.'"  ';
			if((int) $pricelist_id >0){
				$label = "  IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) as  currentstk,CONCAT(a.name,'(','Batch:',IFNULL(batches.batch,'Common'),' , BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(p.sales_rate,IFNULL(batches.item_srate,a.srate)),' , Prate:',IFNULL(batches.item_prate,a.prate),', MRP : ',IFNULL(batches.item_mrp,a.MRP),', WHrate:',IFNULL(batches.item_whrate,a.wh_rate),')') as label ";
				$pricelist = " IFNULL(price_discount,0) as price_discount,p.price_list_id as pricelistid,IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as p_godown_stock,IFNULL(p.sales_rate,IFNULL(batches.item_srate,a.srate))  as 	 p_srate, IFNULL(p.price_discount,b.discount) as p_dis,IFNULL(batches.item_prate,a.prate) as p_prate,IFNULL(batches.item_mrp,a.MRP)  as p_MRP,IFNULL(batches.item_whrate,a.wh_rate) as p_wh_rate,  ";
				$pricelist_text = $pricelist_text .  " left join price_list_items as p on p.item_id = a.id and batches.batch = p.batch and p.price_list_id ='".$pricelist_id."' ";
			}
		}
		if ($check == "Txtbarcode") {
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(pie.purchase_id,'') as purchase_id,IFNULL(pie.imei,'') as imei,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from ( select * from  item as a where is_active = '1' and  a.published='yes' AND barcode like('" . $search . "%'))  as a left join item_racks_master as irm on irm.id = a.rack left join purchase_items_imei as pie on pie.item_id = a.id and pie.published ='yes' and pie.status = 1 left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and  a.published='yes' AND (barcode like('" . $search . "%') ".$batch_txt." ) limit  100";
        }
		if ($check == "name" || $check == ""){
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and a.published='yes' AND (a.name like('%" . $search . "%') or a.part_no1 like('%" . $search . "%') or a.part_no2 like('%" . $search . "%'))  limit  100";
            $login_comid = $this->session->userdata('login_comid');
            if($login_comid =='palack' || $login_comid =='kreatech' || $login_comid =='msa' || $login_comid =='senzation' || $login_comid =='kideez' ){
                $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and a.published='yes' AND (a.name like('%" . $search . "%') or a.part_no1 like('%" . $search . "%') or a.barcode like('" . $search . "%'))  limit  100";
            }
        }
		if ($check == "barcode"){
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,0 as purchase_id,'' as imei,a.unit_id as uid,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,barcode as item_barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id  $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and a.published='yes' AND (a.barcode ='" . $search . "'  ".$batch_txt." ) limit  0,1";
			$result = $this->db->query($qry);
			
			if( $result->num_rows()<1 ){
				$qry = "SELECT 0 as pindex,a.rate as unit_rate,b.barcode as code,a.unit_id as uid,b.unit_id,srate,item_id,b.barcode,b.commission FROM `item_barcode` as a  INNER JOIN item as b on a.item_id=b.id WHERE  b.published='yes' AND a.barcode= '" . $search . "' limit 0,1";
				$query = $this->db->query($qry);
				if ($query->num_rows() == 1) {
					$query = $query->row_array();
					$barcode = '"' . $search . '" as item_barcode';
					if ($query['uid'] != $query['unit_id']) {
						$quantity = $this->getquantity($query['uid'], 1, $query['item_id']);
					}
					$unit = 'u.id=' . $query['uid'];
					$rate = $query['uid'] . ' as uid ,' . $query['unit_rate'] . ' as salerate,';
					$search = $query['code'];
					$qry = "select 0 as pindex,0 as purchase_id,'' as imei,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,0 as pricelistid,'' as itembatch,$barcode,$rate u.name as uname,a.barcode as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id= ".$query['uid']."  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND a.barcode ='" . $search . "'  limit  0,1";
				}
			}
			$result = $this->db->query($qry);
			if( $result->num_rows()<1 ){
				$qry = "select 0 as pindex,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,pie.imei,pie.purchase_id,0 as pricelistid,'' as itembatch,a.barcode as item_barcode,a.srate as unit_rate,a.unit_id as uid, u.name as uname,a.barcode as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id inner join purchase_items_imei as pie on pie.item_id = a.id and pie.published ='yes' and pie.status = 1 $pricelist_text left join units as u on u.id= a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND pie.imei ='" . $search . "'  limit  0,1";
			}

            $result = $this->db->query($qry);
			if( $result->num_rows()<1 && $purchase_barcode > 0 ){
				$qry = "select pie.id as pindex,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,pie.barcode,pie.purchase_id,0 as pricelistid,'' as itembatch,a.barcode as item_barcode,a.srate as unit_rate,a.unit_id as uid, u.name as uname,a.barcode as label,a.barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id inner join purchase_items_barcode as pie on pie.item_id = a.id and pie.is_deleted =0 and pie.status = 1 $pricelist_text left join units as u on u.id= a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND pie.barcode ='" . $search . "'  limit  0,1";
            }

		}
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
		
	}


    
	function itemssearch_new($search, $check, $customer,$type= '',$btype =''){
        
        $txt_active = '';
        if(strtolower($this->session->userdata('login_base_comid')) == 'mcesb' || strtolower($this->session->userdata('login_base_comid')) == 'mces' ){
            $txt_active = " and is_active = '1' ";
        }
		$currentstk = '(IFNULL(a.current_stock,0)+a.open_stock)';
		$godown_stock_text = 'IFNULL(godown_stock,0) as godown_stock';
		$txt_batch = " '' as itembatch, ";
		$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(srate,0),' , Prate:',IFNULL(prate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),' , LC : ',IFNULL(round(landing_cost,2),0),')') as label ";
		$login_comid = $this->session->userdata('login_comid');
		if($login_comid =='playstore' || $login_comid =='Playstore' ){
			$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(srate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),'  ',')') as label ";
		}
        $batchcheck = '';
        if(strtolower($login_comid) =='msa'){
           // $batchcheck = ' and IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) > 0  ';
        }
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $purchase_barcode = 0 ;
        if (isset($settings[0]['purchase_barcode'])) {
            $purchase_barcode = $settings[0]['purchase_barcode'];
        }
        $is_rawmaterial = 1 ;
		if(isset($settings[0]['is_rawmaterial'] ) ){
			$is_rawmaterial = $settings[0]['is_rawmaterial'];
		}

        if($type !=''){
			$is_rawmaterial = 1 ;
		}
		$txt_raw = '  ';
		if((float) $is_rawmaterial <  1  ){
			//$txt_raw = " and  a.material_type = '1' ";
		}

		$res = explode(' ', $search);
        $ls = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                }
                $inc++;
            }
        }
		if (is_numeric($search)) {
           // $ls = " a.MRP  =$search";
           // $als = "";
        }
		$pricelist =" 0 as pricelistid,a.srate as p_srate,b.discount as p_dis,a.prate as p_prate,a.MRP as p_MRP,a.wh_rate as p_wh_rate, ";
		$pricelist_id = 0; 
		$pricelist_text = "";
		
		if ($customer != '') {
			$qry_pricelist = "SELECT * FROM `suppliers` WHERE id = '".$customer."' ";
			$query_pricelist = $this->db->query($qry_pricelist);
			if($query_pricelist->num_rows()>0){
				$query_pricelist = $query_pricelist->row_array();
				$pricelist_id    = $query_pricelist ['price_list'];
			}
			if((int) $pricelist_id >0){
				$label = "  (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk,CONCAT(a.name,'(','BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(p.sales_rate,a.srate),' , Prate:',IFNULL(prate,0),', MRP:',IFNULL(MRP,0),', WHrate:',IFNULL(wh_rate,0),')') as label ";
				$pricelist = " IFNULL(price_discount,0) as price_discount,p.price_list_id as pricelistid,IFNULL(p.sales_rate,a.srate) as 	 p_srate, IFNULL(p.price_discount,b.discount) as p_dis,a.prate as p_prate,a.MRP as p_MRP,a.wh_rate as p_wh_rate, ";
				$pricelist_text = " left join price_list_items as p on p.item_id = a.id and p.price_list_id ='".$pricelist_id."' ";
			}
        }
		$batch_txt = '';
		if((int) $isbatch > 0 ){
			$currentstk ='IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)';
			$godown_stock_text = 'IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as godown_stock';
			$txt_batch = " batches.batch as itembatch, ";
			$label = "  IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) as  currentstk,CONCAT(a.name,'(','Batch:',IFNULL(batches.batch,'Common'),' , BC:',a.barcode,',Qty:',IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) ,' ,Srate:',IFNULL(batches.item_srate,a.srate),' , Prate:',IFNULL(batches.item_prate,a.prate),', MRP : ',IFNULL(batches.item_mrp,a.MRP),', WHrate:',IFNULL(batches.item_whrate,a.wh_rate),')') as label ";
			$pricelist = "0 as pricelistid, IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as p_godown_stock,IFNULL(batches.item_srate,a.srate) as 	 p_srate, IFNULL(b.discount,0) as p_dis,IFNULL(batches.item_prate,a.prate) as p_prate,IFNULL(batches.item_mrp,a.MRP)  as p_MRP,IFNULL(batches.item_whrate,a.wh_rate) as p_wh_rate,  ";
			$pricelist_text = " inner join item_godown as batches on batches.item_id=a.id and batches.batch not in('0') $batchcheck ";
			$batch_txt = '  or batches.batch = "'.$search.'"  ';
			if((int) $pricelist_id >0){
				$label = "  IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0) as  currentstk,CONCAT(a.name,'(','Batch:',IFNULL(batches.batch,'Common'),' , BC:',a.barcode,',Qty:',IFNULL(godown_stock,0),' ,Srate:',IFNULL(p.sales_rate,IFNULL(batches.item_srate,a.srate)),' , Prate:',IFNULL(batches.item_prate,a.prate),', MRP : ',IFNULL(batches.item_mrp,a.MRP),', WHrate:',IFNULL(batches.item_whrate,a.wh_rate),')') as label ";
				$pricelist = " IFNULL(price_discount,0) as price_discount,p.price_list_id as pricelistid,IFNULL(batches.open_stock,0) + IFNULL(batches.current_stock,0)  as p_godown_stock,IFNULL(p.sales_rate,IFNULL(batches.item_srate,a.srate))  as 	 p_srate, IFNULL(p.price_discount,b.discount) as p_dis,IFNULL(batches.item_prate,a.prate) as p_prate,IFNULL(batches.item_mrp,a.MRP)  as p_MRP,IFNULL(batches.item_whrate,a.wh_rate) as p_wh_rate,  ";
				$pricelist_text = $pricelist_text .  " left join price_list_items as p on p.item_id = a.id and batches.batch = p.batch and p.price_list_id ='".$pricelist_id."' ";
			}
		}
		if ($check == "Txtbarcode") {
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(pie.purchase_id,'') as purchase_id,IFNULL(pie.imei,'') as imei,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from ( select * from  item as a where is_active = '1' and  a.published='yes' AND barcode like('" . $search . "%'))  as a left join item_racks_master as irm on irm.id = a.rack left join purchase_items_imei as pie on pie.item_id = a.id and pie.published ='yes' and pie.status = 1 left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and  a.published='yes' AND (barcode like('" . $search . "%') ".$batch_txt." ) ".$txt_raw." limit  100";
        }
		if ($check == "name" || $check == ""){
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and a.published='yes' $txt_active  AND (a.name like('%" . $search . "%') or a.part_no1 like('%" . $search . "%') or a.part_no2 like('%" . $search . "%')) ".$txt_raw." limit  100";
            $login_comid = $this->session->userdata('login_comid');
            if($login_comid =='palack' || $login_comid =='kreatech' || $login_comid =='senzation' || $login_comid =='kideez' ){
                $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' and a.published='yes' AND (a.name like('%" . $search . "%') or a.part_no1 like('%" . $search . "%') or a.barcode like('" . $search . "%')) ".$txt_raw." limit  100";
            }
            if( $login_comid =='msa' ){
                $branchid = strtolower($_GET['batch']);
                $batch_where  =' and a.item_category_id != 60 ';
                if($branchid > 1){
                    $batch_where  =' and a.item_category_id = 60 ';
                }
                $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE is_active = '1' ".$batch_where." and  a.published='yes' AND (a.name like('%" . $search . "%') or a.part_no1 like('%" . $search . "%') or a.barcode like('" . $search . "%')) ".$txt_raw." limit  100";
            }
        }
		if ($check == "barcode"){
            $wh_qry = '';
            if($search ==''){
                 $wh_qry = '  1 = 8 and ';
            }
            $qry = "select 0 as pindex,case when irm.id is null then '' else concat(irm.name,' , row : ',a.row) end as racks,e.godown_stock as stkitm,0 as purchase_id,'' as imei,a.unit_id as uid,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $txt_batch u.name as uname,u.uqc,$label,barcode,barcode as item_barcode,a.*,b.discount as dis,".$godown_stock_text.", ".$currentstk." as  currentstk from item as a left join item_racks_master as irm on irm.id = a.rack left join cess_tbl as ces on ces.ces_id=a.cess_id  $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  $wh_qry is_active = '1' and a.published='yes' AND (a.barcode ='" . $search . "'  ".$batch_txt." ) ".$txt_raw."  limit  0,1";
			$result = $this->db->query($qry);
			
			if( $result->num_rows()<1 ){
				$qry = "SELECT 0 as pindex,a.rate as unit_rate,b.barcode as code,a.unit_id as uid,b.unit_id,srate,item_id,b.barcode,b.commission FROM `item_barcode` as a  INNER JOIN item as b on a.item_id=b.id WHERE  b.published='yes' AND a.barcode= '" . $search . "' limit 0,1";
				$query = $this->db->query($qry);
				if ($query->num_rows() == 1) {
					$query = $query->row_array();
					$barcode = '"' . $search . '" as item_barcode';
					if ($query['uid'] != $query['unit_id']) {
						$quantity = $this->getquantity($query['uid'], 1, $query['item_id']);
					}
					$unit = 'u.id=' . $query['uid'];
					$rate = $query['uid'] . ' as uid ,' . $query['unit_rate'] . ' as salerate,';
					$search = $query['code'];
					$qry = "select 0 as pindex,0 as purchase_id,'' as imei,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,0 as pricelistid,'' as itembatch,$barcode,$rate u.name as uname,a.barcode as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id= ".$query['uid']."  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND a.barcode ='" . $search . "'  limit  0,1";
				}
			}
			$result = $this->db->query($qry);
			if( $result->num_rows()<1 ){
				$qry = "select 0 as pindex,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,pie.imei,pie.purchase_id,0 as pricelistid,'' as itembatch,a.barcode as item_barcode,a.srate as unit_rate,a.unit_id as uid, u.name as uname,a.barcode as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id inner join purchase_items_imei as pie on pie.item_id = a.id and pie.published ='yes' and pie.status = 1 $pricelist_text left join units as u on u.id= a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND pie.imei ='" . $search . "'  limit  0,1";
			}

            $result = $this->db->query($qry);
			if( $result->num_rows()<1 && $purchase_barcode > 0 ){
				$qry = "select pie.id as pindex,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,pie.barcode,pie.purchase_id,0 as pricelistid,'' as itembatch,a.barcode as item_barcode,a.srate as unit_rate,a.unit_id as uid, u.name as uname,a.barcode as label,a.barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id inner join purchase_items_barcode as pie on pie.item_id = a.id and pie.is_deleted =0 and pie.status = 1 $pricelist_text left join units as u on u.id= a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id   WHERE  a.published='yes' AND pie.barcode ='" . $search . "'  limit  0,1";
            }

		}
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
		
	}

    function itemssearch($search, $check, $customer) {
		$pricelist =" a.srate as p_srate,b.discount as p_dis, ";
		$pricelist_id = 0; 
		$pricelist_text = "";
        $unit = 'u.id=a.unit_id';
        $rate = 'a.unit_id as uid,a.srate as salerate,';
        $barcode = 'barcode as item_barcode';
        $quantity = 1;
        if ($check === 'barcode') {
            $qry = "SELECT a.rate as unit_rate,count(a.id) as itemcount,b.barcode as code,a.unit_id as uid,b.unit_id,srate,item_id,b.barcode FROM `item_barcode` as a INNER JOIN item as b on a.item_id=b.id WHERE  b.published='yes' AND a.barcode= '" . $search . "'";
            $query = $this->db->query($qry)->row_array();
            if ($query['itemcount'] == 1) {
                $barcode = '"' . $search . '" as item_barcode';
                if ($query['uid'] != $query['unit_id']) {
                    $quantity = $this->getquantity($query['uid'], 1, $query['item_id']);
                }
                $unit = 'u.id=' . $query['uid'];
                $rate = $query['uid'] . ' as uid ,' . $query['unit_rate'] . ' as salerate,';
                $search = $query['code'];
            }
        }
        $com = " a.name ";
        $kit = '';
        $sub = 'a.srate as rate,';
        $mul_lan = '';
        if ($this->multiple != 0) {
            $com = " concat(cast(a.`name_lan` as char),' ',' ',a.name) ";
        }

        if ($customer != '') {
            // $kit = " left join (select rate,item_id from kit_group as c inner join kit_items as d on c.id=d.kit_id where customer_id =".$customer." and d.published='yes') as e on a.id=e.item_id ";
            // $sub = 'e.*,';
			$qry_pricelist = "SELECT * FROM `suppliers` WHERE id = '".$customer."' ";
			$query_pricelist = $this->db->query($qry_pricelist);
			if($query_pricelist->num_rows()>0){
				$query_pricelist = $query_pricelist->row_array();
				$pricelist_id    = $query_pricelist ['price_list'];
			}
        }
		if((int) $pricelist_id >0){
			$pricelist = " IFNULL(p.sales_rate,a.srate) as 	 p_srate, IFNULL(p.price_discount,b.discount) as p_dis,";
			$pricelist_text = " left join price_list_items as p on p.item_id = a.id and p.price_list_id ='".$pricelist_id."' ";
		}
        $res = explode(' ', $search);
        $ls = $als = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " or  a.name_lan like('%$sd%')";
                    }
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " and a.name_lan like('%$sd%')";
                    }
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
            $als = "";
        }
        $qry = "select  IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$rate u.name as uname,e.*,a.barcode as label,$barcode,a.*," . $sub . "(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id  left join units as u on $unit " . $kit . "  WHERE  a.published='yes' AND barcode ='" . $search . "'";

        if ($check != 'name') {
            $qry = "select  IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,e.*,u.name as uname,CONCAT(a.name,' : ', 'bc:',IFNULL(barcode,0),' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', Prate : ',WRate:',IFNULL(wh_rate,0), '  SRate:', IFNULL(srate,0)) as label,barcode,a.*," . $sub . "(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a  left join cess_tbl as ces on ces.ces_id=a.cess_id left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on u.id=a.unit_id  " . $kit . " WHERE  a.published='yes' AND name like('%$search%')  limit  250";
        }
        $grpdiscount = $this->getValue('grpdiscount');
        if ($grpdiscount == 1) {

            $qry = "select IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist  u.name as uname,e.*,CONCAT(a.name,' : ', 'bc:',IFNULL(barcode,0),' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', WRate:',IFNULL(wh_rate,0), '  SRate:', IFNULL(srate,0)) as label,barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id   $pricelist_text  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on u.id=a.unit_id  left join item_group as b on a.item_group_id =b.id  " . $kit . " WHERE  a.published='yes' AND ($ls)  limit  240";
            if ($check != 'name') {
                $qry = "select IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist $rate u.name as uname,e.*,CONCAT($com ,' : ', 'bc:',barcode,' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', WRate:',IFNULL(wh_rate,0),'   SRate:', IFNULL(srate,0)) as label,$barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text   left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on $unit  left join item_group as b on a.item_group_id =b.id  " . $kit . "  WHERE  a.published='yes' AND barcode ='" . $search . "'";
            }
            if ($check == "Txtbarcode") {
                $qry = "select IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,$pricelist u.name as uname,a.barcode as label,barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join cess_tbl as ces on ces.ces_id=a.cess_id $pricelist_text left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id  " . $kit . " WHERE  a.published='yes' AND barcode like('%" . $search . "%')  limit  240";
            }
        }
		//print_r($qry);
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getitem($opt) {
        if ($opt == "item") {
            $qry = "select IFNULL(id,0) as id from item order by id desc limit 1";
        }
        if ($opt == "supplier") {
            $qry = "select IFNULL(id,0) as id  from suppliers where type='sup' order by id desc limit 1";
        }
        if ($opt == "customer") {
            $qry = "select IFNULL(id,0) as id  from suppliers where type='cus' order by id desc limit 1";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
	
	function subunits($search) {
         $id = $search;
        $count = 1;
        $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $option = '<option value = ""> Select </option>';
        $qry = "select id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
		$result = $this->db->query($qry)->result_array();
		foreach($result as $res){
			$id = $res['id'];
			$count = 1 * $res['unit_count'];
			$option .= '<option count="' . $count . '" value="' . $res["id"] . '">' . $res["name"] . '</option>';
			for ($i = 2; $i >= 2; $i++) {
				$qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where unit_id != 0 and  `unit_id`='" . $id . "'";
				$query = $this->db->query($qry)->row_array();
				$i = $query['count'];
				$count = $count * $query["unit_count"];
				if ($query['count'] > 0) {
					$id = $query['id'];
					$option .= '<option count="' . $count . '" value="' . $query["id"] . '">' . $query["name"] . '</option>';
				}
			}
		}
        print_r($option);
    }

    function units($search) {
		$qry = "select * from item where id=".$search;
		$query = $this->db->query($qry)->row_array();
		$search = $query['unit_id'];
		$sub_unit_one =  $query['sub_unit_one'];
		$sub_unit_two =  $query['sub_unit_two'];
		$is_itemunit = 0 ;
		if((int) $sub_unit_two > 0 || (int) $sub_unit_one  ){
			$is_itemunit = 1;
		}
        $id = $search;
        $count = 1;
        $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $option = '<option value = ""> Select </option>';
        $option .= '<option count = 1 value="' . $query["id"] . '">' . $query["code"] . '</option>';
        $qry = "select id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
		$result = $this->db->query($qry)->result_array();
		foreach($result as $res){
			$id = $res['id'];
			$count = 1 * $res['unit_count'];
			if((int)$is_itemunit > 0 ){
				if((int) $res["id"] == (int) $sub_unit_two || (int) $res["id"] == (int) $sub_unit_one){
					$option .= '<option count="' . $count . '" value="' . $res["id"] . '">' . $res["name"] . '</option>';
				}
			}else{
				$option .= '<option count="' . $count . '" value="' . $res["id"] . '">' . $res["name"] . '</option>';
			}
			for ($i = 2; $i >= 2; $i++) {
				$qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
				$query = $this->db->query($qry)->row_array();
				$i = $query['count'];
				$count = $count * $query["unit_count"];
				if ($query['count'] > 0) {
					$id = $query['id'];
					if((int)$is_itemunit > 0 ){
						if((int) $query["id"] == (int) $sub_unit_two || (int) $query["id"] == (int) $sub_unit_one){
							$option .= '<option count="' . $count . '" value="' . $query["id"] . '">' . $query["name"] . '</option>';
						}
					}else{
						$option .= '<option count="' . $count . '" value="' . $query["id"] . '">' . $query["name"] . '</option>';
					}
				}
			}
		}
        print_r($option);
    }

    function driver($id) {
        $qry = "select a.* from hr_profile as a inner join veh_drivers as b on a.emp_id=b.emp_id where b.veh_id=" . $id;
        if ($id == 0) {
            $qry = "select a.* from hr_profile as a inner join veh_drivers as b on a.emp_id=b.emp_id";
        }
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["emp_id"] . '">' . $row["pro_fname"] . '</option>';
        }
        print_r($option);
    }
	
	public function counters(){
		$qry ="select * from counter";
		$result = $this->db->query($qry)->result_array();
		$option = '<option value="">Select</option>';
		foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
	}

    function cliunits($search) {
        $qry = "SELECT * FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $option = '<option value="' . $query['id'] . '">' . $query['name'] . '</option>';
        $qry = "select a.* from units as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }
	
	 public function design() {
        $qry = "select * from item_designs order by design_id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Design </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["design_id"] . '" >' . $row["design_name"] . '</option>';
        }
        print_r($option);
    }
	
	 public function color() {
        $qry = "select * from item_color order by color_id  asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Color </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["color_id"] . '" >' . $row["color_name"] . '</option>';
        }
        print_r($option);
    }
	
	

    function size() {
        $qry = "select * from item_size order by size_id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Size </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["size_id"] . '" >' . $row["size_code"] . '</option>';
        }
        print_r($option);
    }

    function tax() {
        $qry = "select a.*,b.ces_name,IFNULL(b.ces_percent,0) as ces_percent,IFNULL(c.id,0) as cesid from taxgst as a left join cess_tbl as b on a.cess_type=b.ces_id left JOIN acc_ledgers as c on c.ref_id=b.ces_id and ref_code='Cess' ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option ces_id="' . $row["cesid"] . '" cess="' . $row["ces_percent"] . '" value="' . $row["gstid"] . '" percent="' . $row["GST"] . '" igst="' . $row["igst"] . '" cgst="' . $row["cgst"] . '" sgst="' . $row["sgst"] . '">' . $row["GST"] . '</option>';
        }
        print_r($option);
    }

    function setledgers($paytype) {
        $qry = "select a.* from acc_ledgers as a where a.acc_main_id=" . $paytype;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option acc_main_id="' . $row["acc_main_id"] . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function get_saleskey($type) {
        $qry = " SELECT * FROM `keys` WHERE  page='" . $type . "' order by id asc";
        //echo $qry;
        $query = $this->db->query($qry);
        echo json_encode($query->result_array());
    }

    function gsm() {
        $qry = "select a.* from GSM as a ";
        print_r($qry);
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["GSM_Id"] . '">' . $row["GSM"] . '</option>';
        }
        print_r($option);
    }
    function material() {
        $qry = "select a.* from material as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["material_id"] . '">' . $row["material"] . '</option>';
        }
        print_r($option);
    }

    function salesman() {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '">' . $row["user_name"] . '</option>';
        }
        print_r($option);
    }

    function delivery_type() {
        $qry = "select a.* from delivery_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["id"] . '">' . $row["delivery_type"] . '</option>';
        }
        print_r($option);
    }

    function states() {
        $qry = "select a.* from state as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select State </option>';
        foreach ($result as $row) {
            $option .= '<option code="' . $row["code"] . '" value="' . $row["StateID"] . '">' . $row["StateName"] . '</option>';
        }
        print_r($option);
    }

    function bank() {
        $qry = "select a.* from acc_ledgers as a where ref_code='Bank' and acc_main_id=1";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }
	
	function customerpackingSlips($id) {
        $qry = "select a.* from packing_slip as a where published ='yes' and packing_slip_status = 'created' and packing_slip_customer = '".$id."'  ORDER BY packing_slip_id  DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }
	
	function customerpackingSlip($id,$sale_id) {
		$slip = '0';
		if($sale_id > 0 ){
			$qry = "SELECT GROUP_CONCAT(DISTINCT sales_packing_slip_id) as slip  FROM `sales_items` WHERE published = 'yes' and sales_id = '".$sale_id."'";
			$sale = $this->db->query($qry)->row_array();
			$slip = $sale['slip'];
		}
        $qry = "select a.*,CASE when FIND_IN_SET(packing_slip_id, '".$slip."') then 'selected' else '' end as status from packing_slip as a where published ='yes' and (packing_slip_status = 'created' or FIND_IN_SET(packing_slip_id, '".$slip."') ) and packing_slip_customer = '".$id."'  ORDER BY packing_slip_id  DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option ' . $row["status"] . '  value="' . $row["packing_slip_id"] . '">' . $row["packing_slip_voucher_no"] . '</option>';
        }
        print_r($option);
    }

    function myprinter() {
        $qry = "select a.* from printers as a ORDER BY is_default DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["prn_id"] . '">' . $row["prn_name"] . '</option>';
        }
        print_r($option);
    }
	
	 function item_cess() {
        $qry = "select a.* from cess_tbl as a where cess_on_item =1 ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> All </option>';
        $i = $default = 0;
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["ces_id"] . '">' . $row["ces_name"] . '</option>';
            $i++;
        }
        print_r($option);
    }

    function itemgroup() {
        $qry = "select a.* from item_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> All </option>';
        $i = $default = 0;
        foreach ($result as $row) {
            if ($i == 0) {
                $default = $row["id"];
                $option .= '<option default="' . $row["id"] . '" default="' . $row["id"] . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
            } else {
                $option .= '<option default="' . $default . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
            $i++;
        }
        print_r($option);
    }

    function potency() {
        $qry = "select a.* from cli_potency as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        foreach ($result as $row) {
            if ($no == 0) {
                $option = '<option value="' . $row["Pot_Id"] . '">' . $row["Potency"] . '</option>';
            } else {
                $option .= '<option value="' . $row["Pot_Id"] . '">' . $row["Potency"] . '</option>';
            }
            $no++;
        }
        print_r($option);
    }

    function billtype($type) {
		
		$settings = $this->getCompanySettings();
        $tmp = $this->session->userdata('user');
        $utype = $tmp['utype'];
        $userid = $tmp['Id'];
        $br_txt = '';
		$user_branch = $tmp['branch'];
        $qry = "SELECT GROUP_CONCAT(`user_default_billtype`,',',`default_purchase_billtype`,',',`default_sorder_billtype`,',',`default_sreturn_billtype`,',',`default_porder_billtype`,',',`default_preturn_billtype`) as types FROM `user_settings` as b WHERE user_id=" . $userid;
        if(isset($settings[0]['branch_billtype'] ) ){
			if((float) $settings[0]['branch_billtype'] > 0  ){
				$qry = "SELECT GROUP_CONCAT(id) as types FROM `set_billtype` WHERE branch_id = ".$user_branch;
                $br_txt = ' and branch_id = '.$user_branch;
            }
		}
        $query = $this->db->query($qry)->row_array();
		$value = $query['types'];
        $qry = "select IFNULL(b.name,'Set Cash Ledger') as ledger,IFNULL(a.godown_id,0) as godown,a.* from set_billtype as a left join acc_ledgers as b on b.id= a.cash where a.transaction='" . $type . "' and is_pos=0  order by a.id asc";
        if (ucfirst($utype) != "Admin") {
            $qry = "select IFNULL(b.name,'Set Cash Ledger') as ledger,IFNULL(a.godown_id,0) as godown,a.* from set_billtype as a left join acc_ledgers as b on b.id= a.cash where a.id in($value) and a.transaction='" . $type . "' and is_pos=0  order by a.id asc";
        }else{
            $br_txt = '';
        }
		if (ucfirst($type) == "Jou" || ucfirst($type) == "Rec" || ucfirst($type) == "Pay" || ucfirst($type) == "Contra" || $type == "credit_note" || $type == "debit_note") {
            $qry = "SELECT IFNULL(b.name,'Set Cash Ledger') as ledger,IFNULL(a.godown_id,0) as godown,a.* from set_billtype as a left join acc_ledgers as b on b.id= a.cash where a.transaction='" . $type . "' and is_pos=0 ".$br_txt."  order by a.id asc";
        }
		$option = '';
       
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        foreach ($result as $row) {
            $is_active = 1;
            if(isset($row["is_active"])){
                $is_active = $row["is_active"];
            }
            if ($no == 0) {
                $option = '<option  branch_id= "' . $row['branch_id'] . '" is_active= "' . $is_active . '"  set_rate= "' . $row["set_rate"] . '"  ledger="' . $row["ledger"] . '"  godown="' . $row["godown"] . '"  seperator="' . $row["seperator"] . '"  suffix="' . $row["suffix"] . '" preffix="' . $row["preffix"] . '"    Bank="' . $row["bank"] . '"  Cash="' . $row["cash"] . '" value="' . $row["id"] . '">' . $row["type"] . '</option>';
            } else {
                $option .= '<option  branch_id= "' . $row['branch_id'] . '" is_active= "' . $is_active . '"  set_rate= "' . $row["set_rate"] . '" ledger="' . $row["ledger"] . '" godown="' . $row["godown"] . '" seperator="' . $row["seperator"] . '"  suffix="' . $row["suffix"] . '"  preffix="' . $row["preffix"] . '"  Bank="' . $row["bank"] . '"  Cash="' . $row["cash"] . '" value="' . $row["id"] . '">' . $row["type"] . '</option>';
            }
            $no++;
        }


        // if (ucfirst( $utype) != "Admin") {
        // }else{
        //     $option = '<option value= "" >all</option>'.$option;

        // }
        
        print_r($option);
    }

    function billtypes($type) {
        $qry = "select a.* from set_billtype as a where transaction='" . $type . "' order by id asc";
		
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value = ""> Select </option>';

        foreach ($result as $row) {

            $option .= '<option value="' . $row["id"] . '">' . $row["type"] . '</option>';
        }
        print_r($option);
    }

    function currency() {
        $qry = "select * from currency_tbl";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';

        foreach ($result as $row) {

            $option .= '<option crr_tx=' . $row["is_tax"] . '  crr_value = ' . $row["crr_value"] . ' value="' . $row["crr_id"] . '">' . $row["crr_name"] . '</option>';
        }
        print_r($option);
    }

    function Doctor() {
        $qry = "select * from cli_doctor";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Doc_Id"] . '">' . $row["Doc_Name"] . '</option>';
        }
        print_r($option);
    }

    function Intervel() {
        $qry = "select *,CONCAT(a.Intervell,' min') as label from cli_time_intervell as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Ti_id"] . '">' . $row["label"] . '</option>';
        }
        print_r($option);
    }

    function costcenter() {
        $ls = ' cost_name as label';
        if ($this->multiple != 0) {
            $ls = " concat(cast(a.`name_lan` as char),' ',' ',a.cost_name) as label";
        }
        $qry = "select $ls,a.* from cost_centre as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cost_id"] . '">' . $row["label"] . '</option>';
        }
        print_r($option);
    }

    function analyticscenter() {
        $qry = "select * from analytics_center as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["any_id"] . '">' . $row["any_name"] . '</option>';
        }
        print_r($option);
    }

    function branch() {
        $qry = "select * from company_branch as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value="">All</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["brc_id"] . '">' . $row["brc_name"] . '</option>';
        }
        print_r($option);
    }

    function Cat() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $query_brc = "SELECT branch FROM `users` WHERE Id=" . $userid;
        $exec = $this->db->query($query_brc);
        $branch = $exec->row()->branch;
        $qry = "select * from company_branch";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            if ($row['brc_id'] == $branch) {
                $option .= '<option value="' . $row["brc_id"] . '" selected="selected">' . $row["brc_name"] . '</option>';
            } else {
                $option .= '<option value="' . $row["brc_id"] . '">' . $row["brc_name"] . '</option>';
            }
        }
        print_r($option);
    }

    function Procedure() {
        $qry = "select * from cli_procedures";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Pro_Id"] . '">' . $row["Pro_Name"] . '</option>';
        }
        print_r($option);
    }

    function Schedule($id, $date) {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $qry = "select * from cli_timeschedule where TimeSch_Id not in(SELECT `Shedule_id` from cli_booking where `Bok_Date` ='" . $date . "' and bok_id !=$id AND Cat_Id='" . $branch . "') ORDER BY `cli_timeschedule`.`Schedule_Time` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["TimeSch_Id"] . '">' . $row["Schedule_Time"] . '</option>';
        }
        print_r($option);
    }

    function godown($item_id = 0) {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        $no = 0;
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["godown_code"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function getgodown() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        $no = 0;
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["godown_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function godownjson() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function search_area($search){
        $qry = "select a.area as label,a.id from ims_area as a  where a.area like '%".$search."%' ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function area() {
        $qry = "select a.* from ims_area as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["area"] . '</option>';
        }
        print_r($option);
    }

    function route() {
        $qry = "select a.* from ims_route as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["route_name"] . '</option>';
        }
        print_r($option);
    }

    function messagetype() {
        $qry = "select a.* from sms_type as a ";
        //$qry = "select a.* from sms_type as a left join sms_msg as b on b.type_id=a.id where b.type_id is null  or b.id=" . $id;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function email_type() {
        $qry = "select a.* from email_type as a ";
        //$qry = "select a.* from sms_type as a left join sms_msg as b on b.type_id=a.id where b.type_id is null  or b.id=" . $id;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function emailtype($id) {
        $qry = "select a.* from email_type as a left join email_msg as b on b.type_id=a.id where b.type_id is null  or type_id=" . $id;
        print_r($qry);
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function vehicle() {
        $qry = "select a.*,Driver_name from ims_vehicle as a left join ims_driver as b on b.Id = a.driver ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option Vehicle_num="' . $row["Vehicle_num"] . '" driver="' . $row["Driver_name"] . '"  value="' . $row["Id"] . '">' . $row["Vehicle_num"] . '</option>';
        }
        print_r($option);
    }

    function ims_driver() {
        $qry = "select a.* from ims_driver as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["Id"] . '">' . $row["Driver_name"] . '</option>';
        }
        print_r($option);
    }

    

    function printtype($type) {
        $qry = "select a.* from set_printtype as a  ORDER BY bill_default DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function reference() {
        $qry = "select a.* from reference as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ref_id"] . '">' . $row["name"] . ' -' . $row["details"] . '</option>';
        }
        print_r($option);
    }

    function room_category() {
        $qry = "select a.* from room_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option price="' . $row["price"] . '" tax="' . $row["tax_id"] . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function member_category() {
        $qry = "select a.* from member_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function room($type) {
        $qry = " select * from room as a inner join tax as b on a.tax_id=b.id where room_type_id=" . $type;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option price="' . $row["price"] . '" taxp="' . $row["percent"] . '" tax="' . $row["tax_id"] . '" value="' . $row["id"] . '">' . $row["no"] . '</option>';
        }
        print_r($option);
    }

}
