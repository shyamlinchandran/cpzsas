<?php
$is_discount = 0;
//$itemwd = '210px';
$itemwd = '185px'; //if discont is 0
$com = substr($company['comset_statecode'], 0, 2);
$com =32;
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

}
if((int) $com != (int)$cust){
    $itemwd = '238px'; //if discont is 0
}

?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                font-family: serif;
            }
            div{
                margin: 0px !important;
                padding: 0px !important;
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
            table {
            width: 100%;
            border-collapse: collapse;
        }
        .tbcolr {
            padding: 10px;
            text-align: left;
            border: 1px solid #000; /* Add border for better visibility */
        }
        .ash-bg {
            background-color: #D3D3D3; /* Ash color */
        }
        
        .invoice-details {
    text-align: left;
    margin-left: 20px; /* Align labels to the left */
}
body { font-family: serif; }
        .invoice-container { width: 800px; margin: auto; border: 1px solid #222; padding: 20px; }
        .header { text-align: center; font-size: 20px; font-weight: bold; }
        .company-logo {
            text-align: left;
            margin-bottom: 10px;
        }
        .company-logo img {
            max-width: 150px;
            height: auto;
        }
        .details, .items, .total-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .details td, .items th, .items td, .total-table th, .total-table td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        .total-table {
            font-weight: bold;
        }
        .footer-table td {
            font-size: 9px;
            vertical-align: top;
            padding: 10px;
        }
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
            <table>
                <tr>
                    <td> 
                        <br/><br/>
                        
                        
                         
                     <img src="<?php echo base_url('uploads/company/'.$company['logo']); ?>" alt="Logo" width="180" height="50" />
     
                     </td>
                    <td style="text-align: left;font-size: 10px">
                        <br />
                        <b style="font-size:15px;"><?php echo $company['name'];?></b><br/><br /><span style="padding-left:0px;padding:0px;margin:0px"><?php echo $company['address'] ?></span>
                        <br /> Phone : <?php echo $company['phone'];?>
                        <br /> GSTIN : <?php echo $company['tin'];?>
                    </td>
                    <td class="right"style="font-size: 14px">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                  
                    
                    <?php if($sales[0]['stype'] =='sales'){?> <b>TAX INVOICE</b><?php }else if($sales[0]['stype'] =='sales_return'){?>  <b>CREDIT NOTE</b> <?php }else{?>  <b>PERFORMA INVOICE</b> <?php }?> </td>
                </tr>
                 
                <hr style="font-size: 13px; border: solid 1px #222; "/>  
       
            <table style="width: 100%;" border="10%">
                <tr>
                    <td style="width: 50%; "  class="invoice-details">
                        <br />
                        Invoice Number: <b> <?php echo $sales[0]['invoice'];?></b><br/>
                        Invoice Date: <b><?php echo $sales[0]['in_date'];?></b> <br/>
                        Terms: <b> </b><br/>
                        Due Date: <b></b><br/>
                    </td>
                    <td style="width: 50%;">
                     
                        Place Of Supply: <b>Kerala(32)</b>

                        <?php if($sales[0]['ewb_no'] != ''){?>
				<p style ="padding-left:10px;" >EWB No : <?php echo $sales[0]['ewb_no'];?> <br />EWB Date : <?php echo $sales[0]['ewb_details'];?></p>
				<?php }?>
                    </td>

                    
                </tr>
            </table>
            <table style="width: 100%;" border="10%">
                <tr>
                    <td style="width: 50%;" class="tbcolr ash-bg">
                       Bill To
                    </td>
                    <td style="width: 50%;" class="tbcolr ash-bg">
                     Ship To
                    </td>
                     </tr>
                     <tr>
                    <td>
                    <br/>
                    <b><?php 
                                            if ($sales[0]['customer_id']==0){
                                                echo $sales[0]['cusname'] ;
                                            }
                                            else{
                                                echo $sales[0]['name'] ;
                                            }
                                        
                                            ?></b><br/>
                     <?php echo $sales[0]['address_line1'];?><br/>
                     GSTIN :<?php echo $sales[0]['tin'];?><br/>
                     Phone <?php echo $sales[0]['phone'];?>

                    </td>
                    <td>
                    <br/>
                   <b><?php if($sales[0]['con_name'] != ''){echo $sales[0]['con_name'];}else{  if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         } }?></b>  <br/>
                   <?php if($sales[0]['con_addr']!=''){echo $sales[0]['con_addr'];}else{echo $sales[0]['address_line1'];}?><br/>
                   GSTIN :<?php echo $sales[0]['tin'];?><br/>
                   Phone <?php echo $sales[0]['phone'];?>        
                </td>
                </tr>

            </table>
                <hr style="font-size: 13px; border: solid 1px #222; "/>  
                 
<table>
    <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="1">
                <tr class="topbr ash-bg" > 
                    <th rowspan = "2" style=" width: 20px; text-align: center; ">#</th>
                    <th rowspan = "2" style="width: <?php echo $itemwd;?>;  text-align: center">Item & Description</th>
                    <th rowspan = "2"  class="center" style=" text-align: center">HSN/SAC</th>                
                    <th rowspan = "2"  class="center"  style="  text-align: center; width: 35px;">Qty</th>
                    <th rowspan = "2" class="center" style=" width: 45px; text-align: center">Rate</th>
                    <?php if((int) $com == (int)$cust){?>
                        <th  colspan="2" class="center" style="width: 80px;  text-align: center">CGST</th>
							<th  colspan="2" class="center" style="width: 80px;  text-align: center">SGST</th>
						<?php }else{?>
							<th  colspan="2" class="center" style="width: 80px;  text-align: center">IGST</th>
						<?php }?>                                   
                    <th  rowspan = "2" class="center" style="width:60px;   text-align: center">Amount</th>
                      
                </tr>
                <tr class="topbr ash-bg" >
                    <th style="width:20px">%</th>
                    <th style="width:60px">Amount</th>
                    <?php if((int) $com == (int)$cust){?>
                    <th style="width:20px">%</th>
                    <th style="width:60px">Amount</th>
                    <?php }?>  
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

                        $rate = $item['mrp'];
						if($item['GST'] > 0 ){
							$rate = ($item['total'] - $item['tax'])/ $item['quantity'];
						}
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <td class="center"> <?php echo $item['hsncd']; ?></td>
                        <td class="center"> <?php echo $item['quantity']; ?></td>
                        <td class="center"> <?php echo round($rate, 1); ?></td>

						<?php if((int) $com == (int)$cust){?>
							<td class="center" style="width:20px"> <?php echo number_format($item['GST'] / 2, 0); ?>  </td>     
							<td class="center" style="width:60px"> <?php echo number_format($item['tax'] / 2, 2); ?>  </td>  
							<td class="center"  style="width:20px"> <?php echo number_format($item['GST'] / 2, 0); ?>  </td>     
							<td class="center" style="width:60px"> <?php echo number_format($item['tax'] / 2, 2); ?>  </td>   
						<?php }else{?>
							<td class="center" style="width:20px"> <?php echo number_format($item['GST'] , 0); ?>  </td>     
							<td class="center" style="width:60px"> <?php echo number_format($item['tax'] , 2); ?>  </td>  
						<?php }?>

                        <td class="center"> <?php echo $item['total']; ?></td>
                    </tr>
                <?php }
                ?>

                <!-- <?php
                $len = $size - $i - 1;
                for ($i = 0; $i < $len; $i++) {
                    ?> 
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                      
						<?php if((int) $com == (int)$cust){?>
                            <td> </td>
                            <td> </td>
                        <?php }?>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                <?php } ?>  -->


                <?php
