<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

/**
 * Cheque REST API Controller
 * Provides endpoints to manage cheque details via REST API
 */
class Cheque extends REST_Controller {

    function __construct() {
        parent::__construct();
    }

    /**
     * Endpoint to save or update Cheque Details
     * POST /restapi/cheque/save_cheque/<comid>
     */
    public function save_cheque_post($comid) {
        
        $this->load->model('api/Main_model');

        // Dynamic database switching configuration
        $company_details = $this->Main_model->getcompany_details($comid);
        $global_data['hostname'] = $company_details['sdb_server'];
        $global_data['username'] = $company_details['sdb_username'];
        $global_data['password'] = $company_details['sdb_password'];
        $global_data['database'] = $company_details['sdb_name'];
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);

        // Load the API model which will automatically switch connections in parent constructor (DataTable)
        $this->load->model('api/Cheque_model', 'cheque_model');

        // Get the POST/JSON input data
        $raw_input = file_get_contents('php://input');
        $Save_Mobile_data = json_decode($raw_input, true);

        if (empty($Save_Mobile_data)) {
            $Save_Mobile_data = $this->input->post();
        }

        // Basic Validation
        if (
            empty($Save_Mobile_data['branch']) || 
            empty($Save_Mobile_data['chq_trans']) || 
            empty($Save_Mobile_data['chq_no']) || 
            empty($Save_Mobile_data['chq_amount']) ||
            empty($Save_Mobile_data['chq_bank'])
        ) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Missing required data: branch, chq_trans, chq_no, chq_amount, or chq_bank'
                ]));
        }

        try {
            // Save cheque details using model
            $result_id = $this->cheque_model->save_cheque_data($Save_Mobile_data);

            if ($result_id) {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode([
                        'status' => true,
                        'message' => 'Cheque saved successfully',
                        'cheque_id' => $result_id
                    ]));
            } else {
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(500)
                    ->set_output(json_encode([
                        'status' => false,
                        'message' => 'Failed to save cheque details'
                    ]));
            }
        } catch (Exception $e) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(500)
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Database Error: ' . $e->getMessage()
                ]));
        }
    }
}
