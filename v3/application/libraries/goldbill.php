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
$login_comid = $this->session->userdata('login_base_comid');
$width = '100px';
$height = '100px';
if(strtolower($login_comid ) == 'sgold'  ){
    $width = '130px';

}
if(strtolower($login_comid ) == 'csk'){
    $width = '250px';

}
if( strtolower($login_comid ) == 'kgold' || strtolower($login_comid ) == 'vgold'){
    $width = '150px';
    $height = '150px';
}
?>
<html>
<style>
        /* * {
        margin: 0;
        padding: 0;
    } */
    .cls50{
        margin-right:1px solid black;
    }

    body {
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        font-weight: 200;
        font-size: 85.25%;
        padding: 50px;
        height: 297mm; /* Height of an A4 page */
        width: 210mm; /* Width of an A4 page */
        border: 3px solid red; /* Border style */
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
            background-color:#FAF9F6;
            color: black;
             
        }
        .clsclr{
            background-color: #FAF9F6;
            color: black;
        }
        .clstrcolr2{
            background-color: #FAF9F6;
            border-bottom:1px solid black;   
            color: black;
        }
        .clstrcolr1{
            background-color:#FAF9F6;
            color: black;
        }
       
    </style>

<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
<div style="border:2px solid black;width:100%;padding-top:0px;margin-top:0px;margin-bottom:0px;">
<table style="margin:0px;padding: 2px; padding-bottom:0px; margin: 0px; width: 100%; text-align:left; ?>">
                    <tr>
                        <td style="width: 10%;">
                        <?php if($company['logo'] !=''){ ?>
                            <img align="middle"  style="margin: 0px" width="<?php echo $width;?>" height="<?php echo $height;?>"  src="uploads/company/<?php echo $company['logo'] ?>" />  
                        <?php } ?>
									

									
							 
					 </td> 
                     <td style="line-height: 1.6;width:90%;text-align:center;">
                        <p style="text-align:center;"><h2 style="text-align:center"><?php echo $company['name'] ?> </h2> <?php echo $company['address'] ?> <br /> Phone : +91 <?php echo $company['phone'] ?><br /> Email : <?php echo $company['email'] ?> <br >GSTIN  : <?php echo $company['tin'] ?></p>
                     <!-- <p style = "margin-top:10px;padding-top:10px;padding-left:5px;text-align:center" ><h2 style="text-align:center"><?php echo $company['name'] ?></h2></p>
                                    <p style = "padding-left:5px;font-weight:bold;"><?php echo $company['address'] ?>  </p>
                                    <p style = "padding-left:5px;font-weight:bold;">GSTIN  : <?php echo $company['tin'] ?>  </p>
                                    -->

                     </td>
                     <!-- <td style="text-align:right;width: 40%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px;text-align:right;font-weight:bold;" >Phone : +91 <?php echo $company['phone'] ?> </p>
                                  
                                    <p style = "padding-left:5px;text-align:right;font-weight:bold;">Email : <?php echo $company['email'] ?></p>
                                    <?php if(strtolower($login_comid) == 'omgold'){?>
                                        <p>Website : www.omgold.in</p>
                                    <?php }?>
                     </td> -->
                    </tr>  
                </table>

<hr styl="margin:0px;padding:0px;" />



<h4 style ="margin-top:0px;margin-bottom:0px;padding:0px; text-align:center;font-size:12px;" >TAX INVOICE <br /> <font style ="font-size:10px;margin-top:0px;margin-bottom:0px; text-align:center"> CASH/CREDIT</font></h4>
 <hr style ="margin:0px;padding:0px;" />
