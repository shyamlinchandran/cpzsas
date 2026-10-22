<?php


class Enquirylist_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();

        $this->select = '*, ver.id as reg_id, u.user_name as enq_user_name , uss.user_name as allo_user_name, sup.name as cus_name, case when v.id is null then concat("Name : ", i.name, " | Prate : ",i.prate, " | Srate : ", i.srate, " | MRP : ", i.MRP)  else  concat("Vehicle Name : ", v.veh_name, " | No : ",v.veh_no, " | Model : ", v.veh_model, " | Brand : ", v.veh_brand) end as item_det';
        $this->table = 'service_bill_main as sbm inner join v_enquiry_register as ver on sbm.call_id = ver.id inner join v_enquiry_allocation as vea on ver.id = vea.enq_id inner join users as u on vea.enq_user = u.Id inner join users as uss on vea.user = uss.Id left join suppliers as sup on ver.cus_id = sup.id left join item as i on ver.item_id = i.id and ver.type = 2 left join vehicles as v on ver.item_id = v.id and ver.type = 1';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('sbm.id' => 'desc'); // default order 
    }

    public function where()
    {
        $sDate = $this->getDate($this->input->post('fromDate'));
        $eDate = $this->getDate($this->input->post('toDate'));

        $userid = $this->session->userdata('user');
        $userid= $userid['Id']; 
        $this->wherecondition = 'where vea.user = '.$userid;
        if($this->input->post('dat') == 'date'){
            $this->wherecondition = $this->wherecondition . " and vea.Sdate >= '".$sDate."' and vea.Sdate <= '" .$eDate. "'";
        }  
        if ($this->input->post('userss')) {
            $this->wherecondition = $this->wherecondition . " and vea.user = " . $this->input->post('userss');
        } 
        if ($this->input->post('source')) {
            $this->wherecondition = $this->wherecondition . " and ver.source = " . $this->input->post('source');
        }
        if ($this->input->post('area')) {
            $this->wherecondition = $this->wherecondition . " and ver.area = " . $this->input->post('area');
        }
        if ($this->input->post('state')) {
            $this->wherecondition = $this->wherecondition . " and ver.location = " . $this->input->post('state');
        }
        if ($this->input->post('types') > 0) {
            $this->wherecondition = $this->wherecondition . " and ver.type = " . $this->input->post('types');
        }
        if ($this->input->post('productss') > 0) {
            $this->wherecondition = $this->wherecondition . " and ver.product_id = " . $this->input->post('productss');
        }
        $this->wherecondition = $this->wherecondition . ' and ver.status < 6';

        if($this->input->post('date')){
            $this->wherecondition = $this->wherecondition.' and ver.next_follow_up_date ="'.$this->getDate($this->input->post('date')).'" ';
        }
    }

    public function get_services($search)
    {
        $qry = "SELECT vea.*, ver.*, vea.user as alloc_user, vea.enq_user as enqu_user, sup.id as sup_id, sup.name as sup_name, ver.serv_no as label, ver.id as ver_id from v_enquiry_register as ver inner join v_enquiry_allocation as vea on ver.id = vea.enq_id inner join suppliers as sup on ver.cus_id = sup.id where ver.serv_no like '%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function get_services_from_id($id)
    {
        $qry = "SELECT vea.*, ver.*, vea.user as alloc_user, vea.enq_user as enqu_user, sup.id as sup_id, IFNULL(sup.name,cusname) as sup_name, ver.serv_no as label, ver.id as ver_id from v_enquiry_register as ver inner join v_enquiry_allocation as vea on ver.id = vea.enq_id left join suppliers as sup on ver.cus_id = sup.id where ver.id = " . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function get_item_details()
    {
        $type = $this->input->post('type');
        $item_id = $this->input->post('item_id');
        if ($type == 1) {
            $qry = "select * from vehicles where id = " . $item_id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = "select * from item where id = " . $item_id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        }
    }

    function getsing($id)
    {

        $qry = 'select *, ver.serv_no as service_no, scm.status as stat, ver.item_id as item_idd from service_bill_main as scm inner join v_enquiry_register as ver on scm.call_id = ver.id where scm.id = ' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    public function getsing_item($id)
    {
        $qry = 'select * from service_bill_sub where published = "yes" and bill_id = ' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getsing_ledgers($id)
    {
        $qry = 'select * from service_bill_ledger where published = "yes" and bill_id = ' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function save()
    {
        $id = $this->input->post('id');
        $serv_id = $this->input->post('serv_id');
        $serv_user = $this->input->post('serv_user');
        $status = $this->input->post('completionstat');
        // Items Detils
        $product_id = $this->input->post('product_id', true);
        $product_name = $this->input->post('product_name', true);
        $item_quantity = $this->input->post('item_quantity', true);
        $item_price = $this->input->post('item_price', true);
        $item_taxz = $this->input->post('item_taxz', true);
        $item_tax_amt = $this->input->post('item_tax_amt', true);
        $tot_amt_price = $this->input->post('tot_amt_price', true);
        // Item Details Ends

        // Ledger Details
        $serv_ledgerid = $this->input->post('serv_ledgerid', true);
        $ledg_name = $this->input->post('ledg_name', true);
        $serv_taxid = $this->input->post('serv_taxid', true);
        $tax_name = $this->input->post('tax_name', true);
        $serv_amt = $this->input->post('serv_amt', true);
        $serv_taxamt = $this->input->post('serv_taxamt', true);


        $call_status =  $this->input->post('status');
        $engineer_remarks =  $this->input->post('engineer_remarks');
        $closed_remarks =  $this->input->post('closed_remarks');
        // Ledger Details Ends

        $data = array(
            'call_id' => $serv_id,
            'date' => date('Y-m-d'),
            'call_status'=>$call_status,
            'engineer_remarks'=>$engineer_remarks,
            'closed_remarks'=>$closed_remarks,
            'serv_eng' => $serv_user,
            'status' => $status,
        );

        if ($id <= 0) {
            $this->db->insert('service_bill_main', $data);
            $ins_id = $this->db->insert_id();
            $this->db->where('id',$serv_id)->update('v_enquiry_register',['bill_status'=>1]);
        } else {
            $ins_id = $id;
            $this->db->where('id', $ins_id);
            $this->db->update('service_bill_main', $data);
        }

        $qry = 'update service_bill_sub set published = "no" where bill_id = ' . $ins_id;
        $this->db->query($qry);
        $qry = 'update service_bill_ledger set published = "no" where bill_id = ' . $ins_id;
        $this->db->query($qry);

        if ($product_id !== null && $product_id !== '' && $product_id !== '[]') {
            for ($i = 0; $i < count($product_id); $i++) {
                $data = array(
                    'bill_id' => $ins_id,
                    'item_id' => $product_id[$i],
                    'item_name' => $product_name[$i],
                    'quantity' => $item_quantity[$i],
                    'price' => $item_price[$i],
                    'tax' => $item_taxz[$i],
                    'tax_amt' => $item_tax_amt[$i],
                    'total' => $tot_amt_price[$i],
                    'published' => 'yes',
                );
                $this->db->insert('service_bill_sub', $data);
            }
        }

        if ($serv_ledgerid !== null && $serv_ledgerid !== '' && $serv_ledgerid !== '[]') {
            for ($i = 0; $i < count($serv_ledgerid); $i++) {
                $data = array(
                    'bill_id' => $ins_id,
                    'ledger_id' => $serv_ledgerid[$i],
                    'ledg_name' => $ledg_name[$i],
                    'tax_id' => $serv_taxid[$i],
                    'tax_perc' => $tax_name[$i],
                    'serv_amt' => $serv_amt[$i],
                    'tax_amt' => $serv_taxamt[$i],
                    'published' => 'yes',
                );
                $this->db->insert('service_bill_ledger', $data);
            }
        }
        if ($status == 2 || $status == '2') {
            $data = array(
                'status' => 3,
            );
            $this->db->where('id', $serv_id);
            $this->db->update('v_enquiry_register', $data);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }
}
