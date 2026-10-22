<?php
$is_discount = 1;
//$itemwd = '210px';
$itemwd = '145px'; //if discont is 0
$login_comid = $this->session->userdata('login_comid');
$com = substr($company['comset_statecode'], 0, 2);
$com =$company['statecode'];

 $tin = $purchase[0]['tin'];

if($tin == '' || $tin == null){
	$cust = $com;
}else{
	$cust = substr($tin, 0, 2);

}

if($com == $cust){

}else{
	$itemwd = '190px'; //if discont is 0

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
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
            <table>
                <tr>
                    <td>GST No:<?php echo $company['tin'] ?></td>
                    <td style="text-align: center;font-size: 12px">
						<?php if($note == ''){?>
							<?php if($purchase[0]['ptp'] == 'purchase'){?>
								INVOICE-CASH/CREDIT
							<?php } ?>
							<?php if($purchase[0]['ptp'] == 'purchase_return'){?>
								DEBIT NOTE
							<?php } ?>
							<?php if($purchase[0]['ptp'] == 'order'){?>
								Purchase Order
							<?php } ?>
						<?php }else{ ?>
						
						<?php  echo $note ; } ?>
					</td>
                    <td class="right">Original for Receipient<br/>Duplicate for Supplier / Transporter</td>
                </tr>
            </table>
            <span style="text-align: center"> 
                <span style="text-align: center;font-size: 20px;"><?php echo $company['name'] ?> </span>
                <br/>
                <?php echo $company['address'] ?> 
            </span>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 0px;  margin: 0px; width: 100%;">
                <tr>
                    <td style="width: 50%" rowspan="4"><b>To ,  </b>
                        <?php 
                         if ($purchase[0]['supplier_id']==0){
                              echo $purchase[0]['name'] ;
                         }
                         else{
                              echo $purchase[0]['name'] ;
                         }
                       
                        ?>
                        <br/>
                        <?php echo $purchase[0]['address_line1'];?>
                        <br/>
                        Phone: <?php echo $purchase[0]['phone'];?>
                    </td>
                    <td style="width: 50%"><?php if($purchase[0]['ptp'] == 'purchase'){?>
								Invoice No : 
							<?php } ?>
							<?php if($purchase[0]['ptp'] == 'purchase_return'){?>
								Debit Note No :
							<?php } ?>
							<?php if($purchase[0]['ptp'] == 'order'){?>
								 Order No :
							<?php } ?>  <?php echo $purchase[0]['bill_no'] ?></td>
                </tr>
                <tr>

                    <td >State: KERALA , 32 <?php //echo $company['cst']  ?> </td> 
                </tr> 
                <tr>

                    <td>Date <?php echo $purchase[0]['in_date'] ?></td>
                </tr>
                <tr>
                    <td>
						E-way no && Date : <?php if($purchase[0]['ewb_no'] !='' ){echo $purchase[0]['ewb_no'] . ' ,  ' .$purchase[0]['ewb_details'] ;}?>
					</td>
                </tr> 
                <tr>
                    <td style="text-align: left;">GST:<?php echo $purchase[0]['tin'] ?>  </td> 
                    <td>Ref No: <?php  echo $purchase[0]['po_ref_no']                           ?> </td> 
                </tr> 
                <tr>
                    <td style="text-align: left;">
                    </td>

                    <td>Phone <?php // echo $company['phone']                           ?> 
                    </td> 

                </tr> 
            </table>

            <hr style="border: solid 1px #222; "/>
            <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Item</th>
                    <th  class="center" style="width: 50px;  text-align: center">HSN</th>
                    <th  class="center" style="width: 30px;  text-align: center">GST</th>
                    <th  class="center" style="width: 35px;  text-align: center">Qty</th>
                    <th  class="center" style="width: 30x;  text-align: center">FQty</th>
                   
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                   
                    <?php if ($is_discount == 0) { ?>
			    <th class="center" style="width: 47px;  text-align: center">Rate</th>
                  	  <th class="center" style="width: 50px;  text-align: center">Amount</th>
                  	  <th class="center" style="width: 45px;  text-align: center">CGST</th>
                  	  <th class="center" style="width: 45px;  text-align: center">SGST</th>
                    <?php } ?>
 			<?php if ($is_discount == 1) { ?>
			  <th class="center" style="width: 37px;  text-align: center">Rate</th>
                         <th class="center" style="width: 30px;  text-align: center">Dis</th>
                          <th class="center" style="width: 45px;  text-align: center">Amt</th>
						<?php if($com == $cust){ ?>
							<th class="center" style="width: 45px;  text-align: center">CGST</th>
							<th class="center" style="width: 45px;  text-align: center">SGST</th>
						<?php }else{?>
							<th class="center" style="width: 45px;  text-align: center">IGST</th>
						<?php }?>
                    <?php } ?>
<!--                    <th class="center" style="width: 60px;  text-align: center">Net Amt</th>
<th class="center" style="width: 45px;  text-align: center">Tax</th>-->
                    <th class="center" style="width: 55px;  text-align: center">Total</th>
                </tr>

                <?php
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                foreach ($purchase_items as $item) {
                    if($item['discount']!=0){
                    $rowtotal=((($item['rate']-$item['rate']*$item['discount']/100)*$item['quantity']) +$item['tax']);
                     $discount = ($item['quantity'] * ($item['rate'] * $item['discount'] / 100));
                    }
                    else
                    {
                       $rowtotal=$item['rate']*$item['quantity']+$item['tax'];
                        $discount=0;
                    }

                    $total = $total +$rowtotal ;
                   
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + $rowtotal - $item['tax'];
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['rate'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($rowtotal - $item['tax']);
                    $i = $i + 1;
					$rate = $item['rate'];
					if( (float) $item['is_taxincluded'] >  0 && (float) $item['GST'] > 0 ){
						$taxamt = (float) $rate - (((float) $rate * 100) / ((float) $item['GST'] + 100));
						$rate = (float) $rate - (float) $taxamt;
					}
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <td class="center"> <?php echo $item['hsncd']; ?></td>
                        <td class="center"> <?php echo $item['GST']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?></td>
                        <td class="center"> <?php echo round($item['free_quantity'], 1); ?></td>
                         <?php if ($is_discount == 0) { ?>
 			 	<td class="center"> <?php echo round($rate, 2); ?></td>
                      	         <td class="center">  <?php echo round(($item['total'] - $item['tax']), 1); ?></td>
                         	<td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>     
                      	        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td> 
                        <?php } ?>
                         <?php if ($is_discount == 1) { ?>
								<td class="center"> <?php echo round($rate, 2); ?></td>
								<td class="center"> <?php echo round($item['discount'], 2); ?></td> 
                      	         <td class="center">  <?php echo round(($item['total'] - $item['tax']), 1); ?></td>
								 <?php if($com == $cust){ ?>
										<td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>     
										<td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>
								 <?php } else{?>
											<td class="center"> <?php echo round($item['tax'] , 2); ?>  </td>
								  <?php } ?>
                        <?php } ?>
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
                        <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
                    </tr>
                <?php }
                ?>

                <?php if ($inc == ($cpz + 1)) { ?> 
				<?php $sales_ledgers = $p_ledgers->result_array(); $sales_ledger_cnt = 0 ;foreach($sales_ledgers as $sa) { $sales_ledger_cnt++ ;?>
					<tr>
						<td></td>
						<td><?php echo $sa['name']; ?></td>
						<td></td>
						<td></td>
						<td>1</td>
						<td></td>
						<td><?php echo round($sa['amount'],0); ?></td>
						<td></td>
						<td><?php echo round($sa['amount'],0); ?></td>
						<td><?php echo number_format($sa['tax']/2, 2); ?> </td>
						<td><?php echo number_format($sa['tax']/2, 2); ?> </td>
						<td><?php echo number_format($sa['tax']+  $sa['amount'], 2); ?> </td>
					</tr>
				
				<?php }}?>

                <?php
                $len = $size - $i - 1;
                for ($i = 0; $i < $len; $i++) {
                    ?> 
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                         <?php if ($is_discount == 1) { ?>
                        <td> </td>
                        <?php } ?>
						 <?php if($com == $cust){ ?>
							<td> </td>
						 <?php }?>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                <?php } ?> 
            </table>
            
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
			<?php if ($inc == ($cpz + 1)) { ?> 
			
				<table class="mt" style="font-size:1px; text-align: center ">
					<tr class="topbr"> 

						<th>Quantity : <?php echo $summary['quantity']; ?></th>
						<th> </th> 
						<th>Total <?php if($com != $cust){ echo 'I';} ?>GST : <?php echo $purchase[0]['tax']; ?></th>
						<th> </th>
						<th>G.Total : <?php echo $purchase[0]['total']; ?></th> 
					</tr> 
				</table>
			<?php } ?>
            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table class="mt">
                <tr  class="topbr">  
                    <td>BANK  Details</td> 

                    <td> Declaration
                    </td> 
                </tr> 
                <tr>  
                    <td>
                        BANK NAME : <?php echo $company['comset_bank']; ?> <br/>
                        A/C No:<?php echo $company['comset_account_no']; ?><br/>
                        IFSC CODE :<?php echo $company['comset_ifsccode']; ?><br/>
                    </td> 

                    <td>

                    </td> 
                </tr> 
            </table>        
			
            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">

                <tr> 
                    <td class="left"  colspan="8" style=" font-size:9px;  text-transform: capitalize; " > 
                        Rs: <?php echo $msd; ?>      
						<?php if($login_comid != 'quality' ){?>
                        <br/>
						<?php } ?>
                    </td>
                    <td colspan="4" style="font-size:10px; text-align: center " >

                        <br/>
                        For  <?php echo $company['name']; ?>    
						<?php if($login_comid != 'quality' ){?>
                        <br/>

                        <br/>
						<?php } ?>
                    </td>

                </tr>
                <tr> 
                    <td class="left"  colspan="4" style="font-size:8px; " >
                       
                    </td>
                    <td colspan="4" style="font-size:12px; text-align: right "> 
						<?php if($login_comid == 'quality' ){?>
						 <br/>
						<img   style="margin: 0px" width="80px" height="80px"  src="uploads/company/Quality.png" />  
						<?php } ?>

                    </td>
                    <td colspan="4" style="font-size:10px; text-align: center ">   
						<?php if($login_comid == 'quality' ){?>
						<img   style="margin: 0px" width="100px" height="100px"  src="uploads/company/qualitysignature.png" />  
						<?php } ?>
                        <br/>
                        Authorized Signature
                    </td>
                </tr>
            </table> 
            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**<br > <?php echo ($cpz+1).'/'.$inc;?></td>
                </tr>
            </table> 
        </div>
    </body>
</html>

