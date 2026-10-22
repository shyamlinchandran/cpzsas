<?php

class Todoallocation_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];

        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];

        $this->select = 'r.*,uu.user_name as usss, u.user_name as name, ts.status as stats, usr.user_name as toname';
        $this->table = 'todo_register as r inner join users as u on u.Id = r.user inner join todo_status as ts on ts.id = r.status inner join todo_allocation as ta on ta.enq_id = r.id inner join users as usr on ta.user = usr.Id inner join users as uu on r.loggedin = uu.Id';
        $this->wherecondition = "where 1 and r.state <> 4";
        if($usertype != 1){
            $this->wherecondition = $this->wherecondition . ' and r.loggedin = ' . $userid;
        }

        // $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id WHERE loggedin ='.$userid;
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id)
    {

        $qry = 'select * from enquiry_register where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function completion()
    {
        $date = $this->getDate($this->input->post('date'));
        $id = $this->input->post('followup_id');
        $stt = $this->input->post('statt');
        $remarks = $this->input->post('remark');
        $amount = 0;
        $data = array(
            'enq_id' => $id,
            'dates' => $date,
            'status' => $stt,
            'amounts' => $amount,
            'remark' => $remarks,
        );


        if($stt == 1){
            $updata = array(
                'state' => 4,
            );
            $this->db->insert('todo_closure', $data);   
        }
        else{
            $updata = array(
                'state' => 2,
            );
        }

        $this->db->where('id', $id);
        $this->db->update('todo_register', $updata);

        $res = array(
            'status' => true,
            'message' => "Saved Sucessfully",
        );
        echo json_encode($res);
    }

    function product($search)
    {
        $qry = "select name as label,a.* from item as a where name like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getItems($id = 0)
    {
            $qry = "select ep.*, i.name as itemname from enquiry_product as ep inner join item as i on ep.product_id = i.id where ep.enquiry_id = " . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        
    }

    public function getdata($id)
    {
        $qry = "select tr.* from todo_register as tr where id = " . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
    }

    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getAllItems($type)
    {
            $qry = "select * from item where item_type_id = " . $type;
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        
    }



    /**
     * *******************************************************************************************************
     * 
     * getItems function will retrieve the enquired items from master
     * 
     * @author Althaf
     * @created on : 28-10-2019
     * 
     **********************************************************************************************************
     */


    public function getcompanydet($master, $search)
    {
        $qry = "select a.*, a.companyName as label from " . $master . " as a where companyName like '%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    /**
     * *******************************************************************************************************
     * 
     * varify function for varify the enquiry 
     * 
     * @author Althaf
     * @created on : 29-10-2019
     * 
     **********************************************************************************************************
     */

    public function varify()
    {
        $id = $this->input->post('var_id');
        $data2['status'] = 4;
        $this->db->where('id ', $id);
        $this->db->update('enquiry_register ', $data2);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Varified Successfully.'
        );

        echo json_encode($response);
    }

    function save_todo_allocation()
    {
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
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
            'Ddate' => $this->getDate($Ddate),
            'remark' => $remark
        );
        // $this->db->where('enq_id', $id);
        $qry = "delete from todo_allocation where enq_id = " . $id;
        $this->db->query($qry);
        $this->db->insert('todo_allocation ', $data);
        $insId = $this->db->insert_id();
        if ($insId) {

            $stat = array(
                'state' => 1,

            );
            $this->db->where('id', $id);
            $this->db->update('todo_register', $stat);

            $response = array(
                'valid' => true,
                'type' => $insId,
                'message' => 'Saved Successfully.'
            );
        } else {
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
        $userid = $userid['Id'];

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
        if (!empty($_POST['check']) || $checked_count > 0) {

            // Loop to store and display values of individual checked checkbox.
            foreach ($_POST['check'] as $selected) {
                $data['enq_id'] = $selected;
                $qry = "delete from enquiry_allocation where enq_id = " . $selected;
                $this->db->query($qry);
                $this->db->insert('enquiry_allocation ', $data);
                $insId = $this->db->insert_id();
                if ($insId) {

                    $stat = array(
                        'status' => 1,

                    );
                    $this->db->where('id', $selected);
                    $this->db->update('enquiry_register', $stat);

                    $response = array(
                        'valid' => true,
                        'type' => $insId,
                        'message' => 'Saved Successfully.'
                    );
                } else {
                    $response = array(
                        'valid' => false,
                        'message' => 'Something went wrong.'
                    );
                }
            }
            echo json_encode($response);
        } else {
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Nothing To Allocate.'
            );
            echo json_encode($response);
        }
    }


    function save_closure()
    {
        $id = $this->input->post('closure_id');
        $date = $this->input->post('dates');
        $amounts = $this->input->post('amounts');
        $remark = $this->input->post('remark');
        $data = array(
            'enq_id' => $id,
            'dates' => $this->getDate($date),
            'amounts ' => $amounts,
            'remark' => $remark
        );
        $data2['status'] = 6;
        $this->db->insert('enquiry_closure ', $data);
        $this->db->where('id ', $id);
        $this->db->update('enquiry_register ', $data2);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    function delete($id)
    {
        $qry = "delete from  todo_register where id =" . $id;
        $this->db->query($qry);

        $response = array(
            'status' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
    }

    public function deleteEnq($data)
    {
        $qry = "delete from enquiry_register where id in (" . $data . ")";
        $this->db->query($qry);
        $qry = "delete from enquiry_allocation where enq_id in (" . $data . ")";
        $this->db->query($qry);
        $qry = "delete from enquiry_followup where enquiry_id in (" . $data . ")";
        $this->db->query($qry);
        $qry = "delete from enquiry_closure where enq_id in (" . $data . ")";
        $this->db->query($qry);

        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Deleted Successfully.'
        );

        echo json_encode($response);
    }

    function user()
    {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value="">Select</option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '" >' . $row["user_name"] . '</option>';
        }
        print_r($option);
    }

    function company($search)
    {
        $qry = "select companyName as label,a.* from enquiry_register as a where companyName like'%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function otheritem($id)
    {
        $qry = "SELECT b.id,b.name,a.price,a.quantity FROM `enquiry_product` as a INNER JOIN item as b on a.`product_id`=b.id WHERE a.enquiry_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getItemTypes()
    {
        $qry = "SELECT * FROM item_type WHERE 1";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }


    function save()
    {
        $id = $this->input->post('id');
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $user = $this->input->post('user');
        $task = $this->input->post('task');
        $status = $this->input->post('stat');
        $date = $this->input->post('date');
        $data = array(
            'state' => 1,
            'status' => $status,
            'task' => $task,
            'user' => $user,
            'loggedin' => $userid,
            'date' => $this->getDate($date),
        );
        
            if ($id == '0') {

                $this->db->insert('todo_register', $data);
                $insert_id = $this->db->insert_id();
                $data2 = array(
                    'enq_id' => $insert_id,
                    'Sdate' => $this->getDate($date),
                    'enq_user' => $userid,
                    'user' => $user,
                );
                // $this->db->where('enq_id', $id);
                $qry = "delete from todo_allocation where enq_id = " . $id;
                $this->db->query($qry);
                $this->db->insert('todo_allocation ', $data2);
            } else {

                $this->db->where('id', $id);
                $this->db->update('todo_register ', $data);
            }
    
        
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    public function getStatus()
    {
        $qry = "SELECT * from todo_status";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
}
