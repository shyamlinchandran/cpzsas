<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyMenuTypes
 *
 * @author admin
 */
class SubscriptionMenuTypes extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Submenu_model', 'type');
        $this->load->model('MenuToCompany_model', 'MenuToCompany');
        $this->load->helper('url');
    }
    function subscription(){
     return $this->MenuToCompany->subscription();

    }
    public function listall() {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
//       // $data['type'] = $type;
        $this->load->view('settings/companysubscription/listall');
    }
    function save(){
    
     $this->MenuToCompany->Savesubscription();
    }
    function edit($id) {
        $data['list'] = $this->MenuToCompany->submenu($id);
        $re = $this->MenuToCompany->subscription($id);
        $data['drs'] = $re;
        $data['id'] = $id;
        $this->load->view('settings/companysubscription/createmenu', $data);
    }

 function add() {
        $id=0;
        $data['list'] = $this->MenuToCompany->menus();
        $re = $this->MenuToCompany->subscription($id);
        $data['drs'] = $re;
        $data['id'] = 0;
        $this->load->view('settings/companysubscription/createmenu', $data);
    }
    function delete($id) {
        $this->type->delete($id);
        
    }

   public function ajax_list() {
        $this->type->where();
        $list = $this->type->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $type) {
            $no++;
            $row = array();
            $row[] = $no;

            $row[] = $type->subcription_name;

            $row[] = '<a  href="' . base_url() . 'settings/SubscriptionMenuTypes/edit/' . $type->id .'" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'settings/SubscriptionMenuTypes/delete/' . $type->id . '" title="delete"  data-toggle="tooltip"><span class="glyphicon glyphicon-remove-sign"></span></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->type->count_all(),
            "recordsFiltered" => $this->type->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
