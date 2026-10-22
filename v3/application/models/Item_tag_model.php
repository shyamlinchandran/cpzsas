<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class Item_tag_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = ' tags';
        $this->column_order = array(null, 'tag_name'); //set column field database for datatable orderable
        $this->column_search = array('tag_name'); //set column field database for datatable searchable 
        $this->order = array('tag_name' => 'asc'); // default order 
    }

    function where() {
        
    }

    function where_tag() {
        $this->select = ' b.name,a.id';
        $this->table = ' item_tags as a inner join item as b on a.item_id=b.id';
        $this->column_order = array(null, 'b.name'); //set column field database for datatable orderable
        $this->column_search = array('b.name'); //set column field database for datatable searchable 
        $this->order = array('b.name' => 'asc'); // default order 
    }

    function gesing($id) {
        $qry = "SELECT a.tag_name,a.code as tagcode,a.description as des,b.* FROM `tags` as a INNER JOIN item_sub_tags as b on a.tag_id=b.tag_id where b.published='yes' and  a.tag_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getalltags() {
        $qry = "select * from tags";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function save() {
        $id = $this->input->post('id');
        $tag_name = $this->input->post('tag_name');
        $tag_code = $this->input->post('tag_code');
        $tag_des = $this->input->post('tag_des');
        $sub = $this->input->post('sub', true);
        $tag = $this->input->post('tag', true);
        $des = $this->input->post('des', true);
        $data = array(
            'tag_name' => $tag_name,
            'code' => $tag_code,
            'description' => $tag_des
        );
        if ($id == 0) {
            $this->db->insert('tags', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $this->db->where('tag_id', $id);
            $this->db->update('tags', $data);
            $qry = "update  item_sub_tags set published ='no' where tag_id =" . $id;
            $this->db->query($qry);
        }
        $length = sizeof($sub);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'tag_id' => $insert_id,
                'name' => $sub[$i],
                'code' => $tag[$i],
                'description' => $des[$i],
                'published' => 'yes',
            );
            $this->db->insert('item_sub_tags', $data);
        }
        return $insert_id;
    }

}
