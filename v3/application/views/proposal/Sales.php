<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of sales
 *
 * @author u43255
 */
 
defined('BASEPATH') or exit('No direct script access allowed');
use AliAbdalla\Tafqeet\Core\Tafqeet;
class Sales extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }
	
	public function check_customer(){
		$name = $this->input->post('supname');
		$qry = "select * from suppliers where name ='".$name."'";
		$result = $this->db->query($qry)->result_array();
        echo json_encode($result);

	}
	
	public function assign(){
		$this->sales->assign();
	}

    public function listall($type) {
        $this->output->cache(1);
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/sales/list_all', $data);
    }

    public function getinoviceno($type) {
        print_r($this->sales->getinoviceno($type));
    }

    public function upload_image() {
        if (isset($_FILES['file'])) {
            $ms = $_FILES['file'];
            //upload file
            $config['upload_path'] = 'uploads/company/';
            $config['allowed_types'] = '*';
            $config['max_filename'] = '255';
            $config['max_size'] = '10240'; //1 MB
            $new_name = time() . $_FILES["file"]['name'];
            $config['file_name'] = $new_name;
            $this->load->library('upload', $config);
            $this->upload->do_upload('file');
            echo $new_name;
        }
    }

    public function alreadyexistcheck() {
        print_r($this->sales->alreadyexistcheck());
    }

    public function getnewinoviceno($type) {
        print_r($this->sales->getnewinoviceno($type));
    }

    public function getcoupon() {
        $search = strtolower($_GET['term']);
        return $this->sales->getcoupon($search);
    }

    function delete($type, $id) {
        $this->sales->delete($type, $id);
    }

    function ledbal($id) {
        $data = $this->sales->ledbalid($id);

        $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $data['id'], 'cl');
        if ($data['type'] == 'Dr') {
            if ($amt < 0) {
                echo $amt * -1 . 'Cr';
            } else {
                echo $amt . 'Dr';
            }
        }
        if ($data['type'] == 'Cr') {
            if ($amt < 0) {
                echo $amt * -1 . 'Dr';
            } else {
                echo $amt . 'Cr';
            }
        }
    }

    function cancel($type, $id) {
        $this->sales->cancel($type, $id);
    }

    public function ajax_list() {
		$tmp = $this->session->userdata('user');
        $userid = $tmp['Id'];
		$user_type  = $tmp['user_type'];
        $this->sales->where();
        $max = $this->sales->max();
        $max_id = $max['max_id'];
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $vouchers) {
			$chk_assign = '';
			if ($vouchers->is_assigned < 1 && $vouchers->stype == 'estimate') {
					$chk_assign ='<input class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->sales_id . '"> ';
			}else if((int) $user_type < 2 && $vouchers->stype == 'estimate' ) {
					$chk_assign ='<input class="enquiry" type="checkbox" name="check[]" value="' . $vouchers->sales_id . '"> ';

			}
            $no++;
            $row = array();
            $row[] = $chk_assign.$no;
            $row[] = $vouchers->invoice;
            $row[] = $vouchers->in_date;
            if ($vouchers->customer_id == 0) {
                $row[] = $vouchers->cusname;
            } else {
                $row[] = $vouchers->name;
            }

            // $row[] = $vouchers->narration;
            // $row[] = $vouchers->tax;
            $row[] = $vouchers->total;
            if ($vouchers->cash_status == 0) {
                $row[] = 'Cash Not Collected';
            } else {
                $row[] = 'Cash  Collected';
            }
            $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
			$act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '/view"  title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
			$act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/5" data-toggle="tooltip" title="Print Slip" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
            if ($vouchers->is_assigned  <1 ){
				$act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
            }else{
				if($vouchers->salesman == $userid){
					$act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>';
				}
				
			}
			$act = $act . ' <a href="' . base_url() . 'transaction/sales_check/edit/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Verify" class="btn btn-info"><span class="fa fa-barcode"></span></a>';
            if ($vouchers->sales_id == $max_id) {
          //  if ($vouchers->sales_id == $vouchers->sales_id) {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"  success="Delete ' . $vouchers->invoice . ' successfuly "  message="Do you want Delete ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/delete/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            } else {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/sales/listall/' . $vouchers->stype . '"   success="Cancelled ' . $vouchers->invoice . ' successfuly "  message="Do you want Cancel ' . $vouchers->invoice . '?"  href="' . base_url() . 'transaction/sales/cancel/' . $vouchers->stype . '/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            }
            if ($vouchers->pub != 'yes') {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/sales/bill/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
                        . ' <a href="' . base_url() . 'transaction/sales/sales/view/' . $vouchers->sales_id . '/' . $vouchers->printtype . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
            }
			if ($vouchers->is_assigned < 1 && $vouchers->stype == 'estimate') {
                    $act .= ' <a  '.$vouchers->type.' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="'.$vouchers->invoice.'" assign_id = "'.$vouchers->sales_id.'" data-target="#myAssignModal">Assign</span></a>';
			}else if((int) $user_type < 2 && $vouchers->stype == 'estimate' ){
                    $act .= ' <a  '.$vouchers->type.' back="' . base_url() . 'transaction/sales/listall/estimate" id = "assign"   data-toggle="tooltip" title="Assign" type="button" class="btn btn-success assign" data-toggle="modal" assign_invoice="'.$vouchers->invoice.'" assign_id = "'.$vouchers->sales_id.'" data-target="#myAssignModal">ReAssign</span></a>';
			}
			if($vouchers->stype == 'delivery_note' && $vouchers->status != 'completed'){
					$act = $act . ' <a href="' . base_url() . 'transaction/sales/sales/sales/0/no/' . $vouchers->sales_id . '" data-toggle="tooltip" title="Edit" class="btn btn-success">Add Sales</span></a>';
			}
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all_sales(),
            "recordsFiltered" => $this->sales->count_filtered_sales(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getprinttype($printtype_id) {
        return $this->sales->getprinttype($printtype_id);
    }

    public function sales($type, $id = 0, $copy = 'no',$deliver_note = 0 ) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['copy'] = $copy;
		$data['deliver_note'] = $deliver_note;

        $data['type'] = $type;
        $data['viewtype'] = $type;
        if ($copy == "view") {
            $data['viewtype'] = $copy;
        }
        $qry = "SELECT IFNULL(sum(case when type='sales' then total else 0 end ) - sum(case when type='sales_return' then total else 0 end ),0) as returntotal from sales where published='yes' and invoice_date = CURDATE()";
        $query = $this->db->query($qry)->row_array();
        $data['daybalance'] = $query['returntotal'];
        $zeroindex = $this->sales->zeroindex();
        $settings = $this->sales->getCompanySettings();
        $data['zeroindex'] = $zeroindex;
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales', $data);
    }

    /* estimate start */

    public function estimate($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $zeroindex = $this->sales->zeroindex();
        $settings = $this->sales->getCompanySettings();
        $data['zeroindex'] = $zeroindex;
        $data['settings'] = $settings;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/estimate', $data);
    }

    /* estimate End */

    public function sales8b($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8b', $data);
    }

    public function sales8($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('transaction/sales/sales8', $data);
    }

    public function sales_return($id = 0) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $this->load->view('transaction/sales/salesr', $data);
    }

    public function view($id) {
        $data['id'] = $id;
        $data['type'] = 'View';
        $data['dprate'] = $this->sales->getValue('dprate');
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/sales/view', $data);
    }

    public function save($type) {
        $is_bkground_print = $this->input->post('is_bkground_print');
        $sale_id = $this->input->post('id');
        $printtype = $this->input->post('printtype');
        $id = $this->sales->save($type);

        if ($id != 0) {
            $response = array(
                'valid' => false,
                'type' => 1,
                'bill' => base_url() . 'transaction/sales/bill/' . $id . '/' . $printtype,
                'message' => 'Saved Successfully.'
            );
            if ($is_bkground_print == 0) {
                $response['bill'] = base_url() . 'transaction/sales/bill/' . $id . '/' . $printtype;
            }
            echo json_encode($response);
        }
    }

    public function bill($id, $size) {
        $this->generateBill($id, $size);
    }

    private function generateBill($id, $size) {
        $bill_format = $this->sales->getformat($size);
        $format = $bill_format['code'];
        $size = $bill_format['pagesize'];
		$orient = $bill_format['page'];
        $paper = $bill_format['paper'];
        $pdf_type = $bill_format['pdf_type'];
        $img_file = base_url() . 'assets/images/Desert.jpg';
        $sale = $this->sales->getSales($id);
        if ($pdf_type == "Mpdf") {
            $this->load->library('M_pdf');
            $this->m_pdf->param = ['mode' => 'utf-8', 'format' => json_decode($paper), 'autoPageBreak' => TRUE];
            $this->m_pdf->load();
            $pdf = $this->m_pdf->pdf;
            if ($bill_format['language'] == 'Arabic') {
                $this->lang->load('ac_site', 'ac');
                $this->language = "ac";
            } else {
                $this->lang->load('en_site', 'en');
                $this->language = "en";
            }
            if ($this->language == 'ac') {
                $pdf->SetDirectionality('rtl');
            }
        } else {
            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetCreator(PDF_CREATOR);
            $com = $this->sales->getCompany();
            $pdf->SetAuthor($com['name']);
            $pdf->SetTitle($com['name']);
            $pdf->SetSubject($com['name']);
            $img_file = base_url() . 'assets/images/Desert.jpg';
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->SetMargins(5, 0, 5, 0);
            $pdf->SetAutoPageBreak(TRUE, 0);
        }

        $amt = 0;
        if ($sale[0]['cusid'] > 0) {
            $ledb = $this->sales->ledbalid($sale[0]['cusid']);
            if ($ledb['id'] != "") {
                $amt = $this->ledgers->getLedegerbalance(date('d/m/Y'), $ledb['id'], 'cl');
            }
        }
        if ($amt < 0) {
            $amt = round(($amt * -1), 2);
        } else {
            $amt = $amt;
        }
        $sale[0]['paper'] = $bill_format['paper'];
        $sale[0]['pending'] = $amt;
        $amt = $amt;
        $sale[0]['gtot'] = $amt;
        $tcnt = $this->sales->getSalesItemscnt($id);
        $hcnt = $this->sales->getHsnItemscnt($id);
        $papersiize = $this->sales->getValue('paper');
        $hsn = $this->sales->getHsnItems($id);
        $gst = $this->sales->getgstItems($id);
        $taxparticulars = $this->sales->gettaxparticulars($id);
        if ($papersiize == '[65, 5000]') {
            $size = $tcnt;
        }
        if ($papersiize == 'A4') {
            if ($size == 'half') {
                $size = 8;
            }
            if ($size == 'full') {
                $size = 40;
            }
        }
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
        $pri_type = 'Customer Copy';
        for ($q = 0; $q < 1; $q++) {
            if ($q > 0) {
                $pri_type = 'Duplicate';
            }
            for ($i = 0; $i < $inc; $i++) {
                $len = $size * $i;
                $list = $this->sales->getSalesItems($id, $len, $size);
                $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type,$orient);
            }
        }
        $pdf->Output('example_021.pdf', 'I');
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type,$orient) {
        if (count($list) != 0) {
            $papersiize = $sale[0]['paper'];
            $paperorient = $this->sales->getValue('paperorient');
			if($orient!='L'){
				$orient =  $paperorient;
			}
			$pdf->AddPage($orient, $papersiize);
			//$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            // $pdf->AddPage($paperorient, $papersiize);
            //$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            $img_file2 = base_url() . 'assets/images/15371797581022381971536753.png';
            $data['msd'] = $this->Show_Amount_In_Words(round($sale[0]['total'],0));
            //$data['msd_ac'] = $this->Show_Amount_In_Words($sale[0]['total'],'ac');
			//$data['msd_ac'] = Tafqeet::arablic($sale[0]['total']);

            $data['sales'] = $sale;
            $data['taxparticulars'] = $taxparticulars;
            $data['size'] = $size;
            $data['pri_type'] = $pri_type;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            $data['gst'] = $gst;
            $data['inc'] = $inc;
            $data['cpz'] = $i;
					$pdf->SetDefaultBodyCSS('background', "url('".base_url() ."assets/images/thumbnail_IMG-20200919-WA0009.jpg')");
             $pdf->SetDefaultBodyCSS('background-image-resize', 6);
            if ($sale[0]['pub'] == 'no') {
                $img_file = base_url() . 'assets/images/cancelled.png';
                $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
            }
            $data['sales_items'] = $list;
            $data['company'] = $this->sales->getCompany();
			if(isset($data['company']['watermark'])){
				$pdf->SetWatermarkImage(base_url() . 'assets/images/watermark.jpg', 0.02,[210,180],[0,0]);
				$pdf->showWatermarkImage = true;
			}
            $settings = $this->sales->getCompanySettings();
            $data['settings'] = $settings;
            //$this->load->view('transaction/sales/bill1', $data);       
            $html = $this->load->view('transaction/sales/' . $format, $data, true);
			//ob_end_clean();
            $pdf->writeHTML($html);
        }
    }

}
