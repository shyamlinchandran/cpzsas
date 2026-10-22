<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Service_implementation extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('service_implementation/Service_implementation_model', 'service');
    }
    function itemuploads($file, $type, $fileid) {
        $config['upload_path'] = 'uploads/images';
        $config['allowed_types'] = '*';
        $config['max_filename'] = '255';
        $config['max_size'] = '6024'; //1 MB
        $this->load->library('upload', $config);
		$this->upload->do_upload($fileid);
		$upload_data = $this->upload->data(); 
		return $upload_data['file_name'];
    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Implementation Note';
        $this->load->view("service_implementation/list", $data);
    }
	
	public function implementation_type(){
		return $this->service->implementation_type();
	}
    public function create($id = 0, $type = 'create')
    {

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = $id;
        $data['view'] = $type;
        $this->load->view("service_implementation/create", $data);
    }
    public function ajax_list()
    {
        $list = $this->service->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->installation_date;
            $row[] = $item->installation_team;
            $row[] = $item->warranty_till_date;
            $act = '<a  href="' . base_url() . 'service_implementation/Service_implementation/create/' . $item->imp_id . '/edit" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>                  
                    <a  class="btn btn-info "  href="' . base_url() . 'service_implementation/Service_implementation/create/' . $item->imp_id . '/view" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'service_implementation/Service_implementation/list/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'service_implementation/Service_implementation/delete/' . $item->imp_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->service->count_all(),
            "recordsFiltered" => $this->service->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save()
    {
        $this->service->save();
    }
    public function new_upload()
    {
        if (isset($_FILES['document'])) {
            $file = $_FILES['document'];
            $type = 'image';
            //upload file  
            $fileid = 'document';
            $new_name = time() . str_replace(' ', '_', $_FILES['document']['name']);
            $new_name = ($_FILES['document']['name']);
            $_FILES['document']['name'] = $new_name;
            $imgname[0] = $new_name;
            $new_name = $this->itemuploads($file, $type, $fileid);
            $fileid = 'document';
			$data = array(
				'new_name'=>$new_name
			);
            print_r($new_name);
        } else {
            $data = array(
				'new_name'=>''
			);
            print_r('');
        }
    }
    public function getsing($id)
    {
        $this->service->getsing($id);
    }
    public function other_item($id)
    {
        $this->service->other_item($id);
    }
    public function image_docs($id)
    {
        $this->service->image_docs($id);
    }
    public function delete($id)
    {
        $this->service->delete($id);
    }
    public function get_name()
    {
        $search = strtolower($_GET['term']);
        return $this->service->get_name($search);
    }
    public function product_name()
    {
        $test = strtolower($_GET['term']);
        return $this->service->product_name($test);
    }
    public function delete_db($unique_id)
    {
        $this->service->delete_db($unique_id);
    }
}
