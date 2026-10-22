<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of M_pdf
 *
 * @author jijodileep
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

require_once APPPATH . '/third_party/vendor/autoload.php';

class M_pdf {

    public $param;
    public $pdf;

    public function __construct($param = ['mode' => 'utf-8', 'format' => 'A4']) {
        $this->param = $param;
       // $this->pdf = new Mpdf\Mpdf($this->param);
//        $this->pdf = new Mpdf\Mpdf(['mode' => 'utf-8', 'format' => [65, 5000],'autoPageBreak' => TRUE]);
    }

    public function load() {
        $this->pdf = new Mpdf\Mpdf($this->param);
    }

}
