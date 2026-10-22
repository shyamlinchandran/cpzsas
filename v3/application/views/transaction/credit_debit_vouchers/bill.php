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
			.divmain{
				border : 1px solid black;
				padding :3px;
				width:100%;
			}
			.divsubhalf{
				width:49%;
				height:150px;;
			}
			.tableledger td{
				height:50px !important;
				
			}
			.tableledger th{
				height:50px !important;
			}

        </style>
    </head>
    <body style="width:100%;  padding: 0px; margin: 0; background-repeat:   no-repeat;  background-size: contain; background-image: url('<?= $img_file2 ?>')">
		<div class = "divmain" >
			<p style="padding: 0px;text-align:center;margin-bottom:0px;">
				<font style="font-size:18px;font-weight:bold"><?php echo $company['name'] ?></font><br />
				<font style="font-size:12px;"><?php echo $company['address'];?> , <?php echo $company['phone'] ?><br />
				GST No : <?php echo $company['tin'] ?> <br />
				<br />
				<font style="font-size:18px;font-weight:bold"><?php if($list[0]['type'] == 'credit_note'){echo 'Credit Note' ;}else{echo 'Debit Note';}?></font><br />
				</font>
			</p>
		</div>
		 <?php
            $al = 'left';
            $dir = 'right';
            $ms = "";
            $ar = '';
            
            ?>
		<div class = "divmain" style = "width:100%;padding:0px; margin: 0px;" >
			<div class = "divsubhalf col-sm-6"  style="padding: 0px;padding-left:3px;border-right:1px solid black;padding: 0px; margin: 0px; text-align: <?= $al ?>; float: <?= $al ?>">
				To ,<br />
				<b><?php echo $list[0]['mainledgername'];?></b>
				<?php if($list[0]['address'] != ''){echo '<br />'.$list[0]['address'];}?>
				<?php if($list[0]['supphone'] != ''){echo '<br />'.$list[0]['supphone'];}?>
				<?php if($list[0]['suptin'] != ''){echo '<br />GSTIN : '.$list[0]['suptin'];}?>
			</div>
			<div class = "divsubhalf col-sm-6"  style="padding: 0px;padding-left:3px; margin: 0px; text-align:left;float: <?= $al ?>">
				Voucher No		: <?php echo $list[0]['voucher_no'];?><br />
				Voucher Date 	:<?php echo $list[0]['tran_date'];?><br />
				Narration		:<?php echo $list[0]['narration'];?><br />
				Reference		:<?php echo $list[0]['ref_no'];?><br />
			</div>
		</div>
		<div class = "divmain" style = "width:100%;padding:0px; margin: 0px;" >
			<table class = "tableledger" style="width:100%;  padding:0px;  margin: 0px;" border="0">
				<tr>
					<th>
						Ledger
					</th>
					<th>
						Credit
					</th>
					<th>
						Debit
					</th>
				</tr>
			<?php $i = 0 ; $debit = 0;$credit = 0; foreach($list as $item){ $i++;?>
				<tr>
					<td style = "text-align:center">
						<?php echo $item['ledgername'];?>
					</td>
					<td style = "text-align:right" >
						<?php  $credit = (float) $credit + (float) $item['credit'] ;  echo $item['credit'];?>
					</td>
					<td style = "text-align:right">
						<?php  $debit = (float) $debit + (float) $item['debit'] ; echo $item['debit'];?>
					</td>
				</tr>
			<?php } ?>
			<?php if($i < 7){ for($i= 0 ;$i<7;$i++){?>
				<tr>
					<td>
						&nbsp;
					</td>
					<td style = "text-align:right" >
					</td>
					<td style = "text-align:right">
					</td>
				</tr>
			<?php }} ?>
				<tr>
					<th style = "font-size:16px;text-align:right">
						Total
					</th>
					<th style = "font-size:16px;text-align:right">
						<?php echo $credit ;?>
					</th>
					<th style = "font-size:16px;text-align:right">
						<?php echo $debit;?>
					</th>
				</tr>
			</table>
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
				<td style="width:50%;"></td>
				<th style="width:50%;">Authorised signatory</th>
			</tr>
		</table>
		</div>
	</body>
</html>

