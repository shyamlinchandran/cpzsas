<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Aeging_Model
 *
 * @author jijodileep
 */
class FinantialReports_model extends DataTable {

//put your code here
//acc_ageing

    public function __construct() {
        parent::__construct();
    }

    function TrialBalanceData($end_date,$includeDetails){
          $trans_where = '';
         if($includeDetails == 1){
            $trans_where = ' and ledger_id = -800 ';
        }
        if($end_date == ''){
            $end = '2030-01-01';
        }else{
            $end =  $this->getDate($end_date);
        }
$qry = "select id, mainaccount,name,balance,case when credit > debit then  credit-debit else 0 end as credit,case when debit >= credit then  debit-credit else 0 end as debit from  (SELECT a.id, c.name as mainaccount,acc_main_id,IFNULL(debit,0) +  case when a.type = 'Dr' then openning_bal ELSE 0 END AS debit,IFNULL(credit,0) +  case when a.type = 'Cr' then openning_bal ELSE 0 END AS credit , a.name,IFNULL(balance,0) + case when a.type = 'Dr' then openning_bal ELSE openning_bal *-1 end as balance FROM (SELECT NAME,id,acc_main_id,TYPE,acc_ledgers.openning_bal from acc_ledgers) AS a  left JOIN (SELECT ledger_id,sum(tran_debit-tran_credit) AS balance,ledger_id as ledgerid,SUM(tran_credit) AS credit,SUM(tran_debit) AS debit FROM acc_ledger_trans WHERE published = 'yes'  $trans_where and tran_date <= '".$end."'  GROUP BY ledger_id) AS b ON a.id = b.ledgerid  LEFT JOIN acc_main AS c ON c.id = acc_main_id) as a where (credit > 0  or debit > 0 ) ";        $data['Transactions'] =  $this->db->query($qry)->result_array();
        $data['openstock'] = $this->openStock('2024-01-01');

        return $data;
    }

