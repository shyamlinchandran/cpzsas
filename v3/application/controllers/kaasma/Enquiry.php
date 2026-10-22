<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Enquiry extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kaasma/enquiry_model', 'item');
    }
    public function listall() {
        $data['title'] = 'Enquiry';
        $enq_status = $this->item->enq_status();
        $data['enq_status'] = $enq_status;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('kaasma/enquiry/list_all',$data);
    }
    function create($id=0) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $enq_status = $this->item->enq_status();
        $enq_no = $this->item->generatevouchernumber();
        $data['enq_no'] = $enq_no;
        $data['enq_status'] = $enq_status;
        $data['id'] = $id;
        $data['title'] = 'Enquiry Create';
        $data['view'] = "create";
        
        $this->load->view('kaasma/enquiry/create', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $enq_status = $this->item->enq_status();
        $data['enq_no'] = "";
        $data['enq_status'] = $enq_status;
        $data['id'] = $id;
        $data['title'] = 'Enquiry Edit';
        $data['view'] = "edit";
        
        $this->load->view('kaasma/enquiry/create', $data);
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
    function timeline($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $details = $this->item->enq_timeline($id);
        $data['details'] = $details;
        $data['enq_no'] = "";
        $data['id'] = $id;
        $data['title'] = 'Enquiry Timeline';
        $data['view'] = "view";
        
        $this->load->view('kaasma/enquiry/timeline', $data);
    }
    function create_company($enq_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = 0;
        $data['enq_id'] = $enq_id;
        $data['title'] = 'Enquiry to Company';
        $data['view'] = "edit";
        
        $this->load->view('kaasma/company/create_enquiry', $data);
    }
    public function delete($id)
    {
      $this->item->delete($id);
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
            $act = '<a  href="' . base_url() . 'kaasma/enquiry/edit/'.$item->enq_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  href="' . base_url() . 'kaasma/enquiry/timeline/'.$item->enq_id . '" title="View" data-toggle="tooltip" class="btn btn-info"><span class="fa fa-clock-o"></span></a>
           <a  href="' . base_url() . 'kaasma/enquiry/view/'.$item->enq_id . '" title="View" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>';
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
        if(isset($_FILES['file']))
        {
        $ms = $_FILES['file'];
        //upload file
        $config['upload_path'] = 'uploads/kaasma/enquiry/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '1024'; //1 MB



        if (file_exists('uploads/kaasma/enquiry' . $_FILES['file']['name'])) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'message' => 'File already exists : uploads/kaasma/' . $_FILES['file']['name']
            );
            echo json_encode($response);
            return;
        } else {
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('file')) {
                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => $this->upload->display_errors()
                );
                echo json_encode($response);
                return;
            }
        }
        $this->item->save($_FILES['file']['name']);
    }
    else
    {
        $this->item->save('');
    }
    }
}
