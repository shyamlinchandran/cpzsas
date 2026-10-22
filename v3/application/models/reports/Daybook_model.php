<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Salereport_model
 *
 * @author jijodileep
 */
class Daybook_model extends DataTable {

//    function wherecondition() {
//        $this->select = 'a.trn_tp,c.*,sum(a.tran_debit) ';
//        $this->table = 'acc_ledger_trans as a left join (SELECT sales_id,b.type as saletype,sum(cash_amount) as cash,sum(bank_amount) as bank,sum(total)-sum(cash_amount)+sum(bank_amount)as credit ,sum(total) as total from sales as b where b.published="yes" and b.invoice_date ="' . $this->getDate($this->input->post('date')) . '" GROUP by b.type) as c on trn_tp=saletype ';
//        $this->column_order = array(null, 'trn_tp'); //set column field database for datatable orderable
//        $this->column_search = array('trn_tp'); //set column field database for datatable searchable 
////        $this->order = array('trn_tp' => 'asc'); // default order 
//        $this->wherecondition = " where trn_tp in ('sales','sales_return') and a.published='yes' and tran_date = '" . $this->getDate($this->input->post('date')) . "'GROUP by trn_tp ORDER BY FIELD(trn_tp,'sales','sales_return') ";
//    }
    function wherecondition() {
        $this->select = 'sum(a.total)-(sum(cash_amount)+sum(bank_amount)) as credit,sum(a.total) as total,a.type as saletype,sum(cash_amount) as cash,sum(bank_amount) as bank,c.tb_id,branch_id ';
        $this->table = "sales as a inner join (select DISTINCT tb_id as tb_id,branch_id from acc_ledger_trans as b WHERE b.published='yes' and tb_name='sales') as c on c.tb_id=a.sales_id ";
        $this->column_order = array(null, 'saletype'); //set column field database for datatable orderable
        $this->column_search = array('saletype'); //set column field database for datatable searchable 
//        $this->order = array('trn_tp' => 'asc'); // default order 
        $this->wherecondition = " where a.type in ('sales','sales_return') and a.published='yes' and invoice_date = '" . $this->getDate($this->input->post('date')) . "' ";
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . 'and branch_id=' . $this->input->post('branch');
        }
        $this->wherecondition = $this->wherecondition . " GROUP by a.type ORDER BY FIELD(a.type,'sales','sales_return')";
    }
	
	function daybook_console() {
        $this->select = " '' as ledger_name, a.tran_narration ,a.tb_id,a.voucher_no,a.trn_tp, a.voucher_no,DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date, SUM(tran_debit) as tran_debit ,SUM(tran_credit) as tran_credit ";
        $this->table = 'acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id ';
        $this->column_order = array(null, 'ledger_id', null, null); // $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('tran_id' => 'desc'); // default order 
        $this->wherecondition = " where a.trn_tp  != 'sales' and a.published ='yes' and acc_main_id !=" . $this->cash;

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
	
	
	function daybook() {
        $this->select = " b.name as ledger_name,DATE_FORMAT(a.tran_date,'%d/%m/%Y') as in_date,a.*,b.*";
        $this->table = 'acc_ledger_trans as a inner join acc_ledgers as b on a.ledger_id = b.id ';
        $this->column_order = array(null, 'ledger_id', null, null); // $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('name'); //set column field database for datatable searchable 
        $this->order = array('tran_id' => 'desc'); // default order 
        $this->wherecondition = " where a.trn_tp  != 'sales' and a.published ='yes' and acc_main_id !=" . $this->cash;

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
	
	function getopening($id){
		$debit = 0;
		$credit = 0;
		$toid = $this->cashaccount;
		$date = $this->input->post('date');
		$qry = "Select IFNULL((sum(tran_debit)-sum(tran_credit)),0) as amt,b.openning_bal,b.type from acc_ledger_trans  as a inner join acc_ledgers as b on   a.ledger_id = b.id  where  a.published ='yes' and  a.tran_date >=  '" . $this->finstartDate . "' and  a.tran_date  < '" . $this->getDate($date) . "' and a.ledger_id =" . $toid;
		$query = $this->db->query($qry);
		if($query->num_rows() > 0 ){
			$query = $query->row_array();
			if ($query['type'] == 'Cr') {
				$query['amt'] = ( $query['amt'] - $query['openning_bal']) * -1;
			} else {
				$query['amt'] = $query['amt'] + $query['openning_bal'];
			}
			$debit = $query['amt'];
			$credit = 0;
			if($query['amt'] < 0){
				$credit = $query['amt'] * -1;
				$debit = 0;
			}
		}
		$data[0]['debit']= $debit;
		$data[0]['credit']= $credit;
		echo json_encode($data);
	}

    function getdaybalance($id) {
        $text = "";
        if ($id != 0) {
            $text = " and a.branch_id=" . $id;
        }
        $date = $this->input->post('date');
        $qry = "select sum(`tran_debit`) as total,trn_tp from acc_ledger_trans as a WHERE trn_tp in('sales','purchase','sales_return','purchase_return','payment','receipt','new_expense')  " . $text . "  and published='yes' and tran_date='" . $this->getDate($date) . "' GROUP by trn_tp";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
		}

    function getpurchase($id) {
        $text = "";
        if ($id != 0) {
            $text = " and b.branch_id=" . $id;
        }
        $qry = "select branch_id,type,SUM(IF( cash_type = 'credit', total, 0)) AS credit, SUM(IF( cash_type= 'cash', total, 0)) AS cash  from  purchase as a inner join (select DISTINCT tb_id as tb_id,branch_id from acc_ledger_trans as b WHERE b.published='yes' and tb_name='purchase' " . $text . " ) as c on c.tb_id=a.id  where a.published='yes' and   a.rdate = '" . $this->getDate($this->input->post('date')) . "'  GROUP by a.type";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getsales($id) {
        $text = "";
        $in = "";
        if ($id != 0) {
            $text = " and b.branch_id=" . $id;
            $qry = "SELECT IFNULL(GROUP_CONCAT(id),0) as branch,a.* FROM `set_billtype` as a WHERE a.transaction in('sales','sales_return') and branch_id=" . $id;
            $query = $this->db->query($qry)->row_array();
            $in = "and a.bill_type in ( " . $query['branch'] . " )";
        }
        $qry = "select sum(a.total)-(sum(cash_amount)+sum(bank_amount)) as credit,sum(a.total) as total,a.type as saletype,sum(cash_amount) as cash,sum(bank_amount) as bank  from sales as a  where a.type in ('sales','sales_return') and a.published='yes'   and invoice_date = '" . $this->getDate($this->input->post('date')) . "' " . $in . "  GROUP by a.type ORDER BY FIELD(a.type,'sales','sales_return')";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function where() {
        $this->select = "branch_id,type,SUM(IF( cash_type = 'credit', total, 0)) AS credit, SUM(IF( cash_type= 'cash', total, 0)) AS cash  ";
        $this->table = " purchase as a inner join (select DISTINCT tb_id as tb_id,branch_id from acc_ledger_trans as b WHERE b.published='yes' and tb_name='purchase') as c on c.tb_id=a.id ";
        $this->column_order = array(null, 'type'); //set column field database for datatable orderable
        $this->column_search = array('type'); //set column field database for datatable searchable 
//        $this->order = array('trn_tp' => 'asc'); // default order 
        $this->wherecondition = " where a.published='yes' and   a.date = '" . $this->getDate($this->input->post('date')) . "' ";
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . 'and branch_id=' . $this->input->post('branch');
        }
        $this->wherecondition = $this->wherecondition . " GROUP by a.type ";
    }

    function getvouchers() {
        $this->select = 'trn_tp,sum(tran_debit) as cash ';
        $this->table = ' acc_ledger_trans as a';
        $this->column_order = array(null, 'trn_tp'); //set column field database for datatable orderable
        $this->column_search = array('trn_tp'); //set column field database for datatable searchable 
//        $this->order = array('trn_tp' => 'asc'); // default order 
        $this->wherecondition = " where published='yes' and tb_name='voucher'  and tran_date = '" . $this->getDate($this->input->post('date')) . "' and trn_tp in ('payment','receipt')  ";
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . 'and branch_id=' . $this->input->post('branch');
        }
        $this->wherecondition = $this->wherecondition . " group by trn_tp ORDER BY FIELD(trn_tp,'receipt','payment') ";
    }

    function getcheque() {
        $this->select = 'chq_trans,sum(a.tran_debit) as bank ';
        $this->table = ' acc_ledger_trans as a INNER join chqdetails as b on a.tb_id=b.chq_id and a.trn_tp="Cheque"';
        $this->column_order = array(null, 'chq_trans'); //set column field database for datatable orderable
        $this->column_search = array('chq_trans'); //set column field database for datatable searchable 
//        $this->order = array('trn_tp' => 'asc'); // default order 
        $this->wherecondition = " where a.published='yes'  and tran_date = '" . $this->getDate($this->input->post('date')) . "' and trn_tp in ('Cheque')  ";
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . 'and a.branch_id=' . $this->input->post('branch');
        }
        $this->wherecondition = $this->wherecondition . " GROUP by b.chq_trans ";
    }

    function getallvochers() {
        $this->select = 'trn_tp,sum(tran_debit) as total';
        $this->table = ' acc_ledger_trans as a';
        $this->column_order = array(null, 'trn_tp'); //set column field database for datatable orderable
        $this->column_search = array('trn_tp'); //set column field database for datatable searchable 
//        $this->order = array('trn_tp' => 'asc'); // default order 
        $this->wherecondition = " where a.published ='yes'   and tran_date = '" . $this->getDate($this->input->post('date')) . "' and trn_tp in ('sales','sales_return','purchase','purchase_return','payment','receipt') ";
        if ($this->input->post('branch')) {
            $this->wherecondition = $this->wherecondition . 'and a.branch_id=' . $this->input->post('branch');
        }
        $this->wherecondition = $this->wherecondition . " group by trn_tp ORDER BY FIELD(trn_tp,'sales','sales_return','purchase','purchase_return','payment','receipt') ";
    }
	
	function getbranchanalysis(){
		$where_sale = ' where 1 ';
		$where_purchase = ' where 1 ';
		$where_vou = ' where 1';
		$startdate = $this->getDate($this->input->post('startdate'));
		$enddate = $this->getDate($this->input->post('enddate'));
		$branch = $this->input->post('branch');
		if($this->input->post('startdate')){
			$where_sale = $where_sale . ' and invoice_date >= "'.$startdate.'" ';
			$where_purchase = $where_purchase . ' and date >= "'.$startdate.'" ';
			$where_vou = $where_vou . ' and trans_date >= "'.$startdate.'" ';
		}
		if($this->input->post('enddate')){
			$where_sale = $where_sale . ' and invoice_date <= "'.$enddate.'" ';
			$where_purchase = $where_purchase . ' and date <= "'.$enddate.'" ';
			$where_vou = $where_vou . ' and trans_date <= "'.$enddate.'" ';
			
		}
		if($this->input->post('branch')){
			$where_sale = $where_sale . ' and sb.branch_id = "'.$branch.'" ';
			$where_purchase = $where_purchase . ' and sb.branch_id = "'.$branch.'" ';
			$where_vou = $where_vou . ' and sb.branch_id = "'.$branch.'" ';
		}
		
		$qry = "SELECT sum(ae.paid) as paid,sum(CASE WHEN s.type = 'sales' then s.bill_margin else 0  end ) as total_margin,sum(CASE WHEN s.cash_type ='Cash' and s.type ='sales' then s.total else 0 end) as cash_sale, sum(CASE WHEN s.cash_type ='Credit' and s.type ='sales' then s.total else 0 end) as credit_sale, sum(CASE WHEN s.cash_type ='Bank' and s.type ='sales' then s.total else 0 end) as bank_sale,sum(CASE WHEN  s.type ='sales' then s.total else 0 end) as total_sale,sum(CASE WHEN  s.type ='estimate' then s.total else 0 end) as total_sorder ,sum(CASE WHEN  s.type ='sales_return' then s.total else 0 end) as total_sreturn FROM sales as s INNER JOIN set_billtype as sb on s.bill_type = sb.id and s.published = 'yes' left join acc_ageing as ae on ae.tb_id = s.sales_id and ae.tb_name= 'sales' and (ae.credit >0 or ae.debit > 0 ) ".$where_sale." ";
		$data = $this->db->query($qry)->row_array();
		//$data['total_margin'] = $query['total_margin'];
		//$data['cash_sale'] = $query['cash_sale'];
		//$data['credit_sale'] = $query['credit_sale'];
		//$data['bank_sale'] = $query['bank_sale'];
		//$data['total_sale'] = $query['total_sale'];
		//$data['total_sorder'] = $query['total_sorder'];
		//$data['total_sreturn'] = $query['total_sreturn'];
		$qry  = "SELECT sum(CASE WHEN p.cash_type ='Cash' and p.type ='purchase' then p.total else 0 end) as cash_purchase, sum(CASE WHEN p.cash_type ='Credit' and p.type ='purchase' then p.total else 0 end) as credit_purchase, sum(CASE WHEN p.cash_type ='Bank' and p.type ='purchase' then p.total else 0 end) as bank_purchase,sum(CASE WHEN  p.type ='purchase' then p.total else 0 end) as total_purchase,sum(CASE WHEN  p.type ='order' then p.total else 0 end) as total_porder ,sum(CASE WHEN  p.type ='purchase_return' then p.total else 0 end) as total_preturn from purchase as p INNER JOIN set_billtype as  sb on p.bill_type = sb.id and p.published = 'yes' ".$where_purchase." ";
		$query = $this->db->query($qry)->row_array();
		$data['cash_purchase'] = $query['cash_purchase'];
		$data['credit_purchase'] = $query['credit_purchase'];
		$data['bank_purchase'] = $query['bank_purchase'];
		$data['total_purchase'] = $query['total_purchase'];
		$data['total_porder'] = $query['total_porder'];
		$data['total_preturn'] = $query['total_preturn'];
		$qry = "SELECT SUM(CASE WHEN v.vourcher_type = 'payment' then v.amount else 0 end ) as total_pay,SUM(CASE WHEN v.vourcher_type = 'receipt' then v.amount else 0 end ) as total_rec from voucher as v INNER JOIN set_billtype as sb on v.bill_type = sb.id and v.published = 'yes'";
		$query = $this->db->query($qry)->row_array();
		$data['total_pay'] = $query['total_pay'];
		$data['total_rec'] = $query['total_rec'];
		echo json_encode($data);
	}

}
