<?php
class GST1Report_model extends DataTable
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function instructions()
    {
        $qry ="select i.instructions as content from instructions as i order by id asc";
        return $this->db->query($qry)->result_array();
    }
	
	
public function hsn($sales_id){
		
		$qry = "SELECT DATE_FORMAT(invoice_date, '%d - %M - %Y' ) as date,sum(b.quantity) as quantity,a.tax as tottax,concat(h.hsncode,'-',t.GST,'%') as hsn,sum(b.total) - sum(b.tax) - sum(itm_raw_ces)  as taxable,sum(b.tax)/2 as sgst,sum(b.tax) as tax_amount,a.cusname,a.invoice,s.name,s.cst,s.tin as gstin from sales as a INNER JOIN sales_items as b on a.sales_id = b.sales_id and b.published ='yes' INNER JOIN item as i on i.id = b.item_id INNER JOIN taxgst as t on t.gstid = b.tax_id left JOIN hsncode as h on h.hsnid = i.hsncode left JOIN suppliers as s on s.id = a.customer_id WHERE a.sales_id = ".$sales_id." GROUP by i.hsncode,t.gstid";
		return $this->db->query($qry)->result_array();
	}
    
    public function hsncode()
    {
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
        $qry = "SELECT h.hsncode,i.name,u.name as unit,sum(si.quantity) as quantity,sum(si.total) as total,sum(si.total-si.tax - si.itm_raw_ces) as
         taxable,sum(si.tax)/2 as sgst,sum(si.ces_amt) as ces from sales as s INNER JOIN sales_items as si on si.sales_id= s.sales_id 
         and s.published='yes' and si.published ='yes' and invoice_date >= '".$startdate."' and invoice_date <= '".$enddate."' INNER JOIN item as i on i.id=si.item_id INNER JOIN hsncode as h on h.hsnid = i.hsncode 
         INNER JOIN units as u on u.id=i.unit_id GROUP by h.hsnid,si.item_id";

        return $this->db->query($qry)->result_array();
    }
	
	public function pur_hsn_data($sale_type = 'purchase'){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];

        $is_cigarette_cess = 0;
        if($company[0]['is_cigarette_cess']){
            $is_cigarette_cess = $company[0]['is_cigarette_cess'];
        } 
        $txt_join = ' 0 as cessamt,';
        $txt_join_ledger = ' 0 as cessamt,';
        if($is_cigarette_cess > 0 ){
            $txt_join = ' cig_ces_amt+cig_ces_per_amount AS cessamt, ';
        }


		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' and sale.type = "'.$sale_type.'" and sale.date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = " purchase as sale left join suppliers as sup on sup.id = sale.supplier_id left join state as st on st.StateID = sup.cst inner join (SELECT * FROM (SELECT $txt_join pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.purchase_id,pi.tax_id,pi.tax,pi.total,pi.published,pi.is_taxincluded,pi.unit_id,itm_raw_ces from purchase_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT $txt_join_ledger 0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.purchase_id,pl.tax_id,pl.tax,pl.amount + pl.tax,pl.published,pl.is_taxincluded,0 as unit_id,0 itm_raw_ces from purchase_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes') as  s) as  s on s.purchase_id = sale.id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id left JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=s.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id ";
		$select = "sum(cessamt) as cessamts,i.name as itemname, taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax -s.itm_raw_ces) as beforetax ";
		$group = ' group by h.hsnid,s.tax_id';
		$qry = "select " . $select . " from " .  $table  .$group ;
        return $this->db->query($qry)->result_array();
	}
	
    public function hsn_data_new($sale_type = 'sales'){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' an sale.type in("sales","sales_return") and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = " sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join 
        (select * from (SELECT pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT 0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes') as a)
         as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id LEFT JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=s.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=i.unit_id ";
		
         $select = " taxgst.GST as GSTRATE,
         sum(itm_raw_ces * case when sale.type = 'sales' then 1 else -1 end ) as cess,
         sum(s.quantity * case when sale.type= 'sales' then 1 else -1 end ) as quantity,
         sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end * case when sale.type= 'sales' then 1 else -1 end ) as sgst,
         sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end * case when sale.type ='sales' then 1 else -1 end ) as igst,
         u.code,it.name as itemtype,i.name,h.hsncode,
         sum(s.total * case when sale.type= 'sales' then 1 else -1 end ) as total,
         sum(s.tax * case when sale.type= 'sales' then 1 else -1 end ) as tax,
         sum(s.total - s.tax * case when sale.type= 'sales' then 1 else -1 end ) as beforetax ";
		$group = ' group by h.hsncode,s.tax_id ';
		$qry = "select " . $select . " from " .  $table  .$group ;
        return $this->db->query($qry)->result_array();
	}

    public function new_hsn_data($sale_type = 'sales',$saletype =''){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
        $wh = '';
        if($saletype != ''){
            $wh = ' and saletype = "'.$saletype.'" ';
        }

        $is_cigarette_cess = 0;
        if($company[0]['is_cigarette_cess']){
            $is_cigarette_cess = $company[0]['is_cigarette_cess'];
        } 
        $txt_join = ' 0 as cessamt,';
        $txt_join_ledger = ' 0 as cessamt,';
        $txt_sel = ' 0 as cessamts,';
        if($is_cigarette_cess > 0 ){
            $txt_join = ' cig_ces_amt+cig_ces_per_amount AS cessamt, ';
            $txt_sel = ' sum(cessamt) as cessamts,';
        }
        
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' '.$wh.' and sale.type in("sales","sales_return") and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = "  sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join (SELECT  $txt_join pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt,pi.unit_id from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = 'yes' UNION ALL SELECT $txt_join_ledger 0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt,0 as unit_id from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = 'yes') as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id left JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=s.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id ";
		$select = "$txt_sel taxgst.GST as GSTRATE,sum(case when sale.type ='sales_return' then -1 else 1 end * itm_raw_ces) as cess,sum(case when sale.type ='sales_return' then -1 else 1 end * s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then case when sale.type ='sales_return' then -1 else 1 end * s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then case when sale.type ='sales_return' then -1 else 1 end * s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(case when sale.type ='sales_return' then -1 else 1 end * s.total) as total,sum(case when sale.type ='sales_return' then -1 else 1 end * s.tax) as tax,sum((s.total - s.tax -s.itm_raw_ces) * case when sale.type ='sales_return' then -1 else 1 end ) as beforetax ";
		$group = ' group by h.hsnid,s.tax_id ';
		$qry = "select " . $select . " from " .  $table  .$group ;
        return $this->db->query($qry)->result_array();
	}
	
	
	public function hsn_data($sale_type = 'sales'){
		$company = $this->getCompanySettings();
         $is_cigarette_cess = 0;
        if($company[0]['is_cigarette_cess']){
            $is_cigarette_cess = $company[0]['is_cigarette_cess'];
        } 
        $txt_sel = ' 0 as cessamts,';
        if($is_cigarette_cess > 0 ){
            $txt_sel = ' sum(s.cig_ces_amt+s.cig_ces_per_amount) AS cessamts, ';
        }

		$state = $company[0]['comset_statecode'];
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' and sale.type = "'.$sale_type.'" and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = " sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join sales_items as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id INNER JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id ";
		$select = " $txt_sel taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax -s.itm_raw_ces) as beforetax ";
		$group = ' group by h.hsnid,s.tax_id ';
		$qry = "select " . $select . " from " .  $table  .$group ;
        return $this->db->query($qry)->result_array();
	}
	
    public function hsn_data_det($sale_type = 'sales'){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' and sale.type = "'.$sale_type.'" and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = " sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join sales_items as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id INNER JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id ";
		$select = " saletype,taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax -s.itm_raw_ces) as beforetax ";
		$group = ' group by saletype ';
		$qry = "select " . $select . " from " .  $table  .$group ;
        return $this->db->query($qry)->result_array();
	}

    public function hsn_return_det($sale_type = 'sales_return'){
		$company = $this->getCompanySettings();
		$state = $company[0]['comset_statecode'];
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$txt_where =  ' and sale.type = "'.$sale_type.'" and sale.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"  and sale.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" ';
		$table = " sales as sale left join suppliers as sup on sup.id = sale.customer_id left join state as st on st.StateID = sup.cst inner join sales_items as  s on s.sales_id = sale.sales_id and s.published='yes' and sale.published='yes' ".$txt_where." inner join taxgst on taxgst.gstid = s.tax_id INNER JOIN item as i on i.id =s.item_id and s.published ='yes' left JOIN hsncode as h on h.hsnid=i.hsncode left JOIN item_type as it on it.id = i.item_type_id left JOIN units as u on u.id=s.unit_id ";
		$select = " saletype,taxgst.GST as GSTRATE,sum(itm_raw_ces) as cess,sum(s.quantity) as quantity,sum(CASE WHEN IFNULL(st.StateID,".$state.") = ".$state." then s.tax/2 else 0 end) as sgst,sum(CASE WHEN IFNULL(st.StateID,".$state.") != ".$state." then s.tax else 0 end) as igst,u.code,it.name as itemtype,i.name,h.hsncode,sum(s.total) as total,sum(s.tax) as tax,sum(s.total - s.tax -s.itm_raw_ces) as beforetax ";
		$group = ' group by saletype ';
		$qry = "select " . $select . " from " .  $table  ;
        return $this->db->query($qry)->result_array();
	}


	public function purchase_data($purchase_type,$type,$group ='' ,$having = '',$amtcheck = ''){
		$txt_where = '';
		if($amtcheck =='cl'){
			$txt_where = ' and b.total >=250000 ' ;
		}
		if($amtcheck =='cs'){
			$txt_where = ' and b.total < 250000 ' ;
		}

        $settings =  $settings = $this->getCompanySettings();
        $is_cigarette_cess = 0;
        if($settings[0]['is_cigarette_cess']){
            $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
        } 
        $txt_join = ' 0 as cessamt,';
        $txt_join_ledger = ' 0 as cessamt,';
        if($is_cigarette_cess > 0 ){
            $txt_join = ' cig_ces_amt+cig_ces_per_amount AS cessamt, ';
        }
		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$company = $this->getCompany();
		$text_company_state = $company['statecode'].'-'.$company['statename'];
		$select = '"'.$company['statecode'].'" as comstate,case when st.StateID is null then "'.$company['statecode'].'" else  st.code end as cusstate,case when st.StateID is null then "'.$text_company_state.'" else concat(st.code,"-",st.StateName) end as place,DATE_FORMAT(b.date, "%d-%b-%Y" ) as in_date,sum(itm_raw_ces) as item_cess,0 as kfc ,b.total-sum(a.total) as tot,s.name,b.total as invoicetotal,b.date,s.tin,b.invoice,c.gst,sum(a.total) AS TOTAL,SUM(a.TAX) AS tax,SUM(a.total-a.tax) - sum(case when a.is_taxincluded ="1" then itm_raw_ces else 0 end)  AS taxableamt,a.id as sid,b.type as stype,sum(cessamt) as cessamts ';
		$table = '(SELECT '.$txt_join.'is_taxincluded,a.id,total,a.tax,a.purchase_id,a.quantity,a.tax_id,a.tax AS ptax,a.total AS Ptotal,a.unit_id,a.base_unit_id,a.item_id,published,itm_raw_ces FROM purchase_items a  WHERE a.published ="yes" UNION All SELECT '.$txt_join_ledger .' 0 as is_taxincluded,a.id,a.amount + a.tax,a.tax,a.purchase_id,1 as quantity,a.tax_id,a.tax AS ptax,a.amount AS Ptotal,0 as unit_id,0 base_unit_id,a.ledger_id,published,0 as itm_raw_ces  FROM purchase_ledgers a WHERE a.published ="yes") as a INNER JOIN purchase as b on a.published = "yes" and b.published = "yes" and a.purchase_id=b.`id` and b.type = "'.$purchase_type.'"  and b.date >="' . $this->getDate($this->input->post('startdate')) . '" and b.date <="' . $this->getDate($this->input->post('enddate')) . '" '.$txt_where .' INNER JOIN taxgst as c on a.tax_id=c.gstid LEFT JOIN suppliers as s on s.id=b.supplier_id  left join state as st on st.StateID = s.cst';
		$where =  ' where 1 ';
		if ($type) {
            if ($type == 'B2B') {
                $where = $where. ' and s.tin !="" and s.tin is not  null ';
            }
            if ($type == 'B2C') {
                $where = $where. ' and (s.tin ="" or s.tin is null) ';
            }
        }
		$qry = "select " . $select . " from " .  $table . $where .$group .$having ;
        return $this->db->query($qry)->result_array();
	}
	
	public function sales_data($sale_type,$type,$group ='' ,$having = '',$amtcheck = ''){
		$txt_where = '';
		if($amtcheck =='cl'){
			$txt_where = ' and b.total >=250000 ' ;
		}
		if($amtcheck =='cs'){
			$txt_where = ' and b.total < 250000 ' ;
		}

        $settings =  $settings = $this->getCompanySettings();
        $is_cigarette_cess = 0;
        if($settings[0]['is_cigarette_cess']){
            $is_cigarette_cess = $settings[0]['is_cigarette_cess'];
        } 
        $txt_join = ' 0 as cessamt,';
        $txt_join_ledger = ' 0 as cessamt,';
        $txt_sel = ' 0 as cessamts,';
        if($is_cigarette_cess > 0 ){
            $txt_join = ' cig_ces_amt+cig_ces_per_amount AS cessamt, ';
            $txt_sel = ' sum(cessamt) as cessamts,';
        }

		$startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
		$company = $this->getCompany();
		$text_company_state = $company['statecode'].'-'.$company['statename'];
		$select = ''.$txt_sel.' "'.$company['statecode'].'" as comstate,case when st.StateID is null then "'.$company['statecode'].'" else  st.code end as cusstate,case when st.StateID is null then "'.$text_company_state.'" else concat(st.code,"-",st.StateName) end as place,DATE_FORMAT(invoice_date, "%d-%b-%Y" ) as in_date,sum(itm_raw_ces) as item_cess,sum(case when b.saletype ="b2c" and b.cess > 0  then ces_amt else 0 end) as kfc ,b.total-sum(a.total) as tot,s.name,b.total as invoicetotal,b.invoice_date,s.tin,b.invoice,c.gst,sum(a.total) AS TOTAL,SUM(a.TAX) AS tax,SUM(a.total-a.tax) - sum(case when a.is_taxincluded ="1" then itm_raw_ces else itm_raw_ces end) - sum(case when a.is_taxincluded ="1" and b.saletype ="b2c" and b.cess > 0  then ces_amt else 0 end) AS taxableamt,a.sales_id as sid,b.type as stype ';
		$table = '(SELECT '. $txt_join.'pi.item_id,pi.quantity,IFNULL(i.hsncode,0) as hsncode,pi.sales_id,pi.tax_id,pi.tax,pi.total,pi.itm_raw_ces,pi.published,pi.is_taxincluded,pi.ces_amt,pi.unit_id from sales_items as pi left join item as i on i.id = pi.item_id WHERE pi.published = "yes" UNION ALL SELECT '.$txt_join_ledger.' 0 as item_id,1 as quantity,IFNULL(al.hsncode,0) as hsncode,pl.sales_id,pl.tax_id,pl.tax,pl.amount + pl.tax,0,pl.published,pl.is_taxincluded,0 as ces_amt,0 as unit_id from sales_ledgers as pl inner join acc_ledgers as al on al.id = pl.ledger_id left join hsncode as h on h.hsnid = al.hsncode WHERE pl.published = "yes") as a INNER JOIN sales as b on a.published = "yes" and b.published = "yes"  and a.sales_id=b.`sales_id` and b.type = "'.$sale_type.'"  and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '" and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '" '.$txt_where .' INNER JOIN taxgst as c on a.tax_id=c.gstid LEFT JOIN suppliers as s on s.id=b.customer_id  left join state as st on st.StateID = s.cst';
		$where =  ' where 1 ';
		if ($type) {
            if ($type == 'B2B') {
                $where = $where. ' and s.tin !="" and s.tin is not  null ';
            }
            if ($type == 'B2C') {
                $where = $where. ' and (s.tin ="" or s.tin is null) ';
            }
        }
		$qry = "select " . $select . " from " .  $table . $where .$group .$having  .' order by b.sales_id,invoice_date asc';
        return $this->db->query($qry)->result_array();
	}
    public function b2b()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));
        $qry = 'SELECT su.tin,s.invoice,s.invoice_date,s.total,t.GST as Rate,(SUM(si.total)-SUM(si.tax) - sum(case when si.is_taxincluded ="1" then itm_raw_ces else itm_raw_ces end) - sum(case when si.is_taxincluded ="1" and s.saletype ="b2c" then ces_amt else 0 end) ) as taxable, si.ces_amt from 
        sales as s left join suppliers as su on su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst 
        as t on si.tax_id=t.gstid  WHERE s.saletype="b2b" and s.published="yes" and s.invoice_date >= "'.$startdate.'" 
        and s.invoice_date <= "'.$enddate.'" GROUP by s.invoice,t.gstid';
        return $this->db->query($qry)->result_array();
    }
    public function b2c()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));

        $qry = 'SELECT su.tin,s.invoice,s.invoice_date,s.total,t.GST as Rate,(SUM(si.total)-SUM(si.tax) - sum(case when si.is_taxincluded ="1" then itm_raw_ces else itm_raw_ces end) - sum(case when si.is_taxincluded ="1" and s.saletype ="b2c" then ces_amt else 0 end)) as taxable, si.ces_amt from 
        sales as s left join suppliers as su on su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst 
        as t on si.tax_id=t.gstid  WHERE s.saletype="b2c" and s.published="yes" and s.invoice_date >= "'.$startdate.'" 
        and s.invoice_date <= "'.$enddate.'" GROUP by s.invoice,t.gstid';
        return $this->db->query($qry)->result_array();

    }
    public function b2cs()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));

        $qry ='SELECT t.GST as Rate,(SUM(si.total)-SUM(si.tax) -SUM(si.itm_raw_ces) ) as taxable, si.ces_amt from sales as s left join suppliers as su on
         su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst as t on si.tax_id=t.gstid WHERE
          s.saletype="b2c" and s.published="yes" and s.invoice_date >= "'.$startdate.'" and s.invoice_date <= "'.$enddate.'" GROUP by 
          s.invoice,t.gstid ';
          return $this->db->query($qry)->result_array();
    }
    public function cdnr()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));

        $qry = 'SELECT SUM(s.total) AS refund,t.GST as Rate,(SUM(si.total)-SUM(si.tax) -SUM(si.itm_raw_ces) ) as taxable, si.ces_amt from sales as s 
        left join suppliers as su on su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst as t on
        si.tax_id=t.gstid WHERE s.saletype="b2c" and s.published="yes" and s.invoice_date >= "'.$startdate.'" and s.invoice_date <= "'.$enddate.'" 
        GROUP by s.invoice,t.gstid';
        return $this->db->query($qry)->result_array();
    }
    public function cdnur()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));

        $qry = 'SELECT SUM(s.total) AS refund,t.GST as Rate,(SUM(si.total)-SUM(si.tax) -SUM(si.itm_raw_ces) ) as taxable, si.ces_amt from sales as s 
        left join suppliers as su on su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst as t on
        si.tax_id=t.gstid WHERE s.saletype="b2c" and s.published="yes" and s.invoice_date >= "'.$startdate.'" and s.invoice_date <= "'.$enddate.'" 
        GROUP by s.invoice,t.gstid';
        return $this->db->query($qry)->result_array();
    }
    public function exp()
    {
        $startdate =  $this->getdate($this->input->post('startdate'));
        $enddate = $this->getdate($this->input->post('enddate'));

        $qry = 'SELECT su.tin,s.invoice,s.invoice_date,s.total,t.GST as Rate,(SUM(si.total)-SUM(si.tax) -SUM(si.itm_raw_ces) ) as taxable, si.ces_amt from 
        sales as s left join suppliers as su on su.id=s.sales_id left join sales_items as si on si.sales_id=s.sales_id left join taxgst 
        as t on si.tax_id=t.gstid  WHERE  s.published="yes" and s.invoice_date >= "'.$startdate.'" 
        and s.invoice_date <= "'.$enddate.'" GROUP by s.invoice,t.gstid';
        return $this->db->query($qry)->result_array();
    }
}