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
class Deathcer_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.hed_name,b.hed_id,b.hed_housename,c.mbr_name,c.mbr_id,DATE_FORMAT(crr_death_date, "%d/%m/%Y" ) as deathdate,DATE_FORMAT(crr_date, "%d/%m/%Y" ) as crematedate';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = ' `chr_cremation_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT JOIN chr_family_member as c on a.fmm_id = c.mbr_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null,'mbr_name','hed_name','hed_housename','hed_name','deathdate','crematedate',null); //set column field database for datatable orderable   
        $this->column_search = array('mbr_name','hed_name','hed_housename','hed_name','crr_death_date','crr_date'); //set column field database for datatable searchable 
        $this->order = array('a.crr_id' => 'asc'); // default order 
    }

    function where($head_id) {
        $this->wherecondition = "where a.hed_id= " . $head_id;
    }
    function reports() {
        //$this->wherecondition = "where a.hed_id= " . $head_id;
        $sdate = $this->getDate($_COOKIE["startdate"]);
        $edate = $this->getDate($_COOKIE["enddate"]);
        $this->wherecondition ='where bap_date >="' . $sdate . '" and bap_date <="' . $edate . '"';
        
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
        $qry = 'SELECT a.*,b.hed_id,c.mbr_name,concat(b.hed_name,"/",b.hed_familyno)as familydtl FROM `chr_cremation_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT JOIN chr_family_member as c on a.fmm_id = c.mbr_id where a.crr_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function getdeathcer($id) {
        $qry = 'SELECT a.*,DATE_FORMAT(crr_death_date, "%d/%m/%Y" ) as deathdate, b.hed_id,c.mbr_name,concat(b.hed_name,"/",b.hed_familyno)as familydtl,p.ftr_name as priestname FROM `chr_cremation_register` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id LEFT JOIN chr_family_member as c on a.fmm_id = c.mbr_id LEFT JOIN chr_fathers as p on a.father_id=p.ftr_id where a.crr_id=' . $id;
        $result = $this->db->query($qry)->row_array();
        return $result;
    }
    function getsales($type,$id)
    {
       $qry = "select count(sales_id) as salecount from sales where `customer_id`=" . $id." and `type`='".$type."'";
        $result = $this->db->query($qry);
        $count = $result->row()->salecount;
        return $result->row()->salecount;
    }
    public function custLedgerbal($id) {
       $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans where `published`='yes' and `ledger_id` =" . $id;
       $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }
    function getperson($head_id) {
        $qry = "SELECT * FROM `chr_family_member` WHERE hed_id='" . $head_id . "'";
        $query = $this->db->query($qry)->result_array();
        $option = '<option>select</option>';
        foreach ($query as $item) {
            $option = $option .'<option value="' . $item['mbr_id'] . '">' . $item['mbr_name'] . '</option>';
        }
        
        print_r($option);
    }
    function getfathers() {
        $qry = "select a.* from chr_fathers as a WHERE ftr_published='1'";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option .= '<option value="">Select</option>';
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
       $qry = "select a.hed_id,concat(a.hed_name,'/',a.hed_familyno)as label,dio_name,hed_housename,e.lnd_name FROM `chr_family_head` as a LEFT JOIN chr_diocese as b on a.diocese_id=b.dio_id LEFT JOIN chr_land as e on a.land_id=e.lnd_id where (hed_name like('%$search%') or hed_phone like('%$search%'))";
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
        $qry = "select count(crr_id) as no from chr_cremation_register as a where fmm_id =" . $id;
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
        $death_date = $this->getDate($this->input->post('death_date'));
        $cremate_date = $this->getDate($this->input->post('cremate_date')); 
        $familyid = $this->input->post('familyid');
        //$ledgerid = $this->input->post('ledgerid');
        $person_id = $this->input->post('dc_name');
        $age = $this->input->post('dc_age');
        $reason = $this->input->post('dc_reason');
        $father_name = $this->input->post('father_name');
        $father_details = $this->input->post('father_details');
        $amount = $this->input->post('amount');
        $remarks = $this->input->post('remarks');
        $data = array(                  
            'crr_death_date'=>$death_date,
            'crr_date'=>$cremate_date,
            'fmm_id'=>$person_id,
            'hed_id'=>$familyid,
            'fmm_age'=>$age,
            'crr_death_reason'=>$reason,
            'crr_charges'=>$amount,
            'father_id'=>$father_name,
            'father_details'=>$father_details,
            'crr_remarks'=>$remarks,
           );
       if ($id == 0) {

            $getitemcount = $this->item->getmember($person_id); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'already exists'
                );
            } else {
                    $this->db->insert('chr_cremation_register', $data);
                    $insert_id = $this->db->insert_id();
                    /*$ledger_data = array(
                        "name" => $name,
                        "code" => $head_id,
                        "ref_id" => $insert_id,
                        "ref_code" => 'fml',
                        "is_default" => true,
                        "acc_main_id" => 1,
                        "openning_bal" => 0,
                        "published" => 'yes'
                    );
                    $this->db->insert('acc_ledgers', $ledger_data);*/
                    $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Saved Successfully.');
            }
        }
        else{
                $this->db->where('crr_id', $id);
                $this->db->update('chr_cremation_register', $data);
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
    function delete($id)
    {
        $qry = "delete from chr_family_member where mbr_id =".$id;
        $this->db->query($qry);
    }
    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='".$id."'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }
}
