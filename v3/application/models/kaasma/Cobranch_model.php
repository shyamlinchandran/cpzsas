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
class Cobranch_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'kas_companies as a';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'cmp_name', 'cmp_email', 'cmp_phone', 'cmp_owner'); //set column field database for datatable orderable   
        $this->column_search = array('cmp_name', 'cmp_email'); //set column field database for datatable searchable 
        $this->order = array('a.cmp_id' => 'desc'); // default order 
    }

    function where() {
        if($this->input->post('com_id')!='')
        {
            $this->wherecondition = "where a.fk_company = '" . $this->input->post('com_id') . "'";
        }
        else
        {
             $this->wherecondition = "";
        }
    }

   function getsing($id) {
        $qry = 'select * from kas_companies where cmp_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function getcategorycount($name) {
        $qry = "select count(id) from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }
    public function Add_item($data_item) {
        $this->db->insert('item', $data_item);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
    function checkcompany($name) {
        $qry = "select count(cmp_id) as no from kas_companies as a where cmp_name ='" . $name . "'";
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
        $com_id = $this->input->post('com_id');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $email = $this->input->post('email');
        $district_id = $this->input->post('district_id');
        $location = $this->input->post('location');
        $tot_branch= 0;
        $com_status = 1;//$this->input->post('com_status');
        $owner_name = $this->input->post('owner_name');
        $contact_person = $this->input->post('contact_p');
        $customer_type = $this->input->post('cus_type');
        $slab_id = $this->input->post('slab_id');
        $pic = $file_name;//$this->input->post('slab_id');
        $pincode= $this->input->post('pincode');
        $interest_rate= $this->input->post('interest_p');
        $status = 1;
        $published = 'yes';
        $data = array(
            'fk_company'=>$com_id,
            'cmp_name' => $name,
            'cmp_address'=>$address,
            'district_id'=>$district_id,
            'cmp_phone' => $phone,
            'cmp_email' => $email,
            'cmp_location' => $location,
            'cmp_owner'=>$owner_name,
            'cmp_branches' => $tot_branch,
            'contact_person'=> $contact_person,
            'customer_type' => $customer_type,
            'slab_id' => $slab_id,
            'location_photo' => $pic,
            'cmp_pincode' => $pincode,
            'interest_rate' => $interest_rate,
            'cmp_status'=>$status,
            );
        if ($id == 0) {

            $getitemcount = $this->item->checkcompany($name); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'company name exists'
                );
                echo json_encode($response);
            } else {

                $this->db->insert('kas_companies', $data);
                $insert_id = $this->db->insert_id();
                }
        }
            $this->db->where('cmp_id', $id);
            $this->db->update('kas_companies', $data);
            $insert_id = $id;
            $published = 'yes';
            $exist = 1;

        
        $response = array(
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }
    function delete($id)
    {
        $qry = "delete from kas_companies where cmp_id =".$id;
        $this->db->query($qry);
    }
}
