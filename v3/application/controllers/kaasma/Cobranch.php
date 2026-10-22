<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Cobranch extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('kaasma/cobranch_model', 'item');
    }
    public function listall($com_id) {
        $data['com_id'] = $com_id;
        $data['title'] = 'company branches';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('kaasma/company/list_branches',$data);
    }
    function create($id=0,$com_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['com_id'] = $com_id;
        $data['title'] = 'company Create';
        $data['view'] = "create";
        
        $this->load->view('kaasma/company/create_branch', $data);
    }
    function getsing($id) {
        $this->item->getsing($id);
    }
    function edit($id,$com_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['com_id'] = $com_id;
        $data['title'] = 'company Edit';
        $data['view'] = "edit";
        
        $this->load->view('kaasma/company/create_branch', $data);
    }

    function view($id,$com_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $data['id'] = $id;
        $data['com_id'] = $com_id;
        $data['title'] = 'company View';
        $data['view'] = "view";
        
        $this->load->view('kaasma/company/create_branch', $data);
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
            $row[] = $item->cmp_name;
            $row[] = $item->cmp_phone;
            $row[] = $item->cmp_email;
            $row[] = $item->cmp_owner;
            $act = '<a  href="' . base_url() . 'kaasma/cobranch/edit/'.$item->cmp_id . '/'.$item->fk_company. '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  href="' . base_url() . 'kaasma/cobranch/view/'.$item->cmp_id .'/'.$item->fk_company. '" title="View" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-eye-open"></span></a>';
                  $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/kaasma/cobranch/listall/'.$item->cmp_id.'"  success="Delete ' . $item->cmp_name . ' successfuly "  message="Do you want Delete ' . $item->cmp_name . '?"  href="' . base_url() . 'kaasma/company/delete/' . $item->cmp_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
        $config['upload_path'] = 'uploads/kaasma/';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '1024'; //1 MB



        if (file_exists('uploads/kaasma/' . $_FILES['file']['name'])) {
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
