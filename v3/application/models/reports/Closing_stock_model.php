<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once(APPPATH . 'models/dataTable.php');

class Closing_stock_model extends DataTable {
    private $end_date = '2030-01-01';

    public function __construct() {
        parent::__construct();
        $this->_table = 'item';
        
        $this->select = 'x.id, x.name as itemname, x.barcode, x.open as open_qty, x.op_rate as open_rate, (x.open * x.op_rate) as opening_stock_value, x.stock as running_qty, x.p_rate as purchase_rate, (x.stock * x.p_rate) as running_stock_value, (x.open * x.op_rate) + (x.stock * x.p_rate) as total_closing_value';
        
        $this->column_order = array(null, 'x.name');
        $this->column_search = array('x.name', 'x.barcode');
        $this->order = array('x.name' => 'asc');
        $this->wherecondition = "";
        
        // Initialize with default date
        $this->set_end_date('2030-01-01');
    }

    public function set_end_date($end_date) {
        $this->end_date = $end_date;
        
        // Exact query string requested by the user
        $this->table = "
            (
                SELECT 
                    CASE WHEN i.open_stk_rate > 0 THEN i.open_stk_rate ELSE i.prate END AS op_rate,
                    CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END AS p_rate,
                    i.id,
                    CASE WHEN i.prate IS NOT NULL AND i.prate > 0 THEN i.prate ELSE i.open_stk_rate END AS open_stk_rate,
                    IFNULL(det.stock, 0) AS stock,
                    i.prate,
                    IFNULL(g.open, 0) AS open,
                    i.name,
                    i.barcode,
                    i.item_category_id,
                    i.brand_id
                FROM item AS i 
                LEFT JOIN (
                    SELECT SUM(ig.open_stock) AS open, ig.item_id 
                    FROM item_godown AS ig 
                    GROUP BY ig.item_id
                ) AS g ON g.item_id = i.id 
                LEFT JOIN (
                    SELECT 
                        x.*,
                        ROUND(AVG(CASE WHEN iled.trans_date = x.date AND iled.trans_status ='purchase' AND iled.trans_type ='dt' THEN iled.rate ELSE NULL END), 2) AS rate,
                        ROUND(AVG(CASE WHEN iled.trans_date = x.date AND iled.trans_status ='purchase' AND iled.trans_type ='dt' THEN iled.mrp ELSE NULL END), 2) AS mrp,
                        iled.trans_date 
                    FROM item_ledger AS iled 
                    INNER JOIN (
                        SELECT 
                            SUM(CASE WHEN il.trans_date <= " . $this->db->escape($this->end_date) . " AND il.trans_type ='dt' THEN il.quantity ELSE 0 END) - 
                            SUM(CASE WHEN il.trans_date <= " . $this->db->escape($this->end_date) . " AND il.trans_type ='cr' then il.quantity ELSE 0 END) AS Stock, 
                            CASE 
                                WHEN (MAX(CASE WHEN il.trans_date <= " . $this->db->escape($this->end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '0000-00-00' END)) LIKE '%0000-00-00%' 
                                THEN MAX(CASE WHEN il.trans_date <= " . $this->db->escape($this->end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '0000-00-00' END) 
                                ELSE MAX(CASE WHEN il.trans_date <= " . $this->db->escape($this->end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '2050-03-11' END) 
                            END AS date,
                            item_id 
                        FROM item_ledger AS il 
                        WHERE il.published ='yes' 
                        GROUP BY il.item_id
                    ) AS x ON iled.item_id = x.item_id AND iled.published ='yes' 
                    GROUP BY iled.item_id, x.date 
                ) AS det ON det.item_id = i.id 
                WHERE i.published ='yes'
            ) as x
        ";
    }

    public function where() {
        $this->wherecondition = "where 1=1";
        if ($this->input->post('toid')) {
            $this->wherecondition .= ' and x.id = ' . $this->db->escape($this->input->post('toid'));
        }
        if ($this->input->post('category')) {
            $this->wherecondition .= ' and x.item_category_id = ' . $this->db->escape($this->input->post('category'));
        }
        if ($this->input->post('brand')) {
            $this->wherecondition .= ' and x.brand_id = ' . $this->db->escape($this->input->post('brand'));
        }
    }

    public function get_overall_opening_value($start_date) {
        $qry = "
            SELECT 
                SUM(x.open) as total_open_qty,
                SUM(x.open * x.op_rate) as total_open_value
            FROM (
                SELECT 
                    CASE WHEN i.open_stk_rate > 0 THEN i.open_stk_rate ELSE i.prate END AS op_rate,
                    IFNULL(g.open, 0) as open
                FROM item as i
                LEFT JOIN (
                    SELECT SUM(ig.open_stock) as open, ig.item_id 
                    FROM item_godown as ig 
                    GROUP BY ig.item_id
                ) as g ON g.item_id = i.id
                WHERE i.published = 'yes'
            ) as x
        ";
        
        return $this->db->query($qry)->row_array();
    }

    public function get_overall_closing_value($end_date) {
        $qry = "
            SELECT 
                SUM(x.open) as total_open_qty,
                SUM(x.open * x.op_rate) as total_open_value,
                SUM(x.stock) as total_running_qty,
                SUM(x.stock * x.p_rate) as total_running_value,
                SUM(x.open * x.op_rate) + SUM(x.stock * x.p_rate) as closing 
            FROM (
                SELECT 
                    CASE WHEN i.open_stk_rate > 0 THEN i.open_stk_rate ELSE i.prate END AS op_rate,
                    CASE WHEN i.prate > 0 THEN i.prate ELSE i.open_stk_rate END AS p_rate,
                    IFNULL(g.open, 0) as open,
                    IFNULL(det.stock, 0) as stock
                FROM item as i
                LEFT JOIN (
                    SELECT SUM(ig.open_stock) as open, ig.item_id 
                    FROM item_godown as ig 
                    GROUP BY ig.item_id
                ) as g ON g.item_id = i.id
                LEFT JOIN (
                    SELECT 
                        x.*,
                        ROUND(AVG(CASE WHEN iled.trans_date = x.date AND iled.trans_status ='purchase' AND iled.trans_type ='dt' THEN iled.rate ELSE NULL END), 2) AS rate,
                        ROUND(AVG(CASE WHEN iled.trans_date = x.date AND iled.trans_status ='purchase' AND iled.trans_type ='dt' THEN iled.mrp ELSE NULL END), 2) AS mrp,
                        iled.trans_date 
                    FROM item_ledger AS iled 
                    INNER JOIN (
                        SELECT 
                            SUM(CASE WHEN il.trans_date <= " . $this->db->escape($end_date) . " AND il.trans_type ='dt' THEN il.quantity ELSE 0 END) - 
                            SUM(CASE WHEN il.trans_date <= " . $this->db->escape($end_date) . " AND il.trans_type ='cr' then il.quantity ELSE 0 END) AS Stock, 
                            CASE 
                                WHEN (MAX(CASE WHEN il.trans_date <= " . $this->db->escape($end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '0000-00-00' END)) LIKE '%0000-00-00%' 
                                THEN MAX(CASE WHEN il.trans_date <= " . $this->db->escape($end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '0000-00-00' END) 
                                ELSE MAX(CASE WHEN il.trans_date <= " . $this->db->escape($end_date) . " AND il.trans_type ='dt' AND il.trans_status='purchase' THEN il.trans_date ELSE '2050-03-11' END) 
END AS date,
                            item_id 
                        FROM item_ledger AS il 
                        WHERE il.published ='yes' 
                        GROUP BY il.item_id
                    ) AS x ON iled.item_id = x.item_id AND iled.published ='yes' 
                    GROUP BY iled.item_id, x.date 
                ) AS det ON det.item_id = i.id 
                WHERE i.published ='yes'
            ) as x
        ";
        
        return $this->db->query($qry)->row_array();
    }
}
