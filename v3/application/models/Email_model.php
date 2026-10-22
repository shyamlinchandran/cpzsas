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
class Email_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'message,name,b.id';
        $this->table = 'email_type as a inner join email_msg as b on a.id=b.type_id';
       
        $this->column_search = array('message');
        $this->order = array('a.id' => 'desc');
    }



    function where() {
       
    }
     function getsing($id) {
        $qry = 'select * from email_msg where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

   function save(){
        $message = $this->input->post('msg');
        $type_id = $this->input->post('msgtype');
        $id =  $this->input->post('id');
         $data = array(
                    'message' => $message,
                    'type_id' => $type_id,
                );
       if($id<=0){
          $this->db->insert('email_msg', $data);
          $insert_id = $this->db->insert_id();
       }else{
        $this->db->where('id', $id);
        $this->db->update('email_msg', $data);
        $insert_id = $id;
       }
        return $insert_id;

   }

}
