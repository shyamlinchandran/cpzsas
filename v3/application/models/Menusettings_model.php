<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of menusettings_model
 *
 * @author u43255
 */
class menusettings_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function menus() {
        $qry = "select  * from menus ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function user() {
        $qry = 'select id,username from users';
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function Company($id) {
        $qry = 'select * from company';
        if ($id != 0) {
            $qry = 'select * from company where com_id=' . $id;
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function get_menu_byid($id) {
        $qry = "select  menuid from menutocmpnytype where typeid = '$id'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function get_menu_list() {
        $qry = "select * from menus ";
        $res = $this->db->query($qry);
        return $res->result_array();
    }

//    function MenuCreate() {
//        $name = $this->input->post('name');
//        $menu = $this->input->post('chk');
//        echo $name;
//        foreach ($menu as $value) {
//            $data = array(
//                'company_id' => $name,
//                'menu_id' => $value
//            );
//            $this->db->insert('menu_to_company', $data);
//        }
//    }
    public function alreadyexistcheck($name) {
        $qry = "select count(*) as cnt from menu_to_user where user_id='$name' ";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    function Save() {

        $name = $this->input->post('username');
        $menu = $this->input->post('chk', TRUE);
        if ($this->alreadyexistcheck($name) != 0) {
            $data = array(
                'user_id' => $name,
            );
            $this->db->delete('menu_to_user', $data);
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
                'user_id' => $name,
                'is_read' => $read,
                'is_write' => $Write,
                'is_delete' => $Delete
            );


            $this->db->insert('menu_to_user', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}

/*
      if ($this->alreadyexistcheck($name) != 0) {
      $data = array(
      'typeid' => $name,
      );
      $this->db->delete('menu_to_user', $data);


      foreach ($menu as $value) {
      $data = array(
      'user_id' => $name,
      'menu_id' => $value
      );
      $this->db->insert('menutocmpnytype', $data);
      }
      } else {

      $data = array(
      'type' => $name,
      );
      $this->db->insert('company_type', $data);
      $insert_id = $this->db->insert_id();


      foreach ($menu as $value) {
      $data = array(
      'typeid' => $insert_id,
      'menuid' => $value
      );
      $this->db->insert('menutocmpnytype', $data);
      }
      $response = array(
      'valid' => false,
      'type' => 1,
      'message' => 'Saved Successfully.'
      );
      echo json_encode($response);
      } */

