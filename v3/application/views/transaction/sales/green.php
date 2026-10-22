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
            padding-top: 10px;
            padding-bottom: 10px;

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
            height: 800px;
            border: 1px solid black;
            float: center;
            margin-bottom: 50px;
            margin: 10px;
            margin-left: 10px;
            margin-right: 10px;

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
    </style>

    <head>

    <body>









        <div style="width:100%">
            <div class="cls40">
                <!-- <table class="tab" width="100%" border="0" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table> -->



                <table class="tab" width="100%" border="0" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr>
                            <td rowspan="10" style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60  txt" style="height:40px;font-size:35px;  ">
                                    <b style="color:green"> Green </b> <b style="color: #B2BEB5;">Solar </b> </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                <?php echo $company['address']; ?></br><br />
                                </div>
                                </br>
                              

                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;text-align:left;">
                                    <b>GST INVOICE B2B </b></br>
                                </div>
                            </td>
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    E-Mail : <?php echo $company['email']; ?>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Phone : <?php echo $company['phone']; ?>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Mobile :  <?php echo $company['phone']; ?>
                                    </br>
                                </div>
                                </br>
                            </td>

                        </tr>

                    </tbody>


                </table>
                <table class="tab" width="100%" border="1" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr>
                            <td style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <b> GST Number : <?php echo $company['phone']; ?> </b></br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Invoice Number :<b> <?php echo $sales[0]['invoice']; ?> </b></br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Invoice Date :<?php echo $sales[0]['in_date']; ?> </br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Tax Is Payable On Reverse Charge : (Yes/No) </br>
                                </div>

                            </td>
                            <td>

                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Transportation Mode :<?php echo $sales[0]['transport_mode']; ?>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Vehicle Number :<?php echo $sales[0]['vehicle_no']; ?>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Date & Time of Supply : <?php echo $sales[0]['in_date']; ?>
                                    </br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Place OF Supply :<?php echo $sales[0]['place']; ?>
                                    </br>
                                </div>
                                </br>

                            </td>

                        </tr>


                    </tbody>


                </table>
                <table class="tab" width="100%" border="1" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr>
                            <td style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <b><u> Details of Receiver (Billed to)</u></b></br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                        Name : <b> <?php 
                                            if ($sales[0]['customer_id']==0){
                                                echo $sales[0]['cusname'] ;
                                            }
                                            else{
                                                echo $sales[0]['name'] ;
                                            }
                                        
                                            ?>
                                </b></br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    <?php echo $sales[0]['address_line1'];?>
                                    </br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Mobile No. :<?php echo $sales[0]['phone'];?> &nbsp;&nbsp;&nbsp;&nbsp; Phone :</br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    GST No : <?php echo $sales[0]['tin'];?>
                                    </br>
                                </div>

                            </td>

                            <td style="width:50%">
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    <b><u> Details of Consignee (Shipped to)<u></b>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Phone : <?php if($sales[0]['con_addr']!=''){ echo $sales[0]['con_contact'];}else{echo $sales[0]['phone'];}?>
                                    </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Name: <?php if($sales[0]['con_name'] != ''){echo $sales[0]['con_name'];}else{  if ($sales[0]['customer_id']==0){
                              echo $sales[0]['cusname'] ;
                         }
                         else{
                              echo $sales[0]['name'] ;
                         } }?>
                                    </br>
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Address : <?php if($sales[0]['con_addr']!=''){echo $sales[0]['con_addr'];}else{echo $sales[0]['address_line1'];}?>
                                    </br>
                                    </br>
                                   <p> <?php if($sales[0]['con_addr']!=''){ echo $sales[0]['con_contact'];}else{echo $sales[0]['phone'];}?> </p>
                                </div>
                                </br>
                            </td>

                        </tr>


                    </tbody>


                </table>
                <table class="tab" width="100%" border="1" cellpadding="2" cellspacing="2">
                    <tr >
                        <th rowspan="2" style="width:10px;  text-align: center">
                            <?= label('SI No', $this, $user) ?>
                        </th>
                        <th rowspan="2"  style="width:10px;  text-align: center">
                            <?= label('Description of Goods', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:20px;  text-align: center">
                            <?= label('HSN Code(GST)', $this, $user) ?>
                        </th>
                        <th  rowspan="2" style="width:10px;  text-align: center">
                            <?= label('Qty', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:20px;  text-align: center">
                            <?= label('UOM', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:10px;  text-align: center">
                            <?= label('Unit Price', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:10px;  text-align: center">
                            <?= label('Total', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:20px;  text-align: center">
                            <?= label('Cash Discount', $this, $user) ?>
                        </th>
                        <th rowspan="2" style="width:10px;  text-align: center">
                            <?= label('Taxable Value', $this, $user) ?>
                        </th>
                        <th colspan="2" style="width:10px;  text-align: center">
                            <?= label('CGST', $this, $user) ?>
                        </th>
                        <th colspan="2" style="width:10px;  text-align: center">
                            <?= label('SGST', $this, $user) ?>
                        </th>
                        <th  rowspan="2" style="width:10px;  text-align: center">
                            <?= label('Total', $this, $user) ?>
                        </th>
                    </tr>
                    <tr>
                       
                        <th>
                            %
                        </th>
                        <th>
                            Amount
                        </th>
                        <th>
                            %
                        </th>

                        <th>
                            Amount
                        </th>
                      

                    </tr>

                    <tbody>
                        <tr rowspan="20" style=" width: 100%;height: 750px;">
                            <td style="height:30px;">
                                1
                            </td>
                            <td>
                                WSMD-540 SPGS G TO BS MODULE 540 WP (MONO)-144-HC
                            </td>
                            <td>
                                85414300
                            </td>
                            <td>
                                6
                            </td>
                            <td>
                            </td>
                            <td>
                                11610.00
                            </td>
                            <td>
                                69660.00
                            </td>
                            <td>
                                0.00
                            </td>
                            <td>
                                69660.00
                            </td>
                            <td>
                                6
                            </td>
                            <td>
                                4179.60
                            </td>
                            <td>
                                6
                            </td>
                            <td>
                                4179.60
                            </td>
                            <td>78019.20
                            </td>

                        </tr>

                        <tr style=" width: 100%;height: 250px;">
                            <td colspan="3">
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    E&OE
                                    </br>
                                </div>
                            </td>
                            <td>
                                6
                            </td>
                            <td colspan="2">

                            </td>
                            <td>
                                69660.00
                            </td>
                            <td>
                                0.00
                            </td>

                            <td>
                                69660.00
                            </td>
                            <td>

                            </td>
                            <td>
                                4179.60
                            </td>
                            <td>

                            </td>
                            <td>
                                4179.60
                            </td>
                            <td>
                                78019.20
                            </td>


                        </tr>








                    </tbody>


                </table>

                <table class="tab" width="100%" border="1" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr rowspan="2">
                            <td style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u> Invoice Value (In Words)<u></br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">

                                    ( Rupees Seventy Eight Thousand And Nineteen Only )</br>
                                </div>

                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;text-align:left;">
                                    <b>Round To</b></br>
                                </div>

                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    -0.20
                                    </br>
                                </div>


                                </br>
                            </td>

                        </tr>

                        <tr rowspan="2">
                            <td style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Certified that the Particulars given above are true and correct</br><br />
                                </div>
                                </br>

                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;text-align:left;">
                                    <b>Total </b></br>
                                </div>

                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    78019.00

                                    </br>
                                </div>


                                </br>
                            </td>

                        </tr>

                        <tr rowspan="2">
                            <td style="width:60%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Electronic Reference Number :</br><br />
                                </div>
                                </br>

                            </td>

                            <td colspan="2">
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    <b>GREEN SOLAR</b>

                                    </br>
                                </div>


                                </br>
                            </td>

                        </tr>

                        <tr rowspan="6">
                            <td style="width:60%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    <u>Bank Details :-</u></br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Bank Name : South Indian Bank</br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    Branch: KOOTILANGADI</br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    A/C No : 0832073000000219</br><br />
                                </div>



                            </td>

                            <td colspan="2">
                                </br>
                                </br>
                                </br>
                                </br>

                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Authorised Signatory
                                    </br>
                                </div>


                                </br>
                            </td>

                        </tr>
                    </tbody>
                </table>
                <table class="tab" width="100%" border="0" cellpadding="8" cellspacing="10">
                    <tbody>
                        <tr rowspan="4">
                            <td>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:left;">
                                    Customer care : 7561 040 008</br><br />
                                </div>
                                </br>
                            </td>
                            <td style="width:50%" colspan="3" style=" text-align:right;">
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    Koch | Calicut | Malappuram | Wayanad </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    7594 800 011</br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    greensolarkerala@gmail.com </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    </br><br />
                                </div>
                                </br>
                                <div class="cls60 " style="height:40px;font-size:12px; text-align:right;">
                                    </br><br />
                                </div>
                                </br>
                            </td>
                        </tr>




                    </tbody>


                </table>


            </div>




    </body>

</html>