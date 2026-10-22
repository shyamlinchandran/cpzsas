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
class Stock_journal extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('Stockjournal_model', 'stockjournal');
        $this->load->model('inventory_model/Items_model', 'item');

    }
	
     function generateDirectEway($id)
    {
        $val =  $this->stockjournal->generateDirectEway($id);
        print_r($val);
    }
	function getsing($id){
		$this->stockjournal->getsing($id);
	}
	
	function journal_ledgers($id){
		$this->stockjournal->journal_ledgers($id);
	}
	  function delete($id) {
        $this->stockjournal->delete($id);
    }
	public function print_barcodes($id,$pid = 0){
        $qry = "SELECT DATE_FORMAT(date, '%d%m%y') AS formatted_date FROM `stock_journal` WHERE id = ".$id;
        $pur_data = $this->db->query($qry)->row_array();
        $formatted_date = $pur_data['formatted_date'];
        $uid = 0;
       // $qry = 'SELECT b.`code`,case when RIGHT(YEAR(date),2 ) = 0 then "" ELSE RIGHT(YEAR(date),2 ) END  AS year  FROM purchase a INNER JOIN suppliers AS b ON a.supplier_id = b.id WHERE b.code != "" and b.code != " " and a.id = '.$id;
      //  $pur_data = $this->db->query($qry);
        $supcode ='';
       // if($pur_data->num_rows() > 0 ){
           // $pur_data = $pur_data->row_array();
           // $supcode = ' - '.$pur_data['code'];
       // }
        $login_comid = $this->session->userdata('login_base_comid');
		if($login_comid === 'playstore'){
			
			
		}

        $margin_top = 5;

    if( strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'seasons'  ){
        $margin_top = 1;
    }

    $settings = $this->stockjournal->getCompanySettings();
    $lcode = 0;
    if(isset($settings[0]['lcode']) ){
        $lcode = $settings[0]['lcode'];
    }

		$qry = "select a.*,case when expirydate  not like'%0000%' and expirydate  is not null then DATE_FORMAT(expirydate	,'%d/%m/%y' )  else '' end as exp_d from stock_journal_items a where  published = 'yes'  and type = 'increase'  and stock_journal_id = ".$id." order by id desc" ;
		if((int) $pid > 0 ){
			$qry = "select a.*,case when expirydate  not like'%0000%'  and expirydate  is not null then DATE_FORMAT(expirydate	,'%d/%m/%y' )  else '' end as exp_d from stock_journal_items  a where id = ".$pid." and  published = 'yes' and stock_journal_id = ".$id." order by id desc" ;
		}
		$p_data = $this->db->query($qry)->result_array();
			$this->load->library('M_pdf');
			$this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(78, 25), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
			$this->m_pdf->load();
			$pdf = $this->m_pdf->pdf;
			$this->language = "ac";
			$this->lang->load('ac_site', 'ac');
			$pdf->SetDirectionality('ltr');
        	if($login_comid === 'playstore'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.9876, 50.8), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $data = $this->item->getpitem($id,$uid)[0];
                $data['name'] = substr($data['name'], 0, 20);
                
		    }

            if(strtolower($this->session->userdata('login_base_comid')) =='msa' ){
                $pad ='35px';
                $txt = '';
                $font ='12px';
                $fontitem = '8px';
                $hgt = '1.1';
                if(strtolower($this->session->userdata('login_base_comid')) =='msa' ){
                    $font ='7px';
                    $hgt = '.9';
                    $fontitem = '6px';
                    $pad = "12px";
                }
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                
            }
            if(strtolower($this->session->userdata('login_base_comid')) =='palack' ){
                $this->load->library('Pdf');
                $pdf = new TCPDF("L", "mm", array(75,38 ), true, 'UTF-8', false);
                $pdf->SetMargins(0, 3, 0);
                $pdf->setPrintHeader(false);
                $pdf->setPrintFooter(false);
                $settings = $this->item->getCompanySettings();
            //	$address = $settings[0]['name'];
                $pdf->setFontSubsetting(true);
                $pdf->SetFont('freeserif', '', 8);
                $pdf->SetFont('freeserif', '', 8);
                $pdf->SetAutoPageBreak(TRUE, 0);
                $date = date("ny");
                $data = $this->item->getpitem($id,$uid)[0];
                $data['name'] = substr($data['name'], 0, 20);
            }
            if($login_comid === 'kabini' ||  strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $data = $this->item->getpitem($id,$uid)[0];
                $data['name'] = substr($data['name'], 0, 20);
            }
            if(strtolower($login_comid) === 'ftfa'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $data = $this->item->getpitem($id,$uid)[0];
                $data['name'] = substr($data['name'], 0, 20);
            }
            if(strtolower($login_comid) === 'newideal'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(103.124, 27), 'margin_bottom' => 0,'margin_top' => -2,'margin_right' => 0,'margin_left' => 6, 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $data = $this->item->getpitem($id,$uid)[0];
                $data['name'] = substr($data['name'], 0, 20);
                $barcodes = $data['barcode'];
                     $barcodes = str_replace("Y","",$barcodes);
                     $pleft = 0;
                     if(is_numeric($barcodes) ){
                         if((int) $barcodes <= 1000 ){
                             $pleft = 10;
                         }
                     }
         
                     if(is_numeric($barcodes) ){
                         if((int) $barcodes <= 100 ){
                             $pleft = 10;
                         }
                     }
                     if(is_numeric($barcodes) ){
                         if((int) $barcodes < 10 ){
                             $pleft = 25;
                         }
                     }
            }

            if(strtolower($login_comid) === 'aakaar'   || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' ){
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 27), 'margin_bottom' => 0,'margin_top' =>5,'margin_right' => 0, 'autoPageBreak' => TRUE];
                $tp = "C93";

                if( strtolower($login_comid) === 'kideez' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if(strtolower($login_comid) === 'senzation' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>0,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if( strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'seasons' || strtolower($login_comid) == 'ssaluva' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
                }

                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $login_comid = $this->session->userdata('login_base_comid');
                $address ='UF20 JEANS CO.';
            }
            if( strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'seasons' || strtolower($login_comid) == 'ssaluva' ){
                $tp = "C39";
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
                $paddingtext = '18';
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $login_comid = $this->session->userdata('login_base_comid');
                $address ='UF20 JEANS CO.';
            }

		foreach($p_data as $purdata ){
            $itm_lcode = '';
            if($lcode > 0 ){
                $itm_lcode = $purdata['itm_lcode'];
            }
			$uid = 0 ;
			$id = $purdata['item_id'];

            $qry ="select IFNULL(b.`code`,'') AS CODE ,case when RIGHT(YEAR(DATE),2 ) = 0 then '' ELSE RIGHT(YEAR(DATE),2 ) END  AS year  FROM item AS a LEFT  JOIN suppliers AS b ON a.supplier_id = b.id where a.id = ".$id;
            $supdata = $this->db->query($qry)->row_array();
            $mtext = '';
            if($supdata['CODE'] != ''){
                $mtext = $supdata['CODE'];
            }
            if($supdata['year'] != ''){
                $mtext =  $mtext.$supdata['year'];
            }
            if($mtext !=''){
                $mtext = ' - '.$mtext;
            }

			$settings = $this->stockjournal->getCompanySettings();
			$address = $settings[0]['name'];
			$data = $this->item->getpitem($id,$uid)[0];
			$data['name'] = substr($data['name'], 0, 20);
            $quantity = ceil($purdata['quantity']/2);
            $barcodes = $data['barcode'];
            $barcodes = str_replace("Y","",$barcodes);
            $pleft = 3;
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 1000 ){
                    $pleft = 10;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes <= 100 ){
                    $pleft = 10;
                }
            }
            if(is_numeric($barcodes) ){
                if((int) $barcodes < 10 ){
                    $pleft = 20;
                }
            }
            if(strtolower($login_comid) === 'palack' ){
                $quantity = $purdata['quantity'];
                $quantity =  $quantity + 1;
            }
			for($k =0 ;$k<$quantity;$k++ ){
                
				$html = '';
                if(strtolower($login_comid) === 'aakaar'  || strtolower($login_comid) === 'seasons' || strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'  || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' ){
                    $iname = $data['name'];
                    $address ='AAKAAR';
                    if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' ){
                        $address = $settings[0]['name'];
                    }

                    $tp = "C93";

                if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' ){
                    $tp = "C39";
            
                }
                $paddingtext = '14';
                if(strtolower($login_comid) === 'kideez'){
                    $paddingtext = '18';
                }

                $rate_txt = 'MRP :'.$data['MRP'].' ';
                if(strtolower($login_comid) === 'seasons'  ||   strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'){
                   $rate_txt = 'Price :'.$data['srate'].' ';
                   $address = $settings[0]['name'];
                   $paddingtext = '18';
                   $tp = "C39";
               }


                    $iname =  $data['cat'];
                    $html = $html. '<style>body{
                           font-family: sans-serif;
                      }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                   
                                   <tr style="papadding-top:0px;padding-left:2px;">
                                       <td style="padding-top:0px;line-height:6px;width:49.5%;text-align:left;padding-left:'.$paddingtext.'px;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                                       <td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:9px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                                   </tr>
                             
                                   <tr>
                                       <td colspan = "4"><barcode  style="padding-left:'.$paddingtext.'px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="'.$tp.'" height="1" text="1" /></td>
                                       <td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="'.$tp.'" height="1" text="1" /></td>
                                   </tr>
                                   <tr>
                                   <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:10px;line-height:5px;"><b>'.$data['barcode'].$supcode.' &nbsp;&nbsp; '.$itm_lcode.' </b></td>
                                   
                                   
                                   <td colspan="4" style="font-size:10px;line-height:5px;padding-left:8px;"><b>'.$data['barcode'].$supcode.' &nbsp;&nbsp; '.$itm_lcode.'</b></td>
                                   
                               </tr>
                                <tr>
                                   <td style="font-weight:bold;padding-left:'.$paddingtext.'px;font-size:11px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$iname.'</b></td>
                                   <td style="font-weight:bold;font-size:11px;line-height:8px;width:50.5%;padding-left:9px;" colspan = "4"><b>'.$iname.'</b></td>
                               </tr>  
                                 
                                   <tr>
                                       <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:14px;line-height:8px;"><b> '. $rate_txt .'   </b> </td>
                                       
                                       <td colspan="4" style="font-size:14px;line-height:8px;padding-left:9px;"><b>'. $rate_txt .'  </b></td>
                                   </tr>
                               </table>
                               <table>
                              
                               </table>';
                }else if(strtolower($login_comid) === 'msa'){

                    $data = $this->item->getpitem($id,0)[0];
                    $batch =$purdata['batch'];
                $txt = '<tr>
                                    <td colspan="4" style="padding-left:0px;font-size:8px;line-height:8px;"><b>Pkd:'.date('d/m/y').',Exp :'.$purdata['exp_d'].' <b></td>							
                                    <td colspan="4" style="font-size:8px;line-height:8px;padding-left:5px;"><b>Pkd:'.date('d/m/y').',Exp :'.$purdata['exp_d'].' <b> </td>
                                </tr>';


                                $data['name'] = substr($data['name'], 0, 20);
                                $price_text = '&nbsp;&nbsp;Price:'.$data['srate'];
                                $namemsa = '';
                                $nameitem = $data['name'];;
                                $price_text ='';
                                $namemsa = $data['name'];
                                $nameitem = 'CC 230531 fssai: 11312006000198';

                                $barcodes = $data['barcode'];
                                $barcodes = str_replace("Y","",$barcodes);
                                $pleft = 0;
                                if(is_numeric($barcodes) ){
                                    if((int) $barcodes <= 1000 ){
                                        $pleft = 12;
                                    };
                                }
                    
                                if(is_numeric($barcodes) ){
                                    if((int) $barcodes <= 100 ){
                                        $pleft = 12;
                                    }
                                }
                                if(is_numeric($barcodes) ){
                                    if((int) $barcodes < 10 ){
                                        $pleft = 22;
                                    }
                                }
                               
                                $text = '  <tr><td style="padding-left:6px;font-size:'.$fontitem.';line-height:8px;width:49.5%;" colspan = "4"><b>'.$nameitem.'</b></td>
                                    <td style="font-size:6px;line-height:'.$fontitem.';width:50.5%;padding-left:12px;" colspan = "4"><b>'.$nameitem.'</b></td>
                                                                    </tr>        ';
                    $html = $html .'<style>body{
                        font-family: sans-serif;
                   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                
                                <tr style="papadding-top:0px;">
                                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: '.$font.';font-weight:bold" colspan="4">'.$address.'</td>
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: '.$font.';font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>'.
                                $text .
                               ' <tr>
                                    <td  style="padding-left:'.$pad.';" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="'.$hgt .'" text="1" /></td>
                                    <td style="padding-left:'.$pad.';" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="'.$hgt .'" text="1" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:'.$pad.';text-align:left;font-size:7px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].' '.$namemsa.'</b></td>
                                    
                                    
                                    <td colspan="4" style="padding-left:'.$pad.';text-align:left;font-size:7px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].' '.$namemsa.'</td>
                                    
                                </tr>
                                '.$txt.'
                                <tr>
                                    <td colspan="4" style="padding-left:4px;line-height:8px;"><b><font style ="font-size:10px;" ><font style ="font-size:8px;" >MRP:'.round($purdata['Mrp'],2).' &nbsp;&nbsp;'.$batch.'  </font>'.$price_text.'</font> <b></td>							
                                    <td colspan="4" style="line-height:8px;padding-left:5px;"><b><font style ="font-size:8px;" >MRP:'.round($purdata['Mrp'],2).' &nbsp;&nbsp;'.$batch.' <b></font><font style ="font-size:10px;" >'.$price_text.'</font> </td>
                                </tr>
                                
                            </table>
                           ';
                }
                else if(strtolower($login_comid) === 'newideal'){
                    $html = $html.'<style>body{
                        font-family: sans-serif;
                   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                
                                <tr style="papadding-top:0px;">
                                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:center;font-size: 11px;font-weight:bold" colspan="4">'.$address.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:3px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:35px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:25px;" colspan = "4"><b>'.$data['name'].'</b></td>
                                </tr>           
                                <tr>
                                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                                    <td style="padding-left:'.$pleft.'px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                                    
                                    
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:32px;"><b>Price:'.$data['srate'].' <b> </td>
                                </tr>
                                
                            </table>
                            <table>
                           
                            </table>';
                }
                else if(strtolower($login_comid) === 'ftfa'){
                    $html = '<style>body{
                        font-family: sans-serif;
                   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                
                                <tr style="papadding-top:0px;">
                                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 11px;font-weight:bold" colspan="4">&nbsp;&nbsp;&nbsp;'.$address.'</td>
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:3px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                                    <td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
                                </tr>           
                                <tr>
                                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                                    <td style="padding-left:'.$pleft.'px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                                    
                                    
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:32px;"><b>Price:'.$data['srate'].' <b> </td>
                                </tr>
                                
                            </table>
                            <table>
                           
                            </table>';
                } 
                else if($login_comid === 'kabini' ||  strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal'){
                    $html = $html.'<style>body{
                        font-family: sans-serif;
                   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                
                                <tr style="papadding-top:0px;">
                                    <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:12px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                                    <td style="font-size:8px;line-height:8px;width:50.5%;padding-left:18px;" colspan = "4"><b>'.$data['name'].'</b></td>
                                </tr>           
                                <tr>
                                    <td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="1.5" text="1" /></td>
                                    <td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".5" type="C39" height="1.5" text="1" /></td>
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                                    
                                    
                                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                                    
                                </tr>
                                <tr>
                                    <td colspan="4" style="padding-left:35px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:32px;"><b>Price:'.$data['srate'].' <b> </td>
                                </tr>
                                
                            </table>
                           ';
                }else if(strtolower($login_comid) === 'palack'){
                    $style = array(
                        //'border' => true,
                        'hpadding' => 'auto',
                        'vpadding' => 'auto',
                        'fgcolor' => array(0, 0, 0),
                        'bgcolor' => array(255, 255, 255),
                        ///'text' => true,
                        'font' => 'helvetica',
                        'fontsize' => 8,
                        'stretchtext' => 1
                    );
                    $tmp = $this->session->userdata('user');
                    $user = $tmp['Id'];
                    $address ='PCH Adimali';
                    $phone = '8281732599';
                    $qry = "SELECT b.* FROM users a INNER JOIN  company_branch AS b ON b.brc_id = a.branch WHERE a.Id =".$user;
                    $user_data = $this->db->query($qry);
                    if($user_data->num_rows() > 0 ){
                        $user_data  = $user_data->row_array();
                        $address ='PCH '.$user_data['brc_name'];
                        $phone = $user_data['brc_phone'];
                    }
                    $uid = 0 ;
                    $html = $html  .'<table style ="width:100%"  >
						<tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;font-size:18px;" ><b>'.$address.'</b></td>
						</tr>
                        <tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;padding-top:30px;font-size:10px" >SHOP. '.$phone.' </td>
						</tr>
						<tr>
			
							<td colspan ="4" style = "align:center"> ' . $pdf->write1DBarcode($data['barcode'], 'C128', '10', '15', '45', 12, 1, $style, 'L') . '</td>
						</tr>
                        <tr>
							<td style = "width:10%;">&nbsp;</td>
							<td colspan="3" style = "width:90%;padding-top:30px;font-size:11px;" ><br /><br /><br /><b>'.$data['barcode'].'&nbsp;&nbsp;&nbsp;'.($quantity-1).' &nbsp;&nbsp;&nbsp;'.$formatted_date.'</b></td>
						</tr>
						 
						 
					 
						 
					</table>';
            }
                else if($login_comid === 'playstore'){
                    $html =  $html .'<style>body{
                font-family: sans-serif;
				
           }</style><table  class ="clstble" style="padding-top:5px ;padding-left:15px;cellpadding:0px;width:100%">
                        
						<tr style="papadding-top:0px;">
							<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 10px;font-weight:bold" colspan="4">'.$address.'</td>
							<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:0px;text-align:center;font-size: 10px;font-weight:bold;padding-right:30px" colspan="4">'.$address.'</td>
						</tr>
                        <tr>
							<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
							<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:10px;" colspan = "4"><b>'.$data['name'].'</b></td>
                        </tr>           
                        <tr>
							<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
							<td style="padding-left:0px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;padding-left:10px;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
						</tr>
						<tr>
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
							
							
							<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;padding-left:10px;"><b>'.$data['barcode'].'</td>
							
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:10px;">MRP:'.$data['MRP'].'  </td>
						</tr>
						<tr>
							<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;"><b> Price:'.$data['srate'].'</b>   </td>							
							<td colspan="4" style="font-size:11px;line-height:8px;padding-left:10px;"><b> Price:'.$data['srate'].' </b> </td>
						</tr>
                    </table>
                    <table>
                   
                    </table>';
                }else{
				$html =  $html . '<style>body{
							font-family: sans-serif;
				   }</style><table  style="height:94.4881889775px !important;papadding-top:0px;cellpadding:0px;width:100%">
								
								<tr style="papadding-top:0px;">
									<td style="padding-top:0px;line-height:6px;width:49.5%;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
									<td style="padding-top:0px;line-height:8px;width:50.5%;padding-left:17px;text-align:center;font-size: 13px;font-weight:bold" colspan="4">'.$address.'</td>
								</tr>
								<tr>
									<td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
									<td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
								</tr>           
								<tr>
									<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
									<td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
								</tr>
								<tr>
									<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
									
									
									<td colspan="4" style="text-align:center;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
									
								</tr>
								<tr>
									<td colspan="4" style="padding-left:35px;font-size:11px;line-height:8px;">MRP:'.$data['MRP'].'   </td>							
									<td colspan="4" style="font-size:11px;line-height:8px;padding-left:32px;">MRP:'.$data['MRP'].'  </td>
								</tr>
								<tr>
									<td colspan="4" style="padding-left:35px;font-size:12px;line-height:8px;"><b>Fair Price:'.$data['srate'].'</b>   </td>							
									<td colspan="4" style="font-size:12px;line-height:8px;padding-left:32px;"><b>Fair Price:'.$data['srate'].' </b> </td>
								</tr>
							</table>
							';	
                    }
					$pdf->AddPage();
					$pdf->writeHTML($html);
			}
				
		}
		$pdf->Output('example_021.pdf', 'I');
		

	}
	
	public function bill_items($id){
		$qry ="SELECT b.*,i.name,i.barcode FROM stock_journal AS a INNER JOIN stock_journal_items AS b ON a.id = b.stock_journal_id AND b.published = 'yes'  AND TYPE = 'increase' INNER JOIN item AS i ON i.id = b.item_id where   a.id=".$id ." order by b.id desc";
		$data['result'] = $this->db->query($qry)->result_array();
		$this->load->view('_blocks/subpages/create');
		$data['id'] =$id;
		$this->load->view('stockjournal/bill_items', $data);
		
	}

	
   public function create($id = 0){
	    $this->load->view('_blocks/subpages/create');
		if($id < 1){
			$data['invoice'] = $this->stockjournal->getinvoice();
		}
		$data['settings'] = $this->stockjournal->getCompanySettings();

        $data['id'] = $id;
		$data['view'] = 'Create';
        $this->load->view('stockjournal/create', $data);
   }
   

   public function updateopen(){
        ini_set('max_execution_time', 300000);
        $qry = "SELECT b.id,a.quantity,a.rate FROM msatab a INNER JOIN item AS b ON b.`name` = a.name AND a.barcode = b.barcode WHERE 1 ";
        $data = $this->db->query($qry)->result_array();
        foreach($data as $it){
            $qry ='update item set open_stk_rate = '.$it['rate'].' where id = '.$it['id'];
            $this->db->query($qry);

            $qry ='select * from item_godown where item_id =  '.$it['id'].' ';
            $g_data = $this->db->query($qry)->row_array();
            $qry = 'update item_godown set open_stock = '.$it['quantity'].' where id = '.$g_data['id'];
            $this->db->query($qry);
        }
   
    }
   
    public function itemssearch($type= '') {
        $search = strtolower($_GET['term']);
        return $this->stockjournal->itemssearch($search,$type);
    }

    public function updatestock(){
        ini_set('max_execution_time', 300000);
        $ttp = 'cr';
        $date = '2024-04-30';
        $qry = "SELECT b.id,a.quantity,a.id AS aid FROM (SELECT * from msaitem WHERE STATUS = 0)  AS a INNER	 JOIN (select name,id,barcode from item WHERE id NOT in (14953,18397,18368,18372,18369,18373,18403,18367,18371,18402,18834,18843,15760,18836,15761,18837,18844,14970,18012,14988,17900,14989,17905,17742,18030,17989,18583,14992,18000,17862,17863,18226,18233,18306,18231,18305,18236,18308,18239,18309,18245,18312,18240,18310,18242,18311,17912,17969,17710,18363,17697,17698,17699,17700,18976,18977,18661,18662,20374,20460,15015,19543,20421,20422,20364,20365,17835,17849,17827,17837,17850,19658,19661,19662,18974,18975,15045,18978,18969,18972,17204,18885,17846,17853,19367,19365,15061,19354,18518,18716,18513,18515,18517,18715,18519,18718,18719,15065,18514,18516,18713,18838,18839,15087,18849,15088,18846,15734,19235,20267,20268,15696,18944,17561,18943,15889,18946,17285,18942,15797,18955,16433,19981,16140,19251,17329,18292,15108,17945,16539,19717,15496,18276,15115,19114,16758,19052,19921,19922,19923,15672,18107,15566,18113,18759,18760,18761,18762,18763,20284,20285,15985,18768,15735,18757,15130,18767,15547,18957,18501,18502,18612,18617,18488,18489,18492,18493,18635,18636,18647,18648,18506,18507,20163,20164,15140,17930,15141,17882,19468,19469,17429,18051,17098,18695,17186,18708,17114,19277,16805,18871,18011,18017,15521,17944,17998,16231,18134,18068,18120,18061,18094,18063,18103,15647,18067,18117,16197,19684,17798,19106,17796,19099,18772,18773,18774,18775,18776,17823,20215,17510,19195,16929,19171,17847,18847,17679,17686,17414,18575,15634,18571,15211,18570,16382,18066,20384,20385,18923,18925,18364,19510,16616,19188,18685,18698,18684,18702,18687,18689,18706,15701,19216,16628,19163,15783,19217,17591,19212,15790,18877,18477,19101,15240,18475,18211,18215,15705,18217,20184,20185,15252,19090,18817,18818,16073,18814,18386,19534,18283,18284,16863,19719,19363,19364,15920,18287,15288,17895,18608,15432,18019,16934,19463,17735,17736,17737,18479,18679,18478,18680,18593,18597,15322,17916,15323,17934,15324,18980,18007,18008,18888,18889,16903,19030,17313,19218,16440,19164,15746,18963,16341,18965,15344,17977,20173,20174,17818,17833,17848,15353,18940,15354,18939,15355,18961,20179,20180,15408,19253,15732,19254,15585,19094,15381,17891))  AS b ON a.barcode = b.barcode AND a.name = b.name WHERE 1 ORDER BY aid asc  limit 0,500";
        $data = $this->db->query($qry)->result_array();
        foreach($data as $it){
            $this->stockjournal->stock_gold_trans(0,$it['id'], $it['quantity'],0,0, $date, $ttp, 'dir_update', $it['aid'], 0, 0, 0,  1, 'DIr', '');
		    $this->stockjournal->godown_stock_trans(0, $it['id'], $it['quantity'], $ttp, 'dir_update', 1,'','','' ,0,0,0);
            $qry = "update msaitem set status = 1 where  id =".$it['aid'];
            $this->db->query($qry);
        }
		
    }

    public function listall() {
		$type = "stock_journal";
		$data['type'] = $type;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $this->load->view('stockjournal/list_all',$data);
    }

    public function ajax_list() {
        $list = $this->stockjournal->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $stock) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $stock->date;
            $row[] = $stock->voucher_no;
            $row[] = $stock->remarks;
            $row[] = $stock->user_name;
            $row[] = $stock->created_time;
            $act = ' <a  href="' . base_url() . 'Stock_journal/create/' . $stock->id . '" title="Edit" data-toggle="tooltip" class="btn btn-success "><span class="glyphicon glyphicon-edit"></span></a>';
            $act = $act . ' <a tp="confirm" base="' . base_url() . '/Stock_journal/listall/"  success="Delete ' . $stock->voucher_no . ' successfuly "  message="Do you want Delete ' . $stock->voucher_no . '?"  href="' . base_url() . 'Stock_journal/delete/' . $stock->id . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
			$act = $act .' <a   class="btn btn-primary "  href="' . base_url() . 'Stock_journal/bill_items/' . $stock->id . '" title="Print Barcode"  data-toggle="tooltip">Print</i></a>';
            if(isset($stock->e_way_status)){
                if($stock->e_way_status < 1 ){
                    $act = $act . ' <button sales_id = "'. $stock->id.'" data-toggle="tooltip" title="Edit" class="btn btn-success e-way">Generate e-way</span></button>';
                }
            }
                    
            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->stockjournal->count_all(),
            "recordsFiltered" => $this->stockjournal->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save() {
        $this->stockjournal->save();
    }






//    }
}
