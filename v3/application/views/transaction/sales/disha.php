<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '335px'; //if discont is 0
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
				height:140px !important;
			}
			.clsdiv30{
				width : 30% !important;
				border :1px solid black;
				height:110px !important;
			}
			.clsdiv40{
				width : 40% !important;
				height:140px !important;
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
						<b>State ,Code : <b>
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
		  <b>    Sales Man : <?php //echo $sales[0]['salesmanname'];?><br />
						 Route : <?php //echo $sales[0]['areaname'];?><br /></b> 
		</div>
	</div>
	

    <div style="padding: 0px; margin: 0px;">  
		    <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
			<tr class="topbr" >
				<th style="width:10px;  text-align: center"><?= label('SNo', $this, $user) ?></th>
				<?php $i =0;foreach($print_settings as $items){ $i++; ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
				<?php } ?>
			</tr>
        

            <?php
            $qty =0;
            $total = 0;
            $totdis = 0;
            $txamt = $gtoamt = 0;
            $netamt = 0;
            $i = $len;
            $bftax = 0;
			$tot_itm_raw_ces = 0;
            foreach ($sales_items as $item) {
				$tot_itm_raw_ces = (float) $tot_itm_raw_ces + (float) $item['itm_raw_ces'];
                $total = $total + $item['total'];
                $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                $totdis = $totdis + $discount;
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total'] - $item['tax']);
                $qty =$qty+$item['quantity'];
                $i = $i + 1;
				
				$rate = $item['mrp'];
				$per = 0;
				if((float) $item['GST'] > 0 ){
					$per = (float) $per + (float) $item['GST'];
				}
				if((float) $sales[0]['saletype'] ==  'b2c' && (float) $sales[0]['cess'] > 0  ){
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
					  <?php foreach($print_settings as $items){  ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <td style="text-transform: capitalize;"> <?php echo $item['barcode']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo $item['hsncd']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($item['MRP'], 2); ?></td> 
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($rate, 2); ?></td> 
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo round($discount, 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo round($item['total'] - $item['tax'], 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($item['GST'], 2); ?>  </td> 
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						  <td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td>  
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td>  
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($item['itm_raw_ces'], 2); ?>  </td>  
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
					<?php } ?>
				<?php } ?>
				</tr>
            <?php }
            ?>

            <?php
            if ($i==$size){
                $len=0;
            }else if ($i<$size){
                 $len =$size -$i;
            }else{
                $len =$size -($i-$size);
            }
            
            for ($k = 0; $k < $len; $k++) {
                ?> 
        <tr>
					  <td> &nbsp;</td>
					  <?php foreach($print_settings as $items){  ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <td class="center">   </td>  
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
				<?php } ?>
				</tr>
            <?php } ?> 
			
			<?php if ($inc == ($cpz + 1)) { ?> 
			<tr>
				 <th> &nbsp;</th>
			 <?php foreach($print_settings as $items){  ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						 <th class="center"> <?php echo number_format($qty, 2); ?></th>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						 <th class="center"> <?php echo number_format($totdis, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						 <th class="center"><?php echo number_format($sales[0]['total'] + $sales[0]['discount'] - $sales[0]['tax'], 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						<?php if($sales[0]['tax'] > 0 ) { ?>
							<th class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
						<?php }else{ ?>
							<th class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if($sales[0]['tax'] > 0 ) { ?>
							<th class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
						<?php }else{ ?>
							<th class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <th class="center"> <?php echo number_format($tot_itm_raw_ces, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <th class="center"><?php echo number_format(($sales[0]['total'] + $sales[0]['discount']), 2); ?> </th>
					<?php } ?>
				<?php } ?>
				<tr>
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
                        <td><b><?= label('Amount in Words', $this, $user) ?> :<?php echo $msd; ?></b> </td> 
                    </tr>
                   
                    <tr>
                        <td><?= label('Previous Balance', $this, $user) ?> :<?php echo  $sales[0]['previous']; ?></td> 
                    </tr>
                    <tr>
                        <td><?= label('Total Outstanding', $this, $user) ?> :<?php echo $sales[0]['gtot']; ?></td> 
                    </tr>
                </table>
            </div>

            <div class="cls50">
                <table style="padding: 2px; font-weight: bold; margin: 0px; width: 100%; text-align:<?= $dir ?>">
                 <!--   <tr>
                        <td ><?= label('Bill Total', $this, $user) ?>:</td>
                        <td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($gst[0]['tot'], 2); ?> </b></td>  
                    </tr>
                    <tr>
                        <td><?= label('Discount', $this, $user) ?>  :</td>                      
                        <td style="text-align: <?= $ar ?>; "><b><?php echo number_format($gst[0]['dis_amt'], 2); ?> </b></td>  
                    </tr>
                   
                  
		 <?php if ($sales[0]['adjustment'] > 0) { ?>
		    <tr>
                        <td><?= label('Exchange Amount', $this, $user) ?>  :</td>
                        <td style="text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['adjustment'], 2) ?> </b></td>  
                    </tr>
                    <?php } ?>
                    <tr>
                        <td><?= label('Net Amount', $this, $user) ?>  :</td>
                        <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;text-decoration: underline"><?php echo number_format($sales[0]['total']-$sales[0]['adjustment'], 2) ?> </b></td>  

                    </tr>-->
					 <?php foreach($footer_settings as $items){  ?>
						<?php if($items->Field == 'Before_Tax' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['discount'] + $sales[0]['total']-$sales[0]['tax'] -$sales[0]['cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax']/2, 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax']/2, 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Total_tax' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Item_cess' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['additional_cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'KFC' && $items->Isvisible == 'YES' && $sales[0]['cess'] > 0 ){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'total_Before_Discount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['total'] + $sales[0]['discount']-$sales[0]['roundoff'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Bill_discount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['discount'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Exchange_Amount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['adjustment'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'round_off' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['roundoff'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Bill_total' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:35%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['total'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Terms' && $items->Isvisible == 'YES'){$Footer_Terms ='YES';}?>
						<?php if($items->Field == 'Bank_details' && $items->Isvisible == 'YES'){$Footer_Bank_details ='YES';}?>
					 <?php } ?>
                </table>

            </div>
        </div>
		<?php if($Footer_Terms== 'YES'){?>
        
		<?php } ?>
        <br/>
        <br/>
       
           

           
        <?php } ?>
         <hr style="border: solid 1px #222; "/> 
		 <?php if($Footer_Bank_details == 'YES'){?>
           <!-- <table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
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
                <td  style="font-size:10px; text-align: center "><?php echo  $inc.'-'.number_format($cpz + 1); ?></td>

                </tr>
            </table> -->
		 <?php } ?>
    </div>
</body>
</html>

