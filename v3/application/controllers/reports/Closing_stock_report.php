<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Closing_stock_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reports/closing_stock_model', 'closing_stock');
    }

    public function index() {
        $data['title'] = 'Closing Stock Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/items/closing_stock_report', $data);
    }

    private function get_formatted_date($date) {
        if (empty($date)) return date('Y-m-d');
        $date = str_replace('/', '-', $date);
        $parts = explode('-', $date);
        if (count($parts) == 3) {
            return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
        }
        return $date;
    }

    public function ajax_list() {
        $start_date_input = $this->input->post('startdate');
        $end_date_input = $this->input->post('enddate');
        
        $start_date = $start_date_input ? $this->get_formatted_date($start_date_input) : '2000-01-01';
        $end_date = $end_date_input ? $this->get_formatted_date($end_date_input) : '2030-01-01';

        // Set the dynamic table structure in the model based on the end date
        $this->closing_stock->set_end_date($end_date);
        
        $this->closing_stock->where();
        $list = $this->closing_stock->get_datatables();

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            
            $row[] = $no;
            $row[] = $item->itemname;
            $row[] = $item->barcode;
         //   $row[] = number_format($item->open_qty, $this->company_roundoff, '.', '');
          //  $row[] = number_format($item->open_rate, $this->company_roundoff, '.', '');
          //  $row[] = number_format($item->opening_stock_value, $this->company_roundoff, '.', '');
            $row[] = number_format($item->running_qty + $item->open_qty, $this->company_roundoff, '.', '');
            $row[] = number_format($item->purchase_rate, $this->company_roundoff, '.', '');
          //  $row[] = number_format($item->running_stock_value, $this->company_roundoff, '.', '');
            $row[] = number_format($item->total_closing_value, $this->company_roundoff, '.', '');
            
            $data[] = $row;
        }

        // Fetch overall totals matching your query results
        $totals = $this->closing_stock->get_overall_closing_value($end_date);
        
        $overall_open_qty = isset($totals['total_open_qty']) ? (float)$totals['total_open_qty'] : 0.00;
        $overall_open_value = isset($totals['total_open_value']) ? (float)$totals['total_open_value'] : 0.00;
        $overall_running_qty = isset($totals['total_running_qty']) ? (float)$totals['total_running_qty'] : 0.00;
        $overall_running_value = isset($totals['total_running_value']) ? (float)$totals['total_running_value'] : 0.00;
        $overall_closing_value = isset($totals['closing']) ? (float)$totals['closing'] : 0.00;

        $row_footer = array();
        $row_footer[] = '';
        $row_footer[] = 'Total';
        $row_footer[] = '';
        // $row_footer[] = number_format($overall_open_qty, $this->company_roundoff, '.', '');
        // $row_footer[] = '';
        // $row_footer[] = number_format($overall_open_value, $this->company_roundoff, '.', '');
        $row_footer[] = number_format($overall_running_qty, $this->company_roundoff, '.', '');
        $row_footer[] = '';
        // $row_footer[] = number_format($overall_running_value, $this->company_roundoff, '.', '');
        $row_footer[] = number_format($overall_closing_value, $this->company_roundoff, '.', '');
        $data[] = $row_footer;

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->closing_stock->count_all(),
            "recordsFiltered" => $this->closing_stock->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
}
