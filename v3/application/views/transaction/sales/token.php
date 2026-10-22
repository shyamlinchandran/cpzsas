<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>

        * {
            margin: 0;
        }

        .tab th, td {
            padding-top:5px;
            padding-bottom:5;
            
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
        .cls60{

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
            width: 90%;
            /* height: 430px; */
            border: 1px solid black;
            float: center;
            /* margin-bottom: 10px; */
            margin: 30px;
            margin-left: 15px;
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
        .topbr th{
                border:   1px solid #ddd;
            }
            .tabtr{
                text-align: center;
            }
    </style>

    <head>

    <body>



        </div>
        <!--<div class="cls50">
  <table class="clss2" cellpadding ="10px"  style="padding: 5px;  margin: 0px; width: 100%;">   
               
   <tr bgcolor="black"font color="white" class="table1" >
    <td style="color:white;width:15%"><font style="font-size:14px;font-weight:bold;"> INVOICE </td>
    <td style="color:white;width:20%"><font style="font-size:14px;font-weight:bold;"> Product </td>
    <td style="color:white;width:8%"><font style="font-size:14px;font-weight:bold;"> Size</td>
    <td style="color:white;width:12% !important"><font style="font-size:14px;font-weight:bold;"> Quantity</td>
    <td style="color:white;width:22 !important%"><font style="font-size:14px;font-weight:bold;">Extra Works</td>
    <td style="color:white;width:20%"><font style="font-size:14px;font-weight:bold;">Customer Note</td>
    
    <td style="color:white;width:17%"><font style="font-size:14px;font-weight:bold;">Remarks</td>
   </tr>
   <?php foreach ($list as $item) { ?>
        <tr>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo $item['invoice']; ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo $item['barcode']; ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo $item['size_name']; ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo $item['quantity']; ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo str_replace(",","<br />",$item['feature']); ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo ''; ?></td>
            <td style="padding-right:15px;vertical-align: top;text-align: left;"><font style="font-size:17px;"><?php //echo ''; ?></td>
        </tr>

    <?php } ?>
  
</table>
            
   
            </div>-->
        <div style="width:100%">
            <div class="cls40">
                <p style = "margin:0px;padding:0px;text-align:center;padding-left:500px !important;padding-right:30px;"><span style = "font-size:15px;font-weight:bold"><?php echo $settings[0]['name'];?></span></p>
                <p style= "margin:0px;padding:0px;font-size:13px;text-align:center;" ><?php echo $settings[0]['address'];?>
                <br /><b><u>TOKEN</u></b>
                </p> 
               

                <table class ="tab" width="100%" border="1" cellpadding = "8" cellspacing = "10">
                    <tbody>
                        <tr >
                            <td rowspan="4" style="width:50%">
                                <div class="cls60 " style="height:40px;font-size:12px;">
                                    No : <?php echo $sales[0]['invoice'];?></br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Date :  <?php echo $sales[0]['in_date'];?> </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Party : <?php echo $sales[0]['cusname'];?> </br>
                                    </br>
                                </div>
                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Driver : <?php echo $sales[0]['driver'];?> </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Site : <?php echo $sales[0]['place'];?> </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Veh No :  <?php echo $sales[0]['vehicle_no'];?> </br>
                                </div>
                                </br>
                            </td>

                        </tr>
                    </tbody>


                </table>

                <table class ="tab" width="100%" border="1" cellpadding = "8" cellspacing = "10">
                     
                    <tr>
                    <th  style="width:5%;  text-align: center"><?= label('SI', $this, $user) ?></th>
                    <th style="width:75%;  text-align: center"><?= label('Item Name', $this, $user) ?></th>
                    <th style="width:20%;  text-align: center"><?= label('Qty', $this, $user) ?></th>
                    </tr>
                    <tbody>
                        <?php $k = 0 ;foreach($list as $it){ $k++;?>
                            <tr>
                                <td  style="width:10px;  text-align: center"> <?php echo $k;?>
                                </td>
                                <td  style="width:60px;  text-align: left"> <?php echo $it['name'];?>
                                </td>
                                <td  style="width:30px;  text-align: right"><?php echo $it['quantity'];?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>

                        </table>
                    


            </div>



            <div style = "margin-top:60px;margin-bottom:0px;" class="cls40">

            <p style = "margin:0px;padding:0px;text-align:center;padding-left:500px !important;padding-right:30px;"><span style = "font-size:15px;font-weight:bold"><?php echo $settings[0]['name'];?></span></p>
                <p style= "margin:0px;padding:0px;font-size:13px;text-align:center;" ><?php echo $settings[0]['address'];?> <br /><b><u> GATE PASS</u></b></p> 
               

                <table class ="tab" width="100%" border="1" cellpadding = "8" cellspacing = "10">
                    <tbody>
                        <tr>
                            <td rowspan="4" style="width:50%">
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    No :  <?php echo $sales[0]['invoice'];?>  </br><br />
                                </div>
                                </br>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Date :  <?php echo $sales[0]['in_date'];?> </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Party  : <?php echo $sales[0]['cash_type'];?>  SALES </br>
                                    </br>
                                </div>
                            </td>
                            <td>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Driver : <?php echo $sales[0]['driver'];?>  </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Site : <?php echo $sales[0]['place'];?>  </br>
                                </div>
                                <div class="cls60" style="height:40px;font-size:12px;">
                                    Veh No: <?php echo $sales[0]['vehicle_no'];?>  </br>
                                </div>
                                </br>
                            </td>

                        </tr>
                    </tbody>


                </table>

                <table class ="tab" width="100%" border="1" cellpadding = "8" cellspacing = "10">
                <tr>
                    <th  style="width:5%;  text-align: center"><?= label('SI', $this, $user) ?></th>
                    <th style="width:75%;  text-align: center"><?= label('Item Name', $this, $user) ?></th>
                    <th style="width:20%;  text-align: center"><?= label('Qty', $this, $user) ?></th>
                    </tr>
                    <tbody>
                    <?php $k = 0 ;foreach($list as $it){ $k++;?>
                            <tr>
                                <td  style="width:10px;  text-align: center"> <?php echo $k;?>
                                </td>
                                <td  style="width:60px;  text-align: left"> <?php echo $it['name'];?>
                                </td>
                                <td  style="width:30px;  text-align: right"><?php echo $it['quantity'];?>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>

                        </table>
                    

            </div>
        </div>
        <div>
            <div>

            </div>
        </div>





    </body>

</html>