<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Marriage_reports extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/marriage_model', 'item');
    }

    public function listall() {
        $data['title'] = 'Marriage Reports';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        //$get_headname = $this->item->familymain($head_id);
        //$data['headname'] = $get_headname;
        $data['head_id'] = 0;

        $this->load->view('church/reports/list_marriages', $data);
    }

    public function ajax_list() {
        if (!isset($_COOKIE["startdate"])) {
            //echo "Cookie named '" . "startdate" . "' is not set!";
        } else {
            if ($this->input->post('startdate')) {
                $_COOKIE["startdate"] = $this->input->post('startdate');
                $_COOKIE["enddate"] = $this->input->post('enddate');
                $this->item->reports();
            }
        }
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
            $row[] = $item->weddate;
            $row[] = $item->familyadtl;
            $row[] = $item->bridegrname;
            $row[] = $item->houseaname;
            $row[] = $item->familybdtl;
            $row[] = $item->bridename;
            $row[] = $item->housebname;
            $act = '<a  href="' . base_url() . 'church/marriage_register/edit/' . $item->mrg_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                <a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/marriage_register/printcertificate/' . $item->mrg_id . '" title="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'church/marriage_register/view/' . $item->mrg_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . '/church/marriage_register/listall' . '"  success="Delete ' . $item->witnessa . ' successfuly "  message="Do you want Delete ' . $item->witnessb . '?"  href="' . base_url() . 'church/marriage_register/delete/' . $item->mrg_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
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

}
