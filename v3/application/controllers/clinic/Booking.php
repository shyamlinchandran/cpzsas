<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Booking extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clinic/Booking_model', 'booking');
        $this->config->load('config');
    }

    public function listall() {
        $data['title'] = 'booking';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('clinic/booking/list_all', $data);
    }

    function create() {
        $date = $this->input->get('date');
        $time = $this->input->get('time');
        $cus_id = $this->input->get('cus_id');
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['title'] = 'booking';
        $data['view'] = 'create';
        $data['date'] = $date;
        $data['time'] = $time;
        $data['cus_id'] = $cus_id;
        $this->load->view('clinic/booking/create', $data);
    }

    function calendar() {
        $date = $this->input->get('date');
        $time = $this->input->get('time');
        $cus_id = $this->input->get('cus_id');
        $this->load->view('_blocks/subpages/create');
        $data['id'] = 0;
        $data['title'] = 'booking';
        $data['view'] = 'calendar';
        $data['date'] = $date;
        $data['time'] = $time;
        $data['cus_id'] = $cus_id;
        $this->load->view('clinic/booking/create', $data);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['date'] = '';
        $data['time'] = '';
        $data['cus_id'] = '';
        $data['id'] = $id;
        $data['title'] = 'booking';
        $data['view'] = "create";
        $this->load->view('clinic/booking/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['date'] = '';
        $data['time'] = '';
        $data['cus_id'] = '';
        $data['id'] = $id;
        $data['title'] = 'booking';
        $data['view'] = "view";
        $this->load->view('clinic/booking/create', $data);
    }

    public function save() {
        $this->booking->save();
    }

    public function delete($id) {
        $this->booking->delete($id);
    }

    function getsing($id) {
        $this->booking->getsing($id);
    }

    public function ajax_list() {
        $this->booking->where();
        $list = $this->booking->get_datatables();
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
            $row[] = $item->Schedule_Time;
            $row[] = $item->Bok_Approved;
            $act = '<a  href="' . base_url() . 'clinic/booking/edit/' . $item->Bok_Id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'clinic/booking/view/' . $item->Bok_Id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/clinic/booking/listall/' . '"  success="Delete ' . $item->Pat_Name . ' successfuly "  message="Do you want Delete ' . $item->Pat_Name . '?"  href="' . base_url() . 'clinic/booking/delete/' . $item->Bok_Id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->booking->count_all(),
            "recordsFiltered" => $this->booking->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function customer_list() {
        $this->item->where();
        $list = $this->item->get_datatables();
        //$itemcount = $this->item->getledgeritem();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            //$itemcount = $this->item->getledgeritem($item->id);
            $row = array();
            $row[] = $no;
            $row[] = $item->name;
            $row[] = $item->tin;
            $row[] = $item->phone;
            $row[] = $item->email;
            $row[] = $item->address_line1;
            $act = '<a  href="' . base_url() . 'suppliers/editcust/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'suppliers/viewcust/' . $item->id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/suppliers/customers/' . '"  success="Delete ' . $item->name . ' successfuly "  message="Do you want Delete ' . $item->name . '?"  href="' . base_url() . 'suppliers/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->item->count_all(),
            "recordsFiltered" => $this->item->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function certificate($type, $id, $detail, $date, $end, $place) {
        $this->generateBill($type, $id, $detail, $date, $end, $place);
    }

    public function printcertificate() {
        $type = $this->input->post('type');
        $id = $this->input->post('id');
        $date = $this->input->post('date');
        $enddate = $this->input->post('enddate');
        $institution = $this->input->post('institution');
        $reside = $this->input->post('reside');
        $place = $this->input->post('place');
        $details['date'] = $date;
        $details['enddate'] = $enddate;
        $details['institution'] = $institution;
        $details['reside'] = $reside;
        $details['place'] = $place;


        // $type = 'fitness';
        // $id =43;
        // $date =  'ss';
        // $enddate = 'ss';
        // $institution = 'ss';
        // $reside = 'ss';
        // $place =  'ss';
        // $details['date']=$date;
        // $details['enddate']=$enddate;
        // $details['institution']=$institution;
        // $details['reside']=$reside;
        // $details['place']=$place;
        $this->generateBill1($type, $id, $details);
    }

    private function generateBill($type, $id, $detail, $date, $end, $place) {

        //$this->load->view('transaction/sales/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        $size = 15;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pat = $this->booking->getpatient($id);
        $com = $this->booking->getCompany();
        $list = $this->booking->getSalesItems($id);
        $boknote = $this->booking->getbok_Note($id);
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(20, 0, 15, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $len = 1;
        // $sale = $this->sales->getSales($id); 
        // $amt = 0; 
        // if ($sale[0]['cash_type'] != 'Cash') {
        //     $ledb = $this->sales->ledbalid($sale[0]['id']); 
        //     if ($ledb['id'] != "") {
        //         $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
        //     }
        // }
        // if ($amt < 0) {
        //     $amt = round(($amt * -1), 2);
        // } else {
        //     $amt = $amt;
        // }
        // $amt = $amt + $sale[0]['total'];
        // $sale[0]['gtot'] = $amt;
        // $tcnt = $this->sales->getSalesItemscnt($id);
        // $hcnt = $this->sales->getHsnItemscnt($id);
        $papersiize = $this->booking->getValue('paper');
        // $hsn = $this->sales->getHsnItems($id);
        if ($papersiize == 'A4') {
            if ($size == 'half') {
                $size = 8;
            }
            if ($size == 'full') {
                $size = 38;
            }
        }

        // $inc = ($tcnt + $hcnt + 1) / $size;
        // for ($i = 0; $i < $inc; $i++) {
        // $len = $size * $i;
        // $list = $this->sales->getSalesItems($id, $len, $size);
        $this->pages($pdf, $list, $boknote, $img_file, $size, $len, $pat, $type, $detail, $date, $end, $place);
        // }
        //ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    private function generateBill1($type, $id, $details) {
        $size = 15;
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pat = $this->booking->getpatient($id);
        $com = $this->booking->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $len = 1;
        // $sale = $this->sales->getSales($id); 
        // $amt = 0; 
        // if ($sale[0]['cash_type'] != 'Cash') {
        //     $ledb = $this->sales->ledbalid($sale[0]['id']); 
        //     if ($ledb['id'] != "") {
        //         $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
        //     }
        // }
        // if ($amt < 0) {
        //     $amt = round(($amt * -1), 2);
        // } else {
        //     $amt = $amt;
        // }
        // $amt = $amt + $sale[0]['total'];
        // $sale[0]['gtot'] = $amt;
        // $tcnt = $this->sales->getSalesItemscnt($id);
        // $hcnt = $this->sales->getHsnItemscnt($id);
        $papersiize = $this->booking->getValue('paper');
        // $hsn = $this->sales->getHsnItems($id);
        if ($papersiize == 'A4') {
            if ($size == 'half') {
                $size = 8;
            }
            if ($size == 'full') {
                $size = 38;
            }
        }

        // $inc = ($tcnt + $hcnt + 1) / $size;
        // for ($i = 0; $i < $inc; $i++) {
        // $len = $size * $i;
        // $list = $this->sales->getSalesItems($id, $len, $size);
        $this->pages1($pdf, $img_file, $size, $len, $pat, $type, $details);
        // }
        //ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    function pages1($pdf, $img_file, $size, $len, $pat, $type, $details) {
        // print_r($details['date']) ; 
        //  print_r( $details['enddate']) ; 
        // print_r($details['institution']) ; 
        // print_r($details['reside']) ; 
        // print_r($details['place']) ; 
        $pdf->setCellPaddings(0, 0, 0, 0);
        $papersiize = $this->booking->getValue('paper');
        $paperorient = $this->booking->getValue('paperorient');
        $pdf->AddPage($paperorient, $papersiize);
        $data['institution'] = $details['institution'];
        $data['date'] = getdate();
        $data['type'] = $type;
        $data['size'] = $size;
        $data['len'] = $len;
        $data['company'] = $this->booking->getCompany();
        $data['pat'] = $pat;

        // print_r($data);
        $html = $this->load->view('clinic/booking/bill', $data, true);
        $pdf->writeHTML($html);
        // $pdf->Image($img_file, 110, 90, 40, 29);
    }

    function pages($pdf, $list, $boknote, $img_file, $size, $len, $pat, $type, $detail, $date, $end, $place) {
        $pdf->setCellPaddings(0, 0, 0, 0);
        $papersiize = $this->booking->getValue('paper');
        $paperorient = $this->booking->getValue('paperorient');
        $pdf->AddPage($paperorient, $papersiize);
        if ($type == 'fitness') {
            $data['institution'] = $detail;
        }
        if ($type == 'carry') {
            $data['reside'] = $detail;
            $diff = abs(strtotime($date) - strtotime($end));
            $month = "";
            $day = "";
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $days = $days+1;
            IF ($days > 0) {
                $day = $days . " Days";
            }
            IF ($months > 0) {
                $month = $months . " Months";
            }
            $diff = $month . " " . $day;
            $data['diff'] = $diff;
        }
        if ($type == 'medical') {
            $data['institution'] = $end;
            $sep = '-';
            $parts = explode($sep, $detail);
            $detail = "$parts[2]-$parts[1]-$parts[0]";
            $data['startdate'] = "$parts[0]-$parts[1]-$parts[2]";
            $parts = explode($sep, $date);
            $date = "$parts[2]-$parts[1]-$parts[0]";
            $data['enddate'] = "$parts[0]-$parts[1]-$parts[2]";
            $diff = abs(strtotime($date) - strtotime($detail));
            $month = "";
            $day = "";
            $years = floor($diff / (365 * 60 * 60 * 24));
            $months = floor(($diff - $years * 365 * 60 * 60 * 24) / (30 * 60 * 60 * 24));
            $days = floor(($diff - $years * 365 * 60 * 60 * 24 - $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));
            $days = $days+1;
            IF ($days > 0) {
                $day = $days . " Days";
            }
            IF ($months > 0) {
                $month = $months . " Months";
            }
            $diff = $month . " " . $day;
            $data['diff'] = $diff;
        }
        $data['place'] = $place;

        $data['date'] = getdate();
        $data['type'] = $type;
        $data['size'] = $size;
        $data['len'] = $len;
        $data['boknote'] = $boknote;
        $data['sales_items'] = $list;
        $data['company'] = $this->booking->getCompany();
        $data['pat'] = $pat;
        $html = $this->load->view('clinic/booking/bill', $data, true);
        $pdf->writeHTML($html);
        // $pdf->Image($img_file, 110, 90, 40, 29);
    }

}
