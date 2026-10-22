<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of companytype
 *
 * @author admin
 */
class companytype extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Companytype_model', 'Companytype');
        $this->load->model('menusettings_model', 'menus');
    }
 
    function menuuser() {
        $data['list'] = $this->menus->menus();
         $re = $this->menus->Company();
        $data['drs'] = $re;
        $this->load->view('settings/create', $data);
    }
    function SaveCtype()
    {
     $this->Companytype->Save();
      
    
       }
       function UpdateCtype()
    {
     $this->Companytype->Save();
       echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
    
       }
     
   
    function CheckCtype(){
        return $this->Companytype->CheckCtype();
        
        
       
    }
   
}