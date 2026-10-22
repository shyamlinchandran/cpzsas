<?php
class Qualifications extends MY_Controller{
    public function __construct()
    {
    parent::__construct();
    $this->load->model('education/Qualifications/Qualifications_model','Qualifications');

    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles']='Qualification';
        $this->load->view("education/qualifications/list",$data);
    }
    public function create($id=0,$type='create'){
        
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = $id;
        $data['view'] = $type;
        $this->load->view('education/qualifications/create',$data);

    }
    public function save()
    {
        $this->Qualifications->save();
    }
    public function getsing($id)
    {
        $this->Qualifications->getsing($id);
    }
    public function delete($id)
    {
        $this->Qualifications->delete($id);
    }
    public function getElement()
    {
        $this->Qualifications->getElement();
    }
    public function ajax_list()
    {
        $list  = $this->Qualifications->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach($list as $items){
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->qualification;
            $row[] = $items->details;
            
            $act = '<a  href="' . base_url() . 'education/qualifications/Qualifications/create/' . $items->id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/qualifications/Qualifications/create/' . $items->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/qualifications/Qualifications/list' . '"  success="Delete ' . $items->id . ' successfuly "  message="Do you want Delete ' . $items->id . '?"  href="' . base_url() . 'education/qualifications/Qualifications/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Qualifications->count_all(),
            "recordsFiltered" => $this->Qualifications->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
}