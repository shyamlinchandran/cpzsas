<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind   
 */
class Payment extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Payment_model', 'Payment');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function listall() {
        $data['title'] = 'Payment';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/payment/list_all', $data);
    }

    function create() {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['title'] = 'Payment';
        $data['view'] = "create";
        $this->load->view('clinic/payment/create', $data);
    }

    function ledbal($id) {
        $data = $this->Payment->ledbalid($id);
        If ($data['id'] != "") {
            $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $data['id'], 'cl');
            if ($amt < 0) {
                echo round(($amt * -1), 2) . ' Cr';
            } else {
                echo $amt . ' Cr';
            }
        } else {
            echo 0;
        }
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Payment';
        $data['view'] = "create";
        $isinventory = $this->Payment->isinventory();
        $data['isinventory'] = $isinventory;
        $obsdate = $this->Payment->Obsdate($id);
        $data['obsdate'] = $obsdate;
        $details = $this->Payment->Details($id);
        $data['details'] = $details;
        $this->load->view('clinic/payment/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Payment';
        $data['view'] = "view";
        $obsdate = $this->Payment->Obsdate($id);
        $data['obsdate'] = $obsdate;
        $details = $this->Payment->Details($id);
        $data['details'] = $details;
        $this->load->view('clinic/payment/create', $data);
    }

    public function save() {
        $this->Payment->save();
    }

    function getsing($id) {
        $this->Payment->getsing($id);
    }

    public function ajax_list() {
        $this->Payment->where();
        $list = $this->Payment->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->Bok_Id;
            $row[] = $item->Pat_Name;
            $row[] = $item->Pat_Phone;
            $row[] = $item->Bok_Date;
            $act = '<a  href="' . base_url() . 'clinic/Payment/edit/' . $item->Bok_Id . '" title="Check" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->Payment->count_all(),
            "recordsFiltered" => $this->Payment->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function bill($id) {
        $this->generateBill($id);
    }

    private function generateBill($id) {

        //$this->load->view('transaction/sales/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        $size = 15;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->Payment->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $sale = $this->Payment->getSales($id);
        $tcnt = $this->Payment->getSalesItemscnt($id);
        $papersiize = $this->Payment->getValue('paper');
        if ($papersiize == 'A4') {
            $size = 38; //38
        }
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->Payment->getSalesItems($id, $len, $size);
            $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn);
        }
        //ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn) {
        if (count($list) != 0) {
            $pdf->setCellPaddings(0, 0, 0, 0);
            $papersiize = $this->Payment->getValue('paper');
            $paperorient = $this->Payment->getValue('paperorient');
            $pdf->AddPage($paperorient, $papersiize);
            $data['msd'] = $this->Show_Amount_In_Words($sale[0]['total']);
            $data['sales'] = $sale;
            $data['size'] = $size;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            if ($sale[0]['pub'] == 'no') {
                $img_file = base_url() . 'assets/images/cancelled.png';
                $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
            }
            $data['sales_items'] = $list;
            $data['company'] = $this->Payment->getCompany();
            $html = $this->Payment->view('transaction/sales/bill', $data, true);
            $pdf->writeHTML($html);
            // $pdf->Image($img_file, 110, 90, 40, 29);
        }
    }

}
