<?php
$is_discount = 0;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
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
                width: 100mm;
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
			.cls50{
				width:49%
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
                width: 60mm;
                text-align : Left;
            }
            #invoice-POS .Hours {
                width: 30mm;
                text-align : Right;
            }
			#invoice-POS .qty {
                width: 20mm;
                text-align : Right;
            }
            #invoice-POS .itemtext {
                font-size: .5em;
            }
            #invoice-POS #legalcopy {
                margin-top: 0mm;
            }
        </style>
		<?php if($company['logo'] !=''){ ?>
			<style>
				#invoice-POS #top .logo {
					height: 100px;
					width: 100%;
					background-attachment: fixed;
					background-position: center; 
					background: url("uploads/company/<?php echo $company['logo'] ?>")   no-repeat;
					background-size: 80%;
				}
			</style>
		<?php }?>
    </head>

    <body>


                <div style="margin-top:0px;padding-top:0px;" id="invoice-POS">

				<center style="margin-top:0px;padding:0px;margin-bottom :0px;ma:0px;" id="top">
				<div class="logo">
				</div>
                <div style="margin-top:0px;padding-top:0px;" class="info"> 
                 <p style="margin-top:0px;padding-top:0px;padding-bottom:0px;margin-bottom:0px;font-size: 0.65em;text-align:center;"><font style="font-size: 1.2em" ><?php echo $company['name'] ?></font><br /><?php echo $company['address'] ?><br /><?php echo $company['phone'] ?><br /><br /></p>
                </div>
				</center><!--End InvoiceTop-->

            <div style="margin:0px;padding:0px" id="mid">
                <div  class="info">
				<hr style="padding:0px;margin:3px;border-top: dotted 1px;" />
				<p style ="font-size:8px;padding:0px;margin:0px;" >Sales Agent : <?php echo $sales[0]['salesman_name'];?> <br />
						<?php echo ucfirst($sales[0]['cash_type']) ;?><br />
						<?php echo $sales[0]['invoice'] ;?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $sales[0]['createdat'] ;?><br />
				</p>
                </div>
            </div><!--End Invoice Mid-->
            <hr style="margin: 0px; padding: 0px" />
            <div id="bot">

                <div id="table">
                    <table style="margin: 0px; padding: 0px">
                        <tr style="margin: 0px; padding: 0px" class="tabletitle">
							<td class="" style="width:10px;"><h2>SN.</h2></td>
							<td class="item"><h2>ITEM</h2></td>
                            <td class="qty"><h2>QTY</h2></td>
                            <td class="Hours"><h2>RATE</h2></td>
                            <td class="Hours"><h2>VAT%</h2></td>
                            <td class="Hours"><h2>AMT</h2></td>
                        </tr>
						<tr style="border-bottom:1px solid;">
                                <td colspan="6" style="border-top:2px solid;">&nbsp;</td>
                            </tr>

                        <?php
                        $total = 0;
                        $totdis = 0;
                        $txamt = $gtoamt = 0;
                        $netamt = 0;
                        $i = $len;
                        $bftax = 0;
						$profit = 0;
						$qty = 0;
						$no = 0;
                        foreach ($sales_items as $item) {
							$profit = (float) $profit + (float) $item['MRP'] * (float) $item['quantity'] - (float) $item['mrp'] * (float) $item['quantity'];
                            $total = $total + $item['total'];
                            $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                            $totdis = $totdis + $discount;
                            $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                            $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                            $txamt = $txamt + $item['tax'];
                            $netamt = $netamt + ($item['total'] - $item['tax']);
							$qty = $qty + $item['quantity'] ;
                            $i = $i + 1;
							$no = $no + 1;
							$rate = $item['mrp'];
							$per = 0;
							if((float) $item['GST'] > 0 ){
								$per = (float) $per + (float) $item['GST'];
							}
							if((float) $sales[0]['saletype'] ==  'b2c' && (float) $sales[0]['cess'] > 0  ){
								if((float)$item['ces_amt'] > 0  ){
									$per = (float) $per + 1;
								}
							}
						if((float) $item['itm_ces_per'] > 0  ){
							//$per = (float) $per + (float) $item['itm_ces_per'];
						}
							if((float) $item['is_taxincluded'] > 0 ){
							if( (float) $per > 0 ){
								//$rate  = $rate  - (( (float) $rate * (float) $per)/100);
								$taxamt = (float) $rate - (((float) $rate * 100) / ((float) $per + 100));
								$rate = (float) $rate - (float) $taxamt;
							}
						}
                            ?>
                            <tr class="service">
								<td style="text-transform: capitalize;font-size: 30px;"> <?php echo $no; ?></td>
                                <td style="text-transform: capitalize;font-size: 30px;"> <?php echo $item['name']; ?></td>
                                <td style="text-align:right; font-size: 30px;"> <?php echo number_format($item['quantity'], 2); ?></td>
                                <td style="text-align:right; font-size: 30px;"><?php echo number_format($rate, 3); ?></td>

                                <td style="text-align:right; font-size: 30px;"><?php echo number_format($item['GST'], 0); ?></td>
                                <td style="text-align:right; font-size: 30px;"><?php echo number_format($item['total'], 2); ?></td>
                            </tr>
                        <?php }
                        ?> 
                           <tr style="border-bottom:1px solid;">
                                <td colspan="6" style="border-top:2px solid;">&nbsp;</td>
                            </tr>

                    </table>
					
					<div style="width:100%">
						<div class="" style="font-size:10x;width:25%;float:left">
							Item Dis
							<br />
							Items
							<br />
							Qty 	
							<br />
						</div>
						<div class="" style="font-size:10x;width:25%;float:left">
							: <?php echo $totdis;?>
							<br />
							: <?php echo $i;?>
							<br />
							: <?php echo $qty;?>
							<br />
						</div>
						<div class="" style="font-size:10x;width:30%;float:left">
							Sub Total
							<br />
							Vat Amount
							<br />
							Discount
							<br />
							
						</div>
						<div class="" style="font-size:10x;width:20%;float:left;text-align:right;">
							: <?php echo $sales[0]['total'] - $sales[0]['tax'] + $sales[0]['discount'] ;?>
							<br />
							: <?php echo  $sales[0]['tax']  ;?>
							<br />
							: <?php echo $sales[0]['discount'] ;?>
							<br />
							
						</div>
						
					</div>
            <hr style="margin: 0px; padding: 0px" />
			<div style="width:100%">
						<div class="" style="font-size:10x;width:20%;float:left">
							&nbsp;
						</div>
						<div class="" style="text-align:right;padding:0px;padding-top:3px;padding-bottom:3px;font-size:10x;width:80%;float:right">
							Net Amount: <?php echo  $sales[0]['total']  ;?>
							<br />
							
						</div>
					</div>
					 <hr style="margin: 0px; padding: 0px" />
		<!--	<div style="width:100%">
						<div class="cls50" style="font-size:10x;width:50%;float:left">
							&nbsp;
						</div>
						<div class="" style="text-align:right;padding:0px;padding-top:3px;padding-bottom:3px;font-size:10x;width:80%;float:right">
							Receieved:
							<br />
							Balance:
							<br />
							
						</div>
					</div>
					 <hr style="margin: 0px; padding: 0px" />-->
						<div style="width:100%;font-size:12x;text-align:center">
							THANK YOU VISIT AGAIN<br/>
							REFUND UPON APPROVAL<br/>
							FOR EXCHANGE WITHIN 15 DAYS
						</div>
                </div><!--End Table-->

                               <hr style="margin: 0px; padding: 0px;"/>
							 <p style="padding:0px;font-size:10px;text-align:center">  www.makkahhyper.com</p>
<i class="fa fa-facebook-official" aria-hidden="true"></i>


               
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->



    </body>

</html>

