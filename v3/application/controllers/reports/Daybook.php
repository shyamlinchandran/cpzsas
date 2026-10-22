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
class Daybook extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Daybook_model', 'daybook');
    }
	var $dbit = 0.0;
    var $credit = 0.0;
    var $balance = 0.0;

    public function getsales($id) {
        return $this->daybook->getsales($id);
    }

    public function getpurchase($id) {
        return $this->daybook->getpurchase($id);
    }
	public function getopening($id) {
        return $this->daybook->getopening($id);
    }
	
	public function daybook_custome() {
		$data['title'] = 'Bill type summary report'; 
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/daybook/daybook_custome');
    }
	

    function Daybook() {
        $data['settings'] = $this->daybook->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/daybook/daybook', $data);
    }

    public function getdaybalance($id=0) {
        return $this->daybook->getdaybalance($id);
    }
	
	
	public function Branch_analysis(){
		$data['settings'] = $this->daybook->getCompanySettings();
        $data['title'] = "Branch Analysis Report";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/daybook/branch_analysis', $data);
	}
    function Day_Report() {
        $data['settings'] = $this->daybook->getCompanySettings();
        $data['title'] = "Day Report";
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/daybook/day_report', $data);
    }
	
	public function getMainLedegerbalance($date, $id, $type) {
        log_message('error', 'Some variable did not contain a value.');
        $amt = $this->daybook->getLedegerbalance($date, $id, $type);
        $openning_bal = $this->daybook->getLedbyId($id);
//        $amt = $amt + $openning_bal;
        if ($amt >= 0) {
            $this->dbit = $amt;
            $this->credit = 0;
        } else {
            $this->dbit = 0;
            $this->credit = $amt * -1;
        }
    }

    function Daybook_List() {
        $data['settings'] = $this->daybook->getCompanySettings();
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/daybook/daybook_list', $data);
    }
	
	public function getbranchanalysis(){
		return $this->daybook->getbranchanalysis();
	}
	
	public function customize_daybook_list(){
		$consol = $this->input->post('consol');
        if ($consol == 'true') {
            $this->daybook->daybook_console();
        } else {
            $this->daybook->daybook();
        }

        $list = $this->daybook->get_datatables();
        $toid = $this->daybook->cashaccount;
        $this->loadajax($list, $toid, 'daybook-' . $consol);
	}
	
	private function loadajax($list, $toid, $type = '') {
        $this->getMainLedegerbalance($this->input->post('startdate'), $toid, 'op');
        $data = array();
        $no = $this->input->post('start');
        $crdt = 0;
        $dbt = 0;
        $opcr = 0;
        $opdr = 0;
        if (!$this->input->post('op_balance')) {
            $opcr = $this->credit;
            $opdr = $this->dbit;
            //if ($type == 'daybook') {
            // $opdr = $this->credit;
            // $opcr = $this->dbit;
            //}
            $row = array();
            if ($type != 'con') {
                $row[] = '';
            }
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = 'Opening Balance';
            $row[] = number_format((float) $opdr,$this->company_roundoff, '.', '');
            $row[] = number_format((float) $opcr,$this->company_roundoff, '.', '');
            $data[] = $row;
        }

        //print_r($list);
        //exit;
		$txt = '';
		if ($this->input->post('startdate')) {
			$txt = ' and alt.tran_date >="' . $this->daybook->getDate($this->input->post('startdate')) . '"';
		}
		if ($this->input->post('enddate')) {
			$txt = $txt .' and alt.tran_date <="' . $this->daybook->getDate($this->input->post('enddate')) . '"';
		}
		$qry = "SELECT sum(tran_debit) as debit,sum(tran_credit) as credit,sb.type FROM acc_ledger_trans as alt INNER JOIN sales as s on s.sales_id = alt.tb_id and alt.trn_tp = 'sales' and alt.published ='yes' ".$txt." INNER JOIN acc_ledgers as al on al.id = alt.ledger_id and al.acc_main_id != 4 INNER JOIN set_billtype as sb on sb.id = s.bill_type GROUP by s.bill_type";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->result_array();
			foreach($query  as $item){
				$row = array();
				$crdt = (float)  $crdt + (float) $item['debit'];
				$dbt = (float)  $dbt + (float) $item['credit'];
				$row[] = '';
				$row[] = $item['type'];
				$row[] = $item['type'];
				$row[] = '';
				$row[] = '';
				$row[] = $item['credit'];
				$row[] =  $item['debit'];
				$data[] = $row;
				
				
			}
		}
        foreach ($list as $members) {
            if ($members->tran_credit == '0.00' && $members->tran_debit == '0.00') {
                
            } else {
                $row = array();
                $row[] = $members->in_date;
                if ($type == '') {
                    $row[] = $members->ledname;
                } else {
                    $row[] = $members->ledger_name;
                }

                $row[] = $members->trn_tp;
                $row[] = $this->daybook->get_url($members->tb_id, $members->voucher_no, $members->trn_tp);
                $row[] = $members->tran_narration;

                if ($type == '') {
                    $row[] = $members->tran_debit;
                    $row[] = $members->tran_credit;
                    $crdt = $crdt + $members->tran_credit;
                    $dbt = $dbt + $members->tran_debit;
                } else {
                    $row[] = $members->tran_credit;
                    $row[] = $members->tran_debit;
                    $crdt = $crdt + $members->tran_debit;
                    $dbt = $dbt + $members->tran_credit;
                }

                $data[] = $row;
                // = $this->addrow($members->trn_tp, $members->tran_narration . ' ', $members->tran_credit, '', $members->tran_debit);
                $no++;
            }
        }
        $this->getMainLedegerbalance($this->input->post('enddate'), $toid, 'cl');
        $row = array();
        $cldr = $this->number_fm($dbt + $opdr);
        $clcr = $this->number_fm($crdt + $opcr);
        if ($type != 'con') {
            $row[] = '';
        }
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total ';
		
        $row[] = number_format((float) $dbt	,$this->company_roundoff, '.', '');
        $row[] = number_format((float) $clcr,$this->company_roundoff, '.', '');
        $data[] = $row;
        if (!$this->input->post('op_balance')) {
            $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = 'Closing Balance';
            $row[] = number_format((float) $this->dbit,$this->company_roundoff, '.', '');
            $row[] = number_format((float) $this->credit,$this->company_roundoff, '.', '');
            $data[] = $row;
        }
        $amt_bal = (float) $cldr - (float) $clcr;
        $amtdr = 0;
        $amtcr = 0;
        if ($amt_bal > 0) {
            $amtdr = $amt_bal;
            $amtcr = 0;
        } else if ($amt_bal < 0) {
            $amtdr = 0;
            $amtcr = $amt_bal * -1;
        }
        if ($this->input->post('op_balance')) {
            $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = 'Closing Balance';
            $row[] = number_format((float) $amtdr,$this->company_roundoff, '.', '');
            $row[] = number_format((float) $amtcr,$this->company_roundoff, '.', '');
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->daybook->count_all() + 1,
            "recordsFiltered" => $this->daybook->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function day_list() {
        $this->daybook->getallvochers();
        $list = $this->daybook->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        $grandtotal = 0;
        foreach ($list as $vouchers) {
            $no++;
            if ($vouchers->trn_tp == "sales" || $vouchers->trn_tp == "purchase_return" || $vouchers->trn_tp == "receipt") {
                $total = $total + $vouchers->total;
            } else {
                $total = $total - $vouchers->total;
            }
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->trn_tp;
//            $row[] = '';
//            $row[] = '';
//            $row[] = '';
            $row[] = number_format($vouchers->total,$this->company_roundoff);
            $data[] = $row;
        }
        $row = array();
        $no++;
        $row[] = $no;
        $row[] = '<b>Total</b>';
//            $row[] = '';
//            $row[] = '';
//            $row[] = '';
        $row[] = '<b>' . number_format($total,$this->company_roundoff) . '</b>';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $no,
            "recordsFiltered" => $no,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list() {
        $this->daybook->wherecondition();
        $list = $this->daybook->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $total = 0;
        $grandtotal = 0;
        foreach ($list as $vouchers) {
            if (ucfirst($vouchers->saletype) == "Sales") {
                $total = $total + $vouchers->total;
            } else {
                $total = $total - $vouchers->total;
            }
            $no++;
			$url = ucfirst(str_replace('_', ' ', $vouchers->saletype));
			if($url ==='Sales'){
				$url = '<a onclik ="showledger('. "'".'sales'."'".') >'.ucfirst(str_replace('_', ' ', $vouchers->saletype)).'</a>';
				$url = '<a >'.ucfirst(str_replace('_', ' ', $vouchers->saletype)).'</a>';
				$url = ' <a  onclick="showledger('."'".ucfirst(str_replace('_', ' ', $vouchers->saletype))."'".')">'.ucfirst(str_replace('_', ' ', $vouchers->saletype)).'</a>';
			}
			if($url == 'Sales return'){
				$url = ' <a  onclick="showledger('."'".ucfirst(str_replace('_', ' ', $vouchers->saletype))."'".')">'.ucfirst(str_replace('_', ' ', $vouchers->saletype)).'</a>';
			}
            $row = array();
            $row[] = $no;
            $row[] = $url;
            $row[] = number_format($vouchers->cash,$this->company_roundoff);
            $row[] = number_format($vouchers->bank,$this->company_roundoff);
            $row[] = number_format($vouchers->credit,$this->company_roundoff);
            $row[] = number_format($vouchers->total,$this->company_roundoff);
            $data[] = $row;
        }
        $this->daybook->where();
        $list = $this->daybook->get_datatables();
        foreach ($list as $vouchers) {
            if ($vouchers->type == "purchase_return") {
                $total = $total + $vouchers->credit + $vouchers->cash;
            } else {
                $total = $total - ($vouchers->credit + $vouchers->cash);
            }
			$url = ' <a  onclick="showledger('."'".ucfirst(str_replace('_', ' ', $vouchers->type))."'".')">'.ucfirst(str_replace('_', ' ', $vouchers->type)).'</a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $url;
            $row[] = number_format($vouchers->cash,$this->company_roundoff);
            $row[] = '';
            $row[] = number_format($vouchers->credit,$this->company_roundoff);
            $row[] = number_format($vouchers->credit + $vouchers->cash,$this->company_roundoff);
            $data[] = $row;
        }
        $this->daybook->getvouchers();
        $list = $this->daybook->get_datatables();
        foreach ($list as $vouchers) {
            if ($vouchers->trn_tp == "receipt") {
                $total = $total + $vouchers->cash;
				$url = ' <a  onclick="showledger('."'".ucfirst(str_replace('_', ' ', $vouchers->trn_tp))."'".')">'.ucfirst(str_replace('_', ' ', $vouchers->trn_tp)).'</a>';
				
            } else {
                $total = $total - $vouchers->cash;
				$url = ' <a  onclick="showledger('."'".ucfirst(str_replace('_', ' ', $vouchers->trn_tp))."'".')">'.ucfirst(str_replace('_', ' ', $vouchers->trn_tp)).'</a>';
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $url;
            $row[] = number_format($vouchers->cash,$this->company_roundoff);
            $row[] = '';
            $row[] = '';
            $row[] = number_format($vouchers->cash,$this->company_roundoff);
            $data[] = $row;
        }
        $this->daybook->getcheque();
        $list = $this->daybook->get_datatables();
        foreach ($list as $vouchers) {
            if ($vouchers->chq_trans == "Clearing") {
                $total = $total + $vouchers->bank;
            } else {
                $total = $total - $vouchers->bank;
            }
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = 'Cheque ' . $vouchers->chq_trans;
            $row[] = '';
            $row[] = number_format($vouchers->bank,$this->company_roundoff);
            $row[] = '';
            $row[] = number_format($vouchers->bank,$this->company_roundoff);
            $data[] = $row;
        }
        $no++;
        $row = array();
        $row[] = '';
        $row[] = '<b>Total</b>';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>' . number_format($total,$this->company_roundoff) . '</b>';
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => 6,
            "recordsFiltered" => 6,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
