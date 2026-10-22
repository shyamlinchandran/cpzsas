<?php

class Status_controller extends MY_Controller  {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('production/status/status_model', 'status');
    }


    public function listall(){
        $data['title'] = 'Production Status';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/status/listall',$data);

    }

    public function create($id = 0)
    {
        $data['title'] = 'Production Status';
        $data['id'] = $id;
        $data['view'] = "create";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/status/create', $data);
    }
    public function edit($id = 0)
    {
        $data['title'] = 'Production Status';
        $data['id'] = $id;
        $data['view'] = "edit";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/status/create', $data);
    }
     public function view($id = 0)
    {
        $data['title'] = 'Production Status';
        $data['id'] = $id;
        $data['view'] = "view";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('production/status/create', $data);
    }

    public function ajaxListAll()
    {   
        $list = $this->status->get_datatables();
        $no = $this->input->post('start');
        $data = array();
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[]  = $no;
            $row[] = $item->status;
            $row[] = $item->percentage;
            $act = '<a base="' . base_url() . 'production/status/status_controller/listall/' . '" href="' . base_url() . 'production/status/status_controller/edit/'  . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
             <a  class="btn btn-info " base="' . base_url() . 'production/status/status_controller/listall/'  . '" href="' . base_url() . 'production/status/status_controller/view/'  . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
             $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'production/status/status_controller/listall/' . $item->id . '"  success="Delete ' . $item->status . ' successfuly "  message="Do you want Delete ' . $item->status. '?"  href="' . base_url() . 'production/status/status_controller/delete/'  . $item->id . ' " data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->status->count_all(),
            "recordsFiltered" => $this->status->count_filtered(),
            "data" => $data
        );

        echo json_encode($output);
    }
        

    public function save(){

        $this->status->save();
    }
    public function delete($id) {

        $this->status->delete($id);
    }

    public function getdata($id){
        $this->status->getdata($id);
    }

}

?>