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
class Itemtransfer_model   extends DataTable {

    public function __construct() {
        parent::__construct();
		
		if(strtolower($this->session->userdata('login_comid')) == 'palack'){

		}
        $this->select = 'DISTINCT cid,date,fromname,godown_name,invoice';
		if(strtolower($this->session->userdata('login_comid')) == 'palack'){
        	$this->select = 'DISTINCT cid,date,fromname,godown_name,invoice,e_way_status';
		}
        $this->table = 'item_transfer_sub as a INNER JOIN(SELECT c.id as cid,c.*,b.godown_name as fromname FROM item_transfer as c INNER JOIN ims_godown as b on b.id=c.from_id  and c.published="yes") as x on x.cid=a.transfer_id and a.published="yes" INNER JOIN ims_godown as i on i.id=a.to_id';
        $this->column_order = array(null, 'date'); //set column field database for datatable orderable
        $this->column_search = array('godown_name', 'fromname'); //set column field database for datatable searchable 
        $this->order = array('cid' => 'desc'); // default order 
    }
     function where() {
 
          
           
         
    }
	
	function get_transfer($id){
		$qry = "SELECT  h.hsncode as hsn_name,round((its.item_rate*100)/(100+t.GST),2) as taxable_row,(its.item_rate*its.qty) as total,(its.item_rate*its.qty) - round((its.item_rate*its.qty*100)/(100+t.GST),2) as tax,its.item_rate*its.qty as total,round((its.item_rate*its.qty*100)/(100+t.GST),2) as taxable,igs.godown_name as subgodown,igs.godown_address as godownsubaddress,igm.godown_address as mainaddress,igm.godown_name as maingodown,i.name,u.name as unit,t.GST,it.*,its.* FROM `item_transfer` as it INNER JOIN item_transfer_sub as its on its.transfer_id = it.id and its.published ='yes' INNER JOIN item as i on i.id = its.item_id left join hsncode as h on h.hsnid = i.hsncode LEFT JOIN units as u on u.id = its.unit_id left JOIN taxgst  as t on t.gstid = i.tax_id INNER JOIN ims_godown as igm on igm.id = it.from_id left JOIN ims_godown as igs on igs.id = to_id WHERE it.id =".$id;
		$query = $this->db->query($qry)->result_array();
		return $query;
		
	}
	
	function getTransferItemscnt($id){
		$qry = "SELECT round((its.item_rate*100)/(100+t.GST),2) as taxable_row,(its.item_rate*its.qty) - round((its.item_rate*its.qty*100)/(100+t.GST),2) as tax,its.item_rate*its.qty as total,round((its.item_rate*its.qty*100)/(100+t.GST),2) as taxable,igs.godown_name as subgodown,igs.godown_address as godownsubaddress,igm.godown_address as mainaddress,igm.godown_name as maingodown,i.name,u.name as unit,t.GST,it.*,its.* FROM `item_transfer` as it INNER JOIN item_transfer_sub as its on its.transfer_id = it.id and its.published ='yes' INNER JOIN item as i on i.id = its.item_id left join hsncode as h on h.hsnid = i.hsncode LEFT JOIN units as u on u.id = its.unit_id left JOIN taxgst  as t on t.gstid = i.tax_id INNER JOIN ims_godown as igm on igm.id = it.from_id left JOIN ims_godown as igs on igs.id = to_id WHERE it.id =".$id;
		$query = $this->db->query($qry);
		return $query->num_rows();
		
	}
	
	function getTransferItems($id, $len, $size){
		$qry = "SELECT  its.item_rate*its.qty + ((its.item_rate*its.qty*GST)/100) as totalamout, h.hsncode as hsn_name,round((its.item_rate*100)/(100+t.GST),2) as taxable_row,(its.item_rate*its.qty) - round((its.item_rate*its.qty*100)/(100+t.GST),2) as tax,its.item_rate*its.qty as total,round((its.item_rate*its.qty*100)/(100+t.GST),2) as taxable,igs.godown_name as subgodown,igs.godown_address as godownsubaddress,igm.godown_address as mainaddress,igm.godown_name as maingodown,i.name,u.name as unit,t.GST,it.*,its.* FROM `item_transfer` as it INNER JOIN item_transfer_sub as its on its.transfer_id = it.id and its.published ='yes' INNER JOIN item as i on i.id = its.item_id left join hsncode as h on h.hsnid = i.hsncode LEFT JOIN units as u on u.id = its.unit_id left JOIN taxgst  as t on t.gstid = i.tax_id INNER JOIN ims_godown as igm on igm.id = it.from_id left JOIN ims_godown as igs on igs.id = to_id WHERE it.id =".$id." limit $len,$size ";
		$query = $this->db->query($qry)->result_array();
		return $query;
		
	}


	function taxdetails($id){
		$qry = "SELECT sum((its.item_rate*its.qty) - round((its.item_rate*its.qty*100)/(100+t.GST),2)) ,sum(((its.item_rate*its.qty*GST)/100)) as tax,t.GST FROM `item_transfer_sub` as its INNER JOIN item as i on i.id = its.item_id and its.published ='yes' INNER JOIN taxgst as t on t.gstid = i.tax_id WHERE its.transfer_id = ".$id." ";
		$query = $this->db->query($qry)->result_array();
		return $query;
	}
	
	function gettotals($id){
		$qry = "SELECT sum(qty*item_rate) + sum((qty*item_rate*t.GST /100 )) as total FROM `item_transfer_sub` as its INNER JOIN item as i on i.id = its.item_id and its.published ='yes' INNER JOIN taxgst as t on t.gstid = i.tax_id WHERE its.published ='yes' and transfer_id = ".$id;
		$query = $this->db->query($qry)->row_array();
		return $query;
	}




   

}
