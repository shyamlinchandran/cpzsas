<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sales
 *
 * @author jijodileep
 */
class Cheque extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('reports/Cheque_model', 'cheque');
    }

    
	function Cheque_data(){
		$data['title'] = 'Cheque Collection Report';
        $this->load->view('_blocks/subpages/listreports');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('reports/cheque/cheque',$data);
	}
	
	
	 public function ajax_list() {
        $this->cheque->where();
        $list = $this->cheque->get_datatables();
        $data = array();
        $no = $this->input->post('start');
		$total = 0 ;
        foreach ($list as $vouchers) {
			$total = (float) $total + (float) $vouchers->chq_amount ;
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $vouchers->chq_sdate;
            $row[] = $vouchers->chq_date;
            $row[] = $vouchers->chq_no;
            $row[] = $vouchers->fromname;
            $row[] = $vouchers->toname ;
            $row[] = $vouchers->chq_status ;
            $row[] = $vouchers->chq_amount ;
            $data[] = $row;
        }
         $row = array();
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = '';
            $row[] = $total;
            $data[] = $row;
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->cheque->count_all() + 1,
            "recordsFiltered" => $this->cheque->count_filtered() + 1,
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
	
	 
	
	
}
