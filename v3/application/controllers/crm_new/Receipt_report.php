<?php

class Receipt_report extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url', 'html', 'form'));
        $this->load->model('crm_new/Reports_model', 'report');
    }


    public function list_all()
    {
        $data['settings'] = $this->report->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('crm_new/reports/receiptlist', $data);
    }


    public function ajax_list()
    {
        $this->report->where();
        $list = $this->report->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $crm = $this->input->post('crmtype');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $dates = substr($items->tran_crtd_dt, 0, 10);
            $row[] = $dates;
            $row[] = $items->ledgers;
            $row[] = $items->vtype;
            $row[] = $items->voucher_no;
            $row[] = $items->tran_narration;
            $row[] = $items->tran_credit;
            $row[] = $items->tran_debit;

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
