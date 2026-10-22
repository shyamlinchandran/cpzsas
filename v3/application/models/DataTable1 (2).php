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
        $this->load->database();
    }

//this is for datatable  
    var $data = array(); //THIS IS USED FOR IDENTIFYING tAX
    var $table = '';
    var $select = '';
    var $wherecondition = '';
    var $column_order = '';
    var $column_search = '';
    var $group = '';
// this is for constants
    var $cashaccount = 1;
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

    public function getopst($enddate, $id) {

        $qry = "select (CASE WHEN trans_type = 'cr'  then open_stock-quantity
             else open_stock+quantity end) as open
from item_ledger where  id=(
    SELECT max(id) FROM item_ledger where trans_date  < '" . $this->getDate($enddate) . "' and item_id = '" . $id . " '
    )";

        $query = $this->db->query($qry)->row_array();
        return $query['open'];
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

    function getCompanySettings() {
        $qry = 'select * from company as a inner join company_settings as b on a.com_id=b.com_id limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
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
        $qry = 'select * from company limit 1';
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
    }

    function restore_godown_transfer_stock($insert_id) {
        $qry = "select * from item_transfer as a inner join transfer_items as b on a.id=b.transfer_id  where b.published='yes' and a.id=" . $insert_id;
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

    public function getLedegerbalance($enddate, $id, $tp) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans  where  published ='yes' and  tran_date >=  '" . $this->finstartDate . "' and  tran_date  < '" . $this->getDate($enddate) . "' and ledger_id =" . $id;
        } else {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans  where  published ='yes' and tran_date >=  '" . $this->finstartDate . "' and  tran_date  <= '" . $this->getDate($enddate) . "' and ledger_id =" . $id;
        }
        $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }

    public function getStockLedegerbalance($enddate, $item_id, $tp) {
        $qry = '';
        if ($tp == 'op') {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans  where published ='yes' and tran_date >=  '" . $this->finstartDate . "' and  tran_date  < '" . $this->getDate($enddate) . "' and ledger_id =" . $id;
        } else {
            $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans  where published ='yes' and tran_date >=  '" . $this->finstartDate . "' and  tran_date  <= '" . $this->getDate($enddate) . "' and ledger_id =" . $id;
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

    function trans_save($voucher_no, $tb_id, $tb_name, $tran_tp, $toid, $from, $date, $credit, $debit, $narration, $created_by) {
        if ($credit > $debit) {
            $tran_amt = $credit;
        } else {
            $tran_amt = $debit;
        }
        $qry = 'insert into acc_ledger_trans (voucher_no,tb_id,tb_name,trn_tp,to_ledger_id,ledger_id,tran_amt,tran_date,tran_debit,tran_credit,tran_narration,tran_crtd_by,tran_crtd_dt) '
                . 'values("' . $voucher_no . '","' . $tb_id . '","' . $tb_name . '","' . $tran_tp . '",' . $toid . ',' . $from . ',' . $tran_amt . ',"' . $date . '",' . $debit . ',' . $credit . ',"' . $narration . '",' . $created_by . ',NOW())';
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
                    $current_stock = $current_stock - $quantity;
                } else {
                    $current_stock = $current_stock + $quantity;
                }
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $godown . " and item_id=" . $item_id;
                $this->db->query($qry);
            }
        }
    }

    function stock_trans($id, $item_id, $quantity, $trans_date, $trans_type, $trans_status, $trans_id, $rate, $MRP, $tax_id, $godown) {
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
            'tax_id' => $tax_id);
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
            $current_stock = $current_stock - $quantity;
        } else {
            $current_stock = $current_stock + $quantity;
        }
        $data = array('current_stock' => $current_stock);
        $this->db->where('id', $item_id);
        $this->db->update('item', $data);
        return $oldstock;
    }

    function tax_add($tax_id, $total, $taxtot) {
        $row = array('tax' => $tax_id, 'tax_amt' => $taxtot, 'total' => $total);
        $tp = 0;
        $cnt = count($this->data);
        if ($cnt != 0) {
            for ($i = 0; $i < $cnt; $i++) {
                if ($tax_id == $this->data[$i]['tax']) {
                    $this->data[$i]['tax_amt'] = $this->data[$i]['tax_amt'] + $taxtot;
                    $this->data[$i]['total'] = $this->data[$i]['total'] + $total;
                    $tp++;
                }
            }
        }
        if ($tp == 0) {
            $this->data[$cnt] = $row;
        }
    }

    function tax_save($invoice, $insert_id, $or_type, $to, $invoicedate, $narration, $type) {
        if ($type == 'sale') {
            $cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
                // $res = $this->getLedgers($this->data[$i]['tax'], 'Sales', '="Tax"');
                $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                $this->trans_save($invoice, $insert_id, 'Sales', $or_type, $to, $res, $invoicedate, $this->data[$i]['tax_amt'], '0.00', $narration, 1);
            }
        } else {
            $cnt = count($this->data);
            for ($i = 0; $i < $cnt; $i++) {
                $this->data[$i]['tax'];
                // $res = $this->getLedgers($this->data[$i]['tax'], 'Sales', '="Tax"');
                $res = $this->getLedgersSing($this->data[$i]['tax'], 'Tax');
                $this->trans_save($invoice, $insert_id, 'Purchase', $or_type, $to, $res, $invoicedate, '0.00', $this->data[$i]['tax_amt'], $narration, 1);
            }
        }
    }

    /* stock end here */
}
