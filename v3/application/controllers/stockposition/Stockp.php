<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */
class Stockp extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('stockpos_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function listall() {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('stockposition/list_all');
    }

    function delete($id) {
        $this->sales->delete($id);
    }

    function ledbal($id) {
        $data = $this->sales->ledbalid($id);
        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $data['id'], 'cl');
        if ($amt < 0) {
            echo round(($amt * -1), 2) . ' Cr';
        } else {
            echo $amt . ' Cr';
        }
    }

    function cancel($id) {
        $this->sales->cancel($id);
    }

    public function ajax_list() {
        $this->sales->where();
        $max = $this->sales->max();
        $max_id = $max['max_id'];
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
            
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->invoice_date;
            if ($vouchers->customer_id==0){
                 $row[] = $vouchers->cusname;
            }
            else{
                $row[] = $vouchers->name;
            }
           
            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                    . ' <a href="' . base_url() . 'transaction/sales/view/' . $vouchers->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
            $act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            if ($vouchers->sales_id == $max_id) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"  success="Delete ' . $vouchers->invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/delete/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            } else {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            }
            if ($vouchers->pub != 'yes') {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                        . ' <a href="' . base_url() . 'transaction/sales/view/' . $vouchers->sales_id . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
            }

            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all_sales(),
            "recordsFiltered" => $this->sales->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function stock($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('stockposition/stockpos', $data);
    }

    /* estimate start */

   
    public function view($id) {
        $data['id'] = $id;
        $data['type'] = 'View';
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/sales/view', $data);
    }

    public function save($type) {
        $this->sales->save($type);
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
        $com = $this->sales->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $sale = $this->sales->getSales($id);
        $tcnt = $this->sales->getSalesItemscnt($id);
        $hcnt = $this->sales->getHsnItemscnt($id); 
        $papersiize = $this->sales->getValue('paper'); 
        $hsn = $this->sales->getHsnItems($id);
        if ($papersiize == 'A4') {
            $size = 38;//38
        }
        $inc =($tcnt+$hcnt+1)  / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->sales->getSalesItems($id, $len, $size);
            $this->pages($pdf, $list, $sale, $img_file, $size, $len,$hsn);
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
            $html = $this->load->view('transaction/sales/bill', $data, true);
            $pdf->writeHTML($html);
            // $pdf->Image($img_file, 110, 90, 40, 29);
        }
    }

}
