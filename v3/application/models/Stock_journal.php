<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of purchase
 *
 * @author u43255  
 */
class Stock_journal extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Stockjournal_model', 'stockjournal');
    }
	
	function getsing($id){
		$this->stockjournal->getsing($id);
	}
	
	function journal_ledgers($id){
		$this->stockjournal->journal_ledgers($id);
	}
	  function delete($id) {
        $this->stockjournal->delete($id);
    }
	
	
	
   public function create($id = 0){
	    $this->load->view('_blocks/subpages/create');
		if($id < 1){
			$data['invoice'] = $this->stockjournal->getinvoice();
		}
		$data['settings'] = $this->stockjournal->getCompanySettings();

        $data['id'] = $id;
		$data['view'] = 'Create';
        $this->load->view('stockjournal/create', $data);
   }
   
   
    public function itemssearch($type= '') {
        $search = strtolower($_GET['term']);
        return $this->stockjournal->itemssearch($search,$type);
    }

    public function listall() {
		$type = "stock_journal";
		$data['type'] = $type;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('stockjournal/list_all',$data);
    }

    public function ajax_list() {
        $list = $this->stockjournal->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stock) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $stock->date;
            $row[] = $stock->voucher_no;
            $row[] = $stock->remarks;
            $act = ' <a  href="' . base_url() . 'Stock_journal/create/' . $stock->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/Stock_journal/listall/"  success="Delete ' . $stock->voucher_no . ' successfuly "  message="Do you want Delete ' . $stock->voucher_no . '?"  href="' . base_url() . 'Stock_journal/delete/' . $stock->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->stockjournal->count_all(),
            "recordsFiltered" => $this->stockjournal->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->stockjournal->save();
    }






//    }
}
