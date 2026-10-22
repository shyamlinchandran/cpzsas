<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Dimind
 */
class Itemtype_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.name,a.id,a.description';
        $this->table = ' itemtypemaster as a ';
        $this->column_order = array(null, 'a.name', null); //set column field database for datatable orderable   
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {

       
    }
	function editrow(){
		$id = $this->input->post('id');
		$qry = "select * from itemtypevalue as a  where a.id = ".$id;
		$result = $this->db->query($qry);
        echo json_encode($result->result_array());
	}
	
	
	
	public function where_item(){
		$id = $this->input->post('id');
		$this->select = 'b.*';
        $this->table = '`itemtypemaster` as a INNER JOIN itemtypevalue as b on a.id=b.itemtypeid  ';
        $this->column_order = array(null,'b.name', null); //set column field database for datatable orderable   
        $this->column_search = array('b.name'); //set column field database for datatable searchable 
        $this->order = array('b.id' => 'desc'); // default order 
        $this->wherecondition = " where a.id = '" . $this->input->post('id') . "' ";
    }
	
    function kit_items($id) {
        $qry = "select c.name as item,a.*,b.* from kit_group as a left join kit_items as b on b.kit_id=a.id left join item as c on c.id=b.item_id  where b.published='yes' and a.type='kit_group' and a.id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function get_kit_items($id) {
        $qry = "select a.*,b.*,c.*,d.name as unit,e.GST as GST,b.name as item FROM kit_items as a INNER JOIN item as b on b.id=a.item_id inner join taxgst as c on c.gstid=b.tax_id left JOIN units as d on d.id=b.unit_id left join taxgst as e on e.gstid=b.tax_id where a.published='yes' and kit_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function kitgroup($search, $customer_id) {
        $is = '';
        $qry = "select name as label,a.* from kit_group as a where a.type='kit_group' and name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	
	public function save_Itemtype(){
		$id = $this->input->post('id');
		$name = $this->input->post('name');
		$description = $this->input->post('description');
		$data = array(
			'name'=>$name,
			'description'=>$description
		);
		if((int) $id > 0){
			$this->db->update('itemtypemaster',$data);
		}else{
			$this->db->insert('itemtypemaster',$data);
			$id = $this->db->insert_id();
		}
		return $id;
	}

    function save() {
		$itemtypevalueid = $this->input->post('itemtypevalueid');
		$id = $this->input->post('id');
		$description = $this->input->post('description');
		$name = $this->input->post('name');
		$valdescription = $this->input->post('valdescription');
		$itemtypevalue = $this->input->post('itemtypevalue');
		$insert_id = $id;
		if((int) $id < 1){
			$data = array(
				'name'=>$name,
				'description'=>$description
			);
			$this->db->insert('itemtypemaster',$data);
			$insert_id = $this->db->insert_id();
		}
		$data = array(
			'itemtypeid'=>$insert_id,
			'name'=>$itemtypevalue,
			'description'=>$valdescription,
			'published'=>'yes'
		);
		if((float) $itemtypevalueid > 0){
			$this->db->where('id',$itemtypevalueid);
			$this->db->update('itemtypevalue',$data);
		}else{
			$this->db->insert('itemtypevalue',$data);
		}
		return $insert_id;
    }

}
