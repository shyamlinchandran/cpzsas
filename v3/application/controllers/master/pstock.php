<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items
 *
 * @author jijodileep
 */
class pstock extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('itemstock_model', 'items');
    }

    public function list_all() { 
         
        $this->load->view('_blocks/subpages/list');
        
        $this->load->view('master/items/list_stock');
    }
   
   

 
 
    
    public function ajax_list() {
         
       
        $this->items->where();   
        $list = $this->items->get_datatables();        
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
           $no++;
            $row = array();
            $row[] = $no;
           
  ///////////////////////////////////////////Barcode colmn hide//////////////////////////////////////////////////
           
                $row[] = $items->created_date;
                   
            $row[] = $items->name;
            $row[] = $items->total_quantity;
           
           
            $act = '<a   back="' . base_url() . 'master/pstock/list_all" href="' . base_url() . 'items/item/read/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/pstock/list_all"  href="' . base_url() . 'master/items/productscreate/' . $items->id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
        
    }
    

}
