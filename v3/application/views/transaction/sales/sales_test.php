<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0; //tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$is_taxincuded = $settings[0]['is_taxincluded'];
// if it i one then tax inclusive 
$is_discount = 1; //this is for discount then no sales rate 
$is_SettngsEnabled = 1;
$is_return = 1;
$is_godown = $settings[0]['is_godown'];
$barcode_settings = $settings[0]['barcode_settings'];
$is_billtype = $settings[0]['is_billtype'];
$is_multipleunit = $settings[0]['is_unit'];
$is_analytics = $settings[0]['is_analytics'];
$is_bkground_print = $settings[0]['is_bkground_print'];
$cost_centre = $settings[0]['is_costcenter'];
$is_multipletax = $settings[0]['is_multipletax'];
$terms_condition = $settings[0]['terms_condition'];
$is_kitgroup = $settings[0]['is_kitgroup'];
$is_kitcustomer = $settings[0]['is_kitcustomer'];
$taxtype = $settings[0]['com_tax_type'];
if ($taxtype == 'VAT') {
    $taxtype = 'VAT';
}
$is_itemcode = $settings[0]['is_itemcode'];
$is_extra = $settings[0]['is_discription'];
if ($is_godown == 0) {
    $ghidden = 'hidden';
} else {
    $ghidden = '';
}
if ($is_billtype == 0) {
    $bill = 'hidden';
} else {
    $bill = '';
}
if ($is_multipleunit == 0) {
    $unit = 'hidden';
} else {
    $unit = '';
}
?> 
<style>
    .box-title {
        text-transform: capitalize;
    }
    .sma{
        width: 60px !important;
    }
    .boo{
        position: absolute;
        bottom: 30px;
        left: 95px;
    }
    .table-condensed>thead>tr>td,.table-condensed>tbody>tr>td, .table-condensed>thead>tr>th {
        padding: 1px !important;
    } 

    .table-condensed .form-control { 
        padding: 2px !important;
    } 
    .span {
        font-size: 15px;
        font-weight: 600;  
        padding-right: 15px;
        padding-left: 15px;
    }
    .new-invoice {
        font-size: 15px;
        font-weight: 600;  
        padding-right: 15px;
        padding-left: 15px;
    }
    .tableBodyScroll   { 
        max-height: 300px;
        overflow-y: scroll;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice{
        color: #000;
    }
    .select2-selection.select2-selection--multiple {
        min-height: 25px;
        max-height: 25px;
    }
</style>
<link href="<?php echo base_url(); ?>asset/plugins/select2/select2.min.css"  rel="stylesheet" type="text/css" />

<form method="post" clr="salesitems<?php echo $type . $id; ?>"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/sales/sales/' . $type); ?>" action="<?php echo site_url('transaction/sales/save/' . $type); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
    <input type="hidden" value="<?php echo $copy; ?>" id="copy" name="copy"/>
    <input type="hidden" value="0" name="p_id"/> 
    <input type="hidden" id="new_invoice" name="new_invoice"/> 
    <input type="hidden" id="iv_no" name="iv_no"/> 
    <input type="hidden"  name="newtype"  id="newtype"/> 
    <input type="hidden" id="autoinvoice" name="autoinvoice"/> 
    <input type="hidden" value="<?php echo $is_multipletax; ?>" name="is_multipletax" id='is_multipletax'/>
    <input type="hidden" value="<?php echo $is_return; ?>" name="is_return" id='is_return'/>
    <input type="hidden" value="<?php echo $barcode_settings; ?>" name="barcode_settings" id='barcode_settings'/>
    <input type="hidden" value="0" name="invoice" id='Invoice'/>
    <input type="hidden" id="totstock" name="totstock" value="0"/> 
    <input type="hidden" value="" name="item_mrp" id='item_mrp'/>
    <input type="hidden" value="<?php echo $is_extra; ?>" name="is_extra" id='is_extra'/>
    <input type="hidden" value="" name="tax_led_id" id='tax_led_id'/>
    <input type="hidden" value="<?php echo $cost_centre; ?>" name="cost_centre" id='cost_centre'/>
    <input type="hidden" value="<?php echo $terms_condition; ?>" name="terms_condition" id='terms_condition'/>
    <input type="hidden" value="<?php echo $is_bkground_print; ?>" name="is_bkground_print" id='is_bkground_print'/>
    <input type="hidden" value="<?php echo $is_analytics; ?>" name="is_analytics" id='is_analytics'/>
    <input type="hidden"  id="estid" name="estid" value='0' /> 
    <input type="hidden" value="<?php echo $is_itemcode; ?>" name="is_itemcode" id='is_itemcode'/>
    <input type="hidden"  name="pur_rate" id='pur_rate'/>
    <input type="hidden" value="<?php echo $is_discount; ?>" id="is_discount" name="is_discount"/> 
    <input type="hidden" value="<?php echo $type; ?>" name="ttype" id="ttype"/> 
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype"/> 
    <input type="hidden"  id="unitvalue" name="unitvalue"/> 
    <input type="hidden"  id="paytype" name="paytype"/> 
    <input type="hidden" value="<?php echo $is_kitgroup; ?>" id="is_kitgroup" name="is_kitgroup"/> 
    <input type="hidden" value="<?php echo $is_kitcustomer; ?>" id="is_kitcustomer" name="is_kitcustomer"/> 
    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit"/> 
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded"/> 
    <input type="hidden" value="<?php echo $dprate; ?>" id="dprate" name="dprate"/>  
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <input type="hidden" id="txtEstimate_id" class="form-control" value="0" name="txtEstimate_id"/>
    <input data-validation="required" type="hidden" name="base_unit" id="base_unit"/>
    <style>


        /* The container <div> - needed to position the dropdown content */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Content (Hidden by Default) */
        .dropdown-content {  
            background-color: #f1f1f1;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        /* Links inside the dropdown */
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        /* Change color of dropdown links on hover */
        .dropdown-content a:hover {background-color: #ddd}
    </style>
    <div class="modal fade" id="modal-alter">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" id="myDropdownhide" class="hidden btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <div id="myDropdown" class="dropdown-content">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="content"> 
        <div class="row"> 
            <div class="col-xs-12">

            </div>
        </div>
        <div class="row"> 
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?= label(ucfirst($type), $this, $user) ?></a></li>
                        <li><a href="#otherTab" data-toggle="tab"><?= label('Other Details', $this, $user) ?></a></li> 
                        <li><a href="#service" data-toggle="tab"><?= label('Additional Ledger', $this, $user) ?></a></li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:130px;padding: 4px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="txtEstimate" style="height:30px !important"  class="form-control" name="txtEstimate"/>
                            </div>
                        </li>
                        <?php if ($is_kitgroup == '1') { ?>
                            <li class="pull-right"> 
                                <div class="input-group" style="width:130px;padding: 4px">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                    <input type="text" id="txtkit" onkeydown="kitsearch(event)" style="height:30px !important" placeholder="<?= label('Kit Group', $this, $user) ?>" class="form-control" name="txtkit"/>
                                </div>
                            </li>
                        <?php } ?>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:130px;padding: 4px">
                                <select name="saletype" data-validation="required" style="height:30px !important" id="saletype"  class="form-control">
                                    <option value="b2b">B2C</option> 
                                    <option value="b2c">B2B</option> 
                                </select> 
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:130px;padding: 4px">
                                <select name="is_tax" data-validation="required" style="height:30px !important" id="is_tax"  class="form-control">
                                    <option value="1"><?= label($taxtype, $this, $user) ?> <?= label('Included', $this, $user) ?></option> 
                                    <option value="0"><?= label($taxtype, $this, $user) ?>  <?= label('Excluded', $this, $user) ?></option> 
                                </select> 
                            </div>
                        </li>
                        <?php if ($cost_centre == '1') { ?>
                            <li class="pull-right"> 
                                <div class="input-group" style="width:130px;padding: 4px">
                                    <select  id="Costcenter"  name="Costcenter" style="height:30px !important"  class="form-control" >
                                        <option value="">Select</option> 
                                    </select>
                                </div>
                            </li>
                        <?php } ?>

                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale"> 
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col "><?= label('Invoice date', $this, $user) ?></td>
                                        <td class="col  <?php echo $bill; ?>"><?= label('Bill Types', $this, $user) ?></td> 
                                        <td class="col "><?= label('Cash/Credit', $this, $user) ?></td> 
                                        <?php if ($comontax == 1) { ?>
                                            <td class="col "><?= label($taxtype, $this, $user) ?></td>
                                        <?php } ?> 
                                        <td>   <button type="button" opt="customer" url="<?php echo base_url(); ?>customers/create/"  class="btn btn-primary myModalPop">
                                                <?= label('New', $this, $user) ?>
                                            </button><?= label('Customer', $this, $user) ?> 
                                        </td>
                                        <td><?= label('Billing Name', $this, $user) ?></td>
                                        <td><?= label('Phone Number', $this, $user) ?></td>
                                        <td><?= label('Address', $this, $user) ?></td>
                                    </tr>
                                    <tr> <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td><!--                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="Date"></td>-->
                                        <td <?php echo $bill; ?>>
                                            <select tabindex="-1" id="btype" name="btype" class="form-control " >                                            
                                            </select>
                                        </td>
                                        <td><select name="type" data-validation="required" id="type"  class="form-control">
                                                <option value="Cash"><?= label('Cash', $this, $user) ?></option> 
                                                <option value="Bank"><?= label('Bank', $this, $user) ?></option> 
                                                <option value="Credit"><?= label('Credit', $this, $user) ?></option> 
                                            </select> 

                                        </td>
                                        <?php if ($comontax == 1) { ?>
                                            <td><select  data-validation="required" id="tax_common"  name="tax_common" class="form-control" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                        <?php } ?>

                                        <td><input data-validation type="hidden" name="customer_id" id="supid"/>
                                            <input name="supname"   id="supname" type="text" NoTab="true"    data-validation   class="form-control" placeholder="<?= label('Customer', $this, $user) ?>"></td>
                                        <td><input name="bname" type="text" id="bname"  class="form-control" placeholder="<?= label('Billing Name', $this, $user) ?>"></td>
                                        <td><input name="phone" pattern="[0-9]{0,13}"  type="text" id="phone"  class="form-control" placeholder="<?= label('Phone Number', $this, $user) ?>"></td>
                                        <td><input name="email" type="text" id="address_line1"    class="form-control" placeholder="<?= label('Address', $this, $user) ?>"></td>
                                    </tr> 
                                </table> 
                                <table id="tablex" class="table table-striped table-condensed" hidden="hidden">
                                    <tr>
                                        <td><button type="button" url="<?php echo base_url(); ?>masters/customers/add"  class="btn btn-primary myModalPop">
                                                New
                                            </button>
                                            Customer
                                        </td>
                                        <td>Phone</td>
                                        <td>Email</td>
                                        <td>GST/CST Number</td>
                                    </tr>
                                    <tr> 
                                        <td><input name="phone-ol" type="text" id="phone"  class="form-control" placeholder="Phone"></td>
                                        <td><input name="email-ol" type="text" id="email"    class="form-control" placeholder="Email"></td>
                                        <td><input name="cst" type="text" id="cst"     class="form-control" placeholder="CST"></td>
                                        <td><input name="cst" type="text" id="cst"     class="form-control" placeholder="CST"></td>
                                    </tr>
                                    <tr>
                                        <td>Tin Number </td>
                                        <td>Address</td>
                                        <td>Address 2</td>
                                        <td>Details</td>
                                    </tr>
                                    <tr>
                                        <td><input name="tin" type="text" id="tin"  class="form-control" placeholder="Tin"></td>
                                        <td><input name="address_line1" type="text"  id="address_line1"  class="form-control" placeholder="address line1"></td>
                                        <td><input name="address_line2" type="text"  id="address_line2"  class="form-control" placeholder="address line2"></td>
                                        <td><input name="details" type="text" id="details"  class="form-control" placeholder="details"></td>
                                    </tr>
                                </table> 

                                <p><span class="new-invoice" ><label spellcheck="false" id="prefix"></label><label spellcheck="false" id="sep_first"></label><label class="two-digits price" ondblclick="changeinvoice()" NoTab="true" spellcheck="false" id="b_no"></label><label spellcheck="false" id="sep_second"></label><label spellcheck="false" id="suffix"></label></span><span Class="span" id="i_stock"></span><span Class="span" id="b_mgn">&nbsp;</span><span Class="span" id="i_mgn">&nbsp;</span></span> <span class="span" id="balance"></span><span class="span pull-right"><input type="text" value="0" class="col-lg-6" name="commi_amt_hi" id="commi_amt"/> </span></p>
                                <div class="tableBodyScroll">
                                    <table id="salesTable" class="table table-condensed table-striped"   >
                                        <thead>
                                            <tr>
                                                <td><?= label('SNo', $this, $user) ?></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td><?= label('Item Code', $this, $user) ?></td>
                                                <?php } ?>
                                                <td><button type="button" url="<?php echo base_url(); ?>item/create" opt="item" class="btn btn-primary myModalPop">
                                                        <?= label('New', $this, $user) ?> 
                                                    </button><?= label('Item Name', $this, $user) ?></td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td><?= label('Analytics', $this, $user) ?></td>
                                                <?php } ?> 
                                                <td <?php echo $ghidden; ?>>
                                                    <?= label('Godown', $this, $user) ?>
                                                </td>
                                                <td><?= label('Qty', $this, $user) ?></td>
                                                <?php if (!$is_return == 0) { ?>
                                                    <td><?= label('Stype', $this, $user) ?></td>
                                                <?php } ?>
                                                <td <?php echo $unit; ?>><?= label('Unit', $this, $user) ?></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td><?= label($taxtype, $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('Rate', $this, $user) ?></td>
                                                <?php if ($is_discount != 1) { ?>  <?php } else { ?><td><?= label('Dis Amt', $this, $user) ?> </td><?php } ?>
                                                <td>  <?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?><?= label('Dis', $this, $user) ?>% <?php } ?></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td><?= label($taxtype, $this, $user) ?> <?= label('Amt', $this, $user) ?></td>
                                                <?php } ?>
                                                <td><?= label('Total', $this, $user) ?></td> 
                                                <td> </td> 
                                            </tr>
                                            <tr id="add">
                                                <td class="sma" style="text-align: center;"><input title="1" style="height:25px"   id="totnolist" class="form-control  text-right"  readonly="readonly"/></td>
                                                <?php if ($is_itemcode == 1) { ?>
                                                    <td class="col-lg-1"> <input     id="itemcode" <?php if ($barcode_settings === "1") { ?> class="form-control" onchange="itemsearch()"   <?php } else { ?>class="form-control ItemMatchBarcode" <?php } ?>stype="barcode" data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>"    type="text"     placeholder="<?= label('Item Code', $this, $user) ?>"/></td>                                                                <?php } else { ?>
                                                <?php } ?>

                                                <td class="col-lg-3"> <input  NoTab="true"   id="itemname"   stype="name"  data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>" class="form-control"   type="text"     placeholder="<?= label('Item Name', $this, $user) ?>"/></td>
                                                <?php if ($is_analytics == 1) { ?>
                                                    <td><select tabindex="-1" id="analyticscenter"  class="form-control col-lg-1">
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td  <?php echo $ghidden; ?>><select tabindex="-1" id="godown"   class="form-control">
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <td> <input style='height:25px' id="item_qty"  type="text"  class="form-control text-right  two-digits price " placeholder="<?= label('Quantity', $this, $user) ?>"/></td>
                                                <?php if (!$is_return == 0) { ?>
                                                    <td><select tabindex="-1" id="invoice_type"   class="form-control">
                                                            <option value="Sales">S</option>
                                                            <option value="Return">R</option></select></td>
                                                <?php } ?>
                                                <td class="sma" <?php echo $unit; ?>><select tabindex="-1"   id="unit_item" class="form-control " >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="sma"><select tabindex="-1" id="tax_item"  class="form-control " >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td><input type="hidden" NoTab="true" tabindex="-1" name="commission" id="commission"/>  <input id="mrp_item"   type="text"    class="form-control  text-right two-digits" placeholder="<?= label('Rate', $this, $user) ?>"/></td>
                                                <td> <input id="dis_amt"     type="text"    class="form-control text-right price  two-digits" placeholder="<?php if ($is_discount != 1) { ?>   <?php } else { ?><?= label('Dis Amt', $this, $user) ?> <?php } ?>"/></td>
                                                <td> <input id="prate_item"      type="text"    class="form-control text-right price  two-digits" placeholder="<?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?><?= label('Dis', $this, $user) ?>% <?php } ?>"/></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td> 
                                                        <input style="height:25px" class='form-control  two-digits' id="rowTax" readonly="readonly"/>
                                                    </td>
                                                <?php } ?>
                                                <td><input style="height:25px" class='form-control  two-digits' id="rowTotal" readonly="readonly"/></td>
                                                <td>

                                                    <!--                                        hidden-->
                                                    <input type="hidden" name="item_id" id="item_id"/>

                                                    <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtra"  class="btn btn-success" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span> 
                                                    </button>
                                                </td>
                                            </tr> 
                                        </thead>
                                        <tbody id="rowm">

                                        </tbody>
                                    </table> 
                                </div>
                                <table class="table table-striped table-condensed" > 
                                    <tr> 
                                        <td class="col-lg-1"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-1"></td>
                                    <input type="hidden" name="billmargin" id="billmargin" placeholder="Bill Margin"  readonly="readonly"   type="text" class="text-right  form-control" placeholder="Total Tax">
                                    <td class="col-lg-1"><input type="text"  id="rowdis" name="rowdis" readonly="readonly" class="form-control  text-right" placeholder="Discount"></td>
                                    <td class="col-lg-1"><input name="totsaletax" id="totsaletax" placeholder="Total Tax"  readonly="readonly"   type="text" class="text-right  form-control" placeholder="Total Tax"></td>
                                    <td class="col-lg-2"><input style="height:25px" type="text"  id="total" name="subtot" readonly="readonly" class="form-control  text-right" placeholder="Total"></td>

                                    </tr>

                                    <tr>
                                        <td class="col-lg-1"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"><?= label('Discount', $this, $user) ?></td>
                                        <td class="col-lg-1"><?= label('Round Off', $this, $user) ?></td>
                                        <td class="col-lg-1"><?= label('Total B', $this, $user) ?> <?= label($taxtype, $this, $user) ?></td>
                                        <td class="col-lg-1"><?= label($taxtype, $this, $user) ?></td>                               
                                        <td class="col-lg-2"><?= label('Grand Total', $this, $user) ?></td>

                                    </tr>
                                    <tr>
                                        <td class="col-lg-1"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"></td>
                                        <td class="col-lg-2"><input name="discount" id="discount" placeholder="<?= label('Discount', $this, $user) ?>"   type="text" class="text-right  form-control" ></td>
