<?php
$is_discount = 1;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
$login_comid = $this->session->userdata('login_comid');
$width = '20';;
if($login_comid == 'maris'){
    $width = '10';;
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            body{
                font-family: serif;
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
            }
            tr td {
                font-size: 10px;
            }
            .center{
                text-align: right;
            }
            .spec th{
                font-weight: bold;
                font-size:10px;
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

                border:  solid 1px #444; 
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                border: 1px solid #222 ;
                padding-right: 1px !important;
            } 
            .mt,.mt  td  {
                border-right:  0.5px solid  #333  ; 
                padding-right: 2px !important;
                padding-left:  2px !important;

            } 

            .topbr th{
                border:   0.5px solid  #333  ; 
            }
            .mt th{
                border-top:    0.5px solid  #333   ; 
                font-size:10px;
                height: 10px;
            }
            .valtb td {
                font-size: 14px;
                font-weight: bold;
            }
            .right{
                text-align: right;
                padding-right: 30px;
            }
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        	<p style ="text-align:center" >Purchase Order</p>
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
            
            <table  border="0" class="" style="padding: 0px;  margin: 0px; width: 100%;">
			 <tr>
                    <td style="width:50%;text-align: left;font-weight:bold;">
						<table class="" style="width:100%;height:300px;border-collapse:collapse"  border="0" cellpadding="0" cellspacing="0">
							<tr>
								
								<td style ="border-bottom:1px solid black;width:100%" >
									<?php echo $company['name'] ?><br />
									<?php echo $company['address'] ?> <br />
									<?php echo $company['phone'] ?> <br />
									<?php echo $company['email'] ?> <br />
									<?php echo $company['tin'] ?> <br />
								</td>
							</tr>
							<tr>
								<td >
									<font style ="font-size:12px;font-weight:bold;">Order to ,<br />
							<?php 
							
                              echo $purchase[0]['name']
							?>
						</font>
						<font style ="font-size:11px;padding:5px;">

						<?php
								if($purchase[0]['address_line1'] != '' && $purchase[0]['address_line1'] != null){
									echo '<br />'.$purchase[0]['address_line1'];
								}
						?>
						
						<?php
								if($purchase[0]['phone'] != '' && $purchase[0]['phone'] != null){
									echo '<br />'.$purchase[0]['phone'];
								}
						?>
						
						<?php
								if($purchase[0]['email'] != '' && $purchase[0]['email'] != null){
									echo '<br />'.$purchase[0]['email'];
								}
						?>
						
						<?php
								if($purchase[0]['tin'] != '' && $purchase[0]['tin'] != null){
									echo '<br />GSTIN:'.$purchase[0]['tin'];
								}
						?>
						</font>
								</td>
							</tr>
							
						</table>
					</td>
                    <td style="width:50%;text-align: center;">
						<table class="" style="width:100%;height:300px;border-collapse:collapse"  border="1" cellpadding="5" cellspacing="0">
							<tr >
								<td  class= "clssubtd" style="padding-left:10px;height:35px;text-align:left">PO No <br /><b><?php echo $purchase[0]['invoice'];?></b></td>
								<td class= "clssubtd"  style="height:30px;text-align:left">Dated : <br /><b><?php echo $purchase[0]['in_date'];?></b></td>
							</tr>
							<tr >
								<td class= "clssubtd" style="height:30px;text-align:left">Supplier’s Ref./Order No <br /><?php echo $purchase[0]['supplier_ref'];?></td>
								<td class= "clssubtd" style="height:30px;text-align:left">Destination  <br /><?php //echo 'date';?></td>
							</tr>
							
								<tr >
								<td class= "clssubtd" style="height:30px;text-align:left">Due Date<br /><?php //echo 'date';?></td>
								<td class= "clssubtd" style="height:30px;text-align:left">  </td>
							</tr>
						
							<tr >
								<td class= "clssubtd" colspan= "2" style="height:50px;text-align:left"><b>Shipp To</b> <br />
										Name : <?php echo $purchase[0]['shipping_name'];?><br />
										Address: <?php echo $purchase[0]['shipping_address'];?><br />
										Phone : <?php echo $purchase[0]['shipping_contact'];?><br />
										GSTTIN : <?php echo $purchase[0]['shipping_gstin'];?><br/>

								</td>
							</tr>
						 </table>
					</td>
            </tr>
               
			</table>
            <hr style="border: solid 1px #222; "/>
            <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 10%; text-align: center">No</th>
                    <th style="width:  50%;  text-align: center">Item</th>
                    <?php if($login_comid == 'maris'){?>
                        <th  class="center" style="width: 10%; text-align: center">Unit</th>
                        <th  class="center" style="width: 10%; text-align: center">Code</th>
                        <th  class="center" style="width: 10%;  text-align: center">Quantity</th>
                        <th  class="center" style="width: 10%;  text-align: center">Total</th>
                    <?php }else{?>
                    <th  class="center" style="width: 20%; text-align: center">Code</th>
                    <th  class="center" style="width: 20%;  text-align: center">Quantity</th>
                    <?php }?>
                </tr>

                <?php
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
				$qty = 0 ;
                $bftax = 0;
                foreach ($purchase_items as $item) {
                    if($item['discount']!=0){
                    $rowtotal=((($item['rate']-$item['rate']*$item['discount']/100)*$item['quantity']) +$item['tax']);
                     $discount = ($item['quantity'] * ($item['rate'] * $item['discount'] / 100));
                    }
                    else
                    {
                       $rowtotal=$item['rate']*$item['quantity']+$item['tax'];
                        $discount=0;
                    }
					$qty  = (float) $qty  +(float) $item['quantity'];
                    $total = $total +$rowtotal ;
                   
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + $rowtotal - $item['tax'];
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['rate'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($rowtotal - $item['tax']);
                    $i = $i + 1;
					$rate = $item['rate'];
					if( (float) $item['is_taxincluded'] >  0 && (float) $item['GST'] > 0 ){
						$taxamt = (float) $rate - (((float) $rate * 100) / ((float) $item['GST'] + 100));
						$rate = (float) $rate - (float) $taxamt;
					}
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <?php if($login_comid == 'maris'){?>
                            <td class="center"> <?php echo $item['code']; ?></td>
                            <td class="center"> <?php echo $item['barcode']; ?></td>
                            <td class="center"> <?php echo $item['quantity']; ?></td>
                            <td class="center"> <?php echo $item['total']; ?></td>
                        <?php }else{?>
                        <td class="center"> <?php echo $item['barcode']; ?></td>
                        <td class="center"> <?php echo $item['quantity']; ?></td>
                        <?php }?>
                        
                    </tr>
                <?php }
                ?>

                <?php
                $len = $size - $i - 1;
                for ($i = 0; $i < $len; $i++) {
                    ?> 
                    <tr>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <td> </td>
                        <?php if($login_comid == 'maris'){?>
                            <td></td>
                            <td></td>
                        <?php }?>
                       
                    </tr>
                <?php } ?> 
            </table>
            <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <tr>
                    <th style=" width: 80%;">Total</th>
                   
                    <th style=" width: 10%;"><?php echo $qty ; ?></th>
                    <th style=" width: 10%;"><?php echo $purchase[0]['total'] ; ?></th>
                </tr>
				<tr>
					<td colspan = "3" style = "height:80px;" >
						NOTE : <?php echo $purchase[0]['notes'];?>
						
					</td>
				</tr>
            </table>

           
           
           
            <hr style="border: solid 1px #222; "/>
            <table style="padding:0px;  margin: 0px;  width:100%;">
                <tr>
                    <td  style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
                </tr>
            </table> 
        </div>
    </body>
</html>

