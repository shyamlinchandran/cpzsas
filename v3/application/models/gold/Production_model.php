<?php



class Production_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	public function getsing($id){
		$qry = "SELECT DATE_FORMAT(gold_pd_date, '%d/%m/%Y' ) as date,a.*,b.*,c.name as customer,i.name as product,ri.name as rec_product FROM `gold_production` as  a LEFT JOIN gold_production_items as b on a.gold_pd_id = b.gold_pdn_itms_pid and b.published = 'yes' LEFT JOIN suppliers as c on c.id = a.gold_pd_customer LEFT JOIN item as i on i.id = b.gold_pdn_itms_issue_item LEFT JOIN item as ri on ri.id = b.gold_pdn_itms_rec_item where gold_pd_id=".$id;
		return $this->db->query($qry)->result_array();
	}
	
	public function getinvoice(){
		$qry ="select * from gold_production where published ='yes' order by gold_pd_id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('PD', "", $query['gold_pd_voucher']);
			$invoice = (int) $invoice + 1;
			return 'PD'.$invoice;
		}else{
			return 'PD1';
		}
		
	}
	
	function production(){
		$this->select = " a.*,c.* ";
        $this->table = "`gold_production` as  a LEFT JOIN suppliers as c on c.id = a.gold_pd_customer";
        $this->column_order = array(null, 'a.gold_pd_voucher','b.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.gold_pd_voucher','b.name', null); //set column field database for datatable searchable 
        $this->order = array('a.gold_pd_id' => 'desc'); // default order 
		$this->wherecondition = ' where  a.published = "yes" ';
	}
	
	public function save(){
		$gold_pd_date = $this->getDate($this->input->post('date'));
		$gold_pd_customer = $this->input->post('customer_id') ;
		$gold_pd_user = $this->input->post('user') ;
		$gold_pd_salesman = $this->input->post('salesman') ;
		$data = array(
			'gold_pd_date'=>$gold_pd_date,
			'gold_pd_customer'=>$gold_pd_customer,
			'gold_pd_user'=>$gold_pd_user,
			'gold_pd_salesman'=>$gold_pd_salesman
		);
		$id = $this->input->post('id');
		if((int) $id > 0  ){
			$insert_id = $id;
			$this->db->where('gold_pd_id',$id);
			$this->db->update('gold_production',$data);
			$qry = "update gold_production_items set published = 'no' where gold_pdn_itms_pid = '".$insert_id."'";
			$this->db->query($qry);
		}else{
			$gold_pd_voucher = $this->getinvoice();
			$data['gold_pd_voucher'] = $gold_pd_voucher;
			$this->db->insert('gold_production',$data);
			$insert_id = $this->db->insert_id();
		}
		
		$gold_pdn_itms_issue_item = $this->input->post('item_id',true) ;
		$gold_pdn_itms_issue_wt = $this->input->post('issue_wt',true) ;
		$gold_pdn_itms_rec_item = $this->input->post('rec_item_id',true) ;
		$gold_pdn_itms_rec_wt = $this->input->post('received_wt',true) ;
		$gold_pdn_itms_rec_no = $this->input->post('received_no',true) ;
		$length = sizeof($gold_pdn_itms_issue_item);
		for($i = 0 ; $i< $length;$i++){
			$date_items = array(
				'gold_pdn_itms_issue_item'=>$gold_pdn_itms_issue_item[$i],
				'gold_pdn_itms_issue_wt'=>$gold_pdn_itms_issue_wt[$i],
				'gold_pdn_itms_rec_item'=>$gold_pdn_itms_rec_item[$i],
				'gold_pdn_itms_rec_wt'=>$gold_pdn_itms_rec_wt[$i],
				'gold_pdn_itms_rec_no'=>$gold_pdn_itms_rec_no[$i],
				'gold_pdn_itms_pid'=>$insert_id
			);
			$this->db->insert('gold_production_items',$date_items);
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
