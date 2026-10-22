<?php

class Leads_master extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        // $this->load->model('crm_general/Enquiryallocation_model', 'leadsmaster');
        $this->load->model('crm_general/Leadsmaster_model', 'leadsmaster');
    }

    /**
     * *******************************************************************************************************
     * 
     * create : For create an enquiry
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function create($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $data['logged'] = $userid;
        $data['leads'] = 'leads';
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Leads_master/create', $data);
    }

    public function view($id = 0)
    {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'customer create';
        $data['type'] = 'cus';
        $data['eid'] = '';
        $data['view'] = "view";
        $this->load->view('crm_general/Leads_master/leadsView', $data);
    }

    public function getAll($id = 0)
    {
        $this->leadsmaster->getAll($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * listall() : List all leads list
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function listall($id = 0)
    {
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Leads_master/list_all', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * save_allocation : save allocation from admin
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function addToEnquiry()
    {
        $data = $this->input->post('text');
        $this->leadsmaster->addToEnquiry($data);
    }


    /**
     * *******************************************************************************************************
     * 
     * save_allocation : save allocation from admin
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function addEnquiry($id)
    {
        $this->leadsmaster->addToEnquiry($id); 
    }

    /**
     * *******************************************************************************************************
     * 
     * DeleteLeads fn for delete the selected leads
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function deleteLeads()
    {
        $data = $this->input->post('text');
        $this->leadsmaster->deleteLeads($data);
    }

    /**
     * *******************************************************************************************************
     * 
     * DeleteLeads fn for delete the selected leads
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getStatus($id)
    {
        $this->leadsmaster->getStatus($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * Delete fn for delete the particular lead
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function delete($id)  
    {
        $this->leadsmaster->deleteLeads($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * Delete fn for delete the particular lead
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getEnqId()  
    {
        $this->leadsmaster->getEnqId();
    }

    /**
     * *******************************************************************************************************
     * 
     * Delete fn for delete the particular lead
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function save_bill($id)  
    {
        $this->leadsmaster->save_bill($id);
    }

    public function save_nobill($id)  
    {
        $this->leadsmaster->save_nobill($id);
    }



    /**
     * *******************************************************************************************************
     * 
     * Delete fn for delete the particular lead
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getArea()  
    {
        $this->leadsmaster->getArea();
    }

    public function listTypeofBuss(Type $var = null)
    {
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Leads_master/list_all_type_buss', $data); 
    }

    public function addTypeBussiness($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['option'] = 'create';
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Leads_master/addTypeBussiness', $data);
    }

    public function saveTypeBussiness()
    {
        $this->leadsmaster->saveTypeBussiness();
    }

    public function deleteBussinessType($id)
    {
        $this->leadsmaster->deleteBussinessType($id);
    }

    public function getAllBussType($id = 0)
    {
        $this->leadsmaster->getAllBussType($id);
    }

    public function list_type_bussiness()
    {
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $act = "";
        $this->leadsmaster->list_type_bussiness();
        $list = $this->leadsmaster->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        foreach ($list as $items) {
            $no++;
            $row = array();
            // check boxes
            $row[] = $no;
            $row[] = $items->types;
            $row[] = $items->notes;
            //Edit
            $act = ' <a  back="' . base_url() . 'crm_general/Leads_master/listTypeofBuss"  href="' . base_url() . 'crm_general/Leads_master/addTypeBussiness/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            //delete
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_general/Leads_master/listTypeofBuss' . '"  success="Delete ' . $items->types . ' successfuly "  message="Do you want to Delete ' . $items->types . '?"  href="' . base_url() . 'crm_general/Leads_master/deleteBussinessType/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            
                
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->leadsmaster->count_all(),
            "recordsFiltered" => $this->leadsmaster->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    

    


    public function ajax_list()
    {

        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $act = "";
        $list = $this->leadsmaster->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        foreach ($list as $items) {
            $no++;
            $row = array();
            // check boxes
            $row[] = '<input class="enquiry" type="checkbox" name="check[]" value="' . $items->id . '"> &nbsp;' . $no;
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->companyName;
            $row[] = $items->contactPerson;
            $row[] = '<a tp="new" href="https://wa.me/' . $items->contactNumber . '">' . $items->contactNumber . '</a>';
            //Edit
            $act = ' <a  back="' . base_url() . 'crm_general/Leads_master/listall"  href="' . base_url() . 'crm_general/Leads_master/create/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            //view
            $act .= ' <a  back="' . base_url() . 'crm_general/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_general/Leads_master/view/' . $items->id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
            //delete
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_general/Leads_master/listall' . '"  success="Delete ' . $items->companyName . ' successfuly "  message="Do you want to Delete ' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Leads_master/delete/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            
                
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->leadsmaster->count_all(),
            "recordsFiltered" => $this->leadsmaster->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function getAllocation()
    {
        $this->leadsmaster->getAllocation();
        $list = $this->leadsmaster->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $dates = substr($items->sdate, 0, 10);
            $row[] = $dates;
            $row[] = $items->username;
            $row[] = $items->Edate;
            $row[] = $items->Ddate; 
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->leadsmaster->count_all(),
            "recordsFiltered" => $this->leadsmaster->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
 
    public function getProducts()
    {
        $this->leadsmaster->getProducts();
        $list = $this->leadsmaster->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->itemname;
            $row[] = $items->quantity;
            $row[] = $items->price;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->leadsmaster->count_all(),
            "recordsFiltered" => $this->leadsmaster->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
