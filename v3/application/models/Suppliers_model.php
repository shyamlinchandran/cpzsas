<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items_model
 *
 * @author jijodileep
 */
class Suppliers_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.*,ia.area';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'suppliers as a left join ims_area as ia on ia.id = a.area';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'phone', 'address_line1','tin'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where() {
        $this->wherecondition = "where a.type = '" . $this->input->post('type') . "'";
        $settings = $this->getCompanySettings();
        $tmp = $this->session->userdata('user');
        $customer_branch = 0 ;
        if(isset( $settings[0]['customer_branch']) && $tmp['utype'] != 'Admin'){
            $branch = $tmp['branch'];
			//  $this->wherecondition =  $this->wherecondition .' and a.branch = '.$branch;
        }
		if($this->input->post('area')){
			 $this->wherecondition =  $this->wherecondition .' and a.area = '.$this->input->post('area');
		}
    }

    function getproducts($id) {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function gettransfer($id) {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer as a inner join transfer_items as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getsing($id) {
        $qry = 'select a.*,b.id as spledgid,b.openning_bal as openingbal,b.type as crtype from suppliers as a INNER JOIN acc_ledgers as b on a.id=b.ref_id where b.ref_code in ("cus","sup") and  a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function states() {
        $qry = 'select * from state';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

    function getledgerid($id) {
        $getqry = "SELECT id FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code in ('cus','sup') ";
        $result = $this->db->query($getqry);
        $ldgid = $result->row()->id;
        return $ldgid;
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

    public function Add_item_ledger($data_item_ledger) {
        $this->db->insert('item_ledger', $data_item_ledger);
    }

    function getpurchase($type, $id) {
        $qry = "select count(id) as purccount from purchase where published = 'yes' and `supplier_id`=" . $id . " and `type`='" . $type . "'";
        $result = $this->db->query($qry);
        $count = $result->row()->purccount;
        return $result->row()->purccount;
    }

    public function suppLedgerbal($id) {
        $getqry = "SELECT id FROM `acc_ledgers` WHERE ref_id=$id and ref_code in ('sup') ";
        $result = $this->db->query($getqry);
        $ldgid = $result->row()->id;
        $qry = "Select (sum(tran_debit)-sum(tran_credit)) as amt from acc_ledger_trans where `published`='yes' and `ledger_id` =" . $ldgid;
        $query = $this->db->query($qry)->row_array();
        return $query['amt'];
    }

    function getvouchers($id) {
        $qry = 'select count(voucher_id) as totvouchers from voucher_trans as v inner join acc_ledgers as a on v.acc_ledgers_id=a.id where a.ref_id=' . $id;
        $result = $this->db->query($qry);
        $count = $result->row()->totvouchers;
        return $result->row()->totvouchers;
    }

    function getgroupcount($name) {
        $qry = "select count(id) from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getsupplier($name) {
        $qry = "select count(id) as no from suppliers as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
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

    function save() {
        $settings = $this->getCompanySettings();
        $customer_branch = 0 ;
        if(isset( $settings[0]['customer_branch'])){
            $customer_branch = $settings[0]['customer_branch'];
        }
        $id = $this->input->post('id');
        $pan = $this->input->post('pan');
        $name = $this->input->post('name'); 
        $phone = $this->input->post('phone');
        $tin = $this->input->post('gstin');
        $name_lan = $this->input->post('name_lan');
        $cst = $this->input->post('states_cus');
        $gst = $this->input->post('stcode');
        $email = $this->input->post('email');
        $address_line1 = $this->input->post('address_line1');
        $address_line2 = $this->input->post('address_line2');
        $address_line1_lan = $this->input->post('address_line1_lan');
        $address_line2_lan = $this->input->post('address_line2_lan');
        $details = $this->input->post('remarks');
        $type = $this->input->post('type');
        $bank = $this->input->post('bankname');
        $account_no = $this->input->post('accno');
        $ifsc_code = $this->input->post('ifscc');
        $pincode = "";
			if($this->input->post('pincode')){
				$pincode = $this->input->post('pincode');
			}
        $published = 'yes';
        $credit_period = $this->input->post('credit');
        $route = $this->input->post('route');
        $area = $this->input->post('area_cus');
        $price_list = $this->input->post('price_list');
        $opening_bal = $this->input->post('opening_bal');
        $credit_period_exceed = 0;
		$credit_amount = 0;
		$credit_amount_exceed = 0;
		if($this->input->post('cr_period_exceed')){
			$credit_period_exceed = $this->input->post('cr_period_exceed');
		}
		if($this->input->post('credit_amount')){
			$credit_amount = $this->input->post('credit_amount');
		}
		if($this->input->post('cr_amount_exceed')){
			$credit_amount_exceed = $this->input->post('cr_amount_exceed');
		}
        if($this->input->post('opening_bal')==""){
           $opening_bal =0; 
        }
        $credit_type = $this->input->post('credit_type');
        if(!$this->input->post('credit'))
        {
            $credit_period = 0;
        }
        $data = array(
            'name' => $name,
			'credit_amount_exceed'=>$credit_amount_exceed ,
			'credit_amount'=>$credit_amount,
			'credit_period_exceed'=>$credit_period_exceed,
            'phone' => $phone,
            'tin' => str_replace(' ', '', $tin),
            'cst' => $cst,
            'pan'=>$pan,
            'gst' => $gst,
            'pincode'=>$pincode,
            'email' => $email,
            'address_line1' => $address_line1,
            'address_line2' => $address_line2,
            'details' => $details,
            'type' => $type,
            'published' => $published,
            'credit_period' => $credit_period,
            'bank' => $bank,
            'account_no' => $account_no,
            'ifsc_code' => $ifsc_code,
            'route' => $route,
            'area' => $area,
            'price_list' => $price_list,
        );
        if($this->input->post('code')){
            $data['code'] =$this->input->post('code');
        }
		if($this->input->post('contact_number')){
            $data['contact_number'] =$this->input->post('contact_number');
        }
		if($this->input->post('contact_person')){
            $data['contact_person'] =$this->input->post('contact_person');
        }
        if($this->input->post('name_lan')){
            $data['name_lan'] =$this->input->post('name_lan');
        }
        if($this->input->post('address_line1_lan')){
            $data['address_line1_lan'] =$this->input->post('address_line1_lan');
        }
        if($this->input->post('address_line2_lan')){
            $data['address_line2_lan'] =$this->input->post('address_line2_lan');
        }
        if ($id == 0) {

            $getitemcount = $this->item->getsupplier($name); // check if item exists
            if ($getitemcount > 0) {

                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'customer name exists'
                );
                //echo json_encode($response);
            } else {
                    if($customer_branch > 0 ){
                        $tmp = $this->session->userdata('user');
                        $branch = $tmp['branch'];
                        $data['branch'] = $branch;
                    }
                $this->db->insert('suppliers', $data);
                $insert_id = $this->db->insert_id();
                $ledger_data = array(
                    "name" => $name,
                    "code" => $phone,
                    "ref_id" => $insert_id,
                    "ref_code" => 'sup',
                    "is_default" => true,
                    "acc_main_id" => 24,
                    "openning_bal" => $opening_bal,
                    "type" => $credit_type,
                    "published" => 'yes'
                );
                $this->db->insert('acc_ledgers', $ledger_data);
                $ledgers_code = $this->db->insert_id();
                //$this->ledgers_code(5, $ledgers_code);
                $response = array(
                    'valid' => true,
                    'type' => 1,
                    'message' => 'Saved Successfully.'
                );
            }
        } else {
            $this->db->where('id', $id);
            $this->db->update('suppliers', $data);
            $insert_id = $id;
            $qry = "UPDATE acc_ledgers set   name ='".$name."' ,   openning_bal=" . $opening_bal . ", type='" . $credit_type . "' WHERE ref_id=" . $id . " and ref_code='sup'";
            $query = $this->db->query($qry);
            $published = 'yes';
            $exist = 1;


            $response = array(
                'valid' => true,
                'type' => 1,
                'message' => 'Updated Successfully.'
            );
        }
        echo json_encode($response);
    }

    function delete($id) {
        $is_delete = 1;
		$qry = "select * from sales where published = 'yes' and customer_id = ".$id;
		$query = $this->db->query($qry);;
		if($query->num_rows() > 0 ){
			$is_delete = 0;
		}
		$qry = "select * from purchase where published = 'yes' and supplier_id = ".$id;
		$query = $this->db->query($qry);;
		if($query->num_rows() > 0 ){
			$is_delete = 0;
		}
		$qry = "SELECT * from acc_ledgers as a INNER JOIN acc_ledger_trans as b on a.id = b.ledger_id WHERE b.published= 'yes' and ref_code in('cus','sup') and a.ref_id = ".$id;
        $query = $this->db->query($qry);;
		if($query->num_rows() > 0 ){
			$is_delete = 0;
		}
		if($is_delete > 0 ){
			$qry = "delete from suppliers where id =" . $id;
			$this->db->query($qry);
			$qry = "delete from  acc_ledgers where ref_code in ('cus','sup') and ref_id =" . $id;
			$this->db->query($qry);
		}
    }

    function getledgeritem($id) {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

}
