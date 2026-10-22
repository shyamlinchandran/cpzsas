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
        </style>
    </head>
    <body style="padding: 0px; margin: 0px;">
        <div style="padding: 0px; margin: 0px;border: solid 1px #222; ">
            <table style="padding: 0px;  margin: 0px; width: 100% ">
                <tr>
                    <td style="text-align: center; width: 100px">

                    </td>
                    <td style="text-align: center; width: 300px">
                        <span style="margin-bottom: 8px; text-align: center;font-size: 14px;font-weight: bolder;">  <?php echo $company['name'] ?> </span>

                    </td>
                    <td >
                        Ph: <?php echo $company['phone'] ?> 
                    </td> 

                </tr> 
                <tr>
                    <td style="text-align: left;">
                    </td>
                    <td style="text-align: center;">
                        <?php echo $company['address'] ?> 
                    </td>
                    <td >
                    </td> 

                </tr> 
				<tr>
                    <td style="text-align: center; width: 100px">

                    </td>
                    <td style="text-align: center; width: 300px">
                        <span style="margin-bottom: 8px; text-align: center;font-size: 14px;font-weight: bolder;">   <?php echo ucfirst($sales[0]['vourcher_type']);?> Voucher <br /> </span>

                    </td>
                    <td >
                       
                    </td> 

                </tr> 
				  <tr>
                     <td style="text-align: left;font-size: 13px;" colspan="2" rowspan="2" >
                        <b>To</b> , <br /> <b> <?php echo $sales[0]['name'] ?> </b> 
                        <?php //echo $sales[0]['code'] ?> 
                    </td>
                  
                    <td style="padding-right:10px;font-size: 13px;">
                        Voucher No :  <?php echo $sales[0]['voucher_no'] ?> 
                    </td> 

                </tr> 
				 <tr>
                    
                    <td style="font-size: 13px;" >
                         Date :  <?php echo $sales[0]['trans_date'] ?> 
                    </td> 

                </tr> 
               
             
                <tr>
                    <td style="text-align: left;font-size: 14px;" colspan="2" >
                        Phone <?php echo $sales[0]['code'] ?> 
                    </td>

                    <td>
                    </td> 

                </tr> 
            </table>
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
<!--            <img src="" alt="Cancelled"/>-->
            <table style="width:100%;  padding:0px; margin: 0px; background-image: url('<?php echo base_url() . 'assets/images/cancelled.png' ?>')" >
                <tr>
                    <th style=" width: 300px; text-align: center">Particulars</th>
                    <th style="width:350px;  text-align: center">Amount</th> 
                </tr>
            </table>  
            <hr style="border: solid 1px #222; "/>
            <table  cellpadding="50" style="width:100%;  line-height:20px;">

                <tr>
                    <td style="width: 400px; border-right: solid 1px #222;  text-align: center;ont-size:14px"><?php echo $sales[0]['naration'] ?> <!--<?php if($selected['vno'] != ''  ){?><br />( <?php echo $selected['vno'].')'; }?>-->
                        <?php if(sizeof($selected_ageing) > 0 ){?>
                        <br />
                        <table border="1" cellpadding="4" cellspacing="0" style="width:100%; margin: 0px;">
                            <tr>
                                <td style="width:10%;">slNo.</td>
                                <td style="width:40%;">Voucher Number</td>
                                <td>Paid</td>
                                <!-- <td>Balance</td> -->
                            </tr>
                            <?php $l = 0;for($i = 0; $i<sizeof($selected_ageing);$i++){ $l++;?>
                                <tr>
                                    <td><?php echo $l;?></td>
                                    <td><?php echo $selected_ageing[$i]['voucher_no'] ;?></td>
                                    <td><?php echo $selected_ageing[$i]['paid'] ;?></td>
                                    <!-- <td><?php echo $selected_ageing[$i]['balance'] ;?></td> -->
                                </tr>
                            <?php }?>
                        </table>
                        <?php }?>
                
                </td>
                    <td style="width: 200px; text-align: center;font-size:14px"><?php echo $sales[0]['amount'] ?> </td> 
                </tr>
            </table>  

            <hr style="border: solid 1px #222; "/>
            <table  cellpadding="10z" style="padding:0px; margin: 0px;  width:100%;">

                <tr> 
                    <td class="left"  colspan="8" style=" font-size:14px; border-bottom: solid 1px #222;  text-transform: capitalize; " > 
                        Rs: <?php echo $msd; ?>     
                    </td>
                    <td colspan="4" style="font-size:15px; border-bottom: solid 1px #222; text-align: center " >Total <?php echo $sales[0]['amount']; ?>   </td>
                </tr >  
                <tr> <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>

                </tr>
                <tr> 
                    <td class="left"  colspan="4" style="font-size:8px; " >

                    </td>
                    <td class="left"  colspan="4" style="font-size:12px; " >
                        Office Manager
                    </td>
                    <td class="left"  colspan="4" style="font-size:12px; " >
                        Signature
                    </td>
                </tr>
            </table>
			<br / >

        </div>
    </body>
</html>

