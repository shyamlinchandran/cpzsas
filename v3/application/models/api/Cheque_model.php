<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH . 'models/dataTable.php');

/**
 * Cheque_model
 * Handles cheque CRUD operations for the REST API
 */
class Cheque_model extends DataTable {

    public function __construct() {
        parent::__construct();
        $this->table = "chqdetails";
    }

    /**
     * Save or update cheque details from REST API
     * 
     * @param array $Save_Mobile_data
     * @return int Inserted or updated Cheque ID
     */
    public function save_cheque_data($Save_Mobile_data) {
        $chq_id        = isset($Save_Mobile_data['chq_id']) ? (float)$Save_Mobile_data['chq_id'] : 0;
        $chq_trans     = isset($Save_Mobile_data['chq_trans']) ? $Save_Mobile_data['chq_trans'] : '';
        $collected_by  = isset($Save_Mobile_data['collected_by']) ? $Save_Mobile_data['collected_by'] : '';
        $chq_date      = $this->getDate(isset($Save_Mobile_data['chq_date']) ? $Save_Mobile_data['chq_date'] : date('Y-m-d'));
        $Check_number  = isset($Save_Mobile_data['chq_no']) ? $Save_Mobile_data['chq_no'] : '';
        $chq_frm       = isset($Save_Mobile_data['chq_frm']) ? $Save_Mobile_data['chq_frm'] : 0;
        $chq_amount    = isset($Save_Mobile_data['chq_amount']) ? $Save_Mobile_data['chq_amount'] : 0;
        $chq_bank      = isset($Save_Mobile_data['chq_bank']) ? $Save_Mobile_data['chq_bank'] : '';
        $Check_To      = isset($Save_Mobile_data['chq_to']) ? $Save_Mobile_data['chq_to'] : 0;
        $branch        = isset($Save_Mobile_data['branch']) ? $Save_Mobile_data['branch'] : 0;
        $Check_Details = isset($Save_Mobile_data['chq_details']) ? $Save_Mobile_data['chq_details'] : '';

        $data = array(
            'chq_trans'    => $chq_trans,
            'chq_date'     => $chq_date,
            'chq_no'       => $Check_number,
            'collected_by' => $collected_by,
            'branch_id'    => $branch,
            'chq_amount'   => $chq_amount,
            'chq_bank'     => $chq_bank,
            'chq_status'   => 'Submitted',
            'chq_frm'      => $chq_frm,
            'chq_to'       => $Check_To,
            'chq_sdate'    => $chq_date,
            'chq_details'  => $Check_Details
        );

        if ($chq_id == 0) {
            $this->db->insert('chqdetails', $data);
            return $this->db->insert_id();
        } else {
            $this->db->where('chq_id', $chq_id);
            $this->db->update('chqdetails', $data);
            return $chq_id;
        }
    }
}
