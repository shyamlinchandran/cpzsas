<?php

class Todofollowup_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
      
    }

    function getsing()
    {

       
        $this->select = 'f.*,u.user_name ';
        $this->table = "todo_followup as f inner join todo_allocation as a on a.enq_id = f.enquiry_id inner join users as u on a.enq_user = u.Id"; 
        $this->column_order = array(null, 'user_name'); //set column field database for datatable orderable
        $this->column_search = array('date'); //set column field database for datatable searchable         
    }

    function where($eid = 0){
        
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        if($this->input->post('id')){
            $this->wherecondition = $this->wherecondition = "where f.enquiry_id = " .$this->input->post('id');
        }
        else{
            if($this->input->post('var_id')){
                $this->wherecondition = " Where f.enquiry_id = ".$eid;
            }
            else{
                $this->wherecondition = " Where f.enquiry_id = '".$eid."' and a.user = '".$userid."'";
            }
            
        }
        
        
    }

    public function downloads($id)
    {
        $qry = "select file from enquiry_followup where id = ".$id;
        $filename = $this->db->query($qry)->row_array();
        return $filename;
    }
    

    // function show()
    // {
    //     $userid = $this->session->userdata('user');
    //     $userid= $userid['Id'];
    //     $qry = 'SELECT f.* FROM Enquiry_followup as f inner join Enquiry_allocation as a on f.enquiry_id = a.   ';
    //     $result = $this->db->query($qry);
    //     echo json_encode($result->result_array());
    // }

    function save($file_name = "")
    {
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $remarks = $this->input->post('remarks');
        $status = $this->input->post('stat');
        $nextdate = $this->input->post('nextdate');
        $data = array(
            'enquiry_id' => $id,
            'date' => $this->getDate($date),
            'remarks' => $remarks,
            'file' => $file_name,
            'status' => $status,
            'next_follow_up_date' => $this->getDate($nextdate),
        );
        $data2 = array(
            'state' => 2,
            'status' => $status,
            'next_follow_up_date' => $this->getDate($nextdate),
        );
       
        $result = $this->db->insert('todo_followup ', $data);

        $this->db->where('id', $id);
        $this->db->update('todo_register ', $data2);
        
        if( $result ){
            $stat = array(
                'followup' => 1,
            );

            
            $this->db->update('todo_allocation', $stat);
            return 1;
        }
        // $response = array(
        //     'valid' => false,
        //     'type' => 1,
        //     'message' => 'Saved Successfully.'
        // );
        
        // echo json_encode($response);
        // return 1;
    }
}
