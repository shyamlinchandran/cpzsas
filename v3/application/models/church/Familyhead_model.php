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
class Familyhead_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'hed_id, hed_name , hed_housename , hed_phone , hed_mobile, hed_familyno';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = '`chr_family_head` as a';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'hed_name', 'hed_housename', 'hed_phone', 'hed_mobile', 'hed_familyno'); //set column field database for datatable orderable   
        $this->column_search = array('hed_name', 'hed_housename', 'hed_phone', 'hed_mobile', 'hed_familyno'); //set column field database for datatable searchable 
        $this->order = array('hed_familyno' => 'asc'); // default order 
    }

    function where() {
        $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
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
        $qry = 'SELECT * FROM `chr_family_head` as a LEFT JOIN chr_parish as p on a.parish_id=p.par_id LEFT JOIN chr_diocese as b on a.diocese_id=b.dio_id LEFT JOIN chr_district as c on a.district_id=c.dist_id LEFT JOIN chr_wards as d on a.ward_id = d.wrd_id LEFT JOIN chr_land as e on a.land_id=e.lnd_id LEFT JOIN chr_prayer_community as f on a.community_id=f.com_id LEFT JOIN chr_village as g on a.village_id=g.vlg_id LEFT JOIN chr_taluk as h on a.taluk_id=h.tal_id where a.hed_id=' . $id;
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

    function communities() {
        $qry = 'select * from chr_prayer_community';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function ward() {
        $qry = 'select * from chr_wards';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function village() {
        $qry = 'select * from chr_village';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function taluk() {
        $qry = 'select * from chr_taluk';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function district() {
        $qry = 'select * from chr_district';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function parish() {
        $qry = 'select * from chr_parish';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function diocese() {
        $qry = 'select * from chr_diocese';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function locality() {
        $qry = 'select * from chr_land';
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

    function getmember($name) {
        $qry = "select count(hed_id) as no from chr_family_head as a where hed_name ='" . $name . "'";
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
        $qry = ' select hed_name as name,hed_father as father,hed_gender as gender from chr_family_head where hed_id=' . $id;
        $result = $this->db->query($qry)->row_array();
        return $result;
    }

    function save() {
        $hed_gender =  $this->input->post('gender');
        $post_office = $this->input->post('post_office');
        $pincode = $this->input->post('pincode');
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $fno = $this->input->post('fno');
        $parish = $this->input->post('parish');
        $diocese = $this->input->post('diocese');
        $community = $this->input->post('community');
        $housename = $this->input->post('housename');
        $ward = $this->input->post('ward');
        $land = $this->input->post('locality');
        $panchayath = $this->input->post('panchayath');
        $village = $this->input->post('village');
        $district = $this->input->post('district');
        $taluk = $this->input->post('taluk');
        $phone = $this->input->post('phone');
        $mobile = $this->input->post('mobile');
        $hed_father = $this->input->post('father');
        $hed_mother = $this->input->post('mother');
        $data = array(
            'hed_mother' => $hed_mother,
            'hed_father' => $hed_father,
            'hed_familyno' => $fno,
            'hed_name' => $name,
            'parish_id' => $parish,
            'diocese_id' => $diocese,
            'community_id' => $community,
            'hed_housename' => $housename,
            'ward_id' => $ward,
            'land_id' => $land,
            'panchayath' => $panchayath,
            'hed_gender'=>$hed_gender,
            'village_id' => $village,
            'taluk_id' => $taluk,
            'district_id' => $district,
            'pincode' => $pincode,
            'post_office' => $post_office,
            'hed_phone' => $phone,
            'hed_mobile' => $mobile,
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

             */$this->db->insert('chr_family_head', $data);
            $insert_id = $this->db->insert_id();
            $ledger_data = array(
                "name" => $name,
                "code" => $phone,
                "ref_id" => $insert_id,
                "ref_code" => 'fml',
                "is_default" => true,
                "acc_main_id" => 1,
                "openning_bal" => 0,
                "published" => 'yes'
            );
            $this->db->insert('acc_ledgers', $ledger_data);
            /* } */
        }
        $this->db->where('hed_id', $id);
        $this->db->update('chr_family_head', $data);
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
        $qry = "delete from chr_family_head where hed_id =" . $id;
        $this->db->query($qry);
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
