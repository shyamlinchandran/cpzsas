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
class Baptism_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.hed_name,b.hed_id,b.hed_housename,c.mbr_name,c.mbr_id,DATE_FORMAT(date_of_birth, "%d/%m/%Y" ) as birthdate,DATE_FORMAT(bap_date, "%d/%m/%Y" ) as baptisedate';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = ' `chr_baptism_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT join chr_family_member as c on a.bap_in=c.mbr_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'mbr_name', 'hed_housename', 'hed_name', 'birthdate', 'baptisedate', null); //set column field database for datatable orderable   
        $this->column_search = array('mbr_name', 'hed_housename', 'hed_name', 'bap_date', 'date_of_birth'); //set column field database for datatable searchable 
        $this->order = array('a.bap_id' => 'asc'); // default order 
    }

    function where($head_id) {
        $this->wherecondition = "where a.hed_id= " . $head_id;
    }

    function reports() {
        //$this->wherecondition = "where a.hed_id= " . $head_id;
        $sdate = $this->getDate($_COOKIE["startdate"]);
        $edate = $this->getDate($_COOKIE["enddate"]);
        $this->wherecondition = 'where bap_date >="' . $sdate . '" and bap_date <="' . $edate . '"';
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
        $qry = 'select a.*,b.hed_name,b.hed_id,b.hed_housename,a.hed_id,concat(b.hed_name,"/",b.hed_familyno)as familydtl,dad.mbr_name as dadname,dad.mbr_id as dadid,mom.mbr_name as momname,mom.mbr_id as momid,kid.mbr_name as kidname,kid.mbr_id as kidid, dio.dio_name as dio, lnd.lnd_name as land from `chr_baptism_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT join chr_family_member as dad on a.bap_dad=dad.mbr_id LEFT join chr_family_member as mom on a.bap_mom=mom.mbr_id LEFT join chr_family_member as kid on a.bap_in=kid.mbr_id LEFT JOIN chr_diocese as dio on b.diocese_id=dio.dio_id LEFT JOIN chr_land as lnd on b.land_id=lnd.lnd_id where a.bap_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getbaptism($id) {
        $qry = 'select a.*,DATE_FORMAT(kid.mbr_dob, "%d/%m/%Y" ) as birthdate, DATE_FORMAT(bap_date, "%d/%m/%Y" ) as baptisedate,b.hed_name,b.hed_id,b.hed_housename,b.post_office,b.pincode,a.hed_id,concat(b.hed_name,"/",b.hed_familyno)as familydtl,dad.mbr_name as dadname,dad.mbr_id as dadid,mom.mbr_name as momname,mom.mbr_id as momid,kid.mbr_name as kidname,kid.mbr_id as kidid,r.rel_gender,p.ftr_name as priestname from `chr_baptism_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT join chr_family_member as dad on a.bap_dad=dad.mbr_id LEFT join chr_family_member as mom on a.bap_mom=mom.mbr_id LEFT join chr_family_member as kid on a.bap_in=kid.mbr_id LEFT JOIN chr_relations as r ON kid.mbr_relation=r.rel_id LEFT JOIN chr_fathers as p on a.father_id=p.ftr_id where a.bap_id=' . $id;
        $result = $this->db->query($qry)->row_array();
        return $result;
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

    function getparents($head_id) {
        $qry = "select * FROM `chr_family_member` WHERE hed_id='" . $head_id . "'";
        $query = $this->db->query($qry)->result_array();
        $option = '<option>select</option>';
        foreach ($query as $item) {
            $option = $option . '<option value="' . $item['mbr_id'] . '">' . $item['mbr_name'] . '</option>';
        }

        print_r($option);
    }

    function getfathers() {
        $qry = "select a.* from chr_fathers as a WHERE ftr_published='1'";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ftr_id"] . '">' . $row["ftr_name"] . '</option>';
        }
        print_r($option);
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

    function family_name($search) {
        $qry = "select a.hed_id,concat(a.hed_name,'/',a.hed_familyno)as label,dio_name,hed_housename,e.lnd_name,post_office,pincode FROM `chr_family_head` as a LEFT JOIN chr_diocese as b on a.diocese_id=b.dio_id LEFT JOIN chr_land as e on a.land_id=e.lnd_id where (hed_name like('%$search%') or hed_phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
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

    function getmember($id) {
        $qry = "select count(bap_id) as no from chr_baptism_register as a where bap_in ='" . $id . "'";
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
        $id = $this->input->post('id');
        $baptised_on = $this->getDate($this->input->post('baptised_on'));
        $familyid = $this->input->post('familyid');
        //$ledgerid = $this->input->post('ledgerid');
        $dad_name = $this->input->post('dad_name');
        $mom_name = $this->input->post('mom_name');
        $child_name = $this->input->post('child_name');
        $dateofb = $this->getDate($this->input->post('dateofb'));
        $bless_name = $this->input->post('bless_name');
        $bless_details = $this->input->post('bless_details');
        $father_name = $this->input->post('father_name');
        $father_details = $this->input->post('father_details');
        $amount = $this->input->post('amount');
        $remarks = $this->input->post('remarks');
        $place_of_birth = $this->input->post('place');
        $address = $this->input->post('address');
        $child_gender = $this->input->post('gender');
        $data = array(
            'child_gender' => $child_gender,
            'bap_date' => $baptised_on,
            'hed_id' => $familyid,
            'bap_dad' => $dad_name,
            'bap_mom' => $mom_name,
            'bap_in' => $child_name,
            'place_of_birth' => $place_of_birth,
            'address' => $address,
            'date_of_birth' => $dateofb,
            'blessed_name' => $bless_name,
            'blessed_details' => $bless_details,
            'father_id' => $father_name,
            'father_details' => $father_details,
            'bap_amount' => $amount,
            'bap_remarks' => $remarks,
        );
        if ($id == 0) {

            $getitemcount = $this->item->getmember($child_name); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'already exists'
                );
            } else {


                //print_r($data);
                $this->db->insert('chr_baptism_register', $data);
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
                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Saved Successfully.');
            }
        } else {
            $this->db->where('bap_id', $id);
            $this->db->update('chr_baptism_register', $data);
            $insert_id = $id;
            $published = 'yes';
            $exist = 1;

            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.');
        }
        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete from chr_baptism_register where bap_id =" . $id;
        $this->db->query($qry);
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
