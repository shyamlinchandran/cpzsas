 
<form method="post"  id="frmcreate"  back="<?php echo site_url('tai/trans/create'); ?>" action="<?php echo site_url('tai/trans/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/>    
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Items</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr> 
                                <td>Date</td>
                                <td>Delivery Date</td> 
                                <td>Delivery Time</td> 
                                <td>Invoice</td>
                            </tr>
                            <tr>
                                <td>  <input name="date" type="text" id="date" data-validation="required" class="form-control hunpx date" placeholder="Date"></td>
                                <td>  <input name="rdate" type="text" id="rdate" data-validation="required"    class="form-control hunpx date" placeholder="Delivery Date"></td>
                                <td>  <input name="dtime" type="text" id="dtime" data-validation="required"    class="form-control hunpx" placeholder="Delivery Time"></td>
                                <td>  <input name="invoice" type="text" id="invoice"  readonly="readonly"    class="form-control hunpx" placeholder="New"></td>

                            </tr>
                        </table>
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>Customers </td>
                                <td>Phone</td>
                                <td>Address</td>
                            </tr>
                            <tr> 
                                <td><input type="hidden" name="supid" id="supid"/><input name="supname" id="supname" type="text" NoTab="true"    data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Customer"></td>
                                <td><input name="phone" type="text" id="phone"    class="form-control" placeholder="Phone"></td>
                                <td><input name="address_line1" type="text"  id="address_line1"    class="form-control" placeholder="address line1"></td>
                            </tr>

                        </table>
                        <table class="table table-striped table-condensed" >
                            <thead>
                                <tr>
                                    <td>Item</td>
                                    <td>Rate</td> 
                                    <td>Qty</td> 
                                    <td>Size</td> 
                                    <td>Measurements </td> 
                                    <td>Extra</td> 
                                    <td class="col-xs-2">Total</td> 
                                    <td></td> 
                                </tr>

                            </thead>
                            <tbody id="rowm">
                                <tr id="add">
                                    <td class="col-xs-2"> <input type="hidden" id="itid"/> <input  NoTab="true"   id="itemname"    type="text"    class="form-control" placeholder="Item Name"/></td>
                                    <td> <input   id="rate"  type="text"    class="form-control text-right hunpx two-digits price" placeholder="Rate"/></td>
                                    <td> <input   id="item_qty"  type="text"    class="form-control text-right hunpx two-digits price" placeholder="Quantity"/></td>
                                    <td class="col-xs-2"> 
                                        <select id="siz_id" name="siz_id">
                                            <option value="0">Select</option>
                                            <?php foreach ($size as $s) { ?>
                                                <option value="<?php echo $s['siz_id']; ?>" mes="<?php echo $s['messurement']; ?>"><?php echo $s['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </td> 
                                    <td class="col-xs-6"> <textarea id="mesures" style="width: 100%"></textarea></td>
                                    <td> <textarea id="extra"></textarea></td>
                                    <td></td> 
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
                                <td>Total<input name="gtotal" type="text" id="total"  /></td>
<!--                                <td>Discount <input name="discount" type="text" id="discount"  /></td> 
                                <td>Round <input name="round" type="text" id="round"  /></td> 
                                <td>G Total <input name="gtotal" type="text" id="gtotal"  /></td> -->
                                <td></td> 
                                <td></td>  
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
</form>
<script type="text/javascript">
    var items = new Array();
    function item(item_id, item_name, rate, qty, messurement, exta, siz_id = 0, size) {
        this.item_id = item_id;
        this.item_name = item_name;
        this.rate = rate;
        this.qty = qty;
        this.messurement = messurement;
        this.exta = exta;
        this.siz_id = siz_id;
        this.size = size;
        this.total = (parseFloat(qty) * parseFloat(rate)).toFixed(2);
    }
    function remove(btn) {
        var id = $(btn).attr('index'); 
        var index = getIndexOf(items, id); 
        items.splice(index, 1); 
        calculateGTotal(); 
        $(btn).closest('tr').remove();
    }
    function calculateGTotal() {
        var total = 0;
        $.each(items, function (i) {
            total = parseFloat(total) + parseFloat(items[i].total);
        });
        $("#total").val(total.toFixed(2));
//        var discount = $("#discount").val();
//         $("#total").val(total.toFixed(2))
    }
    function additem(item) {
        var item_id = item.item_id;
        var item_name = item.item_name;
        var rate = item.rate;
        var qty = item.qty;
        var messurement = item.messurement;
        var exta = item.exta;
        var size = item.size;
        var siz_id = item.siz_id;
        var total = item.total;
        var rowval = hidden(item_id, 'item_id[]');
        rowval += hidden(siz_id, 'siz_id[]');
        rowval += td(item_name, 'item_name[]');
        rowval += td(rate, 'rate[]');
        rowval += td(qty, 'qty[]');
        rowval += td(size, 'size[]');
        rowval += td(messurement, 'messurement[]');
        rowval += td(exta, 'exta[]');
        rowval += td(total, 'total[]', 'col-xs-2');
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"   title="Remove" index="' + item_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        rowval += tdhtml(del);
        var newRow = tr(rowval);
        $("#rowm").append(newRow);
    }
    function load() {
        var id = $('#id').val();
        if (id !== '0') {
            $.ajax({
                url: "<?php echo site_url('tai/trans/getSales'); ?>/" + id,
                success: function (result) {
                    var data = JSON.parse(result)[0];
                    $("#date").val(data.in_date);
                    $("#rdate").val(data.del_date);
                    $("#dtime").val(data.dtime);
                    $("#invoice").val(data.invoice);
                    $('#supid').val(data.thacu_id);
                    $("#supname").val(data.name);
                    $('#phone').val(data.phone);
                    $('#address_line1').val(data.address);
                    $('#itemname').focus();
                    $.ajax({
                        url: "<?php echo site_url('tai/trans/getSalesItems'); ?>/" + id,
                        success: function (result) {
                            $.each(JSON.parse(result), function (i, itemsingle) {
                                $("#siz_id").val(itemsingle.siz_id);
                                var itemss = new item(itemsingle.item_id, itemsingle.name, itemsingle.rate, itemsingle.qty, itemsingle.messurement, itemsingle.extra, itemsingle.siz_id, $("#siz_id option:selected").text());
                                additem(itemss);
                                items.push(itemss);
                                clear();
                                calculateGTotal();
                                $('#itemname').focus();
                            });
                        }
                    });
                }
            });
        }
    }
    $(document).ready(function () {
        load();
        $("#supname").autocomplete({
            source: "<?php echo site_url('tai/trans/cust'); ?>",
            select: function (event, ui) {
                $('#supid').val(ui.item.thacu_id);
                $('#phone').val(ui.item.phone);
                $('#address_line1').val(ui.item.address);
                $('#itemname').focus();
            }
        });
        $("#itemname").autocomplete({
            source: "<?php echo site_url('tai/trans/items'); ?>",
            minLength: 2,
            select: function (event, ui) {
                var id = $('#supid').val();
                if (id === '') {
                    $('#supname').focus();
                }
                else {
                    $.ajax({
                        url: "<?php echo site_url('tai/trans/msmentsingle'); ?>/" + id + "/" + ui.item.thait_id,
                        success: function (result) {
                            var data = JSON.parse(result);
                            $("#mesures").val(data.messurement);
                        }
                    });
                }
                $("#itid").val(ui.item.thait_id);
                $("#rate").val(ui.item.rate);
                $('#item_qty').focus();
            }
        });
        $("#siz_id").change(function () {
            $("#mesures").val($("#siz_id option:selected").attr('mes'));
        });
        $("#extra").change(function () {
            var itemss = new item($("#itid").val(), $("#itemname").val(), $("#rate").val(), $("#item_qty").val(), $("#mesures").val(), $("#extra").val(), $("#siz_id").val(), $("#siz_id option:selected").text());
            additem(itemss);
            items.push(itemss);
            clear();
            calculateGTotal();
            $('#itemname').focus();
        });
    });
    function clear() {
        $("#itid").val('');
        $("#itemname").val('');
        $("#rate").val('');
        $("#item_qty").val('');
        $("#mesures").val('');
        $("#extra").val('');
        $("#siz_id").val(0);
    }
    function getIndexOf(a, v) {
        var l = a.length;
        for (var k = 0; k < l; k++) { 
            if (a[k].item_id === v) {
                return k;
            }
        }
        return false;
    }

</script>