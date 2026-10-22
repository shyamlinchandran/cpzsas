<?php

class Bussiness_plan_report extends MY_Controller
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

    public function list_busiplan_report()
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
        $this->load->view('crm_general/Reports/bussinessplan', $data);
    }

    public function ajax_list()
    {
        $this->report->bussinessplan_report();
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
            $dates = substr($items->edate, 0, 10);
            $row[] = $dates;
            $row[] = $items->company;
            $row[] = number_format($items->amount, 3);
            $row[] = number_format($items->closeamount, 3);
            $discounted = number_format($items->closeamount - $items->amount, 3);
            $row[] = $discounted;
            $row[] = $items->itemname;
            $row[] = $items->allouser;
            $row[] = $items->closedrem;
            if($items->rstatus >= 7){
                $row[] = '<a class = "btn btn-success" onclick = "notbill('.$items->enq_id.')">Billed</a> &nbsp;';
            }
            else{
                $row[] = '<a class = "btn btn-warning" onclick = "dos('.$items->enq_id.')">Not Billed</a> &nbsp;';
            }
            

           

                
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
