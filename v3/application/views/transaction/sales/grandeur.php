<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '140px'; //if discont is 0
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
$user = '';
$language = $this->language;
$Footer_Terms = 'NO';
$Footer_Bank_details = 'NO';
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
                background-color:rgb(51, 103, 214);
				color : white;
				height:30px;
            }
            tr td {
                font-size: 12px;
            }
            .center{
                text-align: right;
				width:60px;
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
            
            .txtcenter {
                text-align: right;
            }
            .cls33 span{
                width: 100%;
                text-align: center;
                background-color: #aaa;
            }
            body{
                border-color :black;
                border :1px solid;
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
			.tditem{
				width: 250px;
			}
			.td_customer{
				border-top :solid 1px #222;
				border-right: solid 1px #222;
				padding:0px;
			}
			.td_customer_noborder{
				border-right: solid 1px #222;
				padding-bottom:40px;
				padding:0px;
				text-align:right;
			}
			.tdmain{
				background-color:rgb(51, 103, 214);
				font-color : white;
				height:30px;
			}
			
        </style>
    </head>
    <body style="  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
		<div style="padding: 0px; margin: 0px; border: solid 1px #222;">
			<table style = "width:100%">
				<tr>
					<td style = "width:50%;align:left" >
						<?php if($company['logo']!=""){?>
							<img align="middle"  style="margin: 0px" width="100px" height="100px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
						<?php }else{ echo '&nbsp;';}?>
					</td>
					<td style = "width:50%;text-align:right" >
							<h2 style ="font-size:16px;text-align:right" ><?php echo $company['name'] ?> </h2>
							<p style ="font-size:14px;text-align:right"><br/> 
							<?php echo $company['address']; ?><br />
							
								GSTIN.:<?php echo $company['tin'] ?> State: 32-Kerala<br/> 
							</p>  
					</td>
				</tr>
			</table>
          



    <div style="padding: 0px; margin: 0px;">  
		 <table  class="mt "  style = "width:100%;padding:0px;">
				<tr>
					<td style="color:white" class ="tdmain" ><font style ="font-weight:bold;color:white !important;" >Bill To</font></td>
					<td></td>
				</tr>
				<tr>
					<td class ="td_customer"  style = "width:50%;height: 80px;padding:0px;padding-left:5px;">
						<font style ="font-size:15px;font-weight:bold;">
							<?php 
						
							if ($sales[0]['customer_id']==0){
								echo $sales[0]['cusname'] ;
								if($sales[0]['cusname'] == '' ){
									echo 'Cash';
									}
							}
							else{
                              echo $sales[0]['name'] ;
							}
							
							?>
						</font>
						<font style ="font-size:14px;padding:5px;">

						<?php
								if($sales[0]['address_line1'] != '' && $sales[0]['address_line1'] != null){
									echo '<br />'.$sales[0]['address_line1'];
								}
						?>
						
						<?php
								if($sales[0]['phone'] != '' && $sales[0]['phone'] != null){
									echo '<br />'.$sales[0]['phone'];
								}
						?>
						
						<?php
								if($sales[0]['email'] != '' && $sales[0]['email'] != null){
									echo '<br />'.$sales[0]['email'];
								}
						?>
						
						<?php
								if($sales[0]['tin'] != '' && $sales[0]['tin'] != null){
									echo '<br />GSTIN:'.$sales[0]['tin'];
								}
						?>
						</font>
					</td>
					<td style ="font-size:16px" rowspan ="2" class ="td_customer_noborder" style = "width:50%">
							<font style ="font-weight:bold;padding-bottom:30px;" >Invoice No -: <?php echo $sales[0]['invoice'] ?> <br />
							Date -: <?php echo $sales[0]['invoice_date'] ?> </font>
							
					</td>
				</tr>
		   </table>
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
			<tr class="topbr" >
				<th style="width:10px;  text-align: center"><?= label('#', $this, $user) ?></th>
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
					  <td style ="height:30px;" > <?php echo $i; ?></td>
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
					<?php if($items->Field == 'taxpercentage' ){ $taxpercentage = $item['GST']; if((float)$item['GST'] > 0 ){$taxpercentage = $item['GST']/2;} }?>
						 
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						  <td style="" class="center"> <?php echo number_format($item['tax']/2, 2); ?> (<font style ="font-size:9px;" ><?php echo $taxpercentage;?>%)</font>  </td>  
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($item['tax']/2, 2); ?>(<?php echo $taxpercentage;?>%)   </td>  
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
					  <td style ="height:30px;"> &nbsp;</td>
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
			<tr style ="height:30px;">
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
                    <td style ="height:30px;">&nbsp; </td>
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
        
            
	
           
        <?php } ?>
		
		<div class ="cls50" style ="height:200px;border:1px solid black;">
			<div style="padding: 0px; margin: 0px;">
				<table style = "font-size:10px;width:100%">
					<tr >
						<th rowspan="2" style="width:25%">Taxable Amount</th>
						<th colspan="2" style="width:27%">CGST</th>
						<th colspan="2" style="width:27%">SGST</th>
						<th rowspan="2" style="width:21%">Tax Amount</th>
					</tr>
					<tr >
						<th style="width:10%">Rate</th>
						<th  style="width:15%">Amount</th>
						<th style="width:10%">Rate</th>
						<th  style="width:15%">Amount</th>
					</tr>
					<?php foreach($taxparticulars as $tax){?>
						<tr >
							<td style="text-align:right;width:25%"><?php echo $tax['taxable'];?></td>
							<td style="text-align:center;width:10%"><?php echo $tax['GST']/2;?></td>
							<td  style="text-align:right;width:15%"><?php echo $tax['total']/2;?></td>
							<td style="text-align:center;width:10%"><?php echo $tax['GST']/2;?></td>
							<td  style="text-align:right;width:15%"><?php echo $tax['total']/2;?></td>
							<td  style="text-align:right;width:21%"><?php echo $tax['total'];?></td>
						</tr>
					<?php } ?>
				</table>
			</div>
		</div>
		<div class ="cls48" style ="height:200px;border-left:1px solid black;">
			<table style = "font-size:10px;width:100%">
					<tr >
						<th colspan="2" style="height:60px;width:100%">Amounts</th>
					</tr>
					<tr >
						<td  style="width:50%">Sub Total</td>
						<td  style="width:50%;text-align:right"><?php echo $sales[0]['total']-$sales[0]['roundoff']; ?></td>
					</tr>
					<tr >
						<td  style="width:50%">Round Off</td>
						<td  style="width:50%;text-align:right"><?php echo $sales[0]['roundoff']; ?></td>
					</tr>
					<tr >
						<td colspan="2" style="width:100%"><hr/></td>
					</tr>
					<tr >
						<td  style="width:50%">Total</td>
						<td  style="width:50%;text-align:right"><?php echo $sales[0]['total']; ?></td>
					</tr>
				</table>
		</div>
		<div class ="cls50" style ="height:200px;border:1px solid black;">
			<div style="padding: 0px; margin: 0px;">
				<table style = "font-size:10px;width:100%">
					<tr >
						<th colspan="2" style="width:100%;text-align:center">Invoice Amounts in Words</th>
					</tr>
					<tr>
						<td colspan="2" style="width:100%;text-align:center">
							<?php echo $msd; ?> 
						</td>
					</tr>
					<tr >
						<th colspan="2" style="width:100%;text-align:left">Bank Details:</th>
					</tr>
					<tr>
						<td colspan="2" style="width:100%;text-align:left">
							<?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?><br />
							  <?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> <br />
							   <?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?>
						</td>
					
					<tr >
						<th colspan="2" style="width:100%;text-align:left">Terms and conditions:</th>
					</tr>
					<tr>
						<td colspan="2" style="width:100%;text-align:left">
							Please Aknowledge the delivery and quality of the goods.
Declaration:
We declare that this invoice shows the actual price of the goods described
and that all particulars are true and Currect.
Thanks for doing business with us!
						</td>
					</tr>
					
				</table>
			</div>
		</div>
         <div class ="cls48" style ="height:200px;border:1px solid black;border-bottom:0px;">
			<div style="padding: 0px; margin: 0px;">
				<table style = "font-size:10px;width:100%">
					
					<tr >
						<th  style="text-align:center;height:30px;width:100%;">Authorized Signatory</th>
					</tr>
					<tr>
						<td  style="text-align:center;height:70px;width:100%;border-bottom:1px solid black;"></td>
					</tr>
					<tr >
						<th  style="text-align:center;height:30px;width:100%;">Receieved By</th>
					</tr>
				</table>
			</div>
		</div>
    </div>
</div>
</body>
</html>

