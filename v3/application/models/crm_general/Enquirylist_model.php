<?php


class Enquirylist_model extends DataTable {

    public function __construct() {
        parent::__construct();

        $this->select = 'r.*,a.Edate,a.Ddate, u.user_name as user, it.items as item, sm.status as st_name';
        $this->table = 'enquiry_register as r inner join enquiry_allocation as a on a.enq_id = r.id left join (select er.id as reg, GROUP_CONCAT(i.name) as items from enquiry_register as er inner join enquiry_product as ep on ep.enquiry_id = er.id inner join item as i on ep.product_id = i.id) as it on it.reg = r.id inner join users as u on r.loggedin = u.Id left join status_master as sm on r.statuss = sm.id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }
 
    public function where()
    {
        $sDate = $this->getDate($this->input->post('fromDate'));
        $eDate = $this->getDate($this->input->post('toDate'));

        $userid = $this->session->userdata('user');
        $userid= $userid['Id']; 
        $this->wherecondition = 'where a.user = '.$userid;
        if($this->input->post('dat') == 'date'){
            $this->wherecondition = $this->wherecondition . " and a.Sdate >= '".$sDate."' and a.Sdate <= '" .$eDate. "'";
        }  
        if ($this->input->post('userss')) {
            $this->wherecondition = $this->wherecondition . " and r.user = " . $this->input->post('userss');
        } 
        if ($this->input->post('source')) {
            $this->wherecondition = $this->wherecondition . " and r.source = " . $this->input->post('source');
        }
        if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . " and r.area = " . $this->input->post('area');
        }
        if ($this->input->post('state')) {
            $this->wherecondition = $this->wherecondition . " and r.location = " . $this->input->post('state');
        }
        if ($this->input->post('types') > 0) {
            $this->wherecondition = $this->wherecondition . " and r.type = " . $this->input->post('types');
        }
        if ($this->input->post('productss') > 0) {
            $this->wherecondition = $this->wherecondition . " and ep.product_id = " . $this->input->post('productss');
        }
        $this->wherecondition = $this->wherecondition . ' and r.status < 6';

        // if($this->input->post('date')){
        //     $this->wherecondition = $this->wherecondition.' and r.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        // }
    }

}