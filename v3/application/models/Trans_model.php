<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trans_model
 *
 * @author jijodileep
 */
class Trans_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = '*';
        $this->table = 'tha_sales as a inner join tha_customer as b on a.customer=b.thacu_id'; // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id';
        $this->column_order = array(null, 'name', 'invoice', 'a.date', 'ddate', 'total'); //set column field database for datatable orderable
        $this->column_search = array('name', 'phone', 'invoice', 'a.date', 'ddate', 'total'); //set column field database for datatable searchable 
        $this->order = array('a.tms_id' => 'desc'); // default order 
    }

    // serch tilering items 
    function items($search) {
        $qry = "select  name as label ,a.* from tha_items as a where name like('%$search%') ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    // get the size from the  databse 
    function size() {
        $qry = "select * from tha_size ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getSales($id) {
        $qry = "select   DATE_FORMAT(a.date,'%d/%m/%Y') as in_date,DATE_FORMAT(ddate,'%d/%m/%Y') as del_date,    a.*,b.* from  tha_sales as a inner join tha_customer as b on a.customer=b.thacu_id where tms_id= $id";
        $result = $this->db->query($qry);
        //return $result->result_array();
        echo json_encode($result->result_array());
    }
    function ledbalid($id) {
        $qry = 'select id  from acc_ledgers where ref_code in ("sup","cus") and ref_id = ' . $id . ' limit 1';
        $query = $this->db->query($qry);
        return $query->row_array();
    }
    function getSalesItems($id) {
        $qry = "select a.*,b.* from  tha_sales_items as a inner join tha_items as b on a.item_id=b.thait_id where   a.published='yes' and tms_id= $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function getSalesItemscnt($id) {
        $qry = "select a.*,b.* from  tha_sales_items as a inner join tha_items as b on a.item_id=b.thait_id where   a.published='yes' and tms_id= $id";
        $result = $this->db->query($qry);
       return $result->num_rows();
    }
    function cust($search) {
        $qry = "select  name as label ,a.* from tha_customer as a where name like('%$search%') ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function invoiceno() {
        $qry = "select * from tha_sales order by tms_id desc limit 1";
        $result = $this->db->query($qry);
        if ($result->num_rows() == 0) {
            return date("Y") . '-' . '1';
        } else {
            $query = $result->row_array();
            $res = explode("-", $query['invoice']);
            $num = $res[0] . '-' . ($res[1] + 1);
            return $num;
        }
    }

    function msmentsingle($cust, $type) {
        $qry = "select  *  from tha_messurement where cust_id=$cust and item_id =$type ";
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function msment($mes, $cust, $type) {
        $qry = "select count(*) AS cnt from tha_messurement where cust_id=$cust and item_id =$type ";
        $result = $this->db->query($qry)->row_array();
        $data = array(
            'messurement' => $mes,
            'cust_id' => $cust,
            'item_id' => $type,
            'crdtd' => date('Y-m-d H:i:s', time()),
            'updted' => date('Y-m-d H:i:s', time()),
        );
        if ($result['cnt'] == 0) {
            $this->db->insert('tha_messurement', $data);
        } else {
            $qry = "select  mesid from tha_messurement where cust_id=$cust and item_id =$type ";
            $result = $this->db->query($qry)->row_array();
            $this->db->where('mesid', $result['mesid']);
            $this->db->update('tha_messurement', $data);
        }
    }

    function save() {
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $rdate = $this->input->post('rdate');
        $total = $this->input->post('gtotal');
        $cust = $this->input->post('supid');
        $dtime = $this->input->post('dtime');
        $data = array(
            'date' => $this->getDate($date),
            'ddate' => $this->getDate($rdate),
            'total' => $total,
            'customer' => $cust,
            'dtime' => $dtime,
            'status' => 0,
            'pstatus' => 0
        );

        $insert_id = 0;
        $invoice = 0;
        if ($id == 0) {
            $invoice = $this->invoiceno();
            $data['invoice'] = $this->invoiceno();
            $this->db->insert('tha_sales', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $invoice = $this->input->post('invoice');
            $insert_id = $id;
            $this->db->where('tms_id', $id);
            $this->db->update('tha_sales', $data);
            $qry = "update  tha_sales_items set published ='no' where tms_id =" . $insert_id;
            $this->db->query($qry);
            // $qry = "update  acc_ledger_trans set published ='no' where tb_name='" . $or_type . "' and tb_id =" . $insert_id;
            // $this->db->query($qry);
        }
        $narration= 'Order invoice '.$invoice.' Total amt '.$total;
        $res = $this->getLedgers($cust, '', ' in ("cus","sup")');
        $toid = $res['id'];
        $this->trans_save($invoice, $insert_id, 'Sales', 'Sales', $this->sales, $toid, $this->getDate($date), '0.00', $total, $narration, 1);
        $this->trans_save($invoice, $insert_id, 'Sales', 'Sales',$toid,$this->sales, $this->getDate($date), $total, '0.00', $narration, 1);

        $item_id = $this->input->post('item_id', TRUE);
        $qty = $this->input->post('qty', TRUE);
        $rate = $this->input->post('rate', TRUE);
        $messurement = $this->input->post('messurement', TRUE);
        $itotal = $this->input->post('total', TRUE);
        $exta = $this->input->post('exta', TRUE);
        $siz_id = $this->input->post('siz_id', TRUE);
        $length = sizeof($messurement);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'tms_id' => $insert_id,
                'item_id' => $item_id[$i],
                'qty' => $qty[$i],
                'rate' => $rate[$i],
                'total' => $itotal[$i],
                'messurement' => $messurement[$i],
                'extra' => $exta[$i],
                'siz_id' => $siz_id[$i],
            );
            $this->msment($messurement[$i], $cust, $item_id[$i]);
            $this->db->insert('tha_sales_items', $data);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
