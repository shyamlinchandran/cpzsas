<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ledgers_model
 *
 * @author jijodileep
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require_once('dataTable.php');

class Ledgers_model extends DataTable {

    function __construct() {
        parent::__construct('acc_ledgers');
    }

    function searchcontra($text) {
        $qry = "select * from  acc_ledgers where acc_main_id in (1,2,3,4) and  ( name like ('%" . $text . "%') or code  like ('%" . $text . "%'))";
        $query = $this->db->query($qry);
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['value'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['label'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['id'] = htmlentities(stripslashes($row['id']));
                $new_row['ref_id'] = htmlentities(stripslashes($row['ref_id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }

    function getautocomplete($q, $type, $ledid) {
		$txt = '';
        $settings = $this->getCompanySettings();
		if($type =='rec' || $type == 'pay'){
			$txt = ' acc_main_id not in (1,4) and ';
		}
        if (!$ledid == 0) {
            $qry = "select * from  acc_ledgers where  ".$txt." acc_main_id = " . $ledid . " and (name like ('%" . $q . "%') or code  like ('%" . $q . "%'))";
             $customer_branch = 0 ;
             $tmp = $this->session->userdata('user');
            if(isset( $settings[0]['customer_branch']) && $tmp['utype'] != 'Admin'){
                $branch = $tmp['branch'];
                // $qry = "select * from  acc_ledgers a left join suppliers as b on a.ref_id = b.id and a.ref_code in ('cus','sup')  where  (b.id is null or b.branch =  $branch  )  and  ".$txt." acc_main_id = " . $ledid . " and (a.name like ('%" . $q . "%') or a.code  like ('%" . $q . "%'))";

            }
            $query = $this->db->query($qry);
        } else {
            $qry = "select * from  acc_ledgers where ".$txt."  ( name like ('%" . $q . "%') or code  like ('%" . $q . "%') ) ";
             $customer_branch = 0 ;
             $tmp = $this->session->userdata('user');
            if(isset( $settings[0]['customer_branch']) && $tmp['utype'] != 'Admin'){
                $branch = $tmp['branch'];
                // $qry = "select * from  acc_ledgers a left join suppliers as b on a.ref_id = b.id and a.ref_code in ('cus','sup') where  (b.id is null or b.branch =  $branch  )  and ".$txt."  ( a.name like ('%" . $q . "%') or a.code  like ('%" . $q . "%') ) ";

            }
            $query = $this->db->query($qry);
        }

        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['value'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['label'] = htmlentities(stripslashes($row['name'] . '-' . $row['code']));
                $new_row['id'] = htmlentities(stripslashes($row['id']));
                $new_row['ref_id'] = htmlentities(stripslashes($row['ref_id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }

    function create_ledger($data) {
        $this->db->insert('acc_ledgers', $data);
        $insert_id = $this->db->insert_id();
        $this->ledgers_code($data['acc_main_id'], $insert_id);
    }

    function getcount($id, $unit_id) {
        $qry = 'select count(id) as count from units where id=' . $unit_id . ' and unit_id =' . $id;
        $query = $this->db->query($qry)->row_array();
        return $query['count'];
    }

    function create_user($data) {
        $this->db->insert('users', $data);
    }

    function create_godown($data) {
        $this->db->insert('godown', $data);
    }

    public function encryptpaswrd($password, $id) {
        $qry = "update  users set user_password =AES_ENCRYPT('" . $password . "', '" . $this->pass_encryption . "')  where Id =" . $id;
        $this->db->query($qry);
    }
	
	function save_target(){
		$id = $this->input->post('id');
		$daily = $this->input->post('daily');
		$weekly = $this->input->post('weekly');
		$yearly = $this->input->post('yearly');
		$jan = $this->input->post('jan');
		$feb = $this->input->post('feb');
		$mar = $this->input->post('mar');
		$apr = $this->input->post('apr');
		$may = $this->input->post('may');
		$jun = $this->input->post('jun');
		$jul = $this->input->post('jul');
		$aug = $this->input->post('aug');
		$sep = $this->input->post('sep');
		$oct = $this->input->post('oct');
		$nov = $this->input->post('nov');
		$dec = $this->input->post('dec');
		$data = array(
			'user_id'=>$id,
			'daily'=>$daily,
			'weekly'=>$weekly,
			'yearly'=>$yearly,
			'jan'=>$jan,
			'feb'=>$feb,
			'mar'=>$mar,
			'apr'=>$apr,
			'may'=>$may,
			'jun'=>$jun,
			'jul'=>$jul,
			'aug'=>$aug,
			'sep'=>$sep,
			'oct'=>$oct,
			'nov'=>$nov,
			'december'=>$dec,
		);
		$qry = "select * from user_target where user_id= ".$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$this->db->where('user_id',$id);
			$this->db->update('user_target',$data);
		}else{
			$this->db->insert('user_target',$data);
		}
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
		
	}

}
