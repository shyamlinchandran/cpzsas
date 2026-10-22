<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Item_expiry_report_model extends DataTable {

    function __construct() {
        parent::__construct();
    }

    function where() {
        $today = date('Y-m-d');
        $this->select = "i.name as itemname, i.barcode, ig.batch, ig.expiry_date, DATEDIFF(ig.expiry_date, '$today') as remaining_days, g.godown_name, ig.current_stock";
        $this->table = "item_godown as ig INNER JOIN item as i ON  ig.open_stock + ig.current_stock > 0 and  i.id = ig.item_id  and ig.expiry_date IS NOT NULL AND ig.expiry_date  NOT LIKE'%0000%'  AND ig.expiry_date >= '2026-04-01' LEFT JOIN ims_godown as g ON g.id = ig.godown_id";
        
        $this->column_order = array(null, 'i.name', 'i.barcode', 'ig.batch', 'ig.expiry_date', 'remaining_days', 'g.godown_name', 'ig.current_stock');
        $this->column_search = array('i.name', 'i.barcode', 'ig.batch', 'g.godown_name');
        $this->order = array('ig.expiry_date' => 'asc');

        $this->wherecondition = " where i.published = 'yes' and ig.expiry_date is not null and ig.expiry_date != '0000-00-00' ";

        $expiry_filter = $this->input->post('expiry_filter');
        if ($expiry_filter) {
            if ($expiry_filter == 'expired') {
                $this->wherecondition .= " and ig.expiry_date < '$today' ";
            } else if ($expiry_filter == '1week') {
                $this->wherecondition .= " and DATEDIFF(ig.expiry_date, '$today') BETWEEN 0 AND 7 ";
            } else if ($expiry_filter == '2weeks') {
                $this->wherecondition .= " and DATEDIFF(ig.expiry_date, '$today') BETWEEN 0 AND 14 ";
            } else if ($expiry_filter == '1month') {
                $this->wherecondition .= " and DATEDIFF(ig.expiry_date, '$today') BETWEEN 0 AND 30 ";
            }
        }

        if ($this->input->post('startdate')) {
            $this->wherecondition .= " and ig.expiry_date >= '" . $this->getDate($this->input->post('startdate')) . "'";
        }
        if ($this->input->post('enddate')) {
            $this->wherecondition .= " and ig.expiry_date <= '" . $this->getDate($this->input->post('enddate')) . "'";
        }
        if ($this->input->post('toid')) {
            $this->wherecondition .= " and i.id = '" . $this->input->post('toid') . "'";
        }
        if ($this->input->post('godown')) {
            $this->wherecondition .= " and ig.godown_id = '" . $this->input->post('godown') . "'";
        }
    }
}
