<?php
class Sales_order_pending extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/Sales_order_pending_model', 'pending');
    }
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Item Wise Sales Order Pending Report';
        $this->load->view('reports/sales_order_pending/list', $data);
    }
    public function ajax_list()
    {
        $this->pending->where();
        $list = $this->pending->get_datatables();
        $data = array();
        $no = 1;
        foreach ($list as $item) {
            $row = array();
            $row[] = $no;
            $row[] = $item->delivery_date;
            $row[] = $item->invoice_date;
            $row[] = $item->so_no;
            $row[] = $item->customer_name;
            $row[] = $item->item_name;
            $row[] = $item->order_qty;
            $row[] = $item->billed_qty;
            $row[] = $item->balance_qty;
            $data[] = $row;
            $no++;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->pending->count_all(),
            "recordsFiltered" => $this->pending->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function get_item()
    {
        $search = strtolower($_GET['term']);
        $this->pending->get_item($search);

    }
    public function get_customer()
    {
        $search = strtolower($_GET['term']);
        $this->pending->get_customer($search);
    }
}
