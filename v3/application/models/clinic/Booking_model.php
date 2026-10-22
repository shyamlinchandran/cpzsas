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
class Booking_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.*,c.Pro_Id,d.*';
        $this->table = 'cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id left join cli_bookingprocedures as c on c.Bok_Id=a.Bok_Id INNER JOIN cli_timeschedule as d on a.Shedule_id=d.TimeSch_Id';
        $this->column_search = array('b.Pat_Name', 'a.Bok_Id');
        $this->order = array('a.Bok_Id' => 'desc');
    }
    function getbok_Note($id) {
        $qry = "select max(bok_id) as bok_id ,Bok_Note FROM cli_booking where Cus_Id = ".$id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }
  function getSalesItems($id) {
        $qry = "select * from ( SELECT max(bok_id) as bok_id ,Bok_Note FROM cli_booking WHERE Cus_Id = ".$id .") as a INNER JOIN cli_sales_items as b on a.bok_id=b.Sales_Bok_Id INNER JOIN item as c on c.id=b.Item_Id WHERE b.Published='yes'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
    function where() {
        $tmp = $this->session->userdata('user');
        $userid= $tmp['Id'];
        $query_brc = "SELECT branch FROM `users` WHERE Id=".$userid;
        $exec = $this->db->query($query_brc);
        $branch = $exec->row()->branch;
        $this->wherecondition = "where a.Bok_Approved in ('Approve','Pending')";
         $this->wherecondition = $this->wherecondition . " and a.Cat_Id =" . $branch;
        
    }
   function getpatient($id) {
        $qry = 'select * from cli_patient where Pat_Id='.$id;
        $result = $this->db->query($qry)->row_array();
        return $result;
    }
    function getproducts($id) {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        //echo $qry;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function gettransfer($id) {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer as a inner join transfer_items as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getsing($id) {
        $qry = 'select * from cli_booking where Bok_Id  =' . $id;
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
              $server_tp  = $this->config->item('server_tp');
             $qry = "UPDATE `cli_patient` set no_gen_in_creation =CONCAT( 'S',Pat_Id), sync_type='".$server_tp."' WHERE Pat_Id=".$patient;
                $this->db->query($qry);
        }
        $at = $this->input->post('at');
        // $qry = "select * from cli_timeschedule where TimeSch_Id=".$at;
        // $query = $this->db->query($qry)->row_array();
        // $Shedule=$query['Schedule_Time'];  
        // $Shedule = str_replace(":", "",$query['Schedule_Time']);
        // $hour=substr($Shedule,0,2);
        // $min=substr($Shedule,2,2);
        $id = $this->input->post('id');
        $doctor = $this->input->post('doc');
        $Category = $this->input->post('cat');
        $refered = $this->input->post('ref');
        $date1 = $this->input->post('date');
        $date = $this->getDate($date1);
        $date = $this->input->post('date');
        $date = $this->getDate($date);
        $date1 = date_create($date1);
        // date_time_set($date1,$hour,$min,00);
        // $date1=date_create($date1);
        // date_time_set($date1,$hour,$min,00);
        $at = $this->input->post('at');
        $Apr_Note = $this->input->post('ap_note');
        $from = $this->input->post('from');
        $procedure = $this->input->post('procedure');
        $notes = $this->input->post('notes');
        $approve = $this->input->post('approve');
        $published = 'no';
        $credit_period = $this->input->post('credit');
        $data = array(
            'Cus_Id' => $patient,
            'Bok_Mob' => $phone,
            'Bok_Email' => $email,
            'Bok_Date' => $date,
            'Bok_Starttime' => $date,
            'Bok_Note' => $notes,
            'Apr_Note' => $Apr_Note,
            'Shedule_id' => $at,
            'Intervell_id' => $from,
            'Cat_Id' => $Category,
            'Doc_Id' => $doctor,
            'Bok_Approved' => $approve,
            'Bok_Proc_id' => $procedure,
            'Bok_Ref' => $refered,
        );
        if ($id == 0) {
            $this->db->insert('cli_booking', $data);
            $insert_id = $this->db->insert_id();
            } 
            else {
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
             $server_tp  = $this->config->item('server_tp');
             $qry = "UPDATE `cli_patient` set no_gen_in_creation =CONCAT( 'S',Pat_Id), sync_type='".$server_tp."' WHERE Pat_Id=".$patient;
                $this->db->query($qry);
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
        //date_time_set($date1,$hour,$min,00);
        // date_time_set($date1,$hour,$min,00);
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
            'Bok_Approved' => "Approve",
            'Bok_Proc_id' => $procedure,
            'Bok_Ref' => $refered,
        );
        if ($id == 0) {
            $this->db->insert('cli_booking', $data);
            $insert_id = $this->db->insert_id();
            $server_tp  = $this->config->item('server_tp');
            $qry = "UPDATE `cli_booking` set no_gen_in_creation =CONCAT( 'S',Bok_Id), sync_type='".$server_tp."' WHERE Bok_Id=".$insert_id;
            $this->db->query($qry);
        
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
        $qry = "delete from cli_booking where Bok_Id =" . $id;
        $this->db->query($qry);
    }

    function deleteapp($id) {
        $qry = "delete from cli_booking where Bok_Id =" . $id;
        $this->db->query($qry);
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
