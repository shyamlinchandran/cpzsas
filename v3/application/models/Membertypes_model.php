<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of membertype_model
 *
 * @author u43255
 */
 
 if (!defined('BASEPATH')) exit('No direct script access allowed');
 
require_once(FUEL_PATH.'models/base_module_model.php');
 
class Membertypes_model extends Base_module_model {
 
    function __construct()
    {
        parent::__construct('member_type');
    }
}
 
class Membertype_model extends Base_module_record {
 
}
 