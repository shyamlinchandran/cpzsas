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

        <div style="width:100%;padding: 0px; margin: 10px; height:140px;">


        </div>
        <table   class="mt maintable"  style="padding:0px;  margin:2px; margin-top: 0px"> 
			<tr>
				<td style="width:135px;padding-left:0px;font-size:16px;"><b>
					<?php
                                    $date = explode('-', $sales[0]['invoice_date']);
                                    echo $date[0] . '/' . $date[1] . '/' . $date[2];
                                    ?></b>
				</td>
				<td style="width:150px;font-size:16px;"><b>
					<?php echo $sales[0]['user_name'] ?></b>
				</td>
				<td style="width:250px;font-size:16px;">
				<b>
					<?php
                        if ($sales[0]['cash_type'] == "Credit") {
                            echo 'أجل	';
                        } else if ($sales[0]['cash_type'] == "Ba_Cr") {
                            echo 'البنك/ أجل	';
                        } else if ($sales[0]['cash_type'] == "Ca_Cr") {
                            echo 'نقدي/ أجل	';
                        } else if ($sales[0]['cash_type'] == "Ba_Ca_Cr") {
                            echo 'البنك/نقدي/ أجل	';
                        } else if ($sales[0]['cash_type'] == "COB") {
                            echo 'نقدي/البنك';
                        } else if ($sales[0]['cash_type'] == "Bank") {
                            echo 'البنك';
                        } else {
                            echo 'نقدي';
                        }
                        ?></b>
				</td>
				<td style="font-size:16px;width:100px;"><b>
					<?php echo $sales[0]['invoice'] ?></b>
				</td>
			</tr>
		</table>
		<div style="padding: 0px; margin: 0px;margin-top: 0px;">  
			 <table   class="mt maintable"  style="padding:0px;  margin:2px; margin-top: 30px"> 
				<tr>
					<td style="height:23px;font-weight:bold;font-size:16px;width:510px;padding-left:0px;"><?php echo $sales[0]['cusname'] ?> </td>
					<td style="font-weight:bold;font-size:16px;"><?php echo $sales[0]['tin'] ?></td>
				</tr>
				<tr>
					<td style="font-weight:bold;height:45px;width:510px;padding-left:0px;font-size:16px;"><?php echo $sales[0]['address_line1'] ?></td>
					<td></td>
				</tr>
				<tr>
					<td style="height:23px;width:510px;padding-left:0px;font-size:16px;"> </td>
					<td style="font-size:16px;font-weight:bold;"><?php echo $sales[0]['cusdetails'] ?></td>
				</tr>
			 </table>
		</div>
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

        <div style="padding: 0px; margin: 0px;margin-top: 43px;margin-left:0px;">  

            <table   class="mt maintable"  style="padding:0px;  margin:2px;margin-left:0px; margin-top: 0px"> 
                <?php
                $qty = 0;
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                foreach ($sales_items as $item) {
                    $is_tax = $item['is_taxincluded'];
                    $itemrate = $item['mrp'];
                    if ($is_tax == 1 && $item['tax'] != 0) {
                        $itemrate = ($item['mrp'] * $item['quantity'] - $item['tax']) / $item['quantity'];
                    }
                    $total = $total + (($item['quantity'] * $item['mrps']));
                    $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                    $gtoamt = $gtoamt + round($itemrate * $item['quantity'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($item['total']);
                    $qty = $qty + $item['quantity'];
                    $i = $i + 1;
                    ?>
                    <tr> 
                        <td style="height:23px; text-align: left;width:35px;padding-left:0px;"> <?php echo $i; ?></td>
                        <td style="padding-left:5px;text-align: left;font-size: 14px; width:125px; text-transform: capitalize;"> <?php echo $item['barcode']; ?></td>
                        <td style="padding-left:5px;text-align: left;font-weight:700;font-size: 13px; width:320px; text-transform: capitalize;"> <?php echo $item['name']; ?></td>
            <!--                    <td style="width:115px;text-align: right"> <?php echo $item['uname']; ?></td> --> 
                        <td style="font-size: 14px; width:64px;text-align: right"> <?php echo number_format($item['quantity'], 2); ?></td> 
                        <td style="font-size: 14px; width:74px;text-align: right"> <?php echo number_format($itemrate, 2); ?></td>  
                        <td style="font-size: 14px; width:115px;text-align: right"> <?php echo number_format($itemrate * $item['quantity'], 2); ?></td>
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

                for ($k = 0; $k < $len + 2; $k++) {
                    ?> 
                    <tr>
                        <td style="height:23px">&nbsp; </td>
                        <td> </td> 
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td> 
                    </tr>
                <?php } ?> 



            </table> 
            <?php if ($inc != ($cpz + 1)) { ?> 
                <table style=" margin-bottom: 0px;">
                    <?php
                    for ($i = 0; $i < 8; $i++) {
                        ?> 

                        <tr>
                            <td style="height:20px">&nbsp; </td>
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
					<div style="height:150px;">
                        <table style="padding-top: 0px; font-weight: bold; margin: 10px; margin-right: 0px; margin-top: 5px;width: 100%; text-align:<?= $dir ?>">
                            <tr> 
                                <td style="height:26px;padding-right:50px; text-align: right; width:33%"><?php
                                    if ($sales[0]['cash_type'] == "Cash" || $sales[0]['cash_type'] == "Ca_Cr" || $sales[0]['cash_type'] == "Ba_Ca_Cr" || $sales[0]['cash_type'] == "COB") {
                                        echo $sales[0]['cash_amount'];
                                    }
                                    ?></td>
                                <td></td>
                                <td style="padding-right: 15px;height:34px; text-align: right;"><b><?php echo number_format($gtoamt, 2); ?> </b></td>  
                            </tr>

                            <tr> 
                                <td  style="height:26px;padding-right: 50px; text-align: right;"><?php
                                    if ($sales[0]['cash_type'] == "Bank" || $sales[0]['cash_type'] == "Ba_Cr" || $sales[0]['cash_type'] == "Ba_Ca_Cr" || $sales[0]['cash_type'] == "COB") {
                                        echo $sales[0]['bank_amount'];
                                    }
                                    ?></td>
                                <td  style="  text-align: left;"><?php
                                    if ($sales[0]['cash_type'] == "Bank" || $sales[0]['cash_type'] == "Ba_Cr" || $sales[0]['cash_type'] == "Ba_Ca_Cr" || $sales[0]['cash_type'] == "COB") {
                                        echo $sales[0]['Bank'];
                                    }
                                    ?></td>
                                <td style="padding-right: 15px;height:25px;text-align: right;"><b><?php $netamt =$sales[0]['total']-$sales[0]['discount'];echo number_format($sales[0]['discount']+$totdis, 2); ?> </b></td>  
                            </tr>
                            <tr> 
                                <td  style="height:26px;padding-right:50px; text-align: right;"><?php
                                    if ($sales[0]['cash_type'] == "Credit") {
                                        echo number_format($sales[0]['total'], 2);
                                    } else if ($sales[0]['cash_type'] == "Ba_Cr") {
                                        echo number_format($sales[0]['total'] - $sales[0]['bank_amount'], 2);
                                    } else if ($sales[0]['cash_type'] == "Ca_Cr") {
                                        echo number_format($sales[0]['total'] - $sales[0]['cash_amount'], 2);
                                    } else if ($sales[0]['cash_type'] == "Ba_Ca_Cr") {
                                        echo number_format($sales[0]['total'] - $sales[0]['cash_amount'] - $sales[0]['bank_amount'], 2);
                                    }
                                    ?> </td>
                                <td></td>
                                <td style="padding-right: 15px;height:30px;text-align:right;"><b><?php echo number_format($gst[0]['tax'], 2); ?> </b></td>  
                            </tr>
                            <tr> 
                                
                                <td colspan="2" style="text-align: left;"> <?php echo $msd; ?> </td>
                                <td style="padding-right: 15px;height:30px;text-align:right;"><b><?php echo number_format($sales[0]['total'], 2); ?> </b></td>  
                            </tr>
                            <tr>

                                <td style="height:26px;padding-right:35px; text-align: right;"></td> 
                                <td> </td>
                                <td></td>
                            </tr>
                            
                            <tr>
                                <td colspan="3" style="font-size:15px;padding-top:5px;padding-left:20px;text-align:left">
                                  
                                </td>
                            </tr>

                        </table>
					</div>



<?php } ?>
 
        </div>
		<div style="text-align:center;padding-top30px;padding-left:300px;">
			#PNo.<?php echo $inc . '-' . number_format($cpz + 1) ?>
		</div>
    </body>
</html>

