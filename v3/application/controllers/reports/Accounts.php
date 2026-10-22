<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accounts
 *
 * @author u43255
 */
class Accounts extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('accounts_model', 'accounts');
    }

    var $dbit = 0.0;
    var $credit = 0.0;
    var $balance = 0.0;
	public function profitandlossconsole(){
		 return $this->accounts->profitandlossconsole();
	}
    public function getMainledger() {
        $id = strtolower($_GET['term']);
        return $this->accounts->getautocomplete($id);
    }

    public function getLedegerbalance($date, $id, $type) {
        log_message('error', 'Some variable did not contain a value.');
        $i = 1;
        $amt = $this->accounts->getLedegerbalance($date, $id, $type, $i);
        $type = $this->accounts->gettypebyid($id);
        if ($type == 'Cr') {
            $this->credit = $amt;
            $this->dbit = 0;
            $this->balance = $amt . 'Cr';
            if ($amt < 0) {
                $this->credit = 0;
                $this->dbit = $amt * -1;
                $this->balance = ($amt * -1) . 'Dr';
            }
        } else {
            $this->credit = 0;
            $this->dbit = $amt;
            $this->balance = $amt . 'Dr';
            if ($amt < 0) {
                $this->credit = $amt * -1;
                $this->dbit = 0;
                $this->balance = ($amt * -1) . 'Cr';
            }
        }
    }

    public function getMainLedegerbalance($date, $id, $type,$cas = 0) {
        log_message('error', 'Some variable did not contain a value.');
        $amt = $this->accounts->getLedegerbalance($date, $id, $type,0,$cas);
        $openning_bal = $this->accounts->getLedbyId($id);
//        $amt = $amt + $openning_bal;
        if ($amt >= 0) {
            $this->dbit = $amt;
            $this->credit = 0;
        } else {
            $this->dbit = 0;
            $this->credit = $amt * -1;
        }
    }

    public function sm() {
        $this->accounts->profitlos('', '');
    }

    public function leadger($id = 0, $main = 0, $ledger_name = '') {
        $ledger_name = urldecode($ledger_name);
        $data['id'] = 0;
        $data['main'] = $main;
        $data['ledger_name'] = $ledger_name;
        if ((float) $id > 0) {
            $qry = "select * from acc_ledgers where id=" . $id;
            $query = $this->db->query($qry)->row_array();
            $data['details'] = $query;
        }
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/leadger', $data);
    }

    public function mainLeadger($id = 0) {
        $data['id'] = 0;
        if ((float) $id > 0) {
            $qry = "select * from acc_ledgers where id=" . $id;
            $query = $this->db->query($qry)->row_array();
            $data['details'] = $query;
        }
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/mainleadger', $data);
    }

    public function balancesheet() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['res'] = $this->accounts->profitlos('', '');
        $this->load->view('reports/accounts/balancesheet', $data);
    }

    public function trialbalance() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/trialbalance');
    }

    public function cashbook() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/cashbook');
    }

    public function trail_ajax_list() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['details'] = $this->accounts->trail_balance_list();
        $this->load->view('reports/accounts/trail_balance_detailed', $data);
    }

    public function profitandlossdaywise() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['res'] = $this->accounts->profitlos('', '');
        $this->load->view('reports/accounts/profitandlossdaywise', $data);
    }

    public function profitandloss() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $data['res'] = $this->accounts->profitlos('', '');
        $this->load->view('reports/accounts/profitandloss', $data);
    }

    public function profitandlossd() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
		$result = $this->accounts->profitlosd();
        $data['res'] = $result['response'];
		$data['result'] = $result['result'];
        $this->load->view('reports/accounts/profitandlossdet', $data);
    }

    public function daybook() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/daybook');
    }

    public function trial() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/trial');
    }

    public function checklist() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/accounts/checklist');
    }

    // add rows to datatable 
    private function addrow($no, $date, $narration, $dbit, $cdit) {
        $row = array();
        $row[] = '';
        $row[] = $date;
        $row[] = '';
        $row[] = '';
        $row[] = $narration;
        $row[] = $dbit;
        $row[] = $cdit;
        $row[] = '';
        return $row;
    }

    private function addrowt($no, $date, $dbit, $cdit) {
        $row = array();
        $row[] = $no;
        $row[] = $date;
        $row[] = $dbit;
        $row[] = $cdit;
        return $row;
    }

    public function cashbook_list() {
        $this->accounts->cashbook();
        $list = $this->accounts->get_datatables();
        $toid = $this->accounts->cashaccount;
        if($this->input->post('branch') ){
            $qry = "SELECT DISTINCT cash from set_billtype WHERE transaction ='sales' and branch_id = '".$this->input->post('branch')."' and cash != 0";
            $da = $this->db->query($qry);
            if($da->num_rows() > 0 ){
                $da = $da->row_array();
                $toid = $da['cash'];
            }
        }
        $this->loadajax($list, $toid,'',1);
    }

    public function daybook_list() {
        $consol = $this->input->post('consol');
        if ($consol == 'true') {
            $this->accounts->daybook_console();
        } else {
            $this->accounts->daybook();
        }

        $list = $this->accounts->get_datatables();
        $toid = $this->accounts->cashaccount;
         if($this->input->post('branch') ){
            $qry = "SELECT DISTINCT cash from set_billtype WHERE transaction ='sales' and branch_id = '".$this->input->post('branch')."' and cash != 0";
            $da = $this->db->query($qry);
            if($da->num_rows() > 0 ){
                $da = $da->row_array();
                $toid = $da['cash'];
            }
        }
        $this->loadajax($list, $toid, 'daybook-' . $consol,1);
    }

    public function check_list() {
        $this->accounts->check_list();
        $list = $this->accounts->get_datatables();
        $this->chklist($list);
    }

    public function trial_list() {
        $this->accounts->trialbalance();
        $list = $this->accounts->get_datatables();
        $this->trilist($list);
    }

    private function dataTableGenTo($list, $toid) {
        $no = $this->input->post('start');
        $data = array();
        $data[] = $this->addrow($no, '', 'Opening Balance', $this->dbit, $this->credit);
        foreach ($list as $members) {
            $no++;
            $voucher_no = 'To ' . $members->legder;
            if ($members->trn_tp == 'receipt') {
                $voucher_no = 'By ' . $members->legder;
            }
            $data[] = $this->addrow($no, $members->tran_date, $voucher_no . '<br/>(' . $members->tran_narration . ' - ' . $members->voucher_no . ')', $members->tran_debit, $members->tran_credit);
        }$no++;
        $this->getLedegerbalance($this->input->post('enddate'), $toid, 'cl');
        $data[] = $this->addrow($no, '', 'Closing Balance', $this->dbit, $this->credit);
        return $data;
    }

    private function chklist($list) {
        $data = array();
        $no = $this->input->post('start');
        $crdt = 0;
        $dbt = 0;
        foreach ($list as $members) {
            $crdt = $crdt + $members->tran_credit;
            $dbt = $dbt + $members->tran_debit;
            $row = array();
            $row[] = $members->in_date;
            $row[] = $members->ledger_name;
            $row[] = $this->accounts->get_url($members->tb_id, $members->voucher_no, $members->trn_tp);
            $row[] = $members->tran_narration;
            $row[] = number_format((float) $members->tran_credit,$this->company_roundoff, '.', '');
            $row[] = number_format((float) $members->tran_debit,$this->company_roundoff, '.', '');
            $data[] = $row;
            // = $this->addrow($members->trn_tp, $members->tran_narration . ' ', $members->tran_credit, '', $members->tran_debit);
            $no++;
        }
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = 'Total ';
        $row[] = number_format((float) $crdt,$this->company_roundoff, '.', '');
        $row[] = number_format((float) $dbt,$this->company_roundoff, '.', '');
        $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->accounts->count_all() + 1,
            "recordsFiltered" => $this->accounts->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

     public function excel($start_date,$end_date)
	{

		$start_date = str_replace("-","/",$start_date);
		$end_date = str_replace("-","/",$end_date);
        $data['details'] = $this->accounts->trail_balance_lists($start_date,$end_date);
		$this->load->view('excell2',$data);
	}

    private function trilist($list) {
        $data = array();
        $no = $this->input->post('start');
        $cdt = $dbt = 0.00;
        foreach ($list as $members) {
            $no++;
            $amt = $members->amt;
            if ((float)$amt >= 0) {
                $dbt = (float)$dbt + (float) $amt;
                $data[] = $this->addrowt($no, $members->name, $this->number_fm($amt), '0.00');
            } else {
                $cdt = (float) $cdt + (float) ($amt * -1);
                $data[] = $this->addrowt($no, $members->name, '0.00', $this->number_fm($amt * -1));
            }
        }
        $no++;
        $data[] = $this->addrowt('', '<b>Total</b>', $this->number_fm($dbt), $this->number_fm($cdt));
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->accounts->count_all() + 1,
            "recordsFiltered" => $this->accounts->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    private function loadajax($list, $toid, $type = '',$cas = 0) {
        $this->getMainLedegerbalance($this->input->post('startdate'), $toid, 'op',$cas);
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
                $row[] = $this->accounts->get_url($members->tb_id, $members->voucher_no, $members->trn_tp);
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
        $row[] = number_format((float) $cldr,$this->company_roundoff, '.', '');
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
            "recordsTotal" => $this->accounts->count_all() + 1,
            "recordsFiltered" => $this->accounts->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

   public function ledger_pdf()
{

    $qry = "SELECT a.`name`,b.address_line1 FROM acc_ledgers AS a LEFT JOIN  suppliers AS b ON a.ref_id = b.id AND a.ref_code IN('cus','sup') where a.id = ".$this->input->get('toid');
    $ledger_data = $this->db->query($qry)->row_array();
  
    // 0. Suppress notices that break PDF output headers
    error_reporting(E_ALL & ~E_NOTICE);

    // 1. Setup Data
    $start_date = $this->input->get('startdate');
    $end_date   = $this->input->get('enddate');
    $to_id      = $this->input->get('toid');

    $list = $this->accounts->get_pdfdata();
    $com = $this->accounts->getCompany();

    // Get Opening Balance
    $this->getLedegerbalance($start_date, $to_id, 'op');
    $op_crdt = (float)$this->credit;
    $op_dbt = (float)$this->dbit;
    $running_bal = $op_dbt - $op_crdt;

    // 2. Initialize PDF
    $this->load->library('Pdf');
    $pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);
    
    // Set Document Info
    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);
    $pdf->SetMargins(10, 15, 10); // Left, Top, Right
    $pdf->SetAutoPageBreak(TRUE, 15); // Bottom margin
    $pdf->SetTitle('Ledger Report');
    $pdf->SetFont('helvetica', '', 9);

    // 3. Prepare Table Header HTML
    $table_header = '
    <table border="1" cellpadding="4" style="width:100%;">
        <tr style="background-color:#f2f2f2; font-weight:bold; text-align:center;">
            <th width="12%">Date</th>
            <th width="10%">V Type</th>
            <th width="12%">V Number</th>
            <th width="10%">Ref No</th>
            <th width="26%">Particulars</th>
            <th width="10%">Debit</th>
            <th width="10%">Credit</th>
            <th width="10%">Balance</th>
        </tr>';

    // 4. Gather all rows
    $all_rows_html = [];

    // Add Opening Balance Row
    $op_text = ($running_bal < 0) ? number_format(abs($running_bal), 2) . ' CR' : number_format($running_bal, 2) . ' DR';
    $all_rows_html[] = '
        <tr>
            <td colspan="4" style="border-right:none;"></td>
            <td style="border-left:none;"><b>Opening Balance</b></td>
            <td align="right">' . number_format($op_dbt, 2) . '</td>
            <td align="right">' . number_format($op_crdt, 2) . '</td>
            <td align="right"><b>' . $op_text . '</b></td>
        </tr>';

    // Loop through transactions to build rows
    $total_debit = $op_dbt;
    $total_credit = $op_crdt;

    foreach ($list as $members) {
        $narration_parts = explode(";;", $members->tran_narration);
        $main_narration = htmlspecialchars($narration_parts[0]);
        $ref_no = isset($narration_parts[1]) ? htmlspecialchars($narration_parts[1]) : '';
        $xname = htmlspecialchars($members->xname);
        
        $total_debit += (float)$members->tran_debit;
        $total_credit += (float)$members->tran_credit;
        $running_bal += ((float)$members->tran_debit - (float)$members->tran_credit);
        
        $current_bal_text = ($running_bal < 0) ? number_format(abs($running_bal), 2) . ' CR' : number_format($running_bal, 2) . ' DR';

        $all_rows_html[] = '
        <tr>
            <td align="center">' . $members->in_date . '</td>
            <td align="center">' . htmlspecialchars(lcfirst($members->trn_tp)) . '</td>
            <td align="center">' . htmlspecialchars($members->voucher_no) . '</td>
            <td align="center">' . $ref_no . '</td>
            <td>' . $xname . ' - ' . $main_narration . '</td>
            <td align="right">' . number_format($members->tran_debit, 2) . '</td>
            <td align="right">' . number_format($members->tran_credit, 2) . '</td>
            <td align="right">' . $current_bal_text . '</td>
        </tr>';
    }

    // Add Closing Balance Row
    $closing_text = ($running_bal < 0) ? number_format(abs($running_bal), 2) . ' CR' : number_format($running_bal, 2) . ' DR';
    $all_rows_html[] = '
        <tr style="background-color:#f9f9f9; font-weight:bold;">
            <td colspan="4" style="border-right:none;"></td>
            <td style="border-left:none;">Closing Total</td>
            <td align="right">' . number_format($total_debit, 2) . '</td>
            <td align="right">' . number_format($total_credit, 2) . '</td>
            <td align="right">' . $closing_text . '</td>
        </tr>';

    // 5. Chunking and Rendering
    $rows_per_page_first = 16;
    $rows_per_page_others = 22;

    $chunks = [];
    $remaining_rows = $all_rows_html;

    // First page
    $chunks[] = array_splice($remaining_rows, 0, $rows_per_page_first);

    // Subsequent pages
    while (!empty($remaining_rows)) {
        $chunks[] = array_splice($remaining_rows, 0, $rows_per_page_others);
    }

    $total_pages = count($chunks);

    foreach ($chunks as $index => $page_rows) {
        $pdf->AddPage();
        $html = '';
        
        // Header on first page only
        if ($index == 0) {
            $html .= '
            <h2 style="text-align:center; margin-bottom: 0;">' . htmlspecialchars(strtoupper($com['name'])) . '</h2>
            <div style="text-align:center; font-size: 10px; color: #555;">
                ' . htmlspecialchars($com['address']) . '<br>
                Phone: ' . htmlspecialchars($com['phone']) . ' | Email: ' . htmlspecialchars($com['email']) . ' | GSTIN: ' . htmlspecialchars($com['tin']) . '
            </div>';
        }

        $html .= '
        <h4 style="text-align:center; color: #444; margin-top: 10px; border-top: 1px solid #ccc; padding-top: 5px;">Ledger Statement</h4>
        <table style="width:100%; font-size: 10px; margin-bottom: 5px;">
            <tr>
                <td style="width:60%;">
                    <b>Ledger Name : ' . htmlspecialchars($ledger_data['name']) . '</b><br>
                    ' . htmlspecialchars($ledger_data['address_line1'] ?? '') . '
                </td>
                <td style="width:40%; text-align:right;">
                    Printed : ' . date('d/m/Y') . '<br>
                    Page : ' . ($index + 1) . ' / ' . $total_pages . '
                </td>
            </tr>
        </table>';

        $html .= $table_header;
        $html .= implode('', $page_rows);
        $html .= '</table>';


        $qry = "SELECT 
    led_id,

    -- CREDIT AGEING
    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 1 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m1,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 2 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m2,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 3 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m3,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 4 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m4,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 5 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m5,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 6 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m6,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 7 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m7,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 8 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m8,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 9 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m9,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 10 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m10,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) >= 11 
        THEN GREATEST(credit - paid,0) ELSE 0 END) AS cr_m11_over,


    -- DEBIT AGEING
    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 1 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m1,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 2 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m2,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 3 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m3,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 4 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m4,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 5 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m5,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 6 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m6,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 7 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m7,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 8 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m8,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 9 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m9,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) = 10 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m10,

    SUM(CASE WHEN TIMESTAMPDIFF(MONTH, tb_crdate, CURDATE()) >= 11 
        THEN GREATEST(debit - paid,0) ELSE 0 END) AS dr_m11_over

