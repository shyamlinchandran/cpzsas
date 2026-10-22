<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Print
 *
 * @author jijodileep
 */
class Printoffline extends CI_Controller {

    public $language = 'ac';

    public function __construct() {
        parent::__construct();
        /* $this->load->model('sales_model', 'sales');
          $this->load->model('ledgers_model', 'ledgers'); */
        $this->load->model('print/Printoffline_model', 'Printoffline');
    }

    //put your code here


    public function getallprinters($key, $year) {
        $this->Printoffline->loaddb($key, $year);
        $this->Printoffline->getallbills();
    }

    public function getsingelpdf($key, $year, $id, $size, $co) {
        $this->Printoffline->loaddb($key, $year);
        $out = $this->Printoffline->getlanguage($size);
        $size = $out['pagesize'];
        $this->load->helper('lang_translate');
        if ($out['language'] == 'Arabic') {
            $this->lang->load('ac_site', 'ac');
            $this->language = "ac";
        } else {
            $this->lang->load('en_site', 'en');
            $this->language = "en";
        }

        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
        $this->bill($id, $size);
    }

    public function bill($id, $size) {
        $this->generateBill($id, $size);
    }

    function update($key, $year, $id) {
        $this->Printoffline->loaddb($key, $year);
        $this->Printoffline->update($id);
    }

    private function generateBill($id, $size) {
        //$bill_format = $this->sales->getformat($size);
        //  print_r($bill_format);
        $format = ''; // $bill_format['code'];
        //$size = $bill_format['pagesize'];
        $this->load->library('M_pdf');
        $pdf = $this->m_pdf->pdf;
        if ($this->language == 'ac') {
            $pdf->SetDirectionality('rtl');
        }
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => 'A4', 'margin_left' => 0, 'margin_right' => 0, 'margin_top' => 0, 'margin_bottom' => 0, 'margin_header' => 0, 'margin_footer' => 0];
        $sale = $this->sales->getSales($id);
        $amt = 0;
        if ($sale[0]['cash_type'] != 'Cash') {
            $ledb = $this->sales->ledbalid($sale[0]['id']);
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
        $tcnt = $this->sales->getSalesItemscnt($id);
        $hcnt = $this->sales->getHsnItemscnt($id); 
        $hsn = $this->sales->getHsnItems($id);
        $gst = $this->sales->getgstItems($id); 
        $img_file = '';
        $inc = ($tcnt + $hcnt + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->sales->getSalesItems($id, $len, $size);
            $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format);
        }
        $pdf->Output("uploads.pdf", "I");
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format) {
        if (count($list) != 0) {
            //$pdf->setCellPaddings(0, 0, 0, 0);
            $papersiize = $this->sales->getValue('paper');
            $paperorient = $this->sales->getValue('paperorient');
            $pdf->AddPage($paperorient, $papersiize);
            $img_file2 = base_url() . 'assets/images/15371797581022381971536753.png';
            // $pdf->Image($img_file2, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);

            $data['msd'] = $this->Show_Amount_In_Words($sale[0]['total']);
            $data['sales'] = $sale;
            $data['size'] = $size;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            $data['gst'] = $gst;
            if ($sale[0]['pub'] == 'no') {
                $img_file = base_url() . 'assets/images/cancelled.png';
                $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
            }
            $data['sales_items'] = $list;
            $data['company'] = $this->sales->getCompany();
            $html = $this->load->view('transaction/sales/bill1', $data, true);

//download it D save F.
            // $this->m_pdf->pdf->Output("./uploads/pdf/" . $filename, "");
            $pdf->writeHTML($html);
            // $pdf->Image($img_file, 110, 90, 40, 29);
        }
    }

    public function Show_Amount_In_Words($number) {

        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
        return $result . " Only";
    }

}
