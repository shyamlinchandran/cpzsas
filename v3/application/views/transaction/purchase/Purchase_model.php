<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Purchase_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = 'purchase as a inner join suppliers as b on a.supplier_id =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name', 'invoice', 'rdate'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
        $this->select = 'a.type as ptype, a.id as pid,a.*,b.*';
    }

//add custom filter here
    function where() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        if ($this->input->post('supid')) {
            $this->db->where('supplier_id', $this->input->post('supid'));
        }
         if ($this->input->post('type')) {
            $this->wherecondition = "where a.type = '" . $this->input->post('type') . "' and a.created_by ='".$userid."'";
        }
        if ($this->input->post('invoice')) {
            $this->db->like('invoice', $this->input->post('invoice'));
        }
    }
    function getpurchaseItems($id, $len, $size) {
        $qry = "select  g.*, h.hsncode as hsncd,a.mrp as mrps, a.*,b.* from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner join taxgst as g on a.tax_id=g.gstid where purchase_id= $id and a.published='yes' limit $len,$size";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

     function getpurchase($id) {
        $qry = "select a.published as pub, DATE_FORMAT(date,'%d-%m-%Y') as in_date,  a.type as ptp, a.*,b.* from purchase as a left join suppliers as b on a.supplier_id=b.id where a.id= $id";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
  

    function getHsnItems($id) {
        $qry = " select h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getHsnItemscnt($id) {
        $qry = " select  h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST from purchase_items as a inner join item as b on a.item_id= b.id inner join hsncode as h on h.hsnid=b.hsncode inner JOIN taxgst as tg on b.tax_id=tg.gstid where a.purchase_id=$id and a.published='yes' group by h.hsncode,tg.cgst,tg.sgst,tg.igst,tg.GST";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }
     private function getinoviceno($type) {
       
    $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
    $query1 = $this->db->query($qry1);
    $query1 = $query1->row_array();
    $code=$query1['preffix'].$query1['seperator'].$query1['startnumber'].$query1['seperator'].$query1['suffix'];
        $qry = "SELECT invoice FROM  purchase  where  bill_type='" . $type . "' and published='yes'  order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res=str_replace($query1['preffix'],"",$query['invoice']);
            $res=str_replace($query1['suffix'],"",$res);
            $res=str_replace($query1['seperator'],"",$res);

              $res=$res+1;
              $num = $query1['preffix'].$query1['seperator'].$res.$query1['seperator'].$query1['suffix'];
            return $num;
        }
    }

    function getpurchaseItemscnt($id) {
        $qry = "select  * from purchase_items as a inner join item as b on a.item_id= b.id  where purchase_id= $id";
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    public function alreadyexistcheck($invoice, $supplier) {
        $qry = "select count(*) as cnt from purchase where invoice='$invoice' and supplier_id =$supplier";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    public function save($or_type) {
        //  $cons = new Common_db();
       
        $id = $this->input->post('p_id');
        $route = $this->input->post('route');
        $vehicle = $this->input->post('vehicle');
        $billtype = $this->input->post('btype');
        $billingname = $this->input->post('billingname');
        $area = $this->input->post('area');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        if($or_type=='purchase'){       
         $invoice = $this->input->post('invoice');
             if ($billtype == "") {
                $billno = $this->getinoviceno($or_type);
            } else {
                $billno = $this->getinoviceno($billtype);
            }
        }
        else
        {
            if ($billtype == "") {
                $billno = $this->getinoviceno($or_type);
                $invoice = $billno;
               
            } else {
                $billno = $this->getinoviceno($billtype);
                $invoice = $billno;
            }
        }
        $salesman = $this->input->post('salesman');
        $date = $this->input->post('date');
        $rdate = $this->input->post('rdate');
        $type = $this->input->post('type');
        $tax_common = $this->input->post('tax_common');
        $freight = $this->input->post('freight');
        $other = $this->input->post('other');
        $discount = $this->input->post('discount');
        $rount = $this->input->post('rount');
        $tax = $this->input->post('tax');
        $taxtotal = $this->input->post('taxtotal');
        $gtotal = $this->input->post('gtotal');
        $supid = $this->input->post('supid');
        $narration = 'Purchase invoice' . $invoice . ' on  ' . $date;

        if ($this->alreadyexistcheck($invoice, $supid) != 0 && $id == 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'Alreay Exist.'
            );
            echo json_encode($response);
            return;
        }
        $data = array(
            'invoice' => $invoice,
            'bill_no' => $billno,
            'supplier_id' => $supid,
            'cash_type' => $type,
            'date' => $this->getDate($date),
            'rdate' => $this->getDate($rdate),
            'total' => $gtotal,
            'tax' => $taxtotal,
            'tax_id' => $tax_common,
             'salesman' => $salesman,
            'route' => $route,
            'vehicle' => $vehicle,
            'area' => $area,
             'bill_type' => $billtype,
            'other' => $other,
            'freight' => $freight,
            'discount' => $discount,
            'roundoff' => $rount,
            'created_date' => date('Y-m-d H:i:s'),
            'narration' => $narration,
             'billing_name' => $billingname,
            'created_by' => $userid,
            'type' => $or_type,
            'published' => 'yes',
        );
        $insert_id = 0;
        if ($id == 0) {
            $this->db->insert('purchase', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('id', $id);
            $this->db->update('purchase', $data);
            if($or_type!='purchase_order'){
            if($or_type == 'purchase'){
                 $this->restorestock($insert_id, 'pur');
            }
            else if($or_type == 'purchase_return'){
                $this->restorestock($insert_id, 'sales');
            }
             $ttp = 'cr';
             if ($or_type == 'purchase_return') {
                $ttp = 'dt';
            }
            $this->restore_godown_stock_trans($id,$ttp);
         }
           
            $qry = "update  purchase_items set published ='no' where purchase_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  item_ledger set published ='no' where trans_status='" . $or_type . "' and trans_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='" . $or_type . "' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }
        /* // not using now 
          $supname = $this->input->post('supname');
          $phone = $this->input->post('phone');
          $email = $this->input->post('email');
          $cst = $this->input->post('cst');
          $tin = $this->input->post('tin');
          $address_line1 = $this->input->post('address_line1');
          $address_line2 = $this->input->post('address_line2');
          $details = $this->input->post('details');
         */
        $item_id = $this->input->post('item_id', TRUE);
        $item_qty = $this->input->post('item_qty', TRUE);
        $unit_item = $this->input->post('unit_item', TRUE);
        $godown = $this->input->post('godown', TRUE);
        $tax_item = $this->input->post('tax_item', TRUE);
        $mrp_item = $this->input->post('mrp_item', TRUE);
        $prate_item = $this->input->post('prate_item', TRUE);
        $tax_amount = $this->input->post('tax_amount', TRUE);
        $dis_item = $this->input->post('dis_item', TRUE);
        $rowTotal = $this->input->post('rowTotal');
        $length = sizeof($mrp_item);
        $invoicedate = $rdate;
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'purchase_id' => $insert_id,
                'item_id' => $item_id[$i],
                'unit_id' => $unit_item[$i],
                'godown' => $godown[$i],
                'base_unit_id' => $unit_item[$i],
                'quantity' => $item_qty[$i],
                'rate' => $prate_item[$i],
                'mrp' => $mrp_item[$i],
                'tax_id' => $tax_item[$i],
                'tax' => $tax_amount[$i],
                'discount' => $dis_item[$i],
                'total' => $rowTotal[$i],
                'published' => 'yes'
            );
           if($or_type!='purchase_order'){
            $this->tax_add($tax_item[$i], $rowTotal[$i], $tax_amount[$i]);
           }
            $this->db->insert('purchase_items', $data);
            if($or_type!='purchase_order'){
            $itemData = array(
                'MRP' => $mrp_item[$i],
                'prate' => $prate_item[$i]
            );
            $this->db->where('id', $item_id[$i]);
            $this->db->update('item', $itemData);
            $ttp = 'dt';
             if ($or_type == 'purchase_return') {
                $ttp = 'cr';
            }
            $this->stock_trans(0, $item_id[$i], $item_qty[$i], $this->getDate($invoicedate), $ttp, $or_type, $insert_id, $prate_item[$i], $mrp_item[$i], $tax_item[$i],$godown[$i]);
            $this->godown_stock_trans(0, $item_id[$i], $item_qty[$i], $ttp, $or_type,$godown[$i]);
            }

        }
        if($or_type!='purchase_order'){
        $res = $this->getLedgers($supid, '', ' in ("cus","sup")');
        $toid = 0;
          //this is for ageging  
        
        if ($type == 'Cash') {
            $toid = $this->cashaccount;
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $this->purchase, $this->cashaccount, $this->getDate($rdate), $gtotal, '0.00', $narration, 1);
        } else {
            $toid = $res['id'];
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $this->purchase, $res['id'], $this->getDate($rdate), $gtotal, '0.00', $narration, 1);
            $this->addAgeing($id,$invoice, $insert_id, $or_type, $this->getDate($rdate), $this->getDate($rdate), $res['id'], date('Y-m-d H:i:s', time()),  $gtotal,0, 0, 0, 0);
  
        }
        $subtot = $this->input->post('subtot');
        $taxtotal = $this->input->post('taxtotal');
        $salesamount = $subtot - $taxtotal;
        $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $toid, $this->purchase, $this->getDate($invoicedate), '0.00', $salesamount, $narration, 1);
        if ($rount > 0) {
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $toid, $this->rount, $this->getDate($invoicedate), '0.00', $rount, $narration, 1);
        }
        if ($rount < 0) {
            $rount = $rount * -1;
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $toid, $this->rount, $this->getDate($invoicedate), $rount, '0.00', $narration, 1);
        }
        if (is_numeric($discount) == true && $discount != 0) {
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $toid, $this->discount, $this->getDate($rdate), $discount, '0.00', $narration, 1);
        }
        if (is_numeric($freight) == true && $freight != 0) {
            $this->trans_save($invoice, $insert_id, $or_type, 'purchase', $toid, $this->purchaseFr, $this->getDate($rdate), '0.00', $freight, $narration, 1);
        }
        $this->tax_save($invoice, $insert_id, $or_type, $toid, $this->getDate($invoicedate), $narration, $or_type);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
   

}
