 <?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '130px'; //if discont is 0
$com_tin = '32';
if($sales[0]['tin'] =='' ){
	$sales[0]['tin'] = $sales[0]['custstatecode'];
}
if($sales[0]['tin'] =='' ){
	$cust_tin = '32';
	
}else{
	$cust_tin = substr($sales[0]['tin'],0,2);
	
}
if($cust_tin != $com_tin) {
	$itemwd = '190px';

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
			.tdimage{
				padding-top:10px !important;
				margin-top:10px !important;
			}
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
			 <hr style="font-size: 13px; border: solid 1px #222; "/>  
			<table style="width:100%;">
				
				<tr>
					<td style="width:100%;text-align:center">
					
					<p><font style="font-size: 1.2em" ><?php echo $company['name'] ?></font><br /><?php echo $company['address'] ?><br /><?php echo $company['phone'] ?><br /><?php echo $company['tin'] ?><br /></p>
					</td>
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
                    <td style="text-align: left;"> Name    :<?php echo $sales[0]['con_name'];?></td>
                </tr>
                <tr>
                    <td style="text-align: left;"> Address     :<?php echo $sales[0]['address_line1'];?>
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
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['StateName'] ?></td>
                    <td style="text-align: left;"> State              :<?php echo $sales[0]['constatename'] ?></td>
                </tr>
            </table>

            <hr style="border: solid 1px #222; "/>
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td> Date Of Supply :<?php echo $sales[0]['invoice_date'] ?> </td>
                    <td> Transportation Mode : </td>
                </tr>
                <tr>
                    <td> Invoice Number :<?php echo $sales[0]['invoice'] ?> </td>
                    <td> Dispatch Number :</td>
                </tr>
                <tr>
                    <td> State :<?php echo $company['statename'] ?> </td>
                    <td> E-WayBill No :<?php if($sales[0]['ewb_no'] != "") {echo $sales[0]['ewb_no'].' , '.$sales[0]['ewb_details']; }?> </td>
                </tr>
            </table>
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th rowspan="2" style=" width: 20px; text-align: center">Sl No</th>
                    <th rowspan="2" style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
					<th  rowspan="2" class="center" style="width: 40px;  text-align: center">HSN</th>
                    <th  rowspan="2" class="center" style="width: 35px;  text-align: center">Qty</th>
                    <th  rowspan="2" class="center" style="width: 25px;  text-align: center">Unit</th>
                    <th rowspan="2" class="center" style="width: 42px;  text-align: center">Rate</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th rowspan="2" class="center" style="width: 35px;  text-align: center">Dis</th>
						<th rowspan="2" class="center" style="width: 45px;  text-align: center">Taxable Value</th>
						<?php if($cust_tin == $com_tin) {?>
							<th  colspan="2" class="center" style="width: 70px;  text-align: center">CGST</th>
							<th  colspan="2" class="center" style="width: 70px;  text-align: center">SGST</th>
						<?php }else{?>
							<th  colspan="2" class="center" style="width: 90px;  text-align: center">IGST</th>
						<?php }?>

							<th rowspan="2" class="center" style="width: 55px;  text-align: center">Total</th>
				   <?php } ?>
                    <?php if ($is_discount == 0) { ?>
						<th rowspan="2" class="center" style="width: 45px;  text-align: center">Taxable Value</th>
                        <th colspan="2" class="center" style="width: 45px;  text-align: center">CGST</th>
                        <th colspan="2" class="center" style="width: 45px;  text-align: center">SGST</th>
                        <th rowspan="2" class="center" style="width: 85px;  text-align: center">Total</th>
                    <?php } ?>
