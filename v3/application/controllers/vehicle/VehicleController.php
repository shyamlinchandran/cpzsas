<?php

class VehicleController extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('vehicle/Vehicle', 'vehicle_model');
    }

    function listall(){

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/listall');
    }
    function create($id=0){
        $data=[

            'id'=>$id,
            'view'=>'create',
            'title'=>'Vehicle Create'
        ];
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/create',$data);
    }
    function view($id=0){
        $data=[

            'id'=>$id,
            'view'=>'view',
            'title'=>'Vehicle Create'
        ];
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('vehicle/create',$data);
    }

    function save(){

         $this->vehicle_model->save();

    }

    function ajax_list(){

        $list = $this->vehicle_model->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();

            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->veh_name;
            $row[] = $items->veh_no;
            $row[] = $items->veh_brand;
            $row[] = $items->veh_model;
           
                //edit
                $act = ' <a  back="' . base_url() . 'vehicle/VehicleController/list_all"  href="' . base_url() . 'vehicle/VehicleController/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
                //delete
                $act .= ' <a tp="confirm" base="' . base_url() . 'vehicle/VehicleController/list_all' . '"  success="Delete ' . $items->veh_name . ' successfuly "  message="Do you want to Delete ' . $items->veh_name . '?"  href="' . base_url() . 'vehicle/VehicleController/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
                //view
                $act .= ' <a  back="' . base_url() . 'vehicle/VehicleController/list_all"  href="' . base_url() . 'vehicle/VehicleController/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
               
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->vehicle_model->count_all(),
            "recordsFiltered" => $this->vehicle_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    function delete($id){
        $this->vehicle_model->delete($id);
    }

    function get_sing($id){
        $this->vehicle_model->get_sing($id);
    }

}
?>