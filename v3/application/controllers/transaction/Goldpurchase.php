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
class Goldpurchase extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('ledgers_model', 'ledgers');
        $this->load->model('goldpurchase_model', 'purchase');
        $this->load->model('inventory_model/Items_model', 'item');
    }
	

    public function listall($type = 'O') {
        $data['title'] = 'Old Purchase';
        if($type =='N'){
            $data['title'] = 'Purchase';
        }
        $data['settings'] = $this->purchase->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = 'Purchase';
        $data['purchase_type'] = $type;
        $this->load->view('transaction/goldpurchase/list_all', $data);
    }


    function create($purchase_type,$id = 0) {
        $is_edit = 1;
        $data['is_edit'] = $is_edit;
        if($id < 1 ){
            $data['is_edit'] = 1 ;
        }
        $data['id'] = $id;
        $data['purchase_type'] = $purchase_type;
        $data['view'] = 'create';
        $zeroindex = $this->purchase->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/goldpurchase/create', $data);
    }


    public function ajax_list() {
        $this->purchase->where();
        $list = $this->purchase->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $purchase_type = $this->input->post('purchase_type');
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->in_date;
            $row[] = $item->invoice;
            $row[] = $item->name;
            $row[] = $item->total;
            if($item->old_pur_id < 1){
                $act = '<a  href="' . base_url() . 'transaction/goldpurchase/create/' . $purchase_type . '/'.$item->pid.'" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            }else{
                $act = '';
            }

            $act = $act . ' <a  class="btn btn-info "  href="' . base_url() . 'transaction/goldpurchase/create/' . $purchase_type . '/'.$item->pid.'" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
            $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/goldpurchase/bill/' . $item->pid . '/1" data-toggle="tooltip" title="Sales Bill" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';

                   // $act = $act . '&nbsp;<a tp="confirm" base="' . base_url() . 'transaction/customers/listall' . '"  success="Delete ' . $item->invoice . ' successfuly "  message="Do you want Delete ' . $item->invoice . '?"  href="' . base_url() . 'transaction/goldsales/delete/' . $item->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            //$act = $act . '<iframe style="display:none" tp="pdf" target="_blank" src="https://api.qrserver.com/v1/create-qr-code/?size=250x250&data='.$item->id.'">';
			 
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->purchase->count_all(),
            "recordsFiltered" => $this->purchase->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }
    public function save() {
        $this->purchase->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        
        echo json_encode($response);
    }

    public function getsing($id){
        $this->purchase->getsing($id);
    }

   

    public function bill($id, $is_download = 'view') {
        $this->generateBill($id,$is_download);
    }

    private function generateBill($id,$is_download) {
		 $qry = "SELECT sum(total) - sum(tax) as beforetax,sum(quantity) as quantity FROM `purchase_items` WHERE published = 'yes' and purchase_id = ".$id." ";
		$summary =  $this->db->query($qry)->row_array();
        //$this->load->view('transaction/purchase/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        $size = 35;
        $paper ='A4';
        $this->load->library('M_pdf');
            $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
            $this->m_pdf->load();
            $pdf = $this->m_pdf->pdf;
          
            $this->lang->load('en_site', 'en');
            $this->language = "en";
          
        $purchase = $this->purchase->getpurchase($id);
        $purchase = $this->purchase->getpurchase($id);

        $order_id = $purchase[0]['order_id'];
        $order_details = "";
        if ($order_id != "0") {
            $order_details = $this->purchase->getorderdetails($order_id);
        }
        $tcnt = $this->purchase->getpurchaseItemscnt($id);
        $hcnt = $this->purchase->getHsnItemscnt($id);
        $papersiize = $this->purchase->getValue('paper');
        $hsn = $this->purchase->getHsnItems($id);
		
        if ($papersiize == 'A4') {
            $size = 30; //38
        }
        $login_comid = $this->session->userdata('login_comid');
        if(strtolower($login_comid) === 'shanthi'){
            $size = 15;
        }
        $img_file = '';
        $inc = ($tcnt  + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->purchase->getpurchaseItems($id, $len, $size);
            $this->pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details,$is_download,$i,$inc,$summary);
        }
//        ob_end_clean();

        if ($is_download == 'download') {
            $pdf->Output($purchase[0]['invoice'] . '.pdf', 'D');
        } else {
            $pdf->Output('example_021.pdf', 'I');
        }
    }

    function pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details,$is_download,$i,$inc,$summary) {
//        if (count($list) != 0) {
        $papersiize = $this->purchase->getValue('paper');
        $paperorient = $this->purchase->getValue('paperorient');
        $pdf->AddPage($paperorient, $papersiize);
        $data['msd'] = $this->Show_Amount_In_Words($purchase[0]['total']);
        $data['sales'] = $purchase;
        $data['size'] = $size;
        $data['summary'] = $summary;
        $data['note'] = '';
		$data['inc'] = ceil($inc);
        $data['cpz'] = $i;
        $data['order_details'] = $order_details;
        $data['len'] = $len;
        $data['hsn'] = $hsn;
        if ($purchase[0]['pub'] == 'no') {
            $img_file = base_url() . 'assets/images/cancelled.png';
            $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
        }
        $data['sales_items'] = $list;
        $data['company'] = $this->purchase->getCompany();
		if($purchase[0]['ptp'] == 'order' ){
		    if($this->session->userdata('login_comid') != 'sifet'){
				$html = $this->load->view('transaction/purchase/purchase_order', $data, true);
			}else{
				$html = $this->load->view('transaction/purchase/porder', $data, true);
			}
		}else{
			$html = $this->load->view('transaction/purchase/billgold', $data, true);
		}
        $pdf->writeHTML($html);
        // $pdf->Image($img_file, 110, 90, 40, 29);
    }

//    }
}
