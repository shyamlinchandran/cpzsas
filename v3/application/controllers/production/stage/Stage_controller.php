<?php

class Stage_controller extends MY_Controller  {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('production/stage/stage_model', 'stage');
    }


    public function listall(){
        $data['title'] = 'Production Stage';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/stage/listall',$data);

    }

    public function create($id = 0)
    {
        $data['title'] = 'Production Stage';
        $data['id'] = $id;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/stage/create', $data);
    }
    public function edit($id = 0)
    {
        $data['title'] = 'Production Stage';
        $data['id'] = $id;
        $data['view'] = "edit";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/stage/create', $data);
    }
     public function view($id = 0)
    {
        $data['title'] = 'Production Stage';
        $data['id'] = $id;
        $data['view'] = "view";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/stage/create', $data);
    }

    public function ajaxListAll()
    {   
        $list = $this->stage->get_datatables();
        $no = $this->input->post('start');
        $data = array();
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[]  = $no;
            $row[] = $item->stage;
            $row[] = $item->order;
            $row[] = $item->is_previous;
            $act = '<a base="' . base_url() . 'production/stage/stage_controller/listall/' . '" href="' . base_url() . 'production/stage/stage_controller/edit/'  . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
             <a  class="btn btn-info " base="' . base_url() . 'production/stage/stage_controller/listall/'  . '" href="' . base_url() . 'production/stage/stage_controller/view/'  . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
             $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() .  'production/stage/stage_controller/listall/'. $item->id . '"  success="Delete ' . $item->stage . ' successfuly "  message="Do you want Delete ' . $item->stage. '?"  href="' . base_url() . 'production/stage/stage_controller/delete/'  . $item->id . ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stage->count_all(),
            "recordsFiltered" => $this->stage->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
        

    public function save(){

        $this->stage->save();
    }
    public function delete($id) {

        $this->stage->delete($id);
    }

    public function getdata($id){

        $this->stage->getdata($id);
    }

}

?>