<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0; //tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$is_taxincuded = 0; // if it i one then tax inclusive 
$is_discount = 1; //this is for discount then no sales rate 
$is_SettngsEnabled = 1;
$is_godown = $settings[0]['is_godown'];
$is_billtype = $settings[0]['is_billtype'];
$is_multipleunit = $settings[0]['is_unit'];

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
</style>
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/sales/sales/' . $type); ?>" action="<?php echo site_url('transaction/sales/save/' . $type); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
    <input type="hidden" value="0" name="p_id"/> 
    <input type="hidden" value="0" name="invoice" id='Invoice'/>
    <input type="hidden"  name="pur_rate" id='pur_rate'/>
    <input type="hidden" value="<?php echo $is_discount; ?>" id="is_discount" name="is_discount"/> 
    <input type="hidden" value="<?php echo $type; ?>" name="ttype" id="ttype"/> 
    <input type="hidden" value="<?php echo $is_godown; ?>" id="is_godown" name="is_godown"/> 
    <input type="hidden" value="<?php echo $is_billtype; ?>" id="is_billtype" name="is_billtype"/> 
    <input type="hidden"  id="unitvalue" name="unitvalue"/> 
    <input type="hidden" value="<?php echo $is_multipleunit; ?>" id="is_multipleunit" name="is_multipleunit"/> 
    <input type="hidden" value="<?php echo $is_taxincuded; ?>" id="is_taxincuded" name="is_taxincuded"/> 
    <input type="hidden" value="<?php echo $dprate; ?>" id="dprate" name="dprate"/>  
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <input type="hidden" id="txtEstimate_id" class="form-control" name="txtEstimate_id"/>
    <input data-validation="required" type="hidden" name="base_unit" id="base_unit"/>
    <section class="content"> 
        <div class="row"> 
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?php echo ucfirst($type) ?></a></li>
<!--                         <li><a href="#otherTab" data-toggle="tab">Other Details</a></li>
 -->
                        <?php if ($is_SettngsEnabled == 1) { ?>
                            <li class="pull-right"><a href="#SettingsTab" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
                        <?php } ?>    
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="txtEstimate" style="height:30px !important" class="form-control" name="txtEstimate"/>
                            </div>
                        </li>
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <select name="saletype" data-validation="required" id="saletype"  class="form-control">
                                    <option value="BTOC">BTOC</option> 
                                    <option value="BTOB">BTOB</option> 
                                </select> 
                            </div>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale"> 
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-1">Invoice Date</td>
<!--                                        <td class="col col-lg-1">Delivery Date</td> -->
                                        <td class="col col-lg-1 <?php echo $bill; ?> hidden">Bill Type</td> 
                                        <td class="col col-lg-1 hidden">Cash/Credit</td> 
                                        <?php if ($comontax == 1) { ?>
                                            <td class="col col-lg-1">GST</td>
                                        <?php } ?> 
                                        <td>Customer   <button type="button" url="<?php echo base_url(); ?>customers/create/"  class="btn btn-primary myModalPop">
                                                New
                                            </button>
                                        </td>
                                        <td>Billing Name</td>
                                        <td>Phone Number</td>
                                        <td class="hidden">Address</td>
                                    </tr>
                                    <tr>
 <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td><!--                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>-->
                                        <td <?php echo $bill; ?> hidden>
                                            <select tabindex="-1" id="btype" name="btype" class="form-control col-lg-1" >                                            
                                            </select>
                                        </td>
                                        <td class="hidden"><select name="type" data-validation="required" id="type"  class="form-control ">
                                                <option value="Cash">Cash</option> 
                                                <option value="Credit">Credit</option> 
                                            </select> 

                                        </td>
                                        <?php if ($comontax == 1) { ?>
                                            <td><select  data-validation="required" id="tax_common"  name="tax_common" class="form-control" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                        <?php } ?>

                                        <td><input data-validation="required" type="hidden" name="customer_id" id="supid"/>
                                            <input name="supname"   id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                        <td><input name="bname" type="text" id="bname"  class="form-control" placeholder="Billling Name"></td>
                                        <td><input name="phone" type="text" id="phone"  class="form-control" placeholder="Phone"></td>
                                        <td class="hidden"><input name="email" type="text" id="address_line1"    class="form-control" placeholder="Email"></td>
                                    </tr>
