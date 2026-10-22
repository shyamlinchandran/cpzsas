<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '215px'; //if discont is 0
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
$user = '';
$language = $this->language;
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
                font-size: 12px;
                font-family: sans-serif;
                text-align: center;
                background-color: #ddd;
                color: #000
            }
            tr td {
                font-size: 12px;
            }
            .center{
                text-align: right;
            }
            .spec th{
                font-weight: bold;
                font-size:12px;
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

                border: 1px solid #ddd
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                border: 1px solid #ddd;
                padding-right: 1px !important;
            } 
            .maintable tr:nth-child(odd) {background: #eee}
            .mt,.mt  td  {
                border-right:  1px solid #ddd;
                padding-right: 2px !important;
                padding-left:  2px !important;
                border-collapse: collapse;
            } 

            .topbr th{
                border:   1px solid #ddd;
            }
            .mt th{
                border-top:    1px solid #ddd;
                font-size:12px;
                height: 12px;
            }
            .valtb td {
                font-size: 14px;
                font-weight: bold;
            }
            .right{
                text-align: right;
                padding-right: 30px;
            }
            .cls33{
                width:30%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
            .cls34{
                width:30%;
                /*                background-color: #aaa;  */
                float: right;
                font-size: 13px;
                font-family: sans-serif;


            }
            .cls20{
                width:38%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;
            }
            .cls50{
                width:50%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;
            }
            <?php if ($language == 'ac') { ?>
                .txtright {
                    text-align: right;
                }
                .txtleft {
                    text-align: left;
                }
            <?php } else if ($language != 'ac') { ?>
                .txtright {
                    text-align: left;
                }
                .txtleft {
                    text-align: left;
                }
            <?php } ?> 
            .txtcenter {
                text-align: right;
            }
            .cls33 span{
                width: 100%;
                text-align: center;
                background-color: #aaa;
            }
            body{
                border-color :#000;
                border :solid;
            }
            .hedrnd{
                background-color: #fff;
                border-radius: 10px; 
                height: 140px; 
            }

            .hedrnd p{
                padding-left: 10px;
            }
            .mainhead{ 
                text-align:center;
                font-size:18px; 
                text-transform: uppercase;
                font-weight: bolder; 
                color: #000;
                text-decoration: underline;
                vertical-align: top;
            }
            .cls33 h2{
                padding-left: 10px;
                padding-top: 10px;
            }
            .cls50 h3{
                padding-left:  10px;
            }
            .cls50 p{
                padding: 0px;
                margin: 0px;
            }

        </style>
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">

        <div style="width:100%;padding: 0px; margin: 0px; height: 70px;">
            <div class="cls33 txtleft hedrnd" style="text-align: left;">
                <p><br/></p>
                <b>Invoice:<?php echo $sales[0]['invoice'] ?></b>
            </div>
            <div class="cls20 txtleft hedrnd" style="text-align: center;">
                <h2><?php echo $company['name'] ?> </h2>
                <p><?php echo $company['address'] ?>
                    <br/>
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Tax ID', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  
            </div>
            <div class="cls34" style="text-align: right;">
                <p><br/></p>
                <b>Date:<?php echo $sales[0]['invoice_date'] ?></b>
            </div>
        </div>
        <div style="width:100%;padding:0px; margin: 0px; height: 40px;">
            <?php
            $al = 'left';
            $dir = 'right';
            $ms = "";
            $ar = '';
            if ($language == 'ac') {
                $al = 'right';
                $dir = 'left';
                $ms = "rtl";
                $ar = 'right';
            }
            ?>
            <div style="width:100%;padding: 0px; margin: 0px;">
                <div style="width:60%;padding: 0px;border: 0px solid; margin: 0px; height: 80px;float: left">
                    Party :<?php echo $sales[0]['cusname'] ?>,<br/> Address : <p style="padding: 0px;margin: 0px;"><?php echo $sales[0]['address_line1'] ?></p>
                    <p style="padding: 0px;margin: 0px;"><?php
                        if (isset($sales[0]['phone'])) {
                            echo 'Phone :' . $sales[0]['phone'];
                        }
                        ?>
                    </p>  
                    <p style="padding: 0px;margin: 0px;"><?php
                        if (isset($sales[0]['tin'])) {
                            echo 'Vat# :' . $sales[0]['tin'];
                        }
                        ?>
                    </p>
                </div>
            </div>
        </div>
        <p style="text-align:center">Bill Of Supply</p>
        <div style="padding: 0px; margin: 0px;">  
            <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label('Description Of Goods', $this, $user) ?></th>
                    <th  class="center" style="width: 45px;  text-align: center"><?= label('HSN/Sac', $this, $user) ?></th>
                    <th  class="center" style="width: 35px;  text-align: center"><?= label('GST%', $this, $user) ?></th>
                    <th class="center" style="width: 42px;  text-align: center"><?= label('Qty', $this, $user) ?></th>

<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                    <?php if ($is_discount == 1) { ?>
                        <th class="center" style="width: 35px;  text-align: center"><?= label('Rate', $this, $user) ?></th>
                        <th class="center" style="width: 40px;  text-align: center"><?= label('Discount', $this, $user) ?></th> 
                        <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                        <th class="center" style="width: 40px;  text-align: center"><?= label('Cess', $this, $user) ?></th> 
                        <th class="center" style="width: 50px;  text-align: center"><?= label('Total Amount', $this, $user) ?></th>
                    <?php } ?>
                    <?php if ($is_discount == 0) { ?>
                        <th class="center" style="width: 35px;  text-align: center"><?= label('Rate', $this, $user) ?></th>
                        <th class="center" style="width: 40px;  text-align: center"><?= label('Discount', $this, $user) ?></th> 
                        <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                        <th class="center" style="width: 40px;  text-align: center"><?= label('Cess', $this, $user) ?></th> 
                        <th class="center" style="width: 50px;  text-align: center"><?= label('Total Amount', $this, $user) ?></th>
                    <?php } ?>
<!--                    <th class="center" style="width: 60px;  text-align: center">Net Amt</th>
<th class="center" style="width: 45px;  text-align: center">Tax</th>-->
                </tr>

                <?php
                $qty = 0;
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
                    $qty = $qty + $item['quantity'];
                    $i = $i + 1;
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <td class="center"> <?php echo $item['hsncd']; ?></td>
                        <td class="center"> <?php echo number_format($item['GST'], 2); ?></td>
                        <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                        <td class="center"> <?php echo number_format($item['mrp'], 2); ?></td>
                        <?php if ($is_discount == 1) { ?>
                            <td class="center"> <?php echo round($discount, 2); ?></td>  
                        <?php } ?>
                        <td class="center">  <?php echo number_format($item['total'] - $item['tax'], 2); ?></td>
                        <td class="center">   </td>    
        <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 2); ?></td>   
        <td class="center"> <?php echo round($item['tax'], 2); ?></td>-->
                        <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
                    </tr>
                <?php }
                ?>

                <?php
                if ($i == $size) {
                    $len = 0;
                } else if ($i < $size) {
                    $len = $size - $i;
                } else {
                    $len = $size - ($i - $size);
                }

                for ($k = 0; $k < $len; $k++) {
                    ?> 
                    <tr>
                        <td>&nbsp; </td>
                        <td> </td>
        <!--                    <td> </td>-->
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                    </tr>
                <?php } ?> 
                <tr>
                    <th> </th>
                    <th style="text-transform: capitalize;">Page Total</th>
                    <th class="left"></th>
                    <th class="left"> <?php echo number_format($qty, 2); ?></th>
                    <th class="left"> </th> 
                    <?php if ($is_discount == 1) { ?>
                        <th class="left"> <?php echo number_format($totdis, 2); ?></th>  
                    <?php } ?>
                    <th class="left">  <?php echo number_format($bftax, 2); ?></th>
                    <th class="left">  <?php echo number_format($txamt, 2); ?> </th>    

                    <th class="left"> <?php echo number_format(($bftax + $txamt), 2); ?></th>
                </tr>
            </table>
          <!--   <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
                    <th style=" width: 54%;"><?= label('Total', $this, $user) ?></th>
                    <th style=" width: 12%;"><?php echo number_format($qty, 2); ?></th>
                    <th style=" width: 5%;"></th>
                    <th style=" width: 8%;"><?php echo number_format($bftax, 2); ?></th>
                    <th style=" width: 12%;"><?php echo number_format(($bftax + $txamt), 2); ?></th>
    
                </tr>
            </table>  -->
            <?php if ($inc != ($cpz + 1)) { ?> 
                <table>
                    <?php
                    for ($i = 0; $i < 8; $i++) {
                        ?> 

                        <tr>
                            <td>&nbsp; </td>
                            <td> </td>
            <!--                    <td> </td>-->
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
            <?php } ?>

            <?php if ($inc == ($cpz + 1)) { ?> 
                <div>
                    <div class="cls50" style="text-align: <?= $al ?>; float: <?= $al ?>">
                        <table style="padding: 2px;  margin: 0px; width: 100%; text-align:<?= $al ?>">
                            <tr>
                                <td><?= label('Amount in Words', $this, $user) ?> : </td> 
                            </tr>
                            <tr>
                                <td><?= label('SR', $this, $user) ?> : <?php echo $msd; ?></td>   
                            </tr>
                            <tr>
                                <td></td> 
                            </tr>
                            <tr>
                                <td></td> 
                            </tr>
                        </table>
                    </div>

                    <div class="cls50">
                        <table style="padding: 2px; font-weight: bold; margin: 0px; width: 100%; text-align:<?= $dir ?>">
                            <tr>
                                <td ><?= label('Bill Total', $this, $user) ?>:</td>
                                <td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($gst[0]['tot'], 2); ?> </b></td>  
                            </tr>
                            <tr>
                                <td><?= label('Discount', $this, $user) ?>  :</td>                      
                                <td style="text-align: <?= $ar ?>; "><b><?php echo number_format($gst[0]['dis_amt'], 2); ?> </b></td>  
                            </tr>
                            <tr>
                                <td><?= label('Net Amount', $this, $user) ?>  :</td>
                                <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;text-decoration: underline"><?php echo number_format($sales[0]['total'], 2) ?> </b></td>  
                            </tr>
                        </table>

                    </div>
                </div>
                <table>
                    <tr>
                        <td style="width:60%"><u><?= label('Declaration', $this, $user) ?></u> <br/><?php echo $settings[0]['terms_condition']; ?><br/><?php echo $sales[0]['terms_condition']; ?> </td>
        <!--                <td  style="font-size:12px; text-align: center " >
                        <?= label('For', $this, $user) ?>  <?php echo $company['name']; ?>    
                            <br/>
                            <br/>

                            <br/>
                        </td>         -->
                    </tr>          
                </table>  
                <br/>
                <br/>

                <table  style="width:100%;">
                    <tr>
                        <td style="width:33%; text-align:<?= $al ?>">

                            <?= label('Prepared by', $this, $user) ?> : <?= $sales[0]['user_name'] ?>
                        </td>
                        <td style="width:34%; text-align: center">
                            <?= label('Company Seal', $this, $user) ?>   
                        </td>
                        <td style="width:33%; text-align:<?= $dir ?>">
                            <?= label('Received By', $this, $user) ?>    
                        </td>
                    </tr>
                </table>


            <?php } ?>
            <hr style="border: solid 1px #222; "/> 
            <table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
                <tr>
                    <td  style="font-size:10px; text-align: center ">  
                        <?= label('Bank Details', $this, $user) ?> 
                        <?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?>, 
                        <?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> ,
                        <?= label('IBAN', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?></td>
                </tr>
                <tr>
                    <td  style="font-size:8px; text-align: center ">**<?= label('This is a Computer Generated Invoice', $this, $user) ?>**</td>
                </tr>
                <tr>
                    <td  style="font-size:10px; text-align: center "><?php echo $inc . '-' . number_format($cpz + 1); ?></td>

                </tr>
            </table> 
        </div>
    </body>
</html>

