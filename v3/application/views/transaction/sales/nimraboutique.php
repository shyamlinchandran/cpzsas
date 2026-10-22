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
        </style>




    </head>

    <body style="margin-top:0px;padding-top:0px;">


        <div style="margin-top:0px;padding-top:0px;" id="invoice-POS">

            <!--<center style="padding:0px;margin-bottom :0px;ma:0px;" id="top">
            </center>End InvoiceTop-->


                 <p style="margin-top:0px;padding-top:0px;padding-bottom:0px;margin-bottom:0px;font-size: 0.65em;text-align:center;"><font style="font-size: 1.1em" ><?php echo $company['name'] ?></font><br /><?php echo $company['address'] ?><br /><?php echo $company['phone'] ?><br /><br /><b> Tax Invoice</b></p>
            <div style="margin-top:0px;padding-top:0px" id="mid">
                <div  style="margin:0px;padding:0px"  class="info">
                    <!--                    <h2>Contact Info</h2>-->

                    <p style="margin-top:0px;padding:0px;font-size: 0.65em;"><?= label('Invoice', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?>&nbsp;&nbsp;&nbsp;Date:<?php echo $sales[0]['in_date'] ?></p>

                    <p style="padding:0px;font-size: 0.65em; ">Name    : <?php if($sales[0]['cusname'] !=""){echo $sales[0]['cusname'];}else { echo 'Cash ';} ?><br ><?php echo $sales[0]['address_line1'] ?> <?php
                            if (isset($sales[0]['phone'])) {
                                echo '<br />Phone :' . $sales[0]['phone'];
                            }
                            ?>  </p>

                </div>
            </div><!--End Invoice Mid-->
            <hr style="margin: 0px; padding: 0px" />
            <div id="bot">

                <div id="table">
                    <table>
                        <tr style="padding :0px !important;" class="tabletitle">
                            <td style="margin-bottom :0px;padding-bottom :0px" class="item"><h2>Item Name</h2></td>
                            <td style="margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Qty</h2></td>
                            <td style="margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>MRP</h2></td>
                            <td style="margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Rate</h2></td>
                            <td style="margin-bottom :0px;padding-bottom :0px" class="Hours"><h2>Total</h2></td>
                        </tr>
						<tr>
							<td style="padding-top:0px !important" colspan="4"><hr /></td>
						</tr>
                        <?php
                        $total = 0;
                        $totdis = 0;
                        $txamt = $gtoamt = 0;
                        $netamt = 0;
                        $i = $len;
                        $bftax = 0;
						$profit = 0;
                        foreach ($sales_items as $item) {
							$profit = (float) $profit + (float) $item['MRP'] * (float) $item['quantity'] - (float) $item['mrp'] * (float) $item['quantity'];
                            $total = $total + $item['total'];
                            $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                            $totdis = $totdis + $discount;
                            $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                            $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                            $txamt = $txamt + $item['tax'];
                            $netamt = $netamt + ($item['total'] - $item['tax']);
                            $i = $i + 1;
                            ?>
                            <tr class="service">
                                <td style="text-transform: capitalize;font-size: 25px;"> <?php echo $item['name']; ?></td>
                                <td style="text-align:right; font-size: 25px;"> <?php echo number_format($item['quantity'], 2); ?></td>
                                <td style="text-align:right; font-size: 25px;"><?php echo number_format($item['MRP'], 2); ?></td>
                                <td style="text-align:right; font-size: 25px;"><?php echo number_format($item['mrp'], 2); ?></td>
                                <td style="text-align:right; font-size: 25px;"><?php echo number_format($item['total'] - $item['tax'], 2); ?></td>
                            </tr>
                        <?php }
                        ?> 
                            <tr style="border-bottom:1px solid;">
                                <td colspan="5" style="border-top:2px solid;">&nbsp;</td>
                            </tr>
							<?php if( (int) $sales[0]['tax'] > 0 || (int) $totdis > 0){ ?>
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Total</h2></td>
                            <td></td>
                            <td class="payment"><h2><?php echo number_format($bftax + $totdis, 2); ?></h2></td>
                        </tr>
						<?php } ?>
						<?php if( (int) $totdis > 0){ ?>
                        <tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Discount</h2></td>
                            <td></td>

                            <td class="payment"><h2><?php echo number_format($totdis, 2); ?></h2></td>
                        </tr>
						<?php } ?>
				<?php if( (int) $sales[0]['tax'] > 0){ ?>
						<tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>CGST </h2></td>
                            <td></td>
                            <td class="payment"><h2><?php echo number_format($sales[0]['tax'], 2); ?></h2></td>
                        </tr>
						<tr class="tabletitle">
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>SGST</h2></td>
                            <td></td>

                            <td class="payment"><h2><?php echo number_format($sales[0]['tax'], 2); ?></h2></td>
                        </tr>
					<?php }?>
					
                        <tr class="tabletitle">
                            <td style="font-size:20px;" colspan="2"><b> You  Saved Rs. <?php echo $profit;?></b></td>
                            <td class="Rate"><h2>Grand Total</h2></td>

                            <td colspan="2" class="payment"><h2><?php echo $sales[0]['total']; ?></h2></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                               <hr style="margin: 0px; padding: 0px;"/>
							 <p style="font-size:12px;text-align:center">  Thank you for visit and come again..</p>

                <div style="text-align: center; font-size: 8px">
                </div>
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->



    </body>

</html>

