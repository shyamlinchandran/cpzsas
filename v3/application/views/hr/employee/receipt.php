<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            .valtb{
                padding:0px;  
                margin: 0px;  
                width:100%;
            }
            .valtb tr td {
                font-size: 9px;
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
            .right{
                text-align: right;
            }
            .clsdiv {
                margin-left: 100x;
                margin: 100px;
            }

        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px;border: solid 1px #222; ">
            <p style="text-align:center"><font style="font-size: 18px;text-align:center"> <?php echo $company['name'] ?></font><br /><?php echo $company['address'] ?> </p>
            <div class="clsdiv" style="margin-left:10px;">
                <font> To, <br /></font>
                <font >  <?php echo $payment['pro_fname']; ?><br /></font>
                <font>  <?php echo $payment['pro_permt_address']; ?><br /></font>
                <font> <?php echo $payment['pro_mobile']; ?></font><br />
                <font> Date : <?php echo $payment['paid_date'] ?> </font><br />
            </div>
            <style>
                .mt ,.mt tr ,.mt tr td {
                    border: 1px solid #222 ;
                    padding-right: 1px !important;
                } 
                body {
                    background-image: url("<?php echo base_url() . 'assets/images/cancelled.png' ?>");
                    background-repeat: no-repeat;
                    background-attachment: fixed;
                    background-position: center; 
                }
            </style>
            
            
            
            <hr style="border: solid 1px #222; "/>
            <table style="width:100%;  padding:10px; margin: 0px; background-image: url('<?php echo base_url() . 'assets/images/cancelled.png' ?>')" >
                <tr>
                    <th style=" width:200px; text-align: center;">Particulars</th>
                    <th style="width:180px;  text-align: center">Debit</th> 
                    <th style="width:180px;  text-align: center">Credit</th> 
                </tr>
            </table>  
            <hr style="border: solid 1px #222; "/>
            <table  style="padding: 5px;width:100%;  line-height:30px; ">
                <?php foreach ($salary_components as $components) { ?>
                    <tr>
                        <td style="margin: 3px;width: 200px; border-right: solid 1px #222;  text-align: left;"><?php echo $components['pay_name'] ?></td>
                        <td style="width: 180px;border-right: solid 1px #222;  text-align: right;"><?php
                            if ($components['pay_type'] == "Earnings") {
                                echo $components['amount'];
                            } else {
                                echo '0.000';
                            }
                            ?> </td> 
                        <td style="width: 180px; text-align: right;"><?php
                            if ($components['pay_type'] == "Deductions") {
                                echo $components['amount'];
                            } else {
                                echo '0.000';
                            }
                            ?> </td> 
                    </tr>
                <?php } ?>


            </table>  

            <hr style="border: solid 1px #222; "/>

            <table  cellpadding="12px" style="padding:0px; margin: 0px;  width:100%;">

                <tr> 
                    <td class="left"  colspan="6" style=" font-size:10px; border-bottom: solid 1px #222;  text-transform: capitalize; " > 
                    </td>
                    <td colspan="3" style="font-size:13px; border-bottom: solid 1px #222; text-align: left " >Gross Salary : <br /> Leaves : <br />  Leave Deduction : <br />Paying : <br /> Paid : <br /> Ledger Balance :   </td>
                    <td colspan="3" style="font-size:13px; border-bottom: solid 1px #222; text-align: right " > <?php echo ($payment['tot']) ?> <br /><?php echo floor($payment['leaves']) ?> <br /><?php echo ($payment['deduction']) ?><br /> <?php echo $payment['emp_salary']; ?> <br /><?php echo $payment['employee_paid'] ?> <br /> <?php echo $ledger_balance; ?>  </td>
                </tr >  

                <tr> <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>

                </tr>
                <br><br>
                <tr> 
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >
                        Office Manager
                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >
                        Signature
                    </td>
                </tr>
            </table>



        </div>
    </body>
</html>

