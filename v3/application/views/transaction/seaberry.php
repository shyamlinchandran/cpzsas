 <?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '210px'; //if discont is 0

$com = substr($company['tin'], 0, 2);
$com =32;
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
                <?php echo ' &nbsp;'.$company['address'] ?> 
                <br/>
                <?php if(strtolower($this->session->userdata('login_comid')) != 'swararag'){?>	 <span style="text-align: center;font-size: 11px;">GSTIN :<?php echo $company['tin'] ?></span>
				 <br /><?php }?> <br />
               <span style="text-align: center;font-size: 12px;"><b><?php if($sales[0]['stype'] == 'sales'){ if(strtolower($this->session->userdata('login_comid')) != 'swararag'){echo 'TAX-INVOICE';}else{ echo 'INVOICE';}}else if($sales[0]['stype'] == 'estimate'){echo 'Sales Order';}else if($sales[0]['stype'] == 'sales_return'){echo 'Credit Note';}else {echo 'Delivery Note';}?></b> </span>
            </span>
            <table>
                <tr>
                    <td> </td>
                    <td>  </td>
                    <td><br/></td>
                </tr>
                <tr>
                    <td> </td>
                    <td> </td>
                    <td><br/></td>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 2px;  margin: 0px; width: 100%;">
			 <tr>
                    <td style="text-align: left;font-weight:bold;">Buyer Name & Address</td>
                    <td style="text-align: left;font-weight:bold;">Shipping Name & Address</td>
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
                    <td style="text-align: left;"> Name    :<?php echo $sales[0]['con_name'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Address     :<?php echo $sales[0]['address_line1']." ".$sales[0]['address_line2'];?>
</td>
                    <td style="text-align: left;"> Address : <?php echo $sales[0]['con_addr'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Contact No        :<?php echo $sales[0]['phone'];?></td>
                    <td style="text-align: left;"> Contact No        :<?php echo $sales[0]['con_contact'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Email              :<?php echo $sales[0]['email'];?></td>
                    <td style="text-align: left;"> Email              :</td>
                </tr>
                <tr>
                    <td style="text-align: left;"> GSTIN              :<?php echo $sales[0]['tin'] ?></td>
                    <td style="text-align: left;"> GSTIN              :<?php echo $sales[0]['con_gst'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['StateName']. ' , State Code :'.$sales[0]['custstatecode']; ?></td>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['constatename'] ?></td>
                </tr>
				
            </table>

            <hr style="border: solid 1px #222; "/>
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td>Invoice No :<?php echo $sales[0]['invoice'] ?> </td>
                    <td><?php if($sales[0]['vehicle_no'] !='re'){ echo 'Vehicle : '.$sales[0]['vehicle_no'];?> <?php } ?>  </td>
                </tr>
                <tr>
                    <td> Date :<?php echo $sales[0]['in_date'] ?> </td>
                    <td>Mode of Transport              :<?php echo $sales[0]['transport_mode'] ?></td>
                </tr>
                <tr>
                    <td>   State :<?php echo $company['statename'] ?> </td>
                    <td>Place of Supply :<?php echo $sales[0]['place'] ?></td>
                </tr>
                <tr>
                    <td> </td>
                    <td> E-WayBill No :<?php if($sales[0]['ewb_no'] != "") {echo $sales[0]['ewb_no'].' , '.$sales[0]['ewb_details']; }?> </td>
                </tr>
				<?php if( $sales[0]['transport_mode'] !='' ){ ?>
				
				<?php }?>
            </table>
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 50px;  text-align: center">HSN/SAC</th>
                    <th  class="center" style="width: 50px;  text-align: center">Quantity Nos</th>
                    <th  class="center" style="width: 50px;  text-align: center"> <?php if(strtolower($this->session->userdata('login_comid')) == 'swararag'){?> KGS <?php }else{?> Quantity (SQMR)<?php }?></th>
                    <th class="center" style="width: 42px;  text-align: center">Rate</th>
                        <th class="center" style="width: 35px;  text-align: center">Dis</th>
                        <th  class="center" style="width: 40px;  text-align: center">GST%</th>

                    <!-- <th class="center" style="width: 60px;  text-align: center">Taxable Value</th> -->
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <!-- <th class="center" style="width: 45px;  text-align: center">GST</th> -->
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
                $SQFTNO = 0;
                $ItemSQFT = 0;
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
                        <td class="center"> <?php  if($item['SQFTNO'] > 0 ){ echo round($item['SQFTNO'], 2);$SQFTNO = (float) $SQFTNO + (float)$item['SQFTNO'] ;}else{echo round($item['quantity'],2); $SQFTNO = (float) $SQFTNO + (float)$item['quantity'] ;} ?></td>
                        <td class="center"> <?php echo round($item['ItemSQFT'] * $item['SQFTNO'], 2); $ItemSQFT = (float) $ItemSQFT+ ((float) $item['ItemSQFT'] * $item['SQFTNO']);?></td>
                        <td class="center"> <?php echo round($item['mrp'], 2); ?></td>
						 <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo round($discount, 2); ?></td> 
                        <?php } ?>
                        <!-- <td class="center">  <?php //echo round(num: num: $item['total'] - $item['tax'], 1); ?></td> -->
                       
                        <!-- <td class="center"> <?php //echo round($item['tax'], 2); ?>  </td>      -->
                          <!--  <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>   
                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
    <td class="center"> <?php echo $item['GST']; ?></td>

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
                    <!-- <td> </td>
                    <td> </td> -->
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
						<th style=" width: 49.4%;"><?php if ($inc == ($cpz + 1)) { ?> Total<?php } ?></th>
                        <th style="text-align:right; width: 9%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($SQFTNO, 2); ?><?php } ?></th>
                        <th style="text-align:right; width: 9%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($ItemSQFT, 2); ?><?php } ?></th>
						<th style="text-align:right; width: 11.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php //echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 8.8%;"><?php if ($inc == ($cpz + 1)) { ?> <?php //echo round($sales[0]['tax'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 12.2%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['total']; ?><?php } ?></th>

					</tr>
				</table>
			<?php } ?>
		 
             <hr style="font-size: 13px; border: solid 1px #222; "/>  
			 <?php if ($inc == ($cpz + 1)) { ?> 
           
			<table class="mt" style="padding: 2px;  margin: 0px; width: 100%;border:1px solid black;">
				<tr class="topbr">
					<th rowspan="2" style="width:20%;text-align:center">HSN/SAC</th>
					<th rowspan="2" style="width:10%;text-align:center">Taxable <br /> Value</th>
					<th  colspan="2" style="width:20%;text-align:center">CGST</th>
					<th  colspan="2" style="width:20%;text-align:center">SGST</th>
					<th  colspan="2" style="width:20%;text-align:center">IGST</th>
					<th  rowspan="2" style="width:10%;text-align:center">Total <br />GST</th>
				</tr>
				<tr class="topbr">	
					<th  style="text-align:center">Rate</th>
					<th  style="text-align:center">Amount</th>
					<th  style="text-align:center">Rate</th>
					<th  style="text-align:center">Amount</th>
					<th  style="text-align:center">Rate</th>
					<th  style="text-align:center">Amount</th>
				</tr>
				<?php $hsn_taxable =0 ;$hsn_sgst =0;$hsn_tax =0; foreach($hsndetails as $item){
					$hsn_taxable = (float) $hsn_taxable + (float) $item['taxable'];
					$hsn_sgst = (float) $hsn_sgst + (float) $item['cgst'];
					$hsn_tax = (float) $hsn_tax + (float) $item['tax'];
 					?>
					<tr >
						<td style="text-align:center"><?php echo $item['hsncode'];?></td>
						<td style="text-align:right"><?php echo number_format(round($item['taxable'],2),2);?></td>
						<?php if((int) $com == (int)$cust){?>
							<td style="text-align:right"><?php echo $item['GST'];?></td>
							<td style="text-align:right"><?php echo number_format(round($item['cgst'],2),2);?></td>
							<td style="text-align:right"><?php echo $item['GST'];?></td>
							<td style="text-align:right"><?php echo number_format(round($item['sgst'],2),2);?></td>
							<td style="text-align:center"><?php echo $item['GST']*2;?></td>
							<td style="text-align:right"><?php echo 0.00;?></td>
						<?php }else{ ?>	
							<td style="text-align:right"><?php echo 0.00;//$item['GST'];?></td>
							<td style="text-align:right"><?php echo 0.00;?></td>
							<td style="text-align:right"><?php echo 0.00;//$item['GST'];?></td>
							<td style="text-align:right"><?php echo 0.00;?></td>
							<td style="text-align:center"><?php echo $item['GST']*2;?></td>
							<td style="text-align:right"><?php echo number_format(round($item['tax'],2),2);?></td>
						<?php } ?>
						<td style="text-align:right"><?php echo number_format(round($item['tax'],2),2);?></td>
					</tr>
				<?php }?>
				
				<tr class="topbr">
						<th style="text-align:right">Total</th>
						<th style="text-align:right"><?php echo number_format(round($hsn_taxable,2),2);?></th>
						<?php if((int) $com == (int)$cust){?>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo number_format(round($hsn_sgst,2),2);?></th>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo number_format(round($hsn_sgst,2),2);?></th>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo 0.00;?></th>
						<?php }else{ ?>	
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo 0.00;?></th>
							<th style="text-align:right"></th>
							<th style="text-align:right"><?php echo 0.00;?></th>
							<th style="text-align:right"></th>
						<th style="text-align:right"><?php echo number_format(round($hsn_tax,2),2);?></th>
						
						<?php } ?>
						<th style="text-align:right"><?php echo number_format(round($hsn_tax,2),2);?></th>
				</tr>
			</table>
			<?php } ?>
			 <?php if ($inc == ($cpz + 1)) { ?> 
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td colspan="3"><b>Total Invoice Amount in Words :   <?php echo $msd; ?> </b></td>
                </tr>
                <tr>
                    <td  style="padding-left:50px !important;">
						
					<?php if( $sales[0]['stype'] != 'sales_return' ){ ?>	Bank :<?php echo $company['comset_bank']; ?><br />A/C No:<?php echo $company['comset_account_no']; ?> <br />IFSC  :<?php echo $company['comset_ifsccode']; ?>
					
					<?php } ?>	
					 </td>
					<td>
						
						
					</td>
					<td  style="font-size:10px; text-align: right " >For  <?php echo $company['name']; ?>    </td>   
			   </tr>

               
                <tr>
                    <td></td>
                    <td></td>
                    <td  style="text-align: right " >
					<br /> <br /> <br /> 
                        Authorised Signature    

                    </td>          
				</tr>
				 <tr>
                    <td colspan="3"><u>Declaration</u> <br/>We Declare That This Invoice Shows Actual Price Of The Goods Described And That All Particulars Are True&Good </td>
                        
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

