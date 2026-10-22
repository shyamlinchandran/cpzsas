<?php

class Todo_register extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('todo/Todoallocation_model', 'Todo_allocation');
        $this->load->model('todo/Todoregister_model', 'Todo_register');
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
        $data['settings'] = $this->Todo_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_register/create', $data);
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
        $data['settings'] = $this->Todo_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_register/list', $data);
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
        $data['settings'] = $this->Todo_register->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_register/create', $data);
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
        $this->load->view('todo/Todo_followup/create', $data);
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
        $this->load->view('todo/Todo_register/create', $data);
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
        $this->load->view('todo/Todo_register/create', $data);
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
        return $this->Todo_register->getsing($id);
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
        $qry = "delete from  Todo_register where id =" . $id;
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
        $insert_id = $this->Todo_register->save();
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
        $this->Todo_register->save_allocation();
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
        $this->Todo_register->save_closure();
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
        $this->Todo_register->save_followup();
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

    function complete_task($id)
    {
        $qry = "update todo_register set state=3 where id =" . $id;
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
        $this->Todo_register->user();
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
        $this->Todo_register->users();
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
        $this->Todo_register->source();
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
        return $this->Todo_register->company($search);
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
        return $this->Todo_register->product($typeId, $search);
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
        $list = $this->Todo_register->where();
        $list = $this->Todo_register->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $dates = substr($items->sdate, 0, 10);
            $row[] = $dates;
            $row[] = $items->task;
            $row[] = $items->stt;
            $row[] = $items->userss;
            if ($items->next_follow_up_date == '0000-00-00') {
                $row[] = 'No FollowUps';
            } else {
                $row[] = $items->next_follow_up_date;
            }
            $act = ' <a  back="' . base_url() . 'todo/Todo_register/list_all"  href="' . base_url() . 'todo/Todo_register/create_followup/' . $items->id . '"  data-toggle="tooltip" title="Enquiry Follow up" id="' . $items->id . '"   class="btn btn-info " >Follow up</span></a>';
            if($items->state == 6){
                $act = ' <a  back="' . base_url() . 'todo/Todo_register/listall" id = "cclose"   data-toggle="tooltip" title="Enquiry closure" type="button" class="btn btn-default disabled closure" data-toggle="modal" idss = "'.$items->id.'" data-target="#myFollowupModal">Closed</span></a>';
            }
            if($items->stt == "Completed"){
                $act .= ' <a tp="confirm" base="' . base_url() . '/todo/Todo_register/list_all' . '"  success=" Completion Request send successfully "  message="Are u sure to send request for complete task from ?"  href="' . base_url() . 'todo/Todo_register/complete_task/' . $items->id . '"data-toggle="tooltip" title="Task complete" type="button" class="btn btn-success request" data-toggle="modal" data-target="#myFollowupModal">Request Complete</span></a>';
            }
                
            

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Todo_register->count_all(),
            "recordsFiltered" => $this->Todo_register->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
