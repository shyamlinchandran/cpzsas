<?php

require_once('dataTable.php');

class Menus_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'select * from menus';
        $this->table = 'purchase as a inner join suppliers as b on a.supplier_id =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name', 'email', 'phone', 'address_line1'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    public function list_items() {
        $list = $this->db->query($this->select." ORDER BY menu_series ");
        return $list->result_array();
    }

    public function list_items_by_user($id) { 
        $list = $this->db->query('SELECT * FROM `menu_to_user` as a inner join menus as b on a.`menu_id`= b.id where user_id=' . $id .' ORDER BY b.menu_series asc');
         return $list->result_array();
    }

    public function getpermission($user, $url) {
        $log = $this->db->query('SELECT * FROM menus as b where url="' . $url . '" limit 1');
        $list = $this->db->query('SELECT * FROM `menu_to_user` as a inner join menus as b on a.`menu_id`= b.id where user_id=' . $user . " and url='" . $url . "'");
        $sm = $log->row_array();
        $menuid = $sm['id'];
        if ($menuid != '') {
            $log_data = array('user_id' => $user, 'menu_id' => $menuid);
            $this->db->insert('user_action_log', $log_data);
        }
        return $list->row_array();
    }

}

 