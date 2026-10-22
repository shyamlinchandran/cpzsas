<?php 
class New_Voucher_Report_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function where()
    {
        $this->select = "v.trans_date as date,v.voucher_no as no,v.vourcher_type 
        as VCH_type,l.name as accounts,l.name_lan as particulers,v.naration";
        $this->table = "voucher as v left join voucher_trans as vt on vt.voucher_id=v.id left join acc_ledgers as l on l.id=vt.acc_ledgers_id";
        $this->column_search = array('l.name');
        $this->column_order = array('v.trans_date');
        $this->order = array('v.trans_date'=>'desc');

        $this->wherecondition =' where v.vourcher_type = "journal" ';
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and trans_date>="' . $this->getdate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and trans_date<="' . $this->getdate($this->input->post('enddate')) . '"';
        }
    }
}