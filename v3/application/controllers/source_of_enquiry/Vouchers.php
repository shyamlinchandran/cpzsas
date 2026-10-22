<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of vouchers
 *
 * @author u43255
 */
class Vouchers extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->database();
        $this->load->helper('url');
        $this->load->model('vouchers_model', 'vouchers');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function getLedegerbalance($id, $ls = 0) {
        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $id, 'cl', $ls);
        if ($amt < 0) {
            echo round(($amt * -1), 2) . ' Cr';
        } else {
            echo $amt . ' Cr';
        }
    }

    function delete($id) {
        $this->vouchers->delete($id);
    }

    public function alreadyexistcheck() {
        print_r($this->vouchers->alreadyexistcheck());
    }

    public function getnewinoviceno($type) {
        print_r($this->vouchers->getnewinoviceno($type));
    }

    function cancel($id) {
        $this->vouchers->cancel($id);
    }

    public function listall($type) {
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/vouchers/list_all', $data);
    }

    public function ajax_list() {
        $this->vouchers->where();
        $list = $this->vouchers->get_datatables();
        $max = $this->vouchers->max();
        $max_id = $max['max_id'];

        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            $no++;
            $row = array();
            $row[] = $no;
            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->invoice;
            } else {
                $row[] = $vouchers->voucher_no;
            }
            if ($vouchers->vourcher_type != "journal") {
                $row[] = $vouchers->naration;
            }
            $row[] = $vouchers->tran_date;
            $row[] = str_replace(',', '<br/>', $vouchers->names);
            $row[] = str_replace(';', '<br/>', $vouchers->credit_amounnts);
            $row[] = str_replace(';', '<br/>', $vouchers->debit_amounts);
            $act = '<a tp="pdf" href="' . base_url() . 'transaction/vouchers/bill/' . $vouchers->v_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/vouchers/' . $vouchers->vourcher_type . '/' . $vouchers->v_id . '/view" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/vouchers/' . $vouchers->vourcher_type . '/' . $vouchers->v_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';


            if ($vouchers->v_id == $max_id) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . 'transaction/vouchers/listall/' . $vouchers->vourcher_type . '" message="Do you want Delete ' . $vouchers->voucher_no . ' ?" success="Delete  ' . $vouchers->voucher_no . ' successfuly " href="' . base_url() . 'transaction/vouchers/delete/' . $vouchers->v_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            } else {
                $act = $act . ' <a  tp="confirm" base="' . base_url() . 'transaction/vouchers/listall/' . $vouchers->vourcher_type . '" message="Do you want Cancel ' . $vouchers->voucher_no . ' ?" success="Cancelled  ' . $vouchers->voucher_no . ' successfuly "   href="' . base_url() . 'transaction/vouchers/cancel/' . $vouchers->v_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            }

            if ($vouchers->pub == 'yes') {
                $row[] = $act; //$vouchers->naration;
            } else {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/vouchers/bill/' . $vouchers->v_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                        . ' <a href="' . base_url() . 'transaction/vouchers/' . $vouchers->vourcher_type . '/' . $vouchers->v_id . '/view" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                if ($vouchers->v_id == $max_id) {
                    $act = $act . ' <a tp="confirm" base="' . base_url() . 'transaction/vouchers/listall/' . $vouchers->vourcher_type . '" message="Do you want Delete ' . $vouchers->voucher_no . ' ?" success="Delete  ' . $vouchers->voucher_no . ' successfuly " href="' . base_url() . 'transaction/vouchers/delete/' . $vouchers->v_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
                }
                $row[] = $act . ' <span class="btn btn-warning">Cancelled<span>';
            }

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->vouchers->count_all(),
            "recordsFiltered" => $this->vouchers->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function payment($id = 0, $view = '') {
        $settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/vouchers/payment', $data);
    }

    public function receipt($id = 0, $view = '') {
        $settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/vouchers/receipt', $data);
    }

    public function contra($id = 0, $view = '') {
        $settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/vouchers/contra', $data);
    }

    public function journal($id = 0, $view = '') {
        $settings = $this->vouchers->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('transaction/vouchers/journal', $data);
    }

    public function save() {
        $response = $this->vouchers->save();
        echo json_encode($response);
    }

    public function savejournel() {
        $response = $this->vouchers->savejournel();
        echo json_encode($response);
    }

    public function savecontra() {
        $response = $this->vouchers->savecontra();
        echo json_encode($response);
    }

    public function searchcontra() {
        $text = strtolower($_GET['term']);
        $this->ledgers->searchcontra($text);
    }

    public function search($type, $ledid = 0) {
        $q = strtolower($_GET['term']);
        if (isset($_GET['term'])) {
            $q = strtolower($_GET['term']);
        }
        if (isset($_POST['term'])) {
            $q = strtolower($_POST['term']);
        }
        $this->ledgers->getautocomplete($q, $type, $ledid);
    }

    function getVoucher($id) {
        $sale = $this->vouchers->getvouchers($id);
        echo json_encode($sale);
    }

    function getJouVoucher($id) {
        $sale = $this->vouchers->getjouvouchers($id);
        echo json_encode($sale);
    }

    public function bill($id) {
        $this->generateBill($id);
    }

    private function generateBill($id) {

        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->vouchers->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->AddPage('L', 'A5');
        $sale = $this->vouchers->getvouchers($id);
        if ($sale[0]['pub'] == 'no') {
            $img_file = base_url() . 'assets/images/cancelled.png';
            $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
        }
        $data['msd'] = $this->Show_Amount_In_Words($sale[0]['amount']);
        $data['sales'] = $sale;
        $data['company'] = $com;
        $html = $this->load->view('transaction/vouchers/bill', $data, true);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

}
