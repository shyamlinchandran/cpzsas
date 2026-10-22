<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 

defined('BASEPATH') or exit('No direct script access allowed');

use AliAbdalla\Tafqeet\Core\Tafqeet;

class Salesbill extends MY_Controller
{

    //put your code here
    public function __construct()
    {
        parent::__construct();
        $this->load->model('sales_model', 'sales');
        $this->load->model('ledgers_model', 'ledgers');
    }

    public function bill( $formats,$id,$size, $is_download = 'view')
    {
        $this->generateBill( $formats,$id,$size, $is_download);
    }
    private function generateBill($formats,$id, $size, $is_download = 'view')
    {
        $qry = "SELECT c.name as product,b.`name` AS subproduct,a.percentage,a.productid FROM bom_sub_material AS a  INNER JOIN item AS b ON a.materialid  =b.id  INNER JOIN item AS c ON c.id = a.productid  WHERE a.is_available = 'yes' AND a.productid IN (SELECT item_id FROM sales_items WHERE published = 'yes' AND sales_id = ".$id.")";
        $sub_products = $this->db->query($qry)->result_array();
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
              //  $amt = $this->ledgers->getLedegerbalance($sale[0]['invoice_date'], $ledb['id'], 'cl');
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
        if($formats != 'exp' && $formats != 'exp_invoice' && $formats != 'exp_packing' && $formats != 'food_declaration'){
            $size = 1000;
        }else{
            $size = 5;
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
                $this->pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $formats, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function, $qty,$sub_products);
				$page_function = $page_function + 1 ;
			}
        }
        if ($is_download == 'download') {
            $pdf->Output($sale[0]['invoice'] . '.pdf', 'D');
        } else {
            $pdf->Output('example_021.pdf', 'I');
        }
    }

    function pages($pdf, $list, $sale, $img_file, $size, $len, $hsn, $gst, $formats, $i, $inc, $taxparticulars, $pri_type, $orient, $pdf_type, $hsndetails, $sales_ledgers, $print_settings, $footer_settings,$page_function = 1, $qty = 0,$sub_products)
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
            $data['sub_products']    = $sub_products;
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
		
            $settings = $this->sales->getCompanySettings();
            $data['settings'] = $settings;
            //$this->load->view('transaction/sales/bill1', $data);       
            $html = $this->load->view('transaction/sales/' . $formats, $data, true);
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
            //ob_end_clean();
        }
    }

   

}