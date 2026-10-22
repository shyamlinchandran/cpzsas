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
class Mobile_model extends DataTable {

    public function __construct() {
        parent::__construct();
      
    }

    public function voucherslist(){
        $txt = '';
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
		if($this->session->userdata('user')){
			$txt = ' and a.created_by = ' .$created_by ;
		}
        //if ($this->input->post('type')) {
            $this->wherecondition = "where  vourcher_type = 'receipt'";
           
      // }
        $this->select = 'led.name as ledname,DATE_FORMAT(trans_date, "%d/%m/%Y") as tran_date,voucher_no as invoice, a.published as pub, a.id as v_id,a.*, GROUP_CONCAT(c.name) AS names ,GROUP_CONCAT(FORMAT(b.credit_amounnt,2) SEPARATOR \';\') AS credit_amounnts ,GROUP_CONCAT(FORMAT(b.debit_amount,2) SEPARATOR \';\') AS debit_amounts';
        $this->table = '`voucher` as a inner join acc_ledgers as led on vourcher_type = "receipt" and led.id=a.ledger '.$txt.' inner join voucher_trans as b on a.id =b.voucher_id inner join acc_ledgers as c on b.acc_ledgers_id=c.id left join suppliers as sup on sup.id = c.ref_id and c.ref_code in("cus","sup")';
        $this->column_order = array(null, 'name', 'naration', 'trans_date', 'amount', 'vourcher_type', 'voucher_no'); //set column field database for datatable orderable
        $this->column_search = array('a.voucher_no', 'c.name', 'a.trans_date', 'naration'); //set column field database for datatable searchable
        $this->order = array('a.id' => 'desc'); // default order
        $this->group = "a.id";// default order 
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $this->wherecondition = ' WHERE  c.acc_main_id not in (1,4) and vourcher_type = "receipt" and a.published = "yes" and  a.created_by = ' .$created_by;
       // $this->wherecondition = ' WHERE a.published = "yes" and  a.created_by = 1';
      
          if ($this->input->post('btype')) {
			  $this->wherecondition =$this->wherecondition .  " and bill_type = '" . $this->input->post('btype') . "'";
		 }
        
        if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition .' and trans_date >="'.$this->input->post('startdate') .'" ';
        }

