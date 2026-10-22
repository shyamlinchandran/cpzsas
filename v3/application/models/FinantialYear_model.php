<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class FinantialYear_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        
    }

    function Syncfinantialyear($database)
    {
	  $this->sync_ledger($database,"taxgst");
	  $this->sync_ledger($database,"cess_tbl");
	  $this->sync_ledger($database,"bank");
	  $this->sync_ledger($database,"reference");
	  
	  $this->sync_additional_ledger($database); 
	  
	  $qry = "SELECT a.name,a.openning_bal,a.type,sum(tran_credit) as credit,sum(tran_debit) as debit FROM ".$database.".acc_ledgers as a INNER JOIN ".$database.".acc_ledger_trans as b on a.id=b.ledger_id WHERE b.published='yes' and a.id=1";
	  $query = $this->db->query($qry)->row_array();
	  $debit = $query['debit'];
	  $credit = $query['credit'];
	  if($query['type']=="Cr"){
		$credit = (float) $credit + (float) $query['openning_bal'];
	  }else{
		$debit = (float) $debit + (float) $query['openning_bal'];
	  }
	  $balance = (float)$debit - (float) $credit;
	  $type = $query['type'];
	  if((float) $balance <0){
		$type = 'Cr';
	  }else{
		  $type = 'Dr';
	  }
	  if($balance <0){
		$balance  = $balance  * -1;
	  }
	  $data = array(
		'openning_bal'=>$balance,
		'type'=>$type
	  );
	  $this->db->where('id',1);
	  $this->db->update('acc_ledgers',$data);
     /* $qry ="SELECT b.type as ctype,a.name as ref_name,a.type as ref_type,IFNULL(b.openning_bal,0) as openning_bal,b.type,d.balance ,IFNULL(credit,0) as credit,IFNULL(debit,0) as debit,a.* FROM ".$database.".suppliers as a INNER JOIN ".$database.".acc_ledgers as b on a.id=b.ref_id and b.ref_code in('cus','sup') left join (SELECT sum(tran_debit)-sum(tran_credit) as balance ,sum(tran_debit) as debit,sum(tran_credit) as credit, ledger_id from ".$database.".acc_ledger_trans as c WHERE c.published='yes' GROUP by c.ledger_id) as d on d.ledger_id = b.id";
      $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
            $data= array(
			'name'=>$ms['ref_name'],
			'phone'=>$ms['phone'],
			'tin'=>$ms['tin'],
			'cst'=>$ms['cst'],
			'gst'=>$ms['gst'],
			'email'=>$ms['email'],
			'address_line1'=>$ms['address_line1'],
			'address_line2'=>$ms['address_line2'],
			'details'=>$ms['details'],
			'type'=>$ms['ref_type'],
			'credit_period'=>$ms['credit_period'],
			'bank'=>$ms['bank'],
			'account_no'=>$ms['account_no'],
			'ifsc_code'=>$ms['ifsc_code'],
			'area'=>$ms['area'],
			'route'=>$ms['route']
			);
			$this->db->insert('suppliers',$data);
			$insert_id= $this->db->insert_id();
			$debit = $ms['debit'];
			$credit = $ms['credit'];
			if($ms['ctype']=="Cr"){
				$credit = (float) $credit + (float) $ms['openning_bal'];
			}else{
				$debit = (float) $debit + (float) $ms['openning_bal'];
			}
			$balance  =  (float)$debit - (float) $credit;
			$type = $ms['ctype'];
			if((float) $balance<0 ){
				$type ='Cr';
			}else if((float) $balance>0){
				$type = 'Dr';
			}
			if($balance<0){
				$balance = $balance *-1;
			}
			$ledger_data = array(
                    "name" => $ms['ref_name'],
                    "code" => $ms['phone'],
                    "ref_id" => $insert_id,
                    "ref_code" => $ms['ref_type'],
                    "is_default" => true,
                    "openning_bal" => $balance,
                    "type" => $type,
                    "published" => 'yes'
            );
			
			if($ms['ref_type'] == 'cus'){
				$ledger_data['acc_main_id']=25;
			}else{
				$ledger_data['acc_main_id']=24;
			}
			$this->db->insert('acc_ledgers', $ledger_data);
        }*/
		$this->sync_third_party($database);
		$response = array(
            'status' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
	}
	
	function sync_additional_ledger($database){
		$qry = "SELECT * FROM ".$database.".`acc_ledgers` WHERE ref_code not in ('cus','sup') and ref_code not like'%tax%' and ref_code not LIKE '%Cess%' and ref_code not LIKE '%ref%' and ref_code not LIKE '%bank%' and id >106";
		$result = $this->db->query($qry)->result_array();
		if($this->db->query($qry)->num_rows() > 0 ){
			$qry_new = "select * FROM ( select 1 as 'testdata') as x left JOIN `acc_ledgers` on 1=1";
			$query_new = $this->db->query($qry_new)->row_array();
			foreach($result as $item){
				$data = array();
				foreach($query_new as $keys => $value){
					foreach ($item as $key => $value) {
						if(isset($item[$keys] ) ){
							if($keys != 'id' && $keys!= 'openning_bal'){
								$data[$keys] =  $item[$keys];
							}
						}
					}
				}
				$this->db->insert('acc_ledgers',$data);
			}
		}
	}
	function Syncitem($database){
	   $qry = "select * from ".$database.".ims_godown";
	   $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
		   $data = array(
				'id'=>$ms['id'],
				'godown_name'=>$ms['godown_name'],
				'godown_code'=>$ms['godown_code'],
				'godown_address'=>$ms['godown_address'],
				'godown_contactno'=>$ms['godown_contactno'],
				'godown_contact_person'=>$ms['godown_contact_person'],
		   );
		   if(isset($ms['company'])){
			   $data['company'] = $ms['company'];
		   }
		   $this->db->insert('ims_godown',$data);
	   }
	   $qry ="SELECT * FROM ".$database.".hsncode ORDER by hsnid asc";
	   $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
			$data = array(
				'hsnid'=>$ms['hsnid'],
				'hsncode'=>$ms['hsncode'],
			);
	   $this->db->insert('hsncode',$data);
	   }
	   $qry ="SELECT * FROM ".$database.".item_group ORDER by id asc";
	   $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
			$data = array(
				'id'=>$ms['id'],
				'name'=>$ms['name'],
				'discount'=>$ms['discount'],
			);
			$this->db->insert('item_group',$data);
	   }
	   $qry ="SELECT * FROM ".$database.".item_category ORDER by id asc";
	   $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
			$data = array(
				'id'=>$ms['id'],
				'name'=>$ms['name'],
				'item_type_id'=>$ms['item_type_id'],
				'item_category_id'=>$ms['item_category_id'],
			);
			$this->db->insert('item_category',$data);
	   }
	   $qry ="SELECT * FROM ".$database.".units ORDER by id asc";
	   $query = $this->db->query($qry)->result_array();
	   foreach ($query as $ms) {
			$data = array(
				'id'=>$ms['id'],
				'name'=>$ms['name'],
				'unit_id'=>$ms['unit_id'],
				'code'=>$ms['code'],
				'unit_count'=>$ms['unit_count'],
			);
			$this->db->insert('units',$data);
	   }
	   $qry ="SELECT * FROM taxgst as a INNER JOIN acc_ledgers as b on b.ref_id=a.gstid and ref_code like'%tax%'"; 
	   $tax_array = $this->db->query($qry)->result_array();
	   $qry = "SELECT a.*,b.GST FROM ".$database.".`item` as a INNER JOIN ".$database.".taxgst as b on a.tax_id=b.gstid WHERE 1 order by id asc";
       $query = $this->db->query($qry)->result_array();
	    foreach ($query as $ms) {
		   $data = array(
				'name'=>$ms['name'],
				'brand_id'=>$ms['brand_id'],
				'barcode'=>$ms['barcode'],
				'item_category_id'=>$ms['item_category_id'],
				'item_group_id'=>$ms['item_group_id'],
				'unit_id'=>$ms['unit_id'],
				'rack'=>$ms['rack'],
				'prate'=>$ms['prate'],
				'srate'=>$ms['srate'],
				'wh_rate'=>$ms['wh_rate'],
				'MRP'=>$ms['MRP'],
				'published'=>'yes',
				'hsncode'=>$ms['hsncode'],
				'item_type_id'=>$ms['item_type_id'],
				'godown'=>$ms['godown'],
				'description'=>$ms['description'],
				'material_type'=>$ms['material_type'],
				'analytics_id'=>$ms['analytics_id'],
				'is_autobarcode'=>$ms['is_autobarcode'],
				'cess_id'=>$ms['cess_id']
				);
				foreach($tax_array as $tax){
					if($tax['GST']>=$ms['GST'] && $tax['GST']<=$ms['GST']){
						if($tax['ref_code']=='Tax'){
							$data['tax_id']=$tax['gstid'];
							$data['tax_ledger_id']=$tax['id'];
						}else if($tax['ref_code']=='SaleTax'){
							$data['tax_sales_id']=$tax['id'];
						}else if($tax['ref_code']=='PurTax'){
							$data['tax_purchase_id']=$tax['id'];
						}
					}
				}
				$this->db->insert('item',$data);
				$insert_id = $this->db->insert_id();
				$qry = "select * from ".$database.".item_godown where item_id=".$ms['id']." and godown_id >0 ";
				$godown_array = $this->db->query($qry)->result_array();
				foreach ($godown_array as $gdn) {
					  $godown_data = array(
							'godown_id'=>$gdn['godown_id'],
							'current_stock'=>0,
							'open_stock'=>(float)$gdn['current_stock']+(float)$gdn['open_stock'],
							'published'=>'yes',
							'item_id'=>$insert_id 
							
					  );
					  $this->db->insert('item_godown',$godown_data);
				}
	   }
	   $response = array(
            'status' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
			
    }


	function Syncitem_new($database){
	   $this->sync_master($database,"ims_godown");
	   $this->sync_master($database,"hsncode");
	   $this->sync_master($database,"item_group");
	   $this->sync_master($database,"item_category");
	   $this->sync_master($database,"units");
	  
	   $this->sync_master($database,"ims_area");
	   $this->sync_master($database,"ims_route");
	   $this->sync_master($database,"ims_driver");
	   $this->sync_master($database,"item_brand");
	   $this->sync_master($database,"item_size");
	   
	   $this->sync_master($database,"item_type");
	   $this->sync_master($database,"racks");
	   $this->sync_master($database,"state");
	   $this->sync_master($database,"cost_centre");
	   $this->sync_master($database,"analytics_center");
	   
	   $this->sync_master($database,"currency_tbl");
	   $this->sync_master($database,"coupons");
	   
	   
	   $this->sync_master($database,"users");
	   $this->sync_master($database,"company");
	   $this->sync_master($database,"menus");
	   $this->sync_master($database,"menu_to_user");
	   $this->sync_master($database,"keys");
	   $this->sync_master($database,"set_printtype");
	   $this->sync_master($database,"set_billtype");
	   $this->sync_master($database,"user_settings");
	   $this->sync_master($database,"set_device");
	   
	   
		$this->sync_item_master($database);
	   
	   $this->sync_master_subs($database,'price_list');
	   
	 /* $qry ="SELECT * FROM taxgst as a INNER JOIN acc_ledgers as b on b.ref_id=a.gstid and ref_code like'%tax%'"; 
	   $tax_array = $this->db->query($qry)->result_array();
	   $qry = "SELECT a.*,b.GST FROM ".$database.".`item` as a INNER JOIN ".$database.".taxgst as b on a.tax_id=b.gstid WHERE 1 order by id asc";
       $query = $this->db->query($qry)->result_array();
	    foreach ($query as $ms) {
		   $data = array(
				'name'=>$ms['name'],
				'brand_id'=>$ms['brand_id'],
				'barcode'=>$ms['barcode'],
				'item_category_id'=>$ms['item_category_id'],
				'item_group_id'=>$ms['item_group_id'],
				'unit_id'=>$ms['unit_id'],
				'rack'=>$ms['rack'],
				'prate'=>$ms['prate'],
				'srate'=>$ms['srate'],
				'wh_rate'=>$ms['wh_rate'],
				'MRP'=>$ms['MRP'],
				'published'=>'yes',
				'hsncode'=>$ms['hsncode'],
				'item_type_id'=>$ms['item_type_id'],
				'godown'=>$ms['godown'],
				'description'=>$ms['description'],
				'material_type'=>$ms['material_type'],
				'analytics_id'=>$ms['analytics_id'],
				'is_autobarcode'=>$ms['is_autobarcode'],
				'cess_id'=>$ms['cess_id']
				);
				foreach($tax_array as $tax){
					if($tax['GST']>=$ms['GST'] && $tax['GST']<=$ms['GST']){
						if($tax['ref_code']=='Tax'){
							$data['tax_id']=$tax['gstid'];
							$data['tax_ledger_id']=$tax['id'];
						}else if($tax['ref_code']=='SaleTax'){
							$data['tax_sales_id']=$tax['id'];
						}else if($tax['ref_code']=='PurTax'){
							$data['tax_purchase_id']=$tax['id'];
						}
					}
				}
				$this->db->insert('item',$data);
				$insert_id = $this->db->insert_id();
				$qry = "select * from ".$database.".item_godown where item_id=".$ms['id']." and godown_id >0 ";
				$godown_array = $this->db->query($qry)->result_array();
				foreach ($godown_array as $gdn) {
					  $godown_data = array(
							'godown_id'=>$gdn['godown_id'],
							'current_stock'=>0,
							'open_stock'=>(float)$gdn['current_stock']+(float)$gdn['open_stock'],
							'published'=>'yes',
							'item_id'=>$insert_id 
							
					  );
					  $this->db->insert('item_godown',$godown_data);
				}
	   }*/
	   $response = array(
            'status' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
			
    }
	
	function sync_master_subs($database,$table = 'price_list'){
		if($table == 'price_list'){
			$tablename = $database.'.'.$table;
			$qry = "select * from  ".$tablename." ";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				$query = $this->db->query($qry)->result_array();
				$qry_new = "select * FROM ( select 1 as 'testdata') as x left JOIN ".$table." on 1=1";
				$query_new = $this->db->query($qry_new)->row_array();
				$qry = "truncate ".$table ;
				$this->db->query($qry);
				foreach($query as $item){
					$data = array();
					foreach($query_new as $keys => $value){
						foreach ($item as $key => $value) {
							if(isset($item[$keys] ) ){
								$data[$keys] =  $item[$keys];
							}
						}
					}
					$this->db->insert($table,$data);
				}
			}
			
			$qry = "select * from  ".$database.".price_list_items where published ='yes' ";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				$query = $this->db->query($qry)->result_array();
				$qry_new = "select * FROM ( select 1 as 'testdata') as x left JOIN price_list_items on 1=1";
				$query_new = $this->db->query($qry_new)->row_array();
				$qry = "truncate price_list_items" ;
				$this->db->query($qry);
				foreach($query as $item){
					$data = array();
					foreach($query_new as $keys => $value){
						foreach ($item as $key => $value) {
							if(isset($item[$keys] ) ){
								if($keys != 'id'){
									$data[$keys] =  $item[$keys];
								}
							}
						}
					}
					$this->db->insert('price_list_items',$data);
				}
			}
		}
	}

	function sync_master($database,$table="hsncode"){
		$id = 0 ;	
		if($id ==0) {
			$tablename = $database.'.'.$table;
			$qry = "select * from  ".$tablename." ";
			$query = $this->db->query($qry);
			if($query->num_rows() > 0){
				$query = $this->db->query($qry)->result_array();
				$qry_new = "select * FROM ( select 1 as 'testdata') as x left JOIN `".$table."` on 1=1";
				$query_new = $this->db->query($qry_new)->row_array();
				$qry = "truncate `".$table."`" ;
				$this->db->query($qry);
				foreach($query as $item){
					$data = array();
					foreach($query_new as $keys => $value){
						foreach ($item as $key => $value) {
							if(isset($item[$keys] ) ){
								$data[$keys] =  $item[$keys];
							}
						}
					}
					$this->db->insert($table,$data);
				}
			}
		}
		
	}
	
	function sync_item_master($database,$table="item"){
		$qry = 'truncate item';
		$this->db->query($qry);
		$qry = 'truncate item_godown';
		$this->db->query($qry);
		$qry = "select * from  ".$database.".item where published = 'yes'";
		$old_item = $this->db->query($qry);
		if($old_item->num_rows() > 0 ){
			$old_item = $old_item->result_array();
			$qry = "select * FROM ( select 1 as 'testdata') as x left JOIN ".$table." on 1=1";
			$new_item = $this->db->query($qry)->row_array();
			foreach($old_item  as $item){
				$data = array();
				foreach($new_item as $keys => $value){
					foreach ($item as $key => $value) {
						if(isset($item[$keys] ) ){
							$data[$keys] =  $item[$keys];
						}
					}
				}
				$this->db->insert('item',$data);
			}
			
		}
		
		$qry = "select a.*,sum(open_stock) + sum(current_stock) as stock from  ".$database.".item_godown as a where published = 'yes' group by id";
		$old_item = $this->db->query($qry);
		if($old_item->num_rows() > 0 ){
			$old_item = $old_item->result_array();
			$qry = "select * FROM ( select 1 as 'testdata') as x left JOIN item_godown on 1=1";
			$new_item = $this->db->query($qry)->row_array();
			foreach($old_item  as $item){
				$data = array();
				foreach($new_item as $keys => $value){
					foreach ($item as $key => $value) {
						if(isset($item[$keys] ) ){
							if($keys != 'current_stock' && $keys != 'open_stock'){
								$data[$keys] =  $item[$keys];
							}
							$data['open_stock'] = $item['stock'];
						}
					}
				}
				$this->db->insert('item_godown',$data);
			}
			
		}
		
	}
	function sync_third_party($database,$table="suppliers"){
		$qry = 'truncate suppliers';
		$this->db->query($qry);
		$qry = 'delete from acc_ledgers where ref_code in ("cus","sup")';
		$this->db->query($qry);
		$this->db->query($qry);
		$tablename = $database.'.'.$table;
		$qry = "SELECT s.* from ".$database.".suppliers as s INNER JOIN ".$database.".acc_ledgers as al on s.id =al.ref_id and al.ref_code in ('sup','cus') order by s.id asc";
		$old_party = $this->db->query($qry);
		if($old_party->num_rows() > 0 ){
			$old_party  = $old_party->result_array();
			$qry = "select * FROM ( select 1 as 'testdata') as x left JOIN ".$table." on 1=1";
			$new_party = $this->db->query($qry)->row_array();
			foreach($old_party as $item){
				$data = array();
				foreach($new_party as $keys => $value){
					foreach ($item as $key => $value) {
						if(isset($item[$keys] ) ){
							$data[$keys] =  $item[$keys];
						}
					}
				}
				$this->db->insert('suppliers',$data);
				$insert_id = $this->db->insert_id();
				$qry = "select b.*,case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END as balance,b.type as cash_type from  ".$database.".acc_ledgers as b  left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from ".$database.".acc_ledger_trans as c WHERE c.published='yes' GROUP by ledger_id ) as d on d.ledger_id = b.id WHERE b.ref_code in ('cus','sup') and b.ref_id = ".$insert_id;
				$old_ledger = $this->db->query($qry);
				if($old_ledger->num_rows() > 0 ){
					$data = array();
					$old_ledger = $old_ledger->row_array();
					$qry = "select * FROM  acc_ledgers where 1";
					$new_ledger = $this->db->query($qry)->row_array();
					foreach ($new_ledger as $key => $value) {
						if((float) $old_ledger['balance'] < 0 ){
							$balance = $old_ledger['balance'] *-1;
							$tpe = 'Cr';
						}else{
							$balance = $old_ledger['balance'];
							$tpe = 'Dr';
						}
						$data['openning_bal'] = $balance;
						$data['type'] = $tpe;
						if(isset($old_ledger[$key]) ){
							if($key != 'id' && $key != 'openning_bal' && $key != 'type' ){
								$data[$key] = $old_ledger[$key];
							}
						}
					}
					$this->db->insert('acc_ledgers',$data);
				}
			}
		}
		
	}
	function sync_ledger($database,$table="reference"){
		$tablename = $database.'.'.$table;
		$qry = "select * from  ".$tablename." ";
		$query = $this->db->query($qry)->result_array();
		$qry_new = "select * FROM ( select 1 as 'testdata') as x left JOIN ".$table." on 1=1";
		$query_new = $this->db->query($qry_new)->row_array();
		$qry = "truncate ".$table ;
		$this->db->query($qry);
		if( $table== "taxgst"){
			//$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%tax%' and published ='yes' and ref_id =".$insert_id;
			$delquery = "delete from acc_ledgers WHERE ref_code LIKE '%tax%' and published ='yes' ";
			$this->db->query($delquery);
		}
		if( $table== "cess_tbl"){
			//$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%Cess%' and published ='yes' and ref_id =".$insert_id;
			$delquery = "delete from acc_ledgers WHERE ref_code LIKE '%Cess%' and published ='yes'";
			$this->db->query($delquery);
		}
		if( $table== "bank"){
			//$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%Bank%' and published ='yes' and ref_id =".$insert_id;
			$delquery = "delete from acc_ledgers WHERE ref_code LIKE '%Bank%' and published ='yes'";
			$this->db->query($delquery);
		}
		if( $table== "reference"){
			//$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%ref%' and published ='yes' and ref_id =".$insert_id;
			$delquery = "delete from acc_ledgers WHERE ref_code LIKE '%ref%' and published ='yes'";
			$this->db->query($delquery);
		}
		foreach($query as $item){
			$data = array();
			foreach($query_new as $keys => $value){
				foreach ($item as $key => $value) {
					if(isset($item[$keys] ) ){
						$data[$keys] =  $item[$keys];
					}
				}
			}
			$this->db->insert($table,$data);
			$insert_id = $this->db->insert_id();
			if( $table== "taxgst"){
				$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%tax%' and published ='yes' and ref_id =".$insert_id;
				//$query = "delete from acc_ledgers WHERE ref_code LIKE '%tax%' and published ='yes' and ref_id =".$insert_id;
				//$this->db->query($query);
			}
			if( $table== "cess_tbl"){
				$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%Cess%' and published ='yes' and ref_id =".$insert_id;
				//$query = "delete from acc_ledgers WHERE ref_code LIKE '%Cess%' and published ='yes' and ref_id =".$insert_id;
				//$this->db->query($query);
			}
			if( $table== "bank"){
				$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%Bank%' and published ='yes' and ref_id =".$insert_id;
				//$query = "delete from acc_ledgers WHERE ref_code LIKE '%Bank%' and published ='yes' and ref_id =".$insert_id;
				//$this->db->query($query);
			}
			if( $table== "reference"){
				$qry = "select * from ".$database.".`acc_ledgers` WHERE ref_code LIKE '%ref%' and published ='yes' and ref_id =".$insert_id;
				//$query = "delete from acc_ledgers WHERE ref_code LIKE '%ref%' and published ='yes' and ref_id =".$insert_id;
				//$this->db->query($query);
			}
			$ledger_array = $this->db->query($qry);
			if($ledger_array->num_rows() > 0 ){
				$ledger_array = $ledger_array->result_array();
				foreach($ledger_array as $item){
					$data = array();
					foreach ($item as $key => $value) {
						if($key != 'id' && $key != 'openning_bal'){
							$data[$key] = $item[$key];
						}
						if($key == 'openning_bal' && $table== "bank" ){
							$qrys = "SELECT sum(tran_debit) -sum(tran_credit) + case WHEN al.type = 'Dr' then openning_bal else openning_bal*-1 end as open from ".$database.".acc_ledgers as al left JOIN ".$database.".acc_ledger_trans as alt on alt.ledger_id =al.id and alt.published ='yes' WHERE al.ref_code = 'Bank' and id = ".$item['id']." ";
							$querys = $this->db->query($qrys);
							if($querys->num_rows() > 0 ){
								$querys  = $querys->row_array();
								$data['openning_bal'] = $querys['open'];
							}
						}
					}
					$this->db->insert('acc_ledgers',$data);
				}
			}
			
			
		}
		
	}
   
}
                   