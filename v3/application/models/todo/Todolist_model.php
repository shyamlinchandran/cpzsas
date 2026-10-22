<?php


class Todolist_model extends DataTable {

    public function __construct() {
        parent::__construct();

        $this->select = 'r.*,r.date as sdate, u.user_name as userss, ts.status as stt';
        $this->table = 'todo_register as r inner join todo_allocation as a on a.enq_id = r.id inner join users as u on r.user = u.Id inner join todo_status as ts on ts.id = r.status';
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
        $this->wherecondition = 'where a.user = '.$userid.' and r.state <> 4';
        

        // if($this->input->post('date')){
        //     $this->wherecondition = $this->wherecondition.' and r.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        // }
    }

}