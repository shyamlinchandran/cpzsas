<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Categor_price extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Categor_price_model', 'item');
        $this->load->library('session');
    }
    public function listall()
    {
        $data['title'] = 'Daily Gold Rate';
        $data['settings'] = $this->item->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('categorprice/list', $data);
    }

    public function save(){
        $this->item->save();
    }

    public function getsing($id){
        $this->item->getsing($id);
    }

    
    public function ajax_list()
    {
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = ucfirst($items->name);
            $row[] = $items->gold_rate;
            $row[] = $items->old_gold_rate;
            $act = ' <button title="Edit" attr="' . $items->id . '"class="btn btn-primary addrate"  ><span class="glyphicon glyphicon-edit"></span></button>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}