<!--                    <th class="center" style="width: 60px;  text-align: center">Net Amt</th>
<th class="center" style="width: 45px;  text-align: center">Tax</th>-->
                </tr>
					
                <tr class="topbr" > 
					<th style="font-size:8px;">Rate</th>
					<th style="font-size:8px;">Amount</th>
					<?php if($cust_tin == $com_tin) {?>
						<th style="font-size:8px;">Rate</th>
						<th style="font-size:8px;">Amount</th>
					<?php } ?>
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
					$kfc= 0;
					if($sales[0]['saletype'] == 'b2c' ){
						$kfc = $item['ces_amt'];
					}
                    $i = $i + 1;
						$rate = $item['mrp'];
						if($item['GST'] > 0 ){
							$rate = ($item['total'] - $item['tax'])/ $item['quantity'];
						}
                    ?>
                    <tr>
                        <td style="height:15px;"> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?><?php if($item['item_discription'] != ''){ echo ' ('.$item['item_discription'].')';} ?></td>
                        <td class="center"> <?php echo $item['hsncd']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?></td>
                        <td class="center"> <?php echo $item['ucode']; ?></td>
                        <td class="center"> <?php echo round($rate, 2); ?></td>
                        <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo round($discount, 2); ?></td> 
                        <?php } ?>
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 2); ?></td>
						<?php if($cust_tin == $com_tin) {?>
							<td class="center"> <?php echo round($item['GST'] / 2, 2); ?>  </td>     
							<td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>  
							<td class="center"> <?php echo round($item['GST'] / 2, 2); ?>  </td>     
							<td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>   
						<?php }else{?>
							<td class="center"> <?php echo round($item['GST'] , 2); ?>  </td>     
							<td class="center"> <?php echo round($item['tax'] , 2); ?>  </td>  
						<?php }?>
						
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
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
                    <td style="height:15px;">&nbsp; </td>
                    <td> </td>
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>-->
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
					<?php if($cust_tin == $com_tin) {?>
					  <td> </td>
					  <td> </td>
					<?php }?>	
                    <td> </td>
					<td> </td>
                    <td> </td>
                    <td> </td>
						<td> </td>
                </tr>
            <?php } ?> 
			
				
				
            </table>
			 <?php if ($inc != ($cpz + 1)) { ?> 
          
        <?php } ?>
	
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
					<th style=" width: 50%;"><?php if ($inc == ($cpz + 1)) { ?> Total<?php } ?></th>
					
                    <th style=" width: 9%;"></th>
					<?php if($cust_tin == $com_tin) {?>
						<th style="text-align:right; width: 9%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['total'] -$sales[0]['tax'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 12%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['tax'] / 2, 2); ?><?php } ?></th>
						<th style=" text-align:right;width: 13%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['tax'] / 2, 2); ?><?php } ?></th>
					<?php }else{?>
						<th style="text-align:right; width: 18%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['total']- $sales[0]['tax'], 2); ?><?php } ?></th>
						<th style="text-align:right; width: 16%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['tax'], 2); ?><?php } ?></th>
					<?php } ?>
					   <th style="text-align:right; width: 7%;"><?php if ($inc == ($cpz + 1)) { ?> <?php echo round($sales[0]['total'], 2); ?><?php } ?></th>
                </tr>
            </table>
				  <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
				<tr class="topbar">
					<th style="height:20px;width:70%;border-right:1px solid black;"><?php if ($inc == ($cpz + 1)) { ?><?php echo $msd; ?><?php }?></th>
					<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Before Tax</th>
					<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['total'] + $sales[0]['roundoff'] - $sales[0]['tax'], 2) ?><?php }?></th>
				</tr>

				<?php if( (float) $sales[0]['tax'] > 0 ) {?>
					<tr class="topbar">
						<th rowspan="5" style="width:70%;border-right:1px solid black;"><?php //echo $sales[0]['terms_condition']; ?></th>
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Add CGST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax']/2, 2) ?><?php }?></th>
					</tr>
					<tr class="topbar">
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Add SGST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax']/2, 2) ?><?php }?></th>
					</tr>
					<tr class="topbar">
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">GST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax'], 2) ?><?php }?></th>
					</tr>
				<?php }else{ ?>
					<tr class="topbar">
						<th rowspan="5" style="width:70%;border-right:1px solid black;"><?php //echo $sales[0]['terms_condition']; ?></th>
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Add CGST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax'], 2) ?><?php }?></th>
					</tr>
					<tr class="topbar">
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Add SGST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax'], 2) ?><?php }?></th>
					</tr>
					<tr class="topbar">
						<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">GST</th>
						<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['tax'], 2) ?><?php }?></th>
					</tr>
				<?php } ?>
				
				<tr class="topbar">
					<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Round Off</th>
					<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['roundoff'], 2) ?><?php }?></th>
				</tr>
				
				<tr class="topbar">
					<th style="height:20px;text-align:right;width:15%;border-right:1px solid black;">Invoice Total</th>
					<th style="height:20px;text-align:right;width:15%;"><?php if ($inc == ($cpz + 1)) { ?><?php echo number_format($sales[0]['total'], 2) ?><?php }?></th>
				</tr>
		  </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
		                    <table  style="padding-top:40px;width:100%;">
                <tr>
                    <td style="width:33%; text-align:<?= $al ?>">

                        <?= label('Prepared by', $this, $user) ?> : <?= $sales[0]['user_name']; ?>
                    </td>
                    <td style="width:34%; text-align: center">
                        <?= label('Company Seal', $this, $user) ?>   
                    </td>
                    <td style="width:33%; text-align:<?= $dir ?>">
                        <?= label('Received By', $this, $user) ?>    
                    </td>
                </tr>
            </table>


        <hr style="border: solid 1px #222; "/> 
        <table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
            <tr>
                <td  style="font-size:10px; text-align: center ">  
                    <?= label('Bank Details', $this, $user) ?> 
                    <?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?>, 
                    <?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> ,
                    <?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?></td>
            </tr>
            <tr>
                <td  style="font-size:8px; text-align: center ">**<?= label('This is a Computer Generated Invoice', $this, $user) ?>**</td>
            </tr>
            <tr>
                <td  style="font-size:10px; text-align: center "><?php echo $inc . '-' . number_format($cpz + 1); ?></td>

            </tr>
        </table> 
			

          
           <!-- <hr style=" <?php if ($inc == ($cpz + 1)) { }else{echo 'margin-top:100px;';} ?> border: solid 1px #222; "/>-->
        
        </div>
    </body>
</html>

