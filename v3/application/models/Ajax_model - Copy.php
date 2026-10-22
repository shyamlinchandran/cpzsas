<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ajax_model
 *
 * @author u43255
 */
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('dataTable.php');

class Ajax_model extends DataTable {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function getpurchaseitems($search, $type) {

        $qry = "select CONCAT(a.name,' ',a.barcode) as label,a.id from item as a where name like('%$search%') or barcode like('%$search%') and item_type_id=2 limit 25";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Pestimates($search, $type) {
        $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.id as pid,a.*,b.* from purchase as a inner join  suppliers as b on a.supplier_id =b.id where status!='completed' and a.type='order' and invoice like('%$search%')";
        if (strtolower($type) == 'purchase_return') {
            $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.id as pid,a.*,b.* from purchase as a inner join  suppliers as b on a.supplier_id =b.id where a.type='purchase' and invoice like('%$search%')";
        }

        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function gettaxledger($id) {
        $qry = "select * from acc_ledgers where id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function godownstock($search) {
        $qry = "select IFNULL(c.stock,0) as item_stock, a.id as go_id,a.*,c.* from ims_godown as a left join(select sum(open_stock+current_stock) as stock,item_id,godown_id as gid from item_godown as b where item_id=" . $search . "   ) as c on c.gid=a.id";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        $qty = 0;
        foreach ($result as $row) {
            $qty = $qty + $row["item_stock"];
        }

        foreach ($result as $row) {

            $option .= '<option qty="' . $qty . '" stock="' . $row["item_stock"] . '" value="' . $row["go_id"] . '">' . $row["godown_code"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function cli_salesitems($id) {
        $qry = "SELECT c.name as name,c.id as id,b.Quantity as qty,Total,Rate,Med_note,b.Pot_Id,b.Unit_Id,u.name as uname,p.Potency FROM cli_booking as a INNER JOIN cli_sales_items as b on a.Bok_Id=b.Sales_Bok_Id INNER JOIN item as c on b.Item_Id=c.id left join units as u on u.id=b.Unit_Id left join cli_potency as p on p.Pot_Id=b.Pot_Id WHERE b.Published='yes' and Bok_Id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function service_items($id) {
        $qry = "SELECT * from sales_ledgers as a inner join acc_ledgers as b on b.id=a.ledger_id  where a.published='yes' and  sales_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function sale_coupon($id) {
        $qry = "select a.cou_id,amount,cou_discountp,cou_discount,cou_code FROM `sales_coupon` as a INNER JOIN coupons as b on a.cou_id=b.cou_id where a.sales_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function barcode_batch($id) {
        $qry = " select * from barcode_batch as a INNER JOIN barcode_batch_items as b on a.barcode_batch_id=b.batch_id WHERE b.published='yes' and barcode_batch_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function pur_service_items($id) {
        $qry = "SELECT * from purchase_ledgers as a inner join acc_ledgers as b on b.id=a.ledger_id  where a.published='yes' and  purchase_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function sales_items($id) {
        $qry = "select b.unit_id as unitid,b.tax_id as taxid,b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot,i.any_name as analyticsname, a.*,b.*,c.*,g.* from sales as a inner join  sales_items as b on a.sales_id =b.sales_id inner join item as c on b.item_id =c.id inner join taxgst as d on b.tax_id =d.gstid left join ims_godown as g on b.godown=g.id inner join units as e on b.unit_id =e.id left join analytics_center as i on i.any_id=b.analytics  where b.published='yes' and  a.sales_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getprinters($id) {
        $qry = "select * from sales_print where   sales_id=" . $id;
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function quotation_items($id) {
        $qry = "select b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot, a.*,b.*,c.*,g.* from quotation as a inner join  quotation_items as b on a.id =b.qtn_id inner join item as c on b.item_id =c.id inner join taxgst as d on b.tax_id =d.gstid left join ims_godown as g on b.godown=g.id inner join units as e on c.unit_id =e.id   where b.published='yes' and  a.id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function cli_diagonise($id) {
        $qry = "select a.Dig_Id,Diagnose from cli_bok_diagnose as a inner join cli_diagnose as b on a.Dig_Id=b.Dig_id where a.Bok_Id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function cli_observation($id) {
        $qry = "select Obv_id,Observation from cli_bok_observation as a inner join cli_observation as b on a.Obv_Id=b.Obs_Id where a.Bok_Id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tyrsales_items($id) {
        $qry = "select b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot, a.*,b.*,c.* from tyr_sales as a inner join  tyr_sales_items as b on a.sales_id =b.sales_id inner join item as c on b.item_id =c.id inner join taxgst as d on c.tax_id =d.gstid inner join units as e on c.unit_id =e.id   where b.published='yes' and  a.sales_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function purchase($id) {
        $qry = "select b.unit_id as unitid,b.godown as item_godown,d.GST as tname,e.name  as uname,g.godown_name,a.discount as dis,i.any_name as analyticsname,b.tax_id as txid, a.*,b.*,c.* from purchase as a inner join  purchase_items as b on a.id =b.purchase_id inner join item as c on b.item_id =c.id inner join taxgst as d on b.tax_id =d.gstid inner join units as e on b.unit_id =e.id left join ims_godown as g on g.id=b.godown  left join analytics_center as i on i.any_id=b.analytics where b.published='yes' and  a.id = $id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Patientbyid($id) {
        $qry = "select b.*,a.* from    cli_patient as b  inner join cli_booking as a on a.Cus_Id= b.Pat_Id where b.Pat_Id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function customer($id) {
        $qry = "select b.* from    suppliers as b left join state as a on b.cst=a.StateID where b.id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function tyr_customer($id) {
        $qry = "select b.* from tyr_customer as b where b.id=$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function estimates($search, $type) {
        $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.*,b.* from sales as a inner join  suppliers as b on a.customer_id =b.id where status!='completed' and a.type='estimate' and invoice like('%$search%')";
        if (strtolower($type) == 'sales_return') {
            $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.*,b.* from sales as a inner join  suppliers as b on a.customer_id =b.id where a.type='sales' and invoice like('%$search%')";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function category($search) {
        $qry = "select name as label,a.* from item_category as a  where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function suppliers($search, $type) {
        $ls = "";
        $com = " a.name  as label,";
        if ($type == 'sup') {
            $type = 'type ="sup" and ';
        } else {
            $type = '';
        }
        if ($this->multiple != 0) {
            $ls = " or a.name_lan like('%$search%')";
            $com = " concat(cast(ifnull(a.`name_lan`,' ') as char),' ','',name) as label,";
        }
        $qry = "select $com a.*,b.StateID,b.code from suppliers as a  left join state as b on a.cst=b.StateID where $type   (name like('%$search%') $ls or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function hsn($search) {
        $qry = "select a.hsncode  as label,a.* from hsncode as a   where   hsncode like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Diagonise($search) {
        $qry = "select a.Diagnose as label, a.* from cli_diagnose as a where Diagnose like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Observation($search) {
        $qry = "select a.Observation as label, a.* from cli_observation as a where Observation like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function Patient($search) {
        $qry = "select CONCAT(a.Pat_Name,' ', a.Pat_Phone) as label,a.* from cli_patient as a where Pat_Name like('%$search%') or Pat_Phone like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function mainledger($search) {
        $qry = "select name as label,a.* from acc_main as a where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function members($search) {
        $qry = "select a.name as label,a.* from member as a where name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function ledgers($search) {
        $qry = "select *,name as label from acc_ledgers as a left join taxgst as b on a.tax_id=b.gstid where a.name like('%$search%')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function alter_items($id) {
        $qry = "select sum(c.item_qty) as item_qty,a.*,b.* from item_alternates as a inner join item as b on a.alt_item_id=b.id LEFT JOIN item_godown as c on c.item_id=a.alt_item_id where a.item_id=" . $id . " group by a.alt_item_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function items($search) {
        $res = explode(' ', $search);
        $ls = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
        }
        $qry = "select CONCAT(a.name,' : ', barcode ,'        mrp:',MRP,'prate:',prate) as label,a.*,(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a where name like('%$search%') or price_code like('%$search%')  or barcode like('%$search%')  limit  50";
        $grpdiscount = $this->getValue('grpdiscount');
        if ($grpdiscount == 1) {
            $qry = "select CONCAT(a.name,'      ,  Mrp:',MRP) as label,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a inner join item_group as b on a.item_group_id =b.id where($ls) or price_code ='%$search%'     or barcode ='$search' limit  50";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function itemsearchbyid($id) {
        $qry = "select CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP,', Prate : ',prate, '  ,WRate:',wh_rate,'   SRate:', srate) as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a inner join item_group as b on a.item_group_id =b.id where  a.id ='" . $id . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function barcodesearch($search) {
        $res = explode(' ', $search);
        $ls = $als = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " or  a.name_lan like('%$sd%')";
                    }
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " and a.name_lan like('%$sd%')";
                    }
                }
                $inc++;
            }
        }
        $qry = "select concat(a.name,'Unit :',IFNULL(c.name,d.name)) as label,a.name as name,a.id,IFNULL(b.barcode,a.barcode) as barcode,IFNULL(b.rate,a.srate) as rate,MRP from item as a left join item_barcode as b on a.id=b.item_id left join units as c on c.id=b.unit_id  left join units as d on d.id=a.unit_id WHERE $ls";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function itemssearchsale($sear, $id) {
        $qry = "SELECT b.name,b.barcode,a.quantity,a.sal_itms_id from sales_items as a INNER JOIN item as b on a.item_id=b.id WHERE a.sales_id=" . $id . " and b.barcode='" . $sear . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function itemssearch($search, $check, $customer) {
        $unit = 'u.id=a.unit_id';
        $rate = 'a.unit_id as uid,a.srate as salerate,';
        $barcode = 'barcode as item_barcode';
        $quantity = 1;
        if ($check === 'barcode') {
            $qry = "SELECT a.rate as unit_rate,count(a.id) as itemcount,b.barcode as code,a.unit_id as uid,b.unit_id,srate,item_id,b.barcode FROM `item_barcode` as a INNER JOIN item as b on a.item_id=b.id WHERE  a.published='yes' AND a.barcode= '" . $search . "'";
            $query = $this->db->query($qry)->row_array();
            if ($query['itemcount'] == 1) {
                $barcode = '"' . $search . '" as item_barcode';
                if ($query['uid'] != $query['unit_id']) {
                    $quantity = $this->getquantity($query['uid'], 1, $query['item_id']);
                }
                $unit = 'u.id=' . $query['uid'];
                $rate = $query['uid'] . ' as uid ,' . $query['unit_rate'] . ' as salerate,';
                $search = $query['code'];
            }
        }
        $com = " a.name ";
        $kit = '';
        $sub = 'a.srate as rate,';
        $mul_lan = '';
        if ($this->multiple != 0) {
            $com = " concat(cast(a.`name_lan` as char),' ',' ',a.name) ";
        }

        if ($customer != '') {
            // $kit = " left join (select rate,item_id from kit_group as c inner join kit_items as d on c.id=d.kit_id where customer_id =".$customer." and d.published='yes') as e on a.id=e.item_id ";
            // $sub = 'e.*,';
        }
        $res = explode(' ', $search);
        $ls = $als = '';
        $inc = 0;
        foreach ($res as $sd) {
            if ($sd != '') {
                if ($inc == 0) {
                    $ls = $ls . " a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " or  a.name_lan like('%$sd%')";
                    }
                } else {
                    $ls = $ls . " and  a.name like('%$sd%')";
                    if ($this->multiple != 0) {
                        $als = $als . " and a.name_lan like('%$sd%')";
                    }
                }
                $inc++;
            }
        }
        if (is_numeric($search)) {
            $ls = " a.MRP  =$search";
            $als = "";
        }
        $qry = "select $rate u.name as uname,e.*,CONCAT(a.name,' : ', IFNULL(barcode,0),'Qty :',IFNULL(godown_stock,0) ,'MRP',IFNULL(MRP,0)) as label,$barcode,a.*," . $sub . "(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id  left join units as u on $unit " . $kit . "  WHERE  a.published='yes' AND barcode ='" . $search . "'";

        if ($check != 'name') {
            $qry = "select e.*,u.name as uname,CONCAT(a.name,' : ', 'bc:',IFNULL(barcode,0),' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', Prate : ',IFNULL(prate,0), '  ,WRate:',IFNULL(wh_rate,0), '  SRate:', IFNULL(srate,0)) as label,barcode,a.*," . $sub . "(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on u.id=a.unit_id  " . $kit . " WHERE  a.published='yes' AND name like('%$search%')  limit  250";
        }
        $grpdiscount = $this->getValue('grpdiscount');
        if ($grpdiscount == 1) {

            $qry = "select u.name as uname,e.*,CONCAT($com ,' : ', 'bc:',barcode,' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', Prate : ',IFNULL(prate,0), '  ,WRate:',IFNULL(wh_rate,0),'   SRate:', IFNULL(srate,0)) as label,barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on u.id=a.unit_id  left join item_group as b on a.item_group_id =b.id  " . $kit . " WHERE  a.published='yes' AND ($ls)  limit  240";
            if ($check != 'name') {
                $qry = "select $rate u.name as uname,e.*,CONCAT($com ,' : ', 'bc:',barcode,' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', Prate : ',IFNULL(prate,0), '  ,WRate:',IFNULL(wh_rate,0),'   SRate:', IFNULL(srate,0)) as label,$barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a   left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join units as u on $unit  left join item_group as b on a.item_group_id =b.id  " . $kit . "  WHERE  a.published='yes' AND barcode ='" . $search . "'";
            }
            if ($check == "Txtbarcode") {
                $qry = "select u.name as uname,CONCAT($com ,' : ', 'barcode:',barcode,' Qty :',IFNULL(godown_stock,0),',    MRP:', IFNULL(MRP,0),', Prate : ',IFNULL(prate,0), '  ,WRate:',IFNULL(wh_rate,0),'   SRate:', IFNULL(srate,0)) as label,barcode,a.*," . $sub . "b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a left join units as u on u.id=a.unit_id  left join (select sum(g.current_stock+g.open_stock) as godown_stock,g.item_id as godown_item from item_godown as g group by g.item_id) as e on e.godown_item=a.id left join item_group as b on a.item_group_id =b.id  " . $kit . " WHERE  a.published='yes' AND barcode like('%" . $search . "%')  limit  240";
            }
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getitem($opt) {
        if ($opt == "item") {
            $qry = "select IFNULL(id,0) as id from item order by id desc limit 1";
        }
        if ($opt == "supplier") {
            $qry = "select IFNULL(id,0) as id  from suppliers where type='sup' order by id desc limit 1";
        }
        if ($opt == "customer") {
            $qry = "select IFNULL(id,0) as id  from suppliers where type='cus' order by id desc limit 1";
        }
        $result = $this->db->query($qry);
        echo json_encode($result->row_array());
    }

    function units($search) {
        $id = $search;
        $count = 1;
        $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $option = '<option value = ""> Select </option>';
        $option .= '<option count = 1 value="' . $query["id"] . '">' . $query["code"] . '</option>';
        for ($i = 2; $i >= 2; $i++) {
            $qry = "select count(id) as count,id,name,unit_id,code,unit_count FROM `units`  where `unit_id`='" . $id . "'";
            $query = $this->db->query($qry)->row_array();
            $i = $query['count'];
            $count = $count * $query["unit_count"];
            if ($query['count'] > 0) {
                $id = $query['id'];
                $option .= '<option count="' . $count . '" value="' . $query["id"] . '">' . $query["code"] . '</option>';
            }
        }
        print_r($option);
    }

    function cliunits($search) {
        $qry = "SELECT * FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->row_array();
        $option = '<option value="' . $query['id'] . '">' . $query['name'] . '</option>';
        $qry = "select a.* from units as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function tax() {
        $qry = "select a.* from taxgst as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["gstid"] . '" percent="' . $row["GST"] . '" igst="' . $row["igst"] . '" cgst="' . $row["cgst"] . '" sgst="' . $row["sgst"] . '">' . $row["GST"] . '</option>';
        }
        print_r($option);
    }

    function get_saleskey($type) {
        $qry = " SELECT * FROM `keys` WHERE  page='" . $type . "' order by id asc";
        //echo $qry;
        $query = $this->db->query($qry);
        echo json_encode($query->result_array());
    }

    function salesman() {
        $qry = "select a.* from users as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '">' . $row["user_name"] . '</option>';
        }
        print_r($option);
    }

    function states() {
        $qry = "select a.* from state as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option code="' . $row["code"] . '" value="' . $row["StateID"] . '">' . $row["StateName"] . '</option>';
        }
        print_r($option);
    }

    function myprinter() {
        $qry = "select a.* from printers as a ORDER BY is_default DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["prn_id"] . '">' . $row["prn_name"] . '</option>';
        }
        print_r($option);
    }

    function itemgroup() {
        $qry = "select a.* from item_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> All </option>';
        $i = $default = 0;
        foreach ($result as $row) {
            if ($i == 0) {
                $default = $row["id"];
                $option .= '<option default="' . $row["id"] . '" default="' . $row["id"] . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
            } else {
                $option .= '<option default="' . $default . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
            }
            $i++;
        }
        print_r($option);
    }

    function potency() {
        $qry = "select a.* from cli_potency as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        foreach ($result as $row) {
            if ($no == 0) {
                $option = '<option value="' . $row["Pot_Id"] . '">' . $row["Potency"] . '</option>';
            } else {
                $option .= '<option value="' . $row["Pot_Id"] . '">' . $row["Potency"] . '</option>';
            }
            $no++;
        }
        print_r($option);
    }

    function billtype($type) {
        $qry = "select IFNULL(godown_id,0) as godown,a.* from set_billtype as a where transaction='" . $type . "' order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        foreach ($result as $row) {
            if ($no == 0) {
                $option = '<option godown="' . $row["godown"] . '"  seperator="' . $row["seperator"] . '"  suffix="' . $row["suffix"] . '" preffix="' . $row["preffix"] . '"    Bank="' . $row["bank"] . '"  Cash="' . $row["cash"] . '" value="' . $row["id"] . '">' . $row["type"] . '</option>';
            } else {
                $option .= '<option  godown="' . $row["godown"] . '" seperator="' . $row["seperator"] . '"  suffix="' . $row["suffix"] . '"  preffix="' . $row["preffix"] . '"  Bank="' . $row["bank"] . '"  Cash="' . $row["cash"] . '" value="' . $row["id"] . '">' . $row["type"] . '</option>';
            }
            $no++;
        }
        print_r($option);
    }

