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
                background-color:#e6e6e6;
				color : black;
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
          
            
            .txtcenter {
                text-align: right;
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
			.cls60{
				width:60%;
				border :1px solid #e6e6e6;
				float: left;

			}
			
			.cls40{
				width:39.4%;
				border :1px solid #e6e6e6;
                float: right;
			}
			.cls39{
				width:39%;
				border :1px solid #e6e6e6;
                float: right;
			}
			.subdiv{
				border-bottom :1px solid #e6e6e6;
			}
        </style>
    </head>
    <body style="  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
    <div style="padding: 0px; margin: 0px;">  
		<h3 style = "margin:0px;padding:0px;height:30px;background-color:#e6e6e6;text-align:center;width:100%;padding-top:6px;" >INVOICE</h3>
		<div style = "width:100%">
			<div class ="cls60" style ="height:160px;">
				Exporter : 
			</div>
			<div class ="cls40" style ="height:160px;">
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:20px;">
					INV	NO:	<?php echo $sales[0]['invoice'];?>			&nbsp;&nbsp;&nbsp;&nbsp;				DT:	<?php echo $sales[0]['in_date'];?>

				</div>
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:20px;">
					Buyer's	Order	No.	&	Date:				

				</div>
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:50px;">
					Other	Reference	(s)	IEC		NO.<br />
					PAN	Number	:<br />
					GSTIN	NO:
				</div>
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:25.5px;;">
					Buyer	(	if	other	than	consignee	)
				</div>
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:40px;;">
					Country	of	Origin	of	goods			:	INDIA
	<br />				AD	CODE:	6270114			
				</div>
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:20px;;">
					Country	of	Final	Destination				:	MALAYSIA

				</div>
				
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:12px;width:100%;height:70px;;">
					Terms	of	Shipment	:	
					<br />
				</div>
				
				<div class = "subdiv"  style = "margin:1px solid #e6e6e6;padding:5px;font-size:11px;width:100%;height:15px;;">
					THIS	SUPPLY	IS	MEANT	WITHOUT	PAYMENT	OF
					INTERGRATED	TAX	VIDE	LUT	NO-------------------
					DT	
				</div>
			</div>
			<div class ="cls60" style ="height:83px;">
				Consignee:	(Ship	To)		:

			</div>
			<div class ="cls60" style ="height:80px;">
				<div class ="cls60" style ="height:40px;font-size:12px;">
					Pre	–	carriage <br />
					By	Road
				</div>
				<div class ="cls39" style ="height:40px;font-size:12px;">
					Place	of	Receipt	<br />
					Cochin India
				</div>
				<div class ="cls60" style ="height:40px;font-size:12px;">
					Vessel	/Flight	No.<br />
					By	Road
				</div>
				<div class ="cls39" style ="height:40px;font-size:12px;">
					Port	of	Loading	<br />
					Cochin India
				</div>
				<div class ="cls60" style ="height:40px;font-size:12px;">
					Port	of	Discharge
						<br />
					PORT	KLANG	,		MALAYSIA
				</div>
				<div class ="cls39" style ="height:40px;font-size:12px;">
					Final	Destination	<br />
					PORT	KLANG	MALAYSIA
				</div>
			</div>
		</div>
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
		
		<table style = "width:100%">
			<tr>
				<th style = "text-align:left;">
					Amount In Words : <?php echo $msd;?>
				</th>
			</tr>
		</table>
		<div class ="cls60" style ="height:100px;font-size:12px;">
			&nbsp;Bank:<?php echo $company['comset_bank']; ?><br />
			&nbsp;Account No:<?php echo $company['comset_account_no']; ?> <br />
			&nbsp;IFSC:<?php echo $company['comset_ifsccode']; ?> <br />
		</div>
		<div class ="cls40" style ="height:100px;text-align:right">
			 <table style="padding: 2px; font-weight: bold; margin: 0px; width: 100%;">
                
					 <?php foreach($footer_settings as $items){  ?>
						<?php if($items->Field == 'Before_Tax' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right;"><b><?php echo number_format($sales[0]['discount'] + $sales[0]['total']-$sales[0]['tax'] -$sales[0]['cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align:right;"><b><?php echo number_format($sales[0]['tax']/2, 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right;"><b><?php echo number_format($sales[0]['tax']/2, 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Total_tax' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right"><b><?php echo number_format($sales[0]['tax'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Item_cess' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right"><b><?php echo number_format($sales[0]['additional_cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'KFC' && $items->Isvisible == 'YES' && $sales[0]['cess'] > 0 ){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align:right;"><b><?php echo number_format($sales[0]['cess'], 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'total_Before_Discount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right;"><b><?php echo number_format($sales[0]['total'] + $sales[0]['discount']-$sales[0]['roundoff'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Bill_discount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right;"><b><?php echo number_format($sales[0]['discount'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Exchange_Amount' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right;"><b><?php echo number_format($sales[0]['adjustment'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'round_off' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right"><b><?php echo number_format($sales[0]['roundoff'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Bill_total' && $items->Isvisible == 'YES'){?>
							 <tr>
								<td style="width:15%;">&nbsp;</td>
								<td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
								<td style="text-align:left;width:10px;"> :</td>
								<td style="width:25%; text-align: right"><b><?php echo number_format($sales[0]['total'] , 2); ?> </b></td>  
							</tr>
						<?php } ?>
						<?php if($items->Field == 'Terms' && $items->Isvisible == 'YES'){$Footer_Terms ='YES';}?>
						<?php if($items->Field == 'Bank_details' && $items->Isvisible == 'YES'){$Footer_Bank_details ='YES';}?>
					 <?php } ?>
                </table>
		</div>
		
   
    </div>
</div>
</body>
</html>

