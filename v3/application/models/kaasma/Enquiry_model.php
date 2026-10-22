<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author Dimind
 */
require_once APPPATH . 'models/DataTable.php';

class Enquiry_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'kas_enquiry as a';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'enq_contact_person', 'enq_email', 'enq_phone'); //set column field database for datatable orderable   
        $this->column_search = array('a.enq_contact_person', 'a.enq_email'); //set column field database for datatable searchable 
        $this->order = array('a.enq_id' => 'desc'); // default order 
    }

    function where() {
        if($this->input->post('type')!='')
        {
            $this->wherecondition = "where a.enq_status = '" . $this->input->post('type') . "'";
        }
        else
        {
             $this->wherecondition = "";
        }
    }

   function getsing($id) {
        $qry = 'SELECT a.*,b.user_id  as re_user FROM `kas_enquiry` as a INNER JOIN kas_enq_user as b on a.enq_id=b.enq_id WHERE b.eus_id=(SELECT MAX(eus_id) from kas_enq_user ) and a.enq_id=' . $id;
        $result = $this->db->query($qry);
        
        echo json_encode($result->row_array());
    }
    function enq_status() {
        $qry = 'select * from kas_enq_status order by est_series';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
    function enq_timeline($id) {
        $qry = 'SELECT a.*,b.enq_id as enqid,b.enq_no as enqno, c.user_name as user,d.est_name as enqstatus FROM `kas_enq_user` as a INNER JOIN kas_enquiry as b on a.user_id=b.user_id INNER JOIN users as c on a.user_id=c.Id INNER JOIN kas_enq_status as d on a.enq_status=d.est_name WHERE a.enq_id='.$id.' GROUP by eus_id';
        $result = $this->db->query($qry);
        return $result->result_array();
    }
    function generatevouchernumber() {
        $noqry = 'SELECT enq_no FROM `kas_enquiry` WHERE enq_id=(SELECT MAX(enq_id) FROM kas_enquiry)';
        $noquery = $this->db->query($noqry);
        $prevno = $noquery->row_array();
        if ($noquery->num_rows() == 0) {
            return 1;
        } else {
            $num = $prevno['enq_no']+1;
            return $num;
        }
    }
    function InsertEnquiry($data) {
        $enq_no = $this->generatevouchernumber();
        $data['enq_no']= $enq_no;
        $enq_status = $data['enq_status'];
        $userid = $data['user_id'];
        $this->db->insert('kas_enquiry', $data);
        $insert_id = $this->db->insert_id();
        $user_data = array(
                        'enq_id '=>$insert_id,
                        'enq_status' => $enq_status,
                        'user_id'=>$userid,
                    );
            $this->db->insert('kas_enq_user', $user_data);
        return $insert_id;
    }

    function UpdateEnquiry($data, $id) {
        $this->db->where('enq_id', $id);
        $this->db->update('kas_enquiry', $data);
    }
    function enqtoservice($id) {
        $qry = "select enq_status as status from kas_enquiry as a where enq_id ='" . $id . "'";
        $query = $this->db->query($qry);
        $ex_status = $query->row()->status;
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        if($ex_status<3)
        {
            $status = $ex_status+1;
        }
        else
        {
            $status = $ex_status;
        }   
        $data = array(
            'enq_status' => $status,
            );
        $this->db->where('enq_id', $id);
        $this->db->update('kas_enquiry', $data);
        $insert_id = $id;
        $user_data = array(
                        'enq_id '=>$insert_id,
                        'enq_status' => $status,
                        'user_id'=>$userid,
                    );
        $qry = "select enq_status as status from kas_enq_user as a where enq_id ='" . $id . "' order by eus_id desc limit 1";
        $query = $this->db->query($qry);
        $eus_status = $query->row()->status;
        if($eus_status!=3)
        {
            $this->db->insert('kas_enq_user', $user_data);
        }
    }
    function getenquiry($phone) {
        $qry = "select count(enq_id) as no from kas_enquiry as a where enq_phone ='" . $phone . "'";
        $query = $this->db->query($qry);
        // return $query->row_array();
        $count = 0;
        $result = $query->result();
        foreach ($query->result() as $tt) {
            $total = $tt->no;
            if ($total > 0) {
                $count = 1;
            }
        }

        return $count;
    }
    function save($file_name=0) {
        $id = $this->input->post('id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $phone = $this->input->post('phone');
        $enq_no = $this->generatevouchernumber();
        $enq_date = $this->getDate($this->input->post('enq_date'));
        $enq_updated = $this->getDate($this->input->post('enq_up_date'));
        $email = $this->input->post('email');
        $coname = $this->input->post('coname');
        $re_user= $this->input->post('user_id');
        $cophone = $this->input->post('cophone');
        $tot_branch= $this->input->post('tot_branch');
        $enq_pic = $file_name;
        //$enq_status = $this->input->post('enq_status');
        $remarks = $this->input->post('remarks');
        $owner_name = $this->input->post('owner_name');
        $owner_phone = $this->input->post('owner_phone');
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $published = 'yes';
        if($id==0)
        {
            $enq_status = 0;
        }
        else
        {
            $enq_status = 0;
        }
        $data = array(
            'enq_contact_person' => $name,
            'enq_phone' => $phone,
            'enq_no' => $enq_no,
            'enq_created_on' => $enq_date,
            'enq_updated' => $enq_updated,
            'enq_email' => $email,
            'enq_company' => $coname,
            'enq_co_phone' => $cophone,
            'enq_total_branches' => $tot_branch,
            'enq_co_owner' => $owner_name,
            'enq_owner_phone'=>$owner_phone,
            'enq_status' => $enq_status,
            'enq_remarks'=>$remarks,
            'user_id'=>$userid,
            'published'=>$published,
            );
        if ($id == 0) {

            $getitemcount = $this->item->getenquiry($phone); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => false,
                    'type' => 1,
                    'message' => 'customer name exists'
                );
                //echo json_encode($response);
            } else {

                $this->db->insert('kas_enquiry', $data);
                $insert_id = $this->db->insert_id();
                $user_data = array(
                        'enq_id '=>$insert_id,
                        'enq_status' => $enq_status,
                        'user_id'=>$userid,
                    );
            $this->db->insert('kas_enq_user', $user_data);
                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Saved Successfully.'
                );
                }
        }
        else
        {
            $this->db->where('enq_id', $id);
            $this->db->update('kas_enquiry', $data);
            $insert_id = $id;
            $user_data = array(
                        'enq_id '=>$insert_id,
                        'enq_status' => $enq_status,
                        'user_id'=>$userid,
                    );
            $this->db->insert('kas_enq_user', $user_data);
            $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Updated Successfully.'
            );
        }

        
        echo json_encode($response);
    }
    function delete($id)
    {
        $qry = "delete from kas_enquiry where enq_id =".$id;
        $this->db->query($qry);
    }
    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='".$id."'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }
}
