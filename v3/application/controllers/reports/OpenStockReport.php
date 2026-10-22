<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OpenStockReport extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports/OpenStockReport_model', 'openstock');
    }

    public function index() {
        $data['title'] = 'Opening Stock Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/openstockreport/list', $data);
    }

    public function ajax_list() {
        $date = $this->input->post('date');
        $list = $this->openstock->get_open_stock_data($date);

        $data = array();
        $no = 0;
        $total_qty = 0;
        $total_val = 0;

        foreach ($list as $item) {
            $no++;
            $qty = (float)$item['open_stock_qty'];
            $rate = (float)$item['open_stock_rate'];
            $bal = (float)$item['open_stock_balance'];

            $total_qty += $qty;
            $total_val += $bal;

            $row = array();
            $row[] = $no;
            $row[] = $item['barcode'] ? $item['barcode'] : '-';
            $row[] = $item['item_name'];
            $row[] = $item['godown_name'];
            $row[] = number_format($qty, 2, '.', '');
            $row[] = number_format($rate, 2, '.', '');
            $row[] = number_format($bal, 2, '.', '');

            $data[] = $row;
        }

        $output = array(
            "draw" => isset($_POST['draw']) ? intval($_POST['draw']) : 1,
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
            "total_qty" => number_format($total_qty, 2, '.', ''),
            "total_val" => number_format($total_val, 2, '.', '')
        );

        echo json_encode($output);
    }
}
