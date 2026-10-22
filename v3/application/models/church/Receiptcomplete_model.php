<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Receiptcomplete_model
 *
 * @author dimind
 */
class Receiptcomplete_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,CASE WHEN rec_ispaid=true THEN "Yes" ELSE "No" END as paidmoney, concat(b.hed_name,"/",b.hed_familyno)as family,c.rtp_name';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = '`chr_receipts` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id left join chr_receipt_type as c on a.rtp_id=c.rtp_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null,'c.rtp_name','family','rec_amount','paidmoney',null); //set column field database for datatable orderable   
        $this->column_search = array('c.rtp_name','b.hed_name','b.hed_familyno'); //set column field database for datatable searchable 
        $this->order = array('rec_id' => 'desc'); // default order 
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
        $qry = 'SELECT a.*,concat(b.hed_name,"/",b.hed_familyno)as family FROM `chr_receipts` as a LEFT JOIN chr_family_head as b on a.hed_id=b.hed_id where a.rec_id=' . $id;
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
     function family_name($search) {
       $qry = "select a.hed_id,concat(a.hed_name,'/',a.hed_familyno)as label,b.id as ledgerid from chr_family_head as a left join acc_ledgers as b on a.hed_id=b.ref_id where (hed_name like('%$search%') or hed_phone like('%$search%')) and b.ref_code='fml'";
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
    function save() {
        $id = $this->input->post('id');
        $cash = $this->getValue('cash');
        $rtp_id= $this->input->post('receipt_type');
        $hed_id= $this->input->post('familyid');
        $toid= $this->input->post('ledgerid');
        $paidon = $this->input->post('paidon');
        $paid_status = $this->input->post('paid_status');
        $reg_paidon = $this->getDate($paidon);
        $reg_amount = $this->input->post('rec_amount');
        $rec_data = array(      
                            'reg_id' => $id,   
                            'rtp_id' => $rtp_id,
                            'hed_id'=>$hed_id,
                            'rec_amount'=>$reg_amount,
                            'rec_ispaid'=>$paid_status,
                            'rec_paid_date'=>$reg_paidon,
                         );
                       
       if ($id == 0) {
            $this->db->insert('chr_receipts', $rec_data);
            $insert_id = $this->db->insert_id();
            /*
            $this->trans_save($id, $insert_id, "voucher", "receipt", $cash, $toid, $paidon, '0.00', $reg_amount, 'narration', '1');
            $this->trans_save($id, $insert_id, "voucher", "receipt", $toid, $cash, $paidon, $reg_amount, '0.00', 'narration', '1');*/
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
            $this->db->where('rec_id', $id);
            $this->db->update('chr_receipts', $rec_data);
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
        $qry = "delete from chr_receipts where rec_id =".$id;
        $this->db->query($qry);
        //$qry = "delete from chr_receipt_gen where rec_id =".$id;
        //$this->db->query($qry);
    }
    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='".$id."'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }
}
