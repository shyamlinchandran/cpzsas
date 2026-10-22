<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once  'tcpdf.php';

class Pdf extends tcpdf{

    function __construct() {
        parent::__construct();
    }

}
