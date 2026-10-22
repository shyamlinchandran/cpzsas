<?php

class Physical_stockupdate_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.phy_stk_Id,a.date,a.user,voucher_no ';
		$this->table = 'phy_stk as a  ';
		$this->column_order = array('a.date','a.user');
		$this->column_search = array('a.date');
		$this->order = array('a.phy_stk_Id' =>'desc');
		$this->load->database();
    }
	
	function where(){
		$this->select = "*";
		$this->table =  "physical_stk_update";
		$this->column_order = array( 'voucher_no'); 
		$this->column_search = array( 'voucher_no'); 
		$this->order = array('id' => 'asc'); 
		$this->wherecondition = ' where published = "yes" ';
	}
	
	 
	 
	
	 
	    
    public function getitem($type)
    {
        $search = strtolower($_GET['term']);
        $qry = "select a.*,concat(barcode,'-',name) as label FROM item as a where a.".$type." like('%$search%') limit 0,30 ";
        if($type == 'name'){
            $qry = "select a.*,concat(name,'-',barcode) as label FROM item as a where a.".$type." like('%$search%') limit 0,30 ";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());

    }

    public function getbatch()
    {
        $qry = "select * from batch";
        $result = $this->db->query($qry);
        $result = $result->result_array();
        $option = '<option value="select"> Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Bid"] . '">' . $row["Code"] . '</option>';
        }
        print_r($option);
    }
    public function getgodown()
    {
        $qry = "select * from ims_godown";
        $result = $this->db->query($qry);
        $result = $result->result_array();
        $option = '<option value=""> Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["godown_name"] . '</option>';
        }
        print_r($option);
    }
   
    public function getinvoice(){
		$qry ="select * from phy_stk where published ='yes' order by phy_stk_Id desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('PHY', "", $query['voucher_no']);
			$invoice = (int) $invoice + 1;
			return 'PHY'.$invoice;
		}else{
			return 'PHY1';
		}
		
	}

    function restorestocks($id){
        $qry = 'SELECT * FROM `phy_stk` as a INNER JOIN phy_stk_items as b on a.`phy_stk_Id` = b.phy_stk_id WHERE a.phy_stk_Id = '.$id.' and b.is_delete = 0 ';
        $data = $this->db->query($qry)->result_array();
        foreach($data as $it){
            $type = 'cr';
            $item_quantity = $it['updatequantity'];
            if((float) $item_quantity < 0 ){
                $item_quantity = $item_quantity * -1;
                $type = 'dt';
            }
            $ttp = $type;
            $this->godown_stock_trans(0, $it['item'], $item_quantity, $ttp, 'phy_stk_update',$it['godown'], $it['batch']);
            $qry = "update item_ledger set published = 'no' where godown = ".$it['godown']."  and item_id = ".$it['item']." and  trans_status='phy_stk_update' and trans_id = ".$id;
		    $this->db->query($qry);
        }
        
    }


    public function save()
    { 
        $ids=$this->input->post('ids');
        $stockdate = $this->input->post('stockdate');
        $userId = $this->input->post('userId');  
        $voucher_no = $this->getinvoice();

        $data = array(

            'date' =>$stockdate,
            'user'=>$userId,            
        );
     
        
       if($ids==0){
        $data['voucher_no'] = $voucher_no;
       $this->db->insert('phy_stk',$data);
       $insert_id = $this->db->insert_id();
        }       

       else
       {

        $this->db->where('phy_stk_Id',$ids);
        $this->db->update('phy_stk',$data);
        $insert_id=$ids;       
        $qry = 'update phy_stk_items set is_delete = 1 where phy_stk_id ='.$insert_id;
        $this->db->query($qry);
       }

        $phy_stk_id=$insert_id;
        $barcode = $this->input->post('barcode1', true);
        $itemid = $this->input->post('itemid1', true);
        $itemname=$this->input->post('item1',true);
        $godown = $this->input->post('godown1', true);
        $batch = $this->input->post('batch1', true);
        $actualstock = $this->input->post('actualstock1', true);
        $currentstock = $this->input->post('currentstock1', true);
        $updatequantity = $this->input->post('updatequantity1', true);       
        
        $index = $this->input->post('index', true);
        $len = sizeof($itemid);
        $is_delete=0;

    for ($i = 0; $i <$len; $i++) {
        $data2 = array(

            'phy_stk_id'=>$insert_id,
            'item'=>$itemid[$i],
            'barcode'=>$barcode[$i],
            'godown'=>$godown[$i],
            'batch'=>$batch[$i],
            'currentstock'=>$currentstock[$i],
            'actualstock'=>$actualstock[$i],
            'updatequantity'=>$updatequantity[$i],     
            'is_delete'=>0
        
        );
       
        $this->db->insert('phy_stk_items',$data2);
        $item_quantity = $updatequantity[$i];
        $type = 'dt';
        if((float) $updatequantity[$i] < 0 ){
            $item_quantity = $item_quantity * -1;
            $type = 'cr';
        }

        $ttp = $type ;
		if((float) $item_quantity > 0 ){
			$this->stock_trans(0,$itemid[$i], $item_quantity, $stockdate, $ttp, 'phy_stk_update', $insert_id, 0, 0, 0,  $godown[$i], $voucher_no, $batch[$i]);
			$this->godown_stock_trans(0, $itemid[$i], $item_quantity, $ttp, 'phy_stk_update',$godown[$i], $batch[$i]);
		}

        
    }
      
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

       
        echo json_encode($response);

    }

    public function getuser(){  

        $search = strtolower($_GET['term']);
        $qry = "select a.*,user_name as label FROM users as a where a.user_name like('%$search%') ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array()); 

    }
    function getDetails($id){        
        $qry = 'SELECT a.phy_stk_Id,a.date,b.user_name,a.user FROM `phy_stk`as a left join users as b on a.user=b.Id where phy_stk_Id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());

    }
    public function getstockupdate($id){
        $qry = 'SELECT a.*,b.name as itemname,b.barcode as barcodes,c.godown_name,a.batch as batchname FROM `phy_stk_items`as a inner join item as b on a.item=b.id left join ims_godown as c on a.godown=c.id left join batch as d on a.batch=d.Bid where a.is_delete = 0  and a.phy_stk_id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function delete($id){
        $this->restorestocks($id);
        $qry = "delete from phy_stk where phy_stk_Id=$id";
        $this->db->Query($qry);
    }

    public function getactualstock($id){
        $id = $this->input->post('godownId');
        $itemid =  $this->input->post('itemid');
        $qry  = "SELECT  * FROM `phy_stk` as a INNER JOIN phy_stk_items as b on a.phy_stk_Id = b.phy_stk_id and b.is_delete = 0 WHERE published = 'yes' and date >= (CURDATE() - INTERVAL 3 DAY) and b.item = ".$itemid." and b.godown = ".$id." ";
        $data = $this->db->query($qry);
        $cnt = $data->num_rows();
        $qry='select '.$cnt.' as cnt,(IfNULL(a.current_stock,0.00)+ IfNULL(a.open_stock,0.00)) as actualstk,batch FROM `item_godown` as a where item_id = "'.$itemid.'"  and a.godown_id='.$id ;
        $result = $this->db->query($qry);
        $isbatch = $this->input->post('isbatch');
        if($isbatch > 0 ){
            echo json_encode($result->result_array());
        }else{
            echo json_encode($result->row_array());
        }
        
    }
}