    function billtypes($type) {
        $qry = "select a.* from set_billtype as a where transaction='" . $type . "' order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '<option value = ""> Select </option>';

        foreach ($result as $row) {

            $option .= '<option value="' . $row["id"] . '">' . $row["type"] . '</option>';
        }
        print_r($option);
    }

    function Doctor() {
        $qry = "select * from cli_doctor";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Doc_Id"] . '">' . $row["Doc_Name"] . '</option>';
        }
        print_r($option);
    }

    function Intervel() {
        $qry = "select *,CONCAT(a.Intervell,' min') as label from cli_time_intervell as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Ti_id"] . '">' . $row["label"] . '</option>';
        }
        print_r($option);
    }

    function costcenter() {
        $ls = ' cost_name as label';
        if ($this->multiple != 0) {
            $ls = " concat(cast(a.`name_lan` as char),' ',' ',a.cost_name) as label";
        }
        $qry = "select $ls,a.* from cost_centre as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cost_id"] . '">' . $row["label"] . '</option>';
        }
        print_r($option);
    }

    function analyticscenter() {
        $qry = "select * from analytics_center as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["any_id"] . '">' . $row["any_name"] . '</option>';
        }
        print_r($option);
    }

    function Cat() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $query_brc = "SELECT branch FROM `users` WHERE Id=" . $userid;
        $exec = $this->db->query($query_brc);
        $branch = $exec->row()->branch;
        $qry = "select * from company_branch";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            if ($row['brc_id'] == $branch) {
                $option .= '<option value="' . $row["brc_id"] . '" selected="selected">' . $row["brc_name"] . '</option>';
            } else {
                $option .= '<option value="' . $row["brc_id"] . '">' . $row["brc_name"] . '</option>';
            }
        }
        print_r($option);
    }

    function Procedure() {
        $qry = "select * from cli_procedures";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = "";
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Pro_Id"] . '">' . $row["Pro_Name"] . '</option>';
        }
        print_r($option);
    }

    function Schedule($id, $date) {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $qry = "select * from cli_timeschedule where TimeSch_Id not in(SELECT `Shedule_id` from cli_booking where `Bok_Date` ='" . $date . "' and bok_id !=$id AND Cat_Id='" . $branch . "') ORDER BY `cli_timeschedule`.`Schedule_Time` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["TimeSch_Id"] . '">' . $row["Schedule_Time"] . '</option>';
        }
        print_r($option);
    }

    function godown() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        $no = 0;
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["godown_code"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function getgodown() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        $no = 0;
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["godown_name"] . '</option>';
            $no++;
        }
        print_r($option);
    }

    function godownjson() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function area() {
        $qry = "select a.* from ims_area as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["area"] . '</option>';
        }
        print_r($option);
    }

    function route() {
        $qry = "select a.* from ims_route as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["route_name"] . '</option>';
        }
        print_r($option);
    }

    function messagetype() {
        $qry = "select a.* from sms_type as a ";
        //$qry = "select a.* from sms_type as a left join sms_msg as b on b.type_id=a.id where b.type_id is null  or b.id=" . $id;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function emailtype($id) {
        $qry = "select a.* from email_type as a left join email_msg as b on b.type_id=a.id where b.type_id is null  or type_id=" . $id;
        print_r($qry);
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "0"> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function vehicle() {
        $qry = "select a.* from ims_vehicle as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["Id"] . '">' . $row["Vehicle_num"] . '</option>';
        }
        print_r($option);
    }

    function printtype($type) {
        $qry = "select a.* from set_printtype as a  ORDER BY bill_default DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function reference() {
        $qry = "select a.* from reference as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = "" > Select </option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["ref_id"] . '">' . $row["name"] . ' -' . $row["details"] . '</option>';
        }
        print_r($option);
    }

    function room_category() {
        $qry = "select a.* from room_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option price="' . $row["price"] . '" tax="' . $row["tax_id"] . '" value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function member_category() {
        $qry = "select a.* from member_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option  value="' . $row["id"] . '">' . $row["name"] . '</option>';
        }
        print_r($option);
    }

    function room($type) {
        $qry = " select * from room as a inner join tax as b on a.tax_id=b.id where room_type_id=" . $type;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option value = ""> Select </option>';
        foreach ($result as $row) {
            $option .= '<option price="' . $row["price"] . '" taxp="' . $row["percent"] . '" tax="' . $row["tax_id"] . '" value="' . $row["id"] . '">' . $row["no"] . '</option>';
        }
        print_r($option);
    }

}
