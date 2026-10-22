<?php

class Enquiry_list extends MY_Controller    
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        // $this->load->model('crm_service/Enquiryallocation_model', 'Enquiry_list');
        $this->load->model('crm_service/Enquirylist_model', 'Enquiry_list');
    }

    public function listall($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_list/listall', $data);
    }
    

    public function get_services()
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_list->get_services($search);
    }

    public function get_services_from_id($id)
    {
        return $this->Enquiry_list->get_services_from_id($id);
    }

    public function get_item_details()
    {
        $this->Enquiry_list->get_item_details();
    }

    public function create($id = 0, $serv_no = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $data['serv_no'] = $serv_no;
        $data['logged'] = $userid;
        $data['settings'] = $this->Enquiry_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_list/create', $data);
    }
    public function view($id = 0, $serv_no = 0)
    {
        $data['type'] = 'view';
        $data['id'] = $id;
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $data['serv_no'] = $serv_no;
        $data['logged'] = $userid;
        $data['settings'] = $this->Enquiry_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_list/create', $data);
    }

    public function getsing($id)
    {
        $this->Enquiry_list->getsing($id);
    }

    public function getsing_item($id)
    {
        $this->Enquiry_list->getsing_item($id);
    }

    public function getsing_ledgers($id)
    {
        $this->Enquiry_list->getsing_ledgers($id);
    }

    public function save()
    {
        return $this->Enquiry_list->save();
    }


    public function ajax_list()
    {
        $act = "";
        //$this->Enquiry_list->where();
        $list = $this->Enquiry_list->where();
        $list = $this->Enquiry_list->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;  // '<input class="enquiry" type="checkbox" name="check[]" value="' . $items->reg_id . '"> &nbsp;' . 
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->serv_no;
            $row[] = $items->cus_name;
            $row[] = $items->item_det;
            $date = date_create($items->Ddate);
            $row[] = date_format($date, "d/m/Y");
            $row[] = $items->totalAmount;
            $row[] = $items->enq_user_name;
            $row[] = $items->allo_user_name;
            // $act = ' <a  back="' . base_url() . 'crm_service/Enquiry_list/list_all"  href="' . base_url() . 'crm_service/Enquiry_list/create/' . $items->reg_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            // $act .= ' <a tp="confirm" base="' . base_url() . 'crm_service/Enquiry_list/list_all' . '"  success="Delete ' . $items->companyName . ' successfuly "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'crm_service/Enquiry_list/delete/' . $items->reg_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // $act .= ' <a  back="' . base_url() . 'crm_service/Enquiry_list/list_all"  href="' . base_url() . 'crm_service/Enquiry_list/view/' . $items->reg_id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';


            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_list->count_all(),
            "recordsFiltered" => $this->Enquiry_list->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
