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

class Quotation_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.published as pub,a.id as aid, a.*,b.*';
        $this->table = 'quotation as a left join suppliers as b on a.customer_id =b.id';
        $this->column_order = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        $this->wherecondition = " where a.published ='yes'";
    }

    function wherecustomer() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $id = $this->input->post('supid');
        if ($this->input->post('stype')) {
            $this->wherecondition = "where a.type = '" . $this->input->post('stype') . "' and a.created_by = " . $userid . " and a.customer_id = " . $id;
        }
    }

    function max() {
        $qry = 'select max(Sales_id) as max_id from sales where type ="' . $this->input->post('type') . '"';
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

    public function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT invoice FROM  quotation  where  bill_type='" . $type . "' and published='yes'  order by id desc limit 0,1";
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
        $qry = "select a.published as pub,c.StateName, DATE_FORMAT(invoice_date,'%d-%m-%Y') as in_date,  a.type as stp, a.*,b.* from sales as a left join suppliers as b on a.customer_id=b.id left join state as c on c.StateID=b.cst where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getSalesItems($id, $len, $size) {
        $qry = "select  g.*, h.hsncode as hsncd,a.mrp as mrps, a.*,b.* from sales_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid where sales_id= $id and a.published='yes' limit $len,$size";
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
        $qry = "select  * from sales_items as a inner join item as b on a.item_id= b.id  where sales_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function getRefLedger($id) {
        $qry = 'select * from acc_ledgers where ref_id=' . $id . ' and ref_code ="ref"';
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function delete($id) {
        $qry = "delete from  sales where sales_id =" . $id;
        $this->db->query($qry);
        $qry = "delete from quotation_items  where sales_id =" . $id;
       
    }

    function cancel($id) {
        $qry = "update  quotation set published ='no'  where sales_id =" . $id;
        $this->db->query($qry);
        /* $qry = "update  sales_items set published ='no' where sales_id =" . $id;
          $this->db->query($qry); */
      
    }

    function InsertSales($data) {
        $invoice = $data['invoice'];
        $this->db->insert('quotation', $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

    function UpdateSales($data, $id, $or_type) {
        $insert_id = $id;
        $this->db->where('id', $id);
        $this->db->update('quotation', $data);
        $qry = "update  quotation_items set published ='no' where qtn_id =" . $id;
        $this->db->query($qry);
    }

    function InsertSales_items($data, $or_type, $invoicedate) {
        $qty = $data['quantity'];
        $this->db->insert('quotation_items', $data);
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
        if (is_numeric($data['freight']) == true && $data['freight'] != 0) {
            $this->trans_save($data['invoice'], $insert_id, 'Sales', $or_type, $toid, $this->salesFr, $data['invoice_date'], $data['freight'], '0.00', $data['narration'], 1);
        }

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

    public function save($or_type) {
        //  $cons = new Common_db();
        $id = $this->input->post('id');
        $invoice = $this->input->post('invoice');
        $this->data = array();
        $billtype = $this->input->post('btype');
        if ($id == 0) {
            if ($billtype == '') {
                $invoice = $this->getinoviceno($or_type);
            } else {
                $invoice = $this->getinoviceno($billtype);
            }
        }
        $phone = $this->input->post('phone');
        // $route = $this->input->post('route');
        // $base_unit = $this->input->post('base_unit');
        // $salesman = $this->input->post('salesman');
        // $vehicle = $this->input->post('vehicle');
        // $area = $this->input->post('area');
        // $deldate = $this->input->post('ddate'); //delivery date
        // $cdate = $this->input->post('cdate'); //credit date 
        $invoicedate = $this->input->post('date');
        $invoicedate = $this->getDate($invoicedate);
        // $commi_amt_hi = $this->input->post('commi_amt_hi');
        $type = $this->input->post('type');
        // $reference = $this->input->post('reference');
        // $freight = $this->input->post('freight'); //Transporting
        // $advance = $this->input->post('advance');
        // $other = $this->input->post('other'); //Coolie
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $tax = $this->input->post('taxtotal');
        // $vehicle = $this->input->post('vehicle');
        $gtotal = $this->input->post('gtotal');
        $customer_id = $this->input->post('customer_id');
        $narration = $or_type . ' Invoice:- ' . $invoice . ' on  ' . $invoicedate;
        $supname = $this->input->post('supname');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $data_sales = array(
            'invoice_date' => $invoicedate,
            'customer_id' => $customer_id,
            // 'cash_type' => $type,
            // 'delivery_date' => $this->getDate($deldate),
            // 'credit_eod' => $this->getDate($cdate),
            'total' => $gtotal,
            // 'salesman' => $salesman,
            // 'route' => $route,
            // 'vehicle' => $vehicle,
            // 'area' => $area,
            // 'tax' => $tax,
            // 'ref_amount' => $commi_amt_hi,
            // 'tax_id' => 0,
            // 'advance' => $advance,
            // 'other' => $other,
            // 'freight' => $freight,
            'discount' => $discount,
            'roundoff' => $rount,
            // 'ref_id' => $reference,
            // 'created_date' => date('Y-m-d H:i:s', time()),
            // 'narration' => $narration,
            // 'created_by' => $created_by,
            // 'type' => $or_type,
            'bill_type' => $billtype,
            'cusname' => $supname,
            // 'cusdetails' => $phone,
            'phone' => $phone,
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
        $godown = $this->input->post('godown', TRUE);
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
                'qtn_id' => $insert_id,
                'item_id' => $item_id[$i],
                'godown' => $godown[$i],
                // 'unit_id' => $unit_item[$i],
                // 'base_unit_id' => $unit_item[$i],
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
        // $this->savesub($data_sales, $or_type, $insert_id, $subtot, $taxtotal, $rount, $id);
        return $insert_id;
    }

}
