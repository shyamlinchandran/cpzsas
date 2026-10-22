<?php

defined('BASEPATH') or exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Proposal extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Proposal_model', 'proposal');
    }
	
	function getinvoice(){
		
		$qry = "select * from proposal where 1 order by id desc limit 0,1" ;
		$query = $this->db->query($qry);
		$billtype['preffix'] = 'TTC/';
		$billtype['seperator'] = '';
		$billtype['startnumber'] = 1;
		$billtype['suffix'] = '/2021';
		if($query->num_rows() < 1){
			$invoice = $billtype['preffix'].$billtype['seperator'].$billtype['startnumber'].$billtype['seperator'].$billtype['suffix'];
		}else{
			$query  = $query->row_array();
			$old = $query['bill_no'];
			$old = str_replace($billtype['preffix'], "", $query['bill_no']);
			$old = str_replace($billtype['suffix'], "", $old);
			$old = str_replace("2020", "", $old);
			$old = str_replace($billtype['seperator'], "", $old);
			$old = $old + 1;
            $invoice = $billtype['preffix'] . $billtype['seperator'] . $old . $billtype['seperator'] . $billtype['suffix'];
			

		}
		return $invoice;
	}
	public function getsing($id){
	
		return $this->proposal->getsing($id);
	}
	
	public function getsing_items($id){
	
		return $this->proposal->getsing_items($id);
	}
	
	public function save(){
		$id = $this->input->post('id');
		$customer_id = $this->input->post('customer_id');
		$cost_id = $this->input->post('Costcenter');
		$date = $this->input->post('date');
		$bill_no = $this->getinvoice();
		$is_make  = $this->input->post('is_make');
		$proposal =  $this->input->post('proposal');
		$text_preffix = $this->input->post('text_preffix');
		$qry = "update proposal set is_active = 0  where customer_id =".$customer_id;
		$this->db->query($qry);
		$data = array(
			'customer_id'=>$customer_id,
			'reference'=>$id,
			'cost_id'=>$cost_id,
			'date'=>$this->proposal->getDate($date),
			//'bill_no'=>$bill_no,
			'is_make'=>$is_make,
			'text'=>$proposal,
			'text_preffix'=>$text_preffix,
			'is_active'=>1
			);
			
		if((int)$id > 0 ){
			$qry = "select * from proposal where id = ".$id;
			$p_data = $this->db->query($qry)->row_array();
			$data['bill_no'] = $p_data['bill_no'];
			$qry = 'update proposal set is_published  =  0 where id = '.$id;
			$this->db->query($qry);
			// $this->db->where('id',$id);
			$this->db->insert('proposal',$data);
			$insert_id = $this->db->insert_id();
			//$insert_id = $id;
			//$qry = "update proposal_items set published ='no' where proposal_id = ".$id;
			//$this->db->query($qry);
		}else{
			$data['bill_no'] = $bill_no;
			$this->db->insert('proposal',$data);
			$insert_id = $this->db->insert_id();
		}
		$col1 = $this->input->post('textbox1',true);
		$col2 = $this->input->post('textbox2',true);
		$col21=$this->input->post('textbox22',true);
		$col3 = $this->input->post('textbox31',true);
		$col4 = $this->input->post('textbox4',true);
		$col5 = $this->input->post('textbox5',true);
		$col6 = $this->input->post('textbox6',true);
		$col7 = $this->input->post('textbox7',true);
		$tax_id=$this->input->post('textbox8',true);
		$taxid=$this->input->post('taxid',true);
		//$checkbx=$this->input->post('checkbox',true);
		
		
		if($this->input->post('textbox2',true)){
			$length = sizeof($this->input->post('textbox2',true));
			for($i =0; $i<$length;$i++){
				$data = array(
					'proposal_id'=>$insert_id,
					'col1'=>$col1[$i],
					'col2'=>$col2[$i],
					'col3'=>$col3[$i],
					'col4'=>$col4[$i],
					'col5'=>$col5[$i],
					'col6'=>$col6[$i],
					'col7'=>$col7[$i],	
					'col21'=>$col21[$i],
					'tax_id'=>$taxid[$i],
					'is_checked'=>0,
					'published'=>'yes'
				);
				// if($checkbx[$i]){
				// 	$data['is_checked'] =1;
				// }else{
				// 	$data['is_checked'] =0;

				// }
				
				$this->db->insert('proposal_items',$data);
			}
		}
		 $response = array(
            'id' => $insert_id,
            'valid' => true,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
	}

    public function listall()
    {
		$data['title'] ='Proposal';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('proposal/listall',$data);
    }
	
	public function create($id = 0){
		$data['title'] ='Proposal';
		$data['id'] =$id;
		$data['bill_no'] = $this->getinvoice();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('proposal/create',$data);
	}
	
	
	
	public function quatation($id){
		$this->proposal->quatation($id);
	}


	public function bill($id) {
        $this->generateBill($id);
    }
    private function generateBill($id) {
		   $qry = "select DATE_FORMAT(date,'%d/%m/%Y') as fdate,a.*,b.name,b.address_line1 from proposal as a inner join suppliers as b on a.customer_id=b.id where a.id=".$id;
			$list = $this->db->query($qry)->row_array();
		$this->load->library('M_pdf');
		$paper = 'A4';
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		$this->lang->load('en_site', 'en');
		$pdf->defaultheaderline = 0;
		$pdf->defaultfooterline = 0;
		$company = $this->proposal->getCompany();
		$pdf->SetHeader('<div id="header">
							<table style="width:100%;margin-right:30px;">
								<tr>
									<td><img alt="" src="'.  base_url().'uploads/images/tricolour.png" style="height:100px; width:400px" /></td>
									<td style="text-align:right">
										<p>'.$company['name'].'</p>
										<p>'.$company['address'].'</p>
										<p>'.$company['phone'].'</p>
										<p style="font-size:15px;font-weight:bold">GSTIN/UIN: '.$company['tin'].'</p>
									</td>
								</tr>
							</table>');
							
							$pdf->SetFooter('<div id="footer" class="printable">
							<table style="color:red;width:100%">
								
								
							</table>
						</div>');
						
        $this->language = "en";
		           

		$this->pages($pdf, $list,$id);
		
		$pdf->Output('example_021.pdf', 'I');
		
	}
	function pages($pdf, $list,$id) {
        if (count($list) != 0) {
            $papersiize = 'A4';
            $paperorient = $this->proposal->getValue('paperorient');
			  $pdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        0, // margin_left
        0, // margin right
       35, // margin top
       30, // margin bottom
        0, // margin header
        -1); // margin footer
           $qry = "select DATE_FORMAT(date,'%d/%m/%Y') as fdate,a.*,b.name,b.address_line1,b.tin from proposal as a inner join suppliers as b on a.customer_id=b.id where a.id=".$id;
			$query = $this->db->query($qry)->row_array();
			$data['proposal'] = $query;
            $data['company'] = $this->proposal->getCompany();
            $settings = $this->proposal->getCompanySettings();
            $data['settings'] = $settings;
			$data['items'] =  $this->proposal->getItems($id);
            $html = $this->load->view('proposal/bill', $data, true);
            $pdf->writeHTML($html);
        }
    }
	
	
	public function view($id){
		$qry = "select DATE_FORMAT(date,'%d/%m/%Y') as fdate,a.*,b.name,b.address_line1 from proposal as a inner join suppliers as b on a.customer_id=b.id where a.id=".$id;
		$query = $this->db->query($qry)->row_array();
		$data['proposal'] = $query;
		$data['id'] =$id;
		$this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('proposal/view',$data);
	}
	
	public function delete($id){
		$qry = "delete from proposal where id=".$id ;
		$this->db->query($qry);
		
	}
	public function ajax_list(){
        $list = $this->proposal->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->bill_no;
            $row[] = $item->name;
            $row[] = $item->phone;
            $row[] = $item->date;
            $act = '<a  href="' . base_url() . 'Proposal/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
			$act = $act . '<a tp="pdf" href="' . base_url() . 'Quotations/bill/' . $item->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'Proposal/listall' . '"  success="Delete ' . $item->bill_no . ' successfuly "  message="Do you want to Delete ' . $item->bill_no . '?"  href="' . base_url() . 'Proposal/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
		"draw" => $this->input->post('draw'),
            "recordsTotal" => $this->proposal->count_all(),
            "recordsFiltered" => $this->proposal->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
	}

	public function getIttem(){
		
			return $this->proposal->getIttem();
		}
  
}
