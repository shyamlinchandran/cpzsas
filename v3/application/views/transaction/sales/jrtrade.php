<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '155px'; //if discont is 0
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
                width:33%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
            .cls34{
                width:33%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
            .cls20{
                width:33%;
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
            .mainhead p{ 
                text-align:center;
                font-size:18px; 
                text-transform: uppercase;
                font-weight: bolder; 
                color: #000;
                text-decoration: underline;
                vertical-align: top;
                padding : 0px;
                margin : 0px;
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
                <p><?php echo $company['address']; ?>
                    <br/>
                </p>  

            </div>
            <div class="cls20"> 
				<?php if($company['logo']!=""){?>
					<img align="middle"  style="margin: 0px" width="100%" height="60px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
				<?php }else{ echo '&nbsp;';}?>
            </div>
            <div class="cls34 txtright hedrnd" style="text-align: right;">
                <h2><?php echo $company['name_lan'] ?> </h2>
                <p><?php echo $company['address_lan'] ?>
                    <br/> 
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('GSTN', $this, $user) ?> :<?php echo $company['tin'] ?> 
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
                <h3><?= label('To', $this, $user) ?></h3> 
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
                        echo 'Gst No :' . $sales[0]['tin'];
                    }
                    ?>
                </p>
            </div> 
            <div class="cls20 mainhead" style="text-align:center;float: <?= $al ?>"> 
                <p>	Tax Invoice </p>
                
            </div>
            <div class="cls34" style="text-align: <?= $dir ?>; ">  
                <p  dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('Invoice', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?></p>
                <p style="padding: 0px;margin: 0px;" dir="<?= $ms ?>"> <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] ?> </p> 
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
                <th  class="center" style="width: 30px;  text-align: center"><?= label('Hsncode', $this, $user) ?></th>
<!--                <th  class="center" style="width: 35px;  text-align: center"><?= label('Tax', $this, $user) ?>%</th>-->
                <th  class="center" style="width: 30px;  text-align: center"><?= label('Qty', $this, $user) ?></th>
                <th class="center" style="width: 42px;  text-align: center"><?= label('Rate ', $this, $user) ?></th>
                <th class="center" style="width: 20px;  text-align: center"><?= label('GST% ', $this, $user) ?></th>
                <th  class="center" style="width: 35px;  text-align: center"><?= label('CGST', $this, $user) ?></th>
                <th  class="center" style="width: 35px;  text-align: center"><?= label('SGST ', $this, $user) ?></th>
<!--                    <th  class="right" style="width: 45px;">Rate</th>-->
                <?php if ($is_discount == 1) { ?>
                    <th class="center" style="width: 35px;  text-align: center"><?= label('Dis', $this, $user) ?></th>
    <!--                    <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                    <th class="center" style="width: 40px;  text-align: center"><?= label('Tax', $this, $user) ?></th> -->
                    <th class="center" style="width: 50px;  text-align: center"><?= label('Total', $this, $user) ?></th>
                <?php } ?>
                <?php if ($is_discount == 0) { ?>
    <!--                    <th class="center" style="width: 45px;  text-align: center"><?= label('Taxable Value', $this, $user) ?></th>
                    <th class="center" style="width: 45px;  text-align: center"><?= label('Tax', $this, $user) ?></th> -->
                    <th class="center" style="width: 75px;  text-align: center"><?= label('Total', $this, $user) ?></th>
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
				
				$rate = $item['mrp'];
				$per = 0;
				if((float) $item['GST'] > 0 ){
					$per = (float) $per + (float) $item['GST'];
				}
				if((float) $sales[0]['saletype'] ==  'b2c' && $sales[0]['cess'] >0  ){
					if((float)$item['ces_amt'] > 0  ){
						$per = (float) $per + 1;
					}
				}
				if((float) $item['itm_ces_per'] > 0  ){
					//$per = (float) $per + (float) $item['itm_ces_per'];
				}
				if((float) $item['is_taxincluded'] > 0 ){
					if( (float) $per > 0 ){
						//$rate  = $rate  - (( (float) $rate * (float) $per)/100);
						$taxamt = (float) $rate - (((float) $rate * 100) / ((float) $per + 100));
						$rate = (float) $rate - (float) $taxamt;
					}
				}
                ?>
                <tr>
                    <td> <?php echo $i; ?></td>
                    <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td class="center"> <?php echo $item['hsncd']; ?></td>
    <!--                    <td class="center"> <?php echo $item['GST']; ?></td>-->
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                    <td class="center"> <?php echo number_format($rate, 2); ?></td> 
					<td class="center"> <?php echo number_format($item['GST'], 2); ?></td>
					<td class="center"> <?php echo number_format($item['tax']/2, 2); ?></td>
                    <td class="center"> <?php echo number_format($item['tax']/2, 2); ?></td> 
                    <?php if ($is_discount == 1) { ?>
                        <td class="center"> <?php echo round($discount, 2); ?></td>  
                    <?php } ?>
    <!--                    <td class="center">  <?php echo number_format($item['total'] - $item['tax'], 2); ?></td>
                <td class="center"> <?php echo number_format($item['tax'], 2); ?>  </td>    -->
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
    <!--                    <td> </td>
                    <td> </td>-->
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
            <tr>
                <th> </th>
                <th style="text-transform: capitalize;">Total</th>
                <th class="left"></th>
                <th class="left"> <?php echo number_format($qty, 2); ?></th>
                <th class="left"> </th> 
				<th class="left"> </th> 
				<th class="left"> </th> 
				<th class="left"> </th> 
                <?php if ($is_discount == 1) { ?>
                    <th class="left"> <?php echo number_format($totdis, 2); ?></th>  
                <?php } ?>
<!--                    <th class="left">  <?php echo number_format($bftax, 2); ?></th>
            <th class="left">  <?php echo number_format($txamt, 2); ?> </th>    -->

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
                            <td><?= label('Amount in Words', $this, $user) ?> :<?php echo $msd; ?> </td> 
                        </tr>
                        <tr>
                            <td></td>   
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
                            <td><?= label('Before Tax', $this, $user) ?>  :</td>
                            <td style="text-align: <?= $ar ?>;"><b><?php echo number_format($gst[0]['beforetax'], 2); ?> </b></td>  
                        </tr>
						
                        <tr>
                            <td><?= label('Sgst ', $this, $user) ?>  :</td>
                            <td style="text-align: <?= $ar ?>;"><b><?php if($gst[0]['tax'] > 0){echo number_format($gst[0]['tax']/2, 2);}else{echo '0.00';} ?> </b></td>  
                        </tr>
						<tr>
                            <td><?= label('Cgst ', $this, $user) ?>  :</td>
                            <td style="text-align: <?= $ar ?>;"><b><?php if($gst[0]['tax'] > 0){echo number_format($gst[0]['tax']/2, 2);}else{echo '0.00';} ?> </b></td>  
                        </tr>
                        <?php if ($sales[0]['adjustment'] > 0) { ?>
                            <tr>
                                <td><?= label('Exchange Amount', $this, $user) ?>  :</td>
                                <td style="text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['adjustment'], 2) ?> </b></td>  
                            </tr>
                        <?php } ?>
                        <tr>
                            <td><?= label('Net Amount', $this, $user) ?>  :</td>
                            <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;"><?php echo number_format($sales[0]['total'] - $sales[0]['adjustment'], 2) ?> </b></td>  
    <!--                    <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;text-decoration: underline"><?php
                       // $amount = $sales[0]['total'] - $sales[0]['adjustment'];
                      //  $amount = round($amount, 0);
                       // setlocale(LC_MONETARY, 'en_IN');
                       // $amount = money_format('%!i', $amount);
                       // echo $amount;
                        //echo strstr($amount, '.', true);
                        ?> </b></td> -->
                        </tr>
                    </table>

                </div>
            </div>
            <table>
                <tr>
                    <td style="width:60%"> </td>
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

                        <?= label('Prepared by', $this, $user) ?> : <?= $sales[0]['user_name']; ?>
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
                    <?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?></td>
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

