<?php
class New_Purchase_report_model extends DataTable{
    public function __construct()
    {
       parent::__construct();
       $this->load->database(); 
    }
	
		
	public function purchasetax(){
		$company = $this->getCompany();
		$text_company_state = $company['statename'];
		
		$ary_add = '';
		$qry_add = "SELECT concat('SUM(CASE when pl.tax_id = ',gstid ,' then pl.amount else 0 end ) as pltotal',gstid,',','SUM(CASE when pl.tax_id = ',gstid ,' then pl.tax else 0 end ) as pltax',gstid,',','SUM(CASE when pl.tax_id = ',gstid ,' then pl.amount else 0 end ) - SUM(CASE when pl.tax_id = ',gstid ,' and pl.is_taxincluded = 1 then pl.tax else 0 end )  as pltaxable',gstid)  as ary from taxgst";
		$query = $this->db->query($qry_add)->result_array();
		foreach($query as $item){
			if($ary_add != ''){
				$ary_add  = $ary_add  .',';
			}
			$ary_add = $ary_add . $item['ary'];
		}
		
		
		
		$ary = '';
		$qry = "SELECT (concat('SUM(CASE when b.tax_id = ',gstid ,' then b.itm_raw_ces else 0 end ) as cess',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total else 0 end ) as total',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.tax else 0 end ) as tax',gstid,',','SUM(CASE when b.tax_id = ',gstid ,' then b.total-b.tax else 0 end ) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =  ";
		$qry = $qry . '"1"';
		$qry = $qry . "then b.itm_raw_ces else 0 end) - sum(CASE when b.tax_id = ',gstid ,' and b.is_taxincluded =";
		$qry = $qry . '"1"   ';
		$qry = $qry . "then 0 else 0 end) ";
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
        $this->table = 'purchase as a left join set_billtype as sb on sb.id = a.bill_type left join (SELECT pl.purchase_id as plpurchase_id,'.$ary_add.' from purchase_ledgers as pl WHERE pl.published ="yes" GROUP by pl.purchase_id) as x on x.plpurchase_id = a.id  left join suppliers as s on s.id=a.supplier_id left join state as st on st.StateID = s.cst left join purchase_items as b on a.id=b.purchase_id and b.published="yes" left join item as i on i.id=b.item_id left join hsncode as h on h.hsnid =i.hsncode ';
		$this->select = 'sb.type as btype,x.*,case when st.StateID is null then "'.$text_company_state.'" else concat(st.StateName) end as place,DATE_FORMAT(a.date, "%d-%m-%Y" ) as in_date,a.published as salepub,a.id,IFNULL(s.tin,"") as tin,a.discount,additional_cess,IFNULL(s.tin,0) as custstate,a.total as tot,a.roundoff,a.invoice,s.name as customer,DATE_FORMAT(a.date, "%d-%m-%Y" )  as date,h.hsncode,a.type,'.$ary.' ';
		$this->column_order = array('a.invoice','s.name'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice','s.name'); //set column field database for datatable searchable 
        $this->order = array('a.id' => 'asc'); // default order 
        $this->wherecondition = ' where 1 ';
		if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and a.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
		if($this->input->post('saletype')){
            $this->wherecondition = $this->wherecondition . ' and a.type ="' . $this->input->post('saletype') . '"';
		}
		if($this->input->post('salestype') ){
            //$this->wherecondition = $this->wherecondition . ' and a.saletype ="' . $this->input->post('salestype') . '"';
		}
		if($this->input->post('customer_id')){
            $this->wherecondition = $this->wherecondition . ' and a.supplier_id ="' . $this->input->post('customer_id') . '"';
		}
		if($this->input->post('hsnid')){
            $this->wherecondition = $this->wherecondition . ' and h.hsnid ="' . $this->input->post('hsnid') . '"';
		}
		
		if($this->input->post('btype')){
            $this->wherecondition = $this->wherecondition . ' and a.bill_type ="' . $this->input->post('btype') . '"';
		}
		
		$this->group = 'a.id';
	}
	
	
    public function where()
    {
		$company = $this->getCompany();
		$text_company_state = $company['statename'];
        $this->select = "sb.type as btype,IFNULL(s.tin,0) as custstate,x.*,IFNULL(ces_name,'Cess') as ces_name,itm_raw_ces,IFNULL(uqc_name,u.name) as unitname,p.type,case when st.StateID is null then '".$text_company_state."' else concat(st.StateName) end as place,t.GST,pi.total as tot,h.hsncode as hsn,i.part_no,p.bill_no,p.invoice,DATE_FORMAT(p.date, '%d-%m-%Y' ) as date,s.name as supplier,i.name,i.barcode,pi.quantity,i.mrp as itemmrp,pi.rate,pi.discount,case WHEN pi.is_taxincluded =0 then pi.rate else pi.rate - (pi.rate*t.GST)/100 end as prate ,pi.total -pi.tax as amount,concat('Purchase @',t.GST,'%') as txt,pi.tax/2 as sgst,s.address_line1,s.tin,pi.dis_amt";
        $this->table = "purchase as p left join set_billtype as sb on sb.id = p.bill_type left join (SELECT GROUP_CONCAT(IFNULL(plt.GST,0)) as plgst,GROUP_CONCAT(CASE when pl.is_taxincluded = 1 then pl.amount else pl.amount + pl.tax end ) as pltot,pl.purchase_id as plpurchase_id ,GROUP_CONCAT(placc.name) as plitem,GROUP_CONCAT(pl.tax) as pltax,pl.purchase_id,GROUP_CONCAT(CASE when pl.is_taxincluded = 1 then pl.amount - pl.tax else pl.amount end) as pltaxable from purchase_ledgers as pl left JOIN taxgst as plt on pl.tax_id = plt.gstid INNER JOIN acc_ledgers as placc on placc.id = pl.ledger_id WHERE pl.published ='yes' GROUP by pl.purchase_id) as x on x.plpurchase_id = p.id Left JOIN purchase_items as pi on pi.purchase_id =p.id and pi.published = 'yes'  left join cess_tbl as ces on ces.ces_id = pi.itm_ces_id left JOIN suppliers as s on s.id =p.supplier_id   left join state as st on st.StateID = s.cst left JOIN item as i on i.id = pi.item_id left join units as u on u.id = i.unit_id   left join uqc on uqc.uqc_id = u.uqc left JOIN taxgst as t on t.gstid =pi.tax_id left join hsncode as h on h.hsnid = i.hsncode";
        $this->column_search = array('s.name');
        $this->column_order = array('p.invoice');
        $this->order = array('p.invoice'=>'desc');

        $this->wherecondition =' where p.type = "'.$this->input->post('type').'" ';
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and p.date >="' . $this->getdate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and p.date <="' . $this->getdate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . 'and purchase_id = "' . $this->input->post('customer_id') . '"';
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