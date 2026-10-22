<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Family_head extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/familyhead_model', 'item');
    }

    /* public function profile($id) {
      $data['title'] = 'church';
      $this->load->view('_blocks/subpages/create');
      $this->load->view('_blocks/subpages/list');
      $data['type'] = 'cus';
      $data['stype'] = 'sales';
      $data['vtype'] = '';
      $data['sales']=$this->item->getsales('sales',$id);
      $data['estimate']=$this->item->getsales('estimate',$id);
      $data['salesreturn']=$this->item->getsales('sales_return',$id);
      $data['ledgbal']=$this->item->custLedgerbal($id);
      $data['vouchers']=$this->item->getvouchers($id);
      $data['id'] = $id;
      $this->load->view('church/profile',$data);
      } */

    public function listall() {
        $data['title'] = 'Family Register';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'Members';
        $this->load->view('church/list_all', $data);
    }

    function create($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $communities = $this->item->communities();
        $parish = $this->item->parish();
        $diocese = $this->item->diocese();
        $district = $this->item->district();
        $village = $this->item->village();
        $taluk = $this->item->taluk();
        $ward = $this->item->ward();
        $land = $this->item->locality();
        $data['parish'] = $parish;
        $data['diocese'] = $diocese;
        $data['district'] = $district;
        $data['village'] = $village;
        $data['taluk'] = $taluk;
        $data['communities'] = $communities;
        $data['wards'] = $ward;
        $data['land'] = $land;
        $data['id'] = $id;
        $data['title'] = 'Family create';
        $data['type'] = '';
        $data['view'] = "create";

        $this->load->view('church/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function edit($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $communities = $this->item->communities();
        $parish = $this->item->parish();
        $diocese = $this->item->diocese();
        $district = $this->item->district();
        $village = $this->item->village();
        $taluk = $this->item->taluk();
        $ward = $this->item->ward();
        $land = $this->item->locality();
        $data['parish'] = $parish;
        $data['diocese'] = $diocese;
        $data['district'] = $district;
        $data['village'] = $village;
        $data['taluk'] = $taluk;
        $data['communities'] = $communities;
        $data['wards'] = $ward;
        $data['land'] = $land;
        $data['id'] = $id;
        $data['title'] = 'Family Edit';
        $data['type'] = '';
        $data['view'] = "edit";

        $this->load->view('church/create', $data);
    }

    function view($id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $communities = $this->item->communities();
        $parish = $this->item->parish();
        $diocese = $this->item->diocese();
        $district = $this->item->district();
        $village = $this->item->village();
        $taluk = $this->item->taluk();
        $ward = $this->item->ward();
        $land = $this->item->locality();
        $data['parish'] = $parish;
        $data['diocese'] = $diocese;
        $data['district'] = $district;
        $data['village'] = $village;
        $data['taluk'] = $taluk;
        $data['communities'] = $communities;
        $data['wards'] = $ward;
        $data['land'] = $land;
        $data['id'] = $id;
        $data['title'] = 'Family View';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/create', $data);
    }

    public function delete($id) {
        $this->item->delete($id);
    }

    public function printcertificate($id) {
        $community = $this->item->getcommunity($id);
        $data['member'] = $community;
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
        $pdf->setCellPaddings(5, 0, 0, 5);
        $pdf->AddPage('L', 'A4');
        $html = $this->load->view('church/member/bill', $data, true);
        $pdf->Image(FCPATH . 'assets/images/pi5rK4pyT.png', 0, 0, 297, 210, '', '', '', false, 300, '', false, false, 0);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('example_021.pdf', 'I');
    }

    public function ajax_list() {
        //$this->item->where();
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
            $row[] = $item->hed_familyno;
            $row[] = $item->hed_name;
            $row[] = $item->hed_housename;
            $row[] = $item->hed_phone;
            $row[] = $item->hed_mobile;
            /* $row[] = $item->dio_name;
              $row[] = $item->com_name;
              $row[] = $item->wrd_name;
              $row[] = $item->lnd_name;
              $row[] = $item->hed_created;
              $row[] = $item->village_id;
              $row[] = $item->taluk_id;
              $row[] = $item->district_id; */
            $act = '<a  href="' . base_url() . 'church/family_head/edit/' . $item->hed_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/family_head/view/' . $item->hed_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>
                   <a  class="btn btn-success"  href="' . base_url() . 'church/family_members/listall/' . $item->hed_id . '" title="Family Details"  data-toggle="tooltip"><span class="fa fa-home"></span></i></a>';
            $act = $act . '&nbsp;<a class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/Family_head/printcertificate/' . $item->hed_id . '" title="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/family_head/' . '"  success="Delete ' . $item->hed_name . ' successfuly "  message="Do you want Delete ' . $item->hed_name . '?"  href="' . base_url() . 'church/family_head/delete/' . $item->hed_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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

}
