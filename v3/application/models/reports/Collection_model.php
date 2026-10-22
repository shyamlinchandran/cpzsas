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
class Collection_model extends DataTable {

    function wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->select = 'cash_type,b.total-sum(a.total) as tot,s.name,b.total as invoicetotal,b.invoice_date,s.tin,b.invoice,c.gst,sum(a.total) AS TOTAL,SUM(a.TAX) AS tax,SUM(a.total-a.tax) AS taxableamt,a.sales_id as sid,b.type as stype';
        $this->table = 'sales_items as a INNER JOIN sales as b on a.sales_id=b.`sales_id` INNER JOIN taxgst as c on a.tax_id=c.gstid LEFT JOIN suppliers as s on s.id=b.customer_id  ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('b.invoice', 's.email', 's.phone', 's.name'); //set column field database for datatable searchable 
        $this->order = array('invoice' => 'desc'); // default order 
        if ($this->input->post('sale_type')) {
            $this->wherecondition = " where b.published ='yes' and a.published='yes' and b.type not in('estimate') and b.type  in('" . $this->input->post('sale_type') . "')";
        } else {
            $this->wherecondition = " where b.published ='yes' and a.published='yes' and b.type not in('estimate')";
        }
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and b.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and b.customer_id ="' . $this->input->post('customer_id') . '"';
        }
         if ($this->input->post('user')) {
            $this->wherecondition = $this->wherecondition . ' and b.created_by ="' . $this->input->post('user') . '"';
        }
        $this->wherecondition = $this->wherecondition . ' GROUP by b.invoice ';
    }
	
	
	public function sales_collection_data(){
		
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
		
		if($this->input->post('salesman') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('salesman').'"  ';
            $text =  $text . ' and salesman = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and salesman = "'.$this->input->post('salesman').'"  ';
		}
		if($this->input->post('user') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('user').'"  ';
            $text =  $text . ' and created_by = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and created_by = "'.$this->input->post('salesman').'" ' ;
		}
		$qry  = "SELECT sales_id,total - (bank_amount + cash_amount) as credit_amount,bank_amount,cash_amount,CASE WHEN IFNULL(su.name,cusname) = '' then 'Cash Customer' else  IFNULL(su.name,cusname) end as customer ,DATE_FORMAT(invoice_date,'%d-%m-%Y') as date,s.invoice,s.type,s.cash_type,IFNULL((CASE WHEN s.cash_type = 'cash' and  s.type = 'sales' then total else 0 end),0) as cash,IFNULL((CASE WHEN s.cash_type = 'bank' and s.type = 'sales' then total else 0 end),0) as bank,(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales_return' then total else 0 end) as cashreturn,(CASE WHEN s.cash_type = 'bank' and s.type = 'sales_return' then total else 0 end) as bankreturn from sales as s  LEFT join suppliers as  su on su.id = s.customer_id WHERE s.published = 'yes' and s.type = 'sales'  ".$text." ORDER by invoice_date,sales_id asc";
		$result['sales_data'] = $this->db->query($qry)->result_array();
		
		
		
		echo json_encode($result);
	}
	
	
	public function collection_data(){
		
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
		
		if($this->input->post('salesman') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('salesman').'"  ';
            $text =  $text . ' and salesman = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and salesman = "'.$this->input->post('salesman').'"  ';
		}
		if($this->input->post('user') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('user').'"  ';
            $text =  $text . ' and created_by = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and created_by = "'.$this->input->post('salesman').'" ' ;
		}
		$qry  = "SELECT sales_id,CASE WHEN IFNULL(su.name,cusname) = '' then 'Cash Customer' else  IFNULL(su.name,cusname) end as customer ,DATE_FORMAT(invoice_date,'%d-%m-%Y') as date,s.invoice,s.type,s.cash_type,IFNULL((CASE WHEN s.cash_type = 'cash' and  s.type = 'sales' then total else 0 end),0) as cash,IFNULL((CASE WHEN s.cash_type = 'bank' and s.type = 'sales' then total else 0 end),0) as bank,(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales_return' then total else 0 end) as cashreturn,(CASE WHEN s.cash_type = 'bank' and s.type = 'sales_return' then total else 0 end) as bankreturn from sales as s  LEFT join suppliers as  su on su.id = s.customer_id WHERE s.published = 'yes' and s.type = 'sales' and s.cash_type in('cash','bank') ".$text." ORDER by invoice_date,sales_id asc";
		$result['sales_data'] = $this->db->query($qry)->result_array();
		
		$qry = "SELECT a.id,b.acc_main_id,amount,al.name as ledgername,b.name,DATE_FORMAT(trans_date,'%d-%m-%Y') as date,voucher_no,IFNULL((CASE WHEN vourcher_type  = 'receipt' and b.acc_main_id = '4' then amount else 0 end),0) as cashrec,IFNULL((CASE WHEN vourcher_type  = 'receipt' and b.acc_main_id = '1' then amount else 0 end),0) as bankrec,(CASE WHEN vourcher_type  = 'payment' and b.acc_main_id = '4' then amount else 0 end) as cashpay,(CASE WHEN vourcher_type  = 'payment' and b.acc_main_id = '1' then amount else 0 end) as bankpay FROM `voucher` as a INNER JOIN acc_ledgers as b on a.ledger = b.id LEFT JOIN voucher_trans as vt on vt.published = 'yes' and vt.voucher_id = a.id and b.id != vt.acc_ledgers_id LEFT join acc_ledgers as al on al.id = vt.acc_ledgers_id  WHERE a.published = 'yes' and a.vourcher_type  = 'receipt' ".$text1." ";
		$result['receipt_data'] = $this->db->query($qry)->result_array();
		
		$qry = "SELECT DATE_FORMAT(tran_date,'%d-%m-%Y') as date ,x.*,IFNULL((CASE WHEN chq_trans = 'Issue' then IFNULL(chq_amount,0) else 0 end ),0) as issued,IFNULL((CASE WHEN chq_trans = 'Clearing' then IFNULL(chq_amount,0) else 0 end ),0) as cleared from (SELECT b.tran_date,a.*,al.name as ledgername from chqdetails as a INNER JOIN acc_ledger_trans as b on a.chq_id = b.tb_id and b.trn_tp = 'Cheque' and b.published = 'yes' inner join acc_ledgers as al on al.id = a.chq_frm GROUP by chq_id) as x where chq_trans ='Clearing' and chq_status = 'Cleared' ".$txtcheque." ";
		$result['cheque_data'] = $this->db->query($qry)->result_array();
		
		echo json_encode($result);
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
		
		if($this->input->post('salesman') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('salesman').'"  ';
            $text =  $text . ' and salesman = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and salesman = "'.$this->input->post('salesman').'"  ';
		}
		if($this->input->post('user') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('user').'"  ';
            $text =  $text . ' and created_by = "'.$this->input->post('user').'"  ';
            $text1 =  $text1 . ' and created_by = "'.$this->input->post('user').'" ' ;
		}
        
        $qry = "SELECT sales_id,IFNULL(SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales' then total else 0 end),0) as cash,IFNULL(SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales' then total else 0 end),0) as bank,SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales_return' then total else 0 end) as cashreturn,SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales_return' then total else 0 end) as bankreturn from sales as s WHERE s.published = 'yes' ".$text." ";
		$sales = $this->db->query($qry)->row_array();
		$total = (float)  $sales['cash'] + (float)  $sales['bank'];
		$data['salescash'] = $sales['cash'];
		$data['salesbank'] = $sales['bank'];
		$data['sales_id'] = $sales['sales_id'];
		
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
	
	function totalsalescollectionlist() {
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
		
		if($this->input->post('salesman') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('salesman').'"  ';
            $text =  $text . ' and salesman = "'.$this->input->post('salesman').'"  ';
            $text1 =  $text1 . ' and salesman = "'.$this->input->post('salesman').'"  ';
		}
		if($this->input->post('user') ){
			$txtcheque =  $txtcheque . ' and collected_by = "'.$this->input->post('user').'"  ';
            $text =  $text . ' and created_by = "'.$this->input->post('user').'"  ';
            $text1 =  $text1 . ' and created_by = "'.$this->input->post('user').'" ' ;
		}
        
        $qry = "SELECT IFNULL(SUM(CASE WHEN s.cash_type not in  ('credit','cash','bank') and  s.type = 'sales' then cash_amount else 0 end),0) as other_cash,IFNULL(SUM(CASE WHEN s.cash_type not in  ('credit','cash','bank') and  s.type = 'sales' then bank_amount else 0 end),0) as other_bank,IFNULL(SUM(CASE WHEN s.cash_type not in  ('credit','cash','bank') and  s.type = 'sales' then total - ( bank_amount + cash_amount) else 0 end),0) as other_credit,IFNULL(SUM(CASE WHEN s.cash_type = 'credit' and  s.type = 'sales' then total else 0 end),0) as credit,IFNULL(SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales' then total else 0 end),0) as cash,IFNULL(SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales' then total else 0 end),0) as bank,SUM(CASE WHEN s.cash_type = 'cash' and  s.type = 'sales_return' then total else 0 end) as cashreturn,SUM(CASE WHEN s.cash_type = 'bank' and s.type = 'sales_return' then total else 0 end) as bankreturn,sales_id from sales as s WHERE s.published = 'yes' ".$text." ";
		$sales = $this->db->query($qry)->row_array();
		$total = (float)  $sales['cash'] + (float)  $sales['bank'] + (float) $sales['other_cash'] + (float) $sales['other_bank'] + (float) $sales['other_credit']  ;
		$data['salescash'] = (float) $sales['cash'] + (float) $sales['other_cash'];
		$data['salesbank'] = (float) $sales['bank'] + (float) $sales['other_bank'] ;
		$data['creditsales'] = (float) $sales['credit'] + (float) $sales['other_credit'] ;
		$data['sales_id'] = $sales['sales_id'];
		$data['total'] = $total;
       echo json_encode($data);
    }

}
