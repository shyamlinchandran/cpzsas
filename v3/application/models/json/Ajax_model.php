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
        $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.id as pid,a.*,b.* from purchase as a inner join  suppliers as b on a.supplier_id =b.id where a.type='order' and invoice like('%$search%')";
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
        $qry = 'select b.id as gid,a.*,b.*,current_stock+open_stock as stock from item_godown as a inner join ims_godown as b on a.godown_id=b.id where a.item_id=' . $search;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
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

    function pur_service_items($id) {
        $qry = "SELECT * from purchase_ledgers as a inner join acc_ledgers as b on b.id=a.ledger_id  where a.published='yes' and  purchase_id =$id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function sales_items($id) {
        $qry = "select b.mrp as smrp,DATE_FORMAT(invoice_date,'%d/%m/%Y') as in_date, a.invoice_date as date, d.GST as tname,e.name  as uname,a.discount as dis,b.total as rowtot,i.any_name as analyticsname, a.*,b.*,c.*,g.* from sales as a inner join  sales_items as b on a.sales_id =b.sales_id inner join item as c on b.item_id =c.id inner join taxgst as d on b.tax_id =d.gstid left join ims_godown as g on b.godown=g.id inner join units as e on c.unit_id =e.id left join analytics_center as i on i.any_id=b.analytics  where b.published='yes' and  a.sales_id =$id";
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
        $qry = "select d.GST as tname,e.name  as uname,g.godown_name,a.discount as dis,i.any_name as analyticsname, a.*,b.*,c.* from purchase as a inner join  purchase_items as b on a.id =b.purchase_id inner join item as c on b.item_id =c.id inner join taxgst as d on c.tax_id =d.gstid inner join units as e on b.unit_id =e.id left join ims_godown as g on g.id=b.godown  left join analytics_center as i on i.any_id=b.analytics where b.published='yes' and  a.id = $id";
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
        $qry = "select CONCAT(a.invoice,' ', b.name) as label,a.*,b.* from sales as a inner join  suppliers as b on a.customer_id =b.id where a.type='estimate' and invoice like('%$search%')";
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
        if ($type == 'sup') {
            $type = 'type ="sup" and ';
        } else {
            $type = '';
        }
        $qry = "select a.name  as label,a.*,b.StateID,b.code from suppliers as a  left join state as b on a.cst=b.StateID where $type   (name like('%$search%') or phone like('%$search%'))";
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

    function itemssearch($search, $check) {
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
        $qry = "select CONCAT(a.name,' : ', barcode ,'MRP',MRP) as label,barcode,a.*,(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a where barcode like('%$search%')  limit  200";

        if ($check != 'name') {
            $qry = "select CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP,', Prate : ',prate, '  ,WRate:',wh_rate, '  SRate:', srate) as label,barcode,a.*,(IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a where  a.barcode ='" . $search . "' limit  200";
        }
        $grpdiscount = $this->getValue('grpdiscount');
        if ($grpdiscount == 1) {

            $qry = "select CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP,', Prate : ',prate, '  ,WRate:',wh_rate,'   SRate:', srate) as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a inner join item_group as b on a.item_group_id =b.id where($ls)  limit  200";
            if ($check != 'name') {
                $qry = "select CONCAT(a.name,' : ', 'barcode:',barcode,',    MRP:', MRP,', Prate : ',prate, '  ,WRate:',wh_rate,'   SRate:', srate) as label,barcode,a.*,b.discount as dis, (IFNULL(a.current_stock,0)+a.open_stock) as  currentstk from item as a inner join item_group as b on a.item_group_id =b.id where  a.barcode ='" . $search . "' limit  200";
            }
        }
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function units($search) {
        $id = $search;
        $qry = "select id,name,unit_id,code,unit_count FROM `units`  where `id`='" . $search . "'";
        $query = $this->db->query($qry)->result_array();
        echo json_encode($query);
    }

    function cliunits($search) {
        $qry = "select a.* from units as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function tax() {
        $qry = "select a.* from taxgst as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
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
        echo json_encode($result);
    }

    function states() {
        $qry = "select a.* from state as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function itemgroup() {
        $qry = "select a.* from item_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function potency() {
        $qry = "select a.* from cli_potency as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function billtype($type) {
        $qry = "select a.* from set_billtype as a where transaction='" . $type . "' order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function billtypes($type) {
        $qry = "select a.* from set_billtype as a where transaction='" . $type . "' order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function Doctor() {
        $qry = "select * from cli_doctor";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function Intervel() {
        $qry = "select *,CONCAT(a.Intervell,' min') as label from cli_time_intervell as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function costcenter() {
        $qry = "select * from cost_centre as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function analyticscenter() {
        $qry = "select * from analytics_center as a";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
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
        echo json_encode($result);
    }

    function Procedure() {
        $qry = "select * from cli_procedures";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $no = 0;
        echo json_encode($result);
    }

    function Schedule($id, $date) {
        $tmp = $this->session->userdata('user');
        $branch = $tmp['branch'];
        $qry = "select * from cli_timeschedule where TimeSch_Id not in(SELECT `Shedule_id` from cli_booking where `Bok_Date` ='" . $date . "' and bok_id !=$id AND Cat_Id='" . $branch . "') ORDER BY `cli_timeschedule`.`Schedule_Time` ASC";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function godown() {
        $qry = "select a.* from ims_godown as a order by id asc";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function area() {
        $qry = "select a.* from ims_area as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function route() {
        $qry = "select a.* from ims_route as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function messagetype($id) {
        $qry = "select a.* from sms_type as a left join sms_msg as b on b.type_id=a.id where b.type_id is null  or b.id=" . $id;
        $exeres = $this->db->query($qry);
        echo json_encode($result);
    }

    function emailtype($id) {
        $qry = "select a.* from email_type as a left join email_msg as b on b.type_id=a.id where b.type_id is null  or type_id=" . $id;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function vehicle() {
        $qry = "select a.* from ims_vehicle as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function printtype($type) {
        $qry = "select a.* from set_printtype as a  ORDER BY bill_default DESC ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function reference() {
        $qry = "select a.* from reference as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function room_category() {
        $qry = "select a.* from room_type as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function member_category() {
        $qry = "select a.* from member_category as a ";
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

    function room($type) {
        $qry = " select * from room as a inner join tax as b on a.tax_id=b.id where room_type_id=" . $type;
        $exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        echo json_encode($result);
    }

}
