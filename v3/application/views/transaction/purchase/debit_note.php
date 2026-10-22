<?php
$is_discount = 1;
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
            <p style="text-align: center;"><b>FORM60 <br /><u>DEBIT NOTE<br />(SEE RULE 48)</u></b></p>
            <hr>
            <p style="text-align: center;"><b><?php echo $company['name'] ?><br /><?php echo $company['address'] ?> <br /><?php echo $company['tin'] ?></b>  </p>
            <table style="padding: 0px;  margin: 0px; width: 100% ">
                <tr>
                    <td style="width:60%"></td>
                    <td style="width:53%;text-align: left;font-size: 12px;font-weight: bold;">Invoice: <?php echo $purchase[0]['invoice'] ?></td>
                    <td style="width:10%;text-align: right;"></td>
                </tr>
                <tr>
                    <td style="width:60%"></td>
                    <td style="width:30%;text-align: left;font-size: 12px;font-weight: bold;">Date: <?php echo $purchase[0]['date'] ?></td>
                    <td style="width:10%;text-align: right;"></td>
                </tr>
            </table>
            <p style="text-align: left;padding-left: 10px;"><b><?php echo $purchase[0]['name'] ?><br /><?php echo $purchase[0]['address_line1'] ?> <br /><?php echo $purchase[0]['tin'] ?></b>  </p>
            <hr style="border: solid 1px #222; "/>
            <table style="width:100%;  padding:0px; margin: 0px; background-image: url('<?php echo base_url() . 'assets/images/cancelled.png' ?>')" >
                <tr>
                    <th style=" width:350px; text-align: center">Particulars</th>
                    <th style="width:200px;  text-align: center">Amount</th> 
                </tr>
            </table>  
            <hr style="border: solid 1px #222; "/>
            <table  cellpadding="10" style="width:100%;  line-height:20px;">

                <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: right;"> Taxable Sales Value as per invoice<b> <?php echo $order_details[0]['invoice'] ?> </b><br /> on date <b><?php echo $order_details[0]['date'] ?></b> </td>
                    <td style="width: 200px; text-align: center;"> <?php echo round($order_details[0]['total']- $order_details[0]['tax'],2) ?> </td> 
                </tr>
                <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: right;">Reverted Taxable  Value   </td>
                    <td style="width: 200px; text-align: center;"> <?php echo round($purchase[0]['total']-$purchase[0]['tax'],2); ?> </td> 
                </tr>
                <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: right;">Diffrence  </td>
                    <td style="width: 200px; text-align: center;"> <?php $amount_total =round($order_details[0]['total']- $order_details[0]['tax'],2); $return=round($purchase[0]['total']-$purchase[0]['tax'],2); echo round($amount_total-$return,2);  ?> </td> 
                </tr>
                <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: right;">Tax </td>
                    <td style="width: 200px; text-align: center;">  <?php echo $purchase[0]['tax']; ?> </td> 
                </tr>
                <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: left;">Reason :</td>
                    <td style="width: 200px; text-align: center;">  </td> 
                </tr>
                 <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: left;"></td>
                    <td style="width: 200px; text-align: center;">  </td> 
                </tr>
                 <tr>
                    <td style="width: 350px; border-right: solid 1px #222;  text-align: right;">Total</td>
                    <td style="width: 200px; text-align: center;"></td> 
                </tr>
            </table>  

            <hr style="border: solid 1px #222; "/>
            <table  cellpadding="1" style="padding:0px; margin: 0px;  width:100%; line-height:50px;" >

                <tr> 
                    <td class="left"  colspan="8" style=" font-size:10px; border-bottom: solid 1px #222;  text-transform: capitalize; " > 
                        Rs:  
                    </td>
                    <td colspan="4" style="font-size:13px; border-bottom: solid 1px #222; text-align: center " >Total <?php echo $purchase[0]['total']; ?>   </td>
                </tr >  
                <tr> <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>

                </tr>
                <tr> 
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"   colspan="4" style="font-size:12px; " >
<!--                        Office Manager-->
                    </td>
                    <td class="left"  colspan="4" style="font-size:12px; " >
                        Signature
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>

