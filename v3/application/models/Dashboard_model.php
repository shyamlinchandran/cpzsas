<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dashboard_model
 *
 * @author jijodileep
 */
class Dashboard_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'sales as a inner join suppliers as b on a.customer_id =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 
    }
	
	function getscheduleid()
	{
		$qry = "select * from yoga_schedule order by schedule_id asc";
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			return $query['schedule_id'];
		}else{
			return 0;
		}
	}
    function where() {

        $this->wherecondition = "where a.credit_eod = CURDATE()  and a.cash_type='Credit'";
    }
	
	function gettimes(){
		$qry = "SELECT * FROM `yoga_times` where published = 'yes'";
		$result = $this->db->query($qry)->result_array();
		return $result;
	}

    function tot_purchase_order()
    {
        $qry = "select count(id) as stotal from purchase where type = 'estimate'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }
    function purchase_completed()
    {
        $qry = "select count(id) as stotal from purchase where type = 'estimate' and status = 'completed'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }
    function pur_pending_amount()
    {
        $qry = "select IFNULL(SUM(total),0) as stotal from purchase where type = 'estimate' and status = 'pending'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }
    function pur_completed_amount()
    {
        $qry = "select IFNULL(SUM(total),0) as stotal from purchase where type = 'estimate' and status = 'completed'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }


    function tot_sales_order()
    {
        $qry = "select count(sales_id) as stotal from sales where type = 'estimate'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }
    function Sales_completed()
    {
        $qry = "select count(sales_id) as stotal from sales where type = 'estimate' and status = 'completed'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }


    public function purchase_productionstatus()
    {
        $qry = "SELECT IFNULL(tot,0) as total,x.m,concat(DATE_FORMAT(Date_add(Now(),interval - (a.id-1) month) ,'%b'),'/',
        year(Date_add(Now(),interval - (a.id-1) month))) as month FROM `month` as a left join (select sum(total) as tot,
        DATE_FORMAT(date, '%b') as m ,DATE_FORMAT(date, '%Y') as y,month(date) as mo from purchase as b 
        where published = 'yes' and date >= Date_add(Now(),interval - 12 month) GROUP by DATE_FORMAT(date, '%b') )
        as x on x.m = DATE_FORMAT(Date_add(Now(),interval - (a.id-1) month) ,'%b') ORDER by year(Date_add(Now(),interval - (a.id-1)
        month)),month(Date_add(Now(),interval - (a.id-1) month)) asc";

        $result = $this->db->query($qry)->result_array();
        echo json_encode($result);

    }
    public function productionstatus()
    {
        $qry = "SELECT IFNULL(tot,0) as total,x.m,concat(DATE_FORMAT(Date_add(Now(),interval - (a.id-1) month) ,'%b'),'/',
        year(Date_add(Now(),interval - (a.id-1) month))) as month FROM `month` as a left join (select sum(total) as tot,
        DATE_FORMAT(invoice_date, '%b') as m ,DATE_FORMAT(invoice_date, '%Y') as y,month(invoice_date) as mo from sales as b 
        where published = 'yes' and invoice_date >= Date_add(Now(),interval - 12 month) GROUP by DATE_FORMAT(invoice_date, '%b') )
        as x on x.m = DATE_FORMAT(Date_add(Now(),interval - (a.id-1) month) ,'%b') ORDER by year(Date_add(Now(),interval - (a.id-1)
        month)),month(Date_add(Now(),interval - (a.id-1) month)) asc";

        $result = $this->db->query($qry)->result_array();
        echo json_encode($result);
    }

    function pending_amount()
    {
        $qry = "select IFNULL(SUM(total),0) as stotal from sales where type = 'estimate' and status = 'pending'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }

    function completed_amount()
    {
        $qry = "select IFNULL(SUM(total),0) as stotal from sales where type = 'estimate' and status = 'completed'";
        $response = $this->db->query($qry);
        return $response->row()->stotal;
    }

    public function productionstatus_time()
    {
        

        $qry = "SELECT hours_start,SUM(IFNULL(s.total,0)) as tot,concat(CAST(hours_start AS TIME),'-',CAST(hours_end AS TIME)) as time_interval from 
        month as m left join sales as s on (select CAST(created_date AS TIME) > CAST(m.hours_start AS TIME) and CAST(created_date AS TIME) 
        < CAST(m.hours_end AS TIME)) and s.created_date >= '" . $this->getDate($this->input->post('startdate')) . "' AND
         s.created_date <= '" . $this->getDate($this->input->post('enddate')) . "' where m.id < 7  GROUP BY time_interval  
        ORDER BY `m`.`hours_start`  ASC";
       
        $result = $this->db->query($qry)->result_array();
        echo json_encode($result);
       
    }


	
	function getclasses(){
		$qry = "select * from yoga_classes where published = 'yes' order by cls_name asc";
		$exeres = $this->db->query($qry);
        $result = $exeres->result_array();
        $option = '<option style="text-color:red;" value = "0"><span class="red_color">---------------- </span></option>';
        foreach ($result as $row) {
            $option .= '<option value="' . $row["cls_id"] . '">' . $row["cls_name"] . '</option>';
        }
        return $option;
	}

    function companies() {
        $today = date("Y-m-d");
        $qry = "SELECT COUNT(*) as ctotal FROM `company`";
        $re = $this->db->query($qry);
        return $re->row()->ctotal;
    }

    function getCategorysales() {
        $date = $this->getDate($this->input->post('date'));
        // $date = $this->input->post('date');
        $qry = "SELECT sum(a.total) as total,c.name  as name FROM `sales_items` as a inner join sales as s on s.sales_id=a.sales_id INNER JOIN item as b on a.item_id=b.id INNER JOIN item_category as c on b.item_category_id=c.id WHERE a.published='yes' and invoice_date = '" . $date . "' GROUP by b.item_category_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getMargin() {
       $date = $this->getDate($this->input->post('date'));
        // $date = $this->input->post('date');
        $qry = "SELECT sum(a.total) as total,sum(a.item_margin) as margin,c.name,sum(a.total)-sum(a.item_margin) as profit FROM sales_items as a INNER JOIN sales as b on a.sales_id=b.sales_id INNER JOIN item as c on c.id=a.item_id where a.published='yes' and b.invoice_date='" . $date . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getCategorysalesnew() {
        // $date = $this->getDate($this->input->post('date'));
        $date = $this->input->post('date');
        $qry = "SELECT sum(a.total) as total,c.name  as name FROM `sales_items` as a inner join sales as s on s.sales_id=a.sales_id INNER JOIN item as b on a.item_id=b.id INNER JOIN item_category as c on b.item_category_id=c.id WHERE a.published='yes' and invoice_date = '" . $date . "' GROUP by b.item_category_id";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getMarginnew() {
       // $date = $this->getDate($this->input->post('date'));
        $date = $this->input->post('date');
        $qry = "SELECT sum(total) as totalamount, sum(case when cash_type ='Cash' then total else 0 end) as cash, sum(case when cash_type ='Credit' then total else 0 end) as credit FROM sales  where published='yes' and invoice_date='" . $date . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getMargindash() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }


        $qry = "SELECT sum(total) as totalamount, sum(case when cash_type ='Cash' and `type` = 'sales' then total else 0 end) as cash, sum(case when cash_type ='Credit' and `type` = 'sales' then total else 0 end) as credit, sum(case when cash_type ='Bank' and `type` = 'sales' then total else 0 end) as bank FROM sales  where published='yes'  $text ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }


    function getMarginpurchase() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

       // $date = $this->getDate($this->input->post('date'));
        // $date = $this->input->post('date');
        $qry = "SELECT sum(total) as totalamount, sum(case when cash_type ='Cash' and type ='purchase' then total else 0 end) as cash, sum(case when cash_type ='Credit' and type ='purchase' then total else 0 end) as credit, sum(case when cash_type ='Bank' and type ='purchase' then total else 0 end) as bank FROM purchase  where published='yes' $text ";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }




    function getMargindash2() {
       $date = $this->getDate($this->input->post('date'));
        // $date = $this->input->post('date');
        $qry = "SELECT   sum(case when cash_type ='Cash'  and type = 'sales_return' then total else 0 end) as cash_sales_return,sum(case when cash_type ='Cash'  and type = 'sales' then total else 0 end) as cash_sales,sum(total) as totalamount, sum(case when cash_type ='Cash' then total else 0 end) as cash, sum(case when cash_type ='Credit' then total else 0 end) as credit, sum(case when cash_type ='Bank' then total else 0 end) as bank FROM sales  where published='yes' and invoice_date='" . $date . "'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
    
	
	public function Toplist(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$text = '';
		if($this->input->post('start_date')){
			$text =  $text . ' and s.invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
		}
		if($this->input->post('end_date')){
			$text =  $text . ' and s.invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
		}
		$qry = 'SELECT c.name,IFNULL(sale.sales_count,0) as count,IFNULL(sale.sales_total,0) as total from suppliers as c left join (SELECT s.customer_id,COUNT(s.sales_id) sales_count,sum(s.total) as sales_total from sales as s WHERE s.published = "yes"  '.$text.' GROUP by s.customer_id) as sale on sale.customer_id = c.id  and c.type = "cus" order by sale.sales_count desc limit 0,5';
		$data['top_customer'] = $this->db->query($qry)->result_array();
		$qry = 'SELECT c.name,IFNULL(sale.sales_count,0) as count,IFNULL(sale.sales_total,0) as total from suppliers as c left join (SELECT s.customer_id,COUNT(s.sales_id) sales_count,sum(s.total) as sales_total from sales as s WHERE s.published = "yes"  '.$text.' GROUP by s.customer_id) as sale on sale.customer_id = c.id and c.type = "cus" order by sale.sales_count asc limit 0,5';
		$data['least_customer'] = $this->db->query($qry)->result_array();
		$qry = 'SELECT i.MRP,i.barcode,i.name,IFNULL(item.quantity,0) as quantity,IFNULL(item.total,0) as total from item as i left join (SELECT si.item_id,sum(si.base_quantity) as quantity,sum(si.total) as total from sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published = "yes" and si.published ="yes" '.$text.' GROUP by si.item_id) as item on item.item_id = i.id order by item.quantity desc limit 0,5';
		$data['top_product'] = $this->db->query($qry)->result_array();
		$qry = 'SELECT i.MRP,i.barcode,i.name,IFNULL(item.quantity,0) as quantity,IFNULL(item.total,0) as total from item as i left join (SELECT si.item_id,sum(si.base_quantity) as quantity,sum(si.total) as total from sales as s INNER JOIN sales_items as si on s.sales_id = si.sales_id and s.published = "yes" and si.published ="yes" '.$text.' GROUP by si.item_id) as item on item.item_id = i.id order by item.quantity asc limit 0,5';
		$data['least_product'] = $this->db->query($qry)->result_array();
		echo json_encode($data);
	}

    function quickmenu($id) {
        $qry = "SELECT * FROM `menu_to_user` as a INNER JOIN menus as b on a.menu_id=b.id WHERE is_dashboard=1 and user_id=" . $id;
        $re = $this->db->query($qry);
        return $re->result_array();
    }

    function getsales() {
        $qry = "select GROUP_CONCAT(total) as total,GROUP_CONCAT(date) as date from ( SELECT DISTINCT tran_date,IFNULL(tot,0) as total,IFNULL(invoice_date,tran_date) as date FROM acc_ledger_trans as c left JOIN(select sum(total) as tot,invoice_date from sales as a GROUP by invoice_date) as d on d.invoice_date=c.tran_date WHERE DATE(`tran_date`) >DATE_SUB(CURDATE(), INTERVAL 7 DAY)) as z";
        $result = $this->db->query($qry)->result_array();
        return $result;
    }
	
	public function cashbankcollection(){
		$start_date = $this->input->post('start_date');
		$end_date = $this->input->post('end_date');
		$text = '';
		if($this->input->post('start_date')){
		}
		if($this->input->post('end_date')){
			$text =  $text . ' and tran_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
		}
		$qry = "SELECT acc_main_id,sum(bal) + sum(CASE WHEN type = 'Dr' then openning_bal else openning_bal*-1 end) as balance from (SELECT sum(IFNULL(tran_debit,0)) - sum(IFNULL(tran_credit,0))  as bal ,acc_main_id ,a.id,a.type,a.openning_bal  FROM `acc_ledgers`  as a LEFT JOIN acc_ledger_trans as b on a.id = b.ledger_id and b.published = 'yes' ".$text." WHERE a.acc_main_id in(1,4) GROUP by a.id) as x GROUP by acc_main_id";
		$result = $this->db->query($qry)->result_array();
		echo json_encode($result);
	}

    function getpurchase() {
        $qry = "select GROUP_CONCAT(total) as total,GROUP_CONCAT(date) as date from ( SELECT DISTINCT tran_date,IFNULL(tot,0) as total,IFNULL(date,tran_date) as date FROM acc_ledger_trans as c left JOIN(select sum(total) as tot,date from purchase as a GROUP by date) as d on d.date=c.tran_date WHERE DATE(`tran_date`) >DATE_SUB(CURDATE(), INTERVAL 7 DAY)) as z";
        $result = $this->db->query($qry)->result_array();
        return $result;
    }

    function checklistmismatch() {
        $this->select = '*';
        $this->table = '(SELECT sum(`tran_credit`) as a ,sum(`tran_debit`) as b,`tb_id`,`voucher_no`,`trn_tp` FROM `acc_ledger_trans`  WHERE `published` ="yes" GROUP BY `tb_id`,`voucher_no`,`trn_tp`) as a  ';
        $this->order = array('tb_id' => 'desc'); // default order 
        $this->wherecondition = "WHERE  a<>b";
    }

    function checklistmismatchcnt() {
        $qry = "select count(*) as cnt from (SELECT sum(`tran_credit`) as a ,sum(`tran_debit`) as b,`tb_id`,`voucher_no`,`trn_tp` FROM `acc_ledger_trans`  WHERE `published` ='yes' GROUP BY `tb_id`,`voucher_no`,`trn_tp`) as a WHERE  a<>b ";
        $res = $this->db->query($qry)->row_array();
        echo $res['cnt'];
    }

    function creditDetails() {
        $this->select = '*';
        $this->table = "(SELECT  DATE_ADD(a.sdate,INTERVAL b.Credit_period  DAY) as edate, sdate ,a.gtotal,b.Name,a.invoice  FROM `tra_sales` as a inner join tra_consignee  as b on a.`consignee`=b.Id) as a";
        $this->order = array('sdate' => 'desc'); // default order 
        $this->wherecondition = "WHERE   MONTH(edate)=MONTH(CURRENT_DATE()) ";
    }

    function debitDetails() {
        $this->select = '*';
        $this->table = "(SELECT  DATE_ADD(a.sdate,INTERVAL b.Credit_period  DAY) as edate, sdate ,a.gtotal,b.Name,a.invoice  FROM `tra_purchase` as a inner join tra_forworder  as b on a.`forworder`=b.Id) as a";
        $this->order = array('sdate' => 'desc'); // default order    
        $this->wherecondition = "WHERE   MONTH(edate)=MONTH(CURRENT_DATE()) ";
    }

    function search($type, $search) {

        if ($type == 'Sales') {
            $qry = "SELECT a.`sales_id` as sid,a.`invoice`,a.invoice_date,b.name ,a.`total` FROM `sales` as a left JOIN suppliers as b on a.`customer_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='sales'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Sales_Order') {
            $qry = "SELECT a.`sales_id` as sid,a.`invoice`,a.invoice_date,b.name ,a.`total` FROM `sales` as a left JOIN suppliers as b on a.`customer_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='estimate'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Sales_Return') {
            $qry = "SELECT a.`sales_id` as sid,a.`invoice`,a.invoice_date,b.name ,a.`total` FROM `sales` as a left JOIN suppliers as b on a.`customer_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='sales_return'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Purchase') {
            $qry = "SELECT a.`id` as pid,a.`invoice`,a.date,b.name ,a.`total` FROM `purchase` as a left JOIN suppliers as b on a.`supplier_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='purchase'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Purchase_Order') {
            $qry = "SELECT a.`id` as pid,a.`invoice`,a.date,b.name ,a.`total` FROM `purchase` as a left JOIN suppliers as b on a.`supplier_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='order'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Purchase_Return') {
            $qry = "SELECT a.`id` as pid,a.`invoice`,a.date,b.name ,a.`total` FROM `purchase` as a left JOIN suppliers as b on a.`supplier_id` =b.id WHERE (a.`invoice` like ('%" . $search . "%') or b.name LIKE('%" . $search . "%')) and a.type ='purchase_return'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }

        if ($type == 'Customers') {
            $qry = "SELECT a.* FROM suppliers as a WHERE a.`name` like ('%" . $search . "%') or a.phone LIKE('%" . $search . "%')";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Suppliers') {
            $qry = "SELECT a.* FROM suppliers as a WHERE (a.`name` like ('%" . $search . "%') or a.phone LIKE('%" . $search . "%')) and type='sup'";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
        if ($type == 'Items') {
            $qry = "SELECT a.* FROM `item` as a WHERE a.`name` like ('%" . $search . "%') or a.barcode LIKE('%" . $search . "%')";
            $re = $this->db->query($qry);
            return $re->result_array();
        }
    }

    /* function salereport() {
      $today = date("Y-m-d");
      $qry = "select *,count(sales_id) as total,count(CASE When type='sales' Then total Else 0 End ) as salesn, count(CASE When cash_type='Cash' Then total Else 0 End ) as cash,
      count(CASE When cash_type='credit' Then total Else 0 End ) as credit from sales where `invoice_date`='".$today."'";
      $re = $this->db->query($qry);
      return $re->result_array();
      } */

    function churchfamily() {
        $today = date("Y-m-d");
        $qry = "select count(hed_id) as htotal from chr_family_head";
        $re = $this->db->query($qry);
        return $re->row()->htotal;
    }

    function cashsales() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        
        $qry = "SELECT SUM(case when type ='sales' and `cash_type` = 'cash' then total else 0 end) as cashsales FROM sales  where published='yes' $text";

        $re = $this->db->query($qry);
        return $re->row()->cashsales;
    }

     function cashpurchase() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as ptotal from purchase where `type` = 'purchase' and `cash_type` = 'cash' $text";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }

    function sales() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT COUNT(case when type ='sales' then sales_id else null end) as salescount FROM sales  where published='yes' $text ";
            $data['salescount'] = $this->db->query($qry)->result_array();
        $qry = "SELECT SUM(case when type ='sales' then total else 0 end) as salesvalue FROM sales  where published='yes' $text";
            $data['salesvalue'] = $this->db->query($qry)->result_array();

        $qry = "SELECT SUM(case when type ='sales' and `cash_type` = 'cash' then total else 0 end) as cashsales FROM sales  where published='yes' $text";

            $data['cashsales'] = $this->db->query($qry)->result_array();

        $qry = "select sum(total) as creditsales from sales where `type` = 'sales' and `cash_type` = 'credit' $text";

            $data['creditsales'] = $this->db->query($qry)->result_array();

        $qry = "select sum(total) as banksales from sales where `type` = 'sales' and `cash_type` = 'bank' $text";

            $data['banksales'] = $this->db->query($qry)->result_array();

        $qry = "select count(sales_id) as estimates from sales where `type` = 'estimate' $text";

             $data['estimates'] = $this->db->query($qry)->result_array();

         $qry = "SELECT SUM(case when type ='estimate' then total else 0 end) as estimatesvalue FROM sales  where published='yes' $text";

             $data['estimatesvalue'] = $this->db->query($qry)->result_array();

         $qry = "select count(sales_id) as salereturn from sales where `type` = 'sales_return'  and `published` = 'yes' $text"; 
         
         $data['salereturn'] = $this->db->query($qry)->result_array();   

         $qry = "SELECT SUM(case when type ='sales_return' then total else 0 end) as salesreturnvalue FROM sales  where published='yes' $text";

        $data['salesreturnvalue'] = $this->db->query($qry)->result_array(); 
        
        $qry = "select sum(total) as cashreturn from sales where `type` = 'sales_return' and `cash_type` = 'cash' and `published` = 'yes' $text";

        $data['cashreturn'] = $this->db->query($qry)->result_array(); 

        $qry = "select sum(total) as creditreturn from sales where `type` = 'sales_return' and `cash_type` = 'credit' and `published` = 'yes' $text";

        $data['creditreturn'] = $this->db->query($qry)->result_array(); 

        $qry = "select sum(total) as bankreturn from sales where `type` = 'sales_return' and `cash_type` = 'bank' and `published` = 'yes' $text";

        $data['bankreturn'] = $this->db->query($qry)->result_array();

         echo json_encode($data);
    }

     function purchase() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT COUNT(case when type ='purchase' then id else null end) as purchasecount FROM purchase  where published='yes' $text";

         $data1['purchasecount'] = $this->db->query($qry)->result_array();

         $qry = "SELECT SUM(case when type ='purchase' then total else 0 end) as purchasevalue FROM purchase  where published='yes' $text";

         $data1['purchasevalue'] = $this->db->query($qry)->result_array();

          $qry = "select sum(total) as cashpurchase from purchase where `type` = 'purchase' and `cash_type` = 'cash' $text";

          $data1['cashpurchase'] = $this->db->query($qry)->result_array();

          $qry = "select sum(total) as creditpurchase from purchase where `type` = 'purchase' and `cash_type` = 'credit' $text ";

          $data1['creditpurchase'] = $this->db->query($qry)->result_array();

          $qry = "select sum(total) as bankpurchase from purchase where `type` = 'purchase' and `cash_type` = 'bank' $text";

          $data1['bankpurchase'] = $this->db->query($qry)->result_array();

           $qry = "select count(id) as purchaseorder from purchase where `type` = 'order' $text";

           $data1['purchaseorder'] = $this->db->query($qry)->result_array();

            $qry = "SELECT SUM(case when type ='order' then total else 0 end) as purchaseordervalue FROM purchase  where published='yes' $text";

            $data1['purchaseordervalue'] = $this->db->query($qry)->result_array();

          echo json_encode($data1);
      }


      function paymentreceipt() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
		$txtcheque = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and a.trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
            $txtcheque =  $txtcheque . ' and tran_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and a.trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
            $txtcheque =  $txtcheque . ' and tran_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        

        $qry = "SELECT IFNULL(SUM(case when a.vourcher_type ='payment'  and c.acc_main_id = 1 then amount else 0 end),0) as cashpayment FROM `voucher` as a  INNER JOIN acc_ledgers as c on c.id = a.ledger  and c.acc_main_id in(1,4) WHERE a.published='yes' $text ";

       $data['cashpayment'] = $this->db->query($qry)->result_array();

       $qry = "SELECT IFNULL(SUM(case when a.vourcher_type ='payment'  and c.acc_main_id = 4 then amount else 0 end),0) as bankpayment FROM `voucher` as a  INNER JOIN acc_ledgers as c on c.id = a.ledger and c.acc_main_id in(1,4) WHERE a.published='yes'  $text ";

       $data['bankpayment'] = $this->db->query($qry)->result_array();

       $qry = "SELECT IFNULL(SUM(case when vourcher_type ='receipt'  and acc_main_id = 1 then amount else 0 end),0) as cashcollection FROM `voucher` as a INNER JOIN acc_ledgers as c on c.id = a.ledger and acc_main_id in(1,4) WHERE a.published='yes' $text ";

       $data['cashcollection'] = $this->db->query($qry)->result_array();

       $qry = "SELECT IFNULL(SUM(case when vourcher_type ='receipt'  and acc_main_id = 4 then amount else 0 end),0) as bankcollection FROM `voucher` as a INNER JOIN acc_ledgers as c on c.id = a.ledger and acc_main_id in(1,4) WHERE a.published='yes' $text ";

       $data['bankcollection'] = $this->db->query($qry)->result_array();

		$qry = "SELECT IFNULL(SUM(CASE WHEN chq_trans = 'Issue' then IFNULL(chq_amount,0) else 0 end ),0)  as issued,IFNULL(SUM(CASE WHEN chq_trans = 'Clearing' then IFNULL(chq_amount,0) else 0 end ),0)  as cleared  from (SELECT b.tran_date,a.* from chqdetails as a INNER JOIN acc_ledger_trans as b on a.chq_id = b.tb_id and b.trn_tp = 'Cheque' and b.published = 'yes' GROUP by chq_id) as x where 1 ".$txtcheque."   ORDER BY `x`.`chq_id` ASC" ;
		$data['Cheque'] = $this->db->query($qry)->result_array();
       echo json_encode($data);
    }

    function receivablepayable() {

        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
           // $text =  $text . ' and b.updatedate >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and c.tran_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        

        // $qry = "SELECT SUM(case when a.vourcher_type ='payment'  and c.acc_main_id = 1 then amount else 0 end) as cashpayment FROM `voucher` as a  INNER JOIN acc_ledgers as c on c.id = a.ledger  and c.acc_main_id in(1,4) WHERE a.published='yes' $text ";

         $qry = "SELECT SUM(case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END) as receivable from acc_ledgers as b left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' ".$text."  GROUP by ledger_id ) as d on d.ledger_id = b.id where b.ref_code='cus' ";

       $data['receivable'] = $this->db->query($qry)->result_array();

       $qry = "SELECT SUM(case when b.type='Dr' THEN IFNULL(balance,0)+IFNULL(b.openning_bal,0) ELSE IFNULL(balance,0)-IFNULL(b.openning_bal,0) END) as payable from acc_ledgers as b left join ( select sum(tran_debit) -sum(tran_credit) as balance ,ledger_id from acc_ledger_trans as c WHERE c.published='yes' ".$text." GROUP by ledger_id ) as d on d.ledger_id = b.id where b.ref_code='sup'  ";

       $data['payable'] = $this->db->query($qry)->result_array();

      
       echo json_encode($data);
    }


    function salescount() {
        $today = date("Y-m-d");

        $qry = "SELECT COUNT(case when type ='sales' then sales_id else null end) as salescount FROM sales  where published='yes' and invoice_date ='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->salescount;
    }
	
	function stockvalue(){
		 $end_date = $this->input->post('end_date');
		 $text = '';
		  if($this->input->post('end_date')){
            $text =  $text . ' and trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
		$qry = "SELECT IFNULL(stk,0) + a.open_stock,name,sum((IFNULL(stk,0) + a.open_stock) * CASE WHEN item.prate = 0 or item.prate is null then item.open_stk_rate else item.prate end) stockvalue from item_godown as a Left JOIN(SELECT sum(CASE WHEN b.trans_type = 'dt' then b.quantity else 0 end) - sum(CASE WHEN b.trans_type = 'cr' then b.quantity else 0 end) as stk,b.item_id,b.godown from item_ledger as b WHERE b.published = 'yes' ".$text." GROUP by b.item_id,b.godown) as x on x.item_id = a.item_id and godown = godown_id INNER JOIN item  on item.id = a.item_id and item.published = 'yes'";
		$re = $this->db->query($qry);
        return $re->row()->stockvalue;
	}

     function purchasecount() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT COUNT(case when type ='purchase' then id else null end) as purchasecount FROM purchase  where published='yes' $text";
        $re = $this->db->query($qry);
        return $re->row()->purchasecount;
    }

    function salesvalue() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT SUM(case when type ='sales' then total else 0 end) as salesvalue FROM sales  where published='yes' $text";
        $re = $this->db->query($qry);
       return $re->row()->salesvalue;
    }


     function cashpayment() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and a.trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and a.trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        
        $qry = "SELECT SUM(case when vourcher_type ='payment'  and acc_main_id = 1 then amount else 0 end) as cashpayment FROM `voucher` as a inner join voucher_trans as b on a.id = b.voucher_id INNER JOIN acc_ledgers as c on c.id = b.acc_ledgers_id and acc_main_id in(1,4) WHERE a.published='yes' $text ";

        $re = $this->db->query($qry);
       return $re->row()->cashpayment;
    }


     function bankpayment() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and a.trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and a.trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT SUM(case when vourcher_type ='payment'  and acc_main_id = 4 then amount else 0 end) as bankpayment FROM `voucher` as a inner join voucher_trans as b on a.id = b.voucher_id INNER JOIN acc_ledgers as c on c.id = b.acc_ledgers_id and acc_main_id in(1,4) WHERE a.published='yes' $text ";

        $re = $this->db->query($qry);
       return $re->row()->bankpayment;
    }


    function cashcollection() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and a.trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and a.trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

    
        $qry = "SELECT SUM(case when vourcher_type ='receipt'  and acc_main_id = 1 then amount else 0 end) as cashcollection FROM `voucher` as a inner join voucher_trans as b on a.id = b.voucher_id INNER JOIN acc_ledgers as c on c.id = b.acc_ledgers_id and acc_main_id in(1,4) WHERE a.published='yes' $text ";

        $re = $this->db->query($qry);
       return $re->row()->cashcollection;
    }


     function bankcollection() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT SUM(case when vourcher_type ='receipt'  and acc_main_id = 4 then amount else 0 end) as bankcollection FROM `voucher` as a inner join voucher_trans as b on a.id = b.voucher_id INNER JOIN acc_ledgers as c on c.id = b.acc_ledgers_id and acc_main_id in(1,4) WHERE a.published='yes' $text ";

        $re = $this->db->query($qry);
       return $re->row()->bankcollection;
    }


    function collectionvalues() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
		$txtcheque = '';
        $text1 = '';
        if($this->input->post('start_date')){
			$txtcheque =  $txtcheque . ' and tran_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
            $text1 =  $text1 . ' and trans_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
            $text1 =  $text1 . ' and trans_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
			 $txtcheque =  $txtcheque . ' and tran_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        
        $qry = "SELECT IFNULL(SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales' then total else 0 end),0) as cash,IFNULL(SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales' then total else 0 end),0) as bank,SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales_return' then total else 0 end) as cashreturn,SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales_return' then total else 0 end) as bankreturn from sales as s WHERE s.published = 'yes' ".$text." ";
		$sales = $this->db->query($qry)->row_array();
		$total = (float)  $sales['cash'] + (float)  $sales['bank'];
		$data['salescash'] = $sales['cash'];
		$data['salesbank'] = $sales['bank'];
		
		
		$qry = "SELECT IFNULL(SUM(CASE WHEN vourcher_type  = 'receipt' and acc_main_id = '4' then amount else 0 end),0) as cashrec,IFNULL(SUM(CASE WHEN vourcher_type  = 'receipt' and acc_main_id = '1' then amount else 0 end),0) as bankrec,SUM(CASE WHEN vourcher_type  = 'payment' and acc_main_id = '4' then amount else 0 end) as cashpay,SUM(CASE WHEN vourcher_type  = 'payment' and acc_main_id = '1' then amount else 0 end) as bankpay FROM `voucher` as a INNER JOIN acc_ledgers as b on a.ledger = b.id  WHERE a.published = 'yes'  ".$text1." " ;
		$receipt = $this->db->query($qry)->row_array();
		$total = (float) $total + (float)  $receipt['cashrec'] + (float)  $receipt['bankrec'];
		$data['reccash'] = $receipt['cashrec'];
		$data['recbank'] = $receipt['bankrec'];
		
		
		$qry = "SELECT IFNULL(SUM(CASE WHEN chq_trans = 'Issue' then IFNULL(chq_amount,0) else 0 end ),0)  as issued,IFNULL(SUM(CASE WHEN chq_trans = 'Clearing' then IFNULL(chq_amount,0) else 0 end ),0)  as cleared  from (SELECT b.tran_date,a.* from chqdetails as a INNER JOIN acc_ledger_trans as b on a.chq_id = b.tb_id and b.trn_tp = 'Cheque' and b.published = 'yes' GROUP by chq_id) as x where 1 ".$txtcheque."   ORDER BY `x`.`chq_id` ASC" ;
		$Cheque = $this->db->query($qry)->row_array();
		$data['chequecleared'] = $Cheque['cleared'];
		$data['chequeissued'] = $Cheque['issued'];
		$total = (float) $total +  (float)  $Cheque['cleared'];
		
		$data['total'] = $total;
		
		
       echo json_encode($data);
    }


    function estimatesvalue() {
       $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "SELECT SUM(case when type ='estimate' then total else 0 end) as estimatevalue FROM sales  where published='yes' $text";
        $re = $this->db->query($qry);
       return $re->row()->estimatevalue;
    }

    function purchasevalue() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "SELECT SUM(case when type ='purchase' then total else 0 end) as purchasevalue FROM purchase  where published='yes' $text";
        $re = $this->db->query($qry);
       return $re->row()->purchasevalue;
    }

    function purchaseordervalue() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "SELECT SUM(case when type ='order' then total else 0 end) as pordervalue FROM purchase  where published='yes' $text";
        $re = $this->db->query($qry);
       return $re->row()->pordervalue;
    }


    function getmyhistory() {
        $tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
        $qry = "SELECT * FROM  menus as b  INNER JOIN ( select distinct menu_id  from `user_action_log`  WHERE user_id=" . $userid . "  ORDER BY created_date DESC ) as a on a.menu_id=b.id  ORDER BY  a.menu_id limit 10";
        $re = $this->db->query($qry);
        $result = $re->result_array();
        $no = count($result);
        $li = "";
        foreach ($result as $row) {
            if ($no == 0) {
                $li = '<li>No History</li>';
            }
            $li .= '<li><a href="' . base_url() . $row["Url"] . '"><i class="fa fa-bookmark text-aqua"></i>' . $row['ListName'] . '</a></li>';
            $no++;
        }
        //$li.= '<li class="footer"><a href="#" id="myhistorybtn">Refresh</a></li>';
        print_r($li);
    }

    function creditsales() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as stotal from sales where `type` = 'sales' and `cash_type` = 'credit' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }

    function creditpurchase() {
       $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as ptotal from purchase where `type` = 'purchase' and `cash_type` = 'credit' $text ";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }

     function banksales() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as stotal from sales where `type` = 'sales' and `cash_type` = 'bank' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }

     function bankpurchase() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as ptotal from purchase where `type` = 'purchase' and `cash_type` = 'bank' $text";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }



    function salereports() {
        $today = date("Y-m-d");
        $qry = "select count(sales_id) as stotal from sales where `type` = 'sales' and `invoice_date`='" . $today . "'";
        $re = $this->db->query($qry);
        echo json_encode($re->row_array());
    }

    function estimates($date = '') {
       $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
		if($date != ''){
			$text = $date;
		}
        $qry = "select count(sales_id) as stotal from sales where `type` = 'estimate' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }

    function appointments() {
        $today = date("Y-m-d");
        $qry = "select count(Bok_Id) as appointcnt from cli_booking where `Bok_date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->appointcnt;
    }

    function approvpatient() {
        $today = date("Y-m-d");
        $qry = "select count(Bok_Id) as appointcnt from cli_booking where `Bok_Approved`in('Approve','Checked','Payed') and `Bok_date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->appointcnt;
    }

    function patient_status($type) {
        $today = date("Y-m-d");
        $qry = "select count(Bok_Id) as appointcnt from cli_booking where `Bok_Approved`in('" . $type . "') and `Bok_date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->appointcnt;
    }

    function salereturn() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select count(sales_id) as stotal from sales where `type` = 'sales_return'  and `published` = 'yes' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }


    function salesreturnvalue() {
         $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }

        $qry = "SELECT SUM(case when type ='sales_return' then total else 0 end) as salesreturnvalue FROM sales  where published='yes' $text";
        $re = $this->db->query($qry);
       return $re->row()->salesreturnvalue;
    }


    function cashreturn() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as stotal from sales where `type` = 'sales_return' and `cash_type` = 'cash' and `published` = 'yes' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }


     function creditreturn() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as stotal from sales where `type` = 'sales_return' and `cash_type` = 'credit' and `published` = 'yes' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }


    function bankreturn() {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and invoice_date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and invoice_date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
        $qry = "select sum(total) as stotal from sales where `type` = 'sales_return' and `cash_type` = 'bank' and `published` = 'yes' $text";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }



    function purchasereport($date = '') {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
		if($date != '' ){
			$text = $date;
		}
        $qry = "select count(id) as ptotal from purchase where `type` = 'purchase' $text";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }
	
	function cntcreditsales() {
        $today = date("Y-m-d");
        $qry = "select count(sales_id) as stotal from sales where `type` = 'sales' and `cash_type` = 'credit'and `invoice_date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }
	function cntcashsales() {
        $today = date("Y-m-d");
        $qry = "select count(sales_id) as stotal from sales where `type` = 'sales' and `cash_type` = 'cash'and `invoice_date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->stotal;
    }

    function purchaseorder($date = '') {
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $text = '';
        if($this->input->post('start_date')){
            $text =  $text . ' and date >= "'.$this->getDate($this->input->post('start_date')).'"  ';
        }
        if($this->input->post('end_date')){
            $text =  $text . ' and date <= "'.$this->getDate($this->input->post('end_date')).'"  ';
        }
		if($date != ''){
			$text = $date;
		}
        $qry = "select count(id) as ptotal from purchase where `type` = 'order' $text";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }

    function purchasereturn() {
        $today = date("Y-m-d");
        $qry = "select count(id) as ptotal from purchase where `type` = 'purchase_return' and `date`='" . $today . "'";
        $re = $this->db->query($qry);
        return $re->row()->ptotal;
    }

}
