<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dataTable
 *
 * @author u43255
 */
class DataTable extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->db->close();
        $curdb = $this->load->get_var('database');
        $config['hostname'] = $this->load->get_var('hostname');
        $config['username'] = $this->load->get_var('username');
        $config['password'] = $this->load->get_var('password');
        $config['database'] = $curdb;
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $this->load->database($config);
    }

//this is for datatable 
    var $Sale = 21;
    var $Purchas = 19;
    var $data = array(); //THIS IS USED FOR IDENTIFYING tAX
	var $cesdata = array();
    var $taxdata = array(); //THIS IS USED FOR IDENTIFYING tAX
    var $table = '';
    var $select = '';
    var $wherecondition = '';
	var $having = '';
    var $column_order = '';
    var $column_search = '';
    var $group = '';
// this is for constants
    var $cashaccount = 1;
    var $cash = 4;
    var $purchaseFr = 13;
    var $salesFr = 14;
    var $salesCoolie = 15;
    var $sales = 11;
    var $discount = 16;
    var $purchase = 10;
    var $rount = 12;
    var $finstartDate = '2016-04-01';
    var $finenddate;
    var $ref = 24;
    var $addition = 8;
    var $pass_encryption = 'securepassword2019';
    var $paytype = 1;
    var $Tax = 10;

    public function getopst($enddate, $id) {

//        $qry = "select (CASE WHEN a.trans_type = 'cr'  then a.open_stock-a.quantity
//             else a.open_stock+a.quantity end) as open,c.open_stock
//from item_ledger as a inner join item as c on c.id=a.item_id where a.published='yes' and a.id=(
//    SELECT max(b.id) FROM item_ledger as b where b.published='yes' and b.trans_date  < '" . $this->getDate($enddate) . "' and b.item_id = '" . $id . " '
//    )";
        $qry = "select IFNULL(debit,0)-IFNULL(credit,0) as open,a.open_stock from item as a left join (select IFNULL(sum(quantity),0) as credit,item_id from item_ledger as b WHERE b.published='yes' and b.trans_type='cr' and b.item_id='" . $id . " ' and b.trans_date  < '" . $this->getDate($enddate) . "') as c on a.id=c.item_id left join (select IFNULL(sum(quantity),0) as debit,item_id from item_ledger as e WHERE e.published='yes' and e.trans_type='dt' and e.item_id='" . $id . " ' and e.trans_date  < '" . $this->getDate($enddate) . "') as d on a.id=d.item_id WHERE a.id='" . $id . " '";

        $query = $this->db->query($qry)->row_array();
        if ($query == "") {
            $qry = "select open_stock,count(id)-1 as open from item where id=" . $id;
            $query = $this->db->query($qry)->row_array();
        }
        return $query;
    }


    function checkvoucherAudit($tb_id,$tb_name){
        $qry = "select * from voucherAudit where tb_id =".$tb_id."  and tb_name = '".$tb_name."' ";
        $data = $this->db->query($qry);
        if($data->num_rows() < 1){
            if($tb_name =='Purchase'){
                $qry = "select * from purchase where id = ".$tb_id." ";
                $arr =  $this->db->query($qry)->row_array();
                $audit = array(
                    'tb_id'=>$tb_id,
                    'tb_name'=>$tb_name,
                    'created_date'=>$arr['created_date'],
                    'trn_tp'=>$arr['type'],
                    'voucher_no'=>$arr['invoice'],

                    'status'=>'create',
                    'voucher_value'=>$arr['total'],
                    'last_edited_value'=>$arr['total'],
                    'sales_man'=>$arr['salesman'],
                    'agent'=>0,
                    'created_by'=>$arr['created_by'],
                    'edited_by'=>0,
                    'edited_count'=>0
                );
                $this->db->insert('voucherAudit',$audit);
            }


            if($tb_name =='Sales'){
                $qry = "select * from sales where sales_id = ".$tb_id." ";
                $arr =  $this->db->query($qry)->row_array();
                $audit = array(
                    'tb_id'=>$tb_id,
                    'tb_name'=>$tb_name,
                    'created_date'=>$arr['created_date'],
                    'trn_tp'=>$arr['type'],
                    'voucher_no'=>$arr['invoice'],

                    'status'=>'create',
                    'voucher_value'=>$arr['total'],
                    'last_edited_value'=>$arr['total'],
                    'sales_man'=>$arr['salesman'],
                    'agent'=>$arr['ref_id'],
                    'created_by'=>$arr['created_by'],
                    'edited_by'=>0,
                    'edited_count'=>0
                );
                $this->db->insert('voucherAudit',$audit);
            }

            if($tb_name =='voucher'){
                $qry = "select * from voucher where id = ".$tb_id." ";
                $arr =  $this->db->query($qry)->row_array();
                $audit = array(
                    'tb_id'=>$tb_id,
                    'tb_name'=>$tb_name,
                    'created_date'=>$arr['updatedate'],
                    'trn_tp'=>$arr['vourcher_type'],
                    'voucher_no'=>$arr['voucher_no'],

                    'status'=>'create',
                    'voucher_value'=>$arr['amount'],
                    'last_edited_value'=>$arr['amount'],
                    //'sales_man'=>$arr['salesman'],
                    //'agent'=>$arr['ref_id'],
                    'created_by'=>$arr['created_by'],
                    'edited_by'=>0,
                    'edited_count'=>0
                );
                $this->db->insert('voucherAudit',$audit);
            }

            if($tb_name =='Cheque'){
                /*$qry = "select * from voucher chqdetails chq_id = ".$tb_id." ";
                $arr =  $this->db->query($qry)->row_array();
                $audit = array(
                    'tb_id'=>$tb_id,
                    'tb_name'=>$tb_name,
                    'created_date'=>$arr['updatedate'],
                    'trn_tp'=>'Cheque',
                    'voucher_no'=>$arr['chq_no'],

                    'status'=>'create',
                    'voucher_value'=>$arr['chq_amount'],
                    'last_edited_value'=>$arr['chq_amount'],
                    //'sales_man'=>$arr['salesman'],
                    //'agent'=>$arr['ref_id'],
                    'created_by'=>$arr['collected_by'],
                    'edited_by'=>0,
                    'edited_count'=>0
                );
                $this->db->insert('voucherAudit',$audit);*/
            }


        }
    }

    function updatevoucherAudit($tb_id,$tb_name,$trn_tp,$voucher_no,$value,$date,$sales_man,$agent,$created_by){
        $qry = "update voucherAudit set edited_count = edited_count +1,sales_man = '".$sales_man."',agent = '".$agent."',edited_by = ".$created_by.",last_edited_value = '".$value."'  where tb_id = ".$tb_id."  and tb_name = '".$tb_name."' ";
        $this->db->query($qry);

    }

    
	
	function updateAuditLog_sub($desc,$newarray,$table='',$insert_id =0,$AuditLog_id =0){
		$till = '';
		foreach($newarray as $subarray){
			if($till != ''){
				$till = $till . ',';
			}
			$till = $till . '[';
			foreach ($subarray as $key => $value) {
				$till = $till . " '" . $key . "' is changed to '" . $value . "',";
			}
			$till = $till . ']';
		}
		$tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		 $data = array(
			"description" => $desc,
			"user"=>$created_by, 
			"syschange" => $till,
			"tb_name"=>$table,
			"tb_id"=>$insert_id
			);  
			if ($till) { 
				if((float) $AuditLog_id < 1 ){
					$this->db->insert('auditLog', $data);
				}else{
					$data = array(
						'syschange_sub'=>$till
					);
					$this->db->where('auditLogID',$AuditLog_id);
					$this->db->update('auditLog', $data);
				}
				
			}
	}
	

    function updateAuditLog($desc, $basearray, $newarray,$table='',$insert_id =0) {
        $till='';
        if (is_array($basearray) && (is_array($newarray))) {
            $result = array_diff($newarray, $basearray);
        }
        if (isset($result)) {
            foreach ($result as $key => $value) {
                $till = $till . " '" . $key . "' is changed to '" . $value . "',";
            }
        } else {
            if (is_array($newarray)) {
                unset($newarray['uuid']);
                foreach ($newarray as $key => $value) {
                    $till = $till . " '" . $key . "' is set to '" . $value . "',";
                }
            } else if (is_array($basearray)) {
                foreach ($basearray as $key => $value) {
                    $till = $till . " '" . $key . "' was to '" . $value . "',";
                }
            } else {
                $till = $desc;
            }
        }
        //$result = array_diff($basearray, $newarray);
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $data = array(
        "description" => $desc,
        "user"=>$created_by, 
        "syschange" => $till,
		"tb_name"=>$table,
		"tb_id"=>$insert_id
        );  
		$insert = 0;
        if ($till) { 
            $this->db->insert('auditLog', $data);
			$insert = $this->db->insert_id();
        }else if($table != 'item'){
			 $this->db->insert('auditLog', $data);
			 $insert = $this->db->insert_id();
		}
		return $insert;
    }

    public function createled($name, $code, $primary_key, $ref_code, $acc_main_id) {
        $data = array(
            "name" => $name,
            "code" => $code,
            "ref_id" => $primary_key,
            "ref_code" => $ref_code,
            "is_default" => true,
            "acc_main_id" => $acc_main_id,
            "openning_bal" => 0,
            "published" => 'yes'
        );
        $this->db->insert('acc_ledgers', $data);
        $insert_id = $this->db->insert_id();
        $this->ledgers_code($data['acc_main_id'], $insert_id);
    }

    public function getfield($table, $field, $value) {
        $new_value = $value;
        $val = $value;
        if ($field == 'tax_id') {
            if ($value == "") {
                $value = $val = 0;
            }
            $qry = "select count(gstid) as count,a.* from taxgst as a where GST='" . $value . "'";
            $query = $this->db->query($qry)->row_array();
            if (!$query['count'] == 0) {
                $value = $query['gstid'];
                $new_value = $value;
            } else {
                if ($value == 0) {
                    $sgst = 0;
                } else {
                    $sgst = $value / 2;
                }
                $qry = "insert into taxgst (cgst,sgst,igst,GST) values ('" . ($sgst) . "','" . ($sgst) . "',0,'" . $value . "')";
                $this->db->query($qry);
                $value = $this->db->insert_id();
                $new_value = $value;
                $settings = $this->getCompanySettings();
                $percent = $val;
                $name = $settings[0]['com_tax_type'] . '-' . $percent;
                $this->createled($name, $percent, $value, 'Tax', $this->Tax);
                $this->createled('Sales-' . $percent, $percent, $value, 'SaleTax', $this->Sale);
                $this->createled('Purchase-' . $percent, $percent, $value, 'PurTax', $this->Purchas);
            }

            return $new_value;
        }


        if ($field == 'godown') {
            if ($value == "") {
                $qry = "select id from ims_godown order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
                $new_value = $value;
            } else {
                $qry = "select count(id) as count,a.* from ims_godown  as a where godown_name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into ims_godown (godown_name) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }

        if ($field == 'item_type_id') {
            if ($value == 'Product' || $value == "Goods" || $value == "") {
                $qry = "select id from item_type where name ='Goods'";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
                $new_value = $value;
            }
            if ($value == 'Service' || $value = 'Services') {
                $qry = "select id from item_type where name ='Services'";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
                $new_value = $value;
            }
            return $new_value;
        }
		
		
		if ($field == 'cst') {
            if ($value == "") {
                
                $new_value = 45;
            } else {
                $qry = "select count(StateID) as count,a.* from state as a where StateName='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['StateID'];
                    $new_value = $value;
                } else {
                    $qry = "insert into state (StateName) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }
		
		if ($field == 'district') {
            if ($value == "") {
                
                $new_value = 0;
            } else {
                $qry = "select count(district_id) as count,a.* from district as a where district_name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['district_id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into district (district_name) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }
		
		

        if ($field == 'item_category_id') {
            if ($value == "") {
                $qry = "select * from item_category order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
                $new_value = $value;
            } else {
                $qry = "select count(id) as count,a.* from item_category as a where name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into item_category (name) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }
		
		if( $field == 'brand_id'){
			if ($value == "") {
               // $qry = "select * from item_brand order by ibr_id asc limit 1";
               // $query = $this->db->query($qry)->row_array();
               // $value = $query['ibr_id'];
                $new_value = 0;
            } else {
                $qry = "select count(ibr_id) as count,a.* from item_brand as a where ibr_name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['ibr_id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into item_brand (ibr_name) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
		}
		
		if( $field == 'item_size_id'){
			if ($value == "") {
                //$qry = "select * from item_size order by size_id asc limit 1";
               // $query = $this->db->query($qry)->row_array();
               // $value = $query['ibr_id'];
                $new_value = 0;
            } else {
                $qry = "select count(size_id) as count,a.* from item_size as a where size='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['size_id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into item_size (size) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
		}
		
		if( $field == 'item_color_id'){
			if ($value == "") {
                //$qry = "select * from item_color order by size_id asc limit 1";
               // $query = $this->db->query($qry)->row_array();
               // $value = $query['ibr_id'];
                $new_value = 0;
            } else {
                $qry = "select count(color_id) as count,a.* from item_color as a where color_name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['color_id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into item_color (color_name) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
		}
		
		 if ($field == 'area') {
			if ($value == "") {
                $value = $val = 0;
            }
			$qry = "select count(id) as count,a.* from ims_area as a where area='" . $value . "'";
            $query = $this->db->query($qry)->row_array();
            if (!$query['count'] == 0) {
                $value = $query['id'];
                $new_value = $value;
            } else {
				$data =array(
					'area'=>$value
				);
				$this->db->insert('ims_area',$data);
                //$qry = "insert into ims_area (area) values ('" . $value . "')";
                //$this->db->query($qry);
                $value = $this->db->insert_id();
                $new_value = $value;
            }
            return $new_value;
		}


        if ($field == 'item_group_id') {
            if ($value == "") {
                $value = $val = 0;
            }
            $qry = "select count(id) as count,a.* from item_group as a where discount='" . $value . "'";
            $query = $this->db->query($qry)->row_array();
            if (!$query['count'] == 0) {
                $value = $query['id'];
                $new_value = $value;
            } else {
                $qry = "insert into item_group (name,discount) values ('" . $value . "','" . $value . "')";
                $this->db->query($qry);
                $value = $this->db->insert_id();
                $new_value = $value;
            }
            return $new_value;
        }

        if ($field == 'unit_id') {
            if ($value == "") {
                $qry = "select * from units order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
                $new_value = $value;
            } else {
                $qry = "select count(id) as count,a.* from units as a where name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['id'];
                    $new_value = $value;
                } else {
                    $qry = "insert into units (name,code) values ('" . $value . "','" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }
        if ($field == 'hsncode') {
            if ($value == "") {
                $qry = "select * from hsncode order by hsnid asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['hsnid'];
                $new_value = $value;
            } else {
                $qry = "select count(hsnid) as count,a.* from hsncode as a where hsncode='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['hsnid'];
                    $new_value = $value;
                } else {
                    $qry = "insert into hsncode (hsncode) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $new_value = $value;
                }
            }
            return $new_value;
        }
        return $new_value;
    }

    public function getexportfield($table, $field, $value) {
        $val = $value;
        if ($field == 'tax_id') {
            if ($value == "") {
                $value = $val = 0;
            }
        }
        if (!$value == "" || $value == 0) {
            if ($field == 'godown') {
                if ($value == 0) {
                    $qry = "select id from ims_godown order by id asc limit 1";
                    $query = $this->db->query($qry)->row_array();
                    $value = $query['id'];
                } else {
                    $qry = "select count(id) as count,a.* from ims_godown  as a where godown_name='" . $value . "'";
                    $query = $this->db->query($qry)->row_array();
                    if (!$query['count'] == 0) {
                        $value = $query['id'];
                    } else {
                        $qry = "insert into ims_godown (godown_name) values ('" . $value . "')";
                        $this->db->query($qry);
                        $value = $this->db->insert_id();
                    }
                }
            }

            if ($field == 'item_type_id') {
                if ($value == 0 || $value = 'Product' || $value = "Goods") {
                    $qry = "select id from item_type where name ='Goods'";
                    $query = $this->db->query($qry)->row_array();
                    $value = $query['id'];
                }
                if ($value == 'Service' || $value = 'Services') {
                    $qry = "select id from item_type where name ='Services'";
                    $query = $this->db->query($qry)->row_array();
                    $value = $query['id'];
                }
            }

            if ($field == 'tax_id') {
                $qry = "select count(gstid) as count,a.* from taxgst as a where GST='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['gstid'];
                } else {
                    if ($value == 0) {
                        $sgst = 0;
                    } else {
                        $sgst = $value / 2;
                    }
                    $qry = "insert into taxgst (cgst,sgst,igst,GST) values ('" . ($sgst) . "','" . ($sgst) . "',0,'" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                    $settings = $this->getCompanySettings();
                    $percent = $val;
                    $name = $settings[0]['com_tax_type'] . '-' . $percent;
                    $this->createled($name, $percent, $value, 'Tax', $this->Tax);
                    $this->createled('Sales-' . $percent, $percent, $value, 'SaleTax', $this->Sale);
                    $this->createled('Purchase-' . $percent, $percent, $value, 'PurTax', $this->Purchas);
                }
            }

            if ($field == 'item_category_id') {
                if ($value == 0) {
                    $qry = "select * from item_category order by id asc limit 1";
                    $query = $this->db->query($qry)->row_array();
                    $value = $query['id'];
                } else {
                    $qry = "select count(id) as count,a.* from item_category as a where name='" . $value . "'";
                    $query = $this->db->query($qry)->row_array();
                    if (!$query['count'] == 0) {
                        $value = $query['id'];
                    } else {
                        $qry = "insert into item_category (name) values ('" . $value . "')";
                        $this->db->query($qry);
                        $value = $this->db->insert_id();
                    }
                }
            }

            if ($field == 'item_group') {
                $qry = "select count(id) as count,a.* from item_group as a where name='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['id'];
                } else {
                    $qry = "insert into item_category (name,discount) values ('" . $value . "','" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                }
            }

            if ($field == 'unit_id') {
                if ($value == 0) {
                    $qry = "select * from units order by id asc limit 1";
                    $query = $this->db->query($qry)->row_array();
                    $value = $query['id'];
                } else {
                    $qry = "select count(id) as count,a.* from units as a where name='" . $value . "'";
                    $query = $this->db->query($qry)->row_array();
                    if (!$query['count'] == 0) {
                        $value = $query['id'];
                    } else {
                        $qry = "insert into units (name,code) values ('" . $value . "','" . $value . "')";
                        $this->db->query($qry);
                        $value = $this->db->insert_id();
                    }
                }
            }


            if ($field == 'hsncode') {
                $qry = "select count(hsnid) as count,a.* from hsncode as a where hsncode='" . $value . "'";
                $query = $this->db->query($qry)->row_array();
                if (!$query['count'] == 0) {
                    $value = $query['hsnid'];
                } else {
                    $qry = "insert into hsncode (hsncode) values ('" . $value . "')";
                    $this->db->query($qry);
                    $value = $this->db->insert_id();
                }
            }
        } else {
            if ($field == 'godown') {
                $qry = "select id from ims_godown order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
            }
            if ($field == 'item_type_id') {
                $qry = "select id from item_type where name ='Goods'";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
            }
            if ($field == 'item_category_id') {
                $qry = "select * from item_category order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
            }
            if ($field == 'unit_id') {
                $qry = "select * from units order by id asc limit 1";
                $query = $this->db->query($qry)->row_array();
                $value = $query['id'];
            }
        }
        if ($value == "") {
            $value = "0";
        }
        return $value;
    }

    public function getsyncid($table, $sync_id, $id) {
        $qry = 'select ' . $id . ' as id,count(' . $id . ') as count,* from ' . $table . ' where sync_id=' . $sync_id;
        $query = $this->db->query($qry)->row_array();
        if ($query['count'] == 0) {
            $query['id'] = $sync_id;
        }
        return $query;
    }
	
    function get_url($id, $voucher_no, $trn_tp) {
        $row = "";
		if (strtolower($trn_tp) == 'man_journal' || strtolower($trn_tp) == 'man_journal' ) {
            $row = '<a href="' . base_url() . 'production/process/process_controller/edit/' . $id . '"> ' . $voucher_no . '</a> ';
		}
		if (strtolower($trn_tp) == 'transfer') {
            $row = '<a href="' . base_url() . 'master/items/ProductTransfer/' . $id . '/edit"> ' . $voucher_no . '</a> ';
		}
		if (strtolower($trn_tp) == 'damage') {
            $row = '<a href="' . base_url() . 'master/itemdamage/edit/' . $id . '"> ' . $voucher_no . '</a> ';
		}
		 if (strtolower($trn_tp) == 'stock_journal') {
            $row = '<a href="' . base_url() . 'Stock_journal/create/' . $id . '"> ' . $voucher_no . '</a> ';
		}
		 if (strtolower($trn_tp) == 'service') {
            $row = '<a href="' . base_url() . 'Services/create/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'sales') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/sales/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'sales_retu' || $trn_tp == 'sales_return') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/sales_return/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'estimate') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/estimate/' . $id . '"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'delivery_note') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/delivery_note/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'purchase') {
            $row = '<a href="' . base_url() . 'transaction/purchase/edit/purchase/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'purchase_r' || $trn_tp == 'purchase_return') {
            $row = '<a href="' . base_url() . 'transaction/purchase/edit/purchase_return/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'order') {
            $row = '<a href="' . base_url() . 'transaction/purchase/edit/order/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'journal') {
            $row = '<a href="' . base_url() . 'transaction/vouchers/journal/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'receipt') {
            $row = '<a href="' . base_url() . 'transaction/vouchers/receipt/' . $id . '"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'contra') {
            $row = '<a href="' . base_url() . 'transaction/vouchers/contra/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'payment') {
            $row = '<a href="' . base_url() . 'transaction/vouchers/payment/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'cheque') {
            $row = '<a href="' . base_url() . 'transaction/chque/create/' . $id . '/v"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'replace') {
            $row = '<a href="' . base_url() . 'Replace_items/create/' . $id . '"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'stock_update') {
            $row = '<a href="' . base_url() . 'physical_stock/create/' . $id . '"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'credit_note') {
            $row = '<a href="' . base_url() . 'transaction/Credit_Debit_Vouchers/credit/' . $id . '"> ' . $voucher_no . '</a> ';
        }
		if (strtolower($trn_tp) == 'debit_note') {
            $row = '<a href="' . base_url() . 'transaction/Credit_Debit_Vouchers/debit/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        return $row;
    }

    function addAgeing($id, $voucher_no, $tb_id, $tb_name, $tb_crdate, $tb_caldate, $led_id, $created_date, $credit, $debit, $paid, $balance, $status,$old_date = '') {
        $data = array(
            'voucher_no' => $voucher_no,
            'tb_id' => $tb_id,
            'tb_name' => $tb_name,
            'tb_crdate' => $tb_crdate,
            'tb_caldate' => $tb_caldate,
            'led_id' => $led_id,
            'created_date' => $created_date,
            'credit' => $credit,
            'debit' => $debit,
          //  'paid' => $paid,
           // 'balance' => $balance,
            //'status' => $status
			);
//        print_r($data);
        if ($id == 0) {
            $this->db->insert('acc_ageing', $data);
            $this->db->insert_id();
        } else {
			$qry = "select * from acc_ageing where tb_name = '".$tb_name."' and tb_id='".$tb_id."' ";
            if($old_date != '' ){
				$qry = "select * from acc_ageing where tb_crdate = '".$old_date."' and  tb_name = '".$tb_name."' and tb_id='".$tb_id."' ";
			}
			$query = $this->db->query($qry);
			if($query->num_rows()>0){
				$this->db->where('tb_name', $tb_name);
				$this->db->where('tb_id', $tb_id);
                if($old_date != '' ){
                    $this->db->where('tb_crdate', $old_date);
                }
				$this->db->update('acc_ageing', $data);
                $qry = 'update acc_ageing set debit = debit - return_amount where tb_name = "'.$tb_name.'" and tb_id = '.$tb_id.' ';
                $this->db->query($qry);
			}else{
				$this->db->insert('acc_ageing', $data);
			}
            
        }
    }

    function msgcheck($tb_id, $tb_name) {
        $qry = "SELECT sum(`tran_debit`) as a , sum(`tran_credit`) as b FROM `acc_ledger_trans` where `tb_id` ='" . $tb_id . "' and published='yes' and `tb_name`='" . $tb_name . "'";
        $res = $this->db->query($qry);
        $ress = $res->row_array();
        $msg = 'Saved Successfully.';
        if ($ress['a'] != $ress['b']) {
            $msg = "Error in check list";
        }
        return $msg;
    }

    function create_database($sdb_name, $sdb_username, $sdb_Password, $sdb_Server, $com_id, $primary_key) {
        $database = $this->load->get_var('database');
        $hostname = $this->load->get_var('hostname');
        $password = $this->load->get_var('password');
        $username = $this->load->get_var('username');

        $this->db->close();
        $this->load->dbutil();
        $config['hostname'] = $sdb_Server;
        $config['username'] = $sdb_username;
        $config['password'] = $sdb_Password;
        $config['database'] = $sdb_name;
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $path = FCPATH . 'sql/execute/current.sql';
        $cnt = file_get_contents($path);
        $this->load->database($config);
        $file_array = explode(';', $cnt);
        foreach ($file_array as $query) {
            $this->db->query($query);
        }
        $this->connectDb($database, $password, $username, $hostname);
    }

    function getLedbyId($id) {
        $qry = 'select * from acc_ledgers where id=' . $id;
        $query = $this->db->query($qry)->row_array();
        return $query['openning_bal'];
    }

    function gettypebyid($id) {
        $qry = 'select * from acc_ledgers where id=' . $id;
        $query = $this->db->query($qry)->row_array();
        return $query['type'];
    }

     function getCompanySettings() {
        //$qry = 'select * from company as a inner join company_settings as b on a.com_id=b.com_id limit 1';
        //$settings = $this->db->query($qry);
        //return $settings->result_array();
		$qry = "select * from company";
		$result = $this->db->query($qry)->result_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher','enquiry','lead_master')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[0][$item['key']] = $item['value'];
				if($item['key'] == 'comset_statecode'){
					$qry = "select * from state where StateID = '".$item['value']."'";
					$query = $this->db->query($qry);
					if($query->num_rows() > 0 ){
						$query = $query->row_array();
						$result[0]['statename'] = $query['StateName'];
					}else{
						$result[0]['statename'] = '';
					}
				}
			}
		}
		return $result;
    }


    function msgcheckcnt($tb_id, $tb_name) {
        $qry = "SELECT sum(`tran_debit`) as a , sum(`tran_credit`) as b FROM `acc_ledger_trans` where `tb_id` ='" . $tb_id . "' and published='yes' and `tb_name`='" . $tb_name . "'";
        $res = $this->db->query($qry);
        $ress = $res->row_array();
        $msg = 1;
        if ($ress['a'] != $ress['b']) {
            $msg = 0;
        }
        return $msg;
    }

    function _get_datatables_query() {
//add custom filter here

        $this->db->from($this->table);
        $i = 0;
		if(count($this->column_search)>0){
			foreach ($this->column_search as $item) { // loop column 
				if ($_POST['search']['value']) { // if datatable send POST for search
					if ($i === 0) { // first loop
	//$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
						$this->db->like($item, $_POST['search']['value']);
					} else {
						$this->db->or_like($item, $_POST['search']['value']);
					}

					/* if (count($this->column_search) - 1 == $i) //last loop
					$this->db->group_end(); //close bracket */
				}
				$i++;
			}
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    var $qryfrm = '';

    function getCompany() {
        $qry = 'select * from company as a  limit 1';
        $result = $this->db->query($qry)->row_array();
		$qry = "select * from `keys` where type in('general','item','sales','Purchase','company','voucher')";
		$general_settings = $this->db->query($qry)->result_array();
		foreach($general_settings as $settings){
			$type = $settings['type'];
			$company_settings = $settings['value'];
			$company_settings =json_decode($company_settings,true);
			$text = '[';
			$j =0;
			foreach($company_settings as $item){
				$result[$item['key']] = $item['value'];
				if($item['key'] == 'comset_statecode'){
					$qry = "select * from state where StateID = '".$item['value']."'";
					$query = $this->db->query($qry);
					if($query->num_rows() > 0 ){
						$query = $query->row_array();
						$result['statename'] = $query['StateName'];
						$result['statecode'] = $query['code'];
					}else{
						$result['statename'] = '';
						$result['statecode'] = $query['code'];
					}
				}
			}
		}
		return $result;
    }

    function getQueryDt() {
        if ($this->select == '') {
            $this->qryfrm = 'select * from';
        } else {
            $this->qryfrm = 'select ' . $this->select . ' from';
        }
        $this->qryfrm = $this->qryfrm . ' ' . $this->table . ' ' . $this->wherecondition;
		if(count($this->column_search)>0){
			if ($_POST['search']['value']) {
				if ($this->wherecondition == '') {
					$this->qryfrm = $this->qryfrm . ' Where ';
				} else {
					$this->qryfrm = $this->qryfrm . ' and ';
				}
				$i = 0;
				foreach ($this->column_search as $item) {

					if ($i == 0) {
						$this->qryfrm = $this->qryfrm . ' (' . $item . ' like ("%' . $_POST['search']['value'] . '%")';
					} else {
						$this->qryfrm = $this->qryfrm . ' or ' . $item . ' like ("%' . $_POST['search']['value'] . '%")';
					}
					$i++;
                
				}
				$this->qryfrm = $this->qryfrm . ')';
			}
		}
        if ($this->group != '') {
            $group = $this->group;
            $this->qryfrm = $this->qryfrm . ' group by ' . $group;
        }
		if ($this->having != '') {
            $having = $this->having;
            $this->qryfrm = $this->qryfrm . ' having ' . $having;
			$this->having = '';
        }
        /*   if (isset($this->order)) {
          $order = $this->order;
          $this->qryfrm = $this->qryfrm . ' order by ' . key($order) . ' ' . $order[key($order)];
          } */
        if (isset($_POST['order'])) {
            $order = $this->order;
            if (isset($this->column_order[$_POST['order']['0']['column']])) {
                $this->qryfrm = $this->qryfrm . ' order by ' . $this->column_order[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'];
            }
        } else {
            if (isset($this->order)) {
                $order = $this->order;
                $this->qryfrm = $this->qryfrm . ' order by ' . key($order) . ' ' . $order[key($order)];
            }
        }
    }

    function ledgers_code($acc_main_id, $primary_key) {
        $qry = "select COUNT(b.code) as count,b.code,a.code as sub_code from acc_main as a left join (SELECT acc_ledger_code as code,acc_main_id from acc_ledgers WHERE acc_main_id=" . $acc_main_id . " and id< " . $primary_key . "  order by id desc limit 1) as b on a.id=b.acc_main_id where a.id=" . $acc_main_id;
        $query = $this->db->query($qry)->row_array();
        $code = $query['sub_code'];
        $sub_code = $query['code'];
        $count = $query['count'];
        $res = "1";
        if ($count > 0) {
            $res = str_replace($code, "", $sub_code);
            $res = $res + 1;
        } else {
            $res = "1";
        }
        $sub_code = $code . $res;
        $data = array(
            'acc_ledger_code' => $sub_code);
        $this->db->where('id', $primary_key);
        $this->db->update('acc_ledgers', $data);
    }

    public function get_datatables() {
        $this->getQueryDt();
        if ($this->input->post('length') == '-1') {
            $qery = $this->qryfrm;
        } else {
            $qery = $this->qryfrm . ' limit ' . $this->input->post('start') . ',' . $this->input->post('length');
        }
        //echo $qery;
        $query = $this->db->query($qery);
        return $query->result();
    }

    public function count_filtered() {
        /*   $this->_get_datatables_query();
          $query = $this->db->get(); */
        $this->getQueryDt();
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }

    public function count_all() {
        $this->getQueryDt();
        $query = $this->db->query($this->qryfrm);
        return $query->num_rows();
    }

    /* datatable ends here */

    function getValue($key) {
        $qry = "SELECT * FROM `keys`  where `key`='" . $key . "'";
        $query = $this->db->query($qry)->row_array();
        return $query['value'];
    }

    function getLedgers($tax_id, $type, $ref_code) {
        $qry = 'select * from acc_ledgers where ref_id=' . $tax_id . " and ref_code  $ref_code and name like('%$type%')";
        $query = $this->db->query($qry)->row_array();
        return $query;
    }

    function getLedgersSing($ref_id, $ref_code) {
        $qry = 'select * from acc_ledgers where ref_id=' . $ref_id . " and ref_code='" . $ref_code . "'";
        $query = $this->db->query($qry)->row_array();
        return $query['id'];
    }

    function getbaserate($unit, $quantity, $item) {
        $qry = "select * from item where id='" . $item . "'";
		$chk = $this->db->query($qry);
		if($chk->num_rows() > 0){
			$query = $this->db->query($qry)->row_array();
			$base = $query['unit_id'];
			if ($unit != $base) {
				$i = 1;
				do {
					$i++;
					$qry = "select  * from units where id='" . $unit."'";
					$query = $this->db->query($qry);
					if($query->num_rows() > 0){
						$query = $query->row_array();
						$base_count = $query['unit_count'];
						$quantity = $quantity / $base_count;
						$unit = $query['unit_id'];
					}else{
						$base = $unit;
					}
				} while ($base != $unit);
			}
		}
        return $quantity;
    }

    function getboxrate($item_id,$mrp,$unit_id){
        $qry = "select * from item where id = ".$id;
        $item =  $this->db->query($qry)->row_array();
        $srate = $item['srate'];
        if($srate == $mrp || (float) $mrp > 1000 ){
            $qry = "select * from units where id = '".$unit_id."' " ;
            $u_data = $this->db->query($qry);
            if( $u_data->num_rows() > 0 ){
                $u_data = $u_data->row_array();
                $base_unit = $u_data['base_unit_count'];
                if((int) $base_unit >  1 ){
                    $mrp = $srate * $base_unit ;
                }
            }
        }else{
            $srate = $mrp;
        }
        return $mrp;
    }

    function getquantity($unit, $quantity, $item) {
        $qry = "select * from item where id='" . $item . "'";
		$chk = $this->db->query($qry);
		if($chk->num_rows() > 0){
			$query = $this->db->query($qry)->row_array();
			$base = $query['unit_id'];
			if ($unit != $base) {
				$i = 1;
				do {
					$i++;
					$qry = "select  * from units where id='" . $unit."'";
					$query = $this->db->query($qry);
					if($query->num_rows() > 0){
						$query = $query->row_array();
						$base_count = $query['unit_count'];
						$quantity = $quantity * $base_count;
						$unit = $query['unit_id'];
					}else{
						$base = $unit;
					}
				} while ($base != $unit);
			}
		}
        return $quantity;
    }

    function GetUserPermission($type){
        $qry = '';
        if($type == 'sales'){
            $qry = 'select * from menus where url = "transaction/sales/listall/sales" ';
        }
        if($type == 'estimate'){
            $qry = 'select * from menus where url = "transaction/sales/listall/estimate" ';
        }
        if($type == 'sales_return'){
            $qry = 'select * from menus where url = "transaction/sales/listall/estimate" ';
        }


        if($type == 'purchase'){
            $qry = 'select * from menus where url = "transaction/purchase/listall/purchase" ';
        }
        if($type == 'order'){
            $qry = 'select * from menus where url = "transaction/purchase/listall/order" ';
        }
        if($type == 'purchase_return'){
            $qry = 'select * from menus where url = "transaction/purchase/listall/purchase_return" ';
        }

        if($type == 'payment'){
            $qry = 'select * from menus where url like"%transaction%" and url like"%vouchers%" and url like"%payment%" and url like"%listall%" ';
        }

        if($type == 'receipt'){
            $qry = 'select * from menus where url like"%transaction%" and url like"%vouchers%" and url like"%receipt%" and url like"%listall%"';
        }
        if($type == 'contra'){
            $qry = 'select * from menus where url like"%transaction%" and url like"%vouchers%" and url like"%contra%" and url like"%listall%"';
        }

        if($type == 'journal'){
            $qry = 'select * from menus where url like"%transaction%" and url like"%vouchers%" and url like"%journal%" and url like"%listall%" ';
        }


        $tmp = $this->session->userdata('user');
        $utype = $tmp['utype'];
        $userid = $tmp['Id'];
        if (ucfirst($utype) != "Admin" &&  $qry  !='' ) {
            $data = $this->db->query($qry);
            if($data->num_rows() > 0 ){
                $res = $data->row_array();
                $qry = "select * from menu_to_user where menu_id = ".$res['id']." and  user_id = ".$userid." and is_write = '1' ";
                $cnt = $this->db->query($qry);
                if($cnt->num_rows() > 0 ){
                    return 1;
                }else{
                    return 0;
                }
            }else{
                return 1;
            }
        }else{
            return 1;
        }
    }

    function restoreestimate($insert_id, $txtEstimate_id) {

        $qry = "select * from sales_items where sales_id=$insert_id and published='yes'";
        $query = $this->db->query($qry)->result_array();
        foreach ($query as $ms) {
			if($ms['sales_ref_type'] == '' ){
				$qry = "update sales_items set estimate_quantity=estimate_quantity-" . $ms['quantity'] . " where published ='yes' and sales_id= " . $txtEstimate_id . " and item_id=" . $ms['item_id'];
				$this->db->query($qry);
			}else if($ms['sales_ref_type'] != 'Nil'){
				$qry = "update sales_items set estimate_quantity=estimate_quantity-" . $ms['quantity'] . " where published ='yes' and sales_id= " . $ms['sales_ref_id'] . " and item_id=" . $ms['item_id'];
				$this->db->query($qry);
			}else{
				$qry = "update sales_items set estimate_quantity=estimate_quantity-" . $ms['quantity'] . " where published ='yes' and sales_id= " . $txtEstimate_id . " and item_id=" . $ms['item_id'];
				$this->db->query($qry);
			}
        }
    }

    function restoreorder($insert_id, $txtEstimate_id) {

        $qry = "select * from purchase_items where purchase_id=$insert_id and published='yes'";
        $query = $this->db->query($qry)->result_array();
        foreach ($query as $ms) {
            $qry = "update purchase_items set order_quantity=order_quantity-" . $ms['quantity'] . " where published ='yes' and purchase_id= " . $txtEstimate_id . " and item_id=" . $ms['item_id'];
            $this->db->query($qry);
        }
    }

    function restorestock($insert_id, $type) {

        if ($type == 'pur') {
            $qry = "select * from purchase_items where purchase_id=$insert_id and published='yes'";
            $query = $this->db->query($qry)->result_array();
            foreach ($query as $ms) {
                $qry = "select * from item where id=" . $ms['item_id'];
                $q = $this->db->query($qry)->row_array();
                $base = $q['unit_id'];
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                $this->updatestock($ms['item_id'], 'cr', $qty);
            }
        } if ($type == 'sales') {
            $qry = "select * from sales_items where sales_id=$insert_id and published='yes'";
            $query = $this->db->query($qry)->result_array();
            foreach ($query as $ms) {
				if($ms['sales_ref_type']  != 'delivery_note' ){
					$qry = "select * from item where id=" . $ms['item_id'];
					$q = $this->db->query($qry)->row_array();
					$base = $q['unit_id'];
					$qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
					$this->updatestock($ms['item_id'], 'dt', $qty);
					if((int)$ms['free_quantity'] > 0 ){
						$qty = $this->getquantity($ms['unit_id'], $ms['free_quantity'], $ms['item_id']);
						$this->updatestock($ms['item_id'], 'dt', $qty);
					}
					if((int)$ms['damage_quantity'] > 0 ){
							$qty = $this->getquantity($ms['unit_id'], $ms['damage_quantity'], $ms['item_id']);
							$this->updatestock($ms['item_id'], 'dt', $qty);
					}
				}
            }
        }
        if ($type == 'damage') {
            $qry = "select * from item_damage where damage_id=$insert_id and published='yes'";
            $query = $this->db->query($qry)->result_array();
            foreach ($query as $ms) {
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                $this->updatestock($ms['item_id'], 'dt', $qty);
                $this->godown_stock_trans(0, $ms['item_id'], $qty, 'damage', 'dt', $ms['godown_id'],$ms['batch']);
            }
        }
    }

		public function getunitconversion($quantity,$base,$unit){
		if ($unit != $base) {
				$i = 1;
				do {
					$i++;
					$qry = "select  * from units where id='" . $unit."'";
					$query = $this->db->query($qry);
					if($query->num_rows() > 0){
						$query = $query->row_array();
						$base_count = $query['unit_count'];
						$quantity = $quantity * $base_count;
						$unit = $query['unit_id'];
					}else{
						$base = $unit;
					}
				} while ($base != $unit);
			}
			return $quantity;
	}
	
    function restore_godown_transfer_stock($insert_id) {
        $qry = "select * from item_transfer as a inner join item_transfer_sub  as b on a.id=b.transfer_id  where b.published='yes' and a.id=" . $insert_id;
        $query = $this->db->query($qry)->result_array();

        foreach ($query as $ms) {
			$base_unit_id = $ms['base_unit_id'];
			$unit_id = $ms['unit_id'];
			$is_unit = $ms['is_unit'];
			$quantity = $ms['qty'];
			if((int) $is_unit > 0 ){
				$quantity = $this->getunitconversion($quantity,$base_unit_id,$unit_id);
			}
            $this->godown_stock_trans(0, $ms['item_id'], $quantity, 'cr', 'item', $ms['to_id']);
            $this->godown_stock_trans(0, $ms['item_id'], $quantity, 'dt', 'item', $ms['from_id']);
        }
    }

    function restore_godown_stock_trans($insert_id, $trans_type) {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $qry = "select * from purchase_items where purchase_id=$insert_id and published='yes' ";
        $query1 = $this->db->query($qry)->result_array();
		$where_txt = '';
		$txt = '';
        foreach ($query1 as $ms) {
            if ($ms['godown'] != 0) {
				if((int) $isbatch > 0 ){
					$where_txt = ' and  batch = "'.$ms['batch'].'" ';
				}
                $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $ms['item_id'] . '  '.$where_txt.' and godown_id=' . $ms['godown'];
                $query = $this->db->query($qry)->row_array();
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
				if(isset($ms['base_free_quantity']) ){
					$qty = (float) $qty + (float) $ms['base_free_quantity'];
				}
                if ($trans_type == 'cr') {
                    $current_stock = $current_stock - $qty;
                } else {
                    $current_stock = $current_stock + $qty;
                }
				if((int) $isbatch > 0 ){
					$txt = " and batch = '".$ms['batch']."' ";
				}
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $ms['godown'] . "  ".$txt." and item_id=" . $ms['item_id'];
                $this->db->query($qry);
            }
        }
    }

    function restore_godown_stock($insert_id, $trans_type) {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
		$where_txt = '';
		$txt = '';
        $qry = "select * from sales_items where sales_id=$insert_id and published='yes' ";
        $query1 = $this->db->query($qry)->result_array();
        foreach ($query1 as $ms) {
			if($ms['sales_ref_type']  != 'delivery_note'){
				if ($ms['godown'] != 0) {
					if((int) $isbatch > 0 ){
						$where_txt = ' and  batch = "'.$ms['batch'].'" ';
					}
					$qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $ms['item_id'] . '  '.$where_txt.' and godown_id=' . $ms['godown'];
					$query = $this->db->query($qry)->row_array();
					$current_stock = $query['current_stock'];
					$oldstock = $current_stock;
					$item_quantity = (float)$ms['quantity'] + (float)$ms['free_quantity']+ (float)$ms['damage_quantity'];
					$qty = $this->getquantity($ms['unit_id'], $item_quantity, $ms['item_id']);
					if ($trans_type == 'cr') {
						$current_stock = $current_stock - $qty;
					} else {
						$current_stock = $current_stock + $qty;
					}
					if((int) $isbatch > 0 ){
						$txt = " and batch = '".$ms['batch']."' ";
					}
					$qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $ms['godown'] . "  ".$txt." and item_id=" . $ms['item_id'];
					$this->db->query($qry);
				}
			}
        }	
    }

    public function getbranch($id) {
        if ($id != "") {
            $qry = "select * from set_billtype where id=" . $id;
            $query = $this->db->query($qry)->row_array();
            return $query['branch_id'];
        } else {
            return 0;
        }
    }

    public function getMainLedegerbalance($enddate, $id, $tp) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt,b.openning_bal from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id  where  a.published ='yes' and  tran_date >=  '" . $this->finstartDate . "' and  tran_date  < '" . $this->getDate($enddate) . "' and acc_main_id =" . $id;
        } else {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt,b.openning_bal from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id where  a.published ='yes' and tran_date >=  '" . $this->finstartDate . "' and  tran_date  <= '" . $this->getDate($enddate) . "' and acc_main_id =" . $id;
        }
        $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }
    
     public function getbalance($enddate, $id, $tp, $ls = 0) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt,b.openning_bal,b.type from acc_ledgers as b  left join acc_ledger_trans  as a   on   a.ledger_id = b.id and a.published ='yes' and  a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($enddate) . "'  where    b.id =" . $id;
        } else {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt,b.openning_bal,b.type from acc_ledgers as b  left join acc_ledger_trans  as a on   a.ledger_id = b.id and   a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  <= '" . $this->getDate($enddate) . "'  where  b.id =" . $id;
        }
        $query = $this->db->query($qry)->row_array();
        if ($query['type'] == 'Cr') {
            $query['amt'] = ( $query['amt'] - $query['openning_bal']);
        } else {
            $query['amt'] = $query['amt'] + $query['openning_bal'];
        }


        return $query['amt'];
    }

    public function getLedegerbalancetest($enddate, $id, $tp, $ls = 0,$cas = 0) {
        $qry = '';
		if((float) $cas < 1 || (int)  $id > 1 ){
			$t_where = " ,b.openning_bal ";
		}else{
			$qry = "SELECT sum(CASE WHEN type = 'Cr' then -1* openning_bal else openning_bal end) as amt FROM `acc_ledgers` WHERE acc_main_id = 4";
			$q = $this->db->query($qry)->row_array();
			$t_where = ' , '.$q['amt'].'  as openning_bal ';
		}
		
        if ($tp == 'op') {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt".$t_where.",b.type from acc_ledgers AS b  left join acc_ledger_trans as a on a.ledger_id = b.id  and a.published ='yes' and  a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($enddate) . "' where    b.id =" . $id;
        } else {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt".$t_where.",b.type from acc_ledgers AS b  left join acc_ledger_trans as a on a.ledger_id = b.id and a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  <= '" . $this->getDate($enddate) . "' where    b.id =" . $id;
        }
        print_r($qry);
        $query = $this->db->query($qry)->row_array();
        if ($query['type'] == 'Cr') {
            $query['amt'] = ( $query['amt'] - $query['openning_bal']) * -1;
        } else {
            $query['amt'] = $query['amt'] + $query['openning_bal'];
        }


        return $query['amt'];
    }

   public function getLedegerbalance($enddate, $id, $tp, $ls = 0,$cas = 0) {
        $qry = '';
		if((float) $cas < 1 || (int)  $id > 1 ){
			$t_where = " ,b.openning_bal ";
		}else{
			$qry = "SELECT sum(CASE WHEN type = 'Cr' then -1* openning_bal else openning_bal end) as amt FROM `acc_ledgers` WHERE acc_main_id = 4";
			$q = $this->db->query($qry)->row_array();
			$t_where = ' , '.$q['amt'].'  as openning_bal ';
		}
		
         if ($tp == 'op') {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt".$t_where.",b.type from acc_ledgers AS b  left join acc_ledger_trans as a on a.ledger_id = b.id  and a.published ='yes' and  a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($enddate) . "' where    b.id =" . $id;
        } else {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt".$t_where.",b.type from acc_ledgers AS b  left join acc_ledger_trans as a on a.ledger_id = b.id and a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  <= '" . $this->getDate($enddate) . "' where    b.id =" . $id;
        }
        $query = $this->db->query($qry)->row_array();
        if ($query['type'] == 'Cr') {
            $query['amt'] = ( $query['amt'] - $query['openning_bal']) * -1;
        } else {
            $query['amt'] = $query['amt'] + $query['openning_bal'];
        }


        return $query['amt'];
    }

    public function getStockLedegerbalance($enddate, $item_id, $tp) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt,b.openning_bal from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id where a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($enddate) . "' and a.ledger_id =" . $id;
        } else {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt,b.openning_bal from acc_ledger_trans as a inner join acc_ledgers as b on   a.ledger_id = b.id  where a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  <= '" . $this->getDate($enddate) . "' and a.ledger_id =" . $id;
        }
        $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }

    function getDate($date, $sep = '') {
        if ($date == "") {
            return;
        }
        if ($sep == '') {
            $sep = '/';
        }
        $parts = explode($sep, $date);
        return "$parts[2]-$parts[1]-$parts[0]";
    }
	
	public function getcashaccount($id){
		if ($id != "") {
            $qry = "select * from set_billtype where id=" . $id;
            $query = $this->db->query($qry)->row_array();
            return $query['cash'];
        } else {
            return 1;
        }
	}
	
	

    function getDateapi($date, $sep = '') {
        if ($date == "") {
            return;
        }
        if ($sep == '') {
            $sep = '/';
        }
        $parts = explode($sep, $date);
        return "$parts[2]-$parts[1]-$parts[0]";
    }

    function trans_save($voucher_no, $tb_id, $tb_name, $tran_tp, $toid, $from, $date, $credit, $debit, $narration, $created_by, $costcenter, $branch = 0) {
        if ($this->session->has_userdata('user')) {
            $tmp = $this->session->userdata('user');
            $created_by = $tmp['Id'];
            // Now you can safely use $tmp
        } 
        $amt = 0;
        if (strtolower($tran_tp) == 'sales_retu' || strtolower($tran_tp) == 'sales_return' || strtolower($tran_tp) == 'purchase_r' || strtolower($tran_tp) == 'purchase_return') {
            $amt = $credit;
            $credit = $debit;
            $debit = $amt;
        }

        if ($credit > $debit) {
            $tran_amt = $credit;
        } else {
            $tran_amt = $debit;
        }
        $qry = 'insert into acc_ledger_trans (voucher_no,tb_id,cost_center,tb_name,trn_tp,to_ledger_id,ledger_id,tran_amt,tran_date,tran_debit,tran_credit,tran_narration,tran_crtd_by,tran_crtd_dt,branch_id) '
                . 'values("' . $voucher_no . '","' . $tb_id . '","' . $costcenter . '","' . $tb_name . '","' . $tran_tp . '",' . $toid . ',' . $from . ',' . $tran_amt . ',"' . $date . '",' . $debit . ',' . $credit . ',"' . $narration . '",' . $created_by . ',NOW(),' . $branch . ')';
        $this->getSaved($qry);
    }

    function getSaved($qry) {
        $this->db->trans_strict();
        $this->db->trans_begin();
        $this->db->query($qry);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        return $insert_id;
    }

    function stock_prod($id, $item_id, $quantity, $trans_date, $trans_type, $trans_status, $trans_id,$batch='') {
        $open_stock = $this->updatestock($item_id, $trans_type, $quantity);
        $data = array('item_id' => $item_id,
            'open_stock' => $open_stock,
            'quantity' => $quantity,
            'trans_date' => $trans_date,
			'batch'=> $batch,
            'trans_type' => $trans_type,
            'trans_status' => $trans_status,
            'trans_id' => $trans_id);

        $insert_id = 0;
        if ($id == 0) {
            $this->db->insert('item_ledger', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $id = $insert_id;
            $this->db->where('id', $id);
            $this->db->update('item_ledger', $data);
        }
    }

    /* stock details */

    function godown_stock_trans($id, $item_id, $quantity, $trans_type, $trans_status, $godown,$batch="",$mdate='',$edate='',$mrp = 0,$srate = 0 ,$prate= 0) {
       
        if ($godown != '') {
			$settings = $this->getCompanySettings();
			$isbatch  = $settings[0]['is_batch'];
			$where_text = ' ';
			if((int) $isbatch > 0 ){
				$where_text ='  and batch ="'.$batch.'" ';
			}
            $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $item_id . '  '.$where_text.' and godown_id=' . $godown;
            $query = $this->db->query($qry)->row_array();
            $isexist = $query['no'];
            if ($isexist == 0) {
                if ($trans_type == 'cr') {
                    $num = 0;
                    $stock = $num - $quantity;
                }
               // $qry = "insert into item_godown(godown_id,item_id,item_qty,current_stock,batch) values(" . $godown . " , " . $item_id . " , " . $quantity . " , " . $quantity . " ,'".$batch."')";
				$data = array(
					'godown_id'=>$godown,
					'item_id'=>$item_id,
					'item_qty'=>$quantity,
					'current_stock'=>$quantity,
					'batch'=>$batch,
					'manufacture_date'=>$mdate,
					'expiry_date'=>$edate
				);

                 $settings = $this->getCompanySettings();
                    $is_batch = 0 ;
                    if(isset($settings[0]['is_batch'])){
                        $is_batch = $settings[0]['is_batch'];
                    }
                    if($is_batch > 0 ){
                        $data['item_srate'] = $srate;
                        $data['item_prate'] = $prate;
                        $data['item_mrp'] = $mrp;
                    }

				$this->db->insert('item_godown',$data);
               // $this->db->query($qry);
            } else {
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                if ($trans_type == 'cr') {
                    $current_stock = round($current_stock, 2) - round($quantity, 2);
                } else {
                    $current_stock = round($current_stock, 2) + round($quantity, 2);
                }
				$data = array(
					'current_stock'=>$current_stock
				);
				if($mdate !=''){
					$data['manufacture_date'] = $mdate;
				}
				if($edate !=''){
					$data['expiry_date'] = $edate;
				}
				$this->db->where('godown_id',$godown);
				$this->db->where('item_id',$item_id);
				if((int) $isbatch > 0 ){
					$this->db->where('batch',$batch);
				}
				$this->db->update('item_godown',$data);
               // $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $godown . "  ".$where_text." and item_id=" . $item_id;
                //$this->db->query($qry);
            }
        }
    }

    function stock_trans($id, $item_id, $quantity, $trans_date, $trans_type, $trans_status, $trans_id, $rate, $MRP, $tax_id, $godown, $voucher_no = "",$batch = "") {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $open_stock = $this->updatestock($item_id, $trans_type, $quantity);
        $data = array('item_id' => $item_id,
            'open_stock' => $open_stock,
            'quantity' => $quantity,
			'batch'=>$batch,
            'trans_date' => $trans_date,
            'trans_type' => $trans_type,
            'trans_status' => $trans_status,
            'trans_id' => $trans_id,
            'rate' => $rate,
            'MRP' => $MRP,
            'godown' => $godown,
            'published' => 'yes',
            'tax_id' => $tax_id);
        if ($voucher_no != "") {
            $data['voucher_no'] = $voucher_no;
        }
        $insert_id = 0;
        if ($id == 0) {
            $this->db->insert('item_ledger', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('id', $id);
            $this->db->update('item_ledger', $data);
        }
    }

    function updatestock($item_id, $trans_type, $quantity) {
        $qry = 'select * from item where id=' . $item_id;
        $query = $this->db->query($qry)->row_array();
        $current_stock = $query['current_stock'];
        $oldstock = $current_stock;
        if ($trans_type == 'cr') {
            $current_stock = round($current_stock, 2) - round($quantity, 2);
        } else {
            $current_stock = round($current_stock, 2) + round($quantity, 2);
        }
        $data = array('current_stock' => $current_stock);
        $this->db->where('id', $item_id);
        $this->db->update('item', $data);
        return $oldstock;
    }
	
	 function ces_add($ces_id, $ces) {
		if((float) $ces > 0 ){
			$qry = "SELECT * FROM cess_tbl as a INNER join acc_ledgers as b on a.ces_id=b.ref_id and ref_code='Cess' and a.ces_id = ".$ces_id;
			$query = $this->db->query($qry)->row_array();
			$ces_id = $query['id'];
			$row = array('ces_id' => $ces_id, 'ces' => $ces);
			$tp = 0;
			$cnt = count($this->cesdata);
			if ($cnt != 0) {
				for ($i = 0; $i < $cnt; $i++) {
					if ($ces_id == $this->cesdata[$i]['ces_id']) {
						$this->cesdata[$i]['ces'] = $this->cesdata[$i]['ces'] + $ces ;
						$tp++;
					}
				}
			}
			if ($tp == 0) {
				$this->cesdata[$cnt] = $row;
			}
		}
		}
    


    function tax_add($tax_id, $total, $taxtot, $saleamount) {
        $row = array('tax' => $tax_id, 'tax_amt' => $taxtot, 'total' => $total, 'saleamount' => $saleamount);
        $tp = 0;
        $cnt = count($this->data);
        if ($cnt != 0) {
            for ($i = 0; $i < $cnt; $i++) {
                if ($tax_id == $this->data[$i]['tax']) {
                    $this->data[$i]['tax_amt'] = $this->data[$i]['tax_amt'] + $taxtot;
                    $this->data[$i]['saleamount'] = $this->data[$i]['saleamount'] + $saleamount;
                    $this->data[$i]['total'] = $this->data[$i]['total'] + $total;
                    $tp++;
                }
            }
        }
        if ($tp == 0) {
            $this->data[$cnt] = $row;
        }
    }
	
    function ces_save($invoice, $insert_id, $or_type, $to, $invoicedate, $narration, $type, $costcenter, $is_mul_led, $branch = 0, $discount = 0, $curr_value = 1) {
		if ($type == 'sale') {
			 $cnt = count($this->cesdata);
			 for ($i = 0; $i < $cnt; $i++) {
                $this->trans_save($invoice, $insert_id, 'Sales', $or_type, $to,  $this->cesdata[$i]['ces_id'], $invoicedate, $this->cesdata[$i]['ces'], '0.00', $narration, 1, $costcenter, $branch);
			 }
		}
		if($type== 'purchase'){
			$cnt = count($this->cesdata);
			for ($i = 0; $i < $cnt; $i++) {
                $this->trans_save($invoice, $insert_id, 'Purchase', $or_type, $to, $this->cesdata[$i]['ces_id'], $invoicedate, '0.00', round($this->cesdata[$i]['ces'] * $curr_value, 2), $narration, 1, $costcenter, $branch);
			}
		}
	}

    function stock_gold_trans($id, $item_id, $quantity,$netwt,$gross_wt, $trans_date, $trans_type, $trans_status, $trans_id, $rate, $MRP, $tax_id, $godown, $voucher_no = "",$batch = "") {
		$settings = $this->getCompanySettings();
		$isbatch  = $settings[0]['is_batch'];
        $open_stock = $this->updatestock($item_id, $trans_type, $quantity);
        $data = array('item_id' => $item_id,
            'open_stock' => $open_stock,
            'quantity' => $quantity,
           // 'gross_wt'=>$gross_wt,
           // 'net_wt'=>$netwt,
			'batch'=>$batch,
            'trans_date' => $trans_date,
            'trans_type' => $trans_type,
            'trans_status' => $trans_status,
            'trans_id' => $trans_id,
            'rate' => $rate,
            'MRP' => $MRP,
            'godown' => $godown,
            'published' => 'yes',
            'tax_id' => $tax_id);
        if ($voucher_no != "") {
            $data['voucher_no'] = $voucher_no;
        }
        $insert_id = 0;
        if ($id == 0) {
            $this->db->insert('item_ledger', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('id', $id);
            $this->db->update('item_ledger', $data);
        }
    }


    function godown_gold_stock_trans($id, $item_id, $quantity, $trans_type, $trans_status, $godown,$batch="",$mdate='',$edate='') {
        if ($godown != '') {
			$settings = $this->getCompanySettings();
			$isbatch  = $settings[0]['is_batch'];
			$where_text = ' ';
			if((int) $isbatch > 0 ){
				$where_text ='  and batch ="'.$batch.'" ';
			}
            $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $item_id . '  '.$where_text.' and godown_id=' . $godown;
            $query = $this->db->query($qry)->row_array();
            $isexist = $query['no'];
            if ($isexist == 0) {
                if ($trans_type == 'cr') {
                    $num = 0;
                    $stock = $num - $quantity;
                }
               // $qry = "insert into item_godown(godown_id,item_id,item_qty,current_stock,batch) values(" . $godown . " , " . $item_id . " , " . $quantity . " , " . $quantity . " ,'".$batch."')";
				$data = array(
					'godown_id'=>$godown,
					'item_id'=>$item_id,
					'item_qty'=>$quantity,
					'current_stock'=>$quantity,
					'batch'=>$batch,
					'manufacture_date'=>$mdate,
					'expiry_date'=>$edate
				);
				$this->db->insert('item_godown',$data);
               // $this->db->query($qry);
            } else {
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                if ($trans_type == 'cr') {
                    $current_stock = round($current_stock, 2) - round($quantity, 2);
                } else {
                    $current_stock = round($current_stock, 2) + round($quantity, 2);
                }
				$data = array(
					'current_stock'=>$current_stock
				);
				if($mdate !=''){
					$data['manufacture_date'] = $mdate;
				}
				if($edate !=''){
					$data['expiry_date'] = $edate;
				}
				$this->db->where('godown_id',$godown);
				$this->db->where('item_id',$item_id);
				if((int) $isbatch > 0 ){
					$this->db->where('batch',$batch);
				}
				$this->db->update('item_godown',$data);
               // $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $godown . "  ".$where_text." and item_id=" . $item_id;
                //$this->db->query($qry);
            }
        }
		
		
		
    }



    function tax_save($invoice, $insert_id, $or_type, $to, $invoicedate, $narration, $type, $costcenter, $is_mul_led, $branch = 0, $discount = 0, $curr_value = 1) {
        if ($type == 'sale') {
            $cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
                // $res = $this->getLedgers($this->data[$i]['tax'], 'Sales', '="Tax"');
                if ($is_mul_led == 1) {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'SaleTax');
                    $this->trans_save($invoice, $insert_id, 'Sales', $or_type, $to, $res, $invoicedate, $this->data[$i]['saleamount'], '0.00', $narration, 1, $costcenter, $branch);
                }
                if ($is_mul_led == 0) {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                } else {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                }
                $this->trans_save($invoice, $insert_id, 'Sales', $or_type, $to, $res, $invoicedate, $this->data[$i]['tax_amt'], '0.00', $narration, 1, $costcenter, $branch);
            }
        }else if($type == 'service'){
			$cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
				$res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                $this->trans_save($invoice, $insert_id, 'service', 'service', $to, $res, $invoicedate, $this->data[$i]['tax_amt'], '0.00', $narration, 1, $costcenter, $branch);
			}
		}else if($type == 'hotel_booking'){
			$cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
					$this->trans_save($invoice, $insert_id, 'hotel_booking', $or_type, $to, $res, $invoicedate, round($this->data[$i]['tax_amt'], 2),'0.00' , $narration, 1, $costcenter, $branch);
			}
		} else {
            $cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
                $this->data[$i]['tax'];
                if ($is_mul_led == 1) {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'PurTax');
                    $this->trans_save($invoice, $insert_id, 'purchase', $or_type, $to, $res, $invoicedate, '0.00', round($this->data[$i]['saleamount'] * $curr_value, 2), $narration, 1, $costcenter, $branch);
                }
                // $res = $this->getLedgers($this->data[$i]['tax'], 'Sales', '="Tax"');
                if ($is_mul_led == 0) {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                } else {
                    $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                }
                $this->trans_save($invoice, $insert_id, 'Purchase', $or_type, $to, $res, $invoicedate, '0.00', round($this->data[$i]['tax_amt'] * $curr_value, 2), $narration, 1, $costcenter, $branch);
            }
        }
    }

    /* stock end here */
}
