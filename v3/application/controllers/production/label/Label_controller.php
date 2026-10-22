<?php

class label_controller extends MY_Controller  {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('production/label/label_model', 'label');
    }


    public function listall(){
        $data['title'] = 'Additional Fields';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/label/listall',$data);

    }

    public function create($id = 0)
    {
        $data['title'] ='Additional Fields';
        $data['id'] = $id;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/label/create', $data);
    }
    public function edit($id = 0)
    {
        $data['title'] = 'Additional Fields';
        $data['id'] = $id;
        $data['view'] = "edit";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/label/create', $data);
    }
     public function view($id = 0)
    {
        $data['title'] ='Additional Fields';
        $data['id'] = $id;
        $data['view'] = "view";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/label/create', $data);
    }

    public function ajaxListAll()
    {   
        $list = $this->label->get_datatables();
        $no = $this->input->post('start');
        $data = array();
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[]  = $no;
            $row[] = $item->label;
            $row[] = $item->order;
            $row[] = $item->type;
            $row[] = $item->values;
            $act = '<a base="' . base_url() . 'production/label/label_controller/listall/' . '" href="' . base_url() . 'production/label/label_controller/edit/'  . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
             <a  class="btn btn-info " base="' . base_url() . 'production/label/label_controller/listall/'  . '" href="' . base_url() . 'production/label/label_controller/view/'  . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
             $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'production/label/label_controller/listall/' . $item->id . '"  success="Delete ' . $item->label . ' successfuly "  message="Do you want Delete ' . $item->label. '?"  href="' . base_url() . 'production/label/label_controller/delete/'  . $item->id . ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->label->count_all(),
            "recordsFiltered" => $this->label->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
        

    public function save(){

        $this->label->save();
    }
    public function delete($id) {

        $this->label->delete($id);
    }

    public function getdata($id){
        $this->label->getdata($id);
    }

}

?>