<?php

class Todo_list extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        // $this->load->model('crm_general/Enquiryallocation_model', 'Enquiry_allocation');
        $this->load->model('todo/Todolist_model', 'Todo_list');
    }

    public function listall($id = 0)
    {
        $data['type'] = 'create';
        $data['id'] = $id;
        $data['settings'] = $this->Todo_list->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('todo/Todo_list/listall', $data);
    }


    public function ajax_list()
    {
        $act = "";
        //$this->Enquiry_allocation->where();
        $list = $this->Todo_list->where();
        $list = $this->Todo_list->get_datatables();
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
            "recordsTotal" => $this->Todo_list->count_all(),
            "recordsFiltered" => $this->Todo_list->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
