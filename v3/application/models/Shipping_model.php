<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of shipping_model
 *
 * @author dimind
 */
class Shipping_model extends DataTable {

    function shippingledger() {
        $this->table = " tra_sales  as a left join tra_consignee as b on a.consignee = b.id left join tra_vessal as c on c.id=a.vessal left join tra_consigner as d on d.Id=a.consiner left join tra_vehicle as e on e.Id=a.vhno";
        $this->column_search = array('invoice');
        $this->column_order = array(null, 'sdate', 'invoice', 'con', 'container', 'crdtd_date', 'round', 'gtotal');
        $this->select = "e.Vehicle_num,c.name as vess,d.name as fact,b.address_line1 as dst, DATE_FORMAT(a.sdate,'%d-%m-%Y') as sdate,b.Name as con, a.*,b.*";
        $this->wherecondition = ' where  a.sdate BETWEEN "' . $this->getDate($this->input->post('startdate')) . '"';
        $this->wherecondition = $this->wherecondition . ' and "' . $this->getDate($this->input->post('enddate')) . '"';

        if ($this->input->post('toid')) {
            $this->wherecondition = $this->wherecondition . ' and  b.id ="' . $this->input->post('toid') . '"';
        }
        $this->db->select($this->select);
    }

    
    function transaction($id) {
        $res = $this->getLedgersSing($id, 'con'); 
        $qry = 'SELECT * FROM `acc_ledger_trans` as a  where  a.tran_date BETWEEN "' . $this->getDate($this->input->post('startdate')) . '"';
        $qry = $qry . ' and "' . $this->getDate($this->input->post('enddate')) . '"';
        $qry = $qry . ' and  tb_name ="voucher" and  ledger_id=' . $res;  
        $ress = $this->db->query($qry);
        return $ress->result_array();
    }

}
