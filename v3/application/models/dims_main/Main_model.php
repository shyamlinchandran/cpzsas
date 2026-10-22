<?php


class Main_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();

        $this->select = 'es.*';
        $this->table = 'email_settings as es';
        $this->column_order = array(null, 'id'); //set column field database for datatable orderable
        $this->column_search = array(''); //set column field database for datatable searchable 
        $this->order = array('es.id' => 'desc'); // default order 
    }

    public function email_type()
    {
        $this->select = 'et.*';
        $this->table = 'email_type as et';
        $this->column_order = array(null, 'type'); //set column field database for datatable orderable
        $this->column_search = array(''); //set column field database for datatable searchable 
        $this->order = array('et.id' => 'desc'); // default order 
    }

    public function email_list()
    {
        $this->select = 'e.*, et.type as types';
        $this->table = 'email as e inner join email_type as et on e.email_type = et.id';
        $this->column_order = array(null, 'id'); //set column field database for datatable orderable
        $this->column_search = array(''); //set column field database for datatable searchable 
        $this->order = array('e.id' => 'desc'); // default order 
    }

    public function service_list()
    {
        $this->select = 's.*';
        $this->table = 'service as s';
        $this->column_order = array(null, 'service'); //set column field database for datatable orderable
        $this->column_search = array(''); //set column field database for datatable searchable 
        $this->order = array('s.id' => 'desc'); // default order 
    }

    public function customer_list()
    {
        $this->select = 'cc.*, c.name as company_name';
        $this->table = 'customer_config as cc inner join company as c on cc.company = c.com_id';
        $this->column_order = array(null, 'cc.name'); //set column field database for datatable orderable
        $this->column_search = array(''); //set column field database for datatable searchable 
        $this->order = array('cc.id' => 'desc'); // default order 
    }

    public function getEmailType()
    {
        $qry = "select * from email_type";
        $res = $this->db->query($qry);
        echo json_encode($res->result_array());
    }

    public function getServices()
    {
        $qry = "select * from service";
        $res = $this->db->query($qry);
        echo json_encode($res->result_array());
    }

    public function getCompany($id = 0)
    {
        if($id > 0){
            $qry = "select * from company where com_id = ".$id;
            $res = $this->db->query($qry);
            return $res->row_array();
        }
        else{
            $qry = "select * from company";
            $res = $this->db->query($qry);
            echo json_encode($res->result_array());
        }
        
        
    }

    
    function getEmail($id)
    {
        $qry = "select * from email where id = " . $id;
        $res = $this->db->query($qry);
        return $res->row_array();
    }

    public function getsing_emailsetting($id)
    {
        $qry = "select * from email_settings where id = " . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->row_array());
    }

    public function getsing_emailtype($id)
    {
        $qry = "select * from email_type where id = " . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->row_array());
    }

    public function getsing_email($id)
    {
        $qry = "select * from email where id = " . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->row_array());
    }

    public function getsing_service($id)
    {
        $qry = "select * from service where id = " . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->row_array());
    }

    public function getsing_customer($id)
    {
        $qry = "select cc.*, cc.id as main_id, ccs.*, ccs.id as sub_id from customer_config as cc inner join customer_config_sub as ccs on cc.id = ccs.main_id where ccs.published = 'yes' and cc.id = " . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->result_array());
    }

    public function getConfiguration($id)
    {
        $qry = "select cc.*, s.service as service_name, cc.id as main_id, ccs.*, ccs.id as sub_id from customer_config as cc inner join customer_config_sub as ccs on cc.id = ccs.main_id inner join service as s on ccs.service = s.id where ccs.published = 'yes' and cc.id = " . $id;
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    

    public function saveCustomer()
    {
        $id = $this->input->post('id');
        $company = $this->input->post('company');
        $email = $this->input->post('email');
        $grdtot = $this->input->post('grdtot');

        $service = $this->input->post('service_id', true);
        $samount = $this->input->post('samount', true);
        $sdate = $this->input->post('sdate', true);
        $edate = $this->input->post('edate', true);

        $data = array(
            'company' => $company,
            'email' => $email,
            'total' => $grdtot,
        );

        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('customer_config', $data);

            $updateddata = array(
                'published' => 'no',
            );
            $this->db->where('main_id', $id);
            $this->db->update('customer_config_sub', $updateddata);
        } else {
            $this->db->insert('customer_config', $data);
            $ins_id = $this->db->insert_id();
            $id = $ins_id;
        }

        $length = count($service);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'service' => $service[$i],
                'samount' => $samount[$i],
                'main_id' => $id,
                'startdate' => $this->getDate($sdate[$i]),
                'enddate' => $this->getDate($edate[$i]),
                'published' => 'yes',
            );
            $this->db->insert('customer_config_sub', $data);
        }

        return $id;
    }

    public function saveService()
    {
        $id = $this->input->post('id');
        $service = $this->input->post('service');

        $data = array(
            'service' => $service,
        );

        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('service', $data);
        } else {
            $this->db->insert('service', $data);
        }

        $response = array(
            'result' => true,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
    }

    public function saveEmail()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('msgtype');
        $message = $this->input->post('msg');


        $data = array(
            'email_type' => $type,
            'message' => $message,
        );

        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('email', $data);
        } else {
            $this->db->insert('email', $data);
        }
        $response = array(
            'result' => true,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
    }

    public function saveEmailType()
    {
        $id = $this->input->post('id');
        $type = $this->input->post('type');

        $data = array(
            'type' => $type,
        );

        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('email_type', $data);
        } else {
            $this->db->insert('email_type', $data);
        }

        $response = array(
            'result' => true,
            'message' => 'Saved Successfully',
        );

        echo json_encode($response);
    }

    public function saveEmailSettings()
    {
        $id = $this->input->post('id');
        $host = $this->input->post('host');
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $port = $this->input->post('port');
        $from_address = $this->input->post('from_address');
        $reply_address = $this->input->post('reply_address');
        $data = array(
            'smtp_host' => $host,
            'smtp_username' => $username,
            'smtp_password' => $password,
            'smtp_port' => $port,
            'reply_address' => $reply_address,
            'from_address' => $from_address,
        );
        if ($id <= 0) {
            $this->db->insert('email_settings', $data);
        } else {
            $this->db->where('id', $id);
            $this->db->update('email_settings', $data);
        }

        $response = array(
            'result' => true,
            'message' => 'Saved Successful',
        );
        echo json_encode($response);
    }
}
