<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ledgers_model
 *
 * @author jijodileep
 */
class Ledgers_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' IFNULL(e.debit,0)-IFNULL(e.credit,0),IFNULL(bal,0) as trans,c.GST as tax ,b.name as mainledger,a.* ';
        $this->table = ' acc_ledgers as a left JOIN acc_main as b on a.acc_main_id=b.id left JOIN taxgst as c on c.gstid=a.tax_id left join (select sum(tran_debit) - sum(tran_credit)  as bal,sum(tran_credit) as credit,sum(tran_debit) as debit,ledger_id from acc_ledger_trans as d where d.published="yes" group by ledger_id) as e on e.ledger_id=a.id ';
        $this->column_order = array('a.name', 'b.name', 'a.code', 'a.type'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'b.name', 'a.code', 'a.type'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
         if($this->input->post('main_group') ){
			$this->wherecondition = ' where a.acc_main_id = '.$this->input->post('main_group');
		}
    }

    function ledgergroup() {
        $this->select = ' b.name as subtype,a.* ';
        $this->table = ' acc_main as a left JOIN acc_sub_type as b on a.acc_sub_type_id=b.id ';
        $this->column_order = array('a.name', 'b.name', 'a.code'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'b.name', 'a.code'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

function getsing($id) {
        $qry = 'select *from acc_ledgers as a where a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save_ledgers() {
        $id = $this->input->post('id'); // if it is zero then we will add the item
        $name = $this->input->post('name');
        $open_balance = $this->input->post('open_balance');
        $ledger_type = $this->input->post('ledger_type');
        $ledger_code = $this->input->post('ledger_code');
		$hsncode = $this->input->post('hsncode');
        $main_acc = $this->input->post('main_acc');
        $tax_id = $this->input->post('tax_id');
        if ($tax_id == '') {
            $tax_id = 0;
        }
        $ledger_code = $this->input->post('ledger_code');
        $data = array(
            'name' => $name,
            'acc_ledger_code' => $ledger_code,
            'tax_id' => $tax_id,
			'hsncode'=>$hsncode,
            'acc_main_id' => $main_acc,
            'is_for_sales' => $this->input->post('is_for_sales'),
            'is_for_purchase' => $this->input->post('is_for_purchase'),
            'type' => $ledger_type,
            'openning_bal' => $open_balance,
            'published' => 'yes'
        );
        if ($this->input->post('name_lan')) {
            $data['name_lan'] = $this->input->post('name_lan');
        }
        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        if ($main_acc == 24) {
            $type = 'sup';
        } else {
            $type = 'cus';
        }
        if ($id == 0) {
            $data['ref_id'] = 1;
            $data['ref_code'] = 'yes';
            $data['is_default'] = 0;

            if ($main_acc == 24 || $main_acc == 25) {
                $cusdata = array(
                    'name' => $name,
                    'type' => $type
                );
                if ($this->input->post('name_lan')) {
                    $cusdata['name_lan'] = $this->input->post('name_lan');
                }
                $this->db->insert('suppliers', $cusdata);
                $insert_id = $this->db->insert_id();
                $data['ref_id'] = $insert_id;
                $data['ref_code'] = $type;
                $data['is_default'] = 0;
                $response['id'] = $insert_id;
                $response['ref_code'] = $type;
            }
            $this->db->insert('acc_ledgers', $data);
        } else {
            if ($main_acc == 24 || $main_acc == 25) {
                $qry = "select a.* from acc_ledgers as a  where id =" . $id;
                $currentledger = $this->db->query($qry);
                $result = $currentledger->row_array();
                $cusdata = array(
                    'name' => $name
                );
                $this->db->where('id', $result['ref_id']);
                $this->db->update('suppliers', $cusdata);
                $response['id'] = $result['ref_id'];
                $response['ref_code'] = $type;
            } 
            
            $this->db->where('id', $id);
            $this->db->update('acc_ledgers', $data);
        }


        echo json_encode($response);
    }

    function main_ledger() {
        $qry = "select a.* from acc_main as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value ="">select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

}
