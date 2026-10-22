<?php

class Enquiryallocation_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];

        $user = $this->session->userdata('user');
        $usertype = $user['user_type'];

        $sDate = $this->getDate($this->input->post('fromDate'));
        $eDate = $this->getDate($this->input->post('toDate'));

        $this->select = 'r.*,u.user_name as username, usr.user_name as userss, sm.status as st_name';
        $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id inner join users as usr on r.user = usr.Id left join status_master as sm on r.statuss = sm.id';
        $this->wherecondition =  ' where r.status < 6';
        if ($usertype != 1) {

            $this->wherecondition = $this->wherecondition . ' and r.loggedin = ' . $userid; 
        }
        if($this->input->post('dat') == 'date'){
            $this->wherecondition = $this->wherecondition . " and a.Sdate >= '".$sDate."' and a.Sdate <= '" .$eDate. "'";
        }  
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and r.loggedin = " . $this->input->post('userr');
        }
        if ($this->input->post('cuser')) {
            $this->wherecondition = $this->wherecondition . " and a.user = " . $this->input->post('cuser');
        }

        // $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id WHERE loggedin ='.$userid;
        $this->column_order = array(null, 'companyName'); //set column field database for datatable orderable
        $this->column_search = array('companyName','contactPerson','contactNumber'); //set column field database for datatable searchable 
        $this->order = array('id' => 'desc'); // default order 
    }

    function getsing($id)
    {

        $qry = 'select * from enquiry_register where id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
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
        $stat = $this->input->post('stats');
        $message = '';
        $data2['status'] = 0;
        if($stat == 1){
            $data2['status'] = 4;
            $message = 'Varified';
        }
        else{
            $data2['status'] = 2;
            $message = 'Rejected';
        }
        $this->db->where('id ', $id);
        $this->db->update('enquiry_register ', $data2);
        $response = array(
            'valid' => false,
            'type' => $id,
            'message' => $message . ' Successfully.'
        );

        echo json_encode($response);
    }

    function save_allocation()
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
        $total = $this->input->post('totalss');
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
        $qry = "delete from enquiry_allocation where enq_id = " . $id;
        $this->db->query($qry);
        $this->db->insert('enquiry_allocation ', $data);
        $insId = $this->db->insert_id();
        if ($insId) {

            $stat = array(
                'status' => 1,
                'totalAmount' => $total,

            );
            $this->db->where('id', $id);
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
        
        $this->db->where('id',$id)->delete('enquiry_register');
    }

    public function deleteEnq($data)
    {
		$qry = "select group_concat(id) as id from enquiry_register where status < 1 and id in (" . $data . ")";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){	
			$query = $query->row_array();
			$data = 0;
			if($query['id'] != '' ){
				$data = $query['id'];
			}
			$qry = "delete from enquiry_register where id in (" . $data . ")";
			$this->db->query($qry);
			$qry = "delete from enquiry_allocation where enq_id in (" . $data . ")";
			$this->db->query($qry);
			$qry = "delete from enquiry_followup where enquiry_id in (" . $data . ")";
			$this->db->query($qry);
			$qry = "delete from enquiry_closure where enq_id in (" . $data . ")";
			$this->db->query($qry);
		}
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
        $leadid = 0;
        if ($this->input->post('leadid') > 0) {
            $leadid = $this->input->post('leadid');
        }
        $companyName = $this->input->post('companyName');
        $contactPerson = $this->input->post('contactPerson');
		$parentsName = '';
		if($this->input->post('parentsName')){
			$parentsName = $this->input->post('parentsName');
		}
		$parentsInfo = '';
		if($this->input->post('parentsInfo')){
			$parentsInfo = $this->input->post('parentsInfo');
		}
		$collegeName = '';
		if($this->input->post('collegeName')){
			$collegeName = $this->input->post('collegeName');
		}
		$refperson = '';
		if($this->input->post('refperson')){
			$refperson = $this->input->post('refperson');
		}
		$ref_per_contact = '';
		if($this->input->post('ref_per_contact')){
			$ref_per_contact = $this->input->post('ref_per_contact');
		}
        $source = $this->input->post('source_id');
        if($source == 0 || $source == null){
            $source = 1;
        }
        $contactNumber = $this->input->post('contactNumber');
        $user = $this->input->post('user');
        $date = $this->input->post('date');
        $email = $this->input->post('email');
        $adress = $this->input->post('adress');
        $location = $this->input->post('states_cus');
        $area =  $this->input->post('area');
        $typebuss = $this->input->post('typebuss');
        $unbuss =  $this->input->post('unbuss');
        $allocate_to =  $this->input->post('allocate');
        $Ddate = $this->input->post('ddate');


        if ($this->input->post('crmtype') == 'COURSE_CRM') {
            $course = $this->input->post('course');
        } else {
            $course = 0;
        }
        $remarks = $this->input->post('remarks');
        $gst = $this->input->post('gst');
        $total = $this->input->post('total');
        //Lead master
        if (!$this->input->post('isLead')) {
            $type = $this->input->post('type');
            $quantity = $this->input->post('item_quantity', true);
            $price = $this->input->post('item_price', true);
        } else {
            $total = 0;
        }

       

        $data = array(
            'loggedin' => $userid,
            'companyName' => $companyName,
            'lead_id' => $leadid,
            'contactPerson' => $contactPerson,
            'source' => $source,
            'area' => $area,
            'contactNumber' => $contactNumber,
            'user' => $user,
            'date' => $this->getDate($date),
            'email' => $email,
            'typebuss' => $typebuss,
            'unbuss' => $unbuss,
            'parentsName' => $parentsName, 
            'parentsInfo'=> $parentsInfo,
            'collegeName'=> $collegeName,
            'refperson'=> $refperson,
            'ref_per_contact' => $ref_per_contact,
            'adress' => $adress,
            'course' => $course,
            'location' => $location,
            'remarks' => $remarks,
            'gst' => $gst,
            'totalAmount' => $total,
        );
        //Lead master
        if($leadid < 1 ){
			$leaddata = array(
				'companyName'=>$data['companyName'],
				'area'=>$data['area'],
				'contactPerson'=>$data['contactPerson'],
				'contactNumber'=>$data['contactNumber'],
				'refperson'=>$data['refperson'],
				'ref_per_contact'=>$data['ref_per_contact'],
				'typebuss'=>$data['typebuss'],
				'unbuss'=>$data['unbuss'],
				'date'=>$data['date'],
				'email'=>$data['email'],
				'adress'=>$data['adress'],
				'remarks'=>$data['remarks'],
				'loggedin'=>$data['loggedin']
			);
			$this->db->insert('lead_register',$leaddata);
			$data['lead_id'] =  $this->db->insert_id();
		}
        if (!$this->input->post('isLead')) {
            $data['type'] = $type;
            $data['allocate_to'] =$allocate_to;
        }
        if ($this->input->post('isLead')) {

            if ($id == '0') {
                $this->db->insert('lead_register', $data);
                $insert_id = $this->db->insert_id();
            }
        } else {

            if ($id == '0') {

                $this->db->insert('enquiry_register', $data);
                $insert_id = $this->db->insert_id();
                $settings=$this->getCompanySettings();

                if($settings[0]['User_Authentication']){
                $enq_alloc=[
                    'followup'=>'0',
                    'Sdate'=>$this->getDate($date),
                    'enq_id'=> $insert_id,
                    'enq_user'=> $userid ,
                    'user'=>$allocate_to,
                    'Edate'=>$this->getDate($date),
                    'Ddate'=>$this->getDate($Ddate),
                    'remark'=>$remarks
                ];
               $allocid = $this->db->insert('enquiry_allocation', $enq_alloc);
               if($allocid){

                $this->db->where('id',$insert_id)->update('enquiry_register', ['status'=>1]);

               }

                  }
            } else {
                $insert_id = $id;
                $qry = "delete from enquiry_product where enquiry_id=" . $id;
                $this->db->query($qry);
                $this->db->where('id', $id);
                $this->db->update('enquiry_register ', $data);
            }
            $product_id = $this->input->post('product_id', true);
            if ($this->input->post('product_id', true)) {
                $alt_length = sizeof($product_id);
                for ($i = 0; $i < $alt_length; $i++) {
                    if($type == 2){
                        $quantity[$i] = 1;
                    }
                    $alt_data = array(
                        'enquiry_id' => $insert_id,
                        'price' => $price[$i],
                        'quantity' => $quantity[$i],
                        'product_id' => $product_id[$i]
                    );
                    $this->db->insert('enquiry_product', $alt_data);
                }
            }
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }
}
