<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
 */

/**
 *
 * @author dimind
 */
class Services extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Services_model', 'service');
    }
	
	public function getsing($id){
		print_r($this->service->getsing($id));
	}
	
	public function delete($id){
		$qry = "delete from service where id=".$id ;
		$this->db->query($qry);
		$qry = "delete from service_items where service_id=".$id ;
		$this->db->query($qry);
		$qry = "update acc_ledger_trans set published='no' where tb_name ='service'  and tb_id=".$id ;
		$this->db->query($qry);
	}

    public function listall() {
        $data['title'] = 'Services';
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('service/listall', $data);
    }
	public function getinvoiceno($id){
		print_r($this->service->getinvoiceno($id));
	}
	public function getinvoice($id){
		print_r($this->service->getinvoice($id));
	}

    public function itemsearch() {
		$search = strtolower($_GET['term']);
        return $this->service->itemsearch($search);
	}
   

    public function create($id = 0) {
        $settings = $this->service->getCompanySettings();
		$data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['title'] = 'Services';
        $data['id'] = $id;
        $this->load->view('service/create', $data);
    }

    public function ajax_list() {
        $this->service->where();
        $list = $this->service->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->invdate;
            $row[] = $item->invoice;
			$row[] = $item->bill_no;
			$row[] = $item->name;
			$row[] = $item->phone;
			$row[] = $item->net_total;
            $act = '<a  href="' . base_url() . 'Services/create/' . $item->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
			$act = $act . '<a tp="pdf" href="' . base_url() . 'Services/bill/' . $item->id . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
            $act .= ' <a tp="confirm" base="' . base_url() . 'Services/listall' . '"  success="Delete ' . $item->invoice . ' successfuly "  message="Do you want to Delete ' . $item->invoice . '?"  href="' . base_url() . 'Services/delete/' . $item->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->service->count_all(),
            "recordsFiltered" => $this->service->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
       $insert_id = $this->service->save();
	   $response = array(
				'id'=>$insert_id,
                'valid' => false,
                'type' => 1,
                'message' => 'Saved Successfully.'
            );
	   echo json_encode($response);
    }
	 public function bill($id) {
        $this->generateBill($id);
    }

    private function generateBill($id) {
		$list = $this->service->getdetails($id);
		$this->load->library('M_pdf');
		$paper = 'A4';
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
		$company = $this->service->getCompany();
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		$pdf->SetFooter('<div id="footer" class="printable">
							<table style="color:red;width:100%">
								<tr>
									<td style="text-align:center">'.$company['name'].'</td>
									<td style="text-align:center">'.$company['address'].'</td>
									<td style="text-align:center">'.$company['phone'].'</td>
								</tr>
								
								
							</table>
						</div>');
		$this->lang->load('en_site', 'en');
        $this->language = "en";
		$this->pages($pdf, $list);
		$pdf->Output('example_021.pdf', 'I');
		
	}
	function pages($pdf, $list) {
        if (count($list) != 0) {
            $papersiize = 'A4';
            $paperorient = $this->service->getValue('paperorient');
			 $pdf->AddPage('', // L - landscape, P - portrait 
        '', '', '', '',
        '', // margin_left
        '', // margin right
       '', // margin top
       '', // margin bottom
        '', // margin header
        0	); // margin footer
            $data['service'] = $list;
			 $data['msd'] = $this->Show_Amount_In_Words($list[0]['net_total']);
            $data['company'] = $this->service->getCompany();
            $settings = $this->service->getCompanySettings();
            $data['settings'] = $settings;
            $html = $this->load->view('service/tricolor', $data, true);
            $pdf->writeHTML($html);
        }
    }
	

}
