<?php


class Leadsmaster_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();

        $this->select = 'l.*';
        $this->table = 'lead_register as l';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('l.id' => 'desc'); // default order 
    }

    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getAllocation()
    {
        $id = $this->input->post('supid');
        $this->select = 'r.*,r.date as sdate,a.Edate,a.Ddate, u.user_name as username';
        $this->table = 'enquiry_register as r inner join enquiry_allocation as a on a.enq_id = r.id inner join users as u on a.user = u.Id';
        $this->wherecondition = ' where r.lead_id = ' . $id;
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     ********************************************************************************************************** 
     */

    public function getProducts()
    {
        $id = $this->input->post('supid');
        $this->select = 'p.*, i.name as itemname';
        $this->table = 'enquiry_register as r inner join enquiry_product as p on r.id = p.enquiry_id inner join item as i on p.product_id = i.id';
        $this->wherecondition = ' where r.lead_id = ' . $id;
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('companyName'); //set column field database for datatable searchable 
        $this->order = array('r.id' => 'desc'); // default order 
    }

    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function deleteLeads($data)
    {
        $qry = "delete from lead_register where id in (" . $data . ")";
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);
    }
    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getStatus($id)
    {
        $qry = "select er.*, lr.*,lr.updateddate as ldate, ef.date as fdate, er.updateddate as edate, ec.updateddate as closedate, us.username as username, er.next_follow_up_date as nextfollow, er.status as estatus, er.date as edate, ea.Edate as allodate, ea.Ddate as delidate from lead_register as lr left join enquiry_register as er on er.lead_id = lr.id inner join users as us on lr.loggedin = us.Id left join enquiry_allocation as ea on er.id = ea.enq_id left join enquiry_closure as ec on er.id = ec.enq_id left join enquiry_followup as ef on er.id = ef.enquiry_id where lr.id = " . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getArea()
    {
        $qry = "select a.* from ims_area as a";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function save_bill($id)
    {
        $data = array(
            'status' => 7,
        );
        $this->db->where('id', $id);
        $this->db->update('enquiry_register', $data);
    }

    public function save_nobill($id)
    {
        $data = array(
            'status' => 6,
        );
        $this->db->where('id', $id);
        $this->db->update('enquiry_register', $data);
    }

    



    /**
     * *******************************************************************************************************
     * 
     * deleteLeads fun 
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function getEnqId()
    {
        $id = $this->input->post('idd');
        $qry = "select * from enquiry_register where lead_id = " . $id;
        // print_r($qry);
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }



    /**
     * *******************************************************************************************************
     * 
     * addToEnquiry fun
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function addToEnquiry($data)
    {
        $qry = "INSERT INTO enquiry_register SELECT * FROM lead_register WHERE id in (" . $data . ")";
        $this->db->query($qry);

        $qry = "UPDATE lead_register SET status = 1 where id in (" . $data . ")";
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Added Successfully.'
        );

        echo json_encode($response);
    }

    /**
     * *******************************************************************************************************
     * 
     * addEnquiry fun
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function addEnquiry($id)
    {
        $qry = "INSERT INTO enquiry_register SELECT * FROM lead_register WHERE id = " . $id;
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Added Successfully.'
        );

        echo json_encode($response);
    }

    /**
     * *******************************************************************************************************
     * 
     * Delete fn for delete the particular lead
     * 
     * @author Althaf
     * @created on : 30-10-2019
     * 
     **********************************************************************************************************
     */

    public function delete($id)

    {
        $qry = "delete from lead_register where id = " . $id;
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);
    }

    public function getAll($id)
    {
        $qry = "SELECT lr.*, states.StateName as district, user.user_name as createdby from lead_register as lr inner join state as states on lr.location = states.StateID inner join users as user on lr.loggedin = user.Id where lr.id = " . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function list_type_bussiness()
    {
        $this->select = 't.*, t.updateddate as date, t.type as types, t.note as notes';
        $this->table = 'bussiness_type as t';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('t.type'); //set column field database for datatable searchable 
        $this->order = array('t.id' => 'desc'); // default order 
    }

    public function list_other_bussiness()
    {
        $this->select = 't.*, t.updateddate as date, t.type as types, t.note as notes';
        $this->table = 'bussiness_other as t';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('t.type'); //set column field database for datatable searchable 
        $this->order = array('t.id' => 'desc'); // default order 
    }

    public function deleteBussinessother($id)
    {
        $qry = "delete from bussiness_other where id = " . $id;
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);
    }
    public function getAllBussOther($id = 0)
    {

        if ($id > 0) {
            $qry = "SELECT * from bussiness_other where id = " . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = "SELECT * from bussiness_other";
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
    }

    public function deleteBussinessType($id)
    {
        $qry = "delete from bussiness_other where id = " . $id;
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);
    }

    public function getAllBussType($id = 0)
    {
        if ($id > 0) {
            $qry = "SELECT * from bussiness_type where id = " . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = "SELECT * from bussiness_type";
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
    }

    public function saveTypeBussiness()
    {
        $type = $this->input->post('type');
        $note = $this->input->post('note');
        $data = array(
            'type' => $type,
            'note' => $note,
        );

        if ($this->input->post('id') > 0) {

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('bussiness_type', $data);
        } else {
            $this->db->insert('bussiness_type', $data);
        }
        $response = array(
            'status' => True,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
    }
    public function saveOtherBussiness()
    {
        $type = $this->input->post('type');
        $note = $this->input->post('note');
        $data = array(
            'type' => $type,
            'note' => $note,
        );

        if ($this->input->post('id') > 0) {

            $this->db->where('id', $this->input->post('id'));
            $this->db->update('bussiness_other', $data);
        } else {
            $this->db->insert('bussiness_other', $data);
        }
        $response = array(
            'status' => True,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
    }
}
