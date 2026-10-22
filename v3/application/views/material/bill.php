<?php
$language = $this->language;
$img_file2 = ''; // base_url() . 'assets/images/YkZqzX.jpg';
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
			.cls55{
				width:50%;
				float: left;
				margin:1px solid black;
			}
			.cls44{
				width:50%;
				float: left;
				margin:1px solid black;
			}
		

        </style>
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
		<p style="font-size:14px;text-align:center" ><b>Material <?php echo $material[0]['type'];?></b></p>
		<div style="width:100%;padding:0px; margin: 0px; ">
			<div class="cls55 txtleft"  style="padding:0px; margin: 0px; ">
				<div style="border:1px solid black;height:120px">
				JOB WORK ORDER
				</div>
				<div style="border:1px solid black;height:130px">
					JOB WORK ORDER
				</div>
				<div style="border:1px solid black;height:130px">
					JOB WORK ORDER
				</div>
			</div> 
			<div class="cls44"  style="padding:0px; margin: 0px; ">
				<table class="" style="width:100%;height:300px;border-collapse:collapse"  border="1" cellpadding="0" cellspacing="0">
					<tr >
						<td style="height:40px;">Challan No: <br /><?php echo 'date';?></td></td>
						<td >Dated : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;"> <br /></td>
						<td>Modern Terms of Payment : <br />Payment Adv</td>
					</tr>
					<tr>
						<td style="height:40px;">Ref No & Date: <br /><?php echo 'date';?></td>
						<td>Other References : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;">Buyers Order No: <br /><?php echo 'date';?></td>
						<td>Dated : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;">Despatch Doc No: <br /><?php echo 'date';?></td>
						<td style="height:40px;">Dated : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;">Despatch  Through: <br /><?php echo 'date';?></td>
						<td style="height:40px;">Destination : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;">Bill Of Landing: <br /><?php echo 'date';?></td>
						<td>Motor Vehicle No : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td style="height:40px;">Date & time of Issue: <br /><?php echo 'date';?></td>
						<td>Duration of Process : <br /><?php echo 'date';?></td></td>
					</tr>
					<tr>
						<td valign="top" style="text-align:left;height:55px;" colspan="2">Nature Of Processing: <br /><?php echo 'date';?></td>
					</tr>
				</table>
			</div>
		</div>
		<table   class="mt maintable"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr" > 
                <th style=" width: 40px; text-align: center"><?= label('SNo', $this, $user) ?></th>
                <th style="width: 400px;  text-align: left"><?= label(strtoupper ('Description Of Goods'), $this, $user) ?></th>
                <th  class="center" style="width: 80px;  text-align: center"><?= label(strtoupper('Quantity'), $this, $user) ?></th>
			   <th  class="center" style="width: 60px;  text-align: center"><?= label(strtoupper('Unit'), $this, $user) ?></th>
                <th class="center" style="width: 80px;  text-align: center"><?= label('RATE ', $this, $user) ?></th>
                <th class="center" style="width: 115px;  text-align: center"><?= label('TOTAL', $this, $user) ?></th>

            </tr>
			<?php
				$i = $len;
				foreach($material_items as $item){
				
				$i++;
			?>
				<tr>
					<td> <?php echo $i;?></td>
					<td style="text-align:left;" > <?php echo $item['item'].'<br />&nbsp;&nbsp;&nbsp;&nbsp;Components<br />&nbsp;&nbsp;&nbsp;&nbsp;'.$item['com_of']; ?></td>
					<td class="center"> <?php echo $item['quantity']; ?></td>
					<td class="center"> <?php echo $item['unit']; ?></td>
					<td class="center"> <?php echo $item['rate']; ?></td>
					<td class="center"> <?php echo $item['material_total']; ?></td>
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
                </tr>

                <?php } ?> 
        <?php } ?>
		 <?php if ($inc == ($cpz + 1)) { ?> 
			<tr>
                    <th>&nbsp; </th>
                    <th> </th>
					 <th> </th>
					<th> </th>
					<th> </th>
					<th> </th>
                </tr>
		 <?php } ?>
        </table>
	
	</body>
</html>