    function BalanceSheetData($start_date,$end_date,$includeDetails){
         $trans_where = '';
         if($includeDetails == 1){
            $trans_where = ' and ledger_id = -800 ';
        }
        if($start_date == ''){
            $start = '2000-01-01';
        }else{
            $start = $this->getDate($start_date);
        }

         if($end_date == ''){
            $end = '2030-01-01';
        }else{
            $end =  $this->getDate($end_date);
        }

        $qry = "SELECT group_concat(c.id) AS DirectEcpenses FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(1) AND b.id IN(4)";
        $DirectEcpenses = $this->db->query($qry)->row_array();
        $direxp_ids = $DirectEcpenses['DirectEcpenses'];

        $qry = "SELECT group_concat(c.id) AS InDirectEcpenses FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(1) AND b.id IN(6)";
        $INDirectEcpenses = $this->db->query($qry)->row_array();
        $indirexp_ids = $INDirectEcpenses['InDirectEcpenses'];

        $qry = "SELECT group_concat(c.id) AS DirectIncome FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(2) AND b.id IN(5)";
        $DirectIncome = $this->db->query($qry)->row_array();
        $dirinc_ids = $DirectIncome['DirectIncome'];

        $qry = "SELECT group_concat(c.id) AS INDirectIncome FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(2) AND b.id IN(7)";
        $INDirectIncome = $this->db->query($qry)->row_array();
        $indirinc_ids = $INDirectIncome['INDirectIncome'];

        $qry = "SELECT sum(balance) as balance FROM (SELECT a.id,a.`name` as ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($direxp_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT SUM(tran_debit) - SUM(tran_credit) AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' $trans_where and   published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $direxp_data = $this->db->query($qry)->row_array();

        $qry = "SELECT sum(balance) as balance  FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($indirexp_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT SUM(tran_debit) - SUM(tran_credit) AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' $trans_where and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $indirexp_data = $this->db->query($qry)->row_array();

        $qry = "SELECT sum(balance) as balance  FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($dirinc_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT  SUM(tran_credit) - SUM(tran_debit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' $trans_where and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $dirinc_data = $this->db->query($qry)->row_array();

        $qry = "SELECT sum(balance) as balance  FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($indirinc_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT  SUM(tran_credit) - SUM(tran_debit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."'  $trans_where and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $indirinc_data = $this->db->query($qry)->row_array();
        
        $data['openstock'] = $this->openStock($start);
        $data['closingstock'] = $this->closingStock($end);
        // print_r('openstock'. $data['openstock']);
        // print_r('closingstock'. $data['closingstock']);
        // print_r('direxp_data'. $direxp_data['balance']);
        // print_r('dirinc_amt'. $dirinc_data['balance']);

        $direxp_amt =  (float)  $direxp_data['balance'] + (float)  $data['openstock'];
        $dirinc_amt = (float)  $dirinc_data['balance'] + (float) $data['closingstock'];
        // print_r('direxp_amt'. $direxp_amt);
        // print_r('dirinc_amt'. $dirinc_amt);

         $lose = 0 ;
        $profit = 0 ;
        if($dirinc_amt >  $direxp_amt){
            $profit =(float)  $dirinc_amt - (float)$direxp_amt;
        }else{
            $lose =(float) $direxp_amt - (float)$dirinc_amt;
        }
        //print_r('lose'. $lose);
        //print_r('profit'. $profit);


        $indirexp_amt = $indirexp_data['balance'] ?? 0 ;
        $indirinc_amt = $indirinc_data['balance'] ?? 0;

        //print_r('indirexp_amt'. $indirexp_amt);
        //print_r('indirinc_amt'. $indirinc_amt);
       

        $topExp =  (float) $indirexp_amt  + (float) $lose;
        $totInc =  (float) $indirinc_amt  + (float) $profit;
        //print_r('topExp'. $topExp);
        //print_r('totInc'. $totInc);

        
        $lose = 0 ;
        $profit = 0;
        if($topExp > $totInc ){
            $lose =  (float)  $topExp -  (float) $totInc;
            //print_r('lose'.$lose);
        }else{
            $profit =  (float) $totInc - (float)  $topExp;
            //print_r('profit'.$profit);
        }

        $data['lose'] = $lose;
        $data['profit'] = $profit;
        $qry = "SELECT group_concat(c.id) AS liability FROM acc_type a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id  INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id = 4";
        $liability = $this->db->query($qry)->row_array();
        $liability_ids = $liability['liability'];

        $qry = "SELECT group_concat(c.id) AS asset FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id = 3 ";
        $asset = $this->db->query($qry)->row_array();
        $asset_ids = $asset['asset'];

        $qry = "SELECT a.*,b.name,IFNULL(balance,0) + case when op = 'Dr' then openning_bal else openning_bal*-1 end as  balance FROM (SELECT a.id,a.`name` ledger,a.acc_main_id,openning_bal,type as op FROM acc_ledgers AS a WHERE acc_main_id IN($asset_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id left JOIN (SELECT  SUM(tran_debit) - SUM(tran_credit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."'  $trans_where and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id where IFNULL(balance,0) + case when op = 'Dr' then openning_bal else openning_bal*-1 end !=0";
        $asset_data = $this->db->query($qry)->result_array();
        $data['asset_data'] = $asset_data;
        $qry = "SELECT a.*,b.name,IFNULL(balance,0) + case when op = 'Cr' then openning_bal else openning_bal*-1 end as  balance FROM (SELECT a.id,a.`name` ledger,a.acc_main_id,openning_bal,type as op FROM acc_ledgers AS a WHERE acc_main_id IN($liability_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id left  JOIN (SELECT  SUM(tran_credit) - SUM(tran_debit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' $trans_where and   published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id where IFNULL(balance,0) + case when op = 'Cr' then openning_bal else openning_bal*-1 end != 0";
        $liability_data = $this->db->query($qry)->result_array();
        $data['liability_data'] = $liability_data;
        
        return $data;
    }
    function getProfitandLossData($start_date,$end_date){
         if($start_date == ''){
            $start = '2000-01-01';
        }else{
            $start = $this->getDate($start_date);
        }

         if($end_date == ''){
            $end = '2030-01-01';
        }else{
            $end =  $this->getDate($end_date);
        }

        $qry = "SELECT group_concat(c.id) AS DirectEcpenses FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(1) AND b.id IN(4)";
        $DirectEcpenses = $this->db->query($qry)->row_array();
        $direxp_ids = $DirectEcpenses['DirectEcpenses'];

        $qry = "SELECT group_concat(c.id) AS InDirectEcpenses FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(1) AND b.id IN(6)";
        $INDirectEcpenses = $this->db->query($qry)->row_array();
        $indirexp_ids = $INDirectEcpenses['InDirectEcpenses'];

        $qry = "SELECT group_concat(c.id) AS DirectIncome FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(2) AND b.id IN(5)";
        $DirectIncome = $this->db->query($qry)->row_array();
        $dirinc_ids = $DirectIncome['DirectIncome'];

        $qry = "SELECT group_concat(c.id) AS INDirectIncome FROM acc_type AS a INNER JOIN acc_sub_type AS b ON b.acc_type_id = a.id INNER JOIN acc_main AS c ON c.acc_sub_type_id = b.id  WHERE a.id IN(2) AND b.id IN(7)";
        $INDirectIncome = $this->db->query($qry)->row_array();
        $indirinc_ids = $INDirectIncome['INDirectIncome'];

        $qry = "SELECT a.*,b.name,balance FROM (SELECT a.id,a.`name` as ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($direxp_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT SUM(tran_debit) - SUM(tran_credit) AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' and   published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $direxp_data = $this->db->query($qry)->result_array();

        $qry = "SELECT a.*,b.name,balance FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($indirexp_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT SUM(tran_debit) - SUM(tran_credit) AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $indirexp_data = $this->db->query($qry)->result_array();

        $qry = "SELECT a.*,b.name,balance FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($dirinc_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT  SUM(tran_credit) - SUM(tran_debit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $dirinc_data = $this->db->query($qry)->result_array();

        $qry = "SELECT a.*,b.name,balance FROM (SELECT a.id,a.`name` ledger,a.acc_main_id FROM acc_ledgers AS a WHERE acc_main_id IN($indirinc_ids)) AS a INNER JOIN acc_main AS b ON a.acc_main_id = b.id INNER JOIN (SELECT  SUM(tran_credit) - SUM(tran_debit)  AS balance , ledger_id FROM acc_ledger_trans WHERE tran_date <= '".$end."' and tran_date >= '".$start."' and  published = 'yes' GROUP BY ledger_id) AS trans ON trans.ledger_id = a.id";
        $indirinc_data = $this->db->query($qry)->result_array();
        
        $data['direxp_data']  = $direxp_data;
        $data['indirexp_data']  = $indirexp_data;
        $data['dirinc_data'] = $dirinc_data;
        $data['indirinc_data'] = $indirinc_data;
       

        $data['openstock'] = $this->openStock($start);
        $data['closingstock'] = $this->closingStock($end);

      //  if(strtolower($this->session->userdata('login_base_comid')) == 'vkjs' ){
            $data['openstock'] = $this->openStock_new($start);
            $data['closingstock'] = $this->closingStock_new($end);
        //}
        return $data;


    }

      
    function openStock_new($end){
		$qry = "select sum(CASE WHEN x.open + x.stock != 0 and x.open_stk_rate >0 then (x.open + x.stock)*x.open_stk_rate else 0 end) as closings,sum(x.open * op_rate) + sum(stock*p_rate) as closing from (select case when i.open_stk_rate > 0 then open_stk_rate else open_stk_rate end as op_rate,case when i.prate > 0 then prate else open_stk_rate end as p_rate,i.id,CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp from item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date < '".$end."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date < '".$end."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when  il.trans_date < '".$end."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < ''  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when  il.trans_date < '".$end."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id  where i.published ='yes' order by i.name asc) as x";
		$res = $this->db->query($qry)->row_array();
		$stock = 0 ;
		if(isset($res['closing']) ){
			$stock = $res['closing'];
		}
		return $stock;
	}
    
