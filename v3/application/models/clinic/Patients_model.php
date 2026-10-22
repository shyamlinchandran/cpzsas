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
class Patients_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'cli_patient as a';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'Pat_Name', 'Pat_Email', 'Pat_Phone', 'Pat_Address'); //set column field database for datatable orderable   
        $this->column_search = array('Pat_Name', 'Pat_Email', 'Pat_Phone', 'Pat_Address'); //set column field database for datatable searchable 
        $this->order = array('a.Pat_id' => 'desc'); // default order 
    }

    function updatestatus() {
        $note = $this->input->post('note');
        $Bok_Id = $this->input->post('id');
        $data = array(
            'Bok_Approved' => 'Approve',
        );
        $this->db->where('Bok_Id', $Bok_Id);
        $this->db->update('cli_booking', $data);
    }

    function where() {
        // $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
    }

    function getsing($id) {
        $qry = 'select * from cli_patient where Pat_Id=' . $id;
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
    function pattimeline($id) {        
       $qry = 'select * from cli_booking  where Bok_Approved in ("Checked","Payed")  and Cus_Id=' . $id.' order by Bok_Date desc';
        $details = $this->db->query($qry);
        return $details->result_array();
    }
    function patientdtls($id) {        
        $qry = 'select * from cli_patient  where  Pat_Id=' . $id;
        $details = $this->db->query($qry);
        return $details->row_array();
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

    function checkpatient($name) {
        $qry = "select count(Pat_Id) as no from cli_patient as a where Pat_Name ='" . $name . "'";
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

    function save() {
        //           Pat_Email_Notify               
        $id = $this->input->post('id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $phone = $this->input->post('phone');
        $pat_regno = 1;
        $sms = 1;
        $gender = $this->input->post('gender');
        $email = $this->input->post('email');
        $dob = $this->getDate($this->input->post('dob', true));
        $age = $this->input->post('age');
        $address_line1 = $this->input->post('address_line1');
        $address_line2 = $this->input->post('address_line2');
        $notes = $this->input->post('remarks');
        $reference = $this->input->post('reference');
        $occupation = $this->input->post('occupation');
        $bloodgrp = $this->input->post('bloodgrp');
        $notes = $this->input->post('notes');
        $groups = $this->input->post('pat_grp');
        $published = 'yes';
        $relativ = $this->input->post('relatvid', TRUE);
        $relativid = $this->input->post('relativid', TRUE);
        $relphone = $this->input->post('rphone', TRUE);
        $length = sizeof($relativ);
        $credit_period = $this->input->post('credit');
        $data = array(
            'Pat_Name' => $name,
            'Pat_Phone' => $phone,
            'Pat_regno' => $pat_regno,
            'Pat_Dob' => $dob,
            'Pat_Age' => $age,
            'Pat_Sms' => $sms,
            'Pat_Gender' => $gender,
            'Pat_Email' => $email,
            'Pat_Address' => $address_line1,
            'Pat_Refered' => $reference,
            'Pat_Occupation' => $occupation,
            'Pat_Blood' => $bloodgrp,
            'Pat_Notes' => $notes,
            'Pat_Groups' => $groups,
                //'Pat_Occupation' => $occupation,
                /* 'Pat_Refered' => $details,
                  'Pat_Blood' => $type,
                  'Pat_Occupation' => $published,
                  'Pat_Groups' => $credit_period, */
        );
        if ($id == 0) {

            $getitemcount = $this->item->checkpatient($name); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => 'name exists'
                );
                echo json_encode($response);
                return;
            } else {

                $this->db->insert('cli_patient', $data);
                $insert_id = $this->db->insert_id();
                $server_tp  = $this->config->item('server_tp');
                $qry = "UPDATE `cli_patient` set no_gen_in_creation =CONCAT( 'S',Pat_Id), sync_type='".$server_tp."' WHERE Pat_Id=".$insert_id;
                $this->db->query($qry);
                }
        }
        else
        {
            $this->db->where('Pat_Id', $id);
            $this->db->update('cli_patient', $data);
            $insert_id = $id;
        $qry = "update cli_patient SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='local'  and is_synced!=0 and Pat_Id=".$id;
        $this->db->query($qry);
        $qry = "update cli_patient SET is_synced = 0, sync_type = CONCAT( 'update',sync_type) WHERE sync_type='server' and sync_id!=0  and Pat_Id=".$id;
        $this->db->query($qry);       
        $qry = "update cli_patient SET is_synced = 0 WHERE sync_type like'%update%' and is_synced=0 and Pat_Id=".$id;
        $this->db->query($qry);
        }
        for ($i = 1; $i <= $length; $i++) {
            $data_family = array(
                'Relation_type' => $relativ[$i],
                'pat_id' => $insert_id,
                'relativ_id'=>$relativid[$i],
                'phone' => $relphone[$i],
            );
            if ($id == 0) {
                $this->db->insert('cli_relationships', $data_family);
            } else {
                $this->db->where('Pat_id', $id);
                $this->db->update('cli_relationships', $data_family);
            }
        }
         /*for ($i = 1; $i <= $length; $i++) {        
          if ($id == '0') {
          $qry = "insert into cli_relationships(Relation_type,pat_id,relativ_id,phone) values(" . $relativ[$i] . " , " . $insert_id. " , '" . $relativid[$i] . "' , " . $relphone[$i] . ")";
          $this->db->query($qry);
          }
          else {
          $qry = "update  cli_relationships set Relation_type ='" . $relativ[$i] . "',relativ_id='" . $relativid[$i] ."',phone ='" . $relphone[$i] . "' where pat_id ='" . $id . "'and Relation_type ='" . $relativ[$i] . "'";
          $this->db->query($qry);
          }
          } */

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully'
        );
        echo json_encode($response);
    }

    function bloodgroup() {
        $qry = "select a.* from cli_bloodgroup as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Blo_Id"] . '">' . $row["Blo_Name"] . '</option>';
        }
        print_r($option);
    }

    function getrelations($id) {
        $qry = 'select b.Relation_type as reltype,p.Pat_Name as relativ,p.Pat_Phone as relphone from cli_relationships as b left join cli_patient as p on b.relativ_id=p.Pat_Id where b.pat_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function patrelative($id) {
        $qry = 'select b.Relation_type as reltype,p.Pat_Id as relativid,p.Pat_Name as relativ,p.Pat_Phone as relphone from cli_relationships as b left join cli_patient as p on b.relativ_id=p.Pat_Id where b.pat_id=' . $id;
        $details = $this->db->query($qry);
        return $details->result_array();
    }
    function delete($id) {
        $qry = "delete from cli_patient where Pat_Id =" . $id;
        $this->db->query($qry);
        $qry = "delete from cli_relationships where pat_id =" . $id;
        $this->db->query($qry);
    }

}
