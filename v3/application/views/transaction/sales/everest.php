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
                font-size: 2em;
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
                background: url("uploads/company/<?php echo $company['logo'] ?>")   no-repeat;
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
                 font-size: 1em;
            }
             .rate{
                text-align:right;
                 font-size: 1.3em;
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
                width: 40mm;
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
                margin-top: 2mm;
            }
        </style>




    </head>

    <body>


        <div id="invoice-POS">

           <center id="top">
                <!-- <div class="logo"></div> -->
                <div class="info"> 
                    <h2 style="text-align:center;"><?php echo $company['name'] ?></h2>
                </div> 
            </center> 

            <div id="mid">
                <div  class="info">
                    <!--                    <h2>Contact Info</h2>-->

                    <h2>Invoice:#<?php echo $sales[0]['invoice'] ?><br>Date:<?php echo $sales[0]['createdate'] ?><br>User : <?= $sales[0]['user_name'] ?></h2>

                    <p style="font-size: 0.7em;font-weight:bold; ">Name    : <b><?php echo $sales[0]['cusname'] ?><br /> Address : <?php echo $sales[0]['address_line1'] ?> <?php
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
                        <tr class="tabletitle">
                            <td class="item"><h2>Item Name</h2></td>
                            <td class="Hours"><h2>Qty</h2></td>
                            <td class="Hours"><h2>Price</h2></td>
                            <td class="Hours"><h2>Total</h2></td>
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
                            $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                            $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                            $txamt = $txamt + $item['tax'];
                            $netamt = $netamt + ($item['total'] - $item['tax']);
                            $i = $i + 1;
                            ?>
                            <tr class="service">
                                <td style="text-transform: capitalize;font-size: 30px;"> <?php echo $item['name']; ?></td>
                                <td style="text-align:right; font-size: 30px;"> <?php echo number_format($item['quantity'], 2); ?></td>
                                <td style="text-align:right; font-size: 30px;"><?php echo number_format($item['mrp'], 2); ?></td>
                                <td style="text-align:right; font-size: 30px;"><?php echo number_format($item['total'] - $item['tax'], 2); ?></td>
                            </tr>
                        <?php }
                        ?> 
                            <tr style="border-bottom:1px solid; font-size: 30px !important;">
                                <td colspan="4" style="border-top:2px solid;">&nbsp;</td>
                            </tr>
                        <tr >
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Payable</h2></td>
                            <td class="payment"><h2><?php echo number_format($bftax + $totdis, 2); ?></h2></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Discount</h2></td>
                            <td class="payment"><h2><?php echo number_format($totdis, 2); ?></h2></td>
                        </tr>
                        <!-- <tr>
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Before Tax </h2></td>
                            <td class="payment"><h2><?php echo number_format($bftax, 2); ?></h2></td>
                        </tr>
                        <tr >
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Tax</h2></td>
                            <td class="payment"><h2><?php echo number_format($txamt, 2); ?></h2></td>
                        </tr> -->

                        <tr >
                            <td></td>
                            <td></td>
                            <td class="Rate"><h2>Total</h2></td>
                            <td class="payment"><h2><?php echo $sales[0]['total']; ?></h2></td>
                        </tr>

                    </table>
                </div><!--End Table-->

                <!-- <div id="legalcopy">
                    <p class="legal"><strong><?php echo $settings[0]['terms_condition']; ?><br/><?php echo $sales[0]['terms_condition']; ?></strong>  
                    </p>
                </div> -->
                <!-- <div style="text-align: center;">
                    <barcode style="width: 100%;" code="<?php echo $sales[0]['invoice']; ?>" size="1.5" type="C128B" height="1" text="1" />
                    <?php echo $sales[0]['invoice']; ?>
                </div> -->
                <hr style="margin: 0px; padding: 0px;"/>
                <!-- <div style="text-align: center; font-size: 8px">
                    Powered by www.fazintl.com
                </div> -->
            </div><!--End InvoiceBot-->
        </div><!--End Invoice-->



    </body>

</html>

