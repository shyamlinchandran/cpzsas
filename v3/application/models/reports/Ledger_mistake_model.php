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
class Ledger_mistake_model extends DataTable {

   

    function where() {

        $this->select = ' tb_id,sum(tran_debit) as debit,sum(tran_credit) as credit,voucher_no,sum(tran_debit-tran_credit) as diff,trn_tp';
        $this->table = 'acc_ledger_trans  ';
        $this->column_order = array(null, 'voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('voucher_no'); //set column field database for datatable searchable 
        $this->order = array('voucher_no' => 'asc'); // default order 
        $this->wherecondition = " where  published='yes' GROUP by voucher_no having sum(tran_debit-tran_credit)!=0";
       
    }



}
