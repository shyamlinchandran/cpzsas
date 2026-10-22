<?php

class Process_type extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        //$this->load->library(array('form_validation','session')); 
        $this->load->helper(array('url','html','form'));
        $this->load->model('Processtype_model', 'Process_type');
    }
    //public function index(){
    
    
        //$this->form_validation->set_rules('name', 'Name', 'required|min_length[2]|max_length[10]');
        
           // $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        
       // if ($this->form_validation->run() == FALSE) {
           // $this->load->view('form_validation_demo');
       // }else{
            //$this->session->set_flashdata('item', 'form submitted successfully');
           // redirect(current_url());
       // }
    
    //}

    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('processtype/list');
    }

    public function create($id=0) {
        $data['type']='create';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('processtype/create',$data);
    }

  public function view($id=0) {
        $data['type']='view';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('processtype/create',$data);
    }
    public function getsing($id){
        $this->Process_type->getsing($id);
    }
    public function delete($id) {
        $this->Process_type->delete($id);
    }

    public function save()
    {
        $insert_id=$this->Process_type->save();

    }

    public function ajax_list() {
        $this->Process_type->where();
        $list = $this->Process_type->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->description;
             $act =  ' <a  back="' . base_url() . 'Process_type/list_all"  href="' . base_url() . 'Process_type/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
             $act .=  ' <a tp="confirm" base="' . base_url() . '/Process_type/list_all' . '"  success="Delete ' . $items->name . ' successfuly "  message="Do you want Delete ' . $items->name . '?"  href="' . base_url() . 'Process_type/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $act .=  ' <a  back="' . base_url() . 'Process_type/list_all"  href="' . base_url() . 'Process_type/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
           
            
           $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Process_type->count_all(),
            "recordsFiltered" => $this->Process_type->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}