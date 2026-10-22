<?php
class MIS extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/MIS_model','mis');

    }
    public function Monthly_summary()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['title'] = 'Monthly Summary Report';
        $this->load->view('reports/mis/monthly_summary',$data);
    }
	
	public function route_summary(){
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['title'] = 'User wise Activity Report';
        $this->load->view('reports/mis/route_summary',$data);
	}
	
	 public function agent_summary()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        $data['title'] = ' Summary Report';
        $this->load->view('reports/mis/agent_summary',$data);
    }
	
	public function agent_list() {
		$this->mis->agent_list();
        $list = $this->mis->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$salestotal = $cashsale = $creditsale = $ordertotal = $returntotal = $pay_amount = $rec_amount = $banktotal = 0;
        foreach ($list as $vouchers) {
			$type = '';
			$id = '';
			$salestotal = (float) $salestotal + (float)$vouchers->salestotal;
			$cashsale = (float) $cashsale + (float)$vouchers->cashsale;
			$creditsale = (float) $creditsale + (float)$vouchers->creditsale;
			$ordertotal = (float) $ordertotal + (float)$vouchers->ordertotal;
			$returntotal = (float) $returntotal + (float)$vouchers->returntotal;
			$banktotal = (float) $banktotal + (float)$vouchers->banktotal;
			//$pay_amount = (float) $pay_amount + (float)$vouchers->pay_amount;
			$rec_amount = (float) $rec_amount + (float)$vouchers->rec_amount;
            $no++;
            $row = array();
            $row[] = $no;
			if($this->input->post('selfilter') == 'agent' ){
				$row[] = $vouchers->agent;
				$type = 'agent';
				$id = $vouchers->ref_id;
			}else{
				$row[] = $vouchers->user_name;
				$type = 'salesman';
				$id = $vouchers->salesmanid;
			}
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'"   attrtype="sales" user="'.$id.'" >'.$vouchers->salestotal.'</a>';
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'" attrtype="cashsales" user="'.$id.'" >'.$vouchers->cashsale.'</a>';
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'" attrtype="banksales" user="'.$id.'" >'.$vouchers->banktotal.'</a>';
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'" attrtype="creditsales" user="'.$id.'" >'.$vouchers->creditsale.'</a>';
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'" attrtype="estimate" user="'.$id.'" >'.$vouchers->ordertotal.'</a>';
            $row[] = '<a href="#" class="showreport" filter= "'.$type.'" attrtype="sales_return" user="'.$id.'" >'.$vouchers->returntotal.'</a>';
            //$row[] = $vouchers->pay_amount;
            $row[] = $vouchers->rec_amount;
			$row[] = (float) $vouchers->rec_amount + (float) $vouchers->cashsale + (float) $vouchers->banktotal;
            $data[] = $row;
        }
		$row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = $salestotal;
            $row[] = $cashsale;
            $row[] = $banktotal;
            $row[] = $creditsale;
            $row[] = $ordertotal;
            $row[] = $returntotal;
           // $row[] = $pay_amount;
            $row[] = $rec_amount;
			$row[] = (float) $rec_amount + (float) $cashsale + (float) $banktotal;
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mis->count_all()+1,
            "recordsFiltered" => $this->mis->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	public function ajax_list() {
        $this->mis->route_summary();
        $list = $this->mis->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$salestotal = $cashsale = $creditsale = $ordertotal = $returntotal = $pay_amount = $rec_amount =0;
        foreach ($list as $vouchers) {
			$salestotal = (float) $salestotal + (float)$vouchers->salestotal;
			$cashsale = (float) $cashsale + (float)$vouchers->cashsale;
			$creditsale = (float) $creditsale + (float)$vouchers->creditsale;
			$ordertotal = (float) $ordertotal + (float)$vouchers->ordertotal;
			$returntotal = (float) $returntotal + (float)$vouchers->returntotal;
			$pay_amount = (float) $pay_amount + (float)$vouchers->pay_amount;
			$rec_amount = (float) $rec_amount + (float)$vouchers->rec_amount;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->user_name;
            $row[] = '<a href="#" class="showreport"   attrtype="sales" user="'.$vouchers->Id.'" >'.$vouchers->salestotal.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="cashsales" user="'.$vouchers->Id.'" >'.$vouchers->cashsale.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="creditsales" user="'.$vouchers->Id.'" >'.$vouchers->creditsale.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="estimate" user="'.$vouchers->Id.'" >'.$vouchers->ordertotal.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="sales_return" user="'.$vouchers->Id.'" >'.$vouchers->returntotal.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="payment" user="'.$vouchers->Id.'" >'.$vouchers->pay_amount.'</a>';
            $row[] = '<a href="#" class="showreport" attrtype="receipt" user="'.$vouchers->Id.'" >'.$vouchers->rec_amount.'</a>';
			$row[] = (float) $vouchers->rec_amount + (float) $vouchers->cashsale;
            $data[] = $row;
        }
		$row = array();
            $row[] = '';
            $row[] = 'Total';
            $row[] = $salestotal;
            $row[] = $cashsale;
            $row[] = $creditsale;
            $row[] = $ordertotal;
            $row[] = $returntotal;
            $row[] = $pay_amount;
            $row[] = $rec_amount;
			$row[] = (float) $rec_amount + (float) $cashsale;
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mis->count_all()+1,
            "recordsFiltered" => $this->mis->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
           

    }
	
		
    public function monthly_list()
    {
        $this->mis->get_monthly_list();
        $list = $this->mis->get_datatables();
        $data = array();
		$no=1;
        foreach($list as $item)
        {	
            $row = array();
            $row[] = $no;
			$row[] = '<a href="#" onclick ="loadreport(this)" start_date = "'.$item ->rpt_start_date.'" end_date= "'.$item ->rpt_end_date.'" tagtype="'.$item ->type.'"  >'.$item ->month.'</a>';
           // $row[] = '<a href="" tagtype="'.$item ->type.'" start_date= "'.$item ->rpt_start_date.'" end_date= "'.$item ->rpt_end_date.'"  >'.$item ->month>.'</a>';
            $row[] = $item ->total;
		if($item ->type == 'sales' || $item ->type == 'sales_return' || $item ->type == 'purchase' || $item ->type == 'purchase_return' ){
				$row[] = $item ->cash_amount;
				$row[] = $item ->bank_amount;
				$row[] = $item ->Credit_amount;
			}
            if($item ->type == 'estimate' || $item ->type == 'order' ){
				$row[] = 'Nil';
				$row[] = 'Nil';
				$row[] = 'Nil';
			}
			if($item ->type == 'payment' || $item ->type == 'receipt' ){
				$row[] = $item ->cash;
				$row[] = $item ->bank;
				$row[] = 'Nil';
			}
			if($item ->type == 4 ||  $item ->type == 24 || $item ->type == 25){
				$row[] = $item ->credit;
				$row[] = $item ->debit;
				if((float) $item ->balance >= 0 ){
					$row[] = $item ->balance.' Dr';
				}else{
					$row[] = (-1*$item ->balance).' Cr';
				}
				
			}
            $no++;
            $data[] =$row;
            
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->mis->count_all(),
            "recordsFiltered" => $this->mis->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
  
}