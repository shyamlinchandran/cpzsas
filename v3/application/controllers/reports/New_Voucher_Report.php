<?php
class New_Voucher_Report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/New_Voucher_Report_model','voucher');
    }
    public function listall()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Voucher(journal)';
        $this->load->view('reports/new_voucher_Report/listall',$data);
    }
    public function ajax_list()
    {
        $this->voucher->where();
        $list = $this->voucher->get_datatables();
        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row[] = $item->trans_date;
            $row[] = $item->no;
            $row[] = $item->vourcher_type;
            $row[] = $item->accounts;
            $row[] = $item->particulers;
            $row[] = '-';
            $row[] = $item->narration;
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->voucher->count_all(),
            "recordsFiltered" => $this->voucher->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}