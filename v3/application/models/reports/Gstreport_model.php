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
class Gstreport_model extends DataTable {

    function getType() {
        $qry = 'select * from item_group';
        $res = $this->db->query($qry);
        return $res->result_array();
    }

    function where() {

        $this->select = 'c.type as stype,a.sales_id as sid, a.*,b.*,c.*';
        $this->table = 'sales as c inner join sales_items as a on a.sales_id=c.sales_id inner join item as b on a.item_id =b.id';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('a.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('a.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes' and a.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and b.item_group_id ="' . $this->input->post('type') . '"';
        }
    }

    function gstr_wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->select = 'c.GST as gst,a.sales_id as sid,b.type as stype,ROUND(b.total*70/100) as invoicetotal,ROUND(ROUND((sum(a.total)*(70/100)),2)-ROUND(ROUND((sum(a.total)*(70/100)),2) - ROUND(((sum(a.total)*(70/100))*100),2)/(c.GST+100),2) ,2) as taxableamt,c.GST,ROUND((sum(a.total)*(70/100)),2) as TOTAL,b.sales_id,invoice,sum(a.total) as tot,invoice_date, ROUND(ROUND((sum(a.total)*(70/100)),2) - ROUND(((sum(a.total)*(70/100))*100),2)/(c.GST+100),2) as tax,s.name as name, s.tin as tin ';
        $this->table = 'sales as b INNER JOIN sales_items as a on b.sales_id=a.sales_id INNER JOIN taxgst as c on c.gstid=a.tax_id LEFT JOIN suppliers as s on s.id=b.customer_id   ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('b.invoice', 's.email', 's.phone', 's.name'); //set column field database for datatable searchable 
        $this->order = array('invoice' => 'desc'); // default order 

