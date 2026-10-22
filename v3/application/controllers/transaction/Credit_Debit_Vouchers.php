<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vouchers
 *
 * @author u43255
 */
class Credit_Debit_Vouchers extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('Credit_Debit_Vouchers_model', 'vouchers');
        $this->load->model('ledgers_model', 'ledgers');
    }
	
	 public function getnewinoviceno($type)
    {
        print_r($this->vouchers->getnewinoviceno($type));
    }
	
	
	public function getsing($id){
		$response = $this->vouchers->getsing($id);
		echo json_encode($response);
	}
	
	 function delete($id) {
        $this->vouchers->delete($id);
    }
	
	
	public function credit($id = 0 ,$view = 'create'){
		$settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
		$data['type'] = 'credit_note'; 
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/credit_debit_vouchers/credit', $data);
	}
	
	public function debit($id = 0 ,$view = 'create'){
		$settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
		$data['type'] = 'debit_note'; 
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/credit_debit_vouchers/debit', $data);
	}

  
	public function list_all($type = 'credit_note')
    {
		$settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
		$data['title'] = 'Credit Note';
		if($type == 'debit_note'){
			$data['title'] = 'Debit Note';
		}
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/credit_debit_vouchers/list', $data);
    }
	
	    public function ajax_list() {
        $list = $this->vouchers->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
			if($vouchers->type == 'credit_note'){
				$cr = 'credit';
				$txtdebit = '0.00<br/>';
				$txtcredit = $vouchers->amount.'<br />';
			}
			else{
				$cr = 'debit';
				$txtcredit = '0.00<br/>';
				$txtdebit = $vouchers->amount.'<br />';
			}
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->date;
            $row[] = $vouchers->voucher_no;
            $row[] = $vouchers->mainledname.'<br />'.$vouchers->name;
            $row[] = $txtcredit.$vouchers->credit;
            $row[] = $txtdebit.$vouchers->debit;
			$act =  ' <a href="' . base_url() . 'transaction/Credit_Debit_Vouchers/'.$cr.'/' . $vouchers->id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act .  ' <a tp="pdf" href="' . base_url() . 'transaction/Credit_Debit_Vouchers/bill/' . $vouchers->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . 'transaction/Credit_Debit_Vouchers/list_all/'.$vouchers->type.'"  success="Delete ' . $vouchers->voucher_no . ' successfuly "  message="Do you want Delete ' . $vouchers->voucher_no . '?"  href="' . base_url() . 'transaction/Credit_Debit_Vouchers/delete/' . $vouchers->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->vouchers->count_all(),
            "recordsFiltered" => $this->vouchers->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	
	
	public function save(){
		$id = $this->input->post('vid');
		$btype = $this->input->post('btype');
		$date = $this->vouchers->getDate($this->input->post('date'));
		$main_ledger_id = $this->input->post('main_ledger_id');
		$narration = $this->input->post('narration');
		$type = $this->input->post('type');
		$voucher_no = $this->vouchers->generatevouchernumber($btype);
		$ref_no = $this->input->post('ref_no');
		$total = $this->input->post('amount');

		$data = array(
			'date'=>$date,
			'bill_type'=>$btype,
			'narration'=>$narration,
			'main_ledger'=>$main_ledger_id,
			'type'=>$type,
			'ref_no'=>$ref_no,
			'amount'=>$total
		);
		if((float) $id > 0 ){
			$qry = "select * from credit_debit_voucher where id= '".$id."' ";
			$res = $this->db->query($qry)->row_array();
			$voucher_no = $res['voucher_no'];
			$insert_id = $id;
			$this->vouchers->update_voucher($data,$id);
		}else{
			$data['voucher_no'] = $voucher_no;
			$insert_id = $this->vouchers->insert_voucher($data);
		}
		
		$ledger = $this->input->post('id',true);
		$debit = $this->input->post('debit',true);
		$credit = $this->input->post('credit',true);
		$length = sizeof($ledger);
		for($i =0;$i<$length;$i++){
			$data = array(
				'vid'=>$insert_id,
				'ledger'=>$ledger[$i],
				'debit'=>$debit[$i],
				'credit'=>$credit[$i]
			);
			$this->db->insert('credit_debit_voucher_trans',$data);
			if($type == 'credit_note'){
				$this->vouchers->trans_save($voucher_no, $insert_id, 'credit_debit_voucher', 'credit_note', $main_ledger_id, $ledger[$i], $date, '0.00', $debit[$i], $narration, 1, 1, 1);
				$this->vouchers->trans_save($voucher_no, $insert_id, 'credit_debit_voucher', 'credit_note', $ledger[$i], $main_ledger_id, $date, $debit[$i], '0.00', $narration, 1, 1, 1);
			}else{
				$this->vouchers->trans_save($voucher_no, $insert_id, 'credit_debit_voucher', 'debit_note', $ledger[$i], $main_ledger_id, $date, '0.00', $credit[$i], $narration, 1, 1, 1);
				$this->vouchers->trans_save($voucher_no, $insert_id, 'credit_debit_voucher', 'debit_note', $main_ledger_id, $ledger[$i], $date, $credit[$i], '0.00', $narration, 1, 1, 1);
			}
		}
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
	
	 public function bill($id)
    {
        $this->generateBill($id);
    }

    private function generateBill($id)
    {

        $this->load->library('M_pdf');
		$paper = 'A4';
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		$this->lang->load('en_site', 'en');
        $this->language = "en";
        $list = $this->vouchers->getsing($id);
     //   if ($sale[0]['pub'] == 'no') {
          //  $img_file = base_url() . 'assets/images/cancelled.png';
          //  $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
       // }
        $data['msd'] = $this->Show_Amount_In_Words($list[0]['amount']);
        $com = $this->vouchers->getCompany();
        $data['list'] = $list;
        $data['company'] = $com;
        $html = $this->load->view('transaction/credit_debit_vouchers/bill', $data, true);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }
}
