<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cominfo_model
 *
 * @author dimind
 */
class Cominfo_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*';
        $this->table = 'company as a';
        $this->column_order = array(null, 'name', 'tin', 'logo', 'phone', 'address'); //set column field database for datatable orderable
        $this->column_search = array('name', 'tin'); //set column field database for datatable searchable 
        $this->order = array('a.com_id' => 'desc'); // default order 
    }

    function getsing($id) {
        $qry = 'SELECT a.* FROM company as a WHERE a.com_id=' . $id;
        $result = $this->db->query($qry);

        echo json_encode($result->row_array());
    }

    function save($file_name) {
        $id = $this->input->post('id'); // if it is zero then we will add the item
        $name = $this->input->post('coname');
        $hiddlogo = $this->input->post('hiddlogo');
        if ($file_name == '') {
            $file_name = $hiddlogo;
        }
        $name_lan = $this->input->post('name_lan');
        $phone = $this->input->post('cophone');
        $email = $this->input->post('email');
        $gstin = $this->input->post('gstin');
        $pan = $this->input->post('pan');
        $details = $this->input->post('details');
        $address = $this->input->post('address');
        $address_lan = $this->input->post('address_lan');
        $FSSAI = $this->input->post('FSSAI');

        $location = $this->input->post('location');
        $pincode = $this->input->post('pincode');
        $apiusername = $this->input->post('apiusername');
        $apipassword = $this->input->post('apipassword');
        $data = array(
            'location' => $location,
            'pincode' => $pincode,
            'apiusername' => $apiusername,
            'apipassword' => $apipassword,
            'name' => $name,
            'pan' => $pan,
            'name_lan' => $name_lan,
            'FSSAI' => $FSSAI,
            'comkey' => 123,
            'logo' => $file_name,
            'is_multiplegodown' => 0,
            'address' => $address,
            'address_lan' => $address_lan,
            'email' => $email,
            'phone' => $phone,
            'tin' => $gstin,
            'details' => $details,
            'menutype' => 1,
            'company_master' => 1,
        );
        if ($id == 0) {
            $this->db->insert('company', $data);
            $insert_id = $this->db->insert_id();
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
        } else {
            $this->db->where('com_id', $id);
            $this->db->update('company', $data);
            $insert_id = $id;
            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        }


        echo json_encode($response);
    }

}