<!--                                    <table class="table table-striped table-condensed">
                                        <tr>
                                            <td>First</td>
                                            <td>Second</td>
                                            <td>Second</td>
                                            <td>Four</td>

                                        </tr>
                                        <tr>
                                            <td><input name="first" type="text" id="first"  class="form-control" placeholder="first"></td>
                                            <td><input name="Second" type="text" id="Second"    class="form-control" placeholder="Second"></td>
                                            <td><input name="Second" type="text" id="Second"     class="form-control" placeholder="Second"></td>
                                            <td><input name="Four" type="text" id="Four"     class="form-control" placeholder="Four"></td>
                                        </tr>
                                    </table>-->

                                    <table id="tablex" class="table table-striped table-condensed" hidden="hidden">
                                        <tr>
                                            <td>Customer   <button type="button" url="<?php echo base_url(); ?>masters/customers/add"  class="btn btn-primary myModalPop">
                                                    New
                                                </button>
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
                                    <style>
                                        .span {
                                            font-size: 18px;
                                            font-weight: 600;  
                                            padding-right: 15px;
                                            padding-left: 15px;
                                        }
                                    </style>
                                    <p><span Class="span" id="wholsale">&nbsp;</span><span Class="span" id="prate" ></span> <span class="span" id="balance"></span><span class="span pull-right">    <input type="text" value="0" class="col-lg-6" name="commi_amt_hi" id="commi_amt"/> </span></p>
                                    <table class="table table-striped table-condensed"   >
                                        <thead>
                                            <tr>
                                                <td>No</td>
                                                <td>Item     
                                                    <input type="radio" id="rate" name="rate" value="barcode"> Item Code
                                                    <input type="radio" id="rate" name="rate" value="name" checked="checked"> Name                                    
                                                </td>
                                                <td <?php echo $ghidden; ?> class="hidden">
                                                    Godown
                                                </td>
                                                <td>Qty</td>
                                                <td <?php echo $unit; ?> class="hidden">Unit</td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="hidden">GST</td>
                                                <?php } ?>
                                                <td>Rate</td>
                                                <?php if ($is_discount != 1) { ?>  <?php } else { ?><td>Dis(AMT) </td><?php } ?>
                                                <td>  <?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?>Dis(%) <?php } ?></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="hidden">Tax(AMT)</td>
                                                <?php } ?>
                                                <td>Total<td> 
                                                <td> <td> 
                                            </tr>

                                        </thead>
                                        <tbody  >
                                            <tr id="add">
                                                <td  class="sma" style="text-align: center;"><input title="1" style="height:25px"   id="totnolist" class="form-control col-lg-1 text-right"  readonly="readonly"></td>
                                                <td class="col-lg-4"> <input  NoTab="true"   id="itemname"  data-content="<textarea name='discription' id='discription' form='usrform' data-html='true'></textarea></br><button id='btndis' type='button'>Save</button>" class="form-control"   type="text"     placeholder="Item Name"/></td>
                                                <td <?php echo $ghidden; ?> class="hidden"><select tabindex="-1" id="godown"   class="form-control col-lg-1"  >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <td> <input  id="item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price hunpx " placeholder="Quantity"/></td>
                                                <td class="sma hidden" <?php echo $unit; ?>><select tabindex="-1"   id="unit_item" class="form-control col-lg-1" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="sma hidden"><select tabindex="-1" id="tax_item"  class="form-control col-lg-1" >
                                                            <option value="">Select</option> 
                                                        </select>
                                                    </td>
                                                <?php } ?>
                                                <td><input type="hidden" name="commission" id="commission"/>  <input id="mrp_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="Sales Rate"/></td>
                                                <td> <input id="dis_amt"  NoTab="true"    type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?php if ($is_discount != 1) { ?>   <?php } else { ?>Discount amount <?php } ?>"/></td>
                                                <td> <input id="prate_item"  NoTab="true"    type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder="<?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?>Discount % <?php } ?>"/></td>
                                                <?php if (!$comontax == 1) { ?>
                                                    <td class="hidden"> 
                                                        <input class='form-control col-lg-1 two-digits' id="rowTax" disabled/>
                                                    </td>
                                                <?php } ?>
                                                <td><input class='form-control col-lg-1 two-digits' id="rowTotal" disabled/></td>
                                                <td>

                                                    <!--                                        hidden-->
                                                    <input type="hidden" name="item_id" id="item_id"/>

                                                    <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                        <span class="glyphicon glyphicon-plus"></span> 
                                                    </button>
                                                </td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                    <table class="table table-striped table-condensed" id="rowm" >

                                    </table>
                                    <table class="table table-striped table-condensed" >

                                        <tr> 
                                            <td class="text-right text-center FontDouble" colspan="7"></td>
                                            <td><input type="text"  id="total" name="subtot" readonly="readonly" class="form-control col-lg-1 text-right" placeholder="Total"></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td> </td>
            <!--                                <td>Advance </td>-->
                                            <td></td>
                                            <td>Discount</td>
                                            <td>Round Off</td>
                                            <td>Total Before Tax</td>
                                            <td>GST</td>                               
                                            <td>Grand Total</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td><input name="discount" id="discount" placeholder="Discount"   type="text" class="tatalcal text-right col-lg-1 form-control" ></td>
    <!--                                        <td><input name="Vehicle" id="Vehicle" placeholder="Vehicle No"   type="text" class="col-lg-1 form-control" ></td>-->
                                            <td><input name="rount" id="rount" placeholder="Round off" readonly="readonly"   type="text" class="text-right col-lg-1 form-control" ></td>
                                            <td><input name="totrate" id="totrate" placeholder="Total Before Tax" readonly="readonly"   type="text" class="tatalcal text-right col-lg-1 form-control" ></td>
                                            <td><input name="taxtotal" id="taxtotal" placeholder="Total Tax" readonly="readonly"   type="text" class="text-right col-lg-1 form-control" ></td>
                                            <td><input name="gtotal" id="gtotal" placeholder="Grand Total"  readonly="readonly"  type="text" class="text-right col-lg-1 form-control" ></td>
                                        </tr>
                                    </table>

                            </div>
                            <?php if (ucfirst($type) != 'View') { ?>
                                <div class="box-footer">  
                                    <button id="form-button-save"  type='button' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   

                                    <div class='small-loading' id='FormLoading'> </div>

                                </div>
                            <?php } ?>
                            <div class=" hidden">
                                <i class="fa fa-refresh fa-spin"></i>
                            </div>
                        </div>
                        <!-- /#fa-icons -->

                        <!-- otherTab-->
                        <div class="tab-pane" id="otherTab">
                            <div class="box-body">
                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-2">Delivery Date</td>
                                        <td class="col col-lg-2">Credit Days</td>
                                        <td class="col col-lg-3">SalesMan</td> 
                                        <td class="col col-lg-3">Agent/Reference</td> 
                                        <td class="col col-lg-2"></td> 
                                    </tr>
                                    <tr>
                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>
                                        <td><select  id="salesman"  name="salesman" class="form-control">
                                                <option value="">Select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="reference"  name="reference" class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>                                         
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2">Area</td>
                                        <td class="col col-lg-2">Route</td>
                                        <td class="col col-lg-2">Vehicle</td>
                                        <td class="col col-lg-1">Coolie</td>
                                        <td class="col col-lg-1">Frieght</td>
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
                                        <td>  <input name="other" type="text"   class="form-control  col-lg-1"   placeholder="other"></td>
                                        <td>  <input name="freight" type="text" id="freight"  class="form-control  col-lg-1"  placeholder="Frieght"></td>
                                    </tr>
                                </table>
                                </br>

                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-8">Terms And Conditions</td>
                                        <td class="col col-lg-8">Despatch Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter </textarea></td>
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter text here...</textarea></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <!-- /otherTab -->
                        <?php if ($is_SettngsEnabled == 1) { ?>
                            <!-- SettingsTab-->
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
                            <!-- /#SettingsTab -->
                        <?php } ?>              
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <input name="advance"id="advance" placeholder="Advance"   type="hidden"class="tatalcal text-right col-lg-1 form-control" > 
</form>  

