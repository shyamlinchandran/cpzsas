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
class SalesJob extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('gold/SalesJob_model', 'salesjob');
    }
	
	public function getsing($id){
		$result = $this->salesjob->getsing($id);
		 echo json_encode($result);
	}
	
	 public function list_all(){
	   $data['title'] = 'Sales and Job Work';
	   $this->load->view('_blocks/subpages/create');
       $this->load->view('_blocks/subpages/list');
       $this->load->view('gold/salesjob/listall', $data);
   }
   
    public function ajax_list(){
        $this->salesjob->salesjob();
        $list = $this->salesjob->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->date;
            $row[] = $item->voucher;
            $row[] = $item->name;
            $act = '<a  href="' . base_url() . 'gold/SalesJob/create/' . $item->sale_job_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'gold/SalesJob/list_all' . '"  success="Delete ' . $item->voucher . ' successfuly "  message="Do you want to Delete ' . $item->voucher . '?"  href="' . base_url() . 'gold/SalesJob/delete/' . $item->sale_job_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
		"draw" => $this->input->post('draw'),
            "recordsTotal" => $this->salesjob->count_all(),
            "recordsFiltered" => $this->salesjob->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
	
	
   
		
   public function create($id = 0,$is_view = 'create'){
	    $this->load->view('_blocks/subpages/create');
		//$data['invoice'] = '';
		//$data['job_card_id'] = 0;
		//$data['job_voucher_no'] = '';
		//if($id < 1){
			//$data['invoice'] = $this->material->material($type);
	//	}else{
		//	$qry = "select * from material_card where id = ".$id;
		//	$query = $this->db->query($qry)->row_array();
			////$data['job_card_id']  = $query['job_card_id'];
			//$data['job_voucher_no'] = $query['job_card_voucher_no'];
		//}
		//$data['type'] = $type;
        $data['id'] = $id;
		$data['view'] = $is_view;
        $this->load->view('gold/salesjob/create', $data);
   }
   
  
   public function save(){
		$this->salesjob->save();
   }
   
  
	public function delete($id){
		$qry ="update sales_and_jobcard set published = 'no' where sale_job_id = ".$id;
		$this->db->query($qry);
		$qry ="update sales_and_jobcard_items set published = 'no' where sale_job_id = ".$id;
		$this->db->query($qry);
	}






}
