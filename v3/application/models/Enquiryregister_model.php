<?php

class Enquiryregister_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = ' *';
        $this->table = 'enquiry_register';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'select * from enquiry_register where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function save_allocation() {
        $id = $this->input->post('allocate_id');
        $Sdate = $this->input->post('Sdate');
        $Edate = $this->input->post('Edate');
        $users = $this->input->post('users');
        $amount = $this->input->post('amount');
        $remark = $this->input->post('remark');
        $data = array(
            'Sdate' => $this->getDate($Sdate),
            'Edate' => $this->getDate($Edate),
            'users' => $users,
            ' amount' => $amount,
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
        $this->db->insert('Enquiry_followup ', $data);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );
        $qry = "update Enquiry_register set status=2 where id=" . $id;
        $this->db->query($qry);
        echo json_encode($response);
    }

    function save_closure() {
        $id = $this->input->post('closure_id');
        $date = $this->input->post('dates');
        $amounts = $this->input->post('amounts');
        $remark = $this->input->post('remark');
        $data = array(
            'dates' => $this->getDate($date),
            'amounts ' => $amounts,
            'remark' => $remark
        );
        $this->db->insert('Enquiry_closure ',$data);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    function delete($id) {
        $qry = "delete * from  Enquiry_register where id =" . $id;
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

    function company($search) {
        $qry = "select companyName as label,a.* from enquiry_register as a where companyName like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function product($search) {
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
        $location = $this->input->post('location');
        $remarks = $this->input->post('remarks');
        $id = $this->input->post('id');
        $data = array(
            'companyName' => $companyName,
            'contactPerson' => $contactPerson,
            'source' => $source,
            'contactNumber' => $contactNumber,
            'productid' => $productid,
            'user' => $user,
            'date' => $this->getDate($date),
            'price' => $price,
            'email' => $email,
            'collectedPerson' => $collectedPerson,
            'adress' => $adress,
            'type' => $type,
            'location' => $location,
            'status' => 0,
            'remarks' => $remarks,);

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
