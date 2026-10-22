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


class MenuToCompany_model extends DataTable {
    
  public function __construct() {
        parent::__construct();
        $this->table = 'company as a inner join menu_to_company as b on a.com_id=b.company_id ';
        $this->select = 'distinct name,com_id';
    }

//add custom filter here
    function where() {
       
    }
      function menus() {
        $qry = "select  *, id+1 as menu_id from menu_all ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function menu($id) {
        $qry = 'select distinct ListName,id,b.menu_id,Url,parent,icon,published  FROM menu_all as a left join (select * from menu_to_company WHERE company_id='. $id .') as b on a.id=b.menu_id';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function submenu($id) {
        $qry = 'select distinct ListName,a.id,b.menu_id,Url,parent,icon,published  FROM menu_all as a left join (select * from sub_to_company WHERE sub_id='. $id .') as b on a.id=b.menu_id';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
     function subscription($id) {
        $qry = "select a.* from company_subcription as a ";
        if($id!=0){
            $qry = "select a.* from company_subcription as a where id=".$id;
        }
       $re = $this->db->query($qry);
        return $re->result_array();
    }
     function Company($id) {
        $qry = 'select *,0 as num from company';
        if($id!=0){
        $qry = 'select *,1 as num from company where com_id='.$id;
      }
        $re = $this->db->query($qry);
        return $re->result_array();
    }
    public function alreadyexistcheck($id) {
        $qry = "select count(*) as cnt from menu_to_company where company_id=".$id;
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }
     public function alreadyexist($id) {
        $qry = "select count(*) as cnt from sub_to_company where sub_id=".$id;
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }
      function Save() {
        $menu = $this->input->post('chk');
        $id = $this->input->post('username');
        if ($this->alreadyexistcheck($id) != 0) {
            $data = array(
                'company_id' => $id,
            );
            $this->db->delete('menu_to_company', $data);
        } 
            foreach ($menu as $value) {
                $data = array(
                    'company_id' => $id,
                    'menu_id' => $value
                );
                $this->db->insert('menu_to_company', $data);
            }
             $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
        function Savesubscription() {
        $menu = $this->input->post('chk');
        $id = $this->input->post('subcription');
        if ($this->alreadyexist($id) != 0) {
            $data = array(
                'sub_id' => $id,
            );
            $this->db->delete('sub_to_company', $data);
        } 
            foreach ($menu as $value) {
                $data = array(
                    'sub_id' => $id,
                    'menu_id' => $value
                );
                $this->db->insert('sub_to_company', $data);
            }
             $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
    function delete($id){
        $qry = "delete from  menu_to_company where company_id =" . $id;
        $this->db->query($qry);
		
		
    }
     
}