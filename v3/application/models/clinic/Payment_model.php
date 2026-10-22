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
class Payment_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'Bok_Id,Pat_Name,Pat_Phone,Bok_Date';
        $this->table = 'cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id';
        /*$this->table = 'cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id left join cli_bookingprocedures as c on c.Bok_Id=a.Bok_Id inner join cli_doctor as d on d.Doc_Id=a.Doc_Id';*/
        $this->column_search = array('b.Pat_Name', 'b.Pat_Phone');
        $this->order = array('a.Bok_Id' => 'desc');
    }

    function isinventory() {
        $qry = "SELECT * FROM `keys` WHERE `key`='isinventory'";
        $details = $this->db->query($qry);
        return $details->row_array();
    }

    function ledbalid($id) {
        $qry = 'select id  from acc_ledgers where ref_code in ("clicus") and ref_id = ' . $id . ' limit 1';

        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function where() {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $this->wherecondition = "where a.Bok_Approved='Checked' ";
        $this->wherecondition = $this->wherecondition . " and a.Cat_Id =" . $branch;
    }

    function getproducts($id) {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        //echo $qry;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getrefid($Bok_Id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $Bok_Id;
        $query = $this->db->query($qry)->row_array();
        $patient = $query['Cus_Id'];
        $name = $query['Pat_Name'];
        $qry = 'select count(id) as cnt,id from acc_ledgers as a  where a.ref_id  =' . $patient . ' and a.ref_code="clicus"';
        $query = $this->db->query($qry)->row_array();
        $count = $query['cnt'];

        if ($count > 0) {
            return $query['id'];
        }
        if ($count < 1) {
            $data = array(
                'name' => $name,
                'code' => 'cli_sales',
                'ref_id' => $patient,
                'ref_code' => 'clicus',
                'is_default' => 1,
                'acc_main_id' => 1,
                'type' => 'Dr',
                'openning_bal' => 0,
                'published' => 'yes'
            );
            $this->db->insert('acc_ledgers', $data);
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }

    function Details($id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $id;
        $query = $this->db->query($qry)->row_array();
        $patient = $query['Cus_Id'];
//        $qry = 'SELECT Bok_Date,Observation,a.Bok_Id FROM cli_booking as a INNER JOIN cli_bok_observation as b on a.Bok_Id=b.Bok_Id INNER JOIN cli_observation as c on c.Obs_Id=b.Obv_id WHERE Cus_Id  =' . $patient . ' order by Bok_Date asc';
        $qry = 'select * from cli_booking  where Cus_Id=' . $id;
        $details = $this->db->query($qry);
        return $details->result_array();
    }

    function Obsdate($id) {
        $qry = 'select * from cli_booking as a inner join cli_patient as b on a.Cus_Id=b.Pat_Id where Bok_Id  =' . $id;
        $query = $this->db->query($qry)->row_array();
        $patient = $query['Cus_Id'];
        $qry = 'SELECT DISTINCT a.Bok_Id,Bok_Date FROM cli_booking as a  WHERE Cus_Id  =' . $patient . ' order by Bok_Date asc';
        $details = $this->db->query($qry);
        return $details->result_array();
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

    function save() {
        $is_inventory = $this->input->post('isinv');
        $Bok_Id = $this->input->post('id');
        $qry = "select * from cli_booking where Bok_Id=" . $Bok_Id;
        $query = $this->db->query($qry)->row_array();
        $Bok_Approved = $query['Bok_Approved'];
        $qry = "update  cli_sales_items  set published ='no' where Sales_Bok_Id =" . $Bok_Id;
        $this->db->query($qry);
        if ($Bok_Approved == 'Payed') {
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='Clisales' and tb_id =" . $Bok_Id;
            $this->db->query($qry);
            $qry = "delete from cli_bookingprocedures where Bok_Id =" . $Bok_Id;
            $this->db->query($qry);
            $qry = "delete from cli_bok_observation where Bok_Id =" . $Bok_Id;
            $this->db->query($qry);
        }
        $ref_id = $this->getrefid($Bok_Id);

        $dig_id = $this->input->post('dig_id', true);
        $ob_id = $this->input->post('ob_id', true);
        $dig_name = $this->input->post('dig_name', true);
        $obv_name = $this->input->post('obs_name', true);
        $potency = $this->input->post('cli_potency', true);
        $type = $this->input->post('type');
        $unit = $this->input->post('uid', true);
        $itemname = "";
        $diagonise = "";
        $observation = "";
        if ($is_inventory == 0) {
            $Bok_Amt = $this->input->post('totamt');
            if ($Bok_Amt == "") {
                $Bok_Amt = 0;
            }
        }
        if ($is_inventory == 1) {
            $Bok_Amt = $this->input->post('grandtot');
            if ($Bok_Amt == "") {
                $Bok_Amt = 0;
            }
            $med_nte = $this->input->post('med_nte', true);
            $item_id = $this->input->post('item_id', true);
            $item_qty = $this->input->post('item_qty', true);
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
                    'Med_note' => $med_nte[$i],
                    'Total' => $rowTotal[$i],
                    'Pot_Id' => $potency[$i],
                    'Unit_Id' => $unit[$i],
                    'Published' => 'yes',
                );
                $this->db->insert('cli_sales_items', $data);
                $Sales_Id = $this->db->insert_id();
            }
        }
        if ($type == 'Cash') {
            $toid = $this->cashaccount;
        }
        if ($type == 'Credit') {
            $toid = $ref_id;
        }

        $this->trans_save($Bok_Id, $Bok_Id, 'Clisales', 'sales', $this->sales, $toid, date('Y-m-d H:i:s', time()), '0.00', $Bok_Amt, $Bok_Id, 1);
        $this->trans_save($Bok_Id, $Bok_Id, 'Clisales', 'sales', $toid, $this->sales, date('Y-m-d H:i:s', time()), $Bok_Amt, '0.00', $Bok_Id, 1);
        $data = array(
            'Bok_Approved' => 'Payed',
            'Bok_Amount' => $Bok_Amt,
            'Bok_Cashtype'=>$type,
        );
        if ($is_inventory == 0) {
            $Pre_note = $this->input->post('pre_note');
            $data['Pre_note'] = $Pre_note;
        }
        $this->db->where('Bok_Id', $Bok_Id);
        $this->db->update('cli_booking', $data);

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
