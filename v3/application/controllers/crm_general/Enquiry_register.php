<?php

class Enquiry_register extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_general/Enquiryallocation_model', 'Enquiry_allocation');
        $this->load->model('crm_general/Enquiryregister_model', 'Enquiry_register');
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

    public function listall($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Enquiry_register/create', $data);
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

    public function list_all()
    {
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Enquiry_register/list', $data);
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

    public function create($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Enquiry_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Enquiry_register/create', $data);
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

    public function create_followup($id)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Enquiry_followup/create', $data);
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

    public function create_closure($id)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('Enquiry_closure/create', $data);
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

    public function view($id)
    {
        $data['type'] = 'view';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/enquiry_register/create', $data);
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

    function edit($id)
    {
        $data['type'] = 'edit';
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/enquiry_register/create', $data);
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

    public function getsing($id)
    {
        return $this->Enquiry_register->getsing($id);
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

    function delete($id)
    {
        $qry = "delete from  enquiry_register where id =" . $id;
        $this->db->query($qry);
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

    public function save()
    {
        $insert_id = $this->Enquiry_register->save();
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

    public function save_allocation()
    {
        $this->Enquiry_register->save_allocation();
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

    public function save_closure() {
        $this->Enquiry_register->save_closure();
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

    public function save_followup()
    {
        $this->Enquiry_register->save_followup();
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

    function closure_request($id)
    {
        $qry = "update  enquiry_register set status=3 where id =" . $id;
        $this->db->query($qry);
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
        $this->Enquiry_register->user();
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

    public function users()
    {
        $this->Enquiry_register->users();
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

    public function source()
    {
        $this->Enquiry_register->source();
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

    public function company()
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->company($search);
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

    public function product($typeId)
    {
        $search = strtolower($_GET['term']);
        return $this->Enquiry_register->product($typeId, $search);
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

    public function ajax_list()
    {
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
            $row[] = $items->contactNumber;
            $row[] = substr($items->Edate, 0, 10);
            $row[] = substr($items->Ddate, 0, 10);
            $row[] = $items->user;
            $row[] = $items->item;
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
            if($items->status != 4 && $items->status != 6){
            $act = ' <a  back="' . base_url() . 'crm_general/Enquiry_register/list_all"  href="' . base_url() . 'crm_general/Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';

                if ($items->status == 3) {
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success=" Varification Request send successfully "  message="Are u sure to send request for varification enquiry from ' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning disabled request" data-toggle="modal" data-target="#myFollowupModal">Not Varified</span></a>';
                } else {
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success=" Varification Request send successfully "  message="Are u sure to send request for varification enquiry from ' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning request" data-toggle="modal" data-target="#myFollowupModal">Varify</span></a>';
                }
            }
            else{
                if($items->status != 6){
                    $act = ' <a  back="' . base_url() . 'crm_general/Enquiry_register/list_all"  href="' . base_url() . 'crm_general/Enquiry_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
                    $act .= ' <a tp="confirm" base="' . base_url() . '/crm_general/Enquiry_register/list_all' . '"  success="Closure Requested' . $items->companyName . ' successfull y "  message="Closure Request' . $items->companyName . '?"  href="' . base_url() . 'crm_general/Enquiry_register/closure_request/' . $items->id . '"data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-success request disabled" data-toggle="modal" data-target="#myFollowupModal">varified</span></a>';
                    $act .= ' <a  back="' . base_url() . 'crm_general/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-warning closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closure</span></a>';
                }
                else{
                    $act = ' <a  back="' . base_url() . 'crm_general/Enquiry_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-default disabled closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closed</span></a>';
                }
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