<div class="cls50" style ="padding:0px;margin-top:0px;border-right:1px solid black;"  style="text-align: <?= $al ?>; float: <?= $al ?>">


                <table style="padding-top:2px;  margin:  0px solid black; width: 100%; text-align:left; ?>">
                    <tr>
                    <td style="border-right: 1px solid black;width:50%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px; width:30%;" ><b>To ,   </b> </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['cusname'] ?>  </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['cusdetails'] ?> </p>
                                    <p style = "padding-left:10px;"><?php echo $sales[0]['con_contact'] ?> </p>
                                    <?php if( $sales[0]['tin'] !='' ){?>
                                        <p style = "padding-left:10px;font-weight:bold;">GSTIN : <?php echo $sales[0]['tin'] ?> </p>
                                    <?php } ?>
                     </td>
                     <td style="width:28%;line-height: 1.6;">
                     <p style = "margin-top:10px;padding-top:10px;padding-left:5px; width:30%;" > </p>
                     <?php if($sales[0]['aadhar'] != ''){?>
                                    <p style = "padding-left:5px;">Aadhar :<?php echo $sales[0]['aadhar'] ?>  </p>
                    <?php }else{echo '&nbsp;';}?>
                    <?php if($sales[0]['pan'] != ''){?>
                                    <p style = "padding-left:5px;">Pan : <?php echo $sales[0]['pan'] ?>  </p>
                    <?php }else{echo '&nbsp;';}?>
                                   
                         <?php  if(isset($ewn)){if($ewn!= ''){?>
									    <p style="margin-top:10px;padding-top:10px;padding-left:0px;"><b>Eway No: <?php echo $ewn; ?><br/>Eway Date: <?php echo $ewd; ?></b>  </p>
                                    <?php }}?>
                     </td>

                        <td style="margin:1px;width:22%;line-height: 1.6;font-weight:14px;"><p><b>Invoice No:<?php echo $sales[0]['invoice'] ?></b>  </p>
							  
									<p style="margin-top:10px;padding-top:10px;padding-left:5px;">Date : <?php echo $sales[0]['in_date'] ?>  </p>
									<p style="margin-top:10px;padding-top:10px;padding-left:5px;">State : <?php echo 'Kerala'; ?>  </p>
									<p style="margin-top:10px;padding-top:10px;padding-left:5px;">State Code: <?php echo '32'; ?>  </p>
									<p style="margin-top:10px;padding-top:10px;padding-left:5px;">Rate: <?php echo $sales[0]['gold_rate']; ?>  </p>
                                   
                                </td> 
                    
                    
                     
                    </tr>  
                </table>

            </div>
                <hr style ="margin:0px;padding:0px;" />
            
            <div class="cls50" style ="padding:0px;margin-top:0px;border-right:1px solid black;"  style="text-align: <?= $al ?>; float: <?= $al ?>">
                <table border="0" style="padding: 0px;padding-top:0px;  margin: 0px; width: 100%; text-align:left;" >
                    <tbody style="font-weight:bold;font-size:12px;">
                    <tr class="clstrcolr2" style="border:1px solid black;font-weight:bold;">
                        <td class="clstrcolr2">#</td>
                        <td style ="width:12%;font-weight:bold" class="clstrcolr2">Product</td>
                        <td style ="width:7%;font-weight:bold" class="clstrcolr2">Purity</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">HUID</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Hsn Code</td>
                        <td style ="width:5%;font-weight:bold" class="clstrcolr2">Nos</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Gross Wt</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Stone Wt</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Net Wt</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Rate</td>
                        <!-- <td class="clstrcolr1">VA%</td> -->
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2">Stone Amt</td>
                        <td style ="width:8%;font-weight:bold" class="clstrcolr2"><?php if(strtolower($login_comid) !='mannapatt'  && strtolower($login_comid) !='enchakkattu' && strtolower($login_comid) !='sneha' && strtolower($login_comid) !='ejpm'  && strtolower($login_comid) !='chaithanya'  && strtolower($login_comid) !='sgpj'   && strtolower($login_comid) !='mjv' && strtolower($login_comid) !='mangalya' && strtolower($login_comid) !='ganesh'  && strtolower($login_comid) !='csk'){?>VA Amt<?php }else{?> Va/Gm<?php }?></td>
                        <td style ="width:9%;font-weight:bold" class="clstrcolr2">Total</td>
                    </tr>
                    </tbody>
                    <tbody style="font-weight:bold;font-size:14px;">
                    <?php $i = $len; foreach ($sales_items as $item) { $i++; $rate = $item['net_wt'] *$item['mrp']; $charge =$item['total'] - $item['stone_charge'] - $rate; if($charge< 0 ){$charge = 0;}?>
                        <tr>
                            <td>
                                <?php echo $i;?>
                            </td>
                            <td>
                                <?php echo $item['name'];if($item['itemdiscription'] !='' && $item['item_discription'] !='null' && $item['item_discription'] !=null ){ echo '<br />'.$item['item_discription'] ;}?>
                            </td>
                            <td><?php echo $item['purityname'];?> </td>   
                            <td><?php echo $item['hudid'];?> </td>   
                            <td><?php echo $item['hsncd'];?>  </td> 
                            <td><?php echo round($item['quantity'],0);?></td>
                            <td><?php echo $item['gross_wt'];?></td>
                            <td><?php echo $item['stone_wt'];?></td>
                            <td><?php echo $item['net_wt'];?></td>
                            <td><?php echo $item['mrp'];?></td>
                            <!-- <td><?php echo $item['va_per'];?></td> -->
                            <td><?php echo $item['stone_charge'];?></td>
                            <td><?php if(strtolower($login_comid) !='mannapatt'  && strtolower($login_comid) !='enchakkattu'  && strtolower($login_comid) !='sneha'  && strtolower($login_comid) !='ejpm' && strtolower($login_comid) !='chaithanya'  &&  strtolower($login_comid) !='mjv' &&  strtolower($login_comid) !='sgpj'   &&  strtolower($login_comid) !='mangalya' &&  strtolower($login_comid) !='csk' && strtolower($login_comid) !='ganesh'){?><?php echo round($charge,3);?><?php }else{?> <?php echo round($charge/$item['net_wt'],3);?><?php }?> </td>
                            <td><?php echo $item['total'];?></td>
                        </tr>
                    <?php }?>
                </tbody>


                    <?php if ($inc != ($cpz + 1)) { ?> 

<tr class="">
    <td class="" colspan="4" style="text-align:center;height:600px"> </td>   
        
        <td class=""></td> 
        <td class=""></td>              
                <td class=""></td>              

        <!-- <td class="clstrcolr1"> </td>  -->
        <td class="">  </td> 
        <td class="">  </td> 
        <td class="">  </td> 
        <td class=""> </td>
        <td class=""></td>
        <td class=""></td>

</tr>
<?php }else{?>



      <tr class="clstrcolr2" style="border:1px solid black;">
                        <td class="clstrcolr2"></td>
                        <td style ="width:11%" class="clstrcolr2"></td>
                                                <td style ="width:8%" class="clstrcolr2"></td>

                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:5%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <!-- <td class="clstrcolr1">VA%</td> -->
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:8%" class="clstrcolr2"></td>
                        <td style ="width:9%" class="clstrcolr2"></td>
                    </tr>
                   



                    <tr class="clsclr">
                    <td class="clstrcolr1" colspan="4" style="text-align:center"> </td>   
                        
                        <td class="clstrcolr1"></td> 
                        <td class="clstrcolr1"></td>     
                            <td class="clstrcolr1"></td>             
                        <!-- <td class="clstrcolr1"> </td>  -->
                        <td class="clstrcolr1">  </td> 
                        <td class="clstrcolr1">  </td> 
                        <td class="clstrcolr1">  </td> 
                        <td class="clstrcolr1"> </td>
                        <td class="clstrcolr1"></td>
                        <td class="clstrcolr1"></td>

                    </tr>
                    <?php }?>

                 
                    </table>

                    <?php if ($inc == ($cpz + 1)) { ?> 

                    <table border="0" style="padding: 2px;  margin: 0px; width: 100%; text-align:left;font-size:14px;font-weight:normal" >
                    <tr>
                        <td colspan ="4" style="line-height: 1.6;width:50% !important">
                            <?php if($sales[0]['remarks'] !=''){?>
                                Remarks :  <?php echo $sales[0]['remarks'] ?>
                             <?php }?>
                             <?php if($this->session->userdata('login_base_comid') == 'kgold' || strtolower($this->session->userdata('login_base_comid') ) == 'vgold'){?><br /><b><u>Bank Details<u></u></b> <br /><?php echo $company['comset_bank']; ?> <br /><?php echo $company['comset_ifsccode']; ?>  <br /><?php echo $company['comset_account_no']; ?>  <?php }?>
                        </td>

                        <td  style="line-height: 1.6;width:30%">  
                            <p>Total</p> 
                            <p>Sales Discount</p> 
                            <p>Taxable Value </p>      
                            <?php if($cust == $com ){?>
                                <p>CGST @1.5% </p> 
                                <p>SGST @1.5% </p> 
                            <?php }else{?>
                                <p>IGST Amount </p> 
                            <?php }?>             
                            <!-- <p>GST Total </p>  -->
                        </td> 

                        <td style="text-align:right; line-height: 1.6;width:20%">
                        <p><?php echo $sales[0]['total'] -  $sales[0]['tax'] + $sales[0]['discount'];?></p>
                        <p><?php echo $sales[0]['discount'];?></p>
                        <p><?php echo $sales[0]['total'] -  $sales[0]['tax'];?></p>
                        <?php if($cust == $com ){?>
                            <p><?php echo number_format($sales[0]['tax']/2,2);?></p>
                            <p><?php echo number_format($sales[0]['tax']/2,2);?></p>
                        <?php }else{?>
                            <p><?php echo number_format($sales[0]['tax'],2);?></p>
                        <?php }?>             
                        <!-- <p><?php echo $sales[0]['tax'];?></p> -->

                        </td>


                    </tr>
                    <tr>
                        <td colspan ="3"  style="line-height: 1.6;"></td>
                        <td colspan = "2" class="clsclr" style="text-align:center;"><b>INVOICE TOTAL</b></td>
                        <td class="clsclr" style="text-align:right;width:20%"><b><?php echo number_format($sales[0]['total'],2)?></b></td>
                    </tr>
                    <?php if($sales[0]['purtotal'] > 0 ){ ?>

                    <tr>
                        <td colspan ="3"  style="line-height: 1.6;"></td>
                        <td colspan = "2" class="clsclr" style="text-align:center;"><b>OLD PURCHASE : <?php echo $sales[0]['pinv'].'('.$sales[0]['pur_gross_wt'].') GM ';?></b></td>
                        <td class="clsclr" style="text-align:right;width:20%"><b><?php echo $sales[0]['purtotal'];?></b></td>
                    </tr>

                    <tr>
                        <td colspan ="3"  style="line-height: 1.6;"></td>
                        <td colspan = "2" class="clsclr" style="text-align:center;"><b>PAYABLE</b></td>
                        <td class="clsclr" style="text-align:right;width:20%"><b><?php echo number_format($sales[0]['total'] - $sales[0]['purtotal'],2);?></b></td>
                    </tr>
                    <?php }?>   

               
                    </table>

                         <?php if(  strtolower($login_comid ) == 'kgold' ||  strtolower($login_comid ) == 'vgold'){ ?>
                    <table border="0" style="padding: 2px;  margin: 0px; width: 100%; text-align:left;font-size:14px;font-weight:normal" >
                         <tr>
                            <td colspan ="6"  style="line-height: 2;font-weight:bold;"><?php echo $msd;?></td>
                            
                        </tr>
                         <tr>
                            <td colspan ="3"  style="line-height: 2;"></td>
                            <td  class="" style="text-align:center;"></td>
                            <td colspan = "2" class="" style="font-size:12px;text-align:right;width:20%;font-size:15px;"> <br /><b>Authorized Signatory</b></td>
                        </tr>
                        </table>
                    <?php }?>


                        <?php }?>

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