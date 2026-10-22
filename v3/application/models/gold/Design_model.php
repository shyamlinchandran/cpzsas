<?php



class Design_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	public function getsing($id){
		$qry = "SELECT i1.name as rec_name,DATE_FORMAT(gold_design_date, '%d/%m/%Y' ) as date,a.*,b.*,c.name as customer,i.name as product FROM `gold_design` as  a LEFT JOIN gold_design_items as b on a.gold_design_id  = b.gold_design_itm_design and b.published = 'yes' LEFT JOIN suppliers as c on c.id = a.gold_design_customer LEFT JOIN item as i on i.id = b.gold_design_itm_product left join item as i1 on i1.id=gold_design_itm_rec_product where gold_design_id=".$id;
		return $this->db->query($qry)->result_array();
	}
	
	public function getinvoice(){
		$qry ="select * from gold_design where published ='yes' order by gold_design_id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('DS', "", $query['gold_design_voucher']);
			$invoice = (int) $invoice + 1;
			return 'DS'.$invoice;
		}else{
			return 'DS1';
		}
		
	}
	
	function designs(){
		$this->select = " * ";
        $this->table = "`gold_design` as  a LEFT JOIN suppliers as c on c.id = a.gold_design_customer";
        $this->column_order = array(null, 'a.gold_design_voucher','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.gold_design_voucher','b.name', null); //set column field database for datatable searchable 
        $this->order = array('a.gold_design_id' => 'desc'); // default order 
		$this->wherecondition = ' where  a.published = "yes" ';
	}
	
	public function save(){
		$gold_design_date = $this->getDate($this->input->post('date'));
		$gold_design_customer = $this->input->post('customer_id') ;
		$gold_design_user = $this->input->post('user') ;
		$gold_design_salesman = $this->input->post('salesman') ;
		$data = array(
			'gold_design_date'=>$gold_design_date,
			'gold_design_customer'=>$gold_design_customer,
			'gold_design_user'=>$gold_design_user,
			'gold_design_salesman'=>$gold_design_salesman
		);
		$id = $this->input->post('id');
		if((int) $id > 0  ){
			$insert_id = $id;
			$this->db->where('gold_design_id',$id);
			$this->db->update('gold_design',$data);
			$qry = "update gold_design_items set published = 'no' where gold_design_itm_design = '".$insert_id."'";
			$this->db->query($qry);
		}else{
			$gold_design_voucher = $this->getinvoice();
			$data['gold_design_voucher'] = $gold_design_voucher;
			$this->db->insert('gold_design',$data);
			$insert_id = $this->db->insert_id();
		}
		
		$gold_design_itm_product = $this->input->post('item_id',true) ;
		$gold_design_itm_issue_no = $this->input->post('issue_no',true) ;
		$gold_design_itm_issue_wt = $this->input->post('issue_wt',true) ;
		$gold_design_itm_rec_wt = $this->input->post('received_wt',true) ;
		$gold_design_itm_rec_no = $this->input->post('received_no',true) ;
		$gold_design_itm_damage = $this->input->post('damage',true) ;
		$gold_design_itm_rec_product = $this->input->post('rec_item_id',true) ;
		$length = sizeof($gold_design_itm_product);
		for($i = 0 ; $i< $length;$i++){
			$date_items = array(
				'gold_design_itm_product'=>$gold_design_itm_product[$i],
				'gold_design_itm_issue_no'=>$gold_design_itm_issue_no[$i],
				'gold_design_itm_issue_wt'=>$gold_design_itm_issue_wt[$i],
				'gold_design_itm_rec_wt'=>$gold_design_itm_rec_wt[$i],
				'gold_design_itm_rec_no'=>$gold_design_itm_rec_no[$i],
				'gold_design_itm_damage'=>$gold_design_itm_damage[$i],
				'gold_design_itm_rec_product'=>$gold_design_itm_rec_product[$i],
				'gold_design_itm_design '=>$insert_id
			);
			$this->db->insert('gold_design_items',$date_items);
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
