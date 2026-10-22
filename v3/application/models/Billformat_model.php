<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class Billformat_model extends DataTable {

    function where() { 
        $this->select = '*';
        $this->table = 'set_printtype';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('name' => 'asc'); // default order 
        $this->wherecondition = "  where  published ='yes' ";
    }
	
	function getdetails($id){
		$qry = "select * from set_printtype where id=".$id;
		$query = $this->db->query($qry)->row_array();
		return $query;
	}
    
    function connectDb($id) {
       $qry = 'select * from ozone_main.set_database as a where sdb_Id='.$id;
        $settings = $this->db->query($qry);
        return $settings->row_array();
    }
	
	function save(){
		$id = $this->input->post('id');
		$field_type = $this->input->post('field_type',true);
		$Isvisible = $this->input->post('Isvisible',true);
		$display_as = $this->input->post('display_as',true);
		$width = $this->input->post('width',true);
		$size = sizeof($field_type);
		$text = '';
		for($i=0;$i<$size;$i++){
			if($text !='' ){
				$text = $text . ',';
			}
			$text = $text .'{"Field":"'.$field_type[$i].'","Field_name":"'.$field_type[$i].'","Isvisible":"'.$Isvisible[$i].'","display_as":"'.$display_as[$i].'","width":"'.$width[$i].'"}';
		}
		
		$text = '['.$text.']';
		$footer_field_type = $this->input->post('footer_field_type',true);
		$footer_Isvisible = $this->input->post('footer_Isvisible',true);
		$footer_display_as = $this->input->post('footer_display_as',true);
		$text_footer = '';
		$size = sizeof($footer_field_type);
		for($i=0;$i<$size;$i++){
			if($text_footer !='' ){
				$text_footer = $text_footer . ',';
			}
			$text_footer = $text_footer .'{"Field":"'.$footer_field_type[$i].'","Field_name":"'.$footer_field_type[$i].'","Isvisible":"'.$footer_Isvisible[$i].'","display_as":"'.$footer_display_as[$i].'"}';
		}
		
		$text_footer = '['.$text_footer.']';
		$data = array(
			'print_settings'=>$text,
			'footer_settings'=>$text_footer
		);
		$this->db->where('id',$id);
		$this->db->update('set_printtype',$data);
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

}
