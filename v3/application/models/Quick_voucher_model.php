<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class Quick_voucher_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.user_name,c.name as frm';
        $this->table = 'voucher_quick as a left join users as b on a.user=b.Id inner join acc_ledgers as c on a.ledger_from=c.id';
        $this->column_order = array(null, 'a.date'); //set column field database for datatable orderable
        $this->column_search = array('b.user_name'); //set column field database for datatable searchable 
        $this->order = array('a.date' => 'asc'); // default order 
    }

    function where() {
        $this->wherecondition = " where  a.published='yes'";
    }

    function ledgers() {
        $qry = "select a.* from acc_ledgers as a where acc_main_id=4";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function main_ledgers() {
        $qry = "select a.* from acc_main as a where acc_sub_type_id=6";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function save() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $id = $this->input->post('id');
        $insert_id = $id;
        $date = $this->input->post('date');
        $ledger = $this->input->post('ledger');
        $to_ledger = $this->input->post('to_ledger', TRUE);
        $ledger_amount = $this->input->post('ledger_amount', TRUE);
        $paynarration = $this->input->post('paynarration', TRUE);
        $total = $this->input->post('total');
        $main_ledger = $this->input->post('main_ledger');
        $qry = "select * from acc_main where id=" . $main_ledger;
        $query = $this->db->query($qry)->row_array();
        $branch = $query['branch_id'];
        $data = array(
            'ledger_from' => $ledger,
            'date' => $this->getDate($date),
            'total' => $total,
        );
        if ($id == 0) {
            $qry = "SELECT IFNULL(max(id),0)+1 as id FROM voucher_quick as a WHERE 1";
            $query = $this->db->query($qry);
            $query = $query->row_array();
            $no = $query['id'];
            $qry = "INSERT INTO voucher_quick ( voucher_no, ledger_from, date,  total,user, published) VALUES ('" . $no . "', '" . $ledger . "', '" . $this->getDate($date) . "',  '" . $total . "',  '" . $userid . "', 'yes')";
            $this->db->query($qry);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('voucher_quick', $data);
            $qry = "update voucher_quick_items set published='no' where voucher_quick_id=" . $id . " ";
            $this->db->query($qry);
            $qry = "update acc_ledger_trans set published='no' where tb_name='voucher_quick' and tb_id=" . $id . " ";
            $this->db->query($qry);
        }
        $qry = "select * from voucher_quick where id=" . $insert_id;
        $query = $this->db->query($qry);
        $query = $query->row_array();
        $voucher_no = $query['voucher_no'];
        $length = sizeof($ledger_amount);
        for ($i = 0; $i < $length; $i++) {
            if ($ledger_amount[$i] > 0) {
                $data = array(
                    'voucher_quick_id' => $insert_id,
                    'ledger_to' => $to_ledger[$i],
                    'amount' => $ledger_amount[$i],
                    'published' => 'yes',
                    'narration' => $paynarration[$i]
                );
                $narration = $voucher_no . ' on ' . $date;
                if ($paynarration[$i] == "") {
                    $narration = $paynarration[$i];
                }
                $this->db->insert('voucher_quick_items', $data);
                $this->trans_save($voucher_no, $insert_id, 'voucher_quick', 'new_expense', $to_ledger[$i], $ledger, $this->getDate($date), $ledger_amount[$i], '0.00', $paynarration[$i], 1, 0, $branch);
                $this->trans_save($voucher_no, $insert_id, 'voucher_quick', 'new_expense', $ledger, $to_ledger[$i], $this->getDate($date), '0.00', $ledger_amount[$i], $paynarration[$i], 1, 0, $branch);
            }
        }
        return $insert_id;
    }

    function expense_ledger($id, $main_id) {
        $qry = "SELECT IFNULL(d.narration,'') as pay_narration,a.id,a.name,d.*,IFNULL(amount,0) as amt,IFNULL(total,0) as tot FROM acc_ledgers as a left join (select b.id as quick_id,b.ledger_from,b.voucher_no,b.date,b.total,c.amount,c.ledger_to,narration from voucher_quick as b inner join voucher_quick_items as c on b.id=c.voucher_quick_id where b.published='yes' and c.published='yes' and b.id='" . $id . "') as d on d.ledger_to =a.id WHERE a.acc_main_id in(" . $main_id . ") order by IFNULL(total,0) desc ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

}
