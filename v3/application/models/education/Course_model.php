<?php

class Course_model extends Datatable{

    public function __construct() {
        parent::__construct();
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->select = 'i.*, u.name as uniname';
        $this->table = 'item as i inner join university_type as u on i.university = u.id';
        $this->wherecondition = 'where item_type_id = 3';
        $this->column_order = array(null, 'i.name'); //set column field database for datatable orderable
        $this->column_search = array('i.name'); //set column field database for datatable searchable 
        $this->order = array('i.id' => 'desc'); // default order 
    }

    /*
    *****************************************************************************************************
     * where discount:  retriving discount rates from discount table
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function where_discount(){
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->select = '*';
        $this->table = 'discount';
        $this->wherecondition = '';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }


    /*
    *****************************************************************************************************
     * where_university:  retriving discount rates from discount table
     * 
     * 
     * @author Althaf
     * @created on : 14-10-2019
     * 
     ****************************************************************************************************
     */

    public function university(){
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->select = '*';
        $this->table = 'university_type';
        $this->wherecondition = '';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    /*
    *****************************************************************************************************
     * getdiscount:  retriving discount rates from discount table where id = $id
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function getdiscount($id)
    {
        $qry = "select * from discount where id = ".$id;
        echo json_encode($this->db->query($qry)->row_array());
    }

    /*
    *****************************************************************************************************
     * delete:  delete fn will delete the data with argument  $id 
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function delete($id)
    {
        $qry = "DELETE FROM discount where id = ".$id;
        $this->db->query($qry);
    }

    /*
    *****************************************************************************************************
     * delete:  delete fn will delete the data with argument  $id 
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function deletecourse($id)
    {
        $qry = "DELETE FROM item where id = ".$id;
        $this->db->query($qry);
    }

    /*
    *****************************************************************************************************
     * delete:  delete fn will delete the data with argument  $id 
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function deleteuniversity($id)
    {
        $qry = "DELETE FROM university_type where id = ".$id;
        $this->db->query($qry);
    }


    /*
    *****************************************************************************************************
     * getAllMode:  getAllMode fn will retrieve the data from discount table
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     ****************************************************************************************************
     */

    public function getAllMode()
    {
        $qry = "select * from discount";
        echo json_encode($this->db->query($qry)->result_array());
    }





    public function addUniversity($data, $id = 0)
    {
        // print_r($id);
        // exit(); 
        if($id > 0){
            $this->db->where('id', $id);
            $return = $this->db->update('university_type', $data);

            $response = array(
                'valid' => true,
                'message' => 'Updated Successfully.'
            );
            echo json_encode($response);

        }
        else{

            $result = $this->db->insert('university_type', $data);
            $insert_id = $this->db->insert_id();
            if($insert_id){
                $response = array(
                    'valid' => true,
                    'type' => $insert_id,
                    'message' => 'Saved Successfully.'
                );
            }
            else{
                $response = array(
                    'valid' => false,
                    'message' => 'Something Went Wrong.'
                );
            }
            
            echo json_encode($response);
        }
        
    }

    public function getUniversity()
    {
        $qry = "select * from university_type";
        echo json_encode($this->db->query($qry)->result_array());
    }

    public function getOneUniversity($id)
    {
        // print_r($id);
        $qry = "select * from university_type where id = ".$id;
        echo json_encode($this->db->query($qry)->row_array());
    }

    /**
     *********************************************************************************************************
     * savediscount: saves the discount values into discount table
     * 
     * 
     * @author Althaf
     * @created on : 12-10-2019
     * 
     * 
     *********************************************************************************************************
     */

    public function savediscount($data) 
    {
    $id = $this->input->post('id');

    if ($id == '0') {
        $this->db->insert('discount', $data);
        $insId = $this->db->insert_id();
        if($insId){

            $response = array(
                'valid' => true,
                'type' => $insId,
                'message' => 'Saved Successfully.'
            );
        }
        else{
            $response = array(
                'valid' => false,
                'message' => 'Something went wrong.'
            );
        }
    
            echo json_encode($response);
    } 
    else {
        $this->db->where('id', $id);
        if($this->db->update('discount ', $data)){
            $response = array(
                'valid' => true,
                'message' => 'Updated Successfully.'
            );
        }
        else{
            $response = array(
                'valid' => false,
                'message' => 'Something went wrong.'
            );
        }

        echo json_encode($response);
        
    }
     
        
    }


    public function save($id = 0)  
    {   
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
    
        $enq_user = $userid;
        $name = $this->input->post('name');
        $ccode = $this->input->post('ccode');
        $duration = $this->input->post('duration');
        $univ = $this->input->post('univ');
        $tutfee = $this->input->post('tutfee');
        $examfee = $this->input->post('examfee');
        $certifee = $this->input->post('certifee');
        $otherfee = $this->input->post('otherfee');
        $reg_fee = $this->input->post('reg_fee');

        $type = '3';
        $description = $this->input->post('description');
        $data = array(
            'barcode' => $ccode,
            'tutionfee' => $tutfee,
            'name' => $name,
            'university' => $univ,
            'open_stock' => $duration,
            'examfee' => $examfee,
            'certificatefee' => $certifee,
            'otherfee' => $otherfee,
            'description' => $description,
            'item_type_id' =>$type,
            'reg_fee' => $reg_fee
        );
		if($this->input->post('discount_per')){
			 $data['discount_per'] = $this->input->post('discount_per');
		}
		if($this->input->post('discount_amount')){
			 $data['discount_amount'] =  $this->input->post('discount_amount');
		}
		if($this->input->post('fees')){
			 $data['fees'] =  $this->input->post('fees');
		}
		if($this->input->post('validity')){
			 $data['validity'] = $this->getDate($this->input->post('validity'));
		}
		if($this->input->post('start_date')){
			 $data['course_start_date'] = $this->getDate($this->input->post('start_date'));
		}
		if($this->input->post('end_date')){
			 $data['course_end_date'] = $this->getDate($this->input->post('end_date'));
		}
		if($this->input->post('validity_days')){
			 $data['validity_days'] = $this->input->post('validity_days');
		}
        // $this->db->where('enq_id', $id);

        if($id > 0){
            $data = array(
                'barcode' => $ccode,
                'tutionfee' => $tutfee,
                'name' => $name,
                'open_stock' => $duration,
                'examfee' => $examfee,
                'university' => $univ,
                'certificatefee' => $certifee,
                'otherfee' => $otherfee,
                'description' => $description,
                'item_type_id' =>$type,
                'reg_fee' => $reg_fee

            );
			if($this->input->post('validity_days')){
			 $data['validity_days'] = $this->input->post('validity_days');
			}
			if($this->input->post('discount_per')){
				$data['discount_per'] = $this->input->post('discount_per');
			}
			if($this->input->post('discount_amount')){
				$data['discount_amount'] =  $this->input->post('discount_amount');
			}
			if($this->input->post('fees')){
				$data['fees'] =  $this->input->post('fees');
			}
			if($this->input->post('validity')){
				$data['validity'] = $this->getDate($this->input->post('validity'));
			}
			if($this->input->post('start_date')){
				$data['course_start_date'] = $this->getDate($this->input->post('start_date'));
			}
			if($this->input->post('end_date')){
				$data['course_end_date'] = $this->getDate($this->input->post('end_date'));
			}
            $this->db->where('id', $id);
            $this->db->update('item', $data);

            $response = array(
                'valid' => true,
                'message' => 'Updated Successfully.',
            );
            echo json_encode($response);
        }

        else{

            $this->db->insert('item', $data);
       $insId = $this->db->insert_id();
        if($insId){

        // $stat = array(
        //     'status' => 1,
        // );
        // $this->db->where('id',$id);
        // $this->db->update('enquiry_register', $stat);

            $response = array(
                'valid' => true,
                'type' => $insId,
                'message' => 'Saved Successfully.'
            );
        }
        else{
            $response = array(
                'valid' => false,
                'message' => 'Something went wrong.'
            );
        }

        echo json_encode($response);

        }
       
    }
}