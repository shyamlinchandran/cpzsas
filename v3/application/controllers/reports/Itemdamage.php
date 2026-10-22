<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class Itemdamage extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Itemdamagereport_model', 'Itemdamage');
    }

    function damagereport() {
        $data['title'] = 'Item Damage Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/itemdamagereport/damagereport', $data);
    }

  
      public function ajax_list() {
        $this->Itemdamage->where();
        $list = $this->Itemdamage->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $quantity = 0;
        foreach ($list as $vouchers) {
            $no++;
            $quantity = $quantity + $vouchers->quantity;;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->name;
            $row[] = $vouchers->quantity; 
            $row[] = $vouchers->details;
            $data[] = $row;
        }$no++;
          $row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] =  '';
            $row[] = $this->number_fm($quantity); 
            $row[] =  '';
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Itemdamage->count_all()+1,
            "recordsFiltered" => $this->Itemdamage->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
