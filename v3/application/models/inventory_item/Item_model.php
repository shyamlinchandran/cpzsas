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
class Item_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = " IFNULL(c.total,0) as total,unit_id,a.id,a.name as itemname,IFNULL(a.barcode,'') as barcode,IFNULL(a.srate,0) as salerate,IFNULL(b.name,'') as category,IFNULL(a.description,'') as description,IFNULL(a.open_stock,0) as open_stock,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.prate,0) as prate";
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a left join item_category as b on a.item_category_id =b.id left join (select sum(current_stock+open_stock) as total,item_id  from item_godown group by item_id) as c on c.item_id=a.id';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'itemname', 'category', 'salerate', null); //set column field database for datatable orderable   
        $this->column_search = array('a.name', 'a.barcode', 'b.name', 'a.description'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'desc'); // default order 
    }

    function where()
    {
        //$this->wherecondition = "where a.item_type_id = '" . $this->input->post('sale_type') . "'";
        $this->wherecondition = "where a.published='yes'";

        if ($this->input->post('category_id')) {
            $this->wherecondition = $this->wherecondition . 'and a.item_category_id=' . $this->input->post('category_id');
        }
        if ($this->input->post('material_type')) {
            $this->wherecondition = $this->wherecondition . ' and a.material_type=' . $this->input->post('material_type');
        }
    }

    function getbarcodebatch($id)
    {
        $qry = 'select * from barcode_batch_items  as a left join(select sum(b.quantity) as total,b.id as bid from barcode_batch_items as b where b.published="yes" and b.batch_id=' . $id . ') as c on a.id=bid where a.published="yes" and batch_id=' . $id;
        print_r($qry);
        $settings = $this->db->query($qry);
        return $settings->result_array();
    }

    function printbarcode()
    {
        $id = $this->input->post('id');
        $batch_name = $this->input->post('batch_name');
        if ($id > 0) {
            $qry = "update  barcode_batch set batch_name='" . $batch_name . "'where barcode_batch_id =" . $id;
            $this->db->query($qry);
            $insert_id = $id;
            $query = "update  barcode_batch_items set published='no' where batch_id = " . $id;
            $this->db->query($query);
        } else {
            $batch_data = array(
                'batch_name' => $batch_name,
                'published' => 'yes'
            );
            $this->db->insert('barcode_batch', $batch_data);
            $insert_id = $this->db->insert_id();
        }
        $item_id = $this->input->post('item_id', true);
        $quantity = $this->input->post('item_qty', true);
        $barcode = $this->input->post('item_barcode', true);
        $rate = $this->input->post('item_rate', true);
        $item_name = $this->input->post('item_name', true);
        $item_MRP = $this->input->post('item_MRP', true);
        $totquantity = 0;


        $length = sizeof($item_id);
        for ($i = 0; $i < $length; $i++) {
            $barcode_data = array(
                'batch_id' => $insert_id,
                'item_id' => $item_id[$i],
                'quantity' => $quantity[$i],
                'barcode' => $barcode[$i],
                'rate' => $rate[$i],
                'item_name' => $item_name[$i],
                'mrp' => $item_MRP[$i],
            );
            $data[$i] = $barcode_data;
            $this->db->insert('barcode_batch_items', $barcode_data);
            $totquantity = $totquantity + $quantity[$i];
        }
        return $insert_id;
    }

    public function getaddress($id)
    {
        $qry = "select * from ims_godown where id = " . $id;
        $query = $this->db->query($qry);
        echo json_encode($query->row_array());
    }

    function barcode()
    {
        $this->select = 'irate,item_barcode,b.name,b.barcode,a.name as unit,a.id as uid,a.unit_count as unit_count,srate,IFNULL(sid,0) as sid,a.id,iid';
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'units as a left join (select i.rate as irate,i.id as iid,i.barcode as item_barcode,i.unit_id as unit,IFNULL(c.id, 0) as sid,c.* from item as c left join item_barcode as i on i.item_id=c.id where c.id=' . $this->input->post('id') . ' order by c.id desc) as b on a.id=b.unit';
        // inner join item_group  as c on a.item_group_id=c.id  inner join units  as d on a.unit_id=d.id inner join tax as e on a.tax_id=e.id
        $this->column_order = array(null, 'a.name'); //set column field database for datatable orderable   
        $this->column_search = array('a.name'); //set column field database for datatable searchable 
        $this->order = array('-b.iid ' => 'desc'); // defau
        $this->wherecondition = 'where a.id in(' . $this->input->post('unit') . ')';
    }

    function getunits($search)
    {
        $id = $search;
        $count = 1;
        $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $stack = array('"' . $query["id"] . '"');
        $unit = $query["id"];
        for ($i = 2; $i >= 2; $i++) {
            $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
            $query = $this->db->query($qry)->row_array();
            $i = $query['count'];
            $count = $count * $query["unit_count"];
            if ($query['count'] > 0) {
                $id = $query['id'];
                array_push($stack, '"' . $query["id"] . '"');
                $unit = $unit . ',' . $query["id"];
            }
        }
        return $unit;
    }

    function getproducts($id)
    {
        $qry = "select DATE_FORMAT(a.created_date, '%d/%m/%Y' ) as dtp,a.product_id as pid,i.id as bid,  a.published as pub,i.name as sname,i.id as sid, a.*,b.* from prd_stock as a inner join prd_stockitem as b on a.id =b.stock_prod_id  inner join item as i on i.id=b.sal_item_id where b.published='yes' and   a.id =" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function gettablefields($table_name)
    {
        $dropdownvalue = "";
        if ($table_name == 'item') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="item_type_id">Goods/service</option><option value="barcode">Barcode</option><option value="godown">Godown</option><option value="open_stock">Open Stock</option>  <option value="unit_id">Unit</option>     <option value="item_category_id">Category</option>      <option value="item_group_id">Item Discount Group</option>    <option value="reorder_point">Reorder Point</option><option value="min_level">Min Level</option><option value="max_level">Max Level</option><option value="rack">Rack</option><option value="prate">Purchase Rate</option><option value="srate">SaleRate</option><option value="wh_rate">WholsaleRate</option><option value="MRP">Mrp</option><option value="open_stk_rate">OpenStockRate</option><option value="commission">Commission</option><option value="tax_id">Tax</option><option value="tax_ledger_id">TaxLedgerId</option><option value="tax_sales_id">TaxSalesId</option><option value="tax_purchase_id">TaxPurchaseId</option><option value="hsncode">HsncodeId</option><option value="description">Description</option><option value="mfg_date">MFGDate</option><option value="exp_date">ExpireyDate</option><option value="analytics_id">AnalyticsId</option>';
        }
        if ($table_name == 'suppliers') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>  <option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option>';
        }
        if ($table_name == 'customer') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>  <option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option>';
        }
        return $dropdownvalue;
        // if($table_name == 'supplier'){
        // }
        // if($table_name == 'item'){
        // }
    }

    function gettransfer($id)
    {
        $qry = "select DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp, a.invoice as inv, imsg.godown_address as gaddr, imgg.godown_address as ggaddr, b.eway as eway, imsg.godown_code as gcode, imgg.id as imggid, imgg.godown_code as ggcode, a.from_id,b.item_id as item,b.qty as qty, b.to_id ,name, ig.item_id, iz.id as sizeid, ic.id as colorid, iz.size as sizes, ic.color as colors, ig.brand_rate as brate, ig.normalsrate as nsrate, ig.MRP as mrp, ig.dealer_rate as drate, hsnc.hsncode as hsn, i.prate as rprate from item_transfer as a inner join item_transfer_sub as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id inner join item_godown as ig on b.item_id = ig.item_id and b.size = ig.item_size and b.color = ig.item_color and a.from_id = ig.godown_id  inner join item_size as iz on b.size = iz.id left join item_color as ic on b.color = ic.id inner join ims_godown as imsg on a.from_id = imsg.id inner join ims_godown as imgg on b.to_id = imgg.id  inner join hsncode as hsnc on hsnc.hsnid = i.hsncode where b.published='yes' and a.id =" . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function gettrans($id)
    {
        $qry = "select it.*, its.*, img.godown_code as fromgo, imsgg.godown_code as togo, img.godown_address as fromaddr, imsgg.godown_address as toaddr, img.godown_contactno as fromcont, imsgg.godown_contactno as tocont, img.gst as fromgst, imsgg.gst as togst from item_transfer as it inner join item_transfer_sub as its on its.transfer_id = it.id inner join ims_godown as img on img.id = it.from_id inner join ims_godown as imsgg on imsgg.id = its.to_id where it.id =" . $id . " GROUP BY its.transfer_id";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    public function getList($id)
    {
        $qry = "select i.name as itemname, intrance.damaged,intrance.notes,intrance.recieved,DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp, ig.MRP as mrp, ig.normalsrate as nsrate, ig.brand_rate as brate, ig.dealer_rate as drate,  imsg.godown_address as gaddr, imgg.godown_address as ggaddr, b.eway as eway, imsg.godown_code as gcode, imgg.id as imggid, imgg.godown_code as ggcode, a.from_id,b.item_id as item,b.qty as qty, b.to_id ,name, ig.item_id, iz.id as sizeid";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . ", ic.id as colorid";
        }
        $qry = $qry . ", iz.size as sizes";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . ", ic.color as colors";
        }
        $qry = $qry . ", ig.brand_rate as brate, ig.normalsrate as nsrate, ig.MRP as mrp, ig.dealer_rate as drate  from item_transfer as a inner join item_transfer_sub as b on b.transfer_id=a.id inner join item as i on i.id=b.item_id inner join item_godown as ig on b.item_id = ig.item_id and b.size = ig.item_size";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . " and b.color = ig.item_color";
        }
        $qry = $qry . " and a.from_id = ig.godown_id  inner join item_size as iz on b.size = iz.id";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . " inner join item_color as ic on b.color = ic.id";
        }
        $qry = $qry . " inner join ims_godown as imsg on a.from_id = imsg.id inner join ims_godown as imgg on b.to_id = imgg.id left join (SELECT ";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . " ims.color,";
        }
        $qry = $qry . " ims.size,ims.item_id,im.transfer_id,sum(ims.recieved) as recieved,sum(damaged) as damaged,notes FROM intransist_main as im INNER JOIN intransist_sub as ims on im.id=ims.transist_id and im.transfer_id=" . $id . " group by ims.item_id,ims.size";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . ", ims.color";
        }
        $qry = $qry . " ) as intrance on intrance.transfer_id=a.id and b.size=intrance.size";
        if ($this->input->post('is_color') == 'yes') {
            $qry = $qry . " and b.color=intrance.color";
        }
        $qry = $qry . " and b.item_id=intrance.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b
        // print_r($qry);
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    /*
      | -------------------------------------------------------------------
      |  Auto-load Packages
      | -------------------------------------------------------------------
      | Prototype:
      |
      |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
      |
     */

    public function item_size_list()
    {
        $this->select = "size.*, size.size as sizes, size.notes as note, size.updateddate as date";
        $this->table = 'item_size as size ';
        $this->column_order = array(null, 'size.id', null); //set column field database for datatable orderable   
        $this->column_search = array('size.size'); //set column field database for datatable searchable 
        $this->order = array('size.id' => 'desc'); // default order 
    }

    /*
      | -------------------------------------------------------------------
      |  Auto-load Packages
      | -------------------------------------------------------------------
      | Prototype:
      |
      |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
      |
     */

    public function production_stock_list()
    {
        $this->select = "ps.*, i.name as itemname, u.user_name as username, g.godown_name as gname, size.size as sname, color.color as cname";
        $this->table = 'production_stock as ps inner join item as i on ps.item = i.id inner join users as u on ps.user = u.Id inner join ims_godown as g on ps.godown = g.id inner join item_size as size on size.id = ps.item_size inner join item_color as color on color.id = ps.item_color';
        $this->column_order = array(null, 'ps.id', null); //set column field database for datatable orderable   
        $this->column_search = array('ps.godown'); //set column field database for datatable searchable 
        $this->order = array('ps.id' => 'desc'); // default order 
    }

    /*
      | -------------------------------------------------------------------
      |  Auto-load Packages
      | -------------------------------------------------------------------
      | Prototype:
      |
      |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
      |
     */

    public function item_color_list()
    {
        $this->select = "color.*, color.color as colors, color.notes as note, color.updateddate as date";
        $this->table = 'item_color as color ';
        $this->column_order = array(null, 'color.id', null); //set column field database for datatable orderable   
        $this->column_search = array('color.color'); //set column field database for datatable searchable 
        $this->order = array('color.id' => 'desc'); // default order 
    }

    /*
      | -------------------------------------------------------------------
      |  Auto-load Packages
      | -------------------------------------------------------------------
      | Prototype:
      |
      |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
      |
     */

    public function saveItemSize()
    {

        $data = array(
            'size' => $this->input->post('size'),
            'notes' => $this->input->post('note'),
        );

        if ($this->input->post('id') > 0) {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('item_size', $data);
        } else {
            $this->db->insert('item_size', $data);
        }

        $response = array(
            'status' => true,
            'message' => 'Save Successfully'
        );

        echo json_encode($response);
    }

    /*
      | -------------------------------------------------------------------
      |  Auto-load Packages
      | -------------------------------------------------------------------
      | Prototype:
      |
      |  $autoload['packages'] = array(APPPATH.'third_party', '/usr/local/shared');
      |
     */

    public function saveItemColor()
    {

        $data = array(
            'color' => $this->input->post('color'),
            'notes' => $this->input->post('note'),
        );

        if ($this->input->post('id') > 0) {
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('item_color', $data);
        } else {
            $this->db->insert('item_color', $data);
        }

        $response = array(
            'status' => true,
            'message' => 'Save Successfully'
        );

        echo json_encode($response);
    }

    public function getAllSize($id = 0)
    {
        if ($id > 0) {
            $qry = 'select * from item_size where id = ' . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = 'select * from item_size';
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
    }

    public function getAllItems($search)
    {
        $qry = "select i.*, i.name as label from item as i where i.name like '%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getCusType()
    {
        $qry = "select * from customer_type";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function getAllGodowns($search)
    {
        $qry = "select i.*, i.godown_name as label from ims_godown as i where i.godown_name like '%" . $search . "%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function saveProductionStock()
    {
        $id = $this->input->post('id');
        $dates = $this->input->post('date');
        $date = $this->getDate($dates);
        $godown = $this->input->post('godown_id');
        $item = $this->input->post('item_id');
        $size = $this->input->post('size');
        $color = $this->input->post('color');
        $mrp = $this->input->post('MRP');
        $brate = $this->input->post('brate');
        $nsrate = $this->input->post('nsrate');
        $drate = $this->input->post('drate');
        $user = $this->input->post('user');
        $comment = $this->input->post('comment');

        $data = array(
            'date' => $date,
            'godown' => $godown,
            'item' => $item,
            'item_size' => $size,
            'item_color' => $color,
            'MRP' => $mrp,
            'dealer_rate' => $drate,
            'normalsrate' => $nsrate,
            'branch_rate' => $brate,
            'user' => $user,
            'comment' => $comment,
        );

        if ($id > 0) {

            $this->db->where('id', $id);
            $this->db->update('production_stock', $data);
            $data2 = array(
                'prod_id' => $id,
                'item_id' => $item,
                'item_size' => $size,
                'item_color' => $color,
                'MRP' => $mrp,
                'dealer_rate' => $drate,
                'normalsrate' => $nsrate,
                'brand_rate' => $brate,
            );
            $this->db->insert('item_godown', $data2);

            $response = array(
                'status' => true,
                'message' => 'Updated Successfully',
            );

            echo json_encode($response);
        } else {
            $this->db->insert('production_stock', $data);
            $ins = $this->db->insert_id();
            $data2 = array(
                'prod_id' => $ins,
                'item_id' => $item,
                'item_size' => $size,
                'item_color' => $color,
                'MRP' => $mrp,
                'dealer_rate' => $drate,
                'normalsrate' => $nsrate,
                'brand_rate' => $brate,
            );
            $this->db->insert('item_godown', $data2);

            $response = array(
                'status' => true,
                'message' => 'Saved Successfully',
            );

            echo json_encode($response);
        }
    }

    public function getAllColor($id = 0)
    {

        if ($id > 0) {
            $qry = 'select * from item_color where id = ' . $id;
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = 'select * from item_color';
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
    }

    public function deleteSize($id)
    {
        $qry = 'delete from item_size where id =' . $id;
        $this->db->query($qry);
        $response = array(
            'status' => true,
            'message' => 'Deleted Successfully'
        );

        echo json_encode($response);
    }

    public function deleteProduction($id)
    {
        $qry = 'delete from production_stock where id =' . $id;
        $this->db->query($qry);
        $qry = 'delete from item_godown where prod_id =' . $id;
        $this->db->query($qry);
        $response = array(
            'status' => true,
            'message' => 'Deleted Successfully'
        );

        echo json_encode($response);
    }

    public function getAllProductionStock($id = 0)
    {
        if ($id > 0) {
            $qry = 'select ps.*, i.name as itemname, g.godown_name as gname from production_stock as ps inner join item as i on ps.item = i.id inner join ims_godown as g on g.id = ps.godown';
            $result = $this->db->query($qry);
            echo json_encode($result->row_array());
        } else {
            $qry = 'select * from production_stock';
            $result = $this->db->query($qry);
            echo json_encode($result->result_array());
        }
    }

    public function deleteColor($id)
    {
        $qry = 'delete from item_color where id =' . $id;
        $this->db->query($qry);
        $response = array(
            'status' => true,
            'message' => 'Deleted Successfully'
        );

        echo json_encode($response);
    }

    function getsing($id)
    {
        $qry = 'select IFNULL(item_stock,0) as item_stock, ic.name as item_category_names, a.*,a.name as name,y.any_name,y.any_id,x.id as taxldgid,x.name as taxldg,w.id as saletxid,w.name as saletxldg, z.id as purctxid, z.name as purctxldg from item as a  inner join item_category as ic on ic.id = a.item_category_id left join (select sum(z.open_stock) as item_stock,z.item_id as iid from item_godown as z group by z.item_id ) as x on x.iid=a.id left outer join analytics_center as y on a.analytics_id=y.any_id left outer join acc_ledgers as x on a.tax_ledger_id=x.id left outer join acc_ledgers as w on a.tax_sales_id=w.id left outer join acc_ledgers as z on a.tax_purchase_id=z.id where a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function get_image($id)
    {
        $qry = 'select iimage.* from item_image as iimage where iimage.item_id =' . $id;
        $res = $this->db->query($qry);
        echo json_encode($res->result_array());
    }

    function getpitem($id, $uid)
    {
        if ($uid == 0) {
            $qry = 'select IFNULL(c.barcode,a.barcode) as itembarcode, c.rate as itemrate,a.* from item as a left join (select * from item_barcode as b where item_id=' . $id . ' order by id asc limit 1) as c on c.item_id=a.id where   a.id =' . $id;
        } else {
            $qry = 'select IFNULL(c.barcode,a.barcode) as itembarcode,c.rate as itemrate,a.* from item as a left join (select * from item_barcode as b where item_id=' . $id . ' and b.unit_id =' . $uid . '  order by id asc limit 1) as c on c.item_id=a.id where   a.id =' . $id;
        }
        // $qry = 'select * from item as a where   a.id =' . $id;
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function savebarcode()
    {
        $rate = $this->input->post('rate', TRUE);
        $item_id = $this->input->post('item_id', TRUE);
        $unit_id = $this->input->post('unit_id', TRUE);
        $barcode = $this->input->post('barcode', TRUE);
        $length = sizeof($unit_id);
        for ($i = 0; $i < $length; $i++) {
            if ($item_id[$i] > 0) {
                $item_data = array(
                    'barcode' => $barcode[$i],
                    'rate' => $rate[$i],
                );
                $this->db->where('item_id', $item_id[$i]);
                $this->db->where('unit_id', $unit_id[$i]);
                $this->db->update('item_barcode', $item_data);
            } else {
                $item_data = array(
                    'barcode' => $barcode[$i],
                    'rate' => $rate[$i],
                    'item_id' => $item_id[0],
                    'unit_id' => $unit_id[$i],
                );
                $this->db->insert('item_barcode', $item_data);
            }
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getitembarcode($id)
    {
        $qry = "select count(id) as count,a.* from item as a  where a.`id`='" . $id . "'";
        $query = $this->db->query($qry)->row_array();
        $unit = $this->getunits($query['unit_id']);
        $qry = 'SELECT IFNULL(irate,0) as rate,item_barcode,IFNULL(b.name,"") as name,IFNULL(b.barcode,"") as barcode,a.name as unit,a.id as uid,a.unit_count as unit_count,srate,IFNULL(sid,0) as sid,a.id,iid from units as a left join (select IFNULL(i.rate,0) as irate,i.id as iid,i.barcode as item_barcode,i.unit_id as unit,IFNULL(c.id, 0) as sid,c.* from item as c left join item_barcode as i on i.item_id=c.id where c.id=' . $id . ' order by c.id desc) as b on a.id=b.unit WHERE a.id in( ' . $unit . ' ) ORDER BY -iid desc';
        $query = $this->db->query($qry);
        echo json_encode($query->result_array());
    }

    public function getinoviceno($type = 'stock_entry')
    {

        $qry1 = "SELECT * FROM  set_billtype  where  transaction ='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();

        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM item_transfer as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,id from item_transfer as b ) as c on c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);

        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['invoice']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = (int) $res;
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];

            return $num;
        }
    }

    function getitems($id)
    {
        $qry = 'select * from item as a';
        if ($id != 0) {
            $qry = $qry . ' where   a.item_category_id =' . $id;
        }
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function material_types()
    {
        $qry = "select a.* from material_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["mty_id"] . '">' . $row["mty_name"] . '</option>';
        }
        print_r($option);
    }

    function item_category()
    {
        $qry = "SELECT * FROM `item_category` ORDER BY `id` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function godown($godown)
    {
        $qry = 'select * from ims_godown where id = ' . $godown;
        $gwn = $this->db->query($qry);
        echo json_encode($gwn->row_array());
    }

    function racks()
    {
        $qry = 'select * from item_racks_master';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function brands()
    {
        $qry = 'select * from item_brand';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function tax()
    {
        $qry = 'select gstid,GST from taxgst order by gstid asc';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function getproductslist($search = '')
    {

        $qry = 'select a.*,a.name as name,b.id as categoryid,b.name as category,d.GST as GST,d.gstid,c.name as grp,c.id as groupid,u.name as unit,u.id as unitid,t.id as typeid,t.name as typename,r.name as rack,r.id as rackid from item as a left outer join item_category as b on a.item_category_id=b.id left outer join item_group as c on a.item_group_id=c.id left outer join taxgst as d on a.tax_id=d.gstid left outer join units as u on u.id=a.unit_id left outer join item_type as t on t.id=a.item_type_id left outer join item_racks_master as r on r.id=a.rack ';
        if ($search != '') {
            $qry = $qry . " where  a.name like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function getproductslistbc($search = '')
    {

        $qry = 'select a.*,a.name as name,b.id as categoryid,b.name as category,d.GST as GST,d.gstid,c.name as grp,c.id as groupid,u.name as unit,u.id as unitid,t.id as typeid,t.name as typename,r.name as rack,r.id as rackid from item as a left outer join item_category as b on a.item_category_id=b.id left outer join item_group as c on a.item_group_id=c.id left outer join taxgst as d on a.tax_id=d.gstid left outer join units as u on u.id=a.unit_id left outer join item_type as t on t.id=a.item_type_id left outer join item_racks_master as r on r.id=a.rack ';
        if ($search != '') {
            $qry = $qry . " where  a.barcode like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function unit()
    {
        $qry = 'select id,name from units order by id';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function Hsncode()
    {
        $qry = "select a.* from hsncode as a order by hsnid";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function ItemsCategory()
    {
        $qry = 'select id ,name from item_category where id  in ( SELECT DISTINCT item_category_id from item)';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function ItemsSubCategory($id)
    {
        $qry = 'select id ,name from item_category where  item_category_id=' . $id;
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function Itemtype()
    {
        $qry = 'select id ,name from item_type order by id asc';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function getbarcode()
    {
		$company = $this->getCompanySettings();
		$txt = '';
		if(isset($company[0]['barcode_preffix']) ){
			if($company[0]['barcode_preffix'] != '' ){
				$txt = ' and barcode like "%'.$company[0]['barcode_preffix'].'%" ';
			}
		}
        $qry = 'select *  from company_settings';
        $barcode = $this->db->query($qry)->row_array();
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' ".$txt." order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            print_r($barcode['auto_barcode']);
        } else {
            $query = $query->row_array();
            print_r($query['barcode'] + 1);
        }
    }

    function getnewbarcode()
    {
        $qry = 'select *  from company_settings';
        $barcode = $this->db->query($qry)->row_array();
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $barcode['auto_barcode'];
        } else {
            $query = $query->row_array();
            return $query['barcode'] + 1;
        }
    }

    function Group()
    {
        $qry = 'select id,name,discount from item_group order by id';
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function getgodownitem($id)
    {
        $qry = 'select a.*,b.id as godownid,b.godown_name from ims_godown as b left JOIN (select * from item_godown WHERE item_id=' . $id . ') as a on a.godown_id=b.id';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getotheritem($id)
    {
        $qry = 'SELECT a.item_id,a.alt_item_id as otherid,b.name as othername FROM `item_alternates` as a LEFT JOIN item as b on a.alt_item_id=b.id WHERE a.item_id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getallgodown()
    {
        $qry = 'select * from ims_godown';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getcategorycount($name)
    {
        $qry = "select count(id) from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getanycount($table, $field, $name, $condition)
    {
        $this->db->select("count($field)");
        $query = $this->db->get($table);
        $this->db->where($condition, $name);
        return $query->row_array();
    }

    function getanyid($table, $field, $name, $condition)
    {
        $this->db->select($field);
        $query = $this->db->get($table);
        $this->db->where($condition, $name);
        return $query->result();
    }

    function getidcount($table, $name)
    {
        $this->db->select("count(id)");
        $query = $this->db->get($table);
        $this->db->where('name', $name);
        return $query->row_array();
    }

    function getid($table, $name)
    {
        $this->db->select('id');
        $query = $this->db->get($table);
        $this->db->where('name', $name);
        return $query->result();
    }

    function getcategory($name)
    {
        $qry = "select a.* from item_category as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function gettaxcount($name)
    {
        $qry = "select count(gstid) from taxgst as a where GST ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function saveitemledger($new_insertid)
    {
        $qry = 'SELECT e.id as cid,i.tax_id,a.id as gid,c.id as uid,IFNULL(i.godown,0) as godown FROM item as i left join ims_godown as a on 1=1 left join ( select * from units as b order by b.id asc limit 1) as c on 1=1 left join ( select * from item_category as d order by d.id asc limit 1) as e on 1=1 where i.id=' . $new_insertid . ' order by a.id asc limit 1';
        $query = $this->db->query($qry)->row_array();
        $id = $query['tax_id'];
        $tqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='tax' AND acc_main_id = 10";
        $tquery = $this->db->query($tqry);
        $sqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='saletax' AND acc_main_id = 21";
        $squery = $this->db->query($sqry);
        $pqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='purtax' AND acc_main_id = 19";
        $pquery = $this->db->query($pqry);
        $data['tax'] = $tquery->row_array();
        $data['saletax'] = $squery->row_array();
        $data['purctax'] = $pquery->row_array();
        //        $qry = "update item set item_category_id=IFNULL(item_category_id," . $query['cid'] . ") ,unit_id=IFNULL(unit_id," . $query['uid'] . ") ,godown=IFNULL(godown," . $query['gid'] . "), tax_ledger_id = " . $data['tax']['id'] . " , tax_sales_id = " . $data['saletax']['id'] . ",tax_purchase_id=" . $data['purctax']['id'] . " where id =" . $new_insertid;
        $qry = "update item set item_category_id=IFNULL(item_category_id,1) ,unit_id=IFNULL(unit_id,'0') ,godown=IFNULL(godown,1), tax_ledger_id = " . $data['tax']['id'] . " , tax_sales_id = " . $data['saletax']['id'] . ",tax_purchase_id=" . $data['purctax']['id'] . " where id =" . $new_insertid;
        $this->db->query($qry);
        $qry = "update item set godown= " . $query['gid'] . " where godown=0 and id =" . $new_insertid;
        $this->db->query($qry);
        $qry = "select IFNULL(godown,0) as godown,IFNULL(open_stock,0) as open_stock from item where id=" . $new_insertid;
        $query = $this->db->query($qry)->row_array();
        $qry = "insert INTO item_godown (godown_id,item_id,item_qty,current_stock,open_stock) values (" . $query['godown'] . "," . $new_insertid . "," . $query['open_stock'] . ",0," . $query['open_stock'] . ")";
        $this->db->query($qry);
    }

    function gettaxldg($id)
    {
        $tqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='tax' AND acc_main_id = 10";
        $tquery = $this->db->query($tqry);
        $sqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='saletax' AND acc_main_id = 21";
        $squery = $this->db->query($sqry);
        $pqry = "SELECT * FROM `acc_ledgers` WHERE ref_id=" . $id . " and ref_code='purtax' AND acc_main_id = 19";
        $pquery = $this->db->query($pqry);
        $data['tax'] = $tquery->row_array();
        $data['saletax'] = $squery->row_array();
        $data['purctax'] = $pquery->row_array();
        echo json_encode($data);
    }

    function taxldg_find($search, $type)
    {
        if ($type == "tax") {
            $mainledger = 7;
        } elseif ($type == "saletax") {
            $mainledger = 21;
        } else {
            $mainledger = 19;
        }
        $qry = "select a.name as label,a.* from acc_ledgers as a where (name like('$search%') and acc_main_id=" . $mainledger . ")";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getitemcount($name)
    {
        $qry = "select count(id) as no from item as a where name ='" . $name . "'";
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

    function chk_barcode($barcode)
    {
        $qry = "select count(id) as no from item as a where barcode ='" . $barcode . "'";
        $query = $this->db->query($qry);
        $result = $query->row()->no;
        return $result;
    }

    function check_barcode($id)
    {
        $code = $this->input->post('barcode');
        if ($id == 0) {
            $result = $this->chk_barcode($code);
        } else {
            $qry = "select count(id) as no from item as a where id=" . $id . " and barcode ='" . $code . "'";
            $query = $this->db->query($qry);
            $pre_exist = $query->row()->no;
            if ($pre_exist > 0) {
                $result = 0;
            } else {
                $result = $this->chk_barcode($code);
            }
        }

        if ($result == 0) {
            $response = array('valid' => true);
        } else {
            // Barcode is available
            $response = array('valid' => false, 'message' => 'barcode exists.');
        }
        echo json_encode($response);
    }

    function insert_image($insert_id, $order, $image, $type)
    {
        if ($image != "") {
            $img_data = array(
                'item_id' => $insert_id,
                'iim_name' => $image,
                'iim_type' => $type,
                'orders' => $order,
            );
            $this->db->insert('item_image', $img_data);
        }
    }

    function item_barcode($id, $insert_id, $unit, $barcode, $srate)
    {
        if ($id == 0) {
            $units = $this->getunits($unit);
            $units = explode(",", $units);
            $rate = $srate;
            $length = sizeof($units);
            for ($i = 0; $i < $length; $i++) {
                if ($i == 0) {
                    $item_barcode = $barcode;
                } else {
                    $qry = "select * from units where id=" . $units[$i];
                    $query = $this->db->query($qry);
                    $query = $query->row_array();
                    $rate = $rate * $query['unit_count'];
                    $item_barcode = $barcode . '-' . $units[$i];
                }
                $item_data = array(
                    'item_id' => $insert_id,
                    'unit_id' => $units[$i],
                    'barcode' => $item_barcode,
                    'rate' => $rate,
                );
                $this->db->insert('item_barcode', $item_data);
            }
        } else {
            $qry = "select * from item_barcode where item_id=" . $insert_id . " order by id asc limit 1";
            $query = $this->db->query($qry);
            $query = $query->row_array();
            $uid = $query['unit_id'];
            if ($uid != $unit) {
                $qry = "delete  from item_barcode where item_id=" . $insert_id;
                $this->db->query($qry);
                $units = $this->getunits($unit);
                $units = explode(",", $units);
                $length = sizeof($units);
                for ($i = 0; $i < $length; $i++) {
                    $item_barcode = $barcode . '-' . $units[$i];
                    if ($i == 0) {
                        $item_barcode = $barcode;
                    }
                    $item_data = array(
                        'item_id' => $insert_id,
                        'unit_id' => $units[$i],
                        'barcode' => $item_barcode,
                    );
                    $this->db->insert('item_barcode', $item_data);
                }
            }
        }
    }

    function gettaxid($name)
    {
        $qry = "select gstid from taxgst as a where GST ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function gethsncount($name)
    {
        $qry = "select count(hsnid) from hsncode as a where hsncode ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function gethsnid($name)
    {
        $qry = "select hsnid from hsncode as a where hsncode ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function Add_item($data_item)
    {
        $this->db->insert('item', $data_item);
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function Add_item_ledger($data_item_ledger)
    {
        $this->db->insert('item_ledger', $data_item_ledger);

        /* $response = array(
          'valid' => false,
          'type' => 1,
          'message' => 'Saved Successfully.'
          );
          echo json_encode($response); */
    }

    function getgroupcount($name)
    {
        $qry = "select count(id) from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getitemgroup($name)
    {
        $qry = "select a.* from item_group as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    function getunitcount($name)
    {
        $qry = "select count(id) from units as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->row_array();
    }

    function getunit($name)
    {
        $qry = "select a.* from units as a where name ='" . $name . "'";
        $query = $this->db->query($qry);
        return $query->result();
    }

    public function savefromexcel()
    {
        $rowtotal = $this->input->post('counttotal');
        $columntotal = $this->input->post('countcol');
        $table_name = $this->input->post('table_name');
        $data = array();
        $ledger_data = array();
        $ledger_data['code'] = '0';
        $qry = "";
        $qry = 'insert into ' . $table_name . '(';
        if ($table_name == "customer") {
            $qry = 'insert into suppliers(';
        }
        $check = $table = "0";
        for ($j = 1; $j <= $columntotal; $j++) {
            if ($j == 1) {
                // $qry='insert into '.$table_name.'(';
                //    if($table_name=="customer"){
                //           'insert into suppliers(';
                //          }
            }
            if ($table != "0") {
                $check = 1;
            }
            $table = $this->input->post('colselect_' . $j);
            if ($table != "0") {
                if ($j != 1 && $check != "0") {
                    $qry = $qry . ',';
                }
                $qry = $qry . $table;
            }
        }
        if ($table_name == "customer") {
            $qry = $qry . ' ,type) values';
        }
        if ($table_name == "suppliers") {
            $qry = $qry . ' ,type) values';
        }
        if ($table_name == "item") {
            $qry = $qry . ') values';
        }
        $qry1 = $qry;
        if ($rowtotal > 1) {
            for ($i = 2; $i <= $rowtotal; $i++) {

                if ($i != 2) {
                    $qry = $qry . ',';
                }
                $qry = $qry1 . '(';
                $check1 = $table1 = "0";
                for ($j = 1; $j <= $columntotal; $j++) {
                    if ($table1 != "0") {
                        $check1 = 1;
                    }
                    $table1 = $this->input->post('colselect_' . $j);
                    $field = $this->input->post('txt_' . $j . '_' . $i);
                    if ($table1 == 'name') {
                        $ledger_data['name'] = $field;
                    }
                    if ($table1 == 'phone') {
                        $ledger_data['code'] = $field;
                    }
                    if ($table1 != "0") {
                        $field = $this->getfield($table_name, $table1, $field);
                        if ($j != 1 && $check1 != "0") {
                            $qry = $qry . ',';
                        }
                        $qry = $qry . "'" . $field . "'";
                    }
                }
                if ($table_name == "item") {
                    $qry = $qry . ')';
                }
                if ($table_name == "customer") {
                    $qry = $qry . " ,'cus')";
                    $ledger_data['ref_code'] = 'cus';
                    $ledger_data['is_default'] = 'true';
                    $ledger_data['acc_main_id'] = 25;
                    $ledger_data['published'] = 'yes';
                    $ledger_data['type'] = 'Dr';
                    $this->db->query($qry);
                    $insert_id = $this->db->insert_id();
                    $ledger_data['ref_id'] = $insert_id;
                    $this->db->insert('acc_ledgers', $ledger_data);
                    $ledgers_code = $this->db->insert_id();
                }
                if ($table_name == "suppliers") {
                    $qry = $qry . " ,'sup')";
                    $ledger_data['is_default'] = 'true';
                    $ledger_data['ref_code'] = 'sup';
                    $ledger_data['acc_main_id'] = 24;
                    $ledger_data['published'] = 'yes';
                    $ledger_data['type'] = 'Cr';
                    $this->db->query($qry);
                    $insert_id = $this->db->insert_id();
                    $ledger_data['ref_id'] = $insert_id;
                    $this->db->insert('acc_ledgers', $ledger_data);
                    $ledgers_code = $this->db->insert_id();
                }

                if ($table_name == "item") {
                    $this->db->query($qry);
                    $new_insertid = $this->db->insert_id();
                    $this->saveitemledger($new_insertid);
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

    public function save_transist()
    {
        $item_id = $this->input->post('id', TRUE);
        $quantity = $this->input->post('quantity', TRUE);
        $size = $this->input->post('size_id', TRUE);
        if ($this->input->post('is_color') == 'yes') {
            $color = $this->input->post('color_id', TRUE);
        }

        $date = $this->getDate($this->input->post('date', true));
        $recieved = $this->input->post('recieved', TRUE);
        $damaged = $this->input->post('damaged', TRUE);
        $notes = $this->input->post('notes', TRUE);
        $quantityTot = $this->input->post('quantity_tot', TRUE);
        $godown = $this->input->post('god');
        $tr_id = $this->input->post('vid');
        $length = sizeof($quantity);
        $userid = $this->session->userdata('user');
        $userid = $userid['Id'];
        $status = 0;
        //End
        $data = array(
            'transfer_id' => $tr_id,
            'godown' => $godown,
            'user' => $userid,
            'date' => $date,
        );

        $this->db->insert('intransist_main', $data);
        $trans_id = $this->db->insert_id();

        for ($i = 0; $i < $length; $i++) {
            if ($this->input->post('is_color') == 'no') {
                $color[$i] = 0;
            }
            $data = array(
                'transist_id' => $trans_id,
                'item_id' => $item_id[$i],
                'size' => $size[$i],
                'color' => $color[$i],
                'quantity' => $quantity[$i],
                'recieved' => $recieved[$i],
                'damaged' => $damaged[$i],
                'notes' => $notes[$i],
                'published' => 'yes',
            );

            if ($quantityTot[$i] > 0) {
                $status = 1;
            }
            // print_r($trans_id);
            $this->db->insert('intransist_sub', $data);
            $totals = $recieved[$i] + $damaged[$i];
            $this->stock_trans(0, $item_id[$i], $totals, $date, 'dt', 'transfer', $trans_id, 0, 0, 0, $godown, $tr_id, $size[$i], $color[$i]);
            $this->godown_stock_trans(0, $item_id[$i], $totals, 'dt', 'item', $godown, $size[$i], $color[$i], 0, 0, 0, 0);
        }

        if ($status < 1) {
            $data = array(
                'status' => 1,
            );
            $this->db->where('id', $tr_id);
            $this->db->update('item_transfer', $data);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function save_sitem()
    {
        $from_godown = $this->input->post('from_godown');
        $to_godown = $this->input->post('to_godown');
        $debit = $this->input->post('debit');
        $credit = $this->input->post('credit', true);
        $vid = $this->input->post('vid', true);
        $date = $this->getDate($this->input->post('date', true));
        $stotal = 0.00;
        $ptotal = 0.00;
        $length = sizeof($debit);
        $id = $this->input->post('id');
        $pid = $this->input->post('supid');
        for ($i = 0; $i < $length; $i++) {
            $ptotal = $ptotal + $credit[$i];
        }
        for ($i = 0; $i < $length; $i++) {
            $stotal = $stotal + $debit[$i];
        }
        for ($i = 0; $i < $length; $i++) {

            if ($i == 0 and $vid == 0) {
                $qry = "insert into prd_stock (created_date,product_id,from_godown,to_godown,total_quantity) values  ('" . $date . " ' , " . $pid . " , " . $from_godown . ", " . $to_godown . " , " . $ptotal . ")";
                $this->db->query($qry);
                $insert_id = $this->db->insert_id();
            }
            if ($i == 0 and $vid > 0) {
                $qry = "update  prd_stock set created_date ='" . $date . "',  product_id =  " . $pid . "  ,    total_quantity=   " . $ptotal . "  where id =" . $vid;
                $this->db->query($qry);
                $this->godown_stock_trans(0, $id[$i], $ptotal, 'cr', 'item', $from_godown[$i]);
                $qry = "update item_ledger set published = 'no' where trans_status='item'  and trans_id=" . $vid;
                $this->db->query($qry);
                $insert_id = $vid;
                $qry = "update prd_stockitem set published = 'no' where stock_prod_id=" . $vid;
                $this->db->query($qry);
                $this->stock_prod(0, $pid, $ptotal, $date, 'cr', 'item', $insert_id);
            }
            $qry = 'insert into prd_stockitem (sal_item_id,stock_prod_id,pur_item_id,quantity,total) values  (' . $id[$i] . ',' . $insert_id . ',' . $pid . ',' . $credit[$i] . ',' . $debit[$i] . ')';
            $this->db->query($qry);
            $this->stock_prod(0, $id[$i], $debit[$i], $date, 'dt', 'item', $insert_id);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'dt', 'item', $to_godown[$i]);
        }
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getgodown()
    {
        $qry = 'select * from ims_godown where id>0 order by id asc limit 1';
        $query = $this->db->query($qry)->row_array();
        return $query['id'];
    }

    function getautocomplete($q, $type)
    {
        $query = $this->db->query("select CONCAT(a.name,' ',a.barcode) as label,a.id,b.current_stock from item as a LEFT JOIN item_godown as b on a.id=b.item_id  where name like ('%" . $q . "%') or barcode  like ('%" . $q . "%') and item_type_id=1 limit 25")->result_array();
        print_r(json_encode($query));
    }

    public function save_transfer()
    {
        $from_godown = $this->input->post('from_godown');
        $to_godown = $this->input->post('to_godown');
        $transfer = 'transfer';
        $debit = $this->input->post('debit', true);
        $vid = $this->input->post('vid', true);
        $date = $this->getDate($this->input->post('date', true));
        $length = sizeof($debit);
        $id = $this->input->post('id');
        //By althaf
        $size = $this->input->post('size_id', TRUE);
        if ($this->input->post('is_color') == 'yes') {
            $color = $this->input->post('color_id', TRUE);
        }
        $address = $this->input->post('address');
        $eway = $this->input->post('eway');
        $drate = $this->input->post('drate', TRUE);
        $brate = $this->input->post('brate', TRUE);
        $mrp_item = $this->input->post('mrp_item', TRUE);
        $prate_item = $this->input->post('prate_item', TRUE);
        //End
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0 and $vid == 0) {
                $invoice = $this->getinoviceno();
                $qry = "insert into item_transfer (date,from_id,invoice) values  ('" . $date . " ' , " . $from_godown . " , '" . $invoice . " ')";
                $this->db->query($qry);
                $insert_id = $this->db->insert_id();
            }
            if ($i == 0 and $vid > 0) {
                $qry = "update  item_transfer set date ='" . $date . "',  from_id =  " . $from_godown . " where id =" . $vid;
                $this->db->query($qry);
                $insert_id = $vid;
                $qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $insert_id;
                $this->db->query($qry);
                $this->restore_godown_transfer_stock($insert_id);
                $qry = "update item_transfer_sub set published = 'no' where transfer_id=" . $vid;
                $this->db->query($qry);
            }
            if ($this->input->post('is_color') == 'no') {
                $color[$i] = 0;
            }
            $this->stock_trans(0, $id[$i], $debit[$i], $date, 'cr', $transfer, $insert_id, 0, 0, 0, $from_godown, "", $size[$i], $color[$i]);
            // $this->stock_trans(0, $id[$i], $debit[$i], $date, 'dt', $transfer, $insert_id, 0, 0, 0, $to_godown,"",$size[$i],$color[$i]);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'cr', 'item', $from_godown, $size[$i], $color[$i], $mrp_item[$i], $prate_item[$i], $drate[$i], $brate[$i]);
            // $this->godown_stock_trans(0, $id[$i], $debit[$i], 'dt', 'item', $to_godown, $size[$i], $color[$i], $mrp_item[$i], $prate_item[$i], $drate[$i], $brate[$i]);
            $qry = 'insert into item_transfer_sub (item_id,transfer_id,qty,to_id, size, color, eway) values  (' . $id[$i] . ',' . $insert_id . ',' . $debit[$i] . ',' . $to_godown . ',' . $size[$i] . ',' . $color[$i] . ', "' . $eway . '")';
            $this->db->query($qry);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function save($vdo_a = '')
    {
        $analytics_id = 0;
        $material_type = 1;
        $taxldg_id = 0; //get tax id from acc ledgers
        $saletax_id = 0;
        $purctax_id = 0;
        $open_stock = 0;
        $commission = 0;
        $wholerate = 0;
        $is_multipleunit = $this->input->post('is_multipleunit');
        $unit = $this->input->post('unit_id');
        $id = $this->input->post('id');
        $is_autobarcode = $this->input->post('is_autobarcode');
        $barcode = $this->input->post('barcode');
        $brand_id = $this->input->post('brand_id');
        if ($brand_id == null) {
            $brand_id = 0;
        }
        $is_rack = $this->input->post('is_rack');
        $is_production = $this->input->post('is_production');
        $is_analytics = $this->input->post('is_analytics');
        $item_type = $this->input->post('itemtype');
        $name = $this->input->post('name'); // if it is zero then we will add the item
        $hsncode_id = $this->input->post('hsn_id');
        $price_code = $this->input->post('price_code');
        $name_lan = $this->input->post('name_lan');
        $technical = $this->input->post('technical');
        $accessories = $this->input->post('accessories');
        $vid_url = $this->input->post('vid_b');
        $genders = $this->input->post('genders');
        $item_category_id = $this->input->post('item_category_id');
        $isgodown = $this->input->post('isgodown');
        $is_multipletax = $this->input->post('is_multipletax');
        $item_group_id = $this->input->post('item_group_id');
        $type_photo = $this->input->post('type_photo');
        $imagess = $this->input->post('image_names', TRUE);
        $order = $this->input->post('get_order', TRUE);
        if ($item_group_id == null) {
            $item_group_id = 0;
        }
        $minimum = $this->input->post('minimuml');

        if ($minimum == '') {
            $minimum = 0;
        }
        $maximum = $this->input->post('maxl');
        if ($maximum == '') {
            $maximum = 0;
        }
        $online_item = $this->input->post('online_item');
        $barcode_count = $this->chk_barcode($barcode);
        if ($this->input->post('commission')) {
            $commission = $this->input->post('commission');
        }
        if ($this->input->post('wholerate')) {
            $wholerate = $this->input->post('wholerate');
        }
        $mfgdate = $this->input->post('mfgdate');
        $description = $this->input->post('description');
        if ($mfgdate) {
            $mfgdate = $this->getDate($this->input->post('mfgdate'));
            $expdate = $this->getDate($this->input->post('expdate'));
        } else {
            $mfgdate = date('Y-m-d');
            $expdate = date('Y-m-d');
        }
        if ($isgodown != 1) {
            $open_stock = $this->input->post('open_stock');
        }
        if ($this->input->post('taxldg_id')) {
            $taxldg_id = $this->input->post('taxldg_id');
        }
        if ($this->input->post('saletax_id')) {
            $saletax_id = $this->input->post('saletax_id');
        }
        if ($this->input->post('purctax_id')) {
            $purctax_id = $this->input->post('purctax_id');
        }
        if ($is_production != 0) {
            $material_type = $this->input->post('material_type');
            if ($material_type == null) {
                $material_type = 0;
            }
        }
        if ($is_analytics != 0) {
            if ($this->input->post('analytics_id')) {
                $analytics_id = $this->input->post('analytics_id');
            }
        }
        // $current_stock = $this->input->post('current_stock');
        $reorder_point = $this->input->post('reorder_point');
        if ($reorder_point == '') {
            $reorder_point = 0;
        }
        $prate = 0; // if it is zero then we will add the item
        if ($this->input->post('prate')) {
            $prate = $this->input->post('prate');
        }
        $srate = 0;
        if ($this->input->post('srate')) {
            $srate = $this->input->post('srate');
        }
        $open_stk_rate = $this->input->post('open_stk_rate');
        if ($open_stk_rate == 0 || $open_stk_rate == "") {
            $open_stk_rate = $prate;
        }
        $MRP = 0;
        if ($this->input->post('MRP')) {
            $MRP = $this->input->post('MRP');
        }
        $tax_id = 0;
        if ($this->input->post('tax_id')) {
            $tax_id = $this->input->post('tax_id');
        }
        $item_image = $this->input->post('photo_enable');
        $item_video = $this->input->post('video_enable');
        $item_alternates = $this->input->post('alternate_item_set');
        if ($isgodown != 0) {
            $godown = $this->input->post('gid', TRUE);
            $gwn_qty = $this->input->post('gqty', TRUE);
            $length = sizeof($gwn_qty);
        } else {
            $godown = $this->getgodown();
            $gwn_qty = $open_stock;
            $length = 1;
        }
        /*
          if ($isgodown != 0) {
          $godown = $this->input->post('gdnid', TRUE);
          $gwn_qty = $this->input->post('gdnqty', TRUE);
          $length = sizeof($gwn_qty);
          } else {
          $godown = 1;
          $gwn_qty = $open_stock;
          $length = 1;
          } */
        if ($is_rack != 0) {
            $rack = $this->input->post('rack_id');
            $rrow = $this->input->post('rrow');
            if ($rack == "") {
                $rack = 0;
                $rrow = 0;
            }
        } else {
            $rack = 0;
        }
        if ($isgodown != 0) {
            $godown = $this->input->post('gid', TRUE);
            $gwn_qty = $this->input->post('gqty', TRUE);
            $length = sizeof($gwn_qty);
        } else {
            $godown = $this->getgodown();
            $gwn_qty = $open_stock;
            $length = 1;
        }
        if ($item_alternates != 0) {
            $alt_item = $this->input->post('alt_itemids', TRUE);
            if (isset($alt_item)) {
                $alt_length = sizeof($alt_item);
            } else {
                $alt_length = 0;
            }
        } else {
            $alt_length = 0;
        }
        $data = array(
            'name' => $name,
            'brand_id' => $brand_id,
            'barcode' => $barcode,
            'hsncode' => $hsncode_id,
            'price_code' => $price_code,
            'item_category_id' => $item_category_id,
            'item_group_id' => $item_group_id,
            'item_type_id' => $item_type,
            'unit_id' => $unit,
			'part_no'=>'',
            'min_level' => $minimum,
            'max_level' => $maximum,
            'wh_rate' => $wholerate,
            'open_stock' => $open_stock,
            'rack' => $rack,
            // 'current_stock' => $current_stock,
            'reorder_point' => $reorder_point,
            'prate' => $prate,
            'srate' => $srate,
            'open_stk_rate' => $open_stk_rate,
            'MRP' => $MRP,
            'gender' => $genders,
            'commission' => $commission,
            'tax_id ' => $tax_id,
            'tax_ledger_id' => $taxldg_id,
            'tax_sales_id' => $saletax_id,
            'tax_purchase_id' => $purctax_id,
            'mfg_date' => $mfgdate,
            'exp_date' => $expdate,
            'material_type' => $material_type,
            'analytics_id' => $analytics_id,
            'item_online' => $online_item,
            'description' => $description,
        );
        if ($this->input->post('technical')) {
            $data['technical'] = $technical;
        }
        if ($this->input->post('accessories')) {
            $data['accessories'] = $accessories;
        }
        if ($this->input->post('item_size')) {
            $data['item_size_id'] = $this->input->post('item_size');
        }
        if ($isgodown == 0) {
            $data['godown'] = $godown;
        }
        if ($this->input->post('manual')) {
            $isbarcode = $this->input->post('manual');
            $data['is_autobarcode'] = $isbarcode;
        }

        if ($this->input->post('name_lan')) {
            $data['name_lan'] = $this->input->post('name_lan');
        }
        if ($id == 0) {
            $barcode_count = $this->chk_barcode($barcode);
            if ($barcode_count > 0 && $is_autobarcode == 1) {
                $data['barcode'] = $this->getnewbarcode();
            }
            // this is  for log 
            // $this->updateAuditLog("Item Created", [], $data);


            $this->db->insert('item', $data);
            $insert_id = $this->db->insert_id();
            if ($rack != 0) {
                $rack_data = array(
                    'item_id' => $insert_id,
                    'rack_id' => $rack,
                    'row' => $rrow
                );
                $this->db->insert('item_racks', $rack_data);
            }
            $published = 'yes';
            $exist = 0;
            for ($i = 0; $i < $length; $i++) {
                if ($isgodown != 0) {
                    $data1 = array(
                        'godown_id' => $godown[$i],
                        'item_qty' => $gwn_qty[$i],
                        'open_stock' => $gwn_qty[$i],
                        'item_id' => $insert_id,
                        'published' => $published,
                    );
                } else {
                    $data1 = array(
                        'godown_id' => $godown,
                        'item_qty' => $gwn_qty,
                        'item_id' => $insert_id,
                        'published' => $published,
                        'open_stock' => $gwn_qty,
                    );
                }
                $this->db->insert('item_godown', $data1);
            }
        } else {
            $published = 'yes';
            if($vdo_a == ''){
                $delqry = "delete from item_image where iim_type <> 'video' and item_id =" . $id;
            }else{
                $delqry = "delete from item_image where item_id =" . $id;
            }
            
            $this->db->query($delqry);
            $delqry = "delete from item_alternates where item_id =" . $id;
            $this->db->query($delqry);

            for ($i = 1; $i <= $length; $i++) {
                if ($isgodown != 0) {
                    $qry = "select  count(id) as cnt,open_stock from  item_godown where item_id ='" . $id . "'and godown_id ='" . $godown[$i] . "'";
                    $query = $this->db->query($qry)->row_array();
                    $itemcount = $query['cnt'];
                    $qry = "update  item_godown set item_qty ='" . $gwn_qty[$i] . "',open_stock ='" . $gwn_qty[$i] . "' where item_id ='" . $id . "'and godown_id ='" . $godown[$i] . "'";
                    $this->db->query($qry);
                    if ($itemcount == '0') {
                        $qry = "insert into item_godown(godown_id,item_id,item_qty,open_stock) values(" . $godown[$i] . " , " . $id . " , " . $gwn_qty[$i] . " , " . $gwn_qty[$i] . ")";
                        $this->db->query($qry);
                    }
                } else {
                    $qry = "update  item_godown set item_qty ='" . $gwn_qty . "',open_stock ='" . $gwn_qty . "' where item_id ='" . $id . "'and godown_id ='" . $godown . "'";
                    $this->db->query($qry);
                }
            }

            // log for update base array
            $this->db->where('id', $id);
            $query = $this->db->get('item');

            $this->db->where('id', $id);
            $this->db->update('item', $data);
            if ($is_rack != 0) {
                $rack_data = array(
                    'rack_id' => $rack,
                    'row' => $rrow
                );
                $this->db->where('item_id', $id);
                $this->db->update('item_racks', $rack_data);
            }
            // log for update new array
            $this->db->where('id', $id);
            $queryn = $this->db->get('item');
            //  $this->updateAuditLog("Item Updated", $query->row_array(), $queryn->row_array());

            $insert_id = $id;
            $published = 'yes';
            $exist = 1;
        }
        if ($item_image != 0) {

            $length = count($imagess);
            if ($length > 0) {
                for ($i = 0; $i < $length; $i++) {
                    $this->insert_image($insert_id, $order[$i], $imagess[$i], 'image');
                }
            }
        }
        if ($item_video != 0) {

            if ($this->input->post('type_vid') == 'url') {
                $this->insert_image($insert_id, '1', $vid_url, 'url');
            } else {
                if ($vdo_a != '') {
                    $this->insert_image($insert_id, '1', $vdo_a, 'video');
                }
            }
        }
        for ($i = 0; $i < $alt_length; $i++) {
            $alt_data = array(
                'item_id' => $insert_id,
                'alt_item_id' => $alt_item[$i],
            );
            $this->db->insert('item_alternates', $alt_data);
        }
        if ($is_multipleunit == 1) {
            $this->item_barcode($id, $insert_id, $unit, $this->input->post('barcode'), $srate);
        }
        $response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function getledgeritem($id)
    {
        $qry = "select count(id) as itemcnt from item_ledger where item_id ='" . $id . "'";
        $query = $this->db->query($qry);
        return $query->row()->itemcnt;
    }

    function delete($id)
    {
        // log for update new array
        $this->db->where('id', $id);
        $query = $this->db->get('item');
        // $this->updateAuditLog("Item Deleted", $query->row_array(), ''); 

        $qry = "UPDATE `item` SET `published` = 'no' WHERE `item`.`id` = " . $id;
        $this->db->query($qry);
        /* $qry = "delete from item where id =" . $id;
          $this->db->query($qry);
          $gqry = "delete from item_godown where item_id =" . $id;
          $this->db->query($gqry); */
    }
}
