<?php

class Source_of_enquiry extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('source_of_enquiry/Source_of_enquiry_model', 'Source');
    }

    public function list_all($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('source_of_enquiry/listall', $data);
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('source_of_enquiry/create', $data);
    }

    function delete($id) {
        $qry = "delete from  source_enquiry where id =" . $id;
        $this->db->query($qry);
    }
    public function save() {
        $insert_id = $this->Source->save();
    }
     public function getsing($id) {
        $this->Source->getsing($id);
    }

       public function ajax_list() {
        //  $this->Designation->where();
        $list = $this->Source->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->source_of_enquiry;
            $row[] = $items->details;
             $act = ' <a  back="' . base_url() . 'source_of_enquiry/Source_of_enquiry/lis_tall"  href="' . base_url() . 'source_of_enquiry/Source_of_enquiry/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act.' <a tp="confirm" base="' . base_url() . '/source_of_enquiry/Source_of_enquiry/list_all' . '"  success="Delete ' . $items->id . ' successfuly "  message="Do you want Delete ' . $items->id . '?"  href="' . base_url() . 'source_of_enquiry/Source_of_enquiry/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            //  $act .= ' <a  back="' . base_url() . 'hr/employee/list_all"  href="' . base_url() . 'hr/employee/view/' . $items->empid . '" data-toggle="tooltip" title="view" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Source->count_all(),
            "recordsFiltered" => $this->Source->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}

