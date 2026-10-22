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
            <br/>

            <table>
                <tr>
                    <td> </td>
                    <td style="text-align: center;"><?php echo $company['phone'] ?> </td>
                    <td><br/>Orginal Copy For Customer</td>
                </tr>
                <tr>
                    <td> </td>
                    <td style="text-align: center;"><?php echo $company['email'] ?> </td>
                    <td><br/></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>GSTIN :<?php echo $company['tin'] ?></td>
                    <td>GSTIN :<?php echo $sales[0]['tin'] ?></td>
                </tr>
                <tr>
                    <td> </td>
                    <td>State :<?php echo $sales[0]['cst'] ?></td>
                    <td>Land Ph :</td>

                </tr>
                 <tr>
                    <td> </td>
                    <td></td>
                    <td>Mobile:</td>

                </tr>
                 <tr>
                    <td>Party : Cash</td>
                    <td></td>
                    <td></td>

                </tr>

            </table>
           

            <hr style="border: solid 1px #222; "/>
          
          <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 45px;  text-align: center">HSN/SAC</th>
                    <th  class="center" style="width: 35px;  text-align: center">GST%</th>
                    <th  class="center" style="width: 35px;  text-align: center">Qty</th>
                    <th class="center" style="width: 42px;  text-align: center">Rate</th>
                    <th class="center" style="width: 45px;  text-align: center">Taxable Value</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 35px;  text-align: center">Dis</th>
                        <th class="center" style="width: 40px;  text-align: center">CGST</th>
                        <th class="center" style="width: 40px;  text-align: center">SGST</th>
                        <th class="center" style="width: 50px;  text-align: center">Total</th>
                    <?php } ?>
                    <?php if ($is_discount == 0) { ?>
                        <th class="center" style="width: 45px;  text-align: center">CGST</th>
                        <th class="center" style="width: 45px;  text-align: center">SGST</th>
                        <th class="center" style="width: 75px;  text-align: center">Total</th>
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
                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>     
                        <td class="center"> <?php echo round($item['tax'] / 2, 2); ?>  </td>   
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 1); ?></td>   
    <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
                        <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
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
                        <td> </td>
                    </tr>
                <?php } ?> 
            </table>
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
                    <th style=" width: 50%;">Total</th>
                    <th style=" width: 12%;"></th>
                    <th style=" width: 10%;"><?php echo round($bftax, 2); ?></th>
                    <th style=" width: 6%;"></th>
                    <th style=" width: 6%;"><?php echo round($txamt / 2, 2); ?></th>
                    <th style=" width: 6%;"><?php echo round($txamt / 2, 2); ?></th>
                    <th style=" width: 10%;"><?php echo $sales[0]['total']; ?></th>

                </tr>
            </table>

            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td>Total Invoice Amount in Words : </td>
                    <td></td>
                </tr>
                <tr>
                    <td> Rs: <?php echo $msd; ?></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td><u>Declaration</u> <br/>We Declare That This Invoice Shows Actual Price Of The Goods Described And That All Particulars Are True&Good</td>
                    <td  style="font-size:12px; text-align: center " >
                        For  <?php echo $company['name']; ?>    
                        <br/>

                        <br/>
                    </td>         
                </tr>
                <tr>
                    <td></td>
                    <td  style="text-align: center " >
                        Authorised Signature    
                        <br/>

                        <br/>
                    </td>                </tr>
            </table>
            <!--            <hr style="font-size: 13px; border: solid 1px #222; "/>
                        <table class="mt">
                            <tr  class="topbr">  
                                <td>BANK  Details</td> 
            
                                <td> Declaration
                                </td> 
                            </tr> 
                            <tr>  
                                <td>
                                    
                                    BANK NAME : Central Banck Of INdia <br/>
                                    A/C No:123456789012345678<br/>
                                    IFSC CODE :12345678901<br/>
                                    BRANCH :123456789012345678
                                </td> 
            
                                <td>
            
                                </td> 
                            </tr> 
                        </table>             -->

            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                </tr>
            </table> 
        </div>
    </body>
</html>

