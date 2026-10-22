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
class Production extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('gold/Production_model', 'production');
    }
	
	public function getsing($id){
		$result = $this->production->getsing($id);
		 echo json_encode($result);
	}
	
	 public function list_all(){
	   $data['title'] = 'Production Voucher';
	   $this->load->view('_blocks/subpages/create');
       $this->load->view('_blocks/subpages/list');
       $this->load->view('gold/production/listall', $data);
   }
   
    public function ajax_list(){
        $this->production->production();
        $list = $this->production->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->gold_pd_date;
            $row[] = $item->gold_pd_voucher;
            $row[] = $item->name;
            $act = '<a  href="' . base_url() . 'gold/Production/create/' . $item->gold_pd_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'gold/Production/list_all' . '"  success="Delete ' . $item->gold_pd_voucher . ' successfuly "  message="Do you want to Delete ' . $item->gold_pd_voucher . '?"  href="' . base_url() . 'gold/Production/delete/' . $item->gold_pd_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
		"draw" => $this->input->post('draw'),
            "recordsTotal" => $this->production->count_all(),
            "recordsFiltered" => $this->production->count_filtered(),
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
        $this->load->view('gold/production/create', $data);
   }
   
  
   public function save(){
		$this->production->save();
   }
   
  
	public function delete($id){
		$qry ="update gold_production set published = 'no' where gold_pd_id = ".$id;
		$this->db->query($qry);
		$qry ="update gold_production_items set published = 'no' where gold_pdn_itms_pid = ".$id;
		$this->db->query($qry);
	}






}
