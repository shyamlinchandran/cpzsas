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
class Items_model extends DataTable
{

    public function __construct()
    {
        parent::__construct();
        $this->select = " IFNULL(open,0) as open,IFNULL(c.total,0) as total,unit_id,a.id,a.name as itemname,IFNULL(a.barcode,'') as barcode,IFNULL(a.srate,0) as salerate,IFNULL(b.name,'') as category,IFNULL(a.description,'') as description,IFNULL(a.open_stock,0) as open_stock,IFNULL(a.current_stock,0) as current_stock,IFNULL(a.prate,0) as prate";
        //,c.name as group_name,d.name as unit,e.name as tax
        $this->table = 'item as a left join item_category as b on a.item_category_id =b.id left join (select sum(current_stock+open_stock) as total,sum(open_stock) as open,item_id  from item_godown group by item_id) as c on c.item_id=a.id';
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
		if ($this->input->post('brand')) {
            $this->wherecondition = $this->wherecondition . ' and a.brand_id=' . $this->input->post('brand');
        }
    }

    public function category_list()
    {
        $this->select = "ic.*,ic.image as icimage, icc.name as iccname";
        $this->table = 'item_category as ic left join item_category as icc on icc.id = ic.item_category_id';
        $this->column_order = array(null, 'name'); //set column field database for datatable orderable   
        $this->column_search = array('ic.name'); //set column field database for datatable searchable 
        $this->order = array('ic.id' => 'desc'); // default order 
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
		 if ($table_name == 'lead') {
            $dropdownvalue = '<option value="">Select</option><option value="date">Date Y-m-d</option><option value="companyName">Name</option><option value="adress">Address</option><option value="gst">GSTIN</option><option value="contactPerson">Contact Person</option>  <option value="contactNumber">Contact Number</option>     <option value="email">Email</option>    <option value="source">Sourse of Enquiry</option><option value="area">Area</option><option value="unbuss">Nature of Bussiness</option><option value="remarks">Remarks</option>';
        }
        if ($table_name == 'enquiry') {
            $dropdownvalue = '<option value="">Select</option><option value="date">Date Y-m-d</option><option value="lead">Lead(Will Be saved in leadmaster)</option><option value="companyName">Company Name</option><option value="adress">Address</option><option value="type">Type Of Enquiry</option><option value="product_id">Goods/Service/Course</option><option value="quantity">Quantity</option><option value="price">Price</option><option value="gst">GSTIN</option><option value="contactPerson">Contact Person</option>  <option value="contactNumber">Contact Number</option>     <option value="email">Email</option>          <option value="source">Sourse of Enquiry</option><option value="area">Area</option><option value="unbuss">Nature of Bussiness</option><option value="remarks">Remarks</option>';
        }

        if ($table_name == 'item') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="item_type_id">Goods/service</option><option value="barcode">Barcode</option><option value="godown">Godown</option><option value="brand_id">Brand</option><option value="item_size_id">Size</option><option value="item_color_id">Color</option><option value="open_stock">Open Stock</option>  <option value="unit_id">Unit</option>     <option value="item_category_id">Category</option>      <option value="item_group_id">Item Discount Group</option>    <option value="reorder_point">Reorder Point</option><option value="min_level">Min Level</option><option value="max_level">Max Level</option><option value="rack">Rack</option><option value="prate">Purchase Rate</option><option value="srate">SaleRate</option><option value="landing_cost">Landing Cost</option><option value="special_rate">Special Rate</option><option value="wh_rate">WholsaleRate</option><option value="MRP">Mrp</option><option value="landing_cost">Landing Cost</option><option value="open_stk_rate">OpenStockRate</option><option value="commission">Commission</option><option value="tax_id">Tax</option><option value="tax_ledger_id">TaxLedgerId</option><option value="tax_sales_id">TaxSalesId</option><option value="tax_purchase_id">TaxPurchaseId</option><option value="hsncode">HsncodeId</option><option value="description">Description</option><option value="mfg_date">MFGDate</option><option value="exp_date">ExpireyDate</option><option value="analytics_id">AnalyticsId</option>';
        }
        if ($table_name == 'suppliers') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>  <option value="openning_bal">Openning Balance</option><option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option><option value="area">Area</option>';
        }
        if ($table_name == 'customer') {
            $dropdownvalue = '<option value="0">Select</option><option value="name">Name</option><option value="phone">Phone</option><option value="tin">GST/TIN</option>   <option value="openning_bal">Openning Balance</option> <option value="email">Email</option>     <option value="address_line1">Address</option>      <option value="details">Details</option>    <option value="bank">Bank</option><option value="account_no"> Account No</option><option value="ifsc_code">IFSC CODE</option><option value="area">Area</option>';
        }
        if ($table_name == 'estimate') {
            $dropdownvalue = '<option value="0">Select</option><option value="sales_id">Sales Id</option>
<option value="invoice">Invoice</option>
<option value="invoice_date">Invoice Date</option>
<option value="invoice_total">Invoice Total</option>
<option value="invoice_tax">Invoice Tax</option>
<option value="invoice_cess">Invoice Cess</option>
<option value="invoice_discount">Invoice Discount</option>
<option value="user">User</option>
<option value="customer">Customer</option>
<option value="salesman">Salesman</option>
<option value="remarks">Remarks</option>
<option value="item">Item</option>
<option value="rate">Rate</option>
<option value="Item_Base_Unit">Item Base Unit</option>
<option value="Item_Sub_Unit">Item Sub Unit</option>
<option value="Sales_Unit">Sales Unit</option>
<option value="unit_conversion">Unit Conversion</option>
<option value="quantity">Quantity </option>
<option value="Amount">Amount</option>
<option value="discount_per">Discount%</option>
<option value="discountAmount">Discountamount</option>
<option value="Taxable">Taxable</option>
<option value="taxpercentage">Taxpercentage</option>
<option value="tax">Tax</option>
<option value="cesspercentage">Cesspercentage</option>
<option value ="godown" >Godown</option>
<option value="cess">Cess</option>
<option value="total">Total</option>
';
        }
        return $dropdownvalue;
        // if($table_name == 'supplier'){
        // }
        // if($table_name == 'item'){
        // }
    }

    function gettransfer($id)
    {
        $qry = "select barcode,eway_no,DATE_FORMAT(eway_date, '%d/%m/%Y' ) as ewaydate,transport_mode,vehicle_no,purpose,place,reference,DATE_FORMAT(ref_date, '%d/%m/%Y' ) as ref_date,item_rate,b.unit_id,base_unit_id,IFNULL(u.name,'') as unitname,batch,DATE_FORMAT(a.date, '%d/%m/%Y' ) as dtp,a.from_id,b.item_id as item,b.qty as qty,to_id ,i.name,item_id from item_transfer as a inner join item_transfer_sub as b on b.transfer_id=a.id left join units as u on u.id=b.unit_id inner join item as i on i.id=b.item_id where b.published='yes' and a.id =" . $id;
        //echo $qry;b.
        $query = $this->db->query($qry);
        return $query->result_array();
    }

    function getsing($id)
    {
		$settings = $this->getCompanySettings();
		$text = '';
		if(isset($settings[0]['is_calendar'])){
			if((float)$settings[0]['is_calendar'] > 0 ){
				$text = 'discount_per,discount_amount,fees,a.validity,validity_days,';
			}
		}
        $qry = 'select DATE_FORMAT(package_date,"%d/%m/%Y") as packagedate ,ifnull(sup.name,"") as supname,'.$text.'DATE_FORMAT(exp_date,"%d/%m/%Y") as exp,DATE_FORMAT(mfg_date,"%d/%m/%Y") as mfg, IFNULL(hsn.hsncode,"") as hsnname,IFNULL(cat.name,"") as catname,IFNULL(item_stock,0) as item_stock,a.*,a.name as name,y.any_name,y.any_id,x.id as taxldgid,x.name as taxldg,w.id as saletxid,w.name as saletxldg, z.id as purctxid, z.name as purctxldg from item as a left join item_category as cat on cat.id=a.item_category_id left join hsncode as hsn on hsn.hsnid=a.hsncode left join (select sum(z.open_stock) as item_stock,z.item_id as iid from item_godown as z group by z.item_id ) as x on x.iid=a.id left outer join analytics_center as y on a.analytics_id=y.any_id left outer join acc_ledgers as x on a.tax_ledger_id=x.id left outer join acc_ledgers as w on a.tax_sales_id=w.id left outer join acc_ledgers as z on a.tax_purchase_id=z.id   left join suppliers as sup on sup.id = a.supplier  where a.id=' . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function getpitem($id, $uid=0)
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

    public function delete_category($id)
    {
        $qry = 'delete from item_category where id = ' . $id;
        $this->db->query($qry);

        $response = array(
            'status' => true,
            'message' => 'Deleted Successfully',
        );
        echo json_encode($response);
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
	
	public function savefeature(){
		$category_id = $this->input->post('id');
		$itemtypevalue = $this->input->post('feature',TRUE);
		$qry = "update itemtypecategory set published = 'no' where categoryid =".$category_id;
		$this->db->query($qry);
		if($this->input->post('feature',TRUE)){
			$length = sizeof($itemtypevalue);
			for($i=0;$i<$length;$i++){
				$data = array(
					'categoryid'=>$category_id,
					'published'=>'yes',
					'itemtypevalue'=>$itemtypevalue[$i]
				);
				$this->db->insert('itemtypecategory',$data);
			}
		}
		$response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

    public function save_category($filename = "")
    {

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $category = $this->input->post('cate');

        $data = array(
            'name' => $name,
            'item_category_id' => $category,
        );
        if ($id > 0) {
            if ($filename != "") {
                $data['image'] = $filename;
            }
            $this->db->where('id', $id);
            $this->db->update('item_category', $data);
        } else {
            if ($filename != "") {
                $data['image'] = $filename;
            }

            $result = $this->db->insert('item_category', $data);
        }

        $response = array(
            'status' => true,
            'message' => 'Saved Succesfully',
        );

        echo json_encode($response);
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


    public function get_cat_data($id)
    {
        $qry = 'select * from item_category where id = ' . $id;
        $gwn = $this->db->query($qry);
        echo json_encode($gwn->row_array());
    }

    public function get_category()
    {
        $qry = "select * from item_category where 1";
        $exeres = $this->db->query($qry);
        echo json_encode($exeres->result_array());
    }

    function item_category()
    {
        $qry = "SELECT * FROM `item_category` where 1 ORDER BY `id` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function godown($godown)
    {
        $qry = 'select * from ims_godown';
        $gwn = $this->db->query($qry);
        return $gwn->result_array();
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
        $qry = 'select * from item_brand order by ibr_name asc';
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
        $qry = $qry . " where a.published ='yes'";
        if ($search != '') {
            $qry = $qry . " and  a.name like('%$search%') ";
        }
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    public function checkItemName()
    {
        $typed = $this->input->post('typed');
        if ($this->input->post('itemorbar') == "item") {
            $qry = "select i.* from item as i where name = '" . $typed . "'";
            $res = $this->db->query($qry);
            echo json_encode($res->row_array());
        } else {
            $qry = "select i.* from item as i where barcode = '" . $typed . "'";
            $res = $this->db->query($qry);
            echo json_encode($res->row_array());
        }
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
        $qry = 'select id,name from units where unit_id is null or unit_id = 0 order by id';
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
        $barcode = $this->getCompanySettings();;
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            print_r($barcode[0]['barcode_preffix'].$barcode[0]['auto_barcode']);
        } else {
            $query = $query->row_array();
			$item_barcode = $query['barcode'];
			$item_barcode = str_replace($barcode[0]['barcode_preffix'],'',$item_barcode);
			$item_barcode = (int) $item_barcode  +1;
            print_r($barcode[0]['barcode_preffix'].$item_barcode);
        }
    }

    function getnewbarcode()
    {
        $barcode = $this->getCompanySettings();;
        $qry = "select barcode from  item   where is_autobarcode='1' and published='yes' order by id desc limit 0,1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $barcode[0]['barcode_preffix'].$barcode[0]['auto_barcode'];
        } else {
            $query = $query->row_array();
			$item_barcode = $query['barcode'];
			$item_barcode = str_replace($barcode[0]['barcode_preffix'],'',$item_barcode);
			$item_barcode = (int) $item_barcode  +1;
			
            return $barcode[0]['barcode_preffix'].round($item_barcode);
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
        $isbatch = $this->input->post('isbatch');
		$join ='left';
		if((int) $isbatch > 0 ){
			$join ='inner';
		}
		$qry = 'select a.*,b.id as godownid,b.godown_name,DATE_FORMAT(expiry_date,"%d/%m/%Y") as expirydate from ims_godown as b '.$join.' JOIN (select * from item_godown WHERE item_id=' . $id . ') as a on a.godown_id=b.id';
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
		$qry = "select * from item_godown where godown_id = " . $query['godown'] . " and item_id=  " . $new_insertid . " ";
		$query_exist = $this->db->query($qry);
		if($query_exist->num_rows() < 1 ){
			$qry = "insert INTO item_godown (godown_id,item_id,item_qty,current_stock,open_stock) values (" . $query['godown'] . "," . $new_insertid . "," . $query['open_stock'] . ",0," . $query['open_stock'] . ")";
			$this->db->query($qry);
		}else{
			$qry = "update item_godown set open_stock = ".$query['open_stock']."  where godown_id = " . $query['godown'] . " and item_id=  " . $new_insertid . " ";
			$this->db->query($qry);
		}
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

    function getallCat($search)
    {
        $qry = 'select ic.name as label, ic.* from item_category as ic where ic.name like "%' . $search . '%"';
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
	
	function getallhsn($search)
    {
        $qry = 'select ic.*,hsncode as label from hsncode as ic where ic.hsncode like "%' . $search . '%"';
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
	 function getcount($name,$barcode)
    {
        $qry = "select count(id) as no from item as a where barcode='".$barcode."' and name ='" . $name . "'";
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
	
	    function check_item_barcode($id)
    {
        $code = $this->input->post('modal_itemBarcode');
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

    function insert_image($insert_id, $image, $type)
    {
        if ($image != "") {
            $img_data = array(
                'item_id' => $insert_id,
                'iim_name' => $image,
                'iim_type' => $type,
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
		$table_data = array();
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
			$table_data = array();
            for ($i = 2; $i <= $rowtotal; $i++) {

                if ($i != 2) {
                    $qry = $qry . ',';
                }
                $qry = $qry1 . '(';
                $check1 = $table1 = "0";
				$itemname= '';
				$itemcode = '';
				$uqry = 'update item set ';
				$uwhere = 'where 1 ';
                for ($j = 1; $j <= $columntotal; $j++) {
                    if ($table1 != "0") {
                        $check1 = 1;
                    }
                    $table1 = $this->input->post('colselect_' . $j);
                    $field = $this->input->post('txt_' . $j . '_' . $i);
					if($table1 == 'barcode'){
						$itemcode = $field;
						$uwhere = $uwhere .' and barcode = "'.$field.'"';
					}
                    if ($table1 == 'name') {
                        $ledger_data['name'] = $field;
						$itemname = $field;
						$uwhere = $uwhere .' and name = "'.$field.'"';
                    }
                    if ($table1 == 'phone') {
                        $ledger_data['code'] = $field;
                    }
					if ($table1 == 'openning_bal') {
						if($field =='' || $field == null){
							$field = 0 ;
						}
                        $ledger_data['openning_bal'] = $field;
                    }
                    if ($table1 != "0" && $table1 != 'openning_bal') {
                        $field = $this->getfield($table_name, $table1, $field);
                        if ($j != 1 && $check1 != "0") {
                            $qry = $qry . ',';
                        }
                        $qry = $qry . "'" . $field . "'";
						$uqry = $uqry .$table1.'='."'" . $field . "' ,";
						$table_data[$table1] = $field;
						
                    }
                }
                if ($table_name == "item") {
                    $qry = $qry . ')';
                }
                if ($table_name == "customer") {
                    $qry = $qry . " ,'cus')";
					$table_data['type'] = 'cus'; 
                    $ledger_data['ref_code'] = 'cus';
                    $ledger_data['is_default'] = 'true';
                    $ledger_data['acc_main_id'] = 25;
                    $ledger_data['published'] = 'yes';
                    $ledger_data['type'] = 'Dr';
                    //$this->db->query($qry);
					$qry_exist = "select al.id as ledger,a.id from suppliers as a  inner join acc_ledgers as al on al.ref_id = a.id where a.name= '".$table_data['name']."' and ref_code in('cus','sup') ";
					$query_exist = $this->db->query($qry_exist);
					if($query_exist->num_rows() < 1 ){
						$this->db->insert('suppliers',$table_data);
						$insert_id = $this->db->insert_id();
						$ledger_data['ref_id'] = $insert_id;
						$this->db->insert('acc_ledgers', $ledger_data);
						$ledgers_code = $this->db->insert_id();
					}else{
						$query_exist = $query_exist->row_array();
						$this->db->where('id',$query_exist['id']);
						$this->db->update('suppliers',$table_data);
						$ledger_data['ref_id'] = $query_exist['id'];
						$this->db->where('id',$query_exist['ledger']);
						$this->db->update('acc_ledgers',$ledger_data);
					}
                }
                if ($table_name == "suppliers") {
                    $qry = $qry . " ,'sup')";
					$table_data['type'] = 'cus'; 
                    $ledger_data['is_default'] = 'true';
                    $ledger_data['ref_code'] = 'sup';
                    $ledger_data['acc_main_id'] = 24;
                    $ledger_data['published'] = 'yes';
                    $ledger_data['type'] = 'Cr';
                    //$this->db->query($qry);
					$this->db->insert('suppliers',$table_data);
                    $insert_id = $this->db->insert_id();
                    $ledger_data['ref_id'] = $insert_id;
                    $this->db->insert('acc_ledgers', $ledger_data);
                    $ledgers_code = $this->db->insert_id();
                }

                if ($table_name == "item") {
					$getitemcount = $this->item->getcount($itemname,$itemcode);
					$qry_exist = "select * from item where barcode= '".$itemcode."' and name= '".$itemname."' ";
					$query_exist = $this->db->query($qry_exist);
					if ($query_exist->num_rows() > 0) {
						$query_exist = $query_exist->row_array();
						//$this->db->query($qry);
						//$new_insertid = $this->db->insert_id();
						$this->db->where('id',$query_exist['id']);
						$this->db->update('item',$table_data);
						//$this->saveitemledger($query_exist['id']);
					}else{
						//$this->db->query($qry);
						$this->db->insert('item',$table_data);
						$new_insertid = $this->db->insert_id();
						$this->saveitemledger($new_insertid);
					}
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
	
	public function get_transfer_invoice(){
		$qry ="select * from item_transfer where published ='yes' and invoice!= '' order by id  desc limit 0,1";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			$invoice = str_replace('GT', "", $query['invoice']);
			$invoice = (int) $invoice + 1;
			return 'GT'.$invoice;
		}else{
			return 'GT1';
			
		}
		
	}
	


    public function save_transfer()
    {
		$reference = $this->input->post('reference');
		$ref_date = $this->getDate($this->input->post('ref_date', true));
		$transport_mode = $this->input->post('trans_mode');
		$vehicle_no = $this->input->post('veh_no');
		$purpose =$this->input->post('purpose');
		$place = $this->input->post('place');
		$is_unit = $this->input->post('is_unit');
        $from_godown = $this->input->post('from_godown');
        $to_godown = $this->input->post('to_godown');
        $transfer = 'transfer';
		$eway_no = $this->input->post('eway_no');
		$eway_date = $this->getDate($this->input->post('eway_date', true));
		$is_unit = $this->input->post('is_unit');
		$item_batch = $this->input->post('item_batch',TRUE);
        $debit = $this->input->post('debit', true);
		$item_rate =  $this->input->post('item_rate', true);
        $quantity = $this->input->post('debit', true);
        $vid = $this->input->post('vid', true);
        $date = $this->getDate($this->input->post('date', true));
        $length = sizeof($debit);
        $id = $this->input->post('id');
		if($this->input->post('base_unit_item', true)){
			$base_unit_item = $this->input->post('base_unit_item', true);
			$unit_item      = $this->input->post('unit_item', true);
		}
        for ($i = 0; $i < $length; $i++) {
            if ($i == 0 and $vid == 0) {
				$invoice  = $this->get_transfer_invoice();
                $qry = "insert into item_transfer (eway_no,eway_date,date,from_id,is_unit,invoice,reference,ref_date,transport_mode,vehicle_no,purpose,place) values  ('" . $eway_no . " ' , " . $eway_date . ",'" . $date . " ' , " . $from_godown . ", " . $is_unit . " ,'".$invoice."','".$reference."','".$ref_date."','".$transport_mode."','".$vehicle_no."','".$purpose."','".$place."')";
                $this->db->query($qry);
                $insert_id = $this->db->insert_id();
            }
            if ($i == 0 and $vid > 0) {
				$inv_qry = "select * from item_transfer where id=".$vid;
				$inv_query = $this->db->query($inv_qry)->row_array();
				$invoice = $inv_query['invoice'];
				if($invoice ==''){
					$invoice = 'gtransfer';
				}
                $qry = "update  item_transfer set eway_no ='" . $eway_no . "',eway_date ='" . $eway_date . "',reference ='" . $reference . "',ref_date ='" . $ref_date . "',transport_mode ='" . $transport_mode . "',vehicle_no ='" . $vehicle_no . "',purpose ='" . $purpose . "',place ='" . $place . "',date ='" . $date . "',  from_id =  " . $from_godown . " where id =" . $vid;
                $this->db->query($qry);
                $insert_id = $vid;
                $qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $insert_id;
                $this->db->query($qry);
                $this->restore_godown_transfer_stock($insert_id);
                $qry = "update item_transfer_sub set published = 'no' where transfer_id=" . $vid;
                $this->db->query($qry);
            }
			$batch = "";
			if($this->input->post('item_batch',TRUE)){
				$batch = $item_batch[$i];
			}
			if($this->input->post('base_unit_item', true)){
				if($base_unit_item[$i] != $unit_item[$i]){
					$debit[$i] = $this->getunitconversion($debit[$i],$base_unit_item[$i],$unit_item[$i]);
				}
			}

            $this->stock_trans(0, $id[$i], $debit[$i], $date, 'cr', $transfer, $insert_id, 0, 0, 0, $from_godown,$invoice,$batch);
            $this->stock_trans(0, $id[$i], $debit[$i], $date, 'dt', $transfer, $insert_id, 0, 0, 0, $to_godown,$invoice,$batch);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'cr', 'item', $from_godown,$batch);
            $this->godown_stock_trans(0, $id[$i], $debit[$i], 'dt', 'item', $to_godown,$batch);
            $qry = 'insert into item_transfer_sub (item_rate,item_id,transfer_id,qty,to_id,batch) values  ("'.$item_rate[$i].'",' . $id[$i] . ',' . $insert_id . ',' .  $quantity[$i] . ',' . $to_godown . ',"'.$batch.'")';
			if($this->input->post('base_unit_item', true)){
				$qry = 'insert into item_transfer_sub (item_rate,item_id,transfer_id,qty,to_id,batch,base_unit_id,unit_id) values  ("'.$item_rate[$i].'",' . $id[$i] . ',' . $insert_id . ',' .  $quantity[$i] . ',' . $to_godown . ',"'.$batch.'","'.$base_unit_item[$i].'","'.$unit_item[$i].'")';
			}
			$this->db->query($qry);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    function save($img_a, $img_b, $img_c, $video_a, $video_b)
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
		$brand_id = 0;
		if($this->input->post('brand_id')){
			$brand_id = $this->input->post('brand_id');
		}
        $is_rack = $this->input->post('is_rack');
        $is_production = $this->input->post('is_production');
        $is_analytics = $this->input->post('is_analytics');
		$item_type = 0;
		if($this->input->post('itemtype')){
			$item_type = $this->input->post('itemtype');
			$item_type = $this->input->post('itemtype');
		}
        $name = $this->input->post('name'); // if it is zero then we will add the item
		$hsncode_id = 0;
		if($this->input->post('hsn_id')){
			$hsncode_id = $this->input->post('hsn_id');
		}
		$price_code = 0;
		if($this->input->post('price_code')){
			$price_code = $this->input->post('price_code');
		}
        $name_lan = $this->input->post('name_lan');
		$item_category_id = 0 ;
		if($this->input->post('item_category_id')){
			$item_category_id = $this->input->post('item_category_id');
		}
        $technical = $this->input->post('technical');
        $accessories = $this->input->post('accessories');
        $vid_url = $this->input->post('vid_b');
		$genders = 0;
		if($this->input->post('genders')){
         $genders = $this->input->post('genders');
		}
        $isgodown = $this->input->post('isgodown');
        $is_multipletax = $this->input->post('is_multipletax');
        $item_group_id = $this->input->post('item_group_id');
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
            'min_level' => $minimum,
            'max_level' => $maximum,
            'wh_rate' => $wholerate,
            'open_stock' => $open_stock,
            'rack' => $rack,
            'gender' => $genders,
            // 'current_stock' => $current_stock,
            'reorder_point' => $reorder_point,
            'prate' => $prate,
            'srate' => $srate,
            'open_stk_rate' => $open_stk_rate,
            'MRP' => $MRP,
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
                //                $data['barcode'] = $this->getnewbarcode();
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
            $delqry = "delete from item_image where item_id =" . $id;
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
        if ($item_video != 0) {
            $this->insert_image($insert_id, $video_a, 'video');
            $this->insert_image($insert_id, $video_b, 'video');
            if ($this->input->post('type_vid') == 'url') {
                $this->insert_image($insert_id, $vid_url, 'url');
            }
        }
        if ($item_image != 0) {
            $this->insert_image($insert_id, $img_a, 'image');
            $this->insert_image($insert_id, $img_b, 'image');
            $this->insert_image($insert_id, $img_c, 'image');
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
	public function delete_transfer($id){
		$transfer = 'transfer';
		$qry = "update  item_ledger set published ='no' where trans_status='" . $transfer . "' and trans_id =" . $id;
        $this->db->query($qry);
        $this->restore_godown_transfer_stock($id);
        $qry = "update item_transfer_sub set published = 'no' where transfer_id=" . $id;
        $this->db->query($qry);
		$qry = "update item_transfer set published = 'no' where id=" . $id;
        $this->db->query($qry);
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
