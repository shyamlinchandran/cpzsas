<?php

class Enquiry_allocation extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_service/Enquiryallocation_model', 'Enquiry_allocation');          
    }

    /*
  |--------------------------------------------------------------------------
  | Standardize newlines
  |--------------------------------------------------------------------------
  |
  | Determines whether to standardize newline characters in input data,
  | meaning to replace \r\n, \r, \n occurrences with the PHP_EOL value.
  |
  | WARNING: This feature is DEPRECATED and currently available only
  |          for backwards compatibility purposes!
  |
  */

    public function list_all()
    {
        $data['settings'] = $this->Enquiry_allocation->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_allocation/list', $data);
    }


        /**
     * *******************************************************************************************************
     * 
     * create : For create an enquiry
     * 
     * @author Shyamlin Chnadran
     * @created on : 07-06-2023
     * 
     **********************************************************************************************************
     */

    public function report()
    {
        $settings = $this->Enquiry_allocation->getCompanySettings();
        $data['settings'] = $settings;
        $title = 'Enquiry Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('crm_service/Enquiry_allocation/report', $data);
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
        $data['settings'] = $this->Enquiry_allocation->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_allocation/create', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * view : For view a particular enquiry
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function view($id)
    {
        $data['settings'] = $this->Enquiry_allocation->getCompanySettings();
        $data['type'] = 'view';
        $data['id'] = $id;
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $data['logged'] = $userid;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_allocation/create', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * getsing : **
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function getsing($id)
    {
        $this->Enquiry_allocation->getsing($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * save : save the enquiry into dattabase
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save()
    {
        $com_set = $this->Enquiry_allocation->getCompanySettings();
        // print_r($com_set);
        // exit();
        return $this->Enquiry_allocation->save($com_set);
    }

    /**
     * *******************************************************************************************************
     * 
     * save : save the enquiry into dattabase
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getcustomerdet()
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_allocation->getcustomerdet($search);
    }

    public function gettypedet($type = 2)
    { 
        //$type = $this->input->post('type');
        //$type = strtolower($_GET['type']);
        $search = strtolower($_GET['term']);
        return $this->Enquiry_allocation->gettypedet($type, $search);
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


    public function save_allocation()
    {

        $idsss = $this->input->post('isbulk');

        if ($idsss > 0) {
            $this->Enquiry_allocation->save_bulkallocation();
        } else {
            $this->Enquiry_allocation->save_allocation();
        }
    }

    /**
     * *******************************************************************************************************
     * 
     * save_followup : save followups
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */


    public function save_followup()
    {
        $this->Enquiry_allocation->save_followup();
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getItems($id = 0)
    {
        $this->Enquiry_allocation->getItems($id);
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getAllItems($type = 0)
    {
        $this->Enquiry_allocation->getAllItems($type);
    }



    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getItemTypes()
    {
        return $this->Enquiry_allocation->getItemTypes();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save_closure()
    {
        $this->Enquiry_allocation->save_closure();
    }

    /**
     * *******************************************************************************************************
     * 
     * varify function for varify the enquiry 
     * 
     * @author Althaf
     * @created on : 29-10-2019
     * 
     **********************************************************************************************************
     */

    public function varify()
    {
        $this->Enquiry_allocation->varify();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function save_product()
    {
        $this->enquiry_product->save_product();
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function user()
    {
        $this->Enquiry_allocation->user();
    }

    public function company()
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_allocation->company($search);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function getfollowups($id)
    {
        $data['settings'] = $this->Enquiry_allocation->getCompanySettings();
        $date = date('Y-m-d');
        $data['id'] = $id;
        $data['datenow'] = $date;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Enquiry_allocation/list', $data);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    public function product()
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->product($search);
    }

    /**
     * *******************************************************************************************************
     * 
     * saveNextYear : 
     * 
     * @author Althaf
     * @created on : 17-10-2019
     * 
     **********************************************************************************************************
     */

    function otheritem($id)
    {
        $this->Enquiry_allocation->otheritem($id);
    }

    function delete($id)
    {
        $qry = "delete from  v_enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    /**
     * *******************************************************************************************************
     * 
     * ajaxlist list all values into the table  
     * 
     * @author Althaf
     * @created on : 29-10-2019
     * 
     **********************************************************************************************************
     */


    public function list_report(){

        $this->Enquiry_allocation->get_report();
        $list = $this->Enquiry_allocation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = $items->id;
            $row[] = $items->cusname;
            $row[] = $items->cusphone;
            $row[] = $items->cusaddress;
            $row[] = $items->itemname;
            $row[] = $items->model;
            $row[] = $items->series;
            $row[] = $items->observation;
            $row[] = $items->engineer_remarks;
            $row[] = $items->call_status;
            $row[] = $items->closed_remarks;
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

    public function history_list(){

        $this->Enquiry_allocation->gethistory();
        $list = $this->Enquiry_allocation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->product;
            $row[] = $items->sdate;
            $row[] = $items->user_name;
            $row[] = $items->service_bill_date;
            $row[] = $items->totalAmount;

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
    public function sale_list(){

        $this->Enquiry_allocation->getsales();
        $list = $this->Enquiry_allocation->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->invoice;
            $row[] = $items->name;
            $row[] = $items->invoice_date;
            $row[] = $items->war_period;
            $row[] = $items->total;

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

    public function ajax_list()
    {

        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $act = "";    

        $list = $this->Enquiry_allocation->get_datatables();
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
            $row[] = $items->serv_no;
            $row[] = $items->cus_name;
            $row[] = $items->item_det;
            $date = date_create($items->Ddate);
            $row[] = date_format($date, "d/m/Y");
            $row[] = $items->totalAmount;
            $row[] = $items->enq_user_name;
            $row[] = $items->allo_user_name;
            if ($items->status != 4 && $items->status != 6) {
                //edit
                $act = ' <a  back="' . base_url() . 'crm_service/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_service/Enquiry_allocation/create/' . $items->reg_id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
                if ($usertype == 1) {
                    //delete
                    $act .= ' <a tp="confirm" base="' . base_url() . 'crm_service/Enquiry_allocation/list_all' . '"  success="Delete ' . $items->serv_no . ' successfuly "  message="Do you want to Delete ' . $items->serv_no . '?"  href="' . base_url() . 'crm_service/Enquiry_allocation/delete/' . $items->reg_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
                }
                //view
                $act .= ' <a  back="' . base_url() . 'crm_service/Enquiry_allocation/list_all"  href="' . base_url() . 'crm_service/Enquiry_allocation/view/' . $items->reg_id . '" data-toggle="tooltip" title="view" class="btn btn-success "><span class="glyphicon glyphicon-eye-open"></span></a>';
                if ($usertype == 1) {
                    //Allocate/Reallocate
                    if ($items->status != 0) {
                        $act .= ' <a  back="' . base_url() . 'crm_service/Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->reg_id . '"class="btn btn-primary test"  data-toggle="modal" date="' . $items->date . '" data-target="#myEnquiryModal">Re Allocate</span></a>';
                    } else {
                        $act .= ' <a  back="' . base_url() . 'crm_service/Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry Allocation" id="' . $items->reg_id . '"class="btn btn-primary test"  data-toggle="modal" date="' . $items->date . '" data-target="#myEnquiryModal">Pending..</span></a>';
                    }
                    //Closure/confirm/closed
                    if ($items->status == 3) {
                        $act .= ' <a  var_id="' . $items->reg_id . '" back="' . base_url() . 'crm_service/Enquiry_allocation/getfollowups/' . $items->reg_id . '" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" idss = "' . $items->reg_id . '" data-target="#myFollowupModal">Varification Pending</span></a>';
                    } else if ($items->status == 4) {
                        $act .= ' <a  back="' . base_url() . 'crm_service/Enquiry_register/list_all"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-success closure disabled" data-toggle="modal" data-target="#myFollowupModal">Varified</span></a>';
                    }
                }
            } else {
                if ($items->status != 6) {
                    $act = ' <a tp="confirm" base="' . base_url() . '/crm_service/Enquiry_register/list_all' . '"  success="Closure Requested' . $items->serv_no . ' successfull y "  message="Closure Request' . $items->serv_no . '?"  href="' . base_url() . 'crm_service/Enquiry_register/closure_request/' . $items->reg_id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-success request disabled" data-toggle="modal" data-target="#myFollowupModal">varified</span></a>';
                } else {
                    $act = ' <a  back="' . base_url() . 'crm_service/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-default disabled closure" data-toggle="modal" idss = "' . $items->reg_id . '" data-target="#myFollowupModal">Closed</span></a>';
                }
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






    ////////////////////////////////////////


    public function listOtherofBuss($var = null)
    {
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Leads_master/list_all_other_buss', $data);
    }

    public function addOtherBussiness($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['option'] = 'create';
        $data['settings'] = $this->leadsmaster->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_service/Leads_master/addOtherBussiness', $data);
    }

    public function saveOtherBussiness()
    {
        $this->leadsmaster->saveOtherBussiness();
    }

    public function deleteBussinessOther($id)
    {
        $this->leadsmaster->deleteBussinessOther($id);
    }

    public function getAllBussOther($id = 0)
    {
        $this->leadsmaster->getAllBussOther($id);
    }

    public function list_other_bussiness()
    {
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $act = "";
        $this->leadsmaster->list_other_bussiness();
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
            $act = ' <a  back="' . base_url() . 'crm_service/Enquiry_allocation/listOtherofBuss"  href="' . base_url() . 'crm_service/Enquiry_allocation/addOtherBussiness/' . $items->id . '" data-toggle="tooltip" title="edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            //delete
            $act .= ' <a tp="confirm" base="' . base_url() . 'crm_service/Enquiry_allocation/listOtherofBuss' . '"  success="Delete ' . $items->types . ' successfuly "  message="Do you want to Delete ' . $items->types . '?"  href="' . base_url() . 'crm_service/Enquiry_allocation/deleteBussinessOther/' . $items->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';


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

    function getVehicleServiceHistoryWithItemid($id){

        $this->Enquiry_allocation->getVehicleServiceHistoryWithItemid($id);
    }

    function getProductServiceHistoryWithItemid($id){

        $this->Enquiry_allocation->getProductServiceHistoryWithItemid($id);
    }

    function getVehicleServiceHistoryWithCusid($id){

        $this->Enquiry_allocation->getVehicleServiceHistoryWithCusid($id);
    }
    function getProductServiceHistoryWithCusid($id){

        $this->Enquiry_allocation->getProductServiceHistoryWithCusid($id);
    }
}
