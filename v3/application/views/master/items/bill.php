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
			.tds{
				height:20px;
			}

        </style>
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">


           <p style="padding: 0px;text-align:center;margin-bottom:0px;">
				<font style="font-size:18px;font-weight:bold"><?php echo $company['name'] ?>  <?php if(strtolower($this->session->userdata('login_base_comid')) == 'palack'){?>  Colour House <?php }?> </font><br />
				<font style="font-size:12px;"><?php echo $transfer[0]['mainaddress'];?> , <?php echo $company['phone'] ?><br />
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
							
							
					</font>
				</p>
                
            </div> 
            <div class="cls20 mainhead" style="padding: 0px; margin: 0px; text-align:center;float: <?= $al ?>"> 
            <?php if(strtolower($this->session->userdata('login_base_comid')) != 'palack'){?>
                <p style="padding: 0px;font-size:15px ; font-weight: bold;">Delivery Challan </p>
                <?php }else{?>
                <p style="padding: 0px;font-size:15px ; font-weight: bold;">Delivery Challan </p>
                    <p style="padding: 0px;font-size:15px ; font-weight: bold;">Stock Transfer </p>
                    <?php }?>
                
            </div>
            <div class="cls34" style="padding: 0px; margin: 0px; text-align: <?= $dir ?>; ">  
                <!-- <p  dir="<?= $ms ?>" style="padding: 0px;font-size:12px ; font-weight: bold;"><?= label('INV NO', $this, $user) ?>:<?php echo $transfer[0]['invoice'] ?><br /> -->
                 <!-- <?= label('Date', $this, $user) ?> :<?php echo $transfer[0]['date'] ?> </p>  -->
            </div>
        </div> 
		 <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
			<!-- <tr class="topbr" > 
                <?php if(strtolower($this->session->userdata('login_base_comid')) != 'palack'){?>
				 <th colspan="6" style="text-align: center"><?= label('Delivery Challan', $this, $user) ?></th>
                <?php }else{?>
				 <th colspan="6" style="text-align: center"><?= label('Stock Transfer', $this, $user) ?></th>
                 <?php }?>

            </tr> -->
			<tr>
				<td class="tds" colspan="2">Serial Number  of Challan:- <?php echo $transfer[0]['invoice'] ?>  </td>
				<td colspan="4">Transport Mode: <?php echo $transfer[0]['transport_mode'] ?> </td>
			</tr>
			<tr>
				<td class="tds" colspan="2">Date of Challan:  <?php echo $transfer[0]['date'] ?> </td>
				<td colspan="4">Vehicle number: <?php echo $transfer[0]['vehicle_no'] ?> </td>
			</tr>
			<tr>
				<td class="tds" colspan="2">Ref No:-  <?php echo $transfer[0]['reference'] ?> </td>
				<td colspan="4">Purpose:- <?php echo $transfer[0]['purpose'] ?> </td>
			</tr>
			<tr>
				<td class="tds" colspan="2">Ref Date:- <?php echo $transfer[0]['ref_date'] ?>  </td>
				<td colspan="4">Date:-  <?php echo $transfer[0]['date'] ?></td>
			</tr>
			<tr>
				<td class="tds" colspan="2">Place:- <?php echo $transfer[0]['place'] ?> </td>
				<td colspan="4">Eway Bill Date: <?php echo $transfer[0]['eway_date'] ?> </td>
			</tr>
			<tr>
				<td class="tds">State:- Kerala  </td>
				<td >Code:32  </td>
				<td colspan="4"> Eway Bill No:-<?php echo $transfer[0]['eway_no'] ?></td>
			</tr>
			<tr class="topbr" > 
				 <th colspan="6" style="text-align: left;font-size:14px;"><?= label('Detail of Receiver', $this, $user) ?></th>
			</tr>
			<tr class="" > 
				 <td colspan="6" style="text-align: left;font-size:12px;">Name :<?php echo ucfirst($company['name']);?> <?php if(strtolower($this->session->userdata('login_base_comid')) == 'palack'){?>  Colour House <?php }?>  </td>
			</tr>
			<tr class="" > 
				 <td colspan="6" style="text-align: left;font-size:12px;">Address : <?php echo ucfirst($transfer[0]['godownsubaddress']);?></td>
			</tr>
			<tr class="" > 
				 <td colspan="6" style="text-align: left;font-size:12px;">GSTIN : <?php echo $company['tin'] ?></td>
			</tr>
			<tr>
				<td >State:- Kerala  </td>
				<td >Code:32  </td>
				<td colspan="4"> </td>
			</tr>
			
		 </table>
		<br />
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 20px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th style="width: <?php echo $itemwd; ?>px;  text-align: left"><?= label(strtoupper ('Description Of Goods'), $this, $user) ?></th>
                <th  class="center" style="width: 40px;  text-align: center"><?= label(strtoupper('Hsncode'), $this, $user) ?></th>
                <th  class="center" style="width: 30px;  text-align: center"><?= label(strtoupper('Quantity'), $this, $user) ?></th>
			   <th  class="center" style="width: 30px;  text-align: center"><?= label(strtoupper('Unit'), $this, $user) ?></th>
                <th class="center" style="width: 42px;  text-align: center"><?= label('RATE ', $this, $user) ?></th>
                <th class="center" style="width: 25px;  text-align: center"><?= label('Tax % ', $this, $user) ?></th>
                <th class="center" style="width: 40px;  text-align: center"><?= label('TOTAL', $this, $user) ?></th>

            </tr>
			<?php
				$i = $len;
				foreach($transfer_items as $item){
				$taxamount =  0 ;
                $total = $item['qty'] * $item['item_rate'];
                if($item['GST'] > 0 ){
                    
                }
				$i++;
			?>
				<tr>
					<td> <?php echo $i;?></td>
					<td style="text-align:left;" > <?php echo $item['name']; ?></td>
					<td class="center"> <?php echo $item['hsn_name']; ?></td>
					<td class="center"> <?php echo $item['qty']; ?></td>
					<td class="center"> <?php echo $item['unit']; ?></td>
					<td class="center"> <?php echo $item['item_rate']; ?></td>
                    					<td class="center"> <?php echo $item['GST']; ?></td>
					<td class="center"> <?php echo round($item['totalamout'],2); ?></td>
				</tr>
			
			<?php
				}
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
					 <td> </td>
                </tr>
            <?php } ?> 
			<?php if ($inc != ($cpz + 1)) { ?> 
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
                </tr>

                <?php } ?> 
        <?php } ?>
		 <?php if ($inc == ($cpz + 1)) { ?> 
			<?php foreach($taxdetails as $item){ if((float)$item['GST'] > 0 ){?>
				
				<tr class="topbar">
                    <th colspan="5">&nbsp; </th>
					<th colspan="2" style="text-align:left;font-size:12px;"> <?php if((float)$item['GST'] > 0 ){echo 'SGST ';}else{echo '';}?></th>
					<th style="font-size:12px;"> <?php if((float)$item['tax'] > 0 ){echo $item['tax']/2;}else{echo '0';}?></th>
                </tr>
				<tr class="topbar">
                    <th colspan="5">&nbsp; </th>
					<th colspan="2" style="text-align:left;font-size:12px;"> <?php if((float)$item['GST'] > 0 ){echo 'CGST ';}else{echo '';}?></th>
					<th style="font-size:12px;"> <?php if((float)$item['tax'] > 0 ){echo $item['tax']/2;}else{echo '0';}?></th>
                </tr>
				
			<?php } } ?>
				<tr class="topbar">
                    <th colspan="5">&nbsp; </th>
					<th colspan="2" style="text-align:left;font-size:12px;"> Grand Total</th>
					<th style="font-size:12px;"><?php echo round($totals['total'],2) ;?></th>
                </tr>
		 <?php } ?>
        </table>
		
       

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

       
            </div>
 
            <br/>

           

		<table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
			<tr class="topbr" > 
				<th style="width:50%;"><!--Bank Details--></th>
				<th style="width:50%;">For: M/s <?php echo $company['name'] ?></th>
			</tr>
			<tr>
				<td >&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br /><!--<?= label('Bank', $this, $user) ?> :<?php echo $company['comset_bank']; ?><br /><br />
					<?= label('Account No', $this, $user) ?>:<?php echo $company['comset_account_no']; ?> <br /><br />
					<?= label('IFSC', $this, $user) ?> :<?php echo $company['comset_ifsccode']; ?>-->
				</td>
				<td ></td>
			</tr>
			<tr class="topbr" > 
				<td style="width:50%;">Terms & Conditions :  <br />&nbsp; <br />&nbsp;</td>
				<th style="width:50%;">Authorised signatory</th>
			</tr>
		</table>
        <?php } ?>
        <hr style="border: solid 1px #222; "/> 
       
    </div>
</body>
</html>

