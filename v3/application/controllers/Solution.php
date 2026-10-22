<?php

class Solution extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('solution_model','solution');
    }
    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('solution/list');
    }

    public function category(){
        return $this->solution->category();

    }

    public function tax(){
        return $this->solution->tax();
    }
    
    public function subcategory(){
        return $this->solution->subcategory();
    }
    public function delete($id) {
        $this->solution->delete($id);
    }

    public function create($id=0) {
        $data['type']='create';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('solution/create',$data);
    }
    public function view($id=0) {
        $data['type']='view';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('solution/create',$data);
    }
    

    public function getsing($id){
        $this->solution->getsing($id);
    }

    
    public function ajax_list() {
       // $this->solution->where();
        $list = $this->solution->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $solution) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $solution->name;
            $row[] = $solution->description;
            $row[] = $solution->main;
            $row[] = $solution->sub;
           // $pic = "<img width='200px' height = '180px' src = '" . base_url(). 'uploads/test/' . $solution->logo . "'>";
           // $row[] = $pic;
            $act =  ' <a  back="' . base_url() . 'Solution/list_all"  href="' . base_url() . 'solution/create/' . $solution->id . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .=  ' <a tp="confirm" base="' . base_url() . '/Solution/list_all' . '"  success="Delete ' . $solution->name . ' successfuly "  message="Do you want Delete ' . $solution->name . '?"  href="' . base_url() . 'Solution/delete/' . $solution->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $act .=  ' <a  back="' . base_url() . 'Solution/list_all"  href="' . base_url() . 'Solution/view/' . $solution->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
           
            
           $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->solution->count_all(),
            "recordsFiltered" => $this->solution->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    function save() {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/solution/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '1024'; //1 MB
            $new_name = time() . $_FILES["file"]['name'];
            $config['file_name'] = $new_name; 
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            }
            $this->solution->save($new_name);
        } else {
            $this->solution->save('');
        }
    }
    

}