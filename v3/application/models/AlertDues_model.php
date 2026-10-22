<?php

/**
 * AlertDues_model
 * Handles alert and dues records (stored in the `support` table, differentiated by `type`).
 */
class AlertDues_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->select         = ' a.*, b.name, b.com_id';
        $this->table          = 'support as a left join company as b on a.company = b.com_id';
        $this->table          = 'alert_dues as a left join company as b on a.company = b.com_id';
        $this->wherecondition = " where a.is_delete = 0";
        $this->column_search  = array('a.type', 'b.name', 'a.task', 'a.voucherno', 'a.ledger');
        $this->order          = array('a.id' => 'desc');
    }

    /**
     * Optional extra filter for DataTable (filter by tab type).
     */
    function where($type = '') {
        if (!empty($type) && in_array($type, array('alert', 'dues'))) {
            $this->wherecondition = " where a.is_delete = 0 and a.type = '" . $this->db->escape_str($type) . "'";
        }
    }

    function save() {
        $id         = $this->input->post('id');
        $company_id = $this->input->post('company_id');
        $type       = $this->input->post('type');

        $data = array(
            'company' => $company_id,
            'type'    => $type,
        );

        if ($type == 'alert') {
            $data['task']      = $this->input->post('task');
            $data['date']      = $this->input->post('date');
            $data['time']      = $this->input->post('time');
            $data['task_from'] = $this->input->post('task_from');
            $data['task_to']   = $this->input->post('task_to');
        } else if ($type == 'dues') {
            $data['voucherno'] = $this->input->post('voucherno');
            $data['ledger']    = $this->input->post('ledger');
            $data['remarks']   = $this->input->post('remarks');
            $data['amount']    = $this->input->post('amount');
            $data['duedate']   = $this->input->post('duedate');
            $data['time']      = $this->input->post('time');
        }

        if ($id > 0) {
            $this->db->where('id', $id);
            $this->db->update('alert_dues', $data);
        } else {
            $this->db->insert('alert_dues', $data);
        }

        $response = array(
            'valid'   => true,
            'type'    => 1,
            'message' => 'Saved Successfully.',
        );
        echo json_encode($response);
    }

    function getsing($id) {
        $qry    = "select * from alert_dues where id=" . (int)$id . " and is_delete = 0";
        $result = $this->db->query($qry);
        echo json_encode($result->result_array());
    }

    function getcompanies() {
        $qry    = "select com_id, name from company order by name asc";
        $result = $this->db->query($qry)->result_array();
        $html   = '<option value="">Select</option>';
        foreach ($result as $row) {
            $html .= '<option value="' . $row['com_id'] . '">' . $row['name'] . '</option>';
        }
        echo $html;
    }

    function delete($id) {
        $data = array('is_delete' => 1);
        $this->db->where('id', $id);
        $this->db->update('alert_dues', $data);
        $response = array(
            'valid'   => true,
            'type'    => 1,
            'message' => 'Deleted Successfully.',
        );
        echo json_encode($response);
    }

    function getbytype($type) {
        $company_id = $this->session->userdata('login_base_comid');
        $qry        = "select a.*, b.name from alert_dues a left join company b on a.company = b.com_id "
                    . "where a.type = '" . $this->db->escape_str($type) . "' and a.company = " . (int)$company_id
                    . " and a.is_delete = 0 order by a.id desc limit 5";
        $result     = $this->db->query($qry)->result_array();
        return $result;
    }

    public function get_ageing_dues($start_date = '', $end_date = '') {
        $this->db->select('a.*, l.name as ledger_name, IFNULL(s.narration, p.narration) as remarks, (a.debit + a.credit - a.paid) as balance');
        $this->db->from('acc_ageing a');
        $this->db->join('acc_ledgers l', 'a.led_id = l.id');
        $this->db->join('sales s', 'a.tb_id = s.sales_id AND a.tb_name = "sales"', 'left');
        $this->db->join('purchase p', 'a.tb_id = p.id AND a.tb_name = "purchase"', 'left');
        $this->db->where('(a.debit + a.credit - a.paid) > 0');
        
        if ($start_date != '') {
            $this->db->where('a.due_date >=', $start_date);
        }
        if ($end_date != '') {
            $this->db->where('a.due_date <=', $end_date);
        }
        
        $this->db->order_by('a.due_date', 'ASC');
        return $this->db->get()->result_array();
    }
}
