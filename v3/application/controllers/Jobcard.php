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
class Jobcard extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Jobcard_model', 'jobcard');
    }
		
   public function create($type,$id = 0,$is_view = 'create'){
	    $this->load->view('_blocks/subpages/create');
		$data['invoice'] = '';
		if($id < 1){
			$data['invoice'] = $this->jobcard->getinvoice($type);
		}
        $data['id'] = $id;
		$data['view'] = $is_view;
		$data['type'] = $type;
        $this->load->view('jobcard/create', $data);
   }
   
   public function list_all($type){
	   $data['type'] = $type;
	   $this->load->view('_blocks/subpages/create');
       $this->load->view('_blocks/subpages/list');
       $this->load->view('jobcard/listall', $data);
   }
   
    public function productSearch()  {
        $search= strtolower($_GET['term']);
        $this->jobcard->productSearch($search);
       
     }
	 
	public function getjobcard_items($id){
		return $this->jobcard->getjobcard_items($id);
	}
	
	public function getjobcard_items_material($id){
		return $this->jobcard->getjobcard_items_material($id);
	}
	
	public function getjobcard($id){
		return $this->jobcard->getjobcard($id);
	}
	 
	public function getMaterialList($id)  {
        
        $this->jobcard->getMaterialList($id);
       
     }
   public function save(){
		$this->jobcard->save();
   }
   public function ajax_list(){
        $this->jobcard->jobcard();
        $list = $this->jobcard->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->voucher_date;
            $row[] = $item->voucher_no;
            $row[] = $item->name;
            $row[] = $item->voucher_due_date;
            $row[] = $item->status;
            $act = '<a  href="' . base_url() . 'Jobcard/create/' . $item->type . '/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
			//$act = $act . '<a tp="pdf" href="' . base_url() . 'Jobcard/bill/' . $item->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'Jobcard/list_all' . '"  success="Delete ' . $item->voucher_no . ' successfuly "  message="Do you want to Delete ' . $item->voucher_no . '?"  href="' . base_url() . 'Jobcard/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
		"draw" => $this->input->post('draw'),
            "recordsTotal" => $this->jobcard->count_all(),
            "recordsFiltered" => $this->jobcard->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}
  

	public function bill($id) {
        $this->generateBill($id);
    }
	
    private function generateBill($id) {
		$format  ='bill';
		$size =12;
		$orient = 'A4';
		$pdf_type = "Mpdf";
		$paper = 'A4';
		$this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		$this->lang->load('en_site', 'en');
        $this->language = "en";
		$jobcard = $this->jobcard->get_jobcard($id);
        $tcnt = $this->jobcard->getjobcardItemscnt($id);
		$papersiize ='A4';
		$inc = number_format(($tcnt) / $size, 2);
        $page = explode(".", $inc);
        $mode = (int) $page[1];
        $inc = (int) $page[0];
        if ($mode > 0) {
            $inc = $inc + 1;
        }
        if ($inc == 0) {
            $inc = $inc + 1;
        }
		for ($i = 0; $i < $inc; $i++) {
           $len = $size * $i;
           $list = $this->jobcard->getjobcardItems($id, $len, $size);
           $this->pages($pdf, $list, $jobcard, $size, $len, $format, $i, $inc,$orient,$pdf_type);
       }
	   $pdf->Output('example_021.pdf', 'I');
	}
	
	
	function pages($pdf, $list, $jobcard, $size, $len, $format, $i, $inc,$orient,$pdf_type){
		if (count($list) != 0) {
			$papersiize = 'A4';
            $paperorient = $this->jobcard->getValue('paperorient');  
			$pdf->AddPage('P', 'A4');
			//$data['msd'] = $this->Show_Amount_In_Words(round($totals['total'],0));
			$data['jobcard'] = $jobcard;
			$data['size'] = $size;
			$data['len'] = $len;
			$data['inc'] = $inc;
            $data['cpz'] = $i;
			$data['jobcard_items'] = $list;
			$data['company'] = $this->jobcard->getCompany();
			$settings = $this->jobcard->getCompanySettings();
            $data['settings'] = $settings;
			if($jobcard[0]['type'] == 'out'){
				$html = $this->load->view('jobcard/bill', $data, true);
			}else{
				$html = $this->load->view('jobcard/bill_in', $data, true);
			}
			//ob_end_clean();
            $pdf->writeHTML($html);
		}
	}





}
