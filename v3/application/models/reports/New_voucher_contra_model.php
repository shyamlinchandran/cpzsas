<?php 
class New_voucher_contra_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function where()
    {
        $this->select = "sb.type as btype,DATE_FORMAT(trans_date, '%d-%m-%Y' ) as date,v.voucher_no,v.vourcher_type,trans_date,v.naration,v.amount,al.name as to_account,acf.name as from_account";
        $this->table = "voucher as v left join set_billtype as sb on sb.id = v.bill_type inner JOIN voucher_trans as vt on vt.credit_amounnt < vt.debit_amount and vt.voucher_id = v.id and vt.published='yes' INNER JOIN acc_ledgers as al on al.id = v.ledger INNER JOIN acc_ledgers as acf on acf.id =vt.acc_ledgers_id";
        $this->column_search = array('v.voucher_no');
        $this->column_order = array('v.trans_date');
        $this->order = array('v.trans_date'=>'desc');

        $this->wherecondition =' where v.vourcher_type = "contra" ';
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and trans_date>="' . $this->getdate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and trans_date<="' . $this->getdate($this->input->post('enddate')) . '"';
        }
    }
}