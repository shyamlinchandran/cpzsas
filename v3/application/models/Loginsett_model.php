<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
require_once('dataTable.php');
class Loginsett_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.set_id,a.user_id as loginid,a.set_ip as ip,a.set_status as status, a.set_logintime as login,b.user_name as user,b.Id as userid';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'sett_login as a inner join users as b on a.user_id =b.Id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'user', 'ip', 'status'); //set column field database for datatable orderable   
        $this->column_search = array('b.user_name'); //set column field database for datatable searchable 
        $this->order = array('a.set_id' => 'desc'); // default order 
    }

    function where() {
        $type = $this->input->post('type');
        $user = $this->input->post('user');
        $btn = $this->input->post('searchbtn');
        /*if(isset($btn))
        {
             */ if($user =='0')
            {
                $this->wherecondition = "where a.set_status = '" . $type . "'" ;
            }
            else
            {
                $this->wherecondition = "where a.set_status = '" . $type . "' and a.user_id = '" . $user . "'";
            } /* 
        } */     
    }

     function getUsers() {
        $qry = 'select * from users';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function getUserbyId($id) {
        $qry = "select AES_DECRYPT(user_password,'".$this->pass_encryption."') as password,a.* from users as a where Id=".$id;
        $res = $this->db->query($qry);
        return $res->row()->password;
    }

    function logoutuser($id,$session)
    {
        $qry = "update sett_login set `set_status`= 0 where `user_id`= ". $id.  " and `session_id` = '". $session ."'";
        $this->db->query($qry);
    }

    function changepswd($id,$new_password)
    {
        $qry = "update users set `user_password`= AES_ENCRYPT('".$new_password."', '".$this->pass_encryption."') where `Id`= ". $id;
        $this->db->query($qry);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Changed Successfully.'
        );
        echo json_encode($response);
    }
}