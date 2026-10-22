<?php

class District_model extends DataTable{
    public function __construct() {
  
    parent::__construct();
    $this->select = 'd.id,d.district_name,d.district_code';
    $this->table = 'district as d';
    $this->column_order = array('d.id','d.district_name');
    $this->column_search = array('d.district_name');
    $this->order = array('d.id' =>'desc');
    $this->load->database();

    }
    public function save()
    { 
        $id = $this->input->post('id');
        $district_name = $this->input->post('district_name');
        $district_code =$this->input->post('district_code');
        

        $data = array(
            'district_name' =>$district_name,
            'district_code'=>$district_code
        
        );

        
       if($id==0){
        $this->db->insert('district',$data);
       }
       else
       {
        $this->db->where('id', $id);
        $this->db->update('district', $data);
    
       }
      
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        // 
        

        echo json_encode($response);


    }
    public function delete($id)
    {
        $qry = "delete from district where id=" .$id;
        $this->db->Query($qry);
    }
    // public function getElement()
    // {
        
    //         $qry = "select * from district order by id asc";
    //         $exs = $this->db->query($qry);
    //         $result = $exs->result_array();
    //         $option = '<option value = "">select</option>';
    //         $no = 0;
    //         foreach ($result as $row) {
    //             $option .= '<option value="' . $row["id"] . '">' . $row["district_name"] . '</option>';
    //             $no++;
    //         }
    //         print_r($option);
        
    // }
    function getsing($id){
        $qry = 'select d.district_name,d.district_code from district as d where d.id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());

    }

}