<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '175px'; //if discont is 0


$com =33;
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
          	.clsdiv40s, .clsdiv38s, .clsdiv25s {
	display: inline-block;
	vertical-align: top;
	margin: 0;
	padding: 0;
	border: 1px solid black;
}
.clsdiv40s {
	width: 48%;
	height: 165px;
}
.clsdiv38s {
	width: 30%;
	height: 165px;
}
.clsdiv25s {
	width: 20.6%;
	height: 165px;
}
            body{
                font-family: serif;
            }
            div{
                margin: 0px !important;
                padding: 0px !important;
            }
			.divk{
				height:300px !important;
			}
            .valtb{
                padding:0px;  
                margin: 0px;  
                width:100%;
            }
            .valtb tr td {
                font-size: 12px;
                font-family: initial;
                text-align: center;
            }
            tr th {
                font-size: 10px;
                font-family: sans-serif;
                text-align: center;
            }
            tr td {
                font-size: 10px;
            }
            .center{
                text-align: right;
            }
            .spec th{
                font-weight: bold;
                font-size:10px;
                height: 15px;

            }
            .Bold{
                font-weight: bolder;
            }
            .border {
                padding: 0px; 
                margin: 0px; 
                width: 100%;
            }
            .border tr td {

                border:  solid 1px #444; 
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                border: 1px solid #222 ;
                padding-right: 1px !important;
            } 
            .mt,.mt  td  {
                border-right:  0.5px solid  #333  ; 
                padding-right: 2px !important;
                padding-left:  2px !important;

            } 

            .topbr th{
                border:   0.5px solid  #333  ; 
                font-weight: bold;
            }
            .mt th{
                border-top:    0.5px solid  #333   ; 
                font-size:10px;
                height: 10px;
            }
            .valtb td {
                font-size: 14px;
                font-weight: bold;
            }
            .right{
                text-align: right;
                padding-right: 30px;
            }
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
        <?php if($sales[0]['einvoiceqrcode']!="") {?>
            <table>
                <tr >
                    <td>EINVOICE DETAILS</td>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table>
                <tr >
                    <td style="width:70%"><br /><br /><br /><br /><br />&nbsp;AckNo :<?php  echo $sales[0]['AckNo'];?> <br />&nbsp;Irn : <?php  echo $sales[0]['einvoiceirn'];?>  
                    
                    <?php if($e_way_data->num_rows() > 0 ){

                        $ew = $e_way_data->row_array();
                        echo '<br />&nbsp; E-way Number : '.$ew['EwbNo'];
                        echo '<br />&nbsp;E-way Date : '.$ew['EwbDt'];
                    }?> </td>
                    <td style="width:30%"> <br />
                     <?php if($e_invoice_data->num_rows() > 0 ){ ?>
                     		<br />	<img align="middle"  style="margin: 0px"  height="100px"  src="uploads/<?php echo $sales[0]['einvoiceqrcode'];?>" />  
					<?php }?>
                     </td>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>

        <?php }?>
            <table>
                <tr >
                    <td></td>
                    <td style="text-align: center;font-size: 12px;font-weight:bold"><?php if($sales[0]['stype'] == 'sales_return'){echo 'Credit Note';}else{echo 'GST TAX INVOICE';}?></td>
                    <td class="right">Original/Duplicate/Triplicate</td>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table>
                <tr style="padding-left:10px ;" >
                    <td style="width:1%;"></td>
                    <td  rowspan="5" style="width:40%;margin-left:10px;padding-left:3px;text-align: left;"><font style="margin-left:10px;padding-left:3px;text-align: left;font-size: 12px;font-weight:bold"><?php echo $company['name'] ?></font><br/>
                    <?php echo $company['address'] ?> <br  />Pin :<?php echo $company['pincode'] ?> , Phone : 9843452835,9443275758 <br  />GSTIN :<?php echo $company['tin'] ?></td>
                    <td style="width:29%"> </td>
                    <td style="width:15%">GST-Invoice No.</td>
                    <td style="width:15%">: &nbsp;&nbsp;<?php echo $sales[0]['invoice'] ?></td>
                </tr>

                <tr style="padding-left:10px ;" >
                    <td style="width:1%;"></td>
                   
                    <td style="width:29%"> </td>
                    <td style="width:15%">GST-Invoice Date.</td>
                    <td style="width:15%">: &nbsp;&nbsp;<?php echo $sales[0]['in_date'] ?></td>
                </tr>
                <tr style="padding-left:10px ;" >
                    <td style="width:1%;"></td>
                   
                    <td style="width:29%"> </td>
                    <td style="width:15%">MODE</td>
                    <td style="width:15%">: &nbsp;&nbsp;<?php echo  'Credit';//$sales[0]['cash_type']; ?></td>
                </tr>
                <tr style="padding-left:10px ;" >
                    <td style="width:1%;"></td>
                   
                    <td style="width:29%"> </td>
                    <td style="width:15%"> Vechile No.</td>
                    <td style="width:15%">: &nbsp;&nbsp;<?php echo $sales[0]['vehicle_no']; ?></td>
                </tr>
            </table>

         <br />
          
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 0px;  margin: 0px; width: 100%;">
			 <tr>
                    <td style="text-align: center;font-weight:bold;">Customer Address</td>
                    <td style="text-align: center;font-weight:bold;"> Deilivery Address</td>
                </tr>
                <tr>
                    <td style="text-align: left;">  <?php 
                         if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         }
                       
                        ?></td>
                    <td style="text-align: left;"> <?php echo $sales[0]['con_name'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> <?php echo $sales[0]['address_line1'];?> 
</td>
                    <td style="text-align: left;"><?php echo $sales[0]['con_addr'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> <?php echo $sales[0]['phone'];?> State : <?php echo $sales[0]['StateName'] ?></td>
                    <td style="text-align: left;"> <?php echo $sales[0]['con_contact'];?>  State :  <?php echo $sales[0]['StateName'] ?> </td>
                </tr>
              
                <tr>
                    <td style="text-align: left;"> GSTIN              :<?php echo $sales[0]['tin'] ?></td>
                    <td style="text-align: left;"> GSTIN              :<?php echo $sales[0]['con_gst'];?></td>
                </tr>
                <!-- <tr>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['StateName'] ?></td>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['constatename'] ?></td>
                </tr> -->
				
            </table>

      
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">S<br/> No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 50px;  text-align: center">HSN<br />/ SAC</th>
                    <th  class="center" style="width: 60px;  text-align: center">Qty <br />/ Unit</th>
                    <th class="center" style="width: 50px;  text-align: center">Pcs</th>
                    <th class="center" style="width: 42px;  text-align: center">Inclu <br />Rate</th>
                    <th class="center" style="width: 45px;  text-align: center">Taxable Amount</th>
                    <th  class="center" style="width: 30px;  text-align: center">GST%</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 45px;  text-align: center">GST</th>
                       <!-- <th class="center" style="width: 40px;  text-align: center">SGST</th>-->
                        <th class="center" style="width: 50px;  text-align: center">Total</th>
                    <?php } ?>
                    <?php if ($is_discount == 0) { ?>
                        <th class="center" style="width: 90px;  text-align: center">CGST</th>
                        <!--<th class="center" style="width: 45px;  text-align: center">SGST</th>-->
                        <th class="center" style="width: 55px;  text-align: center">Total</th>
                    <?php } ?>
<!--                    <th class="center" style="width: 60px;  text-align: center">Net Amt</th>
<th class="center" style="width: 45px;  text-align: center">Tax</th>-->
                </tr>

                <?php
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                foreach ($sales_items as $item) {
                    $total = $total + $item['total'];
                    $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 1);
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($item['total'] - $item['tax']);
                    $i = $i + 1;
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <td class="center"> <?php echo $item['hsncd']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?>&nbsp;<?php echo $item['sqftunitname']; ?></td>
                        <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo $item['SQFTNO']; ?></td>
                            <?php } ?>
                        <td class="center"> <?php echo round($item['mrp'], 2); ?></td>
						
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 1); ?></td>
                        <td class="center"> <?php echo $item['GST']; ?></td>
                        <td class="center"> <?php echo round($item['tax'], 2); ?>  </td>     
                          <!--  <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>   
                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
                        <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
                    </tr>
                <?php }
                ?>

                         <?php
            if ($i == $size) {
                $len = 0;
            } else if ($i < $size) {
                $len = $size - $i;
            } else {
                $len = $size - ($i - $size);
            }
			if ($inc == ($cpz + 1)) {
				$len = $len  - sizeof($hsndetails);
			}
            for ($k = 0; $k < $len; $k++) {
                ?> 
                <tr>
                    <td>&nbsp; </td>
                    <td> </td>
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>
                    <td> </td>-->
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
					<td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            <?php } ?> 
				
				
				
            </table>
			 <?php if ($inc == ($cpz + 1)) { ?> 
				
				<?php $sales_ledgers = $sales_ledgers->result_array(); $sales_ledger_cnt = 0 ;foreach($sales_ledgers as $item) { $sales_ledger_cnt++ ;?>
						<br />
						<?php if($sales_ledger_cnt < 2){?>
							<table class="mt" style="width:100%;  padding:0px; margin: 0px;">
							<tr class="topbr" > 
								<th style=" width: 69.4%;">Ledger Name</th>
								<th style="text-align:left; width: 10.5%;">Taxable Value</th>
								<th style="text-align:left; width: 7.7%;">Tax</th>
								<th style="text-align:left; width: 12.2%;">Ledger Total</th>

							</tr>
						<?php }?>
						<tr>
								<td style=" width: 69.4%;"> <?php echo $item['name'];?></td>
								<td style="text-align:left; width: 10.5%;"><?php echo $item['amount'];?></td>
								<td style="text-align:left; width: 7.7%;"><?php echo $item['tax'];?></td>
								<td style="text-align:left; width: 12.2%;"><?php echo $item['amount'] + $item['tax'];?></td>

						</tr>
						<?php if($sales_ledger_cnt < 2){?>
							</table>
						<?php }?>
				<?php }?>
				<table class="mt" style="width:100%;  padding:0px; margin: 0px;">
					<tr>
						<th style=" width: 68.4%;"><?php if ($inc == ($cpz + 1)) { ?> Total&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sales[0]['qty'];?> <?php } ?></th>
						<th style="text-align:left; width: 11.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 10%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['tax'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 10%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['total']; ?><?php } ?></th>

					</tr>
				</table>
			<?php } ?>
		 
             <hr style="font-size: 13px; border: solid 1px #222; "/>  
			 <?php if ($inc == ($cpz + 1)) { ?> 
                <table style="width:100%; padding:0; margin:0; text-align:<?= $al ?>;">
                    <tr>
                        <td style="text-align: left;"><b>Tax Amount In Words :  <?php echo $taxableamountinwords;?></b></td>
                    </tr>
                   
                
                </table>
                <br />
                <div style="width:100%; padding:0; margin:0; text-align:<?= $al ?>;">
                    <table style="width:100%; padding:0; margin:0; text-align:<?= $al ?>;">
                        <tr>
                            <td rowspan="5" style="width:60%">

                            <table style="padding:5px;font-size:8px; width:100%; border-collapse:collapse;" border="1">
    <tr>
        <th  style="width:34%; text-align:center;">Taxable Amount</th>
        <th  style="width:23%; text-align:center;">CGST</th>
        <th  style="width:23%; text-align:center;">SGST</th>
        <th  style="width:23%; text-align:center;">IGST</th>
  </tr>
  
  <?php $taxable_t = 0 ;$taxable_igst = 0 ;$taxable_cgst = 0; foreach($taxparticulars as $tax){ ?>
  
  <tr>
    <th  style="width:34%;font-size:9px; text-align:center;"><?php $taxable_t = $taxable_t +$tax['taxable'] ; echo $tax['GST']; echo '%&nbsp;&nbsp;'; echo $tax['taxable']; ?></th>
    <th  style="width:23%; font-size:9px;text-align:center;"><?php if($com == $cust){ $taxable_cgst = $taxable_cgst + $tax['total']/2;  echo $tax['GST']/2; echo '%-&nbsp;&nbsp;'; echo $tax['total']/2;}else {echo '------';} ?></th>
    <th  style="width:23%; font-size:9px;text-align:center;"><?php  if($com == $cust){ echo $tax['GST']/2; echo '%-&nbsp;&nbsp;';  echo $tax['total']/2;} else {echo '------';}?></th>
    <th  style="width:23%; font-size:9px;text-align:center;"><?php  if($com != $cust){ $taxable_igst = $taxable_igst + $tax['total']; echo $tax['GST']; echo '%-&nbsp;&nbsp;';  echo $tax['total']; } else {echo '------';}?></th>
  </tr>

  <?php } ?>

  <tr>
    <th  style="width:34%; text-align:center;"><?php echo 'Total &nbsp; &nbsp; &nbsp;'; echo $taxable_t; ?></th>
    <th  style="width:23%; text-align:center;"><?php echo $taxable_cgst; ?></th>
    <th  style="width:23%; text-align:center;"><?php echo $taxable_cgst; ?></th>
    <th  style="width:23%; text-align:center;"><?php echo $taxable_igst; ?></th>
  </tr>
</table>


                            </td>

                            <td style="width:10%;">
                                     
                            </td>

                            <td style="width:15%;">
                                    Taxable Amount 
                            </td>
                           
                            <td style="width:15%;text-align:right">
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo number_format($sales[0]['discount'] + $sales[0]['total']-$sales[0]['tax'] -$sales[0]['cess'] + $sales[0]['freight'], 2); ?>
                             </td>
                        </tr>

                        <tr>
                        <td style="width:10%;">
                                     
                                     </td>
         
                                     <td style="width:15%;">
                                             GST TAX AMT 
                                     </td>
                                    
                                     <td style="width:15%;text-align:right">
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo number_format($sales[0]['tax'] , 2); ?>
                                      </td>
                                 </tr>

                                 <tr>
                        <td style="width:10%;">
                                     
                                     </td>
         
                                     <td style="width:15%;">
                                             Transport 
                                     </td>
                                    
                                     <td style="width:15%;text-align:right">
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo number_format($sales[0]['freight'] , 2); ?>
                                      </td>
                                 </tr>
                                 <tr>
                        <td style="width:10%;">
                                     
                                     </td>
         
                                     <td style="width:15%;">
                                             Tcs 
                                     </td>
                                    
                                     <td style="width:15%;text-align:right">
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo number_format($sales[0]['tcs_amount'] , 2); ?>
                                      </td>
                                 </tr>

                                 <tr>
                        <td style="width:10%;">
                                     
                                     </td>
         
                                     <td style="width:15%;">
                                             Net Amount 
                                     </td>
                                    
                                     <td style="width:15%;text-align:right">
                                         &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; : <?php echo number_format($sales[0]['total'] , 2); ?>
                                      </td>
                                 </tr>
                    </table>
                </div>
               
			<?php } ?>
            <!-- <p style="padding:0px;margin:0px;font-size:8px"><b>Total Invoice Amount in Words :  <?php echo $msd; ?> </b></p> -->
			 <?php if ($inc == ($cpz + 1)) { ?> 
            <table style="padding: 2px;  margin: 0px; width: 100%;">
              
            <tr>
                    <td  colspan="3"> <b>Total Invoice Amount in Words :  <?php echo $msd; ?></b>  </td>   
			   </tr>

                <tr>
                    <td colspan="2"  style="padding-left:0px !important;">
                        <table>
                             <tr>
                                <td  colspan="2" style="text-align: center;"><b>Bank Details</b></td>
                            </tr>
                            <tr>
                                <td style="width:20%;">Bank Name</td>
                                <td tyle="width:72;">:&nbsp; <?php echo $company['comset_bank']; ?>&nbsp;</td>
                            </tr>
                             <tr>
                                <td>Account No</td>
                                <td>:&nbsp; <?php echo $company['comset_account_no']; ?>&nbsp;</td>
                            </tr>
                             <tr>
                                <td>Branch</td>
                                <td>:&nbsp; KOTHANALLUR&nbsp;</td>
                            </tr>
                            <tr>
                                <td>IFSC</td>
                                <td>:&nbsp; <?php echo $company['comset_ifsccode']; ?>&nbsp;</td>
                            </tr>
                        </table>
                    <!-- <b>Company's Bank Detailes : <br /></b>
                    Bank Name:<?php echo $company['comset_bank']; ?>
                    <br />Account No:<?php echo $company['comset_account_no']; ?>
                     <br />Branch:<?php echo 'KOTHANALLUR';//$company['comset_bank']; ?>
                     <br />IFSC  :<?php echo $company['comset_ifsccode']; ?>
                     -->
                </td>
					
                    
                
					<td  style="font-size:10px; text-align: right " ><br /><br /><br />For  <?php echo $company['name']; ?>    </td>   
			   </tr>

               
                <tr>
                    <td></td>
                    <td></td>
                    <td  style="text-align: right " >
                        Authorised Sign   

                    </td>          
				</tr>
				 <tr>
                    <td colspan="3"><u>Terms & Conditions </u> <br/> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct. </td>
                        
                </tr>
            </table>
			 <?php }else{?>
				<div class="divk" >
				<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;
				</div>
			  <?php }?>
        
          
            <hr style=" <?php if ($inc == ($cpz + 1)) { }else{echo 'margin-top:100px;';} ?> border: solid 1px #222; "/>
            <table  style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                </tr>
            </table> 
        </div>
    </body>
</html>

