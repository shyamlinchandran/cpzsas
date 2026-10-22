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
class Itemtransfer extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('itemtransfer_model', 'items');
		$this->load->model('items_model', 'item');
    }
	
	public function delete($id){
		$this->item->delete_transfer($id);
	}

    public function list_all() {
        $data['type'] = 'transfer';
        $this->load->view('_blocks/subpages/list');
        $this->load->view('master/items/list_transfer', $data);
    }

    public function ajax_list() {
		$settings = $this->items->getCompanySettings();
        $this->items->where();
        $list = $this->items->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $items) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $items->date;
            $row[] = $items->invoice;
            $row[] = $items->fromname;
            $row[] = $items->godown_name;
            $act = '<a   back="' . base_url() . 'master/ProductTransfer/list_all" href="' . base_url() . 'master/items/ProductTransfer/' . $items->cid . '/view" data-toggle="tooltip" title="View" class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span></a>'
                    . ' <a  back="' . base_url() . 'master/ProductTransfer/list_all"  href="' . base_url() . 'master/items/ProductTransfer/' . $items->cid . '/edit" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . 'master/ProductTransfer/list_all"  success="Delete ' . $items->invoice . ' successfuly "  message="Do you want Delete ' . $items->invoice . '?"  href="' . base_url() . 'master/Itemtransfer/delete/' . $items->cid . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			if(isset($settings[0]['item_transfer_bill']) ){
				$act = $act . '<a tp="pdf" href="' . base_url() . 'master/Itemtransfer/bill/' . $items->cid . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
			}

             if(isset($items->e_way_status)){
                if($items->e_way_status < 1 ){
                    $act = $act . ' <button sales_id = "'. $items->cid.'" data-toggle="tooltip" title="Edit" class="btn btn-success e-way">Generate e-way</span></button>';
                }
            }
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
	
	 public function bill($id) {
        $this->generateBill($id);
    }
	
    private function generateBill($id) {
		$format  ='bill';
		$size =20;
		$orient = 'A4';
		$pdf_type = "Mpdf";
		$paper = 'A4';
		$this->load->library('M_pdf');
        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
        $this->m_pdf->load();
        $pdf = $this->m_pdf->pdf;
		$this->lang->load('en_site', 'en');
        $this->language = "en";
		$transfer = $this->items->get_transfer($id);
		$taxdetails = $this->items->taxdetails($id);
		$totals = $this->items->gettotals($id);
        $tcnt = $this->items->getTransferItemscnt($id);
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
           $list = $this->items->getTransferItems($id, $len, $size);
           $this->pages($pdf, $list, $transfer, $size, $len, $format, $i, $inc,$orient,$pdf_type,$taxdetails,$totals);
       }
	   $pdf->Output('example_021.pdf', 'I');
	}
	
	
	function pages($pdf, $list, $transfer, $size, $len, $format, $i, $inc,$orient,$pdf_type,$taxdetails,$totals){
		if (count($list) != 0) {
			$papersiize = 'A4';
            $paperorient = $this->items->getValue('paperorient');  
			$pdf->AddPage('P', 'A4');
			$data['msd'] = $this->Show_Amount_In_Words(round($totals['total'],0));
			$data['transfer'] = $transfer;
			$data['size'] = $size;
			$data['len'] = $len;
			$data['inc'] = $inc;
			$data['totals'] = $totals;
            $data['cpz'] = $i;
			$data['taxdetails'] = $taxdetails;
			$data['transfer_items'] = $list;
			$data['company'] = $this->items->getCompany();
			$settings = $this->items->getCompanySettings();
            $data['settings'] = $settings;
            $html = $this->load->view('master/items/bill', $data, true);
			//ob_end_clean();
            $pdf->writeHTML($html);
		}
	}

}
