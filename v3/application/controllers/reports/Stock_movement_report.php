<?php
class Stock_movement_report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/Stock_movement_model','stock');

    }
	
	 public function list_daily()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['title'] = 'Daily Customer Sales Analysis Report';
        $this->load->view('reports/stock_movement/list_daily',$data);
    }
    public function daily_ajax_list()
    {
        $this->stock->daily_list();
        $list = $this->stock->get_datatables();
        $data = array();
        $no =1;
        foreach($list as $item)
        {
            $row = array();
            $row[] = $no;
            $row[] = $item ->name;
            $row[] = $item ->sales_qty;
            $row[] = $item ->sales_value;
            $row[] = $item ->sales_return_qty;
            $row[] = $item ->sales_return_value;
            $row[] = $item ->damage_qty;
            $row[] = $item ->damage_value;
            $no++;
            $data[] =$row;
            
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	
    public function list()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Stock Movement Report';
        $this->load->view('reports/stock_movement/list',$data);
    }
    public function ajax_list()
    {
        $this->stock->where();
        $list = $this->stock->get_datatables();
        $data = array();
        $no =1;
        foreach($list as $item)
        {
            $row = array();
            $row[] = $no;
            $row[] = $item ->name;
            $row[] = $item ->open_stock;
            $row[] = $item ->purchasequantity;
            $row[] = $item ->purchasereturn;
            $row[] = $item ->salequantity;
            $row[] = $item ->salesreturn;
            $row[] = "free Quentity";
            $row[] = $item ->damage;
            $row[] = $item ->issued;
            $row[] = $item ->received;
            $row[] = $item ->closing_stock;
            $no++;
            $data[] =$row;
            
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->stock->count_all(),
            "recordsFiltered" => $this->stock->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function customers($type='')
    {
        $search = strtolower($_GET['term']);
        return $this->stock->customers($search,$type);
    }
    public function brand()
    {
        $search = strtolower($_GET['term']);
        return $this->stock->brand($search);
    }
}