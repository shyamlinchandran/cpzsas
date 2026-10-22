<!DOCTYPE html>
<?php  
$com = substr($company['comset_statecode'], 0, 2);
$com =$company['statecode'];
$statecode = $sales[0]['statecode'];
if($statecode == '' || $statecode == null){
	$cust = $com;
}else{
	$cust = $statecode;

}

?>
<html>
<style>
        * {
            margin: 0;
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


        .cls40 {
            width: 100%;
            height: 620px;
            border: 0px solid black;
            float: center;
            margin-bottom: 60px;
            margin: 10px;
            margin-left: 50px;
            margin-right: 90px;


        } 
        .clstrcolr{
            background-color:grey;
            color: white;
             
        }
        .clsclr{
            background-color: grey;
            color: white;
        }
        .clstrcolr1{
            background-color:grey;
            color: white;
        }
       
    </style>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div style="width:100%;padding-top:0px;margin-top:0px;margin-bottom:0px;">
<table style="margin:0px;padding: 2px; padding-bottom:0px; margin: 0px; width: 100%; text-align:left; ?>">
                    <tr>
                        <td style="width: 10%;">
                        <img align="middle"  style="margin: 0px" width="100px" height="100px"  src="uploads/company/<?php echo $company['logo'] ?>" />  

									
							 
					 </td> 
                     <td style="width: 50%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px;" ><h2><?php echo $company['name'] ?></h2></p>
                                    <p style = "padding-left:5px;"><?php echo $company['address'] ?>  </p>
                                    <p style = "padding-left:5px;">GSTIN : <?php echo $company['tin'] ?>  </p>
                                   

                     </td>
                     <td style="text-align:right;width: 40%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px;text-align:right;" >Phone : +91 <?php echo $company['phone'] ?> </p>
                                    <p style = "padding-left:5px;text-align:right;">Email : <?php echo $company['email'] ?></p>
                                    <p>Website : www.omgold.in</p>

                     </td>
                    </tr>  
                </table>


<br/>
<br/>

<h3 style ="margin-top:0px;margin-bottom:0px; text-align:center" >PURCHASE BILL</h2>
 
<div class="cls50" style ="margin-top:0px;"  style="text-align: <?= $al ?>; float: <?= $al ?>">


                <table style="padding: 2px;  margin: 0px; width: 100%; text-align:left; ?>">
                    <tr>
                    <td style="width:50%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px; width:30%;" ><b>To ,   </b> </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['name'] ?>  </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['address_line1'] ?> </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['phone'] ?> </p>
                                    <?php if($sales[0]['aadhar'] != ''){?>
                                    <p style = "padding-left:10px;">GSTIN : <?php echo $sales[0]['tin'] ?> </p>
                                    <?php }else{echo '&nbsp;';}?>
                     </td>
                     <td style="width:30%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px; width:30%;" > </p>
                     <?php if($sales[0]['aadhar'] != ''){?>
                                    <p style = "padding-left:5px;">Aadhar :<?php echo $sales[0]['aadhar'] ?>  </p>
                    <?php }else{echo '&nbsp;';}?>
                    <?php if($sales[0]['pan'] != ''){?>
                                    <p style = "padding-left:5px;">Pan : <?php echo $sales[0]['pan'] ?>  </p>
                    <?php }else{echo '&nbsp;';}?>

                     </td>

                        <td style="width:20%;line-height: 1.6;"><p>Invoice No:<?php echo $sales[0]['invoice'] ?>  </p>
							  
									<p style="margin-top:10px;padding-top:10px;padding-left:5px;">Date : <?php echo $sales[0]['in_date'] ?>  </p>
									
							 
					     </td> 
                    
                    
                     
                    </tr>  
                </table>

         
                <br/>

                <table border="0" style="padding: 2px;  margin: 0px; width: 100%; text-align:left;" >
                <tr class="clstrcolr">
                <td class="clstrcolr1">#</td>
                <td class="clstrcolr1">Product Description</td>
                <td class="clstrcolr1">Pcs</td>
                <td class="clstrcolr1">Gross Weight</td>
                <td class="clstrcolr1">Stone Weight</td>
                <td class="clstrcolr1">Melt_Loss</td>
                <td class="clstrcolr1">Net Weight</td>
                <td class="clstrcolr1">Rate</td>
                <td class="clstrcolr1">Total</td>
                    </tr>

                    <?php $i = 0; foreach ($sales_items as $item) { $i++; $rate = $item['net_wt'] *$item['mrp']; $charge =$item['total']  - $rate;?>
                        <tr>
                            <td>
                                <?php echo $i;?>
                            </td>
                            <td>
                                <?php echo $item['name'];?>
                            </td>
                            <td><?php echo round($item['quantity'],0);?></td>
                            <td><?php echo $item['gross_wt'];?></td>
                            <td><?php echo $item['stone_wt'];?></td>
                            <td><?php echo $item['melt_loss_wt'];?></td>
                            <td><?php echo $item['net_wt'];?></td>
                            <td><?php echo $item['rate'];?></td>
                            <td><?php echo $item['total'];?></td>
                        </tr>
                    <?php }?>

                    <tr class="clsclr">
                    <td class="clstrcolr1" colspan="4" style="text-align:center">Total </td>   
                    <td class="clstrcolr1"></td>              
                        <td class="clstrcolr1"></td> 
                        <td class="clstrcolr1"></td>              
                        <td class="clstrcolr1"> </td> 
                        <td class="clstrcolr1">  </td> 
                        

                    </tr>
                    </table>
                    <table border="0" style="padding: 2px;  margin: 0px; width: 100%; text-align:left;" >
                    <tr>
                        <td colspan ="4" style="line-height: 1.6;width:50% !important">

                              
                        </td>

                        <td  style="line-height: 1.6;width:30%">  
                    
                     
                           
                        </td> 

                        <td style="text-align:right; line-height: 1.6;width:20%">
                        
                     

                        </td>


                    </tr>
                    <tr>
                        <td colspan ="4"  style="line-height: 1.6;"></td>
                        <td class="clsclr" style="text-align:center;"><b>INVOICE TOTAL</b></td>
                        <td class="clsclr" style="text-align:center;width:20%"><b><?php echo $sales[0]['total']?></b></td>
                    </tr>
                    
                    </table>
                    <!-- <table border="0" style="padding: 2px;  margin: 0px; width: 100%; text-align:left;" >

                    <tr>
                 
               
                        <td colspan="9" style="line-height: 1.6;text-align: justify;padding-right:12px;"> Total Invoice in Words :<?php echo $msd;?>
							(E&OE) 
									<br /><p>WE BANK WITH SOUTH INDIAN BANK,VAIKOM BRANCH  </p>
                                    <br /><p>A/C NO :0091073000000719 </p>
                                    <br/><p>IFSC :SIBL0000091 </p>
                                    <br/>
                                  
                                     
                        </td>
 
					  
                     <td colspan="3" style="line-height: 1.6;">  
                    
                     
                        <p>Taxable Value </p>      
                         <p>Sales Discount</p> 
                         <p>CGST Amount </p> 
                         <p>SGST Amount </p> 
                         <p>IGST Amount </p> 
                         <p>GST Total </p> 
                         <p>State Cess Amount </p>
                         <p>Labour Charges </p>
                      </td> 
                      <td>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>
                      <br/>     
                        <p> </p>
                        <br/>
                        <br/>

                      </td>
                      <td style="text-align:right; line-height: 1.6;">
                   
                        <p><?php echo $sales[0]['total'] -  $sales[0]['tax'] + $sales[0]['discount'];?></p>
                        <p><?php echo $sales[0]['discount'];?></p>
                        <?php if($cust == $com ){?>
                            <p><?php echo $sales[0]['tax']/2;?></p>
                            <p><?php echo $sales[0]['tax']/2;?></p>
                            <p><?php echo 0;?></p>
                        <?php }else{?>
                            <p><?php echo 0;?></p>
                            <p><?php echo 0;?></p>
                            <p><?php echo $sales[0]['tax'];?></p>
                        <?php }?>             
                        <p>0</p>                     
                        <p>0.00 </p>
                        <p>0.00 </p>

                        </td>
                       
                    </tr>  
                    <tr rowsspan="3">
                        <td  colspan="5"><p></p>
                        <p></p>
                     </td>
                        <td  colspan="4" style="text-align:right;">  <?php if($sales[0]['purtotal'] < 1 ){ ?>Seal/Initials<?php }?></td>
                        <td colspan="3" class="clsclr" style="text-align:center;"><b>INVOICE TOTAL</b>
                        </td>
                        <td colspan="2" class="clsclr" style="text-align:right;"><b><?php echo $sales[0]['total']?></b>
                        </td>
                     </td>
                        </tr>

                        <?php if($sales[0]['purtotal'] > 0 ){ ?>
                            <tr rowsspan="3">
                        <td  colspan="5"><p></p>
                        <p></p>
                     </td>
                        <td  colspan="4" style="text-align:right;"></td>
                        <td colspan="3" class="clsclr" style="text-align:center;"><b>Old Pur TOTAL</b>
                        </td>
                        <td colspan="2" class="clsclr" style="text-align:right;"><b><?php echo $sales[0]['purtotal'].' ('.$sales[0]['pinv'].' )'; ?></b>
                        </td>
                     </td>
                        </tr>
                        <tr rowsspan="3">
                        <td  colspan="5"><p></p>
                        <p></p>
                     </td>
                        <td  colspan="4" style="text-align:right;"> Seal/Initials</td>
                        <td colspan="3" class="clsclr" style="text-align:center;"><b>Payable</b>
                        </td>
                        <td colspan="2" class="clsclr" style="text-align:right;"><b><?php echo $sales[0]['total'] - $sales[0]['purtotal'];?></b>
                        </td>
                     </td>
                        </tr>
                        <?php }?>
                </table>
                 -->
                 
            </div>










			 
</div>





                             
 
</body>