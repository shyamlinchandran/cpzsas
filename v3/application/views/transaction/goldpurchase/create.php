<?php 
$user = $this->session->userdata('user');
$user_default_billtype_sales = $user['user_default_billtype'];
$user_default_billtype_sales_return = $user['default_sreturn_billtype'];
$tax = 6;
$search_type= '';
$title= 'Purchase';
if($purchase_type != 'N'){
    $title= 'Old Purchase';
    $search_type = 'old';
}
?>
<style>

.table>tbody>tr>td {
    padding-top: 0px !important;
    padding-bottom: 0px !important;
    padding-left: 0px !important;
    padding-right: 0px !important;    border: 1px solid;
    border-color: #ddd;
}

        table {
        border-collapse: collapse;
    }
    td {
        padding: 0;
    }
    input[type="text"] {
        width: 100%;
        box-sizing: border-box; /* Ensure width includes padding and border */
        padding: 0; /* Remove padding */
        margin: 0; /* Remove margin */
        border: 1px solid #ccc; /* Add border for clarity */
    }
    .exsmall{
        width: 30px !important;
    }
    .large{
        width: 95px !important;
    }
  .medium{
    width: 65px !important;
  }
  .sma{
        width: 50px !important;
    }
    .smatot{
        width:70px !important;
    }
    .small{
        width: 40px !important;
    }
    .smalvl1{
        width: 60px !important;
    }
    .smalvl2{
        width: 40px !important;
    }
    .larg{
        width:130px;
    }
    .largxl{
        width:220px;
    }
    .tableBodyScroll {
        max-height: 250px;
        overflow-y: scroll;
        overflow-x: hidden;
        min-height:250px
    }
    .table>thead>tr>th {
        font-size: 12px;
    }
    .table>tr>th>td {
        font-size: 5px;
    }
    .tableBodyScroll input {
        font-size: 12px; /* Adjust the font size for input elements inside the table */
        font-weight:bold;
    }

       
</style>
<style>
        

        .radio-container {
            text-align: center;
        }

        .radio-container input[type="radio"] {
            margin: 0 5px;  /* Adjust the margin as needed */
        }
        .radio-container input[type="radio"] {
            margin-right: 10px;  /* Adjust the margin as needed */
        }
        .radio-container label {
            display: inline-block;
            margin-right: 10px;  /* Adjust the margin between radio button and text */
            color: #3366cc;  /* Adjust the color for the first radio button text */
        }

        .radio-container label:nth-child(2) {
            color: #cc3366;  /* Adjust the color for the second radio button text */
        }

        .radio-container label:nth-child(3) {
            color: #66cc33;  /* Adjust the color for the third radio button text */
        }
        .consale{
            margin-top:30px;
        }
        #invoice_sales {
            display: inline-block;
            background-color: #3366cc;  /* Adjust the background color */
            color: #fff;  /* Adjust the text color */
            margin-top:0px;
            padding: 8px 15px;  /* Adjust the padding */
            margin-top:18px;
            width:100%;
            border-radius: 5px;  /* Add border-radius for rounded corners */
        }
    </style>
   
<form method="post" id="frmcreateoldp"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/goldpurchase/listall/').$purchase_type; ?>" action="<?php echo site_url('transaction/goldpurchase/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>
    <input type="hidden" value="<?php echo $tax; ?>" name="tax" id="tax"/>
    <input type="hidden" value="<?php echo $purchase_type; ?>" name="purchase_type" id="purchase_type"/>
    <input type="hidden" value="0" name="return_id" id="return_id"/>
    <input type="hidden" value="<?php echo $id; ?>" name="old_pur_id" id="old_pur_id"/>
    <input type="hidden" value="<?php echo $user_default_billtype_sales; ?>" name="user_default_billtype" id="user_default_billtype"/>  
    <input type="hidden" value="<?php echo $view; ?>" name="view" id="view"/> 
    <input type="hidden" value="<?php echo $is_edit; ?>" id="is_edit" name="is_edit" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button" class="btn  btn-success align-bottom"href="<?php echo site_url('transaction/goldpurchase/listall/').$purchase_type; ?>"> <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                       <div class = "col-sm-12">
                            <div style = "display:none" class="radio-container">
                                <label for="sales"><input checked type="radio" value = "sales" id="sales" name="options">Sales</label>
                                <label for="oldpurchase"><input type="radio" value = "oldpurchase" id="oldpurchase" name="options">Old Purchase Items </label>
                                <!-- <label for="salesreturn"><input type="radio" value = "salesreturn"  id="salesreturn" name="options">Sales Return Items </label> -->
                            </div>
                            <div style = "margin:0px;padding:0px;" class = "col-sm-5">
                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-12">
                                            <?= label('Invoice Date', $this, $user) ?> *<span class="required"></span> :
                                            <input   name="date" type="text" id="date" data-validation="required" class="form-control  date" placeholder="Date">                                    
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-12">
                                            <?= label('Cash Type', $this, $user) ?> *<span class="required"></span> :
                                            <select name="cash_type" data-validation="required" id="cash_type" class="form-control">
                                                    <option value="Cash"><?= label('Cash', $this, $user) ?></option>
                                                    <!-- <option value="Bank"><?= label('Bank', $this, $user) ?></option> -->
                                                    <option value="Credit"><?= label('Credit', $this, $user) ?></option>
                                                    <option value="Bank"><?= label('Bank', $this, $user) ?></option>
                                                </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-12">
                                            <?= label('Bill Type', $this, $user) ?> *<span class="required"></span> :
                                            <select name="btype" data-validation="required" id="btype" class="form-control">
                                                   
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 form-group">
                                        <div class="col-sm-12">
                                            <span noTab ="true" style = "" id = "invoice_sales"></span>
                                        </div>
                                    </div>

                                </div>
                                <div style = "margin:0px;padding:0px;" class = "col-sm-7">
                                    <div class= "col-sm-12">
                                        <div  style = "margin:0px;padding:0px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                            <?= label('Party', $this, $user) ?>   <button hddid="sales" data-toggle="tooltip" type="button" title="TotalAdd To save" class="sma btn btn-primary btnaddcustomer" href="#">
                                                        New
                                             </button>
                                                <input data-validation type="hidden" name="customer_id" id="customer_id" />
                                                <input attr = "customer_id"  name="customername" id="customername" type="text" next="true" data-validation class="form-control sales" placeholder="<?= label('Party Name', $this, $user) ?>">
                                            </div>
                                        </div>
                                        
                                        <div  style = "margin:0px;padding:0px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                                <?= label('Billing Name', $this, $user) ?> *<span class="required"></span> :
                                                <input  name="cusname" id="cusname" type="text" next="true" data-validation class="form-control sales" style ="margin-top:10px;"  placeholder="<?= label('Billing Name', $this, $user) ?>">
                                            </div>
                                        </div>
                                        <div  style = "margin:0px;padding:0px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                                <?= label('Address', $this, $user) ?> *<span class="required"></span> :
                                                <textarea  name="cusdetails" id="cusdetails" type="text" next="true"  style ="margin-top:10px;" data-validation class="form-control sales"  ></textarea>
                                            </div>
                                        </div>
                                    </div>

                                        <div  style = "margin:0px;padding:0px;margin-top:20px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                                <?= label('Contact No.', $this, $user) ?> *<span class="required"></span> :
                                                <input  name="con_contact" id="con_contact" type="text" next="true" data-validation class="form-control sales" placeholder="<?= label('Contact Number', $this, $user) ?>">
                                            </div>
                                        </div>
                                        <div  style = "margin:0px;padding:0px;margin-top:20px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                                <?= label('Area', $this, $user) ?> *<span class="required"></span> :
                                                <select id="area" name="area" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div  style = "display :none; margin:0px;padding:0px;margin-top:20px;" class = "col-sm-4">
                                            <div class="col-sm-12 form-group">
                                                <?= label('Salesman', $this, $user) ?> *<span class="required"></span> :
                                                <select id="salesman" name="salesman" class="form-control">
                                                    <option value="">Select</option>
                                                </select>
                                            </div>
                                        </div>
                                </div>
                            <div style = "display:none;"   class = "col-sm-12 consale containersales">
                                
                                <div style = "margin:0px;padding:0px;" class = "col-sm-12 box-body tableBodyScroll">
                                    <table style ="width:100%;font-size:5px !important;"  class ="col-sm-12 table table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th style = "width:6% !important;" ></th>
                                                <th>Description</th>
                                                <!-- <th>AddDesc</th> -->
                                                <th style = "width:6% !important;">Purity</th>
                                                <th style = "width:6% !important;">HUID</th>
                                                <th style = "width:4% !important;">Pcs</th>
                                                <th style = "width:6% !important;">Gross_wt</th>
                                                <th style = "width:6% !important;">Stone_wt</th>
                                                <th style = "width:6% !important;">Stone_chg</th>
                                                <th style = "width:6% !important;">Net_wt</th>
                                                <th style = "width:6% !important;">Rate</th>
                                                <th style = "width:6% !important;">Wstge_wt</th>
                                                <th style = "width:6% !important;">Mkg_chg</th>
                                                <th style = "width:6% !important;">Va%</th>
                                                <th style = "width:6% !important;">Va_amt</th>
                                                <th style = "width:8% !important;">Amount</th>
                                                <th style = "width:6% !important;"></th>
                                            </tr>

                                        </thead>
                                            <tr>
                                                <td class = "" style = "width:6% !important;"><input type ="text" readonly id = "sale_slno" class = "form-control " /></td>
                                                <td class = "large"  ><input type ="text"  id = "sale_items" class = "form-control larg" /><input type ="hidden" id = "sale_item_id" value ="0"   ></td>
                                                <!-- <td style = "width:6% !important;"><input type ="text"  id = "sale_desc" class = "form-control larg" /></td> -->
                                                <td class = "" style = "width:6% !important;"><select id = "sale_purity" class ="form-control purity"   ></select></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_hudid" class = "form-control" /></td>
                                                <td class = "smalvl2" style = "width:4% !important;"><input type ="text"  id = "sale_pcs" class = "form-control clssales  two-digits zero-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_grosswt" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" tyle = "width:6% !important;"><input type ="text"  id = "sale_stonewt" class = "form-control  clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_stonechg" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input noTab = "true" type ="text" readonly id = "sale_newwt" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_rate" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_wstg" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_mkg_chg" class = "form-control clssales  two-digits" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text"  id = "sale_va_per" class = "form-control clssales  two-digits one-digit" /></td>
                                                <td class = "sma" style = "width:6% !important;"><input type ="text" readonly id = "sale_va_amt" class = "form-control   two-digits" /></td>
                                                <td class = "smatot" style = "width:8% !important;"><input type ="text" readonly id = "sale_amt" class = "form-control   two-digits" /></td>
                                                <td class ="exsmall"> 
                                                    <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddExtra" class="btn btn-success btnAddExtra" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tbody id = "bodysales">
                                            </tbody>
                                    </table>
                                </div>
                                
                            </div>
                            <div   class = "col-sm-12 consale containeroldpurchase">
                            <div style = "margin:0px;padding:0px;" class = "col-sm-12 box-body tableBodyScroll">


