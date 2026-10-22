<?php
$is_discount = 1;
$is_bankac = 1;
$itemwd = '296'; //if discont is 0
$sizewd = '80';

?>
<html>

<head>
    <meta charset="UTF-8">
    <title></title>
    <style>
        body {
            font-family: serif;
        }

        div {
            margin: 0px !important;
            padding: 0px !important;
        }

        .valtb {
            padding: 0px;
            margin: 0px;
            width: 100%;
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

        .center {
            text-align: right;
        }

        .spec th {
            font-weight: bold;
            font-size: 10px;
            height: 15px;

        }

        .Bold {
            font-weight: bolder;
        }

        .border {
            padding: 0px;
            margin: 0px;
            width: 100%;
        }

        .border tr td {

            border: solid 1px #444;
        }

        .mt,
        .mt tr:first-child,
        .mt tr:first-child td {
            border: 1px solid #222;
            padding-right: 1px !important;
        }

        .mt,
        .mt td {
            border-right: 0.5px solid #333;
            padding-right: 2px !important;
            padding-left: 2px !important;

        }

        .topbr th {
            border: 0.5px solid #333;
        }

        .mt th {
            border-top: 0.5px solid #333;
            font-size: 10px;
            height: 10px;
        }

        .valtb td {
            font-size: 14px;
            font-weight: bold;
        }

        .right {
            text-align: right;
            padding-right: 30px;
        }
    </style>
</head>

<body style="padding: 0px; margin: 0px;">
    <input type="hidden" value=<?php echo $settings[0]['is_color'] ?> id="is_color" name="is_color" />
    <div style="padding: 0px; margin: 0px; border: solid 1px #222;">
        <table>
            <tr>
                <td></td>
                <td style="text-align: center;font-size: 12px"></td>
                <td class="right"><br /></td>
            </tr>
        </table>
        <span style="text-align: center">
            <span style="text-align: center;font-size: 20px;"><?php echo $com['name'] ?> </span>
            <br />
            <?php echo $com['address'] ?>
            
            <br />
        </span>
        <hr  />
        <table>
            <tr>
                <td>Date :<?php echo date('Y-m-d') ?> </td>
                <td>GSTIN :<?php echo '112334ddd' ?> </td>
                <td><br />Orginal Copy For Customer</td>
            </tr>
            <tr>
                <td>Invoice Number :<?php echo 'invoice' ?> </td>
                <td><br /></td>
            </tr>
        </table>

        <hr style="border: solid 1px #222; " />

        <table style="padding: 2px;  margin: 0px; width: 100%;">
            <tr>
                <td>Company Name : <?php echo $com['name'] ?></td>
                <td>Phone: <?php echo $com['phone'] ?> </td>
            </tr>
            <tr>
                <td>Email : <?php echo $com['email'] ?> </td>
                <td>GST IN : <?php echo $com['tin'] ?> </td>
            </tr>
            <tr>
                <td>Address : <?php echo $com['address'] ?> </td>

            </tr>
        </table>

        <table class="mt " style="width:100%;  padding:0px;  margin: 0px;" border="0">
            <tr class="topbr">
                <th style=" width: 30px; text-align: center">Sl No</th>
                <th style="width: <?php echo $itemwd; ?>px;  text-align: center">Services</th>
                <th class="center" style="width: 80px;  text-align: center">Start Date</th>
                <th class="center" style="width: 80px;  text-align: center">Expiry Date</th>
                <th class="center" style="width: 80px;  text-align: center">Amount</th>

            </tr>



            <?php
            // $len = $size - $i - 1;
            for ($i = 0; $i < 35; $i++) {
                if ($i >= $len) {
            ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php
                } else {
                ?>
                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo $config[$i]['service_name'] ?></td>
                        <td><?php echo $config[$i]['startdate'] ?></td>
                        <td><?php echo $config[$i]['enddate'] ?></td>
                        <td><?php echo $config[$i]['samount'];
                            ?></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <table class="mt" style="width:100%;  padding:0px; margin: 0px;">
            <tr>

                <th style=" width: 52%;"></th>
                <th style=" width: 8%;"></th>
                <th style=" width: 8%;"></th>
                <th style=" width: 10%;"><b>Total</b></th>

                <th style=" width: 22%;"><b><?php echo $config[0]['total']; ?>.00</b></th>

            </tr>
        </table>

        <hr style="font-size: 13px; border: solid 1px #222; " />
        <table style="padding: 2px;  margin: 0px; width: 100%;">
            <tr>
                <td>Total Invoice Amount in Words: <b> <?php echo $msd ?> </b></td>
                <td></td>
            </tr>
            <tr>
                <td> Rs: <b><?php echo $config[0]['total']; ?></b></td>
                <td></td>
            </tr>

            <tr>
                <td><u>Declaration</u> <br />We Declare That This Invoice Shows Actual Price Of The Goods Described And That All Particulars Are True&Good</td>
                <td style="font-size:12px; text-align: center ">
                    For <?php echo $company['name']; ?>
                    <br />

                    <br />
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: center ">
                    Authorised Signature
                    <br />

                    <br />
                </td>
            </tr>
        </table>
        <!--            <hr style="font-size: 13px; border: solid 1px #222; "/>
                        <table class="mt">
                            <tr  class="topbr">  
                                <td>BANK  Details</td> 
            
                                <td> Declaration
                                </td> 
                            </tr> 
                            <tr>  
                                <td>
                                    
                                    BANK NAME : Central Banck Of INdia <br/>
                                    A/C No:123456789012345678<br/>
                                    IFSC CODE :12345678901<br/>
                                    BRANCH :123456789012345678
                                </td> 
            
                                <td>
            
                                </td> 
                            </tr> 
                        </table>             -->

        <hr style="border: solid 1px #222; " />
        <table style="padding:0px;  margin: 0px;  width:100%;">
            <tr>
                <td style="font-size:8px; text-align: center ">**This is a Computer Generated Invoice**</td>
            </tr>
        </table>
    </div>
</body>

</html>