<script type="text/javascript">
    //messages 
    function calert(msg) {
        alert(msg);
    }
    var inc_inary = 0;
    //class
    function item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate) {
        inc_inary = inc_inary + 1;
        this.inc_id = inc_inary;
        this.item_id = item_id;
        this.item_qty = item_qty;
        this.unit_item = unit_item;
        this.godown = godown;
        this.dis_amt = dis_amt;
        this.tax_item = tax_item;
        this.tax_amount = tax_amount;
        this.mrp_item = mrp_item;
        this.prate_item = prate_item;
        this.itemname = itemname;
        this.comontax = comontax;
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
        clearValue($("#unit_item"));
        clearValue($("#godown"));
        clearValue($("#dis_amt"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        $("#prate").html('');
        $("#current_stock").html('');
        clearValue($("#rowTax"));
        clearValue($("#rowTotal"));
        var is_godown = $("#is_godown").val();
        if (is_godown === '1') {
            $('#godown').html('');
        }
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
        $('#bname').val(ui.item.name);
        $('#supid').val(ui.item.id);
        $('#phone').val(ui.item.phone);
        $('#address_line1').val(ui.item.email);
        $('#cst').val(ui.item.cst);
        $('#tin').val(ui.item.tin);
        $('#address_line1').val(ui.item.address_line1);
        $('#address_line2').val(ui.item.address_line2);
        $('#details').val(ui.item.details);
        $('#itemname').focus();

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
        url: "<?php echo site_url('ajaxcall/get_saleskey/sales'); ?>",
        success: function (results) {

            $.each(JSON.parse(results), function (i, itemsingle) {
                addrow(itemsingle.id, itemsingle.key, itemsingle.value, itemsingle.page)
            });
        }
    });
    $(function () {
        // $("#godown").change(function(){
        //     var element = $(this);
        //     var myTag = element.attr("stock");
        //     $('#current_stock').val(myTag);
        // });
    });
    $("#unit_item").change(function () {
        var myTag = $(this).find(':selected').attr('count');
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
    });
    $("#type").change(function () {
        var myTag = $(this).find(':selected').attr('count');
        var mrp = $("#unitvalue").val();
        myTag = myTag * mrp;
        $('#mrp_item').val(myTag);
    });
    $("#type").change(function () {
        var name = $("#supid").val();
        var cashtype = $("#type").val();
        customer_alert(name, cashtype);
        $("#supname").focus();
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
    function load_items(id) {

        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/sales_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {

                        $('#date').val(itemsingle.in_date);
                        $('#txtEstimate_id').val(itemsingle.sales_id);
                        if (itemsingle.customer_id !== "0") {
                            loadCustByid(itemsingle.customer_id);
                        } else {
                            $('#supname').val(itemsingle.cusname);
                            $('#phone').val(itemsingle.cusdetails);
                            $('#address_line1').val(itemsingle.cusemail);
                        }
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#other').val(itemsingle.other);
                        $('#Invoice').val(itemsingle.invoice);
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('#area').val(itemsingle.area);
                        $('#salesman').val(itemsingle.salesman);
                        $('#route').val(itemsingle.route);
                        $('#vehicle').val(itemsingle.vehicle);
                        $('#type').val(itemsingle.cash_type);
                        $('#btype').val(itemsingle.bill_type);
                        $('.box-title').html(itemsingle.type);
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var dis_amt = itemsingle.dis_amt;
                        var unit_item = itemsingle.unit_id;
                        var godown = itemsingle.godown;
                        var tax_item = itemsingle.tax_id;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var is_discount = $("#is_discount").val();
                        var is_taxincuded = $("#is_taxincuded").val();
                        var tax_amount = itemsingle.tax;
                        var rowTotal = ((parseFloat(itemsingle.mrp) * parseFloat(itemsingle.quantity)) - itemsingle.dis_amt).toFixed(2);
                        if (is_discount === '1') {
                        }
                        if (is_taxincuded === "0") {
                            // taxamt = parseFloat(total) * parseFloat(tax) / 100;
                            rowTotal = (parseFloat(rowTotal) + parseFloat(tax_amount)).toFixed(2);
                        }

                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var pur_rate = itemsingle.prate;
                        var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate);
                        addrowtoTable(iteadd);
                        items.push(iteadd);
                        $("#rowTotal").val(0.0);
                        calculateGTotal();
                        $("#itemname").focus();
                        ref();
                        $('.myspop').popover();
                        $('#rowm').tableNav();
                    });
                }
            });
        }

    }
    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        var commi = 0;
        var totrate = 0;
        var itmno = 0;
        var j = 0;
        $.each(items, function (i) {
            j = j + 1;
            itmno = itmno + 1;
            $("#itmno" + items[i].inc_id).val(itmno.toFixed(0));
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
            totrate = parseFloat(totrate) + parseFloat(items[i].mrp_item);
            commi = parseFloat(commi) + parseFloat(total) * parseFloat(items[i].commission) / 100;
        });
        $("#totnolist").val(j);
        $("#totrate").val(totrate.toFixed(2));
        $("#total").val(total.toFixed(2));
        $("#taxtotal").val(tax.toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
        //+ parseFloat(tax) tax included in rate
        var gtotal = parseFloat(total) + parseFloat(freight) - parseFloat(discount);
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
            calert('Please add a valid item');
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
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var commission = $("#commission").val();
        var pur_rate = $("#pur_rate").val();
        var tax_name = $("#tax_item option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name, dis_amt, pur_rate);
        addrowtoTable(iteadd);
        items.push(iteadd);
        /* no valiidation alredy exits items 
         if (validate(item_id) === 0)
         {
         addrowtoTable(iteadd);
         items.push(iteadd);
         }
         else
         {
         $("#itemname").focus();
         //calert('item is already exists');
         }*/
        $("#rowTotal").val(0.0);
        $('#rowm').tableNav();

    }
    function customer_alert(name, cashtype) {
        var ctype = cashtype.toLowerCase();
        var cname = name.toLowerCase();
        if (cname == "" && ctype == "credit") {
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
        if (type == 'credit' && name == '') {
            $('#form-button-save').attr('disabled', 'disabled');
            $("#itemname").focus();

            calert('Customer Required');
        }
    }
    function calculaterowdis(id) {
        var is_discount = getVal('is_discount');
        var mrp_item = getVal('itmmrp' + id);
        var qty = getVal("itmqty" + id);
        var prate_item = getVal('itmrate' + id);
        var dis_amt = 0;

        if (is_discount === '1') {
            if (prate_item != '' && prate_item != '' && qty != '')
                dis_amt = parseFloat((mrp_item * prate_item * qty) / 100);
        }

        $("#itmdis" + id).val(dis_amt.toFixed(2));
        calculaterow(id);

    }
    function calculaterow(id) {
        //    itmtax   
        var qty = getVal("itmqty" + id);
        var is_discount = getVal('is_discount');
        var prate_item = getVal('itmrate' + id);
        var mrp_item = getVal('itmmrp' + id);
        var dis_amt = getVal('itmdis' + id);
        var tax = getVal("itmtaxper" + id);
        var tot = getVal("itmtot" + id);
        prate_item = 0;
        var total = 0;
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        items.splice(itm, 1);
        iteadd.item_qty = qty;
        prate_item = parseFloat(mrp_item) * qty - dis_amt;
        if (is_discount === '1') {
            total = parseFloat(mrp_item) * qty - dis_amt;
            if (dis_amt != '0' && mrp_item != '0' && qty != '0') {
                prate_item = parseFloat(((dis_amt * 100) / (mrp_item * qty)));
            }
            $("#itmrate" + id).val(prate_item.toFixed(2));
            // total = rowtotal(qty, mrp_item);
        } else {
            total = rowtotal(qty, prate);
        }
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        if (!isNaN(taxamt)) {
            $("#itmtax" + id).val(taxamt.toFixed(2));
            $("#itmtot" + id).val(total);
        }
        iteadd.tax_amount = taxamt;
        iteadd.mrp_item = mrp_item;
        iteadd.prate_item = prate_item;
        iteadd.rowTotal = total;
        //this.commission = commission;  
        items.push(iteadd);
        calculateGTotal();
    }
    var idinc = 0;
    function addrowtoTable(items) {
        idinc = idinc + 1;
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
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var pophtml = 'MRP -' + items.mrp_item + '<br/> ' + 'Purchase Rate -' + items.pur_rate + '</br>' + '<textarea col=23 form="usrform"></textarea>' + '<button type="button" id="adddis">Click Me!</button>';
        var rowval = rowval + td(1, 'item_no[]', 'col-lg-1 text-right', 'id="itmno' + idinc + '"', 'sma');
        rowval = rowval + td(itemname, 'itemname[]', '', '', 'col-lg-4', pophtml);
        var is_godown = $("#is_godown").val();
        var is_multipleunit = $("#is_multipleunit").val();
        if (is_godown === "1") {

            rowval = rowval + td(items.godown_name,hidden);
        }
        rowval = rowval + tde(item_qty, 'item_qty[]', 'form-control text-right col-lg-1 two-digits price hunpx', 'id="itmqty' + idinc + '" onchange=calculaterowdis(' + idinc + ')');
        // if (is_multipleunit === "1") {
        //     rowval = rowval + td(items.unit_name);
        // }
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', 'col-lg-1 text-right hidden', 'id="itmtaxper' + idinc + '"');
        }
        rowval = rowval + tde(mrp_item, 'mrp_item[]', 'ol-lg-1 text-right two-digits hunpx', 'id="itmmrp' + idinc + '" onchange=calculaterowdis(' + idinc + ')') + tde(dis_amt, 'dis_amt[]', 'form-control text-right price col-lg-1 two-digits', 'id="itmdis' + idinc + '" onchange=calculaterow(' + idinc + ')') + tde(prate_item, 'prate_item[]', 'col-lg-1 text-right', 'id="itmrate' + idinc + '" onchange=calculaterowdis(' + idinc + ')');
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'col-lg-1 text-right rtaxtot hidden', 'id="itmtax' + idinc + '"');
        }
        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'text-right col-lg-1 rtot total hunpx', 'id="itmtot' + idinc + '"', 'col-lg-1') + tdhtml(del);
        var newRow = tr(rowval);
        $("#rowm").append(newRow);
    }

    function add() {
        insertItems();
        clear();
        calculateGTotal();
        $("#itemname").focus();
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
            if (mrp_item != '0' && qty != '0') {
                total = ((parseFloat(mrp_item) * parseFloat(qty)) - dis);
            }
            // total = rowtotal(qty, mrp_item);
        } else {
            total = rowtotal(qty, prate);
        }
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        if (is_taxincuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            total = (parseFloat(total) + parseFloat(taxamt)).toFixed(2);
        }
        if (!isNaN(taxamt)) {
            $("#rowTax").val(taxamt.toFixed(2));
            $("#rowTotal").val(total);
        }
    }
    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(2);
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
//        $('#tablex').removeAttr('hidden');
//        $("#tablex").attr("hidden", "true");
        is_taxincuded = $("#is_taxincuded").val();

        $(".myModalPop").click(function () {

            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('.box-header').remove();
                    $('.box').removeClass();
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop').modal();
                    $('#is_model').val(1);
                    $('.box-footer').hide();
                }
            });
        });
        $("#mClick").click(function () {
            $('#btnsaved').click();
        })
        showbtn(1);
        advance();
        ref();
        $("#form-button-save").click(function () {
            showbtn(0);
            var type = $("#type").val();
            var name = $("#supid").val();
            if (type == 'credit' && name == '') {
            } else {
                if (frmcreate === 0) {
                    var ms = $("#frmcreate").isValid();
                    if (ms === true) {

                        formsubmit($("#frmcreate"))
                    } else
                    {
                        showbtn(0);
                        return;
                    }
                }
                frmcreate = 1;
            }
        })
        $("#type").change(function () {
            advance();
        });
        $('.dshow').addClass('hidden');
        //supplier 
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
                        $("#balance").html("Clossing Balance: " + results);
                    }
                });
                loadCust(ui);
