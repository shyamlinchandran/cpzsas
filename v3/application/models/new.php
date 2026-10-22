<?php 
private function ageing_trans_save($type, $id, $tp) {
		$hdcrdt = $this->input->post('hdcrdt', true);
		$check_list = $this->input->post('chck', true);
		$age_id = $this->input->post('age_id', true);
		$txtamt = $this->input->post('txtamt', true);
		$hddbt = $this->input->post('hddbt', true);
		$paid = $this->input->post('paid');
		$tb_id = $this->input->post('tbid', true);
		if ($tp == 'e') {
			$qry = "update  acc_ageing_trans set published ='no' where voucher_id =" . $id;
			$this->db->query($qry);
		}
		if($this->input->post('hdcrdt', true)){
			$i = 0;
			$length = sizeof($hdcrdt);
			for ($i = 0; $i < $length; $i++) {
				$bal = 0;
				if ($type == 'pay') {
					$bal = $hdcrdt[$i];
				}
				if ($type == 'rec') {
					$bal = $hddbt[$i];
				}
				$paid = $txtamt[$i];

				$data = array(
					'ageing_id' => $age_id[$i],
					'voucher_id' => $id,
					'paid' => $txtamt[$i],
					'published' => 'yes',
				);

				$this->db->insert('acc_ageing_trans', $data);
			}
		}
    }
	
	
	?>