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
class Purchase extends MY_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->model('ledgers_model', 'ledgers');
        $this->load->model('purchase_model', 'purchase');
        $this->load->model('inventory_model/Items_model', 'item');
    }
	
    public function print_selected() {
        $rows = $this->input->post('rows'); // array of row IDs
        $quantities = $this->input->post('quantities'); // associative array
        $_SESSION['printids']=$rows; 
        $_SESSION['printquantities']=$quantities; 
    }
    public function getinoviceno($type) {
		$invoice = $this->purchase->getinoviceno($type);
        print_r($invoice);
    }
	
	public function bill_items($id){
		$qry ="select a.*,b.name,b.barcode from purchase_items as a inner join item as b on a.item_id=b.id where a.published='yes' and  purchase_id=".$id ." order by a.id desc";
		$data['result'] = $this->db->query($qry)->result_array();
		$this->load->view('_blocks/subpages/create');
		$data['id'] =$id;
		$this->load->view('transaction/purchase/bill_items', $data);
		
	}

    public function billitems($id){
		$qry ="select i.name,a.barcode,a.purchase_id,a.id from purchase_items_barcode as a inner join item as i on a.item_id = i.id where a.is_deleted = 0 and a.status = 1 and a.purchase_id =".$id;
		$data['result'] = $this->db->query($qry)->result_array();
		$this->load->view('_blocks/subpages/create');
		$data['id'] =$id;
		$this->load->view('transaction/purchase/billitems', $data);
    }
		
    public function printbarcodes($id,$pid = 0){
        $qry = 'SELECT b.`code` FROM purchase a INNER JOIN suppliers AS b ON a.supplier_id = b.id WHERE b.code != "" and b.code != " " and a.id = '.$id;
        $pur_data = $this->db->query($qry);
        $supcode ='';
        if($pur_data->num_rows() > 0 ){
            $pur_data = $pur_data->row_array();
            $supcode = ' - '.$pur_data['code'];
        }
        $login_comid = $this->session->userdata('login_base_comid');
		if($login_comid === 'playstore'){
			
			
		}
		$qry = "select * from purchase_items_barcode where is_deleted = 0 and purchase_id = ".$id;
		if((int) $pid > 0 ){
			$qry = "select * from purchase_items_barcode where id = ".$pid." and  is_deleted = 0 and purchase_id = ".$id;
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
            if( strtolower($login_comid) === 'choice' || $login_comid === 'kabini' || strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal' || strtolower($login_comid) === 'palack' || strtolower($login_comid) === 'royalf'){
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
            if(strtolower($login_comid) === 'inworld'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 3  , 'autoPageBreak' => TRUE];
                $this->m_pdf->load();
                $pdf = $this->m_pdf->pdf;
                $this->language = "ac";
                $this->lang->load('ac_site', 'ac');
                $pdf->SetDirectionality('ltr');
                $settings = $this->item->getCompanySettings();
                $address = $settings[0]['name'];
                $data = $this->item->getpitem($id,0)[0];
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

            if(strtolower($login_comid) === 'cochinsilks'  ||   strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'aakaar'  ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'seasons' || strtolower($login_comid) === 'ssaluva'   || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 27), 'margin_bottom' => 0,'margin_top' =>6,'margin_right' => 0, 'autoPageBreak' => TRUE];
                $tp = "C93";

                if( strtolower($login_comid) === 'kideez' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'boyszone' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>0,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if(strtolower($login_comid) == 'seasons' ||  strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'ssaluva' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>5,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
                }

                if(strtolower($login_comid) === 'kuppayam'  ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'margin_left' => 5,'autoPageBreak' => TRUE];
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
            // print_r($p_data);exit;
		foreach($p_data as $purdata ){

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
                        
            $settings = $this->item->getCompanySettings();
			$address = $settings[0]['name'];
			$data = $this->item->getpitem($id,$uid)[0];
			$data['name'] = substr($data['name'], 0, 20);
            $data['barcode'] = $purdata['barcode'];
            $quantity = 1;
            if(strtolower($login_comid) === 'palack'  ){
                $quantity = $quantity * 2;
            }
			for($k =0 ;$k<$quantity;$k++ ){
                $rate_txt = 'MRP :'.$data['MRP'].' ';
                 if(strtolower($login_comid) === 'seasons'  ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'){
                    $rate_txt = 'Price :'.$data['srate'].' ';
                }
                if(strtolower($login_comid) === 'seasons'  ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'){
                    $rate_txt = 'Price :'.$data['MRP'].' ';
                }
				$html = '';
                if(strtolower($login_comid) === 'cochinsilks'  || strtolower($login_comid) === 'aakaar'  || strtolower($login_comid) === 'seasons' ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'   ||  strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone'){
                    $iname = $data['name'];
                    $address ='AAKAAR';
                    if(strtolower($login_comid) === 'cochinsilks'  || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
                        $address = $settings[0]['name'];
                    }

                    $tp = "C93";

                    if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone'){
                        $tp = "C39";
                
                    }

                    if(strtolower($login_comid) == 'seasons'  ||  strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'ssaluva' ){
                        $tp = "C39";
                        $address = $settings[0]['name'];
                        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>5,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
                    }


                    $paddingtext = '14';
                    if(strtolower($login_comid) === 'kideez'){
                        $paddingtext = '18';
                    }

                    if(strtolower($login_comid) == 'seasons' ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'ssaluva' ){
                        $paddingtext = '18';
                
                    }

                    if(strtolower($login_comid) === 'seasons'  ||  strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'){
                        $rate_txt = 'Price :'.$data['MRP'].' ';
                    }

                    if(strtolower($login_comid) === 'kuppayam'  ){
                        $tp = "C39";
                        $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'margin_left' => 5,'autoPageBreak' => TRUE];
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
                                       <td colspan = "4"><barcode  style="padding-left:'.$paddingtext.'px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="'.$tp.'" height="1.3" text="1" /></td>
                                       <td style="padding-left:10px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="'.$tp.'" height="1.3" text="1" /></td>
                                   </tr>
                                   <tr>
                                   <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:10px;line-height:5px;"><b>'.$data['barcode']. $supcode.' &nbsp;&nbsp;'.$data['lcode'].' </b></td>
                                   
                                   
                                   <td colspan="4" style="font-size:10px;line-height:5px;padding-left:8px;"><b>'.$data['barcode']. $supcode.' &nbsp;&nbsp;'.$data['lcode'].'</b></td>
                                   
                               </tr>
                                <tr>
                                   <td style="font-weight:bold;padding-left:'.$paddingtext.'px;font-size:12px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$iname.'</b></td>
                                   <td style="font-weight:bold;font-size:12px;line-height:8px;width:50.5%;padding-left:9px;" colspan = "4"><b>'.$iname.'</b></td>
                               </tr>  
                                 
                                   <tr>
                                       <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:12px;line-height:8px;"><b>'. $rate_txt.'   </b> </td>
                                       
                                       <td colspan="4" style="font-size:12px;line-height:8px;padding-left:9px;"><b> '. $rate_txt.'  </b></td>
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
                                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:0px;text-align:left;font-size: 11px;font-weight:bold" colspan="4">'.$address.'</td>
                                </tr>
                                <tr>
                                    <td style="padding-left:35px;font-size:8px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                                    <td style="font-size:8px;line-height:8px;width:50.5%;padding-left:32px;" colspan = "4"><b>'.$data['name'].'</b></td>
                                </tr>           
                                <tr>
                                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                                    <td style="padding-left:0px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
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
                } else if(strtolower($login_comid) === 'inworld'){
                    $html = '<style>body{
        font-family: sans-serif;
   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                
                <tr style="papadding-top:0px;">
                    <td style="padding-left:15px;padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:0px;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                </tr>
                <tr>
                    <td style="padding-left:15px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:0px;" colspan = "4"><b>'.$data['name'].'</b></td>
                </tr>           
                <tr>
                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                    <td style="padding-left:0px" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                    
                    
                    <td colspan="4" style="padding-left:0px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:20px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:0px;"><b>Price:'.$data['srate'].' <b> </td>
                </tr>
                
            </table>
            <table>
           
            </table>';
                }
                else if(strtolower($login_comid) === 'choice' || $login_comid === 'kabini' ||  strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal'  || strtolower($login_comid) === 'royalf' ){
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
                            <table>
                           
                            </table>';
                }else if(strtolower($login_comid) === 'palack'){
                        $html = $html  .'<style>body{
                            font-family: sans-serif;
                       }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                                    
                                    <tr style="papadding-top:0px;">
                                        <td style="padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 13px;font-weight:bold" colspan="4"><br />'.$address.'</td>
                                        <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:17px;text-align:left;font-size: 13px;font-weight:bold" colspan="4"><br />'.$address.'</td>
                                    </tr>
                                         
                                    <tr>
                                        <td colspan = "4"><barcode  style="padding-left:10px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.5" text="1" /></td>
                                        <td style="padding-left:29px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height="1.5" text="1" /></td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                                        
                                        
                                        <td colspan="4" style="padding-left:35px;text-align:left;font-size:8px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                                        
                                    </tr>
                                  
                                </table>
                               ';
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
									<td colspan = "4"><barcode  style="padding-left:35px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="C39" height="1" text="1" /></td>
									<td style="padding-left:34px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".7" type="C39" height="1" text="1" /></td>
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
	
	public function print_barcodes($id,$pid = 0,$is_checked = ""){
        $purid = $id;
        $qry = "SELECT DATE_FORMAT(date, '%d%m%y') AS formatted_date FROM `purchase` WHERE id = ".$id;
        $pur_data = $this->db->query($qry)->row_array();
        $formatted_date = $pur_data['formatted_date'];
        $uid = 0;
        $qry = 'SELECT b.`code`,case when RIGHT(YEAR(date),2 ) = 0 then "" ELSE RIGHT(YEAR(date),2 ) END  AS year  FROM purchase a INNER JOIN suppliers AS b ON a.supplier_id = b.id WHERE b.code != "" and b.code != " " and a.id = '.$id;
        $pur_data = $this->db->query($qry);
        $supcode ='';
        if($pur_data->num_rows() > 0 ){
            $pur_data = $pur_data->row_array();
            $supcode = ' - '.$pur_data['code'];
        }
        $login_comid = $this->session->userdata('login_base_comid');
		if($login_comid === 'playstore'){
			
			
		}

        $margin_top = 5;

    if( strtolower($login_comid) === 'kuppayam'  || strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'seasons'  ){
        $margin_top = 1;
    }

    $settings = $this->purchase->getCompanySettings();
    $lcode = 0;
    if(isset($settings[0]['lcode']) ){
        $lcode = $settings[0]['lcode'];
    }

		$qry = "select a.*,case when expiry_date  not like'%0000%' and expiry_date  is not null then DATE_FORMAT(expiry_date	,'%d/%m/%y' )  else '' end as exp_d,case when manufacture_date  not like'%0000%' and manufacture_date  is not null then DATE_FORMAT(manufacture_date	,'%d/%m/%y' )  else '' end as mfg_d from purchase_items a where published = 'yes' and purchase_id = ".$id." order by id desc" ;
		if((int) $pid > 0 ){
			$qry = "select a.*,case when expiry_date  not like'%0000%' and expiry_date  is not null then DATE_FORMAT(expiry_date	,'%d/%m/%y' )  else '' end as exp_d,case when manufacture_date  not like'%0000%' and manufacture_date  is not null then DATE_FORMAT(manufacture_date	,'%d/%m/%y' )  else '' end as mfg_d from purchase_items a where id = ".$pid." and  published = 'yes' and purchase_id = ".$id." order by id desc" ;
		}

        if($is_checked != ''){
            $rows = $_SESSION['printids']; // e.g., [1, 2, 3]
            if (!empty($rows) && is_array($rows)) {
                $ids = implode(',', array_map('intval', $rows)); // "1,2,3"
            }
			$qry = "select a.*,case when expiry_date  not like'%0000%' and expiry_date  is not null then DATE_FORMAT(expiry_date	,'%d/%m/%y' )  else '' end as exp_d,case when manufacture_date  not like'%0000%' and manufacture_date  is not null then DATE_FORMAT(manufacture_date	,'%d/%m/%y' )  else '' end as mfg_d from purchase_items a where id in($ids) and  published = 'yes' and purchase_id = ".$id." order by id desc" ;
        }
		$p_data = $this->db->query($qry)->result_array();
			$this->load->library('M_pdf');
			$this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(78, 25), 'margin_bottom' => 1,'margin_top' => 1,'margin_right' => 0,'margin_left' => 1, 'autoPageBreak' => TRUE];
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
            if(strtolower($login_comid) === 'choice' || $login_comid === 'kabini' ||  strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal'  || strtolower($login_comid) === 'royalf'){
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
             if(strtolower($login_comid) === 'inworld'){
                $this->load->library('M_pdf');
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(90, 27), 'margin_bottom' => 0,'margin_top' => 1,'margin_right' => 0,'margin_left' => 3  , 'autoPageBreak' => TRUE];
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

            if(strtolower($login_comid) === 'cochinsilks'  || strtolower($login_comid) === 'aakaar'   || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
                $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 27), 'margin_bottom' => 0,'margin_top' =>5,'margin_right' => 0, 'autoPageBreak' => TRUE];
                $tp = "C93";

                if( strtolower($login_comid) === 'kideez' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>1,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'boyszone' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>0,'margin_right' => 0, 'autoPageBreak' => TRUE];
            
                }

                if(  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) == 'seasons' || strtolower($login_comid) == 'ssaluva' ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 7,'autoPageBreak' => TRUE];
                }

                if(strtolower($login_comid) === 'kuppayam'  ){
                    $tp = "C39";
                    $this->m_pdf->param = ['mode' => 'utf-8', 'format' => array(95, 28), 'margin_bottom' => 0,'margin_top' =>$margin_top,'margin_right' => 0, 'margin_left' => 5,'autoPageBreak' => TRUE];
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
            if($is_checked != ''){
                $printquantities = $_SESSION['printquantities'];
                $purdata['quantity'] = $printquantities[$purdata['id']];
            }
            $itm_lcode = '';
            if($lcode > 0 ){
                $itm_lcode = $purdata['itm_lcode'];
            }
			$uid = 0 ;
			$id = $purdata['item_id'];

            $qry ="select IFNULL(b.`code`,'') AS CODE ,case when RIGHT(YEAR(DATE),2 ) = 0 then '' ELSE RIGHT(YEAR(DATE),2 ) END  AS year  FROM purchase AS a LEFT  JOIN suppliers AS b ON a.supplier_id = b.id where a.id = ". $purid;
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
          //  print_r($mtext);exit;

			$settings = $this->item->getCompanySettings();
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
                if(strtolower($login_comid) === 'cochinsilks'  || strtolower($login_comid) === 'aakaar'  || strtolower($login_comid) === 'seasons' || strtolower($login_comid) === 'kuppayam'  ||  strtolower($login_comid) === 'fashion'  ||  strtolower($login_comid) === 'ssaluva'  || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
                    $iname = $data['name'];
                    $address ='AAKAAR';
                    if(strtolower($login_comid) === 'cochinsilks'  || strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
                        $address = $settings[0]['name'];
                    }

                    $tp = "C93";

                if(strtolower($login_comid) === 'senzation' || strtolower($login_comid) === 'kideez' || strtolower($login_comid) === 'boyszone' ){
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

               if( strtolower($login_comid) === 'kuppayam'){
                $rate_txt = 'Price :'.$data['MRP'].' ';
                $paddingtext = '18';

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
                                   <td colspan="4" style="padding-left:'.$paddingtext.'px;font-size:10px;line-height:5px;"><b>'.$data['barcode'].' &nbsp;&nbsp; '.$itm_lcode.'  '.$mtext .' </b></td>
                                   
                                   
                                   <td colspan="4" style="font-size:10px;line-height:5px;padding-left:8px;"><b>'.$data['barcode'].' &nbsp;&nbsp; '.$itm_lcode.'  '.$mtext .'</b></td>
                                   
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
                                    <td colspan="4" style="padding-left:0px;font-size:8px;line-height:8px;"><b>Mfd:'.$purdata['mfg_d'].',Exp :'.$purdata['exp_d'].' <b></td>							
                                    <td colspan="4" style="font-size:8px;line-height:8px;padding-left:5px;"><b>Mfd:'.$purdata['mfg_d'].',Exp :'.$purdata['exp_d'].' <b> </td>
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
                                    <td colspan="4" style="padding-left:4px;line-height:8px;"><b><font style ="font-size:10px;" ><font style ="font-size:8px;" >MRP:'.round($purdata['mrp'],2).' &nbsp;&nbsp;'.$batch.'  </font>'.$price_text.'</font> <b></td>							
                                    <td colspan="4" style="line-height:8px;padding-left:5px;"><b><font style ="font-size:8px;" >MRP:'.round($purdata['mrp'],2).' &nbsp;&nbsp;'.$batch.' <b></font><font style ="font-size:10px;" >'.$price_text.'</font> </td>
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
                else if(strtolower($login_comid) === 'inworld'){
                    $html = '<style>body{
        font-family: sans-serif;
   }</style><table style="papadding-top:0px;cellpadding:0px;width:100%">
                
                <tr style="papadding-top:0px;">
                    <td style="padding-left:15px;padding-top:10px;line-height:6px;width:49.5%;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                    <td style="padding-top:10px;line-height:8px;width:50.5%;padding-left:0px;text-align:left;font-size: 12px;font-weight:bold" colspan="4">'.$address.'</td>
                </tr>
                <tr>
                    <td style="padding-left:15px;font-size:10px;line-height:8px;width:49.5%;" colspan = "4"><b>'.$data['name'].'</b></td>
                    <td style="font-size:10px;line-height:10px;width:50.5%;padding-left:0px;" colspan = "4"><b>'.$data['name'].'</b></td>
                </tr>           
                <tr>
                    <td colspan = "4"><barcode  style="padding-left:15px;margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                    <td style="padding-left:0px" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".9" type="C93" height=".8" text="1" /></td>
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:35px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</b></td>
                    
                    
                    <td colspan="4" style="padding-left:0px;text-align:left;font-size:10px;line-height:5px;padding-right:10px;"><b>'.$data['barcode'].'</td>
                    
                </tr>
                <tr>
                    <td colspan="4" style="padding-left:20px;font-size:13px;line-height:8px;"><b>Price:'.$data['srate'].'   <b></td>							
                    <td colspan="4" style="font-size:13px;line-height:8px;padding-left:0px;"><b>Price:'.$data['srate'].' <b> </td>
                </tr>
                
            </table>
            <table>
           
            </table>';
                } 
                else if(strtolower($login_comid) === 'choice' || $login_comid === 'kabini' ||  strtolower($login_comid) === 'kabini' || strtolower($login_comid) === 'royal'  || strtolower($login_comid) === 'royalf'){
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
									<td style="padding-left:25px;" colspan = "4"><barcode  style="margin-left:-11px;width: 100%;" code="'.$data['barcode'].'" size=".6" type="C39" height=".8" text="1" /></td>
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
	 public function purchase_emei($id) {
        return $this->purchase->purchase_emei($id);
    }

    public function send_mail($id) {
        $data['id'] = $id;
        $this->load->view('_blocks/subpages/create');
        $this->load->view('transaction/purchase/send_mail', $data);
    }

    public function getMenus() {
        $db = 'aapala';
        $query = $this->db->query("call uspGetMenus()");

        return $query->result();
    }

    function order_email_test() {
        $this->load->library('email');
        $this->load->helper('path');
        $this->load->helper('directory');
        $this->email->set_newline("\r\n");
        $path = set_realpath('assets/pdf/');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.uniq.co.in';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'awards@uniq.co.in';
        $config['smtp_from_name'] = 'FROM NAME';
        $config['smtp_pass'] = 'starglaze123';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['smtp_crypto'] = 'ssl';
        $verifymsg = "Please See The Attached Order For Supplies . If You Have Any Questions , Please Contact Thank You For Your Service ";
        $this->email->initialize($config);
        $this->email->from('dimsapp@gmail.com');
        $this->email->to('jijodileep@gmail.com');
        $this->email->subject('Purchase Order ');
        $this->email->message($verifymsg);
        $this->email->attach('http://localhost/dims/assets/pdf/bill.pdf');
        echo $this->email->send();
    }

    function order_email() {
        $id = $this->input->post('id');
        $sup_id = $this->input->post('sup_id', True);
        $size = 15;
        $settings = $this->purchase->getCompanySettings();
        $company = $settings[0]['name'];
        $email = $this->input->post('mailid', True);
        $this->load->library('email');
        $this->load->helper('path');
        $this->load->helper('directory');
        $this->email->set_newline("\r\n");
        $path = set_realpath('assets/pdf/');

        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'mail.uniq.co.in';
        $config['smtp_port'] = '465';
        $config['smtp_user'] = 'awards@uniq.co.in';
        $config['smtp_from_name'] = 'FROM NAME';
        $config['smtp_pass'] = 'starglaze123';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n";
        $config['mailtype'] = 'html';
        $config['smtp_crypto'] = 'ssl';
        $verifymsg = "Please See The Attached Order For Supplies . If You Have Any Questions , Please Contact" . $settings[0]['phone'] . " Thank You For Your Service ";
        $this->email->initialize($config);
        $this->email->from($settings[0]['email']);
        $this->email->to($email);
        $this->email->subject('Purchase Order  -' . $company);
        $this->email->message($verifymsg);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->purchase->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
        $purchase = $this->purchase->getpurchase($id);
        $tcnt = $this->purchase->getpurchaseItemscnt($id);
        $hcnt = $this->purchase->getHsnItemscnt($id);
        $papersiize = $this->purchase->getValue('paper');
        $hsn = $this->purchase->getHsnItems($id);
        if ($papersiize == 'A4') {
            $size = 38; //38
        }
        $inc = ($tcnt + $hcnt + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->purchase->getpurchaseItems($id, $len, $size);
            $qry = "SELECT GST,b.name,a.* FROM `purchase_ledgers` as a INNER JOIN acc_ledgers as b on a.ledger_id = b.id left join taxgst as t on t.gstid = a.tax_id WHERE a.published ='yes' and purchase_id = ".$id;
		    $p_ledgers = $this->db->query($qry);
            $this->pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn,$p_ledgers);
        }
        $this->email->attach($pdf->Output('example_021.pdf', 'S'), 'attachment', 'report.pdf', 'assets/pdf');
        $this->email->send();
        $qry = "update purchase set purchase_status ='send'  where id=" . $id;
        $this->db->query($qry);
        $length = sizeof($sup_id);
        for ($i = 0; $i < $length; $i++) {
            $data = array(
                'purchase_id' => $id,
                'supplier_id' => $id,
            );
            $this->db->insert('order_mail', $data);
        }

        $response = array(
            'valid' => false,
            'type' => 1,
            'message' => 'Saved Successfully.'
        );
        echo json_encode($response);
    }

    public function listall($type) {
        $this->load->view('_blocks/subpages/create');
        $this->load->view('_blocks/subpages/list');
        $data['type'] = $type;
        $this->load->view('transaction/purchase/list_all', $data);
    }

    function create($type) {
        $data['is_edit'] = 1;
        $this->load->view('_blocks/subpages/create');
        $zeroindex = $this->purchase->zeroindex();
        $data['zeroindex'] = $zeroindex;
        $data['id'] = 0;
		$data['invoice'] = '';
		$data['txtestimate']=0;
        $data['view'] = 'create';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/createpurchase', $data);
    }

    function delete($id, $type) {
        $this->purchase->delete($id, $type);
    }

    function confirm_order($id, $type = "") {
        $qry = "update purchase set purchase_status ='confirmed'  where id=" . $id;
        $this->db->query($qry);
    }

    function cancel($id, $type) {
        $this->purchase->cancel($id, $type);
    }

    function edit($type, $id) {
        $is_edit = $this->purchase->GetUserPermission($type);
        $data['is_edit'] = $is_edit;
		$qry = "select * from purchase where id = ".$id." ";
		$purchase = $this->db->query($qry)->row_array();
		$data['invoice'] = $purchase ['bill_no'];
        $this->load->view('_blocks/subpages/create');
        $zeroindex = $this->purchase->zeroindex();
        $data['zeroindex'] = $zeroindex;
		$data['txtestimate']=0;
        $data['id'] = $id;
        $data['view'] = 'edit';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/createpurchase', $data);
    }

    function view($type, $id) {
		$qry = "select * from purchase where id = ".$id." ";
		$purchase = $this->db->query($qry)->row_array();
		$data['invoice'] = $purchase ['bill_no'];
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
		$data['txtestimate']=0;
        $data['view'] = 'view';
        $data['type'] = $type;
        $settings = $this->purchase->getCompanySettings();
        $data['settings'] = $settings;
        $this->load->view('transaction/purchase/create', $data);
    }

    function pert($id) {
        $this->load->view('_blocks/subpages/create');
        $data['id'] = $id;
        $data['view'] = 'return';
        $this->load->view('transaction/purchase/create', $data);
    }

    public function ajax_list() {
        $max = $this->purchase->max();
        $max_id = $max['max_id'];
        $this->purchase->where();
        $list = $this->purchase->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $purchase) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $purchase->in_date;
            $row[] = $purchase->invoice;
            $row[] = $purchase->bill_no;
            $row[] = $purchase->name;
            $row[] = $purchase->total;
            $act = '<a  href="' . base_url() . 'transaction/purchase/edit/' . $purchase->ptype . '/' . $purchase->pid . '" title="Edit" data-toggle="tooltip" class="btn btn-success pur_edit"><span class="glyphicon glyphicon-edit"></span></a>
                   <a  class="btn btn-info "  href="' . base_url() . 'transaction/purchase/view/' . $purchase->ptype . '/' . $purchase->pid . '"  title="View"  data-toggle="tooltip"><span class="glyphicon glyphicon-eye-open"></span></i></a>
                   <a tp="pdf" class="btn btn-info "  href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '" title="Bill"  data-toggle="tooltip"><span class="glyphicon glyphicon-print"></span></i></a>
              <a   tp="new" target="_blank"  href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '/download" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span></a>
				   <a  class="btn btn-primary "  href="' . base_url() . 'transaction/purchase/bill_items/' . $purchase->pid . '" title="Print Barcode"  data-toggle="tooltip"><span class="glyphicon glyphicon-modal-window"></span></i></a>
                   <a  class="btn btn-primary "  href="' . base_url() . 'transaction/purchase/billitems/' . $purchase->pid . '" title="Print Barcode"  data-toggle="tooltip">Print</i></a>';
            if ($purchase->ptype == 'order') {
                $act = $act . '<a  href="' . base_url() . 'transaction/purchase/send_mail/' . $purchase->pid . '" title="Send Email" data-toggle="tooltip" class="btn btn-success"><span class="glyphicon glyphicon-envelope"></span></a>';
            }
            if ($purchase->pid == $max_id) {

                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/purchase/listall/' . $purchase->ptype . '"  success="Delete ' . $purchase->invoice . ' successfuly "  message="Do you want Delete ' . $purchase->invoice . '?"  href="' . base_url() . 'transaction/purchase/delete/' . $purchase->pid . '/' . $purchase->ptype . '" data-toggle="tooltip" title="Delete" class="btn btn-danger"><span class="glyphicon glyphicon-remove-circle"></span></a>';
            } else {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/purchase/listall/' . $purchase->ptype . '"   success="Cancelled ' . $purchase->invoice . ' successfuly "  message="Do you want Cancel ' . $purchase->invoice . '?"  href="' . base_url() . 'transaction/purchase/cancel/' . $purchase->pid . '/' . $purchase->ptype . '" data-toggle="tooltip" title="Cancel" class="btn btn-warning"><span class="glyphicon glyphicon-ban-circle"></span></a>';
            }
            if ($purchase->pub != 'yes') {
                $act = '<a tp="pdf" href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-print"></span></a>'
             .' <a   tp="new" target="_blank"  href="' . base_url() . 'transaction/purchase/bill/' . $purchase->pid . '/download" data-toggle="tooltip" title="Print" class="btn btn-primary"><span class="glyphicon glyphicon-download"></span></a>'
					 . ' <a href="' . base_url() . 'transaction/purchase/view/purchase/' . $purchase->pid . '" data-toggle="tooltip" title="View" class="btn btn-info "><span class="glyphicon glyphicon-eye-open"></span></a>';
                $act = $act . ' <span class="btn btn-warning">Cancelled<span>';
            }
            if ($purchase->purchase_status == "send") {
                $act = $act . ' <a tp="confirm" base="' . base_url() . '/transaction/purchase/listall/' . $purchase->ptype . '"  success="Confirm Order ' . $purchase->invoice . ' successfuly "  message="Do you want Confirm Purchase Order ' . $purchase->invoice . '?"  href="' . base_url() . 'transaction/purchase/confirm_order/' . $purchase->pid . '/' . $purchase->ptype . '" data-toggle="tooltip" title="Confirm" class="btn btn-info"><span class="glyphicon glyphicon-share-alt"></span></a>';
            }


            $row[] = $act;
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->purchase->count_all(),
            "recordsFiltered" => $this->purchase->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function save($type) {
        $this->purchase->save($type);
    }

    public function save_order($type) {
        $this->purchase->save_order($type);
    }

    public function bill($id, $is_download = 'view') {
        $this->generateBill($id,$is_download);
    }

    private function generateBill($id,$is_download) {
		 $qry = "SELECT sum(total) - sum(tax) as beforetax,sum(quantity) as quantity FROM `purchase_items` WHERE published = 'yes' and purchase_id = ".$id." ";
		$summary =  $this->db->query($qry)->row_array();
        //$this->load->view('transaction/purchase/bill', $data);new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); //
        $size = 35;
        $qry = "SELECT GST,b.name,a.* FROM `purchase_ledgers` as a INNER JOIN acc_ledgers as b on a.ledger_id = b.id left join taxgst as t on t.gstid = a.tax_id WHERE a.published ='yes' and purchase_id = ".$id;
		$p_ledgers = $this->db->query($qry);
        $this->load->library('Pdf');
        $pdf = new Pdf('P', 'mm', 'A4', false, 'UTF-8', false);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetCreator(PDF_CREATOR);
        $com = $this->purchase->getCompany();
        $pdf->SetAuthor($com['name']);
        $pdf->SetTitle($com['name']);
        $pdf->SetSubject($com['name']);
        $img_file = base_url() . 'assets/images/Desert.jpg';
        //   $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetMargins(5, 0, 5, 0);
        $pdf->SetAutoPageBreak(TRUE, 0);
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
        $login_comid = $this->session->userdata('login_base_comid');
        if(strtolower($login_comid) === 'shanthi'){
            $size = 15;
        }
        $inc = ($tcnt  + 1) / $size;
        for ($i = 0; $i < $inc; $i++) {
            $len = $size * $i;
            $list = $this->purchase->getpurchaseItems($id, $len, $size);
            $this->pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details,$is_download,$i,$inc,$summary,$p_ledgers);
        }
//        ob_end_clean();

        if ($is_download == 'download') {
            $pdf->Output($purchase[0]['invoice'] . '.pdf', 'D');
        } else {
            $pdf->Output('example_021.pdf', 'I');
        }
    }

    function pages($pdf, $list, $purchase, $img_file, $size, $len, $hsn, $order_details,$is_download,$i,$inc,$summary,$p_ledgers) {
//        if (count($list) != 0) {
        $pdf->setCellPaddings(0, 0, 0, 0);
        $papersiize = $this->purchase->getValue('paper');
        $paperorient = $this->purchase->getValue('paperorient');
        $pdf->AddPage($paperorient, $papersiize);
        $data['msd'] = $this->Show_Amount_In_Words($purchase[0]['total']);
        $data['purchase'] = $purchase;
        $data['size'] = $size;
        $data['summary'] = $summary;
        $data['p_ledgers'] = $p_ledgers;
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
        $data['purchase_items'] = $list;
        $data['company'] = $this->purchase->getCompany();
		if($purchase[0]['ptp'] == 'order' ){
		    if($this->session->userdata('login_base_comid') != 'sifet'){
				$html = $this->load->view('transaction/purchase/purchase_order', $data, true);
			}else{
				$html = $this->load->view('transaction/purchase/porder', $data, true);
			}
		}else{
			$html = $this->load->view('transaction/purchase/bill', $data, true);
		}
        $pdf->writeHTML($html);
        // $pdf->Image($img_file, 110, 90, 40, 29);
    }

//    }
}
