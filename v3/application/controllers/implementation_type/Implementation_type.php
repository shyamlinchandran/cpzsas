<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Implementation_type extends MY_Controller{
   
    public function __construct(){
     parent::__construct();
     $this->load->model('implementation_type/Implementation_type_model','service');
    }
    public function list(){
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles']='Implementation Type';
        $this->load->view("implementation_type/list",$data);
    }
    public function create($id = 0, $type = 'create'){

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = $id;
        $data['view'] = $type;
        $this->load->view("implementation_type/create",$data);
    }
    public function ajax_list()
    {
        $list = $this->service->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $act = '<a  href="' . base_url() . 'implementation_type/Implementation_type/create/' . $item->id . '/Edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   
                    <a  class="btn btn-info "  href="' . base_url() . 'implementation_type/Implementation_type/create/' . $item->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            
                $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'implementation_type/Implementation_type/list/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'implementation_type/Implementation_type/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->service->count_all(),
            "recordsFiltered" => $this->service->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->service->save();
    }
    public function getsing($id)
    {
        $this->service->getsing($id);
    }
    public function delete($id)
    {
        $this->service->delete($id);
    }
}