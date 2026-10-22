<?php
header("Access-Control-Allow-Origin: *");
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';

class Replacement extends REST_Controller {

    function __construct() {
        parent::__construct();

    }

    /**
     * Endpoint to save Replacement Voucher
     */
    public function save_replacement_post($comid) {
        
        $this->load->model('api/Main_model');

        $company_details = $this->Main_model->getcompany_details($comid);
        //database 
        $global_data['hostname'] = $company_details['sdb_server'];
        $global_data['username'] = $company_details['sdb_username'];
        $global_data['password'] = $company_details['sdb_password'];
        $global_data['database'] =  $company_details['sdb_name'];
        $global_data['isexcute'] = '1';
        $this->load->vars($global_data);

        	$this->load->model('Replace_items_model', 'replacement');
        // 1. Get the data. 
        // This handles both standard POST and JSON input (common in Mobile/API)
        $raw_input = file_get_contents('php://input');
        $Save_Mobile_data = json_decode($raw_input, true);

        // If it's not JSON, fall back to standard POST
        if (empty($Save_Mobile_data)) {
            $Save_Mobile_data = $this->input->post();
        }

        // 2. Validation (Basic)
        if (empty($Save_Mobile_data['customer_id']) || empty($Save_Mobile_data['id'])) {
            return $this->output
                ->set_content_type('application/json')
                ->set_status_header(400)
                ->set_output(json_encode([
                    'status' => false,
                    'message' => 'Missing required data: Customer or Items'
                ]));
        }

        try {
            // 3. Call the Model function we created earlier
            $result_id = $this->replacement->save_mobile_data($Save_Mobile_data);

            if ($result_id) {
                // 4. Return Success
                return $this->output
                    ->set_content_type('application/json')
                    ->set_status_header(200)
                    ->set_output(json_encode([
                        'status' => true,
                        'message' => 'Replacement Voucher saved successfully',
                        'voucher_id' => $result_id
                    ]));
            }
        } catch (Exception $e) {
            // 5. Handle Errors
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