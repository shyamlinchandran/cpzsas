<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Customerprice extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('customerprice_model', 'item');
        
    }

    public function listall() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('customerprice/list_all');
    }

     function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $price = $this->item->price();
        $data['price'] = $price;
        /*$isbatch = $this->getKey('isbatch');
        $data['isgodown'] = $this->getKey('is_godown');
        $settings = $this->item->getCompanySettings();
        $godown = 1;
        $gwn = $this->item->godown($godown);
        $re = $this->item->tax();
        $res = $this->item->Category();
        $settings = $this->item->getCompanySettings();
        $result = $this->item->Group();
        $unit = $this->item->unit();
        $hsn = $this->item->Hsncode();
        $data['godown'] = $gwn;
        $data['unit'] = $unit;
        $data['tax'] = $re;
        $data['grp'] = $result;
        $data['settings'] = $settings;
        $data['cat'] = $res;
        $data['hsn'] = $hsn;
        $data['id'] = $id;
        $data['type'] = $type;*/
        $data['view'] = "create";
        
        $this->load->view('customerprice/create',$data);
    }


     function edit($id) {
        $this->load->view('_blocks/subpages/create');
        //$isbatch = $this->getKey('isbatch');
        $price = $this->item->price();
        $data['price'] = $price;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $this->load->view('customerprice/create', $data);
    }


    function view($id) {
        $this->load->view('_blocks/subpages/create');
        //$isbatch = $this->getKey('isbatch');
        // $data['type'] = $type;
        $data['id'] = $id;
        $data['view'] = 'view';
        $this->load->view('customerprice/create', $data);
    }


  function getsing($id) {
        $this->item->getsing($id);
    }

     public function getcustomer() {
        $search = strtolower($_GET['term']);
        return $this->item->getcustomer($search);
    }

    function godownitem($id) {
         $this->item->getgodownitem($id);
       // echo json_encode($result);
    }

    public function ajax_list() {
        //$this->item->where();
        $list = $this->item->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->pname;
            $row[] = $item->customer;
            $row[] = $item->iname;
            $row[] = $item->salerate;
           
            $act = '<a  href="' . base_url() . 'settings/customerprice/edit/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/customerprice/view/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->item->save();
    }


 
}
