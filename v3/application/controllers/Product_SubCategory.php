<?php

class Product_SubCategory extends MY_Controller {

   
    public function __construct() {
        parent::__construct();
        $this->load->model('Product_SubCategory_model','Product_SubCategory');
    }
    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Pro_sub_category/list');
    }
     public function category(){
        return $this->Product_SubCategory->category();
            }


    public function create($id=0) {
         $data['type']='create';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Pro_sub_category/create',$data);
    }
    public function view($id=0) {
        $data['type']='view';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Pro_sub_category/create',$data);
    }

    public function getsing($id){
        $this->Product_SubCategory->getsing($id);
    }
    public function delete($id) {
        $this->Product_SubCategory->delete($id);
    }

    public function save()
    {
        $insert_id=$this->Product_SubCategory->save();

    }
    public function ajax_list() {
        //$this->test->where();
        
        $list = $this->Product_SubCategory->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->cat;
            $row[] = $items->description;
            $act =  ' <a  back="' . base_url() . 'Product_SubCategory/list_all"  href="' . base_url() . 'Product_SubCategory/create/' . $items->id . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .=  ' <a tp="confirm" base="' . base_url() . '/Product_SubCategory/list_all' . '"  success="Delete ' . $items->name . ' successfuly "  message="Do you want Delete ' . $items->name . '?"  href="' . base_url() . 'Product_SubCategory/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $act .=  ' <a  back="' . base_url() . 'Product_SubCategory/list_all"  href="' . base_url() . 'Product_SubCategory/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
           
            
           $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Product_SubCategory->count_all(),
            "recordsFiltered" => $this->Product_SubCategory->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}