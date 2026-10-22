<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '175px'; //if discont is 0
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
            .topbr td{
                border:   0px solid  #333  ; 
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
            <hr class="hidden"  style="font-size: 8px; border: solid 0px #FFFFFF; "/>  
            <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 25px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 60px;  text-align: center">Place Stored</th>
                    <th  class="center" style="width: 40px;  text-align: center">No.Of.Packages</th>
                    <th  class="center" style="width: 40px;  text-align: center">Quantity</th>
                    <th class="center" style="width: 50px;  text-align: center">Rate</th>
                    <td colspan="4" class="center" style="width: 177px;  text-align: center"> Value<br />Rs<spa style="float:right;">&nbsp;</spa></td>

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
                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>     
                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>  
                        <td class="center"> <?php echo round($discount, 2); ?></td> 
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
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
            <table class="mt" style="width:100%;  padding:3px; margin: 0px;">
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Total value of stock as declared above</th>
                    <th style="width:60px;text-align: left;"></th>
                    <th style="width:307px;text-align: left;"><ul><input type="checkbox" name="vehicle1" value="Bike"> Basis Of valuation Imported Raw Materials(valued at landed cost/market value whichever lower)</ul> </th>
                </tr>
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">value of stock received on credit/unpaid stock</th>
                    <th style="width:60px;text-align: left;"></th>
                    <th style="width:307px;text-align: left;"><ul><input type="checkbox" name="vehicle1" value="Bike"> Indigeneous goods (purchasr/market value whichever is lower)</ul></th>
                </tr>
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">value of stock older than 90 days and hence not ranking for Drawing Power</th>
                    <th style="width:60px"></th>
                    <th style="width:307px;text-align: left;"> <ul><input type="checkbox" name="vehicle1" value="Bike"> Finished Goods (at cost or selling price less profit)</ul></th>
                </tr>
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Total Sales During The Month</th>
                    <th style="width:60px"></th>
                    <th style="width:307px;text-align: left;"><ul><input type="checkbox" name="vehicle1" value="Bike"> Goods in process(at actual cost basis)</ul></th>
                </tr>
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Total Purchase During The Month</th>
                    <th style="width:60px"></th>
                    <th style="width:307px;text-align: left;"></th>
                </tr>

            </table>
            <hr style="font-size: 10px; border: solid 1px #FFFFFF; "/>  

            We declare that all the goods noted on the reverse and pledged/hypothecated to you either our own property or that we have such interest therein as entitles us to pledge/hypothecate them with the Bank to the full extent of the Bank's advances to us against them and that they are not subject to any lien claim or charge of anu sort
            <p style="text-align: right;">Signature</p>
            <table class="mt" style="width:100%;  padding:3px; margin: 0px;">
                <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Date Of Receipt</th>
                    <th style="width:60px;text-align: left;"></th>
                    <th style="width:307px;text-align: left;">I confirm That calculations have benn checked and found correct .Insurance Cover has been Taken fully </th>
                </tr>
                  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Toatal Value of Stock</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>
                  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Less Value Of Stock received on credit/unpaid stock</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>
                  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Less Value Of Stock Older than 90 days  and hence not ranking for Drawing Power</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Date Of Receipt</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Net Value Of Stock ranking for Drawing Power</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Less Margin@_______________%</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Net Value/Drawing Limit</th>
                    <th style="width:60px;text-align: left;"></th>
<!--                    <th style="width:307px;text-align: left;"> </th>-->
                </tr>  <tr class="topbr" > 
                    <th style="width:200px;text-align: left;">Outstanding in the Account</th>
                    <th style="width:60px;text-align: left;"></th>
                    <th style="width:307px;text-align: left;">Authorised Signatory </th>
                </tr>

            </table>
            
        </div>
    </body>
</html>

