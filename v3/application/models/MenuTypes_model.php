<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MenuTypes_model
 *
 * @author admin
 */

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');


class MenuTypes_model extends DataTable {
    
  public function __construct() {
        parent::__construct();
        $this->table = 'company_type ';
        $this->column_order = array(null,  'a.type'); //set column field database for datatable orderable
        $this->column_search = array('type'); //set column field database for datatable searchable 
        
        $this->select = '*';
    }

//add custom filter here
    function where() {
       
    }
    function get_menu_byid($id){
         $qry = "select a.*, b.typeid, menuid  from menus as a left join  (select * from  menutocmpnytype where typeid = '$id')  as b on a.id=b.menuid where parent=0 order by id";
         $result = $this->db->query($qry);
        return $result->result_array();
    }
    
     function get_type_byid($id){
         $qry = "select type from company_type  where id = '$id'";
         $res = $this->db->query($qry);
        return $res;
    }
    function delete($id){
        $qry = "delete from  company_type where id =" . $id;
        $this->db->query($qry);
		
		
    }
     
}