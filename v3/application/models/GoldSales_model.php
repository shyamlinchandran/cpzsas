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

class GoldSales_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,a.*,b.name as supname';
        $this->table = 'sales as a left join suppliers as b on a.customer_id = b.id ';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','a.total','b.email', 'b.phone', 'b.name', 'a.cusname', 'a.cusdetails','a.ref_no'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
    }
   

    function where(){
        $this->wherecondition = ' where a.type = "'.$this->input->post('type').'" ';
        if($this->input->post('area') ){
            $this->wherecondition =  $this->wherecondition .' and a.area = '.$this->input->post('area');
        }
        if($this->input->post('btype') ){
            $this->wherecondition =  $this->wherecondition .' and a.bill_type = '.$this->input->post('btype');
        }
    }
    
    function zeroindex() {
        $qry = 'select * from taxgst where GST="0" limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
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

    function getSalesItems($id, $len, $size) {
        $qry ='select * from sales where sales_id = '.$id;
        $dat = $this->db->query($qry)->row_array();
        $old_pur_id = $dat['old_pur_id'];
        $qry = "select pu.invoice pinv,IFNULL(pu.total,0) purtotal,DATE_FORMAT(exp_date,'%d/%m/%Y') as expdate,br.ibr_name,a.mrp/u.base_unit_count unitrate,u.unit_count,u.unit_count as unit_counts,end_unit_kg,a.rate as discount_percentage, case when item_mrp > 0  then item_mrp  else b.MRP end as imrp,	ct.ces_percent,IFNULL(u.code,'') as ucode,g.*, h.hsncode as hsncd,a.mrp as mrps,IFNULL(u.name,'') as uname,IFNULL(u.code,'') as ucodes, a.*,b.* from sales_items as a left join item_godown as ig on ig.item_id = a.item_id and ig.batch = a.batch and ig.godown_id = a.godown left join cess_tbl as ct on ct.ces_id =a.ces inner join item as b on a.item_id= b.id left join item_brand as br on br.ibr_id = b.brand_id left join hsncode as h on h.hsnid=b.hsncode left join taxgst as g on a.tax_id=g.gstid left join units as u on u.id= a.unit_id left join purchase as pu on pu.id = ".$old_pur_id." where sales_id= $id and a.published='yes'  GROUP by sal_itms_id order by sal_itms_id desc limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getsales_ledgers($id){
		$qry = "SELECT GST,b.name,a.*,h.hsncode as hsncd FROM `sales_ledgers` as a INNER JOIN acc_ledgers as b on a.ledger_id = b.id left join hsncode as h on h.hsnid = b.hsncode left join taxgst as t on t.gstid = a.tax_id WHERE a.published ='yes' and sales_id =".$id;
		$query = $this->db->query($qry);
		return $query;
	}

    function gettaxparticulars($id) {
        $qry = "select sum(total-tax) as taxable,sum(tax) as total,GST from sales_items as a inner join taxgst as b on a.tax_id=b.gstid where a.published='yes' and a.sales_id=" . $id . " group by tax_id";
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
		//$qry = "SELECT h.hsncode,t.GST/2 as GST,sum(total-tax) as taxable,sum(tax/2) as cgst,sum(tax/2) as sgst,sum(tax) as tax from sales_items as a INNER JOIN item as b on a.item_id =b.id and a.published ='yes' left JOIN hsncode as h on h.hsnid =b.hsncode INNER JOIN taxgst as t on t.gstid =a.tax_id WHERE sales_id =".$id." GROUP by h.hsnid,t.gstid";
		$qry = "select hsncode,GST/2 as GST,sum(total-tax-itm_raw_ces) as taxable,sum(tax/2) as cgst,sum(tax/2) as sgst,sum(tax) as tax from (SELECT h.hsncode,t.GST,tax,total,b.hsncode as hsnid,t.gstid,itm_raw_ces  from sales_items as a INNER JOIN item as b on a.item_id =b.id and a.published ='yes' left JOIN hsncode as h on h.hsnid =b.hsncode INNER JOIN taxgst as t on t.gstid =a.tax_id WHERE sales_id =".$id." UNION ALL SELECT h.hsncode,tg.GST,sl.tax,sl.tax + amount,al.hsncode as hsnid,tg.gstid as total,0 as itm_raw_ces FROM `sales_ledgers` as sl  INNER JOIN taxgst as tg on  sl.tax_id = tg.gstid and sl.published ='yes' INNER JOIN acc_ledgers as al on al.id = sl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE sales_id =".$id." ) as x GROUP by hsnid,gstid";
		$result = $this->db->query($qry);
        return $result->result_array();
	}

    function getSalesItemscnt($id) {
        $qry = "select  * from sales_items as a inner join item as b on a.item_id= b.id  where a.published='yes' and sales_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
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

    function ledbalid($id) {
        $qry = 'select id,openning_bal,ref_code,type from acc_ledgers where ref_code in ("sup","cus") and ref_id = ' . $id . ' limit 1';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getSales($id) {
        $qry = "select  pu.invoice pinv,IFNULL(pu.total,0) purtotal,DATE_FORMAT(invoice_date,'%d/%m/%Y') as informatdate,DATE_FORMAT(CONVERT_TZ(a.created_date,'+00:00','+05:30'),'%d/%m/%Y-%H:%i:%S ') as crin_date,DATE_FORMAT(delivery_date,'%d-%m-%Y') as del_date,IFNULL(Vehicle_num,'') as vhl,IFNULL(ima.area,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') as areaname,IFNULL(u.user_name,'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;') as salesmanname,DATE_FORMAT(a.created_date, '%d/%m/%y %T') AS in_cdate,u.user_name as salesman_name,IFNULL(state.code,'') as custstatecode,c.code as statecode,IFNULL(const.StateName,'') as constatename,c.StateName,DATE_FORMAT(a.created_date, '%d/%m/%y %T') AS in_cdate,t.brc_name,t.brc_address,IFNULL(customer_id,0) as cusid,l.name as Bank,IFNULL(adjustment_amount,0) as adjustment,DATE_FORMAT(a.created_date, '%Y-%m-%d  %T') AS createdate,DATE_FORMAT(a.created_date, '%d/%m/%Y %H:%i:%s') AS createdat,user_name,a.type as stype,a.published as pub,IFNULL(c.StateName,'Kerala') as StateNames,IFNULL(c.code,'32') as StateCodes, DATE_FORMAT(invoice_date,'%d-%m-%Y') as in_date,  a.type as stp, a.*,b.* from sales as a  left join purchase as pu on pu.id =old_pur_id left join set_billtype as s on s.id=a.bill_type left join  company_branch as t on t.brc_id=s.branch_id left join suppliers as b on a.customer_id=b.id left join acc_ledgers as l on l.id=a.bank_id left join users as u on u.id=a.salesman left join state as c on c.StateID=b.cst left join state as const on const.StateID = a.con_state left join state on state.StateID = a.cusstate  left join ims_area as ima on ima.id = b.area left join ims_vehicle as iv on iv.Id = a.vehicle where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getformat($size) {
        $qry = "SELECT * FROM `set_printtype` as a  where a.`id`=" . $size;
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getsing($id){
        $qry = 'select a.tax_id as saletax,a.discount as discounts,DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,a.*,b.*,i.name,s.name as supname from sales as a inner join sales_items as b on a.sales_id = b.sales_id and b.published = "yes" left join item as i on i.id = b.item_id left join suppliers as s on s.id = a.customer_id where a.sales_id = '.$id;
        $sales = $this->db->query($qry)->result_array();
        $data['sales'] = $sales;

        $qry = 'select DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,a.*,b.*,i.name,s.name as supname from purchase as a inner join purchase_items as b on a.id = b.purchase_id and b.published ="yes" left join item as i on i.id = b.item_id left join suppliers as s on s.id = a.supplier_id where a.id = '.$sales[0]['old_pur_id'];
        $purchase = $this->db->query($qry)->result_array();
        $data['purchase'] = $purchase;

        echo json_encode($data);


    }

    function save_return(){
        $cusname = $this->input->post('cusname');
        $cusdetails = $this->input->post('cusdetails');
        $con_contact = $this->input->post('con_contact');
        if($cusname ==''){
            $cusname = $this->input->post('customername');
        }
        $id = $this->input->post('id');
        $tax_id = $this->input->post('tax_id');
        $date = $this->input->post('date');
        $saleTax = $this->input->post('saleTax');
        $salesTot = $this->input->post('salesTot');
        $date = $this->getDate($date);
        $cash_type = $this->input->post('cash_type');
        $btype = $this->input->post('btype');
        $customer_id = $this->input->post('customer_id');
        $customername = $this->input->post('customername');
        $area = $this->input->post('area');
        $discount =  $this->input->post('discount');
        if($discount == ''){
            $discount = 0;
        }
        $salesman = $this->input->post('salesman');
        $data = array(
            'cusname'=>$cusname,
            'con_contact'=>$con_contact,
            'cusdetails'=>$cusdetails,
            'type'=>'sales_return',
            'invoice_date'=>$date,
            'tax'=>$saleTax,
            'discount'=>$discount,
            'total'=>$salesTot,
            'customer_id'=>$customer_id,
            'tax_id'=>$tax_id,
            'cash_type'=>$cash_type,
            'salesman'=>$salesman,
            'area'=>$area
        );
        if ($id == 0) {
            $invoice = $this->getinoviceno($btype);
            $data['invoice']= $invoice;
            $data['bill_type']= $btype;
            $this->db->insert('sales',$data);
            $insert_id = $this->db->insert_id();
        }else{
            $this->db->where('sales_id',$id);
            $this->db->update('sales',$data);
            $qry = "select * from sales where sales_id = ".$id;
            $sales_data = $this->db->query($qry)->row_array();
            $invoice = $sales_data['invoice'];
            $data['invoice']= $invoice;
            $insert_id = $id;
            $ttp = 'dt';
            $this->restore_godown_stock($id, $ttp);
            $or_type = 'sales';
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
        $or_type = 'sales_return';

        $data['narration'] = 'Invoice :'.$invoice;
        if($cash_type == 'Cash'){
            $toid = 1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, 1, $data['invoice_date'], $data['total'], '0.00', $data['narration'], 1, 1, 1);
        }else if($cash_type =='Credit'){
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], $data['total'],'0.00', $data['narration'], 1, 1, 1);
            $this->addAgeing($insert_id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), $data['total'],0 , 0, 0, 0);

        }else if($cash_type == 'Bank'){
            $toid = 1;
            $Qry = 'select a.* ,b.id as ledid from  bank  as a inner join acc_ledgers as b on a.id = b.ref_id and ref_code = "Bank" ' ;
            $bank = $this->db->query($Qry);
            if($bank->num_rows() > 0 ){
                $bank = $bank->row_array();
                $toid =  $bank['ledid'];
                $qry = 'update sales set bank_id = '.$bank['id'].'  where sales_id = '.$insert_id;
                $this->db->query($qry);
            }
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $toid, $data['invoice_date'],  $data['total'], '0.00',$data['narration'], 1, 1, 1);
        }
        $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'],  '0.00',$data['total'], $data['narration'], 1, 1, 1);



        $saleitemid = $this->input->post('saleitemid',true);
        $salepurity = $this->input->post('salepurity',true);
        $salehudid = $this->input->post('salehudid',true);
        $salepcs = $this->input->post('salepcs',true);
        $salegrosswt = $this->input->post('salegrosswt',true);
        $salestonewt = $this->input->post('salestonewt',true);
        $salestonechg = $this->input->post('salestonechg',true);
        $salenewwt = $this->input->post('salenewwt',true);
        $salerate =  $this->input->post('salerate',true);
        $salewstg = $this->input->post('salewstg',true);
        $salemkgchg = $this->input->post('salemkgchg',true);
        $salevaper = $this->input->post('salevaper',true);
        $saleamt = $this->input->post('saleamt',true);
        $len = sizeof($saleitemid);
        for($i = 0;$i<$len;$i++){
            $data_items = array(
                'sales_id'=>$insert_id,
                'item_id'=>$saleitemid[$i],
                'quantity'=>$salepcs[$i],
                'purity'=>$salepurity[$i],
                'hudid'=>$salehudid[$i],
                'mrp'=>$salerate[$i],
                'gross_wt'=>$salegrosswt[$i],
                'stone_wt'=>$salestonewt[$i],
                'stone_charge'=>$salestonechg[$i],
                'wstge_wt'=>$salewstg[$i],
                'net_wt'=>$salenewwt[$i],
                'mkg_chg'=>$salemkgchg[$i],
                'va_per'=>$salevaper[$i],
                'total'=>$saleamt[$i],

            );
            $this->db->insert('sales_items',$data_items);
            $ttp = 'dt';
            $or_type = 'sales_return';
            $this->stock_gold_trans(0, $saleitemid[$i],$salepcs[$i],$salenewwt[$i],$salegrosswt[$i], $date, $ttp, $or_type, $data_items['sales_id'], 0, 0, 0, 1, $invoice, '');
			$this->godown_gold_stock_trans(0, $saleitemid[$i],$salepcs[$i], $ttp, $or_type, 1, 1);
        }

    }

    function save(){
        $oldPAmt = $this->input->post('oldPAmt');
        if($oldPAmt ==''){
            $oldPAmt = 0 ;
        }

        $cusname = $this->input->post('cusname');
        $cusdetails = $this->input->post('cusdetails');
        $con_contact = $this->input->post('con_contact');
        if($cusname ==''){
            $cusname = $this->input->post('customername');
        }
        $id = $this->input->post('id');
        $tax_id = $this->input->post('tax_id');
        $date = $this->input->post('date');
        $saleTax = $this->input->post('saleTax');
        $salesTot = $this->input->post('salesTot');
        $date = $this->getDate($date);
        $cash_type = $this->input->post('cash_type');
        $btype = $this->input->post('btype');
        $customer_id = $this->input->post('customer_id');
        $customername = $this->input->post('customername');
        $area = $this->input->post('area');
        $discount =  $this->input->post('discount');
        if($discount == ''){
            $discount = 0;
        }
        $salesman = $this->input->post('salesman');
        $data = array(
            'cusname'=>$cusname,
            'con_contact'=>$con_contact,
            'cusdetails'=>$cusdetails,
            'type'=>'sales',
            'invoice_date'=>$date,
            'tax'=>$saleTax,
            'discount'=>$discount,
            'total'=>$salesTot,
            'customer_id'=>$customer_id,
            'tax_id'=>$tax_id,
            'cash_type'=>$cash_type,
            'salesman'=>$salesman,
            'area'=>$area
        );
        if ($id == 0) {
            $invoice = $this->getinoviceno($btype);
            $data['invoice']= $invoice;
            $data['bill_type']= $btype;
            $this->db->insert('sales',$data);
            $insert_id = $this->db->insert_id();
        }else{
            $this->db->where('sales_id',$id);
            $this->db->update('sales',$data);
            $qry = "select * from sales where sales_id = ".$id;
            $sales_data = $this->db->query($qry)->row_array();
            $invoice = $sales_data['invoice'];
            $data['invoice']= $invoice;
            $insert_id = $id;
            $ttp = 'cr';
            $this->restore_godown_stock($id, $ttp);
            $or_type = 'sales';
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
        $or_type = 'sales';

        $data['narration'] = 'Invoice :'.$invoice;
        if($cash_type == 'Cash'){
            $toid = 1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, 1, $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1, 1, 1);
        }else if($cash_type =='Credit'){
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1, 1, 1);
            $this->addAgeing($insert_id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total']- $oldPAmt, 0, 0, 0);

        }else if($cash_type == 'Bank'){
            $toid = 1;
            $Qry = 'select a.* ,b.id as ledid from  bank  as a inner join acc_ledgers as b on a.id = b.ref_id and ref_code = "Bank" ' ;
            $bank = $this->db->query($Qry);
            if($bank->num_rows() > 0 ){
                $bank = $bank->row_array();
                $toid =  $bank['ledid'];
                $qry = 'update sales set bank_id = '.$bank['id'].'  where sales_id = '.$insert_id;
                $this->db->query($qry);
            }
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $toid, $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1, 1, 1);
        }
        $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $data['total'], '0.00', $data['narration'], 1, 1, 1);



        $saleitemid = $this->input->post('saleitemid',true);
        $salepurity = $this->input->post('salepurity',true);
        $salehudid = $this->input->post('salehudid',true);
        $salepcs = $this->input->post('salepcs',true);
        $salegrosswt = $this->input->post('salegrosswt',true);
        $salestonewt = $this->input->post('salestonewt',true);
        $salestonechg = $this->input->post('salestonechg',true);
        $salenewwt = $this->input->post('salenewwt',true);
        $salerate =  $this->input->post('salerate',true);
        $salewstg = $this->input->post('salewstg',true);
        $salemkgchg = $this->input->post('salemkgchg',true);
        $salevaper = $this->input->post('salevaper',true);
        $saleamt = $this->input->post('saleamt',true);
        $len = sizeof($saleitemid);
        for($i = 0;$i<$len;$i++){
            $data_items = array(
                'sales_id'=>$insert_id,
                'item_id'=>$saleitemid[$i],
                'quantity'=>$salepcs[$i],
                'purity'=>$salepurity[$i],
                'hudid'=>$salehudid[$i],
                'mrp'=>$salerate[$i],
                'gross_wt'=>$salegrosswt[$i],
                'stone_wt'=>$salestonewt[$i],
                'stone_charge'=>$salestonechg[$i],
                'wstge_wt'=>$salewstg[$i],
                'net_wt'=>$salenewwt[$i],
                'mkg_chg'=>$salemkgchg[$i],
                'va_per'=>$salevaper[$i],
                'total'=>$saleamt[$i],

            );
            $this->db->insert('sales_items',$data_items);
            $ttp = 'cr';
            $or_type = 'sales';
            $this->stock_gold_trans(0, $saleitemid[$i],$salepcs[$i],$salenewwt[$i],$salenewwt[$i], $date, $ttp, $or_type, $data_items['sales_id'], 0, 0, 0, 1, $invoice, '');
			$this->godown_gold_stock_trans(0, $saleitemid[$i],$salepcs[$i], $ttp, $or_type, 1, 1);
        }


        $old_pur_id = $this->input->post('old_pur_id');
        $oldPAmt = $this->input->post('oldPAmt');
        if($oldPAmt ==''){
            $oldPAmt = 0 ;
        }
        if((float) $oldPAmt > 0 ){
            $pur_data = array(
                'date'=>$date,
                'total'=>$oldPAmt,
                'supplier_id'=>$customer_id,
                'cash_type'=>$cash_type,
                'salesman'=>$salesman,
                'area'=>$area,
                'sales_refid'=>$insert_id
            );
            if($old_pur_id > 0 ){
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
                $qry = "SELECT * FROM `set_billtype` WHERE transaction = 'purchase' ";
                $bill_type_date = $this->db->query($qry)->row_array();
                $bill_type_id = $bill_type_date['id'];
                $pur_data['bill_type'] = $bill_type_id;
                $billno = $this->getpurinoviceno($bill_type_id);
                $invoice = $billno;
                $pur_data['invoice'] = $billno;
                $pur_data['bill_no'] = $billno;
                $this->db->insert('purchase',$pur_data);
                $old_pur_id = $this->db->insert_id();

            }
            $qry = 'update sales set old_pur_id = '.$old_pur_id.' where sales_id = '.$insert_id;
            $this->db->query($qry);
            $or_type = 'purchase';
            $res = $this->getLedgers($customer_id, '', ' in ("cus","sup")');
            $toid = $res['id'];
			$this->trans_save($invoice, $old_pur_id, 'purchase', $or_type, $this->purchase, $res['id'], $date, round($oldPAmt * 1, 2), '0.00', '', 1, 1, 1);
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
            $oldpuramt = $this->input->post('oldpuramt',true);
            $len = sizeof($oldpuritemid);
            for($i =0;$i<$len;$i++){
                $puritem_data = array(
                    'purchase_id'=> $old_pur_id,
                    'item_id'=>$oldpuritemid[$i],
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


    }

    function delete($id){
        $qry = 'select * from sales where sales_id = '.$id;
        $data = $this->db->query($qry)->row_array();
        $type = $data['type'];
        $old_pur_id = $data['old_pur_id'];
        if($type == 'sales'){
            $ttp = 'cr';
            $this->restore_godown_stock($id, $ttp);
            $or_type = 'sales';
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
            $qry = "delete from sales where sales_id = ".$id;
            $this->db->query($qry);
        }else if($type == 'sales_return'){
            $ttp = 'dt';
            $this->restore_godown_stock($id, $ttp);
            $or_type = 'sales';
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
            $qry = "delete from sales where sales_id = ".$id;
            $this->db->query($qry);
        }

        if($old_pur_id > 0 ){
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
                $qry = "delete from purchase where id = ".$old_pur_id;
                $this->db->query($qry);
        }
    }

    function getpurinoviceno($type) {

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

    function search_item($search,$date){
        $txt = ' CURDATE() ';
        if($date !=''){
            $txt = "'".$date."'";
        }
        if($this->input->post('type') ){
            $txtx  = ' and material_type = 2 ';
            $man = 'left';
        }else{
            $man = 'INNER';
            $txtx  = ' and material_type = 1 ';
        }
        $qry = "select i.name as label,i.*,b.gold_rate,IFNULL(b.old_gold_rate,0) as old_gold_rate from item as i ".$man." join category_rate as b on b.published ='yes' and  i.item_category_id = category_id and b.date = ".$txt."  where i.name like'%".$search."%'  ".$txtx." ";
        $data = $this->db->query($qry)->result_array();
        echo json_encode($data);
    }
}
