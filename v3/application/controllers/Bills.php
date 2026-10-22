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
class Bills extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->helper('lang_translate');
    }


    public function getUserSales($comkey,$user_id){
        $_SESSION["comkey"] = $comkey;
        // print_r($this->db);
         $qry = "SELECT b.* FROM `company` as a INNER JOIN set_database as b on a.com_id =b.com_id and a.comkey = '".$comkey."'";
         $db = $this->db->query($qry)->row_array();
         $newdata['hostname'] = $db['sdb_server'];
         $newdata['username'] = $db['sdb_username'];
         $newdata['password'] = $db['sdb_password'];
         $newdata['database'] = $db['sdb_name'];
         $newdata['isexcute'] = $db['sdb_isexcute'];
         $newdata['dbcompany'] = $db;
         $newdata['baseurl'] = base_url();
         $this->load->vars($newdata);
         $this->load->model('Sales_model', 'sales');
         $qry ="select sales_id,print_status,invoice,created_by from  sales where is_auto_print > 0 and print_status = 0 and published = 'yes' and  created_by = '".$user_id."' ";
         $sales = $this->db->query($qry)->result_array();

         $response = array(
            'valid' => true,
            'result'=>$sales,
            'message' => 'Data Fetched Succesfully'
        );
        echo json_encode($response);

    }

    public function updatePrintStatus($comkey,$id){
        $_SESSION["comkey"] = $comkey;
        // print_r($this->db);
         $qry = "SELECT b.* FROM `company` as a INNER JOIN set_database as b on a.com_id =b.com_id and a.comkey = '".$comkey."'";
         $db = $this->db->query($qry)->row_array();
         $newdata['hostname'] = $db['sdb_server'];
         $newdata['username'] = $db['sdb_username'];
         $newdata['password'] = $db['sdb_password'];
         $newdata['database'] = $db['sdb_name'];
         $newdata['isexcute'] = $db['sdb_isexcute'];
         $newdata['dbcompany'] = $db;
         $newdata['baseurl'] = base_url();
         $this->load->vars($newdata);
         $this->load->model('Sales_model', 'sales');
         $qry ="update sales set print_status = 1 where sales_id = '".$id."' ";
         $this->db->query($qry);

         $response = array(
            'valid' => true,
            'message' => 'Print Status Updated Succesfully'
        );
        echo json_encode($response);

    }

    public function generatevoucherbill($comkey,$id,$test = ''){
		$_SESSION["comkey"] = $comkey;
       // print_r($this->db);
        $qry = "SELECT b.* FROM `company` as a INNER JOIN set_database as b on a.com_id =b.com_id and a.comkey = '".$comkey."'";
        $db = $this->db->query($qry)->row_array();
        $newdata['hostname'] = $db['sdb_server'];
        $newdata['username'] = $db['sdb_username'];
        $newdata['password'] = $db['sdb_password'];
        $newdata['database'] = $db['sdb_name'];
        $newdata['isexcute'] = $db['sdb_isexcute'];
        $newdata['dbcompany'] = $db;
        $newdata['baseurl'] = base_url();
        $this->load->vars($newdata);
		$this->load->model('Vouchers_model', 'vouchers');
        $this->load->model('ledgers_model', 'ledgers');
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->vouchers->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->setCellPaddings(0, 0, 0, 0);
        $pdf->AddPage('P', 'A4');
		$data['selected'] = $this->vouchers->get_selected($id);
        $sale = $this->vouchers->getvouchers($id);
		$vourcher_type = $sale[0]['vourcher_type'];
		$acc_ledgers_id = $sale[0]['acc_ledgers_id'];
		$voucher_id = $id;
		if($vourcher_type == 'receipt'){
			$data['aeging'] =$this->vouchers->aeging_data($acc_ledgers_id,$id,'rec');
			
		}else if($vourcher_type == 'payment' ){
			$data['aeging'] =$this->vouchers->aeging_data($acc_ledgers_id,$id,'pay');
			
		}
		$data['amt'] = $this->ledgers->getLedegerbalance(date('d/m/Y'), $acc_ledgers_id, 'cl');
        if ($sale[0]['pub'] == 'no') {
            $img_file = base_url() . 'assets/images/cancelled.png';
            $pdf->Image($img_file, 50, 60, 0, 50, '', '', '', false, 100, '', false, false, 0);
        }
        $data['msd'] = $this->ShowAmountInWords($sale[0]['amount']);
        $data['sales'] = $sale;
        $data['company'] = $com;
		
        $html = $this->load->view('transaction/vouchers/bill', $data, true);
        $pdf->writeHTML($html);
        ob_end_clean();
        $pdf->Output('Drobo.pdf', 'I');
    }

	public function generatesalesbill($comkey,$id,$test = ''){
		$_SESSION["comkey"] = $comkey;
       // print_r($this->db);
        $qry = "SELECT b.* FROM `company` as a INNER JOIN set_database as b on a.com_id =b.com_id and a.comkey = '".$comkey."'";
        $db = $this->db->query($qry)->row_array();
        $newdata['hostname'] = $db['sdb_server'];
        $newdata['username'] = $db['sdb_username'];
        $newdata['password'] = $db['sdb_password'];
        $newdata['database'] = $db['sdb_name'];
        $newdata['isexcute'] = $db['sdb_isexcute'];
        $newdata['dbcompany'] = $db;
        $newdata['baseurl'] = base_url();
        $this->load->vars($newdata);
		$this->load->model('Sales_model', 'sales');
        $qry = 'select * from sales where sales_id = '.$id;
        $size_data = $this->db->query($qry)->row_array();
        $size = $size_data['printtype'];
        $is_download = 'download';
      
		$qry = "select IFNULL(sum(amount),0) as amt from sales_ledgers where published ='yes' and sales_id = ".$id." ";
		$add_amount = $this->db->query($qry)->row_array();
		$add_amount = $add_amount['amt'];
        $qry = "SELECT sum(ces_amt) as ces,sum(quantity) as qty FROM `sales_items` WHERE published ='yes' and sales_id = " . $id;
        $query = $this->db->query($qry)->row_array();
        $qty = $query['qty'];
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
        $sale = $this->sales->getSales($id,$comkey);
        $sale[0]['bill_kfc'] = 0;
        $sale[0]['qty'] = $qty;
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
        } else {
            $this->load->library('Pdf');
            $pdf = new Pdf('P', 'mm', $paper, false, 'UTF-8', false);
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
        $previous = $amt;
        if ($sale[0]['cash_type'] == 'Credit') {
            $previous = $amt - $sale[0]['total'];
        }
		$sale[0]['add_amount'] = $add_amount;
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
        $gst = $this->sales->getgstItems($id);
        $taxparticulars = $this->sales->gettaxparticulars($id);
        $sales_ledgers = $this->sales->getsales_ledgers($id);

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
		if($this->session->userdata('login_comid') == 'joish' && $sale[0]['stype'] != 'estimate' && $sale[0]['bill_type'] == 23 ){
			$cntl = 3;
		}
		$page_function  = 0;
        for ($q = 0; $q < $cntl; $q++) {
            if ($q > 0) {
                $pri_type = 'Duplicate';
            }
			if ($q > 1) {
                $pri_type = 'Triplicate';
            }
            for ($i = 0; $i < $inc; $i++) {
                $len = $size * $i;
                $list = $this->sales->getSalesItems($id, $len, $size);
                $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function,$comkey);
				$page_function = $page_function + 1 ;
			}
        }
     
        $pdf->Output('example_021.pdf', 'I');
    

	}


    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $format, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function = 1,$comkey ='')
    {
        if (count($list) != 0) {

            $papersiize = $sale[0]['paper'];
            $paperorient = $this->sales->getValue('paperorient');
            if ($orient != 'L') {
                $orient =  $paperorient;
            }
			
            if(strtolower($this->session->userdata('login_comid') == 'asekar' )){
                $orient = 'P';
            }
            $pdf->AddPage($orient, $papersiize);
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
            $data['size'] = $size;
            $data['comkey'] = $comkey;
            $data['pri_type'] = $pri_type;
            $data['len'] = $len;
            $data['hsn'] = $hsn;
            $data['hsndetails'] = $hsndetails;
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
            if(strtolower($this->session->userdata('login_comid')) == 'acs' ){
                $pdf->SetWatermarkImage(base_url() . 'uploads/company/acswatermark.jpg', 0.1, [210, 180], [0, 0]);
                $pdf->showWatermarkImage = true;
            }
			
			$qry = "SELECT sum(ifnull(b.tax,0)) as tax,a.GST,sum(IFNULL(b.total,0)-IFNULL(b.tax,0)-IFNULL(CASE WHEN sale.cess > 0 then b.ces_amt else 0 end,0) -IFNULL(itm_raw_ces,0)) as total,sum(itm_raw_ces ) as ces_amt from taxgst as a left join sales_items as b on a.gstid = b.tax_id and b.published ='yes' and b.sales_id=".$sale[0]['sales_id']." left join sales as sale on sale.sales_id = b.sales_id where 1 GROUP by a.gstid order by a.gst asc";
			$data['new_taxparticulars'] = $this->db->query($qry)->result_array();
		

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
                        }else{
                            print_r('error');exit;
                        }
                    }
                }
            }

            
            $settings = $this->sales->getCompanySettings();
            $data['settings'] = $settings;
            //$this->load->view('transaction/sales/bill1', $data);       
            $html = $this->load->view('transaction/sales/' . $format, $data, true);
			$repeat_bill = 0 ;
			if(isset($settings[0]['repeat_bill']) ){
				$repeat_bill = $settings[0]['repeat_bill'];
			}
			if((float)$repeat_bill > 0  ){
				$html = $this->load->view('transaction/sales/disha_header', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishabody1', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishabody2', $data, true);
				$html = $html.$this->load->view('transaction/sales/dishafooter', $data, true);
			}
            $pdf->writeHTML($html);
        }
    }


    public function Show_Amount_In_Words($number) {

        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'One', '2' => 'Two',
            '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
            '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
            '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
            '13' => 'Thirteen', '14' => 'Fourteen',
            '15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
            '18' => 'Eighteen', '19' => 'Nineteen', '20' => 'Twenty',
            '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
            '60' => 'Sixty', '70' => 'Seventy',
            '80' => 'Eighty', '90' => 'Ninety');
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }
        }
        $str = array_reverse($str);
        $result = implode('', $str);
        $points = ($point) ?
                "." . $words[$point / 10] . " " .
                $words[$point = $point % 10] : '';
        return $result . " Only";
    }
}
