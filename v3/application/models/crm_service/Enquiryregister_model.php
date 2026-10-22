<?php


class Enquiryregister_model extends DataTable {  

    public function __construct() {
        parent::__construct();

        $this->select = '*, ver.id as reg_id , u.user_name as enq_user_name , uss.user_name as allo_user_name, IFNULL(sup.name,cusname) as cus_name, CASE when v.id is null then concat("Name : ", i.name, " | Prate : ",i.prate, " | Srate : ", i.srate, " | MRP : ", i.MRP) else concat("Name : ", v.veh_name, " | No : ",v.veh_no, " | Model : ", v.veh_model, " | Brand: ", v.veh_brand) end as item_det';
        $this->table = 'v_enquiry_register as ver inner join v_enquiry_allocation as vea on ver.id = vea.enq_id and ver.bill_status=0 inner join users as u on vea.enq_user = u.Id inner join users as uss on vea.user = uss.Id left join suppliers as sup on ver.cus_id = sup.id left join item as i on ver.item_id = i.id and ver.type = 2 left join vehicles as v on ver.item_id=v.id and ver.type= 1';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('ver.id' => 'desc'); // default order 
    }

    public function where()
    {
        $userid = $this->session->userdata('user');
        $userid= $userid['Id'];
        $this->wherecondition = 'where vea.user = '. $userid;

        // if($this->input->post('date')){
        //     $this->wherecondition = $this->wherecondition.' and r.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        // }
        $this->wherecondition = $this->wherecondition . ' and ver.status < 3';
    }

    function getsing($id) {

        $qry = 'select *, ver.id as reg_id , ver.type as ver_type, ver.cus_id as cust_id, ver.item_id  as product_id, u.user_name as enq_user_name , uss.user_name as allo_user_name, sup.name as cus_name, CASE when i.id is null then v.veh_no else i.name end as product from v_enquiry_register as ver inner join v_enquiry_allocation as vea on ver.id = vea.enq_id inner join users as u on vea.enq_user = u.Id inner join users as uss on vea.user = uss.Id left join item as i on ver.item_id = i.id and ver.type =2 left join vehicles as v on ver.item_id = v.id and ver.type = 1 left join suppliers as sup on ver.cus_id = sup.id where ver.id=' . $id;
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

    function product($search) {
        $qry = "select name as label,a.*, a.srate as rate from item as a where name like'%" . $search . "%'";
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
