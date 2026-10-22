<?php



class SalesJob_model extends DataTable {

    public function __construct() {
        parent::__construct();
        
    }
	
	public function getsing($id){
		$qry = "SELECT a.*,b.*,i.name as itemname,s.name as customername,DATE_FORMAT(date, '%d/%m/%Y' ) as dates FROM `sales_and_jobcard` as a INNER JOIN sales_and_jobcard_items as b on a.sale_job_id = b.sale_job_id and b.published = 'yes' INNER JOIN item as i on i.id = b.product LEFT JOIN suppliers as s on s.id = a.customer where a.sale_job_id = ".$id;
		return $this->db->query($qry)->result_array();
	}
	
	public function getinvoice(){
		$qry ="select * from sales_and_jobcard where published ='yes' order by sale_job_id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('JB', "", $query['voucher']);
			$invoice = (int) $invoice + 1;
			return 'JB'.$invoice;
		}else{
			return 'JB1';
		}
		
	}
	
	function salesjob(){
		$this->select = " a.*,s.* ";
        $this->table = "`sales_and_jobcard` as  a LEFT JOIN suppliers as s on s.id = a.customer";
        $this->column_order = array(null, 'a.voucher','s.name', null); //set column field database for datatable orderable   
        $this->column_search = array(null, 'a.voucher','s.name', null); //set column field database for datatable searchable 
        $this->order = array('a.sale_job_id' => 'desc'); // default order 
		$this->wherecondition = ' where  a.published = "yes" ';
	}
	
	public function save(){
		$date = $this->getDate($this->input->post('date'));
		$customer = $this->input->post('customer_id') ;
		$user = $this->input->post('user') ;
		$salesman = $this->input->post('salesman') ;
		$data = array(
			'date'=>$date,
			'customer'=>$customer,
			'user'=>$user,
			'salesman'=>$salesman
		);
		$id = $this->input->post('id');
		if((int) $id > 0  ){
			$insert_id = $id;
			$this->db->where('sale_job_id',$id);
			$this->db->update('sales_and_jobcard',$data);
			$qry = "update sales_and_jobcard_items set published = 'no' where sale_job_id = '".$insert_id."'";
			$this->db->query($qry);
		}else{
			$voucher = $this->getinvoice();
			$data['voucher'] = $voucher;
			$this->db->insert('sales_and_jobcard',$data);
			$insert_id = $this->db->insert_id();
		}
		
		$type = 'issue';
		$product = $this->input->post('item_id',true) ;
		$rec_wt = $this->input->post('received_wt',true) ;
		$issue_wt = $this->input->post('issue_wt',true) ;
		$touch = $this->input->post('touch',true) ;
		$rec_pure_wt = $this->input->post('received_pure',true) ;
		$issue_pure_wt = $this->input->post('issued_pure',true) ;
		
		
		$balance_wt = $this->input->post('balance_pure',true) ;
		$mc_rate = $this->input->post('mc_rate',true) ;
		$mc_amount = $this->input->post('mc_amount',true) ;
		$mc_rec = $this->input->post('mc_rec',true) ;
		$mc_balance =  $this->input->post('mc_bal',true) ;
		$rate = $this->input->post('rate',true) ;
		$amount = $this->input->post('amount',true) ;
		
		$data = array(
			'sale_job_id'=>$insert_id,
			'type'=>$type,
			'product'=>$product,
			'rec_wt'=>$rec_wt,
			'issue_wt'=>$issue_wt,
			'touch'=>$touch,
			'rec_pure_wt'=>$rec_pure_wt,
			'issue_pure_wt'=>$issue_pure_wt,
			'balance_wt'=>$balance_wt,
			'mc_rate'=>$mc_rate,
			'mc_amount'=>$mc_amount,
			'mc_rec'=>$mc_rec,
			'mc_balance'=>$mc_balance,
			'rate'=>$rate,
			'amount'=>$amount,
		);
		$this->db->insert('sales_and_jobcard_items',$data);
		
		$type = 'receive';
		$product = $this->input->post('rec_item_id',true) ;
		$rec_wt = $this->input->post('rec_received_wt',true) ;
		$issue_wt = $this->input->post('rec_issue_wt',true) ;
		$touch = $this->input->post('rec_touch',true) ;
		$rec_pure_wt = $this->input->post('rec_received_pure',true) ;
		$issue_pure_wt = $this->input->post('rec_issued_pure',true) ;
		
		
		$balance_wt = $this->input->post('rec_balance_pure',true) ;
		$mc_rate = $this->input->post('rec_mc_rate',true) ;
		$mc_amount = $this->input->post('rec_mc_amount',true) ;
		$mc_rec = $this->input->post('rec_mc_rec',true) ;
		$mc_balance =  $this->input->post('rec_mc_bal',true) ;
		$rate = $this->input->post('rec_rate',true) ;
		$amount = $this->input->post('rec_amount',true) ;
		
		$data = array(
			'sale_job_id'=>$insert_id,
			'type'=>$type,
			'product'=>$product,
			'rec_wt'=>$rec_wt,
			'issue_wt'=>$issue_wt,
			'touch'=>$touch,
			'rec_pure_wt'=>$rec_pure_wt,
			'issue_pure_wt'=>$issue_pure_wt,
			'balance_wt'=>$balance_wt,
			'mc_rate'=>$mc_rate,
			'mc_amount'=>$mc_amount,
			'mc_rec'=>$mc_rec,
			'mc_balance'=>$mc_balance,
			'rate'=>$rate,
			'amount'=>$amount,
		);
		$this->db->insert('sales_and_jobcard_items',$data);
		
		$response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

}
