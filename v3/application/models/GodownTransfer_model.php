<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class GodownTransfer_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'DISTINCT cid,date,fromname,godown_name';
        $this->table = 'item_transfer_sub as a INNER JOIN(SELECT c.id as cid,c.*,b.godown_name as fromname FROM item_transfer as c INNER JOIN ims_godown as b on b.id=c.from_id ) as x on x.cid=a.transfer_id and a.published="yes" INNER JOIN ims_godown as i on i.id=a.to_id';
        $this->column_order = array(null, 'date'); //set column field database for datatable orderable
        $this->column_search = array('godown_name', 'fromname'); //set column field database for datatable searchable 
        $this->order = array('cid' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }
	
	 function get_purpose() {
        $qry = "select * from purpose_of_transfer order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["id"] . '" >' . $row["purpose"] . '</option>';
        }
        print_r($option);
    }
	
	    public function save_transfer()
    {
		$purpose_of_transfer = $this->input->post('purpose_of_transfer');
		$is_unit = $this->input->post('is_unit');
        $from_godown = $this->input->post('from_godown');
        $to_godown = $this->input->post('to_godown');
		$salesman = $this->input->post('salesman');
		$user = $this->input->post('user');
		$customer_id = $this->input->post('customer_id');
        $transfer = 'transfer';
		$is_unit = $this->input->post('is_unit');
		$item_batch = $this->input->post('item_batch',TRUE);
        $debit = $this->input->post('debit', true);
        $quantity = $this->input->post('debit', true);
        $vid = $this->input->post('vid', true);
        $date = $this->getDate($this->input->post('date', true));
        $length = sizeof($debit);
        $id = $this->input->post('id');
		if($this->input->post('base_unit_item', true)){
			$base_unit_item = $this->input->post('base_unit_item', true);
			$unit_item      = $this->input->post('unit_item', true);
		}
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0 and $vid == 0) {
                $qry = "insert into item_transfer (date,from_id,is_unit,salesman,user,customer_id,purpose_of_transfer) values  ('" . $date . " ' , " . $from_godown . ", " . $is_unit . ", " . $salesman . ", " . $user . ", " . $customer_id . ", " . $purpose_of_transfer . " )";
                $this->db->query($qry);
                $insert_id = $this->db->insert_id();
            }
            if ($i == 0 and $vid > 0) {
                $qry = "update  item_transfer set purpose_of_transfer = '" . $purpose_of_transfer . "',salesman ='" . $salesman . "',user ='" . $user . "',customer_id ='" . $customer_id . "',date ='" . $date . "',  from_id =  " . $from_godown . " where id =" . $vid;
                $this->db->query($qry);
                $insert_id = $vid;
                $qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $insert_id;
                $this->db->query($qry);
                $this->restore_godown_transfer_stock($insert_id);
                $qry = "update item_transfer_sub set published = 'no' where transfer_id=" . $vid;
                $this->db->query($qry);
            }
			$batch = "";
			if($this->input->post('item_batch',TRUE)){
				$batch = $item_batch[$i];
			}
			if($this->input->post('base_unit_item', true)){
				if($base_unit_item[$i] != $unit_item[$i]){
					$debit[$i] = $this->getunitconversion($debit[$i],$base_unit_item[$i],$unit_item[$i]);
				}
			}

            $this->stock_trans(0, $id[$i], $debit[$i], $date, 'cr', $transfer, $insert_id, 0, 0, 0, $from_godown,'',$batch);
            $this->stock_trans(0, $id[$i], $debit[$i], $date, 'dt', $transfer, $insert_id, 0, 0, 0, $to_godown,'',$batch);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'cr', 'item', $from_godown,$batch);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'dt', 'item', $to_godown,$batch);
            $qry = 'insert into item_transfer_sub (item_id,transfer_id,qty,to_id,batch) values  (' . $id[$i] . ',' . $insert_id . ',' .  $quantity[$i] . ',' . $to_godown . ',"'.$batch.'")';
			if($this->input->post('base_unit_item', true)){
				$qry = 'insert into item_transfer_sub (item_id,transfer_id,qty,to_id,batch,base_unit_id,unit_id) values  (' . $id[$i] . ',' . $insert_id . ',' .  $quantity[$i] . ',' . $to_godown . ',"'.$batch.'","'.$base_unit_item[$i].'","'.$unit_item[$i].'")';
			}
			$this->db->query($qry);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
	
	function getitem(){
		$itemcode = $this->input->post('itemcode');
		$qry = "select * from item where barcode='$itemcode' and published ='yes' order by id desc limit 0,1 ";
		return $this->db->query($qry)->result_array();
	}
	 function gettransfer($id)
    {
        $qry = "select purpose_of_transfer,sup.name as supname,a.user,a.customer_id,a.salesman,b.unit_id,base_unit_id,IFNULL(u.name,'') as unitname,batch,DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,i.name,item_id,i.barcode from item_transfer as a left join suppliers as sup on sup.id = a.customer_id inner join item_transfer_sub as b on b.transfer_id=a.id left join units as u on u.id=b.unit_id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }







   

}
