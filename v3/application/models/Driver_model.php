
<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class Driver_model extends DataTable {

    public function __construct() {
		parent::__construct();
		$this->select = 'a.*';
		$this->table = 'ims_driver as a  ';
		$this->column_order = array('a.Driver_name','a.Mobile');
		$this->column_search = array('a.Driver_name');
		$this->order = array('a.Id' =>'desc');
		$this->load->database();
    }  
	
	public function save()
    { 
        $id = $this->input->post('id');
        $drivername =$this->input->post('drivername');
		$licenseno =$this->input->post('licenseno');
        $address=$this->input->post('address');
        $mobile=$this->input->post('mobileno');

        $data = array(
            'Driver_name' =>$drivername,
            'licence_no'=>$licenseno,
            'Address'=>$address,
            'Mobile'=>$mobile,		
        
        );

        
       if($id==0){
        $this->db->insert('ims_driver',$data);

       }
       else
       {
        $this->db->where('Id', $id);
        $this->db->update('ims_driver', $data);
    
       }
      
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);

    }
    public function delete($id)
    {
        $qry = "delete from ims_driver where Id=$id";
        $this->db->Query($qry);
    }
   
    
    function getDetails($id){
        $qry = 'SELECT a.* FROM `ims_driver`as a where Id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());

    }

    

   
}