<?php
class New_Purchase_report  extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/New_Purchase_report_model','purchase');
    }
	
	public function purchase()
    {
		$qry = "select * from taxgst order by GST*1 asc";
		$tax_array = $this->db->query($qry)->result_array();
		$data['tax_array'] = $tax_array;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Purchase Voucher Report';
        $this->load->view('reports/new_purchase_report/purchasetax', $data);
    }
	
	public function purchase_ajax_list(){
		$qry = "select * from taxgst order by GST*1 asc";
		$tax_array = $this->db->query($qry)->result_array();
        $this->purchase->purchasetax();
		$list = $this->purchase->get_datatables();
		$company = $this->purchase->getCompany();
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
            $row[] = $item->invoice;
            $row[] = $item->in_date;
			$row[] = $item->tin;
            $row[] = $item->customer;
			foreach($tax_array as $items){
				$txt = 'taxable'.$items['gstid']; 
				$taxtxt = 'tax'.$items['gstid'];
				$txtcess = 'cess'.$items['gstid'];
				
				$pltaxable = 'pltaxable'.$items['gstid']; 
				$pltax = 'pltax'.$items['gstid'];
				$ledger_taxable = (float) $item->$pltaxable;
				if($ledger_taxable == null || $ledger_taxable == '' || $ledger_taxable == 'null'){
					$ledger_taxable = 0;
				}
				$ledger_tax = (float) $item->$pltax;
				if($ledger_tax == null || $ledger_tax == '' || $ledger_tax == 'null'){
					$ledger_tax = 0;
				}
				
				
				if($cust_state == $com_state){
					$taxable = $item->$txt;
					if((float) $ledger_taxable > 0  ){
						$taxable = (float) $taxable + (float) $ledger_taxable;
					}
					$taxable_igst = 0 ;
					$cgst = 0;
					$sgst = 0 ;
					if((float) $item->$taxtxt > 0 ){
						$cgst = $item->$taxtxt/ 2;
						$sgst =  $item->$taxtxt/ 2;
					}
					if((float) $ledger_tax > 0  ){
						$cgst = (float) $cgst + (float) $ledger_tax/2;
						$sgst = (float) $sgst + (float) $ledger_tax/2;
					}
					$igst = 0 ;
					$cess = $item->$txtcess;
					$cess_igst = 0; 
				}else{
					$taxable = 0;
					$taxable_igst = $item->$txt;
					if((float) $ledger_taxable > 0  ){
						$taxable_igst = (float) $taxable_igst + (float) $ledger_taxable;
					}
					$cgst = 0;
					$sgst = 0 ;
					$igst = $item->$taxtxt;
					if((float) $ledger_tax > 0  ){
						$igst = (float) $igst + (float) $ledger_tax;
					}
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
					$row[] = (float) $taxable_igst + (float) $taxable ;
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
            "recordsTotal" => $this->purchase->count_all(),
            "recordsFiltered" => $this->purchase->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
		
	}
	
	
	
	
    public function listall()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['titles'] = 'Inventory Purchase Report';
        $this->load->view('reports/new_purchase_report/listall',$data);
    }
    public function ajax_list()
    {
        $this->purchase->where();
        $list = $this->purchase->get_datatables();
        $data = array();
		$company = $this->purchase->getCompany();
		$com_state = substr($company['tin'],0,2);
        foreach ($list as $item) {
		
			$cust_state = $item->custstate;
			$cust_state  = substr($cust_state,0,2);
			if($cust_state == '' ){
				$cust_state  = $com_state;
			}else if( (float) $cust_state < 1 ){
				$cust_state  = $com_state;
			}
			
			
			$tot = $item->tot;
			if($tot == null || $tot == 'null' || $tot == "" || $tot == '' ){
				$tot = 0 ;
			}
			if((float) $tot > 0  ){
				$row = array();
				$row[] = $item->bill_no;
				$row[] = $item->date;
				$row[] = $item->invoice;
				$row[] = $item->date;
				$row[] = $item->supplier;
				$row[] = $item->name;
				//$row[] = $item->part_no;
				$row[] = $item->hsn;
				$row[] = $item->quantity;
				$row[] =	number_format(round($item->prate,$this->company_roundoff),$this->company_roundoff);
			 //   $row[] = $item->discount;
				$row[] = $item->amount;
				$row[] = "";
				$row[] = "";
				$row[] = "";
				if($cust_state == $com_state){
					$row[] =	number_format(round($item->sgst,$this->company_roundoff),$this->company_roundoff);
					$row[] =	number_format(round($item->sgst,$this->company_roundoff),$this->company_roundoff);
					$row[] = "0";
				}else{
					$row[] = "0";
					$row[] = "0";
					$row[] =	number_format(round($item->sgst +  $item->sgst,$this->company_roundoff),$this->company_roundoff);
				}
				$row[] = $item->tot;
				$row[] = $item->GST;
				$row[] = $item->txt;
				$row[] = "CGST";
				$row[] = "SGST";
				$row[] = "IGST";
				//$row[] = 0;
			  //  $row[] = $item->address_line1;
			   // $row[] = $item->address_line1;
				$row[] = "India";
				$row[] = $item->place;
				$row[] = $item->btype;
				$row[] = $item->unitname;
				$row[] = $item->tin;
				$row[] = '';
				$row[] = $item->itm_raw_ces;
				$row[] = $item->ces_name;
			  //  $row[] =	number_format(round($item->dis_amt,$this->company_roundoff),$this->company_roundoff);
			  
				$data[] = $row;
			}
			
			$plgst = $item->plgst;
			if($plgst == null || $plgst == 'null' || $plgst == "" || $plgst == '' ){
				$plgst = '';
			}
			$plgst = explode(",",$plgst);
			
			
			$pltax = $item->pltax;
			$chkpltax = $item->pltax;
			if($pltax == null || $pltax == 'null' || $pltax == "" || $pltax == '' ){
				$pltax = '';
				$chkpltax = '';
			}
			$pltax = explode(",",$pltax);
			
			$pltaxable = $item->pltaxable;
			if($pltaxable == null || $pltaxable == 'null' || $pltaxable == "" || $pltaxable == '' ){
				$pltaxable = '';
			}
			$pltaxable = explode(",",$pltaxable);
			
			$plitem = $item->plitem;
			if($plitem == null || $plitem == 'null' || $plitem == "" || $plitem == '' ){
				$plitem = '';
			}
			$plitem = explode(",",$plitem);
			
			$pltot = $item->pltot;
			if($pltot == null || $pltot == 'null' || $pltot == "" || $pltot == '' ){
				$pltot = '';
			}
			$pltot = explode(",",$pltot);
			
			
			$len = sizeof($pltax);
			if($chkpltax != '' ){
			for($i = 0 ;$i<$len ;$i++ ){
			
				$tax = $pltax[$i];
				$sgst = 0;
				if((float)$tax  > 0  ){
					$sgst = (float) $tax/2;
				}
				$row = array();
				$row[] = $item->bill_no;
				$row[] = $item->date;
				$row[] = $item->invoice;
				$row[] = $item->date;
				$row[] = $item->supplier;
				$row[] = $plitem [$i];
				$row[] = '';
				$row[] = '';
				$row[] = 1;
				$row[] =	number_format(round($pltaxable[$i],$this->company_roundoff),$this->company_roundoff);
			 //   $row[] = $item->discount;
				$row[] = $pltaxable[$i];
				$row[] = "";
				$row[] = "";
				$row[] = "";
				$row[] =	number_format(round($sgst,$this->company_roundoff),$this->company_roundoff);
				$row[] =	number_format(round($sgst,$this->company_roundoff),$this->company_roundoff);
				$row[] = "0";
				$row[] = $plgst[$i];
				$row[] = $pltot[$i];
				$row[] = 'Purchase @'.$plgst[$i].'%';
				$row[] = "";
				$row[] = "";
				$row[] = "";
				//$row[] = 0;
			  //  $row[] = $item->address_line1;
			   // $row[] = $item->address_line1;
				$row[] = "India";
				$row[] = $item->place;
				$row[] = $item->type;
				$row[] = $item->unitname;
				$row[] = $item->tin;
				$row[] = '';
				$row[] = $item->itm_raw_ces;
				$row[] = $item->ces_name;
			  //  $row[] =	number_format(round($item->dis_amt,$this->company_roundoff),$this->company_roundoff);
			  
				$data[] = $row;
			}
		}
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->purchase->count_all(),
            "recordsFiltered" => $this->purchase->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
    public function suppliers($type='')
    {
        $search = strtolower($_GET['term']);
        return $this->purchase->suppliers($search,$type);
    }
}