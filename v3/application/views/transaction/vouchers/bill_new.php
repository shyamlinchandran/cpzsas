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
        <br>
        
            <table style="padding: 0px;  margin: 0px; width: 100% ">
                <tr >
                    <td style="text-align: right;width:50px">
                    <img src="<?php echo base_url() ?>assets/images/res.jpeg" style="max-width:100%;" height="60px" alt="cannot load image">
                    </td>
                    <td colspan = "2" style="text-align: left;width:330px">
                    <span style="margin-bottom: 8px; text-align: left;font-size: 10px;font-weight: bolder;">  <?php echo $company['name'] ?> </span><br style = "line-height:-10px;"> 
                    <p style = "text-align:center;font-size:8px"><?php echo $company['address'] ?> ,Phone: <?php echo $company['phone'] ?></p> 
                    </td>
                </tr>  
 
                <br style = "line-height: 20px;">

                <tr style="border: solid 1px #222; ">
                    <td style="text-align: left;" colspan="2" >
                    
                    To &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> <?php echo $sales[0]['name'] ?> </b><br>
                    phone &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sales[0]['code'] ?> 
                    </td>

                    <td style="text-align: right"><br>

                    </td> 

                </tr> 
                <br style = "line-height: 7px;">
                <tr style="border: solid 1px #222; ">
                    <td style="text-align: left;" colspan="2" >
                    
                    Invoice Id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> <?php echo $sales[0]['voucher_no'] ?>  </b><br>
                    Invoice Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php echo $sales[0]['trans_date'] ?> <br><br>
                    Legal name:  MEDUGARE SERVICES LLP
                    </td>
                    

                </tr> 

                
 
            </table>

            <br>

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
            <table style="width:100%;  padding:10px; margin: 0px; background-image: url('<?php echo base_url() . 'assets/images/cancelled.png' ?>')" >
                <tr>
                    <th style=" width: 200px; text-align: center;">Particulars</th>
                    <th style="width:200px;  text-align: center">Amount</th> 
                </tr>
            </table>  
            <hr style="border: solid 1px #222; "/>
            <table  cellpadding="40px" style="width:100%;  line-height:70px; ">

                <tr>
                    <td style="width: 200px; border-right: solid 1px #222;  text-align: center;"><?php echo $sales[0]['naration'] ?></td>
                    <td style="width: 200px; text-align: left;"><?php echo $sales[0]['amount'] ?> </td> 
                </tr>

            </table>  

            <hr style="border: solid 1px #222; "/>
        
            <table  cellpadding="10px" style="padding:0px; margin: 0px;  width:100%;">
            
                <tr> 
                    <td class="left"  colspan="8" style=" font-size:10px; border-bottom: solid 1px #222;  text-transform: capitalize; " > 
                        Rs: <?php echo $msd; ?>     
                    </td>
                    <td colspan="4" style="font-size:13px; border-bottom: solid 1px #222; text-align: center " >Total <?php echo $sales[0]['amount']; ?>   </td>
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

