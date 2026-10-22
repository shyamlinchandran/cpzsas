<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Enqservice extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kaasma/enquiry_model', 'item');
    }
    public function listall() {
        $data['title'] = 'Enquiry to Service';
        $enq_status = $this->item->enq_status();
        $data['enq_status'] = $enq_status;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('kaasma/enquiry/list_approval',$data);
    }
   function getsing($id) {
        $this->item->getsing($id);
    }
    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $enq_status = $this->item->enq_status();
        $data['enq_status'] = $enq_status;
        $data['enq_no'] = "";
        $data['id'] = $id;
        $data['title'] = 'Enquiry View';
        $data['view'] = "view";
        
        $this->load->view('kaasma/enquiry/create', $data);
    }
    public function enqtoservice($id)
    {
      $this->item->enqtoservice($id);
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
            $row[] = $item->enq_no;
            $row[] = $item->enq_contact_person;
            $row[] = $item->enq_phone;
            $row[] = $item->enq_email;
            $row[] = $item->enq_company;
            $act = '<a  href="' . base_url() . 'kaasma/enquiry/view/'.$item->enq_id . '" title="View" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>
            <a back="' . base_url() . 'kaasma/enqservice/listall/'.'"  href="' . base_url() . 'kaasma/enqservice/enqtoservice/'.$item->enq_id . '" title="Add to service" data-toggle="tooltip" class="btn btn-info"><span class="fa fa-check"></span></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/kaasma/enqservice/listall/'.'"  success="Delete ' . $item->enq_contact_person . ' successfuly "  message="Do you want Delete ' . $item->enq_contact_person . '?"  href="' . base_url() . 'kaasma/enquiry/delete/' . $item->enq_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