        if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition .' and trans_date <="'.$this->input->post('enddate') .'" ';
        }


    }

    function UpdatePaymentVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger) {
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $insert_id = 0;
        $cash = $this->getValue('cash');
        $data['vourcher_type'] = "payment";
        //$voucher_no = $this->generatenumber($type);
        if ($vid == 0) {
            $data['voucher_no'] = $voucher_no;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $tp = 'e';
            $insert_id = $vid;
            $voucher_no = $this->input->post('new_invoice');
            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher'  and trn_tp  != 'Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
        }

        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, "voucher", "payment", $ledger, $toid, $data['trans_date'], '0.00', $data['amount'], $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $ledger . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, "voucher", "payment", $toid, $ledger, $data['trans_date'], $data['amount'], '0.00', $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $response = array(
            'valid' => true,
            'message' => $this->msgcheck($insert_id, 'voucher'),
            'id' => $insert_id
        );
        return $response;
    }

    function UpdateReceiptVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger) {
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $cash = $this->getValue('cash');
        //$voucher_no = $this->generatenumber($type);
        $data['vourcher_type'] = "receipt";
        $insert_id = 0;
        if ($vid == 0) {
            $data['voucher_no'] = $voucher_no;
            $this->db->insert('voucher', $data);
            $insert_id = $this->db->insert_id();
        } else {
            $voucher_no = $this->input->post('new_invoice');
            $tp = 'e';
            $insert_id = $vid;
			$old_qry = "SELECT * FROM `voucher` as a INNER JOIN voucher_trans as b on a.id = b.voucher_id and b.published ='yes' inner join acc_ledgers as acc on acc.id = acc_ledgers_id  WHERE acc.acc_main_id not in (1,4) and  a.id = ".$vid;
			$old = $this->db->query($old_qry)->row_array();
            $this->db->where('id', $vid);
            $this->db->update('voucher', $data);
            $qry = "update  voucher_trans set published ='no' where voucher_id =" . $insert_id;
            $this->db->query($qry);
            $qry = "update  acc_ledger_trans set published ='no' where tb_name='voucher' and trn_tp  != 'Cheque' and tb_id =" . $insert_id;
            $this->db->query($qry);
			
			
			$qry = "update acc_ledgers set opening_balance_paid = opening_balance_paid -  ".$old['open_paid']."  where id = ".$old['acc_ledgers_id'];
			$this->db->query($qry);
        }
        $this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $toid, $ledger, $data['trans_date'], '0.00', $data['amount'], $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $cash . ',0.00,' . $data['amount'] . ')';
        $this->getSaved($qry);
        $this->trans_save($voucher_no, $insert_id, 'voucher', "receipt", $ledger, $toid, $data['trans_date'], $data['amount'], '0.00', $data['naration'].';;'.$data['reference'], $data['created_by'], $costcenter, $branch);
        $qry = 'insert into voucher_trans (voucher_id,acc_ledgers_id,credit_amounnt,debit_amount) values  (' . $insert_id . ',' . $toid . ',' . $data['amount'] . ',0.00)';
        $this->getSaved($qry);

        $response = array(
            'valid' => true,
            'message' => $this->msgcheck($insert_id, 'voucher'),
            'id' => $insert_id
        );
        return $response;
    }


    private function ageing_trans_save($type, $id, $tp) {
		$hdcrdt = $this->input->post('hdcrdt', true);
		$check_list = $this->input->post('chck', true);
		$age_id = $this->input->post('age_id', true);
		$txtamt = $this->input->post('txtamt', true);
		$hddbt = $this->input->post('hddbt', true);
		$paid = $this->input->post('paid');
		$tb_id = $this->input->post('tbid', true);
		if ($tp == 'e') {
			$qry = "update  acc_ageing_trans set published ='no' where voucher_id =" . $id;
			$this->db->query($qry);
		}
		if($this->input->post('hdcrdt', true)){
			$i = 0;
			$length = sizeof($hdcrdt);
			for ($i = 0; $i < $length; $i++) {
				$bal = 0;
				if ($type == 'pay') {
					$bal = $hdcrdt[$i];
				}
				if ($type == 'rec') {
					$bal = $hddbt[$i];
				}
				$paid = $txtamt[$i];

				$data = array(
					'ageing_id' => $age_id[$i],
					'voucher_id' => $id,
					'paid' => $txtamt[$i],
					'published' => 'yes',
				);

				$this->db->insert('acc_ageing_trans', $data);
			}
		}
    }

    private function ageing_save($type, $id, $tp) {
        if ($tp != 'n') {
            $qry = "select * from acc_ageing_trans where published='yes' and voucher_id=" . $id . " ";
            $restore = $this->db->query($qry)->result_array();
            foreach ($restore as $ms) {
                $restore_qry = "update acc_ageing set paid = paid-" . $ms['paid'] . " where   age_id = " . $ms['ageing_id'] . " ";
                $this->db->query($restore_qry);
            }
        }
        $check_list = $this->input->post('chck', true);
        $age_id = $this->input->post('age_id', true);
        $txtamt = $this->input->post('txtamt', true);
        $hdcrdt = $this->input->post('hdcrdt', true);
        $hddbt = $this->input->post('hddbt', true);
        $paid = $this->input->post('paid');
        $i = 0;
		if($this->input->post('hdcrdt', true)){
			$length = sizeof($hdcrdt);
			for ($i = 0; $i < $length; $i++) {
				$ls = "";
				$qry = 'select IFNULL(b.paid,0) as paid FROM  voucher_trans as a inner join acc_ageing_trans as b on b.voucher_id=a.voucher_id inner join acc_ageing as c on c.age_id=ageing_id where a.published="yes" and  b.published="yes" and b.voucher_id=' . $id . ' and ageing_id=' . $age_id[$i];
				$query = $this->db->query($qry)->row_array();
				if ($query['paid'] == "") {
					$query['paid'] = 0;
				}
				$paid = $txtamt[$i];
				
				if ($paid == '' || $paid == NULL) {
					$paid = 0;
				}
				if ($tp == 'n') {
					$ls = " , last_paid=" . $paid . "";
				}
				$qry = "update acc_ageing set  pay_type ='" . $type . "' ,balance=(credit+debit)-(paid+" . (float) $paid . "), pay_id= " . $id . ",paid = paid +" . $paid . "  $ls where age_id = " . $age_id[$i];
				$this->db->query($qry);
			}
		}
    }

    function generatevouchernumber($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
                . " c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = $query['top'] + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }

    function savereceipt() {

        $ledger = $this->input->post('frmact');
        $costcenter = 0;
        if ($this->input->post('Costcenter')) {
            $costcenter = $this->input->post('Costcenter');
        }
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $tp = 'n'; // this is for new save 
        $cash = $this->getValue('cash');
        $type = 'rec';
        $toid = $this->input->post('toid', true);
        $vid = $this->input->post('vid', true);
        $billtype = $this->input->post('btype');
        $branch = $this->getbranch($billtype);
        if($branch == ''){
            $branch = 0 ;
        }
        $date = $this->input->post('date', true);
        $amount = $this->input->post('amount', true);
        $narration = $this->input->post('narration', true);
        $response = array(
            'valid' => false,
            'message' => 'illegal Response'
        );
		$invoices = '';
		if( $this->input->post('invoices')  ){
			$invoices = $this->input->post('invoices');
		}
		$salesman = $created_by ;
		if($this->input->post('salesman')){
			$salesman = $this->input->post('salesman');
		}
        $data = array(
            'ledger' => $ledger,
            'amount' => $amount,
			'salesman'=>$salesman,
			'invoices'=>$invoices,
			//'open_paid'=>$open_paid,
			//'open_bal'=>$open_bal,
            'cost_center' => $costcenter,
            'naration' => $narration,
            'trans_date' => $date,
            'created_by' => $created_by,
            'created_date' => date('Y-m-d'),
            'is_post' => "yes",
            'bill_type' => $billtype,
            'published' => "yes"
        );
        if ($this->input->post('autoCheck')) {
            $data['is_autoCheck'] = 1;
        }
        if ($vid == 0) {
            if ($this->input->post('invoice')) {
                $data['voucher_invoice'] = $this->input->post('invoice');
            }
        }

        if ($this->input->post('reference')) {
            $reference = $this->input->post('reference');
            $data['reference'] = $reference;
        }else{
            $data['reference'] = '';
		}
        $voucher_no = $this->generatevouchernumber($billtype);
        
       
        if ($type == 'rec') {
			
            $response = $this->UpdateReceiptVoucher($type, $data, $vid, $toid, $voucher_no, $branch, $ledger);
           
			$insert_id = $response['id'];
            if ($vid > 0) {
                $tp = 'e';
            }
        }
        $this->ageing_save($type, $insert_id, $tp);
        $this->ageing_trans_save($type, $insert_id, $tp);

        $qry = "SELECT b.phone from acc_ledgers as a INNER JOIN suppliers as b on a.ref_id = b.id and a.ref_code in('cus','sup') and a.id = ".$this->input->post('toid');
        $data = $this->db->query($qry);
        if($data->num_rows() > 0 ){
            $data = $data->row_array();
            $phone = $data['phone'];
            if($phone != '' && $this->session->userdata('login_comid') == '123456' ){
                $rtn = $this->send_whatsappsms($this->session->userdata('login_comid'),$phone,'Voucher Updated',base_url().'bills/generatevoucherbill/'.$this->session->userdata('login_comid').'/'.$insert_id.'/e.pdf',$this->session->userdata('login_comid'));

            }
        }
        return $response;
    }


    public function getrecinoviceno($type) {
        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.voucher_no,CONVERT(LEFT(string,length(string)-" . $suffix . ")"
                . ",UNSIGNED INTEGER) as top FROM voucher as a INNER join(select SUBSTRING(voucher_no," . $preffix . ")"
                . " as string,b.id from voucher as b WHERE published='yes' and bill_type=" . $type . ") as c on"
                . " c.id=a.id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = $query['top'] + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];
            return $num;
        }
    }

    public function where(){
        $this->select = 's.sales_id,s.status,s.type,s.invoice,s.invoice_date,s.total,ifnull(cus.name,s.cusname) as cusname';
        $this->table = "sales as s left join suppliers as cus on cus.id = s.customer_id  ";
        $this->column_order = array(null, 'cus.name', 's.invoice','s.invoice_date','s.total'); //set column field database for datatable orderable   
        $this->column_search = array('cus.name','s.invoice','s.invoice_date','s.total','s.status'); //set column field database for datatable searchable 
        $this->order = array('a.invoice_date' => 'desc'); // default order 
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $this->wherecondition = ' WHERE s.published = "yes" and s.type = "estimate" and s.created_by = ' .$created_by;
        if($this->input->post('startdate') ){
            $this->wherecondition = $this->wherecondition .' and invoice_date >="'.$this->input->post('startdate') .'" ';
        }

        if($this->input->post('enddate') ){
            $this->wherecondition = $this->wherecondition .' and invoice_date <="'.$this->input->post('enddate') .'" ';
        }
    }

    public function getitembyId($item_id,$customer_id){

        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $qry = "select user_settings.default_sorder_billtype from user_settings where user_id = ".$created_by;
        $data_user = $this->db->query($qry)->row_array();
        $billtype = $data_user['default_sorder_billtype'];


        $qry = "select * from set_billtype where id = ".$billtype; 
        $b_data = $this->db->query($qry)->row_array();
        $godown = $b_data['godown_id'];

        $cus_rate = '';
        $price_list = 0 ;
        $where_txt = '';
        if((int)  $customer_id > 0 ){
            $qry = "select * from suppliers where   id = " .$customer_id;
            $cus_data = $this->db->query($qry);
            if($cus_data->num_rows() > 0 ){
                $cus_data = $cus_data->row_array();
                $price_list = $cus_data['price_list'];
                if($price_list ==''){
                    $price_list = 0 ;
                }
                $cus_rate = $cus_data['cus_rate'];

            }
        }
        
        $case = ' i.srate ';
        if($cus_rate != ''){
            $case =  ' i.'.$cus_rate.' ';
        }
       
        $sel_text = ' case when pli.sales_rate is null then '.$case .' else pli.sales_rate end  as rate  ';
        $price_qry = ' left join price_list_items as pli on pli.price_list_id = '.$price_list.'  and pli.item_id = i.id and pli.published = "yes"  ';

        $qry = "select IFNULL(itg.open_stock,0) +IFNULL(itg.current_stock,0)  as stock, i.id as item_id,wh_rate,i.id,i.name,i.unit_id,free_qty,free_qty_for,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,i.name as label,$sel_text,IFNULL(pli.price_discount,0) as price_discount,IFNULL(pli.sales_rate,0) as price_list_rate,IFNULL(pli.price_list_id,0) as price_list_id,'$cus_rate' as cus_rate,i.name,i.barcode,i.tax_id,t.GST,i.item_category_id,i.item_group_id,i.srate,i.MRP,i.prate ,IFNULL(case when pli.sales_rate is null then g.discount else pli.price_discount end,0) as discount from item as i left join item_godown as itg on itg.item_id = i.id and itg.godown_id = '".$godown."'  inner join taxgst as t on i.tax_id = t.gstid  left join item_group as g on g.id = i.item_group_id  ".$price_qry." left join cess_tbl as ces on ces.ces_id=i.cess_id where i.id= ".$item_id."  ".$where_txt ."  ";
        $data = $this->db->query($qry)->result_array();
        echo json_encode($data);
    }

    public function itemssearch($search, $category_id, $customer_id,$brand_id = 0){

        
        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $qry = "select user_settings.default_sorder_billtype from user_settings where user_id = ".$created_by;
        $data_user = $this->db->query($qry)->row_array();
        $billtype = $data_user['default_sorder_billtype'];

        $qry = "select * from set_billtype where id = ".$billtype; 
        $b_data = $this->db->query($qry)->row_array();
        $godown = $b_data['godown_id'];

        $cus_rate = '';
        $price_list = 0 ;
        $where_txt = '';
        if((int)  $customer_id > 0 ){
            $qry = "select * from suppliers where   id = " .$customer_id;
            $cus_data = $this->db->query($qry);
            if($cus_data->num_rows() > 0 ){
                $cus_data = $cus_data->row_array();
                $price_list = $cus_data['price_list'];
                if($price_list ==''){
                    $price_list = 0 ;
                }
                $cus_rate = $cus_data['cus_rate'];

            }
        }
        if((int) $category_id > 0  ){
            $where_txt = ' and i.item_category_id = ' .$category_id;
        }
        $case = ' i.srate ';
        if($cus_rate != ''){
            $case =  ' i.'.$cus_rate.' ';
        }
        if((int) $brand_id > 0  ){
            $where_txt = ' and i.brand_id = ' .$brand_id;
        }
        $sel_text = ' case when pli.sales_rate is null then '.$case .' else pli.sales_rate end  as rate  ';
        $price_qry = ' left join price_list_items as pli on pli.price_list_id = '.$price_list.'  and pli.item_id = i.id and pli.published = "yes"  ';

        $qry = "select (select iim_name from item_image where item_id = i.id limit 1) as image, special_rate,IFNULL(itg.open_stock,0) +IFNULL(itg.current_stock,0)  as stock, i.id as item_id,wh_rate,i.id,i.name,i.unit_id,free_qty,free_qty_for,IFNULL(ces_id,0) as ces_id,IFNULL(ces_name,'') as ces_name,IFNULL(ces_percent,0) as ces_percent,concat(i.name,' ,BC: ',i.barcode) as label,$sel_text,IFNULL(pli.price_discount,0) as price_discount,IFNULL(pli.sales_rate,0) as price_list_rate,IFNULL(pli.price_list_id,0) as price_list_id,'$cus_rate' as cus_rate,i.name,i.barcode,i.tax_id,t.GST,i.item_category_id,i.item_group_id,i.srate,i.MRP,i.prate ,IFNULL(case when pli.sales_rate is null then g.discount else pli.price_discount end,0) as discount from item as i left join item_godown as itg on itg.item_id = i.id and itg.godown_id = '".$godown."' inner join taxgst as t on i.tax_id = t.gstid  left join item_group as g on g.id = i.item_group_id  ".$price_qry." left join cess_tbl as ces on ces.ces_id=i.cess_id where is_active =1 and (i.name like '%".$search."%'  or i.barcode like '%".$search."%')  and i.published ='yes' ".$where_txt ."  ";
        $data = $this->db->query($qry)->result_array();
        echo json_encode($data);
    }

    public function getinoviceno($type) {

        $qry1 = "SELECT * FROM  set_billtype  where  id='" . $type . "'  order by id";
        $query1 = $this->db->query($qry1);
        $query1 = $query1->row_array();
        $code = $query1['preffix'] . $query1['seperator'] . $query1['startnumber'] . $query1['seperator'] . $query1['suffix'];
        $preffix = strlen($query1['preffix']) + strlen($query1['seperator']) + 1;
        $suffix = strlen($query1['suffix']) + strlen($query1['seperator']);
        $qry = "SELECT c.*,a.invoice,CONVERT(LEFT(string,length(string)-" . $suffix . "),UNSIGNED INTEGER) as top FROM sales as a INNER join(select SUBSTRING(INVOICE," . $preffix . ") as string,sales_id from sales as b WHERE bill_type='" . $type . "') as c on c.sales_id=a.sales_id order by top desc limit 1";
        $query = $this->db->query($qry);
        if ($query->num_rows() == 0) {
            return $code;
        } else {
            $query = $query->row_array();
            $res = str_replace($query1['preffix'], "", $query['invoice']);
            $res = str_replace($query1['suffix'], "", $res);
            $res = str_replace($query1['seperator'], "", $res);
            $res = $res + 1;
            $num = $query1['preffix'] . $query1['seperator'] . $res . $query1['seperator'] . $query1['suffix'];

            return $num;
        }
    }

    public function save(){
        $tmp = $this->session->userdata('user');
        $sales_id = $this->input->post('sales_id');
        $created_by = $tmp['Id'];

        $tmp = $this->session->userdata('user');
        $created_by = $tmp['Id'];
        $qry = "select user_settings.default_sorder_billtype from user_settings where user_id = ".$created_by;
        $data_user = $this->db->query($qry)->row_array();
        $billtype = $data_user['default_sorder_billtype'];


        $qry = "select * from set_billtype where id = ".$billtype; 
        $b_data = $this->db->query($qry)->row_array();
        $godown = $b_data['godown_id'];

        //$billtype ="SELECT * FROM set_billtype WHERE transaction = 'estimate' ";
        //$billtype = $this->db->query($billtype)->row_array();
        //$billtype = $billtype['id'];
        $invoice_no = $this->getinoviceno($billtype);
        $customer_id  = $this->input->post('customer_id');
        if($customer_id ==''){
            $customer_id = 0 ;
        }
        if((int) $customer_id > 0 ){
            $qry ="select * from suppliers where id = ".$customer_id;
            $supplier_data = $this->db->query($qry)->row_array();
        }
        $sales_grand_subtotal = $this->input->post('sales_grand_subtotal');
        $sales_grand_gst = $this->input->post('sales_grand_gst');
        $grand_cess = $this->input->post('sales_grand_cess');
        $cash_type =  $this->input->post('cash_type');
        $grand_total = $this->input->post('sales_grand_total');
        $invoice_date = date('Y-m-d');
        $sales_grand_subtotal = $this->input->post('sales_grand_subtotal');
        $sales_data = array(
            'customer_id'=>$customer_id,
            'invoice_date'=>$invoice_date,
            'total'=>$grand_total,
            'cash_type'=>$cash_type,
            'tax'=>$sales_grand_gst,
            'status'=>'pending',
            'salesman'=>$created_by,
            'additional_cess'=>$grand_cess,
            'created_by'=>$created_by,
            'type'=>'estimate'
        );
        if($this->input->post('remarks')){
            $sales_data['remarks'] = $this->input->post('remarks');
        }
        $sale_type = 'b2c';
        if((int) $customer_id > 0 ){
            $qry ='SELECT IFNULL(tin,"") as tin FROM suppliers where id = '.$customer_id;
            $su = $this->db->query($qry)->row_array();
            if($su['tin'] != ''){
                $sale_type = 'b2b';
            }
        }
        $sales_data['saletype'] = $sale_type;
        if((int) $sales_id> 0 ){
            $this->db->where('sales_id',$sales_id);
            $this->db->update('sales',$sales_data);
            $insert_id = $sales_id;
            $data_update = array(
                'published'=>'no'
            );
            $this->db->where('sales_id',$sales_id);
            $this->db->update('sales_items',$data_update);
        }else{
            $sales_data['invoice'] =  $invoice_no;
            $sales_data['bill_type'] = $billtype ;
            $this->db->insert('sales',$sales_data);
            $insert_id = $this->db->insert_id();
        }
        $sal_itemid = $this->input->post('sal_itemid',true);
        $sal_itemqty =  $this->input->post('sal_itemqty',true);
        $sal_itemfqty =  $this->input->post('sal_itemfqty',true);
        $sal_itemunit = $this->input->post('sal_itemunit',true);
        $sal_itemrate =  $this->input->post('sal_itemrate',true);
        $sal_itemces_percent = $this->input->post('sal_itemces_percent',true);
        $sal_itemces_id =  $this->input->post('sal_itemces_id',true);
        $sal_itemcess = $this->input->post('sal_itemcess',true);
        $sal_itemtaxid =  $this->input->post('sal_itemtaxid',true);
        $sal_itemtotal =  $this->input->post('sal_itemtotal',true);
        $is_taxincuded = $this->input->post('is_taxincuded');
        $sal_itemdis_amt = $this->input->post('sal_itemdis_amt',true);
        $sal_itemdiscount = $this->input->post('sal_itemdiscount',true);
        $sal_itemtax = $this->input->post('sal_itemtax',true);
        $sal_itemtotal = $this->input->post('sal_itemtotal',true);
        //$qry = "select * from ims_godown ";
        //$godown_data = $this->db->query($qry)->row_array();
        $godown_id = $godown;
        $len = sizeof($sal_itemid);
        for($i = 0;$i<$len;$i++){
            $data_sales_items = array(
                'sales_id'=>$insert_id,
                'item_id'=>$sal_itemid[$i],
                'quantity'=>$sal_itemqty[$i],
                'mrp'=>$sal_itemrate[$i],
                'free_quantity'=>$sal_itemfqty[$i],
                'itm_ces_id'=>$sal_itemces_id[$i],
                'itm_ces_per'=>$sal_itemces_percent[$i],
                'itm_raw_ces'=>$sal_itemcess[$i],
                'tax_id'=>$sal_itemtaxid[$i],
                'unit_id'=>$sal_itemunit[$i],
                'base_unit_id'=>$sal_itemunit[$i],
                'tax'=>$sal_itemtax[$i],
                'total'=>$sal_itemtotal[$i],
                'rate'=>$sal_itemdiscount[$i],
                'dis_amt'=>$sal_itemdis_amt[$i],
                'ces_amt'=>0,
                'is_taxincluded'=>$is_taxincuded,
                'godown'=>$godown_id,

            );
            $this->db->insert('sales_items',$data_sales_items);
        }
        return $insert_id;
    }

   

}
