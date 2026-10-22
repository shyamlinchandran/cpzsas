<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of booking
 *
 * @author u43255
 */
class Booking  extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();         
        $this->load->helper('url');
        $this->load->model('booking_model', 'booking'); 
    } 
    
    public  function listall(){
        
        
    }
   function create(){
        $this->load->view('_blocks/subpages/create'); 
        $this->load->view('transaction/booking/create');
    }
     public  function  save(){
        $this->booking->save();
        
    }
}
