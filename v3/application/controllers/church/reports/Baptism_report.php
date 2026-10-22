<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Baptism_report extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/baptism_model', 'item');
    }

    public function listall() {
        $data['title'] = 'Baptism Report';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/listreports');
        //$get_headname = $this->item->familymain($head_id);
        //$data['headname'] = $get_headname;
        $data['head_id'] = 0;

        $this->load->view('church/reports/list_all', $data);
    }

    public function ajax_list() {
        if (!isset($_COOKIE["startdate"])) {
            //echo "Cookie named '" . "startdate" . "' is not set!";
        } else {
            //echo "Cookie '" . "startdate" . "' is set!<br>";
            //echo "Value is: " .($_COOKIE["startdate"]);
            if ($this->input->post('startdate')) {
                $_COOKIE["startdate"] = $this->input->post('startdate');
                $_COOKIE["enddate"] = $this->input->post('enddate');
                $this->item->reports();
            }
        }
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
            /* $act = '<a  class="btn btn-info " tp="pdf"  href="' . base_url() . 'church/baptism_register/printcertificate/' . $item->bap_id . '" tpritle="Print"  data-toggle="tooltip"><span class="glyphicon glyphicon glyphicon-print"></span></i></a>';            
              $row[] = $act; */
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
