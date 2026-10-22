<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Blood2
 *
 * @author dimind
 */
class Registern extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/register_model', 'registerm');
        $this->load->helper('cookie');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $baptisms = $this->registerm->baptism_cnt();
        $marriage = $this->registerm->marriage_cnt();
        $death = $this->registerm->death_cnt();
        $data['baptisms'] = $baptisms;
        $data['marriage'] = $marriage;
        $data['death'] = $death;
        $this->load->view('church/registern/list_all',$data);
    }

    public function ajax_list() {
        //$this->items->where();

        $list = $this->registerm->get_datatables();
        $data = array();
        // a.name as itemname, a.barcode, b.name as category, c.name as group, d.name as unit, e.name as tax
        $no = $this->input->post('start');
        foreach ($list as $regst) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $regst->bapcnt;
            /*$act = '<a   href="' . base_url() . 'blood/Doner/doner/read/' . $registerm->bid . '"  back="'.site_url("blood\donner\donner").'"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'blood/Doner/doner/edit/' . $registerm->bid . '" back="'.site_url("blood\donner\donner").'"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;*/
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->registerm->count_all(),
            "recordsFiltered" => $this->registerm->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    function getbaptised() {
        $this->registerm->getbaptised();
        
        //$this->getDate($this->input->post('enddate'));
        $cookie_name = "startdate";
        $cookie_namea = "enddate";
        $cookie_value = $this->input->post('startdate');
        $cookie_valuea = $this->input->post('enddate');
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
        setcookie($cookie_namea, $cookie_valuea, time() + (86400 * 30), "/");
        /*$cookie = array(
            "startdate" => $cookie_value,
            "time" => time()+3600
                );

$this->input->set_cookie($cookie);*/
    }

    /*function getDate($date, $sep = '') {
        if ($date == "") {
            return;
        }
        if ($sep == '') {
            $sep = '/';
        }
        $parts = explode($sep, $date);
        return "$parts[2]-$parts[1]-$parts[0]";
    }*/

}