FROM acc_ageing where led_id = $to_id
GROUP BY led_id;";
$acc_ageing = $this->db->query($qry);
    if($acc_ageing->num_rows() > 0 ){
        $acc_ageing = $acc_ageing->row_array();
        $html .= '<div style="width:100%;"><br /><table border="1" cellpadding="4" style="width:100%;" style ="margin-top:30px;" >';
        $html .= '<tr>';
            $html .= '<th>1 Month</th>';
            $html .= '<th>2 Month</th>';
            $html .= '<th>3 Month</th>';
            $html .= '<th>4 Month</th>';
            $html .= '<th>5 Month</th>';
            $html .= '<th>6 Month</th>';
        $html .= '</tr>';
        $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m1']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m2']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m3']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m4']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m5']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m6']) . '</td>';
        $html .= '</tr>';

        $html .= '<tr>';
            $html .= '<th>7 Month</th>';
            $html .= '<th>8 Month</th>';
            $html .= '<th>9 Month</th>';
            $html .= '<th>10 Month</th>';
            $html .= '<th>11 & Over </th>';
            $html .= '<th></th>';
        $html .= '</tr>';

        $html .= '<tr>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m7']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m8']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m9']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m10']) . '</td>';
            $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m11_over']) . '</td>';
            $html .= '<td></td>';
        $html .= '</tr>';

        // $html .= '<th>11 & Over </th>';
       
        // $html .= '<tr>';
       
      
        // $html .= '<td>' . htmlspecialchars($acc_ageing['dr_m11_over']) . '</td>';
        // $html .= '</tr>';
        $html .= '</table></div>';    
    }
        $pdf->writeHTML($html, true, false, true, false, '');
    }

    // 6. Finalize and Output
    // Clean output buffer to ensure PDF downloads correctly
    if (ob_get_contents()) ob_end_clean();
    
    $pdf->Output('Ledger_Report_' . date('Y-m-d') . '.pdf', 'I');
}

    public function ajax_list() {
        $this->accounts->where();
        $list = $this->accounts->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $this->getLedegerbalance($this->input->post('startdate'), $this->input->post('toid'), 'op');
        $op_crdt = $this->credit;
        $op_dbt = $this->dbit;
        $total_ms = $this->accounts->ledgerBalance();
        $row = $this->addrow($no, '', 'Opening Balance', number_format((float) $this->dbit,$this->company_roundoff, '.', ''), number_format((float) $this->credit,$this->company_roundoff, '.', ''));
        $row[] = $total_ms['credit'];
        $row[] = $total_ms['debit'];
        $data[] = $row;
        $crdt = $this->credit;
        $dbt = $this->dbit;
        $bal = $this->dbit - $this->credit;
        $resbal = 0;

        //  print_r($total_ms);
        foreach ($list as $members) {
			$tran_narration = $members->tran_narration;
			$ref_no = '';
			$narration = explode(";;",$tran_narration);
			$ledger_narration = $narration[0];
			if(isset($narration[1]) ){
				$ref_no = $narration[1];
			}
            $crdt = $crdt + $members->tran_credit;
            $dbt = $dbt + $members->tran_debit;
            $bal = $bal + $members->tran_debit - $members->tran_credit;
            $resbal = 0;
            if ($bal < 0) {
                $resbal = (-1 * $bal);
                $resbal = number_format((float) $resbal,$this->company_roundoff, '.', '') . ' CR';
            } else {
                $resbal = number_format((float) $bal,$this->company_roundoff, '.', '') . ' DR';
            }
            $row = array();
            $row[] = $members->in_date;
            $row[] = lcfirst($members->trn_tp);
            $row[] = $this->accounts->get_url($members->tb_id, $members->voucher_no, $members->trn_tp);
            $row[] = $ref_no;
            $row[] = $members->xname . '-' . $ledger_narration;
            $row[] = $members->tran_debit;
            $row[] = $members->tran_credit;
            $row[] = $resbal;
            $data[] = $row;
            $op_crdt = $op_crdt + $members->tran_credit;
            $op_dbt = number_format((float) $op_dbt + $members->tran_debit,$this->company_roundoff, '.', '');
        }
        $this->getLedegerbalance($this->input->post('enddate'), $this->input->post('toid'), 'cl');
       // $data[] = $this->addrow($no, '', 'Total', number_format((float) $op_dbt,$this->company_roundoff, '.', ''), number_format((float) $op_crdt,$this->company_roundoff, '.', ''));
		$closing = $op_dbt - $op_crdt;
		$closing = $closing . 'DR';
		if( (float) $op_crdt > (float) $op_dbt ){
			$closing = $op_dbt - $op_crdt;
			$closing = $closing*-1 . 'CR';
		}
        $row = array();
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '';
        $row[] = '<b>Closing</b>';
        $row[] = '<b>'.$op_dbt.'</b>';
        $row[] = '<b>'.$op_crdt.'</b>';
        $row[] = '<b>'.$closing.'</b>';
        $data[] = $row;
        $op_crdt = $op_crdt;
        $op_dbt = $op_dbt;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->accounts->count_all() + 2,
            "recordsFiltered" => $this->accounts->count_filtered() + 2,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function profit_ajax_list() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $result = $this->accounts->profitlosdatewise($this->input->post('startdate'), $this->input->post('enddate'));
        $data['res'] = $result['response'];
        $data['result'] = $result['result'];
        $this->load->view('reports/accounts/profitandlossdet', $data);
    }
    
    function proloss_balancesheet( $result){
        
        
        
        
        return -100;
    }

    public function balancesheet_ajax_list() {
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $result_pro = $this->accounts->profitlosdatewise($this->input->post('startdate'), $this->input->post('enddate')); 
        $data['res'] = $result_pro['response'];
        $result = $this->accounts->balancesheetdatewise($this->input->post('startdate'), $this->input->post('enddate'));
		$data['grossprofit'] = $this->accounts->profitandlossconsole($this->input->post('startdate'), $this->input->post('enddate'));
        $data['result'] = $result['result'];
        $data['profit'] = $this->accounts->profitandlossconsole($this->input->post('startdate'), $this->input->post('enddate'));
        $this->load->view('reports/accounts/balancesheetdetaild', $data);
    }

    public function mainajax_list() {
        $this->accounts->wherecondition();
        $list = $this->accounts->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $op_crdt = 0;
        $op_dbt = 0;
        $crdt = 0;
        $dbt = 0;
        $bal = 0;
        $resbal = 0;
		$gdebit = $gcredit = 0;
        $resbalance = 0;
        if ($this->input->post('startdate')) {
			$qry = "SELECT sum(IFNULL(op_dbt,0)) + SUM(CASE WHEN a.type = 'Dr' then a.openning_bal else 0 end) as op_dbt ,sum(IFNULL(op_crdt,0)) + SUM(CASE WHEN a.type = 'Cr' then a.openning_bal else 0 end) as op_crdt from acc_ledgers as a left join (SELECT sum(IFNULL(tran_debit,0)) as op_dbt,sum(IFNULL(tran_credit,0)) as op_crdt,ledger_id from acc_ledger_trans  as b  WHERE b.published ='yes' and tran_date<'" . $this->accounts->getDate($this->input->post('startdate')) ."' GROUP by ledger_id) as x on x.ledger_id = a.id WHERE acc_main_id   =" . $this->input->post('toid') . " ";
        } else {
            $qry = "select sum(tran_debit) as op_dbt,sum(tran_credit) as op_crdt from acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id=b.id where a.published='yes' and acc_main_id=" . $this->input->post('toid') . "  ";
			$qry = "SELECT sum(IFNULL(op_dbt,0)) + SUM(CASE WHEN a.type = 'Dr' then a.openning_bal else 0 end) as op_dbt ,sum(IFNULL(op_crdt,0)) + SUM(CASE WHEN a.type = 'Cr' then a.openning_bal else 0 end) as op_crdt from acc_ledgers as a left join (SELECT sum(IFNULL(tran_debit,0)) as op_dbt,sum(IFNULL(tran_credit,0)) as op_crdt,ledger_id from acc_ledger_trans  as b  WHERE b.published ='yes' and tran_date<'" . $this->accounts->getDate($this->input->post('enddate')) ."' GROUP by ledger_id) as x on x.ledger_id = a.id WHERE acc_main_id   =" . $this->input->post('toid') . " ";
		}
        $query = $this->db->query($qry);
        if ($query->num_rows() > 0) {
            $query = $query->row_array();
            $op_crdt = $query['op_crdt'];
            $op_dbt = $query['op_dbt'];
            $crdt = $query['op_crdt'];
            $dbt = $query['op_dbt'];
            $resbal = $query['op_dbt'] - $query['op_crdt'];
            if ($resbal < 0) {
                $resbalance = (-1 * $resbal);
                $resbalance = $resbalance . ' CR';
            } else {
                $resbalance = $resbal . ' DR';
            }
        }
		$gdebit  = $op_dbt;
		$gcredit = $op_crdt;
        $row = array();
        $row[] = 'Opening';
        $row[] = $op_dbt;
        $row[] = $op_crdt;
        $row[] = '';
        $row[] = $resbalance;
        $data[] = $row;

        foreach ($list as $members) {
            $ledger_balance = $members->tran_debit - $members->tran_credit;
            if ($ledger_balance < 0) {
                $ledger_balance = $ledger_balance * -1;
                $ledger_balance = $ledger_balance . 'CR';
            } else {
                $ledger_balance = $ledger_balance . 'DR';
            }
            $crdt = $crdt + $members->tran_credit;
            $dbt = $dbt + $members->tran_debit;
            $bal = $bal + $members->tran_debit - $members->tran_credit;
			$gcredit = (float) $gcredit + (float) $members->tran_credit;
			$gdebit = (float) $gdebit + (float) $members->tran_debit;
            $resbal = 0;
            if ($bal < 0) {
                $resbal = (-1 * $bal);
                $resbal = $resbal . ' CR';
                $resbalance = $resbal ;
            } else {
                $resbal = $bal . ' DR';
                $resbalance = $resbal ;
            }
            $row = array();

            $row[] = '<a href="' . base_url() . 'reports/accounts/leadger/0/' . $members->ledgerid . '/' . $members->ledger_name . '"> ' . $members->ledger_name . '</a> ';
            $row[] = $members->tran_debit;
            $row[] = $members->tran_credit;
            $row[] = $ledger_balance;
            $row[] = $resbal;
            $data[] = $row;
            $op_crdt = $op_crdt + $members->tran_credit;
            $op_dbt = $op_dbt + $members->tran_debit;
        }
        $row = array();
		$bal = (float) $gdebit - (float) $gcredit ; 
		 if ($bal < 0) {
                $resbal = (-1 * $bal);
                $resbal = $resbal . ' CR';
            } else {
                $resbal = $resbal . ' DR';
            }
		$clos = (float) $gdebit - (float) $gcredit ; 
		if((float) $clos <  0 ){
			$clos  = (-1 * $clos);
			$clos = $clos  .'CR';
		}else{
			$clos = $clos  .'DR';
		}
        $row[] = 'Closing';
        $row[] = $gdebit;
        $row[] = $gcredit;
        $row[] = '';
        $row[] = $clos;
        $data[] = $row;
        $op_crdt = $op_crdt;
        $op_dbt = $op_dbt;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->accounts->count_all() + 2,
            "recordsFiltered" => $this->accounts->count_filtered() + 2,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

}
