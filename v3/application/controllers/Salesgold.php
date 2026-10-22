<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */

defined('BASEPATH') or exit('No direct script access allowed');

use AliAbdalla\Tafqeet\Core\Tafqeet;

class Salesgold extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('goldsales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function listall() {
        $data['title'] = 'Sales';
        $data['settings'] = $this->sales->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'Sales';
        $this->load->view('transaction/goldsales/list_all', $data);
    }

    public function ajax_list() {
        $this->sales->where();
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->in_date;
            $row[] = $item->invoice;
            $row[] = $item->cusname;
            $row[] = $item->total;
            $act = '<a  href="' . base_url() . 'transaction/goldsales/create/' . $item->sales_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'transaction/goldsales/create/' . $item->sales_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
           // $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'transaction/customers/listall' . '"  success="Delete ' . $item->invoice . ' successfuly "  message="Do you want Delete ' . $item->invoice . '?"  href="' . base_url() . 'transaction/goldsales/delete/' . $item->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            //$act = $act . '<iframe style="display:none" tp="pdf" target="_blank" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data='.$item->id.'">';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all(),
            "recordsFiltered" => $this->sales->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getsing($id){
        $this->sales->getsing($id);
    }

    public function create($id = 0,$view = 'create'){
        $is_edit = $this->sales->GetUserPermission('Sales');
        $data['is_edit'] = $is_edit;
        if($id < 1 ){
            $data['is_edit'] = 1 ;
        }
        $data['id'] = $id;
        $data['view'] = $view;
        $zeroindex = $this->sales->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $settings = $this->sales->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/goldsales/create', $data);
    }

    public function search_item(){
        $search = $this->input->post('term');
        $date = $this->input->post('date');
        if($this->input->post('date')){
            $date = $this->sales->getDate($this->input->post('date'));
        }
        return $this->sales->search_item($search,$date);
    }

    public function save(){
        $this->sales->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        
        echo json_encode($response);
    }
	
   

}
