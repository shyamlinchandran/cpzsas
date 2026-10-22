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

	public function InsertData($comid,$table,$data){
        $this->database($comid);
		$this->db->insert($table,$data);
		return $this->db->insert_id();
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
	
public function get_item_info($comid, $page, $length) {
    $this->database($comid);
    $start = $page * $length;

    // 1. Instant total row count
    $qry = "SELECT NOW() as start, COUNT(id) as cnt FROM item";
    $res = $this->db->query($qry)->row_array();
    $data['start_time'] = $res['start'];
    $data['total_rows'] = $res['cnt'];

    // 2. Fetch only the current page of items (Removed JSON logic from SQL)
    $qry = "SELECT 
                SUM(CASE WHEN b.godown_id = 1 THEN b.open_stock ELSE 0 END) + 
                SUM(CASE WHEN b.godown_id = 1 THEN b.current_stock ELSE 0 END) as godownstock,
                SUM(b.open_stock) + SUM(b.current_stock) as global_stock, 
                a.id, a.name, a.barcode, a.free_qty, a.free_qty_for, a.part_no, 
                a.brand_id, a.item_category_id, a.item_group_id, a.sub_unit_one, 
                a.sub_unit_two, a.unit_id, a.prate, a.srate, a.special_rate2, 
                a.special_rate, a.wh_rate, a.MRP, a.tax_id, a.item_type_id, 
                a.material_type, a.cess_id, a.hsncode
            FROM item as a 
            LEFT JOIN item_godown as b ON a.id = b.item_id 
            GROUP BY a.id 
            ORDER BY a.id ASC 
            LIMIT ".$start.", ".$length;

    $result = $this->db->query($qry)->result_array();

    // If we have items on this page, fetch their images efficiently
    if (!empty($result)) {
        // Collect just the item IDs for this page (e.g., [12, 13, 14...])
        $item_ids = array_column($result, 'id');
        $ids_string = implode(',', array_map('intval', $item_ids));

        // Fetch ALL images for just these specific items in ONE quick query
        $img_qry = "SELECT iim_id, iim_type, item_id, concat('".base_url() ."','/uploads/images/item',iim_name) as image_path, updatedate 
                    FROM item_image 
                    WHERE item_id IN ($ids_string)";
        $images = $this->db->query($img_qry)->result_array();

        // Group the images by their item_id in PHP memory
        $images_by_item = [];
        foreach ($images as $img) {
            $images_by_item[$img['item_id']][] = $img;
        }

        // Map the images back to their respective items
        foreach ($result as &$row) {
            $row['images'] = isset($images_by_item[$row['id']]) ? $images_by_item[$row['id']] : [];
        }
    }

    $data['result'] = $result;

    // 3. Instant end time
    $qry = "SELECT NOW() as end";
    $res = $this->db->query($qry)->row_array();
    $data['end_time'] = $res['end'];

    return $data;
}
	
	public function get_customer_info($comid,$page,$length){
	
		$this->database($comid);
		$start = $page *  $length;
		$qry = "select NOW() as start,count(id) as cnt from (SELECT IFNULL(sum(b.tran_debit),0) - IFNULL(sum(b.tran_credit),0) + CASE WHEN a.type = 'Dr' then a.openning_bal else a.openning_bal *-1 end as balance,a.id,a.ref_id,a.ref_code from suppliers as s inner join   acc_ledgers as a on s.id = a.ref_id and ref_code in ('cus','sup') LEFT JOIN acc_ledger_trans as b on a.id = b.ledger_id and b.published ='yes' and ref_code in('cus','sup') WHERE ref_code in('cus','sup')
		GROUP by a.id) as x ";
		$res = $this->db->query($qry)->row_array();
		$qry = "SELECT IFNULL(sum(b.tran_debit),0) - IFNULL(sum(b.tran_credit),0) + CASE WHEN a.type = 'Dr' then a.openning_bal else a.openning_bal *-1 end as balance,a.id as ledgerid,a.ref_id,a.ref_code,IFNULL(s.price_list,0) as price_list,s.id,a.id as ledger_id,s.name,s.phone,s.total_points,s.redeemed_points,s.cus_agent,s.cus_salesman,s.cus_rate,s.tin,s.address_line1,s.bank,s.account_no,s.ifsc_code,s.area,s.route from  suppliers as s inner join  acc_ledgers as a on s.id = a.ref_id and ref_code in ('cus','sup') LEFT JOIN acc_ledger_trans as b on a.id = b.ledger_id and b.published ='yes' and ref_code in('cus','sup') WHERE ref_code in('cus','sup')
		GROUP by a.id order by a.id asc limit ".$start.",".$length." ";
		$result = $this->db->query($qry)->result_array();
		$data['result'] = $result ; 
		$data['start_time'] = $res['start'];
		$data['total_rows'] = $res['cnt'];
		$qry = "select NOW() as end from item order by id asc limit 0,1";
		$res = $this->db->query($qry)->row_array();
		$data['end_time'] = $res['end'];
		return $data;
	}

	public function ledgerstatement($comid,$ledger_id,$date,$end_date ){
		 $this->database($comid);
		 $qry = "SELECT IFNULL(balance,0) + case when a.`type` = 'Cr' then -1 * a.openning_bal ELSE a.openning_bal END AS balance,a.id  FROM acc_ledgers AS a LEFT JOIN (SELECT SUM(tran_debit) - SUM(tran_credit) AS balance,ledger_id FROM acc_ledger_trans WHERE published = 'yes' and tran_date < '.$date.' GROUP BY ledger_id) AS b ON a.id = b.ledger_id where  a.id = ".$ledger_id;
		 $data = $this->db->query($qry)->row_array();
		 $balance = $data['balance'];

		 $qry = 'SELECT '.$balance.' as open, a.tb_name,a.tb_id,a.tran_credit,a.tran_debit,a.tran_date,a.tran_narration,b.`name`,voucher_no FROM acc_ledger_trans AS  a INNER JOIN acc_ledgers AS b ON a.to_ledger_id = b.id WHERE a.published = "yes" and a.ledger_id = '.$ledger_id.' and a.tran_date >= "'.$date.'" and a.tran_date <= "'.$end_date.'" order by a.tran_date asc';
		$statement = $this->db->query($qry)->result_array();
		return $statement;
	
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

	public function createArea($comid, $data){
		$this->database($comid);
		$insert_id = 0;
		$qry ="select * from ims_area where area= '".$data['area']."'  ";
		$query = $this->db->query($qry);
		if($query->num_rows()<1){
			$this->db->insert('ims_area', $data);
			$insert_id = $this->db->insert_id();
			
		}
        return $insert_id;
	}
	
	public function createcustomer($comid, $data,$customer_id = 0){
		$this->database($comid);
		if($customer_id < 1){

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

		}else{
			$this->db->where('id', $customer_id);
			$this->db->update('suppliers', $data);
			
			$insert_id = $customer_id;
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
		public function getbrand($comid){
        $this->database($comid);
		$qry = "select * from item_brand where 1";
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

	public function cash_ledger($comid){
		$this->database($comid);
		$qry = "SELECT id,name FROM acc_ledgers a WHERE acc_main_id = 4";
		$query = $this->db->query($qry);
        return $query->result_array();
	}
	public function bank_ledger($comid){
		$this->database($comid);
		$qry = "SELECT id,name FROM acc_ledgers a WHERE acc_main_id = 1";
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
		
		$isbatch = $result[0]['is_batch'];
		if( (float) $isbatch < 1 ){
			$qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and x.godown = a.godown_id HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
			$this->db->query($qry);
		}
		
		
		$txt_raw = '';
		if((float) $is_rawmaterial <  1  ){
			$txt_raw = " and b.material_type = '1' ";
		}
		$qry = "SELECT sum(case when  godown_id = ".$godown_id."  then a.open_stock+a.current_stock else 0 end) as stock,sum(a.open_stock+a.current_stock) as global_stock,a.item_id,b.name,b.barcode FROM `item_godown` as a INNER JOIN item as b on b.id=a.`item_id` where b.published = 'yes'   ".$txt_raw." group by item_id ";
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
		
		$isbatch = $result[0]['is_batch'];
		if( (float) $isbatch < 1 ){
			$qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and x.godown = a.godown_id HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
			$this->db->query($qry);
		}
		
		
		$txt_raw = ' b.published = "yes"  ';
		if((float) $is_rawmaterial <  1  ){
			$txt_raw = $txt_raw . " and b.material_type = '1' ";
		}
		$price_list = 0 ;
        $qry = "SELECT Globalstock as global_stock, IFNULL(h.hsncode,'') as hsncodename,IFNULL(plist.price_discount,0) as price_discount,IFNULL(plist.sales_rate,0) as price_list_rate,IFNULL(plist.price_list_id,0) as price_list_id,ic.name as category,b.item_category_id,sub_unit_one,sub_unit_two,IFNULL(a.godown_id,0) as itemgodownid ,b.id,b.free_qty,b.free_qty_for,b.part_no,b.make_model,b.item_size_id,b.brand_id,b.barcode,b.price_code,b.item_category_id,b.item_group_id,b.unit_id,b.prate,b.srate,b.wh_rate,b.special_rate2,b.special_rate,b.MRP,b.open_stk_rate,b.commission,b.tax_id,b.tax_ledger_id,b.tax_sales_id,b.tax_purchase_id,b.published,b.hsncode,b.item_type_id,b.godown,b.description,b.mfg_date,b.exp_date,b.updatedate,b.cess_id,b.name,c.ces_name,IFNULL(c.ces_id,0) as ces_id,IFNULL(c.ces_percent,0) as ces_percent,a.batch,IFNULL(a.godown_id,0) as godown_id,IFNULL(a.item_id,b.id) as item_id,IFNULL(a.item_qty,0) as item_qty,IFNULL(a.item_srate,b.srate) as item_srate,a.item_prate,a.item_whrate,a.item_mrp,a.item_opnstkrate,a.type,a.published,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.open_stock,0) + IFNULL(a.current_stock,0) as open_stock,a.updatedate FROM `item` as b  left join (SELECT SUM(open_stock) + SUM(current_stock) AS Globalstock,item_id AS it FROM item_godown GROUP BY item_id) as global on global.it = b.id left join hsncode as h on h.hsnid = b.hsncode left join price_list_items as plist on b.id= plist.item_id and plist.price_list_id = ".$price_list." left JOIN item_godown as a on b.id=a.`item_id` and a.godown_id = '" . $godownid . "' and a.current_stock+a.open_stock > 0 left join cess_tbl as c on c.ces_id=b.cess_id left join item_category as ic on b.item_category_id = ic.id  where   ".$txt_raw." ";
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
    
    $isbatch = $result[0]['is_batch'];
    if( (float) $isbatch < 1 ){
        $qry = "update item_godown as aa inner JOIN (SELECT a.id,a.current_stock,stk from item_godown as a INNER JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and x.godown = a.godown_id HAVING stk !=current_stock) as y on y.id = aa.id set aa.current_stock = stk";
        $this->db->query($qry);
    }
    
    $txt_raw = '  ';
    if((float) $is_rawmaterial <  1  ){
        $txt_raw = " and  b.material_type = '1' ";
    }

    $price_list = 0 ;
    $qry = "select Globalstock as global_stock, IFNULL(h.hsncode,'') as hsncodename,IFNULL(plist.price_discount,0) as price_discount,IFNULL(plist.sales_rate,0) as price_list_rate,IFNULL(plist.price_list_id,0) as price_list_id,ic.name as category,b.item_category_id,sub_unit_one,sub_unit_two,IFNULL(a.godown_id,0) as itemgodownid,b.id,b.free_qty,b.free_qty_for,b.part_no,b.make_model,b.item_size_id,b.brand_id,b.barcode,b.price_code,b.item_category_id,b.item_group_id,b.unit_id,b.prate,b.srate,b.wh_rate,b.special_rate2,b.special_rate,b.MRP,b.open_stk_rate,b.commission,b.tax_id,b.tax_ledger_id,b.tax_sales_id,b.tax_purchase_id,b.published,b.hsncode,b.item_type_id,b.godown,b.description,b.mfg_date,b.exp_date,b.updatedate,b.cess_id,b.name,c.ces_name,IFNULL(c.ces_id,0) as ces_id,IFNULL(c.ces_percent,0) as ces_percent,a.batch,IFNULL(a.godown_id,0) as godown_id,IFNULL(a.item_id,b.id) as item_id,IFNULL(a.item_qty,0) as item_qty,IFNULL(a.item_srate,b.srate) as item_srate,a.item_prate,a.item_whrate,a.item_mrp,a.item_opnstkrate,a.type,a.published,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.open_stock,0) + IFNULL(a.current_stock,0)  as open_stock,a.updatedate from item as b left join (SELECT SUM(open_stock) + SUM(current_stock) AS Globalstock,item_id AS it FROM item_godown GROUP BY item_id) as global on global.it=b.id left join hsncode as h on h.hsnid = b.hsncode left join price_list_items as plist on b.id= plist.item_id and plist.price_list_id = ".$price_list." left join item_godown as a on b.id =a.item_id and a.godown_id = '" . $godownid . "' and a.current_stock+a.open_stock > 0 left join cess_tbl as c on c.ces_id=b.cess_id  left join item_category as ic on b.item_category_id = ic.id  where  b.published = 'yes' and   b.updatedate > '" . $date . "'  ".$txt_raw." ";
    
    $items_result = $this->db->query($qry)->result_array();

    // Efficiently bind images only if items are returned
    if (!empty($items_result)) {
        // Collect all distinct item IDs from the result set
        $item_ids = array_column($items_result, 'id');
        $ids_string = implode(',', array_map('intval', $item_ids));

        // Single lightning-fast query to grab images with computed paths
        $img_qry = "SELECT iim_id, iim_type, item_id, iim_name, 
                           CONCAT('" . base_url() . "', 'uploads/images/item/', iim_name) as image_path, 
                           updatedate 
                    FROM item_image 
                    WHERE item_id IN ($ids_string)";
        $images = $this->db->query($img_qry)->result_array();

        // Map items by their ID in PHP memory
        $images_by_item = [];
        foreach ($images as $img) {
            $images_by_item[$img['item_id']][] = $img;
        }

        // Attach the image arrays safely back into the final rows
        foreach ($items_result as &$row) {
            $row['images'] = isset($images_by_item[$row['id']]) ? $images_by_item[$row['id']] : [];
        }
    }

    return $items_result;
}

    public function getbillnumber($comid, $device) {
        $this->database($comid);
		if( !isset($device['replacement_billtype'])){
			$qry = 'select * from set_billtype where transaction = "replacement" ';
			$replacement_billtype = $this->db->query($qry);
			if($replacement_billtype->num_rows() > 0){
				$device['replacement_billtype'] = $replacement_billtype->row_array()['id'];
			}else{
				$device['replacement_billtype'] = 0;	
			}
		}
        $qry = "select * from set_billtype where  `id` ='" . $device['sales_billtype'] . "' or  `id` ='" . $device['bill_id'] . "' or `id` ='" . $device['payment_billtype'] . "' or `id` ='" . $device['receipt_billtype'] . "' or `id` ='" . $device['estimate_billtype'] . "' or `id` ='" . $device['salereturn_billtype'] . "' or `id` ='" . $device['replacement_billtype'] . "'   or transaction not in ('sales','pay','rec','estimate','sales_return','replacement') ";
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
		if( !isset($device['replacement_billtype'])){
			$qry = 'select * from set_billtype where transaction = "replacement" ';
			$replacement_billtype = $this->db->query($qry);
			if($replacement_billtype->num_rows() > 0){
				$device['replacement_billtype'] = $replacement_billtype->row_array()['id'];
			}else{
				$device['replacement_billtype'] = 0;	
			}
		}
        $qry = "select * from set_billtype where `id` ='" . $device['sales_billtype'] . "' or `id` ='" . $device['bill_id'] . "' or `id` ='" . $device['payment_billtype'] . "' or `id` ='" . $device['receipt_billtype'] . "' or `id` ='" . $device['estimate_billtype'] . "'  or `id` ='" . $device['replacement_billtype'] . "'  or `id` ='" . $device['salereturn_billtype'] . "'  or transaction not in ('sales','pay','rec','estimate','sales_return') ";
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

    public function get_user_orders($comid,$user_id,$date){
		$this->database($comid);
        $qry = "SELECT a.updatedate,a.sales_id,a.invoice,a.invoice_date,a.bill_type,a.receipt_amount,a.discount,a.discount_per,a.`status`, a.total,a.tax,a.remarks,a.cash_type,a.saletype,a.salesman,a.created_by,a.bank_id,a.bank_pay_method  AS bank_method,case when bank_pay_method = 'card' then card_no ELSE  gpay_no  end AS bank_transaction, a.customer_id,b.`name` AS customer,b.phone,b.address_line1,b.email FROM sales AS  a  LEFT JOIN suppliers AS b ON a.customer_id = b.id WHERE a.published  ='yes'  AND a.`type` = 'estimate' AND a.salesman =".$user_id." and a.updatedate > '".$date."' ";
        $query = $this->db->query($qry)->result_array();
		//$size = sizeof($query);
		// $k = 0 ;
		// for($i=0;$i<$size;$i++){
		// 	$k++;
		// 	$data[$i] = $query[$i];
		// 	$qry = "select a.*,b.name as item_name from sales_items as a inner join item as b on a.item_id=b.id where a.published='yes' and  sales_id =".$query[$i]['sales_id'];
		// 	$data[$i]['sales_items'] = $this->db->query($qry)->result_array();;
		// }
		// if($k < 1){
		// 	$data = [];
		// }
		return $query;
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
        $qry = "select a.*,b.id as ledgerid from suppliers  as a inner join acc_ledgers as b on a.id = b.ref_id and ref_code in ('cus','sup') ";
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
		$qry = "select * from company as a where a.comkey = '".$comid."' ";
		$data = $this->db->query($qry);
		if($data->num_rows() > 0 ){
			$this->database($comid);
			$qry = "select count(*) as cnt from set_device where  dev_number='" . $dev_number . "' ";
			$query = $this->db->query($qry);
			$res = $query->row_array();
			if ($res['cnt'] == 0) {
				$qry = "insert into set_device  (com_id ,dev_number) values('" . $comid . "','" . $dev_number . "') ";
				$query = $this->db->query($qry);
				return 1;
			}else{
				return 2;
			}
		}else{
			return 0;
		}
    }
	
	public function create_executive_tracking($comid, $dev_number,$data) {
        $this->database($comid);
		$this->db->insert('executive_track', $data);
    }

	 public function createmobile_log($comid, $dev_number,$text) {
        $this->database($comid);
		$qry = "insert into mobile_log  (device_id ,text) values('" . $dev_number . "','" . $text . "') ";
        $query = $this->db->query($qry);
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
