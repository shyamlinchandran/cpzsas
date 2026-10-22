<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '215px'; //if discont is 0
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
$user = '';
$language = $this->language;
?>
<style>
	.cls50{
           width:50%;
           float: left;
           font-size: 13px;
           font-family: sans-serif;
            }
	.cls50{
           width:50%;
           float: left;
           font-size: 13px;
           font-family: sans-serif;
            }
			.thicker {
			font-weight: 900;
			font-size:18px;
			}
			hr {
  border: 0;
  border-top: 4px double #8c8c8c;
  text-align: center;
}
hr:after {
  content: '\2665';
  display: inline-block;
  position: relative;
  top: -15px;
  padding: 0 10px;
  background: #fff;
  color: #8c8c8c;
  font-size: 18px;
}
		
			
	</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">

        <div style="width:100%;padding: 0px; margin: 0px; height: 70px;">
		<div class="cls50">
				<img alt="" src="<?php echo base_url(); ?>uploads/images/<?php echo $company['logo'];?>" style="height:100px; width:400px" />
		</div>
		<div class="cls50" style="padding-top:10px;text-align:right;">
			<table style="color:black;width:100%;padding:0px;">
				<tr>
					<td style="text-align:right">
						<p><?php echo $company['name'];?></p><br />
						<p style="margin-top:30px;"><?php echo $company['address'];?></p>
						<p><?php echo $company['phone'];?></p>
						<p class="thicker" style="">GSTIN/UIN: <?php echo $company['tin'];?></p>
					</td>
				</tr>
			</table>
		</div>
		<?php $arr_ph = explode(";", $service[0]['address_line1']);
									
			$arr_ph1 = explode(";", $service[0]['address_line2']);			$size1 = sizeof($arr_ph1);			$size = sizeof($arr_ph);?>
		<table class="tableitalic" style="font-style: italic;font-weight:bold;font-size:12px; color:black;width:100%;padding:0px;">
			
		
			<tr>
				<td style="width:500px;font-size:16px">
					<?php echo $service[0]['name'];?>
				</td>
				
				<td  style="width:400px;text-align:right;font-size:14px">
					<?php echo $service[0]['sdate'];?>
				</td>
			</tr>
			<tr>
				<td style="font-size:14px">
					<?php echo str_replace(';', '<br />', $arr_ph[0]);  ?>
				</td>

				<td style="text-align:right;font-size:16px">
					Invoice No: <?php echo $service[0]['invoice'];?>
				</td>
			</tr>
			<?php for($i=1;$i<$size;$i++){?>
			<tr>
									<td  style="font-weight:bold;font-size:14px;width:80%"><i><?php echo str_replace(';', '<br />', $arr_ph[$i]);  ?></i></td>
									<td></td>
			</tr>
			<?php }?>
			<tr>
				<td style="font-size:14px">
					GSTIN/UIN : <?php echo $service[0]['tin'];?>
				</td>
			
				<td  style="text-align:right;font-size:14px">
					Qtn No:<?php echo $service[0]['bill_no'];?>
				</td>
			</tr>
			<?php for($i=0;$i<$size1;$i++){?>
				<tr>
					<td  style="<?php if($i < 1){ echo 'padding-top:10px; ';}?>font-weight:bold;font-size:14px;width:80%"><i><?php if($i < 1){ echo '<font style="padding:0px;padding-bottom:8px;font-size:16px;" >Delivery Address</font><br /><br />';}echo str_replace(';', '<br />', $arr_ph1[$i]);  ?></i></td>
					<td></td>
				</tr>
			<?php }?>
			
			<tr>
				<td colspan="2" style="font-size:20px;padding-left:500px;">Invoice</td>
			</tr>
		</table>
		<br />
		<table style="border:1px solid #ccc;border-collapse:collapse;width:100%;padding:20px;font-weight:normal;font-size:12px;">
			<tr>
				<th style="width:40px;border:1px solid #ccc;padding:5px;font-size:14px;"> No</th>
				<th   style="width:230px;border:1px solid #ccc;padding:5px;font-size:14px;">Description</th>
				<th   style="width:75px;border:1px solid #ccc;padding:5px;font-size:14px;">Qty</th>
				<th  style="width:75px;border:1px solid #ccc;font-size:14px;"> Rate</th>
				<th  style="width:50px;border:1px solid #ccc;font-size:14px;"> Tax%</th>
				<th  style="width:75px;border:1px solid #ccc;font-size:14px;"> Tax</th>
				<th style="border:1px solid #ccc;font-size:14px;">Total</th>
			</tr>
			<?php $i =0; foreach($service as $item){$i++;?>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"><?php echo $i;?></th>
					<th   style="height:30px;text-align:left;width:330px;border:1px solid #ccc;"> <?php echo $item['itemname'];?></th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> <?php echo number_format($item['quantity'],2);?></th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> <?php echo number_format($item['amount'],2);?></th>
					<th  style="height:30px;width:50px;border:1px solid #ccc;"> <?php echo $item['GST'];?></th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> <?php echo number_format($item['subtax'],2);?></th>
					<th style="height:30px;border:1px solid #ccc;"> <?php echo number_format($item['subtotal'],2);?></th>
					
				</tr>
			<?php }?>
			<?php for($j=$i;$j<6;$j++){?>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;">&nbsp;</th>
					<th   style="height:30px;text-align:left;width:330px;border:1px solid #ccc;"> </th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> </th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> </th>
					<th  style="height:30px;width:50px;border:1px solid #ccc;"></th>
					<th  style="height:30px;width:75px;border:1px solid #ccc;"> </th>
					<th style="height:30px;border:1px solid #ccc;"> </th>
					
				</tr>
			<?php }?>
			<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"></th>
					<th colspan="4"  style="height:30px;text-align:right;width:330px;border:0px solid #ccc;"> </th>
					<th  style="height:30px;width:100px;border:1 solid #ccc;"> <?php echo number_format($service[0]['gtax'],2);?></th>
					<th style="height:30px;border:1px solid #ccc;"> <?php echo number_format($service[0]['gtotal'],2);?></th>
					
			</tr>
			<?php if((int) $service[0]['is_ces'] > 0 ){?>
				
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"></th>
					<th colspan="3"  style="height:30px;text-align:right;width:330px;border:1px solid #ccc;"> </th>
					<th colspan="2"  style="height:30px;width:100px;border:1 solid #ccc;"> KFC</th>
					<th style="height:30px;border:1px solid #ccc;"> <?php echo number_format($service[0]['ces_amt'],2);?></th>
					
				</tr>
			
			<?php } ?>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"></th>
					<th colspan="3"  style="height:30px;text-align:right;width:330px;border:1px solid #ccc;"> </th>
					<th colspan="2"  style="height:30px;width:100px;border:1 solid #ccc;"> Round Off</th>
					<th style="height:30px;border:1px solid #ccc;"> <?php echo number_format($service[0]['roundoff'],2);?></th>
					
				</tr>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"></th>
					<th colspan="3"  style="height:30px;text-align:right;width:330px;border:1px solid #ccc;"> </th>
					<th colspan="2"  style="height:30px;width:100px;border:1 solid #ccc;"> Grand Total</th>
					<th style="height:30px;border:1px solid #ccc;"> <?php echo number_format($service[0]['net_total'],2);?></th>
					
				</tr>
			<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"></th>
					<th colspan="5"  style="font-weight:normal;height:30px;text-align:left;width:330px;border:1px solid #ccc;"><?php echo $msd;?> </th>
					<th style="height:30px;border:0px solid #ccc;"> </th>
					
				</tr>
			<!-- <tr>
				<th style="width:40px;border:1px solid #ccc;">Sl No</th>
				<th   style="width:330px;border:1px solid #ccc;">DESCRIPTION</th>
				<th colspan="2" style="border:1px solid #ccc;">CURRENT <br /> INVOICE</th>
				<th style="border:1px solid #ccc;">CUMULATIVE CURRENT <br />  AMOUNT</th>
			</tr>
			<?php $i =0; foreach($service as $item){$i++;?>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"><?php echo $i;?></th>
					<th style="text-align:left;width:330px;border:1px solid #ccc;"> <?php echo $item['itemname'];?></th>
					<th colspan="2" style="width:220px;border:1px solid #ccc;"> <?php echo $item['subtotal'];?></th>
					<th style="width:200px;border:1px solid #ccc;"><?php echo $item['subtotal'];?></th>
				</tr>
			<?php }?>
				<tr>
					<th style="height:30px;width:40px;border:1px solid #ccc;"><?php echo $i;?></th>
					<th colspan="3" style="width:220px;border:1px solid #ccc;text-align:right"> <?php echo 'GSTIN-18%';?></th>
					<th style="width:200px;border:1px solid #ccc;"><?php //echo $item['subtotal'];?></th>
				</tr> -->
			
</table>

	
		</div>





</body>
</html>

