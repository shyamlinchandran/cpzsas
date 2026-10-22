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
                background-color: #FF7171;
                color: #fff
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

                border: 1px solid #FF7171
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                border: 1px solid #FF7171;
                padding-right: 1px !important;
            } 
            .maintable tr:nth-child(odd) {background: #eee}
            .mt,.mt  td  {
                border-right:  1px solid #FF7171;
                padding-right: 2px !important;
                padding-left:  2px !important;
                border-collapse: collapse;
            } 

            .topbr th{
                border:   1px solid #FF7171;
            }
            .mt th{
                border-top:    1px solid #FF7171;
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
                width:40%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
            .cls20{
                width:20%;
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
                background-color: #eee;
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
                color: #FF7171;
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
                <h2><?php echo $company['name'] ?> </h2>
                <p><?php echo $company['address'] ?>
                    <br/>
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Tax ID', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  

            </div>
            <div class="cls20"> 
                <img align="middle"  style="margin: 30px" width="90" height="110"  src="uploads/company/<?php echo $company['logo'] ?>" />   
            </div>
            <div class="cls33 txtright hedrnd" style="text-align: right;">
                <h2><?php echo $company['name_lan'] ?> </h2>
                <p><?php echo $company['address_lan'] ?>
                    <br/> 
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Tax ID', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  
            </div>


        </div>
        <div style="width:100%;padding:0px; margin: 0px; height: 70px;">
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

            <div class="cls33 txtleft" style="text-align: <?= $al ?>; float: <?= $al ?>">
                <h3><?php echo $sales[0]['cusname'] ?></h3>  
                <h3><?php echo $sales[0]['address_line1'] ?></h3>  
                <h3><?php echo $sales[0]['phone'] ?></h3>  
            </div> 
            <div class="cls20 mainhead" style="float: <?= $al ?>"> 
                <?= label($sales[0]['stype'], $this, $user) ?>-<?= label($sales[0]['cash_type'], $this, $user) ?>  
            </div>
            <div class="cls33" style="text-align: <?= $dir ?>; ">  
                <p dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('Invoice', $this, $user) ?>:#<?php echo $sales[0]['invoice'] ?></p>
                <p dir="<?= $ms ?>"> <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] . ' 00:00:00' ?> </p> 
                <p dir="<?= $ms ?>">   <?= label('P Date', $this, $user) ?> :<?php echo date('d-m-Y H:i:s') ?></p> 
            </div>
        </div>


    </div> 

    <div style="padding: 0px; margin: 0px;">  
<!--        <table style="padding: 2px;  margin: 0px; width: 100%;">
            <tr>
                <td><?= label('Transportation Mode', $this, $user) ?> : </td>
                <td>Date Of Supply :<?php echo $sales[0]['invoice_date'] ?> </td>
            </tr>
            <tr>
                <td>  </td>
                <td>State : </td>
            </tr>
            <tr>
                <td><?= label('Dispatch Number', $this, $user) ?> : </td>
                <td><?= label('E-Way Bill Number', $this, $user) ?> :<?php echo $sales[0]['ewb_no'] ?> </td>
            </tr>
        </table>-->
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 20px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label('Description Of Goods', $this, $user) ?></th>
                <th  class="center" style="width: 45px;  text-align: center"><?= label('Barcode', $this, $user) ?></th>
<!--                <th  class="center" style="width: 35px;  text-align: center"><?= label('Tax', $this, $user) ?>%</th>-->
                <th  class="center" style="width: 35px;  text-align: center"><?= label('Qty', $this, $user) ?></th>
                <th class="center" style="width: 42px;  text-align: center"><?= label('Rate', $this, $user) ?></th>

<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                <?php if ($is_discount == 1) { ?>
                    <th class="center" style="width: 35px;  text-align: center"><?= label('Dis', $this, $user) ?></th>
                    <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                    <th class="center" style="width: 40px;  text-align: center"><?= label('Tax', $this, $user) ?></th> 
                    <th class="center" style="width: 50px;  text-align: center"><?= label('Total', $this, $user) ?></th>
                <?php } ?>
                <?php if ($is_discount == 0) { ?>
                    <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                    <th class="center" style="width: 45px;  text-align: center"><?= label('Tax', $this, $user) ?></th> 
                    <th class="center" style="width: 75px;  text-align: center"><?= label('Total', $this, $user) ?></th>
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
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total'] - $item['tax']);
                $i = $i + 1;
                ?>
                <tr>
                    <td> <?php echo $i; ?></td>
                    <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td class="center"> <?php echo $item['barcode']; ?></td>
    <!--                    <td class="center"> <?php echo $item['GST']; ?></td>-->
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                    <td class="center"> <?php echo number_format($item['mrp'], 2); ?></td> 
                    <?php if ($is_discount == 1) { ?>
                        <td class="center"> <?php echo round($discount, 2); ?></td>  
                    <?php } ?>
                    <td class="center">  <?php echo number_format($item['total'] - $item['tax'], 2); ?></td>
                    <td class="center"> <?php echo number_format($item['tax'], 2); ?>  </td>    
    <!--                        <td class="center"> <?php echo round($item['total'] - $item['tax'], 2); ?></td>   
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
        <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
            <tr>
                <th style=" width: 58%;"><?= label('Total', $this, $user) ?></th>
                <th style=" width: 12%;"></th>
                <th style=" width: 8%;"><?php echo number_format($bftax, 2); ?></th>
                <th style=" width: 10%;"><?php echo number_format($txamt, 2); ?></th> 
                <th style=" width: 12%;"><?php echo $sales[0]['total']; ?></th>

            </tr>
        </table>  
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
                        <td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($gtoamt, 2); ?> </b></td>  
                    </tr>
                    <tr>
                        <td><?= label('Discount', $this, $user) ?>  :</td>                      
                        <td style="text-align: <?= $ar ?>; "><b><?php echo number_format($totdis, 2); ?> </b></td>  
                    </tr>
                    <tr>
                        <td><?= label('Tax', $this, $user) ?>  :</td>
                        <td style="text-align: <?= $ar ?>;"><b><?php echo number_format($txamt, 2); ?> </b></td>  
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
                <td style="width:60%"><u><?= label('Declaration', $this, $user) ?></u> <br/><?php echo $sales[0]['terms_condition']; ?> </td>
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
                    <?= label('Prepared by', $this, $user) ?>    
                </td>
                <td style="width:34%; text-align: center">
                    <?= label('Company Seal', $this, $user) ?>    
                </td>
                <td style="width:33%; text-align:<?= $dir ?>">
                    <?= label('Received By', $this, $user) ?>    
                </td>
            </tr>
        </table>
        <hr style="border: solid 1px #222; "/> 
        <table style="padding:0px;  margin: 0px;  width:100%;">
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
        </table> 
    </div>
</body>
</html>

