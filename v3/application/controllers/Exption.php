<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exption
 *
 * @author jijodileep
 */
class Exption extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('exption_model', 'exption');
    }

    //put your code here
    function saveerror() {
        $err_url = $this->input->post('err_url');
        $err_text = $this->input->post('err_text');
        $errr_num = $this->input->post('errr_num');
        $this->load->model('exption_model', 'exption');
        $this->exption->saveerror($err_url, $err_text, $errr_num);
        $data['err_url'] = $err_url;
        $data['err_text'] = $err_text;
        $data['errr_num'] = $errr_num;
        $this->load->view('_blocks/lte_layout/error', $data);
    }

}
