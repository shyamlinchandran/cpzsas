<?php

class Bussiness_opportunity_report extends MY_Controller
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

    public function list_opportunity_report()
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
        $this->load->view('crm_general/Reports/bussinessOpertunity', $data);
    }

    public function ajax_list()
    {
        $this->report->opportunity_report();
        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];
        $closedAmount = 0;
        $list = $this->report->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $id = $this->input->post('allocate_id');
        for ($i = 1; $i <=13;$i++) {
            $mymonths[$i] = 0;
        }
        $totals = 0;
        foreach ($list as $items) {
            $no++;
            $row = array();
            // check boxes
            $row[] = $no;
            $row[] = '<a href = "'.base_url().'crm_general/reports/Allocated_report/list_allocated_report">'.$items->user_name.'</a>';
            $months = explode(',', $items->mon);
            $close = explode(',', $items->amo);

            // print_r($months);
            // exit();
            $sum = 0;
            
            $s = 1;
            for ($j = 0; $j < count($months); $j++) {
                    $m = $months[$j];
                    $mymonths[$m] = (float) $mymonths[$m] + (float) $close[$j];
                    for ($i = $s; $i <= 12;) {
                    // $count = $j;
                    if ($months[$j] == $i) {
                        
                        $row[] = $close[$j].'.000'; 
                        if($i < 12){
                            $i = $i + 1;
                            $s = $i;
                        
                        } 
                        $sum = $sum + $close[$j];
                        break 1;
                    } else {
                        $row[] = "";
                        if($i < 12){
                            $i = $i + 1;
                            // $s = $i;
                        }       
                    }
                }
            }
            $last = 0;
            if(count($months) < 12){
                for ($j = 0; $j < count($months); $j++) {
                    $last = $months[$j];
                }
                for($j = $last; $j < 12; $j++){
                    $row[] = "";
                }
            }
            $totals = $totals + $sum;
            $row[] = $sum.'.000';


            $data[] = $row;
        }
        $row = array();
        $row[] = "";
        $row[] = "<strong>Total</strong>";
        $row[] = '<strong>'.$mymonths[1].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[2].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[3].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[4].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[5].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[6].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[7].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[8].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[9].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[10].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[11].'.000 </strong>';
        $row[] = '<strong>'.$mymonths[12].'.000 </strong>';
        $row[] = '<strong>'.$totals.'.000 </strong>';
        $data[] = $row;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->report->count_all(),
            "recordsFiltered" => $this->report->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
