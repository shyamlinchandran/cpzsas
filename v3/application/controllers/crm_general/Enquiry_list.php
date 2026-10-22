<?php

class Enquiry_list extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        // $this->load->model('crm_general/Enquiryallocation_model', 'Enquiry_allocation');
        $this->load->model('crm_general/Enquirylist_model', 'Enquiry_list');
    }

    public function listall($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Enquiry_list/listall', $data);
    }


    public function ajax_list()
    {
        $act = "";
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_list->where();
        $list = $this->Enquiry_list->get_datatables();
        $settings=$this->Enquiry_list->getcompanysettings();
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
            $row[] = $items->contactNumber; 
            $row[] = substr($items->Edate, 0, 10);
            $row[] = substr($items->Ddate, 0, 10);
            $row[] = $items->user;
            $row[] = $items->item;
            // $row[] = $items->Ddate;
            if ($items->statuss == 0) {
                $row[] = 'Nil';
            } else {
                $row[] = $items->st_name;
            }
            if ($items->next_follow_up_date == '0000-00-00') {
                $row[] = 'No FollowUps';
            } else {
                $row[] = $items->next_follow_up_date;
            }
            if ($items->status != 4 && $items->status != 6) {
                $act = ' <a  back="' . base_url() . 'crm_general/Enquiry_register/list_all"  href="' . base_url() . 'crm_general/Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
                if($settings[0]['User_Authentication']){

                    $act .= ' <a  back="' . base_url() . 'crm_general/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closure</span></a>';

                }
               

                if ($items->status == 3) {
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success=" Varification Request send successfully "  message="Are u sure to send request for varification enquiry from ' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning disabled request" data-toggle="modal" data-target="#myFollowupModal">Not Varified</span></a>';
                } else {
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success=" Varification Request send successfully "  message="Are u sure to send request for varification enquiry from ' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning request" data-toggle="modal" data-target="#myFollowupModal">Varify</span></a>';
                }
            } else {
                
                if($items->status != 6){
                    $act = ' <a  back="' . base_url() . 'crm_general/Enquiry_register/list_all"  href="' . base_url() . 'crm_general/Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success="Closure Requested' . $items->companyName . ' successfull y "  message="Closure Request' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-success request disabled" data-toggle="modal" data-target="#myFollowupModal">varified</span></a>';
                    $act .= ' <a  back="' . base_url() . 'crm_general/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closure</span></a>';
                }
                else{
                    $act .= ' <a  back="' . base_url() . 'crm_general/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-default disabled closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closed</span></a>';
                }
                

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
