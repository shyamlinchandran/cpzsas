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
                font-size: 14px;
                font-family: sans-serif;
                text-align: center;
                /*    // background-color: #ddd;*/
                color: #000
            }
            tr td {
                font-size: 13px;
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

                /*                border: 1px solid #ddd*/
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                /*                border: 1px solid #ddd;
                                padding-right: 1px !important;*/
            } 
            .maintable tr:nth-child(odd) {

            }
            .mt,.mt  td  {
                /*                border-right:  1px solid #ddd;*/
                padding-right: 2px !important;
                padding-left:  2px !important;
                border-collapse: collapse;
            } 

            .topbr th{
                /*                border:   1px solid #ddd;*/
            }
            .mt th{
                /*                border-top:    1px solid #ddd;*/
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
                /*                background-color: #aaa;*/
            }
            body{
                /*                //border-color :#000;*/
                border :solid;
            }
            .hedrnd{
                /*                background-color: #fff;*/
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
    <body>

        <div style="width:100%;padding: 0px; margin: 0px; height:188px;">


        </div>
        <div style="width:100%;padding:4px; margin-left:60px; height:80px;">

            <table style="width:100%;">
                <tr>
                    <td style="padding-top:10px;"><h1 style="font-size: 18px; font-weight: bold;"> <?php echo $sales[0]['invoice'] ?></h1></td>

                    <td style="text-align: right;padding-right: 95px;">
                        <table style="height:70px;" >
                            <tr>
                                <td style="padding-top:16px;width: 50px"><?php $date = explode('-', $sales[0]['invoice_date']);
            echo $date[0]; ?></td> 
                                <td style="padding-top:16px;width: 40px"><?php echo $date[1]; ?></td> 
                                <td style="padding-top:16px;width: 30px"><?php echo $date[2]; ?></td> 
                            </tr>
                            <tr>
                                <td style="padding-top:12px;width: 50px"><?php $date = explode('-', $sales[0]['invoice_date']);
            echo $date[0]; ?></td> 
                                <td style="padding-top:12px;width: 40px"><?php echo $date[1]; ?></td> 
                                <td style="padding-top:12px;width: 30px"><?php echo $date[2]; ?></td> 
                            </tr>
                        </table> 
                    </td> 
                </tr>
            </table>

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

            <div   style="text-align:left;padding-left:80px; ">
<?php echo $sales[0]['cusname'] ?> 
    <!--                <h3><?= label('To', $this, $user) ?></h3> 
                <h3><?php echo $sales[0]['cusname'] ?></h3>  
                <p style="padding: 0px;margin: 0px;"><?php echo $sales[0]['address_line1'] ?></p>  
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
                </p>-->
            </div> 
    <!--            <div class="cls20 mainhead" style="float: <?= $al ?>"> 
<?= label($sales[0]['stype'], $this, $user) ?>-<?= label($sales[0]['cash_type'], $this, $user) ?>  
            </div>-->
            <div class="cls33" style="text-align: <?= $dir ?>; ">  
    <!--                <p  dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('Invoice', $this, $user) ?>:#<?php echo $sales[0]['invoice'] ?></p>
                <p style="padding: 0px;margin: 0px;" dir="<?= $ms ?>"> <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] . ' 00:00:00' ?> </p> 
                <p style="padding: 0px;margin: 0px;" dir="<?= $ms ?>">   <?= label('P Date', $this, $user) ?> :<?php echo date('d-m-Y H:i:s') ?></p> 
           
                -->
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
        <table   class="mt maintable"  style="padding:0px;  margin:0px; margin-top: 16px"> 
            <?php
            $qty = 0;
            $total = 0;
            $totdis = 0;
            $txamt = $gtoamt = 0;
            $netamt = 0;
            $i = $len;
            $bftax = 0;
            foreach ($sales_items as $item) {
                $total = $total + (($item['quantity'] * $item['mrps']));
                $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                $totdis = $totdis + $discount;
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total']);
                $qty = $qty + $item['quantity'];
                $i = $i + 1;
                ?>
                <tr> 
                    <td style="width:100px;padding-left:45px"> <?php echo $i; ?></td>
                    <td style="width:300px; text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td style="width:45px;text-align: right"> <?php echo $item['uname']; ?></td> 
                    <td style="width:60px;text-align: right"> <?php echo number_format($item['mrp'], 2); ?></td>  
                    <td style="width:90px;text-align: right"> <?php echo number_format($item['quantity'], 2); ?></td>  
                    <td style="width:125px;text-align: right"> <?php echo number_format($item['mrp'] * $item['quantity'], 2); ?></td>
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
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td> 
                </tr>
<?php } ?> 
<!--            <tr>
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
</tr>-->
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

                <div>
                    <table style="padding: 2px; font-weight: bold; margin: 0px; margin-right: 30px; width: 100%; text-align:<?= $dir ?>">
                        <tr> 
                            <td></td>
                            <td></td>
                            <td style="height:34px; text-align: right;padding-right:15px;"><b><?php echo number_format($total, 2); ?> </b></td>  
                        </tr>

                        <tr> 
                            <td></td>
                            <td></td>
                            <td style="height:34px;text-align: right;padding-right:15px;"><b><?php echo number_format($totdis, 2); ?> </b></td>  
                        </tr>
                        <tr> 
                            <td> </td>
                            <td></td>
                            <td style="height:34px;text-align:right;padding-right:15px;"><b><?php echo number_format($gst[0]['tax'], 2); ?> </b></td>  
                        </tr>
                        <tr> 
                            <td style="padding-left:55px;"><h3 >VAT NO :<?php echo $sales[0]['tin'] ?> </h3></td>
                            <td></td>
                            <td style="height:30px;text-align:right;padding-right:15px;"><b><?php echo number_format($netamt, 2); ?> </b></td>  
                        </tr>
                        <tr>

                            <td style="height:30px;font-size: 10px;;">#PNo.<?php echo $inc . '-' . number_format($cpz + 1) ?></td> 
                            <td><?php echo $sales[0]['user_name'] ?> </td>
                            <td></td>
                        </tr>

                    </table>

                </div>
            </div>



<?php } ?>

    </div>
</body>
</html>

