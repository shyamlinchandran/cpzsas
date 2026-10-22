<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of login
 *
 * @author jijodileep
 */
class Login extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $version = $this->config->item('version');
        $url = str_replace($version . '/', '', base_url()); 
        redirect($url);
    }

    public function logout() {
        $login_url = $this->session->userdata('login_url');
        unset($_SESSION['username']);
        unset($_SESSION['pswd']);
        unset($_SESSION['logged_in']);
        echo '<META HTTP-EQUIV=Refresh CONTENT="0; URL=' . base_url() . 'login">';
    }

    public function loginset() {

        $type = "emps";
        $this->load->model('Getdata_model', 'getdata');
        $error = "Invalid Login";
        $data = array("type" => $type, 'error' => $error);
        $uname = $_POST['uname'];
        $comid = $_POST['comid'];
        $db = $this->getdata->getdb($comid);
        if ($db) {

            $pswd = $_POST['pswd'];
            $newdata = array(
                'username' => $uname,
                'logged_in' => TRUE
            );
            $newdata['hostname'] = $db['sdb_server'];
            $newdata['username'] = $db['sdb_username'];
            $newdata['password'] = $db['sdb_password'];
            $newdata['database'] = $db['sdb_name'];
            $newdata['isexcute'] = $db['sdb_isexcute'];
            $newdata['dbcompany'] = $db;
            $this->load->vars($newdata);
            $this->load->model('User_model', 'user');
            $user = $this->user->login($uname, $pswd);
            $fin_database = $this->user->getdb();
            if ($user['password'] == $pswd && $user['username'] == $uname) {
                $newdata['user'] = $user;
                if(strtolower($comid)  == 'kmtrading'){
                    $url = base_url() . "inventory_master/Item/listall?newpage=new";
				}
				else if ($user['utype'] == 'Super Admin') {
                    $url = base_url() . "dashboard/superadmin";
                } else if ($user['utype'] == 'Admin') {
                    $url = base_url() . "dashboard/admin";
                } else if ($user['utype'] == 'clinic') {
                    $url = base_url() . "dashboard/clinic";
                } else {
                    $url = base_url() . "dashboard/users";
                }
                $newdata['fin_database'] = $fin_database;
                $newdata['dash'] = $url;
                $newdata['login_comid'] = $comid;
                $this->session->set_userdata($newdata);
                $data = array(
                    'user_id' => $user['Id'],
                    'session_id' => session_id(),
                    'set_ip' => $_SERVER['REMOTE_ADDR'],
                    'set_status' => TRUE
                );
                $this->getdata->insertlogin($data);
                redirect($url);
            }
            $error = "Invalid User Name & password  ";
            $data = array("type" => $type, 'error' => $error);
            $this->load->view('_jlogin/login', $data);
        } else {
            $error = "Invalid Company Details";
            $data = array("type" => $type, 'error' => $error);
            $this->load->view('_jlogin/login', $data);
        }
    }

}
