<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trasport_model
 *
 * @author jijodileep
 */
class Trasportsales_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,b.*';
        $this->table = 'tra_sales as a inner join tra_consignee as b on a.consignee=b.Id';
        $this->column_order = array(); //set column field database for datatable orderable
        $this->column_search = array('sdate', 'rdate', 'a.container', 'b.Name'); //set column field database for datatable searchable 
        $this->order = array('a.pid' => 'desc'); // default order 
    }

    function where() {
        $post = $this->input->post('status');
        $this->wherecondition = "where a.status =" . $post;
    }

    function getsalesing($id) {
        $qry = 'select DATE_FORMAT(sdate,"%d/%m/%Y") as s_date,DATE_FORMAT(rdate,"%d/%m/%Y") as r_date, a.* from tra_sales as a  where pid=' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function getemail($id) {
        $qry = 'select * from tra_consigner where Id =' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function consiner($id) {
        $qry = 'select * from tra_consigner where Id =' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function Consignee($id) {
        $qry = 'select * from tra_consignee where Id =' . $id;
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    function oc($id) {
        $qry = 'select * from tra_sitems where pid =' . $id;
        $result = $this->db->query($qry);
        return $result->result_array();
    }

}
