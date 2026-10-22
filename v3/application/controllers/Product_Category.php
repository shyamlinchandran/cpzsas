<?php


class Product_Category extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Product_Category_model', 'Product_Category');
    }
    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Product_Category/Product_list');
    }

    public function create($id=0) {
        $data['type']='create';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Product_Category/Product_create',$data);
    }  
 public function view($id=0) {
        $data['type']='view';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Product_Category/Product_create',$data);
    }
         

    public function getsing($id){
        $this->Product_Category->getsing($id);
    }
    public function delete($id) {
        $this->Product_Category->delete($id);
    }

    public function save()
    {
        $insert_id=$this->Product_Category->save();

    }

    public function ajax_list() {
        $this->Product_Category->where();
        $list = $this->Product_Category->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->discription;
            $act =  ' <a  back="' . base_url() . 'Product_Category/list_all"  href="' . base_url() . 'Product_Category/create/' . $items->id . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
             $act .=  ' <a tp="confirm" base="' . base_url() . '/Product_Category/list_all' . '"  success="Delete ' . $items->name . ' successfuly "  message="Do you want Delete ' . $items->name . '?"  href="' . base_url() . 'Product_Category/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $act .=  ' <a  back="' . base_url() . 'Product_Category/list_all"  href="' . base_url() . 'Product_Category/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
           
            
           $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Product_Category->count_all(),
            "recordsFiltered" => $this->Product_Category->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}