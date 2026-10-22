<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '185px'; //if discont is 0
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
                font-size: 10px;
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


           <p style="padding: 0px;text-align:center;margin-bottom:0px;">
				<font style="font-size:18px;font-weight:bold"><?php echo $company['name'] ?></font><br />
				<font style="font-size:12px;"><?php echo $sales[0]['brc_address'] ?> , <?php echo $company['phone'] ?><br />
				GST No : <?php echo $company['tin'] ?> <br />
				</font>
			</p>
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
<div style="width:100%;padding:0px; margin: 0px; ">
            <div class="cls33 txtleft" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
				<p style="padding: 0px;">
					<font style="font-size:12px;font-weight:bold">
							<?= label('To', $this, $user) ?><br />
							<?php echo $sales[0]['cusname'] ?><br />
							<?php
                    if (isset($sales[0]['address_line1'])) {
                        echo  $sales[0]['address_line1'];
                    }
                    ?><br />
							<?php
                    if (isset($sales[0]['phone'])) {
                        echo 'Phone :' . $sales[0]['phone'];
                    }
                    ?><br />
					<?php
                    if (isset($sales[0]['tin'])) {
						if($sales[0]['tin'] != '')
							echo 'Gst No :' . $sales[0]['tin'];
                    }
                    ?>
					</font>
				</p>
                
            </div> 
            <div class="cls20 mainhead" style="padding: 0px; margin: 0px; text-align:center;float: <?= $al ?>"> 
                <p style="padding: 0px;font-size:15px ; font-weight: bold;">	Tax Invoice </p>
                
            </div>
            <div class="cls34" style="padding: 0px; margin: 0px; text-align: <?= $dir ?>; ">  
                <p  dir="<?= $ms ?>" style="padding: 0px;font-size:12px ; font-weight: bold;"><?= label('INV NO', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?><br />
                 <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] ?>  <?php if($sales[0]['ref_no']!=''){?> <br />Ref No :<?php echo $sales[0]['ref_no'] ?> <?php }?> </p> 
            </div>
        </div> 


       <!-- <div style="width:100%;padding:0px; margin: 0px; ">
		 <div class="cls33 txtleft hedrnd" style="padding: 0px; margin: 0px; text-align: left;">
                <h2 "padding: 0px; margin: 0px;"><?php echo $company['name'] ?> </h2>
                <p style="padding:0px;margin:0px;"><?php echo $company['address'] ?>
                    <br/>
                </p>  

            </div>
            <div style="padding: 0px; margin: 0px; " class="cls20"> 
				<?php if($company['logo']!=""){?>
					<img align="middle"  style="margin: 0px" width="100%" height="60px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
				<?php }?>
            </div>
            <div class="cls34 txtright hedrnd" style="padding: 0px; margin: 0px; text-align: right;">
                <h2 "padding: 0px; margin: 0px;"><?php echo $company['name_lan'] ?> </h2>
                <p style="padding: 0px; margin: 0px; "><?php echo $company['address_lan'] ?>
                    <br/> 
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Gst No', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  
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

            <div class="cls33 txtleft" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
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
            <div class="cls20 mainhead" style="padding: 0px; margin: 0px; text-align:center;float: <?= $al ?>"> 
                <p>	Tax Invoice </p>
                
            </div>
            <div class="cls34" style="padding: 0px; margin: 0px; text-align: <?= $dir ?>; ">  
                <p  dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('INV NO', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?></p>
                <p style="padding: 0px;margin: 0px;" dir="<?= $ms ?>"> <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] ?> </p> 
            </div>
        </div> -->



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
                <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label(strtoupper ('Description Of Goods'), $this, $user) ?></th>
                <th  class="center" style="width: 45px;  text-align: center"><?= label(strtoupper('Hsncode'), $this, $user) ?></th>
                <th  class="center" style="width: 30px;  text-align: center"><?= label(strtoupper('Qty'), $this, $user) ?></th>
                <th  class="center" style="width: 30px;  text-align: center"><?= label(strtoupper('FQty'), $this, $user) ?></th>
			   <th  class="center" style="width: 35px;  text-align: center"><?= label(strtoupper('Unit'), $this, $user) ?></th>
				<th class="center" style="width: 35px;  text-align: center"><?= label(strtoupper('Mrp '), $this, $user) ?></th>
                <th class="center" style="width: 42px;  text-align: center"><?= label('RATE ', $this, $user) ?></th>
				<th class="center" style="width: 35px;  text-align: center"><?= label('DIS', $this, $user) ?></th>
				 <th class="center" style="width: 40px;  text-align: center"><?= label('TAXABLE', $this, $user) ?></th>
				  <th class="center" style="width: 40px;  text-align: center"><?= label('GST%', $this, $user) ?></th>
				   <th class="center" style="width: 45px;  text-align: center"><?= label('SGST ', $this, $user) ?></th>
				    <th class="center" style="width: 45px;  text-align: center"><?= label('CGST ', $this, $user) ?></th>
				<!--	  <th class="center" style="width: 45px;  text-align: center"><?= label('CESS ', $this, $user) ?></th>-->
                <th class="center" style="width: 50px;  text-align: center"><?= label('TOTAL', $this, $user) ?></th>

            </tr>

            <?php
            $qty = 0;
            $total = 0;
            $totdis = 0;
            $txamt = $gtoamt = 0;
            $netamt = 0;
            $i = $len;
			$is_taxincluded = 0;
            $bftax = 0;
			$totrawces = 0 ;
			$taxable_value = 0 ;
            foreach ($sales_items as $item) {
				$is_taxincluded = $item['is_taxincluded'];
				if((int) $item['is_taxincluded'] > 0 ){
					$taxable_value = $taxable_value + $item['total'] - $item['tax'] - $item['itm_raw_ces']-$item['ces_amt'];
				}else{
					$taxable_value = $taxable_value + $item['total'] - $item['tax'] - $item['itm_raw_ces'];
				}
				$itm_raw_ces = $item['itm_raw_ces'];
				$totrawces = (float) $totrawces + (float) $item['itm_raw_ces'];
                $total = $total + $item['total'];
                $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                $totdis = $totdis + $discount;
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total'] - $item['tax']);
                $qty = $qty + $item['quantity'];
                $i = $i + 1;
				$ces_amt = 0;
				if( $sales[0]['saletype'] ==  'b2c' ){
					$ces_amt =$item['ces_amt'];
				}
				
				$rate = $item['mrp'];
				$per = 0;
				if((float) $item['GST'] > 0 ){
					$per = (float) $per + (float) $item['GST'];
				}
				if( $sales[0]['saletype'] ==  'b2c' && (float) $sales[0]['cess'] > 0  ){
					$per = (float) $per + 1;
				}
				if((float) $item['itm_ces_per'] > 0  ){
					$per = (float) $per + (float) $item['itm_ces_per'];
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
                    <td> <?php echo $i;?></td>
                    <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td class="center"> <?php echo $item['hsncd']; ?></td>
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                    <td class="center"> <?php echo number_format($item['free_quantity'], 2); ?></td>
					<td class="center"> <?php echo $item['uname']; ?></td>
				<td class="center"> <?php echo number_format($item['MRP'], 2); ?></td>
                    <td class="center"> <?php echo number_format($rate, 2); ?></td> 
                    <td class="center"> <?php echo round($discount, 2); ?></td>
					<?php if((int) $item['is_taxincluded'] > 0  && (float) $sales[0]['cess'] > 0  ){?>
						<td class="center">  <?php echo number_format($item['total'] - $item['tax'] - $item['itm_raw_ces']-$ces_amt, 2); ?></td>
					<?php } else{?>
						<td class="center">  <?php echo number_format($item['total'] - $item['tax'] - $item['itm_raw_ces'], 2); ?></td>
					<?php } ?>
					<td class="center"> <?php echo $item['GST']; ?></td>
					<td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td> 
					<td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td> 
					<!-- <td class="center"> <?php echo number_format($item['itm_raw_ces'], 2); ?>  </td> -->
					<?php if((int) $item['is_taxincluded'] > 0 && $sales[0]['saletype'] ==  'b2c' && (float) $sales[0]['cess'] > 0  ){?>
						<td class="center"> <?php echo number_format($item['total']-$item['ces_amt'], 2); ?></td>
					<?php } else{?>
						<td class="center"> <?php echo number_format($item['total'], 2); ?></td>
					<?php } ?>
                    
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
				<!--	<td> </td>-->
					 <td> </td>
					<td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                <!--    <td> </td> -->
                    <td> </td>
                </tr>
            <?php } ?> 
		<?php if ($inc == ($cpz + 1)) { ?> 

            <tr>
                <th> </th>
                <th style="text-transform: capitalize;">Total</th>
                <th class="left"></th>
                <th class="left"> </th>
                <th class="left"> </th>
				 <th class="left"> </th> 
                <th class="left"> </th>
                <th class="left"> </th>
			<!--	 <th class="left"> </th>-->
				<th class="left"> </th>  
				<?php if((int) $is_taxincluded < 1 ){?>
					<th class="left"> <?php echo number_format(($sales[0]['total']-$sales[0]['tax']), 2); ?></th>
				<?php }else{ ?>
					<th class="left"> <?php echo number_format(($sales[0]['total'] - $sales[0]['cess']-$sales[0]['tax']), 2); ?></th>
				<?php } ?>
				<th class="left"> </th>
				<th class="left"><?php echo  number_format($sales[0]['tax']/2,2); ?> </th> 
				<th class="left"><?php echo  number_format($sales[0]['tax']/2,2); ?> </th> 
				<!-- <th class="left"><?php echo  number_format($totrawces ,2); ?>  </th> -->
				<?php if((int) $is_taxincluded < 1 ){?>
					<th class="left"> <?php echo number_format(($sales[0]['total']), 2); ?></th>
				<?php }else{ ?>
					<th class="left"> <?php echo number_format(($sales[0]['total'] - $sales[0]['cess']), 2); ?></th>
				<?php } ?>
            </tr>
			 <?php } ?>
        </table>
     
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
            <div style="padding:0px;" >
                <div class="cls50" style="text-align: <?= $al ?>; float: <?= $al ?>">
                    <table style="padding: 2px;  margin: 0px; width: 100%; text-align:<?= $al ?>">
						<tr style ="padding:0px;">
							<td style ="padding:0px;" colspan = "2"><?= label('Amount in Words', $this, $user) ?> :<?php echo $msd; ?></td>
						</tr>
                        <tr style ="padding:0px;">
                            <td style = "padding:0px;width:35%">
							<br /> <img align="middle"  style="margin: 0px" width="120px" height="120px"  src="uploads/company/<?php echo $company['logo'] ?>" />  </td> 
							<td style = "width:65%">
							<?= label('Bank', $this, $user) ?> : <?php echo $company['comset_bank']; ?><br />
							<?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?><br />
							<?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?>
							</td>
					   </tr>
                        
                    </table>
                </div>

                <div class="cls50">
                    <table style="padding: 0px; font-weight: bold; margin: 0px; width: 100%; text-align:<?= $dir ?>">
                        <tr>
                            <td ><?= label('TOTAL', $this, $user) ?> :</td>
                            <td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['total']-$sales[0]['cess'], 2); ?> </b></td>  
                        </tr>
                        <tr>
                            <td><?= label('Discount', $this, $user) ?>  :</td>                      
                            <td style="text-align: <?= $ar ?>; "><b><?php echo number_format($gst[0]['dis_amt'], 2); ?> </b></td>  
                        </tr>

						
                      
					
						<?php if((float) $sales[0]['cess'] > 0){?>
							<tr>
								<td><?= label('KFC(1%)', $this, $user) ?>  :</td>
								<td style="text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
                        <?php if ($sales[0]['adjustment'] > 0) { ?>
                            <tr>
                                <td><?= label('Exchange Amount', $this, $user) ?>  :</td>
                                <td style="text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['adjustment'], 2) ?> </b></td>  
                            </tr>
                        <?php } ?>
                        <tr>
                            <td><?= label('GRAND TOTAL', $this, $user) ?>  :</td>
                            <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;"><?php echo number_format(round($sales[0]['total'] - $sales[0]['adjustment'],0), 2) ?> </b></td>  

                        </tr>
                    </table>

                </div>
            </div>


            <table  style="padding:0px;width:100%;">
                <tr>
                    <td style="width:33%; text-align:<?= $al ?>">

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
                <td  style="font-size:8px; text-align: center ">**<?= label('This is a Computer Generated Invoice', $this, $user) ?>**</td>
            </tr>
            <tr>
                <td  style="font-size:10px; text-align: center "><?php echo $inc . '-' . number_format($cpz + 1); ?></td>

            </tr>
        </table> 
    </div>
</body>
</html>

