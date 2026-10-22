<?php
$comontax = 0; // THIS IS FOR COMMON TAX  0 for individual tax 1 common tax 
$taxincprate = 0; //tax inclueded in purchase rate if 0 then not inclueded 1 then included 
$json = json_encode(array('id' => '0'));
$is_discount = 1; //this is for discount then no sales rate 
?> 
<form method="post"  id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/sales/sales8'); ?>" action="<?php echo site_url('transaction/sales/save/estimate'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
    <input type="hidden" value="0" name="p_id"/> 
    <input type="hidden" value="0" name="commi_amt_hi" id="commi_amt_hi"/> 
    <input type="hidden" value="<?php echo $is_discount; ?>" id="is_discount" name="is_discount"/> 
    <input type="hidden" value="<?php echo $dprate; ?>" id="dprate" name="dprate"/>  
    <input type="hidden" value="<?php echo $comontax; ?>"  name="comontax" id="comontax"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Estimate</h3>
                        <span class="pull-right"><button id="btshow" type='button' data-toggle="tooltip"   title='Expand' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-eye-open"></i> </button>   
                            <!--                            <button type="button" class="btn btn-info btn-lg" id="msd">Open Modal</button>-->
                        </span>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>Invoice Date</td>
                                <td>Delivery Date</td> 
                                <td>Type</td>
                                <?php if ($comontax == 1) { ?>
                                    <td>Tax</td>
                                <?php } ?>
                                <td>Reference</td>
                                <td>Estimate Search</td>
                            </tr>
                            <tr>
                                <td>  <input name="date" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date hunpx" placeholder="Date"></td>
                                <td>  <input name="ddate" type="text"  data-validation="length" data-validation-length="min2"   class="form-control date hunpx" placeholder="Date"></td>
                                <td><select name="type" data-validation="required" id="type"  class="form-control">
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
                                <td><select  id="reference"  name="reference" class="form-control" >
                                        <option value="">Select</option> 
                                    </select>
                                </td> 
                                <td><input type="text" id="txtEstimate" class="form-control" name="txtEstimate"/>
                                    <input type="hidden" id="txtEstimate_id" class="form-control" name="txtEstimate_id"/>
                                </td>
                            </tr>
                        </table>
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>Customer </td>
                                <td>Phone</td>
                                <td>Email</td>
                                <td>GST/CST Number</td>
                            </tr>
                            <tr> 
                                <td><input type="hidden" name="customer_id" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                <td><input name="phone" type="text" id="phone"  class="form-control" placeholder="Phone"></td>
                                <td><input name="email" type="text" id="email"    class="form-control" placeholder="Email"></td>
                                <td><input name="cst" type="text" id="cst"     class="form-control" placeholder="CST"></td>
                            </tr>
                            <tr class="dshow">
                                <td>Tin Number </td>
                                <td>Address</td>
                                <td>Address 2</td>
                                <td>Details</td>
                            </tr>
                            <tr class="dshow">
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
                        <p><span id="current_stock" class="span"></span><span id="prate" class="span"></span><span id="commi_amt" class="span pull-right"></span></p>
                        <table class="table table-striped table-condensed" >
                            <thead>
                                <tr>
                                    <td>Item</td>
                                    <td>Qty</td>
                                    <td>Unit</td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td>Tax</td>
                                    <?php } ?>
                                    <td>MRP</td>
                                    <td>  <?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?>Discount % <?php } ?></td>
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
                                    <td> <input   id="item_qty"  type="text" NoTab="true"   class="form-control text-right hunpx two-digits price" placeholder="Quantity"/></td>
                                    <td><select tabindex="-1"   id="unit_item" class="form-control" >
                                            <option value="">Select</option> 
                                        </select>
                                    </td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td><select tabindex="-1" id="tax_item"  class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>
                                    <?php } ?>
                                    <td><input type="hidden" name="commission" id="commission"/>  <input id="mrp_item"   type="text"    class="form-control hunpx text-right two-digits" placeholder="MRP"/></td>
                                    <td> <input id="prate_item"  NoTab="true"    type="text"    class="form-control text-right price hunpx two-digits" placeholder="<?php if ($is_discount != 1) { ?> Sales Rate  <?php } else { ?>Discount % <?php } ?>"/></td>
                                    <?php if (!$comontax == 1) { ?>
                                        <td> 
                                            <input class='form-control hunpx two-digits' id="rowTax" disabled/>
                                        </td>
                                    <?php } ?>
                                    <td><input class='form-control hunpx two-digits' id="rowTotal" disabled/></td>
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
                                <td class="text-right text-center FontDouble" colspan="6">Total</td>
                                <td><input  id="total" name="subtot" readonly="readonly" class="form-control hunpx text-right" placeholder="Total"></td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Transporting </td>
