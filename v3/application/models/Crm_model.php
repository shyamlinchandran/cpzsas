<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author sathyan
 */
class Crm_model   extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'e.*,c.id as coid,c.name as company,c.email as email,c.phone as phone, c.address as address,c.contact_person as contact';
        $this->table = 'crm_enquiry as e join crm_customers as c on e.company_id=c.id';

        $this->column_order = array(null,'co_id'); //set column field database for datatable orderable
        $this->column_search = array('c.name','c.phone','c.email'); //set column field database for datatable searchable 
        $this->order = array('c.id' => 'desc'); // default order 
    }
     /*function where() {
 
          
            $this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        
         
    }*/



    function save() {
        
        $id = $this->input->post('id', true);
        $date = $this->getDate($this->input->post('date', true));
        $location = $this->input->post('location', true);
        $company_id = $this->input->post('customer_id', true);
        $contact = $this->input->post('contact', true);
        $location = $this->input->post('location', true);
        //$address = $this->input->post('address', true);
        $enqsrc = $this->input->post('source', true);
        $btype = $this->input->post('business', true);
        $product = $this->input->post('product', true);
        $remarks = $this->input->post('remarks', true);
        $fdate = $this->getDate($this->input->post('fdate', true));
        $itime = $this->getDate($this->input->post('itime', true));
        $otime = $this->getDate($this->input->post('otime', true));
        $insert_id = 0;
        $data = array(
                'company_id' => $company_id,
                'date' =>$date,
                'location' => $location,
                'remarks' => $remarks,
                'enq_source' => $enqsrc,
                'business_nature' =>$btype,
                'product' => $product,
                'follow_date' => $fdate,
                'in_time' => $itime,
                'out_time' => $otime

                );

            if ($id == 0) {
                $this->db->insert('crm_enquiry', $data);
                $insert_id = $this->db->insert_id();

            } else {
                $insert_id = $id;
                $this->db->where('id', $id);
                $this->db->update('crm_enquiry', $data);
                
            }
            $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
            echo json_encode($response);
            
        }

         function getsing($id) {
        $qry = "select e.*,p.id as productid,p.name as product,s.id as sourceid,s.name as source,b.id as busnsid,b.name as business,c.id as coid, c.name as co_name,c.contact_person as contact,c.phone as phone,c.email as email,c.address as address from crm_enquiry as e left outer join crm_product as p on e.product=p.id left outer join crm_enq_src  as s on e.enq_source=s.id left outer join crm_busn_ntr  as b on e.business_nature=b.id inner join crm_customers as c on e.company_id=c.id where e.id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    
    function product() {
        $qry = 'select id,name from crm_product';
        $re = $this->db->query($qry);
        return $re->result_array();
    }
    function enquiry() {
        $qry = 'select id,name from crm_enq_src';
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function business() {
        $qry = 'select id,name from crm_busn_ntr';
        $re = $this->db->query($qry);
        return $re->result_array();
    }

   function crm_customer($search) {
       $qry = "select a.name as label,a.* from crm_customers as a where (name like('%$search%') or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

}