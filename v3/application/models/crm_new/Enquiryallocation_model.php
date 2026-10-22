<?php

class Enquiryallocation_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];

        $user = $this->session->userdata('user');
        $usertype= $user['user_type'];

        $this->select = 'r.*,u.user_name';
        $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id';
        $this->wherecondition = 'where r.status <> 5';
        if($usertype != 1){
            $this->wherecondition = $this->wherecondition . ' and r.loggedin = ' .$userid;
        }
        
        // $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id WHERE loggedin ='.$userid;
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('r.contactPerson', 'r.companyName'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        
        $qry = 'select * from enquiry_register where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function product($search) {
        $qry = "select name as label,a.* from item as a where name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    // function checkalloc() {
    //     $userId = $this->input->post('allocate_id');
    //     $qry = " SELECT * FROM enquiry_allocation WHERE enq_id = $userId ";
    //     $result = $this->db->query($qry);
    //     if($result->num_rows() > 0){
    //         return true;
    //     }
    // }

    // function save_allocation() {
    //     $id = $this->input->post('allocate_id');
    //     $Sdate = $this->input->post('Sdate');
    //     $Edate = $this->input->post('Edate');
    //     $users = $this->input->post('user');
    //     $amount = $this->input->post('amount');
    //     $remark = $this->input->post('remark');
    //     $data = array(
    //         'Sdate' => $this->getDate($Sdate),
    //         'Edate' => $this->getDate($Edate),
    //         'user' => $users,
    //         'amount' => $amount,
    //         'remark' => $remark
    //     );
    //     $this->db->insert('enquiry_allocation ', $data);
    //     $response = array(
    //         'valid' => false,
    //         'type' => $id,
    //         'message' => 'Saved Successfully.'
    //     );

    //     echo json_encode($response);
    // }

    function save_allocation() {
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $id = $this->input->post('allocate_id');

        $Sdate = $this->input->post('Sdate');

        $enq_user = $userid;
        
        $users = $this->input->post('user');
        $Edate = $this->input->post('Edate');
        $Ddate = $this->input->post('Ddate');
        $remark = $this->input->post('remark');
        $data = array(
            'enq_id' => $id,
            'Sdate' => $this->getDate($Sdate),
            'Edate' => $this->getDate($Edate),
            'enq_user' => $enq_user,
            'user' => $users,
            'Ddate' => $this->getFollowDate($Ddate),
            'remark' => $remark
        );
        // $this->db->where('enq_id', $id);
        $qry = "delete from enquiry_allocation where enq_id = " .$id;
        $this->db->query($qry);
        $this->db->insert('enquiry_allocation ', $data);
        $insId = $this->db->insert_id();
        if($insId){

        $stat = array(
            'status' => 1,

        );
        $this->db->where('id',$id);
        $this->db->update('enquiry_register', $stat);

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

    public function save_bulkallocation()
    {
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];

        $date = date('Y-m-d');
        
        $Sdate = $this->input->post('Sdate');
        $enq_user = $userid;
        $users = $this->input->post('user');
        $Edate = $this->input->post('Edate');
        $Ddate = $this->input->post('Ddate');
        $remark = $this->input->post('remark');
        $data = array(
            'Sdate' => $this->getDate($Sdate),
            'Edate' => $this->getFollowDate($Edate),
            'enq_user' => $enq_user,
            'user' => $users,
            'Ddate' => $this->getFollowDate($Ddate),
            'remark' => $remark
        );
        $checked_count = count($_POST['check']);
        if(!empty($_POST['check']) || $checked_count > 0){
            
            // Loop to store and display values of individual checked checkbox.
            foreach($_POST['check'] as $selected){
                $data['enq_id'] = $selected;
                $qry = "delete from enquiry_allocation where enq_id = " .$selected;
                $this->db->query($qry);
                $this->db->insert('enquiry_allocation ', $data);
                $insId = $this->db->insert_id();
                if($insId){

                    $stat = array(
                        'status' => 1,

                    );
                    $this->db->where('id',$selected);
                    $this->db->update('enquiry_register', $stat);

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

            
            }
            echo json_encode($response);
            }

            else{
                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Nothing To Allocate.'
                );
                echo json_encode($response);
            }
    }


function save_closure() {
        $id = $this->input->post('closure_id');
        $date = $this->input->post('dates');
        $remark = $this->input->post('remark');
        $data = array(
            'enq_id' => $id,
            'dates' => $this->getFollowDate($date),
            'remark' => $remark
        );
        $data2['status'] = 4;
        $this->db->insert('enquiry_closure ',$data);
        $this->db->where('id ',$id);
        $this->db->update('enquiry_register ',$data2);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
}

    function delete($id) {
        $qry = "delete * from  enquiry_register where id =" . $id;
        $this->db->query($qry);
    }

    public function deleteEnq($data)
    {
        $qry = "delete from enquiry_register where id in (" . $data.")";
        $this->db->query($qry);
        $qry = "delete from enquiry_allocation where enq_id in (" . $data.")";
        $this->db->query($qry);
        $qry = "delete from enquiry_followup where enquiry_id in (" . $data.")";
        $this->db->query($qry);
        $qry = "delete from enquiry_closure where enq_id in (" . $data.")";
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);

    }

    function user() {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '" >' . $row["user_name"] . '</option>';
        }
        print_r($option);
    }

    function company($search) {
        $qry = "select companyName as label,a.* from enquiry_register as a where companyName like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function otheritem($id) {
        $qry = "SELECT b.id,b.name,a.price FROM `enquiry_product` as a INNER JOIN item as b on a.`product_id`=b.id WHERE a.enquiry_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getItemTypes() {
        $qry = "SELECT * FROM item_type WHERE 1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {
        $id = $this->input->post('id');
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $companyName = $this->input->post('companyName');
        $contactPerson = $this->input->post('contactPerson');
        $source = $this->input->post('source_id');
        $contactNumber = $this->input->post('contactNumber');
        $user = $this->input->post('user');
        $date = $this->input->post('date');
        $price = $this->input->post('item_price', true);
        $email = $this->input->post('email');
        $adress = $this->input->post('adress');
        if($this->input->post('course') == ""){
            $type = 0;
        }
        else{
            $type = $this->input->post('type');
        }
        
        $qualy = $this->input->post('qual');
        $location = $this->input->post('states_cus');
        if($this->input->post('crmtype') == 'COURSE_CRM'){
            if($this->input->post('course') == ""){
                $course = 0;
            }
            else{
                $course = $this->input->post('course');
            }
            

        }
        else{
            $course = 0;
        }
        
        $remarks = $this->input->post('remarks');
        $gst = $this->input->post('gst');
        $total = $this->input->post('total');

        

        $data = array(
            'loggedin' => $userid,
            'companyName' => $companyName,
            'contactPerson' => $contactPerson,
            'source' => $source,
            'contactNumber' => $contactNumber,
            'user' => $user,
            'date' => $this->getDate($date),
            'email' => $email,
            'adress' => $adress,
            'type' => $type,
            'route' => $qualy,
            'course' => $course,
            'location' => $location,
            'remarks' => $remarks,
            'gst' => $gst,
            'totalAmount' => $total,
        );
        if ($id == '0') {
            $this->db->insert('enquiry_register', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $qry = "delete from enquiry_product where enquiry_id=" . $id;
            $this->db->query($qry);
            $this->db->where('id', $id);
            $this->db->update('enquiry_register ', $data);
        }
        $product_id = $this->input->post('product_id', true);
        if( $this->input->post('product_id', true)){
            $alt_length = sizeof($product_id);
        for ($i = 0; $i < $alt_length; $i++) {
            $alt_data = array(
                'enquiry_id' => $insert_id,
                'price' => $price[$i],
                'product_id' => $product_id[$i]
            );
            $this->db->insert('enquiry_product', $alt_data);
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
