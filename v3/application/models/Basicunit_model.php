<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ledgers_model
 *
 * @author jijodileep
 */
class Basicunit_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'uqc_name,IFNULL(c.unit_id,0) as unit_id,IFNULL(d.unit_id,0) as unit,a.name,a.code,a.unit_count,b.name as Parentunit,a.id';
        $this->table = ' units as a left join uqc on uqc.uqc_id = a.uqc LEFT JOIN units as b on a.unit_id=b.id left join(select DISTINCT unit_id from item where 1) as c on c.unit_id=a.id LEFT join (select DISTINCT unit_id from item_barcode where 1 ) as d on d.unit_id =a.id';
        $this->column_order = array('a.name', 'b.name', 'a.code'); //set column field database for datatable orderable
        $this->column_search = array('a.name', 'b.name', 'a.code'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        
    }
	
	function getsing($id){
		$qry = "select * from units where id =".$id;
		$query = $this->db->query($qry)->row_array();
		return $query;
	}
	function parent($id){
		$parent_id = 0 ;
		if($id>0){
			$qry = "select IFNULL(unit_id,0) as unit_id from units where id ='".$id."'";
			$res = $this->db->query($qry);
			if($res->num_rows()>0){
				$query = $this->db->query($qry)->row_array();
				$parent_id =  $query['unit_id'];
			}
		}
		$qry = "SELECT a.* FROM `units` as a left join (select b.unit_id,COUNT(b.id) from units as b GROUP by unit_id) as c on c.unit_id=a.id WHERE c.unit_id is null or a.unit_id is null or a.unit_id =0 or a.id=".$parent_id;
		$result = $this->db->query($qry)->result_array();
		 $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
	}
	
	function save(){
		$insert_id = 0;
		$base_unit_count = 1;
		$id = $this->input->post('id');
		$name = $this->input->post('unit');
		$parent = 0;
		if($this->input->post('parent')){
			$parent = $this->input->post('parent');
		}
		$uqc =  $this->input->post('uqc');
		$code = $this->input->post('code');
		$count = $this->input->post('count');
		$data = array(
				'name'=>$name,
				'unit_id'=>$parent,
				'uqc'=>$uqc,
				'code'=>$code,
				'unit_count'=>$count
			);
		if($id > 0){
			$this->db->where('id',$id);
			$this->db->update('units',$data);
			$insert_id = $id;
		}else{
			$this->db->insert('units',$data);
		}
		if($parent < 1){
			$parent = $insert_id;
		}
		if($parent > 0 ){
			$qry = "SELECT T2.id, T2.name FROM ( SELECT @r AS _id, (SELECT @r := unit_id FROM units WHERE id = _id) AS unit_id, @l := @l + 1 AS lvl FROM (SELECT @r := ".$parent.", @l := 0) vars, units h WHERE @r <> 0) T1 JOIN units T2 ON T1._id = T2.id WHERE T2.unit_id is null or T2.unit_id =0 ORDER BY T1.lvl DESC";
			$query = $this->db->query($qry)->row_array();
			$base = $query['id'];
			$qry = "select id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $base . "'";
			$result = $this->db->query($qry)->result_array();
			foreach($result as $res){
				$id = $res['id'];
				$count = 1 * $res['unit_count'];
				$update_qry = "update units set base_unit_count ='".$count."' where id=".$res["id"];
				$this->db->query($update_qry);
				for ($i = 2; $i >= 2; $i++) {
					$qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
					$query = $this->db->query($qry)->row_array();
					$i = $query['count'];
					$count = $count * $query["unit_count"];
					if ($query['count'] > 0) {
						$id = $query['id'];
						$update_qry = "update units set base_unit_count ='".$count."' where id=".$query["id"];
						$this->db->query($update_qry);
					}
				}
			}
		}
		
		
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
          
	}

}