<!--                                        <td><input name="Vehicle" id="Vehicle" placeholder="Vehicle No"   type="text" class=" form-control" ></td>-->
                                        <td class="col-lg-1"><input name="rount" id="rount" placeholder="<?= label('Round Off', $this, $user) ?>" readonly="readonly"   type="text" class="text-right  form-control" ></td>
                                        <td class="col-lg-1"><input name="totrate" id="totrate" placeholder="<?= label('Total Before Tax', $this, $user) ?>" readonly="readonly"   type="text" class="tatalcal text-right  form-control" ></td>
                                        <td class="col-lg-1"><input name="taxtotal" id="taxtotal" placeholder="<?= label($taxtype, $this, $user) ?>" readonly="readonly"   type="text" class="text-right  form-control" ></td>
                                        <td class="col-lg-2"><input name="gtotal" style='font-size: 15pt;font-weight: bold;'  id="gtotal" placeholder="<?= label('Grand Total', $this, $user) ?>"  readonly="readonly"  type="text" class="text-right  form-control" ></td>

                                    </tr>
                                </table> 
                            </div> 
                        </div> 
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2"><?= label('State', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('State Code', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('E-Way Bill Number', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('E-Way Bill Details', $this, $user) ?></td>
                                    </tr>
                                    <tr> 
                                        <td><select  id="states"  name="states" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="stcode" type="text" id="stcode"  class="form-control  "   placeholder="<?= label('State Code', $this, $user) ?>"></td>
                                        <td>  <input name="gst" type="text" id="gst"  class="form-control  col-lg-2"   placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                        <td>  <input name="ewbno" type="text" id="ewbno"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Number', $this, $user) ?>"></td>
                                        <td>  <input name="ewbdetails" type="text" id="ewbdetails"  class="form-control  col-lg-2"   placeholder="<?= label('E-Way Bill Details', $this, $user) ?>"></td>

                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Delivery Date', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Credit Days', $this, $user) ?></td>
                                        <td class="col col-lg-3"><?= label('SalesMan', $this, $user) ?></td> 
                                        <td class="col col-lg-3"><?= label('Agent/Reference', $this, $user) ?></td> 
                                        <td></td> 
                                    </tr>
                                    <tr>
                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="<?= label('Delivery Date', $this, $user) ?>"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date " placeholder="<?= label('Credit Days', $this, $user) ?>"></td>
                                        <td><select  id="salesman"  name="SalesMan" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="reference"  name="reference" class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><?= label('Area', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Route', $this, $user) ?></td>
                                        <td class="col col-lg-2"><?= label('Vehicle', $this, $user) ?></td>
                                        <td class="col "><?= label('Coolie', $this, $user) ?></td>
                                        <td class="col "><?= label('Freight', $this, $user) ?></td>
                                    </tr>
                                    <tr>
                                        <td><select  id="area"  name="area" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="route"  name="route" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="vehicle"  name="vehicle" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="other" type="text"   class="form-control  "   placeholder="<?= label('Coolie', $this, $user) ?>"></td>
                                        <td>  <input name="freight" type="text" id="freight"  class="form-control  "  placeholder="<?= label('Freight', $this, $user) ?>"></td>
                                    </tr>
                                </table>
                                </br>

                                <div class="col-lg-12">
                                    <div class="col-lg-6">
                                        <table class="table table-striped table-condensed" >
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Terms And Conditions', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td><textarea readonly="readonly" colspan="12" style="width: 100%; height:75px !important;"   name="tms_confixed" ><?php echo $terms_condition; ?> </textarea></td>
                                            </tr> 
                                            <tr>
                                                <td><textarea colspan="12" style="width: 100%; height:75px !important;" id="tms_con"  name="tms_con" > </textarea></td>
                                            </tr>  

                                        </table>
                                    </div>
                                    <div class="col-lg-6">
                                        <table class="table table-striped table-condensed" >
                                            <tr>
                                                <th style="text-align:center" colspan="12"><?= label('Delivery Details', $this, $user) ?></th>
                                            </tr>
                                            <tr>
                                                <td> <?= label('Name', $this, $user) ?>    :</td>
                                                <td><input name="con_name" type="text" id="con_name"  class="form-control 2"   placeholder="<?= label('Name', $this, $user) ?>"></td>
                                            </tr>
                                            <tr>
                                                <td><?= label('Address', $this, $user) ?>     :</td>
                                                <td><input name="con_addr" type="text" id="con_addr"  class="form-control 2"   placeholder="<?= label('Address', $this, $user) ?>"></td>
                                            </tr>  
                                            <td> <?= label('Contact', $this, $user) ?>    :</td>
                                            <td><input name="con_contact" type="text" id="con_contact"  class="form-control 2"   placeholder="<?= label('Contact', $this, $user) ?>"></td>
                                            </tr>  
                                            <tr>
                                                <td> <?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>    :</td>
                                                <td><input name="con_gst" type="text" id="con_gst"  class="form-control 2"   placeholder="<?= label($taxtype, $this, $user) ?> <?= label('No', $this, $user) ?>"></td>
                                            </tr>  
                                            <tr> <td> <?= label('State', $this, $user) ?>     :</td>
                                                <td><select  id="con_state"  name="con_state" class="form-control">
                                                        <option value="">Select</option> 
                                                    </select></td>
                                            </tr>  
                                        </table>
                                    </div>

                                </div> 
                                </br>


                            </div>

                        </div> 
                        <?php if ($is_SettngsEnabled == 1) { ?> 
                            <div class="tab-pane" id="SettingsTab">
                                <div class="box-body">
                                    <table class="table table-striped table-condensed" >
                                        <tr> 
                                            <td class="col-lg-4">Key</td>
                                            <td class="col-lg-4">Value</td>
                                            <td></td> 
                                        </tr>

                                        <tbody id="rown">
                                            <tr id="add">
                                                <td class="col-lg-4"> <input data-validation="required" type="hidden" name="keyid" id="keyid"/>
                                                    <input name="keyname" id="keyname[]" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key" disabled></td>
                                                <td class="col-lg-4"> <input  NoTab="true"   id="key_value"  name="key_value"  type="text"    class="form-control" placeholder="Key Value" disabled/></td>


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div> 
                        <?php } ?>  
                        <div class="tab-pane" id="service">
                            <div class="box-body">
                                <div class="col-lg-12">
                                    <div class="col-lg-7">
                                        <div class="box-body">
                                            <table class="table table-striped table-condensed col-lg-6"   >
                                                <thead>
                                                    <tr>
                                                        <td colspan="6"><?= label('Additional Ledger', $this, $user) ?> </td>
                                                        <td colspan="1"><?= label($taxtype, $this, $user) ?>%</td>
                                                        <td colspan="2"><?= label('Service Amount', $this, $user) ?></td>
                                                        <td colspan="2"><?= label($taxtype, $this, $user) ?> <?= label('Amount', $this, $user) ?> </td>
                                                        <td colspan="1"><?= label('Action', $this, $user) ?> <td> 
                                                    </tr>

                                                </thead>
                                                <tbody id="rows">
                                                    <tr id="addservice">

                                                        <td  colspan="6"> <input type="hidden" NoTab="true" tabindex="-1" name="ser_ledgerid" id="ser_ledgerid"/><input  NoTab="true"   id="ser_ledger"  class="form-control"   type="text"     placeholder="<?= label('Ledger', $this, $user) ?>"/></td>
                                                        <td colspan="1"><input type="hidden" NoTab="true" tabindex="-1" name="ser_taxid" id="ser_taxid"/><select tabindex="-1" id="ser_tax"  class="form-control" >
                                                                <option value="">Select</option> 
                                                            </select>
                                                        </td>
                                                        <td colspan="2"> <input style='height:25px' id="ser_amt"  type="text"  class="form-control text-right  two-digits price " placeholder="<?= label('Service Amount', $this, $user) ?>"/></td>
                                                        <td colspan="2"> <input id="ser_taxamt"   type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="<?= label($taxtype, $this, $user) ?> <?= label('Amount', $this, $user) ?> "/></td>
                                                        <!--                                        hidden-->

                                                        <td colspan="1">  <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                                <span class="glyphicon glyphicon-plus"></span> 
                                                            </button>
                                                        </td>
                                                    </tr> 
                                                </tbody>      
                                            </table>
                                            <table class="table table-striped table-condensed" >

                                                <tr>
                                                    <td></td>
                                                    <td> </td> 
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><?= label('Total', $this, $user) ?> <?= label($taxtype, $this, $user) ?></td>                               
                                                    <td><?= label('Total', $this, $user) ?></td>
                                                </tr>
                                                <tr>
                                                    <td class='col-lg-4'></td>
                                                    <td class='col-lg-2'></td>
                                                    <td class='col-lg-2'></td>
                                                    <td></td> 
                                                    <td></td>
                                                    <td></td>
                                                    <td><input name="sertaxtotal" id="sertaxtotal" placeholder="Total Tax" value="0" readonly="readonly"   type="text" class="text-right  form-control" ></td>
                                                    <td><input name="sergtotal" id="sergtotal" placeholder="Grand Total" value="0" readonly="readonly"  type="text" class="text-right  form-control" ></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-lg-5">
                                        <div class="box-body">

                                            <table class="table table-striped table-condensed col-lg-6" >
                                                <thead>
                                                <th style="text-align:left" colspan="1"><?= label('Select Coupon', $this, $user) ?></th>
                                                <td colspan="11"> <input name="Coupon" id="Coupon" type="text" NoTab="true"     data-validation-length="min2"   class="form-control" placeholder="Coupon"/></td>
                                                <tr>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td><?= label('Coupon', $this, $user) ?></td>
                                                        <td><?= label('Amount', $this, $user) ?></td>
                                                        <td><?= label('Action', $this, $user) ?></td>
                                                    </tr>
                                                <tbody id="rowcoupon">
                                                    <tr id="add">

                                                    </tr>
                                                </tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.tab-content -->
                    <?php if (ucfirst($type) != 'View') { ?>
                        <div class="box-footer">  
                            <div class="col-sm-12">
                                <div class="col-sm-2">
                                    <button id="form-button-save"  type='button' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                                </div>
                                <div class=" col-sm-3">
                                    <div class="form-group col-sm-5">
                                        <?= label('Bill Type', $this, $user) ?>
                                    </div>
                                    <div class="col-sm-7">
                                        <select   id="printtype"  name="printtype" class="form-control" >
                                            <option value="">Select</option>  
                                        </select> 
                                    </div> 
                                </div>
                                <div class="col-sm-7">
                                    <?php if ($is_bkground_print == 1) { ?>
                                        <div class="col-sm-3">
                                            <?= label('Printers', $this, $user) ?>
                                        </div>
                                        <div class="col-sm-9">
                                            <select style="height: 25px" id="myprinter" name="myprinter[]" class="form-control select2" multiple="multiple" data-placeholder="Select Printers"
                                                    style="width: 100%;">   
                                            </select> 
                                        </div> 
                                    <?php } ?>

                                </div>
                            </div>  
                        </div>

                    <?php } ?>

                </div>
            </div> 
        </div>   
    </section>
    <input name="advance"id="advance" placeholder="Advance"   type="hidden"class="tatalcal text-right  form-control" > 
</form>  
<div class="modal fade "  tabindex="-1"  id="modelextra"  role="dialog"  aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-body"  > 
                <textarea class="form-control " cols="20" id="txtExtra"></textarea>
            </div> 
            <div class="modal-footer">
                <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtram"  class="btn btn-success" href="#">
                    <span class="glyphicon glyphicon-plus"></span> 
                </button>
                <button type="button" id="btncls"   class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div> 
    </div>
</div> 
<script src="<?php echo base_url(); ?>asset/plugins/select2/select2.full.min.js"></script>
<script>

</script>
<script type="text/javascript">
    $(function () {
        $('.select2').select2();
    });
    //messages 
    function calert(msg) {
        toastr["error"](msg);
    }
    function changeinvoice() {
        document.getElementById("b_no").contentEditable = true;

    }
    var inc_inary = 0;
    //class
    function item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincuded, margin, item_discription, barcode, analytics, analyticsname, invoice_type) {

        inc_inary = parseInt(inc_inary) + 1;
        this.inc_id = inc_inary;
        this.invoice_type = invoice_type;
        this.item_id = item_id;
        this.item_qty = item_qty;
        this.margin = margin;
        this.analyticsname = analyticsname;
        this.analytics = analytics;
        this.barcode = barcode;
        this.unit_item = unit_item;
        this.godown = godown;
        this.dis_amt = dis_amt;
        this.tax_item = tax_item;
        this.tax_amount = tax_amount;
        this.item_discription = item_discription;
        this.mrp_item = mrp_item;
        this.prate_item = prate_item;
        this.itemname = itemname;
        this.comontax = comontax;
        this.is_taxincuded = is_taxincuded;
        this.rowTotal = rowTotal;
        this.commission = commission;
        this.unit_name = unit_name;
        this.godown_name = godown_name;
        this.tax_name = tax_name;
        this.pur_rate = pur_rate;
    }
    //class array
    var items = new Array();
    function clear() {
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
        clearValue($("#itemcode"));
        clearValue($("#unit_item"));
        clearValue($("#godown"));
        clearValue($("#dis_amt"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        $('#txtExtra').val('');
        $("#prate").html('');
        $("#current_stock").html('');
        clearValue($("#rowTax"));
        clearValue($("#rowTotal"));
        var is_godown = $("#is_godown").val();
        if (is_godown === '1') {
            $('#godown').html('');
        }
    }
    function clearservice() {
        clearValue($("#ser_ledger"));
        clearValue($("#ser_ledgerid"));
        clearValue($("#ser_amt"));
        clearValue($("#ser_taxamt"));
    }
    function additemcode(event, id) {
        var x = event.which || event.keyCode;
        if (x === 13) {
            itemsearchbyid(id);
            $('#myDropdownhide').click();
        }
    }
    function additmcode(id) {
        itemsearchbyid(id);
        $('#myDropdownhide').click();
    }
    function itemsearchbyid(id) {
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemsearchbyid/' + id,
                function (result) {
                    $.each(result, function (i, field) {
                        $("#itemname").val(field.name);
                        var is_itemcode = $("#is_itemcode").val();
                        if (is_itemcode === "1") {
                            $("#itemcode").val(field.barcode);
                        }
                        itemSelect(field.MRP, field.dis, field.srate, field.prate, field.wh_rate, field.price_code, field.currentstk, field.tax_id, field.id, field.commission, field.unit_id, field.barcode, field.tax_sales_id, '');
                    });

                });

    }

    function addrowtocoupon(cou_id, cou_code, cou_discountp, cou_discount) {
        var amount = cou_discount;
        var singrow = '<td class="col-lg-4"> <input data-validation="required" value=' + cou_id + ' type="hidden" name="copid[]" id="copid[]"/>' +
                ' <input name="couname[]" id="couname[]" type="text" NoTab="true" disabled value=' + cou_code + '    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key"></td>' +
                ' <td class="col-lg-4"> <input  NoTab="true" disabled  id="cou_value"  value=' + amount + '  name="cou_value"  type="text"    class="form-control" placeholder="Coupon Value"/></td>' +
                '<td><span data-toggle="tooltip"   title="Remove" onclick="removecoupon(this)" couamt=' + amount + ' class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rowcoupon").append(newRow);
    }

    function addrow(id, key, value, page) {
        var singrow = '<td class="col-lg-4"> <input data-validation="required" value=' + id + ' type="hidden" name="keyid" id="keyid"/>' +
                ' <input name="keyname" id="keyname[]" type="text" NoTab="true" value=' + key + '    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key"></td>' +
                ' <td class="col-lg-4"> <input  NoTab="true"   id="key_value"  value=' + value + '  name="key_value"  type="text"    class="form-control" placeholder="Key Value"/></td>';
        var newRow = "<tr>" + singrow + "</tr>";
        $("#rown").append(newRow);
    }

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;
    }/*
     load customer details here 
     */
    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#supname').val(result.name);
                $('#gst').val(result.tin);
                $('#states').val(result.cst);
                $('#bname').val(result.name);
                $('#supid').val(result.id);
                $('#phone').val(result.phone);
                $('#address_line1').val(result.address_line1);
                $('#cst').val(result.cst);
                $('#tin').val(result.tin);
                $('#address_line1').val(result.address_line1);
                $('#address_line2').val(result.address_line2);
                $('#details').val(result.details);
                $("#frmcreate").isValid();

            }
        });
    }
    function loadCust(ui) {
        $('#supname').val(ui.item.name);
        $('#gst').val(ui.item.tin);
        $('#states').val(ui.item.cst);
        $('#stcode').val(ui.item.code);
        $('#bname').val(ui.item.name);
        $('#supid').val(ui.item.id);
        $('#phone').val(ui.item.phone);
        $('#address_line1').val(ui.item.email);
        $('#cst').val(ui.item.cst);
        $('#tin').val(ui.item.tin);
        $('#address_line1').val(ui.item.address_line1);
        $('#address_line2').val(ui.item.address_line2);
        $('#details').val(ui.item.details);
        $('#itemname').focus().select();
    }
    /*
     * load items from db
     */
    $.ajax({
        url: "<?php echo site_url('ajaxcall/salesman'); ?>",
        success: function (result) {
            $('#salesman').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/myprinter'); ?>",
        success: function (result) {
            $('#myprinter').html(result);
            $(".select2").val(["1", "2"]);
        }
    });

    $.ajax({
        url: "<?php echo site_url('ajaxcall/get_saleskey/sales'); ?>",
        success: function (results) {
            $.each(JSON.parse(results), function (i, itemsingle) {
                addrow(itemsingle.id, itemsingle.key, itemsingle.value, itemsingle.page);
            });
        }
    });
    $('.new-invoice').on('DOMFocusOut', function () {
        var newinvoice = $('#b_no').text();
        var oldinvoice = $('#iv_no').text();
        var suffix = $('#btype').find(':selected').attr('suffix');
        var prefix = $('#btype').find(':selected').attr('preffix');
        var seperator = $('#btype').find(':selected').attr('seperator');
        if (newinvoice !== '') {
            var invoice = prefix + seperator + newinvoice + seperator + suffix;
            $.ajax({
                url: "<?php echo site_url('transaction/sales/alreadyexistcheck'); ?>",
                type: 'POST',
                data: {field1: invoice},
                success: function (result) {
                    var invoice = result;
                    if (parseFloat(invoice) > 0) {
                        newinvoice = oldinvoice;
                        calert('Invoice Already Exist');
                    }
                    $("#new_invoice").val(newinvoice);
                    $('#b_no').html(newinvoice);
                    $("#new_invoice").val(prefix + seperator + newinvoice + seperator + suffix);
                }
            });
        } else {
            $('#b_no').html(oldinvoice);
        }


    });
    $("#unit_item").change(function () {
        var myTag = $(this).find(':selected').attr('count');
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
    });
    $("#godown").change(function () {
        var myTag = $('#godown').find(':selected').attr('stock');
        $("#i_stock").html("Stock: " + myTag);

    });
    $("#states").change(function () {
        var code = $(this).find(':selected').attr('code');
        $('#stcode').val(code);
    });
    $("#discount").change(function () {
        var newdiscount = $('#discount').val();
        var olddiscount = $('#rowdis').val();
        var total = $('#gtotal').val();
        var discount = $('#discount').val();
        if (discount !== "") {
            discount = discount;
        } else {
            discount = 0;
        }
        var dis_per = ((parseFloat(discount) * 100) / parseFloat(total));
        var id = 1;
        $(".disper").each(function () {
            $(this).val(dis_per);
            var ids = $(this).attr('id');
            calculaterowdis(ids.split("itmrate")[1]);
            id = id + 1;
        });
        calculateGTotal();
    });
    $("#unit_item").change(function () {

        var myTag = $(this).find(':selected').attr('count');
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
    });
    $("#type").change(function () {
        var ctype = $('#btype').find(':selected').attr('Cash');
        var btype = $('#btype').find(':selected').attr('Bank');
        document.getElementById("b_no").contentEditable = false;
        var type = $("#type").val();
        if (type === 'Bank') {
            $("#paytype").val(btype);
        }
        if (type === 'Cash') {
            $("#paytype").val(ctype);
        }
        if (type === 'Credit') {
            $("#supname").attr('data-validation-length', 'min2');
            $("#supname").attr('data-validation', 'required,length');
            $("#supid").attr('data-validation', 'required');
            $("#supname").focus();
        } else
        {
            $("#supid").removeAttr('data-validation', 'required');
            $("#supname").removeAttr('data-validation-length', 'min2');
            $("#supname").removeAttr('data-validation', 'required,length');
        }
    });
    $("#is_tax").change(function () {
        var is_tax = $("#is_tax").val();
        $("#is_taxincuded").val(is_tax);
        is_taxincuded = is_tax;
    });
    $("#supname").change(function () {
        var name = $("#supid").val();
        var cashtype = $("#type").val();
        customer_alert(name, cashtype);
        $("#supname").focus();
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/area'); ?>",
        success: function (result) {
            $('#area').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
        success: function (result) {
            $('#Costcenter').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/analyticscenter'); ?>",
        success: function (result) {
            $('#analyticscenter').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/route'); ?>",
        success: function (result) {
            $('#route').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/vehicle'); ?>",
        success: function (result) {
            $('#vehicle').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('ajaxcall/reference'); ?>",
        success: function (result) {
            $('#reference').html(result);
            if ($("#id").val() !== '0') {
                load_items($("#id").val());
            }
        }
    });
    function getbtype(btypeid)
    {
        $.ajax({
            url: "<?php echo site_url('transaction/sales/getprinttype'); ?>/" + btypeid,
            async: false,
            success: function (results) {
                var result = JSON.parse(results);
                $('#printtype').val(result.id);
                //$("#item_qty").focus();
            }
        });
    }
    $.ajax({
        url: "<?php echo site_url('ajaxcall/printtype'); ?>/" + $('#ttype').val(),
        success: function (result) {
            var terms_condition = $('#terms_condition').val();
//            $('#tms_con').val();
//            $('#tms_con').val(terms_condition);
            $('#printtype').html(result);
        }
    });
    function load_items(id) {
        var tot = 0;
        var ser_tax = 0;
        if (id !== '0') {

            var selectedValues = '';
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getprinters'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        if (i < 1) {
                            selectedValues = selectedValues + itemsingle.printer_id;
                        } else {
                            selectedValues = selectedValues + ',' + itemsingle.printer_id;
                        }

                    });
                }

            });
        }
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/service_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        tot = parseFloat(tot) + parseFloat(itemsingle.amount);
                        ser_tax = parseFloat(ser_tax) + parseFloat(itemsingle.tax);
                        $('#sertaxtotal').val(ser_tax);
                        $('#sergtotal').val(tot);
                        addrowtoservice(itemsingle.amount, itemsingle.tax_id, itemsingle.tax, itemsingle.tax, itemsingle.name, itemsingle.ledger_id);

                    });
                }
            });
            $.ajax({
                url: "<?php echo site_url('ajaxcall/sale_coupon'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        addrowtocoupon(itemsingle.cou_id, itemsingle.cou_code, itemsingle.cou_discountp, itemsingle.amount);
                    });
                }
            });


            $.ajax({
                url: "<?php echo site_url('ajaxcall/sales_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var est_qty = 0;
                        $('#printtype').val(itemsingle.printtype);
                        var ttype = $("#copy").val();
                        if (ttype === "copy") {
                            $("#id").val(0);
                        }
                        var estid = $("#id").val();
                        if (estid !== '0') {
                            $('#txtEstimate_id').val(itemsingle.estimate_id);

                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity <= itemsingle.estimate_quantity) {
                            est_qty = 1;

                        }
                        if ($('#txtEstimate_id').val() !== "0" && itemsingle.quantity > itemsingle.estimate_quantity) {
                            var mrp_item = itemsingle.mrp;
                            var prate_item = itemsingle.rate;
                            var taxamount = 0;
                            var quantity = parseFloat(itemsingle.quantity) - parseFloat(itemsingle.estimate_quantity);
                            itemsingle.quantity = quantity;
                            var total = parseFloat(mrp_item) * parseFloat(quantity);
                            if (itemsingle.rate !== "0.00") {
                                var discount = (parseFloat(total) * parseFloat(prate_item)) / 100;
                                var total = parseFloat(total) - parseFloat(discount);
                                itemsingle.dis_amt = discount;

                            }
                            if (itemsingle.is_taxincluded === "1") {
                                taxamount = (parseFloat(total) * parseFloat(itemsingle.tname)) / 100;
                                itemsingle.tax = taxamount;
                            }
                            if (itemsingle.is_taxincluded === "0") {
                                taxamount = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(itemsingle.tname) + 100));
                                itemsingle.tax = taxamount;
                            }


                        }
                        if (i < 1) {
                            $('#b_no').html(itemsingle.invoice);
                            if ($('#txtEstimate_id').val() === "0") {
                                $('#btype').val(itemsingle.bill_type);
                            }
                            $('#date').val(itemsingle.in_date);
                            if (itemsingle.customer_id !== "0") {
                                loadCustByid(itemsingle.customer_id);
                            } else {
                                $('#supname').val(itemsingle.cusname);
                                $('#phone').val(itemsingle.cusdetails);
                                $('#address_line1').val(itemsingle.cusemail);
                            }
//                            getbtype(itemsingle.bill_type);


                        }


                        $('#tms_con').val();
                        $('#tms_con').val(itemsingle.terms_condition);
                        // $('#des_det').val();
                        // $('#des_det').val(itemsingle.despatch_details);
                        $('#con_name').val(itemsingle.con_name);
                        $('#con_addr').val(itemsingle.con_addr);
                        $('#con_contact').val(itemsingle.con_contact);
                        $('#con_gst').val(itemsingle.con_gst);
                        $('#con_state').val(itemsingle.con_state);
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#ewbno').val(itemsingle.ewb_no);
                        $('#ewbdetails').val(itemsingle.ewb_details);
                        $('#other').val(itemsingle.other);
                        $('#Invoice').val(itemsingle.invoice);
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('#area').val(itemsingle.area);
                        $('#salesman').val(itemsingle.salesman);
                        $('#route').val(itemsingle.route);
                        $('#vehicle').val(itemsingle.vehicle);
                        $('#tax_led_id').val(itemsingle.tax_sales_id);
                        $('#type').val(itemsingle.cash_type);
                        $('#saletype').val(itemsingle.saletype);
                        $('.box-title').html(itemsingle.type);
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var dis_amt = itemsingle.dis_amt;
                        var unit_item = itemsingle.unitid;
                        var godown = itemsingle.godown;
                        var tax_item = itemsingle.taxid;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var item_discription = itemsingle.item_discription;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var is_discount = $("#is_discount").val();

                        var is_taxincluded = itemsingle.is_taxincluded;
                        $("#is_taxincuded").val(is_taxincuded);
                        $("#is_tax").val(is_taxincuded);
                        var tax_amount = itemsingle.tax;
                        var rowTotal = ((parseFloat(itemsingle.mrp) * parseFloat(itemsingle.quantity)) - itemsingle.dis_amt).toFixed(2);
                        if (is_discount === '1') {
                        }
                        if (is_taxincluded === "0") {
                            rowTotal = (parseFloat(rowTotal) + parseFloat(tax_amount)).toFixed(2);
                        }

                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var barcode = itemsingle.barcode;
                        var unit_name = itemsingle.uname;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var analytics = itemsingle.analytics;
                        var analyticsname = itemsingle.analyticsname;
                        var pur_rate = itemsingle.prate;

                        var amount = parseFloat(rowTotal).toFixed(2);
                        if (is_taxincluded === "0") {
                            amount = parseFloat(rowTotal - tax_amount).toFixed(2);
                        }
                        var invoice_type = "Sales";
                        if (item_qty < 0) {
                            invoice_type = "Return";
                        }
                        var margin = parseFloat(pur_rate * item_qty).toFixed(2);
                        var margin = parseFloat(amount - margin).toFixed(2);
                        dis_amt = parseFloat(dis_amt).toFixed(2);
                        if (est_qty === 0) {
                            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincluded, margin, item_discription, barcode, analytics, analyticsname, invoice_type);
                            addrowtoTable(iteadd);
                            items.push(iteadd);
                            $("#Costcenter").val(itemsingle.cost_center);
                            $("#rowTotal").val(0.0);
                            calculateGTotal();
                            $("#itemname").focus();
                            ref();
                            $('.myspop').popover();
                        }
                    });
                }
            });
        }

    }
    function  calculateGTotal() {
        console.log(items);
        var total = 0;
        var tax = 0;
        var commi = 0;
        var totrate = 0;
        var itmno = 0;
        var bmargin = 0;
        var discount = 0;
        var j = 0;
        $.each(items, function (i) {
            j = j + 1;
            itmno = itmno + 1;
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            bmargin = parseFloat(bmargin) + parseFloat(items[i].margin);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
            totrate = parseFloat(totrate) + parseFloat(items[i].mrp_item);
            discount = parseFloat(discount) + parseFloat(items[i].dis_amt);
            commi = parseFloat(commi) + parseFloat(total) * parseFloat(items[i].commission) / 100;
        });
        $("#billmargin").val(bmargin);
        $("#b_mgn").html("B M: " + bmargin.toFixed(2));
        $("#totnolist").val(j);
        $("#rowdis").val(discount.toFixed(2));
        $("#discount").val(discount.toFixed(2));
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        $("#total").val(total.toFixed(2));
        $("#totsaletax").val(tax.toFixed(2));
        tax = parseFloat(tax) + parseFloat(tottax);
        $("#taxtotal").val(tax.toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
        discount = 0;
        //+ parseFloat(tax) tax included in rate
        var gtotal = parseFloat(total) + parseFloat(totamt) + parseFloat(freight) - parseFloat(discount);
        var totrate = parseFloat(gtotal) - parseFloat(tax);
        $("#totrate").val(totrate.toFixed(2));
        var rount = (parseFloat(gtotal.toFixed(0)) - parseFloat(gtotal.toFixed(2))).toFixed(2);
        $("#gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
        $("#rount").val(rount);
        var reference = getVal('reference');
        if (reference !== 0) {
            $("#commi_amt").show();
            $("#commi_amt").val(commi.toFixed(2));
        } else {
            $("#commi_amt").hide();
            $("#commi_amt").val(0);
        }
        ref();
        $('.myspop').popover();
    }

    function  validate(item_id) {
        var validate = 0;
        $.each(items, function (i) {
            if (items[i].item_id === item_id)
            {
                validate = 1;
                return validate;
            }
        });
        return validate;
    }
    function insertItems()
    {
        var item_id = $("#item_id").val();
        if (item_id === '' || item_id === undefined)
        {
            $("#itemname").focus();
            return;
        }
        var item_qty = $("#item_qty").val();
        var unit_item = $("#unit_item").val();
        var godown = $("#godown").val();
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
        var prate_item = $("#prate_item").val();
        var dis_amt = $("#dis_amt").val();
        var itemname = $("#itemname").val();
        var is_itemcode = $("#is_itemcode").val();
        var barcode = "";
        if (is_itemcode === "1") {
            barcode = $("#itemcode").val();
        }
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var commission = $("#commission").val();
        var pur_rate = $("#pur_rate").val();
        var item_discription = $('#txtExtra').val();
        $('#txtExtra').val('');
        var invoice_type = $('#invoice_type').val();
        var tax_name = $("#tax_item option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        var is_taxincuded = $("#is_taxincuded").val();
        var amount = parseFloat(rowTotal).toFixed(2);
        if (is_taxincuded === "0") {
            amount = parseFloat(rowTotal - tax_amount).toFixed(2);
        }
        var margin = parseFloat(pur_rate * item_qty).toFixed(2);
        var analyticsname = $("#analyticscenter option:selected").text();
        var analytics = $("#analyticscenter").val();
        var margin = parseFloat(amount - margin).toFixed(2);
        if (godown !== null && unit_item !== null && tax_item !== null && tax_item !== "") {
            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincuded, margin, item_discription, barcode, analytics, analyticsname, invoice_type);
            addrowtoTable(iteadd);
            items.push(iteadd);
            var id = $("#id").val();
            if (id === "0") {
                localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
            }
            $("#rowTotal").val(0.0);
            $('#rowm').tableNav();
        } else {
            if (tax_item === null) {
                calert("Select Item Tax");
            } else {
                calert('Set Default Company Settings');
            }
            $("#itemname").focus();
        }
    }
    function customer_alert(name, cashtype) {
        var ctype = cashtype.toLowerCase();
        var cname = name.toLowerCase();
        if (cname === "" && ctype === "credit") {
            clearValue($("#supname"));
            $("#supname").focus();
            calert('Customer Required');
        }
    }
    function showbtn(id) {
        var name = $("#supid").val();
        var cashtype = $("#type").val();
        customer_alert(name, cashtype);
        if (id === 0) {
            $('#form-button-save').attr('disabled', 'disabled');
        } else
        {
            if (items.length === 0) {
                $('#form-button-save').attr('disabled', 'disabled');
            } else {
                $('#form-button-save').removeAttr('disabled');
            }
        }
        var type = $("#type").val();
        var name = $("#supid").val();
        if (type === 'credit' && name === '') {
            $('#form-button-save').attr('disabled', 'disabled');
            $("#itemname").focus();
            calert('Customer Required');
        }
    }
    function calculaterowdis(id) {
        var is_discount = getVal('is_discount');
        var mrp_item = getVal('itmmrp' + id);
        var qty = getVal("itmqty" + id);
        var inv_typ = getVal("inv_typ" + id);
        if (inv_typ === "Return" && qty > 0) {
            qty = parseFloat(qty * -1);
            $("#itmqty" + id).val(qty);
        }
        if (inv_typ === "Sales" && qty < 0) {
            qty = parseFloat(qty * -1);
            $("#itmqty" + id).val(qty);
        }
        var prate_item = getVal('itmrate' + id);
        var dis_amt = 0;
        if (is_discount === '1') {
            if (prate_item !== '' && prate_item !== '' && qty !== '')
                dis_amt = parseFloat((mrp_item * prate_item * qty) / 100);
        }

        $("#itmdis" + id).val(dis_amt.toFixed(2));
        calculaterow(id);
    }
    function calculatefield() {
        var prate = getVal("prate_item");
        var qty = getVal("item_qty");
        var mrp_item = getVal('mrp_item');
        var dis = 0.00;
        if (mrp_item !== '0' && qty !== '0' && prate !== 0) {
            dis = mrp_item * qty * prate / 100;
        }
        $("#dis_amt").val(dis.toFixed(2));
    }
    $('.ItemMatchBarcode').autoComplete({
        minChars: 2,
        cache: false,
        appendTo: '#mainSale',
        source: function (term, response) {
            $('.itemname').attr('data-placement', 'right');
            $('.itemname').popover('toggle');
            $("[wf-popover]").popover({
                html: true,
                content: function () {
                    var content = $(this).attr("wf-content");
//                        alert( $("#discription").text());
                    return content;
                },
                title: function () {
                    var title = $(this).attr("wf-title");
                    //return $(title).children(".popover-heading").html();
                    return title;
                },
                placement: function () {
                    var my = this.$element.attr('wf-popover');
                    return my;
                }
            });
            var customer = '';
            var is_kitcustomer = $("#is_kitcustomer").val();
            if (is_kitcustomer !== '0') {
                customer = $("#supid").val();
            }
            xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/items1/Txtbarcode/' + customer + '?', {term: term}, function (data) {
                response(data);
            });
        }
        ,
        renderItem: function (item, search) {
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
            return '<div class="autocomplete-suggestion" data-val="' + item.label + '" data-tax_sales_id="' + item.tax_sales_id + '" data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-barcode="' + item.barcode + '"  data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.prate + '"  data-srate="' + item.rate + '"  data-mrp="' + item.rate + '"  data-wh_rate="' + item.wh_rate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
        }
        ,
        onSelect: function (e, term, item) {
            var MRP = item.data('mrp');
            var price_code = item.data('price_code');
            var currentstk = item.data('currentstk');
            var tax_id = item.data('tax_id');
            var id = item.data('id');
            $("#item_qty").focus();
            var commission = item.data('commission');
            var unit_id = item.data('unit_id');
            var barcode = item.data('barcode');
            var tax_sales_id = item.data('tax_sales_id');
            itemSelect(MRP, item.data('dis'), item.data('srate'), item.data('prate'), item.data('wh_rate'), price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, '');
            $("#itemname").val(item.data('name'));
            var is_itemcode = $("#is_itemcode").val();
            if (is_itemcode === "1") {
                $("#itemcode").val(item.data('barcode'));
            }

        }

    }
    );
    $(itemname).autoComplete({
        minChars: 2,
        cache: false,
        appendTo: '#mainSale',
        source: function (term, response) {
            $('.itemname').attr('data-placement', 'right');
            $('.itemname').popover('toggle');
            $("[wf-popover]").popover({
                html: true,
                content: function () {
                    var content = $(this).attr("wf-content");
//                        alert( $("#discription").text());
                    return content;
                },
                title: function () {
                    var title = $(this).attr("wf-title");
                    //return $(title).children(".popover-heading").html();
                    return title;
                },
                placement: function () {
                    var my = this.$element.attr('wf-popover');
                    return my;
                }
            });
            var customer = '';
            var is_kitcustomer = $("#is_kitcustomer").val();
            if (is_kitcustomer !== '0') {
                customer = $("#supid").val();
            }
            xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/items1/name/' + customer + '?', {term: term}, function (data) {
                response(data);
            });
        }
        ,
        renderItem: function (item, search) {
            search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
            var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
            return '<div class="autocomplete-suggestion" data-val="' + item.label + '" data-tax_sales_id="' + item.tax_sales_id + '" data-unit_id="' + item.unit_id + '" data-name="' + item.name + '"  data-barcode="' + item.barcode + '"  data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.prate + '"  data-srate="' + item.rate + '"  data-mrp="' + item.rate + '"  data-wh_rate="' + item.wh_rate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
        }
        ,
        onSelect: function (e, term, item) {
            var MRP = item.data('mrp');
            var price_code = item.data('price_code');
            var currentstk = item.data('currentstk');
            var tax_id = item.data('tax_id');
            var id = item.data('id');
            $("#item_qty").focus();
            var commission = item.data('commission');
            var unit_id = item.data('unit_id');
            var barcode = item.data('barcode');
            var tax_sales_id = item.data('tax_sales_id');
            itemSelect(MRP, item.data('dis'), item.data('srate'), item.data('prate'), item.data('wh_rate'), price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, '');
            $("#itemname").val(item.data('name'));
            var is_itemcode = $("#is_itemcode").val();
            if (is_itemcode === "1") {
                $("#itemcode").val(item.data('barcode'));
            }

        }

    }
    );
    var is_itemcode = $("#is_itemcode").val();

    function itemsearch() {
        $('.itemname').attr('data-placement', 'right');
        $('.itemname').popover('toggle');
        $("[wf-popover]").popover({
            html: true,
            content: function () {
                var content = $(this).attr("wf-content");
//                        alert( $("#discription").text());
                return content;
            },
            title: function () {
                var title = $(this).attr("wf-title");
                //return $(title).children(".popover-heading").html();
                return title;
            },
            placement: function () {
                var my = this.$element.attr('wf-popover');
                return my;
            }
        });

        var text = $("#itemcode").val();
        var customer = '';
        var is_kitcustomer = $('#is_kitcustomer').val();
        if (is_kitcustomer !== '0') {
            customer = $("#supid").val();
        }
        $.getJSON('<?php echo base_url(); ?>ajaxcall/items1/barcode/' + customer + '?', {term: text}, function (result) {
            $.each(result, function (i, field) {
                $("#itemname").val(field.name);
                var is_itemcode = $("#is_itemcode").val();
                $("#item_qty").val(1);
                if (is_itemcode === "1") {
                    $("#itemcode").val(field.item_barcode);
                }
                itemSelect(field.MRP, field.dis, field.salerate, field.prate, field.wh_rate, field.price_code, field.currentstk, field.tax_id, field.id, field.commission, field.uid, field.item_barcode, field.tax_sales_id, field.uname);
                rowcalc();
                add();
                showbtn(1);
                $("#itemcode").focus();
            });

        });



    }
    function kitsearch(event) {
        var cusid = $("#supid").val();
        $("#txtkit").autocomplete({
            source: "<?php echo site_url('kitgroup/kitgroup'); ?>/" + cusid,
            minLength: 2,
            select: function (event, ui) {
                $.ajax({
                    url: "<?php echo site_url('kitgroup/get_kit_items'); ?>/" + ui.item.id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            var item_id = itemsingle.item_id;
                            var item_qty = itemsingle.quantity;
                            var godown = 1;
                            var unit_item = itemsingle.unit_id;
                            var tax_id = itemsingle.tax_id;
                            var mrp_item = itemsingle.rate;
                            var itemname = itemsingle.item;
                            var comontax = $("#comontax").val();
                            var is_taxincluded = $("#is_taxincuded").val();
                            var commission = 0;
                            var unit_name = itemsingle.unit;
                            var barcode = itemsingle.barcode;
                            var tax_name = itemsingle.GST;
                            var pur_rate = itemsingle.prate;
                            var dis_amt = 0;
                            var item_discription = '';
                            var prate_item = 0;
                            var analytics = 0;
                            var analyticsname = '';
                            var godown_name = '';
                            var rowTotal = 0;
                            var tax_amount = 0;
                            var margin = parseFloat(0) - parseFloat(itemsingle.prate).toFixed(2);
                            if (item_qty !== '0' && mrp_item !== '0') {
                                rowTotal = (parseFloat(item_qty) * parseFloat(mrp_item)).toFixed(2);
                                if (tax_name !== 0) {
                                    var tax_amount = parseFloat(rowTotal) - ((parseFloat(rowTotal) * 100) / (parseFloat(tax_name) + 100));
                                    if (is_taxincluded === "0") {
                                        tax_amount = parseFloat(rowTotal) * parseFloat(tax_name) / 100;
                                        rowTotal = (parseFloat(rowTotal) + parseFloat(tax_amount));
                                    }
                                    var margin = parseFloat(pur_rate * item_qty).toFixed(2);
                                    var margin = parseFloat(rowTotal) - parseFloat(margin);

                                }
                            }
                            var iteadd = new item(item_id, item_qty, godown, unit_item, tax_id, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate, is_taxincluded, margin, item_discription, barcode, analytics, analyticsname);
                            addrowtoTable(iteadd);
                            items.push(iteadd);
                            $("#Costcenter").val('');
                            $("#rowTotal").val(0.0);
                            calculateGTotal();
                            $("#itemname").focus();
                            ref();
                            $('.myspop').popover();
                        });
                    }
                });
            }
        });


    }
    function calculaterow(id) {
        //    itmtax   
        var qty = getVal("itmqty" + id);
        var inv_typ = getVal("inv_typ" + id);
        if (inv_typ === "Return" && qty > 0) {
            qty = parseFloat(qty * -1);
        }
        if (inv_typ === "Sales" && qty < 0) {
            qty = parseFloat(qty * -1);
            $("#itmqty" + id).val(qty);
        }
        var is_discount = getVal('is_discount');
        var mrp_item = getVal('itmmrp' + id);
        var dis_amt = getVal('itmdis' + id);
        var tax = getVal("itmtaxper" + id);
        var pur_rate = getVal("mar_pur_rate" + id);
        var tot = getVal("itmtot" + id);
        var prate_item = 0;
        var total = 0;
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        items.splice(itm, 1);
        iteadd.item_qty = qty;
        if (is_discount === '1') {
            total = parseFloat(mrp_item) * qty - dis_amt;
            var dis_tot = parseFloat(mrp_item * qty);
            var dis_tot = parseFloat(dis_tot - dis_amt);
            if (dis_tot < 0) {
                total = parseFloat(mrp_item) * qty;
                dis_amt = 0;
                $("#itmdis" + id).val(dis_amt.toFixed(2));
            }
            if (dis_amt !== '0' && mrp_item !== '0' && qty !== '0' && dis_amt < mrp_item * qty) {
                prate_item = parseFloat(((dis_amt * 100) / (mrp_item * qty)));
            }
            $("#itmrate" + id).val(prate_item.toFixed(2));
            // total = rowtotal(qty, mrp_item);
        }
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        is_taxincuded = $("#is_taxincuded" + id).val();
        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            total = (parseFloat(total) + parseFloat(taxamt)).toFixed(2);
        }
        if (!isNaN(taxamt)) {
            $("#itmtax" + id).val(taxamt.toFixed(2));
            $("#itmtot" + id).val(total);
        }
        var amount = parseFloat(total).toFixed(2);
        if (is_taxincuded === "0") {
            amount = parseFloat(total - taxamt).toFixed(2);
        }
        var margin = parseFloat(pur_rate * qty).toFixed(2);
        var margin = parseFloat(amount - margin).toFixed(2);
        $("#margin" + id).val(margin);
        $("#i_mgn").html("I M: " + parseFloat(margin).toFixed(2));
        iteadd.tax_amount = taxamt;
        iteadd.mrp_item = mrp_item;
        iteadd.prate_item = prate_item.toFixed(2);
        iteadd.rowTotal = total;
        iteadd.margin = margin;
        iteadd.dis_amt = dis_amt;
        //this.commission = commission;  
        items.push(iteadd);
        localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
        calculateGTotal();
    }
    var idinc = 0;
    function addrowtoTable(items) {
        idinc = idinc + 1;
        var invoice_type = items.invoice_type;
        var is_taxincuded = items.is_taxincuded;
        var item_id = items.item_id;
        var item_qty = items.item_qty;
        var unit_item = items.unit_item;
        var godown = items.godown;
        var tax_item = items.tax_item;
        var dis_amt = items.dis_amt;
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var dis_amt = items.dis_amt;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var margin = items.margin;
        var pur_rate = items.pur_rate;
        var barcode = items.barcode;
        var item_discription = items.item_discription;
        var is_extra = $("#is_extra").val();
        var totstock = $("#totstock").val();
        $("#i_mgn").html("I M: " + margin);
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var pophtml = 'MRP -' + items.mrp_item + '<br/> ' + 'Purchase Rate -' + items.pur_rate;
        pophtml = pophtml + '</br>' + 'Stock  -' + totstock;
        if (is_extra === "1") {
            pophtml = pophtml + '</br>' + '<textarea col=23 form="usrform">' + item_discription + '</textarea>';
        }
        var rowval = rowval + td(1, 'item_no[]', ' text-right', 'id="itmno' + items.inc_id + '"', 'sma') + hidden(is_taxincuded, 'is_taxincuded[]', 'id="is_taxincuded' + items.inc_id + '"');
        var is_itemcode = $("#is_itemcode").val();
        if (is_itemcode === "1") {
            rowval = rowval + td(barcode, 'item[]', '', '', 'col-lg-1', pophtml);
        }
        rowval = rowval + td(itemname, 'itemname[]', '', '', 'col-lg-3', pophtml);
        var is_analytics = $("#is_analytics").val();
        if (is_analytics === "1") {
            var analytics = items.analytics;
            var analyticsname = items.analyticsname;
            rowval = rowval + hidden(analytics, 'analytics_id[]') + td(items.analyticsname, '', '');
        }
        var is_godown = $("#is_godown").val();
        var is_multipleunit = $("#is_multipleunit").val();
        if (is_godown === "1") {

            rowval = rowval + td(items.godown_name, '', '');
        }
        rowval = rowval + tde(item_qty, 'item_qty[]', 'text-right  two-digits price', 'id="itmqty' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        if (is_multipleunit === "1") {
            rowval = rowval + td(items.unit_name, '', '');
        }
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', '', 'id="itmtaxper' + items.inc_id + '"');
        }
        rowval = rowval + tde(mrp_item, 'mrp_item[]', ' text-right two-digits', 'id="itmmrp' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')') + tde(dis_amt, 'dis_amt[]', 'text-right price  two-digits', 'id="itmdis' + items.inc_id + '" onchange=calculaterow(' + items.inc_id + ')') + tde(prate_item, 'prate_item[]', 'text-right price disper  two-digits', 'id="itmrate' + items.inc_id + '" onchange=calculaterowdis(' + items.inc_id + ')');
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', ' text-right rtaxtot', 'id="itmtax' + items.inc_id + '"');
        }
        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(invoice_type, 'inv_typ[]', 'id="inv_typ' + items.inc_id + '"') + hidden(item_discription, 'itmdtn[]', 'id="itmdtn' + items.inc_id + '"') + hidden(pur_rate, 'mar_pur_rate[]', 'id="mar_pur_rate' + items.inc_id + '"') + hidden(margin, 'margin[]', 'id="margin' + items.inc_id + '"') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'text-right  rtot total', 'id="itmtot' + items.inc_id + '"', '') + tdhtml(del);
        var newRow = tr(rowval);
        $("#rowm").prepend(newRow);
        $('#salesTable').tableNav();
        $('#salesTable input').eq(1).click();
    }

    function add() {
        insertItems();
        clear();
        calculateGTotal();
    }
    function calculatesertot(amt, tax) {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        totamt = (parseFloat(totamt) - parseFloat(amt)).toFixed(2);
        tottax = (parseFloat(tottax) - parseFloat(tax)).toFixed(2);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
    }

    function addservices() {
        var tottax = $("#sertaxtotal").val();
        var totamt = $("#sergtotal").val();
        var ledger = $("#ser_ledger").val();
        var ledgerid = $("#ser_ledgerid").val();
        var amount = $("#ser_amt").val();
        var taxid = $("#ser_tax").val();
        var tid = 0;
        totamt = (parseFloat(totamt) + parseFloat(amount)).toFixed(2);
        var gst = 0;
        var tax = 0;
        if (amount !== '0' && taxid !== null && taxid !== '0') {
            tax = $("#ser_tax option:selected").attr('percent');
            gst = (parseFloat((amount * tax) / 100)).toFixed(2);
            tottax = (parseFloat(tottax) + parseFloat(gst)).toFixed(2);
            tid = $("#ser_tax").val();
            ;
        }
        $("#ser_taxamt").val(gst);
        addrowtoservice(amount, tid, tax, gst, ledger, ledgerid);
        $("#sertaxtotal").val(tottax);
        $("#sergtotal").val(totamt);
        $("#ser_ledger").focus();
        calculateGTotal();
    }
    function addrowtoservice(amount, taxid, tax, gst, ledger, ledgerid) {
        var newrow = '<tr><td  colspan="6"> <input type="hidden" readonly="readonly" NoTab="true" value="' + ledgerid + '" tabindex="-1" name="serv_ledgerid[]" id="serv_ledgerid"/><input  NoTab="true"  readonly="readonly" id="serv_ledger"  class="form-control"  value="' + ledger + '" type="text"     placeholder="service ledger"/></td>' +
                ' <td  colspan="1"> <input type="hidden" NoTab="true" value="' + taxid + ' " tabindex="-1" name="serv_taxid[]" readonly="readonly" id="serv_taxid"/><input  NoTab="true"   id="serv_tax"  class="form-control" readonly="readonly"  value="' + tax + ' " type="text"     placeholder="service ledger"/></td>' +
                ' <td  colspan="2"> <input style="height:25px" id="serv_amt"  name="serv_amt[]" value="' + amount + '" type="text" readonly="readonly" class="form-control text-right  two-digits price " placeholder="service Amt"/></td>' +
                ' <td  colspan="2"> <input id="serv_taxamt" name="serv_taxamt[]" value="' + gst + '"  type="text" readonly="readonly"   class="form-control  text-right two-digits" placeholder="GST"/></td>' +
                '<td  colspan="1"> <span data-toggle="tooltip"   title="Remove" onclick="removeservice(this)" sertax="' + gst + '" seramt="' + amount + '"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
        $("#rows").append(newrow);
        clearservice();
    }
    function remove(btn) {
        var id = $(btn).attr('index');
        var index = getIndexOf(items, id);
        items.splice(index, 1);
        calculateGTotal();
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
        var id = $("#id").val();
        console.log(items);
        if (id === "0") {
            localStorage.setItem('salesitems<?php echo $type . $id; ?>', JSON.stringify(items));
        }
    }
    function removeservice(btn) {
        var amt = $(btn).attr("seramt");
        var tax = $(btn).attr("sertax");
        calculatesertot(amt, tax);
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
        calculateGTotal();
    }
    function removecoupon(btn) {
        var couamt = $(btn).attr("couamt");
        var Discount = $("#discount").val();
        var dis = parseFloat(Discount) - parseFloat(couamt);
        $("#discount").val(dis);
        calculateGTotal();
        $('.tooltip').remove();
        $(btn).closest('tr').remove();
    }

    function getIndexOf(a, v) {
        var l = a.length;
        for (var k = 0; k < l; k++) {
            if (a[k].inc_id.toString() === v.toString()) {
                return k;
            }
        }
        return false;
    }

    function itemSelect(MRP, dis, srate, prate, wh_rate, price_code, currentstk, tax_id, id, commission, unit_id, barcode, tax_sales_id, uname)
    {
        showbtn(0);
        var is_discount = getVal('is_discount');
        var dis_amt = 0.00;
        $("#mrp_item").val(srate);
        $("#item_mrp").val(MRP);
        $("#pur_rate").val(prate);
        $("#unitvalue").val(srate);
        $("#i_stock").html("Stock: " + currentstk);
        $("#totstock").val(currentstk);
        if (is_discount === '1') {
            $("#prate_item").val(0);
            if (dis !== undefined && dis !== '' && dis !== '0') {
                $("#prate_item").val(dis);
                dis_amt = parseFloat(srate * dis / 100);
            }
        } else
        {
            $("#prate_item").val(dis);
        }
        $("#dis_amt").val(dis_amt);
        $("#current_stock").addClass('bg-info');
        $("#tax_sales_id").val(tax_sales_id);
        var is_godown = $("#is_godown").val();
        if (uname !== '') {
            var option = '<option value="' + unit_id + ' ">' + uname + ' </option>';
            $('#unit_item').html('<option value="' + unit_id + '" selected>' + uname + ' </option>');
        } else {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/units'); ?>/" + unit_id,
                success: function (result) {
                    $('#unit_item').html(result);
                    $('#unit_item').val(unit_id);
                }
            });
        }
        if (is_godown === '1') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + id,
                success: function (result) {
                    $('#godown').html('');
                    $('#godown').html(result);
                    var qty = $('#godown').find(':selected').attr('qty');
                    var myTag = $('#godown').find(':selected').attr('stock');
                    $("#i_stock").html("Stock: " + myTag);
                    $("#totstock").val(qty);
                }
            });
        }
        if (is_godown === '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/godown'); ?>",
                success: function (result) {
                    $('#godown').html(result);
                }
            });
            $("#item_qty").focus().select();
        }
        var is_multipletax = getVal('is_multipletax');
        if (is_multipletax === '1') {
            if (tax_sales_id !== undefined && tax_sales_id !== '' && tax_sales_id !== 0) {
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/gettaxledger'); ?>/" + tax_sales_id,
                    async: false,
                    success: function (results) {
                        var result = JSON.parse(results);
                        tax_id = result.ref_id;
                    }
                });
            }

        }

        $('#tax_item').val(tax_id);
        $('#item_id').val(id);
        $('#commission').val(commission);
        $('#base_unit').val(unit_id);



    }
    function rowcalc() {
        var prate = getVal("prate_item");
        var qty = getVal("item_qty");
        var is_discount = getVal('is_discount');
        var prate_item = getVal('prate_item');
        var mrp_item = getVal('mrp_item');
        var tax = $("#tax_item option:selected").attr('percent');
        var total = 0;
        if (is_discount === '1') {
            var dis = getVal("dis_amt");
            if (mrp_item !== '0' && qty !== '0') {
                total = ((parseFloat(mrp_item) * parseFloat(qty)) - dis);
            }
            // total = rowtotal(qty, mrp_item);
        } else {
            total = rowtotal(qty, prate);
        }
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            total = (parseFloat(total) + parseFloat(taxamt));
        }
        if (!isNaN(taxamt)) {
            $("#rowTax").val(taxamt.toFixed(2));
            $("#rowTotal").val(total.toFixed(2));
        }
    }
    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(2);
    }
    function setbillno(id) {
        var sid = $('#id').val();
        if (sid === '0') {
            $.ajax({
                url: "<?php echo site_url('transaction/sales/getnewinoviceno'); ?>/" + id,
                success: function (result) {
                    $('#b_no').html(result);
                    $('#iv_no').html(result);
                    var suffix = $('#btype').find(':selected').attr('suffix');
                    var prefix = $('#btype').find(':selected').attr('preffix');
                    var seperator = $('#btype').find(':selected').attr('seperator');
                    $('#autoinvoice').val(prefix + seperator + result + seperator + suffix);
                    $("#new_invoice").val(prefix + seperator + result + seperator + suffix);
                    $('#sep_second').html(seperator);
                    $('#sep_first').html(seperator);
                    $('#suffix').html(suffix);
                    $('#prefix').html(prefix);
//                    document.getElementById("b_no").contentEditable = true;
                }
            });
        }
    }
    function ref() {
        var reference = getVal('reference');
        if (reference !== 0 && reference !== null) {
            $("#commi_amt").show();
        } else {
            $("#commi_amt").hide();
        }
    }
    $.validate({
        validateHiddenInputs: true,
        modules: 'date, security,file'
    });
    function advance() {
        var adv = $("#type").val();
        if (adv === 'Cash') {
            $("#advance").attr('readonly', 'readonly');
        } else
        {
            $("#advance").removeAttr('readonly');
        }
    }
    var frmcreate = 0;
    var is_taxincuded;

    $(document).ready(function () {
        var btnid = '';
        var id = $("#id").val();
        if (id === "0") {
            var salesitems = localStorage.getItem('salesitems<?php echo $type . $id; ?>');
            if (salesitems !== '' && salesitems !== null) {
                items = JSON.parse(salesitems);
                $.each(JSON.parse(salesitems), function (i, itemsingle) {
                    addrowtoTable(itemsingle);
                    inc_inary = parseInt(inc_inary) + 1;
                });
            }
        }
        is_taxincuded = $("#is_taxincuded").val();
        $("#is_tax").val(is_taxincuded);
        $('#myModalPop').on('shown.bs.modal', function () {
            $('#name').focus();
        });
        $(".myModalPop").click(function () {
            var opt = $(this).attr('opt');
            $("#newtype").val(opt);
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    btnid = guid();
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-header').remove();
                    $('.box-primary').removeClass('box');
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop').modal();
                    $('#is_model').val(1);
                    $('.pophide').hide();
                    $('#btnsaveds').attr('id', btnid);
                    $('.popuphide').hide();
                }
            });
        });
        $("#mClick").click(function () {
            var opt = $("#newtype").val();
            if (opt === "item") {
                $('#' + btnid).click();
            }
            if (opt === "customer") {
                $('#btnsaved').click();
            }
            $.ajax({
                url: "<?php echo site_url('ajaxcall/getitem'); ?>/" + opt,
                async: false,
                success: function (results) {
                    var results = JSON.parse(results);
                    if (results.id > 0) {
                        if (opt === "customer") {
                            loadCustByid(results.id);
                        }
                        if (opt === "item") {
                            itemsearchbyid(results.id);
                        }
                    }

                    //$("#item_qty").focus();
                }
            });
        });
        $("#btnAddExtra").click(function () {
            $('#modelextra').modal();
        });
        showbtn(1);
        advance();
        ref();
        $("#form-button-save").click(function () {
            showbtn(0);
            var type = $("#type").val();
            var name = $("#supid").val();
            if (type === 'credit' && name === '') {
            } else {
                if (frmcreate === 0) {
                    var ms = $("#frmcreate").isValid();
                    if (ms === true) {
                        formsubmit($("#frmcreate"));
                    } else
                    {
                        showbtn(0);
                        return;
                    }
                }
                frmcreate = 1;
            }
        });
        $("#type").change(function () {
            advance();
        });
        $('.dshow').addClass('hidden');
        $('#btshow').click(function () {
            $('.dshow').removeClass('hidden');
        });
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function (results) {
//                        alert(results);
                        $("#balance").html("Closing Balance: " + results);
                    }
                });
                loadCust(ui);
                //                alert(JSON.stringify(ui.item));

                $('#itemname').focus();
                $('#itemcode').focus();
            }
        });
        $("#ser_ledger").autocomplete({
            source: "<?php echo site_url('ajaxcall/ledgers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#ser_ledgerid').val(ui.item.id);
                $('#ser_tax').val(ui.item.tax_id);
                $('#ser_ledger').val(ui.item.name);
                $('#ser_amt').focus();
            }
        });
        $('#reference').change(function () {
            calculateGTotal();
        });
        $('#btype').change(function () {
            var ctype = $('#btype').find(':selected').attr('Cash');
            var btype = $('#btype').find(':selected').attr('Bank');
            var type = $("#type").val();
            if (type === 'Bank') {
                $("#paytype").val(btype);
            }
            if (type === 'Cash') {
                $("#paytype").val(ctype);
            }
            var btypeid = $(this).val();
            getbtype(btypeid);
            setbillno(btypeid)
        });
        //Tax
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax_item').html(result);
                $('#tax_common').html(result);
                $('#ser_tax').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/states'); ?>",
            success: function (result) {
                $('#con_state').html(result);
                $('#con_state').val(45);
                $('#states').html(result);
                $('#states').val(45);
                $('#stcode').val(32);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#godown').html(result);
            }
        });
        $("#Coupon").autocomplete({
            source: "<?php echo site_url('transaction/sales/getcoupon'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#Coupon').val('');
                var dis = 0;
                if (ui.item.cou_discount !== '0' && ui.item.cou_discount !== '' && ui.item.cou_discount !== '0.000') {
                    dis = ui.item.cou_discount;
                } else if (ui.item.cou_discountp !== '0' && ui.item.cou_discountp !== '' && ui.item.cou_discountp !== '0.000') {
                    var total = $('#gtotal').val();
                    dis = (parseFloat(total) * parseFloat(ui.item.cou_discountp)) / 100;
                }
                var dis_amt = $('#discount').val();
                if (dis_amt !== '0' && dis_amt !== '') {
                    amount = parseFloat(dis_amt) + parseFloat(dis);
                } else {
                    amount = dis;
                }
                addrowtocoupon(ui.item.cou_id, ui.item.cou_code, ui.item.cou_discountp, dis);
                $('#discount').val(amount);
                calculateGTotal();
                $('#Coupon').val("");
                $('#Coupon').focus();
            }
        });
        $('.tatalcal').change(function () {
            calculateGTotal();
        });
        $('.price').change(function () {
            rowcalc();
        });
        $('#addmore').click(function () {
            var row = $("#add").html();
            var newRow = "<tr>" + row + "</tr>";
            $("#rowm").append(newRow);
            $(".remove").removeClass("hidden");
            $(".remove").first().addClass("hidden");
        });
        $("#itemname").keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 27)
            {
                showbtn(1);
                $("#freight").focus();
            }

        });
        $("#invoice_type").change(function (e) {
            var stype = $("#invoice_type").val();
            var qty = $("#item_qty").val();
            if (stype === "Return" && qty > 0) {
                qty = parseFloat(-1 * qty);
                $("#item_qty").val(qty);
            } else if (stype === "Sales" && qty < 0) {
                $("#item_qty").val(parseFloat(qty * -1));
            }
            calculatefield();
            rowcalc();

        });
        $("#item_qty").keydown(function (e) {
            var stype = $("#invoice_type").val();
            var qty = $("#item_qty").val();
            if (stype === "Return" && qty > 0) {
                qty = parseFloat(-1 * qty);
                $("#item_qty").val(qty);
            }
            calculatefield();
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
                if ($("#item_qty").val() === 0 || $("#item_qty").val() === '') {
                    $("#item_qty").val(1);
                }
                e.preventDefault();
                e.stopPropagation();
                $("#mrp_item").focus().select();
            }
        });
        $("#ser_amt").keydown(function (e) {
            var amount = $("#ser_amt").val();
            if (amount > 0) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    addservices();
                }
            }

        });
        $("#tax_item").keydown(function (e) {
            var prate = getVal("dis_amt");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;
            if (mrp_item !== '0' && qty !== '0' && prate !== 0) {
                dis = (prate * 100 / (qty * mrp_item));
            }
            $("#prate_item").val(parseFloat(dis).toFixed(2));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#itemname").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                showbtn(1);
            }
            if (key === 9) {
                e.preventDefault();
                e.stopPropagation();
                $("#itemname").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                showbtn(1);
            }

        });
        $("#dis_amt").keydown(function (e) {
            var prate = getVal("dis_amt");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;
            if (mrp_item > 0 && qty !== 0 && mrp_item !== '0' && prate !== 0 && mrp_item !== '' && prate !== '') {
                dis = (prate * 100 / (qty * mrp_item));
            }
            $("#prate_item").val(parseFloat(dis).toFixed(2));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13) {
                e.preventDefault();
                e.stopPropagation();
                $("#prate_item").focus().select();
            }
            if (key === 9) {
                e.preventDefault();
                e.stopPropagation();
                $("#prate_item").focus().select();
            }

        });
        $("#btnAddExtram").click(function () {
            add();
            showbtn(1);
            $('#btncls').click();
        });
        $('#txtExtra').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            if (key === 9 || key === 27)
            {
                $('#itemname').focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                add();
                showbtn(1);
                $('#btncls').click();
            }
        });
        $("#itemname").bind('keydown', 'Ctrl+a', function (evt) {
            var list = '<div class="box-body"><table class="table table-striped table-condensed"><tr><th class="col-md-6">Name</th><th>Barcode</th><th>Quantity</th><th>MRP</th><th>SalesRate</th><th></th></tr>';
            var id = $("#item_id").val();
            var item = 0;
            $.ajax({
                url: "<?php echo site_url('ajaxcall/alter_items'); ?>/" + id,
                success: function (results) {
                    $.each(JSON.parse(results), function (i, itemsingle) {
                        if (i < 1) {
                            item = itemsingle.id;
                        }
                        list = list + '<tr>';
                        list = list + '<td><input  type="hidden" name="pop_item_id' + itemsingle.id + '" id="pop_item_id' + itemsingle.id + '" value="' + itemsingle.id + '"/><input class="form-control" style="height:25px"   id="pop_itemname' + itemsingle.id + '" NoTab="true" name="pop_itemname[]" value=' + itemsingle.name + '  /></td><td><input class="form-control"  style="height:25px" id="pop_barcode' + itemsingle.id + '" NoTab="true" name="pop_barcode[]" value=' + itemsingle.barcode + '  /></td><td><input class="form-control" style="height:25px"  id="pop_qty' + itemsingle.id + '" NoTab="true" name="pop_qty[]" value=' + itemsingle.item_qty + '  /></td><td><input class="form-control" style="height:25px"  id="pop_mrp[]" NoTab="true" name="pop_mrp[]" value=' + itemsingle.MRP + '  /><td><input class="form-control" style="height:25px"  id="pop_srate' + itemsingle.id + '" NoTab="true" name="pop_srate[]" onkeydown="additemcode(event,' + itemsingle.id + ')" value=' + itemsingle.srate + '  /></td><td> <button style="height:25px !important;"  onclick="additmcode(' + itemsingle.id + ')" data-toggle="tooltip" type="button"    title="Add To save" id="btnadditem"  class="btn " href="#"><span class="glyphicon glyphicon-plus"></span> </button></td>';
                        // list = list + '<a id="' + itemsingle.name + '" barcode="' + itemsingle.barcode + '" href="#" class="sela">' + itemsingle.name + '- ' + itemsingle.MRP + '</a>';
                        list = list + '</tr>';
                    });
                    list = list + '</table></div>';
                    $('#myDropdown').html(list);
                    $("#modal-alter").modal();
                }
            });
            return false;
        });
        $('#modelextra').on('shown.bs.modal', function () {
            $('#txtExtra').focus();
        });
        $("#prate_item").keydown(function (e) {
            calculatefield();
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {

                var is_extra = $("#is_extra").val();
                if (parseInt(is_extra) === 1) {
                    $('#modelextra').modal();
                    $("#itemname").focus().select();
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").focus().select();
                    }

                } else {
                    add();
                    $("#itemname").focus().select();
                    var is_itemcode = $("#is_itemcode").val();
                    if (is_itemcode === "1") {
                        $("#itemcode").focus().select();
                    }
                    showbtn(1);
                }
            }
            if (key === 27)
            {
                add();
                $("#itemname").focus().select();
                var is_itemcode = $("#is_itemcode").val();
                if (is_itemcode === "1") {
                    $("#itemcode").focus().select();
                }
                showbtn(1);
                $("#freight").focus();
            }
        });
        $("#mrp_item").keydown(function (e) {
            calculatefield();
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                e.preventDefault();
                e.stopPropagation();
                $("#dis_amt").focus().select();
            }
            if (key === 27)
            {

            }
            showbtn(1);
        });
        $("#supname").focus();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function (result) {
                $('#btype').html(result);
                var ctype = $('#btype').find(':selected').attr('Cash');
                $("#paytype").val(ctype);
                var id = $('#btype').val();
                setbillno(id);
            }
        });
        $('.myspop').popover();
        $("#txtEstimate").autocomplete({
            source: "<?php echo site_url('ajaxcall/estimates/' . $type); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#txtEstimate_id').val(ui.item.sales_id);
                $('#estid').val(ui.item.sales_id);
                $('#freight').val(ui.item.freight);
                $('#advance').val(ui.item.advance);
                $('#other').val(ui.item.other);
                $('#discount').val(ui.item.discount);
                loadCust(ui);
                load_items(ui.item.sales_id);
                $('[data-toggle="popover"]').popover();
            }
        });

        calculateGTotal();
    });

</script>
