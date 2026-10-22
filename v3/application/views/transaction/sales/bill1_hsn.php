 <?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0

$com = substr($company['tin'], 0, 2);
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
            <table>
                <tr>
                    <td></td>
                    <td style="text-align: center;font-size: 12px"></td>
                    <td class="right"><br/></td>
                </tr>
            </table>
            <span style="text-align: center"> 
                <span style="text-align: center;font-size: 20px;"><?php echo $company['name'] ?> </span>
                <br/>
                <?php echo $company['address'] ?> 
                <br/>
            </span>
            <table>
                <tr>
                    <td> </td>
                    <td style = "text-align:center;">GSTIN :<?php echo $company['tin'] ?>  </td>
                    <td><br/></td>
                </tr>
                <tr>
                    <td> </td>
                    <td style = "text-align:center;" ><?php if($company['pan'] !=''){?> PAN :<?php echo $company['pan'] ?>  <?php }?> </td>
                    <td><br/></td>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 2px;  margin: 0px; width: 100%;">
			 <tr>
                    <td style="text-align: center;font-weight:bold;">Buyer Name & Address</td>
                    <td style="text-align: center;font-weight:bold;">Shipping Name & Address</td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Name        : <?php 
                         if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         }
                       
                        ?></td>
                    <td style="text-align: left;"> Name    :<?php if($sales[0]['con_name'] != ''){echo $sales[0]['con_name'];}else{  if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         } }?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Address     :<?php echo $sales[0]['address_line1'];?>
