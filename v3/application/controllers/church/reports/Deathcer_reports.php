<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Deathcer_reports extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('church/deathcer_model', 'item');
    }

    public function listall() {
        $data['title'] = 'Death Reports';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        //$get_headname = $this->item->familymain($head_id);
        //$data['headname'] = $get_headname;
        $data['head_id'] = 0;

        $this->load->view('church/reports/list_death', $data);
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
            $row[] = $item->mbr_name;
            $row[] = $item->hed_housename;
            $row[] = $item->deathdate;
            $row[] = $item->crematedate;
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

    public function printcertificate($crr_id) {
        $deathcer = $this->item->getdeathcer($crr_id);
        $data['deathcer'] = $deathcer;
        $this->load->view('church/deathcer/bill', $data);
        //$this->generateBill($bap_id);
    }

}
