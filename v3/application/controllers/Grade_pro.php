<?php


class Grade_pro extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Gradepro_model', 'Grade_pro');
    }
    public function list_all() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('grade/gradelist');
    }

    public function create($id=0) {
        $data['type']='create';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('grade/gradecreate',$data);
    }
    
  public function view($id=0) {
        $data['type']='view';
        $data['id']=$id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('grade/gradecreate',$data);
    }

    public function getsing($id){
        $this->Grade_pro->getsing($id);
    }
    public function delete($id) {
        $this->Grade_pro->delete($id);
            }

    public function save()
    {
        $insert_id=$this->Grade_pro->save();

    }

    public function ajax_list() {
        //$this->test->where();
        $list = $this->Grade_pro->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->discription;
            $act =  ' <a  back="' . base_url() . 'Grade_pro/list_all"  href="' . base_url() . 'Grade_pro/create/' . $items->id . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .=  ' <a tp="confirm" base="' . base_url() . '/Grade_pro/list_all' . '"  success="Delete ' . $items->name . ' successfuly "  message="Do you want Delete ' . $items->name . '?"  href="' . base_url() . 'Grade_pro/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
             $act .=  ' <a  back="' . base_url() . 'Grade_pro/list_all"  href="' . base_url() . 'Grade_pro/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
           
            
           $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Grade_pro->count_all(),
            "recordsFiltered" => $this->Grade_pro->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}