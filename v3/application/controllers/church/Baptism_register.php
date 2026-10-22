<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Baptism_register extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/baptism_model', 'item');
    }

    public function listall() {
        $data['title'] = 'Baptism Register';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        //$get_headname = $this->item->familymain($head_id);
        //$data['headname'] = $get_headname;
        $data['head_id'] = 0;

        $this->load->view('church/baptism/list_all', $data);
    }

    function create($id = '0') {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'baptism create';
        $data['type'] = '';
        $data['view'] = "create";

        $this->load->view('church/baptism/create', $data);
    }

    public function getparents($head_id) {
        return $this->item->getparents($head_id);
    }

    public function getfathers() {
        return $this->item->getfathers();
    }

    public function family_name() {
        $search = strtolower($_GET['term']);
        return $this->item->family_name($search);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Baptism edit';
        $data['type'] = '';
        $data['view'] = "edit";

        $this->load->view('church/baptism/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['title'] = 'Baptism View';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/baptism/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function ajax_list() {
        //$this->item->where($head_id);
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
            $row[] = $item->mbr_name;
            $row[] = $item->hed_housename;
            $row[] = $item->hed_name;
            $row[] = $item->birthdate;
            $row[] = $item->baptisedate;
            $act = '<a  href="' . base_url() . 'church/baptism_register/edit/' . $item->bap_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
            <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/baptism_register/printcertificate/' . $item->bap_id . '" title="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/baptism_register/view/' . $item->bap_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/baptism_register/listall' . '"  success="Delete ' . $item->mbr_name . ' successfuly "  message="Do you want Delete ' . $item->mbr_name . '?"  href="' . base_url() . 'church/baptism_register/delete/' . $item->bap_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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

    function save() {
        $this->item->save();
    }

    public function printcertificate($bap_id) {
        $baptism = $this->item->getbaptism($bap_id);
        $data['baptised'] = $baptism;
        $this->load->library('Pdf');
        $pdf = new Pdf('p', 'mm', 'A4', false, 'UTF-8', false);
        $com = $this->item->getCompany();
        $data['company'] = $com;
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage('P', 'A4');
        $html = $this->load->view('church/baptism/bill', $data, true);
        $pdf->Image(FCPATH . 'assets/images/8TEb59Kpc.png', 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

//    public function printcertificate($bap_id) {
//        $baptism = $this->item->getbaptism($bap_id);
//        $data['baptised'] = $baptism;
//        $this->load->view('church/baptism/bill', $data);
//        //$this->generateBill($bap_id);
//    }
    /* private function generateBill($id) {
      $size = 15;
      $this->load->library('Pdf');
      $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
      $pdf->setPrintHeader(false);
      $pdf->setPrintFooter(false);
      $pdf->SetCreator(PDF_CREATOR);
      $baptism = $this->item->getbaptism($id);
      $com = $this->item->getCompany();
      $pdf->SetAuthor($com['name']);
      $pdf->SetTitle($com['name']);
      $pdf->SetSubject($com['name']);
      $img_file = base_url() . 'assets/images/Desert.jpg';
      //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
      $pdf->SetMargins(5, 0, 5, 0);
      $pdf->SetAutoPageBreak(TRUE, 0);
      $len = 1;
      $papersiize = $this->item->getValue('paper');
      if ($papersiize == 'A4') {
      if ($size == 'half') {
      $size = 8;
      }
      if ($size == 'full') {
      $size = 38;
      }
      }

      $this->pages1($pdf, $img_file, $size, $len, $baptism);
      //ob_end_clean();
      $pdf->Output('example_021.pdf', 'I');
      }

      function pages1($pdf, $img_file, $size, $len, $baptism) {
      $pdf->setCellPaddings(0, 0, 0, 0);
      $papersiize = $this->item->getValue('paper');
      $paperorient = $this->item->getValue('paperorient');
      $pdf->AddPage($paperorient, $papersiize);
      //$data['institution'] = $details['institution'];
      $data['date'] = getdate();
      $data['size'] = $size;
      $data['len'] = $len;
      $data['company'] = $this->item->getCompany();
      $data['baptised'] = $baptism;
      // print_r($data);
      $html = $this->load->view('church/baptism/bill', $data, true);
      $pdf->writeHTML($html);
      // $pdf->Image($img_file, 110, 90, 40, 29);
      } */
}
