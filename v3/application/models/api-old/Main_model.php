<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Main_model
 *
 * @author jijodileep
 */
require_once 'Base_model.php';

class Main_model extends Base_model {

    //put your code here
	
	public function getcompany_details($comid){
		$result = $this->getcompany_database($comid);
		return $result;
	}
    public function get_aeging($comid,$ledger_id,$type) {
        $this->database($comid);
		$text = ' HAVING debit > 0 ';
		if($type == 'pay'){
			$text = ' HAVING credit > 0 ';
		}
        $qry = 'select 0 as lastpaid ,DATE_FORMAT(tb_crdate, "%d/%m/%Y" ) as tb_crdate,tb_name,tb_id, age_id,voucher_no,paid,balance,last_paid, `tb_name`,`tb_crdate`, CASE WHEN `credit` <>0 THEN credit -`paid` ELSE 0 END AS credit , CASE WHEN `debit` <>0 THEN debit -`paid` ELSE 0 END AS debit from `acc_ageing` as a inner join acc_ledgers as b on a.`led_id` =b.id where ( select CASE WHEN `credit` <>0 THEN credit -`paid` ELSE debit -`paid` END AS credit )!=0 and a.status!=5 and a.led_id ='.$ledger_id.' '.$text.' order by b.id desc';
        $query = $this->db->query($qry);
        return $query->result_array();
    }
	