<table style ="width:100%;font-size:5px !important;"  class ="col-sm-12 table table-striped table-condensed">
    <thead>
        <tr>
            <th style = "width:6% !important;" ></th>
            <th>Description</th>
            <!-- <th>AddDesc</th> -->
            <th style = "width:6% !important;">Purity</th>
            <th style = "display:none;">hudid</th>
            <th style = "width:6% !important;">Pcs</th>
            <th style = "width:6% !important;">Gross_wt</th>
            <th style = "width:6% !important;">Stone_wt</th>
            <?php if($purchase_type == 'N'){?>
                <th style = "width:6% !important;">Stone_Chg</th>
            <?php }?>
            <?php if($purchase_type != 'N'){?>
                <th style = "width:6% !important;">Melt_Loss%</th>
                <th style = "width:6% !important;">Melt_Loss_wt</th>
            <?php }?>
            <th style = "width:6% !important;">Net_wt</th>
            <?php if($purchase_type == 'N'){?>
                <th style = "width:6% !important;">Making_Chg</th>
            <?php }?>
            <th style = "width:6% !important;">Rate</th>
            <th style = "width:6% !important;">Amount</th>
            <th style = "width:6% !important;"></th>
        </tr>

    </thead>
        <tr>
            <td class = "small" style = "width:6% !important;"><input type ="text" readonly id = "oldpur_slno" class = "form-control " /></td>
            <td style = "width:6% !important;"><input type ="text"  id = "oldpur_items" class = "form-control largxl" /><input type ="hidden" id = "oldpur_item_id" value ="0"   ></td>
            <!-- <td style = "width:6% !important;"><input type ="text"  id = "salereturn_desc" class = "form-control larg" /></td> -->
            <td style = "width:6% !important;"><select id = "purchase_purity" class ="form-control purity"   ></select></td>
            <td style = "display:none;width:6% !important;"><input type ="text"  id = "oldpur_hudid" class = "form-control" /></td>
            <td class = "smalvl1" style = "width:6% !important;"><input type ="text"  id = "oldpur_pcs" class = "form-control clsoldpur  two-digits" /></td>
            <td class = "medium"  style = "width:6% !important;"><input type ="text"  id = "oldpur_grosswt" class = "form-control clsoldpur  two-digits" /></td>
            <td class = "medium"  style = "width:6% !important;"><input type ="text"  id = "oldpur_stonewt" class = "form-control  clsoldpur  two-digits" /></td>
            
            <td <?php if($purchase_type != 'N'){?> style = "display:none" <?php }else{  ?> style = "width:6% !important;"<?php }?> class = "medium"  ><input type ="text"  id = "oldpur_stonechg" class = "form-control  clsoldpur  two-digits" /></td>
            <td <?php if($purchase_type == 'N'){?> style = "display:none" <?php }else{  ?> style = "width:6% !important;"<?php }?> class = "medium"  style = "width:6% !important;"><input type ="text"  id = "oldpur_melt_per" class = "form-control  clsoldpur  two-digits" /></td>
            <td <?php if($purchase_type == 'N'){?> style = "display:none" <?php }else{  ?> style = "width:6% !important;"<?php }?> class = "medium"  style = "width:6% !important;"><input readonly type ="text"  id = "oldpur_melt_wt" class = "form-control  clsoldpur  two-digits" /></td>
            <td class = "medium"  style = "width:6% !important;"><input noTab = "true" type ="text" readonly id = "oldpur_newwt" class = "form-control clsoldpur  two-digits" /></td>
            <td class = "medium" <?php if($purchase_type != 'N'){?> style = "display:none" <?php }else{  ?> style = "width:6% !important;"<?php }?>><input type ="text"  id = "oldpur_makingchg" class = "form-control  clsoldpur  two-digits" /></td>
            <td class = "medium"  style = "width:6% !important;"><input type ="text"  id = "oldpur_rate" class = "form-control clsoldpur  two-digits" /></td>
            <td class = "medium"  style = "width:6% !important;"><input type ="text" readonly id = "oldpur_amt" class = "form-control   two-digits" /></td>
            <td> 
                <button  style = "width:100%;" data-toggle="tooltip" type="button" title="Add To save" id="btnAddoldpur" class="btn btn-success btnAddoldpur" href="#">
                    <span class="glyphicon glyphicon-plus"></span>
                </button>
            </td>
        </tr>
        <tbody id = "bodyoldpur">
        </tbody>
    </table>

