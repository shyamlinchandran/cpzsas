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
class Marriage_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*, fa.hed_name as hedfa,fa.hed_id as hedfaid,fa.hed_housename as houseaname,fb.hed_name as hedfb,fb.hed_id as hedfbid,fb.hed_housename as housebname,a.hed_id_a,concat(fa.hed_name,"/",fa.hed_familyno)as familyadtl,concat(fb.hed_name,"/",fb.hed_familyno)as familybdtl,bridegr.mbr_name as bridegrname,bridegr.mbr_id as bridegrid,bride.mbr_name as bridename,bride.mbr_id as brideid, DATE_FORMAT(wedding_date, "%d/%m/%Y" ) as weddate';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = '`chr_marriage_register` as a LEFT JOIN chr_family_head as fa on a.hed_id_a=fa.hed_id LEFT join chr_family_member as bridegr on a.bride_groom_id=bridegr.mbr_id LEFT JOIN chr_family_head as fb on a.hed_id_b=fb.hed_id LEFT join chr_family_member as bride on a.bride_id=bride.mbr_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null,'weddate','fb.hed_familyno','fb.hed_familyno',null); //set column field database for datatable orderable   
        $this->column_search = array('wedding_date','fa.hed_familyno','fb.hed_familyno','fa.hed_housename','fb.hed_housename'); //set column field database for datatable searchable 
        $this->order = array('a.wedding_date' => 'desc'); // default order 
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
        $qry = 'select a.*,fa.hed_name,fa.hed_id,fa.hed_housename,a.hed_id_a,concat(fa.hed_name,"/",fa.hed_familyno)as familyadtl,concat(fb.hed_name,"/",fb.hed_familyno)as familybdtl,dada.mbr_name as dadaname,dada.mbr_id as dadaid,moma.mbr_name as momaname,moma.mbr_id as momaid,dadb.mbr_name as dadbname,dadb.mbr_id as dadbid,momb.mbr_name as mombname,momb.mbr_id as mombid,bridegr.mbr_name as bridegrname,bridegr.mbr_id as bridegrid,bride.mbr_name as bridename,bride.mbr_id as brideid,dioa.dio_name as dioa, diob.dio_name as diob,lnda.lnd_name as landa,lnda.lnd_name as landb from `chr_marriage_register` as a LEFT JOIN chr_family_head as fa on a.hed_id_a=fa.hed_id LEFT join chr_family_member as dada on a.dada_id=dada.mbr_id LEFT join chr_family_member as moma on a.moma_id=moma.mbr_id LEFT join chr_family_member as bridegr on a.bride_groom_id=bridegr.mbr_id LEFT JOIN chr_family_head as fb on a.hed_id_b=fb.hed_id LEFT join chr_family_member as dadb on a.dadb_id=dadb.mbr_id LEFT join chr_family_member as momb on a.momb_id=momb.mbr_id LEFT join chr_family_member as bride on a.bride_id=bride.mbr_id LEFT JOIN chr_diocese as dioa on fa.diocese_id=dioa.dio_id LEFT JOIN chr_diocese as diob on fb.diocese_id=diob.dio_id LEFT JOIN chr_land as lnda on fa.land_id=lnda.lnd_id LEFT JOIN chr_land as lndb on fb.land_id=lndb.lnd_id WHERE mrg_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function getmarriage_dtls($id) {
        $qry = 'select a.*,fa.hed_name,fa.hed_id,fa.hed_housename,a.hed_id_a,concat(fa.hed_name,"/",fa.hed_familyno)as familyadtl,concat(fb.hed_name,"/",fb.hed_familyno)as familybdtl,dada.mbr_name as dadaname,dada.mbr_id as dadaid,moma.mbr_name as momaname,moma.mbr_id as momaid,dadb.mbr_name as dadbname,dadb.mbr_id as dadbid,momb.mbr_name as mombname,momb.mbr_id as mombid,bridegr.mbr_name as bridegrname,bridegr.mbr_id as bridegrid,bride.mbr_name as bridename,bride.mbr_id as brideid,DATE_FORMAT(wedding_date, "%d/%m/%Y" ) as weddate,p.ftr_name as priestname from `chr_marriage_register` as a LEFT JOIN chr_family_head as fa on a.hed_id_a=fa.hed_id LEFT join chr_family_member as dada on a.dada_id=dada.mbr_id LEFT join chr_family_member as moma on a.moma_id=moma.mbr_id LEFT join chr_family_member as bridegr on a.bride_groom_id=bridegr.mbr_id LEFT JOIN chr_family_head as fb on a.hed_id_b=fb.hed_id LEFT join chr_family_member as dadb on a.dadb_id=dadb.mbr_id LEFT join chr_family_member as momb on a.momb_id=momb.mbr_id LEFT join chr_family_member as bride on a.bride_id=bride.mbr_id LEFT JOIN chr_diocese as dioa on fa.diocese_id=dioa.dio_id LEFT JOIN chr_diocese as diob on fb.diocese_id=diob.dio_id LEFT JOIN chr_land as lnda on fa.land_id=lnda.lnd_id LEFT JOIN chr_land as lndb on fb.land_id=lndb.lnd_id LEFT JOIN chr_fathers as p on a.father_id=p.ftr_id WHERE mrg_id='.$id;
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
    function getparents($head_id) {
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
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ftr_id"] . '">' . $row["ftr_name"] . '</option>';
        }
        print_r($option);
    }
    function diocese() {
        $qry = 'select * from chr_diocese';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
    function parish() {
        $qry = 'select * from chr_parish';
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
    function getmember($bridegr_id,$bride_id) {
        $qry = "select count(mrg_id) as no from chr_marriage_register as a where bride_groom_id = " . $bridegr_id . " and bride_id=".$bride_id;
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
        $married_on = $this->getDate($this->input->post('married_on')); 
        $familyida = $this->input->post('familyida');
        $familyidb = $this->input->post('familyidb');
        //$ledgerid = $this->input->post('ledgerid');
        $parish = $this->input->post('parish_main');
        $diocese = $this->input->post('diocese_main');
        $dad_namea = $this->input->post('dad_namea');
        $dad_nameb = $this->input->post('dad_nameb');
        $mom_namea = $this->input->post('mom_namea');
        $mom_nameb = $this->input->post('mom_nameb');
        $bridegr_name = $this->input->post('bridegr_name');
        $bride_name = $this->input->post('bride_name');
        $witnessa = $this->input->post('witnessa');
        $witnessb = $this->input->post('witnessb');
        $father_name = $this->input->post('father_name');
        $father_details = $this->input->post('father_details');
        $amount = $this->input->post('amount');
        $remarks = $this->input->post('remarks');
        //dio_id  parish

        $data = array(
            'wedding_date'=>$married_on,
            'parish_id'=>$parish,
            'dio_id'=>$diocese,
            'hed_id_a'=>$familyida,
            'hed_id_b'=>$familyidb,
            'dada_id'=>$dad_namea,
            'dadb_id'=>$dad_nameb,
            'moma_id'=>$mom_namea,
            'momb_id'=>$mom_nameb,
            'bride_groom_id'=>$bridegr_name,
            'bride_id'=>$bride_name,
            'witnessa'=>$witnessa,
            'witnessb'=>$witnessb,
            'father_id'=>$father_name,
            'father_details'=>$father_details,
            'mrg_amount'=>$amount,
            'mrg_details'=>$remarks,
           );
       if ($id == 0) {

            $getitemcount = $this->item->getmember($bridegr_name,$bride_name); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'already exists'
                );
            } else {
                if($bride_name!=$bridegr_name)
                {
                    $this->db->insert('chr_marriage_register', $data);
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
                        'message' => 'Saved Successfully.'
                    );
                }
                else
                {
                    $response = array(
                        'valid' => true,
                        'type' => 1,
                        'message' => 'Invalid entry.'
                    );
                }
            }
        }
        else{
                $this->db->where('mrg_id', $id);
                $this->db->update('chr_marriage_register', $data);
                $insert_id = $id;
                $published = 'yes';
                $exist = 1;
            
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
        }
        echo json_encode($response);
    }
    function delete($id)
    {
        $qry = "delete from chr_marriage_register where mrg_id =".$id;
        $this->db->query($qry);
    }
    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='".$id."'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }
}