<!--                                <td>Advance </td>-->
                                <td>Coolie</td>
                                <td>Discount</td>
                                <td>Round Off</td>
                                <td>Tax</td>                               
                                <td>Grand Total</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><input name="freight"id="freight" placeholder="Freight"   type="Transporting"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="other"id="other" placeholder="other charges"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="discount"id="discount" placeholder="Discount"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="rount"id="rount" placeholder="Round off" readonly="readonly"   type="text"class="text-right hunpx form-control" ></td>
                                <td><input name="taxtotal"id="taxtotal" placeholder="Total Tax"  readonly="readonly" type="text"class="text-right hunpx form-control" ></td>
                                <td><input name="gtotal"id="gtotal" placeholder="Grand Total"  readonly="readonly"  type="text"class="text-right hunpx form-control" ></td>
                            </tr>
                        </table>

                    </div>

                    <div class="box-footer">  
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   

                        <div class='small-loading' id='FormLoading'> </div>

                    </div>
                    <div class=" hidden">
                        <i class="fa fa-refresh fa-spin"></i>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <input name="advance"id="advance" placeholder="Advance"   type="hidden"class="tatalcal text-right hunpx form-control" > 

</form>
<script type="text/javascript">
    //messages 
    function calert(msg) {
        alert(msg);
    }

    //class
    function item(item_id, item_qty, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, unit_name, tax_name) {
        this.item_id = item_id;
        this.item_qty = item_qty;
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
        this.tax_name = tax_name;
    }
    //class array
    var items = new Array();
    function callsubmit() {
        var i = 0;
        $.each(items, function () {
            i++;
        });
        if (i === 0) {
            $('#form-button-save').attr('disabled', 'disabled');
        }
        else {
            $('#form-button-save').removeAttr('disabled');
        }
    }

    function clear() {
        clearValue($("#item_id"));
        clearValue($("#item_qty"));
        clearValue($("#unit_item"));
        clearValue($("#tax_item"));
        clearValue($("#mrp_item"));
        clearValue($("#prate_item"));
        clearValue($("#itemname"));
        $("#prate").html('');
        $("#current_stock").html('');
        clearValue($("#rowTax"));
        clearValue($("#rowTotal"));

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
    function loadCust(ui) {
        $('#supname').val(ui.item.name);
        $('#supid').val(ui.item.id);
        $('#phone').val(ui.item.phone);
        $('#email').val(ui.item.email);
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
    function load_items(id) {
        if (id !== '0') {
            loadCustByid(id);
            $.ajax({
                url: "<?php echo site_url('ajaxcall/sales_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        $('#txtEstimate_id').val(itemsingle.sales_id);
                        $('#freight').val(itemsingle.freight);
                        $('#advance').val(itemsingle.advance);
                        $('#other').val(itemsingle.other);
                        $('#Invoice').val(itemsingle.invoice);
                        $('#discount').val(itemsingle.dis);
                        $('#reference').val(itemsingle.ref_id);
                        $('.box-title').html(itemsingle.type);
                        var item_id = itemsingle.item_id;
                        var item_qty = itemsingle.quantity;
                        var unit_item = itemsingle.unit_id;
                        var tax_item = itemsingle.tax_id;
                        var mrp_item = itemsingle.MRP;
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
                        var tax_name = itemsingle.tname;
                        var iteadd = new item(item_id, item_qty, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, unit_name, tax_name);
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
            $("#commi_amt").html(commi.toFixed(2));
            $("#commi_amt_hi").val(commi.toFixed(2));
        } else {
            $("#commi_amt").html('');
            $("#commi_amt_hi").val(0);
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
        var iteadd = new item(item_id, item_qty, unit_item, tax_item, mrp_item, prate_item, itemname, comontax, rowTotal, tax_amount, commission, unit_name, tax_name);
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
    function addrowtoTable(items) {
        var item_id = items.item_id;
        var item_qty = items.item_qty;
        var unit_item = items.unit_item;
        var tax_item = items.tax_item;
        var mrp_item = items.mrp_item;
        var prate_item = items.prate_item;
        var itemname = items.itemname;
        var comontax = items.comontax;
        var rowTotal = items.rowTotal;
        var tax_amount = items.tax_amount;
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"   title="Remove" index="' + item_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var rowval = td(itemname, 'itemname[]')
                + td(item_qty, 'item_qty[]', 'hunpx text-right')
                + td(items.unit_name);
        if (comontax === '0') {
            rowval = rowval + td(items.tax_name);
        }
        rowval = rowval + td(mrp_item, 'mrp_item[]', 'hunpx text-right') + td(prate_item, 'prate_item[]', 'hunpx text-right');
        if (comontax === '0') {
            rowval = rowval + td(tax_amount, 'tax_amount[]', 'hunpx text-right');
        }
        rowval = rowval + hidden(item_id, 'item_id[]') + hidden(unit_item, 'unit_item[]') + hidden(tax_item, 'tax_item[]') + td(rowTotal, 'rowTotal[]', 'text-right hunpx total') + tdhtml(del);
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
        }
        else {
            total = rowtotal(qty, prate);
        }
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
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
        modules: 'date, security,file'
    });
    function advance() {
        var adv = $("#type").val();
        if (adv === 'Cash') {
            $("#advance").attr('readonly', 'readonly');
        }
        else
        {
            $("#advance").removeAttr('readonly');
        }
    }
    $(document).ready(function () {
        //focus 
//        $("#msd").click(function () {
//            $.ajax({
//                url: "<?php echo site_url('masters/customers'); ?>",
//                success: function (result) {
//                    $("#modal-content").html(result);
//                    $("#myModal").modal('show');
//                }
//            });
//
//        });

        callsubmit();
        advance();
        $("#type").change(function () {
            advance();
        });
        $("#invoice").focus();
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
            url: "<?php echo site_url('ajaxcall/reference'); ?>",
            success: function (result) {
                $('#reference').html(result);
                if ($("#id").val() !== '0') {
                    load_items($("#id").val());
                }
            }
        });
        //item select for purchase 
        $("#itemname").autocomplete({
            source: "<?php echo site_url('ajaxcall/items'); ?>",
            minLength: 2,
            select: function (event, ui) {
                clear();
                var is_discount = getVal('is_discount');
                var dprate = getVal('dprate');
                $("#mrp_item").val(ui.item.MRP);
                if (is_discount === '1') {
                    $("#prate_item").val(0);
                } else
                {
                    $("#prate_item").val(ui.item.srate);
                }
                if (dprate === '1') {
                    $("#prate").html('Purchase Rate :' + ui.item.prate);
                }
                else {
                    $("#prate").html('Price Code :' + ui.item.price_code);
                }

                $("#current_stock").html('Current Stock :' + ui.item.currentstk);
                $("#current_stock").addClass('bg-info');
                $("#prate").addClass('bg-info');
                $('#tax_item').val(ui.item.tax_id);
                $('#item_id').val(ui.item.id);
                $('#commission').val(ui.item.commission);
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
                $("#freight").focus();
                callsubmit();
            }

        });
        $("#item_qty").keydown(function (e) {

            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
                $("#mrp_item").focus();
            }

        });
        $("#freight").keydown(function (e) {

            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9)
            {
                callsubmit();
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

        });
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
            if (a[k].id === v) {
                return k;
            }
        }
        return false;
    }





</script>