        $this->wherecondition = " where b.published ='yes' and a.published='yes' and b.type not in('estimate','sales_return')";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and s.tin !="" and s.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (s.tin ="" or s.tin is null) ';
            }
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and b.customer_id ="' . $this->input->post('customer_id') . '"';
        }
        $this->wherecondition = $this->wherecondition . ' GROUP by a.tax_id ';
    }

    function gst_wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->select = 'c.GST as gst,a.sales_id as sid,b.type as stype,ROUND(b.total*70/100) as invoicetotal,ROUND(ROUND((sum(a.total)*(70/100)),2)-ROUND(ROUND((sum(a.total)*(70/100)),2) - ROUND(((sum(a.total)*(70/100))*100),2)/(c.GST+100),2) ,2) as taxableamt,c.GST,ROUND((sum(a.total)*(70/100)),2) as TOTAL,b.sales_id,invoice,sum(a.total) as tot,invoice_date, ROUND(ROUND((sum(a.total)*(70/100)),2) - ROUND(((sum(a.total)*(70/100))*100),2)/(c.GST+100),2) as tax,s.name as name, s.tin as tin ';
        $this->table = 'sales as b INNER JOIN sales_items as a on b.sales_id=a.sales_id INNER JOIN taxgst as c on c.gstid=a.tax_id LEFT JOIN suppliers as s on s.id=b.customer_id   ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('b.invoice', 's.email', 's.phone', 's.name'); //set column field database for datatable searchable 
        $this->order = array('invoice' => 'desc'); // default order 

        $this->wherecondition = " where b.published ='yes' and a.published='yes' and b.type not in('estimate','sales_return')";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and s.tin !="" and s.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (s.tin ="" or s.tin is null) ';
            }
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and b.customer_id ="' . $this->input->post('customer_id') . '"';
        }
        $this->wherecondition = $this->wherecondition . ' GROUP by b.invoice,a.tax_id ';
    }

    function wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->select = 'case when st.StateID is null then "32-KERALA" else concat(st.code,"-",st.StateName) end as place,DATE_FORMAT(invoice_date, "%d-%b-%Y" ) as in_date,sum(itm_raw_ces) as item_cess,sum(case when b.saletype ="b2c" and b.cess > 0  then ces_amt else 0 end) as kfc ,b.total-sum(a.total) as tot,s.name,b.total as invoicetotal,b.invoice_date,s.tin,b.invoice,c.gst,sum(a.total) AS TOTAL,SUM(a.TAX) AS tax,SUM(a.total-a.tax) - sum(case when a.is_taxincluded ="1" then itm_raw_ces else itm_raw_ces end) - sum(case when a.is_taxincluded ="1" and b.saletype ="b2c" and b.cess > 0  then ces_amt else 0 end) AS taxableamt,a.sales_id as sid,b.type as stype';
        $this->table = 'sales_items as a INNER JOIN sales as b on a.sales_id=b.`sales_id` INNER JOIN taxgst as c on a.tax_id=c.gstid LEFT JOIN suppliers as s on s.id=b.customer_id  left join state as st on st.StateID = s.cst';
        $this->column_order = array(null, 'b.invoice','name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('b.invoice', 's.email', 's.phone', 's.name'); //set column field database for datatable searchable 
        $this->order = array('b.invoice_date' => 'desc'); // default order 
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
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and s.tin !="" and s.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (s.tin ="" or s.tin is null) ';
            }
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and b.customer_id ="' . $this->input->post('customer_id') . '"';
        }

        if ($this->input->post('taxwise') == "taxwise") {
            $this->wherecondition = $this->wherecondition . ' GROUP by a.tax_id ';
        } else {
            $this->wherecondition = $this->wherecondition . ' GROUP by b.invoice,a.tax_id ';
        }
    }

    function gstr2wherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->select = 'DATE_FORMAT(date, "%d/%m/%Y" ) as in_date,sum(itm_raw_ces) as item_cess,cur_exc_amt,b.total as invtot,sum(a.total) as tot,sum(a.tax) as tax,d.GST as GST,sum(a.total)-sum(a.tax) - sum(case when a.is_taxincluded ="1" then itm_raw_ces else 0 end) as beftax,b.invoice,b.date,c.name,c.tin,purchase_id,b.type as ptype';
        $this->table = 'purchase_items as a Left JOIN purchase as b on a.purchase_id=b.id left JOIN suppliers as c on c.id=b.supplier_id INNER JOIN taxgst as d on d.gstid=a.tax_id ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('b.invoice', 's.email', 's.phone', 's.name'); //set column field database for datatable searchable 
        $this->order = array('b.date' => 'desc'); // default order 

        $this->wherecondition = " where b.published ='yes' and a.published='yes' and b.type not in('order','porder') ";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and b.date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and b.date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            if ($this->input->post('type') == 'B2B') {
                $this->wherecondition = $this->wherecondition . ' and c.tin !="" and c.tin is not  null ';
            }
            if ($this->input->post('type') == 'B2C') {
                $this->wherecondition = $this->wherecondition . ' and (c.tin ="" or c.tin is null) ';
            }
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and b.supplier_id  ="' . $this->input->post('customer_id') . '"';
        }
        if ($this->input->post('tax')) {
            $this->wherecondition = $this->wherecondition . ' and a.tax_id  ="' . $this->input->post('tax') . '"';
        }
        $this->wherecondition = $this->wherecondition . '  GROUP by b.invoice,a.tax_id ';
    }

    function tyrwherecondition() {
        $type = $this->input->post('type');
        $name = $this->input->post('supname');
        //$this->select = 'a.type as stype, a.*,b.*';
        $this->table = 'tyr_sales as c inner join tyr_customer as a on a.id=c.customer_id ';
        $this->column_order = array(null, 'name', 'email', 'phone', 'address_line1'); //set column field database for datatable orderable
        $this->column_search = array('c.invoice', 'b.email', 'b.phone', 'b.name'); //set column field database for datatable searchable 
        $this->order = array('c.sales_id' => 'desc'); // default order 

        $this->wherecondition = " where c.published ='yes'";
        if ($this->input->post('startdate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date >="' . $this->getDate($this->input->post('startdate')) . '"';
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition = $this->wherecondition . ' and c.invoice_date <="' . $this->getDate($this->input->post('enddate')) . '"';
        }
        if ($this->input->post('type')) {
            $this->wherecondition = $this->wherecondition . ' and c.cash_type ="' . $this->input->post('type') . '"';
        }
        if ($this->input->post('supname')) {
            $this->wherecondition = $this->wherecondition . ' and c.customer_id ="' . $this->input->post('customer_id') . '"';
        }
    }

}
