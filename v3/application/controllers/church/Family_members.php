<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Family_members extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/familymember_model', 'item');
    }

    public function listall($head_id) {
        $data['title'] = 'Family members';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $get_headname = $this->item->familymain($head_id);
        $data['headname'] = $get_headname;
        $data['head_id'] = $head_id;

        $this->load->view('church/member/list_all', $data);
    }

    function create($head_id) {
        $id = 0;
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['head_id'] = $head_id;
        $data['title'] = 'Member create';
        $data['type'] = '';
        $data['view'] = "create";

        $this->load->view('church/member/create', $data);
    }

    function getsing($id) {
        $this->item->getsing($id);
    }

    function edit($id, $head_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['head_id'] = $head_id;
        $data['title'] = 'Family Member edit';
        $data['type'] = '';
        $data['view'] = "edit";

        $this->load->view('church/member/create', $data);
    }

    function view($id, $head_id) {
        $this->load->view('_blocks/subpages/create');
        $settings = $this->item->getCompanySettings();
        $relations = $this->item->relations();
        $data['relations'] = $relations;
        $data['id'] = $id;
        $data['head_id'] = $head_id;
        $data['title'] = 'Family Member View';
        $data['type'] = 'cus';
        $data['view'] = "view";
        $this->load->view('church/member/create', $data);
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
        $head_id = $this->input->post('head_id');
        $this->item->where($head_id);
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
            $row[] = $item->rel_name;
            //$row[] = $item->hed_id;
            $row[] = $item->dob;
            $row[] = $item->mbr_age;
            $row[] = $item->mbr_education;
            /* $row[] = $item->mbr_baptised_on;
              $row[] = $item->mbr_married_on;
              $row[] = $item->mbr_job;
              $row[] = $item->mbr_remarks;
              $row[] = $item->village_id;
              $row[] = $item->taluk_id;
              $row[] = $item->district_id; */
            $act = '<a  href="' . base_url() . 'church/family_members/edit/' . $item->mbr_id . '/' . $item->hed_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/family_members/view/' . $item->mbr_id . '/' . $item->hed_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/Family_members/printcertificate/' . $item->mbr_id . '" title="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/family_members/listall' . $item->hed_id . '"  success="Delete ' . $item->mbr_name . ' successfuly "  message="Do you want Delete ' . $item->mbr_name . '?"  href="' . base_url() . 'church/family_members/delete/' . $item->mbr_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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
