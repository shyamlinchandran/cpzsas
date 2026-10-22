<?php
$is_discount = 0;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
$com = substr($company['tin'], 0, 2);
$com =32;
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

}
?>
<!DOCTYPE html>
<html lang="en" >

    <head>
        <meta charset="UTF-8">
        <title>Bill</title>
        <style>
            #invoice-POS {
                /*                box-shadow: 0 0 1in -0.25in rgba(1, 1, 1, 0.2);*/
                padding: 1mm;
                margin: 0 auto;
                width: 120mm;
                background: #FFFFFF;
            }
            #invoice-POS ::selection {
                background: #f31544;
                color: #FFF;
            }
            #invoice-POS ::moz-selection {
                background: #f31544;
                color: #FFF;
            }
            #invoice-POS h1 {
                font-size: 1.5em;
                color: #222;
            }
            #invoice-POS h2 {
                font-size: .7em;
            }
            #invoice-POS h3 {
                font-size: 1.2em;
                font-weight: 300;
                line-height: 1em;
            }
            #invoice-POS p {
                font-size: .7em;
                color: #000000;
                line-height: 1.2em;
            }
            #invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
                /* Targets all id with 'col-' */
                border-bottom: 0px solid #EEE;
            }
            #invoice-POS #top {
                min-height: 100px;
            }
            #invoice-POS #mid {
                min-height: 80px;
            }
            #invoice-POS #bot {
                min-height: 50px;
            }
            #invoice-POS #top .logo {
                height: 100px;
                width: 100%;
                background-attachment: fixed;
                background-position: center; 
                background: url("uploads/company/logo.png")   no-repeat;
                background-size: 80%;
            }
            #invoice-POS .clientlogo {
                float: left;
                height: 60px;
                width: 60px;
                background: url(http://michaeltruong.ca/images/client.jpg) no-repeat;
                background-size: 60px 60px;
                border-radius: 50px;
            }
            #invoice-POS .info {
                display: block;
                margin-left: 0;
                margin-top : 0px;
            }
            #invoice-POS .title {
                float: right;
            }
            .payment{
                text-align:right;
            }
            #invoice-POS .title p {
                text-align: right;
            }
            #invoice-POS table {
                width: 100%;
                border-collapse: collapse;
            }
            #invoice-POS .tabletitle {
                font-size: .2 em;
                background: #FFFAFA;
            }
            #invoice-POS .service {
                border-bottom: 1px solid #EEE;
            }
            #invoice-POS .item {
                width: 45mm;
                text-align : Left;
            }
            #invoice-POS .Hours {
                width: 35mm;
                text-align : Right;
            }
            #invoice-POS .itemtext {
                font-size: .5em;
            }
            #invoice-POS #legalcopy {
                margin-top: 0mm;
            }
			.tha, .tda {
				border: 1px solid black;
				border-collapse: collapse;
			}
}
        </style>




    </head>

    <body style="margin-top:0px;padding-top:0px;">


        <div style="margin-top:0px;padding-top:0px;" id="invoice-POS">

            <!--<center style="padding:0px;margin-bottom :0px;ma:0px;" id="top">
            </center>End InvoiceTop-->


                 <p style="margin-top:0px;padding-top:0px;padding-bottom:0px;margin-bottom:0px;font-size: 0.65em;text-align:center;"><font style="font-size:2em" ><b><?php echo $company['name'] ?></b></font><br /> <b><?php echo $company['address'] ?><br /><?php echo $company['phone'] ?><br /><br /> </b><b><?php if($sales[0]['stype'] == 'sales'){echo 'Bill';}else {echo 'Estimate';}?></b></p>
            <div style="margin-top:0px;padding-top:0px" id="mid">
                <div  style="margin:0px;padding:0px"  class="info">
                    <!--                    <h2>Contact Info</h2>-->

                   <b>  <p style="font-weight:bold;margin-top:0px;padding:0px;font-size: 0.65em;"><?= label('Invoice', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?>&nbsp;&nbsp;&nbsp;Date:<?php echo $sales[0]['in_cdate'] ?></p>

                   <p style="font-weight:bold;padding:0px;font-size: 0.65em; ">To <br /> <?php if($sales[0]['cusname'] !=""){echo $sales[0]['cusname'];}else { echo 'Cash ';} ?><br ><?php echo $sales[0]['address_line1'] ?> <?php
                            if (isset($sales[0]['phone'])) {
                                echo '<br />Phone :' . $sales[0]['phone'];
                            }
                            ?>  </p></b>

                </div>
            </div><!--End Invoice Mid-->
            <hr style="margin: 0px; padding: 0px" />
            <div id="bot">

                <div id="table">
                    <table>
                        <tr style="padding :0px !important;" class="tabletitle">
                            <td style="font-size: 20px;margin-bottom :0px;padding-bottom :0px" class="item"><h2>Description</h2></td>
                            <td style="font-size: 20px;margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Qty</h2></td>
                           <td style="margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>MRP</h2></td>
                            <td style="font-size: 20px;margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Rate</h2></td>
                            <td style="font-size: 20px;margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Total</h2></td>
                        </tr>
						<tr>
							<td style="padding-top:0px !important" colspan="6"><hr /></td>
						</tr>
                        <?php
                        $total = 0;
                        $totdis = 0;
                        $txamt = $gtoamt = 0;
                        $netamt = 0;
                        $i = $len;
                        $bftax = 0;
						$profit = 0;
						$tdis_amt = 0 ;
						$bef = 0 ;
                        foreach ($sales_items as $item) {
							$profit = (float) $profit + (float) $item['imrp'] * (float) $item['quantity'] - (float) $item['mrp'] * (float) $item['quantity'];
                            $total = $total + $item['total'];
                            $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                            $totdis = $totdis + $discount;
                            $bftax = $bftax + round($item['total'] - $item['tax'] - $item['dis_amt'] , 2);
                            $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
							$tdis_amt = (float) $tdis_amt + $item['dis_amt'];
                            $txamt = $txamt + $item['tax'];
                            $netamt = $netamt + ($item['total'] - $item['tax']);
                            $i = $i + 1;
							$bef = (float) $bef + $item['total'] - $item['tax'] -  $item['dis_amt'] ;
                            ?>
                            <tr class="service">
                                <td style="font-weight:bold;text-transform: capitalize;font-size: 30px;"> <?php echo $item['name']; ?></td>
                                <td style="font-weight:bold;text-align:right; font-size: 30px;"> <?php echo number_format($item['quantity'], 2); ?></td>
                               <td style="font-weight:bold;text-align:right; font-size: 30px;"><?php echo number_format($item['imrp'], 2); ?></td>
                                <td style="font-weight:bold;text-align:right; font-size: 30px;"><?php echo number_format(($item['total'] - $item['tax'] -  $item['dis_amt']) / $item['quantity'] , 2); ?></td>
                                <td style="font-weight:bold;text-align:right; font-size: 30px;"><?php echo number_format($item['total'] - $item['tax'] -  $item['dis_amt'] , 2); ?></td>
                            </tr>
                        <?php }
                        ?> 
                            <tr style="border-bottom:1px solid;">
                                <td colspan="6" style="border-top:2px solid;">&nbsp;</td>
                            </tr>
							<?php if( (int) $sales[0]['tax'] > 0 || (int) $totdis > 0){ ?>
                       
						<?php } ?>
						<?php if( (int) $totdis > 0){ ?>
						 <tr class="tabletitle">
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Amount</h2></td>
                            <td colspan="3" class="payment"><h2 style = "font-size:30px;"><?php echo number_format($bef , 2); ?></h2></td>
                        </tr>
                        <tr class="tabletitle">
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Item 	Discount</h2></td>

                            <td colspan="3" class="payment"><h2 style = "font-size:30px;"><?php echo number_format($tdis_amt, 2); ?></h2></td>
                        </tr>
						<?php } ?>
						<tr class="tabletitle">
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Before Tax</h2></td>

                            <td colspan="3" class="payment"><h2 style = "font-size:30px;"><?php echo number_format($bef + $tdis_amt, 2); ?></h2></td>
                        </tr>
				<?php if( (int) $sales[0]['tax'] > 0){ ?>
						<tr class="tabletitle">
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >CGST</h2></td>
                            <td colspan="3"  class="payment"><h2 style = "font-size:30px;"><?php echo number_format($sales[0]['tax']/2, 2); ?></h2></td>
                        </tr>
						<tr class="tabletitle">
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >SGST</h2></td>
                            <td colspan="3" class="payment"><h2 style = "font-size:30px;"><?php echo number_format($sales[0]['tax']/2, 2); ?></h2></td>
                        </tr>
					<?php }?>
						
						<?php if( (int) $sales[0]['discount'] > 0){ ?>
						<tr class="tabletitle">
                           <!-- <td style="font-size:20px;" colspan="2"><b> You  Saved Rs. <?php echo $profit;?></b></td>-->
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Discount</h2></td>

                            <td colspan="3" class="payment"><h2 style = "font-size:32px;" ><?php echo $sales[0]['discount']; ?></h2></td>
                        </tr>
						<?php }?>
						
                        <tr class="tabletitle">
                           <!-- <td style="font-size:20px;" colspan="2"><b> You  Saved Rs. <?php echo $profit;?></b></td>-->
                            <td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Grand Total</h2></td>

                            <td colspan="3" class="payment"><h2 style = "font-size:32px;" ><?php echo $sales[0]['total']; ?></h2></td>
                        </tr>
						
						<?php if( (int) $sales[0]['adjustment_amount'] > 0){ ?>
							<tr class="tabletitle">
							<!-- <td style="font-size:20px;" colspan="2"><b> You  Saved Rs. <?php echo $profit;?></b></td>-->
								<td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Exchange Amount</h2></td>

								<td colspan="3" class="payment"><h2 style = "font-size:32px;" ><?php echo $sales[0]['adjustment_amount']; ?></h2></td>
							</tr>
							<tr class="tabletitle">
							<!-- <td style="font-size:20px;" colspan="2"><b> You  Saved Rs. <?php echo $profit;?></b></td>-->
								<td colspan="3"  class="Rate"><h2 style = "font-size:30px;" >Amount Payable</h2></td>

								<td colspan="3" class="payment"><h2 style = "font-size:32px;" ><?php echo (float) $sales[0]['total'] - (float) $sales[0]['adjustment_amount']  ; ?></h2></td>
							</tr>
						<?php }?>
						

                    </table>
			<table class="lt" style="font-size:12px !important;padding: 2px;  margin: 0px; width: 100%;border:1px solid black;">
				<tr style="padding :0px !important;" class="tabletitle">
                    <td class ="tha" style="text-align:center;width:25%;font-size: 10px;margin-bottom :0px;padding-bottom :0px" >Hsncode</td>
                    <td class ="tha" style="text-align:center;width:25%;font-size: 10px;margin-bottom :0px;padding-bottom :0px" >SGST</td>
                    <td class ="tha" style="text-align:center;width:25%;font-size: 10px;margin-bottom :0px;padding-bottom :0px" >CGST</td>
                    <td class ="tha" style="text-align:center;width:25%;font-size: 10px;margin-bottom :0px;padding-bottom :0px" >Total tax</td>
			   </tr>
				
				<?php $tot_tax= 0;$hsn_taxable =0 ;$hsn_sgst =0;$hsn_tax =0; foreach($hsndetails as $item){
					$hsn_taxable = (float) $hsn_taxable + (float) $item['taxable'];
					$hsn_sgst = (float) $hsn_sgst + (float) $item['cgst'];
					$hsn_tax = (float) $hsn_tax + (float) $item['tax'];
					$tot_tax = (float) $tot_tax + (float) $item['tax'];
 					?>
					<tr style="padding :0px !important;" class="tabletitle">
						<td class ="tha" style="height:25px;width:25%;font-size: 9px;margin-bottom :0px;padding-bottom :0px" ><?php echo $item['hsncode'];?></td>
						<td class ="tha" style="text-align:center;width:25%;font-size: 9px;margin-bottom :0px;padding-bottom :0px" ><?php echo round($item['cgst'],2);?> <br /> (@<?php echo $item['GST'];?>%)</td>
						<td class ="tha" style="text-align:center;width:25%;font-size: 9px;margin-bottom :0px;padding-bottom :0px" ><?php echo round($item['cgst'],2);?><br />(@<?php echo $item['GST'];?>%)</td>
						<td class ="tha" style="text-align:right;width:25%;font-size: 9px;margin-bottom :0px;padding-bottom :0px" ><?php echo $item['tax'];?></td>
					</tr>
				<?php }?>
				
			</table>
                </div><!--End Table-->
				<hr style="margin: 0px; padding: 0px;"/>
				<p style="font-size:11px;text-align:left;padding:0px;margin-top:30px;margin:2px;"> <b><br />  You  Saved Rs. <?php echo $profit;?></b><hr style="margin: 0px; padding: 0px;"/>
				
				<p style="font-size:11px;text-align:left;padding:0px;margin-top:30px;margin:2px;"> <b><br /> Payment Details</b><hr style="margin: 0px; padding: 0px;"/>
					<br />
					<?php if($sales[0]['cash_type'] == 'Cash'){?>
						<font  style="font-size:11px;"><b>CASH   : <?php echo $sales[0]['total'];?></b></font>
					<?php } ?>
					<?php if($sales[0]['cash_type'] == 'Bank'){?>
						<font  style="font-size:11px;"><b>BANK (<?php echo ucfirst($sales[0]['bank_pay_method']);?>)  : <?php echo $sales[0]['total'];?></b></font>
					<?php } ?>
					<?php if($sales[0]['cash_type'] == 'COB'){?>
						<font  style="font-size:11px;"><b>BANK (<?php echo ucfirst($sales[0]['bank_pay_method']);?>)  : <?php echo $sales[0]['bank_amount'];?></b>
						<b>	<br />CASH   : <?php echo $sales[0]['cash_amount'];?></b>
						</font>
					<?php } ?>
				</p>
				<p style="font-size:10px;text-align:left;padding:0px;margin-top:30px;margin:1px;"><br /><br /> <b>Outstanding  : <?php echo $sales[0]['gtot']; ?><hr style="display:none;margin: 0px; padding: 0px;"/></b>
				</p>
				
				<p style="font-size:12px;text-align:center">  Thank you for visit and come again..</p>

                <div style="text-align: center; font-size: 8px">
                </div>
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->



    </body>

</html>

