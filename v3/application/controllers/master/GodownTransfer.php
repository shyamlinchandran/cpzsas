<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Items
 *
 * @author jijodileep
 */
class GodownTransfer extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('GodownTransfer_model', 'items');
    }

    public function list_all() {
        $data['type'] = 'transfer';
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/godown_transfer/list_godown_transfer', $data);
    }
	
	function getitem(){
		$result = $this->items->getitem();
        echo json_encode($result);
	}
	
	public function get_purpose(){
		return $this->items->get_purpose();
	}
	
	 public function gettransfer($id) {
        $pdt = $this->items->gettransfer($id);
        echo json_encode($pdt);
    }
	
	 public function save_transfer() {
        $this->items->save_transfer();
    } 

    public function ajax_list() {
        $this->items->where();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = $items->fromname;
            $row[] = $items->godown_name;
            $act = '<a   back="' . base_url() . 'master/GodownTransfer/list_all" href="' . base_url() . 'master/GodownTransfer/ProductTransfer/' . $items->cid . '/view"  data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/GodownTransfer/list_all"  href="' . base_url() . 'master/GodownTransfer/ProductTransfer/' . $items->cid . '/edit"  data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->items->count_all(),
            "recordsFiltered" => $this->items->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	
	 public function ProductTransfer($id = 0, $view = '') {
		$settings = $this->items->getCompanySettings();
        $data['settings'] = $settings;
        $data['id'] = $id;
        $data['view'] = $view;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/godown_transfer/create', $data);
    }

}
