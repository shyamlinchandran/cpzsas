<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        * {
            margin: 0;
        }

        .tab th,
        td {
            padding-top: 8px;
            padding-bottom: 8px;

        }

        .wrap {
            width: 1200px;
            margin: auto;
            background: white;
        }

        .header {
            height: 150px;
            background: white;
            padding-top: 50px;

            padding-right: 20px;
        }

        .nav {
            height: 50px;
            background: white;
        }

        .solid5 {
            border-top: 8px solid #bbb;
        }

        .left {
            width: 30%;
            height: 100px;
            float: left;
            background: white;



        }

        .right {
            width: 55%;
            height: 100px;
            float: left;
            text-align: left;
            padding-left: 95px;
            margin: 0px;
        }

        .clear {
            clear: both;
        }

        .footer {
            height: 80px;
            background: white;
        }

        body {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: 200;
            font-size: 85.25%;
            padding: 50px;

        }

        .alignright {
            float: right;

        }

        .column {
            float: left;
            width: 25%;
            line-height: 20px;
            font-size: 14px;

        }


        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        p.big {
            line-height: 1.8;
        }

        .clss3 {
            font-size: medium;
            font-style: normal;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: 260;
            margin: 0px;
            font-size: 13px;
            padding-left: 95px;


        }

        .clss22 {
            font-size: bold;
            font-style: normal;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: 260;
            padding-top: 20px;


        }

        .table1 {
            font-size: medium;
            font-weight: 100;
            font-size: 14px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;


        }

        .row2 {
            font-size: 20px;
            padding-top: 10px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;





        }

        .table1 td {
            background: black;
            border: 5px solid black;

        }

        table {
            border-collapse: collapse;

        }

        .solid1 {
            border-collapse: collapse;
            border: 5px solid black;
        }

        .table2 {
            padding-top: 120px;
            font-size: 14px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            line-height: 25px;
            border-bottom: 2pt solid black;


        }


        .column1 {
            float: left;
            width: 36%;
            line-height: 20px;
            font-size: 14px;
            padding-left: 1px;

        }

        .bottom_border {
            border-bottom: 1pt solid black;


        }

        .cls60 {

            line-height: 2.6;

        }

        .clss2 {
            line-height: 20px;
            font-size: 30px;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border-spacing: 10px;
        }

        .bottom_border2 {
            border-bottom: solid 2px black;
        }



        .cls40 {
            width: 100%;
            height: 620px;
            border: 1px solid black;
            float: center;
            margin-bottom: 60px;
            margin: 10px;
            margin-left: 30px;
            margin-right: 60px;


        }

        .cls10 {
            width: 10%;
            height: 300px;
            float: left;
        }

        .cls49 {
            width: 19.5%;
            height: 300px;
            float: left;
        }

        table,
        td {
            border-bottom: 1px solid black;
            border-collapse: collapse;
        }

        h4,
        h5 {
            text-align: center;
        }

        .topbr th {
            border: 1px solid #ddd;
        }



        .tabtr {
            text-align: center;

        }

        h2 {
            text-align: center;
        }

        .tab3 {
            padding-top: 5px;
        }

        th {
            padding-top: 1px;
        }
         
    </style>

    <head>

    <body>

        <div style="width:100%;padding-top:0px;margin-top:0px;">
            <!-- <img align="middle"  style="margin: 0px" height ="width:50px;"   src="uploads/company/A.jpg" />   -->

            <h2 style ="margin-top:0px;margin-bottom:10px;" >PACKING LIST</h2>
            <div class="cls40">

                <table class="tab" width="100%" border="1" cellpadding="2" cellspacing="3">
                    <tbody>
                        <tr>
                            <td rowspan="5" style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                   Exporter
                                    <br />
                                    <p style = "margin-top:10px;padding-top:10px;padding-left:5px;" ><b><?php echo $company['name'] ?></b> </p>
                                    <p style = "padding-left:5px;"><?php echo $company['address'] ?> </p>
                                    <p style = "padding-left:5px;">Phone: <?php echo $company['phone'] ?> </p>
                                    </br><br />
                                </div>
                                </br>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    INV No.& Date : <?php echo $sales[0]['invoice'] .' , '.$sales[0]['in_date']   ?>
                                    </br><br />
                                </div>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Exporter's Ref. :
                                    <br />
                                    <!-- <?php echo $sales[0]['exporter_ref'] ?> -->
                                </div>
                            </td>
                        </tr>
                        <tr rowspan="2">

                            <td colspan="2">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Buyer's Order No & Date:
                                    <br/>
                                    <br/>
                                    <!-- <?php echo $sales[0]['buyer_order_no'];?> -->
                                </div>
                            </td>
                        </tr>
                        <tr>

                            <td colspan="2">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <!-- Other References -->
                                    Other Exporter Details :

                                    <br/>
                                <br/>
                                     
                                    <!-- <?php echo $sales[0]['other_ref'];?> -->
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <!-- Other References -->
                                    PAN :

                                    <br/>
                                    <br/>
                                     
                                    <!-- <?php echo $sales[0]['other_ref'];?> -->
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <!-- Other References -->
                                   GST :

                                   <br/>
                                   <br/>
                                     
                                    <!-- <?php echo $sales[0]['other_ref'];?> -->
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <!-- Other References -->
                                  State :

                                  <br/>
                                  <br/>
                                     
                                    <!-- <?php echo $sales[0]['other_ref'];?> -->
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
                <table class="tab" width="100%" border="1" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr>
                            <td rowspan="5" width="50%">
                                <div class="cls60 " style="height:180px !important;font-size:12px;">
                                    Consignee
                                    <br />

                                    <p style = "padding-top:10px;" ><?php 
                                        if ($sales[0]['customer_id']==0){
                                            echo $sales[0]['cusname'] ;
                                        }
                                        else{
                                            echo $sales[0]['name'] ;
                                        }
                                    
                                        ?> 
                                    </p>
                                    <p><?php echo $sales[0]['address_line1'];?></p>
                                    <!-- <p>Phone: <?php echo $sales[0]['phone'];?> </p> -->
                                    </br><br />
                                </div>
                            </td>
                            <td colspan="3">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Buyer (if other than consignee) Notifying Party:
                                    <p><?php 
                                        if ($sales[0]['customer_id']==0){
                                            echo $sales[0]['cusname'] ;
                                        }
                                        else{
                                            echo $sales[0]['name'] ;
                                        }
                                    
                                        ?> 
                                    </p>
                                    <p><?php echo $sales[0]['address_line1'];?></p>
                                    <!-- <p>Phone: <?php echo $sales[0]['phone'];?> </p> -->
                                    </br><br />
                                </div>

                            </td>

                        </tr>
                        <tr rowspan="3" width=50%>
                            <td colspan = "2"> 
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Country of Origin of Goods:
                                    <br/><?php echo $sales[0]['country_origin_of_goods'];?> 
                                </div>
                            </td>
                            <td> 
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Country of Final Destination:
                                    <!-- </br>India -->
                                </div>
                            </td>
                        </tr>
                        <!-- <tr>

                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Country of Origin:
                                    </br><br />
                                </div>

                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                   INDIA
                                    </br><br />
                                </div>

                            </td>
                        </tr> -->
                        <!-- <tr>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Pre – carriage <br />
                                    <?php echo $sales[0]['pre_carriage'];?>
                                </div>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Place of Receipt by Pre-carriage<br />
                                    <?php echo $sales[0]['place_of_receipt'];?>

                                </div>
                            </td>
                            <td rowspan="5">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u> BANK DETAILS</u> </br>
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u><?php echo $company['comset_bank']; ?></u> </br>
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u>AFFINITY INTERNATIONAL</u> </br>
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u>C/A No: 007721010000022</u> </br>
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u>MICR: 682026909</u> </br>
                                </div>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u>Swift Code: UBININBBKCH</u> </br>
                                </div>
                            </td>


                        </tr>



                        <tr>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Vessel/Flight No.<br />
                                    <?php echo $sales[0]['flight_no'];?>
                                </div>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Port Of Loading
                                    <br />
                                    <?php echo $sales[0]['port_of_landing'];?>
                                </div>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Port Of Discharge
                                    <br />
                                    <?php echo $sales[0]['port_of_discharge'];?>
                                </div>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Final Destination
                                    <br />
                                    <?php echo $sales[0]['final_destination'];?>
                                </div>
                            </td>
                        </tr> -->


                    </tbody>
                </table>
                <table class="tab" width="100%" border="1" cellpadding="8" cellspacing="10">
                        <tr>
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Pre – carriage by <br />
                                    <?php echo $sales[0]['pre_carriage'];?>
                                </div>
                            </td>
                            
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Place of Receipt by Pre-carriage<br />
                                    <?php echo $sales[0]['place_of_receipt'];?>

                                </div>
                            </td>
                            <td style = "width:25%">
                            <div class="cls60 " style="height:40px;font-size:12px;">
                                   Terms of delivery and payment<br />
                                    <?php echo $sales[0]['place_of_receipt'];?>

                                </div>
                            </td>
                            <td rowspan = "5" style = "width:25%;">
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u> BANK DETAILS</u> </br></br></br>
                                </div>
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u><?php echo $company['comset_bank']; ?></u> </br>
                                </div>
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u>AFFINITY INTERNATIONAL</u> </br>
                                </div>
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u>C/A No: 007721010000022</u> </br>
                                </div>
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u>MICR: 682026909</u> </br>
                                </div>
                                <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                    <u>Swift Code: UBININBBKCH</u> </br>
                                </div>
                                   <br/>
                                   <br/>
                                   
                                    <div class="cls60 " style="margin-bottom:40px;height:60px;font-size:13px;">
                                  <b> OUR BANKERS : 
                                  <br/>
                            </td>
                           
                        </tr>
                        
                        <tr>
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                   Mode of Transport by AIR<br />
                                    <?php echo $sales[0]['flight_no'];?>
                                </div>
                                <br />
                                <br />
                            </td>
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Port Of Loading
                                   
                                    <?php echo $sales[0]['port_of_landing'];?>
                                </div>
                                <br />
                                <br />
                            </td>
                            <td>
                            <div class="cls60 " style="height:40px;font-size:12px;">
                                   Full payment before dispatched
                                  
                                    <?php echo $sales[0]['port_of_landing'];?>
                                </div>
                                <br />
                                <br />
                            </td>
                            
                        </tr>

                        <tr>
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Port Of Discharge
                                   
                                    <?php echo $sales[0]['port_of_discharge'];?>
                                   
                                </div>
                                <br />
                                    <br />
                            </td>
                            <td style = "width:25%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Final Destination
                                    <br />
                                    <?php echo $sales[0]['final_destination'];?>
                                </div>
                                <br />
                                <br />
                            </td>
                            <td rowspan="3">
                        <div class="cls60 " style="height:40px;font-size:12px;">
                                  End Use Code :
                                   
                                    <?php echo $sales[0]['final_destination'];?>
                                </div>
                                <br />
                        </td>
                        </tr>
                        <tr>
                            <td>
                            <div class="cls60 " style="height:40px;font-size:12px;">
                                  <!-- End Use Code :
                                    <br />
                                    <?php echo $sales[0]['final_destination'];?> -->
                                </div>
                            </td>
                            <td>
                            <div class="cls60 " style="height:40px;font-size:12px;">
                                  <!-- End Use Code :
                                    <br />
                                    <?php echo $sales[0]['final_destination'];?> -->
                                </div>
                            </td>
                                    </tr>
                                    <tr rowspan="4" style="width:50%">
                                        <td>
                                        <div class="cls60 " style="height:40px;font-size:12px;">
                                Marks & Nos/ :
                                   
                                   
                                </div>
                                <br/>
                                <br/>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                               Container No
                                    

                                   
                                </div>
                                <br/>
                                <br/>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                              MADE IN INDIA
                                   
                                   
                                </div>
                                <br />
                                    <br />
                                        </td>
                                        <td>
                                        <div class="cls60 " style="height:40px;font-size:12px;">
                                No & kind of Pkgs
                                  
                                    <?php echo $sales[0]['final_destination'];?>
                                </div>
                                <br />
                                <br />

                                        </td>
                                    </tr>

                       
                       


                </table>
                <table class="tab3" width="100%" border="1" cellpadding="0" cellspacing="0">
                    <tbody>
                        <tr rowspan="2">
                            <th style="width:10px;  text-align: center">
                                <?= label('Carton No.', $this, $user) ?>
                            </th>
                            <th style="padding-left:50px;padding-right:50px;width:165px !important;  text-align: center">
                                <?= label('Description of Goods &nbsp;&nbsp;&nbsp;', $this, $user) ?>
                            </th>
                            <th style="width:20px;  text-align: center">
                                <?= label('HSN Code', $this, $user) ?>
                            </th>
                            <th style="width:10px;  text-align: center">
                                <?= label('Quantity(Nos)', $this, $user) ?>
                            </th>
                            <th style="width:10px;  text-align: center">
                                <?= label('TOTAL Wt IN KG', $this, $user) ?>
                            </th>
                            <!-- <th style="width:15px;  text-align: center">
                            </th> -->
                            <th style="width:10px;  text-align: center">
                                <?= label('Rate per Unit(USD)', $this, $user) ?>
                            </th>
                            <th style="width:20px;  text-align: center">
                                <?= label('Total Amount(USD)', $this, $user) ?>
                            </th>
                        </tr>
                        
            <?php
            $qty =0;
            $total = 0;
            $totdis = 0;
            $txamt = $gtoamt = 0;
            $netamt = 0;
            $i = $len;
            $bftax = 0;
			$tot_itm_raw_ces = 0;
            foreach ($sales_items as $item) {
				$tot_itm_raw_ces = (float) $tot_itm_raw_ces + (float) $item['itm_raw_ces'];
                $total = $total + $item['total'];
                $discount = ($item['quantity'] * ($item['mrps'] * $item['rate'] / 100));
                $totdis = $totdis + $discount;
                $bftax = $bftax + round($item['total'] - $item['tax'], 2);
                $gtoamt = $gtoamt + round($item['quantity'] * $item['mrps'], 2);
                $txamt = $txamt + $item['tax'];
                $netamt = $netamt + ($item['total'] - $item['tax']);
                $qty =$qty+$item['quantity'];
                $i = $i + 1;
				
				$rate = $item['mrp'];
				$per = 0;
				if((float) $item['GST'] > 0 ){
					$per = (float) $per + (float) $item['GST'];
				}
				if((float) $sales[0]['saletype'] ==  'b2c' && (float) $sales[0]['cess'] > 0  ){
					if((float)$item['ces_amt'] > 0  ){
						$per = (float) $per + 1;
					}
				}
				if((float) $item['itm_ces_per'] > 0  ){
					//$per = (float) $per + (float) $item['itm_ces_per'];
				}
				if((float) $item['is_taxincluded'] > 0 ){
					if( (float) $per > 0 ){
						//$rate  = $rate  - (( (float) $rate * (float) $per)/100);
						$taxamt = (float) $rate - (((float) $rate * 100) / ((float) $per + 100));
						$rate = (float) $rate - (float) $taxamt;
					}
				}
                ?>
                            <tr>
                            <td style="width:10px;  text-align: center">
                                    <?php echo $i;?>
                            </td>
                            <td style="width:65px !important;  text-align: center">
                                <?php echo $item['name']; ?>
                            </td>
                            <td style="width:20px;  text-align: center">
                                <?php echo $item['hsncd']; ?>
                            </td>
                            <td style="width:10px;  text-align: center">
                             <!-- <?php echo number_format($item['quantity'], 2); ?> -->
                            </td>
                            <td style="width:10px;  text-align: center">
                            <!-- <?php echo number_format($item['end_unit_kg'] *$item['quantity'], 2); ?> -->
                            </td>
                            <!-- <td style="width:15px;  text-align: center">
                            </td> -->
                            <td style="width:10px;  text-align: center">
                            <!-- <?php echo number_format(($item['total']/$item['quantity'])/$sales[0]['dollar_value'], 2); ?> -->
                            </td>
                            <td style="width:20px;  text-align: center">
                                <!-- <?php echo number_format($item['total']/$sales[0]['dollar_value'], 2); ?> -->
                            </td>
                            </td>
                    <?php }
                    ?>
                        <tr>
                            <td colspan="5">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Amount Chargeable  (In words):<?php echo $msd;?>
                                </div>
                                <br/>
                                <br/>

                                
                            </td>
                            <td>
                               &nbsp;<b>Total</b>
                            </td>
                            <td>
                            &nbsp;<b> 
                                <!-- <?php echo round($sales[0]['total'] / $sales[0]['dollar_value'],2); ?></b> -->
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <!-- Shipping Terms(In words) :  -->
                                    No of Packages :
                                    <!-- <?php echo $sales[0]['shipping_terms'];?> -->
                                </div>
                               
                               
                                <div class="cls60 payment"  style="height:40px;font-size:12px;">
                                    <!-- Payment Term : -->
                                    Total Net Weight :
                                    <!-- <?php echo $sales[0]['payment_term'];?> -->
                                </div>
                                <div class="cls60 payment"  style="height:40px;font-size:12px;">
                                    <!-- Payment Term : -->
                                    Total Gross Weight :
                                    <!-- <?php echo $sales[0]['payment_term'];?> -->
                                </div>
                               <br/>
                               

                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <b>Declaration:</b>
                                </div>
                                <br/>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    We declare that this invoice is the actual price of goods  described and all particulars are true and correct.
                                </div>
                                <br/>
                                <br/>
                            </td>
                            <td colspan="2">
                            <!-- <img align="middle"  style = "width:150px;"  height ="width:50px;"   src="uploads/company/afinitysign.jpeg" />   -->

                            </td>
                        </tr>




                    </tbody>
                </table>


            </div>
             

        </div>