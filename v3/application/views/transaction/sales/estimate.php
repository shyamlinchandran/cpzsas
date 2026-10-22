<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$login_comid = $this->session->userdata('login_base_comid');
$title = 'ESTIMATE';
if($login_comid == 'cloudcakes'){
$title = 'Proforma Invoice';
}

$itemwd = '325px'; //if discont is 0
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
			.divk{
				height:300px !important;
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
        <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
            <table>
                <tr>
                    <td></td>
                    <td style="text-align: center;font-size: 12px"></td>
                    <td class="right"><br/></td>
                </tr>
            </table>
            <span style="text-align: center"> 
                <span style="text-align: center;font-size: 20px;"><?php echo $title;?></span>
               
                <br/>
            </span>
            


            <hr style="border: solid 1px #222; "/>
            <table style="padding: 2px;  margin: 0px; width: 100%;">
                <tr>
                    <td> V No :<?php echo $sales[0]['invoice'] ?> </td>
                    <td style = "text-align:right" >  Date  : <?php echo $sales[0]['in_date'] ?></td>
                </tr>
                <tr>
                   <td>To <br /><?php  if($sales[0]['cusname'] != '') {echo $sales[0]['cusname'] ;}else {echo 'Cash';}?>
					   <?php if($sales[0]['address_line1']!=''){?>  <?php echo $sales[0]['address_line1'].'<br />'; ?> <?php } ?>
						 <?php if($sales[0]['phone']!=''){?>  <?php echo $sales[0]['phone'].'<br />'; ?> <?php } ?>
				</td>
                   <td></td>
                </tr>
                
            </table>
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th  class="center" style="width: 45px;  text-align: center">Unit</th>
                    <th  class="center" style="width: 50px;  text-align: center">Quantity</th>
                    <th class="center" style="width: 42px;  text-align: center">Rate</th>
                    <th class="center" style="width: 85px;  text-align: center">Total</th>

                </tr>

                <?php
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                foreach ($sales_items as $item) {
                    $total = $total + $item['total'];
                    $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 1);
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($item['total'] - $item['tax']);
                    $i = $i + 1;
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['uname']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?></td>
                        <td class="center"> <?php echo round($item['mrp'], 2); ?></td>
                        <td class="center"> <?php echo number_format($item['total'], 2); ?></td>
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
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>
                    <td> </td>-->
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    
                </tr>
            <?php } ?> 
           
				
				
            </table>
            
			 <?php if ($inc == ($cpz + 1)) { ?> 
				
				<?php $sales_ledgers = $sales_ledgers->result_array(); $sales_ledger_cnt = 0 ;foreach($sales_ledgers as $item) { $sales_ledger_cnt++ ;?>
                        <hr />
						<?php if($sales_ledger_cnt < 2){?>
							<table class="mt" style="width:100%;  padding:0px; margin: 0px;">
							<!-- <tr class="topbr" > 
								<th style=" width: 69.4%;">Ledger Name</th>
								<th style="text-align:left; width: 10.5%;">Taxable Value</th>
								<th style="text-align:left; width: 7.7%;">Tax</th>
								<th style="text-align:left; width: 12.2%;">Ledger Total</th>

							</tr> -->
						<?php }?>
                        <tr>
								<td style="text-align:right; width: 100%;font-size:12px"> Total : <?php echo $total;?> </td>

						</tr>
						<tr>
								<td style="text-align:right; width: 100%;font-size:12px"> <?php echo $item['name'];?> : <?php echo $item['amount'] + $item['tax'];?></td>

						</tr>
						<?php if($sales_ledger_cnt < 2){?>
							</table>
						<?php }?>
				<?php }?>
				<table class="mt" style="width:100%;  padding:0px; margin: 0px;">
                <?php if($sales[0]['discount'] > 0 ){?>
                    

                    <tr>
						<th style=" width: 69.4%;text-align:left;padding-left:40px;">&nbsp;&nbsp;&nbsp;<?php if ($inc == ($cpz + 1)) { ?> <?php //echo 'Amount in Words :' . $msd;?><?php } ?></th>
						<th style="text-align:left; width: 10.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php //echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th colspan = "2" style="text-align:right; width: 19.9%;">Total : <?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['total'] + $sales[0]['discount']; ?><?php } ?></th>

					</tr>

                    <tr>
						<th style=" width: 69.4%;text-align:left;padding-left:40px;">&nbsp;&nbsp;&nbsp;<?php if ($inc == ($cpz + 1)) { ?> <?php //echo 'Amount in Words :' . $msd;?><?php } ?></th>
						<th style="text-align:left; width: 10.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php //echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th colspan = "2" style="text-align:right; width: 19.9%;">Bill Discount : <?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['discount']; ?><?php } ?></th>

					</tr>
                <?php }?>

					<tr>
						<th style=" width: 69.4%;text-align:left;padding-left:40px;">&nbsp;&nbsp;&nbsp;<?php if ($inc == ($cpz + 1)) { ?> <?php echo 'Amount in Words :' . $msd;?><?php } ?></th>
						<th style="text-align:left; width: 10.5%;"><?php if ($inc == ($cpz + 1)) { ?> <?php //echo round($sales[0]['total'] - $sales[0]['tax'] - $sales[0]['cess'], 2); ?><?php } ?></th>
						<th colspan = "2" style="text-align:right; width: 19.9%;">Bill Total : <?php if ($inc == ($cpz + 1)) { ?> <?php echo $sales[0]['total']; ?><?php } ?></th>

					</tr>
                     <?php if($login_comid == 'tspices'){?>
                    <tr>
                        <th style ="text-align:right"  colspan ="4">Previous Balance : <?php echo  $sales[0]['previous']; ?></th>
                    </tr>
                    <tr>
                        <th style ="text-align:right"  colspan ="4">Total Outstanding : <?php echo  $sales[0]['gtot']; ?></th>
                    </tr>
                    <?php }?>
				</table>
			<?php } ?>
		 
            
  
            <!-- <hr style="font-size: 13px; border: solid 1px #222; "/>  
			
			 <?php if ($inc == ($cpz + 1)) { ?> 
 
			 <?php }else{?>
				<div class="divk" >
				<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;
				</div>
			  <?php }?> -->

          
            <hr style=" <?php if ($inc == ($cpz + 1)) { }else{echo 'margin-top:100px;';} ?> border: solid 1px #222; "/>
           
        </div>
    </body>
</html>