    function closingStock_new($end){
		//$qry = "select sum(CASE WHEN x.open + x.stock != 0 and x.open_stk_rate >0 then (x.open + x.stock)*x.open_stk_rate else 0 end) as closings,sum(x.open * op_rate) + sum(stock*p_rate) as closing from (select  case when i.open_stk_rate > 0 then open_stk_rate else open_stk_rate end as op_rate,case when i.prate > 0 then prate else open_stk_rate end as p_rate,i.id,CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp from item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$end."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$end."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when  il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < ''  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when  il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id  where i.published ='yes' order by i.name asc) as x";
	    $qry = "select sum(CASE WHEN x.open + x.stock != 0 and x.open_stk_rate >0 then (x.open + x.stock)*x.open_stk_rate else 0 end) as closings,sum(x.open * op_rate) + sum(stock*p_rate) as closing from (select case when i.open_stk_rate > 0 then open_stk_rate else open_stk_rate end as op_rate,case when i.prate > 0 then prate else open_stk_rate end as p_rate,i.id,CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp from item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$end."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$end."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when  il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < ''  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when  il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id  where i.published ='yes' order by i.name asc) as x";
        $res = $this->db->query($qry)->row_array();
		$stock = 0 ;
		if(isset($res['closing']) ){
			$stock = $res['closing'];
		}
		return $stock;
	}

    function openStock($end){
        $qry = "SELECT 
                    SUM(
                        (IFNULL(g.open_stock, 0) * CASE WHEN i.open_stk_rate > 0 THEN i.open_stk_rate ELSE 0 END)
                        +
                        (IFNULL(t.tran_stock, 0) * CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END)
                    ) AS closing
                FROM item AS i
                LEFT JOIN (
                    SELECT item_id, SUM(open_stock) AS open_stock
                    FROM item_godown
                    GROUP BY item_id
                ) AS g ON g.item_id = i.id
                LEFT JOIN (
                    SELECT 
                        item_id,
                        SUM(CASE WHEN trans_type = 'dt' THEN quantity ELSE -quantity END) AS tran_stock
                    FROM item_ledger
                    WHERE published = 'yes' 
                      AND trans_date < '".$end."'
                    GROUP BY item_id
                ) AS t ON t.item_id = i.id
                WHERE i.published = 'yes'";
        $res = $this->db->query($qry)->row_array();
        return isset($res['closing']) ? (float)$res['closing'] : 0;
    }

