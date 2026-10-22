<?php

defined('BASEPATH') or exit('No direct script access allowed');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Main extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('dims_main/Main_model', 'main');
    }

    //Email settings
    public function listEmailSettings()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/listAllEmailSettings');
    }

    public function listEmailType()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/listAllEmailType');
    }

    public function listEmail()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/listAllEmail');
    }

    public function listAllService()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/service/listAllService');
    }

    public function listAllCustomer()
    {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/customer/listAllCustomer');
    }

    public function getsing_emailtype($id)
    {
        $this->main->getsing_emailtype($id);
    }

    public function getsing_emailsetting($id)
    {
        $this->main->getsing_emailsetting($id);
    }

    public function getsing_email($id)
    {
        $this->main->getsing_email($id);
    }

    public function getsing_service($id)
    {
        $this->main->getsing_service($id);
    }

    public function getsing_customer($id)
    {
        $this->main->getsing_customer($id);
    }

    public function getEmailType()
    {
        $this->main->getEmailType();
    }

    public function getServices()
    {
        $this->main->getServices();
    }

    public function getCompany()
    {
        $this->main->getCompany();
    }

    public function bill($id)
    {
        $this->generateBill($id);
    }

    private function generateBill($id, $type = '')
    {

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $config = $this->main->getConfiguration($id);
        $com = $this->main->getCompany($config[0]['company']);
        $len = count($config);
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->AddPage('P', 'A4');
        $data['msd'] = $this->Show_Amount_In_Words($config[0]['total']);
        $data['config'] = $config;
        $data['com'] = $com;
        $data['len'] = $len;
        $html = $this->load->view('transaction/sales/bill_cust', $data, true);
        $pdf->writeHTML($html, true, false, false, false, '');
        ob_end_clean();
        $file = 'expiry_' . $id . '.pdf';
        $pdf->Output(FCPATH . 'uploads/bills/' . $file, 'F');
    }

    public function createEmailSettings($id = 0)
    {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/createEmailSettings', $data);
    }

    public function createEmailType($id = 0)
    {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/createEmailType', $data);
    }

    public function createEmail($id = 0)
    {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/email/createEmail', $data);
    }

    public function createService($id = 0)
    {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/service/createService', $data);
    }

    public function createCustomer($id = 0)
    {

        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('dims_main/customer/createCustomer', $data);
    }

    public function sendMail($id)
    {
        $mail = new PHPMailer(true);
        $emaildata = $this->main->getEmail(1);
        $e_message = '';
        $config = $this->main->getConfiguration($id);
        $com = $this->main->getCompany($config[0]['company']);
        $text = '';
        for ($i = 0; $i < count($config); $i++) {
            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
                $mail->isSMTP();                                            // Send using SMTP
                $mail->Host       = 'smtp.pepipost.com';                    // Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->Username   = 'althafmarahman';                     // SMTP username
                $mail->Password   = 'althafmarahman_5e09764f096b4d117bc0b1ee118656e7';                               // SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
                $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

                $mail->setFrom('althafmarahman@pepisandbox.com');
                $mail->addAddress('althafmarahman@gmail.com', 'Joe User');     // Add a recipient
                $mail->isHTML(true);

                $e_message = $emaildata['message'];
                $e_message = str_replace('#name#', $com['contact_person'], $e_message);
                $e_message = str_replace('#service#', $config[$i]['service_name'], $e_message);
                $e_message = str_replace('#enddate#', $config[$i]['enddate'], $e_message);
                $mail->Subject = 'Expiry Alert';
                $mail->Body    = $e_message;
                $filename = 'expiry_' . $id . '.pdf';
                $mail->AddAttachment(FCPATH . '/uploads/bills/' . $filename);
                $text = '';

                if ($mail->send()) {
                    print_r("Success");
                    $text = 'Mail Send Successfully';
                } else {
                    $text = 'something went wrong!!';
                }
            } catch (Exception $e) {
                print_r($mail->ErrorInfo);
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        $response = array(
            'result' => true,
            'message' => $text,
        );

        echo json_encode($response);
    }

    public function saveEmailSettings()
    {
        $this->main->saveEmailSettings();
    }

    public function saveEmailType()
    {
        $this->main->saveEmailType();
    }

    public function saveEmail()
    {
        $this->main->saveEmail();
    }

    public function saveService()
    {
        $this->main->saveService();
    }

    public function saveCustomer()
    {
        $id = $this->main->saveCustomer();
        $this->generateBill($id);
        $response = array(
            'result' => true,
            'message' => 'Saved Successfully',
        );
        echo json_encode($response);
    }

    public function customer_list()
    {
        $this->main->customer_list();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $customer) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $customer->company_name;
            $row[] = $customer->email;
            $row[] = number_format($customer->total, 2);
            $act = '<a  href="' . base_url() . 'dims_main/Main/createCustomer/' . $customer->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . '&nbsp;<a tp = "pdf" href="' . base_url() . 'dims_main/Main/bill/' . $customer->id . '" title="Edit" data-toggle="tooltip" class="btn btn-info"><span class="glyphicon glyphicon-print"></span></a>';
            $act = $act . '&nbsp;<a tp="confirm" base = "' . base_url() . 'dims_main/Main/listAllCustomer" success="Successfully mailed to ' . $customer->email . '" message="Do you want to send Mail to ' . $customer->email . '?" href="' . base_url() . 'dims_main/Main/sendMail/' . $customer->id . '" title="Mail" data-toggle="tooltip" class="btn btn-warning"><span class="glyphicon glyphicon-envelope"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function service_list()
    {
        $this->main->service_list();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $service) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $service->service;
            $act = '<a  href="' . base_url() . 'dims_main/Main/createService/' . $service->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';

            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function email_list()
    {
        $this->main->email_list();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $email) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $email->types;
            $row[] = $email->message;
            $act = '<a  href="' . base_url() . 'dims_main/Main/createEmail/' . $email->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function email_type_list()
    {
        $this->main->email_type();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $email_type) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $email_type->type;
            $act = '<a  href="' . base_url() . 'dims_main/Main/createEmailType/' . $email_type->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function email_settings_list()
    {
        // $this->main->where();
        $list = $this->main->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $email_settings) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $email_settings->smtp_host;
            $row[] = $email_settings->smtp_username;
            $row[] = $email_settings->smtp_port;
            $row[] = $email_settings->from_address;
            $act = '<a  href="' . base_url() . 'dims_main/Main/createEmailSettings/' . $email_settings->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;

            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->main->count_all(),
            "recordsFiltered" => $this->main->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
}
