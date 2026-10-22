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

class Itemprice_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.id,a.name as itemname,b.sales_rate as salerate,b.price_name as pname';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a inner join item_price as b on a.id =b.item_id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'itemname','salerate','pname'); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'b.itemname'); //set column field database for datatable searchable 
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
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,name,item_id from item_transfer as a inner join transfer_items as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }
    function getsing($id) {
        $qry = 'select a.*,a.name as itemname,b.price_name as pname,b.sales_rate as srate from item as a left outer join item_price as b on a.id=b.item_id where b.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }


  

    function Hsncode() {
        $qry = 'select * from hsncode';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    
    function Group() {
        $qry = 'select id,name from item_group';
        $result = $this->db->query($qry);
        return $result->result_array();
    }


    

    function getanycount($table,$field,$name,$condition) {
        $this->db->select("count($field)");
        $query = $this->db->get($table);
        $this->db->where($condition,$name);
        return $query->row_array();
    }


    function getitem($search) {
       $qry = "select a.name as label,a.* from item as a where (name like('%$search%'))";
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
        $pname = $this->input->post('pname'); // if it is zero then we will add the item
        $itemid = $this->input->post('itemid');
        $srate = $this->input->post('srate');
        
        $data = array(
            'price_name' => $pname,
            'item_id' => $itemid,
            'sales_rate'=>$srate
        );
        $this->db->insert('item_price', $data);
        $insert_id = $this->db->insert_id();
        $published = 'yes';
        $this->db->where('id', $id);
        $this->db->update('item_price', $data);
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
