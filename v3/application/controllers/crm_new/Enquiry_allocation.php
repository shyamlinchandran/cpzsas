<?php

class Enquiry_allocation extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_new/Enquiryallocation_model', 'Enquiry_allocation');
    }

    public function list_all() {
        $data['settings']=$this->Enquiry_allocation->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_allocation/list', $data);
    } 

    public function create($id = 0) {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings']=$this->Enquiry_allocation->getCompanySettings();

        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_allocation/create', $data);
    }

//    public function create_followup($id) {
//        $data['type'] = 'create';
//        $data['id'] = $id;
//        $this->load->view('_blocks/subpages/create');
//        $this->load->view('_blocks/subpages/list');
//        $this->load->view('Enquiry_followup/create', $data); 
//    }
//    public function create_closure($id) {
//        $data['type'] = 'create';
//        $data['id'] = $id;
//        $this->load->view('_blocks/subpages/create');
//        $this->load->view('_blocks/subpages/list');
//        $this->load->view('Enquiry_closure/create', $data);
//    }

    public function view($id) {
        $data['settings']=$this->Enquiry_allocation->getCompanySettings();
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_allocation/create', $data);
    }

    function edit($id) {
        $data['type'] = 'edit';
        $data['id'] = $id;
        $data['settings']=$this->Enquiry_allocation->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/Enquiry_allocation/create', $data);
    }

    public function getsing($id) {
        $this->Enquiry_allocation->getsing($id);
    }

    function delete($id) {
        $qry = "delete from  enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    public function deleteEnq()
    
    {
        $data = $this->input->post('text');
        $this->Enquiry_allocation->deleteEnq($data);
    }

    public function save() {
        return $this->Enquiry_allocation->save();
    }

    // public function save_allocation() {
    //     $this->Enquiry_allocation->save_allocation();
    // }
    public function save_allocation() {

        $idsss = $this->input->post('isbulk');  
        
        if($idsss > 0){
            $this->Enquiry_allocation->save_bulkallocation();
        }
        else{
            $this->Enquiry_allocation->save_allocation(); 
        }
        
    }

    // public function save_bulkallocation()
    // {
         
    // }
    public function checkalloc() {
        $this->Enquiry_allocation->checkalloc();
    }

    public function save_followup() {
        $this->Enquiry_allocation->save_followup();
    }

    public function getItemTypes() {
        return $this->Enquiry_allocation->getItemTypes();
    }

    public function save_closure() {
        $this->Enquiry_allocation->save_closure();
    }

    public function save_product() {
        $this->enquiry_product->save_product();
    }

    public function user() {
        $this->Enquiry_allocation->user();
    }

    public function company() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_allocation->company($search);
    }

    public function product() {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->product($search);
    }

    function otheritem($id) {
        $this->Enquiry_allocation->otheritem($id);
    }

    public function ajax_list() {
        //$this->Enquiry_allocation->where();
        $list = $this->Enquiry_allocation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        foreach ($list as $items) {
            $no++;
            $row = array();

            $row[] = '<input class="enquiry" type="checkbox" name="check[]" value="' . $items->id . '"> &nbsp;' . $no;
            
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->companyName;
            $row[] = $items->contactPerson;
            $row[] = '<a tp="new" href="https://wa.me/'. $items->contactNumber.'">'.$items->contactNumber.'</a>';
            // if(($items->user_name) == null){
            //     $row[] = 'Pending..';
            // }
            // else{
            //     $row[] = $items->user_name;
            // }
            if($items->status != 0){  
            $row[] = $items->user_name; 
            }
            else{
            $row[] = 'Nil'; 
            }
            // $row[] = $items->location; 
            $act = ' <a  back="' . base_url() . 'crm_new/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_new/Enquiry_allocation/edit/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_new/Enquiry_allocation/list_all' . '"  success="Delete ' . $items->companyName . ' successfuly "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'crm_new/Enquiry_allocation/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_new/Enquiry_allocation/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
        
            if($items->status != 0){
                $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->id . '"    class="btn btn-primary test"  data-toggle="modal" date="'.$items->date.'" data-target="#myEnquiryModal">Re Allocate</span></a>';
            }
            else{
                $act .= ' <a  back="' . base_url() . 'crm_new/Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->id . '"    class="btn btn-primary test"  data-toggle="modal" date="'.$items->date.'" data-target="#myEnquiryModal">Pending..</span></a>';

            }
           
            $row[] = $act; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Enquiry_allocation->count_all(),
            "recordsFiltered" => $this->Enquiry_allocation->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

}
