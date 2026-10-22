<?php


class Enquirylist_model extends DataTable {

    public function __construct() {
        parent::__construct();

        $this->select = 'r.*,a.Edate,a.Ddate';
        $this->table = 'enquiry_register as r inner join enquiry_allocation as a on a.enq_id = r.id ';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('r.contactPerson', 'r.companyName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    public function where()
    {
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->wherecondition = 'where r.status <> 5 and a.user = '.$userid;

        // if($this->input->post('date')){
        //     $this->wherecondition = $this->wherecondition.' and r.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        // }
    }

}