<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Base_model
 *
 * @author Dimind
 */
class Base_model extends CI_Model {

    //put your code here
    function database($key) {
        $this->db->close();
        $this->load->dbutil();
        $config['hostname'] = 'localhost';
        $config['username'] ='root';
        $config['password'] = '';
        $config['database'] ='kaasma_db';
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