</div>
                            </div>
                            <div style = "display:none;" class = "col-sm-12 consale containersalesreturn">
                                <div style = "margin:0px;padding:0px;" class = "col-sm-12 box-body tableBodyScroll">


                                    <table style ="width:100%;font-size:5px !important;"  class ="col-sm-12 table table-striped table-condensed">
                                        <thead>
                                            <tr>
                                                <th style = "width:6% !important;" ></th>
                                                <th>Description</th>
                                                <!-- <th>AddDesc</th> -->
                                                <th style = "width:6% !important;">Pcs</th>
                                                <th style = "width:6% !important;">Gross_wt</th>
                                                <th style = "width:6% !important;">Stone_wt</th>
                                                <th style = "width:6% !important;">Stone_chg</th>
                                                <th style = "width:6% !important;">Net_wt</th>
                                                <th style = "width:6% !important;">Rate</th>
                                                <th style = "width:6% !important;">Va%</th>
                                                <th style = "width:6% !important;">Va_amt</th>
                                                <th style = "width:6% !important;">Amount</th>
                                                <th style = "width:6% !important;"></th>
                                            </tr>

                                        </thead>
                                            <tr>
                                                <td style = "width:6% !important;"><input type ="text" readonly id = "salereturn_slno" class = "form-control small" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_items" class = "form-control larg" /><input type ="hidden" id = "salereturn_item_id" value ="0"   ></td>
                                                <!-- <td style = "width:6% !important;"><input type ="text"  id = "salereturn_desc" class = "form-control larg" /></td> -->
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_pcs" class = "form-control clssalesreturn smalvl1 two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_grosswt" class = "form-control clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_stonewt" class = "form-control  clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_stonechg" class = "form-control clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input noTab = "true" type ="text" readonly id = "salereturn_newwt" class = "form-control clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_rate" class = "form-control clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text"  id = "salereturn_va_per" class = "form-control clssalesreturn medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text" readonly id = "salereturn_va_amt" class = "form-control  medium two-digits" /></td>
                                                <td style = "width:6% !important;"><input type ="text" readonly id = "salereturn_amt" class = "form-control  medium two-digits" /></td>
                                                <td> 
                                                    <button data-toggle="tooltip" type="button" title="Add To save" id="btnAddsalesreturn" class="btn btn-success" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span>
                                                    </button>
                                                </td>
                                            </tr>
                                            <tbody id = "bodysalesreturn">
                                            </tbody>
                                        </table>

                                </div>
                            </div>

                            <div  class="col-sm-12 row  ">
                                    <div style="display:none;" class="col-sm-4  ">
                                    &nbsp;
                                    </div>
                                    <div style ="display:none" style="padding:3px;" class="col-sm-4  ">
                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Discount', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input  id="discount" name="discount" value='0.00'  placeholder="<?= label('Discount', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Tax %', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <select readonly id ="tax_id" name ="tax_id" class = "form-control">
                                                    
                                                </select> 
                                            </div>
                                        </div>

                                        
                                    </div>
                                    <div style="display:none;" class="col-sm-4  ">
                                        <div  style ="display:none" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Order Amt', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readobly id="orderAmt" name="orderAmt" value='0.00'  placeholder="<?= label('Order Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        

                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Sale Amt', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly id="saleAmt" name="saleAmt" value='0.00'  placeholder="<?= label('Sale Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>
                                        
                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Before Tax', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly id="before" name="before" value='0.00'  placeholder="<?= label('Before TAx', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>
                                       
                                       
                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Sale Total', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-3">
                                                <input readonly id="saleTax" name="saleTax" value='0.00'  placeholder="<?= label('Sale Tax', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                            <div style="padding:3px;" class="col-sm-4">
                                                <input readonly id="salesTot" name="salesTot" value='0.00'  placeholder="<?= label('Sale Tot', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        
                                        <div class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Payable', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly id="payable" name="payable" value='0.00'  placeholder="<?= label('Payable Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div style ="display:none" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Sales Return Amt', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readonly id="returnAmt" name="returnAmt" value='0.00'  placeholder="<?= label('Sales Return Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div style ="display:none" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Gross Amt', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readobly id="grossAmt" name="grossAmt" value='0.00'  placeholder="<?= label('Gross Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div style ="display:none" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Net Amt', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readobly id="netAmt" name="netAmt" value='0.00'  placeholder="<?= label('Net Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div style ="display:none;" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Amount Paid', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readobly id="amtPaid" name="amtPaid" value='0.00'  placeholder="<?= label('Amount Paid', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                                        <div style ="display:none" class="col-sm-12">
                                           <div style="padding:3px;" class="col-sm-5"><?= label('Balance', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-7">
                                                <input readobly id="balanceAmt" name="balanceAmt" value='0.00'  placeholder="<?= label('Balance Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                                       
                                        <div <?php if($purchase_type !='N'){?> style= "display:none;" <?php }?> class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-6">&nbsp;</div>
                                           <div style="padding:3px;" class="col-sm-3"><?= label('Tax %', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-3">
                                                <select readonly id ="purtax_id" name ="purtax_id" class = "form-control">
                                                        
                                                </select> 
                                            </div>
                                        </div>

                                        <div <?php if($purchase_type !='N'){?> style= "display:none;" <?php }?> class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-6">&nbsp;</div>
                                           <div style="padding:3px;" class="col-sm-3"><?= label('Tax', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-3">
                                                <input readonly id="PurTax" name="PurTax" value='0.00'  placeholder="<?= label('Sale Tax', $this, $user) ?>" type="text" class="text-right  form-control two-digits">

                                            </div>
                                        </div>

                                      


                                    <div class="col-sm-12">
                                            <div style="padding:3px;" class="col-sm-6">&nbsp;</div>
                                           <div style="padding:3px;" class="col-sm-3"><?= label('Amount', $this, $user) ?></div>
                                            <div style="padding:3px;" class="col-sm-3">
                                                <input readonly id="oldPAmt" name="oldPAmt" value='0.00'  placeholder="<?= label('Old Purchase Amt', $this, $user) ?>" type="text" class="text-right  form-control two-digits">
                                            </div>
                                        </div>

                    </div>  
                    <div class="box-footer">          
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class='small-loading' id='FormLoading'> </div>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>

            </div> 
        </div>

    </section>
</form>
<script type="text/javascript">
    function calculateGtotal(){
        var taxtotal = 0 ;
        var sale_amount = $('#saleAmt').val();
        if(sale_amount === ''){
            sale_amount = 0 ;
        }
        var discount = $('#discount').val();
        if(discount === ''){
            discount = 0 ;
        }
        $('#discount').val(parseFloat(discount).toFixed(3));
        sale_amount = parseFloat(sale_amount) - parseFloat(discount);
        $('#before').val(parseFloat(sale_amount).toFixed(3));
        var saletotal = sale_amount;
        $('#salesTot').val(parseFloat(saletotal).toFixed(3));
        $('#saleTax').val(0.000);
        var gst = $('#tax_id').val();
        var taxperc = 0 ;
        if(gst !== '' && gst !== undefined && tax_id !== 0){
            taxperc = $("#tax_id option:selected").attr('percent');
        } 
        if(parseFloat(taxperc) > 0 ){
            taxtotal = parseFloat(sale_amount) * parseFloat(taxperc) / 100;
            saletotal = parseFloat(saletotal) + parseFloat(taxtotal);
            $('#salesTot').val(parseFloat(saletotal).toFixed(3));
            $('#saleTax').val(parseFloat(taxtotal).toFixed(3));
        }
        var oldPAmt=  $('#oldPAmt').val();
        if(oldPAmt ===''){
            oldPAmt = 0;
        }
        var salesTot=  $('#salesTot').val();
        if(salesTot ===''){
            salesTot = 0;
        }
        var payable = parseFloat(salesTot) - parseFloat(oldPAmt);
        $('#payable').val(parseFloat(payable).toFixed(3));
        
    }
    var textpurity = '';
    var cntoldpur = 0;
    function addrowoldpurchase(oldpur_item_id,oldpur_items,oldpur_pcs,oldpur_grosswt,oldpur_stonewt,oldpur_melt_per,oldpur_melt_wt,oldpur_newwt,oldpur_rate,oldpur_amt,purchase_purity,oldpur_hudid,oldpur_stonechg,oldpur_makingchg){
        //oldpur_makingchg
        var purchase_type = $('#purchase_type').val();
        var display = '';
        var dis = ' style ="display:none;" ';
        if(purchase_type != 'N'){
            display = ' style ="display:none;" ';
            dis = '';
        }
        cntoldpur = cntoldpur + 1;
        var text = '<tr>';
        text = text +'<td><input type = "text" readonly class="form-control  nos" /></td>';
        text = text + '<td><input class = "form-control" type = "text" readonly name = "oldpuritems[]" value = "'+oldpur_items+'" /><input type = "hidden" name = "oldpuritemid[]" value ="'+oldpur_item_id+'"/> </td>';
        
        text = text + '<td><select id= "purchasepurity'+cntoldpur+'"  name="purchasepurity[]" class="form-control">'+textpurity+'</select></td>';
        text = text + '<td style ="display:none" ><input value= "'+oldpur_hudid+'" type="text" name="oldpurhudid[]" class="form-control" autocomplete="off"></td>';
        
        text = text + '<td><input attr ='+cntoldpur+' type="text" id="oldpur_pcs'+cntoldpur+'"  name="oldpurpcs[]" value ="'+oldpur_pcs+'" class="form-control clsoldpurrow   two-digits" ></td>';
       
        text = text + '<td><input attr ='+cntoldpur+' type="text" id="oldpur_grosswt'+cntoldpur+'" name = "oldpurgrosswt[]" value ="'+oldpur_grosswt+'" class="form-control clsoldpurrow    two-digits" autocomplete="off"></td>';


        text = text + '<td><input attr ='+cntoldpur+' type="text" id="oldpur_stonewt'+cntoldpur+'" name="oldpurstonewt[]" value ="'+oldpur_stonewt+'" class="form-control  clsoldpurrow    two-digits" autocomplete="off"></td>';
        text = text + '<td '+display+'><input attr ='+cntoldpur+' type="text" id="oldpur_stonechg'+cntoldpur+'" name="oldpurstonechg[]" value ="'+oldpur_stonechg+'" class="form-control  clsoldpurrow    two-digits" autocomplete="off"></td>';

        text = text + '<td '+dis+' ><input attr ='+cntoldpur+' type="text" id="oldpur_melt_per'+cntoldpur+'" name="oldpurmeltper[]" value ="'+oldpur_melt_per+'" class="form-control clsoldpurrow    two-digits" autocomplete="off"></td>';


        text = text + '<td '+dis+'><input attr ='+cntoldpur+' notab="true" type="text" readonly  id="oldpur_melt_wt'+cntoldpur+'" value ="'+oldpur_melt_wt+'"  name="oldpurmeltwt[]" class="form-control clsoldpurrow    two-digits" autocomplete="off"></td>';
        
        text = text + '<td><input readonly attr ='+cntoldpur+' type="text" id="oldpur_newwt'+cntoldpur+'" name="oldpurnewwt[]" value ="'+oldpur_newwt+'"  class="form-control clsoldpurrow    two-digits" autocomplete="off"></td>';

        text = text + '<td '+display+'><input attr ='+cntoldpur+' type="text" id="oldpur_makingchg'+cntoldpur+'" name="oldpurmakingchg[]" value ="'+oldpur_makingchg+'" class="form-control  clsoldpurrow    two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntoldpur+' type="text" id="oldpur_rate'+cntoldpur+'" name="oldpurrate[]" value ="'+oldpur_rate+'" class="form-control clsoldpurrow    two-digits" autocomplete="off"></td>';


        text = text + '<td><input attr ='+cntoldpur+' type="text" readonly="" id="oldpur_amt'+cntoldpur+'" name="oldpuramt[]" class="form-control oldpuramt" value ="'+oldpur_amt+'"     two-digits" autocomplete="off"></td>';
        text = text + '<td><span data-toggle="tooltip"   title="Remove" onclick="removeoldpur(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        text =text + '</tr>';
        $('.clsoldpur').val('');
        $('#oldpur_items').val('');
        $('#oldpur_amt').val('');
        $('#oldpur_item_id').val(0);
        $('#bodyoldpur').append(text);
        $('#purchasepurity'+cntoldpur).val(purchase_purity);
        calculateOldPurchasetotal();
    }
    var cnts = 0 ;
    var cntsr = 0 ;

    function calculateOldPurchasetotal(){
        var oldpuramt = 0 ;
        $(".oldpuramt").each(function() {
            oldpuramt = parseFloat($(this).val()) + parseFloat(oldpuramt);
        });
        var purtax = 0 ;
        var gst = $('#purtax_id').val();
        var taxperc = 0 ;
        if(gst !== '' && gst !== undefined && tax_id !== 0){
            taxperc = $("#purtax_id option:selected").attr('percent');
        } 
        var purchase_type = $('#purchase_type').val();
        if(parseFloat(taxperc) > 0 && purchase_type == 'N'){
            purtax = parseFloat(oldpuramt) * parseFloat(taxperc)/100;
            oldpuramt = parseFloat(oldpuramt) + parseFloat(purtax);
        }
        $('#PurTax').val(parseFloat(purtax).toFixed(3));
        $('#oldPAmt').val(parseFloat(oldpuramt).toFixed(3));
        calculateGtotal();
    }

    
    function calculateSalesreturntotal(){
        var salereturnamt = $('#salereturnamt').val();
        var saletotal = 0 ;
        $(".salereturnamt").each(function() {
            saletotal = parseFloat($(this).val()) + parseFloat(saletotal);
        });
        $('#returnAmt').val(saletotal);
        calculateGtotal();
    }
    function calculateSalestotal(){
        var saleAmt = $('#saleAmt').val();
        var saletotal = 0 ;
        $(".saleamt").each(function() {
            saletotal = parseFloat($(this).val()) + parseFloat(saletotal);
        });
        $('#saleAmt').val(parseFloat(saletotal).toFixed(3));
        calculateGtotal();
    }

    function removeoldpur(btn){
        $(btn).closest('tr').remove();
        calculateOldPurchasetotal();
    }
    function removesales(btn){
        $(btn).closest('tr').remove();
        calculateSalestotal();
    }
    function removesalesreturn(btn){
        $(btn).closest('tr').remove();
        calculateSalesreturntotal();
    }
    $(document).on("change","#btype",function() {
        var id = $('#btype').val();
        setbillno(id);
    });

    function setbillno(id) {
        var sid = $('#id').val();
        if (sid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/Purchase/getinoviceno'); ?>/" + id,
				type: 'POST',
                data: {
                    // date: date
                },
                success: function(result) {
                    $('#invoice_sales').html(result);
                    
                }
            });
        }
    }

    function addrowreturn(sale_item_id,sale_items,sale_pcs,sale_grosswt,sale_stonewt,sale_stonechg,sale_newwt,sale_rate,sale_va_per,sale_va_amt){
        cntsr = cntsr + 1;
        if(!$.isNumeric(sale_wstg)){
            sale_wstg  = 0 ;
        }
        if(!$.isNumeric(sale_newwt)){
            sale_newwt  = 0 ;
        }
        if(!$.isNumeric(sale_rate)){
            sale_rate  = 0 ;
        }
       
        if(!$.isNumeric(sale_stonechg)){
            sale_stonechg  = 0 ;
        }
        if(!$.isNumeric(sale_va_per)){
            sale_va_per  = 0 ;
        }
        var total = parseFloat(total) + parseFloat(sale_va_amt);
        var total = parseFloat(sale_newwt) * parseFloat(sale_rate);
        total = parseFloat(total) +  parseFloat(sale_stonechg);
        var sale_va_amt = 0 ;
        if(parseFloat(sale_va_per) > 0  && parseFloat(total) > 0 ){
            sale_va_amt  = parseFloat(total * sale_va_per) /100;
        }
        var total = parseFloat(total) + parseFloat(sale_va_amt);
        var text = '<tr>';
         text = text +'<td><input type = "text" readonly class="form-control  nos" /></td>';
        text = text + '<td><input class = "form-control" type = "text" readonly name = "salesreturnitem[]" value = "'+sale_items+'" /><input type = "hidden" name = "salereturnitemid[]" value ="'+sale_item_id+'"/> </td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturnpcs'+cntsr+'"  name="salereturnpcs[]" value ="'+sale_pcs+'" class="form-control clssalesreturnrow smalvl1 two-digits" ></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturngrosswt'+cntsr+'" name = ="salereturngrosswt[]" value ="'+sale_grosswt+'" class="form-control clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturnstonewt'+cntsr+'" name="salereturnstonewt[]" value ="'+sale_stonewt+'" class="form-control  clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturnstonechg'+cntsr+'" name="salereturnstonechg[]" value ="'+sale_stonechg+'" class="form-control clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' notab="true" type="text" readonly="" id="salereturnnewwt'+cntsr+'" value ="'+sale_stonewt+'"  name="salereturnnewwt[]" class="form-control clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturnrate'+cntsr+'" name="salereturnrate[]" value ="'+sale_rate+'" class="form-control clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" id="salereturnvaper'+cntsr+'" name="salereturnvaper[]" value ="'+sale_va_per+'"  class="form-control clssalesreturnrow sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" readonly="" id="salereturnvaamt'+cntsr+'" name="salereturnvaamt[]" value ="'+sale_va_amt+'"  class="form-control  sma two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cntsr+' type="text" readonly="" id="salereturnamt'+cntsr+'" name="salereturnamt[]" class="form-control salereturnamt" value ="'+total+'"  sma two-digits" autocomplete="off"></td>';
        text = text + '<td><span data-toggle="tooltip"   title="Remove" onclick="removesalesreturn(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        text = text + '</tr>';

        $('#salereturn_items').val('');
        $('#salereturn_item_id').val(0);
        $('#salereturn_amt').val('');
        $('.clssalesreturn ').val('');
        $('#bodysalesreturn').append(text);
        calculateSalesreturntotal();

    }

    function addrow(sale_item_id,sale_items,sale_pcs,sale_grosswt,sale_stonewt,sale_stonechg,sale_newwt,sale_rate,sale_wstg,sale_mkg_chg,sale_va_per,sale_va_amt,sale_purity,sale_hudid){
        cnts = cnts + 1;
        if(!$.isNumeric(sale_wstg)){
            sale_wstg  = 0 ;
        }
        if(!$.isNumeric(sale_newwt)){
            sale_newwt  = 0 ;
        }
        if(!$.isNumeric(sale_rate)){
            sale_rate  = 0 ;
        }
        if(!$.isNumeric(sale_mkg_chg)){
            sale_mkg_chg  = 0 ;
        }
        if(!$.isNumeric(sale_stonechg)){
            sale_stonechg  = 0 ;
        }
        if(!$.isNumeric(sale_va_per)){
            sale_va_per  = 0 ;
        }
        var sale_wstg_amt = parseFloat(sale_wstg) * parseFloat(sale_rate);
        var total = parseFloat(total) + parseFloat(sale_va_amt);
        var total = parseFloat(sale_newwt) * parseFloat(sale_rate);
        total = parseFloat(total) + parseFloat(sale_mkg_chg) + parseFloat(sale_stonechg);
        var sale_va_amt = 0 ;
        if(parseFloat(sale_va_per) > 0  && parseFloat(total) > 0 ){
            sale_va_amt  = parseFloat(total * sale_va_per) /100;
        }
        var total = parseFloat(total) + parseFloat(sale_va_amt) +parseFloat(sale_wstg_amt);
        sale_va_amt = parseFloat(sale_va_amt) + parseFloat(sale_mkg_chg)+parseFloat(sale_wstg_amt);
       var text = '<tr>';
        text = text +'<td><input type = "text" readonly class="form-control   nos" /></td>';
        text = text + '<td><input class = "form-control" type = "text" readonly name = "salesitem[]" value = "'+sale_items+'" /><input type = "hidden" name = "saleitemid[]" value ="'+sale_item_id+'"/> </td>';
        text = text + '<td><select id= "salepurity'+cnts+'"  name="salepurity[]" class="form-control">'+textpurity+'</select></td>';
        text = text + '<td><input value= "'+sale_hudid+'" type="text" name="salehudid[]" class="form-control" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salepcs'+cnts+'"  name="salepcs[]" value ="'+parseFloat(sale_pcs).toFixed(0)+'" class="form-control clssalesrow  two-digits zero-digits" ></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salegrosswt'+cnts+'" name ="salegrosswt[]" value ="'+sale_grosswt+'" class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salestonewt'+cnts+'" name="salestonewt[]" value ="'+sale_stonewt+'" class="form-control  clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salestonechg'+cnts+'" name="salestonechg[]" value ="'+sale_stonechg+'" class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' notab="true" type="text" readonly="" id="salenewwt'+cnts+'" value ="'+parseFloat(sale_stonewt).toFixed(3)+'"  name="salenewwt[]" class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salerate'+cnts+'" name="salerate[]" value ="'+sale_rate+'" class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salewstg'+cnts+'" name="salewstg[]" value ="'+sale_wstg+'" class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salemkgchg'+cnts+'" name="salemkgchg[]" value ="'+sale_mkg_chg+'"  class="form-control clssalesrow  two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" id="salevaper'+cnts+'" name="salevaper[]" value ="'+sale_va_per+'"  class="form-control clssalesrow  two-digits one-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" readonly="" id="salevaamt'+cnts+'" name="salevaamt[]" value ="'+parseFloat(sale_va_amt).toFixed(3)+'"  class="form-control   two-digits" autocomplete="off"></td>';
        text = text + '<td><input attr ='+cnts+' type="text" readonly="" id="saleamt'+cnts+'" name="saleamt[]" class="form-control saleamt" value ="'+parseFloat(total).toFixed(3)+'"   two-digits" autocomplete="off"></td>';
        text = text + '<td><span data-toggle="tooltip"   title="Remove" onclick="removesales(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        text = text + '</tr>';
        $('#sale_item').val('');
        $('#sale_item_id').val(0);
        $('#sale_items').val('');
        $('#sale_amt').val('');
        $('.clssales').val('');
        $('#bodysales').append(text);
        $('#salepurity'+cnts).val(sale_purity);
        $('#salestonechg'+cnts).trigger('change');
        calculateSalestotal();

    }

    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function(results) {
                var result = JSON.parse(results)[0];
                $('#customername').val(result.name);
                $('#cusname').val(result.name);
                $('#cusdetails').val(result.address_line1);
                $('#con_contact').val(result.phone);
                $('#customer_id').val(id);

            }
        });
    }


	$(document).ready(function () {

        
        $('#sale_pcs').change(function(){
            var val = $(this).val();
            if(val === ''){
                val = 0;
            }
            $(this).val(parseFloat(val).toFixed(0));
        });
        $('input[type="text"]').focus(function(){
            $(this).select();
        });
        $(document).on('keypress', 'input[type="text"]', function(event){
            // Check if the pressed key is Enter
            if(event.which === 13) {
                // Prevent the default form submission behavior
                event.preventDefault();
                // Optionally, you can also blur the input to remove focus
                var $nextInput = $(this).nextAll('input[type="text"]:visible').not('[readonly]').first();
                if ($nextInput.length > 0) {
                    $nextInput.focus();
                } 
            }
        });
        $('#tax_id').change(function(){
            calculateGtotal();
        });
        $('#purtax_id').change(function(){
            calculateGtotal();
        });
        $('#discount').change(function(){
            calculateGtotal();
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            async:false,
            success: function(result) {
                $('#tax_id').html(result);
                var tax =$('#tax').val();
                $('#tax_id').val(tax);
                $('#purtax_id').html(result);
                $('#purtax_id').val(tax);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/purity'); ?>",
            async:false,
            success: function(result) {
                $('.purity').html(result);
                textpurity = result;
            }
        });
        $('input[type=radio][name=options]').change(function() {
            $('.consale').attr('style','display:none');
            if (this.value == 'sales') {
                $('.containersales').attr('style','');
            }
            else if (this.value == 'salesreturn') {
                $('.containersalesreturn').attr('style','');
            }else if (this.value == 'oldpurchase') {
                $('.containeroldpurchase').attr('style','');
            }
        });
        $('#btnAddsalesreturn').click(function(){
            var total =  $('#salereturn_amt').val();
            if(parseFloat(total) > 0 ){
                var salereturn_pcs = $('#salereturn_pcs').val();
                if(!$.isNumeric($("#salereturn_pcs").val())){
                    salereturn_pcs  = 0 ;
                }

                var salereturn_grosswt = $('#salereturn_grosswt').val();
                if(!$.isNumeric($("#salereturn_grosswt").val())){
                    salereturn_grosswt  = 0 ;
                }

                var salereturn_stonewt = $('#salereturn_stonewt').val();
                if(!$.isNumeric($("#salereturn_stonewt").val())){
                    salereturn_stonewt  = 0 ;
                }

                var salereturn_stonechg = $('#salereturn_stonechg').val();
                if(!$.isNumeric($("#salereturn_stonechg").val())){
                    salereturn_stonechg  = 0 ;
                }
            
            
                var salereturn_newwt = $('#salereturn_newwt').val();

                var salereturn_rate = $('#salereturn_rate').val();
                if(!$.isNumeric($("#salereturn_rate").val())){
                    salereturn_rate  = 0 ;
                }


               

                var salereturn_va_per = $('#salereturn_va_per').val();

            
                if(!$.isNumeric($("#salereturn_va_per").val())){
                    salereturn_va_per  = 0 ;
                }

                var  salereturn_va_amt = $('#salereturn_va_amt').val(0);
                if(!$.isNumeric($("#salereturn_va_amt").val())){
                    salereturn_va_amt  = 0 ;
                }
                var salereturn_item_id = $('#salereturn_item_id').val();
                var salereturn_items = $('#salereturn_items').val();
                addrowreturn(salereturn_item_id,salereturn_items,salereturn_pcs,salereturn_grosswt,salereturn_stonewt,salereturn_stonechg,salereturn_newwt,salereturn_rate,salereturn_va_per,salereturn_va_amt);
            }
        });

        $('#oldpur_melt_per').keydown(function(event){
            // Check if the pressed key is Enter or Tab
            if(event.which === 13 || event.which === 9) {

                // Prevent the default behavior of Enter key (form submission) and Tab key (tab navigation)
                $('.btnAddoldpur').trigger('click');

            }
        });

      

        $('#btnAddoldpur').click(function(){
            var total =  $('#oldpur_amt').val();
            if(parseFloat(total) > 0 ){
                var oldpur_pcs = $('#oldpur_pcs').val();
                if(!$.isNumeric($("#oldpur_pcs").val())){
                    oldpur_pcs  = 0 ;
                }

                var oldpur_grosswt = $('#oldpur_grosswt').val();
                if(!$.isNumeric($("#oldpur_grosswt").val())){
                    oldpur_grosswt  = 0 ;
                }

                var oldpur_stonewt = $('#oldpur_stonewt').val();
                if(!$.isNumeric($("#oldpur_stonewt").val())){
                    oldpur_stonewt  = 0 ;
                }

                var oldpur_melt_per = $('#oldpur_melt_per').val();
                if(!$.isNumeric($("#oldpur_melt_per").val())){
                    oldpur_melt_per  = 0 ;
                }
            
            

                var oldpur_melt_wt = $('#oldpur_melt_wt').val();
                if(!$.isNumeric($("#oldpur_melt_wt").val())){
                    oldpur_melt_wt  = 0 ;
                }


                var oldpur_rate = $('#oldpur_rate').val();
                if(!$.isNumeric($("#oldpur_rate").val())){
                    oldpur_rate  = 0 ;
                }
				
				var oldpur_newwt = parseFloat(oldpur_grosswt)  - parseFloat(oldpur_stonewt) -parseFloat(oldpur_melt_wt);
				var oldpur_amt = parseFloat(oldpur_newwt) * parseFloat(oldpur_rate);

                var oldpur_stonechg = $('#oldpur_stonechg').val();
                if(!$.isNumeric($("#oldpur_stonechg").val())){
                    oldpur_stonechg  = 0 ;
                    $('#oldpur_stonechg').val(0);
                }

                var oldpur_makingchg = $('#oldpur_makingchg').val();
                if(!$.isNumeric($("#oldpur_makingchg").val())){
                    oldpur_makingchg  = 0 ;
                    $('#oldpur_makingchg').val(0);
                }

                oldpur_amt = parseFloat(oldpur_amt) + parseFloat(oldpur_stonechg) + parseFloat(oldpur_makingchg) ;

                var oldpur_items = $('#oldpur_items').val();
                var oldpur_item_id = $('#oldpur_item_id').val();
                var purchase_purity =  $('#purchase_purity').val();
                var oldpur_hudid =  $('#oldpur_hudid').val();
				addrowoldpurchase(oldpur_item_id,oldpur_items,oldpur_pcs,oldpur_grosswt,oldpur_stonewt,oldpur_melt_per,oldpur_melt_wt,oldpur_newwt,oldpur_rate,oldpur_amt,purchase_purity,oldpur_hudid,oldpur_stonechg,oldpur_makingchg);
            }
        });


        $('#btnAddExtra').click(function(){
            var total =  $('#sale_amt').val();
            if(parseFloat(total) > 0 ){
                var sale_pcs = $('#sale_pcs').val();
                if(!$.isNumeric($("#sale_pcs").val())){
                    sale_pcs  = 0 ;
                }

                var sale_grosswt = $('#sale_grosswt').val();
                if(!$.isNumeric($("#sale_grosswt").val())){
                    sale_grosswt  = 0 ;
                }

                var sale_stonewt = $('#sale_stonewt').val();
                if(!$.isNumeric($("#sale_stonewt").val())){
                    sale_stonewt  = 0 ;
                }

                var sale_stonechg = $('#sale_stonechg').val();
                if(!$.isNumeric($("#sale_stonechg").val())){
                    sale_stonechg  = 0 ;
                }
            
            
                var sale_newwt = $('#sale_newwt').val();

                var sale_rate = $('#sale_rate').val();
                if(!$.isNumeric($("#sale_rate").val())){
                    sale_rate  = 0 ;
                }

                var sale_wstg = $('#sale_wstg').val();

                var sale_mkg_chg = $('#sale_mkg_chg').val();
                if(!$.isNumeric($("#sale_mkg_chg").val())){
                    sale_mkg_chg  = 0 ;
                }

                var sale_va_per = $('#sale_va_per').val();

            
                if(!$.isNumeric($("#sale_va_per").val())){
                    sale_va_per  = 0 ;
                }

                var  sale_va_amt = $('#sale_va_amt').val(0);
                if(!$.isNumeric($("#sale_va_amt").val())){
                    sale_va_amt  = 0 ;
                }
                var sale_item_id = $('#sale_item_id').val();
                var sale_items = $('#sale_items').val();

                var sale_purity = $('#sale_purity').val();
                var sale_hudid = $('#sale_hudid').val();
                addrow(sale_item_id,sale_items,sale_pcs,sale_grosswt,sale_stonewt,sale_stonechg,sale_newwt,sale_rate,sale_wstg,sale_mkg_chg,sale_va_per,sale_va_amt,sale_purity,sale_hudid);
            }
        });

        $(document).on("change",".clssalesreturnrow",function() {
            var attr = $(this).attr('attr');
            var salepcs = $('#salereturnpcs'+attr).val();
            var salegrosswt = $('#salereturngrosswt'+attr).val();
            var salestonewt = $('#salereturnstonewt'+attr).val();
            var salestonechg = $('#salereturnstonechg'+attr).val();
            if(!$.isNumeric($("#salereturnstonechg"+attr).val())){
                salestonechg  = 0 ;
                $('#salereturnstonechg'+attr).val(0);
            }
            if(!$.isNumeric($("#salereturngrosswt"+attr).val())){
                salegrosswt  = 0 ;
                $('#salereturngrosswt'+attr).val(0);
            }
            if(!$.isNumeric($("#salereturnstonewt"+attr).val())){
                salestonewt  = 0 ;
                $('#salereturnstonewt'+attr).val(0);
            }
            var salenewwt = parseFloat(salegrosswt) - parseFloat(salestonewt);
            $('#salereturnnewwt'+attr).val(parseFloat(salenewwt).toFixed(3));

            var salerate = $('#salereturnrate'+attr).val();
            if(!$.isNumeric($("#salereturnrate"+attr).val())){
                salerate  = 0 ;
                $('#salereturnrate'+attr).val(0);
            }


          

            var salevaper = $('#salereturnvaper'+attr).val();

            var total = parseFloat(salenewwt) * parseFloat(salerate);
            total = parseFloat(total)  + parseFloat(salestonechg);
            var salevaper = $('#salereturnvaper'+attr).val();
            if(!$.isNumeric($("#salereturnvaper"+attr).val())){
                salevaper  = 0 ;
                $('#salereturnvaper'+attr).val(0);
            }
            var salevaamt = 0;
            $('#salereturnvaamt'+attr).val(0);
            if(parseFloat(salevaper) > 0  && parseFloat(total) > 0 ){
                salevaamt  = parseFloat(total * salevaper) /100;
                $('#salereturnvaamt'+attr).val(salevaamt);
            }
            var total = parseFloat(total) + parseFloat(salevaamt);
            $('#salereturnamt'+attr).val(total);
            calculateSalesreturntotal();

        });

        
        $(document).on("change",".clssalesrow",function() {
            var attr = $(this).attr('attr');
            var salepcs = $('#salepcs'+attr).val();
            var salegrosswt = $('#salegrosswt'+attr).val();
            var salestonewt = $('#salestonewt'+attr).val();
            var salestonechg = $('#salestonechg'+attr).val();
            if(!$.isNumeric($("#salestonechg"+attr).val())){
                salestonechg  = 0 ;
                $('#salestonechg'+attr).val(0);
            }
            if(!$.isNumeric($("#salegrosswt"+attr).val())){
                salegrosswt  = 0 ;
                $('#salegrosswt'+attr).val(0);
            }
            if(!$.isNumeric($("#salestonewt"+attr).val())){
                salestonewt  = 0 ;
                $('#salestonewt'+attr).val(0);
            }
            var salenewwt = parseFloat(salegrosswt) - parseFloat(salestonewt);
            $('#salenewwt'+attr).val(parseFloat(salenewwt).toFixed(3));

            var salerate = $('#salerate'+attr).val();
            if(!$.isNumeric($("#salerate"+attr).val())){
                salerate  = 0 ;
                $('#salerate'+attr).val(0);
            }

            var salewstg = $('#salewstg'+attr).val();
            if(!$.isNumeric($("#salewstg"+attr).val())){
                salewstg  = 0 ;
                $('#salewstg'+attr).val(0);
            }

            var salewstg_amt = parseFloat(salewstg) * parseFloat(salerate);

            var salemkgchg = $('#salemkgchg'+attr).val();
            if(!$.isNumeric($("#salemkgchg"+attr).val())){
                salemkgchg  = 0 ;
                $('#salemkgchg'+attr).val(0);
            }

            var salevaper = $('#salevaper'+attr).val();

            var total = parseFloat(salenewwt) * parseFloat(salerate);
            total = parseFloat(total) + parseFloat(salemkgchg) + parseFloat(salestonechg);
            var salevaper = $('#salevaper'+attr).val();
            if(!$.isNumeric($("#salevaper"+attr).val())){
                salevaper  = 0 ;
                $('#salevaper'+attr).val(0);
            }
            var salevaamt = 0;
            $('#salevaamt'+attr).val(0);
            if(parseFloat(salevaper) > 0  && parseFloat(total) > 0 ){
                salevaamt  = parseFloat(total * salevaper) /100;
                $('#salevaamt'+attr).val(salevaamt);
            }

            salevaamtnew = parseFloat(salevaamt) + parseFloat(salemkgchg) + parseFloat(salewstg_amt);
            $('#salevaamt'+attr).val(parseFloat(salevaamtnew).toFixed(3));
            var total = parseFloat(total) + parseFloat(salevaamt) + parseFloat(salewstg_amt);
            $('#saleamt'+attr).val(parseFloat(total).toFixed(3));
            calculateSalestotal();

        });
        $('#sale_va_per').keydown(function(event){
            // Check if the pressed key is Enter or Tab
            if(event.which === 13 || event.which === 9) {

                // Prevent the default behavior of Enter key (form submission) and Tab key (tab navigation)
                $('.btnAddExtra').trigger('click');

            }
        });
        $('.clssales').change(function(){
            var sale_pcs = $('#sale_pcs').val();
            if(!$.isNumeric($("#sale_pcs").val())){
                sale_pcs  = 0 ;
                $('#sale_pcs').val(0);
            }
            $('#sale_pcs').val(parseFloat(sale_pcs).toFixed(0));
            var sale_grosswt = $('#sale_grosswt').val();
            var sale_stonewt = $('#sale_stonewt').val();
            var sale_stonechg = $('#sale_stonechg').val();
            if(!$.isNumeric($("#sale_stonechg").val())){
                sale_stonechg  = 0 ;
                $('#sale_stonechg').val(0);
            }
            if(!$.isNumeric($("#sale_grosswt").val())){
                sale_grosswt  = 0 ;
                $('#sale_grosswt').val(0);
            }
            if(!$.isNumeric($("#sale_stonewt").val())){
                sale_stonewt  = 0 ;
                $('#sale_stonewt').val(0);
            }
            var sale_newwt = parseFloat(sale_grosswt) - parseFloat(sale_stonewt);
            $('#sale_newwt').val(parseFloat(sale_newwt).toFixed(3));

            var sale_rate = $('#sale_rate').val();
            if(!$.isNumeric($("#sale_rate").val())){
                sale_rate  = 0 ;
                $('#sale_rate').val(0);
            }

            var sale_wstg = $('#sale_wstg').val();
            if(!$.isNumeric($("#sale_wstg").val())){
                sale_wstg  = 0 ;
                $('#sale_wstg').val(0);
            }
            var sale_wstg_amt = parseFloat(sale_wstg) * parseFloat(sale_rate);


            var sale_mkg_chg = $('#sale_mkg_chg').val();
            if(!$.isNumeric($("#sale_mkg_chg").val())){
                sale_mkg_chg  = 0 ;
                $('#sale_mkg_chg').val(0);
            }

            var sale_va_per = $('#sale_va_per').val();

            var total = parseFloat(sale_newwt) * parseFloat(sale_rate);
            total = parseFloat(total) + parseFloat(sale_mkg_chg) + parseFloat(sale_stonechg);
            var sale_va_per = $('#sale_va_per').val();
            if(!$.isNumeric($("#sale_va_per").val())){
                sale_va_per  = 0 ;
                $('#sale_va_per').val(0);
            }
            var sale_va_amt = 0;
            $('#sale_va_amt').val(0);
            if(parseFloat(sale_va_per) > 0  && parseFloat(total) > 0 ){
                sale_va_amt  = parseFloat(total * sale_va_per) /100;
                $('#sale_va_amt').val(sale_va_amt);
            }
            sale_va_amt_new = parseFloat(sale_va_amt) + parseFloat(sale_mkg_chg)+ parseFloat(sale_wstg_amt);
            $('#sale_va_amt').val(parseFloat(sale_va_amt_new).toFixed(3));
            var total = parseFloat(total) + parseFloat(sale_va_amt) + parseFloat(sale_wstg_amt);
            $('#sale_amt').val(parseFloat(total).toFixed(3));
        });

        $(document).on("change",".clsoldpurrow",function() {
            
			var attr = $(this).attr('attr');


            var oldpur_stonechg = $('#oldpur_stonechg'+attr).val();
            if(!$.isNumeric($("#oldpur_stonechg"+attr).val())){
                oldpur_stonechg  = 0 ;
                $('#oldpur_stonechg'+attr).val(0);
            }

            var oldpur_makingchg = $('#oldpur_makingchg'+attr).val();
            if(!$.isNumeric($("#oldpur_makingchg"+attr).val())){
                oldpur_makingchg  = 0 ;
                $('#oldpur_makingchg'+attr).val(0);
            }


            var salereturn_pcs = $('#salereturn_pcs'+attr).val();
			
            var oldpur_grosswt = $('#oldpur_grosswt'+attr).val();
			if(!$.isNumeric($("#oldpur_grosswt"+attr).val())){
                oldpur_grosswt  = 0 ;
                $('#oldpur_grosswt'+attr).val(0);
            }
			
			var oldpur_stonewt = $('#oldpur_stonewt'+attr).val();
			if(!$.isNumeric($("#oldpur_stonewt"+attr).val())){
                oldpur_stonewt  = 0 ;
                $('#oldpur_stonewt'+attr).val(0);
            }
			
			var oldpur_melt_per = $('#oldpur_melt_per'+attr).val();
			if(!$.isNumeric($("#oldpur_melt_per"+attr).val())){
                oldpur_melt_per  = 0 ;
                $('#oldpur_melt_per'+attr).val(0);
            }
			
			var oldpur_melt_wt = $('#oldpur_melt_wt'+attr).val();
			if(!$.isNumeric($("#oldpur_melt_wt"+attr).val())){
                oldpur_melt_wt  = 0 ;
                $('#oldpur_melt_wt'+attr).val(0);
            }


			
			var oldpur_rate = $('#oldpur_rate'+attr).val();
			if(!$.isNumeric($("#oldpur_rate"+attr).val())){
                oldpur_rate  = 0 ;
                $('#oldpur_rate'+attr).val(0);
            }
			$('#oldpur_melt_wt'+attr).val(0);
            oldpur_melt_wt = 0;
			var oldpur_newwt = parseFloat(oldpur_grosswt) - parseFloat(oldpur_stonewt);
            if(parseFloat(oldpur_melt_per) > 0 ){
                oldpur_melt_wt = parseFloat(oldpur_newwt) * parseFloat(oldpur_melt_per) /100;
                $('#oldpur_melt_wt'+attr).val(oldpur_melt_wt);
            }

			oldpur_newwt = parseFloat(oldpur_newwt)  - parseFloat(oldpur_melt_wt);
			$('#oldpur_newwt'+attr).val(oldpur_newwt);
			
			var oldpur_rate = $('#oldpur_rate'+attr).val();
			if(!$.isNumeric($("#oldpur_rate"+attr).val())){
                oldpur_rate  = 0 ;
                $('#oldpur_rate'+attr).val(0);
            }

           
			var oldpur_amt = parseFloat(oldpur_newwt) * parseFloat(oldpur_rate);
            oldpur_amt = parseFloat(oldpur_amt)  + parseFloat(oldpur_makingchg) + parseFloat(oldpur_stonechg);
			$('#oldpur_amt'+attr).val(oldpur_amt);
			

            calculateOldPurchasetotal();

            
           
        });

        $('.clsoldpur').change(function(){
            var oldpur_stonechg = $('#oldpur_stonechg').val();
            if(!$.isNumeric($("#oldpur_stonechg").val())){
                oldpur_stonechg  = 0 ;
                $('#oldpur_stonechg').val(0);
            }

            var oldpur_makingchg = $('#oldpur_makingchg').val();
            if(!$.isNumeric($("#oldpur_makingchg").val())){
                oldpur_makingchg  = 0 ;
                $('#oldpur_makingchg').val(0);
            }

            var salereturn_pcs = $('#salereturn_pcs').val();
			
            var oldpur_grosswt = $('#oldpur_grosswt').val();
			if(!$.isNumeric($("#oldpur_grosswt").val())){
                oldpur_grosswt  = 0 ;
                $('#oldpur_grosswt').val(0);
            }
			
			var oldpur_stonewt = $('#oldpur_stonewt').val();
			if(!$.isNumeric($("#oldpur_stonewt").val())){
                oldpur_stonewt  = 0 ;
                $('#oldpur_stonewt').val(0);
            }
			
			var oldpur_melt_per = $('#oldpur_melt_per').val();
			if(!$.isNumeric($("#oldpur_melt_per").val())){
                oldpur_melt_per  = 0 ;
                $('#oldpur_melt_per').val(0);
            }
			
			var oldpur_melt_wt = $('#oldpur_melt_wt').val();
			if(!$.isNumeric($("#oldpur_melt_wt").val())){
                oldpur_melt_wt  = 0 ;
                $('#oldpur_melt_wt').val(0);
            }
			
			var oldpur_rate = $('#oldpur_rate').val();
			if(!$.isNumeric($("#oldpur_rate").val())){
                oldpur_rate  = 0 ;
                $('#oldpur_rate').val(0);
            }
			
			var oldpur_newwt = parseFloat(oldpur_grosswt) - parseFloat(oldpur_stonewt);
            oldpur_melt_wt= 0 ;
            if(parseFloat(oldpur_melt_per)  > 0 ){
                oldpur_melt_wt  = parseFloat(oldpur_newwt) * parseFloat(oldpur_melt_per)/100;
            }
            $('#oldpur_melt_wt').val(oldpur_melt_wt);
			oldpur_newwt = parseFloat(oldpur_newwt)  - parseFloat(oldpur_melt_wt);
			$('#oldpur_newwt').val(oldpur_newwt);
			
			var oldpur_rate = $('#oldpur_rate').val();
			if(!$.isNumeric($("#oldpur_rate").val())){
                oldpur_rate  = 0 ;
                $('#oldpur_rate').val(0);
            }

           
			var oldpur_amt = parseFloat(oldpur_newwt) * parseFloat(oldpur_rate);
            var oldpur_amt = parseFloat(oldpur_amt) + parseFloat(oldpur_stonechg) + parseFloat(oldpur_makingchg);
			$('#oldpur_amt').val(oldpur_amt);
			


            
           
        });


	$('.clssalesreturn').change(function(){
            var salereturn_pcs = $('#salereturn_pcs').val();
            var salereturn_grosswt = $('#salereturn_grosswt').val();
            var salereturn_stonewt = $('#salereturn_stonewt').val();
            var salereturn_stonechg = $('#salereturn_stonechg').val();
            if(!$.isNumeric($("#salereturn_stonechg").val())){
                salereturn_stonechg  = 0 ;
                $('#salereturn_stonechg').val(0);
            }
            if(!$.isNumeric($("#salereturn_grosswt").val())){
                salereturn_grosswt  = 0 ;
                $('#salereturn_grosswt').val(0);
            }
            if(!$.isNumeric($("#salereturn_stonewt").val())){
                salereturn_stonewt  = 0 ;
                $('#salereturn_stonewt').val(0);
            }
            var salereturn_newwt = parseFloat(salereturn_grosswt) - parseFloat(salereturn_stonewt);
            $('#salereturn_newwt').val(salereturn_newwt);

            var salereturn_rate = $('#salereturn_rate').val();
            if(!$.isNumeric($("#salereturn_rate").val())){
                salereturn_rate  = 0 ;
                $('#salereturn_rate').val(0);
            }


            
            var salereturn_va_per = $('#salereturn_va_per').val();

            var total = parseFloat(salereturn_newwt) * parseFloat(salereturn_rate);
            total = parseFloat(total) + parseFloat(salereturn_stonechg);
            var salereturn_va_per = $('#salereturn_va_per').val();
            if(!$.isNumeric($("#salereturn_va_per").val())){
                salereturn_va_per  = 0 ;
                $('#salereturn_va_per').val(0);
            }
            var salereturn_va_amt = 0;
            $('#salereturn_va_amt').val(0);
            if(parseFloat(salereturn_va_per) > 0  && parseFloat(total) > 0 ){
                salereturn_va_amt  = parseFloat(total * salereturn_va_per) /100;
                $('#salereturn_va_amt').val(salereturn_va_amt);
            }
            var total = parseFloat(total) + parseFloat(salereturn_va_amt);
            $('#salereturn_amt').val(total);
        });


        $("#customername").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers/0/1'); ?>",
            minLength: 2,
            select: function(event, ui) {

                $('#cusname').val(ui.item.name);
                $('#cusdetails').val(ui.item.address_line1);
                $('#con_contact').val(ui.item.phone);


                $('#customer_id').val(ui.item.id);
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function(results) {
                        $("#balance").html("Closing Balance: " + results);
                    }
                });
                $('#sale_items').focus();
            }
        });


        $("#oldpur_items").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('transaction/goldsales/search_item'); ?>",
                    type: "POST",
                    data: {
                        term: request.term,
                        date:$('#date').val(),
                        type:'<?php echo $search_type;?>'
                    },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#oldpur_item_id').val(ui.item.id);
                $('#oldpur_rate').val(ui.item.old_gold_rate);
                $('#oldpur_pcs').focus();
            }
        });


        $("#sale_items").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('transaction/goldsales/search_item'); ?>",
                    type: "POST",
                    data: {
                        term: request.term,
                        date:$('#date').val()
                    },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#sale_item_id').val(ui.item.id);
                $('#sale_rate').val(ui.item.gold_rate);
                $('#sale_purity').focus();
            }
        });
       
        $('#customername').change(function(){
            var customer_id = $('#customer_id').val();
            if(customer_id === '0' || customer_id === '' || customer_id === 0){
                $('#customername').val('');
            }
        });


        $('#cash_type').change(function(){
            var cash_type =  $('#cash_type').val();
            if(cash_type === 'Credit'){
                $('#customername').attr('data-validation-length', 'min2');
                $("#customername").attr('data-validation', 'required,length');
                var customer_id = $('#customer_id').val();
                if(customer_id === '0' || customer_id === '' || customer_id === 0){
                    $('#customername').val('');

                }
            }else{
                $('#customername').removeAttr('data-validation-length', 'min2');
                $("#customername").removeAttr('data-validation', 'required,length');
            }
        });

        $("#salereturn_items").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "<?php echo site_url('transaction/goldsales/search_item'); ?>",
                    type: "POST",
                    data: {
                        term: request.term,
                        date:$('#date').val(),
                    },
                    dataType: "json",
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                $('#salereturn_item_id').val(ui.item.id);
                $('#salereturn_rate').val(ui.item.gold_rate);
                $('#salereturn_pcs').focus();
            }
        });

        $('.sidebar-toggle').trigger('click');
        $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function(result) {
                $('#salesman').html(result);
              
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function(result) {
                $('#area').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/purchase'); ?>",
			async:false,
            success: function(result) {
                var user_default_billtype = $('#user_default_billtype').val();
                $('#btype').html(result);
                if (user_default_billtype !== "") {
                    //$('#btype').val(user_default_billtype);
                }
                var id = $('#btype').val();
                setbillno(id);
            }
        });
        load();
    });
    function load(){
        var id = $('#id').val();
        if(id > 0){
            $.ajax({
                url: "<?php echo site_url('transaction/Goldpurchase/getsing'); ?>/" + id,
                async:false,
                success: function(results) {
                    var result = JSON.parse(results);
                    // $.each(result.sales, function(i, itemsingle) {
                    //     $('#cusname').val(itemsingle.cusname);
                    //     $('#cusdetails').val(itemsingle.cusdetails);
                    //     $('#con_contact').val(itemsingle.con_contact);
                    //     $('#date').val(itemsingle.in_date);
                    //     $('#cash_type').val(itemsingle.cash_type);
                    //     $('#btype').val(itemsingle.bill_type);
                    //     $('#invoice_sales').html('Inv No : '+itemsingle.invoice);
                    //     $('#customername').val(itemsingle.supname);
                    //     $('#customer_id').val(itemsingle.customer_id);
                    //     $('#area').val(itemsingle.area);
                    //    // $('#discount').val(itemsingle.discounts);
                    //     //$('#tax_id').val(itemsingle.saletax);
                    //    // $('#salesman').val(itemsingle.salesman);
                    //     addrow(itemsingle.item_id,itemsingle.name,itemsingle.quantity,itemsingle.gross_wt,itemsingle.stone_wt,itemsingle.stone_charge,itemsingle.net_wt,itemsingle.mrp,itemsingle.wstge_wt,itemsingle.mkg_chg,itemsingle.va_per,0,itemsingle.purity,itemsingle.hudid);
                    //    // $('#old_pur_id').val(itemsingle.old_pur_id);

                    // });

                    $.each(result.purchase, function(i, itemsingle) {
                        $('#cusname').val(itemsingle.supname);
                        $('#cusdetails').val(itemsingle.supaddress);
                        $('#con_contact').val(itemsingle.supphone);
                        $('#date').val(itemsingle.in_date);
                        $('#cash_type').val(itemsingle.cash_type);
                        $('#btype').val(itemsingle.bill_type);
                        $('#invoice_sales').html('Inv No : '+itemsingle.invoice);
                        $('#customername').val(itemsingle.supname);
                        $('#customer_id').val(itemsingle.supplier_id);
                        addrowoldpurchase(itemsingle.item_id,itemsingle.name,itemsingle.quantity,itemsingle.gross_wt,itemsingle.stone_wt,itemsingle.melt_loss_per,itemsingle.melt_loss_wt,itemsingle.net_wt,itemsingle.rate,itemsingle.total,itemsingle.purity,itemsingle.hudid,itemsingle.stone_chg,itemsingle.making_chg)
                    });


                }
            });
        }

        $('#cash_type').trigger('change');
    }
</script>
