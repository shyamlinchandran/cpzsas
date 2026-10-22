<?php
class New_Sales_report extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/New_Sales_report_model', 'sales');
    }
    public function listall()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Inventory Sales Report';
        $this->load->view('reports/new_sales_report/listall', $data);
    }
	
	public function sales()
    {
		$qry = "select * from taxgst order by GST*1 asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Sales Voucher Report';
        $this->load->view('reports/new_sales_report/salestax', $data);
    }
	
	public function sales_ajax_list(){
		$qry = "select * from taxgst order by GST*1 asc";
		$tax_array = $this->db->query($qry)->result_array();
        $this->sales->salestax();
		$list = $this->sales->get_datatables();
		$company = $this->sales->getCompany();
		$com_state = substr($company['tin'],0,2);
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
			$cust_state = $item->custstate;
			$cust_state  = substr($cust_state,0,2);
			if($cust_state == '' ){
				$cust_state  = $com_state;
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
			
			$row = array();
           // $row[] = $no;
            $row[] = $item->invoice;
            $row[] = $item->in_date;
			$row[] = $item->tin;
            $row[] = $item->customer;
            //$row[] = '';
			foreach($tax_array as $items){
				$txt = 'taxable'.$items['gstid']; 
				$taxtxt = 'tax'.$items['gstid'];
				$txtcess = 'cess'.$items['gstid'];
				if($cust_state == $com_state){
					$taxable = $item->$txt;
					$taxable_igst = 0 ;
					$cgst = 0;
					$sgst = 0 ;
					if((float) $item->$taxtxt > 0 ){
						$cgst = $item->$taxtxt/ 2;
						$sgst =  $item->$taxtxt/ 2;
					}
					$igst = 0 ;
					$cess = $item->$txtcess;
					$cess_igst = 0; 
				}else{
					$taxable = 0;
					$taxable_igst = $item->$txt;
					$cgst = 0;
					$sgst = 0 ;
					$igst = $item->$taxtxt;
					$cess = 0;
					$cess_igst = $item->$txtcess;
				}
				if((float) $items['GST'] > 0 ) {
					$row[] = $taxable;
					$row[] = $cgst;
					$row[] = $sgst;
					$row[] = $cess;
					$row[] = $taxable_igst;
					$row[] = $igst;
					$row[] = $cess_igst;
				}else{
					$row[] = (float) $taxable + (float) $taxable_igst;
				}
			}
            $row[] = $item->tot;
            $row[] = $item->btype;
            $row[] = $item->place;
			if( $item->tin != '' &&  $item->tin != null){
				$row[] = 'Registered';
			}else{
				$row[] = 'Unregistered';
			}
            $row[] = '';
			
            $data[] = $row;
		}
		$output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all(),
            "recordsFiltered" => $this->sales->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
		
	}
    public function ajax_list()
    {
        $this->sales->where();
        $list = $this->sales->get_datatables();
		$company = $this->sales->getCompany();
		$com_state = substr($company['tin'],0,2);
        $data = array();
        foreach ($list as $item) {
			$cust_state = $item->custstate;
			$cust_state  = substr($cust_state,0,2);
			if($cust_state == '' ){
				$cust_state  = $com_state;
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
            $row = array();
            $row[] = $item->invoice;
            $row[] = $item->invoice_date;
            $row[] = $item->customer;
            $row[] = $item->pincode;
            $row[] = $item->name;
            $row[] = $item->hsn;
			            $row[] = $item->unitname;

            $row[] = $item->quantity;
			//$row[] =	number_format(round($item->itemmrp,$this->company_roundoff),$this->company_roundoff);
            $row[] =	number_format(round($item->Salerate,$this->company_roundoff),$this->company_roundoff);
          //  $row[] = $item->dis;
            $row[] = $item->amount;
           // $row[] = "";
           // $row[] = "sales";
		   $row[] = "0.00";
		   $row[] = "0.00";
		   $row[] = "0.00";
		   if($cust_state == $com_state){
				$row[] =	number_format(round($item->sgst,$this->company_roundoff),$this->company_roundoff);
				$row[] =	number_format(round($item->sgst,$this->company_roundoff),$this->company_roundoff);
				$row[] = "0";
		   }else{
				$row[] = "0";
				$row[] = "0";
				$row[] =	number_format(round($item->sgst +  $item->sgst,$this->company_roundoff),$this->company_roundoff);
		   }
            $row[] = $item->billdis;
            $row[] = $item->roundoff;
            $row[] = $item->total;
            $row[] = $item->taxper;
            $row[] = 'Sales Taxable';
          //  $row[] = $item->address_line1;
           // $row[] = $item->address_line1;
           //$row[] = "";
		    $row[] = 'CGST';
		    $row[] = 'SGST';
			$row[] = 'IGST';
		    $row[] = 'India';
		    $row[] = $item->place;
			$row[] = $item->btype;
		    $row[] = $item->unitname;
            $row[] = $item->tin;
			$row[] = '';
            $row[] = $item->itm_raw_ces;
            $row[] = $item->ces_name;
           // $row[] =	number_format(round($item->dis_amt,$this->company_roundoff),$this->company_roundoff);
            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all(),
            "recordsFiltered" => $this->sales->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function suppliers($type='')
    {
        $search = strtolower($_GET['term']);
        return $this->sales->suppliers($search,$type);
    }
}
