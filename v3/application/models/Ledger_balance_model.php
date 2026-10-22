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
class Ledger_balance_model extends DataTable {

    function where() {

        $this->select = "IFNULL(credit,0) as credit,IFNULL(debit,0) as debit,b.type,b.id,IFNULL(d.bal,0) as tran_amt ,IFNULL(d.bal,0)  as Closing_balance,a.name,IFNULL(b.openning_bal,0) as openning_bal,phone ";
        if ($this->input->post('type') == "all") {
            $this->table = "suppliers as a inner join acc_ledgers as b on a.id=b.ref_id and b.ref_code in('sup','cus')  left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes' and c.tran_date<='" . $this->getDate($this->input->post('date')) . "' GROUP by c.ledger_id ) as d on d.ledger_id=b.id  ";
        } else {
            $this->table = "suppliers as a inner join acc_ledgers as b on a.id=b.ref_id and b.ref_code in('" . $this->input->post('type') . "')  left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes' and c.tran_date<='" . $this->getDate($this->input->post('date')) . "' GROUP by c.ledger_id ) as d on d.ledger_id=b.id  ";
        }
        $this->column_order = array(null, 'a.nam'); //set column field database for datatable orderable
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order    
		if($this->input->post('area')){
			$this->wherecondition = ' where a.area ='.$this->input->post('area');
		}
    }

}