// Number of empty rows needed to fill this specific page
$blank_rows_needed = $size - count($sales_items);

for ($k = 0; $k < $blank_rows_needed; $k++) {
?> 
    <tr>
        <td> </td>
        <td> </td>
        <td> </td>
        
        <?php if ((int)$com == (int)$cust) { ?>
            <td> </td>
            <td> </td>
        <?php } ?>
        <td> </td>
        <td> </td>
        <td> </td>
        <td> </td>
    </tr>
<?php } ?>
            </table>
            <hr style="border: solid 1px #222; "/>
           
          


            </table>
         
            
             
        <table style="padding: 0px; margin: 0px; width: 100%; ">
            <tr>
                <td colspan="8"  style="font-size: 9px; text-transform: capitalize;width:64%;">
                    <br/>
                    <br/>
                    <b>Total In Words Rs:</b>&nbsp; <b style="font-size:12px;"><?php echo $msd;?></b>
                    <br/>
                    <br/>
                    <b>Notes</b>
                    <br/><br/>
                    <b>BANK DETAILS:</b><br/>
                    Account Number: <?php echo $company['comset_account_no']; ?>  &nbsp;&nbsp;<br /> IFSC: <?php echo $company['comset_ifsccode']; ?> <br/>
                    BANK NAME: <?php echo $company['comset_bank']; ?> <br/>
                    <!--BRANCH NAME: <?php echo $company['comset_ifsccode']; ?>  <br/>-->
                    <?php if($sales[0]['terms_condition'] !=''){?>
                    <br/>
                    <b>Terms & Conditions</b> <br/>
                    <?php  echo $sales[0]['terms_condition'];?> 
                    <?php }?>
                    <!-- # Goods once sold will not be taken back without consent in writing.<br/>
                    # Interest will be recovered @2% per month on overdue unpaid bills.<br/>
                    # We shall not be responsible for any loss or damage due to transportation.<br/>
                    # Subject to Eraniel Jurisdiction.<br/> -->
                </td>
                <td colspan="1" style="width:18%;font-size: 10px; text-align: center; vertical-align: top;">
                    <b>Sub Total </b> 
                    <?php if((int) $com == (int)$cust){?>
                        <br/>
                        <b>CGST</b> 
                        <br/>
                        <b>SGST</b> 
                    <?php }else{?>
                        <br/>
                        <b>IGST</b> 
                    <?php }?>
                    <br/>
                    <b>Total </b>  
                   
                </td>
                <td  colspan="1" style="width:5%;width:10px;font-size: 10px;font-weight:bold; text-align: right; vertical-align: top;">
                    <b>:</b> 
                    <?php if((int) $com == (int)$cust){?>
                        <br/>
                        <b>:</b> 
                        <br/>
                        <b>:</b> 
                    <?php }else{?>
                        <br/>
                        <b>:</b> 
                    <?php }?>
                    <br/>
                    <b>: </b>  
                   
                </td>
                <td  colspan="1" style="width:15%;font-size: 10px;font-weight:bold; text-align: right; vertical-align: top;">
                   <?php echo number_format($sales[0]['total'] - $sales[0]['tax'],2) ;?> 
                    <?php if((int) $com == (int)$cust){?>
                    <br/> 
                   <?php echo number_format($sales[0]['tax']/2,2) ;?>
                  <br/>
                   <?php echo number_format($sales[0]['tax']/2,2) ;?>
                  <?php }else{?>
                    <br/>
                   <?php echo number_format($sales[0]['tax'],2) ;?>
                    <?php }?>
                    <br/>
                   <b style="font-weight:15px"><?php echo number_format($sales[0]['total'],2) ;?></b>
                   
                </td>
            </tr>
            <tr>
              
                <td colspan="12" style="font-size: 10px; text-align: right;">
                    <br/>
                    <!-- <img src="<?php echo base_url('uploads/company/eminentsign.jpeg'); ?>" alt="Logo" width="100" height="60" /> -->
                    <br/> 
                    <b>Authorized Signature&nbsp;&nbsp;&nbsp;&nbsp;</b>
                </td>
            </tr>
        </table>
    
           
        </div>
    </body>
</html>

