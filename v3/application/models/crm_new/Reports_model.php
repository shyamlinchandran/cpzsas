<?php


class Reports_model extends DataTable {

    public function __construct() {
        parent::__construct();

        $this->select = 'alt.*, alt.trn_tp as vtype, al.name as ledgers';
        $this->table = 'acc_ledger_trans as alt inner join acc_ledgers as al on alt.to_ledger_id = al.id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('',''); //set column field database for datatable searchable 
        $this->order = array('alt.tran_id' => 'desc'); // default order 
    }

    public function where()
    {
        $this->wherecondition = " where alt.published = 'yes' and alt.tb_name = 'voucher' and alt.trn_tp = 'receipt'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }	
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
    }


}
