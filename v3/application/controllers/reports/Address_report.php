<?php

class Address_report extends MY_Controller {
        
    function __construct(){
        parent:: __construct();
        $this->load->model('reports/Address_report_model','Addressmodel');
    }

    function index() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('reports/addressreport/Address_report_view');

    }

     function CashCustomerReport() {
        $data['title'] = 'Cash Customer List';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('reports/addressreport/cashcustomer',$data);

    }

    
	public function CashCustomer_list() {
        $this->Addressmodel->CashCustomer();
        $list = $this->Addressmodel->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->cusname;
            $row[] = $vouchers->cusdetails;
            $row[] = $vouchers->cusemail;
            $row[] = number_format($vouchers->cnt,0);
            $row[] = number_format($vouchers->total,$this->company_roundoff);
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Addressmodel->count_all() + 1,
            "recordsFiltered" => $this->Addressmodel->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

	
	 function Reedeem() {
        $data['settings'] = $this->Addressmodel->getCompanySettings();
		$data['title'] = 'Customer Point Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/addressreport/reedeem', $data);
    }
	
	public function reedeem_list() {
        $this->Addressmodel->Reedeem();
        $list = $this->Addressmodel->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
            $row[] = number_format($vouchers->total,$this->company_roundoff);
            $row[] = number_format($vouchers->total_points,$this->company_roundoff);
			$row[] = number_format($vouchers->redeemed_points,$this->company_roundoff);
            $row[] = number_format($vouchers->reedeemable_point,$this->company_roundoff);
            $row[] = number_format($vouchers->reedeemable,$this->company_roundoff);
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Addressmodel->count_all() + 1,
            "recordsFiltered" => $this->Addressmodel->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
    public function reportfetch()
    {   
    
        $this->Addressmodel->where();
        $list = $this->Addressmodel->get_datatables();
      
        $data = array();
        $row = array();

        $no = $this->input->post('start');
        $total = 0;
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->name;
            $row[] = $items->tin;
            $row[] = $items->phone;
            $row[] = $items->email;
			$row[] = $items->contact_person;
            $row[] = $items->contact_number;
            $row[] = $items->address_line1;
            $row[] = $items->bank;
			$row[] = $items->account_no;
            $row[] = $items->ifsc_code;
            $row[] = $items->area;
            $row[] = $items->route_name;

            $row[] = $items->StateName;
			$row[] = $items->credit_period;
            $row[] = $items->credit_amount;
            $row[] = $items->details;
            $data[] = $row;
        }
        
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Addressmodel->count_all(),
            "recordsFiltered" => $this->Addressmodel->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function searcharea()
    {
        $q = strtolower($_GET['term']);
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
        }
        if (isset($_POST['term'])) {
            $q = strtolower($_POST['term']);
        }
        $this->Addressmodel->getautocomplete_area($q);
    }

    public function searchstate()
    {
        $q = strtolower($_GET['term']);
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
        }
        if (isset($_POST['term'])) {
            $q = strtolower($_POST['term']);
        }
        $this->Addressmodel->getautocomplete_state($q);
    }
}
?>