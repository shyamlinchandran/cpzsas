<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class ItemstockEntry_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = 'item_stock_entry as a';
        $this->column_order = array(null, 'total', null); //set column field database for datatable orderable
        $this->column_search = array('total'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->select = '*';
    }

    function wheresupplier() {
//        $tmp = $this->session->userdata('user');
//        $userid = $tmp['Id'];
//        $id = $this->input->post('supid');
//        if ($this->input->post('stype')) {
//            $this->wherecondition = "where a.type = '" . $this->input->post('stype') . "' and a.created_by = " . $userid . " and a.supplier_id = " . $id;
//        }
    }

//add custom filter here
    function delete($id) {
        
    }

    function zeroindex() {
        $qry = 'select * from taxgst where GST="0" limit 1';
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function cancel($id) {
        
    }

    function where() {
        
    }

    function getsing($id) {
        $qry = "SELECT  a.*,b.*,c.name,c.barcode,d.godown_name,u.name as uname,GST FROM `item_stock_entry` as a  INNER JOIN item_stock_entry_items as b on a.id=b.stock_entry_id inner join item as c on c.id=b.item_id inner join ims_godown as d on d.id=b.godown_id inner join units as u on u.id=b.unit_id inner join taxgst as t on t.gstid=b.tax_id WHERE b.published='yes' and a.id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getpurchaseItems($id, $len, $size) {
        $qry = "";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchase($id) {
        $qry = "";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItems($id) {
        $qry = "";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = "";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    function restore_stock($id, $type) {
        $qry = "select * from item_stock_entry_items where stock_entry_id=$id and published='yes' ";
        $query1 = $this->db->query($qry)->result_array();
        foreach ($query1 as $ms) {
            if ($ms['godown_id'] != 0) {
                $qry = 'select count(id) as no,current_stock  from item_godown where item_id=' . $ms['item_id'] . ' and godown_id=' . $ms['godown_id'];
                $query = $this->db->query($qry)->row_array();
                $current_stock = $query['current_stock'];
                $oldstock = $current_stock;
                $qty = $this->getquantity($ms['unit_id'], $ms['quantity'], $ms['item_id']);
                $current_stock = $current_stock - $qty;
                $qry = "update item_godown set current_stock=" . $current_stock . " where godown_id =" . $ms['godown_id'] . " and item_id=" . $ms['item_id'];
                $this->db->query($qry);
            }
        }
    }

    private function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $qry = "SELECT invoice FROM  item_stock_entry  where  bill_type='" . $type . "' and published='yes'  order by id desc limit 0,1";
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

    function getpurchaseItemscnt($id) {
        $qry = "";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    public function save() {
        $curr_value = 1;
        $com_currency = $this->input->post('com_currency');
        $comset_currency = $this->input->post('comset_currency');
        if ($comset_currency != $com_currency) {
            $curr_value = $this->input->post('curr_value');
        }
        $is_mul_led = $this->input->post('is_multipletax');
        $id = $this->input->post('p_id');
        $is_taxincuded = $this->input->post('is_taxincuded');
        $billtype = $this->input->post('btype');
        $branch = $this->getbranch($billtype);
        $printtype = $this->input->post('printtype');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $billno = $this->getinoviceno($billtype);
        $invoice = $this->getinoviceno($billtype);
        $salesman = $this->input->post('salesman');
        $date = $this->input->post('date');
        $tax_common = $this->input->post('tax_common');
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $taxtotal = $this->input->post('taxtotal');
        $gtotal = $this->input->post('gtotal');
        $narration = 'Item Stck Entry invoice' . $invoice . ' on  ' . $date;
        $data = array(
            'invoice' => $invoice,
            'currency_id' => $com_currency,
            'cur_exc_amt' => $curr_value,
            'date' => $this->getDate($date),
            'total' => $gtotal,
            'tax_total' => $taxtotal,
            'salesman' => $salesman,
            'bill_type' => $billtype,
            'printtype' => $printtype,
            'discount' => $discount,
            'roundoff' => $rount,
            'updatedate' => date('Y-m-d H:i:s'),
            'narration' => $narration,
            'updated_by' => $userid,
            'published' => 'yes',
        );
        $insert_id = 0;
        if ($id == 0) {
            $data['invoice'] = $invoice;
            $this->db->insert('item_stock_entry', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $data['invoice'] = $this->input->post('invoice');
            $insert_id = $id;
            $this->db->where('id', $id);
            $this->db->update('item_stock_entry', $data);
            $this->restore_stock($id, 'stock_entry');
            $qry = "update  item_stock_entry_items set published ='no' where stock_entry_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  item_ledger set published ='no' where trans_status='stock_entry' and trans_id =" . $insert_id;
            $this->db->query($qry);
        }
        $item_id = $this->input->post('item_id', TRUE);
        $item_qty = $this->input->post('item_qty', TRUE);
        $unit_item = $this->input->post('unit_item', TRUE);
        $godown = $this->input->post('godown', TRUE);
        $tax_item = $this->input->post('tax_item', TRUE);
        $sub_id = $this->input->post('sub_id', TRUE);
        $mrp_item = $this->input->post('mrp_item', TRUE);
        $prate_item = $this->input->post('prate_item', TRUE);
        $is_taxincluded = $this->input->post('is_taxincuded', TRUE);
        $tax_amount = $this->input->post('tax_amount', TRUE);
        $itmdtn = $this->input->post('itmdtn', TRUE);
        $dis_item = $this->input->post('dis_item', TRUE);
        $dis_amt = $this->input->post('dis_amt', TRUE);
        $rowTotal = $this->input->post('rowTotal', TRUE);
        $analytics = 0;
        $length = sizeof($mrp_item);
        $invoicedate = $date;
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'analytics' => $analytics,
                'sub_id' => $sub_id[$i],
                'stock_entry_id' => $insert_id,
                'discount_amount' => $dis_amt[$i],
                'item_id' => $item_id[$i],
                'unit_id' => $unit_item[$i],
                'godown_id' => $godown[$i],
                'item_discription' => $itmdtn[$i],
                'base_unit_id' => $unit_item[$i],
                'is_taxincluded' => $is_taxincluded[$i],
                'quantity' => $item_qty[$i],
                'rate' => $prate_item[$i],
                'mrp' => $mrp_item[$i],
                'tax_id' => $tax_item[$i],
                'tax' => $tax_amount[$i],
                'discount' => $dis_item[$i],
                'total' => $rowTotal[$i],
                'published' => 'yes'
            );
            if ($this->input->post('analytics_id')) {
                $data['analytics'] = $analytics[$i];
            }
            if ($sub_id[$i] == 0) {
                $this->db->insert('item_stock_entry_items', $data);
            } else {
                $this->db->where('sub_id', $sub_id[$i]);
                $this->db->where('stock_entry_id', $insert_id);
                $this->db->update('item_stock_entry_items', $data);
            }

            $pur_rate = $prate_item[$i];
            if ($dis_item[$i] != 0 && $pur_rate != 0 && $dis_item[$i] != "" && $pur_rate != "") {
                $disamt = ($pur_rate * $dis_item[$i]) / 100;
                $pur_rate = $pur_rate - $disamt;
            }
            $pur_rate = $this->getbaserate($unit_item[$i], $pur_rate, $item_id[$i]);
            $itemData = array(
                'MRP' => $mrp_item[$i],
                'prate' => $pur_rate * $curr_value
            );
            $this->db->where('id', $item_id[$i]);
            $this->db->update('item', $itemData);
            $ttp = 'dt';
            $or_type = 'stock_entry';
            $qty = $this->getquantity($unit_item[$i], $item_qty[$i], $item_id[$i]);
            $this->stock_trans(0, $item_id[$i], $qty, $this->getDate($date), $ttp, $or_type, $insert_id, $prate_item[$i], $mrp_item[$i], $tax_item[$i], $godown[$i], $invoice);
            $this->godown_stock_trans(0, $item_id[$i], $qty, $ttp, $or_type, $godown[$i]);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
