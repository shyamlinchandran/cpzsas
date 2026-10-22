<?php

class Qualifications_model extends DataTable{
    public function __construct() {
  
    parent::__construct();
    $this->select = 'q.id,q.qualification,q.details';
    $this->table = 'qualification as q';
    $this->column_order = array('q.id','q.qualification');
    $this->column_search = array('q.qualification');
    $this->order = array('q.id' =>'desc');
    $this->load->database();

    }
    public function save()
    { 
        $id = $this->input->post('id');
        $qualification = $this->input->post('qualification');
        $details =$this->input->post('details');
        

        $data = array(
            'qualification' =>$qualification,
            'details'=>$details
        
        );

        
       if($id==0){
        $this->db->insert('qualification',$data);
       }
       else
       {
        $this->db->where('id', $id);
        $this->db->update('qualification', $data);
    
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
        $qry = "delete from qualification where id=" .$id;
        $this->db->Query($qry);
    }
    public function getElement()
    {
        
            $qry = "select * from qualification order by id asc";
            $exs = $this->db->query($qry);
            $result = $exs->result_array();
            $option = '<option value = "">select</option>';
            $no = 0;
            foreach ($result as $row) {
                $option .= '<option value="' . $row["id"] . '">' . $row["qualification"] . '</option>';
                $no++;
            }
            print_r($option);
        
    }
    function getsing($id){
        $qry = 'select q.qualification,q.details from qualification as q where q.id='.$id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());

    }

}