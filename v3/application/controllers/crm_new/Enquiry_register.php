<?php

class Enquiry_register extends MY_Controller {

    public function __construct() {
        parent::__construct();      
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_new/Enquiryallocation_model', 'Enquiry_allocation');
        $this->load->model('crm_new/Enquiryregister_model', 'Enquiry_register');
    }

    public function listall($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_register/create', $data);
    }

    public function list_all() {
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_register/list', $data);
    }

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_register/create', $data);  
    }

    public function create_followup($id) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_followup/create', $data);
    }

    public function create_closure($id) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_closure/create', $data); 
    }

    public function view($id) {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/enquiry_register/create', $data);
    }

    function edit($id) {
        $data['type'] = 'edit';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/enquiry_register/create', $data);
    }

    public function getsing($id) {
        return $this->Enquiry_register->getsing($id);
    }

    function delete($id) {
        $qry = "delete from  enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    public function save() {
        $insert_id = $this->Enquiry_register->save();
    }

    public function save_allocation() {
        $this->Enquiry_register->save_allocation();
    }

    public function save_followup() {
        $this->Enquiry_register->save_followup();
    }

    // public function save_closure() {
    //     $this->Enquiry_register->save_closure();
    // }

    function closure_request($id) {
        $qry = "update   enquiry_register set status=3 where id =" . $id;
        $this->db->query($qry);
    }

    public function user() {
        $this->Enquiry_register->user();
    }

    public function source() {
        $this->Enquiry_register->source();
    }

    public function company() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->company($search);
    }

    public function product($typeId) {
        $search = strtolower($_GET['term']);
        $this->Enquiry_register->product($typeId, $search);
    }
    

    public function ajax_list() {
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_register->where();
        $list = $this->Enquiry_register->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $dates = substr($items->sdate, 0, 10);
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
//            $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"  data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->id . '"    class="btn btn-primary test"  data-toggle="modal" data-target="#myEnquiryModal">Allocation</span></a>';
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
            "recordsTotal" => $this->Enquiry_register->count_all(),
            "recordsFiltered" => $this->Enquiry_register->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
