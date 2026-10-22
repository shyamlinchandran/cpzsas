<?php

class Enquiry_completion_report extends MY_Controller
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

    public function list_completion_report()
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
        $this->load->view('crm_general/Reports/enquiryCompletion', $data);
    }

    public function ajax_list()
    {
        $this->report->completion_report();
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
            $row[] = substr($items->edate, 0, 10);
            $row[] = $items->company;
            $row[] = substr($items->allodate, 0, 10);
            $row[] = substr($items->closedate, 0, 10);  
            $start_date = strtotime(substr($items->allodate, 0, 10));
            $end_date = strtotime(substr($items->closedate, 0, 10));
            $deli_date = strtotime(substr($items->delidate, 0, 10));
            $total = ($end_date - $start_date)/60/60/24;
            $total = (int)$total;
            $pending = ($end_date - $deli_date)/60/60/24;
            $pending = (int)$pending;
            $row[] = $total;
            $row[] = substr($items->delidate, 0, 10); 
            $row[] = $items->itemname;
            $row[] = $pending;
            $row[] = $items->closedamount;
            $row[] = $items->username;
            $row[] = $items->userss;
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
