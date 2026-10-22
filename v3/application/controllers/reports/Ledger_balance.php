<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class Ledger_balance extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('reports/Ledger_balance_model', 'ledger');
    }
	
	public function new_ajax_list()
    {
		$this->ledger->new_ajax_list();
        $list = $this->ledger->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		foreach ($list as $vouchers) {
            $no++;
			$row = array();
            $row[] = $no;
            $row[] = $vouchers->name;
			$row[] = $vouchers->credit_period;
            $row[] = $vouchers->credit_amount;
            $row[] = $vouchers->customer_balance;
            $row[] = $vouchers->first;
			$row[] = $vouchers->second;
			$row[] = $vouchers->third;
			$row[] = $vouchers->fourth;
			$row[] = $vouchers->fifth;
			$row[] = $vouchers->sixth;
			$row[] = $vouchers->seventh;
            $data[] = $row;
		}
		
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledger->count_all()+1,
            "recordsFiltered" => $this->ledger->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
       
	}
	
	function bill_receivable(){
		$data['title'] = 'Bill Due Report';
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/ledger_balance/bill_receivable',$data);
	}
	public function bill_receivable_list(){
		$this->ledger->receivable_list();
        $list = $this->ledger->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->invoice_date;
            $row[] = $items->invoice;
            $row[] = $items->name;
            $row[] = $items->balance;
            $row[] = $items->due_date;
            $row[] = $items->day;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledger->count_all(),
            "recordsFiltered" => $this->ledger->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
	}
	
	
	function Ledger_transaction($acc_main_id){
		$data['title'] = 'Supplier Ledger Transaction Report';
		if( (float) $acc_main_id > 24 ){
		 	 $data['title'] = 'Customer Ledger Transaction Report';
		}
		$data['acc_main_id'] =  $acc_main_id;
		$this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/ledger_balance/ledger_transaction', $data);
	}
	
	
	function period_ledger_balance()
    {
        $data['title'] = 'Agewise Debtors Report'; 
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/ledger_balance/period_ledger_balance', $data);
    }

    function ledger_balance($type)
    {
        $data['title'] = 'Ledger Balance Report Customer';
        $data['type'] = $type;
		$data['led_type'] = 'cus';
        if ($type == "sup") {
            $data['title'] = 'Ledger Balance Report Supplier';
			$data['led_type'] = 'sup';
        }
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/ledger_balance/ledger_balance', $data);
    }
	
	public function transaction_list()
    {
		$this->ledger->transaction_list();
        $list = $this->ledger->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$debit = $credit = 0;
		foreach ($list as $vouchers) {
			if((float) $vouchers->balance < 0  ){
				$balance = ((float) $vouchers->balance * -1 ). ' CR';
			}else{
				$balance = (float) $vouchers->balance . 'DR';
			}
            $no++;
			$debit = (float) $debit + (float) $vouchers->debit;
			$credit = (float) $credit + (float) $vouchers->credit;
			$row = array();
            $row[] = $no;
            $row[] =  ' <a  onclick="showledger('.$vouchers->supledgerid.','."'".$vouchers->name."'".')">'.$vouchers->name.'</a>';
            $row[] = $vouchers->debit;
            $row[] = $vouchers->credit;
            $row[] = $balance;
            $data[] = $row;
		}
		$row = array();
			$row[] = '';
            $row[] = 'Totals';
            $row[] = $debit;
            $row[] = $credit;
			$balance = (float) $debit - (float) $credit;
			if($balance < 0 ){
				$row[] = ($balance*-1).'CR';
			}else{
				$row[] = $balance.'DR';
			}
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledger->count_all()+1,
            "recordsFiltered" => $this->ledger->count_filtered()+1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
       
	}

    public function ajax_list()
    {
        $this->ledger->where();
        $list = $this->ledger->get_datatables();
        $data = array();
        $total = $debit = $credit = $openning_bal = 0;
        $totalss = $debitss = $creditss = $openning_balss = $cl_balance = 0;
		$type = $this->input->post('type');
        $text = '';
        if($this->input->post('customer_type') ){
			$text = " and customer_type = ".$this->input->post('customer_type');
		}

        $qry = "select IFNULL(credit,0) as credit,IFNULL(debit,0) as debit,b.type,b.id,IFNULL(d.bal,0) as tran_amt ,IFNULL(d.bal,0) as Closing_balance,a.name,IFNULL(b.openning_bal,0) as openning_bal,phone from (select * from suppliers where 1 $text)  as a inner join acc_ledgers as b on a.id=b.ref_id and b.ref_code in('".$type."') left join (select sum(c.tran_debit) as debit,sum(c.tran_credit) as credit,sum(c.tran_debit)-sum(c.tran_credit) as bal,c.ledger_id from acc_ledger_trans as c where c.published='yes'  and c.tran_date<='".$this->ledger->getDate($this->input->post('date'))."' GROUP by c.ledger_id ) as d on d.ledger_id=b.id  order by a.id asc";
        $getTotal = $this->db->query($qry)->result_array();
        foreach ($getTotal as $totz) {
            if ($totz['type'] == "Cr") {
                $totz['credit'] = $totz['credit'] + $totz['openning_bal'];
                $totz['Closing_balance'] = $totz['Closing_balance'] - $totz['openning_bal'];
            } else {
                $totz['debit'] = $totz['debit'] + $totz['openning_bal'];
                $totz['Closing_balance'] = $totz['Closing_balance'] - $totz['openning_bal'];
            }
            if ($totz['tran_amt'] < 0) {
                $totz['tran_amt'] = $totz['tran_amt'] * -1;
            }
            if ($totz['Closing_balance'] < 0) {
                $totz['Closing_balance'] = $totz['Closing_balance'] * -1;
                $ctype = 'Cr';
            } else if ($totz['Closing_balance'] > 0) {
                $ctype = 'Dr';
            }
            $totalss = $totalss + $totz['debit'] - $totz['credit'];
            $totalss = abs($totalss);
            $debitss = $debitss + $totz['debit'];
            $creditss = $creditss + $totz['credit'];
            $openning_balss = $openning_balss + $totz['openning_bal'];
            $close_bal_typess = 'Dr';
            if ($totalss < 0) {
                $totalss = $totalss * -1;
                $close_bal_typess = 'Cr';
            }
			}
        // print_r($totalss);
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $ctype = $vouchers->type;
			$my_debit =  $vouchers->debit ;
			$my_credit =  $vouchers->credit ;
            if (ucfirst($ctype) == "Cr") {
                $vouchers->credit = $vouchers->credit + $vouchers->openning_bal;
                $vouchers->Closing_balance = $vouchers->Closing_balance - $vouchers->openning_bal;
            } else {
                $vouchers->debit = $vouchers->debit + $vouchers->openning_bal;
                $vouchers->Closing_balance = $vouchers->Closing_balance + $vouchers->openning_bal;
            }
            if ($vouchers->tran_amt < 0) {
                $vouchers->tran_amt = $vouchers->tran_amt * -1;
            }
            if ($vouchers->Closing_balance < 0) {
				$cl_balance = (float) $cl_balance - ($vouchers->Closing_balance*-1);
                $vouchers->Closing_balance = $vouchers->Closing_balance * -1;
                $ctype = 'Cr';
            } else if ($vouchers->Closing_balance > 0) {
                $ctype = 'Dr';
				$cl_balance = (float) $cl_balance + (float) $vouchers->Closing_balance;
            }
            $total = $total + $vouchers->debit - $vouchers->credit;
            $debit = $debit + $vouchers->debit;
            $credit = $credit + $vouchers->credit;
            $openning_bal = $openning_bal + $vouchers->openning_bal;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] =  ' <a  onclick="showledger('.$vouchers->ledid.','."'".$vouchers->name."'".')">'.$vouchers->name.'</a>';
            $row[] = $vouchers->route_name;
            $row[] = $vouchers->areaname;
			$row[] = $vouchers->phone;
           // $row[] = $vouchers->openning_bal.$totz['type'];
           $row[] = $vouchers->openning_bal.$vouchers->baltype;
            $row[] = number_format($my_debit,$this->company_roundoff);
            $row[] = number_format($my_credit,$this->company_roundoff);
            $row[] = $vouchers->Closing_balance . $ctype;
            $data[] = $row;
        }
        $close_bal_type = 'Dr';
        if ($total < 0) {
            $total = $total * -1;
            $close_bal_type = 'Cr';
        }
		$txt = '';
		if($this->input->post('area')){
			$txt = ' and s.area = '. $this->input->post('area');
		}
        if($this->input->post('customer_type')){
			$txt = ' and s.customer_type = '. $this->input->post('customer_type');
		}
		$qry = "select al.type,sum(case when al.type ='Dr' then al.openning_bal else 0 end) - sum(case when al.type ='Cr' then al.openning_bal else 0 end)  as open,sum(x.debit) as debit,sum(x.credit) as credit,sum(x.debit) - sum(x.credit) as balance from suppliers as s INNER JOIN acc_ledgers as al on al.ref_id =s.id and al.ref_code in ('".$type."') ".$txt." left JOIN (SELECT alt.ledger_id,sum(alt.tran_debit) as debit,sum(alt.tran_credit) as credit FROM acc_ledger_trans as alt where alt.published ='yes' and tran_date <= '".$this->ledger->getDate($this->input->post('date'))."' GROUP by alt.ledger_id ) as x on  x.ledger_id =al.id";
        $query = $this->db->query($qry)->row_array();
		if((float) $cl_balance < 0 ){
			$cl_balance_lbl = ($cl_balance*-1).'Cr';
		}else{
			$cl_balance_lbl = $cl_balance. 'Dr';
		}
		$closing = $query['balance'];
		$closing = (float) $closing + (float) $query['open'];
		if( (float) $closing < 0){
			$cl_balance_lbl  = ($closing *-1).'Cr';
		}else{
			$cl_balance_lbl = $closing.'Dr';
		}
		$row = array();
        $row[] = '';
        $row[] = '';
		 $row[] = '';
        $row[] = '';
        $row[] = '<b>Totals</b>';
        $row[] = '<b>' . number_format($query['open'],$this->company_roundoff) . '</b>';
        $row[] = '<b>' . number_format($query['debit'],$this->company_roundoff) . '</b>';
        $row[] = '<b>' . number_format($query['credit'],$this->company_roundoff) . '</b>';
        $row[] = '<b>' . $cl_balance_lbl . '</b>';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->ledger->count_all(),
            "recordsFiltered" => $this->ledger->count_filtered(),
            "total" => $totalss,
            "debit" => $debitss,
            "credit" => $creditss,
            "openning_bal" => $openning_balss,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
