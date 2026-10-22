<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Trans
 *
 * @author u43255
 */
class Trans extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('trans_model', 'trans');
    }

    public function listall() {
        $this->load->view('_blocks/subpages/list');
        $this->load->view('tai/trans/list_all');
    }

    public function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['id'] = $id;
        $size = $this->trans->size();  // loading from data base 
        $data['size'] = $size;
        $this->load->view('tai/trans/create', $data);
    }

    function getSales($id) {
        $this->trans->getSales($id);
    }

    function getSalesItems($id) {
        $this->trans->getSalesItems($id);
    }

    function msmentsingle($cust, $type) {
        $this->trans->msmentsingle($cust, $type);
    }

    function save() {
        $this->trans->save();
    }

    public function items() {
        $search = strtolower($_GET['term']);
        $this->trans->items($search);
    }

    public function cust() {
        $search = strtolower($_GET['term']);
        $this->trans->cust($search);
    }

    public function ajax_list() {

        $list = $this->trans->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $trans) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $trans->name . '-' . $trans->phone;
            $row[] = $trans->invoice;
            $row[] = $trans->date;
            $row[] = $trans->ddate . '-' . $trans->dtime;
            // $row[] = $vouchers->tax;
            $row[] = $trans->total;
            $act = '<a tp="pdf" href="' . base_url() . 'tai/trans/bill/' . $trans->tms_id . '/full" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'tai/trans/create/' . $trans->tms_id . '" data-toggle="tooltip" title="Edit" class="btn btn-info "><span class="glyphicon glyphicon-edit"></span></a>';
//            $act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
//            if ($vouchers->sales_id == $max_id) {
//                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"  success="Delete ' . $vouchers->invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/delete/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
//            } else {
//                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
//            }
//            if ($vouchers->pub != 'yes') {
//                $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
//                        . ' <a href="' . base_url() . 'transaction/sales/view/' . $vouchers->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
//                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
//            }

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->trans->count_all(),
            "recordsFiltered" => $this->trans->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function bill($id, $size) {
        $this->generateBill($id, $size);
    }

    private function generateBill($id, $size) {

        //$this->load->view('transaction/sales/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        // $size = 15;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->trans->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $sale = $this->trans->getSales($id); 
        $amt = 0; 
        if ($sale[0]['cash_type'] != 'Cash') {
            $ledb = $this->trans->ledbalid($sale[0]['thacu_id']); 
            if ($ledb['id'] != "") {
                $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
            }
        }
        if ($amt < 0) {
            $amt = round(($amt * -1), 2);
        } else {
            $amt = $amt;
        }

        $amt = $amt + $sale[0]['total'];
        $sale[0]['gtot'] = $amt;
        $tcnt = $this->trans->getSalesItemscnt($id);
        //$hcnt = $this->trans->getHsnItemscnt($id);
        $papersiize = $this->sales->getValue('paper');
        //$hsn = $this->sales->getHsnItems($id);
        if ($papersiize == 'A4') {
            if ($size == 'half') {
                $size = 8;
            }
            if ($size == 'full') {
                $size = 38;
            }
        }

        $inc = ($tcnt + $hcnt + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->sales->getSalesItems($id, $len, $size);
            $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn);
        }
        //ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn) {
        if (count($list) != 0) {
            $pdf->setCellPaddings(0, 0, 0, 0);
            $papersiize = $this->sales->getValue('paper');
            $paperorient = $this->sales->getValue('paperorient');
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
            $data['company'] = $this->sales->getCompany();
            $html = $this->load->view('tai/trans/bill', $data, true);
            $pdf->writeHTML($html);
            // $pdf->Image($img_file, 110, 90, 40, 29);
        }
    }

}
