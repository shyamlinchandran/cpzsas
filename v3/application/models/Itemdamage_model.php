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
class Itemdamage_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'c.invoice,a.id as aid,b.id as item_id,c.date,a.damage_id,a.*,b.*  ';
        $this->table = 'item_damage as a inner join item as b on a.item_id=b.id inner join damage as c on c.damage_id=a.damage_id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name', 'aid'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }
     function where() {
        $this->wherecondition = " where c.published ='yes'";
        $this->wherecondition = $this->wherecondition. " and  a.published ='yes'";
        $this->wherecondition = $this->wherecondition. " group by c.damage_id";
         
    }
    function getdamage($id) {
        $qry = "select godown_id,a.unit_id,godown_name,u.name as unitname,DATE_FORMAT(c.date, '%d/%m/%Y' ) as date,b.id as item_id,b.name as item,a.quantity,a.details,a.batch from item_damage as a inner join item as b on a.item_id=b.id inner join damage as c on c.damage_id=a.damage_id left join  ims_godown as g on g.id=a.godown_id left join units as u on u.id=a.unit_id  where a.published='yes' and c.damage_id =" . $id;
        //echo $qry;b.
       $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	public function getinvoice(){
		$qry ="select * from damage where published ='yes' and invoice!= '' order by damage_id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('DS', "", $query['invoice']);
			$invoice = (int) $invoice + 1;
			return 'DS'.$invoice;
		}else{
			return 'DS1';
		}
		
	}
	
     public function save() {
		$item_batch = $this->input->post('item_batch', true);
        $quantity = $this->input->post('quantty', true);
        $item_id = $this->input->post('id', true);
        $id = $this->input->post('vid', true);
        $details = $this->input->post('det', true);
        $date = $this->getDate($this->input->post('date', true));
        $unit_id =$this->input->post('unit_id', true);
        $godown_id =$this->input->post('godown_id', true);
        $is_godown =$this->input->post('is_godown');
        $is_multipleunit =$this->input->post('is_multipleunit');
        $length = sizeof($quantity);
        $type='damage';
        $insert_id=$id;
        if($id> 0){
		$qry = "select * from damage where damage_id =".$id;
		$res = $this->db->query($qry)->row_array();
		$invoice = $res['invoice'];
		if($invoice ==''){
			$invoice = 'Transfer';
		}
        $this->restorestock($id, 'damage');
        $qry = "update  item_damage set published ='no' where damage_id=".$id;
                $this->db->query($qry);
        
        $qry = "update  item_ledger set published ='no' where trans_status='" . $type . "' and trans_id =" . $id;
                $this->db->query($qry);

        $qry = "update  damage set date ='" . $date . "' where damage_id =" . $id;
                $this->db->query($qry);  

         }
          if ($id <= 0) {
			  $invoice = $this->getinvoice();
			  
              $data = array(
                'date' => $date,
                'published' => 'yes',
				'invoice'=>$invoice
            );
        $this->db->insert('damage', $data);
        $insert_id = $this->db->insert_id();
        }
        for ($i = 0; $i < $length; $i++) {

         $data = array(
                'damage_id' => $insert_id,
                'item_id' => $item_id[$i],
                'godown_id' => $godown_id[$i],
                'unit_id' => $unit_id[$i],
                'quantity' => $quantity[$i],
                'details' => $details[$i],
                'published' => 'yes'
            );
			$batch = "";
			if($this->input->post('item_batch', true)){
				$data['batch'] = $item_batch[$i];
				$batch = $item_batch[$i];
			}
         $ttp="cr";
        $this->db->insert('item_damage', $data);
        if($is_multipleunit==1){
               $quantity[$i]=$this->getquantity($unit_id[$i], $quantity[$i], $item_id[$i]);
            }
			
			
           $this->godown_stock_trans(0, $item_id[$i], $quantity[$i], $ttp, 'damage', $godown_id[$i],$batch);

            $this->stock_trans(0, $item_id[$i], $quantity[$i], $date, $ttp, 'damage', $insert_id, 0, 0, 0, $godown_id[$i],$invoice,$batch);
     }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
}
