<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '212px';
$itemwd = '205px'; //if discont is 0
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
                font-size: 12px;
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
            .cls33{
                width:40%;
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

        </style>
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">

        <div style="width:100%;padding: 0px; margin: 0px; height: 70px;">

<!--            <div class="cls33 txtleft hedrnd" style="text-align: left;">
                <h2><?php echo $company['name'] ?> </h2>
                <p><?php echo $company['address'] ?>
                    <br/>
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Tax ID', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  

            </div>-->
<!--            <div class="cls20"> 
                <img align="middle"  style="margin: 30px" width="90" height="110"  src="uploads/company/<?php echo $company['logo'] ?>" />   
            </div>
            <div class="cls33 txtright hedrnd" style="text-align: right;">
                <h2><?php echo $company['name_lan'] ?> </h2>
                <p><?php echo $company['address_lan'] ?>
                    <br/> 
                    <?= label('Phone', $this, $user) ?> :<?php echo $company['phone'] ?> <br/>
                    <?= label('Tax ID', $this, $user) ?> :<?php echo $company['tin'] ?> 
                </p>  
            </div>-->


        </div>
        <div style="width:100%;padding:0px; margin: 0px; height: 70px;">
            <?php
            $al = 'left';
            $dir = 'right';
            $ms = "";
            $ar = '';
            
            ?>

            <div class="cls33 txtleft" style="text-align: <?= $al ?>; float: <?= $al ?>">
                <h3><?= label('To', $this, $user) ?></h3> 
                <h3><?php echo $sales[0]['cusname'] ?></h3>  
                <p style="padding: 0px;margin: 0px;"><?php echo $sales[0]['address_line1'] ?></p>  
                <p style="padding: 0px;margin: 0px;"><?php
                    if (isset($sales[0]['phone'])) {
                        echo 'Phone :' . $sales[0]['phone'];
                    }
                    ?>
                </p>  
                <p style="padding: 0px;margin: 0px;"><?php
                    if (isset($sales[0]['tin'])) {
                        echo 'Vat# :' . $sales[0]['tin'];
                    }
                    ?>
                </p>
            </div> 
            <div class="cls20 mainhead" style="text-align:center;float: <?= $al ?>"> 
                <p> <?= label('Estimate', $this, $user) ?>  </p>
            </div>
            <div class="cls33" style="text-align: <?= $dir ?>; ">  
                <p  dir="<?= $ms ?>" style="font-size:16px ; font-weight: bold;"><?= label('V No:', $this, $user) ?>:#<?php echo $sales[0]['invoice'] ?></p>
                <p style="padding: 0px;margin: 0px;" dir="<?= $ms ?>"> <?= label('Date', $this, $user) ?> :<?php echo $sales[0]['in_date'] . ' 00:00:00' ?> </p> 
        </div>


    </div> 

    <div style="padding: 0px; margin: 0px;">  
<!--        <table style="padding: 2px;  margin: 0px; width: 100%;">
            <tr>
                <td><?= label('Transportation Mode', $this, $user) ?> : </td>
                <td>Date Of Supply :<?php echo $sales[0]['invoice_date'] ?> </td>
            </tr>
            <tr>
                <td>  </td>
                <td>State : </td>
            </tr>
            <tr>
                <td><?= label('Dispatch Number', $this, $user) ?> : </td>
                <td><?= label('E-Way Bill Number', $this, $user) ?> :<?php echo $sales[0]['ewb_no'] ?> </td>
            </tr>
        </table>-->
        <table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 5px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th style="width: <?php echo $itemwd; ?>px;  text-align: center"><?= label('Description Of Goods', $this, $user) ?></th>
                <th  class="center" style="width: 30px;  text-align: center"><?= label('Qty', $this, $user) ?></th>
				<th  class="center" style="width: 30px;  text-align: center"><?= label('Rate', $this, $user) ?></th>
				<th  class="center" style="width: 45px;  text-align: center"><?= label('Total', $this, $user) ?></th>

            </tr>

            <?php
            $qty = 0;
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
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total'] - $item['tax']);
                $qty = $qty + $item['quantity'];
                $i = $i + 1;
                ?>
                <tr>
                    <td> <?php echo $i; ?></td>
                    <td style="text-transform: capitalize;"> <?php echo $item['name']; ?></td>
                    <td class="center"> <?php echo number_format($item['quantity'], 2); ?></td>
					 <td class="center"> <?php echo number_format($item['mrp'], 2); ?></td>
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
                    <td> </td>
                    <td> </td>

                </tr>
            <?php } ?> 
            <tr>
                <th> </th>
                <th style="text-transform: capitalize;"><?= label('Total', $this, $user) ?></th>
                <th class="left"> <?php echo number_format($qty, 2); ?></th>
				 <th class="left"></th>
                <th class="left"> <?php echo number_format($total, 2); ?></th>
	
            </tr>
        </table>

        <?php if ($inc != ($cpz + 1)) { ?> 
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
                    </tr>

                <?php } ?> 
            </table>
        <?php } ?>

        
    </div>
</body>
</html>

