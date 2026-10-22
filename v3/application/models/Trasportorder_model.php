<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trasportorder_model
 *
 * @author dimind
 */
class Trasportorder_model extends DataTable {

    public function __construct() {
        parent::__construct();
        //display another table name when inner joining using ariyas $this->select = 'a.ord_id,a.ord_date as date,b.Name as cone,c.Name as con';//////////////
        $this->select = 'a.ord_id,a.ord_date as date,b.Name as cone,c.Name as con,ordr_sts';
        $this->table = 'tra_order as a inner join   tra_consignee as b on a.consinee_id =b.Id inner join tra_consigner as c on a.consignr_id=c.Id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array('b.Name', 'c.Name', 'ord_date', 'ordr_sts', 'contner_no'); //set column field database for datatable searchable 
        $this->order = array('a.ord_id' => 'desc'); // default order 
    }

    function where() {
        $post = $this->input->post('status');
        $this->wherecondition = "where a.ordr_sts =" . $post;
    }

    function order_del($id) {
        $qry = "delete from tra_order where ord_id =$id";
        $this->db->query($qry);
    }

    function order_save() {
        $pid = $this->input->post('pid');
//        $invoice = $this->input->post('invoice');
        $sdate = $this->input->post('ord_date');
        $consignee = $this->input->post('consignee');
        $consiner = $this->input->post('consiner');
        $pol = $this->input->post('pol');
        $pod = $this->input->post('pod');
        $forworder = $this->input->post('forworder');
        $line = $this->input->post('line');
        $transporter = $this->input->post('transopter');
        $details = $this->input->post('dtls');

        $data = array(
            'ord_date' => $this->getDate($sdate),
            'forwrd_id' => $forworder,
            'line_id' => $line,
            'pol_id' => $pol,
            'pod_id' => $pod,
            'consinee_id' => $consignee,
            'consignr_id' => $consiner,
            'forwrd_id' => $forworder,
            'trspt_id' => $transporter,
            'details' => $details,
            'ordr_sts' => 0);
        $insert_id = 0;
        if ($pid == 0) {
            $this->db->insert('tra_order', $data);
            $insert_id = $this->db->insert_id();
        } else {

            $insert_id = $pid;
            $this->db->where('ord_id', $pid);
            $this->db->update('tra_order', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function order_savetwo() {
        $pid = $this->input->post('pid');
        $invoice = $this->input->post('invoice');
        $sdate = $this->input->post('ord_date');
        $consignee = $this->input->post('consignee');
        $consiner = $this->input->post('consiner');
        $forworder = $this->input->post('forworder');
        $line = $this->input->post('line');
        $transporter = $this->input->post('transopter');
        $container = $this->input->post('container');
        $eta = $this->input->post('eta');
        $etd = $this->input->post('etd');
        $veh = $this->input->post('vehicle');
        $drv = $this->input->post('driver');
        $ddate = $this->input->post('delvery_date');
        $details = $this->input->post('dtls');
        $remark = $this->input->post('remark');



        $data = array(
            'ord_date' => $this->getDate($sdate),
            'forwrd_id' => $forworder,
            'line_id' => $line,
            'consinee_id' => $consignee,
            'consignr_id' => $consiner,
            'forwrd_id' => $forworder,
            'trspt_id' => $transporter,
            'contner_no' => $container,
            'vhicle' => $veh,
            'driver' => $drv,
            'details' => $details,
            'delvery_date' => $this->getDate($ddate),
            'estd_date' => date('Y-m-d H:i:s', time()),
            'confrd_date' => date('Y-m-d H:i:s', time()),
            'eta' => $eta,
            'etd' => $etd,
            'remarks' => $remark,
            'ordr_sts' => 1
        );
        $insert_id = 0;
        if ($pid == 0) {
            $this->db->insert('tra_order', $data);
            $insert_id = $this->db->insert_id();
        } else {
            //  $invoice = $this->input->post('invoice');
            $insert_id = $pid;
            $this->db->where('ord_id', $pid);
            $this->db->update('tra_order', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            // 'bill' => base_url() . 'transaction/order/bill/' . $insert_id,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getorder($id) {
        $qry = 'select * from tra_order where ord_id=' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function getcont($id) {
        $qry = 'select DATE_FORMAT(ord_date,"%d/%m/%Y") as odate,DATE_FORMAT(delvery_date,"%d/%m/%Y") as ddate, a.* from tra_order as a  where ord_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

}
