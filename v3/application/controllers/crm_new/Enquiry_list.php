<?php

class Enquiry_list extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        // $this->load->model('crm_new/Enquiryallocation_model', 'Enquiry_allocation');
        $this->load->model('crm_new/Enquirylist_model', 'Enquiry_list');
    }

    public function listall($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_list/listall', $data);
    }


    public function ajax_list() {
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_list->where();
        $list = $this->Enquiry_list->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->companyName; 
            $row[] = $items->contactPerson;
            $row[] = '<a tp="new" href="https://wa.me/' . $items->contactNumber . '">' . $items->contactNumber . '</a>';
            $row[] = $items->Edate;
            // $row[] = $items->Ddate;
            if($items->next_follow_up_date == '0000-00-00'){
                $row[] = 'No FollowUps';
            }
            else{
                $row[] = $items->next_follow_up_date;
            }
            
            // $act = ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  href="' . base_url() . 'crm_new/Enquiry_register/edit/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            // $act .= ' <a tp="confirm" base="' . base_url() . 'crm_new/Enquiry_register/list_all' . '"  success="Delete ' . $items->companyName . ' successfully "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'crm_new/Enquiry_register/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            // $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  href="' . base_url() . 'crm_new/Enquiry_register/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act = ' <a  back="' . base_url() . 'crm_new/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_new/Enquiry_allocation/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  href="' . base_url() . 'crm_new/Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
            
            
            if($items->status == 4){
                $act .= ' <a tp="confirm" base="' . base_url() . '/crm_new/Enquiry_register/list_all' . '"  success="Closure Requested' . $items->companyName . ' successfull y "  message="Closure Request' . $items->companyName . '?"  href="' . base_url() . 'crm_new/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning request disabled" data-toggle="modal" data-target="#myFollowupModal">Closed Request</span></a>';
                if($crm == 'CRM' ){
                    $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  href="' . base_url() . 'Customers/join/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info ">Join</a>';
    
                }
                else{
                    $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  href="' . base_url() . 'education/Student/join/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info ">Join</a>';
    
                }
            }
            else{
                $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">confirm closure</span></a>';
            }
            
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