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
class Melting extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('gold/Melting_model', 'melting');
    }
	
	public function getsing($id){
		$result = $this->melting->getsing($id);
		 echo json_encode($result);
	}
	
	public function delete($id){
		$qry ="update gold_melting set published = 'no' where melt_id = ".$id;
		$this->db->query($qry);
		$qry ="update gold_melting_item set published = 'no' where melt_itm_melt_id = ".$id;
		$this->db->query($qry);
	}
	
	 public function list_all(){
	   $data['title'] = 'Melting Voucher';
	   $this->load->view('_blocks/subpages/create');
       $this->load->view('_blocks/subpages/list');
       $this->load->view('gold/melting/listall', $data);
   }
   
    public function ajax_list(){
        $this->melting->melting();
        $list = $this->melting->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->melt_date;
            $row[] = $item->melt_invoice;
            $row[] = $item->name;
            $act = '<a  href="' . base_url() . 'gold/Melting/create/' . $item->melt_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'gold/Melting/list_all' . '"  success="Delete ' . $item->melt_invoice . ' successfuly "  message="Do you want to Delete ' . $item->melt_invoice . '?"  href="' . base_url() . 'gold/Melting/delete/' . $item->melt_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
		"draw" => $this->input->post('draw'),
            "recordsTotal" => $this->melting->count_all(),
            "recordsFiltered" => $this->melting->count_filtered(),
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
        $this->load->view('gold/melting/create', $data);
   }
   

   public function save(){
		$this->melting->save();
   }
   
  

	

	







}
