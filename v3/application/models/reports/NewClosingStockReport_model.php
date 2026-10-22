<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'models/dataTable.php');

class NewClosingStockReport_model extends DataTable {

    public function __construct() {
        parent::__construct();
    }

    public function parse_date($date) {
        if (empty($date)) {
            return date('Y-m-d');
        }
        if (strpos($date, '/') !== false) {
            $parts = explode('/', $date);
            if (count($parts) == 3) {
                return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
            }
        } else if (strpos($date, '-') !== false) {
            $parts = explode('-', $date);
            if (count($parts) == 3) {
                if (strlen($parts[0]) == 4) {
                    return $date;
                } else {
                    return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
                }
            }
        }
        return $date;
    }

    public function get_closing_stock_data($date = '', $stock_type = 'with_stock') {
        $end = $this->parse_date($date);

        $where_stock = "";
        if ($stock_type != 'all') {
            $where_stock = " AND ROUND(
                (IFNULL(ig.open_stock, 0) * IFNULL(i.open_stk_rate, 0)) +
                (IFNULL(il.tran_stock, 0) * CASE WHEN i.prate IS NOT NULL AND i.prate > 0 THEN i.prate ELSE IFNULL(i.open_stk_rate, 0) END), 2
            ) != 0";
        }

        $qry = "SELECT 
                    i.id AS item_id,
                    i.barcode,
                    i.name AS item_name,
                    IFNULL(g_all.godown_id, 0) AS godown_id,
                    IFNULL(img.godown_name, 'Main Godown') AS godown_name,
                    ROUND(IFNULL(ig.open_stock, 0) + IFNULL(il.tran_stock, 0), 2) AS closing_stock_qty,
                    CASE 
                        WHEN (IFNULL(ig.open_stock, 0) + IFNULL(il.tran_stock, 0)) != 0 THEN
                            ROUND(
                                (
                                    (IFNULL(ig.open_stock, 0) * IFNULL(i.open_stk_rate, 0)) +
                                    (IFNULL(il.tran_stock, 0) * CASE WHEN i.prate IS NOT NULL AND i.prate > 0 THEN i.prate ELSE IFNULL(i.open_stk_rate, 0) END)
                                ) / (IFNULL(ig.open_stock, 0) + IFNULL(il.tran_stock, 0)), 2
                            )
                        ELSE
                            ROUND(CASE WHEN i.prate IS NOT NULL AND i.prate > 0 THEN i.prate ELSE IFNULL(i.open_stk_rate, 0) END, 2)
                    END AS closing_stock_rate,
                    ROUND(
                        (IFNULL(ig.open_stock, 0) * IFNULL(i.open_stk_rate, 0)) +
                        (IFNULL(il.tran_stock, 0) * CASE WHEN i.prate IS NOT NULL AND i.prate > 0 THEN i.prate ELSE IFNULL(i.open_stk_rate, 0) END), 2
                    ) AS closing_stock_value
                FROM item AS i
                INNER JOIN (
                    SELECT item_id, godown_id FROM item_godown
                    UNION
                    SELECT item_id, godown AS godown_id FROM item_ledger WHERE published = 'yes' AND trans_date <= '".$end."'
                ) AS g_all ON g_all.item_id = i.id
                LEFT JOIN ims_godown AS img ON img.id = g_all.godown_id
                LEFT JOIN (
                    SELECT item_id, godown_id, SUM(open_stock) AS open_stock 
                    FROM item_godown 
                    GROUP BY item_id, godown_id
                ) AS ig ON ig.item_id = g_all.item_id AND ig.godown_id = g_all.godown_id
                LEFT JOIN (
                    SELECT 
                        item_id,
                        godown AS godown_id,
                        SUM(CASE WHEN trans_type = 'dt' THEN quantity ELSE -quantity END) AS tran_stock
                    FROM item_ledger
                    WHERE published = 'yes' 
                      AND trans_date <= '".$end."'
                    GROUP BY item_id, godown
                ) AS il ON il.item_id = g_all.item_id AND il.godown_id = g_all.godown_id
                WHERE i.published = 'yes'
                  " . $where_stock . "
                ORDER BY img.godown_name ASC, i.name ASC";

        return $this->db->query($qry)->result_array();
    }
}
