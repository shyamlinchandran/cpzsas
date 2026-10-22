<?php
$is_discount = 0;
$is_bankac= 1;
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
                    <td >GST No:<?php echo $company['tin'] ?></td>
                    <td style="text-align: center;font-size: 12px">INVOICE-CASH/CREDIT</td>
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
                    <td style="width: 50%" rowspan="4">To ,  
                        <?php 
                         if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         }
                       
                        ?>
                        <br/>
                        <?php echo $sales[0]['address_line1'];?>
                        <br/>
                        Phone: <?php echo $sales[0]['phone'];?>
                    </td>
                    <td style="width: 50%">Invoice  <?php echo $sales[0]['invoice'] ?></td>
                </tr>
                <tr>

                    <td >State: <?php //echo $company['cst']  ?> </td> 
                </tr> 
                <tr>

                    <td>Date <?php echo $sales[0]['in_date'] ?></td>
                </tr>
                <tr>
                    
                    <td>State Code:  <?php //echo $company['statecode']                           ?>  </td> 
                </tr> 
                <tr>
                    <td style="text-align: left;">GST:<?php echo $sales[0]['tin'] ?>  </td> 
                    <td>Truck No: <?php // echo $sales[0]['trucknumber']                           ?> </td> 
                </tr> 
                <tr>
                    <td style="text-align: left;">State: <?php echo $sales[0]['cst'] ?>, State Code: <?php //echo $sales[0]['gst']                           ?>  
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
                    <th  class="center" style="width: 45px;  text-align: center">HSN</th>
                    <th  class="center" style="width: 35px;  text-align: center">GST</th>
                    <th  class="center" style="width: 35px;  text-align: center">Qty</th>
                    <th class="center" style="width: 42px;  text-align: center">Rate</th>
                    <th class="center" style="width: 45px;  text-align: center">Amount</th>
                    <th class="center" style="width: 45px;  text-align: center">CGST</th>
                    <th class="center" style="width: 45px;  text-align: center">SGST</th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 45px;  text-align: center">Discount</th>
                    <?php } ?>
<!--                    <th class="center" style="width: 60px;  text-align: center">Net Amt</th>
<th class="center" style="width: 45px;  text-align: center">Tax</th>-->
                    <th class="center" style="width: 75px;  text-align: center">Total</th>
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
                        <td class="center"> <?php echo round(($item['total'] - $item['tax'])/$item['quantity'], 2); ?></td>
                        <td class="center">  <?php echo round($item['total'] - $item['tax'], 2); ?></td>
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
                    </tr>
                <?php } ?> 
            </table>
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
                    <th style=" width: 50%;">Total</th>
                    <th style=" width: 12%;"></th>
                    <th style=" width: 8%;"><?php echo round($bftax, 2); ?></th>
                    <th style=" width: 10%;"><?php echo round($txamt / 2, 2); ?></th>
                    <th style=" width: 8%;"><?php echo round($txamt / 2, 2); ?></th>
                    <th style=" width: 12%;"><?php echo $sales[0]['total']; ?></th>

                </tr>
            </table>

            <hr style="font-size: 13px; border: solid 1px #222; "/>  
            <table class="mt" style="font-size:1px; text-align: center ">
                <tr class="topbr"> 

                    <th>Transporting : <?php echo $sales[0]['freight']; ?> </th> 
                    <th>Coolie: <?php echo $sales[0]['other']; ?> </th> 
                    <th>Total GST : <?php echo $sales[0]['tax']; ?></th>
                    <th>Round Off : <?php echo $sales[0]['roundoff']; ?> </th>
                    <th>G.Total : <?php echo $sales[0]['total']; ?></th> 
                </tr> 
            </table>
            <hr style="font-size: 13px; border: solid 1px #222; "/>
            <table style="padding:2px;width:40%">
		<tr  class="topbr">  
                    <td colspan=2 style="text-align:center">Bank Details</td> 

                </tr>
		<tr  class="topbr">  
                    <td>Bank Name</td> 
                    <td>: <?php echo $company['comset_bank']; ?>   </td>
                </tr>
		 
                <tr  class="topbr">  
                    <td>Account no.</td>
		    <td>: <?php echo $company['comset_account_no']; ?></td> 
                </tr>
	        <tr  class="topbr">  
                    <td>IFSC code</td> 
		    <td>: <?php echo $company['comset_ifsccode']; ?></td>
                </tr>
            </table>             
            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">

                <tr> 
                    <td class="left"  colspan="8" style=" font-size:9px;  text-transform: capitalize; " > 
                        Rs: <?php echo $msd; ?>                     
                        <br/>
                    </td>
                    <td colspan="4" style="font-size:10px; text-align: center " >

                        <br/>
                        For  <?php echo $company['name']; ?>    
                        <br/>

                        <br/>
                    </td>

                </tr>
                <tr> 
                    <td class="left"  colspan="6" style="font-size:8px; " >
                        <!--         <?php if ($sales[0]['stp'] == 'estimate') { ?>                                                                                  Purchase by You Before Acknowledging Receipt 
                        <?php } if ($sales[0]['stp'] == 'sales8b') { ?>                                                                                            Before Acknowledging Receipt
                        <?php } if ($sales[0]['stp'] == 'sales8') { ?>                                                                 
                        <?php } ?>-->
                    </td>
                    <td colspan="2" style="font-size:12px; text-align: right "> 

                    </td>
                    <td colspan="4" style="font-size:10px; text-align: center ">   
                        <br/>
                        Authorized Signature
                    </td>
                </tr>
            </table> 
            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                </tr>
            </table> 
        </div>
    </body>
</html>

