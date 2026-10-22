<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chque_model
 *
 * @author jijodileep
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Chque_model extends DataTable {

    //put your code here
    function __construct() {
        parent::__construct();
       $this->table = 'chqdetails as b  left join users as col on col.id = b.collected_by left join acc_ledgers as  a  on a.id=b.chq_frm left join acc_ledgers as  c on c.id=b.chq_to  ';
        $this->column_order = array(null, 'chq_trans', 'chq_bank', 'chq_date', 'chq_frm', 'chq_to', 'chq_status'); //set column field database for datatable orderable
        $this->column_search = array('chq_date', 'chq_no', 'chq_amount', 'chq_bank', 'chq_status'); //set column field database for datatable searchable 
        // default order 
        $this->select = 'user_name,b.*,a.name as chqe_frm ,c.name as  chqe_to,case when chq_frm =0 then chq_to else chq_frm end as ledger ';
    }

//add custom filter here
    function where() {
        $this->wherecondition = "where b.chq_status = '" . $this->input->post('type') . "'";
    }

    function confirm() {
        $id = $this->input->post('id');
        $qry = 'select  * from    chqdetails where chq_id='.$id;
        $result = $this->db->query($qry)->row_array();
        $chq_to = $this->input->post('chq_to');
		print_r($chq_to.'$chq_to');
        $chq_status = $this->input->post('chq_status');
        $chq_date = $this->input->post('chq_date');
        $chq_trans = $result['chq_trans'];
        $data = array(
            'chq_date' => $this->getDate($chq_date),
            'chq_status' => $chq_status
        );
        if ($chq_trans == 'Clearing') {
            $data['chq_to'] = $chq_to;
            $result['chq_to'] =$chq_to;
            
        } else {
            $data['chq_frm'] = $chq_to;
            $result['chq_frm']= $chq_to;
        }
        $branch = $result['branch_id'];
        $frm = $result['chq_frm'];
        $to = $result['chq_to'];
        $gtotal = $result['chq_amount'];
        $narration = 'Cheque Cleared on ' . $chq_date.' Details: No '.$result['chq_no'] .' Bank '.$result['chq_details'].' Details '.$result['chq_details'];
        $or_type = 'Cheque';
            $this->trans_save($result['chq_no'], $id, 'voucher', $or_type, $to, $frm, $this->getDate($chq_date), $gtotal, '0.00', $narration, 1,0,$branch);
            $this->trans_save($result['chq_no'], $id, 'voucher', $or_type, $frm, $to, $this->getDate($chq_date), '0.00', $gtotal, $narration, 1,0,$branch);
            print_r($data);
            $this->db->where('chq_id', $id);
        $this->db->update('chqdetails', $data);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getsing($id) {
        $qry = "select b.*,a.name as chqe_frm ,c.name as  chqe_to, DATE_FORMAT(chq_date, '%d/%m/%Y' ) as chq_dates from    chqdetails as b  left join acc_ledgers as  a  on a.id=b.chq_frm left join acc_ledgers as  c on c.id=b.chq_to where b.chq_id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save() {
        $chq_trans = $this->input->post('chq_trans'); // if it is zero then we will add the item
		$collected_by = $this->input->post('collected_by');
        $chq_date = $this->getDate($this->input->post('chq_date'));
        $Check_number = $this->input->post('chq_no');
        $chq_frm = $this->input->post('chq_frm');
        $chq_amount = $this->input->post('chq_amount');
        $chq_bank = $this->input->post('chq_bank');
        //$chq_status = $this->input->post('chq_status');
        $Check_To = $this->input->post('chq_to');
        $branch = $this->input->post('branch');
        $chq_id = $this->input->post('chq_id');
        $Check_Details = $this->input->post('chq_details');
        $data = array(
            'chq_trans' => $chq_trans,
            'chq_date' => $chq_date,
            'chq_no' => $Check_number,
			'collected_by'=>$collected_by,
            'branch_id'=>$branch,
            'chq_amount' => $chq_amount,
            'chq_bank' => $chq_bank,
            'chq_status' => 'Submitted',
            'chq_frm' => $chq_frm,
            'chq_to' => $Check_To,
            'chq_sdate' => $chq_date,
            'chq_details' => $Check_Details
        );
        if ($chq_id == 0) {
            $this->db->insert('chqdetails', $data);
        } else {
            $this->db->where('chq_id', $chq_id);
            $this->db->update('chqdetails', $data);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
	
	function save_cheque(){
		$id = $this->input->post('modal_cheque_id');
        $qry = 'select  * from    chqdetails where `chq_status` = "Submitted" and chq_id='.$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$result = $this->db->query($qry)->row_array();
			$chq_to = $this->input->post('chq_to');
			$chq_status = $this->input->post('chq_status');
			$chq_date = $this->input->post('chq_date');
			$chq_trans = $this->input->post('chq_trans');
			$data = array(
				'chq_date' => $this->getDate($chq_date),
				'chq_status' => $chq_status
			);
			if ($chq_trans == 'Clearing') {
				$data['chq_to'] = $chq_to;
				$result['chq_to'] =$chq_to;
            
			} else {
				$data['chq_frm'] = $chq_to;
				$result['chq_frm']= $chq_to;
			}
			$branch = $result['branch_id'];
			$frm = $result['chq_frm'];
			$to = $result['chq_to'];
			$gtotal = $result['chq_amount'];
			$narration = 'Cheque Cleared on ' . $chq_date.' Details: No '.$result['chq_no'] .' Bank '.$result['chq_details'].' Details '.$result['chq_details'];
			$or_type = 'Cheque';
				$this->trans_save($result['chq_no'], $id, 'voucher', $or_type, $to, $frm, $this->getDate($chq_date), $gtotal, '0.00', $narration, 1,0,$branch);
				$this->trans_save($result['chq_no'], $id, 'voucher', $or_type, $frm, $to, $this->getDate($chq_date), '0.00', $gtotal, $narration, 1,0,$branch);
 
			$this->db->where('chq_id', $id);
			$this->db->update('chqdetails', $data);
			$txtamt = $this->input->post('txtamt',true);
			$age_id = $this->input->post('age_id',true);
			if($this->input->post('txtamt',true)){
				$length = sizeof($txtamt);
				for($i = 0; $i<$length;$i++){
					$amount = $txtamt[$i];
					if($amount == '' ){
						$amount = 0;
					}
					if((float) $amount > 0 ){
						$type = 'cheque';
						$paid = $amount;
						$qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=balance-" . $paid . ", pay_id= " . $id . ",paid = paid +" . $paid . " , last_paid=" . $paid . " where age_id = " . $age_id[$i];
						$this->db->query($qry);
						$data = array(
							'ageing_id' => $age_id[$i],
							'voucher_id' => $id,
							'paid' => $amount,
							'voucher_type'=>'cheque',
							'published' => 'yes',
						);

						$this->db->insert('acc_ageing_trans', $data);
					}
				}
			}
		}
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

}