	 public function getcompany($comid,$branch) {
        $this->database($comid);
        $qry = "SELECT b.brc_address as address,a.com_id,a.name,a.comkey,a.is_multiplegodown,a.phone,a.tin,a.details,a.menutype,a.company_master,a.email,a.name_lan,a.address_lan,a.updatedate FROM `company` as a left join company_branch as b on b.brc_id='".$branch."' WHERE 1";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
	
	public function save_user_location($comid, $data){
		$this->database($comid);
		$this->db->insert('user_location',$data);
	}
	
	public function company_settings($comid) {
        $this->database($comid);
        $qry = "select * from company";
		$result = $this->db->query($qry)->result_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[0][$item['key']] = $item['value'];
			}
		}
		$result[0]['paper_orientation'] = 'P';
		return $result;
    }
	
	public function createcustomer($comid, $data){
		$this->database($comid);
		$insert_id = 0;
		$qry ="select * from suppliers where name= '".$data['name']."' and tin='".$data['tin']."' ";
		$query = $this->db->query($qry);
		if($query->num_rows()<1){
			$this->db->insert('suppliers', $data);
			$insert_id = $this->db->insert_id();
			$ledger_data = array(
				"name" => $data['name'],
				"code" => $data['phone'],
				"ref_id" => $insert_id,
				"ref_code" => $data['type'],
				"is_default" => true,
				"openning_bal" => 0,
			"published" => 'yes'
			);
			if($data['type'] == 'cus'){
				$ledger_data['acc_main_id'] = 25;
				$ledger_data['type'] ='Dr' ;
			}else{
				$ledger_data['acc_main_id'] = 24;
				$ledger_data['type'] = 'Cr';
			}
			$this->db->insert('acc_ledgers', $ledger_data);
		}
        return $insert_id;
	}
	public function getarea($comid){
        $this->database($comid);
		$qry = "select * from ims_area where 1";
        $query = $this->db->query($qry);
        return $query->result_array();
	}
	public function getcategory($comid){
        $this->database($comid);
		$qry = "select * from item_category where 1";
        $query = $this->db->query($qry);
        return $query->result_array();
	}

    public function getdevice($comid, $dev_number) {
        $this->database($comid);
        $qry = "select * from set_device where dev_number='" . $dev_number . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }
	public function customerbalance($comid,$id){
		$this->database($comid);
		$qry = "SELECT b.*,b.type as cash_type,CASE when b.type='Dr' then b.openning_bal else -1*openning_bal end as balance FROM `suppliers` as a INNER JOIN acc_ledgers as b on a.id=b.ref_id and ref_code in ('cus','sup') and a.id ='".$id."' WHERE 1 ";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	public function customer_balance($comid,$date =''){
		$this->database($comid);
		$qry = "select b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from  acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE 1  ";
		if($date != ''){
			//$qry = "select d.updatedate,b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from acc_ledgers as b left join ( select MAX(updatedate) as updatedate,sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE CASE WHEN d.updatedate IS NOT null and d.updatedate > '".$date."' then 1 else 0 end > 0 or b.updatedate > '".$date."' ";
			$qry = "select b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from  acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE 1  ";

		}
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	
	public function getitemstock($godown_id,$date,$comid){
		$this->database($comid);
		$qry = "select * from company";
		$result = $this->db->query($qry)->result_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[0][$item['key']] = $item['value'];
			}
		}
		$is_rawmaterial = 1 ;
		if(isset($result[0]['is_rawmaterial'] ) ){
			$is_rawmaterial = $result[0]['is_rawmaterial'];
		}
		$txt_raw = '';
		if((float) $is_rawmaterial <  1  ){
			$txt_raw = " and b.material_type = '1' ";
		}
		$qry = "SELECT sum(a.open_stock+a.current_stock) as stock,a.item_id,b.name,b.barcode FROM `item_godown` as a INNER JOIN item as b on b.id=a.`item_id` where godown_id = ".$godown_id."  ".$txt_raw." group by item_id ";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	
	public function price_list_details($comid){
		$this->database($comid);
		$qry = "SELECT * FROM price_list as a INNER join `price_list_items` as b on a.id = b.price_list_id and b.published ='yes'";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	
	public function get_price_list($comid){
		$this->database($comid);
		$qry = "SELECT * FROM price_list as a";
		$query = $this->db->query($qry);
        return $query->result_array();
	}

    public function getitems($comid, $godownid) {
        $this->database($comid);
		$qry = "select * from company";
		$result = $this->db->query($qry)->result_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[0][$item['key']] = $item['value'];
			}
		}
		$is_rawmaterial = 1 ;
		if(isset($result[0]['is_rawmaterial'] ) ){
			$is_rawmaterial = $result[0]['is_rawmaterial'];
		}
		$txt_raw = ' 1 ';
		if((float) $is_rawmaterial <  1  ){
			$txt_raw = "  b.material_type = '1' ";
		}
		$price_list = 0 ;
        $qry = "SELECT IFNULL(h.hsncode,'') as hsncodename,IFNULL(plist.price_discount,0) as price_discount,IFNULL(plist.sales_rate,0) as price_list_rate,IFNULL(plist.price_list_id,0) as price_list_id,ic.name as category,b.item_category_id,sub_unit_one,sub_unit_two,IFNULL(a.godown_id,0) as itemgodownid ,b.id,b.free_qty,b.free_qty_for,b.part_no,b.make_model,b.item_size_id,b.brand_id,b.barcode,b.price_code,b.item_category_id,b.item_group_id,b.unit_id,b.prate,b.srate,b.wh_rate,b.special_rate,b.MRP,b.open_stk_rate,b.commission,b.tax_id,b.tax_ledger_id,b.tax_sales_id,b.tax_purchase_id,b.published,b.hsncode,b.item_type_id,b.godown,b.description,b.mfg_date,b.exp_date,b.updatedate,b.cess_id,b.name,c.ces_name,IFNULL(c.ces_id,0) as ces_id,IFNULL(c.ces_percent,0) as ces_percent,a.batch,IFNULL(a.godown_id,0) as godown_id,IFNULL(a.item_id,b.id) as item_id,IFNULL(a.item_qty,0) as item_qty,IFNULL(a.item_srate,b.srate) as item_srate,a.item_prate,a.item_whrate,a.item_mrp,a.item_opnstkrate,a.type,a.published,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.open_stock,0) + IFNULL(a.current_stock,0) as open_stock,a.updatedate FROM `item` as b left join hsncode as h on h.hsnid = b.hsncode left join price_list_items as plist on b.id= plist.item_id and plist.price_list_id = ".$price_list." left JOIN item_godown as a on b.id=a.`item_id` and a.godown_id = '" . $godownid . "' and a.current_stock+a.open_stock > 0 left join cess_tbl as c on c.ces_id=b.cess_id left join item_category as ic on b.item_category_id = ic.id  where b.is_active = 1 and ".$txt_raw." ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewitems($comid, $godownid, $date) {
        $this->database($comid);
		$qry = "select * from company";
		$result = $this->db->query($qry)->result_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[0][$item['key']] = $item['value'];
			}
		}
		$is_rawmaterial = 1 ;
		if(isset($result[0]['is_rawmaterial'] ) ){
			$is_rawmaterial = $result[0]['is_rawmaterial'];
		}
		$txt_raw = '  ';
		if((float) $is_rawmaterial <  1  ){
			$txt_raw = " and  b.material_type = '1' ";
		}
        //$date = date_create($date);
        //$date = date_format($date, 'Y-m-d H:i:s');
		$price_list = 0 ;
        $qry = "select IFNULL(h.hsncode,'') as hsncodename,IFNULL(plist.price_discount,0) as price_discount,IFNULL(plist.sales_rate,0) as price_list_rate,IFNULL(plist.price_list_id,0) as price_list_id,ic.name as category,b.item_category_id,sub_unit_one,sub_unit_two,IFNULL(a.godown_id,0) as itemgodownid,b.id,b.free_qty,b.free_qty_for,b.part_no,b.make_model,b.item_size_id,b.brand_id,b.barcode,b.price_code,b.item_category_id,b.item_group_id,b.unit_id,b.prate,b.srate,b.wh_rate,b.special_rate,b.MRP,b.open_stk_rate,b.commission,b.tax_id,b.tax_ledger_id,b.tax_sales_id,b.tax_purchase_id,b.published,b.hsncode,b.item_type_id,b.godown,b.description,b.mfg_date,b.exp_date,b.updatedate,b.cess_id,b.name,c.ces_name,IFNULL(c.ces_id,0) as ces_id,IFNULL(c.ces_percent,0) as ces_percent,a.batch,IFNULL(a.godown_id,0) as godown_id,IFNULL(a.item_id,b.id) as item_id,IFNULL(a.item_qty,0) as item_qty,IFNULL(a.item_srate,b.srate) as item_srate,a.item_prate,a.item_whrate,a.item_mrp,a.item_opnstkrate,a.type,a.published,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.open_stock,0) + IFNULL(a.current_stock,0)  as open_stock,a.updatedate from item as b left join hsncode as h on h.hsnid = b.hsncode left join price_list_items as plist on b.id= plist.item_id and plist.price_list_id = ".$price_list." left join item_godown as a on b.id =a.item_id and a.godown_id = '" . $godownid . "' and a.current_stock+a.open_stock > 0 left join cess_tbl as c on c.ces_id=b.cess_id  left join item_category as ic on b.item_category_id = ic.id  where b.is_active = 1 and  b.updatedate > '" . $date . "'  ".$txt_raw." ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getbillnumber($comid, $device) {
        $this->database($comid);

        $qry = "select * from set_billtype where  `id` ='" . $device['sales_billtype'] . "' or  `id` ='" . $device['bill_id'] . "' or `id` ='" . $device['payment_billtype'] . "' or `id` ='" . $device['receipt_billtype'] . "' or `id` ='" . $device['estimate_billtype'] . "' or `id` ='" . $device['salereturn_billtype'] . "'  or transaction not in ('sales','pay','rec','estimate','sales_return') ";
        $query = $this->db->query($qry);
        $smt = $query->result_array();
        foreach ($smt as $key => $value) {
            if ($value['transaction'] == 'sales' || $value['transaction'] == 'sales_return' || $value['transaction'] == 'estimate') {
                //$qry = "select invoice from sales WHERE sales_id =(SELECT MAX(sales_id) FROM `sales` WHERE bill_type=" . $value['id'] . ")";
				$preffix = strlen($smt[$key]['preffix']) + strlen($smt[$key]['seperator']) + 1;
				$suffix = strlen($smt[$key]['suffix']) + strlen($smt[$key]['seperator']);
				$qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM sales as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,sales_id from sales as b WHERE bill_type=" . $value['id'] . " and b.published = 'yes' and b.type = '".$value['transaction']."' and b.invoice like'%".$smt[$key]['preffix']."%' ) as c on c.sales_id=a.sales_id order by top desc limit 1";   
				$query = $this->db->query($qry);
                $smts = $query->row_array();
                if ($smts['invoice'] != '') {
                    $res = str_replace($smt[$key]['preffix'], "", $smts['invoice']);
                    $res = str_replace($smt[$key]['suffix'], "", $res);
                    $res = str_replace($smt[$key]['seperator'], "", $res);
                    $res = $res + 1;
                    $smt[$key]['startnumber'] =  (string) $res;
                }
            }
			if ($value['transaction'] == 'pay' || $value['transaction'] == 'rec') {
				//$qry = "select voucher_no from voucher WHERE id =(SELECT MAX(id) FROM `voucher` WHERE bill_type=" . $value['id'] . ")";
                //$query = $this->db->query($qry);
               // $smts = $query->row_array();
               // if ($smts['voucher_no'] != '') {
                 //   $res = str_replace($smt[$key]['preffix'], "", $smts['voucher_no']);
                  //  $res = str_replace($smt[$key]['suffix'], "", $res);
                  //  $res = str_replace($smt[$key]['seperator'], "", $res);
                  //  $res = $res + 1;
                  //  $smt[$key]['startnumber'] =  (string) $res;
               // }
			
			
				$qry1 = "SELECT * FROM  set_billtype  where  id='" . $value['id'] . "'  order by id";
				$query1 = $this->db->query($qry1);
				$query1 = $query1->row_array();
				$code = $query1['startnumber'];
				$preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
				$suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
				$qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from voucher as b WHERE published='yes' and bill_type=" . $value['id'] . ") as c on"
                . " c.id=a.id order by top desc limit 1";
				$query = $this->db->query($qry);
				if ($query->num_rows() == 0) {
					$smt[$key]['startnumber'] = $code;
				} else {
					$query = $query->row_array();
					$smt[$key]['startnumber'] =  $query['top'] + 1;
				}
			
			
			
			}
        }
        return $smt;
    }

    public function getbilltype($comid, $device) {
        $this->database($comid);
        $qry = "select * from set_billtype where `id` ='" . $device['sales_billtype'] . "' or `id` ='" . $device['bill_id'] . "' or `id` ='" . $device['payment_billtype'] . "' or `id` ='" . $device['receipt_billtype'] . "' or `id` ='" . $device['estimate_billtype'] . "' or `id` ='" . $device['salereturn_billtype'] . "'  or transaction not in ('sales','pay','rec','estimate','sales_return') ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function gettransferitems($comid, $godownid, $date) {
        $this->database($comid);
        //$date = date_create($date);
        //$date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select t.item_id,t.qty,t.transfer_id,i.from_id,i.date from item_transfer_sub as t inner join item_transfer as i on t.transfer_id=i.id  where to_id ='" . $godownid . "' and i.updatedate > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
	
	
	public function getsales_orders($comid,$user_id,$date=""){
		$this->database($comid);
		$qry = "select a.*,b.*,u.user_name from sales as a left join users as u on u.Id=a.created_by inner join sales_items as b on a.sales_id=b.sales_id and a.published='yes' and b.published='yes' and a.is_assigned = '1' and a.type='estimate' and a.status!='completed' WHERE a.status!='completed' and a.type='estimate' and  a.salesman =".$user_id;
		if($date!=""){
			$qry = "select a.*,b.*,u.user_name from sales as a left join users as u on u.Id=a.created_by inner join sales_items as b on a.sales_id=b.sales_id and a.published='yes'  and b.published='yes' and a.is_assigned = '1' and a.type='estimate' and a.status!='completed' and a.updatedate > '".$date."' WHERE a.status!='completed' and a.type='estimate' and a.salesman =".$user_id;
		}
		$query = $this->db->query($qry);
       // return $query->result_array();
		$qry = "select * from sales as a where a.published='yes' and a.is_assigned = '1' and a.type='estimate' and a.status!='completed' and a.salesman =".$user_id;
		$query = $this->db->query($qry)->result_array();
		$size = sizeof($query);
		$k = 0 ;
		for($i=0;$i<$size;$i++){
			$k++;
			$data[$i] = $query[$i];
			$qry = "select a.*,b.name as item_name from sales_items as a inner join item as b on a.item_id=b.id where a.published='yes' and  sales_id =".$query[$i]['sales_id'];
			$data[$i]['sales_items'] = $this->db->query($qry)->result_array();;
		}
		if($k < 1){
			$data = [];
		}
		return $data;
	}

    public function login($comid, $dev_number, $username, $password) {
        $this->database($comid);
        $qry = "select count(*) as cnt  from users where username='" . $username . "' and AES_DECRYPT(user_password,'".$this->pass_encryption."') ='" . $password . "'";
        $query = $this->db->query($qry);
        $out = $query->row_array();
        if ($out['cnt'] == 0) {
            $res['cnt'] = 0;
            return $res;
        } else {
            $qry = "select *   from users where username='" . $username . "' and AES_DECRYPT(user_password,'".$this->pass_encryption."') ='" . $password . "'";
            $query = $this->db->query($qry);
            $res['cnt'] = $out['cnt'];
            $res['user'] = $query->row_array();
            return $res;
        }
    }
	
	 public function get_point_settings($comid) {
        $this->database($comid);
        $qry = "select * from point_settings ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getunits($comid, $dev_number) {
        $this->database($comid);
        $qry = "select IFNULL(unit_id,0) as unit_id,id,name,`code`,unit_count,published,updatedate,name_lan from units ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewunits($comid, $dev_number, $date) {
        $this->database($comid);
        $qry = "select IFNULL(unit_id,0) as unit_id,id,name,`code`,unit_count,published,updatedate,name_lan from units ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    
    /*public function getnewunits($comid, $dev_number,$date) {
        $this->database($comid);
        $qry = "select * from units ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }*/

    /*public function getnewunits($comid, $dev_number, $date) {
        $this->database($comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from units where `updatedate` > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }*/

	public function customer_points($comid){
        $this->database($comid);
		$qry = "select * from point_settings as a";
		$query = $this->db->query($qry);
		$min_points_to_reedeem = 0 ;
		$one_currency_equivalent = 0 ;
		if($query->num_rows() >  0  ){
			$query = $query->row_array();
			$min_points_to_reedeem = $query['min_point_to_redeem'];
			$one_currency_equivalent = $query['one_currency_equivalent'];
		}
		$qry = "SELECT ".$one_currency_equivalent." as one_currency_equivalent_point,".$min_points_to_reedeem." as min_points_to_reedeem,total_points - redeemed_points as customer_points,a.id,a.name from suppliers as a";
        $query = $this->db->query($qry);
        return $query->result_array();
	}
    public function getcustomer($comid, $dev_number) {
        $this->database($comid);
        $qry = "select * from suppliers ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
	
	public function getupdatedcustomer($comid, $dev_number,$date) {
        $this->database($comid);
		//$date = date_create($date);
       // $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from suppliers where updatedate > '".$date."'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function gettaxgst($comid, $dev_number) {
        $this->database($comid);
        $qry = "select a.*,b.ces_name,IFNULL(b.ces_percent,0) as ces_percent,b.ces_id from taxgst as a left join cess_tbl as b on a.cess_type = b.ces_id and 2=1 WHERE 1 ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function getnewtaxgst($comid, $dev_number,$date) {
        $this->database($comid);
        $qry = "select a.*,b.ces_name,IFNULL(b.ces_percent,0) as ces_percent,b.ces_id from taxgst as a left join cess_tbl as b on a.cess_type = b.ces_id and 2=1 WHERE 1 ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    
   /* public function getnewtaxgst($comid, $dev_number,$date) {
        $this->database($comid);
        $qry = "select * from taxgst ";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
*/
   /* public function getnewtaxgst($comid, $dev_number, $date) {
        $this->database($comid);
        $date = date_create($date);
        $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from taxgst where `updatedate` > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }
*/
    public function createdevice($comid, $dev_number) {
        $this->database($comid);
        $qry = "select count(*) as cnt from set_device where  dev_number='" . $dev_number . "' ";
        $query = $this->db->query($qry);
        $res = $query->row_array();
        if ($res['cnt'] == 0) {
            $qry = "insert into set_device  (com_id ,dev_number) values('" . $comid . "','" . $dev_number . "') ";
            $query = $this->db->query($qry);
        }
    }

    public function getledgers($comid, $type) {
        $this->database($comid);
        $qry = 'select * from ' . $type;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    public function  getnewledgers($comid, $type, $date) {
        $this->database($comid);
      //  $date = date_create($date);
       // $date = date_format($date, 'Y-m-d H:i:s');
        $qry = "select * from " . $type . " where `updatedate` > '" . $date . "'";
        $query = $this->db->query($qry);
        return $query->result_array();
    }

}
