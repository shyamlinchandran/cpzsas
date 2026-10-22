<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                font-family: sans-serif;
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
            <table style="padding: 3px; margin: 0px;">
                <tr>
                    <td>Invoice:  <?php echo $sales[0]['invoice'] ?></td>
                    <td style="text-align: center;font-size: 12px"></td>
                    <td class="center">Date :<?php echo $sales[0]['in_date'] ?></td>
                </tr>
            </table>
            <span style="text-align: center"> 
                <span style="text-align: center;font-size: 20px;"><?php echo $company['name'] ?> </span>
                <br/>
                <?php echo $company['address'] ?> 
                <br/>
            </span>.

            <table style="padding: 3px; margin: 0px;">
                <tr>
                    <td> </td>
                    <td>GSTIN :<?php echo $company['tin'] ?></td>
                    <td>GSTIN :<?php echo $sales[0]['tin'] ?></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>State :<?php echo $sales[0]['StateName'] ?></td>
                    <td>State :<?php echo $sales[0]['StateName'] ?></td>

                </tr>
                <tr>
                    <td> </td>
                    <td></td>
                    <td></td>

                </tr>
                <tr>
                    <td>Buyer Name : Cash</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Buyer Address:<?php echo $sales[0]['address_line1']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>Contact :<?php echo $sales[0]['phone']; ?></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>


            <hr style="border: solid 1px #222; "/>

            <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 30px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 40px;  text-align: center">HSN/SAC</th>
                    <th  class="center" style="width: 45px;  text-align: center">GST%</th>
                    <th  class="center" style="width: 50px;  text-align: center">Quantity</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 52px;  text-align: center">Rate</th>
                        <th class="center" style="width: 50px;  text-align: center">Unit</th>
                        <th class="center" style="width: 45px;  text-align: center">Discount</th>
                        <th class="center" style="width: 75px;  text-align: center">Total</th>
                    <?php } ?>
                    <?php if ($is_discount == 0) { ?>
                        <th class="center" style="width: 62px;  text-align: center">Rate</th>
                        <th class="center" style="width: 60px;  text-align: center">Unit</th>
                        <th class="center" style="width: 100px;  text-align: center">Total</th>
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
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 1); ?></td>
                        <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo round($discount, 2); ?></td> 
                        <?php } ?>
    <!--                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>     -->
    <!--                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>   -->
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 1); ?></td>
                    </tr>
                <?php }
                ?>

                <?php
                $len = $size - $i - 1;
                for ($i = 0; $i < $len; $i++) {
                    ?> 
                    <tr>
                        <td> </td>
                        <td> </td>
    <!--                        <td> </td>-->
    <!--                        <td> </td>-->
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                <?php } ?> 
            </table>
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">

                <tr>
                    <?php if ($is_discount == 0) { ?>
                        <th style=" width: 68%;">Total</th>
                        <th style=" width: 12%;"></th>
                        <th style=" width: 8%;"></th>
    <!--                        <th style=" width: 10%;"><?php echo round($txamt / 2, 2); ?></th>-->
    <!--                        <th style=" width: 8%;"><?php echo round($txamt / 2, 2); ?></th>-->
                        <th style=" width: 12%;"><?php echo $sales[0]['total']; ?></th>
                    <?php } ?>
                    <?php if ($is_discount == 1) { ?>

                        <th style=" width: 68%;">Total</th>
                        <th style=" width: 12%;"></th>
                        <th style=" width: 8%;"></th>
    <!--                        <th style=" width: 10%;"><?php echo round($txamt / 2, 2); ?></th>-->
    <!--                        <th style=" width: 8%;"><?php echo round($txamt / 2, 2); ?></th>-->
                        <th style=" width: 2%;"></th>
                        <th style=" width: 10%;"><?php echo round($bftax, 2); ?></th>
                    <?php } ?>
                </tr>
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <font size="12">Amount in Words : </font> <font size="15">Rs. <?php echo $msd; ?> </font>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  

            <table class="mt" style="  padding:0px; margin: 0px;">
                <tr class="topbr"> 
                    <td style="width:160px">Tax Rate</td>
                    <td style="width:100px">Taxable Value </td> 
                    <td style="width:65px">IGST</td> 
                    <td style="width:65px">CGST</td> 
                    <td style="width:80px">SGST</td>
                    <td style="width:95px">Total Taxable Value</td> 
                </tr>  
            </table> 
            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table class="mt" style="font-size:10px; text-align: center ">
                <?php foreach ($gst as $item) { ?> 
                    <tr class="topbr"> 
                        <td style="width:160px"><?php echo $item['gst']; ?></td>
                        <td style="width:100px"><?php echo $item['beforetax']; ?></td> 
                        <td style="width:65px"><?php echo $item['tax']; ?></td> 
                        <td style="width:65px"><?php echo $item['tax'] / 2; ?></td> 
                        <td style="width:80px"><?php echo $item['tax'] / 2; ?></td>
                        <td style="width:95px" style="text-align: right "><?php echo $item['tot']; ?></td>  
                    </tr> 
                <?php } ?> 
            </table>            <hr style="font-size: 13px; border: solid 1px #222; "/>  

            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                </tr>
            </table> 

            <!--            <hr style="border: solid 1px #222; "/>
                        <table style="padding:0px;  margin: 0px;  width:100%;">
                            <tr>
                                <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                            </tr>
                        </table> -->
        </div>
    </body>
</html>

