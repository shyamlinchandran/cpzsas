<?php

class Enquiryfollowup_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
      
    }

    function getsing()
    {

       
        $this->select = 'f.*,u.user_name ';
        $this->table = "enquiry_followup as f inner join enquiry_allocation as a on a.enq_id = f.enquiry_id inner join users as u on a.enq_user = u.Id"; 
        $this->column_order = array(null, 'user_name'); //set column field database for datatable orderable
        $this->column_search = array('date'); //set column field database for datatable searchable         
    }

    public function status_list()
    {
        $this->select = '*';
        $this->table = "status_master"; 
        $this->column_order = array(null, 'status'); //set column field database for datatable orderable
        $this->column_search = array('label'); //set column field database for datatable searchable  
    }

    public function deleteStatus($id)
    {
        $qry = "delete from status_master where id = ".$id;
        $this->db->query($qry);
        
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

    public function getStatus($id = 0)
    {
        if($id > 0){
            $qry = "select * from status_master where id = ".$id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        }
        else{
            $qry = "select * from status_master";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
        }
        
    }

    public function saveStatus() 
    {
        
        $data = array(
            'status' => $this->input->post('label'),
            'note' => $this->input->post('note'),
        );
        if($this->input->post('id') > 0){
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('status_master', $data);

        }
        else{
            $this->db->insert('status_master', $data);
        }

        $response = array(
            'status' => TRUE,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
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
        $nextdate = $this->input->post('nextdate');
        $status = $this->input->post('status');
        $data = array(
            'enquiry_id' => $id,
            'date' => $this->getDate($date),
            'status' => $status,
            'remarks' => $remarks,
            'file' => $file_name,
            'next_follow_up_date' => $this->getDate($nextdate),
        );
        $data2 = array(
            'status' => 2,
            'statuss' => $status,
            'next_follow_up_date' => $this->getDate($nextdate),
        );
       
        $result = $this->db->insert('enquiry_followup ', $data);

        $this->db->where('id', $id);
        $this->db->update('enquiry_register ', $data2);
        
        if( $result ){
            $stat = array(
                'followup' => 1,
            );

            
            $this->db->update('enquiry_allocation', $stat);
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
