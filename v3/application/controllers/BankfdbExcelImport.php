<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class BankfdbExcelImport extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('excel');
        $this->load->model('BankfdbExcelImport_model', 'excel_import');
    }

    public function index() {
        $data['title'] = 'Import Bank Excel Vouchers (Receipt / Payment)';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('vouchers/bankfdb_excel_import', $data);
    }

    public function upload_and_preview() {
        $response = array('status' => 'error', 'message' => 'Failed to upload file.');

        if (!isset($_FILES['excel_file']['name']) || empty($_FILES['excel_file']['name'])) {
            $response['message'] = 'Please choose an Excel file to upload.';
            echo json_encode($response);
            return;
        }

        $uploadPath = FCPATH . 'uploads/excel/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        $config['upload_path'] = $uploadPath;
        $config['allowed_types'] = 'xls|xlsx|csv';
        $config['max_size'] = '10240';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('excel_file')) {
            $response['message'] = strip_tags($this->upload->display_errors());
            echo json_encode($response);
            return;
        }

        $uploadData = $this->upload->data();
        $filePath = $uploadData['full_path'];

        try {
            $parsedRows = $this->excel_import->parse_excel_file($filePath);
            @unlink($filePath); // Clean up temp file

            if (empty($parsedRows)) {
                $response['message'] = 'No valid data rows found in the Excel file.';
            } else {
                $response['status'] = 'success';
                $response['rows'] = $parsedRows;
                $response['total_count'] = count($parsedRows);
            }
        } catch (Exception $e) {
            @unlink($filePath);
            $response['message'] = 'Error reading Excel file: ' . $e->getMessage();
        }

        echo json_encode($response);
    }

    public function execute_import() {
        $response = array('status' => 'error', 'message' => 'No data provided.');
        $postData = json_decode($this->input->post('rows_json'), true);

        if (empty($postData) || !is_array($postData)) {
            $response['message'] = 'Invalid or empty voucher data.';
            echo json_encode($response);
            return;
        }

        $result = $this->excel_import->process_import($postData);

        $response['status'] = 'success';
        $response['message'] = "Import completed! Successfully created {$result['success']} vouchers. (Failed: {$result['errors']})";
        $response['result'] = $result;

        echo json_encode($response);
    }
}
