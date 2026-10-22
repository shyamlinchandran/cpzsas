<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '280px'; //if discont is 0
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
                <span style="text-align: center;font-size: 20px;">Packing Slip</span>
               
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
					   <?php if($sales[0]['address_line1']!=''){?><br />  <?php echo $sales[0]['address_line1'].'<br />'; ?> <?php }else{ echo '<br />'. $sales[0]['cusemail'];} ?>

						 
                          <?php
			   if($sales[0]['cusdetails']!=''){
                        echo 'Phone :' . $sales[0]['cusdetails'].'<br />';
                    }else{
                    if (isset($sales[0]['phone'])) {if($sales[0]['phone']!=''){
                        echo 'Phone :' . $sales[0]['phone'].'<br />';
                    }}

					
					}
                    ?>
                      
				</td>
                   <td style = "text-align:right" ><?php if($sales[0]['salesmanname'] !=''){?> SalesMan :<?php echo $sales[0]['salesmanname'].' <br />Salesman Ph :'. $sales[0]['salesmanphone']; ?> <?php }?></td>
                </tr>
                
            </table>
         <table   class="mt"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="topbr" > 
                    <th style=" width: 20px; text-align: center">Sl No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Description Of Goods</th>
                    <th class="center" style="width: 72px;  text-align: center">Unit</th>
                    <th  class="center" style="width: 75px;  text-align: center">Quantity</th>
                    <th  class="center" style="width: 120px;  text-align: center">MUM</th>
                </tr>

                <?php
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                $qty = 0 ;
                foreach ($sales_items as $item) {
                     $quantity = (float) $item['quantity'];
                        $subcount = (int) $item['subcount'];
                        $uname = $item['uname'];
                        $subname = $item['subname'];

                        if (empty($subname) || strtolower($subname) == 'null' || $subcount <= 1) {
                            $qty_display = round($quantity, 1) . ' ' . $uname;
                        } else {
                            $sub_units = floor($quantity / $subcount);
                            $remaining = $quantity % $subcount;

                            $qty_display = '';
                            if ($sub_units > 0) {
                                $qty_display .= $sub_units . ' BOX ';
                            }
                            if ($remaining > 0) {
                                if ($qty_display !== '') {
                                    $qty_display .= ' . ';
                                }
                                $qty_display .= round($remaining, 1) . ' ' . $uname;
                            }
                        }


                    $total = $total + $item['total'];
                    $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 1);
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($item['total'] - $item['tax']);
                    $i = $i + 1;
                    $qty = (float) $qty + (float) $item['quantity'] ;
                    ?>
                    <tr>
                        <td> <?php echo $i; ?></td>
                        <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                        
                        <td class="center"> <?php echo $item['uname']; ?></td>
                        <td class="center"> <?php echo round($item['quantity'], 1); ?></td>
                        <td class="center"> <?php echo $qty_display; ?></td>
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
                 
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>-->
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    <td> </td>
                    
                </tr>
            <?php } ?> 
					 <?php if ($inc == ($cpz + 1)) { ?> 

                       <tr>
                    <td>&nbsp; </td>
                 
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>-->
                    <td> </td>
                    <td> </td>
                    <td style="text-align:right"> <?php echo $qty;?></td>
                    <td> </td>
                    
                </tr>
                     <?php }?>
				
				
            </table>
                        <hr style="font-size: 13px; border: solid 1px #222;padding:0px;margin:0px; "/>  

           
			
			 <?php if ($inc == ($cpz + 1)) { ?> 
 
			 <?php }else{?>
				<div class="divk" style="text-align:right" >
				<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;<br />&nbsp;
				</div>
			  <?php }?>

         
        </div>
    </body>
</html>

