<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trans_model
 *
 * @author jijodileep
 */
class Proposal_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = "a.*,b.name,b.phone,case WHEN a.is_active =0 then 'Active' else 'Inactive' end as status";
        $this->table = '`proposal` as a INNER JOIN suppliers as b on b.id=a.`customer_id` and a.is_published = 1'; // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id';
        $this->column_order = array(null, 'b.name', 'b.phone', 'a.date'); //set column field database for datatable orderable
        $this->column_search = array( 'b.name', 'b.phone', 'a.date'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    // serch tilering items 
    public function quatation($id){
		$qry ="select * from proposal where customer_id =".$id." order by id asc";
		$result = $this->db->query($qry)->result_array();
		$option = '<option value="">Select</option>';
		foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["bill_no"] . '</option>';
        }
        print_r($option);
	}	
	public function getItems($id){
		$qry = "select * from proposal_items where published='yes' and proposal_id =".$id;
		$result = $this->db->query($qry);
		return $result->result_array();
	}
	
	public function getsing($id){
		$qry = "select  DATE_FORMAT(a.date,'%d/%m/%Y') as dates,a.*,b.name,b.phone,c.pname,case WHEN a.is_active =0 then 'Active' else 'Inactive' end as status from `proposal` as a INNER JOIN suppliers as b on b.id=a.`customer_id` inner join cost_centre as c on a.cost_id=c.cost_id where a.id=".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	public function getsing_items($id){
		//$qry = "select * from proposal_items where published='yes' and proposal_id =".$id;
		$qry="select a.*,b.id,b.name,IFNULL(taxgst.GST,0) as Gst from proposal_items as a left join item as b  on a.col3=b.id left join taxgst on gstid = a.tax_id where a.published='yes' and proposal_id=".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}

	public function getIttem(){

		$search = strtolower($_GET['term']);
        $qry = "select a.*,name as label,b.GST FROM  item as a inner join taxgst as b on a.tax_id=b.gstid where a.name like('%$search%') ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}


}
