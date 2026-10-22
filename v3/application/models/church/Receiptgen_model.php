<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receiptgen_model
 *
 * @author dimind
 */
class Receiptgen_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.rtp_id,b.rtp_name,MONTHNAME(STR_TO_DATE(a.reg_month, "%m")) as mnth';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = '`chr_receipts_gen` as a left join chr_receipt_type as b on a.rtp_id=b.rtp_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null,'reg_month','b.rtp_name','reg_createdon','reg_amount',null); //set column field database for datatable orderable   
        $this->column_search = array('reg_month','b.rtp_name','reg_createdon','reg_amount'); //set column field database for datatable searchable 
        $this->order = array('reg_id' => 'desc'); // default order 
    }

    function where() {
        $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
    }

    function getsing($id) {
        $qry = 'SELECT a.* FROM `chr_receipts_gen` as a where a.reg_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
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
    function getvouchers($id)
    {
       $qry = 'select count(voucher_id) as totvouchers from voucher_trans as v inner join acc_ledgers as a on v.acc_ledgers_id=a.id where a.ref_id=' . $id;
        $result = $this->db->query($qry);
        $count = $result->row()->totvouchers;
        return $result->row()->totvouchers;
    }
    function getreceiptype() {
        $qry = 'select * from chr_receipt_type';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
    function getfamilyno() {
        $qry = 'select count(hed_id) as cnt from chr_family_head';
        $result = $this->db->query($qry);
        return $result->row()->cnt;
    }
    function receiptforall($receiptid) {
        $qry = 'select count(rtp_id) as cnt from chr_receipt_type where rtp_is_allmembers=true and rtp_id='.$receiptid;
        $result = $this->db->query($qry);
        return $result->row()->cnt;
    }
    function getfamily() {
        $qry = 'select hed_id,b.id as ledgerid from chr_family_head as a left join acc_ledgers as b on a.hed_id=b.ref_id LEFT JOIN chr_parish as p on a.parish_id=p.par_id where ref_code="fml" and par_isdefault="yes"';
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
    function generatevouchernumber() {
        $noqry = 'SELECT voucher_no FROM `acc_ledger_trans` WHERE tran_id=(SELECT MAX(tran_id) FROM acc_ledger_trans WHERE tb_name="c-family")';
        $noquery = $this->db->query($noqry);
        $prevno = $noquery->row_array();
        if ($noquery->num_rows() == 0) {
            return 1;
        } else {
            $num = $prevno['voucher_no']+1;
            return $num;
        }
    }
    function getmember($name) {
        $qry = "select count(rtp_id) as no from chr_receipt_type as a where rtp_name ='" . $name . "'";
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
     function getreceipt_type($id) {
       $qry = "select a.rtp_name as label,a.* from chr_receipt_type as a where a.rtp_id=".$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function save() {
        $id = $this->input->post('id');         
        $reg_month = $this->input->post('rec_month');
        $rtp_id= $this->input->post('receipt_type');
        $createdon = $this->input->post('createdon');
        $reg_createdon = $this->getDate($createdon);
        $reg_amount = $this->input->post('rec_amount');
        $cash = $this->getValue('cash');
        $data = array(         
           'reg_month ' => $reg_month,
            'rtp_id' => $rtp_id,
            'reg_createdon' => $reg_createdon,
            'reg_amount'=>$reg_amount,
            );
       if ($id == 0) {
                $this->db->insert('chr_receipts_gen', $data);
                $insert_id = $this->db->insert_id();
                $familycount = $this->getfamilyno();
                $receiptforall = $this->receiptforall($rtp_id);
                if($familycount>0 && $receiptforall>0)
                {
                    $family = $this->getfamily();
                    foreach ($family as $item) {
                        for($i=0;$i<$familycount;$i++)
                        {
                           $rec_data = array(      
                                               'reg_id' => $id,   
                                               'rtp_id' => $rtp_id,
                                                'hed_id'=>$item['hed_id'],
                                                'rec_amount'=>$reg_amount,
                                                'rec_ispaid'=>'false',
                                                'rec_createdate'=>$reg_createdon,
                                            );
                           
                        }
                        $billno = $this->generatevouchernumber();
                        $narration = 'Church Receipt Invoice:- ' . $billno . ' on  ' . $createdon;
                        $this->trans_save($billno, $insert_id, "c-family", "receipt", '11', $item['ledgerid'], $reg_createdon, '0.00', $reg_amount, $narration, 1,0);
                        $this->trans_save($billno, $insert_id, "c-family", "receipt", $item['ledgerid'], '11', $reg_createdon, $reg_amount, '0.00', $narration, 1,0);
                        $this->db->insert('chr_receipts', $rec_data);
                    }

                }
                /*$ledger_data = array(
                    "name" => $name,
                    "code" => $phone,
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
        else
        {
            $this->db->where('reg_id', $id);
            $this->db->update('chr_receipts_gen', $data);
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
        $qry = "delete from chr_receipts_gen where reg_id =".$id;
        $this->db->query($qry);
        $qry = "delete from chr_receipts where reg_id =".$id;
        $this->db->query($qry);
    }
    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='".$id."'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }
}
