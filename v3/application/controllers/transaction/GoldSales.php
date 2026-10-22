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

class Goldsales extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('GoldSales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function listall($type = 'sales') {
        $data['title'] = 'Sales';
        $data['settings'] = $this->sales->getCompanySettings();
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/goldsales/list_all', $data);
    }

    function delete($id){
        $this->sales->delete($id);
    }

    public function ajax_list() {
        $this->sales->where();
        $list = $this->sales->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        $type = $this->input->post('type');
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $item->in_date;
            $row[] = $item->invoice;
            $row[] = $item->cusname;
            $row[] = $item->total;
            if(strtolower($this->input->post('type')) =='sales'){
                $act = '<a  href="' . base_url() . 'transaction/goldsales/create/' . $item->sales_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                <a  class="btn btn-info "  href="' . base_url() . 'transaction/goldsales/create/' . $item->sales_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/goldsales/bill/' . $item->sales_id . '/1" data-toggle="tooltip" title="Sales Bill" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
                if($item->old_pur_id > 0 ){
                    $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/goldpurchase/bill/' . $item->old_pur_id . '/1" data-toggle="tooltip" title="Old Purchase" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
                }
            }else{
                $act = '<a  href="' . base_url() . 'transaction/goldsales/return/' . $item->sales_id . '" title="Edit" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
                <a  class="btn btn-info "  href="' . base_url() . 'transaction/goldsales/return/' . $item->sales_id . '" title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>';
                $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/goldsales/bill/' . $item->sales_id . '/1" data-toggle="tooltip" title="Sales Bill" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>';
                if($item->old_pur_id > 0 ){
                    $act = $act . ' <a tp="pdf" href="' . base_url() . 'transaction/goldpurchase/bill/' . $item->old_pur_id . '/1" data-toggle="tooltip" title="Old Purchase" class="btn btn-warning"><span class="glyphicon glyphicon-print"></span></a>';
                }
            }
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/goldsales/listall/' . $this->input->post('type') . '"  success="Delete ' . $item->invoice . ' successfuly "  message="Do you want Delete ' . $item->invoice . '?"  href="' . base_url() . 'transaction/goldsales/delete/' . $item->sales_id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            $row[] = $act;
            $data[] = $row;
        }
        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->sales->count_all(),
            "recordsFiltered" => $this->sales->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function getsing($id){
        $this->sales->getsing($id);
    }

    public function create($id = 0,$view = 'create'){
        $is_edit = 1;
        $data['is_edit'] = $is_edit;
        if($id < 1 ){
            $data['is_edit'] = 1 ;
        }
        $data['id'] = $id;
        $data['view'] = $view;
        $zeroindex = $this->sales->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $settings = $this->sales->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/goldsales/create', $data);
    }

    public function return($id = 0,$view = 'create'){
        $is_edit = 1;
        $data['is_edit'] = $is_edit;
        if($id < 1 ){
            $data['is_edit'] = 1 ;
        }
        $data['id'] = $id;
        $data['view'] = $view;
        $zeroindex = $this->sales->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $settings = $this->sales->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/goldsales/return', $data);
    }

    public function search_item(){
        $search = $this->input->post('term');
        $date = $this->input->post('date');
        if($this->input->post('date')){
            $date = $this->sales->getDate($this->input->post('date'));
        }
        return $this->sales->search_item($search,$date);
    }

    public function save(){
        $this->sales->save();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        
        echo json_encode($response);
    }

    public function save_return(){
        $this->sales->save_return();
        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        
        echo json_encode($response);
    }


    
    public function bill($id, $size, $is_download = 'view')
    {
        $this->generateBill($id, $size, $is_download);
    }

    private function generateBill($id, $size, $is_download = 'view')
    {
		$qry = "select IFNULL(sum(amount),0) as amt from sales_ledgers where published ='yes' and sales_id = ".$id." ";
		$add_amount = $this->db->query($qry)->row_array();
		$add_amount = $add_amount['amt'];
        $qry = "SELECT sum(ces_amt) as ces,sum(u.unit_count * a.quantity) as altqty,sum(free_quantity) as free_quantity,sum(total) as total,sum(dis_amt) as dis_amt FROM `sales_items`  as a left join units as u on u.id= a.unit_id WHERE a.published ='yes' and sales_id = " . $id;
        $query = $this->db->query($qry)->row_array();
        $btot_altqty =  $query['altqty'];
        $btot_free_quantity =  $query['free_quantity'];
        $btot_total =  $query['total'];
        $btot_dis_amt =  $query['dis_amt'];
        $bill_kfc = $query['ces'];
        $bill_format = $this->sales->getformat($size);
        $format = $bill_format['code'];
        $size = $bill_format['pagesize'];
        $size_half = $size;
        if (isset($bill_format['half_pagesize'])) {
            if ((int) $bill_format['half_pagesize'] > 0) {
                $size_half = $bill_format['half_pagesize'];
            }
        }
        $orient = $bill_format['page'];
        $paper = $bill_format['paper'];
        $pdf_type = $bill_format['pdf_type'];
        $print_settings  = '[{"Field":"item_name","Field_name":"item_name","Isvisible":"YES","display_as":"Item","width":"120px"},{"Field":"item_barcode","Field_name":"item_barcode","Isvisible":"YES","display_as":"Barcode","width":"40px"},{"Field":"hsn_code","Field_name":"hsn_code","Isvisible":"NO","display_as":"HSN","width":"40px"},{"Field":"item_quantity","Field_name":"item_quantity","Isvisible":"YES","display_as":"Quantity","width":"40px"},{"Field":"MRP","Field_name":"MRP","Isvisible":"NO","display_as":"MRP","width":"40px"},{"Field":"Rate","Field_name":"Rate","Isvisible":"YES","display_as":"Rate","width":"40px"},{"Field":"discount","Field_name":"discount","Isvisible":"NO","display_as":"Discount","width":"40px"},{"Field":"beforetax","Field_name":"beforetax","Isvisible":"NO","display_as":"Amount","width":"40px"},{"Field":"taxpercentage","Field_name":"taxpercentage","Isvisible":"NO","display_as":"GST %","width":"40px"},{"Field":"SGST","Field_name":"SGST","Isvisible":"YES","display_as":"SGST","width":"40px"},{"Field":"CGST","Field_name":"CGST","Isvisible":"YES","display_as":"CGST","width":"40px"},{"Field":"item_cess","Field_name":"item_cess","Isvisible":"YES","display_as":"Item Cess","width":"40px"},{"Field":"Total","Field_name":"Total","Isvisible":"YES","display_as":"Total","width":"40px"}]';
        $footer_settings = '[{"Field":"Before_Tax","Isvisible":"YES","display_as":"Before Tax"},{"Field":"SGST","Isvisible":"YES","display_as":"SGST"},{"Field":"CGST","Isvisible":"YES","display_as":"CGST"},{"Field":"Total_tax","Isvisible":"YES","display_as":"Tax"},{"Field":"Item_cess","Isvisible":"YES","display_as":"Item Cess"},{"Field":"KFC","Isvisible":"YES","display_as":"KFC"},{"Field":"Bill_discount","Isvisible":"YES","display_as":"Bill Discount"},{"Field":"Bill_total","Isvisible":"YES","display_as":"Bill Total"},{"Field":"Terms","Isvisible":"YES","display_as":"Terms"},{"Field":"Bank_details","Isvisible":"YES","display_as":"Bank Details"}]';
        if (isset($bill_format['print_settings'])) {
            $print_settings = $bill_format['print_settings'];
            $footer_settings = $bill_format['footer_settings'];
        }
        $img_file = base_url() . 'assets/images/Desert.jpg';
        $sale = $this->sales->getSales($id);
        $sale[0]['btot_altqty'] = $btot_altqty;
        $sale[0]['btot_free_quantity'] = $btot_free_quantity;
        $sale[0]['btot_total'] = $btot_total;
         $sale[0]['btot_dis_amt'] = $btot_dis_amt;
		$sale[0]['add_amount'] = $add_amount;
        $sale[0]['bill_kfc'] = 0;
        if ($sale[0]['saletype'] == 'b2c') {
            $sale[0]['bill_kfc'] = $bill_kfc;
        }
        if ($sale[0]['paper_size'] != 'full') {
            $size = $size_half;
        }
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

            if(strtolower($this->session->userdata('login_comid')) == 'afinity' ){ 
                $pdf->SetFooter('<div style = "padding:0px;margin:0px;" id="footer" class="printable">
                <img align="middle"  style="margin: 0px"   src="uploads/company/B.jpg" /> 	
			    </div>');
                
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
           // $img_file = base_url() . 'assets/images/Desert.jpg';
            // $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
            $pdf->SetMargins(5, 0, 5, 0);
            $pdf->SetAutoPageBreak(TRUE, 0);
        }

        $amt = 0;
        if ($sale[0]['cusid'] > 0) {
            $ledb = $this->sales->ledbalid($sale[0]['cusid']);
            if ($ledb['id'] != "") {
                $amt = $this->ledgers->getLedegerbalance($sale[0]['informatdate'], $ledb['id'], 'cl');
            }
        }
        if ($amt < 0) {
            $amt = round(($amt * -1), 2);
        } else {
            $amt = $amt;
        }
        $previous = $amt;
        if ($sale[0]['cash_type'] == 'Credit') {
			if($sale[0]['stype'] != 'estimate'){
                if($sale[0]['stype'] == 'sales'){
				    $previous = $amt - $sale[0]['total'];
                }else{
                     $previous = $amt + $sale[0]['total'];
                }
			}
        }
        $sale[0]['paper'] = $bill_format['paper'];
        $sale[0]['pending'] = $amt;
        $amt = $amt;
        $sale[0]['gtot'] = $amt;
        $sale[0]['previous'] = $previous;
        $tcnt = $this->sales->getSalesItemscnt($id);
        $hcnt = $this->sales->getHsnItemscnt($id);
        $papersiize = $this->sales->getValue('paper');
        $hsn = $this->sales->getHsnItems($id);
        $hsndetails = $this->sales->getHsndetails($id);
		$hsnsize = sizeof($hsndetails);
        $gst = $this->sales->getgstItems($id);
        $taxparticulars = $this->sales->gettaxparticulars($id);
        $sales_ledgers = $this->sales->getsales_ledgers($id);

        $qry = "select sum(quantity) as qty from sales_items where published = 'yes' and sales_id = " .$id;
        $q_data = $this->db->query($qry)->row_array();
        $qty = $q_data['qty'];
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
		if($sale[0]['stype'] == 'estimate' && $format == 'raj'){
			$size = $size + 12;
		}
		if($sale[0]['stype'] == 'bill1_hsn'){
			$tcnt = (float) $tcnt + (float) $hsnsize;
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
        $pri_type = 'Original';
		$cntl = 1;
		if($this->session->userdata('login_comid') == 'tbr' && $sale[0]['stype'] != 'estimate' ){
			$cntl = 4;
		}
        if($this->session->userdata('login_comid') == 'tbr2022' && $sale[0]['stype'] != 'estimate' ){
			$cntl = 4;
		}
		$page_function  = 0;
        for ($q = 0; $q < $cntl; $q++) {
            if ($q > 0) {
                $pri_type = 'Duplicate';
            }
			if ($q > 1) {
                $pri_type = 'Triplicate';
            }
            if ($q > 2) {
                $pri_type = 'Quadruplicate';
            }
            for ($i = 0; $i < $inc; $i++) {
                $len = $size * $i;
                $list = $this->sales->getSalesItems($id, $len, $size);
                $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function, $qty);
				$page_function = $page_function + 1 ;
			}
        }
        if ($is_download == 'download') {
            $pdf->Output($sale[0]['invoice'] . '.pdf', 'D');
        } else {
            $pdf->Output('example_021.pdf', 'I');
        }
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function = 1, $qty = 0)
    {
        if (count($list) != 0 ||  $sales_ledgers->num_rows() > 0  ) {
             $qry = "SELECT sum(ces_amt) as ces,sum(u.unit_count * a.quantity) as altqty,sum(free_quantity) as free_quantity,sum(total) as total,sum(dis_amt) as dis_amt FROM `sales_items`  as a left join units as u on u.id= a.unit_id WHERE a.published ='yes' and sales_id = " . $sale[0]['sales_id'];
            $query = $this->db->query($qry)->row_array();
            $btot_altqty =  $query['altqty'];
            $btot_free_quantity =  $query['free_quantity'];
            $btot_total =  $query['total'];
            $btot_dis_amt =  $query['dis_amt'];
            $sale[0]['btot_altqty'] = $btot_altqty;
            $sale[0]['btot_free_quantity'] = $btot_free_quantity;
            $sale[0]['btot_total'] = $btot_total;
            $sale[0]['btot_dis_amt'] = $btot_dis_amt;

			if($this->session->userdata('login_comid') == 'mayooram'  ){

            $qry = "select * from e_way where sales_id = ".$sale[0]['sales_id']." and status > 0 ";
            $e_way_data = $this->db->query($qry);
			$data['e_way_data'] = $e_way_data;


            $qry = "select * from e_invoice where sales_id = ".$sale[0]['sales_id']." and status > 0 ";
            $e_invoice_data = $this->db->query($qry);
			$data['e_invoice_data'] = $e_invoice_data;
            if($e_invoice_data->num_rows() > 0 ){
                $e_invoice_data= $e_invoice_data->row_array();
                if($e_invoice_data['SignedQrCode'] != '' && $e_invoice_data['SignedQrCode'] != 'NULL' ){
                    if($sale[0]['einvoiceqrcode'] =='' ){
                        $this->load->library('ciqrcode');
                        $qr_image = rand() . '.png';
                        $params['data'] = $e_invoice_data['SignedQrCode'];
                        $params['level'] = 'H';
                        $params['size'] = 8;
                        $params['savename'] = FCPATH . "uploads/" . $qr_image;
                        if ($this->ciqrcode->generate($params)) {
                            $qry = "update sales set einvoiceqrcode ='".$qr_image."' where sales_id =  ".$sale[0]['sales_id'];
                            $this->db->query($qry);
                            $sale[0]['einvoiceqrcode'] = $qr_image;
                        }
                    }
                }
            }
        }

            $qry = "select sum(quantity) as qty,sum(total - tax - itm_raw_ces) as bef,sum(total) as saletot from sales_items where published = 'yes' and sales_id = " .$sale[0]['sales_id'];
             $q_data = $this->db->query($qry)->row_array();
            $qty = $q_data['qty'];
            $bef = $q_data['bef'];
            $saletot = $q_data['saletot'];
            $papersiize = $sale[0]['paper'];
            $sale[0]['befo'] = $bef;
            $sale[0]['saletot'] = $saletot;
            $paperorient = $this->sales->getValue('paperorient');
            if ($orient != 'L') {
                $orient =  $paperorient;
            }
			
			
            $pdf->AddPage($orient, $papersiize,'','','');
            //$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            // $pdf->AddPage($paperorient, $papersiize);
            //$this->m_pdf->param = ['mode' => 'utf-8', 'format' => [210,50], 'autoPageBreak' =>FALSE];
            $img_file2 = base_url() . 'assets/images/15371797581022381971536753.png';
            $data['msd'] = $this->Show_Amount_In_Words(round($sale[0]['total'], 0));
            //$data['msd_ac'] = $this->Show_Amount_In_Words($sale[0]['total'],'ac');
            //$data['msd_ac'] = Tafqeet::arablic($sale[0]['total']);
			$data['page_function']= $page_function;
            $data['sales'] = $sale;
            $data['taxparticulars'] = $taxparticulars;
            $data['sales_ledgers'] = $sales_ledgers;
			$data['packed_by'] = '';
			if($this->session->userdata('login_comid') != 'mayooram'  ){
				$qry = "select * from users where Id = '".$sale[0]['packed_by']."'  ";
				$packed = $this->db->query($qry);
				if($packed->num_rows() > 0 ){
					$packed = $packed->row_array();
					$data['packed_by'] = $packed['user_name'];
				}
			}
            $data['size'] = $size;
            $data['pri_type'] = $pri_type;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            $data['hsndetails'] = $hsndetails;
            $data['qty'] = $qty;
            $data['tot_qty'] = $qty;
            $data['gst'] = $gst;
            $data['inc'] = $inc;
            $data['cpz'] = $i;
            if ($pdf_type == 'Mpdf') {
                $pdf->SetDefaultBodyCSS('background', "url('" . base_url() . "assets/images/thumbnail_IMG-20200919-WA0009.jpg')");
                $pdf->SetDefaultBodyCSS('background-image-resize', 6);
            }
            if ($sale[0]['pub'] == 'no') {
                $img_file = base_url() . 'assets/images/cancelled.png';
                $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
            }

           
            $data['footer_settings'] = json_decode($footer_settings);
            $data['print_settings'] = json_decode($print_settings);
            $data['sales_items'] = $list;
            $data['company'] = $this->sales->getCompany();
            if (isset($data['company']['watermark'])) {
                $pdf->SetWatermarkImage(base_url() . 'assets/images/watermark.jpg', 0.02, [210, 180], [0, 0]);
                $pdf->showWatermarkImage = true;
            }
			
			$qry = "SELECT sum(ifnull(b.tax,0)) as tax,a.GST,sum(IFNULL(b.total,0)-IFNULL(b.tax,0)-IFNULL(CASE WHEN sale.cess > 0 then b.ces_amt else 0 end,0) -IFNULL(itm_raw_ces,0)) as total,sum(itm_raw_ces ) as ces_amt from taxgst as a left join sales_items as b on a.gstid = b.tax_id and b.published ='yes' and b.sales_id=".$sale[0]['sales_id']." left join sales as sale on sale.sales_id = b.sales_id where 1 GROUP by a.gstid order by a.gst asc";
			$data['new_taxparticulars'] = $this->db->query($qry)->result_array();
            if(strtolower($this->session->userdata('login_comid')) == 'afinity' ){ 
                $data['msd'] = $this->numberTowords($sale[0]['total'] / $sale[0]['dollar_value']);
            }
            $settings = $this->sales->getCompanySettings();
            $data['settings'] = $settings;
            //$this->load->view('transaction/sales/bill1', $data);       
            $html = $this->load->view('transaction/sales/' . $format, $data, true);
			$repeat_bill = 0 ;
			if(isset($settings[0]['repeat_bill']) ){
				$repeat_bill = $settings[0]['repeat_bill'];
			}
			
            $pdf->writeHTML($html);
            //ob_end_clean();
        }
    }


    function numberTowords($num)
{

        $ones = array(
        0 =>"ZERO",
        1 => "ONE",
        2 => "TWO",
        3 => "THREE",
        4 => "FOUR",
        5 => "FIVE",
        6 => "SIX",
        7 => "SEVEN",
        8 => "EIGHT",
        9 => "NINE",
        10 => "TEN",
        11 => "ELEVEN",
        12 => "TWELVE",
        13 => "THIRTEEN",
        14 => "FOURTEEN",
        15 => "FIFTEEN",
        16 => "SIXTEEN",
        17 => "SEVENTEEN",
        18 => "EIGHTEEN",
        19 => "NINETEEN",
        "014" => "FOURTEEN"
        );
        $tens = array( 
        0 => "ZERO",
        1 => "TEN",
        2 => "TWENTY",
        3 => "THIRTY", 
        4 => "FORTY", 
        5 => "FIFTY", 
        6 => "SIXTY", 
        7 => "SEVENTY", 
        8 => "EIGHTY", 
        9 => "NINETY" 
        ); 
        $hundreds = array( 
        "HUNDRED", 
        "THOUSAND", 
        "MILLION", 
        "BILLION", 
        "TRILLION", 
        "QUARDRILLION" 
        ); /*limit t quadrillion */
        $num = number_format($num,2,".",","); 
        $num_arr = explode(".",$num); 
        $wholenum = $num_arr[0]; 
        $decnum = $num_arr[1]; 
        $whole_arr = array_reverse(explode(",",$wholenum)); 
        krsort($whole_arr,1); 
        $rettxt = ""; 
        foreach($whole_arr as $key => $i){
            
        while(substr($i,0,1)=="0")
                $i=substr($i,1,5);
        if($i < 20){ 
        /* echo "getting:".$i; */
        $rettxt .= $ones[$i]; 
        }elseif($i < 100){ 
        if(substr($i,0,1)!="0")  $rettxt .= $tens[substr($i,0,1)]; 
        if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
        }else{ 
        if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
        if(substr($i,1,1)!="0")$rettxt .= " ".$tens[substr($i,1,1)]; 
        if(substr($i,2,1)!="0")$rettxt .= " ".$ones[substr($i,2,1)]; 
        } 
        if($key > 0){ 
        $rettxt .= " ".$hundreds[$key]." "; 
        }
        } 

        $rettxt = strtolower($rettxt) . ' dollar ';
        if($decnum > 0){
        $rettxt .= " and ";
        if($decnum < 20){
        $rettxt .= $ones[$decnum];
        }elseif($decnum < 100){
        $rettxt .= strtolower($tens[substr($decnum,0,1)]);
        $rettxt .= " ".strtolower($ones[substr($decnum,1,1)]) .' cents' ;
        }
        }
        return $rettxt;
    }
	
   

}
