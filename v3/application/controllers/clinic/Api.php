<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Api extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Api_model', 'api');
    }

    public function getallrequstbyMonth() {
        $this->api->getallbooking();
    }

}
