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
class Familymember_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.*,DATE_FORMAT(mbr_dob, "%d/%m/%Y" ) as dob';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'chr_family_member as a LEFT JOIN chr_relations as b on a.mbr_relation=b.rel_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'mbr_name', 'rel_name', 'mbr_dob', 'mbr_age', 'mbr_education', null); //set column field database for datatable orderable   
        $this->column_search = array('mbr_name', 'mbr_age', 'mbr_education'); //set column field database for datatable searchable 
        $this->order = array('rel_series' => 'asc'); // default order 
    }

    function where($head_id) {
        $this->wherecondition = "where a.hed_id= " . $head_id;
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
        $qry = 'select a.* from chr_family_member as a LEFT JOIN chr_relations as b on a.mbr_relation=b.rel_id where a.mbr_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getsales($type, $id) {
        $qry = "select count(sales_id) as salecount from sales where `customer_id`=" . $id . " and `type`='" . $type . "'";
        $result = $this->db->query($qry);
        $count = $result->row()->salecount;
        return $result->row()->salecount;
    }

    public function custLedgerbal($id) {
        $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans where `published`='yes' and `ledger_id` =" . $id;
        $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }

    function getvouchers($id) {
        $qry = 'select count(voucher_id) as totvouchers from voucher_trans as v inner join acc_ledgers as a on v.acc_ledgers_id=a.id where a.ref_id=' . $id;
        $result = $this->db->query($qry);
        $count = $result->row()->totvouchers;
        return $result->row()->totvouchers;
    }

    function relations() {
        $qry = 'select * from chr_relations';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function familymain($head_id) {
        $qry = "SELECT a.*,b.dio_name,c.com_name,d.wrd_name,e.lnd_name,f.vlg_name,g.tal_name,h.dist_name FROM `chr_family_head` as a LEFT JOIN chr_diocese as b on a.diocese_id=b.dio_id LEFT JOIN chr_prayer_community as c on a.community_id=c.com_id LEFT JOIN chr_wards as d on a.ward_id=d.wrd_id LEFT JOIN chr_land as e on a.land_id=e.lnd_id LEFT join chr_village as f on a.village_id=f.vlg_id LEFT join chr_taluk as g on a.taluk_id=g.tal_id LEFT JOIN chr_district as h on a.district_id=h.dist_id where a.hed_id=" . $head_id;
        $query = $this->db->query($qry);
        return $query->row_array();
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

    function getmember($name) {
        $qry = "select count(mbr_id) as no from chr_family_member as a where mbr_name ='" . $name . "'";
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

    function getcommunity($id) {
        $qry = ' select mbr_name as name,member_father as father,member_gender as gender from chr_family_member where mbr_id=' . $id;
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function save() {
        $id = $this->input->post('id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $relation = $this->input->post('relation');
        $head_id = $this->input->post('head_id');
        $dobun = $this->input->post('dob');
        $dob = $this->getDate($dobun);
        $age = $this->input->post('age');
        $education = $this->input->post('education');
        $baptised = $this->input->post('baptised_on');
        $baptised_on = $this->getDate($baptised);
        $married = $this->input->post('married_on');
        $married_on = $this->getDate($married);
        $district = $this->input->post('district');
        $job = $this->input->post('job');
        $remarks = $this->input->post('remarks');
        $member_father = $this->input->post('father');
        $member_mother = $this->input->post('mother');
        $member_gender = $this->input->post('gender');
        $data = array(
            'member_mother' => $member_mother,
            'member_gender' => $member_gender,
            'member_father' => $member_father,
            'mbr_name' => $name,
            'mbr_relation' => $relation,
            'hed_id' => $head_id,
            'mbr_dob' => $dob,
            'mbr_age' => $age,
            'mbr_education' => $education,
            'mbr_baptised_on' => $baptised_on,
            'mbr_married_on' => $married_on,
            'mbr_job' => $job,
            'mbr_remarks' => $remarks,
        );
        if ($id == 0) {

            /* $getitemcount = $this->item->getmember($name); // check if item exists
              if ($getitemcount > 0) {

              $response = array(
              'valid' => true,
              'type' => 1,
              'message' => 'name exists'
              );
              echo json_encode($response);
              } else {

             */$this->db->insert('chr_family_member', $data);
            $insert_id = $this->db->insert_id();
            /* $ledger_data = array(
              "name" => $name,
              "code" => $head_id,
              "ref_id" => $insert_id,
              "ref_code" => 'fml',
              "is_default" => true,
              "acc_main_id" => 1,
              "openning_bal" => 0,
              "published" => 'yes'
              );
              $this->db->insert('acc_ledgers', $ledger_data); */
            /* } */
        }
        $this->db->where('mbr_id', $id);
        $this->db->update('chr_family_member', $data);
        $insert_id = $id;
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
        $qry = "delete from chr_family_member where mbr_id =" . $id;
        echo $qry;
        //$this->db->query($qry);
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
