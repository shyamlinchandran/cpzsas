<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of accounts_model
 *
 * @author u43255
 */
require_once('dataTable.php');

class Accounts_model extends DataTable
{

    function where()
    {
        $this->select = " DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, a.*,b.*,x.name as xname";
        $this->table = 'acc_ledger_trans as a  inner join acc_ledgers as b on a.ledger_id = b.id left join acc_ledgers as x on x.id = to_ledger_id ';
        $this->column_order = array(null, 'in_date', 'trn_tp', null, 'tran_narration', 'tran_debit', 'tran_credit', null); //set column field database for datatable orderable
        $this->column_search = array(); //set column field database for datatable searchable 
        $this->order = array('a.tran_date' => 'asc'); // default order 
        $this->wherecondition = " where a.published ='yes' ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and ledger_id=' . $this->input->post('toid');
        }
        if ($_POST['search']['value']) {
            $this->wherecondition = $this->wherecondition . ' and (voucher_no like"%' . $_POST['search']['value'] . '%" or trn_tp like"%' . $_POST['search']['value'] . '%" or tran_narration like"%' . $_POST['search']['value'] . '%") ';
        }
        $this->db->select($this->select);
    }


    function get_pdfdata(){
        $qry = "SELECT DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, a.*,b.*,x.name as xname FROM acc_ledger_trans as a  inner join acc_ledgers as b on a.ledger_id = b.id left join acc_ledgers as x on x.id = to_ledger_id WHERE   a.published ='yes' ";
        $startdate = $this->input->get_post('startdate');
    $enddate   = $this->input->get_post('enddate');
    $toid      = $this->input->get_post('toid');

        if ($startdate) {
            $qry .= ' AND a.tran_date >= "' . $this->getDate($startdate) . '"';
        }
        if ($enddate) {
            $qry .= ' AND a.tran_date <= "' . $this->getDate($enddate) . '"';
        }
        if ($toid) {
            $qry .= ' AND a.ledger_id = ' . $this->db->escape($toid);
        }
        $qry .= " ORDER BY a.tran_date ASC"; // Ensuring chronological order
    
        $query = $this->db->query($qry);
         return $query->result();
    }
      public function trail_balance_lists($startdate,$enddate){
        $text = '';
        if($enddate){
            $text = ' and alt.tran_date <=  "'.$this->getDate($enddate).'" ' ;
        }

        if($startdate){
            $sel_text = 'sum(case when  alt.tran_date >=  "'.$this->getDate($startdate).'" then tran_debit else 0 end) as debit , sum(case when  alt.tran_date >=  "'.$this->getDate($this->input->post('startdate')).'" then tran_credit else 0 end) as credit ,sum(case when  alt.tran_date <  "'.$this->getDate($this->input->post('startdate')).'" then tran_debit else 0 end) as before_debit , sum(case when  alt.tran_date <  "'.$this->getDate($startdate).'" then tran_credit else 0 end) as before_credit, ';
             
        }else{
            $sel_text = 'sum(tran_debit) as debit , sum(tran_credit) as credit ,0 as before_debit,0 as before_credit';

        }
        $qry = "SELECT acc_main_id,sum(IFNULL(before_debit,0)) + SUM(CASE when al.type = 'Dr' then al.openning_bal else 0 end ) as debtot,sum(IFNULL(before_credit,0)) + SUM(CASE when al.type = 'Cr' then al.openning_bal else 0 end ) as cretot,sum(IFNULL(debit,0)) as deb, sum(IFNULL(credit,0)) as cre,sum(IFNULL(debit,0)) as deb,al.name,am.id,am.name as main,sum(IFNULL(debit,0)) as debit ,sum(IFNULL(credit,0)) as credit from acc_ledgers  as al LEFT JOIN acc_main as am  on al.acc_main_id = am.id left join (SELECT ".$sel_text."ledger_id from acc_ledger_trans as alt WHERE alt.published = 'yes'   ".$text." GROUP by alt.ledger_id) as x on x.ledger_id = al.id GROUP by am.id";
        $result['acc_main_data'] = $this->db->query($qry)->result_array();
        $qry = "SELECT acc_main_id,sum(IFNULL(before_debit,0)) + SUM(CASE when al.type = 'Dr' then al.openning_bal else 0 end ) as debtot,sum(IFNULL(before_credit,0)) + SUM(CASE when al.type = 'Cr' then al.openning_bal else 0 end ) as cretot,sum(IFNULL(debit,0)) as deb, sum(IFNULL(credit,0)) as cre,sum(IFNULL(debit,0)) as deb,al.name,am.id,am.name as main,sum(IFNULL(debit,0)) as debit ,sum(IFNULL(credit,0)) as credit from acc_ledgers  as al LEFT JOIN acc_main as am  on al.acc_main_id = am.id left join (SELECT ".$sel_text."ledger_id from acc_ledger_trans as alt WHERE alt.published = 'yes'   ".$text." GROUP by alt.ledger_id) as x on x.ledger_id = al.id GROUP by al.id order by am.id asc ";
        $result['ledger_data'] = $this->db->query($qry)->result_array();
        return $result;
    }

    function ledgerBalance()
    {
        $qry = "select ifnull( sum(tran_credit) ,0)as credit,ifnull(sum(tran_debit),0) as debit   from acc_ledger_trans as a inner join acc_ledgers as b on a.to_ledger_id = b.id where a.published ='yes' and tran_date >='" . $this->getDate($this->input->post('startdate')) . "' and tran_date <='" . $this->getDate($this->input->post('enddate')) . "' and ledger_id=" . $this->input->post('toid');
        return $this->db->query($qry)->row_array();
    }

    public function getautocomplete($param)
    {
        $qry = "SELECT a.*,a.name as label FROM `acc_main` as a where name like'%$param%'";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    public function wherecondition()
    {
        $this->select = " ledgerid,main,ledname as ledger_name,sum(tran_debit) as tran_debit,sum(tran_credit) as tran_credit,b.id";
        $this->table = '(SELECT act.*,ac.acc_main_id as main,ac.name as ledname,ac.id as ledgerid from acc_ledger_trans as act INNER JOIN acc_ledgers as ac on act.ledger_id=ac.id
) as a inner join acc_ledgers as b on a.ledger_id = b.id ';
        $this->column_order = array(null, null, ' b.name', null); //set column field database for datatable orderable
        $this->column_search = array(' b.name'); //set column field database for datatable searchable 
        $this->order = array(' b.name' => 'asc'); // default order 
        $this->wherecondition = " where a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and main=' . $this->input->post('toid');
        }
        $this->group = ' a.ledger_id';
        $this->db->select($this->select);
    }

    function cashbook()
    {
        $this->select = " e.ledname,b.name as ledger_name, DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, a.*,b.*";
        $this->table = 'acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id left join(select d.name as ledname,c.tran_id as lid,d.acc_main_id as main from  acc_ledger_trans as c inner join acc_ledgers as d on c.to_ledger_id = d.id) as e on e.lid=a.tran_id';
        $this->column_order = array(null, 'ledger_id', null, null); // $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('tran_id' => 'desc'); // default order 
        $this->wherecondition = " where a.published ='yes' and acc_main_id =" . $this->cash;
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }

        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . ' and a.branch_id ="' . $this->input->post('branch') . '"';
        }
        if ($this->input->post('group')) {
            $this->wherecondition = $this->wherecondition . ' and a.trn_tp ="' . $this->input->post('group') . '"';
        }
        $this->db->select($this->select);
    }

    function daybook()
    {
        $this->select = " b.name as ledger_name,DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date,a.*,b.*";
        $this->table = 'acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id ';
        $this->column_order = array(null, 'ledger_id', null, null); // $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('tran_id' => 'desc'); // default order 
        $this->wherecondition = " where a.published ='yes' and acc_main_id !=" . $this->cash;

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . ' and a.branch_id ="' . $this->input->post('branch') . '"';
        }
        if ($this->input->post('group')) {
            $this->wherecondition = $this->wherecondition . ' and a.trn_tp ="' . $this->input->post('group') . '"';
        }

        $this->db->select($this->select);
    }

    function daybook_console()
    {
        $this->select = " '' as ledger_name, a.tran_narration ,a.tb_id,a.voucher_no,a.trn_tp, a.voucher_no,DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, SUM(tran_debit) as tran_debit ,SUM(tran_credit) as tran_credit ";
        $this->table = 'acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id ';
        $this->column_order = array(null, 'ledger_id', null, null); // $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('tran_id' => 'desc'); // default order 
        $this->wherecondition = " where a.published ='yes' and acc_main_id !=" . $this->cash;

        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . ' and a.branch_id ="' . $this->input->post('branch') . '"';
        }
        if ($this->input->post('group')) {
            $this->wherecondition = $this->wherecondition . ' and a.trn_tp ="' . $this->input->post('group') . '"';
        }
        $this->wherecondition = $this->wherecondition . ' GROUP BY a.tran_narration,a.voucher_no ';
        $this->db->select($this->select);
    }

    function check_list()
    {
        $this->table = " acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id";
        $this->column_order = array(null, 'ledger_id', null, null);
        $this->column_search = array('voucher_no', 'name');
        $this->order = array('tran_id' => 'desc');
        $this->select = " b.name as ledger_name,DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, a.*,b.*";
        $this->wherecondition = " where a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and tran_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        //$this->db->where('published', 'yes');
        //  $this->db->group_by('ledger_id');
        $this->db->select($this->select);
    }

    function trialbalance()
    {
        $this->table = " acc_ledger_trans as a left join acc_ledgers as b on a.ledger_id = b.id";
        $this->column_order = array(null, 'ledger_id', null, null);
        $this->column_search = array('ledger_id', 'name');
        $this->order = array('name' => 'desc');
        $this->select = 'sum(IFNULL(tran_debit,0))- sum(IFNULL(tran_credit,0)) + case when  b.type ="cr" then  b.openning_bal *-1 else  openning_bal end as amt,`ledger_id`,b.name';
        $this->group = 'ledger_id';
        $this->wherecondition = " where a.published ='yes'";
        $this->db->select($this->select);
    }

    function profitlos($start, $end)
    {
        $qry = "SELECT * from  acc_settings ";
        $result = $this->db->query($qry)->result_array();
        $response = array();
        foreach ($result as $res) {
            if ($res['type'] == 'profit') {

                $set_value = $res['set_value'];
                $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
                //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
                $output = $this->db->query($qry)->row_array();
                $response[$res['set_key']] = $output['amt'];
                $response[$res['set_key'] . 'Led'] = $res['set_key'];
            }
        }
        $qry = "SELECT sum( open_stk_rate *b.open_stock) as openstk, sum( open_stk_rate *(b.open_stock+b.current_stock)) as currntstk  FROM `item` as a INNER JOIN item_godown as b on a.`id` =b.item_id";
        $output = $this->db->query($qry)->row_array();
        $response['openstk'] = $output['openstk'];
        $response['currntstk'] = $output['currntstk'];
        //print_r($response);
        return $response;
    }


  

    function profitlosd()
    {
        $qry = "SELECT * from  acc_settings ";
        $result = $this->db->query($qry)->result_array();
        $response = array();
        foreach ($result as $res) {
            if ($res['type'] == 'profit') {
                $set_value = $res['set_value'];
                $qry = "SELECT  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id";
                $result[$res['set_key']] = $this->db->query($qry)->result_array();
                $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
                //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
                $output = $this->db->query($qry)->row_array();
                $response[$res['set_key']] = $output['amt'];
                $response[$res['set_key'] . 'Led'] = $res['set_key'];
            }
        }
        // print_r($response);
        $qry = "SELECT sum( open_stk_rate *b.open_stock) as openstk, sum( case when prate<1 then open_stk_rate else prate end *(b.open_stock+b.current_stock)) as currntstk  FROM `item` as a INNER JOIN item_godown as b on a.`id` =b.item_id";
        $output = $this->db->query($qry)->row_array();
        $response['openstk'] = $output['openstk'];
        $response['currntstk'] = $output['currntstk'];
        $response['Led_Name'] = '';
        $data['response'] = $response;
        $data['result'] = $result;
        //print_r($response);
        return $data;
    }

    function clossingStock($date)
    {
        $qry = "SELECT ifnull( sum( open_stk_rate *b.open_stock),0) as openstk FROM `item` as a INNER JOIN item_godown as b on a.`id` =b.item_id";
        $output = $this->db->query($qry)->row_array();
        $openstk = $output['openstk'];

        $qry = "select ifnull( sum(c.prate * b.quantity),0) as sales from sales as a inner JOIN sales_items as b on a.sales_id =b.sales_id INNER JOIN item as c on b.item_id =c.id where a.invoice_date <'" . $date . "' and a.type='sales'  and  b.published ='yes'";
        $output = $this->db->query($qry)->row_array();
        $sales = $output['sales'];


        $qry = "select ifnull(  sum(c.prate * b.quantity),0) as sales_return from sales as a inner JOIN sales_items as b on a.sales_id =b.sales_id INNER JOIN item as c on b.item_id =c.id where a.invoice_date <'" . $date . "' and a.type='sales_return' and  b.published ='yes'";
        $output = $this->db->query($qry)->row_array();
        $sales_return = $output['sales_return'];

        $qry = "select ifnull(  sum(c.prate * b.quantity),0) as purchase from purchase as a inner JOIN purchase_items as b on a.id =b.purchase_id INNER JOIN item as c on b.item_id =c.id where a.date <'" . $date . "' and a.type='purchase' and  b.published ='yes'";
        $output = $this->db->query($qry)->row_array();
        $purchase = $output['purchase'];

        $qry = "select ifnull(  sum(c.prate * b.quantity),0) as purchase_return from purchase as a inner JOIN purchase_items as b on a.id =b.purchase_id INNER JOIN item as c on b.item_id =c.id where a.date <'" . $date . "' and a.type='purchase_return' and  b.published ='yes'";
        $output = $this->db->query($qry)->row_array();
        $purchase_return = $output['purchase_return'];

        // stock = total purchase - total sales - total purchase returns + total sales returns + total opening stock 
        $stock = $purchase - $sales - $purchase_return + $sales_return + $openstk;
        return $stock;
    }

    function getincome()
    {
        $date = $this->getDate($this->input->post('enddate'));
        $qry = "SELECT * from  acc_settings ";
        $result = $this->db->query($qry)->result_array();
        foreach ($result as $res) {
            if ($res['type'] == 'profit') {
                $set_value = $res['set_value'];
                $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes' and tran_date <='" . $this->getDate($this->input->post('enddate')) . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
            }
        }
    }

    public function trail_balance_list(){
        $text = '';
        if($this->input->post('enddate')){
            $text = ' and alt.tran_date <=  "'.$this->getDate($this->input->post('enddate')).'" ' ;
        }

        if($this->input->post('startdate')){
            $sel_text = 'sum(case when  alt.tran_date >=  "'.$this->getDate($this->input->post('startdate')).'" then tran_debit else 0 end) as debit , sum(case when  alt.tran_date >=  "'.$this->getDate($this->input->post('startdate')).'" then tran_credit else 0 end) as credit ,sum(case when  alt.tran_date <  "'.$this->getDate($this->input->post('startdate')).'" then tran_debit else 0 end) as before_debit , sum(case when  alt.tran_date <  "'.$this->getDate($this->input->post('startdate')).'" then tran_credit else 0 end) as before_credit, ';
             
        }else{
            $sel_text = 'sum(tran_debit) as debit , sum(tran_credit) as credit ,0 as before_debit,0 as before_credit';

        }
        $qry = "SELECT acc_main_id,sum(IFNULL(before_debit,0)) + SUM(CASE when al.type = 'Dr' then al.openning_bal else 0 end ) as debtot,sum(IFNULL(before_credit,0)) + SUM(CASE when al.type = 'Cr' then al.openning_bal else 0 end ) as cretot,sum(IFNULL(debit,0)) as deb, sum(IFNULL(credit,0)) as cre,sum(IFNULL(debit,0)) as deb,al.name,am.id,am.name as main,sum(IFNULL(debit,0)) as debit ,sum(IFNULL(credit,0)) as credit from acc_ledgers  as al LEFT JOIN acc_main as am  on al.acc_main_id = am.id left join (SELECT ".$sel_text."ledger_id from acc_ledger_trans as alt WHERE alt.published = 'yes'   ".$text." GROUP by alt.ledger_id) as x on x.ledger_id = al.id GROUP by am.id";
        $result['acc_main_data'] = $this->db->query($qry)->result_array();
        $qry = "SELECT acc_main_id,sum(IFNULL(before_debit,0)) + SUM(CASE when al.type = 'Dr' then al.openning_bal else 0 end ) as debtot,sum(IFNULL(before_credit,0)) + SUM(CASE when al.type = 'Cr' then al.openning_bal else 0 end ) as cretot,sum(IFNULL(debit,0)) as deb, sum(IFNULL(credit,0)) as cre,sum(IFNULL(debit,0)) as deb,al.name,am.id,am.name as main,sum(IFNULL(debit,0)) as debit ,sum(IFNULL(credit,0)) as credit from acc_ledgers  as al LEFT JOIN acc_main as am  on al.acc_main_id = am.id left join (SELECT ".$sel_text."ledger_id from acc_ledger_trans as alt WHERE alt.published = 'yes'   ".$text." GROUP by alt.ledger_id) as x on x.ledger_id = al.id GROUP by al.id order by am.id asc ";
        $result['ledger_data'] = $this->db->query($qry)->result_array();
        return $result;
    }


    function profitandlossconsole($start, $end)
    {
        $date = str_replace('/', '-', $start);
        $start = date("Y-m-d", strtotime($date));
        $end = str_replace('/', '-', $end);
        $end = date("Y-m-d", strtotime($end));
        $aend = date("Y-m-d", strtotime($end));
        $qry = "SELECT * from  acc_settings ";
        $result = $this->db->query($qry)->result_array();
        $response = array();
        $profit = 0;
        $loss = 0;
        foreach ($result as $res) {
            $set_value = $res['set_value'];
            $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes' and tran_date >='" . $start . "' and tran_date <='" . $end . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
            //$qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
            //$qry = "select id,  name,amt + case when type ='Cr' then openning_bal else (openning_bal*-1)  end  as amt  from (SELECT b.id,  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt,b.openning_bal,b.type FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes'   and tran_date <='" . $aend . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id) as x";
            $output = $this->db->query($qry)->row_array();
            if ($res['set_key'] == 'dir_income' ||  $res['set_key'] == 'indir_income') {
                $profit = (float) $profit + (float) $output['amt'];
            } else if ($res['set_key'] == 'indir_expence' ||  $res['set_key'] == 'dir_expence') {
                $loss = (float) $loss + (float) $output['amt'];
            }
        }
        $openstk_value = $this->clossingStock($start);
        $currntstk_value = $this->clossingStock_new($end);
        $data['open'] = $openstk_value;
        $data['close']  = $currntstk_value;
        if ($loss < 0) {
            $loss = $loss * -1;
        }
        $loss = $loss + $openstk_value;
        $profit = $profit + $currntstk_value;
        $data['loss'] = $loss;
        $data['profit'] = $profit;
        $net = (float)$profit - (float)$loss;
        $data['net'] = round($net, 2);
       //return $profit;
        return $data['net'];
    }

    function profitlosdatewise($start, $end)
    { 
        $profit_start = $this->getDate($start);
        $profit_end = $this->getDate($end);
        $qry = 'SELECT DATE_ADD("'.$profit_start.'",interval -1 DAY) as date from item limit 0,1';
        $dat = $this->db->query($qry)->row_array();
        $profit_start = $dat['date'];
        $dateElements = explode('/',$start);
        $month = $dateElements[1];
        $date = str_replace('/', '-', $start);
        $start = date("Y-m-d", strtotime($date));
        //end date = end date +1 
        $date = str_replace('/', '-', $end);
        $end = date("Y-m-d", strtotime($date));
        $aend = $end;
        $date = date_create($end);
        $date_new = date_create($end);
        date_add($date, date_interval_create_from_date_string("1 days"));
        date_add($date_new, date_interval_create_from_date_string("-1 days"));
        $end = date_format($date, "Y-m-d");
        $newend = date_format($date_new, "Y-m-d");

        $qry = "SELECT * from  acc_settings ";
        $result = $this->db->query($qry)->result_array();
        $response = array();
        if ($month=='04')
        { 
            foreach ($result as $res) {
                if ($res['type'] == 'profit') {
                    $set_value = $res['set_value'];
                    $qry = "select id,  name,amt + case when type ='Cr' then openning_bal else (openning_bal*-1)  end  as amt  from (SELECT b.id,  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt,b.openning_bal,b.type FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes'   and tran_date <='" . $aend . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id) as x";
                    $result[$res['set_key']] = $this->db->query($qry)->result_array();
                    $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes'  and tran_date >='" . $start . "' and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
                    //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
                    $output = $this->db->query($qry)->row_array();
                    $response[$res["set_key"]] = $output['amt'];
                    $response[$res['set_key'] . 'Led'] = $res['set_key'];
                }
            }
    
        }
        else {
            foreach ($result as $res) {
                if ($res['type'] == 'profit') {
                    $set_value = $res['set_value'];
                    $qry = "select id,  name,amt   as amt  from (SELECT b.id,  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt,b.openning_bal,b.type FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes'  and tran_date >='" . $start . "' and    tran_date <='" . $aend . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id) as x";
                    $result[$res['set_key']] = $this->db->query($qry)->result_array();
                    $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes'  and tran_date >='" . $start . "' and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
                    //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
                    $output = $this->db->query($qry)->row_array();
                    $response[$res["set_key"]] = $output['amt'];
                    $response[$res['set_key'] . 'Led'] = $res['set_key'];
                }
            }
    
        }
      
        $stktype = 'open';
        $response['openstk'] =  $this->new_clossingStock($profit_start,$stktype);
        $response['currntstk'] = $this->new_clossingStock($profit_end);
        $response['Led_Name'] = '';
        $data['response'] = $response;
        $data['result'] = $result;
        return $data;
    }
	


    // function profitlosdatewise($start, $end)
    // { 
    //     $dateElements = explode('/',$start);
    //     $month = $dateElements[1];
    //     $date = str_replace('/', '-', $start);
    //     $start = date("Y-m-d", strtotime($date));
    //     //end date = end date +1 
    //     $date = str_replace('/', '-', $end);
    //     $end = date("Y-m-d", strtotime($date));
    //     $aend = $end;
    //     $date = date_create($end);
    //     date_add($date, date_interval_create_from_date_string("1 days"));
    //     $end = date_format($date, "Y-m-d");

    //     $qry = "SELECT * from  acc_settings ";
    //     $result = $this->db->query($qry)->result_array();
    //     $response = array();
    //     if ($month=='04')
    //     { 
    //         foreach ($result as $res) {
    //             if ($res['type'] == 'profit') {
    //                 $set_value = $res['set_value'];
    //                 $qry = "select id,  name,amt + case when type ='Cr' then openning_bal else (openning_bal*-1)  end  as amt  from (SELECT b.id,  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt,b.openning_bal,b.type FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes'   and tran_date <='" . $aend . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id) as x";
    //                 $result[$res['set_key']] = $this->db->query($qry)->result_array();
    //                 $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes'  and tran_date >='" . $start . "' and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
    //                 //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
    //                 $output = $this->db->query($qry)->row_array();
    //                 $response[$res["set_key"]] = $output['amt'];
    //                 $response[$res['set_key'] . 'Led'] = $res['set_key'];
    //             }
    //         }
    
    //     }
    //     else {
    //         foreach ($result as $res) {
    //             if ($res['type'] == 'profit') {
    //                 $set_value = $res['set_value'];
    //                 $qry = "select id,  name,amt   as amt  from (SELECT b.id,  b.name,IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt,b.openning_bal,b.type FROM `acc_ledger_trans` as a inner join acc_ledgers as b on a.ledger_id=b.id  WHERE  a.published ='yes'  and tran_date >='" . $start . "' and    tran_date <='" . $aend . "' and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) group by ledger_id) as x";
    //                 $result[$res['set_key']] = $this->db->query($qry)->result_array();
    //                 $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes'  and tran_date >='" . $start . "' and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
    //                 //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
    //                 $output = $this->db->query($qry)->row_array();
    //                 $response[$res["set_key"]] = $output['amt'];
    //                 $response[$res['set_key'] . 'Led'] = $res['set_key'];
    //             }
    //         }
    
    //     }
      
    //     $response['openstk'] = $this->clossingStock($start);
    //     $response['currntstk'] = $this->clossingStock_new($end);
    //     $response['Led_Name'] = '';
    //     $data['response'] = $response;
    //     $data['result'] = $result;
    //     return $data;
    // }
	

    function new_clossingStock($end,$type ='close'){
        $txt = 'CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,';
        if($type =='open'){
            // $txt = 'CASE WHEN  i.open_stk_rate is not null and i.open_stk_rate > 0 then i.open_stk_rate else i.prate end as open_stk_rate,';
        }
		$qry = "select sum((stock + open) * open_stk_rate)  as closing from (	select ".$txt."ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp from item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$end."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$end."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when il.trans_date >= '".$end."' and il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < '".$end."'  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when il.trans_date >= '".$end."' and il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id  where i.published ='yes' order by i.name asc ) as x order by name asc";
		$res = $this->db->query($qry)->row_array();
		$stock = 0 ;
		if(isset($res['closing']) ){
			$stock = $res['closing'];
		}
		return $stock;
	}
	function clossingStock_new($end){
		$qry = "select sum(CASE WHEN x.open + x.stock != 0 and x.open_stk_rate >0 then (x.open + x.stock)*x.open_stk_rate else 0 end) as closing from (select i.id,CASE WHEN  i.prate is not null and i.prate > 0 then i.prate else i.open_stk_rate end as open_stk_rate,ifnull(det.stock,0) as stock,i.prate,ifnull(g.open,0) as open,i.name,i.barcode,ifnull(det.rate,i.prate) as rate,ifnull(det.rate,0) as mrp from item as i left join (select sum(ig.open_stock) as open,ig.item_id from item_godown as ig group by ig.item_id) as g on g.item_id = i.id left join (select x.*,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then  iled.rate else null end),2) AS rate,round(avg(case when iled.trans_date = x.date and iled.trans_status ='purchase' and iled.trans_type ='dt' then iled.mrp else null end),2) as mrp,iled.trans_date from item_ledger as iled inner join (SELECT sum(case when il.trans_date <= '".$end."' and il.trans_type ='dt' then il.quantity else 0 end) - sum(case when il.trans_date <= '".$end."' and il.trans_type ='cr' then il.quantity else 0 end) as Stock , case when (max(case when il.trans_date >= '' and il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end)) like'%0000-00-00%' then max(case when il.trans_date < ''  and il.trans_type ='dt' and il.trans_status='purchase' then il.trans_date else '0000-00-00' end) else max(case when il.trans_date >= '' and il.trans_date <= '".$end."' and il.trans_type ='dt' and il.trans_status='purchase'  then il.trans_date else '2050-03-11' end) end as date,item_id FROM `item_ledger` as il WHERE il.published ='yes' GROUP by il.item_id) as x on iled.item_id =x.item_id and iled.published ='yes'  GROUP by iled.item_id,x.date ) as det on det.item_id =i.id  where i.published ='yes' order by i.name asc) as x";
		$res = $this->db->query($qry)->row_array();
		$stock = 0 ;
		if(isset($res['closing']) ){
			$stock = $res['closing'];
		}
		return $stock;
	}

    function balancesheetdatewise($start, $end)
    {
        $date = str_replace('/', '-', $start);
        $start = date("Y-m-d", strtotime($date));
        //end date = end date +1 
        $date = str_replace('/', '-', $end);
        $end = date("Y-m-d", strtotime($date));
        $aend = $end;
        $date = date_create($end);
        date_add($date, date_interval_create_from_date_string("1 days"));
        $end = date_format($date, "Y-m-d");

        $qry = "SELECT * from  acc_settings where type ='balance'";
        $result = $this->db->query($qry)->result_array();
        $response = array();
        foreach ($result as $res) {
            $set_value = $res['set_value'];
            $qry = "select sum(case when type='Cr' then openning_bal else 0 end) cr,sum(case when type='Dr' then openning_bal else 0 end) dr,sum(credit)-sum(debit),id,name,sum(IFNULL(credit,0))-sum(IFNULL(debit,0)) + sum(case when type='cr' then openning_bal else openning_bal*-1 end ) as amt,openning_bal,type from (select m.id,m.name,sum(tran_credit) as credit,sum(tran_debit) as debit,acc_main_id,b.type,b.openning_bal from acc_ledgers as b inner join acc_main as m on b.acc_main_id = m.id left join acc_ledger_trans as a on a.ledger_id = b.id and tran_date <='" . $aend . "' and a.published ='yes' where b.acc_main_id in (SELECT id FROM `acc_main` WHERE acc_sub_type_id in ($set_value)) group by b.id) as x group by acc_main_id";
            $result[$res['set_key']] = $this->db->query($qry)->result_array();
            $qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) + case when al.type ='Cr' then openning_bal else (openning_bal*-1)  end  as amt FROM `acc_ledger_trans` as alt left join acc_ledgers as al on al.id = alt.ledger_id WHERE  alt.published ='yes'   and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
            //$qry = "SELECT  IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0)  as amt FROM `acc_ledger_trans` WHERE  published ='yes'   and tran_date <='" . $aend . "'  and `ledger_id` in (SELECT id FROM `acc_ledgers` WHERE `acc_ledgers`.`acc_main_id` in ($set_value)) ";
            //SELECT IFNULL( SUM(`tran_credit`) -sum(`tran_debit`),0) as amt,b.name FROM `acc_ledger_trans` as a INNER JOIN acc_ledgers as b on a.ledger_id= b.id WHERE b.`acc_main_id` in (9,10,20,21) GROUP BY ledger_id
            $output = $this->db->query($qry)->row_array();
            $response[$res["set_key"]] = $output['amt'];
            $response[$res['set_key'] . 'Led'] = $res['set_key'];
        }
        $response['openstk'] = $this->clossingStock($start);
        $response['currntstk'] = $this->clossingStock($end);
        $response['Led_Name'] = '';
        $data['response'] = $response;
        $data['result'] = $result;
        return $data;
    }

    function acc_sub_code($acc_type_id, $primarykey)
    {
        $qry = "select COUNT(sub_code) as count,sub_code,type_code from acc_type as a left join (SELECT  sub_code,acc_type_id from acc_sub_type WHERE acc_type_id=" . $acc_type_id . " and id< " . $primarykey . " order by id desc limit 1) as b on a.id=b.acc_type_id where a.id=" . $acc_type_id;
        $query = $this->db->query($qry)->row_array();
        $code = $query['type_code'];
        $sub_code = $query['sub_code'];
        $count = $query['count'];
        $res = "1";
        if ($count > 0) {
            $res = str_replace($code, "", $sub_code);
            $res = $res + 1;
        } else {
            $res = "1";
        }
        $sub_code = $code . $res;
        $data = array(
            'code' => $sub_code
        );
        $this->db->where('id', $primarykey);
        $this->db->update('acc_sub_type', $data);
    }

    function acc_main_code($acc_sub_type_id, $primarykey)
    {
        $qry = "select COUNT(b.code) as count,b.code,sub_code from acc_sub_type as a left join (SELECT code,acc_sub_type_id from acc_main WHERE acc_sub_type_id=" . $acc_sub_type_id . " and id< " . $primarykey . "  order by id desc limit 1) as b on a.id=b.acc_sub_type_id where a.id=" . $acc_sub_type_id;
        $query = $this->db->query($qry)->row_array();
        $code = $query['sub_code'];
        $sub_code = $query['code'];
        $count = $query['count'];
        $res = "1";
        if ($count > 0) {
            $res = str_replace($code, "", $sub_code);
            $res = $res + 1;
        } else {
            $res = "1";
        }
        $sub_code = $code . $res;
        $data = array(
            'code' => $sub_code
        );
        $this->db->where('id', $primarykey);
        $this->db->update('acc_main', $data);
    }

    function ledgers_code($acc_main_id, $primary_key)
    {
        $qry = "select COUNT(b.code) as count,b.code,a.code as sub_code from acc_main as a left join (SELECT acc_ledger_code as code,acc_main_id from acc_ledgers WHERE acc_main_id=" . $acc_main_id . " and id< " . $primary_key . "  order by id desc limit 1) as b on a.id=b.acc_main_id where a.id=" . $acc_main_id;
        $query = $this->db->query($qry)->row_array();
        $code = $query['sub_code'];
        $sub_code = $query['code'];
        $count = $query['count'];
        $res = "1";
        if ($count > 0) {
            $res = str_replace($code, "", $sub_code);
            $res = $res + 1;
        } else {
            $res = "1";
        }
        $sub_code = $code . $res;
        $data = array(
            'acc_ledger_code' => $sub_code
        );
        $this->db->where('id', $primary_key);
        $this->db->update('acc_ledgers', $data);
    }
}
