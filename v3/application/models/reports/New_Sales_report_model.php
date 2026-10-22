<?php 
class New_Sales_report_model extends DataTable{
    public function construct()
    {
        parent::__construct();
        $this->load->database();
    }
	
	public function salestax(){
		$company = $this->getCompany();
		$text_company_state = $company['statename'];
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.itm_raw_ces else 0 end ) as cess',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then b.itm_raw_ces else 0 end) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =";
		$qry = $qry . '"1" and a.saletype = "b2c" and a.cess > 0 ';
		$qry = $qry . "then b.ces_amt else 0 end) ";
		$qry = $qry . " as taxable',gstid)) as ary FROM `taxgst`";
		$query = $this->db->query($qry)->result_array();
		foreach($query as $item){
			if($ary != ''){
				$ary  = $ary  .',';
			}
			$ary = $ary . $item['ary'];
		}
		//print_r($ary);
		//$ary  = $query['ary'];
        $this->table = 'sales as a left join set_billtype as sb on sb.id = a.bill_type left join suppliers as s on s.id=a.customer_id left join state as st on st.StateID = s.cst inner join sales_items as b on a.sales_id=b.sales_id and b.published="yes" inner join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode ';
		$this->select = 'sb.type as btype,case when st.StateID is null then "'.$text_company_state.'" else concat(st.StateName) end as place,DATE_FORMAT(invoice_date, "%d-%m-%Y" ) as in_date,a.published as salepub,a.sales_id,IFNULL(s.tin,"") as tin,a.discount,additional_cess,a.cess as ces_amt,IFNULL(s.tin,0) as custstate,a.total as tot,a.roundoff,a.invoice,s.name as customer,a.invoice_date,h.hsncode,a.type,'.$ary.' ';
		$this->column_order = array('a.invoice','s.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','s.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'asc'); // default order 
        $this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('salestype') ){
            $this->wherecondition = $this->wherecondition . ' and a.saletype ="' . $this->input->post('salestype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.customer_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		if($this->input->post('btype')){
            $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		
		$this->group = 'a.sales_id';
	}
    public function where()
    {
		$company = $this->getCompany();
		$text_company_state = $company['statename'];
        $this->select='roundoff,s.discount as billdis,u.name as unitname,su.pincode,sb.type as btype,IFNULL(su.tin,0) as custstate,case when st.StateID is null then "'.$text_company_state.'" else concat(st.StateName) end as place,itm_raw_ces,IFNULL(ces_name,"Cess") as ces_name,IFNULL(uqc_name,u.name) as unitname,t.GST as taxper,h.hsncode as hsn,si.total,s.invoice,DATE_FORMAT(invoice_date, "%d-%m-%Y" ) as invoice_date,IFNULL(su.name,s.cusname) as customer,i.name,i.barcode,si.quantity,si.mrp,t.gst,si.is_taxincluded, i.MRP as itemmrp,case WHEN si.is_taxincluded =0 then si.mrp else si.mrp -(si.mrp*t.GST)/100 end as Salerate,si.rate as dis,si.total -si.tax as amount,s.type,si.tax/2 as sgst,si.total,su.tin,su.phone,su.address_line1,si.dis_amt';
        $this->table ="sales as s left join set_billtype as sb on sb.id = s.bill_type left join suppliers as su on su.id=s.customer_id  left join state as st on st.StateID = su.cst INNER JOIN sales_items as si on si.sales_id=s.sales_id and si.published ='yes' INNER JOIN item as i on i.id = si.item_id left join hsncode as h on h.hsnid = i.hsncode INNER JOIN taxgst as t on t.gstid = si.tax_id left join units as u on u.id = i.unit_id left join uqc on uqc.uqc_id = u.uqc left join cess_tbl as ces on ces.ces_id = itm_ces_id ";
        $this->column_search = array('su.name');
        $this->column_order = array('s.invoice');
        $this->order = array('s.invoice'=>'desc');

        $this->wherecondition =' where s.type = "'.$this->input->post('type').'" ';
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and invoice_date>="' . $this->getdate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and invoice_date<="' . $this->getdate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . 'and customer_id = "' . $this->input->post('customer_id') . '"';
        }
    }
    public function suppliers($search,$type)
    {
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
        $qry = "select $com a.*,b.StateID,b.code from suppliers as a  left join state as b on a.cst=b.StateID where $type  (name like('%$search%') $ls or phone like('%$search%'))";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }
}