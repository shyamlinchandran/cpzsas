<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0; 
$is_SettngsEnabled = 1;
//tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$json = json_encode(array('id' => '0'));
$cid=$carea='';
?>
<style>
    .box-title{
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/purchase/create'. $type); ?>" action="<?php echo site_url('transaction/purchase/save/'. $type); ?>"  class="form-horizontal">
    <input type="hidden" value="0" name="id" /> 
    <input type="hidden" value="<?php echo $id; ?>" name="p_id" id="p_id"/> 
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <section class="content"> 
        <div class="row">
       <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab"><?php echo $type ?></a></li>
                        <li><a href="#otherTab" data-toggle="tab">Other Details</a></li>
                        <?php if ($is_SettngsEnabled == 1) { ?>
                            <li class="pull-right"><a href="#SettingsTab" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
                        <?php } ?>             
                        <li class="pull-right"> 
                            <div class="input-group" style="width:150px;padding: 4px">
                                <span class="input-group-addon"><i class="glyphicon glyphicon-search"></i></span>
                                <input type="text" id="txtEstimate" style="height:30px !important" class="form-control" name="txtEstimate"/>
                            </div>
                        </li>

                    </ul>
                    <div class="tab-content">
                        <!-- Font Awesome Icons -->
                        <div class="tab-pane active" id="mainSale"> 
                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td class="hunpx">Invoice</td>
                                <td class="hunpx">Date</td>
                                <td class="hunpx">Received</td>
                                <td class="hunpx"> Type</td>
                                <?php if ($comontax == 1) { ?>
                                    <td>Tax</td>
                                <?php } ?>
                                <td>
                                    Supplier  <button type="button" url="<?php echo base_url(); ?>masters/supplier/add"  class="btn btn-primary myModalPop">
                                        New
                                    </button>
                                </td>
                                 <td>Billing Name</td>
                                 <td>Phone Number</td>
                                        <td>Address</td>
                                        
                            </tr>
                            <tr>
                                <td><input name="invoice" data-validation-error-msg="*"  type="text" id="invoice" data-validation="required"    class="form-control hunpx" placeholder="Invoice"></td>
                                <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>
                                <td>  <input name="rdate" type="text" id="rdate" data-validation="required"    class="form-control hunpx date" placeholder="Received Date"></td>
                                <td><select name="type" data-validation="required" id="type"  class="form-control" >
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
                                <td><input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Supplier"></td>
                                <td><input name="billingname" type="text" id="billingname"    class="form-control" placeholder="Billin Name"></td>
                                 <td><input name="phone" type="text" id="phone"  class="form-control" placeholder="Phone"></td>
                                        <td><input name="address" type="text" id="address"    class="form-control" placeholder="Email"></td>

                            </tr>
                        </table>
                        <table class="table table-striped table-condensed" style="display: none" >
                            <tr>

                                <td>Phone</td>
                                <td>Email</td>
                                <td>GST</td>
                            </tr>
                            <tr> 
                                <td><input name="phone" type="text" id="phone"    class="form-control" placeholder="Phone"></td>
                                <td><input name="email" type="text" id="email"    class="form-control" placeholder="Email"></td>
                                <td><input name="cst" type="text" id="cst"    class="form-control" placeholder="CST"></td>
                            </tr>
                            <tr>
                                <td>GST Number </td>
                                <td>Address</td>
                                <td>Address 2</td>
                                <td>Details</td>
                            </tr>
                            <tr>
                                <td><input name="tin" type="text" id="tin"    class="form-control" placeholder="Tin"></td>
                                <td><input name="address_line1" type="text"  id="address_line1"    class="form-control" placeholder="address line1"></td>
                                <td><input name="address_line2" type="text"  id="address_line2"    class="form-control" placeholder="address line2"></td>
                                <td><input name="details" type="text" id="details"    class="form-control" placeholder="details"></td>
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
                        <p><span id="current_stock" class="col col-md-2"></span><span id="prate" class="center"></span> <span class="span  pull-right" id="balance" ></span> </p>

                        <table class="table table-striped table-condensed" >
                            <thead>
                                <tr>
                                    <td>
                                        Item
                                        <button type="button" url="<?php echo base_url(); ?>items/item/add"  class="btn btn-primary myModalPop">
                                            New
                                        </button>
                                    </td>
                                    <td>Qty</td>
									<td>Godown</td>
                                    <td>Unit</td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td>GST</td>
                                    <?php } ?>
                                    <td>MRP</td>
                                    <td>Discount %</td>
                                    <td>Purchase Rate</td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td>Tax Amount</td>
                                    <?php } ?>
                                    <td>Total<td> 
                                    <td> <td> 
                                </tr>

                            </thead>
                            <tbody id="rowm">
                                <tr id="add">
                                    <td> <input  NoTab="true"   id="itemname"    type="text"    class="form-control" placeholder="Item Name"/></td>
                                    <td> <input   id="item_qty"  type="text"    class="form-control text-right hunpx two-digits price" placeholder="Quantity"/></td>
                                      <td><select tabindex="-1" id="godown"  class="form-control col-lg-1" >
                                                        <option value="">Select</option> 
                                                    </select>
                                                </td>
									<td><select    id="unit_item" class="form-control" tabindex="-1" >
                                            <option value="">Select</option> 
                                        </select>
                                    </td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td><select  id="tax_item"  class="form-control" tabindex="-1" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>
                                    <?php } ?>
                                    <td> <input id="mrp_item"   type="text"    class="form-control hunpx text-right two-digits" placeholder="MRP"/></td>
                                    <td> <input id="dis_item"   type="text"    class="form-control hunpx text-right two-digits" placeholder="Discount"/></td>
                                    <td> <input id="prate_item"  NoTab="true"    type="text"    class="form-control text-right price hunpx two-digits" placeholder="Purchase Rate"/></td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td> 
                                            <input class='form-control hunpx two-digits' id="rowTax" readonly="readonly" tabindex="-1"/>
                                        </td>
                                    <?php } ?>
                                    <td><input class='form-control hunpx two-digits' id="rowTotal" readonly="readonly" tabindex="-1"/></td>
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
                        <table class="table table-striped table-condensed" >

                            <tr> 
                                <td class="text-right text-center FontDouble" colspan="5">Total</td>
                                <td><input  id="total" name="subtot" readonly="readonly" tabindex="-1" class="form-control hunpx text-right" placeholder="Total"></td>

                            </tr>
                            <tr>
                                <td>Freight </td>
                                <td>Other charges</td>
                                <td>Discount</td>
                                <td>Round Off</td>
                                <td>GST</td>                               
                                <td>Grand Total</td>
                            </tr>
                            <tr>
                                <td><input name="freight"id="freight" placeholder="Freight"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="other"id="other" placeholder="other charges"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="discount"id="discount" placeholder="Discount"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="rount"id="rount" placeholder="Round off" readonly="readonly"   type="text"class="text-right hunpx form-control" ></td>
                                <td><input name="taxtotal"id="taxtotal" placeholder="Total Tax"  readonly="readonly" type="text"class="text-right hunpx form-control" ></td>
                                <td><input name="gtotal"id="gtotal" placeholder="Grand Total"  readonly="readonly"  type="text"class="text-right hunpx form-control" ></td>
                            </tr>
                        </table>

                    </div>

                    <div class="box-footer">  
                        <?php if ($view != 'view') { ?>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   

                            <div class='small-loading' id='FormLoading'> </div>
                        <?php } ?>
                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
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
                                                <option value="">select</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="route"  name="route" class="form-control">
                                                <option value="">route</option> 
                                            </select>
                                        </td> 
                                        <td><select  id="vehicle" name="vehicle" class="form-control">
									
                                                <option value="">vehicle</option> 
                                            </select>
                                        </td> 
                                        <td>  <input name="coolie" type="text"   class="form-control  col-lg-1"   placeholder="Coolie"></td>
                                        <td>  <input name="frieght" type="text"   class="form-control  col-lg-1"  placeholder="Frieght"></td>
                                    </tr>
                                </table>
                                </br>

                                <table class="table table-striped table-condensed" >
                                    <tr>
                                        <td class="col col-lg-8">Terms And Conditions</td>
                                        <td class="col col-lg-8">Despatch Details</td>
                                    </tr>
                                    <tr>
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">
                                             Enter </textarea></td>
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">
                                                 Enter text here...</textarea></td>
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
                                            <td></td>
                                            <td></td>                                      
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>                                      
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td></td>                                      
                                        </tr>
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
    </section>
