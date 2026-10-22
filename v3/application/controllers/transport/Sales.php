<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author jijodileep
 */
class Sales extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Trasportsales_model', 'trasport');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transport/sales/list_all');
    }

    function email($id) {
        $this->load->view('_blocks/subpages/create');
        $data['sales'] = '';
        $this->load->view('transport/sales/email', $data);
    }

    public function do_upload() {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 1000;
        // $config['max_width'] = 1024;
        // $config['max_height'] = 768;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('transport/sales/email', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('transport/sales/email_success', $data);
        }
        if (isset($_FILES['files']) && !empty($_FILES['files'])) {
            $no_files = count($_FILES["files"]['name']);
            for ($i = 0; $i < $no_files; $i++) {
                if ($_FILES["files"]["error"][$i] > 0) {
                    echo "Error: " . $_FILES["files"]["error"][$i] . "<br>";
                } else {
                    if (file_exists('./upload/' . $_FILES["files"]["name"][$i])) {
                        echo 'File already exists : ./upload/' . $_FILES["files"]["name"][$i];
                    } else {
                        move_uploaded_file($_FILES["files"]["tmp_name"][$i], './upload/' . $_FILES["files"]["name"][$i]);
                        echo 'File successfully uploaded : ./upload/' . $_FILES['files']['name'][$i] . ' ';
                    }
                }
            }
        } else {
            echo 'Please choose at least one file';
        }
    }

    public function ajax_list() {
        $this->trasport->where();
        $list = $this->trasport->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->container;
            $row[] = $vouchers->sdate;
            $row[] = $vouchers->rdate;
            $row[] = $vouchers->Name;
            $row[] = $vouchers->gtotal;

            $act = '<a tp="pdf" href="' . base_url() . 'transport/sales/generateBill/' . $vouchers->pid . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'transport/transaction/sales/' . $vouchers->pid . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a  href="' . base_url() . 'transport/sales/email/' . $vouchers->pid . '" data-toggle="tooltip" title="Email" class="btn btn-primary"><span class="glyphicon glyphicon-envelope"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trasport->count_all(),
            "recordsFiltered" => $this->trasport->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    function generateBills($id) {
        $res = $this->trasport->getsalesing($id);
        print_r($res);
    }

    function array_find_deep($array, $matching) {
        foreach ($array as $item) {
            if ($item['txtname'] == $matching)
                return $item['value'];
        }

        return false;
    }

    function generateBill($id) {
        $data['company'] = $this->trasport->getCompany();
        $this->load->library('Pdf');
        $res = $this->trasport->getsalesing($id);
        $data['salse'] = $res;
        $data['consiner'] = $this->trasport->consiner($res['consiner']);
        $data['Consignee'] = $this->trasport->Consignee($res['consignee']);
        $data['oc'] = $this->trasport->oc($id);
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();
        $html = $this->load->view('transport/sales/bill', $data, true);
        $img_file = ''; // base_url() . 'assets/images/goodwill.jpg';
        //$pdf->Image($img_file, 0, 0, 0, 0, '', '', '', false, '', '', false, false, 0);
        $pdf->writeHTML($html);
        //ob_end_clean();
        $pdf->Output();
        /*  $html =;print_r($html);
          $pdf->writeHTML($html);
          ob_end_clean();
          $pdf->Output('example_021.pdf', 'I'); */
    }

}
