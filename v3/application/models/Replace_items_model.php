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
class Replace_items_model extends DataTable {

    public function __construct() {
        parent::__construct();

    }
	
	function getinvoice($id){
		$qry = "select * from set_billtype where id=".$id;
		$billtype = $this->db->query($qry)->row_array();
		$qry = "select * from replacement where rep_bill_type = ".$id ." order by rep_id desc limit 0,1" ;
		$query = $this->db->query($qry);
		if($query->num_rows() < 1){
			$invoice = $billtype['preffix'].$billtype['seperator'].$billtype['startnumber'].$billtype['seperator'].$billtype['suffix'];
		}else{
			$query  = $query->row_array();
			$old = $query['rep_invoice'];
			$old = str_replace($billtype['preffix'], "", $query['rep_invoice']);
			$old = str_replace($billtype['suffix'], "", $old);
			$old = str_replace("2020", "", $old);
			$old = str_replace($billtype['seperator'], "", $old);
			$old = $old + 1;
            $invoice = $billtype['preffix'] . $billtype['seperator'] . $old . $billtype['seperator'] . $billtype['suffix'];
		}
		return $invoice;
	}
	
	public function where(){
		$this->select = ' DATE_FORMAT(a.rep_date, "%d/%m/%Y" ) as date,rep_invoice,rep_id,b.name as customer,u.user_name as user';
        $this->table = '`replacement` as a LEFT JOIN suppliers as b on rep_customer = b.id left JOIN users as u on u.Id = rep_user';
        $this->column_order = array(null, 'a.rep_date'); //set column field database for datatable orderable
        $this->column_search = array('a.rep_date', 'b.name','u.user_name'); //set column field database for datatable searchable 
        $this->order = array('rep_id' => 'desc'); // default order 
		$this->wherecondition = ' where a.published ="yes" ';
	}
	
	function restore_replacement($insert_id) {
		$qry = "update  item_ledger set published ='no' where trans_status='replace' and trans_id =" . $insert_id;
        $this->db->query($qry);
        $qry = "select * from replacement_items  as a  where a.published='yes' and a.rep_itm_rep_id=" . $insert_id;
        $query = $this->db->query($qry)->result_array();

        foreach ($query as $ms) {
			$base_unit_id = $ms['rep_itm_base_unit'];
			$unit_id = $ms['rep_itm_unit'];
			$is_unit = 1;
			$quantity = $ms['rep_itm_quantity'];
			if((int) $is_unit > 0 ){
				$quantity = $this->getunitconversion($quantity,$base_unit_id,$unit_id);
			}
            $this->godown_stock_trans(0, $ms['rep_itm_item'], $quantity, 'dt', 'item', $ms['rep_itm_godown']);
        }
		$qry = "update replacement_items set published = 'no' where rep_itm_rep_id = " .$insert_id;
		$this->db->query($qry);
    }
	
	public function save_data(){
		$id = $this->input->post('vid');
        $date = $this->getDate($this->input->post('date', true));
		$salesman = $this->input->post('salesman');
		$user = $this->input->post('user');
		$btype= $this->input->post('btype');
		$customer_id = $this->input->post('customer_id');
		$reference  = $this->input->post('reference');
		$data = array(
			"rep_date"=>$date,
			"rep_user"=>$user,
			"rep_salesman"=>$salesman,
			"rep_customer"=>$customer_id,
			"published"=>'yes'
		);
		if((float) $id > 0 ){
			$this->restore_replacement($id);
			$this->db->where('rep_id',$id);
			$this->db->update('replacement',$data);
			$insert_id = $id;
			$qry = "select * from replacement where rep_id = ".$id;
			$row_data = $this->db->query($qry)->row_array();
			$rep_invoice = $row_data['rep_invoice'];
			
		}else{
			$data['rep_bill_type'] = $btype;
			$data['rep_invoice'] = $this->getinvoice($btype);
			$rep_invoice = $data['rep_invoice'];
			$this->db->insert('replacement',$data);
			$insert_id = $this->db->insert_id();
		}
		$base_unit_item = $this->input->post('base_unit_item', true);
		$unit_item = $this->input->post('unit_item', true);
		$item_id = $this->input->post('id', true);
		$godown = $this->input->post('godown', true);
		$quantity = $this->input->post('debit', true);
		$length = sizeof($base_unit_item);
		for($i = 0 ; $i < $length ;$i++){
			$data = array(
				"rep_itm_rep_id"=>$insert_id,
				"rep_itm_item"=>$item_id[$i],
				"rep_itm_unit"=>$unit_item[$i],
				"rep_itm_base_unit"=>$base_unit_item[$i],
				"rep_itm_godown"=>$godown[$i],
				"rep_itm_quantity"=>$quantity[$i],
			);
			$rep_itm_base_quantity = $this->getunitconversion($data['rep_itm_quantity'],$data['rep_itm_base_unit'],$data['rep_itm_unit']);
			$data['rep_itm_base_quantity']  = $rep_itm_base_quantity;
			$this->db->insert('replacement_items',$data);
            $this->godown_stock_trans(0, $data['rep_itm_item'], $rep_itm_base_quantity, 'cr', 'item', $data['rep_itm_godown']);
			$this->stock_trans(0, $item_id[$i], $rep_itm_base_quantity, $date, 'cr', 'replace', $insert_id, 0, 0, 0,$data['rep_itm_godown'],$rep_invoice,'');
		}
	}

    
    public function getsing($id){
		$qry = "SELECT i.barcode,s.name as customer_name,DATE_FORMAT(a.rep_date, '%d/%m/%Y' ) as dates,a.*,b.*,c.code as code,i.name as item,g.godown_name FROM `replacement` as a INNER JOIN replacement_items as b on a.rep_id = b.rep_itm_rep_id and b.published ='yes' INNER JOIN units as c on c.unit_id =rep_itm_unit INNER JOIN item as i on i.id = b.rep_itm_item INNER JOIN ims_godown as g on g.id = b.rep_itm_godown left join suppliers as s on s.id =a.rep_customer where a.rep_id = ".$id." GROUP by b.rep_itm_id";
		 $query = $this->db->query($qry);
         return $query->result_array();
	}

   

}
