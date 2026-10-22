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
if($login_comid == 'rjd' ){
	
$order = 'Quotation';
}

$com = substr($company['comset_statecode'], 0, 2);
$com =32;
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

}

$title = 'TAX-INVOICE';
if($sales[0]['stype'] == 'sales_return'){
	$title = 'CREDIT NOTE';
}


if($sales[0]['stype'] == 'estimate'){
	$title = 'ESTIMATE';
}

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
			.sub_tbl td{
				height:29px;
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
                height: 14px;

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
                border: 2px solid #000000;
                padding-right: 1px !important;
            } 
			<?php if($this->session->userdata('login_base_comid') != 'grandmother' &&$this->session->userdata('login_base_comid') != 'antraders' && $this->session->userdata('login_base_comid') != 'anmply' && $this->session->userdata('login_base_comid') != 'anmtra' && strtolower($this->session->userdata('login_base_comid'))  != 'sunith'  ){ ?>
				.maintable tr:nth-child(odd) {background: #eee}
			<?php } ?>
            .mt,.mt  td  {
                border-right:  2px solid #000000;
                padding-right: 2px !important;
                padding-left:  2px !important;
                border-collapse: collapse;
				
            } 

            .topbr th{
                border:   1px solid #000000;
            }
            .mt th{
                border-top:    1px solid #000000;
                font-size:12px;
                height: 11px;
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
                width:39%;
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
                width:49.65%;
                /*                background-color: #aaa;  */
                float: left;
				height:130px !important;
                font-size: 13px;
				border:2x solid #000000;
				border-right:1px solid #000000;
				border-bottom:0px solid #000000;
				border-top:0px solid #000000;
                font-family: sans-serif;
            }
			.cls50a{
                width:49.5%;
                /*                background-color: #aaa;  */
                float: left;
				height:130px !important;
                font-size: 13px;
				border:2x solid #000000;
				border-bottom:0px solid #000000;
				border-left:1px solid #000000;
				border-top:0px solid #000000;
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
			.tditem{
				width: 250px;
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
			
			.clsimg{
				padding:5px;
				border :0px solid black;
                width:25%;
				height: 120px; 
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
			
			
			.clsimg span{
                width: 100%;
                text-align: center;
                background-color: #aaa;
            }
			
			 .clsimg h2{
                padding-left: 10px;
                padding-top: 10px;
            }
			
			
			.clscom{
				padding:5px;
				border :0px solid black;
                width:52%;
				height: 124px; 
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
			
			
			.clscom span{
                width: 100%;
                text-align: center;
                background-color: #aaa;
            }
			
			 .clscom h2{
                padding-left: 10px;
                padding-top: 10px;
            }
			 body{
                border-color :black;
                border :solid;
            }
			.bdrlft{
				border-left :0.03px solid black;
			}
			.bdrright{
				border-right :0.03px solid black;
			}
			
			
			.clsimg{
				padding:5px;
				border :0px solid black;
                width:20%;
				height: 120px; 
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
                font-family: sans-serif;


            }
			
			
			.clsimg span{
                width: 100%;
                text-align: center;
                background-color: #aaa;
            }
			
			 .clsimg h2{
                padding-left: 10px;
                padding-top: 10px;
            }
			.thd{
				border-left:2px solid #000000;
			}
			.cls60n{
				border:1px solid black;
				border-top:0px;
				border-bottom:0px;
				width:59.9%;
				height:100px;
			}
			.cls60n1{
				border-right:1px solid black;
				width:39.65%;
				height:100px;
			}
        </style>
    </head>
    <body style="margin:1px solid black;width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">

        <div style="border:1px solid black;width:100%;padding: 0px; margin: 0px; height: 70px;">
			
			
			 <div  style=" "  class="clsimg  "> 
				<?php if($company['logo']!=""){?>
					<img align="middle"  style="margin: 0px" width="100%" height="100px"  src="uploads/company/<?php echo $company['logo'] ?>" />  
				<?php }else{ echo '&nbsp;';}?>
			
            </div>
            <div class="clscom  " style="border-right:0px solid black;text-align: center;padding-top:0px;">
               <font style="padding-top:0px;font-size:30px;font-weight:bold;"> <?php echo $company['name'] ?></font> <br /><?php echo $company['address'] ?> <br />State : Kerala , Code : 32
                 

            </div>
           
             <div class="clsimg  " style="text-align: center;padding-top:0px;">
			 <?php if($this->session->userdata('login_base_comid') != 'grandmother'){ ?>		<p style ="padding:0px;margin:0px;text-align:right;font-size:12px;" >GSTIN:<?php echo $company['tin'];?></p><?php }?>
				<br />
                <table style ="width:100%">
					<tr>
						<td style ="width:45%" >Invoice no</td>
						<td style="width:2%">:</td>
						<td style= "width:50%;text-align:left"><b><?php echo $sales[0]['invoice'] ?></b></td>
					</tr>
					<tr>
						<td>Date</td>
						<td style="width:2px;">: </td>
						<td  style= "text-align:left"><?php echo $sales[0]['in_date']; ?> </td>
					</tr>
					<?php if($this->session->userdata('login_base_comid') != 'grandmother'){ ?>
					<tr>
						<td  colspan="3" style= "text-align:left"><br /></br/><b><?php echo $title;?>   <?php
                    if (isset($sales[0]['tin'])) {
						if($sales[0]['tin']!=''){
								echo ' - B2B';
						}else{
							echo ' - B2C '; 
						}
					}else{
						echo ' - B2C '; 
					}
                    ?> </b> </td>
					</tr>
					<?php }?>
				</table>
				
            </div>


        </div>
		<div style="width:100%;">

        <div class ="cls60n" style=" float:left">
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
			
			  <p style="margin: 0px;padding:0px;" ><?= label('To ,', $this, $user) ?></p> 
                <p style="margin: 0px;padding:0px;padding-left:10px;"><b><?php  if($sales[0]['cusname'] != '') {echo $sales[0]['cusname'] ;}else {echo 'Cash Customer';}?> </b> 
               <br /><?php echo $sales[0]['address_line1'] ?>  
               <?php
                    if (isset($sales[0]['phone'])) {if($sales[0]['phone']!=''){
                        echo '<br />Phone :' . $sales[0]['phone'];
                    }}
                    ?>
               <?php
                    if (isset($sales[0]['tin'])) {if($sales[0]['tin']!=''){
                        echo '<br />GSTIN :' . $sales[0]['tin'];
                    }}
                    ?>
                </p>
            
          
   
        </div>
			<div class ="cls60n1" style="">
				<?php if($sales[0]['transport_mode'] != ''){?>
				<p style ="padding-left:10px;" >Transportation Mode : <?php echo $sales[0]['transport_mode'];?></p>
				<p style ="padding-left:10px;" >Vehicle No : <?php echo $sales[0]['vehicle_no'];?></p>
				<?php }?>
				<?php if($sales[0]['ewb_no'] != ''){?>
				<p style ="padding-left:10px;" >EWB No : <?php echo $sales[0]['ewb_no'];?> <br />EWB Date : <?php echo $sales[0]['ewb_details'];?></p>
				<?php }?>
			</div>
	</div>

    </div> 

    <div style="padding: 0px; margin: 0px;">  

        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
			<tr class="topbr" >
				<th class ="thd"  style="width:10px;  text-align: center;border-left:2px solid #000000 !important"><?= label('SNo', $this, $user) ?></th>
				<?php $i =0;foreach($print_settings as $items){ $i++; ?>
					<?php if($items->Field == 'item_name' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:56.8% !important;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'item_barcode' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'hsn_code' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'item_quantity' && $items->Isvisible == 'YES'){?>
						  <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label('Unit', $this, $user) ?></th>
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
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as.' ', $this, $user) ?></th>
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <th class="tditem" style="width:<?php echo $items->width;?>;  text-align: center"><?= label($items->display_as, $this, $user) ?></th>
					<?php } ?>
				<?php } ?>
			</tr>
        
			<tbody class ="sub_tbl">
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
						<td class="center"> <?php echo $item['uname']; ?></td>
						<td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
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
						 <td class="center"> <?php echo number_format($item['total'] - $item['tax'] , 2); ?></td>
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
						 <th class="center"> <?php if($this->session->userdata('login_base_comid') != 'grandmother'){ ?>  <?php echo number_format($qty, 2); ?> <?php }?></th>
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
						 <th class="center"> <?php echo number_format($totdis, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'beforetax' && $items->Isvisible == 'YES'){?>
						 <th class="center"><?php echo number_format($sales[0]['total'] + $sales[0]['discount'] - $sales[0]['tax'], 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'taxpercentage' && $items->Isvisible == 'YES'){?>
						 <th class="center"> </th>
					<?php } ?>
					<?php if($items->Field == 'SGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<?php if($sales[0]['tax'] > 0 ) { ?>
								<th class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
							<?php }else{ ?>
								<th class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
							<?php } ?>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'CGST' && $items->Isvisible == 'YES'){?>
						<?php if((int) $com == (int)$cust){?>
							<?php if($sales[0]['tax'] > 0 ) { ?>
								<th class="center"> <?php echo number_format($sales[0]['tax']/2, 2); ?> </th>
							<?php }else{ ?>
								<th class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
							<?php } ?>
						<?php }else{ ?>
								<th class="center"> <?php echo number_format($sales[0]['tax'], 2); ?> </th>
						<?php } ?>
					<?php } ?>
					<?php if($items->Field == 'item_cess' && $items->Isvisible == 'YES'){?>
						 <th class="center"> <?php echo number_format($tot_itm_raw_ces, 2); ?> </th>
					<?php } ?>
					<?php if($items->Field == 'Total' && $items->Isvisible == 'YES'){?>
						 <th class="center"><?php echo number_format(($sales[0]['total'] + $sales[0]['discount']  +  $sales[0]['redeemed_amount'] ), 2); ?> </th>
					<?php } ?>
				<?php } ?>
				<tr>
				 <?php } ?> 
				 </tbody>
        </table>
     
         <!-- <?php if ($inc != ($cpz + 1)) { ?> 
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
                    <td> </td>
                </tr>
                
            <?php } ?> 
              </table>
        <?php } ?>-->

              <?php //if ($inc == ($cpz + 1)) { ?> 
        <div>
            <div class="cls50" style="text-align: <?= $al ?>; float: <?= $al ?>">
                <table style="padding: 2px;  margin: 0px; width: 100%; text-align:<?= $al ?>">
                    <tr>
                        <td colspan ="2"><b><?= label('Amount in Words', $this, $user) ?> :<?php echo $msd; ?></b> </td> 
                    </tr>
                   <?php $previous = 1;$Outstanding = 1; if($login_comid == 'aktraders' || $login_comid == 'antraders' || $login_comid == 'anmply'){$previous = 0;$Outstanding = 0;} ?>
				   
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
						foreach($d as $ia){  if($ia->Isvisible == 'NO' ){
							$previous = 0 ;
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
						foreach($d as $ia){  if($ia->Isvisible == 'NO' ){
							$Outstanding = 0 ;
							}
						}

					?>


				   
				   
                    <tr>
						<td>
							<?php if ($previous > 0 ) { ?> 
								<?php if($login_comid!= 'Perumalil' && $login_comid != 'perumalil' && $this->session->userdata('login_base_comid') != 'grandmother'){?>
									<?= label('Previous Balance', $this, $user) ?> :<?php echo  $sales[0]['previous']; ?>
								<?php } ?>
							<?php } ?>
							<?php if ($Outstanding > 0  && $this->session->userdata('login_base_comid') != 'grandmother' ) { ?>
								<br /><?= label('Total Outstanding', $this, $user) ?> :<?php echo $sales[0]['gtot']; ?>
							<?php } ?>
						</td> 
						<td>
							<?php if($this->session->userdata('login_base_comid') == 'antraders'){?>
								<img align="middle"  style="margin: 0px;" width="100px" height="100px"  src="uploads/company/1679567378anmetals.jpg" />  <br />
							<?php }?>
							<?php if($this->session->userdata('login_base_comid') == 'anmply'){?>
							<!--	<img align="middle"  style="margin: 0px;" width="80px" height="80px"  src="uploads/company/1678343074anmply.jpg" />  <br />-->
								<img align="middle"  style="margin: 0px;" width="80px" height="80px"  src="uploads/company/anmplyqr.jpg" />  <br />

							<?php }?>
							<?php if($this->session->userdata('login_base_comid') == 'anmtra'){?>
								<img align="middle"  style="margin: 0px;" width="80px" height="80px"  src="uploads/company/1678343074anmply.jpg" />  <br />
							<?php }?>
							<?php if($this->session->userdata('login_base_comid') == 'grandmother'){ ?>
								<img align="middle"  style="margin: 0px;" width="80px" height="80px"  src="uploads/company/grandmother.jpg" />  <br />
							<?php }?>
								
						</td>
						
                    </tr>
                   
                </table>
            </div>

            <div class="cls50a">
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
					
              		<?php if ($inc == ($cpz + 1)) { ?> 
    <?php 
    // 1. IMPROVED ROW COUNTER
    $visible_rows = 0;
    foreach($footer_settings as $items) {
        // Exclude Terms and Bank_details from the calculation rows
        if($items->Isvisible == 'YES' && !in_array($items->Field, ['Terms', 'Bank_details'])) {
            if($items->Field == 'KFC' && $sales[0]['cess'] <= 0) continue;
            $visible_rows++;
        }
    }
    if($sales[0]['redeemed_amount'] > 0) $visible_rows++;
    ?>

    <?php 
    $first_row = true; 
    foreach($footer_settings as $items){  
        
        // 2. LOGIC TO IDENTIFY TOTALS ROWS ONLY
        // We only show the row if it's visible AND it's not Terms/Bank_details
        $is_total_field = !in_array($items->Field, ['Terms', 'Bank_details']);
        $show_item = ($items->Isvisible == 'YES' && $is_total_field);
        
        // Specific check for KFC
        if($items->Field == 'KFC' && $sales[0]['cess'] <= 0) $show_item = false;
        
        // 3. SET GLOBAL FLAGS FOR TERMS/BANK (to be used outside this table later)
        if($items->Field == 'Terms' && $items->Isvisible == 'YES') { $Footer_Terms = 'YES'; }
        if($items->Field == 'Bank_details' && $items->Isvisible == 'YES') { $Footer_Bank_details = 'YES'; }

        if($show_item){ ?>
            <tr>
                <?php if($first_row): ?>
                    <td rowspan="<?= $visible_rows ?>" style="width:40%; text-align:center; vertical-align:middle; border:1px solid #eee;">
                        <?php if($sales[0]['einvoiceqrcode']!="") {?>
                                E-Invoice <br />
                                <img align="middle" style="margin: 0px" height="100px" src="uploads/<?php echo $sales[0]['einvoiceqrcode'];?>" />  
                            <?php echo '<br />'.$sales[0]['AckNo']; } ?>
                    </td>
                    <?php $first_row = false; ?>
                <?php endif; ?>

                <td style="text-align:left;"><?= label($items->display_as, $this, $user) ?> </td>
                <td style="text-align:left;width:10px;"> :</td>
                <td style="width:25%; text-align: <?= $ar ?>;">
                    <b>
                        <?php 
                        // Simplified Switch/Match logic for values
                        if($items->Field == 'Before_Tax') echo number_format($sales[0]['discount'] + $sales[0]['total']-$sales[0]['tax'] -$sales[0]['cess'], 2);
                        elseif($items->Field == 'SGST' || $items->Field == 'CGST') echo number_format($sales[0]['tax']/2, 2);
                        elseif($items->Field == 'Total_tax') echo number_format($sales[0]['tax'], 2);
                        elseif($items->Field == 'Item_cess') echo number_format($sales[0]['additional_cess'], 2);
                        elseif($items->Field == 'KFC') echo number_format($sales[0]['cess'], 2);
                        elseif($items->Field == 'total_Before_Discount') echo number_format($sales[0]['total'] + $sales[0]['discount']-$sales[0]['roundoff'] , 2);
                        elseif($items->Field == 'Bill_discount') echo number_format($sales[0]['discount'] , 2);
                        elseif($items->Field == 'round_off') echo number_format($sales[0]['roundoff'] , 2);
                        elseif($items->Field == 'Bill_total') echo number_format($sales[0]['total'] , 2);
                        ?>
                    </b>
                </td>  
            </tr>
        <?php } ?>
    <?php } ?>

    <?php if($sales[0]['redeemed_amount'] > 0): ?>
        <tr>
            <?php if($first_row): ?> 
                <td rowspan="<?= $visible_rows ?>" style="width:40%; text-align:center;">
                   </td>
            <?php endif; ?>
            <td style="text-align:left;"><?= label('Reedeemed', $this, $user) ?> </td>
            <td style="text-align:left;width:10px;"> :</td>
            <td style="width:25%; text-align: <?= $ar ?>;"><b><?php echo number_format($sales[0]['redeemed_amount'] , 2); ?> </b></td>
        </tr>
    <?php endif; ?>

<?php } ?>
                </table>

            </div>
        </div>
		<?php if($Footer_Terms== 'YES'){?>
        <table  style="width:100%;border:2px solid #000000;border-bottom:1px solid #000000;">
            <tr>
                <td style="width:40%"><u><?= label('Declaration', $this, $user) ?></u> <br/><?php echo $settings[0]['terms_condition']; ?><br/><?php echo $sales[0]['terms_condition']; ?> </td>

            </tr>          
        </table>  
		<?php } ?>
       
       
            <table  style="border:2px solid #000000;width:100%;border-top:1px solid #000000;">
                <tr>
                    <td style="width:33%; text-align:<?= $al ?>">
						<?php if($login_comid!= 'Perumalil' && $login_comid != 'perumalil'){?>
							<br/>
						<br/>
						 <br/>
							<br/>
							<?= label('Prepared by', $this, $user) ?> : <?= $sales[0]['user_name']; ?>
						<?php }else{ ?>
							<img align="middle"  style="margin: 0px;" width="80px" height="80px"  src="uploads/company/perumalilqrcode.jpeg" /> 
						<?php } ?>
                    </td>
                    <td style="width:34%; text-align: center">
						<br/>
						<br/>
						 <br/>
							<br/>
                        <?= label('Company Seal', $this, $user) ?>   
                    </td>
                    <td style="width:33%; text-align:<?= $dir ?>">
						 <br/>
							<br/>
							 <br/>
							<br/>
                        <?= label('Authorized Signatory', $this, $user) ?>    
                    </td>
                </tr>
            </table>

           
        <?php //} ?>
		 <?php if($Footer_Bank_details == 'YES'){?>
            <table style="padding:0px;  margin: 0px;  width:100%; font-weight: bold;">
                <tr>
                    <td  style="font-size:10px; text-align: center ">  
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
            </table> 
		 <?php } ?>
    </div>
</body>
</html>

