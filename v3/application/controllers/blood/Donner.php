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
class Donner extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Blood_model', 'blood');
    }

    public function donner() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('blood/donner');
    }

    public function ajax_list() {
        //$this->items->where();

        $list = $this->blood->get_datatables();
        $data = array();
        // a.name as itemname, a.barcode, b.name as category, c.name as group, d.name as unit, e.name as tax
        $no = $this->input->post('start');
        foreach ($list as $blood) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $blood->Name;
            $row[] = $blood->Age;
            $row[] = $blood->Mob;
            $row[] = $blood->Address;
            $row[] = $blood->Bldgrp;
            //$row[] = $blood->tax;
            $act = '<a   href="' . base_url() . 'blood/Doner/doner/read/' . $blood->bid . '"  back="'.site_url("blood\donner\donner").'"  data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'blood/Doner/doner/edit/' . $blood->bid . '" back="'.site_url("blood\donner\donner").'"  data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->blood->count_all(),
            "recordsFiltered" => $this->blood->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
