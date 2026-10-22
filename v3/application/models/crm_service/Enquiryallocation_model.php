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

        $this->select = '*, ver.id as reg_id , u.user_name as enq_user_name , uss.user_name as allo_user_name, IFNULL(sup.name,cusname) as cus_name,CASE when v.id is null then concat("Name : ", i.name, " | Prate : ",i.prate, " | Srate : ", i.srate, " | MRP : ", i.MRP) else  concat("Name : ", v.veh_name, " | No : ",v.veh_no, " | Brand : ", v.veh_brand, " | Model : ", v.veh_model)   end as item_det,itemname';
        $this->table = 'v_enquiry_register as ver inner join v_enquiry_allocation as vea on ver.id = vea.enq_id inner join users as u on vea.enq_user = u.Id inner join users as uss on vea.user = uss.Id LEFT join suppliers as sup on ver.cus_id = sup.id left join item as i on ver.item_id = i.id and ver.type = 2 left join vehicles as v on ver.item_id = v.id and ver.type=1';
        $this->wherecondition =  'where 1 and ver.status < 3';
        if ($usertype != 1) {
            $this->wherecondition = $this->wherecondition . ' and ver.loggedin = ' . $userid; 
        }
        if($this->input->post('dat') == 'date'){
            $this->wherecondition = $this->wherecondition . " and vea.Sdate >= '".$sDate."' and vea.Sdate <= '" .$eDate. "'";
        }  
        if ($this->input->post('userr')) {
            $this->wherecondition = $this->wherecondition . " and ver.loggedin = " . $this->input->post('userr');
        }
        if ($this->input->post('cuser')) {
            $this->wherecondition = $this->wherecondition . " and ver.user = " . $this->input->post('cuser');
        }

        // $this->table = 'enquiry_register as r left join enquiry_allocation as a on r.id = a.enq_id left join users as u on a.user = u.Id WHERE loggedin ='.$userid;
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('ver.id' => 'desc'); // default order 
    }


     function get_report(){

        $this->select = " ver.*,sbm.engineer_remarks,sbm.closed_remarks,sbm.call_status";
        $this->table = 'v_enquiry_register  as ver left join service_bill_main as sbm on sbm.call_id = ver.id  left join suppliers as sup on ver.cus_id = sup.id left join item as i on ver.item_id = i.id';
        $this->column_order = array(null, 'date', 'id','cusname','cusphone','cusaddress','itemname','model','series','observation','engineer_remarks','call_status','closed_remarks'); //set column field database for datatable orderable   
        $this->column_search = array('date', 'id','cusname','cusphone','cusaddress','itemname','model','series','observation','engineer_remarks','call_status','closed_remarks'); //set column field database for datatable searchable 
        $this->order = array('date' => 'desc'); // default order 
        $this->wherecondition = 'where 1';
       
    }

    function gethistory(){

        $this->select = " d.sdate,u.user_name,CASE when c.id is null then b.veh_no else c.name end as product,a.* ,sbm.date as service_bill_date";
        $this->table = 'v_enquiry_register as a left join service_bill_main as sbm on a.id =sbm.call_id left join vehicles as b on b.id=a.item_id and a.type = 1 left join item as c on c.id = a.item_id and a.type=2  INNER join v_enquiry_allocation as d on d.enq_id =a.id INNER JOIN users as u on u.Id =d.user';
        $this->column_order = array(null, 'sdate', null); //set column field database for datatable orderable   
        $this->column_search = array('sdate'); //set column field database for datatable searchable 
        $this->order = array('sdate' => 'desc'); // default order 
        $this->wherecondition = 'where a.cus_id =0';
        if($this->input->post('customerid')){   

            $this->wherecondition = 'where a.cus_id='.$this->input->post('customerid');

            if($this->input->post('type') && $this->input->post('itemid')){

                $this->wherecondition = $this->wherecondition .' and a.type ='.$this->input->post('type');
                $this->wherecondition = $this->wherecondition .' and a.item_id ='.$this->input->post('itemid');
            }

        }
        elseif($this->input->post('type')==1){

            $this->wherecondition ='where a.type ='.$this->input->post('type');
            $this->wherecondition = $this->wherecondition .' and a.item_id ='.$this->input->post('itemid');

        }

    }

    function getsales(){

        $this->select = "* ";
        $this->table = 'sales as a inner join sales_items as b on b.sales_id=a.sales_id and a.customer_id !=0 inner join item as c on b.item_id =c.id';
        $this->column_order = array(null, 'a.sales_id', null); //set column field database for datatable orderable   
        $this->column_search = array('a.sales_id'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
        $this->wherecondition = 'where a.customer_id = 0';
        if($this->input->post('customerid')){

            $this->wherecondition = ' where a.customer_id='.$this->input->post('customerid');

             if($this->input->post('itemid')){

                 if($this->input->post('type') ==2){
                     
            //     $this->wherecondition = $this->wherecondition .' and a.type ='.$this->input->post('type');
                   $this->wherecondition = $this->wherecondition .' and b.item_id ='.$this->input->post('itemid');

                 } 
                  else{
                    $this->wherecondition = 'where a.customer_id = 0';
    
                 }


             }
           
        }
        // elseif($this->input->post('type')==1){

        //     $this->wherecondition ='where a.type ='.$this->input->post('type');
        //     $this->wherecondition = $this->wherecondition .' and a.item_id ='.$this->input->post('itemid');

        // }


        // if($this->input->post('type') && $this->input->post('itemid')){
        //     $this->wherecondition = $this->wherecondition .' and a.type ='.$this->input->post('type');
        //     $this->wherecondition = $this->wherecondition .' and a.item_id ='.$this->input->post('itemid');
        // }
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


    public function getcustomerdet($search)
    {
        $qry = "select s.*, s.name as label  from suppliers as s where type = 'cus' and name like '%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function gettypedet($type, $search)
    {
        if ($type == 1) {
            $qry = "select s.*, s.veh_no as label  from vehicles as s where s.veh_no like '%" . $search . "%'";
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        } else if($type == 2) {
            $qry = "select i.*, i.name as label,taxs.* from item as i left join taxgst as taxs on i.tax_id = taxs.gstid where i.published = 'yes' and i.name like '%" . $search . "%'";
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
        else{
            echo ("invalid type");  
        }
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
        if ($stat == 1) {
            $data2['status'] = 4;
            $message = 'Varified';
        } else {
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
        $remark = $this->input->post('remark');
        $total = $this->input->post('totalss');
        $qry = "select * from v_enquiry_allocation where enq_id = " . $id;
        $details = $this->db->query($qry)->row_array();
        $data = array(
            'enq_id' => $id,
            'Sdate' => $this->getDate($Sdate),
            'Edate' => $this->getDate($Edate),
            'enq_user' => $enq_user,
            'Ddate' => $details['Ddate'],
            'user' => $users,
            'remark' => $remark
        );
        // $this->db->where('enq_id', $id);
        $qry = "delete from v_enquiry_allocation where enq_id = " . $id;
        $this->db->query($qry);
        $this->db->insert('v_enquiry_allocation ', $data);
        $insId = $this->db->insert_id();
        if ($insId) {

            $stat = array(
                'status' => 1,
            );
            $this->db->where('id', $id);
            $this->db->update('v_enquiry_register', $stat);

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
        $qry = "delete * from  enquiry_register where id =" . $id;
        $this->db->query($qry);
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

    function save($com_set)
    {
        $id = $this->input->post('id');
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $user = $this->input->post('user');
        $date = $this->input->post('date');
        $customerid = $this->input->post('customerid');
        $typess = $this->input->post('typess');
        $item_id = $this->input->post('item_id');
        
        $item_name = $this->input->post('item_name');
        $model = $this->input->post('model');
        $serial = $this->input->post('serial');
        $remarks = $this->input->post('remarks');
        $problems = $this->input->post('problems');
        $observation = $this->input->post('observation');
        $entryremarks = $this->input->post('entryremarks');
        $amount = $this->input->post('amount_to_pay');
        $deli_date = $this->input->post('deli_date');
        $alloo_user = $this->input->post('alloo_user');

        $cusaddress =  $this->input->post('cusaddress');
        $customerName =  $this->input->post('customerName');
        $cusphone =  $this->input->post('cusphone');
        // $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';


        // $serv_no = substr(str_shuffle($str_result),  0, 6);
        $serv_no = 1;
        $qry =  'SELECT * FROM v_enquiry_register ORDER by id DESC LIMIT 1';
        $res = $this->db->query($qry)->row_array();
        if ($res !== '' && $res !== null) {
            $serv_no = $res['serv_no'] + 1;
        } else {
           // $serv_no = $com_set[0]['service_num_start'];
        }


        $data = array(
            'cusaddress'=>$cusaddress,
            'cusname'=>$customerName,
            'cusphone'=>$cusphone,
            'model'=>$model,
            'series'=>$serial,
            'problems'=>$problems,
            'observation'=>$observation,
            'eremarks'=>$entryremarks,
            'status' => 1,
            'loggedin' => $userid,
            'serv_no' => $serv_no,
            'user' => $user,
            'date' => $this->getDate($date),
            'remarks' => $remarks,
            'type' => $typess,
            'cus_id' => $customerid,
            'totalAmount' => $amount,
            'item_id' => $item_id,
            'itemname'=> $item_name,
            
        );
        if ($id == '0') {

            $this->db->insert('v_enquiry_register', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $insert_id = $id;
            $qry = "delete from v_enquiry_allocation where enq_id=" . $id;
            $this->db->query($qry);
            $this->db->where('id', $id);
            $this->db->update('v_enquiry_register ', $data);
        }

        $data = array(
            'Sdate' => $this->getDate($date),
            'remark' => $remarks,
            'enq_id' => $insert_id,
            'enq_user' => $userid,
            'user' => $alloo_user,
            'Edate' => $this->getDate($date),
            'Ddate' => $this->getDate($deli_date),
        );

        $this->db->insert('v_enquiry_allocation', $data);


        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );

        echo json_encode($response);
    }

    // function getVehicleServiceHistoryWithItemid($id){
    //    $this->db->where('a.item_id',$id);
    //    $this->db->where('a.type',1);
    //    $data= $this->db->select('a.*,b.*,c.*,d.*')->from('v_enquiry_register as a')
    //    ->join('vehicles as b ','a.item_id = b.id')   
    //    ->join('v_enquiry_allocation as d','a.id=d.enq_id')  
    //    ->join('users as c ','d.user = c.id') 
    //     ->get()->result_array();
    //    echo json_encode($data);
    // }
    // function getProductServiceHistoryWithItemid($id){
    //     $cus_id=$this->input->post('cus_id');
    //     $this->db->where('a.cus_id',$cus_id);
    //     $this->db->where('a.item_id',$id);
    //     $this->db->where('a.type',2);
    //     $data= $this->db->select('a.*,b.*,c.*,d.*')->from('v_enquiry_register as a')
    //     ->join('item as b ','a.item_id = b.id')   
    //     ->join('v_enquiry_allocation as d','a.id=d.enq_id')  
    //     ->join('users as c ','d.user = c.id') 
    //      ->get()->result_array();
    //     echo json_encode($data);
    //  }


    //  function getServiceHistoryWithCusid($id){
    //     $this->db->where('a.cus_id',$id);
    //     $this->db->where('a.type',1);
    //     $data= $this->db->select('a.*,b.*,c.*,d.*')->from('v_enquiry_register as a')
    //     ->join('vehicles as b ','a.item_id = b.id')   
    //     ->join('v_enquiry_allocation as d','a.id=d.enq_id')  
    //     ->join('users as c ','d.user = c.id') 
    //      ->get()->result_array();
    //     echo json_encode($data);
    //  }


    //  function getProductServiceHistoryWithCusid($id){
    //     $this->db->where('a.cus_id',$id);
    //     $this->db->where('a.type',2);
    //     $data= $this->db->select('a.*,b.*,c.*,d.*')->from('v_enquiry_register as a')
    //     ->join('item as b ','a.item_id = b.id')   
    //     ->join('v_enquiry_allocation as d','a.id=d.enq_id')  
    //     ->join('users as c ','d.user = c.id') 
    //      ->get()->result_array();
    //     echo json_encode($data);
    //  }
}
