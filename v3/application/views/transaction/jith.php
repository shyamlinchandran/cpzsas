<?php
$is_discount = 1;
$is_bankac = 1;
//$itemwd = '210px';
$itemwd = '180px'; //if discont is 0
$itemwdb = '220px'; //if discont is 0
$com = substr($company['tin'], 0, 2);
$com =32;
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

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
            .mtn {
                border-collapse: collapse;  /* Ensure borders collapse properly */
            }

            .mtn tr td th{
                border-right:  0.5px solid  #333  ; 
                padding-right: 2px !important;
                padding-left:  2px !important;
            }
            .mtn ,.mtn tr:first-child ,.mtn tr:first-child td {
                border: 1px solid #222 ;
                padding-right: 1px !important;
            } 
            .mts  {
                font-weight:bold;
                border:  solid 1px #444; 
            }
            .mtnx tr th{
                padding:5px;
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
            .div4{
                width:25%;
                float: left;
            }
            .div15{
                width:15%;
                float: left;
            }
            .div10{
                width:10%;
                float: left;
            }
            .div50{
                width:50%;
                float: right;
            }
            .container {
        display: flex;
        flex-wrap: nowrap;
    }

    .mtn tr td{
        border-top:1px solid black;
        padding:4px;
    }

        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px; ">
            <table>
                <tr>
                    <td></td>
                    <td style="text-align: center;font-size: 12px"></td>
                    <td class="right"><br/></td>
                </tr>
            </table>
            <p style="text-align: center;font-size: 14px;font-weight:bold">TAX INVOICE</p>
            <div style="width:100%;padding:0px; margin: 0px; height: 70px;">
                <div class ="div4" style ="float:left;text-align:left">
                    <b style="font-size: 12px">Bill From:</b><br />
                   <p style ="padding-top:0px;margin-top:0px;font-size:10px" > JITH & JITH ENTERPRISES<br />
                    GROUND FLOOR 33/340-1<br />
                    NEDUMPALLIL,<br />
                    THATTEKKAD ROAD <br />
                    Pin Code : 682040<br />
                    Ph. No. : 9946511139 <br />
                    GSTIN No. :32CWZPJ7567C1Z1 <br />
                    State Code :32<br />
                    State Name : Kerala</p>
                </div>
                <div class ="div4" style ="float:left">
                    <b style="font-size: 12px">Billed to:</b>
                    <p style ="margin-right:10px;padding-top:0px;margin-top:0px;font-size:10px" > <?php echo $sales[0]['cusname'] ?><br />
                    <?php echo $sales[0]['address_line1'] ?><br />
                    Pincode :<?php echo $sales[0]['pincode'] ?><br />
                    Ph No. :<?php echo $sales[0]['phone'] ?> <br />
                    GSTIN No. :<?php echo $sales[0]['tin'] ?> <br />
                    State Code :32<br />
                    State Name : Kerala</p>
                </div>
                <div class ="div4" style ="float:left">
                    <b style="font-size: 12px">Shipped to :</b>
                    <p style ="margin-right:10px;padding-top:0px;margin-top:0px;font-size:10px" > <?php echo $sales[0]['cusname'] ?><br />
                    <?php echo $sales[0]['address_line1'] ?><br />
                    Pincode :<?php echo $sales[0]['pincode'] ?><br />
                    Ph No. :<?php echo $sales[0]['phone'] ?> <br />
                    GSTIN No. :<?php echo $sales[0]['tin'] ?> <br />
                    State Code :32<br />
                    State Name : Kerala</p>
                </div>
                <div class ="div4" style ="float:left">
                   <table style ="padding:0px;">
                        <tr>
                            <td style="line-height:10px;width:40%">Invoice #</td>
                            <td style="width:5%">:</td>
                            <td style="width:55%;font-weight:bold;font-size:10px"><?php echo $sales[0]['invoice'] ?></td>
                        </tr>
                        <tr>
                            <td >Invoice Date</td>
                            <td >:</td>
                            <td style="font-weight:bold;font-size:10px"><?php echo $sales[0]['in_date'] ?></td>
                        </tr>
                        
                        <tr>
                            <td style="width:40%">Discount</td>
                            <td style="width:5%">:</td>
                            <td style="width:55%;font-weight:bold;font-size:10px"> Premier Lite</td>
                        </tr>
                        <tr>
                            <td style="width:40%">Group</td>
                            <td style="width:5%"></td>
                            <td style="width:55%;font-weight:bold;font-size:10px">On-invoice</td>
                        </tr>
                        <tr>
                            <td >Salesman</td>
                            <td >:</td>
                            <td style="font-weight:bold;font-size:10px"><?php echo $sales[0]['salesmanname'] ?></td>
                        </tr>
                        <tr>
                            <td >Route</td>
                            <td >:</td>
                            <td style="font-weight:bold;font-size:10px"><?php echo $sales[0]['areaname'] ?></td>
                        </tr>
                        <tr>
                            <td >Doc Ref #</td>
                            <td >:</td>
                            <td style="font-weight:bold;font-size:10px"><?php echo $sales[0]['ref_no'] ?></td>
                        </tr>
                        <tr>
                            <td >PO Ref. #</td>
                            <td >:</td>
                            <td style="font-weight:bold;font-size:10px"></td>
                        </tr>
                        <tr>
                            <td >No</td>
                            <td ></td>
                            <td style="font-weight:bold;font-size:10px"></td>
                        </tr>

                   </table>
                </div>


                <!-- <div class ="div10" style ="float:left">
                    <span style="font-size: 12px"> Invoice # <br />
                    Invoice Date<br />Discount<br />Group<br />Salesman<br />Route<br />Doc Ref #:<br />PO Ref .:<br />No
                </div>
                <div class ="div15" style ="float:left">
                    <span style="font-weight:bold;font-size: 10px"> : &nbsp;<?php echo $sales[0]['invoice'] ?> <br />
                    : &nbsp;<?php echo $sales[0]['in_date'] ?><br /><br /><br />: &nbsp;Premier Lite<br /> &nbsp;&nbsp;On-invoice<br />:&nbsp;<?php echo $sales[0]['salesmanname'] ?><br />:&nbsp;Cheranellur<br />:&nbsp;SO24121696838
                    
                </div>   -->
            </div>     
            
            <table class ="mts" style ="margin:1px:solid black;width:100%;margin-top:10px;margin-bottom:15px;" >
                <tr>
                    <td style ="width:70%;">IRN :</td>
                    <td style ="width:15%;">Ack. No :</td>
                    <td style ="width:15%;">Ack. Date :</td>
                </tr>
            </table>
           
         <table   class="mtn"  style="width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="" > 
                    <th style=" width: 20px; text-align: center;border-right:1px solid black;">Sr No</th>
                    <th style="width: <?php echo $itemwd; ?>px;  text-align: center;border-right:1px solid black;">Description Of Goods/Services</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">HSN/SAC<br />Code</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">Quantity</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">MRP</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">Unit Price</th>
                    <th class="center" style="width: 40px;  text-align: center;border-right:1px solid black;">Sch Dis</th>
                    <th  class="center" style="width: 45px;  text-align: center;border-right:1px solid black;">Taxable <br />Amount</th>
                    <th class="center" style="width: 35px;  text-align: center;border-right:1px solid black;">Tax <br />Rate(%)</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">CGST</th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;">SGST</th>
                    <th  class="center" style="width: 50px;  text-align: center">Total<br /> Amount</th>
                </tr>

                <?php
                $qty = 0;
                $SQFTNO = 0;
                $ItemSQFT = 0;
                $total = 0;
                $totdis = 0;
                $txamt = $gtoamt = 0;
                $netamt = 0;
                $i = $len;
                $gross_tot = 0;
                $bftax = 0;
                $sdiscount = 0;
                $mrp_tot = 0;
                foreach ($sales_items as $item) {
                    $sal_itms_mrp =  $item['sal_itms_mrp'] ;
                    if($sal_itms_mrp < 1){
                        $sal_itms_mrp = $item['MRP'];
                    }
                    $mrpp =  $item['mrp'];
                    $GSTp =$item['GST'];
                    $beforeTaxmrp = $mrpp / (1 + $GSTp / 100);  // Inclusive GST formula
                    $beforeTaxm = $item['mrp'] / (1 + ($GSTp / 100));
                    $beforeTaxm = round($beforeTaxm,2);
                    $beforeTaxmrp = $beforeTaxmrp * $item['quantity'];
                    $gross_tot = $gross_tot + $beforeTaxmrp;
                    $mrp_tot = $mrp_tot + ($item['quantity'] * $sal_itms_mrp) ;
                    $total = $total + $item['total'];
                    $discount = $item['dis_amt'] ;
                    $totdis = $totdis + $discount;
                    $bftax = $bftax + round($item['total'] - $item['tax'], 1);
                    $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                    $txamt = $txamt + $item['tax'];
                    $sdiscount = $sdiscount + $item['add_dis_amt'];
                    $netamt = $netamt + ($item['total'] - $item['tax']);
                    $i = $i + 1;
                    $qty = $qty + $item['quantity'];
                    ?>
                    
                    <tr class="" > 
                    <td style=" width: 20px; text-align: center;border-right:1px solid black;"><?php echo $i;?></td>
                    <td style="width: <?php echo $itemwd; ?>px;  text-align: left;border-right:1px solid black;"><?php echo $item['name'];?></td>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo $item['hsncd'];?></td>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo $item['quantity'];?></td>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo $sal_itms_mrp;?></t>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo $beforeTaxm;?></>
                    <td class="center" style="width: 40px;  text-align: center;border-right:1px solid black;"><?php echo $item['add_dis_amt'];//$item['name'];?></td>
                    <td  class="center" style="width: 45px;  text-align: center;border-right:1px solid black;"><?php echo round($item['total'] - $item['tax'], 2); ?></td>
                    <td class="center" style="width: 35px;  text-align: center;border-right:1px solid black;"><?php echo $item['GST'];?></td>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo number_format($item['tax']/2, 2); ?></td>
                    <td  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo number_format($item['tax']/2, 2); ?></td>
                    <td  class="center" style="width: 50px;  text-align: center"><?php echo number_format($item['total'],2); ?></td>
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
			if ($inc == ($cpz + 1)) {
				$len = $len  - sizeof($hsndetails);
			}
            $len = 0;
            for ($k = 0; $k < $len; $k++) {
                ?> 
                <tr>
                    <td>&nbsp; </td>
                    <td> </td>
    <!--                    <td> </td>-->
    <!--                    <td> </td>
                    <td> </td>
                    <td> </td>-->
                    <!-- <td> </td>
                    <td> </td> -->
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
			
		 <br />
         <table   class="mtn mtnx"  style="padding:10px;width:100%;  padding:0px;  margin: 0px;" border="0">
                
                <tr class="" > 
                    <th style="width: 212px;  text-align: right;border-right:1px solid black;">Total</th>
                    <th  class="center" style="width: 53px;  text-align: center;border-right:1px solid black;"></th>
                    <th  class="center" style="width: 55px;  text-align: center;border-right:1px solid black;"><?php echo number_format($qty, 2); ?></th>
                    <th  class="center" style="width: 55px;  text-align: center;border-right:1px solid black;"></th>
                    <th  class="center" style="width: 55px;  text-align: center;border-right:1px solid black;"></th>
                    <th class="center" style="width: 40px;  font-size:10px; text-align: center;border-right:1px solid black;">0</th>
                    <th  class="center" style="width: 45px;font-size:10px;  text-align: center;border-right:1px solid black;"><?php echo number_format($sales[0]['total'] + $sales[0]['discount'] - $sales[0]['tax'], 2); ?> </th>
                    <th class="center" style="width: 35px;  text-align: center;border-right:1px solid black;"></th>
                    <th  class="center" style="width: 50px;  text-align: center;border-right:1px solid black;"><?php echo number_format($sales[0]['tax']/2, 2); ?></th>
                    <th  class="center" style="width:10px;  text-align: center;border-right:1px solid black;"><?php echo number_format($sales[0]['tax']/2, 2); ?></th>
                    <th  class="center" style="width: 10px;  text-align: center"><?php echo number_format(($sales[0]['total'] + $sales[0]['discount']  +  $sales[0]['redeemed_amount'] ), 2); ?></th>
                </tr>
            </table>
            <p style="padding-left:100px;font-size:10px;font-weight:bold"> Amt. in word(s) : <?php echo $msd;?> </p>
            <table   class="mtn mtnx"  style="padding:10px;width:100%;  padding:0px;  margin: 0px;" border="0">
                <tr class="" > 
                    <td style ="border-right:1px solid black;width:10%"> <span style="font-weight:bold">Gross Amt</span> <br /> <?php echo round($gross_tot,2) ;?></td>
                    <td style ="border-right:1px solid black;width:10%"><span style="font-weight:bold"> Total Amt<br />(MRP)</span><br /> <?php echo $mrp_tot;?> </td>
                    <td style ="border-right:1px solid black;width:10%"> <span style="font-weight:bold">Trade Payout<br />Amt.</span><br /> <?php echo $totdis;?> </td>
                    <td style ="border-right:1px solid black;width:10%"> <span style="font-weight:bold">MTD Payout<br />Amt.</span><br /> <?php echo $totdis;?> </td>
                    <td style ="border-right:1px solid black;width:10%"><span style="font-weight:bold">Cash Disc. Amt.</span><br /> 0 </td>

                    <td style ="border-right:1px solid black;width:10%"><span style="font-weight:bold">Total Credit<br /> Amt</span> <br /> 0 </td>
                    <td style ="border-right:1px solid black;width:10%"><span style="font-weight:bold"> Total Debit<br /> Amt</span><br /> 0 </td>
                    <td style ="border-right:1px solid black;width:10%"><span style="font-weight:bold">Sch. Disc<br /> Amt</span> <br /> <?php echo $sdiscount;?> </td>
                    <td style ="border-right:1px solid black;width:10%"> <span style="font-weight:bold">TCS Amount<br />Amt.</span><br /> 0 </td>
                    <td style ="width:10%"><span style="font-weight:bold">Net Payable<br /> Amt.</span><br /> <?php echo $sales[0]['total'];?> </td>

                </tr>
            </table>
        </div>

        <div style="width:100%;padding:0px; margin: 0px; height: 70px;">
            <div class ="div50" style ="float:right;text-align:left;padding-top:10px;">
            <table   class="mtn mtnx"  style="padding:10px;width:100%;  padding:0px;  margin: 0px;" border="0">
                 <tr class="" > 
                        <td style ="text-align:center;border-right:1px solid black;" colspan ="3"> <span style="font-weight:bold"> **Scheme Details**</span></td>
                        
                    </tr>
                     <tr class="" > 
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%"> <span style="font-weight:bold">Scheme Desc</span></td>
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%"><span style="font-weight:bold"> Scheme From</span></td>
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%"> <span style="font-weight:bold"> Scheme Till</span></td>
                        
                    </tr>
                    <tr class="" > 
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%;height:20px;"><?php echo $sales[0]['schemedesc'];?> <span style="font-weight:bold"></span></td>
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%"><?php echo $sales[0]['schemefrom'];?><span style="font-weight:bold"></span></td>
                        <td style ="text-align:center;border-right:1px solid black;width:33.33%"><?php echo $sales[0]['schemetill'];?> <span style="font-weight:bold"> </span></td>
                        
                    </tr>
                </table>
                <br />
            </div>
        </div>
        <span style ="font-size:12px;font-weight:bold">Internal Reference No.: <?php echo $sales[0]['ref_no'] ?></span>

        <div style="width:100%;padding:0px; margin: 0px; height: 70px;">
            <div class ="div50" style ="float:left;text-align:left;padding-top:10px;">
          <span style ="font-size:12px;">  Declaration: <br />
            1) Whether the tax is payable on reverse charge basis-No. <br />
            2) We declare that this invoice shows the actual price of the goods  <br />
               &nbsp;&nbsp; described and that all particulars are true and correct <br /></span>
            </div>


            <div class ="div50" style ="float:right;text-align:right;padding-top:10px;">
          <span style ="text-align:right;font-size:10px;"><b> FOR : JITH & JITH ENTERPRISES</b></span>
<br /><br /><br />
          <span style ="text-align:right;font-size:10px;"><b>Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></span>

            </div>


        </div>
    </body>
</html>

