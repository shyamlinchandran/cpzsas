<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Co_expiry extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('coexp_model', 'item');
        $this->load->library('encryption');
        $this->encryption->initialize(
                array(
                    'cipher' => 'aes-256',
                    'mode' => 'ctr',
                    'key' => '911c9f7db4ed2df35ca44e78e93d3a8'
        ));        
    }
    public function listall() {
        $data['title'] = 'Licence Details';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('company/list_licence',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'Licence Create';
        $data['view'] = "create";        
        $this->load->view('company/create_licence', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['title'] = 'Enquiry View';
        $data['view'] = "view";
        
        $this->load->view('company/create_licence', $data);
    }
    function getcompanies() {
        return $this->item->getcompanies();
    }
   public function ajax_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;			
            $row[] = $item->company;
            $row[] = $item->mac_address;
            $row[] = $item->end_date;
            $act = '<a  href="' . base_url() . 'sadmin/co_expiry/view/'.$item->col_id . '" title="View" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>';
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
