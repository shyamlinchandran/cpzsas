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
    var $taxdata = array(); //THIS IS USED FOR IDENTIFYING tAX
    var $table = '';
    var $select = '';
    var $wherecondition = '';
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
        if (strtolower($trn_tp) == 'sales') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/sales/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'sales_retu' || $trn_tp == 'sales_return') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/sales_return/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'estimate') {
            $row = '<a href="' . base_url() . 'transaction/sales/sales/estimate/' . $id . '"> ' . $voucher_no . '</a> ';
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
        if (strtolower($trn_tp) == 'payment') {
            $row = '<a href="' . base_url() . 'transaction/vouchers/payment/' . $id . '"> ' . $voucher_no . '</a> ';
        }
        if (strtolower($trn_tp) == 'cheque') {
            $row = '<a href="' . base_url() . 'transaction/chque/create/' . $id . '/v"> ' . $voucher_no . '</a> ';
        }
        return $row;
    }

    function addAgeing($id, $voucher_no, $tb_id, $tb_name, $tb_crdate, $tb_caldate, $led_id, $created_date, $credit, $debit, $paid, $balance, $status) {
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
            'paid' => $paid,
            'balance' => $balance,
            'status' => $status);
//        print_r($data);
        if ($id == 0) {
            $this->db->insert('acc_ageing', $data);
            $this->db->insert_id();
        } else {
            $this->db->where('tb_name', $tb_name);
            $this->db->where('tb_id', $tb_id);
            $this->db->update('acc_ageing', $data);
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

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    var $qryfrm = '';

    function getCompany() {
        $qry = 'select * from company as a left join company_settings as b on a.com_id=b.com_id limit 1';
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function getQueryDt() {
        if ($this->select == '') {
            $this->qryfrm = 'select * from';
        } else {
            $this->qryfrm = 'select ' . $this->select . ' from';
        }
        $this->qryfrm = $this->qryfrm . ' ' . $this->table . ' ' . $this->wherecondition;

        if ($_POST['search']['value']) {
            if ($this->wherecondition == '') {
                $this->qryfrm = $this->qryfrm . ' Where ';
            } else {
                $this->qryfrm = $this->qryfrm . ' and ';
            }
            $i = 0;
            foreach ($this->column_search as $item) {

                if ($i == 0) {
                    $this->qryfrm = $this->qryfrm . ' ' . $item . ' like ("%' . $_POST['search']['value'] . '%")';
                } else {
                    $this->qryfrm = $this->qryfrm . ' or ' . $item . ' like ("%' . $_POST['search']['value'] . '%")';
                }
                $i++;
            }
        }
        if ($this->group != '') {
            $group = $this->group;
            $this->qryfrm = $this->qryfrm . ' group by ' . $group;
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
        $qry = "select * from item where id=" . $item;
        $query = $this->db->query($qry)->row_array();
        $base = $query['unit_id'];
        if ($unit != $base) {
            $i = 1;
            do {
                $i++;
                $qry = "select  * from units where id=" . $unit;
                $query = $this->db->query($qry)->row_array();
                $base_count = $query['unit_count'];
                $quantity = $quantity / $base_count;
                $unit = $query['unit_id'];
            } while ($base != $unit);
        }
        return $quantity;
    }

    function getquantity($unit, $quantity, $item) {
        $qry = "select * from item where id=" . $item;
        $query = $this->db->query($qry)->row_array();
        $base = $query['unit_id'];
        if ($unit != $base) {
            $i = 1;
            do {
                $i++;
                $qry = "select  * from units where id=" . $unit;
                $query = $this->db->query($qry)->row_array();
                $base_count = $query['unit_count'];
                $quantity = $quantity * $base_count;
                $unit = $query['unit_id'];
            } while ($base != $unit);
        }
        return $quantity;
    }

    function restoreestimate($insert_id, $txtEstimate_id) {

        $qry = "select * from sales_items where sales_id=$insert_id and published='yes'";
        $query = $this->db->query($qry)->result_array();
        foreach ($query as $ms) {
            $qry = "update sales_items set estimate_quantity=estimate_quantity-" . $ms['quantity'] . " where published ='yes' and sales_id= " . $txtEstimate_id . " and item_id=" . $ms['item_id'];
            $this->db->query($qry);
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
                $qry = "select * from item where id=" . $ms['item_id'];
                $q = $this->db->query($qry)->row_array();
                $base = $q['unit_id'];
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                $this->updatestock($ms['item_id'], 'dt', $qty);
            }
        }
        if ($type == 'damage') {
            $qry = "select * from item_damage where damage_id=$insert_id and published='yes'";
            $query = $this->db->query($qry)->result_array();
            foreach ($query as $ms) {
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                $this->updatestock($ms['item_id'], 'dt', $qty);
                $this->godown_stock_trans($id, $ms['item_id'], $qty, 'damage', 'dt', $ms['godown_id']);
            }
        }
    }

    function restore_godown_transfer_stock($insert_id) {
        $qry = "select * from item_transfer as a inner join item_transfer_sub  as b on a.id=b.transfer_id  where b.published='yes' and a.id=" . $insert_id;
        $query = $this->db->query($qry)->result_array();

        foreach ($query as $ms) {
            $this->godown_stock_trans(0, $ms['item_id'], $ms['qty'], 'cr', 'item', $ms['to_id']);
            $this->godown_stock_trans(0, $ms['item_id'], $ms['qty'], 'dt', 'item', $ms['from_id']);
        }
    }

    function restore_godown_stock_trans($insert_id, $trans_type) {
        $qry = "select * from purchase_items where purchase_id=$insert_id and published='yes' ";
        $query1 = $this->db->query($qry)->result_array();
        foreach ($query1 as $ms) {
            if ($ms['godown'] != 0) {
                $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $ms['item_id'] . ' and godown_id=' . $ms['godown'];
                $query = $this->db->query($qry)->row_array();
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                if ($trans_type == 'cr') {
                    $current_stock = $current_stock - $qty;
                } else {
                    $current_stock = $current_stock + $qty;
                }
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $ms['godown'] . " and item_id=" . $ms['item_id'];
                $this->db->query($qry);
            }
        }
    }

    function restore_godown_stock($insert_id, $trans_type) {
        $qry = "select * from sales_items where sales_id=$insert_id and published='yes' ";
        $query1 = $this->db->query($qry)->result_array();
        foreach ($query1 as $ms) {
            if ($ms['godown'] != 0) {
                $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $ms['item_id'] . ' and godown_id=' . $ms['godown'];
                $query = $this->db->query($qry)->row_array();
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                if ($trans_type == 'cr') {
                    $current_stock = $current_stock - $qty;
                } else {
                    $current_stock = $current_stock + $qty;
                }
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $ms['godown'] . " and item_id=" . $ms['item_id'];
                $this->db->query($qry);
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

    public function getLedegerbalance($enddate, $id, $tp, $ls = 0) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt,b.openning_bal,b.type from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id  where  a.published ='yes' and  a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($enddate) . "' and a.ledger_id =" . $id;
        } else {
            $qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt,b.openning_bal,b.type from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id  where  a.published ='yes' and a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  <= '" . $this->getDate($enddate) . "' and a.ledger_id =" . $id;
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

    function stock_prod($id, $item_id, $quantity, $trans_date, $trans_type, $trans_status, $trans_id) {
        $open_stock = $this->updatestock($item_id, $trans_type, $quantity);
        $data = array('item_id' => $item_id,
            'open_stock' => $open_stock,
            'quantity' => $quantity,
            'trans_date' => $trans_date,
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

    function godown_stock_trans($id, $item_id, $quantity, $trans_type, $trans_status, $godown) {
        if ($godown != '') {
            $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $item_id . ' and godown_id=' . $godown;
            $query = $this->db->query($qry)->row_array();
            $isexist = $query['no'];
            if ($isexist == 0) {
                if ($trans_type == 'cr') {
                    $num = 0;
                    $stock = $num - $quantity;
                }
                $qry = "insert into item_godown(godown_id,item_id,item_qty,current_stock) values(" . $godown . " , " . $item_id . " , " . $quantity . " , " . $quantity . ")";
                $this->db->query($qry);
            } else {
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                if ($trans_type == 'cr') {
                    $current_stock = round($current_stock, 2) - round($quantity, 2);
                } else {
                    $current_stock = round($current_stock, 2) + round($quantity, 2);
                }
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $godown . " and item_id=" . $item_id;
                $this->db->query($qry);
            }
        }
    }

    function stock_trans($id, $item_id, $quantity, $trans_date, $trans_type, $trans_status, $trans_id, $rate, $MRP, $tax_id, $godown, $voucher_no = "") {
        $open_stock = $this->updatestock($item_id, $trans_type, $quantity);
        $data = array('item_id' => $item_id,
            'open_stock' => $open_stock,
            'quantity' => $quantity,
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
