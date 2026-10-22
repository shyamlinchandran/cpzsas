<?php
class District extends MY_Controller{
    public function __construct()
    {
    parent::__construct();
    $this->load->model('education/district/District_model','district');

    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles']='District';
        $this->load->view("education/district/list",$data);
    }
    public function create($id=0,$type='create'){
        
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = $id;
        $data['view'] = $type;
        $this->load->view('education/District/create',$data);

    }
    public function save()
    {
        $this->district->save();
    }
    public function getsing($id)
    {
        $this->district->getsing($id);
    }
    public function delete($id)
    {
        $this->district->delete($id);
    }
    public function getElement()
    {
        $this->district->getElement();
    }
    public function ajax_list()
    {
        $list  = $this->district->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach($list as $items){
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->district_name;
            $row[] = $items->district_code;
            
            $act = '<a  href="' . base_url() . 'education/district/District/create/' . $items->id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                    <a  class="btn btn-info "  href="' . base_url() . 'education/district/District/create/' . $items->id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'education/district/District/list' . '"  success="Delete ' . $items->id . ' successfuly "  message="Do you want Delete ' . $items->id . '?"  href="' . base_url() . 'education/district/District/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->district->count_all(),
            "recordsFiltered" => $this->district->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);

    }
}