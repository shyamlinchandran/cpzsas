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

class Salesitem_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.published as pub, a.type as stype, DATE_FORMAT(invoice_date, "%d/%m/%Y" ) as in_date,  a.*,b.*';
        $this->table = 'tyr_sales as a left join tyr_customer as b on a.customer_id =b.id';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
    }

    function where() {

        if ($this->input->post('type')) {
           $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
        }
    }

    function max() {
        $qry = 'select max(Sales_id) as max_id from tyr_sales where type ="' . $this->input->post('type') . '"';
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function ledbalid($id) {
        $qry = 'select id  from acc_ledgers where ref_code in ("sup","cus") and ref_id = ' . $id . ' limit 1';
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

    public function getinoviceno($type='1') {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT invoice FROM  tyr_sales  where  bill_type='" . $type . "' and published='yes'  order by sales_id desc limit 0,1";
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

    function getSales($id) {
        $qry = "select a.published as pub, DATE_FORMAT(invoice_date,'%d-%m-%Y') as in_date,  a.type as stp, a.*,b.* from tyr_sales as a left join tyr_customer as b on a.customer_id=b.id where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getSalesItems($id, $len, $size) {
        $qry = "select  g.*, h.hsncode as hsncd,a.mrp as mrps, a.*,b.* from tyr_sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid where sales_id= $id and a.published='yes' limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItems($id) {
        $qry = " select SUM(`total`)as tot ,sum(total-tax) as amt ,round(sum((total-tax)*tg.cgst/100),2) as camt ,round(sum((total-tax)*tg.sgst/100),2) as samt ,round(sum((total-tax)*tg.igst/100),2) as iamt , h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from tyr_sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.sales_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = " select SUM(`total`)as tot ,sum(total-tax) as amt ,round(sum((total-tax)*tg.cgst/100),2) as camt ,round(sum((total-tax)*tg.sgst/100),2) as samt ,round(sum((total-tax)*tg.igst/100),2) as iamt , h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from tyr_sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.sales_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function getSalesItemscnt($id) {
        $qry = "select  * from tyr_sales_items as a inner join item as b on a.item_id= b.id  where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function getRefLedger($id) {
        $qry = 'select * from acc_ledgers where ref_id=' . $id . ' and ref_code ="ref"';
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function delete($id) {
        $qry = "delete from  tyr_sales where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from tyr_sales_items  where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from  acc_ledger_trans  where tb_name='Sales' and tb_id =" . $id;
        $this->db->query($qry);
    }

    function cancel($id) {
        $qry = "update  tyr_sales set published ='no'  where sales_id =" . $id;
        $this->db->query($qry);
        /* $qry = "update  sales_items set published ='no' where sales_id =" . $id;
          $this->db->query($qry); */
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='tyr_sales' and tb_id =" . $id;
        $this->db->query($qry);
    }

    function InsertSales($data) {
        $invoice = $data['invoice'];
        $this->db->insert('tyr_sales', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function UpdateSales($data, $id, $or_type) {
        $invoice = $data['invoice'];
        $insert_id = $id;
        $this->db->where('sales_id', $id);
        $this->db->update('tyr_sales', $data);
        $qry = "update  tyr_sales_items set published ='no' where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $id;
        $this->db->query($qry);
        $qry = "update  acc_ledger_trans set published ='no' where tb_name='tyr_sales' and tb_id =" . $id;
        $this->db->query($qry);
        $this->restorestock($id, 'sales');
    }

    function InsertSales_items($data, $or_type, $invoicedate) {
		//$qty = $this->getquantity($data['unit_id'], $data['quantity'], $data['item_id']);
        $this->db->insert('tyr_sales_items', $data);
        if ($or_type != 'tyrestimate') {
            $this->tax_add($data['tax_id'], $data['total'], $data['tax']);
            $ttp = 'cr';
            if ($or_type == 'tyrsales_return') {
                $ttp = 'dt';
            }
            $this->stock_trans(0, $data['item_id'], $data['quantity'], $invoicedate, $ttp, $or_type, $data['sales_id'], $data['rate'], $data['mrp'], $data['tax_id'], $data['godown']);
            $this->godown_stock_trans(0, $data['item_id'], $data['quantity'], $ttp, $or_type, $data['godown']);
        }
    }

    function savesub($data, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id) {

        if (strtolower($data['cash_type']) != 'cash' || $data['customer_id'] != '') {
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
        }
        if (isset($data['ref_id']) && $data['ref_id'] != 0) {
            // log_message("Enter in reference");
            $refs = $this->getRefLedger($data['ref_id']);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $refs['id'], $this->ref, $this->getDate(), '0.00', $data['commi_amt_hi'], $data['narration'], 1);
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->ref, $refs['id'], $data['invoice_date'], $data['commi_amt_hi'], '0.00', $data['narration'], 1);
        } 
        $toid = 0; 
        if (strtolower($data['cash_type']) == 'cash') {
            $toid = $this->cashaccount;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $this->cashaccount, $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1);
        } else {
            $res = $this->getLedgers($data['customer_id'], '', ' in ("cus","sup")');
            $toid = $res['id'];
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $this->sales, $res['id'], $data['invoice_date'], '0.00', $data['total'], $data['narration'], 1);
            $this->addAgeing($id, $data['invoice'], $insert_id, 'Sales', $data['invoice_date'], $data['invoice_date'], $res['id'], date('Y-m-d H:i:s', time()), 0, $data['total'], 0, 0, 0);
        }
        if (is_numeric($data['discount']) == true && $data['discount'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->discount, $data['invoice_date'], '0.00', $data['discount'], $data['narration'], 1);
        }
        /*if (is_numeric($data['freight']) == true && $data['freight'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesFr, $data['invoice_date'], $data['freight'], '0.00', $data['narration'], 1);
        }*/

        $salesamount = $subtot - $taxtotal;
        $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->sales, $data['invoice_date'], $salesamount, '0.00', $data['narration'], 1);
        if ($rount > 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], $rount, '0.00', $data['narration'], 1);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->rount, $data['invoice_date'], '0.00', $rount, $data['narration'], 1);
        } 
        $this->tax_save($data['invoice'], $insert_id, $or_type, $toid, $data['invoice_date'], $data['narration'], 'sale');
    }
    function tyr_customer($search, $type) {
        if ($type == 'sup') {
            $type = 'type ="sup" and ';
        } else {
            $type = '';
        }
        $qry = "select a.name  as label,a.* from tyr_customer as a where (name like('%$search%') or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function vhl_manufacture() {
        $qry = "select a.* from tyr_vhl_manufacturers as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }
    public function save($or_type) {
        //  $cons = new Common_db();
        $this->data = array();
        $id = $this->input->post('id');
        $billtype = $this->input->post('btype');
        $invoice = $this->input->post('invoice');
        if($id==0)
        {
        if ($billtype == '') {
            $invoice = $this->getinoviceno($or_type);
        
        } else {
            $invoice = $this->getinoviceno($billtype);
        }
        }
        $customer_id = $this->input->post('customer_id');
        $cname = $this->input->post('supname', TRUE);
        $phone = $this->input->post('phone', TRUE);
        $email = $this->input->post('email', TRUE);
        $vhl_mfctr = $this->input->post('vmf', TRUE);
        $vhl_model = $this->input->post('vmodel', TRUE);
        $vhl_name = $this->input->post('vname', TRUE);
        $vhl_no = $this->input->post('vno', TRUE);
        $kms = $this->input->post('kms', TRUE);
        $address_line1 = $this->input->post('address_line1', TRUE);
        $address_line2 = $this->input->post('address_line1');
        $details = $this->input->post('comments');
        $type = 'cus';
        $customer_data = array(
                'name' => $cname,
                'phone' => $phone,
                'email' => $email,
                'vhl_mfctr' => $vhl_mfctr,
                'vhl_model' => $vhl_model,
                'vhl_name' => $vhl_name,
                'vhl_no' => $vhl_no,
                'kms' => $kms,
                'address_line1' => $address_line1,
                'address_line2' => $address_line2,
                'details' => $details,
                'type' => $type,
                'published' => 'yes'
            );
        if($customer_id=='')
        {
             $this->db->insert('tyr_customer',$customer_data);
             $customer_id = $this->db->insert_id();

        }
        else
        {
            $this->db->set($customer_data);
            $this->db->where('id', $customer_id);
            $this->db->update('tyr_customer');
        }  
        $route = $this->input->post('route');
        //$base_unit = $this->input->post('base_unit');
        //$salesman = $this->input->post('salesman');
        $vehicle = $this->input->post('vehicle');
        $area = $this->input->post('area');
        $deldate = $this->input->post('ddate'); //delivery date
        $cdate = $this->input->post('cdate'); //credit date 
        $invoicedate = $this->input->post('date');
        //$commi_amt_hi = $this->input->post('commi_amt_hi');
        $type = $this->input->post('type');
        //$reference = $this->input->post('reference');
        $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
        $freight = $this->input->post('freight'); //Transporting
        $advance = $this->input->post('advance');
        $other = $this->input->post('other'); //Coolie
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $tax = $this->input->post('taxtotal');
        $vehicle = $this->input->post('vehicle');
        $gtotal = $this->input->post('gtotal');
        $supname = $this->input->post('supname');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $data_sales = array(
            'invoice_date' => $this->getDate($invoicedate),
            'customer_id' => $customer_id,
            'cash_type' => $type,
            'delivery_date' => $this->getDate($invoicedate),
            'credit_eod' => $this->getDate($invoicedate),
            'total' => $gtotal,
            //'salesman' => $salesman,
            'route' => $route,
            'vehicle' => $vehicle,
            'area' => $area,
            'tax' => $tax,
            'ref_amount' => 1,
            'tax_id' => 0,
            'advance' => $advance,
            'other' => $other,
            // 'freight' => $freight,
            'discount' => $discount,
            'roundoff' => $rount,
            //'ref_id' => $reference,
            'created_date' => date('Y-m-d H:i:s', time()),
            'narration' => $narration,
            'created_by' => 2,
            'type' => $or_type,
            // 'bill_type' => $billtype,
            // 'cusname' => $supname,
            // 'cusdetails' => $phone,
            // 'cusemail' => $email,
            'published' => 'yes'
        );
        $insert_id = 0;
        if ($id == 0) {
            $data_sales['invoice'] = $invoice;
            $insert_id = $this->InsertSales($data_sales);
        } else {
            $data_sales['invoice'] = $invoice;
            $this->UpdateSales($data_sales, $id, $or_type);
            $insert_id = $id;
        }
        $item_id = $this->input->post('item_id', TRUE);
        $item_qty = $this->input->post('item_qty', TRUE);
        // $godown = $this->input->post('godown', TRUE);
        $unit_item = $this->input->post('unit_item', TRUE);
        $tax_item = $this->input->post('tax_item', TRUE);
        $mrp_item = $this->input->post('mrp_item', TRUE);
        $prate_item = $this->input->post('prate_item', TRUE);
        $dis_amt = $this->input->post('dis_amt', TRUE);
        $tax_amount = $this->input->post('tax_amount', TRUE);
        $rowTotal = $this->input->post('rowTotal', TRUE);
        $subtot = $this->input->post('subtot');
        $taxtotal = $this->input->post('taxtotal');
        $length = sizeof($mrp_item);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'sales_id' => $insert_id,
                'item_id' => $item_id[$i],
                'godown' => 1,
                'unit_id' => $unit_item[$i],
                'base_unit_id' => $unit_item[$i],
                'quantity' => $item_qty[$i],
                'rate' => $prate_item[$i],
                'mrp' => $mrp_item[$i],
                'tax_id' => $tax_item[$i],
                'tax' => $tax_amount[$i],
                'dis_amt' => $dis_amt[$i], 'discount' => 0,
                'total' => $rowTotal[$i],
                'published' => 'yes'
            );
            $this->InsertSales_items($data, $or_type, $invoicedate);
        }
        $this->savesub($data_sales, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id);
        return $insert_id;
    }

}
