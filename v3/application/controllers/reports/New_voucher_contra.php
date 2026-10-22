<?php
class New_voucher_contra extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/New_voucher_contra_model','voucher');
    }
    public function listall()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Voucher(contra)';
        $this->load->view('reports/new_voucher_contra/listall',$data);
    }
    public function ajax_list()
    {
        $this->voucher->where();
        $list = $this->voucher->get_datatables();
        $data = array();
        foreach ($list as $item) {
            $row = array();
            $row[] = $item->date;
            $row[] = $item->voucher_no;
            $row[] = $item->btype;
            $row[] = $item->from_account;
            $row[] = $item->to_account;
            $row[] = $item->amount;
            $row[] = $item->amount;
            $row[] = $item->naration;
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