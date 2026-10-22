<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Doctors_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.*,c.Pro_Id,d.*';
        $this->table = 'cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id left join cli_bookingprocedures as c on c.Bok_Id=a.Bok_Id inner join cli_doctor as d on d.Doc_Id=a.Doc_Id';
        $this->column_search = array('b.Pat_Name', 'a.Bok_Id');
        $this->order = array('a.Bok_Id' => 'desc');
    }

    function where() {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $now = new DateTime();  
        $this->wherecondition = "where Bok_Date =CURDATE() and a.Bok_Approved in ('Approve','Checked','Payed') ";
        $this->wherecondition = $this->wherecondition . " and a.Cat_Id =" . $branch;
    }

    function getproducts($id) {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        //echo $qry;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function Details($id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $id . ' order by Bok_Date desc';
        $query = $this->db->query($qry)->row_array();
        $patient = $query['Cus_Id'];
        $qry = 'select * from cli_booking  where     Bok_Approved in ("Checked","Payed")  and Cus_Id=' . $patient . ' order by Bok_Date desc';
        $details = $this->db->query($qry);
        return $details->result_array();
    }

    function Obsdate($id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $id . ' order by Bok_Date desc';
        $details = $this->db->query($qry);
        return $details->row_array();
    }

    function isinventory() {
        $qry = "SELECT * FROM `keys` WHERE `key`='isinventory'";
        $details = $this->db->query($qry);
        return $details->row_array();
    }

    function gettransfer($id) {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer as a inner join transfer_items as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getsing($id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function states() {
        $qry = 'select * from state';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getcategorycount($name) {
        $qry = "select count(id) from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    public function Add_item($data_item) {
        $this->db->insert('item', $data_item);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function Add_item_ledger($data_item_ledger) {
        $this->db->insert('item_ledger', $data_item_ledger);
    }

    function getgroupcount($name) {
        $qry = "select count(id) from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getsupplier($name) {
        $qry = "select count(id) as no from suppliers as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        // return $query->row_array();
        $count = 0;
        $result = $query->result();
        foreach ($query->result() as $tt) {
            $total = $tt->no;
            if ($total > 0) {
                $count = 1;
            }
        }

        return $count;
    }

    function approve() {
        $is_inventory = $this->input->post('isinv');
        $patid = $this->input->post('patid');
        $patname = $this->input->post('patname'); // if it is zero then we will add the item
        $patphone = $this->input->post('patphone');
        $pat_regno = 1;
        $sms = 1;
        $patgender = $this->input->post('patgender');
        $patemail = $this->input->post('patemail');
        $patdob = $this->getDate($this->input->post('patdob', true));
        $patage = $this->input->post('patage');
        $pataddress_line1 = $this->input->post('pataddress_line1');
        $patnotes = $this->input->post('patnotes');
        $patreference = $this->input->post('patreference');
        $patoccupation = $this->input->post('patoccupation');
        $patbloodgrp = $this->input->post('patbloodgrp');
        $groups = $this->input->post('pat_grp');
        $published = 'yes';
        $relativ = $this->input->post('relatvid', TRUE);
        $relname = $this->input->post('relativ', TRUE);
        $relphone = $this->input->post('rphone', TRUE);
        $length = sizeof($relativ);
        $data = array(
            'Pat_Name' => $patname,
            'Pat_Phone' => $patphone,
            'Pat_regno' => $pat_regno,
            'Pat_Dob' => $patdob,
            'Pat_Age' => $patage,
            'Pat_Sms' => $sms,
            'Pat_Gender' => $patgender,
            'Pat_Email' => $patemail,
            'Pat_Address' => $pataddress_line1,
            'Pat_Refered' => $patreference,
            'Pat_Occupation' => $patoccupation,
            'Pat_Blood' => $patbloodgrp,
            'Pat_Notes' => $patnotes,
            'Pat_Groups' => $groups,
                //'Pat_Occupation' => $occupation,
                /* 'Pat_Refered' => $details,
                  'Pat_Blood' => $type,
                  'Pat_Occupation' => $published,
                  'Pat_Groups' => $credit_period, */
        );
        $this->db->where('Pat_Id', $patid);
        $this->db->update('cli_patient', $data);
            $qry = "update cli_patient SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='local'  and is_synced!=0 and Pat_Id=".$patid;
            $this->db->query($qry);
            $qry = "update cli_patient SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='server' and sync_id!=0  and Pat_Id=".$patid;
            $this->db->query($qry);       
            $qry = "update cli_patient SET is_synced = 0 WHERE sync_type like'%update%' and is_synced=0 and Pat_Id=".$patid;
            $this->db->query($qry);

        $insert_id = $patid;
        for ($i = 1; $i <= $length; $i++) {
            $data_family = array(
                'Relation_type' => $relativ[$i],
                'pat_id' => $patid,
                'name' => $relname[$i],
                'phone' => $relphone[$i],
            );
            if ($patid == 0) {
                $this->db->insert('cli_relationships', $data_family);
            } else {
                $this->db->where('Pat_id', $patid);
                $this->db->update('cli_relationships', $data_family);
            }
        }

        $Bok_Id = $this->input->post('id');
        $dig_id = $this->input->post('dig_id', true);
//        $ob_id = $this->input->post('ob_id', true);
        $dig_name = $this->input->post('dig_name', true);
//        $obv_name = $this->input->post('obs_name', true);
        $lab_note = $this->input->post('lab_note', true);
        $summery = $this->input->post('doc_notes', true);
        $qry = "select * from cli_booking where Bok_Id=" . $Bok_Id;
        $query = $this->db->query($qry)->row_array();
        $Bok_Approved = $query['Bok_Approved'];
        $qry = "update  cli_sales_items  set published ='no' where Sales_Bok_Id =" . $Bok_Id;
        $this->db->query($qry);
        $qry = "delete from cli_bookingprocedures where Bok_Id =" . $Bok_Id;
        $this->db->query($qry);
        $qry = "delete from cli_bok_observation where Bok_Id =" . $Bok_Id;
        $this->db->query($qry);
        $qry = "delete from cli_bok_diagnose where Bok_Id =" . $Bok_Id;
        $this->db->query($qry);
        $itemname = "";
        $diagonise = "";
        $observation = $this->input->post('observation');
        $length = sizeof($dig_id);

        for ($i = 0; $i < $length; $i++) {
            $diagonise = $dig_name[$i] . "  " . $diagonise;
            if ($dig_id[$i] < 1) {
                $data = array(
                    'Diagnose' => $dig_name[$i],
                );
                $this->db->insert('cli_diagnose', $data);
                $insert_id = $this->db->insert_id();
                $server_tp  = $this->config->item('server_tp');
                $qry = "UPDATE `cli_diagnose` set no_gen_in_creation =CONCAT( 'S',Dig_Id), sync_type='".$server_tp."' WHERE Dig_Id=".$insert_id;
                $this->db->query($qry);
                $dig_id[$i] = $insert_id;
            }
            $data = array(
                'Bok_Id' => $Bok_Id,
                'Dig_Id' => $dig_id[$i],
            );
            $this->db->insert('cli_bok_diagnose', $data);
            $Bok_Dig_Id = $this->db->insert_id();
        }
//        $length = sizeof($ob_id);
//        for ($i = 0; $i < $length; $i++) {
//            $observation = $observation . "   " . $obv_name[$i];
//            if ($ob_id[$i] < 1) {
//                $data = array(
//                    'Observation' => $obv_name[$i],
//                );
//                $this->db->insert('cli_observation', $data);
//                $insert_id = $this->db->insert_id();
//                $ob_id[$i] = $insert_id;
//            }
//            $data = array(
//                'Bok_Id' => $Bok_Id,
//                'Obv_id' => $ob_id[$i],
//            );
//            $this->db->insert('cli_bok_observation', $data);
//            $Bok_Obv_Id = $this->db->insert_id();
//        }
        if ($is_inventory == 1) {
            $item_id = $this->input->post('item_id', true);
            $med_nte = $this->input->post('med_nte', true);
            $item_qty = $this->input->post('item_qty', true);
            $potency = $this->input->post('cli_potency', true);
            $unit = $this->input->post('uid', true);
            $mrp_item = $this->input->post('mrpitem', true);
            $rowTotal = $this->input->post('rowTotal', true);
            $item_name = $this->input->post('item_name', true);
            $length = sizeof($item_id);
            for ($i = 0; $i < $length; $i++) {
                $itemname = $itemname . "   " . $item_name[$i];
                $data = array(
                    'Sales_Bok_Id' => $Bok_Id,
                    'Item_Id' => $item_id[$i],
                    'Rate' => $mrp_item[$i],
                    'Quantity' => $item_qty[$i],
                    'Total' => $rowTotal[$i],
                    'Med_note' => $med_nte[$i],
                    'Pot_Id' => $potency[$i],
                    'Unit_Id' => $unit[$i],
                    'Published' => 'yes',
                );
                $this->db->insert('cli_sales_items', $data);
                $Sales_Id = $this->db->insert_id();
            }
        }
        $data = array(
            'Bok_DocNote' => $observation,
            'Bok_Priscription' => $itemname,
            'Bok_DoctDescription' => $diagonise,
            'Bok_Labnote' => $lab_note,
            'Bok_Summery' => $summery,
            'Bok_Approved' => 'Checked',
        );
        if ($is_inventory == 0) {
            $amount = $this->input->post('totamt');
            $Pre_note = $this->input->post('pre_note');
            $data['Bok_Amount'] = $amount;
            $data['Pre_note'] = $Pre_note;
        }
        $this->db->where('Bok_Id', $Bok_Id);
        $this->db->update('cli_booking', $data);
        $qry = "update cli_booking SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='local' and is_synced!=0 and Bok_Id=".$Bok_Id;
        $this->db->query($qry);
        $qry = "update cli_booking SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='server' and sync_id!=0 and Bok_Id=".$Bok_Id;
       $this->db->query($qry);       
       $qry = "update cli_booking SET is_synced = 0 WHERE sync_type like'%update%' and is_synced=0 and Bok_Id=".$Bok_Id;
       $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function save() {
        $patient = $this->input->post('customer_id');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $name = $this->input->post('supname');
        if ($patient == "") {
            $data = array(
                'Pat_Name' => $name,
                'Pat_Email' => $email,
                'Pat_Phone' => $phone,
            );
            $this->db->insert('cli_patient', $data);
            $patient = $this->db->insert_id();
        }
        $at = $this->input->post('at');
        $qry = "select * from cli_timeschedule where TimeSch_Id=" . $at;
        $query = $this->db->query($qry)->row_array();
        $Shedule = $query['Schedule_Time'];
        $Shedule = str_replace(":", "", $query['Schedule_Time']);
        $hour = substr($Shedule, 0, 2);
        $min = substr($Shedule, 2, 2);
        $id = $this->input->post('id');
        $doctor = $this->input->post('doc');
        $Category = $this->input->post('cat');
        $refered = $this->input->post('ref');
        $date1 = $this->input->post('date');
        $date = $this->getDate($date1);
        $date = $this->input->post('date');
        $date = $this->getDate($date);
        $date1 = date_create($date1);
        date_time_set($date1, $hour, $min, 00);
        $at = $this->input->post('at');
        $from = $this->input->post('from');
        $procedure = $this->input->post('procedure');
        $notes = $this->input->post('notes');
        $published = 'no';
        $credit_period = $this->input->post('credit');
        $data = array(
            'Cus_Id' => $patient,
            'Bok_Mob' => $phone,
            'Bok_Email' => $email,
            'Bok_Date' => $date,
            'Bok_Starttime' => $date,
            'Bok_Note' => $notes,
            'Shedule_id' => $at,
            'Intervell_id' => $from,
            'Cat_Id' => $Category,
            'Doc_Id' => $doctor,
            'Bok_Approved' => "Pending",
        );
        if ($id == 0) {
            $this->db->insert('cli_booking', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('Bok_Id', $id);
            $this->db->update('cli_booking', $data);
            $insert_id = $id;
            $qry = "delete from cli_bookingprocedures where Bok_Id =" . $insert_id;
            $this->db->query($qry);
        }
        $bok_pro = $data = array(
            'Bok_Id' => $insert_id,
            'Pro_Id ' => $procedure,
        );
        $this->db->insert('cli_bookingprocedures', $bok_pro);
        $published = 'yes';
        $exist = 1;

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete from suppliers where id =" . $id;
        $this->db->query($qry);
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
