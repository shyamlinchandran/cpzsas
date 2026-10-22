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

class Customerprice_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'i.name as iname,a.id,a.price_name as pname,a.sales_rate as salerate,s.name as customer';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item_price as a inner join customer_price as b on a.id =b.price_id inner join suppliers as s on b.customer_id=s.id inner join item as i on a.item_id=i.id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'pname','salerate'); //set column field database for datatable orderable   
        $this->column_search = array('a.pname'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    /*function where() {
        $this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
    }*/

    function getproducts($id) {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        //echo $qry;
        $query = $this->db->query($qry);
        return $query->result_array();
    }
 function gettransfer($id) {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer from item_price as a inner join transfer_items as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    function getsing($id) {
        $qry = 'select i.name as iname,a.id,a.price_name as pname,a.sales_rate as salerate,s.name as customer,b.price_id as pid from item_price as a inner join customer_price as b on a.id =b.price_id inner join suppliers as s on b.customer_id=s.id inner join item as i on a.item_id=i.id where b.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }
    function price() {
        $qry = 'select a.*,concat(a.price_name,":",b.name,":",a.sales_rate) as label,a.id,a.price_name from item_price as a inner join item as b on a.item_id=b.id';
        $result = $this->db->query($qry);
        return $result->result_array();
    }

   function getcustomer($search) {
       $qry = "select a.name as label,a.* from suppliers as a where (name like('%$search%') or phone like('%$search%')) and `type`='cus'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

   function getautocomplete($q, $type) {

        $query = $this->db->query("select * from  item where name like ('%" . $q . "%') or barcode  like ('%" . $q . "%') and item_type_id=1 limit 25");
        if ($query->num_rows() > 0) {
            foreach ($query->result_array() as $row) {
                $new_row['value'] = htmlentities(stripslashes($row['name'] . '-' . $row['barcode']));
                $new_row['label'] = htmlentities(stripslashes($row['name'] . '-' . $row['barcode']));
                $new_row['id'] = htmlentities(stripslashes($row['id']));
                $row_set[] = $new_row; //build an array
            }
            echo json_encode($row_set); //format the array into json data
        }
    }



    function save() {
        $id = $this->input->post('id');
        $pid = $this->input->post('pid'); // if it is zero then we will add the item
        $custid = $this->input->post('custid');
        
        $data = array(
            'customer_id' => $custid,
            'price_id'=>$pid
        );
        $this->db->insert('customer_price', $data);
        $insert_id = $this->db->insert_id();
        $published = 'yes';
        $this->db->where('id', $id);
        $this->db->update('customer_price', $data);
        $insert_id = $id;
        $published = 'yes';
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

}
