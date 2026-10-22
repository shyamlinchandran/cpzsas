<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '215px'; //if discont is 0
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
$user = '';
$language = $this->language;
?>
<html>
    <head>
	 <link href="https://allfont.net/allfont.css?fonts=saxmono" rel="stylesheet" type="text/css" />
        <meta charset="UTF-8">
        <title></title>
        <style>
			@font-face {
			font-family: "saxMono";
			src: url("saxMono.ttf");}
           body {
			font-family: saxMono;
			font-size: 48px;
			text-shadow: 4px 4px 4px #aaa;
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
                text-align: center;
            }
            tr th {
                font-size: 14px;
                text-align: center;
                /*    // background-color: #ddd;*/
                color: #000
            }
            tr td {
                font-size: 13px;
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

                /*                border: 1px solid #ddd*/
            }
            .mt ,.mt tr:first-child ,.mt tr:first-child td {
                /*                border: 1px solid #ddd;
                                padding-right: 1px !important;*/
            } 
            .maintable tr:nth-child(odd) {

            }
            .mt,.mt  td  {
                /*                border-right:  1px solid #ddd;*/
                padding-right: 2px !important;
                padding-left:  2px !important;
                border-collapse: collapse;
            } 

            .topbr th{
                /*                border:   1px solid #ddd;*/
            }
            .mt th{
                /*                border-top:    1px solid #ddd;*/
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


            }
            .cls20{
                width:20%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
            }
            .cls50{
                width:50%;
                /*                background-color: #aaa;  */
                float: left;
                font-size: 13px;
				
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
                /*                background-color: #aaa;*/
            }
            body{
                /*                //border-color :#000;*/
                border :solid;
            }
            .hedrnd{
                /*                background-color: #fff;*/
                border-radius: 10px; 
                height: 140px; 
            }

            .hedrnd p{
                padding-left: 10px;
            }
            .mainhead{ 
                text-align:center;
                font-size:18px; 
                text-transform: uppercase;
                font-weight: bolder; 
                color: #000;
                text-decoration: underline;
                vertical-align: top;
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

        </style>
    </head>
    <body>

        <div style="width:100%;padding: 0px; margin: 10px; height:10px;">


        </div>
        <div style="width:100%;padding-left:0px;margin: 0px; margin-left:8px; height:40px;">

            <table style="width:100%;">
                <tr>
                    <td style="padding-top:10px;"><h1 style="font-size: 18px; font-weight: bold;text-align: left;"> </h1></td>
                    <td style="font-size: 14px;  padding-top:10px;"></td>
                    <td style="text-align: right;padding-right: 80px;">
                        <table style="height:70px;" >
                            <tr>
                                <td style="padding-top:16px;width: 50px"></td> 

                            </tr>

                        </table> 
                    </td> 
                </tr>
            </table>

        </div>    
       
        <div style="width:100%;padding:0px; margin: 0px; margin-top: 0px; height: 72px;">
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
            <div   style="text-align:left;padding-left:50px; ">
                <table style="margin-top: 10px;width:100%;">
                    <tr>
                        <td style="width:40%"></td>
                        <td style="width:30%;text-align:right"></td> 
                        <td style="width:30%;text-align:left"><?php echo $sales[0]['invoice'] ?>WWW GGG RTGTR ERFEFT</td> 
                    </tr>
					 <tr>
                        <td style="width:40%"><?php echo $sales[0]['cusname'] ?></td>
                        <td style="width:30%;text-align:right"></td> 
                        <td style="width:30%;text-align:left"><?php
                                    $date = explode('-', $sales[0]['invoice_date']);
                                    echo $date[0] . '/' . $date[1] . '/' . $date[2];
                                    ?></td> 
                    </tr>
                </table>
            </div> 
        </div>

        <div   style=" padding: 0px; margin: 0px;margin-top: 0px;">  

              <table   class="mt maintable"  cellpadding="5px" autosize="1"  width="100%" style="overflow: wrap"> 
                <?php
                $qty = 0;
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $bftax = 0;
                foreach ($sales_items as $item) {
					
                    $is_tax = $item['is_taxincluded'];
                    $itemrate = $item['mrp'];
                    if ($is_tax == 1 && $item['tax'] != 0) {
                        $itemrate = ($item['mrp'] * $item['quantity'] - $item['tax']) / $item['quantity'];
                    }
                    $total = $total + (($item['quantity'] * $item['mrps']));
                    $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                    $gtoamt = $gtoamt + round($itemrate * $item['quantity'], 2);
                    $txamt = $txamt + $item['tax'];
                    $netamt = $netamt + ($item['total']);
                    $qty = $qty + $item['quantity'];
                    $i = $i + 1;
                    ?>
                    <tr> 
                        <td style="width:12px;padding-left:1px;text-align: right"> <?php echo $i; ?></td>
                        <td style="font-weight:700;font-size: 11px; width:135px; text-align: left"> <?php echo strtoupper($item['name']); ?></td>
                        <td style="width:50px;font-size: 11px;text-align: right;"> <?php echo $item['hsncd'] ?>&nbsp;</td>
                        <td style="font-size: 11px; text-align: right;width:40px;"> <?php echo number_format($item['quantity'], 2); ?></td> 
                        <td style="width:50px;font-size: 11px; text-align: right;"> <?php echo number_format($itemrate, 2); ?></td>  
                        <td style="width:55px;font-size: 11px;  text-align: right"> <?php echo number_format($itemrate * $item['quantity'], 2); ?></td>
                        <td style="width:37px;font-size: 11px; text-transform: capitalize;text-align: right"> <?php echo number_format($item['dis_amt'],2); ?></td>
                        <td style="width:55px;font-size: 11px;  text-align: right"> <?php echo number_format(($itemrate * $item['quantity'])-$item['dis_amt'], 2); ?></td>
						<td style="width:45px;font-size: 11px; text-align: right"> <?php echo number_format($item['sgst'], 2); ?></td> 
                        <td style="width:70px;font-size: 11px;  text-align: right"> <?php echo number_format($item['tax']/2, 2); ?></td> 
					<td style="width:45px;font-size: 11px;  text-align: right"> <?php echo number_format($item['cgst'], 2); ?></td> 
                        <td style="width:70px;font-size: 11px;  text-align: right"> <?php echo number_format($item['tax']/2, 2); ?></td> 
                        <td style="font-size: 11px;  text-align: right"> <?php echo number_format($item['total'], 2); ?></td>
                        <td style="font-size: 11px;  text-align: right"> &nbsp;</td>
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
                        <td> </td>
                        <td> </td>
                        <td> </td> 
                    </tr>
                <?php } ?> 



            </table> 


           
                <div>

                    <div>
                        <table style="padding-top: 8px; font-weight: bold; margin: 0px; margin-right: 0px; width: 100%; text-align:<?= $dir ?>">
                            <tr> 
                                <td style="height:34px;padding-right:35px; text-align: right; width:33%"><?php
                                   
                                    ?></td>
                                <td></td>
                                <td style="height:10px; text-align: right;padding-right:20px;"><b> <?php if ($inc == ($cpz + 1)) { ?> <?php } ?><?php   echo $sales[0]['total'];; ?> </b></td>  
                            </tr>
                        </table>

                    </div>
                </div>




	
        </div>
    </body>
</html>

