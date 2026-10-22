<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Chque
 *
 * @author jijodileep
 */
class Chque extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('chque_model', 'cheque');
    }

    function confirm() {
        $this->cheque->confirm();
    }

    function list_all() {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/chque/list_all');
    }
	
	public function bounce($id){
		$qry = 'select  * from    chqdetails where chq_status  ="Cleared" and  chq_id='.$id;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$result = $this->db->query($qry)->row_array();
			$chq_trans = $result['chq_trans'];
			$chq_to = $result['chq_to'];
			$chq_frm = $result['chq_frm'];
			if ($chq_trans == 'Issue') {
				$frm = $result['chq_to'];
				$to = $result['chq_frm'];
			} else {
				$frm = $result['chq_to'];
				$to = $result['chq_frm'];
			}
			$chq_date = date('Y-m-d');
			$branch = $result['branch_id'];
			
			$gtotal = $result['chq_amount'];
			$narration = 'Cheque Bounced on ' . $chq_date.' Details: No '.$result['chq_no'] .' Bank '.$result['chq_details'].' Details '.$result['chq_details'];
			$or_type = 'Cheque';
			$this->cheque->trans_save($result['chq_no'], $id, 'voucher', $or_type, $to, $frm, $chq_date, $gtotal, '0.00', $narration, 1,0,$branch);
			$this->cheque->trans_save($result['chq_no'], $id, 'voucher', $or_type, $frm, $to, $chq_date, '0.00', $gtotal, $narration, 1,0,$branch);
			$data = array(
				'chq_status'=>'bounced'
			);
			$this->db->where('chq_id',$id);
			$this->db->update('chqdetails',$data);

            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0 ){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
                    $this->db->query($qry);
                }
            }


		}
	}
	
	public function cancel($id){
		$qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
		$age_data = $this->db->query($qry);
		if($age_data->num_rows() > 0 ){
			$age_data = $age_data->result_array();
			foreach($age_data as $item){
				$qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
				$this->db->query($qry);
				$qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
				$this->db->query($qry);
				$qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
				$this->db->query($qry);
			}
		}
		$qry = "update acc_ledger_trans set tran_narration = 'cancelled',  published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." ";
		$this->db->query($qry);
		$qry = "update chqdetails set chq_status = 'Rejected' where chq_id = ".$id." ";
		$this->db->query($qry);

	}

    public function deletesubmited($id){
        $qry = 'select  * from    chqdetails where  chq_id='.$id;
		$query = $this->db->query($qry);
        if($query->num_rows() > 0 ){
            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0 ){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
                    $this->db->query($qry);
                }
            }
            $qry = "update acc_ledger_trans set tran_narration = 'Deleted',  published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." ";
            $this->db->query($qry);
            $qry = "delete from  chqdetails  where chq_id = ".$id." ";
            $this->db->query($qry);
        }
	}
	
    public function deleteall($id){
        $qry = 'select  * from    chqdetails where chq_status  ="Cleared" and  chq_id='.$id;
		$query = $this->db->query($qry);
        if($query->num_rows() > 0 ){
            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0 ){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
                    $this->db->query($qry);
                }
            }
            $qry = "update acc_ledger_trans set tran_narration = 'Deleted',  published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." ";
            $this->db->query($qry);
            $qry = "delete from  chqdetails  where chq_id = ".$id." ";
            $this->db->query($qry);
        }
	}

	public function delete($id){
        $qry = 'select  * from    chqdetails where chq_status  ="Cleared" and  chq_id='.$id;
		$query = $this->db->query($qry);
        if($query->num_rows() > 0 ){
            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0 ){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
                    $this->db->query($qry);
                }
            }
            $qry = "update acc_ledger_trans set tran_narration = 'Deleted',  published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." ";
            $this->db->query($qry);
            $qry = "update chqdetails set chq_status = 'Submitted' where chq_id = ".$id." ";
            $this->db->query($qry);
        }
	}

    function getsing($id) {
        $this->cheque->getsing($id);
    }

    function create($id = 0, $type = '') {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['type'] = $type;
        $this->load->view('transaction/chque/create', $data);
    }

    public function ajax_list() {
        $this->cheque->where();
        $list = $this->cheque->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $cheque) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $cheque->chq_no;
            $pdc = "PDC Clearing";
            if ($cheque->chq_trans == "Clearing") {
                $pdc = "PDC Clearing";
                $row[] = $cheque->chqe_frm;
            } else {
                $pdc = $cheque->chq_trans;
                $row[] = $cheque->chqe_to;
            }
            $row[] = $cheque->chq_sdate;
            $row[] = $cheque->chq_bank;
            $row[] = $cheque->chq_amount;
            $row[] = $pdc;
            $row[] = $cheque->user_name;
            $row[] = $cheque->tran_crtd_dt;
            $row[] = $cheque->chq_status;
            if($this->session->userdata('login_base_comid') == '123456' || $this->session->userdata('login_base_comid') == 'swamees'){
                $smd = '<a  class="btn btn-info "  href="' . base_url() . 'transaction/chque/chequetransaction/' . $cheque->chq_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            }else{
                $smd = '<a  class="btn btn-info "  href="' . base_url() . 'transaction/chque/create/' . $cheque->chq_id . '/v" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            }
                            $smd = '<a  class="btn btn-info "  href="' . base_url() . 'transaction/chque/chequetransaction/' . $cheque->chq_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';

            if ($cheque->chq_status == "Submitted") {
                $smd = $smd . ' <a  href="' . base_url() . 'transaction/chque/chequetransaction/' . $cheque->chq_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                 <a style ="display:none;"   class="btn btn-info " onclick="return theFunction(' . $cheque->chq_id . ',\'' . trim($cheque->chq_trans) . '\',' . $cheque->ledger . ',\'' . trim($cheque->chq_amount) .'\');" title="Confirm"  data-toggle="tooltip"><span class="glyphicon glyphicon-share-alt"></span></i></a>';
                 $smd  = $smd . ' <a    tp="confirm" base="' . base_url() . '/transaction/chque/list_all" success="Deleted  successfuly "    message="Do you want Delete This Cheque?"  href="' . base_url() . 'transaction/chque/deletesubmited/' . $cheque->chq_id . '" title="Delete" data-toggle="tooltip" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';

         }else if($cheque->chq_status == "Cleared"){
                $smd = $smd . ' <a tp="confirm" base="' . base_url() . '/transaction/chque/list_all"   success="Cancelled  successfuly "  message="Do you want Cancel This Cheque?"  href="' . base_url() . 'transaction/chque/cancel/' . $cheque->chq_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
				// $smd  = $smd . ' <a tp="confirm" base="' . base_url() . '/transaction/chque/list_all" success="Bounced  successfuly "    message="Do you want Bounce This Cheque?"  href="' . base_url() . 'transaction/chque/bounce/' . $cheque->chq_id . '" title="Bounvce" data-toggle="tooltip" class="btn btn-danger">Bounce</a>';
				// $smd  = $smd . ' <a  tp="confirm" base="' . base_url() . '/transaction/chque/list_all" success="Status Changed toSubmited  successfuly "    message="Do you want  This Cheque to reverted to submit?"  href="' . base_url() . 'transaction/chque/delete/' . $cheque->chq_id . '" title="Delete" data-toggle="tooltip" class="btn btn-danger">Revert to submit</span></a>';
                $smd  = $smd . ' <a  tp="confirm" base="' . base_url() . '/transaction/chque/list_all" success="Deleted  successfuly "    message="Do you want Delete This Cheque?"  href="' . base_url() . 'transaction/chque/deleteall/' . $cheque->chq_id . '" title="Delete" data-toggle="tooltip" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';

            }

            $row[] = $smd;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->cheque->count_all(),
            "recordsFiltered" => $this->cheque->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function save() {
        $this->cheque->save();
    }
	
	function save_cheque() {
        $this->cheque->save_cheque();
    }

    public function chequetransaction($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $this->load->view('transaction/chque/chequetransaction', $data);
    }

    public function transaction_submit() {
        $this->cheque->transaction_submit();
    }

    public function transaction_clear() {
        $this->cheque->transaction_clear();
    }

    public function transaction_bounce($id) {
        $qry = 'select  * from    chqdetails where chq_status  ="Cleared" and  chq_id='.$id;
        $query = $this->db->query($qry);
        if($query->num_rows() > 0 ){
            $result = $this->db->query($qry)->row_array();
            $chq_trans = $result['chq_trans'];
            $chq_to = $result['chq_to'];
            $chq_frm = $result['chq_frm'];
            
            $frm = $result['chq_to'];
            $to = $result['chq_frm'];
            
            $bounce_date = $this->input->post('bounce_date');
            if(empty($bounce_date)) {
                echo json_encode(['valid' => false, 'message' => 'Bounce date is required']);
                return;
            }
            $chq_date = date('Y-m-d', strtotime(str_replace('/', '-', $bounce_date)));
            $branch = $result['branch_id'];
            
            $gtotal = $result['chq_amount'];
            $narration = 'Cheque Bounced on ' . $chq_date.' Details: No '.$result['chq_no'] .' Bank '.$result['chq_details'].' Details '.$result['chq_details'];
            $or_type = 'Cheque';
            $this->cheque->trans_save($result['chq_no'], $id, 'voucher', $or_type, $to, $frm, $chq_date, $gtotal, '0.00', $narration, 1,0,$branch);
            $this->cheque->trans_save($result['chq_no'], $id, 'voucher', $or_type, $frm, $to, $chq_date, '0.00', $gtotal, $narration, 1,0,$branch);
            $data = array(
                'chq_status'=>'bounced'
            );
            $this->db->where('chq_id',$id);
            $this->db->update('chqdetails',$data);
            
            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id =  ".$id." ";
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0 ){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']."  where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid   where age_id = ".$item['ageing_id']." " ;
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set  published = 'no' where id = ".$item['id']." ";
                    $this->db->query($qry);
                }
            }
            
            echo json_encode(['valid' => true, 'message' => 'Bounced Successfully']);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Invalid Request']);
        }
    }

    public function transaction_remove_bounced($id) {
        $qry = 'select * from chqdetails where chq_status = "bounced" and chq_id='.$id;
        $query = $this->db->query($qry);
        if($query->num_rows() > 0) {
            $qry = "update acc_ledger_trans set published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." and tran_narration LIKE '%Bounced%' ";
            $this->db->query($qry);
            
            $qry = "update chqdetails set chq_status = 'Cleared' where chq_id = ".$id;
            $this->db->query($qry);
            
            echo json_encode(['valid' => true, 'message' => 'Reverted Bounced Status Successfully']);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Invalid Request']);
        }
    }

    public function transaction_remove_cleared($id) {
        $qry = 'select * from chqdetails where chq_status = "Cleared" and chq_id='.$id;
        $query = $this->db->query($qry);
        if($query->num_rows() > 0) {
            $qry = "select * from acc_ageing_trans where published = 'yes' and voucher_type = 'cheque' and voucher_id = ".$id;
            $age_data = $this->db->query($qry);
            if($age_data->num_rows() > 0){
                $age_data = $age_data->result_array();
                foreach($age_data as $item){
                    $qry = "update acc_ageing set paid = paid - ".$item['paid']." where age_id = ".$item['ageing_id'];
                    $this->db->query($qry);
                    $qry = "update acc_ageing set balance = credit + debit - paid where age_id = ".$item['ageing_id'];
                    $this->db->query($qry);
                    $qry = "update acc_ageing_trans set published = 'no' where id = ".$item['id'];
                    $this->db->query($qry);
                }
            }
            $qry = "update acc_ledger_trans set published = 'no' where trn_tp = 'Cheque' and tb_id = ".$id." and tran_narration LIKE '%Cleared%' ";
            $this->db->query($qry);
            
            $qry = "update chqdetails set chq_status = 'Submitted' where chq_id = ".$id;
            $this->db->query($qry);
            
            echo json_encode(['valid' => true, 'message' => 'Reverted Cleared Status Successfully']);
        } else {
            echo json_encode(['valid' => false, 'message' => 'Invalid Request']);
        }
    }

}
