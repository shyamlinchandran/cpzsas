<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Companytype_model
 *
 * @author admin
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Companytype_model extends CI_Model {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

//    function menus() {
//        $qry = "select  * from menus ";
//        $result = $this->db->query($qry);
//        return $result->result_array();
//    }
//
//    function Company() {
//        $qry = 'select * from company';
//        $re = $this->db->query($qry);
//        return $re->result_array();
//    }
    public function alreadyexistcheck($name) {
        $qry = "select count(*) as cnt from company_type where type='$name' ";
        $query = $this->db->query($qry)->row_array();
        return $query['cnt'];
    }

    function Save() {
        $name = $this->input->post('type');
        $menu = $this->input->post('chk');
        $name = $this->input->post('type');



        if ($this->alreadyexistcheck($name) != 0) {
            $data = array(
                'typeid' => $name,
            );
            $this->db->delete('menutocmpnytype', $data);
            

            foreach ($menu as $value) {
                $data = array(
                    'typeid' => $name,
                    'menuid' => $value
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
        }
    }

}

//         function CheckCtype(){
//             
//              $echeck="select type from company_type where type=".$_POST['type'];
//   $echk=mysql_query($echeck);
//   $ecount=mysql_num_rows($echk);
//  if($ecount!=0)
//   {
//      echo "Email already exists";
//   }
//         }