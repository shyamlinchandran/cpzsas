<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Merge_model
 *
 * @author DELL
 */
class Merge_model extends DataTable {

    //put your code here
    public function __construct() {
        parent::__construct();
    }

    function product_merge() {
        $fromid = $this->input->post('fromid');
        $toid = $this->input->post('toid');
        if ($fromid == $toid) {
            return "Same Ledger";
        }
        $qry = 'update `item_ledger` set item_id =' . $toid . " where item_id = " . $fromid;
        $this->db->query($qry);

        $qry = 'update `purchase_items` set item_id =' . $toid . " where item_id =" . $fromid;
        $this->db->query($qry);


        $qry = 'update `sales_items` set item_id =' . $toid . " where item_id =" . $fromid;
        $this->db->query($qry);


        $qry = "UPDATE item_godown c INNER JOIN (SELECT SUM(`current_stock`) as total,`item_id`,d.godown_id FROM item_godown as d where d.item_id =" . $fromid . "  GROUP BY d.`item_id`,d.godown_id) as x on x.godown_id=c.godown_id and c.item_id=" . $toid . " set c.current_stock = c.current_stock+x.total";
        $this->db->query($qry);




        $qry = "UPDATE item_godown c INNER JOIN (SELECT SUM(`open_stock`) as total,`item_id`,d.godown_id FROM item_godown as d where d.item_id =" . $fromid . "  GROUP BY d.`item_id`,d.godown_id) as x on x.godown_id=c.godown_id and c.item_id=" . $toid . " set c.open_stock = c.open_stock+x.total";
        $this->db->query($qry);


        

        $qry = "delete from item_godown where item_id=".$fromid;
        $query = $this->db->query($qry);
        
         $qry = "delete from item where id=".$fromid;
        $query = $this->db->query($qry);
       



        return "Saved";
    }

    function merge() {
        $qry = "SELECT id, GROUP_CONCAT(id) gid,COUNT(id) as count FROM suppliers as a WHERE 1 GROUP by name having count(*)>1";
        $query = $this->db->query($qry);
        $res = $query->result_array();
        echo '<pre>';
        foreach ($res as $re) {
            echo '<br/>';
            $use = $re['id'];
            $gid = str_replace($re['id'] . ',', "", $re['gid']);
            $qry = "SELECT  id FROM acc_ledgers  WHERE ref_id  = $use and ref_code in('sup','cus')";
            $query = $this->db->query($qry);
            $led = $query->row_array();
            $ledid = $led['id'];
            $qry = 'update `acc_ledger_trans` set to_ledger_id =' . $ledid . " where to_ledger_id in( SELECT id FROM acc_ledgers  WHERE  ref_id in(" . $gid . ")and ref_code in('sup','cus'))";
            $this->db->query($qry);

            $qry = 'update `acc_ledger_trans` set ledger_id =' . $ledid . " where ledger_id in( SELECT id FROM acc_ledgers  WHERE  ref_id in(" . $gid . ")and ref_code in('sup','cus'))";
            $this->db->query($qry);

            $qry = "delete FROM acc_ledgers  WHERE ref_id  in( $gid )and ref_code in('sup','cus')";
            $query = $this->db->query($qry);

            $qry = "delete from suppliers  where id in ($gid)";
            $this->db->query($qry);

            $qry = 'update `sales` set customer_id =' . $use . ' where  customer_id in (' . $gid . ')';
            $this->db->query($qry);

            $qry = 'update `purchase` set supplier_id =' . $use . ' where  supplier_id in (' . $gid . ')';
            $this->db->query($qry);
        }
    }

    function mergeledger() {
        $gid = $this->input->post('fromid');
        $ledid = $this->input->post('toid');
        if ($gid == $ledid) {
            return "Same Ledger";
        }
        $qry = 'update `acc_ledger_trans` set to_ledger_id =' . $ledid . " where to_ledger_id = " . $gid;
        $this->db->query($qry);

        $qry = 'update `acc_ledger_trans` set ledger_id =' . $ledid . " where ledger_id =" . $gid;
        $this->db->query($qry);
        $qry = 'select openning_bal from acc_ledgers as m where  m.id=  ' . $gid;
        $row = $this->db->query($qry)->row_array();

        $qry = 'update `acc_ledgers` set openning_bal =openning_bal+' . $row['openning_bal'] . '  where id =' . $ledid;
        $this->db->query($qry);

        $qry = "delete FROM acc_ledgers  WHERE id =" . $gid;
        $query = $this->db->query($qry);


        $qry = 'update  voucher  set ledger =' . $ledid . '  where  ledger=' . $gid;
        $this->db->query($qry);

        $qry = 'update  voucher_trans  set voucher_id =' . $ledid . '  where  voucher_id=' . $gid;
        $this->db->query($qry);
        return "Saved";
    }

}