    function ExactopenStock($date){
        $qry ="select  sum(case when open_stk_rate > 0 then open_stk_rate else open_stk_rate end  * b.open_stock) as closing from item as a inner  join item_godown as b on a.id = b.item_id and b.open_stock > 0 ";
        $res = $this->db->query($qry)->row_array();
		$stock = 0 ;
		if(isset($res['closing']) ){
			$stock = $res['closing'];
		}
		return $stock;
    }

    function closingStock($end){
        $qry = "SELECT 
                    SUM(
                        (IFNULL(g.open_stock, 0) * CASE WHEN i.open_stk_rate > 0 THEN i.open_stk_rate ELSE 0 END)
                        +
                        (IFNULL(t.tran_stock, 0) * CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END)
                    ) AS closing
                FROM item AS i
                LEFT JOIN (
                    SELECT item_id, SUM(open_stock) AS open_stock
                    FROM item_godown
                    GROUP BY item_id
                ) AS g ON g.item_id = i.id
                LEFT JOIN (
                    SELECT 
                        item_id,
                        SUM(CASE WHEN trans_type = 'dt' THEN quantity ELSE -quantity END) AS tran_stock
                    FROM item_ledger
                    WHERE published = 'yes' 
                      AND trans_date <= '".$end."'
                    GROUP BY item_id
                ) AS t ON t.item_id = i.id
                WHERE i.published = 'yes'";
        $res = $this->db->query($qry)->row_array();
        return isset($res['closing']) ? (float)$res['closing'] : 0;
    }
 

//     function openStock($end) {
//     // 1. Get the baseline "Exact" opening stock value
//     $baseOpeningValue = $this->ExactopenStock(null);

//     $op_rate = 'op_rate';
//     if (strtolower($this->session->userdata('login_base_comid')) == 'shanthi') {
//         $op_rate = 'p_rate';
//     }

//     // 2. Simplified query: Only calculate the value of transactions (ledger)
//     $qry = "SELECT sum(stock * p_rate) as ledger_value 
//             FROM (
//                 SELECT 
//                     ifnull(det.stock, 0) as stock,
//                     CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END as p_rate
//                 FROM item as i 
//                 LEFT JOIN (
//                     SELECT x.* FROM item_ledger as iled 
//                     INNER JOIN (
//                         SELECT 
//                             sum(case when il.trans_date < '$end' and il.trans_type ='dt' then il.quantity else 0 end) - 
//                             sum(case when il.trans_date < '$end' and il.trans_type ='cr' then il.quantity else 0 end) as Stock,
//                             item_id 
//                         FROM item_ledger as il 
//                         WHERE il.published ='yes' 
//                         GROUP BY il.item_id
//                     ) as x ON iled.item_id = x.item_id 
//                     WHERE iled.published ='yes' 
//                     GROUP BY iled.item_id
//                 ) as det ON det.item_id = i.id 
//                 WHERE i.published ='yes'
//             ) as x";

//     $res = $this->db->query($qry)->row_array();
//     $ledgerValue = isset($res['ledger_value']) ? $res['ledger_value'] : 0;

//     // 3. Return the sum of static opening + transaction movement
//     return $baseOpeningValue + $ledgerValue;
// }

// function closingStock($end) {
//     // 1. Get the baseline "Exact" opening stock value
//     $baseOpeningValue = $this->ExactopenStock(null);

//     // 2. Simplified query: Calculate value up to AND INCLUDING the end date (<=)
//     $qry = "SELECT sum(stock * p_rate) as ledger_value 
//             FROM (
//                 SELECT 
//                     ifnull(det.stock, 0) as stock,
//                     CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END as p_rate
//                 FROM item as i 
//                 LEFT JOIN (
//                     SELECT x.* FROM item_ledger as iled 
//                     INNER JOIN (
//                         SELECT 
//                             sum(case when il.trans_date <= '$end' and il.trans_type ='dt' then il.quantity else 0 end) - 
//                             sum(case when il.trans_date <= '$end' and il.trans_type ='cr' then il.quantity else 0 end) as Stock,
//                             item_id 
//                         FROM item_ledger as il 
//                         WHERE il.published ='yes' 
//                         GROUP BY il.item_id
//                     ) as x ON iled.item_id = x.item_id 
//                     WHERE iled.published ='yes' 
//                     GROUP BY iled.item_id
//                 ) as det ON det.item_id = i.id 
//                 WHERE i.published ='yes'
//             ) as x";

//     $res = $this->db->query($qry)->row_array();
//     $ledgerValue = isset($res['ledger_value']) ? $res['ledger_value'] : 0;

//     return $baseOpeningValue + $ledgerValue;
// }

}
