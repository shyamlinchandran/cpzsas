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

		body{
			padding:50px;
		}
			
	</style>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>

    </head>
    <body style="width:100%;  padding: 0px; margin-left:50px;padding-right:5px;margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
         <div class="box-body"  style="padding-left:50px;" id="printJS-form">
						<style>
							#printJS-form { 
							margin-left:48px;
							margin-right:48px;
							
							}
							#cc{ 
							position:relative;  
							width: 94%;
							height:auto;
							}
							div#header {
							position:fixed;
							top:0px;
							left:0px; 
							width:100%;
							padding:8px; 
							}
							#header img{
							height:100px;
							margin:auto;
							}
							
							div#footer {
							position:fixed;
							bottom:0px;
							left:0px;
							width:100%;
							height:40px;
							border-top:2px double #000 ;
							padding:8px;
							 
							}
							.printable {display:none;}
							@media print {
							.printable {display:block;}
							body
							{
							margin-top: 40mm;
							}
							
							}
							hr {
							page-break-before: always;
							
						 
							}
							#main table tr td{
								border : 1px solid #ccc;
								padding : 2px;
							}
						</style>
						
						</div>
						
						<div id="cc" style="margin-left:50px;margin-right:50px;"> 
							<table style="width:100%;margin-right:50px;">
								<tr>
									<td style="font-weight:bold;font-size:14px;width:60%"><p><?php echo $proposal['name'];?></p></td>
									<td style="width:40%;font-weight:bold;font-size:13px;text-align:right"><?php echo $proposal['fdate'];?></td>
								</tr>
								<?php $arr_ph = explode(";",$proposal['address_line1']);
									
									$size = sizeof($arr_ph);?>
								<tr>
									<td  style="font-weight:bold;font-size:13px;width:60%"><i><?php echo str_replace(';', '<br />', $arr_ph[0]);  ?></i></td>
									<td style="width:40%;font-weight:bold;font-size:13px;text-align:right"><?php echo str_replace('<br />',';',$proposal['bill_no']);?></td>
								</tr>
								<?php for($i=1;$i<$size;$i++){?>
								<tr>
									<td  style="font-weight:bold;font-size:13px;width:80%"><i><?php echo str_replace(';', '<br />', $arr_ph[$i]);  ?></i></td>
									<td></td>
								</tr>
								<?php }?>
								<tr>
									<td  style="font-weight:bold;font-size:13px;width:80%"><i>GSTIN/UIN : <?php echo print_r($proposal['tin']);?></i></td>
									<td></td>
								</tr>
							</table>
							<br />
							<div id="main" style="margin-right:50px;">
								<?php $size = sizeof($items); echo str_replace("<hr />",'<pagebreak />',$proposal['text_preffix']);?>
								<?php  if($size> 0 ){?>
								<?php if($proposal['text_preffix'] != ''){?>
									<div class="col-sm-12 " >
										<br />
										<font style="font-size:14px;">Thank You ,<br /></font><br />
										For s<font style="color:red;font-size:16px;font-weight:bold">Tricolour Trading and Contracting</font><br />
										<img  style="float:left;" src="<?php echo base_url();?>uploads/images/jijo.png" />
									</div>
								<pagebreak>
								<?php } ?>
								<table style="border-collapse: collapse; width: 100%; height: 3150px;" border="1">
									<tr>
										<td style="font-weight:bold;text-align:center;width:5% !important" >Sl No</td>
										<?php if($proposal['is_make'] == 'yes'){?>
											<td style="font-weight:bold;text-align:center;width:45% !important";>DESCRIPTION</td>
											<td style="font-weight:bold;text-align:center;width:16% !important">MAKE</td>
										<?php }else{?>
											<td style="text-align:center;font-weight:bold;width:61% !important";>DESCRIPTION</td>
										<?php }?>
										<td style="text-align:center;width:7% !important;font-weight:bold;">QTY</td>
										<td style="text-align:center;width:7% !important;font-weight:bold;">UNIT</td>
										<td style="text-align:center;width:7% !important;font-weight:bold;">RATE</td>
										<td style="text-align:center;width:13% !important;font-weight:bold;">AMOUNT</td>
									</tr>
									<?php foreach($items as $item){?>
										<tr>
											<td style="text-align:center;width:5% !important" ><?php echo $item['col1'];?></td>
											<?php if($proposal['is_make'] == 'yes'){?>
												<td style="text-align:left;width:45% !important";><?php echo $item['col2'];?></td>
												<td style="text-align:center;width:18% !important"><?php echo $item['col3'];?></td>
											<?php }else{?>
												<td style="text-align:left;width:61% !important";><?php echo $item['col2'];?></td>
											<?php }?>
											<td style="text-align:center;width:7% !important"><?php if((float) $item['col6'] > 0  ){ echo round($item['col4'],0); } ?></td>
											<td style="text-align:center;width:7% !important"><?php echo $item['col5'];?></td>
											<td style="text-align:center;width:7% !important"><?php if((float) $item['col6'] > 0  ){echo round($item['col6'],2);}?></td>
											<td style="text-align:right;width:13% !important"><?php echo number_format((float)$item['col7'],2);?></td>
										</tr>
									<?php } ?>
								</table>
								
								<?php } ?>
								<?php  if($size> 0 || $proposal['text_preffix'] != ''){?>
									
									<?php if($proposal['text']!= '') {?>
										<pagebreak>
									<?php } ?>
								<?php }?>
								<?php if($proposal['text']!= '') {?>
								<?php echo str_replace("<hr />",'<pagebreak />',$proposal['text']);?>
								
								
								<?php } ?>
							</div>
						</div>
						
                        <!-- /.box -->
					</div>


</body>
</html>

