<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base_model
 *
 * @author jijodileep
 */
class Base_model extends CI_Model {

	function getcompany_database($comid){
		$this->db->close();
        $this->load->dbutil();
        $config['hostname'] = 'localhost';
        $config['username'] = 'cpzassroot';
        $config['password'] =  'kbn9AeEVHc57dKuJXgrhBz';
        $config['database'] = 'cpzsas_main';
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $this->load->database($config);
		$qry = "SELECT a.*,b.*,count(a.com_id) as cnt FROM company as a inner join `set_database` as b on a.com_id=b.com_id WHERE comkey='".$comid."' ";
		$query = $this->db->query($qry)->row_array();
        $this->db->close();
		return $query;
	}
    //put your code here
    function database($key) {
		$this->db->close();
        $this->load->dbutil();
        $config['hostname'] = 'localhost';
        $config['username'] = 'cpzassroot';
        $config['password'] =  'kbn9AeEVHc57dKuJXgrhBz';
        $config['database'] = 'cpzsas_main';
        $config['dbdriver'] = 'mysqli';
        $config['dbprefix'] = '';
        $config['pconnect'] = FALSE;
        $config['db_debug'] = TRUE;
        $config['cache_on'] = FALSE;
        $config['cachedir'] = '';
        $config['char_set'] = 'utf8';
        $config['dbcollat'] = 'utf8_general_ci';
        $this->load->database($config);
		$qry = "SELECT a.*,b.*,count(a.com_id) as cnt FROM company as a inner join `set_database` as b on a.com_id=b.com_id WHERE comkey='".$key."' ";
		$query = $this->db->query($qry)->row_array();
        $this->db->close();
		if( $query['cnt'] > 0 ){
			$config['hostname'] = $query['sdb_server'];
			$config['username'] = $query['sdb_username'];
			$config['password'] = $query['sdb_password'];
			$config['database'] = $query['sdb_name'];
			$config['dbdriver'] = 'mysqli';
			$config['dbprefix'] = '';
			$config['pconnect'] = FALSE;
			$config['db_debug'] = TRUE;
			$config['cache_on'] = FALSE;
			$config['cachedir'] = '';
			$config['char_set'] = 'utf8';
			$config['dbcollat'] = 'utf8_general_ci';
			$this->load->database($config);
		}
    }
    var $pass_encryption = 'securepassword2019';

}
