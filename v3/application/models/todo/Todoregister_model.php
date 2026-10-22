<?php


class Todoregister_model extends DataTable {

    public function __construct() {
        parent::__construct();

        $this->select = 'r.*,r.date as sdate, u.user_name as userss, ts.status as stt';
        $this->table = 'todo_register as r inner join todo_allocation as a on a.enq_id = r.id inner join users as u on r.user = u.Id inner join todo_status as ts on ts.id = r.status';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    public function where()
    {
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->wherecondition = 'where a.user = '.$userid.' and r.state <> 4';

        if($this->input->post('date')){
            $this->wherecondition = $this->wherecondition.' and r.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        }
        // $this->wherecondition = $this->wherecondition . ' and r.status < 6';
    }

    function getsing($id) {

        $table = 'enquiry_register';
        if($this->input->post('isLead')){  
            
            $table = 'lead_register';
        }
        $qry = 'select * from ' . $table . ' where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save_allocation() {
        $id = $this->input->post('allocate_id');
        $Sdate = $this->input->post('Sdate');
        $Edate = $this->input->post('Edate');
        $Ddate = $this->input->post('Ddate');
        $remark = $this->input->post('remark');
        $data = array(
            'Sdate' => $this->getFollowDate($Sdate),
            'Edate' => $this->getFollowDate($Edate),
            'Ddate' => $this->getFollowDate($Ddate),
            'enq_id' => $id,
            'remark' => $remark
        );
        $this->db->insert('enquiry_allocation ', $data);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );
        $qry = "update enquiry_register set status=1 where id=" . $id;
        $this->db->query($qry);
        echo json_encode($response);
    }

    function save_followup() {
        $id = $this->input->post('id');
        $image = $this->input->post('image');
        $description = $this->input->post('description');
        $data = array(
            'image' => $image,
            'description' => $description,
            'enq_id' => $id
        );
        $this->db->insert('enquiry_followup ', $data);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );
        $qry = "update enquiry_register set status=2 where id=" . $id;
        $this->db->query($qry);
        echo json_encode($response);
    }

    function save_closure() {
        $id = $this->input->post('closure_id');
        
        $date = $this->input->post('dates');
        $amounts = $this->input->post('amounts');
        $remark = $this->input->post('remark');
        $stat = $this->input->post('stat');
        // print_r($stat);
        // exit();
        $data = array(
            'enq_id' => $id,
            'dates' => $this->getDate($date),
            'status' => $stat,
            'amounts ' => $amounts,
            'remark' => $remark,
        );
        $data2['status'] = 6;
        $data2['value'] = $stat;
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

    function users() {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }
    
     function source() {
        $qry = "select a.* from source_enquiry as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '" >' . $row["source_of_enquiry"] . '</option>';
        }
        print_r($option);
    }

    function company($search) {
        $qry = "select companyName as label,a.* from enquiry_register as a where companyName like'%".$search."%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function product($typeId, $search) {
        $qry = "select name as label,a.*, a.srate as rate from item as a where item_type_id = '".$typeId."' and name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    function services($search) {
        $qry = "select name as label,a.* from item as a where name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save() {
        $productid = $this->input->post('productid');
        $companyName = $this->input->post('companyName');
        $contactPerson = $this->input->post('contactPerson');
        $source = $this->input->post('source_id');
        $contactNumber = $this->input->post('contactNumber');
        $user = $this->input->post('user');
        $date = $this->input->post('date');
        $price = $this->input->post('price');
        $email = $this->input->post('email');
        $collectedPerson = $this->input->post('collectedPerson');
        $adress = $this->input->post('adress');
        $type = $this->input->post('type');
        $location = $this->input->post('states_cus');
        $remarks = $this->input->post('remarks');
        $id = $this->input->post('id');

        $data = array(
            'companyName' => $companyName,
            'contactPerson' => $contactPerson,
            'source' => $source,
            'contactNumber' => $contactNumber,
            'productid' => $productid,
            'user' => $user,
            'date' => $this->getFollowDate($date),
            'price' => $price,
            'email' => $email,
            'collectedPerson' => $collectedPerson, 
            'adress' => $adress,
            'type' => $type,
            'location' => $location,
            'status' => 0,
            'remarks' => $remarks,
        );

        if ($id == '0') {
            $this->db->insert('enquiry_register', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('enquiry_register ', $data);
        }
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

}
