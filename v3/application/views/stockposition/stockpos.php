
<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/sales/sales/'); ?>" action="<?php echo site_url('transaction/sales/save/'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
   <section class="content"> 
        <div class="row"> 
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#mainSale" data-toggle="tab">Stock Position</a></li>
                        <li><a href="#otherTab" data-toggle="tab">Other Details</a></li>

                       <li class="pull-right"><a href="#SettingsTab" data-toggle="tab"><i class="fa fa-gear"></i></a></li>
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
                                        <td class="col col-lg-1">Date</td>
<!--                                        <td class="col col-lg-1">Delivery Date</td> -->
                                        <td class="col col-lg-1">Branch</td> 
                                        <td>From</td>
                                    </tr>
                                    <tr>
 <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td><!--                                        <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>
                                        <td>  <input name="cdate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date col-lg-1" placeholder="Date"></td>-->
                                        <td> <input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                        <td><input data-validation="required" type="hidden" name="customer_id" id="supid"/>
                                            <input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
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
                                <table class="table table-striped table-condensed" >
                                    <thead>
                                        <tr>
                                            <td>Goods   
                                                <button type="button" url="<?php echo base_url(); ?>items/item/add"  class="btn btn-primary myModalPop">
                                                    New
                                                </button>
                                            </td>
                                            <td>Godown</td>
                                            <td>Packages</td>
                                            <td>Qty</td>
                                            <td>Rate</td>
                                            <td>Total<td> 
                                            <td> <td> 
                                        </tr>

                                    </thead>
                                    <tbody id="rowm">
                                        <tr id="add">

                                            <td class="col-lg-4"> <input  NoTab="true"   id="itemname"    type="text"    class="form-control" placeholder="Item Name"/></td>
                                            <td><select tabindex="-1" id="godown"   class="form-control col-lg-1 "  >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td>
                                            <td> <input   id="item_qty"  type="text" NoTab="true"   class="form-control text-right col-lg-1 two-digits price" placeholder="Quantity"/></td>
                                            <td ><select tabindex="-1"   id="unit_item" class="form-control col-lg-1" >
                                                    <option value="">Select</option> 
                                                </select>
                                            </td> <input id="mrp_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="MRP"/>
                                            
                                                </td>
                                            
                                            <td><input type="hidden" name="commission" id="commission"/>  <input id="mrp_item"   type="text"    class="form-control col-lg-1 text-right two-digits" placeholder="MRP"/></td>
                                            <td> <input id="prate_item"  NoTab="true"    type="text"    class="form-control text-right price col-lg-1 two-digits" placeholder=""/></td>
                                            <td> 
                                                    <input class='form-control col-lg-1 two-digits' id="rowTax" disabled/>
                                                </td>
                                           <td><input class='form-control col-lg-1 two-digits' id="rowTotal" disabled/></td>
                                            <td>

                                                <!--                                        hidden-->
                                                <input type="hidden" name="item_id" id="item_id"/>

                                                <button data-toggle="tooltip" type="button"    title="Add To save"   class="btn btn-success" href="#">
                                                    <span class="glyphicon glyphicon-plus"></span> 
                                                </button>
                                            </td>

                                        </tr>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-striped table-condensed" >

                                    <tr> 
                                        <td class="text-right text-center FontDouble" colspan="7">Total</td>
                                        <td><input type="text"  id="total" name="subtot" readonly="readonly" class="form-control col-lg-1 text-right" placeholder="Total"></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td>Transporting </td>
        <!--                                <td>Advance </td>-->
                                        <td>Coolie</td>
                                        <td>Discount</td>
                                        <td>Vehicle</td>
                                        <td>Round Off</td>
                                        <td>GST</td>                               
                                        <td>Grand Total</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td><input name="freight"id="freight" placeholder="Freight"   type="text"class="tatalcal text-right col-lg-1 form-control" ></td>
                                        <td><input name="other"id="other" placeholder="other charges"   type="text"class="tatalcal text-right col-lg-1 form-control" ></td>
                                        <td><input name="discount"id="discount" placeholder="Discount"   type="text"class="tatalcal text-right col-lg-1 form-control" ></td>
                                        <td><input name="Vehicle"id="Vehicle" placeholder="Vehicle No"   type="text"class="col-lg-1 form-control" ></td>
                                        <td><input name="rount"id="rount" placeholder="Round off" readonly="readonly"   type="text"class="text-right col-lg-1 form-control" ></td>
                                        <td><input name="taxtotal"id="taxtotal" placeholder="Total Tax"  readonly="readonly" type="text"class="text-right col-lg-1 form-control" ></td>
                                        <td><input name="gtotal"id="gtotal" placeholder="Grand Total"  readonly="readonly"  type="text"class="text-right col-lg-1 form-control" ></td>
                                    </tr>
                                </table>

                            </div>

                            <div class="box-footer">  
                                <button id="form-button-save"  type='button' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   

                                <div class='small-loading' id='FormLoading'> </div>

                            </div>
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
                                        <td class="col col-lg-2">Total Value</td>
                                        <td class="col col-lg-2">Credit/unpaid</td>
                                        <td class="col col-lg-2">Older Stock</td>
                                        <td class="col col-lg-1">Total Sales</td>
                                        <td class="col col-lg-1">Total Purchase</td>
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
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter </textarea></td>
                                        <td class="col col-lg-2"><textarea rows="4" cols="50" name="tms_con" form="usrform">Enter text here...</textarea></td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                        <!-- /otherTab -->
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
                                               <!--  <td class="col-lg-4"> <input data-validation="required" type="hidden" name="keyid" id="keyid"/>
                                                <input name="keyname" id="keyname[]" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Key" disabled></td>
                                                 <td class="col-lg-4"> <input  NoTab="true"   id="key_value"  name="key_value"  type="text"    class="form-control" placeholder="Key Value" disabled/></td> -->


                                            </tr>

                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            <!-- /#SettingsTab -->
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
    function item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name) {
        inc_inary = inc_inary + 1;
        this.inc_id = inc_inary;
        this.item_id = item_id;
        this.item_qty = item_qty;
        this.unit_item = unit_item;
        this.godown = godown;
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
        clearValue($("#unit_item"));
        clearValue($("#godown"));
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
        url: "<?php echo site_url('ajaxcall/get_saleskey'); ?>",
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

                        $('#date').val(itemsingle.invoice_date);
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
                        var unit_item = itemsingle.unit_id;
                        var godown = itemsingle.godown;
                        var tax_item = itemsingle.tax_id;
                        var mrp_item = itemsingle.mrp;
                        var prate_item = itemsingle.rate;
                        var itemname = itemsingle.name + ' ' + itemsingle.barcode;
                        var comontax = $("#comontax").val();
                        var is_discount = $("#is_discount").val();
                        var rowTotal = (parseFloat(itemsingle.rate) * parseFloat(itemsingle.quantity)).toFixed(2);
                        if (is_discount === '1') {
                            rowTotal = ((parseFloat(itemsingle.MRP) - (parseFloat(itemsingle.rate) / 100) * parseFloat(itemsingle.MRP)) * parseFloat(itemsingle.quantity)).toFixed(2);
                        }
                        itemsingle.total;
                        var tax_amount = itemsingle.tax;
                        var commission = itemsingle.commission;
                        var unit_name = itemsingle.uname;
                        var godown_name = itemsingle.godown_name;
                        var tax_name = itemsingle.tname;
                        var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name);
                        addrowtoTable(iteadd);
                        items.push(iteadd);
                        $("#rowTotal").val(0.0);
                        calculateGTotal();
                        $("#itemname").focus();
                        ref();
                    });
                }
            });
        }

    }
    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        var commi = 0;
        $.each(items, function (i) {
            total = parseFloat(total) + parseFloat(items[i].rowTotal);
            tax = parseFloat(tax) + parseFloat(items[i].tax_amount);
            commi = parseFloat(commi) + parseFloat(total) * parseFloat(items[i].commission) / 100;
        });
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
        var itemname = $("#itemname").val();
        var comontax = $("#comontax").val();
        var rowTotal = $("#rowTotal").val();
        var tax_amount = $("#rowTax").val();
        var commission = $("#commission").val();
        var tax_name = $("#tax_item option:selected").text();
        var unit_name = $("#unit_item option:selected").text();
        var godown_name = $("#godown option:selected").text();
        var iteadd = new item(item_id, item_qty, godown, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, godown_name, unit_name, tax_name);
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
    }
    function showbtn(id) {
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
    }
    function calculaterow(id) {
        //    itmtax   
        var qty = getVal("itmqty" + id);
        var is_discount = getVal('is_discount');
        var prate_item = getVal('itmrate' + id);
        var mrp_item = getVal('itmmrp' + id);
        var tax = getVal("itmtaxper" + id);
        var total = 0;
        var itm = getIndexOf(items, id);
        var iteadd = items[itm];
        items.splice(itm, 1);
        iteadd.item_qty = qty;
        if (is_discount === '1') {
            mrp_item = parseFloat(mrp_item) - (parseFloat(mrp_item) * parseFloat(prate_item) / 100);
            total = rowtotal(qty, mrp_item);
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
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"  index="' + items.inc_id + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var rowval = td(itemname, 'itemname[]');
        var is_godown = $("#is_godown").val();
        var is_multipleunit = $("#is_multipleunit").val();
        if (is_godown === "1") {

            rowval = rowval + td(items.godown_name);
        }
        rowval = rowval + tde(item_qty, 'item_qty[]', 'col-lg-1 text-right', 'id="itmqty' + idinc + '" onchange=calculaterow(' + idinc + ')');
         if (is_multipleunit === "1") {
        rowval = rowval + td(items.unit_name);
                                      }
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name, 'taxper[]', 'col-lg-1 text-right', 'id="itmtaxper' + idinc + '"');
        }
        rowval = rowval + tde(mrp_item, 'mrp_item[]', 'col-lg-1 text-right', 'id="itmmrp' + idinc + '" onchange=calculaterow(' + idinc + ')') + tde(prate_item, 'prate_item[]', 'col-lg-1 text-right', 'id="itmrate' + idinc + '" onchange=calculaterow(' + idinc + ')');
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'col-lg-1 text-right rtaxtot', 'id="itmtax' + idinc + '"');
        }
        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(godown, 'godown[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'text-right col-lg-1 rtot total', 'id="itmtot' + idinc + '"') + tdhtml(del);
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
            mrp_item = parseFloat(mrp_item) - (parseFloat(mrp_item) * parseFloat(prate_item) / 100);
            total = rowtotal(qty, mrp_item);
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
        is_taxincuded = $("#is_taxincuded").val();
        $('#myModalPop').on('hidden.bs.modal', function (e) {
            alert(insert_primary_key);
            alert(popup_type);
        });
        $(".myModalPop").click(function () {

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
        showbtn(1);
        advance();
        ref();
        $("#form-button-save").click(function () {
            showbtn(0);
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
                loadCust(ui);
                $.ajax({
                    url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
                    success: function (results) {

                        $("#balance").html("Clossing Balance: " + results);
                    }
                });
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
            source: function (term, response) {


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
                return '<div class="autocomplete-suggestion" data-val="' + item.label + '"  data-unit_id="' + item.unit_id + '"    data-commission="' + item.commission + '"  data-val="' + search + '" data-tax_id="' + item.tax_id + '" data-id="' + item.id + '" data-currentstk="' + item.currentstk + '" data-price_code="' + item.price_code + '" data-prate="' + item.MRP + '"  data-srate="' + item.srate + '"  data-mrp="' + item.prate + '"  data-dis="' + item.dis + '"  >' + item.label.replace(re, "<b>$1</b>") + '</div>';
            },
            onSelect: function (e, term, item) {
                var MRP = item.data('mrp');
                var price_code = item.data('price_code');
                var currentstk = item.data('currentstk');
                var tax_id = item.data('tax_id');
                var id = item.data('id');
                var commission = item.data('commission');
                var unit_id = item.data('unit_id');
                itemSelect(MRP, item.data('dis'), item.data('srate'), item.data('prate'), price_code, currentstk, tax_id, id, commission, unit_id);
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

            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
                $("#mrp_item").focus();
            }

        });
        $("#prate_item").keydown(function (e) {
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
        $("#supname").focus();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype') . '/' . $type; ?>",
            success: function (result) {
                $('#btype').html(result);
            }
        });
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

    function itemSelect(MRP, dis, srate, prate, price_code, currentstk, tax_id, id, commission, unit_id)
    {
        console.log(MRP + "  -- " + dis + "  -- " + srate + "  -- " + prate + "  -- " + price_code + "  -- " + currentstk + "  -- " + tax_id + "  -- " + id + "  -- " + commission + "  -- " + unit_id);
        showbtn(0);
        var is_discount = getVal('is_discount');
        var dprate = getVal('dprate');
        $("#mrp_item").val(MRP);
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

        // $("#current_stock").html('Current Stock :' + currentstk);
        $("#current_stock").addClass('bg-info');
        $("#prate").addClass('bg-info');
        $('#tax_item').val(tax_id);
        $('#item_id').val(id);
        $('#commission').val(commission);
        $.ajax({
            url: "<?php echo site_url('ajaxcall/units'); ?>/" + id,
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