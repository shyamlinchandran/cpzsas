<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Deathcer_register extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/deathcer_model', 'item');
    }
   public function listall() {
        $data['title'] = 'Death Register';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        //$get_headname = $this->item->familymain($head_id);
        //$data['headname'] = $get_headname;
        $data['head_id'] = 0;

        $this->load->view('church/deathcer/list_all',$data);
    }
    function create() {
        $id=0;
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['title'] = 'Death Certificate create';
        $data['type'] = '';
        $data['view'] = "create";
        
        $this->load->view('church/deathcer/create', $data);
    }
    public function getperson($head_id) {
        return $this->item->getperson($head_id);
    }
    public function getfathers() {
        return $this->item->getfathers();
    }
    public function family_name() {
        $search = strtolower($_GET['term']);
        return $this->item->family_name($search);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['title'] = 'Death Certificate edit';
        $data['type'] = '';
        $data['view'] = "edit";
        
        $this->load->view('church/deathcer/create', $data);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['head_id'] = $head_id;
        $data['title'] = 'Death Certificate View';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/deathcer/create', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
    }
    public function ajax_list() {
        //$head_id = $this->input->post('head_id');
        //$this->item->where($head_id);
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
            $row[] = $item->mbr_name;
            $row[] = $item->hed_housename;
            $row[] = $item->deathdate;
            $row[] = $item->crematedate;
            $act = '<a  href="' . base_url() . 'church/deathcer_register/edit/'.$item->crr_id .'" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/deathcer_register/printcertificate/' . $item->crr_id . '" title="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/deathcer_register/view/' . $item->crr_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/deathcer_register/listall'.$item->crr_id .'"  success="Delete ' . $item->mbr_name . ' successfuly "  message="Do you want Delete ' . $item->crr_id  . '?"  href="' . base_url() . 'church/deathcer_register/delete/' . $item->crr_id  . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
    public function printcertificate($crr_id) {
        $com = $this->item->getCompany();
        $data['company'] = $com;
        $deathcer = $this->item->getdeathcer($crr_id);
        $data['deathcer'] = $deathcer;
        $this->load->view('church/deathcer/bill', $data);
        //$this->generateBill($bap_id);
    }
}
