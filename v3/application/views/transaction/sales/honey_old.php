<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '305px'; //if discont is 0
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
			
			.clsdiv20{
				width : 19% !important;
				border :1px solid black;
				height:130px !important;
			}
			.clsdiv30{
				width : 30% !important;
				border :1px solid black;
				height:110px !important;
			}
			.clsdiv40{
				width : 40% !important;
				height:130px !important;
				border :1px solid black;
			}
			.clsdiv38{
				width : 38% !important;
				height:110px !important;
				border :1px solid black;
			}
			.clsdiv25{
				width : 20.6% !important;
				height:110px !important;
				border :1px solid black;
			}
			.clsdiv40s{
				width : 40% !important;
				height:125px !important;
				border :1px solid black;
			}
			.clsdiv38s{
				width : 38% !important;
				height:125px !important;
				border :1px solid black;
			}
			.clsdiv25s{
				width : 20.6% !important;
				height:125px !important;
				border :1px solid black;
			}
			.cls50sub{
				width : 50% !important;
				border-left :1px solid black;
			}
			.cls40sub{
				width : 33% !important;
				border-right :1px solid black;
			}
			.cls10sub{
				width : 15% !important;
			}
			.ptax { margin:0 }
        </style>
		
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
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
	<table style="width:100%">
			<tr  colspan="2">
				<td style="width:45%;text-align:right">
					<b>TAX - INVOICE</b>
				</td>
				<td style="width:45%;text-align:right">
					<?php echo $inc . '-' . number_format($cpz + 1); ?>
				</td>
			</tr>
	</table>
	<div style="width:100%;padding:0px; margin: 0px; ">
		<div class="clsdiv20" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
			<img align="middle"  style="margin: 0px" width="100%" height="108px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
		</div>
		<div class="clsdiv40" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
			 <table class="" style="padding: 2px;;  margin: 0px; width: 100%;">
				<tr>
					<td colspan ="2">
						<h2><?php echo $company['name'];?></h2>
					</td>
				</tr>
				<tr>
					<td colspan ="2">
						<b><?php echo $company['address'];?><b>
					</td>
				</tr>
				<tr>
					<td colspan ="2">
						<b><?php echo $company['phone'];?><b>
					</td>
				</tr>
				<tr>
					<td colspan ="2">
						<b>GSTIN : <?php echo $company['tin'];?><b>
					</td>
					
				</tr>
				<tr>
					
					<td colspan ="2">
						<b>State ,Code : <?php echo $company['statename'].','.$company['statecode'];?><b>
					</td>
				</tr>
			 </table>
		</div>
		<div class="clsdiv40" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
			<table class="" style="padding: 1px;;  margin: 0px; width: 100%;">
				<tr>
					<td style ="font-size:10px;" colspan ="2">
						<b>To , </b>
					</td>
				</tr>
				<tr>
					<td style ="font-size:10px;" colspan ="2">
						<b>	<?php if ($sales[0]['customer_id']==0){ echo $sales[0]['cusname'] ;if($sales[0]['cusname'] == null || $sales[0]['cusname'] ==''){echo 'Cash';}}else{echo $sales[0]['name'] ;}?> </b>
					</td>
				</tr>
				<tr>
					<td style ="font-size:10px;"  colspan ="2">
						<b>	Address : <?php echo $sales[0]['cusdetails'] ?> </b>
					</td>
				</tr>
				<tr>
					<td style ="font-size:10px;" colspan ="2">
						<b>	Phone : <?php echo $sales[0]['phone'] ?> </b>
					</td>
				</tr>
				<tr>
					<td style ="font-size:10px;" colspan ="2">
						<b>	GSTIN : <?php echo $sales[0]['tin'] ?> </b>
					</td>
					
				</tr>
				<tr>
					<td style ="font-size:10px;" colspan ="1">
						<b><br /> <?php if(strlen ($sales[0]['StateName']) > 0  ){echo 'State ,Code :'. $sales[0]['StateName'].','.$sales[0]['statecode'];}else {echo 'State ,Code :'. $company['statename'].','.$company['statecode'];}?><b>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="width:100%;padding:0px; margin: 0px; ">
		<div class="cls50sub" style="font-size:12px;padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
			<b> Invoice No : <?php echo $sales[0]['invoice'];?><br />
			Date : <?php echo $sales[0]['in_date'];?><br /></b>
		</div>
		<div class="cls10sub" style="font-size:12px;padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
		    <b>    <?php echo strtoupper ($sales[0]['saletype']);?><br /></b> 
		</div>
		<div class="cls40sub" style="font-size:12px;padding: 0px;padding-left:10px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
		  <b>    Sales Man : <?php echo $sales[0]['salesmanname'];?><br />
						 Route : <?php echo $sales[0]['areaname'];?><br /></b> 
		</div>
	</div>
	

    <div style="padding: 0px; margin: 0px;">  
	   
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 20px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th  class="center" style="width: 65px;  text-align: center"><?= label(strtoupper('Hsncode'), $this, $user) ?></th>
			  <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label(strtoupper ('Description Of Goods'), $this, $user) ?></th>
				<th class="center" style="width: 63px;  text-align: center"><?= label(strtoupper('Mrp '), $this, $user) ?></th>
                <th class="center" style="width: 63px;  text-align: center"><?= label('Base RATE ', $this, $user) ?></th>
			  <th  class="center" style="width: 50px;  text-align: center"><?= label(strtoupper('UOM'), $this, $user) ?></th>
				  <th class="center" style="width: 45px;  text-align: center"><?= label('Tax %', $this, $user) ?></th>
				 
			   <th  class="center" style="width: 50px;  text-align: center"><?= label(strtoupper('Qty'), $this, $user) ?></th>
			   <th  class="center" style="width: 50px;  text-align: center"><?= label(strtoupper('FOC'), $this, $user) ?></th>
				<th class="center" style="width: 45px;  text-align: center"><?= label('Net Rate', $this, $user) ?></th>
				  <!--  <th class="center" style="width: 45px;  text-align: center"><?= label('CGST ', $this, $user) ?></th>
				    <th class="center" style="width: 45px;  text-align: center"><?= label('SGST Rate ', $this, $user) ?></th>
				  <th class="center" style="width: 45px;  text-align: center"><?= label('SGST ', $this, $user) ?></th>
                 --> <th class="center" style="width: 60px;  text-align: center"><?= label('TOTAL', $this, $user) ?></th>

            </tr>

            <?php
            $qty = 0;
            $total = 0;
            $totdis = 0;
            $txamt = $gtoamt = 0;
            $netamt = 0;
            $i = $len;
            $bftax = 0;
			$totrawces = 0 ;
			$taxable_value = 0 ;
            foreach ($sales_items as $item) {
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
				$item_srate = $item['mrp'];
				$rate = $item['mrp'];
				$per = 0;
				if((float) $item['GST'] > 0 ){
					$per = (float) $per + (float) $item['GST'];
				}
				//if( $sales[0]['saletype'] ==  'b2c' ){
				if((float) $sales[0]['cess'] > 0 ){
					$per = (float) $per + $item['ces'];
				}
				//}
				if( $sales[0]['saletype'] ==  'b2b' && (float) $sales[0]['cess'] > 0 ){
					if((float) $item['ces'] > 0 ){
						$item_srate = $item_srate - (($item_srate*$item['ces'])/100);
					}
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
				$cig_ces_amt = 0 ;
				$cig = 0;
				
				
                ?>
                <tr>
                    <td> <?php echo $i;?></td>
                    <td class="center"> <?php echo $item['hsncd']; ?></td>
                    <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
					<td class="center"> <?php echo number_format($item['MRP'], 2); ?></td> 
                    <td class="center"> <?php echo number_format($rate, 2); ?></td> 
					<td class="center"> <?php echo $item['uname']; ?></td>
					<td class="center"> <?php echo $item['GST']; ?></td>
					
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
                    <td class="center"> <?php echo number_format($item['free_quantity'], 2); ?></td>
					<?php if((float) $item['total'] > 0 && (float)$item['quantity'] > 0 ) {?>
						<td class="center"> <?php echo number_format((float) $item['total']/(float)$item['quantity'] + $cig , 2); ?></td>
					<?php } else{?>
						<td class="center"> <?php echo number_format(0 , 2); ?></td>
					<?php } ?>
					<!--<td class="center"> <?php //echo number_format($item['tax']/2, 2); ?>  </td> 
					<td class="center"> <?php //echo $item['cgst']; ?></td>
					<td class="center"> <?php //echo number_format($item['tax']/2, 2); ?>  </td> -->
					<?php if((int) $item['is_taxincluded'] > 0 && $sales[0]['saletype'] == 'b2b' ){?>
						<td class="center"> <?php echo number_format($item['total'] , 2); ?></td>
					<?php } else{?>
						<td class="center"> <?php echo number_format($item['total'] , 2); ?></td>
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
					<!--<td> </td>
					<td> </td>
					<td> </td>-->
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
                <th style="text-transform: capitalize;"> <?php if ($inc == ($cpz + 1)) { ?> Total<?php } ?></th>
                <th class="left"></th>
                <th class="left"> </th>
				 <th class="left"> </th>
				 <th class="left"> </th>
				<th class="left"> </th>
				<th class="left"> </th>
				<th class="left"> <?php  //echo number_format($qty, 2); ?></th>  
                <th class="left"> <?php //echo number_format($taxable_value, 2); ?></th>
				<!--<th class="left"><?php echo  number_format($txamt/2,2); ?> </th> 
				<th class="left"> </th>
              <th class="left"><?php echo  number_format($txamt/2,2); ?> </th> -->
                <th class="left"> <?php if ($inc == ($cpz + 1)) { ?><?php echo number_format(($sales[0]['total']  - $sales[0]['roundoff']), 2); ?><?php } ?></th>
				
            </tr>
        </table>
     
        <?php if ($inc != ($cpz + 1)) { ?> 
            <table>
                <?php
                for ($i = 0; $i < 5; $i++) {
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
                    </tr>

                <?php } ?> 
            </table>
        <?php } ?>

        <?php if ($inc == ($cpz + 1)) { ?> 
            <div style="width:100%;padding:0px; margin: 0px; ">
				<div class="clsdiv40s" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
					<table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
						<tr>
							<td style="font-size:10px;">
								<b>
								<?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?>, <br />
								<?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> <br />
								<?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?><br />
								</b>
							</td>
						</tr>
						

					</table>
					<table   class=" maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
					<tr>
							<td style="font-size:8px;"><b> Certified That the  particulers given above are true and correct</b></td>
					</tr>
					<tr>
						<td style="padding-top: 20px;height:0px;text-align:center;font-size:12px;"><b> <?php echo $company['name'];?></b></td>
					</tr>
					<tr>
						<td style="padding-top: 20px;height:20px;font-size:10px;"><b> E&O .E &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorised Signatory</td>
					</tr>
					</table>
				</div>
				<!--<div class="clsdiv20" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
					<table   class=" maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
						<tr>
							<td style="padding-top:80px;text-align:center;height:20px;font-size:10px;"><b> (Seal)</td>
						</tr>
					</table>
				</div>-->
				<div class="clsdiv38s" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
					<table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
						<tr>
							<th style="width:25%">Taxable</th>
							<th style="width:25%">Tax%</th>
							<th style="width:25%">Tax</th>
							<th style="width:25%">Cess</th>
						</tr>
						<?php $Taxable = 0 ;$tax_tot = $ces_amt =  0; foreach($new_taxparticulars as $item){
							$tax_tot = (float) $tax_tot + (float) $item['total'] ;
							$ces_amt = (float) $ces_amt + (float) $item['ces_amt'];
							$Taxable  = (float) $Taxable  + (float) $item['tax'];
						?>
							<tr>
								<td style="width:25%"><?php echo $item['total'];?></td>
								<td style="width:25%"><?php echo $item['GST'];?></td>
								<td style="width:25%"><?php echo $item['tax'];?></td>
								<td style="width:25%"><?php echo $item['ces_amt'];?></td>
							</tr>
						<?php } ?>
						<tr>
							<th style="width:25%"><?php echo round($tax_tot,2);?></th>
							<th style="width:25%"></th>
							<th style="width:25%"><?php echo round($Taxable,2);?></th>
							<th style="width:25%"><?php echo number_format(round($ces_amt,2),2);?></th>
						</tr>
					</table>
				</div>
				<div class="clsdiv25s" style="padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
					<table   class=""  style="width:100%;  padding:0px;  margin: 0px;" border="0">
						<?php $wi = '45px';?>
						
					
						<tr >
							<td style="padding-top:<?php echo $wi;?>;">Round Off</td>
							<td style="padding-top:<?php echo $wi;?>;">:</td>
							<td style="padding-top:<?php echo $wi;?>;"><?php echo $sales[0]['roundoff'];?></td>
						</tr>
						
						<tr>
							<th>Grand Total</th>
							<th>:</th>
							<th><?php echo $sales[0]['total'];?></th>
						</tr>
						<tr >
							<td style="">C/F</td>
							<td style="">:</td>
							<td style=""><?php echo $sales[0]['previous'];?></td>
						</tr>
						<tr >
							<th style="">Net Payable</th>
							<th style="">:</th>
							<th style=""><?php echo $sales[0]['gtot'];?></th>
						</tr>
					</table>
				</div>
			</div>
		<!--	<table style="padding:0px;  margin: 0px;  width:100%; ">
				<tr>
					<td><b>Your Saving is Rs.<?php echo round($sales[0]['saved'],2);?></b> </td>
					<td style="text-align:right"><?php echo $msd;?> </td>
				</tr>
			</table>-->

        <?php } ?>
        <hr class="" style="border: solid 1px #222; "/> 
       <!--<table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
            
            <tr>
                <td  style="font-size:8px; text-align: center ">**<?= label('This is a Computer Generated Invoice', $this, $user) ?>**</td>
            </tr>
            <tr>
                <td  style="font-size:10px; text-align: center "><?php echo $inc . '-' . number_format($cpz + 1); ?></td>

            </tr>
        </table> -->
    </div>
</body>
</html>

