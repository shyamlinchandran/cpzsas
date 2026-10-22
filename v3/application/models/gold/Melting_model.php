<?php



class Melting_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	public function getsing($id){
		$qry = "SELECT IFNULL(rec_item.name,'') as rec_item_name,DATE_FORMAT(melt_date, '%d/%m/%Y' ) as date,a.*,b.*,c.name as customer,i.name as product FROM `gold_melting` as  a LEFT JOIN gold_melting_item as b on a.melt_id = b.melt_itm_melt_id and b.published = 'yes' LEFT JOIN suppliers as c on c.id = a.melt_customer LEFT JOIN item as i on i.id = b.melt_itm_product left join item as rec_item on melt_itm_rec_product = rec_item.id where melt_id=".$id;
		return $this->db->query($qry)->result_array();
	}
	
	public function getinvoice(){
		$qry ="select * from gold_melting where published ='yes' order by melt_id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('MT', "", $query['melt_invoice']);
			$invoice = (int) $invoice + 1;
			return 'MT'.$invoice;
		}else{
			return 'MT1';
		}
		
	}
	
	function melting(){
		$this->select = " * ";
        $this->table = "`gold_melting` as  a LEFT JOIN suppliers as c on c.id = a.melt_customer";
        $this->column_order = array(null, 'a.melt_invoice','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.melt_invoice','b.name', null); //set column field database for datatable searchable 
        $this->order = array('a.melt_id' => 'desc'); // default order 
		$this->wherecondition = ' where  a.published = "yes" ';
	}
	
	public function save(){
		$melt_date = $this->getDate($this->input->post('date'));
		$melt_customer = $this->input->post('customer_id') ;
		$melt_user = $this->input->post('user') ;
		$melt_salesman = $this->input->post('salesman') ;
		$data = array(
			'melt_date'=>$melt_date,
			'melt_customer'=>$melt_customer,
			'melt_user'=>$melt_user,
			'melt_salesman'=>$melt_salesman
		);
		$id = $this->input->post('id');
		if((int) $id > 0  ){
			$insert_id = $id;
			$this->db->where('melt_id',$id);
			$this->db->update('gold_melting',$data);
			$qry = "update gold_melting_item set published = 'no' where melt_itm_melt_id = '".$insert_id."'";
			$this->db->query($qry);
		}else{
			$melt_invoice = $this->getinvoice();
			$data['melt_invoice'] = $melt_invoice;
			$this->db->insert('gold_melting',$data);
			$insert_id = $this->db->insert_id();
		}
		
		$melt_itm_product = $this->input->post('item_id',true) ;
		$melt_itm_issue_no = $this->input->post('issue_no',true) ;
		$melt_itm_issue_wt = $this->input->post('issue_wt',true) ;
		$melt_itm_received_wt = $this->input->post('received_wt',true) ;
		$melt_itm_balance_wt = $this->input->post('balance_wt',true) ;
		$melt_itm_rec_product = $this->input->post('rec_item_id',true) ;
		$length = sizeof($melt_itm_product);
		for($i = 0 ; $i< $length;$i++){
			$date_items = array(
				'melt_itm_product'=>$melt_itm_product[$i],
				'melt_itm_issue_no'=>$melt_itm_issue_no[$i],
				'melt_itm_issue_wt'=>$melt_itm_issue_wt[$i],
				'melt_itm_received_wt'=>$melt_itm_received_wt[$i],
				'melt_itm_balance_wt'=>$melt_itm_balance_wt[$i],
				'melt_itm_rec_product'=>$melt_itm_rec_product[$i],
				'melt_itm_melt_id'=>$insert_id
			);
			$this->db->insert('gold_melting_item',$date_items);
		}
		
		$response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}
}
