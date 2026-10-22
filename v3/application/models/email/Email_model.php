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
class Email_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = '*';
        $this->table = 'email_settings as a';

        $this->column_search = array('type', 'subject');
        $this->order = array('a.id' => 'desc');
    }



    function where()
    {
    }
    function getsing($id)
    {
        $qry = 'select * from email_settings where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save()
    {
    }
}