</form> 
<script type="text/javascript">
    //messages 
    function calert(msg) {
        alert(msg);
    }
    var inc_inary = 0;
    //class
    function item(dis_item, item_id, item_qty,godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission,godown_name, unit_name, tax_name) {
        inc_inary = inc_inary + 1;
        this.inc_id = inc_inary;
        this.dis_item = dis_item;
        this.item_id = item_id;
        this.item_qty = item_qty;
		this.godown=godown;
        this.unit_item = unit_item;
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
    }
    //class array
    var items = new Array();


    function clear() {
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
		 clearValue($("#godown"));
        clearValue($("#unit_item"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        clearValue($("#rowTotal"));
        clearValue($("#rowTax"));
        clearValue($("#dis_item"));
    }
    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0
        }
        return val;

    }
    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        $.each(items, function (i) {
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
        });
        $("#total").val(total.toFixed(2));
        $("#taxtotal").val(tax.toFixed(2));
        var freight = getVal("freight");
        var other = getVal("other");
        var discount = getVal("discount");
//+ parseFloat(tax)
        var gtotal = parseFloat(total) + parseFloat(freight) - parseFloat(discount);
        var rount = (parseFloat(gtotal.toFixed(0)) - parseFloat(gtotal.toFixed(2))).toFixed(2);

        $("#gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
        $("#rount").val(rount);
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
        var dis_item = $("#dis_item").val();
        var item_qty = $("#item_qty").val();
        var unit_item = $("#unit_item").val();
		var godown = $("#godown").val();
        var tax_item = $("#tax_item").val();
        var mrp_item = $("#mrp_item").val();
        var prate_item = $("#prate_item").val();
        var itemname = $("#itemname").val();
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
		var godown_name = $("#godown option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var tax_name = $("#tax_item option:selected").text();
        var iteadd = new item(dis_item, item_id, item_qty,godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, '',godown_name , unit_name, tax_name);
        addrowtoTable(iteadd);
        items.push(iteadd);
    }
    function addrowtoTable(items) {
        var dis_item = items.dis_item;
        var item_id = items.item_id;
        var unit_item = items.unit_item;
		var godown = items.godown;
        var item_qty = items.item_qty;
        var tax_item = items.tax_item;
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"   title="Remove" index="' + items.inc_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var rowval = td(itemname, 'itemname[]')
                + td(item_qty, 'item_qty[]', 'hunpx text-right')
                + td(items.godown_name)+td(items.unit_name);
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name);
        }
        rowval = rowval + td(mrp_item, 'mrp_item[]', 'hunpx text-right') + td(dis_item, 'dis_item[]', 'hunpx text-right') + td(prate_item, 'prate_item[]', 'hunpx text-right');
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'hunpx text-right');
        }
        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'text-right hunpx total') + tdhtml(del);
        var newRow = tr(rowval);
        $("#rowm").append(newRow);
    }

    function add() {
        insertItems();
        clear();
        calculateGTotal();
        $("#itemname").focus();

    }
    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(2);
    }

    $.validate({
        modules: 'date, security,file'
    });
    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#supname').val(result.name);
                $('#supid').val(result.id);
                $('#phone').val(result.phone);
                $('#email').val(result.email);
                $('#cst').val(result.cst);
                $('#tin').val(result.tin);
                $('#address_line1').val(result.address_line1);
                $('#address_line2').val(result.address_line2);
                $('#details').val(result.details);
            }
        });
    }
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {

        var id = $('#p_id').val()

        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/purchase'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        loadCustByid(itemsingle.supplier_id);
                        $('#billingname').val(itemsingle.billing_name);
                        $('#date').val(formatDate(itemsingle.date));
                        $('#rdate').val(formatDate(itemsingle.rdate));
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#other').val(itemsingle.other);
                        $('#invoice').val(itemsingle.invoice);
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('.box-title').html(itemsingle.type);
						$('#area').val(itemsingle.area);
						$('#salesman').val(itemsingle.salesman);
						$('#route').val(itemsingle.route);
						$('#vehicle').val(itemsingle.vehicle);
                        var dis_item = itemsingle.discount;
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var unit_item = itemsingle.unit_id;
						var godown = itemsingle.godown;
                        var tax_item = itemsingle.tax_id;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var tax_amount = itemsingle.tax;
                        var rowTotal = (((parseFloat(itemsingle.rate) - parseFloat(itemsingle.rate) * parseFloat(itemsingle.discount) / 100) * parseFloat(itemsingle.quantity)) + parseFloat(tax_amount)).toFixed(2);
                        itemsingle.total;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
						var godown_name=itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var iteadd = new item(dis_item, item_id, item_qty,godown,unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission,godown_name, unit_name, tax_name);
                        addrowtoTable(iteadd);
                        items.push(iteadd);
                        $("#rowTotal").val(0.0);
                        calculateGTotal();
                        $("#itemname").focus();

                    });

                }
            });
        } else {
            $("#invoice").focus();
        }

    }

    $(document).ready(function () {

        $(".myModalPop").click(function () {
            $('#modal-body').html('');
            $.ajax({
                url: $(this).attr('url'),
                success: function (result) {
                    $('#modal-body').html(result);
                    $('.crmc').removeClass();
                    $('#cfooter').hide();
                    $('.createheader').hide();
                    $('#myModalPop').modal();
                }
            });
        });

        
		        $.ajax({
            url: "<?php echo site_url('ajaxcall/area'); ?>",
            success: function (result) {
                $('#area').html(result);
            }
        });
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            success: function (result) {
                $('#salesman').html(result);
            }
        });
		 $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#godown').html(result)
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
        //supplier 
        $("#supname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers/sup'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#supid').val(ui.item.id);
                $('#phone').val(ui.item.phone);
                $('#phone').val(ui.item.phone);
                $('#billingname').val(ui.item.name);
                $('#email').val(ui.item.email);
                $('#cst').val(ui.item.cst);
                $('#tin').val(ui.item.tin);
                $('#address').val(ui.item.address_line1);
                $('#address_line2').val(ui.item.address_line2);
                $('#details').val(ui.item.details);
                $('#itemname').focus();
				$('#vehicle').val(ui.item.cid);
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function (results) {

                        $("#balance").html("Clossing Balance: " + results);
                    }
                });
            }
        });
        //Tax
        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax_item').html(result);
                $('#tax_common').html(result);
            }
        });
        //item select for purchase 
        $("#itemname").autocomplete({
            source: "<?php echo site_url('ajaxcall/items'); ?>",
            minLength: 2,
            select: function (event, ui) {
                clear();
                $("#mrp_item").val(ui.item.MRP);
                $("#prate_item").val(ui.item.prate);
                $('#tax_item').val(ui.item.tax_id);
                $('#item_id').val(ui.item.id);
                $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                $("#prate").html('Rate :' + ui.item.prate);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.id,
                    success: function (result) {
                        $('#unit_item').html(result);
                        $('#unit_item').val(ui.item.unit_id);
                        $("#item_qty").focus();
                    }
                });
            }
        });
        $('.tatalcal').change(function () {
            calculateGTotal();
        })
        $('.price').change(function () {
            var prate = $("#prate_item").val();
            var qty = $("#item_qty").val();
            $("#rowTotal").val(rowtotal(qty, prate));
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
            if (key === 13) {
                return false;
            }
            if (key === 27)
            {
                $("#freight").focus();
            }


        });
        $("#prate_item").keydown(function (e) {
            var prate = $("#prate_item").val();
            var prates = $("#prate_item").val();
            var qty = $("#item_qty").val();
            var dis_item = $("#dis_item").val();
            var tax_name = $("#tax_item option:selected").attr('percent');
            if (dis_item !== '') {
                prate = parseFloat(prate) - (parseFloat(prate) * parseFloat(dis_item) / 100);
            }
            var rowTax = parseFloat(rowtotal(qty, prate)) * parseFloat(tax_name) / 100;
            var tot = parseFloat(rowtotal(qty, prate)) + parseFloat(rowTax);
            $("#rowTotal").val(tot.toFixed(2));
            $("#rowTax").val(rowTax.toFixed(2));
            var key = e.charCode || e.keyCode || 0;

            if (key === 13 || key === 9) {
                $("#prate_item").val(parseFloat(prates).toFixed(2));
                add();
            }
            if (key === 27)
            {
                $("#prate_item").val(parseFloat(prates).toFixed(2));
                add();
                $("#freight").focus();
            }

        });
		load();
    })
	
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

</script>