//                alert(JSON.stringify(ui.item));

                $('#itemname').focus();
            }
        });
        $("#txtEstimate").autocomplete({
            source: "<?php echo site_url('ajaxcall/estimates'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#txtEstimate_id').val(ui.item.sales_id);
                $('#freight').val(ui.item.freight);
                $('#advance').val(ui.item.advance);
                $('#other').val(ui.item.other);
                $('#discount').val(ui.item.discount);
                loadCust(ui);
                load_items(ui.item.sales_id)
                $('[data-toggle="popover"]').popover();
            }
        });
        $('#reference').change(function () {
            calculateGTotal();
        });
        //Tax
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax_item').html(result);
                $('#tax_common').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#godown').html(result);
            }
        });
        $("#itemname").autoComplete({
            minChars: 2,
            cache: false,
            appendTo: '#mainSale',
            source: function (term, response) {
                $('.itemname').attr('data-placement', 'right');
                $('.itemname').popover('toggle');

                //add all atributes.....
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
                        var my = this.$element.attr('wf-popover')
                        return my;
                    },
//                    trigger: 'keydown'
                });

                try {
                    xhr.abort();
                } catch (e) {
                }
                xhr = $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearch/' + $('#rate:checked').val() + '?', {term: term}, function (data) {
                    response(data);
                });
            },
            renderItem: function (item, search) {
                search = search.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
                var re = new RegExp("(" + search.split(' ').join('|') + ")", "gi");
                return '<div class="autocomplete-suggestion" data-val="' + item.label + '"  data-unit_id="' + item.unit_id + '"    data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.MRP + '"  data-srate="' + item.srate + '"  data-mrp="' + item.prate + '"  data-wh_rate="' + item.wh_rate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
            },
            onSelect: function (e, term, item) {
                var MRP = item.data('mrp');
                var price_code = item.data('price_code');
                var currentstk = item.data('currentstk');
                var tax_id = item.data('tax_id');
                var id = item.data('id');
                var commission = item.data('commission');
                var unit_id = item.data('unit_id');
                itemSelect(MRP, item.data('dis'), item.data('srate'), item.data('prate'), item.data('wh_rate'), price_code, currentstk, tax_id, id, commission, unit_id);
            }
        });
        $('.tatalcal').change(function () {
            calculateGTotal();
        })
        $('.price').change(function () {
            rowcalc();
        })
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
        $("#item_qty").keydown(function (e) {
            var prate = getVal("prate_item");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0;
            if (mrp_item != '0' && qty != '0' && prate != 0) {
                dis = parseFloat((mrp_item * qty * prate) / 100);
            }
            $("#dis_amt").val(dis.toFixed(2));
            $("#mrp_item").val(parseFloat(mrp_item).toFixed(2));
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
                $("#mrp_item").focus();
            }

        });
        $("#dis_amt").keydown(function (e) {
            var prate = getVal("dis_amt");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;
            if (mrp_item != '0' && qty != '0' && prate != 0) {
                dis = (prate * 100 / (qty * mrp_item));
            }
            $("#prate_item").val(dis.toFixed(2));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
//                add();
            }
            if (key === 27)
            {
//                add();
//                $("#freight").focus();
            }
            showbtn(1);
        });
        $("#prate_item").keydown(function (e) {
            var prate = getVal("prate_item");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            var dis = 0.00;
            if (mrp_item != '0' && qty != '0' && prate != 0) {
                dis = mrp_item * qty * prate / 100;
            }
            $("#dis_amt").val(dis.toFixed(2));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                add();
            }
            if (key === 27)
            {
                add();
                $("#freight").focus();
            }
            showbtn(1);
        });
        $("#mrp_item").keydown(function (e) {
            var prate = getVal("prate_item");
            var qty = getVal("item_qty");
            var mrp_item = getVal('mrp_item');
            if (mrp_item != '0' && qty != '0' && prate != 0) {
                var dis = mrp_item * qty * prate / 100;
            }
            $("#dis_amt").val(dis.toFixed(2));
            rowcalc();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
//                add();
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
            }
        });
        $('.myspop').popover();


    });
    function remove(btn) {
        var id = $(btn).attr('index');
        var index = getIndexOf(items, id);
        items.splice(index, 1);
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

    function itemSelect(MRP, dis, srate, prate, wh_rate, price_code, currentstk, tax_id, id, commission, unit_id)
    {
        console.log(MRP + "  -- " + dis + "  -- " + srate + "  -- " + prate + "  -- " + wh_rate + "  -- " + price_code + "  -- " + currentstk + "  -- " + tax_id + "  -- " + id + "  -- " + commission + "  -- " + unit_id);
        showbtn(0);
        var is_discount = getVal('is_discount');
        var dprate = getVal('dprate');
        $("#mrp_item").val(MRP);
        $("#pur_rate").val(prate);
        $("#unitvalue").val(MRP);
        if (is_discount === '1') {
            $("#prate_item").val(0);
            if (dis !== undefined && dis !== '') {
                $("#prate_item").val(dis);
            }

        } else
        {
            $("#prate_item").val(srate);
        }
        if (dprate === '1') {
            $("#prate").html('Rate :' + prate);
        } else {
            $("#prate").html('Price Code :' + price_code);
        }

        $("#wholsale").html('wholsale :' + wh_rate);        // $("#current_stock").html('Current Stock :' + currentstk);
        $("#current_stock").addClass('bg-info');
        $("#prate").addClass('bg-info');
        $('#tax_item').val(tax_id);
        $('#item_id').val(id);
        $('#commission').val(commission);
        $('#base_unit').val(unit_id);
        $.ajax({
            url: "<?php echo site_url('ajaxcall/units'); ?>/" + unit_id,
            success: function (result) {
                $('#unit_item').html(result);
                $('#unit_item').val(unit_id);
                $("#item_qty").focus();
            }
        });
        var is_godown = $("#is_godown").val();
        if (is_godown === '1') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/godownstock'); ?>/" + id,
                success: function (result) {
                    $('#godown').html('');
                    $('#godown').html(result);
                    var element = $(this);
                    var myTag = element.attr("stock");
                    $('#current_stock').val(myTag);
                    $("#godown").focus();
                }
            });
        }
    }
</script>
