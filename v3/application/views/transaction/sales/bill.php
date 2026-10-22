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
            <h2 style="text-align: center;">STATEMENT OF STOCK POSITION </h2>
            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="padding: 3px;  margin: 0px; width: 100%;">
                <tr>
                    <td style="width:50%;">From:</td>
                    <td style="width:50%;">To: UNION BANK OF INDIA</td>
                </tr>
                <tr>
                    <td style="width:50%;"></td>
                    <td style="width:50%;"></td>
                </tr>
            </table>
            <hr style="border: solid 1px #222; "/>
            <table class="mt" style="padding: 4px;  margin: 0px; width: 100%;">
                <tr>
                    <td style="width:100%;text-align: left;font-size: 12px;" >We give here below particulars of goods held in your name on your Account as on Date:.................(If there are more than one godown, details are to be given godownwise with the address of the godown) </td>
                </tr>

            </table>
            <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 25px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 60px;  text-align: center">Place Stored</th>
                    <th  class="center" style="width: 40px;  text-align: center">No.Of.Packages</th>
                    <th  class="center" style="width: 40px;  text-align: center">Quantity</th>
                    <th class="center" style="width: 50px;  text-align: center">Rate</th>
                    <td colspan="4" class="center" style="width: 177px;  text-align: center"> Value<br />Rs<spa style="float:right;">&nbsp;</spa></td>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
<!--                    <td class="center" style="width: 40px; border-left: none; text-align: center"></td>
                    <td class="center" style="width: 47px;  text-align: center"></td>
                    <td class="center" style="width: 40px;  text-align: center"></td>-->

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
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
                    <th style=" width: 50%;">Total</th>
                    <th style=" width: 5%;"></th>
                    <th style=" width: 5%;"></th>
                    <th style=" width: 5%;"></th>
                    <th style=" width: 5%;"></th>
                    <th style=" text-align: center;width: 30%;"><?php echo $sales[0]['total']; ?></th>

                </tr>
            </table>

 
        
          
        </div>
    </body>
</html>

