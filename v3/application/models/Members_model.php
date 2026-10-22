<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require_once('commmondb.php');
class Members_model extends CI_Model {

    var $table = 'member';
    var $column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
    var $column_search = array('name', 'email', 'phone', 'address_line1'); //set column field database for datatable searchable 
    var $order = array('id' => 'desc'); // default order 
    var $cmdb='';
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->cmdb= new commmondb();
    }
    function  getcategory (){
        $qry = "select * from member_category where  published='yes'";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    private function _get_datatables_query() {

        //add custom filter here
        if ($this->input->post('country')) {
            $this->db->where('country', $this->input->post('country'));
        }
        if ($this->input->post('FirstName')) {
            $this->db->like('name', $this->input->post('FirstName'));
        }
        if ($this->input->post('LastName')) {
            $this->db->like('email', $this->input->post('LastName'));
        }
        if ($this->input->post('address')) {
            $this->db->like('phone', $this->input->post('address'));
        }

        $this->db->from($this->table);
        $i = 0;

        foreach ($this->column_search as $item) { // loop column 
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }

                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function get_datatables() {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered() {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all() {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    public function count($id, $type, $ps) {
        $qry = "select * from member where $type ='$id' ";
        if ($ps != 0) {
            $qry =$qry.' and id !='.$ps;
        }
        $result = $this->db->query($qry);
        return $result->num_rows();
    }

    public function list_by_id($id) {
        $qry = "select * from member where id ='$id' ";
        $result = $this->db->query($qry);
        return $result->row_array();
    }

    public function list_by_family($id) {
        $qry = "select * from member_family where member_id ='$id' ";
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    public function saveall() {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $phone = $this->input->post('phone');
        $address_line1 = $this->input->post('address_line1');
        $email =  $this->input->post('email');
        $member_cate_id =  $this->input->post('membercategory');
        $dob =$this->cmdb->getDate( $this->input->post('dob'));
        $address_line2 =  $this->input->post('address_line2');
        $details = $this->input->post('details');
        $pname = $this->input->post('pname', true);
        $pphone = $this->input->post('pphone', true);
        $pemail = $this->input->post('pemail', true);
        $membertype = $this->input->post('membertype', true);
        $ddetails = $this->input->post('ddetails', true);
        $insert_id = $id;
        $data = array(
            'name' => $name,
            'phone' => $phone,
            'dob' => $dob,
            'member_cate_id' => $member_cate_id,
            'address_line1' => $address_line1,
            'email' => $email,
            'address_line2' => $address_line2,
            'details' => $details);
        if ($id == 0) {
            $this->db->insert('member', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $this->db->where('id', $id);
            $this->db->update('member', $data);
        }
        $length = sizeof($membertype);
        $qry = "delete from member_family where member_id ='$id' ";
        $result = $this->db->query($qry);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'name' => $pname[$i],
                'member_type_id' => $membertype[$i],
                'member_id' => $insert_id,
                'phone' => $pphone[$i],
                'email' => $pemail[$i],
                'details' => $ddetails[$i]);
            $this->db->insert('member_family', $data);
        }
    }

}
 