</td>
                    <td style="text-align: left;"> Address : <?php if($sales[0]['con_addr']!=''){echo $sales[0]['con_addr'];}else{echo $sales[0]['address_line1'];}?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Contact No        :<?php echo $sales[0]['phone'];?></td>
                    <td style="text-align: left;"> Contact No        :<?php if($sales[0]['con_addr']!=''){ echo $sales[0]['con_contact'];}else{echo $sales[0]['phone'];}?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> PAN              :<?php echo $sales[0]['pan'];?></td>
                    <td style="text-align: left;"> PAN              :<?php echo $sales[0]['pan'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> GSTIN              :<?php echo $sales[0]['tin'] ?></td>
                    <td style="text-align: left;"> GSTIN              :<?php if($sales[0]['con_addr']!=''){echo $sales[0]['con_gst'];}else{echo $sales[0]['tin'] ;}?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['StateName'] ?></td>
                    <td style="text-align: left;"> State              :<?php if($sales[0]['con_addr']!=''){ echo $sales[0]['constatename'];}else{echo $sales[0]['StateName'];} ?></td>
                </tr>
				
            </table>

            <hr style="border: solid 1px #222; "/>
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td> Date Of Supply :<?php echo $sales[0]['invoice_date'] ?> </td>
                    <td> Transportation Mode :<?php echo $sales[0]['transport_mode'] ?>  </td>
                    <td> Place Of Supply :<?php echo $sales[0]['place'] ?> </td>
                </tr>
                <tr>
                    <td> Invoice Number :<?php echo $sales[0]['invoice'] ?> </td>
                    <td> Vehicle No  :<?php echo $sales[0]['vehicle_no'] ?> </td>
                </tr>
                <tr>
                    <td> State :<?php echo $company['statename'] ?> </td>
                    <td > E-WayBill No :<?php if($sales[0]['ewb_no'] != "") {echo $sales[0]['ewb_no'].' , '.$sales[0]['ewb_details']; }?> </td>
                </tr>
				
            </table>
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 50px;  text-align: center">HSN/SAC</th>
                    <th  class="center" style="width: 30px;  text-align: center">GST%</th>
                    <th  class="center" style="width: 35px;  text-align: center">Qty</th>
                    <th class="center" style="width: 42px;  text-align: center">Rate</th>
                        <th class="center" style="width: 35px;  text-align: center">Dis</th>
                    <th class="center" style="width: 60px;  text-align: center">Taxable Value</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 45px;  text-align: center">GST</th>
                       <!-- <th class="center" style="width: 40px;  text-align: center">SGST</th>-->
                        <th class="center" style="width: 70px;  text-align: center">Total</th>
                    <?php } ?>
                    <?php if ($is_discount == 0) { ?>
                        <th class="center" style="width: 90px;  text-align: center">CGST</th>
                        <!--<th class="center" style="width: 45px;  text-align: center">SGST</th>-->
                        <th class="center" style="width: 75px;  text-align: center">Total</th>
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
                        <td class="center"> <?php echo $item['GST']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?></td>
                        <td class="center"> <?php echo round($item['mrp'], 2); ?></td>
						 <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo round($discount, 2); ?></td> 
                        <?php } ?>
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 1); ?></td>
                       
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
						<th style=" width: 69.4%;"><?php if ($inc == ($cpz + 1)) { ?> Total<?php } ?></th>
						<th style="text-align:left; width: 10.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th style="text-align:left; width: 7.7%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['tax'], 2); ?><?php } ?></th>
						<th style="text-align:left; width: 12.2%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['total']; ?><?php } ?></th>

					</tr>
				</table>
			<?php } ?>
		 
            
  
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 2px;  margin: 0px; width: 100%;border:1px solid black;">
				<tr class="topbr">
					<th rowspan="2" style="width:30%;text-align:center">HSN/SAC</th>
					<th rowspan="2" style="width:10%;text-align:center">Taxable <br /> Value</th>
					<?php if((int) $com == (int)$cust){?>
						<th  colspan="2" style="width:20%;text-align:center">Central Tax</th>
						<th  colspan="2" style="width:20%;text-align:center">State Tax</th>
					<?php }else{?>
						<th  colspan="2" style="width:40%;text-align:center">Integrated Tax </th>
					<?php }?>
					<th  rowspan="2" style="width:20%;text-align:center">Total <br />Tax</th>
				</tr>
				<tr class="topbr">	
					<?php if((int) $com == (int)$cust){?>
						<th  style="text-align:center">Rate</th>
						<th  style="text-align:center">Amount</th>
					<?php } ?>
					<th  style="text-align:center">Rate</th>
					<th  style="text-align:center">Amount</th>
				</tr>
				<?php $tot_tax= 0;$hsn_taxable =0 ;$hsn_sgst =0;$hsn_tax =0; foreach($hsndetails as $item){
					$hsn_taxable = (float) $hsn_taxable + (float) $item['taxable'];
					$hsn_sgst = (float) $hsn_sgst + (float) $item['cgst'];
					$hsn_tax = (float) $hsn_tax + (float) $item['tax'];
					$tot_tax = (float) $tot_tax + (float) $item['tax'];
 					?>
					<tr >
						<td style="text-align:left"><?php echo $item['hsncode'];?></td>
						<td style="text-align:right"><?php echo $item['taxable'];?></td>
						<?php if((int) $com == (int)$cust){?>
							<td style="text-align:right"><?php echo $item['GST'];?></td>
							<td style="text-align:right"><?php echo round((float)$item['cgst'],2);?></td>
							<td style="text-align:right"><?php echo $item['GST'];?></td>
							<td style="text-align:right"><?php echo round((float)$item['sgst'],2);?></td>
							<td style="text-align:right"><?php echo $item['tax'];?></td>
						<?php }else{ ?>
							<td style="text-align:center"><?php echo $item['GST']*2;?></td>
							<td style="text-align:center"><?php echo round((float)$item['tax'],2);?></td>
							<td style="text-align:center"><?php echo $item['tax'];?></td>
						<?php } ?>
						
					</tr>
				<?php }?>
				<tr class="topbr">
						<th style="text-align:right">Total</th>
						<th style="text-align:right"><?php echo $hsn_taxable;?></th>
						<?php if((int) $com == (int)$cust){?>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo $hsn_sgst;?></th>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo $hsn_sgst;?></th>
							<th style="text-align:right"><?php echo $hsn_tax;?></th>
						<?php }else{ ?>
							<th style="text-align:right"></th>
							<th style="text-align:center"><?php echo $hsn_tax;?></th>
							<th style="text-align:center"><?php echo $hsn_tax;?></th>
						<?php } ?>
				</tr>
			</table>
			 <?php if ($inc == ($cpz + 1)) { ?> 
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td colspan="2"><b>Total Invoice Amount in Words :   <?php echo $msd; ?> </b></td>
                </tr>
                <tr>
                    <td colspan="1" style="padding-left:50px !important;">Bank :<?php echo $company['comset_bank']; ?><br />A/C No:<?php echo $company['comset_account_no']; ?> <br />IFSC  :<?php echo $company['comset_ifsccode']; ?> </td>
					<td  style="font-size:10px; text-align: right " >For  <?php echo $company['name']; ?>    </td>   
			   </tr>

                <tr>
                    <td><u>Declaration</u> <br/>We Declare That This Invoice Shows Actual Price Of The Goods Described And That All Particulars Are True&Good</td>
                    <td  style="font-size:10px; text-align: center " >
                         
                        <br/>

                    </td>         
                </tr>
                <tr>
                    <td></td>
                    <td  style="text-align: right; " >
                        Authorised Signature    
                        <br/>

                        <br/>
                    </td>                </tr>
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

