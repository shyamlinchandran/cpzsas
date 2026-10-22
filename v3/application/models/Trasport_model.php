<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trasport_model
 *
 * @author jijodileep
 */
class Trasport_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' a.*,b.*';
        $this->table = 'tra_purchase as a inner join tra_forworder as b on a.forworder =b.id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array('sdate', 'rdate', 'invoice', 'container', 'b.Name'); //set column field database for datatable searchable 
        $this->order = array('a.pid' => 'desc'); // default order 
    }

    public function sales() {
        $this->select = ' a.*,b.*';
        $this->table = 'tra_sales as a inner join   tra_consignee as b on a.consignee =b.id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array(); //set column field database for datatable searchable 
        $this->order = array('a.pid' => 'desc'); // default order 
    }

    function getpurchaseauto($search) {
        $qry = "select a.container as label,DATE_FORMAT(sdate,'%d/%m/%Y' ) as s_date,DATE_FORMAT(rdate, '%d/%m/%Y' ) as r_date,a.* from  tra_purchase  as a  where is_sale=0 and container like( '%$search%' )";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getpurchase($id) {
        $qry = 'select DATE_FORMAT(sdate,"%d/%m/%Y") as s_date,DATE_FORMAT(rdate,"%d/%m/%Y") as r_date, a.* from tra_purchase as a  where pid=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getsales($id) {
        $qry = 'select DATE_FORMAT(sdate,"%d/%m/%Y") as s_date,DATE_FORMAT(rdate,"%d/%m/%Y") as r_date, a.* from tra_sales as a  where pid=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getorder() {
        $qry = "Select * from tra_order where ordr_sts =1";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getpurchaseitem($id) {
        $qry = 'select * from tra_pitems  where pid=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getsalesitem($id) {
        $qry = 'select * from tra_sitems where pid=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getpurchaseno($id) {
        $qry = 'select * from tra_purchase where pid=' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function getsalesno($id) {
        $qry = 'select * from tra_sales where pid=' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function charges($id) {

        $qry = "select * from    tra_charges  where";
        if ($id == 0) {
            $qry = $qry . ' is_master =1';
        }
        if ($id != 0) {
            $qry = $qry . ' fk_charge=' . $id;
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tax($id) {
        $qry = "SELECT b.id,b.name,a.percent,b.published  FROM `tra_tax_charge` as a inner JOIN tax as b on a.`tax`= b.id where charge=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tra_forworder() {
        $qry = "select * from tra_forworder ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_driver() {
        $qry = "select * from tra_driver ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_vehicle() {
        $qry = "select * from tra_vehicle ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_consignee() {
        $qry = "select * from tra_consignee ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_consigner() {
        $qry = "select * from tra_consigner ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tha_pickup() {
        $qry = "select * from tha_pickup ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_line() {
        $qry = "select * from tra_line ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_delivery() {
        $qry = "select * from tra_delivery ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_vessal() {
        $qry = "select * from tra_vessal";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function tra_transport() {
        $qry = "select * from tra_transport";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function save() {
        $id = $this->input->post('pid');
        $invoice = $this->input->post('invoice');
        $sdate = $this->input->post('sdate');
        $rdate = $this->input->post('rdate');
        $forworder = $this->input->post('forworder');
        $line = $this->input->post('line');
        $in = $this->input->post('inv');
        $comment = $this->input->post('comment');
        $container = $this->input->post('container');
        $vessal = $this->input->post('vessal');
        $pol = $this->input->post('pol');
        $pod = $this->input->post('pod');
        $consignee = $this->input->post('consignee');
        $consiner = $this->input->post('consiner');
        $aditon = $this->input->post('aditon');
        $substration = $this->input->post('substration');
        $gtotal = $this->input->post('gtotal');
        $round = $this->input->post('round');
        $refino = $this->input->post('refino');
        $inoval = $this->input->post('inoval');
        $qtybox = $this->input->post('qtybox');
        $comm = $this->input->post('transport');
        $transport = $this->input->post('transport');
        $tb_name = 'SPurchase';
        $eta = $this->input->post('eta');
        $etd = $this->input->post('etd');
        $data = array(
            'invoice' => $invoice,
            'sdate' => $this->getDate($sdate),
            'rdate' => $this->getDate($rdate),
            'forworder' => $forworder,
            'line' => $line,
            'invoice_nmbr' => $in,
            'comment' => $comment,
            'container' => $container,
            'vessal' => $vessal,
            'pol' => $pol,
            'pod' => $pod,
            'consignee' => $consignee,
            'consiner' => $consiner,
            'aditon' => $aditon,
            'substration' => $substration,
            'gtotal' => $gtotal,
            'round' => $round,
            'is_sale' => 0,
            'crdtd_date' => date('Y-m-d H:i:s', time()),
            'refinno' => $refino,
            'invoicevalue' => $inoval,
            'qtyinbox' => $qtybox,
            'transport' => $transport,
            'eta' => $eta,
            'etd' => $etd,
            'commidities' => $comm);
        $insert_id = 0;
        $qry = "update  `tra_order` set ordr_sts =2 where  `contner_no`  ='" . trim($container) . "'";
        $this->db->query($qry);
        $instp = 0;
        $or_type = 'Purchase';
        if ($id == 0) {
            $this->db->insert('tra_purchase', $data);
            $insert_id = $this->db->insert_id();
        } else {
            //  $invoice = $this->input->post('invoice');
            $instp = $id;
            $insert_id = $id;
            $this->db->where('pid', $id);
            $this->db->update('tra_purchase', $data);
            // $qry = "delete from tra_pitems  where pid =" . $insert_id;
            //$this->db->query($qry);
            $qry = 'update acc_ageing  set status =5  where  tb_name="' . $or_type . '" and tb_id =' . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='$tb_name' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }
        if ($transport > 0) {
            $tranap = $this->input->post('tptotal');
            $res = $this->getLedgers($transport, '', '="trs"');
            $narration = "Total GTA From " . $res['name'] . ':Invoice-' . $invoice;
            $toid = $res['id'];
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $this->purchase, $toid, $this->getDate($rdate), $tranap, '0.00', $narration, 1);
        }
        $forworder_led = $this->getLedgers($forworder, '', '="fwr"');
        $narration = $forworder_led['name'] . ':Invoice- P :' . $invoice;
        $toid = $forworder_led['id'];
        $this->addAgeing($invoice, $insert_id, $or_type, $this->getDate($rdate), $this->getDate($rdate), $toid, date('Y-m-d H:i:s', time()), $gtotal, 0, 0, 0, 0);

        //trans_save($voucher_no, $tb_id, $tb_name, $tran_tp, $toid, $from, $date, $credit, $debit, $narration, $created_by) 
        $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $this->purchase, $toid, $this->getDate($rdate), $gtotal, '0.00', $narration, 1);

        if ($substration > 0) {
            $narration = "Discount applied for  " . $invoice;
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->discount, $this->getDate($rdate), $substration, '0.00', $narration, 1);
        }
        if ($aditon > 0) {
            $narration = "Addition applied for " . $invoice;
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->addition, $this->getDate($rdate), 0.00, $aditon, $narration, 1);
        }
        $narration = "Round Off applied for " . $invoice;
        if ($round > 0) {
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->rount, $this->getDate($rdate), '0.00', $round, $narration, 1);
        }
        if ($round < 0) {
            $round = $round * -1;
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->rount, $this->getDate($rdate), $round, '0.00', $narration, 1);
        }

        $qry = 'select * from    tra_charges';
        $result = $this->db->query($qry)->result_array();

        foreach ($result as $sing) {
            $name = 'schr' . $sing['Id'];
            $this->insertupdate($insert_id, $name, $this->input->post($name), $sing['Id'], 'char', $instp);
            $narration = '' . $sing['Name'];


            if ($sing['is_ledger'] == 1) {
                $res = $this->getLedgers($sing['Id'], '', '="cha"');
                $salesamount = $this->input->post($name);
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $res['id'], $this->getDate($rdate), '0.00', $salesamount, $narration, 1);
            }

            if ($sing['is_master'] == 1) {
                $this->taxcalc($sing['Id'], $insert_id, $invoice, $or_type, $rdate, $narration, $toid, $instp);
                $name = 'tot' . $sing['Id'];
                $this->insertupdate($insert_id, $name, $this->input->post($name), $sing['Id'], 'char', $instp);
                $narration = 'Items ' . $sing['Name'];
            }
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            // 'bill' => base_url() . 'transaction/sales/bill/' . $insert_id,
            'message' => $this->msgcheck($insert_id, $tb_name)
        );
        echo json_encode($response);
    }

    function invoiceno() {
        $qry = "select * from tra_sales order by pid desc limit 1";
        $result = $this->db->query($qry);
        if ($result->num_rows() == 0) {
            return '1'; //date("Y") . '-' . 
        } else {
            $query = $result->row_array();
            $num = $query['invoice'] + 1; //$res[0] . '-' . ();
            return $num;
        }
    }

    function sales_save() {
        $id = $this->input->post('pid');
        $invoice = $this->input->post('invoice');
        $sdate = $this->input->post('sdate');
        $rdate = $this->input->post('rdate');
        $forworder = $this->input->post('forworder');
        $line = $this->input->post('line');
        $comment = $this->input->post('comment');
        $container = $this->input->post('container');
        $vessal = $this->input->post('vessal');
        $pol = $this->input->post('pol');
        $pod = $this->input->post('pod');
        $consignee = $this->input->post('consignee');
        $consiner = $this->input->post('consiner');
        $aditon = $this->input->post('aditon');
        $substration = $this->input->post('substration');
        $gtotal = $this->input->post('gtotal');
        $round = $this->input->post('round');
        $refino = $this->input->post('refino');
        $inoval = $this->input->post('inoval');
        $qtybox = $this->input->post('qtybox');
        $comm = $this->input->post('comm');
        $veh_id = $this->input->post('veh_id');
        $dr_id = $this->input->post('dr_id');
        $pid_p = $this->input->post('pid_p');
        $transport = $this->input->post('transport');
        $eta = $this->input->post('eta');
        $etd = $this->input->post('etd');
        $status = $this->input->post('status');
        $data = array(
            'sdate' => $this->getDate($sdate),
            'rdate' => $this->getDate($rdate),
            'forworder' => $forworder,
            'line' => $line,
            'comment' => $comment,
            'container' => $container,
            'vessal' => $vessal,
            'pol' => $pol,
            'pod' => $pod,
            'consignee' => $consignee,
            'consiner' => $consiner,
            'aditon' => $aditon,
            'substration' => $substration,
            'gtotal' => $gtotal,
            'round' => $round,
            'is_sale' => 0,
            'crdtd_date' => date('Y-m-d H:i:s', time()),
            'refinno' => $refino,
            'invoicevalue' => $inoval,
            'qtyinbox' => $qtybox,
            'vhno' => $veh_id,
            'drno' => $dr_id,
            'pid_p' => $pid_p,
            'transport' => $transport,
            'eta' => $eta,
            'etd' => $etd,
            'status' => $status,
            'commidities' => $comm);
        $insert_id = 0;
        $sts = 0;
        $pdata = array(
            'is_sale' => 1
        );
        $tb_name = 'SSales';
        $this->db->where('pid', $pid_p);
        $this->db->update('tra_purchase', $pdata);
        $data['invoice'] = $this->input->post('invoice'); // $this->invoiceno(); // auto gen
        $or_type = 'Sales';
        if ($id == 0) {
            $this->db->insert('tra_sales', $data);
            $insert_id = $this->db->insert_id();
        } else {
            //  $invoice = 
            $sts = $id;
            $insert_id = $id;
            $this->db->where('pid', $id);
            $this->db->update('tra_sales', $data);
            $qry = 'update acc_ageing  set status =5  where  tb_name="' . $or_type . '" and tb_id =' . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='$tb_name' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }

        $forworder_led = $this->getLedgers($consignee, '', '="con"');
        $narration = $forworder_led['name'] . ':Invoice- S:' . $invoice;
        $toid = $forworder_led['id'];
        if ($status == 1) {
            $this->addAgeing($invoice, $insert_id, $or_type, $this->getDate($rdate), $this->getDate($rdate), $toid, date('Y-m-d H:i:s', time()), 0, $gtotal, 0, 0, 0);
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $this->sales, $toid, $this->getDate($rdate), '0.00', $gtotal, $narration, 1);

            if ($substration > 0) {
                $narration = "Discount applied for  " . $invoice;
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->discount, $this->getDate($rdate), '0.00', $substration, $narration, 1);
            }
            if ($aditon > 0) {
                $narration = "Addition applied for " . $invoice;
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->addition, $this->getDate($rdate), $aditon, 0.00, $narration, 1);
            }
            $narration = "Round Off applied for " . $invoice;
            if ($round > 0) {
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->rount, $this->getDate($rdate), $round, '0.00', $narration, 1);
            }
            if ($round < 0) {
                $round = $round * -1;
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $this->rount, $this->getDate($rdate), '0.00', $round, $narration, 1);
            }
        }

        $qry = 'select * from    tra_charges';
        $result = $this->db->query($qry)->result_array();

        foreach ($result as $sing) {
            $name = 'schr' . $sing['Id'];
            $this->insertupdatesale($insert_id, $name, $this->input->post($name), $sing['Id'], 'char', $sts);
            $narration = '' . $sing['Name'];
            if ($sing['is_ledger'] == 1) {
                if ($status == 1) {
                    $res = $this->getLedgers($sing['Id'], '', '="cha"');
                    $salesamount = $this->input->post($name);
                    $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $res['id'], $this->getDate($rdate), $salesamount, '0.00', $narration, 1);
                }
            }
            if ($sing['is_master'] == 1) {
                $this->taxcalcs($sing['Id'], $insert_id, $invoice, $or_type, $rdate, $narration, $toid, $sts,$status);
                $name = 'tot' . $sing['Id'];
                $narration = 'Items ' . $sing['Name'];
                $this->insertupdatesale($insert_id, $name, $this->input->post($name), $sing['Id'], 'char', $sts);
            }
        }
        $url = base_url() . 'transport/sales/generateBill/' . $insert_id;
        if ($this->msgcheckcnt($insert_id, $tb_name) == 0) {
            $url = '';
        }
        $response = array(
            'valid' => false,
            'type' => $this->msgcheckcnt($insert_id, $tb_name),
            'bill' => $url,
            'message' => $this->msgcheck($insert_id, $tb_name)
        );
        echo json_encode($response);
    }

    function taxcalc($id, $insert_id, $invoice, $or_type, $rdate, $narration, $toid, $instp) {
        $tb_name = 'SPurchase';
        $taxqry = 'select * from    tax';
        $taxresult = $this->db->query($taxqry)->result_array();
        foreach ($taxresult as $tsing) {
            $name = 'tax' . $tsing['id'] . $id;
//            $data = array(
//                'pid' => $insert_id,
//                'txtname' => $name,
//                'value' => $this->input->post($name),
//                'tid' => $tsing['id'],
//                'type' => 'taxc',
//            ); 
//            $this->itemsave('tra_pitems', $data);
            $nsm = $tsing['name'] . ' Tax  :-' . $narration;
            $this->insertupdate($insert_id, $name, $this->input->post($name), $tsing['id'], 'taxc', $instp);
            $res = $this->getLedgers($tsing['id'], '', '="Tax"');
            $salesamount = $this->input->post($name);
            $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $res['id'], $this->getDate($rdate), '0.00', $salesamount, $nsm, 1);
        }
    }

    function taxcalcs($id, $insert_id, $invoice, $or_type, $rdate, $narration, $toid, $sts,$status) {
        $taxqry = 'select * from    tax';
        $taxresult = $this->db->query($taxqry)->result_array();
        foreach ($taxresult as $tsing) {
            $name = 'tax' . $tsing['id'] . $id;
//            $data = array(
//                'pid' => $insert_id,
//                'txtname' => $name,
//                'value' => ,
//                'tid' => ,
//                'type' => ,
//            );
            $tb_name = 'SSales';
            //$this->itemsave('tra_sitems', $data);
            $this->insertupdatesale($insert_id, $name, $this->input->post($name), $tsing['id'], 'taxc', $sts);
            $nsm = $tsing['name'] . ' Tax  :-' . $narration;
            if ($status == 1) {
                $res = $this->getLedgers($tsing['id'], '', '="Tax"');
                $salesamount = $this->input->post($name);
                $this->trans_save($invoice, $insert_id, $tb_name, $or_type, $toid, $res['id'], $this->getDate($rdate), $salesamount, '0.00', $nsm, 1);
            }
        }
    }

    function insertupdate($insert_id, $name, $val, $tid, $typ, $sts) {
        if ($sts == 0) {
            $data = array(
                'pid' => $insert_id,
                'txtname' => $name,
                'value' => $val,
                'tid' => $tid,
                'type' => $typ,
            );

            $this->itemsave('tra_pitems', $data);
        } else {
            $qry = "update tra_pitems set value='" . $val . "'  where pid = " . $insert_id . " and  txtname='" . $name . "'";
            $this->db->query($qry);
        }
    }

    function insertupdatesale($insert_id, $name, $val, $tid, $typ, $sts) {
        if ($sts == 0) {
            $data = array(
                'pid' => $insert_id,
                'txtname' => $name,
                'value' => $val,
                'tid' => $tid,
                'type' => $typ,
            );

            $this->itemsave('tra_sitems', $data);
        } else {
            $qry = "update tra_sitems set value='" . $val . "'  where pid = " . $insert_id . " and  txtname='" . $name . "'";
            $this->db->query($qry);
        }
    }

    function itemsave($table, $data) {
        $this->db->insert($table, $data);
        $insert_id = $this->db->insert_id();
        return $insert_id;
    }

}
