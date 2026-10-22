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
//defined('BASEPATH') OR exit('No direct script access allowed');
//require_once('dataTable.php');

class Package_Menu_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = 'package as a inner join package_menus as b on a.package_id=b.package_id ';
        $this->select = 'distinct package,a.package_id';
		 $this->column_search = array('a.package');
        $this->order = array('a.package_id' => 'asc');
    }

//add custom filter here
    function packagelist() {
        $qry = 'select package_id,package  from package ';
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function where() {
        
    }

    function menus($id) {
        $qry = "select a.*,b.* from master_menu as a left JOIN (select e.menu_id,e.is_read,e.is_delete,e.is_write,d.package,d.package_id as uid from package_menus as e INNER JOIN package as d on e.package_id=d.package_id WHERE e.package_id=" . $id . " ) as b on a.id=b.menu_id order by uid DESC";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    public function alreadyexistcheck($package) {
        $qry = "select count(*) as cnt from package_menus where package_id='$package' ";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    function Save() {

        $package = $this->input->post('package');
        $menu = $this->input->post('chk', TRUE);
        if ($this->alreadyexistcheck($package) != 0) {
            $qry = "delete from package_menus where package_id = " . $package;
            $this->db->query($qry);
        }
        foreach ($menu as $in) {
            if ($this->input->post('write' . $in) == 'on') {
                $Write = '1';
            } else {
                $Write = '0';
            }
            if ($this->input->post('read' . $in) == 'on') {
                $read = '1';
            } else {
                $read = '0';
            }
            if ($this->input->post('delete' . $in) == 'on') {
                $Delete = '1';
            } else {
                $Delete = '0';
            }
            $menuid = $in;
            $data = array(
                'menu_id' => $menuid,
                'package_id' => $package,
                'is_read' => $read,
                'is_write' => $Write,
                'is_delete' => $Delete
            );


            $this->db->insert('package_menus', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
