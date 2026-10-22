<?php

class Allocated_report extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_general/Reports_model', 'report');
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

    public function list_allocated_report()
    {
        $data['settings'] = $this->report->getCompanySettings();
        $date = date('Y-m-d');
        $data['datenow'] = $date;
        $data['id'] = 0;
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $data['usertype'] = $usertype;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_general/Reports/allocated', $data);
    }

    public function ajax_list()
    {
        $this->report->allocated_report();
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $list = $this->report->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        foreach ($list as $items) {
            $no++;
            $row = array();
            // check boxes
            $row[] = $no;
            $dates = substr($items->date, 0, 10);
            $row[] = $dates;
            $row[] = $items->companyName;
            $row[] = $items->contactPerson;
            $row[] = $items->contactNumber;
            $row[] = $items->email;
            $row[] = '<a href = "'.base_url().'crm_general/reports/Bussiness_opportunity_report/list_opportunity_report">'.$items->allouser.'</a>';
            $row[] = substr($items->allodate, 0, 10);
            $row[] = substr($items->delidate, 0, 10);
            $row[] = $items->itemname;
            $row[] = $items->amount;
            $row[] = $items->alloremark;
           
            
                
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->report->count_all(),
            "recordsFiltered" => $this->report->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }



}
