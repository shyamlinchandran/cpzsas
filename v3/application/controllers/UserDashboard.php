<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emp
 *
 * @author u43255
 */
//require_once(FUEL_PATH.'/libraries/Fuel_MY_Controller.php');
class UserDashboard extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('UserDashboard_model', 'dash');
    }

	public function dashboard_admin() {
		$data['title'] = 'Admin DashBoard';
		 $this->load->view('_blocks/lte_layout/header');
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('userdashboard/admin');
		$this->load->view('_blocks/lte_layout/footer');
	}

}

?>
