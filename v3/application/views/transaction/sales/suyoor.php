<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '260px'; //if discont is 0
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
$user = '';
$language = $this->language;
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
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
                text-align: center;
            }
            tr th {
                font-size: 14px;
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
                width:45%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;


            }
            .cls20{
                width:20%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
            }
			.cls60{
				width:60%;
			}
			.cls40{
				width:40%;
			}
            .cls50{
                width:50%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
				
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

        <div style="width:100%;padding: 0px; margin: 10px; height:170px;">


        </div>
      
       
       

        <div   style=" padding: 0px; margin: 0px;margin-top: 0px;">  
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
               <p style="padding: 0px;margin: 0px;"><font style="font-weight:bold;font-size:16px;"> <?= label('To', $this, $user) ?></font> ,<br /> 
             <font style="font-weight:bold;font-size:16px;">   <?php echo $sales[0]['cusname'] ?></font><br />  
              <font style="font-size:14px;">  <?php echo $sales[0]['address_line1'] ?></p> 
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
                </p> </font>
            </div> 
		<div>
			<font style="font-size:15px;font-weight:bold">
			<?php    if($sales[0]['cash_type'] =='Cash'){echo 'Cash';} 
			else if($sales[0]['cash_type'] =='Credit'){echo 'Credit';}
			else if($sales[0]['cash_type'] =='Bank'){echo 'Bank';}
			
			else if($sales[0]['cash_type'] =='COB'){echo 'Cash/Bank';}
			else if($sales[0]['cash_type'] =='Ca_Cr'){echo 'Cash/Credit';}
			else if($sales[0]['cash_type'] =='Ba_Cr'){echo 'Bank/Credit';}
			else if($sales[0]['cash_type'] =='Ba_Ca_Cr'){echo 'Bank/Cash/Credit';}?></font>
		</div>
            <div class="cls34" style="text-align: <?= $dir ?>; ">  
                <p  dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('Invoice', $this, $user) ?>:<font><?php echo $sales[0]['invoice'] ?> </font><br />
                <font style="font-size:14px;"><?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] ?></font> </p> 
            </div>
        </div>
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 10px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th  class="center" style="width: 60px;  text-align: center"><?= label('Barcode', $this, $user) ?></th>
                <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label('Description Of Goods', $this, $user) ?></th>
                <th  class="center" style="width: 30px;  text-align: center"><?= label('Qty', $this, $user) ?></th>
                <th class="center" style="width: 30px;  text-align: center"><?= label('Rate', $this, $user) ?></th>
				<th class="center" style="width: 30px;  text-align: center"><?= label('Dis', $this, $user) ?></th>
               <th class="center" style="width: 50px;  text-align: center"><?= label('Total', $this, $user) ?></th>		
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
                    <td style="text-align:center"> <?php echo $i; ?></td>
                    <td style="text-align:left"> <?php echo $item['barcode']; ?></td>
                    <td style="text-align:left;text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                    <td class="center"> <?php echo number_format($item['mrp'], 2); ?></td> 
                    <td class="center"> <?php echo round($discount, 2); ?></td> 
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
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                </tr>
            <?php } ?> 
			 <tr class="bottomtr">
                    <th class="thbottom">&nbsp; </th>
                    <th class="thbottom"> </th>
                    <th class="thbottom"> </th>
                    <th class="thbottom"><?php echo number_format($qty, 2); ?> </th>
                    <th class="thbottom"> </th>
                    <th class="thbottom" ><?php echo round($discount, 2); ?> </th>
                    <th class="thbottom"> <?php echo number_format(($bftax + $txamt), 2); ?></td>
                </tr>
				<?php if ($inc == ($cpz + 1)) { ?> 
					<tr>
					<th style="text-align:left;font-size:12px" colspan="7">Amount in Words : <?php echo $msd; ?> </th>
					</tr>
				<?php } ?>
        </table>
		   
           
			 <div class="" style="width:100%;margin-top:0px;margin-right:0px; ">  
				<?php if ($inc == ($cpz + 1)) { ?> 
				<table>
					<tr class="trresult">
						<td style="width:120px;font-size:15px;font-weight:bold"><?php if ($inc == ($cpz + 1)) { ?> Customer Sign <?php } ?></td>
						<td style="width:140px;"></td>
						<td style="font-size:15px;font-weight:bold;text-align:left;width:260px;"><?php if ($inc == ($cpz + 1)) { ?> Salesman Sign <?php } ?></td>
						<td style="text-align:left;width:130px;font-size:15px;font-weight:bold"><?= label('Bill Total', $this, $user) ?></td>
						<td style="width:30px;text-align:center">:</td>
						<td style="width:80px;font-size:15px;text-align:right;font-weight:bold"><?php echo number_format($gst[0]['tot'], 2); ?></td>
					</tr>
					<tr class="trresult">
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:15px;font-weight:bold"><?= label('Discount', $this, $user) ?></td>
						<td style="text-align:center">:</td>
						<td style="font-size:15px;text-align:right;font-weight:bold"><?php echo number_format($gst[0]['dis_amt'], 2); ?></td>
					</tr>
					<tr class="trresult">
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:15px;font-weight:bold"><?= label('Before Vat', $this, $user) ?></td>
						<td style="text-align:center">:</td>
						<td style="font-size:15px;text-align:right;font-weight:bold"><?php echo number_format($gst[0]['beforetax'], 2); ?></td>
					</tr>
					<tr class="trresult">
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:15px;font-weight:bold"><?= label('Vat', $this, $user) ?></td>
						<td style="text-align:center">:</td>
						<td style="font-size:15px;text-align:right;font-weight:bold"><?php echo number_format($gst[0]['tax'], 2); ?></td>
					</tr>
					<tr class="trresult">
						<td></td>
						<td></td>
						<td></td>
						<td style="font-size:15px;font-weight:bold"><?= label('Net Amount', $this, $user) ?></td>
						<td style="text-align:center">:</td>
						<td style="font-size:15px;text-align:right;font-weight:bold"><?php echo number_format($sales[0]['total'], 2); ?></td>
					</tr>
				</table>
				<?php }?>
		</div>
        </div>
    </body>
</html>

