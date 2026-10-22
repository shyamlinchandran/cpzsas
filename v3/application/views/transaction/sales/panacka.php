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
$login_comid = $this->session->userdata('login_base_comid');
$order = 'Estimate';
if ($login_comid == 'rjd') { 

	$order = 'Quotation';
}

$com = substr($company['comset_statecode'], 0, 2);
$com = 32;
$statecode = $sales[0]['statecode'];
if ($statecode == '' || $statecode == null) {
	$cust = $com;
} else {
	$cust = $statecode;
}






?>
<html>

<head>
	<meta charset="UTF-8">
	<title></title>
	<style>
		body {
			font-family: sans-serif;
		}

		div {
			margin: 0px !important;
			padding: 0px !important;
		}

		.valtb {
			padding: 0px;
			margin: 0px;
			width: 100%;
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

		.center {
			text-align: right;
			width: 60px;
		}

		.spec th {
			font-weight: bold;
			font-size: 12px;
			height: 15px;

		}

		.Bold {
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

		.mt,
		.mt tr:first-child,
		.mt tr:first-child td {
			border: 1px solid #ddd;
			padding-right: 1px !important;
		}

		<?php if ($this->session->userdata('login_base_comid') != 'antraders') { ?>.maintable tr:nth-child(odd) {
			background: #eee
		}

		.maintable td {}

		<?php } ?>.mt,
		.mt td {
			border-right: 1px solid #ddd;
			padding-right: 2px !important;
			padding-left: 2px !important;
			border-collapse: collapse;
		}

		.topbr th {
			border: 1px solid #ddd;
		}

		.mt th {
			border-top: 1px solid #ddd;
			font-size: 12px;
			height: 12px;
		}

		.valtb td {
			font-size: 14px;
			font-weight: bold;
		}

		.right {
			text-align: right;
			padding-right: 30px;
		}

		.cls33 {
			width: 36%;
			/*                background-color: #aaa;  */
			float: left;
			font-size: 13px;
			font-family: sans-serif;


		}

		.cls34 {
			width: 20%;
			/*                background-color: #aaa;  */
			float: left;
			font-size: 13px;
			font-family: sans-serif;


		}

		.cls20 {
			width: 25%;
			/*                background-color: #aaa;  */
			/* float: left; */
			font-size: 13px;
			text-align: right;
			font-family: sans-serif;
		}

		.cls50 {
			width: 50%;
			/*                background-color: #aaa;  */
			float: left;
			font-size: 13px;
			font-family: sans-serif;
		}

		<?php if ($language == 'ac') { ?>.txtright {
			text-align: right;
		}

		.txtleft {
			text-align: left;
		}

		<?php } else if ($language != 'ac') { ?>.txtright {
			text-align: right;
		}

		.txtleft {
			text-align: left;
		}

		<?php } ?>.txtcenter {
			text-align: center;
		}

		.cls33 span {
			width: 100%;
			text-align: center;
			background-color: #aaa;
		}

		body {
			border-color: #000;
			border: solid;
		}

		.hedrnd {
			background-color: #fff;
			border-radius: 10px;
			height: 140px;
		}

		.hedrnd p {
			padding-left: 10px;
		}

		.mainhead p {
			text-align: center;
			font-size: 15px;
			text-transform: uppercase;
			font-weight: bold;
			color: #000;
			text-decoration: underline;
			vertical-align: top;
			padding: 0px;
			margin: 0px;
		}

		.mainborder {
			border: 2px solid #8c8c8c;
			/* padding-right: 2px !important;
			padding-left: 2px !important; */
			border-collapse: collapse;
		}


		.cls33 h2 {
			padding-left: 10px;
			padding-top: 10px;
		}

		.cls50 h3 {
			padding-left: 10px;
		}

		.cls50 p {
			padding: 0px;
			margin: 0px;
		}

		.tditem {
			width: 250px;
		}

		.clsdiv20 {
			width: 19% !important;
			border: 1px solid black;
			height: 130px !important;
		}

		.clsdiv30 {
			width: 30% !important;
			border: 1px solid black;
			height: 110px !important;
		}

		.clsdiv40 {
			width: 40% !important;
			height: 130px !important;
			border: 1px solid black;
		}

		.clsdiv38 {
			width: 38% !important;
			height: 110px !important;
			border: 1px solid black;
		}

		.clsdiv25 {
			width: 20.6% !important;
			height: 110px !important;
			border: 1px solid black;
		}

		.clsdiv40s {
			width: 40% !important;
			height: 125px !important;
			border: 1px solid black;
		}

		.clsdiv38s {
			width: 38% !important;
			height: 125px !important;
			border: 1px solid black;
		}

		.clsdiv25s {
			width: 20.6% !important;
			height: 125px !important;
			border: 1px solid black;
		}

		.cls50sub {
			width: 50% !important;
			border-left: 1px solid black;
		}

		.cls40sub {
			width: 33% !important;
			border-right: 1px solid black;
		}

		.cls10sub {
			width: 15% !important;
		}

		.ptax {
			margin: 0
		}
		.head-member img {
            width: 100px;
            height: 100px;
            border-radius: 10px;
            object-fit: cover;
        }
	</style>
</head>

<body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
			<p style="padding:0px;margin:0px;font-weight:bold;text-align:center">
				<?php if ($sales[0]['stype'] != 'estimate' && $sales[0]['stype'] != 'sales_return') { ?> Tax Invoice <?php } else if ($sales[0]['stype'] == 'estimate') { ?> Estimate <?php } else {
																																														echo 'Credit Note';
																																													} ?>
			</p>
	<div class="mainborder">
		<table style="border-bottom: 1px solid #8c8c8c;">
			<tr>
				<!-- <td style="width:4%;"></td> -->
				<!-- <td colspan="2" style="width:13%;border-right: 1px solid #b3b3b3">
					<img align="middle"  style="margin: 0px" width="100px;" height="100px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
			    </td> -->
				<td style="padding: 0;padding-left:100px;padding-right:100px">
					<table>
						<tr>
							<td style="font-size:18px;font-weight:bold;text-align:center;"><?php echo $company['name'] ?></td>
						</tr>
						<tr>
							<td style="font-size:12px;text-align:center"><?php echo $company['address'] ?> ,
								<?php echo $company['phone'] ?><br />
								GST No : <?php echo $company['tin'] ?> <br />
							</td>
						</tr>
					</table>
				</td>
				<!-- <td colspan="2" style="border: 1px solid #ddd;"></td> -->
			</tr>
		</table>
		

		<div class="mainhead" style="padding: 0px; margin: 0px; text-align:center; font-weight: bold;">
			
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
		<!-- style="border: 1px solid black; width: 70%;" -->
		<div style="width:100%;padding:0px; margin: 0px; border: 1px solid #ddd;">
			<div class="cls33 txtleft" style="height:145px;padding: 0px; margin: 0px; border-right: 2px solid #d9d9d9;text-align: <?= $al ?>; float: <?= $al ?>;">

				<p style="padding: 0px;padding-left:5px; ">
					<font style="font-size:12px;">
						<b><?= label('Bill To,', $this, $user) ?></b><br />
						<?php echo $sales[0]['customername'] 
						?><br />
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
							if ($sales[0]['tin'] != '')
								echo 'Gst No :' . $sales[0]['tin'];
						}
						?>
					</font>
				</p>

			</div>
			<div class="cls33 " style="height:145px;padding: 0px;padding-left: 4px; margin: 0px; text-align:left; border-right: 2px solid #d9d9d9; float: <?= $al ?>">

				<p style="padding: 0px; padding-left:5px;">
					<font style="font-size:12px;">
						<b><?= label('Ship To,', $this, $user) ?></b><br />
						<?php if ($sales[0]['con_name'] != '') {
							echo $sales[0]['con_name'];
						} else {
							if ($sales[0]['customer_id'] == 0) {
								echo $sales[0]['cusname'];
							} else {
								echo $sales[0]['name'];
							}
						} ?><br />
						<?php if ($sales[0]['con_addr'] != '') {
							echo $sales[0]['con_addr'];
						} else {
							echo $sales[0]['address_line1'];
						} ?><br />
						GSTIN :<?php echo $sales[0]['tin']; ?><br />
						Phone <?php echo $sales[0]['phone']; ?><br />
					</font>
				</p>

			</div>
			<div class="cls20" style="height:145px;padding: 0px; margin: 0px; text-align: left; ">
				<p dir="<?= $ms ?>" style="padding: 0px;font-size:12px ;padding-left:5px"><b><?= label('INV NO', $this, $user) ?>:<?php echo $sales[0]['invoice'] ?></b><br />
					<?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] ?>
					<br />
					<?= label('Salesman', $this, $user) ?> :<?php echo $sales[0]['salesmanname'] ?>

					<?php if ($sales[0]['remarks'] != '') { ?>
						<br />
						<?= label('Remarks', $this, $user) ?> :<?php echo $sales[0]['remarks'] ?>
					<?php } ?>
					<br />
					<?= label('Prepared by', $this, $user) ?> :<?php echo $sales[0]['user_name'] ?>
					<?php if($sales[0]['ewb_no'] != ''){?>
							<br />
							<?= label('Eway Bill No ', $this, $user) ?> :<?php echo $sales[0]['ewb_no'] ?>
						<br />
							<?= label('Eway Bill Date ', $this, $user) ?> :<?php echo $sales[0]['ewb_details'] ?>
					<?php }?>
						<?php if($sales[0]['vehicle_no'] !=''){ echo '<br />Vehicle No : '.$sales[0]['vehicle_no'];?> <?php } ?>
				<?php if($sales[0]['vehicle_no'] !=''){ echo '<br />Mode of Transport  : '.$sales[0]['transport_mode'];?> <?php } ?>
				<?php if($sales[0]['ref_no'] !=''){ echo '<br />Ref no : '.$sales[0]['ref_no'];?> <?php } ?>	
				</p>
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
						<th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label('Alt.Qty', $this, $user) ?></th>

						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'unit' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'free_quantity' && $items->Isvisible == 'YES'){?>
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
						<?php if((int) $com == (int)$cust){?>
							<th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
						<?php }else{ ?>
							<th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label('IGST ', $this, $user) ?></th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <!-- <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th> -->
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
						<td class="center"> <?php echo number_format($item['unit_qty'], 2); ?> </td>
						<td class="center"> <?php echo number_format($item['quantity'], 2); ?>   <?php echo $item['ucode']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'unit' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo $item['ucode']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'free_quantity' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($item['free_quantity'], 2); ?></td>
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
						<?php if((int) $com == (int)$cust){?>
							<td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td>  
						  <?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
						 <td class="center"> <?php echo number_format($item['tax']/2, 2); ?>  </td>  
						 <?php } else{?>
						 <td class="center"> <?php echo number_format($item['tax'], 2); ?>  </td>  
						 <?php } ?>
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


<?php if ($inc == ($cpz + 1)) { ?> 
				<?php $sales_ledgers = $sales_ledgers->result_array(); $sales_ledger_cnt = 0 ;foreach($sales_ledgers as $sa) { $sales_ledger_cnt++ ;?>
					<tr>
					  <td> <?php echo ''; ?></td>
					  <?php foreach($print_settings as $items){  ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <td style="text-transform: capitalize;"> <b>&nbsp;&nbsp;<?php echo $sa['name']; ?></b></td>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <td style="text-transform: capitalize;"> <?php //echo $item['barcode']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo $item['hsncd']; ?></td>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format(1, 2); ?></td>
					<?php } ?>
					<?php if($items->Field == 'unit' && $items->Isvisible == 'YES'){?>
						<td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'free_quantity' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo number_format($item['free_quantity'], 2); ?></td>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($sa['amount'], 2); ?></td> 
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php echo number_format($sa['amount'], 2); ?></td> 
					<?php } ?>
					<?php if($items->Field == 'gross_amt' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo round($discount, 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'discount_per' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo round($discount, 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo round($discount, 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						<td class="center"> <?php //echo round($sales[0]['bef'], 2); ?></td>  
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php  echo number_format($sa['GST'], 2); ?>  </td> 
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<td class="center"> <?php echo number_format($sa['tax']/2, 2); ?>  </td>  
						  <?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
						 <td class="center"> <?php echo number_format($sa['tax']/2, 2); ?>  </td>  
						 <?php } else{?>
						 <td class="center"> <?php echo number_format($sa['tax'], 2); ?>  </td>  
						 <?php } ?>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php //echo number_format($item['itm_raw_ces'], 2); ?>  </td>  
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <td class="center"> <?php echo number_format($sa['amount'] + $sa['tax'], 2); ?></td>
					<?php } ?>
				<?php } ?>
				</tr>
				<?php } ?>
				<?php }?>

				
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
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'unit' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'free_quantity' && $items->Isvisible == 'YES'){?>
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
						<?php if((int) $com == (int)$cust){?>
						 <td class="center"> </td>
						<?php } ?>
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
						  <th class="center"> </th>
						 <th class="center"> <?php echo number_format($qty, 2); ?></th>
					<?php } ?>
					<?php if($items->Field == 'unit' && $items->Isvisible == 'YES'){?>
						 <td class="center"> </td>
					<?php } ?>
					<?php if($items->Field == 'free_quantity' && $items->Isvisible == 'YES'){?>
						 <th class="center"> <?php echo ''; ?></th>
					<?php } ?>
					<?php if($items->Field == 'MRP' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'Rate' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'discount' && $items->Isvisible == 'YES'){?>
						 <th style = "text-align:right" class="center"> <?php echo number_format($totdis, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						 <th style = "text-align:right" class="center"><?php echo number_format($sales[0]['total'] + $sales[0]['discount'] - $sales[0]['tax'], 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<?php if($sales[0]['tax'] > 0 ) { ?>
								<th style = "text-align:right" class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
							<?php }else{ ?>
								<th style = "text-align:right" class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<?php if($sales[0]['tax'] > 0 ) { ?>
								<th style = "text-align:right" class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
							<?php }else{ ?>
								<th style = "text-align:right" class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
							<?php } ?>
						<?php }else{ ?>
								<th style = "text-align:right" class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <th style = "text-align:right" class="center"> <?php echo number_format($tot_itm_raw_ces, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <th  style = "text-align:right" class="center"><?php echo number_format(($sales[0]['total'] + $sales[0]['discount'] + $sales[0]['redeemed_amount']), 2); ?> </th>
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
							<?php if ($login_comid == 'asrfoods' || $login_comid != 'greenera') { ?>
								<tr>
									<td colspan="2" style=" ">
										<br /><b>Bank Details.</b><br />
										<?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?><br />
										<?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> <br />
										<?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?>
									</td>
								</tr>

							<?php } else if (strtolower($login_comid) == 'kmtrading') { ?>
								<tr>
									<td>&nbsp;&nbsp;&nbsp;&nbsp;<b>Payment</b><br /> <img align="middle" style="margin: 0px;" width="80px" height="80px" src="uploads/company/kmqr.jpg" />
										<br /> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Scan</b>
									</td>
									<td>
										<?php if ($sales[0]['einvoiceqrcode'] != "") { ?>
											E-Invoice <br />
											<img align="middle" style="margin: 0px" height="100px" src="uploads/<?php echo $sales[0]['einvoiceqrcode']; ?>" />
										<?php } ?>
									</td>
								</tr>

							<?php } ?>
							<?php $previous = 1;
							$Outstanding = 1;
							if ($login_comid == 'aktraders') {
								$previous = 0;
								$Outstanding = 0;
							} ?>

							<?php
							$val = 'previous';
							$filter_rules = array(
								'Field' => $val
							);

							$filter = function ($player) use ($filter_rules) {
								foreach ($filter_rules as $rulekey => $rulevalue) {
									if ($player->$rulekey != $rulevalue) {
										return false;
									}
								}
								return true;
							};

							$d = array_filter($print_settings, $filter);
							foreach ($d as $ia) {
								if ($ia->Isvisible == 'NO') {
									$previous = 0;
								}
							}


							$val = 'outstanding';
							$filter_rules = array(
								'Field' => $val
							);

							$filter = function ($player) use ($filter_rules) {
								foreach ($filter_rules as $rulekey => $rulevalue) {
									if ($player->$rulekey != $rulevalue) {
										return false;
									}
								}
								return true;
							};

							$d = array_filter($print_settings, $filter);
							foreach ($d as $ia) {
								if ($ia->Isvisible == 'NO') {
									$Outstanding = 0;
								}
							}

							?>




							<tr>
								<td>

								</td>
							</tr>
							<tr>
								<td>

								</td>
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
                        <td style="text-align: <?= $ar ?>; "><b style="font-size:14px;text-decoration: underline"><?php echo number_format($sales[0]['total'] - $sales[0]['adjustment'], 2) ?> </b></td>  

                    </tr>-->
							<?php foreach ($footer_settings as $items) {  ?>
								<?php if ($items->Field == 'Before_Tax' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['discount'] + $sales[0]['total'] - $sales[0]['tax'] - $sales[0]['additional_cess'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'SGST' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax'] / 2, 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'CGST' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax'] / 2, 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'Total_tax' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['tax'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'Item_cess' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['additional_cess'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'KFC' && $items->Isvisible == 'YES' && $sales[0]['cess'] > 0) { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['cess'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'total_Before_Discount' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['total'] + $sales[0]['discount'] - $sales[0]['roundoff'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'Bill_discount' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['discount'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'Exchange_Amount' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['adjustment'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'round_off' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['roundoff'], 2); ?> </b></td>
									</tr>
								<?php } ?>

								<?php
								if ($sales[0]['redeemed_amount'] > 0) {
								?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label('Reedeemed', $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['redeemed_amount'], 2); ?> </b></td>
									</tr>

								<?php } ?>
								<?php if ($items->Field == 'Bill_total' && $items->Isvisible == 'YES') { ?>
									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['total'], 2); ?> </b></td>
									</tr>

									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;">Previous Balance </td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['sale_previous'], 2); ?> </b></td>
									</tr>

									<tr>
										<td style="width:35%;">&nbsp;</td>
										<td style="text-align:left;">Total Outstanding</td>
										<td style="text-align:left;width:10px;"> :</td>
										<td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['sale_outstand'], 2); ?> </b></td>
									</tr>
								<?php } ?>
								<?php if ($items->Field == 'Terms' && $items->Isvisible == 'YES') {
									$Footer_Terms = 'YES';
								} ?>
								<?php if ($items->Field == 'Bank_details' && $items->Isvisible == 'YES') {
									$Footer_Bank_details = 'YES';
								} ?>
							<?php } ?>
						</table>

					</div>
				</div>
				<?php if ($Footer_Terms == 'YES') { ?>
					<?php if ($login_comid == 'asrfoods') { ?>
						<table style="padding:0px;width:100%;">
							<tr>
								<td style="width:100%"> <br /><?php //echo $settings[0]['terms_condition']; 
																?><br /><?php //echo $sales[0]['terms_condition']; 
																	?> <b>DECLARATION:</b> We declare that this invoice shows the actual price of the goods described and that all particulars are true and correct  </td>

							</tr>

						</table>
					<?php } ?>
				<?php } ?>

				<?php if ($this->session->userdata('login_base_comid') == 'madeena') { ?>

					<table style="width:100%;">
						<tr>
							<td style="width:33%; text-align:<?= $al ?>">

							</td>
							<td style="width:34%; text-align: center">
								<img style="margin: 0px" width="100px" height="100px" src="uploads/company/mdeenaseal.jpg" />
							</td>
							<td style="width:33%; text-align:<?= $dir ?>">
								<img style="margin: 0px" width="100px" height="100px" src="uploads/company/madeenasignature.jpg" />
							</td>
						</tr>
						<tr>
							<td style="width:33%; text-align:<?= $al ?>">
								&nbsp;
							</td>
							<td style="width:34%; text-align: center">
								<?= label('Company Seal', $this, $user) ?>
							</td>
							<td style="width:33%; text-align:<?= $dir ?>">
								<?= label('Authorized Signatory', $this, $user) ?>
							</td>
						</tr>
					</table>
				<?php } else { ?>
					<table style="width:100%;">
						<tr>
							<td style="width:33%; text-align:<?= $al ?>">
								<?php if ($login_comid != 'panackakuzhiyil' &&  $login_comid != 'Perumalil' && $login_comid != 'perumalil') { ?>
									<br />
									<br />
									<br />
									<br />
									&nbsp;
								<?php } else if (strtolower($login_comid) != 'kmtrading' && strtolower($login_comid) != 'panackakuzhiyil') { ?>
									<img align="middle" style="margin: 0px;" width="80px" height="80px" src="uploads/company/perumalilqrcode.jpeg" />
								<?php } elseif (strtolower($login_comid) == 'panackakuzhiyil') {  ?>
									<img align="middle" style="margin: 0px;" width="80px" height="80px" src="uploads/company/qrpanack.jpg" />
								<?php }else {  ?>
									<img align="middle" style="margin: 0px;" width="80px" height="80px" src="uploads/company/kmqr.jpg" />
								<?php } ?>

							</td>
							<td style="width:34%; text-align: center">
								<br />
								<br />
								<br />
								<br />
								<?= label('Company Seal', $this, $user) ?>
							</td>
							<td style="width:33%; text-align:<?= $dir ?>">
								<br />
								<br />
								<br />
								<br />
								<?= label('Authorized Signatory', $this, $user) ?>
							</td>
						</tr>
					</table>
				<?php } ?>

			<?php } ?>
			<hr style="border: solid 1px #222; " />
			<?php if ($Footer_Bank_details == 'YESs') { ?>
				<table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
					<tr>
						<td style="font-size:10px; text-align: center ">
							<?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?>,
							<?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> ,
							<?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?></td>
					</tr>
					<tr>
						<td style="font-size:8px; text-align: center ">**<?= label('This is a Computer Generated Invoice', $this, $user) ?>**</td>
					</tr>
					<tr>
						<td style="font-size:10px; text-align: center "><?php echo  $inc . '-' . number_format($cpz + 1); ?></td>

					</tr>
				</table>
			<?php } ?>
		</div>
	</div>
</body>

</html>