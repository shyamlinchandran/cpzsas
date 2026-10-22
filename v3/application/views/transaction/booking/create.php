<?php $comontax = 1;
?>
<form method="post" id="frmcreate" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('transaction/booking/listall'); ?>" action="<?php echo site_url('transaction/booking/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="0" name="id"/>  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Booking</h3>
                    </div>

                    <div class="box-body">
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>Start Date</td>
                                <td>End Date</td>
                                <td>No days</td>
                                <td>Type</td>  
                                <td>No Adults</td>
                                <td>No Children</td> 
                            </tr>
                            <tr>
                                <td>  <input name="sdate" NoTab="true" type="text" id="start_date" data-validation="required"  class="form-control hunpx  caldays date" placeholder="Date"></td>
                                <td>  <input name="edate" NoTab="true" type="text" id="end_date" data-validation="required"   class="form-control hunpx caldays date" placeholder="Date"></td>
                                <td><input name="nodays" tabindex="-1" type="text" id="nodays" data-validation="required"   readonly="true"   class="hunpx form-control" placeholder="Number Of days"></td>
                                <td><select  data-validation="required" id="type"  name="type" class="form-control" >
                                        <option value="Cash">Cash</option> 
                                        <option value="Credit">Credit</option> 
                                    </select> 
                                </td>
                                <td> <input id="no_adults" name="no_adults"   type="text" data-validation="required"   class="form-control hunpx text-right " placeholder="No Adults"/></td>
                                <td> <input id="no_children" name="no_children" type="text" data-validation="required"   class="form-control text-right price hunpx" placeholder="No Children"/></td>

                            </tr>
                        </table>
                        <table class="table table-striped table-condensed" >
                            <tr>
                                <td>Member</td>
                                <td>Phone</td>
                                <td colspan="2">Email</td> 
                            </tr>
                            <tr>
                                <td><input type="hidden" name="memid" id="memid"/>
                                    <input NoTab="true" name="memname" id="name" type="text"  data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Member"></td>
                                <td><input name="phone" type="text" id="phone" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Phone"></td>
                                <td colspan="2"><input name="email" type="text" id="email" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Email"></td>

                            </tr>
                            <tr> 
                                <td colspan="2">Address</td>
                                <td>Address 2</td>
                                <td>Details</td>
                            </tr>
                            <tr>
                                <td colspan="2"><input name="address_line1" type="text"  id="address_line1" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="address line1"></td>
                                <td><input name="address_line2" type="text"  id="address_line2" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="address line2"></td>
                                <td><input name="details" type="text" id="details" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="details"></td>
                            </tr>
                        </table>
                        <form id="clearform">

                            <table class="table table-striped table-condensed" >
                                <thead>
                                    <tr>
                                        <td>Member Category</td>
                                        <td>Room Category</td>
                                        <td>Room</td>
                                        <td>Rate</td>
                                        <td>No Room</td>
                                        <td>Tax%</td>
                                        <td>Tax Amount</td>
                                        <td>Total</td>
                                    </tr> 
                                    <tr>
                                        <td><select  id="member_category"  class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>
                                        <td><select  id="room_category"  class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>
                                        <td><select  id="room_id"  class="form-control" >
                                                <option value="">Select</option> 
                                            </select>
                                        </td>
                                        <td><input type="text"  id="rate" class="two-digits form-control rowcalc hunpx text-right" placeholder="Rate"></td>
                                        <td><input type="text"  id="norooms" class="form-control rowcalc hunpx text-right" placeholder="No Rooms"></td>
                                        <td><input type="text"  id="taxp" class="two-digits form-control rowcalc hunpx text-right" placeholder="Tax %"></td>
                                        <td><input type="text"  id="taxamt" class="form-control rowcalc hunpx text-right" readonly="true" tabindex="-1" placeholder="tax Amount"></td>
                                        <td><input type="text"  id="totalrow" class="two-digits  rowcalc form-control hunpx text-right" readonly="true" placeholder="Total"></td>
                                    </tr>
                                </thead>
                                <tbody id="addroms">

                                </tbody>

                            </table>
                        </form>
                        <table class="table table-striped table-condensed" > 
                            <tr>

                                <td>Other charges</td>
                                <td>Discount</td>
                                <td>Round Off</td>
                                <td>Tax</td>                               
                                <td>Grand Total</td>
                            </tr>
                            <tr>
                                <td><input name="other"id="other" placeholder="other charges"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="discount"id="discount" placeholder="Discount"   type="text"class="tatalcal text-right hunpx form-control" ></td>
                                <td><input name="rount"id="rount" placeholder="Round off" readonly="readonly"   type="text"class="text-right hunpx form-control" ></td>
                                <td><input name="tax"id="taxtotal" placeholder="Total Tax"  readonly="readonly" type="text"class="text-right hunpx form-control" ></td>
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
</form> 

<script type="text/javascript">
    //messages 
    function calert(msg) {
        alert(msg);
    }

    //class
    function item(member_category, member_category_nm, room_category, room_category_nm, room_id, room_id_nm, rate, norooms, taxp, taxamt, totalrow) {
        this.member_category = member_category;
        this.room_category = room_category;
        this.room_id = room_id;
        this.rate = rate;
        this.norooms = norooms;
        this.taxp = taxp;
        this.taxamt = taxamt;
        this.totalrow = totalrow;
        this.member_category_nm = member_category_nm;
        this.room_category_nm = room_category_nm;
        this.room_id_nm = room_id_nm;
    }
    //class array
    var items = new Array();


    function clear() {
        $("#member_category").val('');
        $("#room_category").val('');
        $("#room_id").val('');
        $("#rate").val(0);
        $("#norooms").val(0);
        $("#taxp").val(0);
        $("#taxamt").val(0);
        $("#totalrow").val(0);
    }
    //calculate days 
    function caldays() {
        var start = $('#start_date').datepicker('getDate');
        var end = $('#end_date').datepicker('getDate');
        var days = (end - start) / 1000 / 60 / 60 / 24;
        $("#nodays").val(days);
    }

    function getVal(id) {
        var val = $("#" + id).val();
        if (val === '')
        {
            val = 0;
        }
        return val;

    }
    function calcrow() {
        var rate = $("#rate").val();
        var norooms = $("#norooms").val();
        if (norooms.length === 0)
        {
            norooms = 1;
        }
        var taxp = $("#taxp").val();
        var taxamt = parseFloat(rate) * parseFloat(norooms) * parseFloat(taxp) / 100;
        $("#taxamt").val(taxamt.toFixed(2));
        var totalrow = parseFloat(rate) * parseFloat(norooms) + parseFloat(taxamt);
        $("#totalrow").val(totalrow.toFixed(2))
    }

    function  calculateGTotal() {
        var total = 0;
        var tax = 0;
        $.each(items, function (i) {
            total = parseFloat(total) + parseFloat(items[i].totalrow);
            tax = parseFloat(tax) + parseFloat(items[i].taxamt);
        });
        var other = getVal("other");
        var discount = getVal("discount");

        $("#taxtotal").val(tax);
        var gtotal = parseFloat(total) + parseFloat(other) - parseFloat(discount);

        var rount = (parseFloat(gtotal.toFixed(0)) - parseFloat(gtotal.toFixed(2))).toFixed(2);
        $("#gtotal").val(parseFloat(gtotal.toFixed(0)).toFixed(2));
        $("#rount").val(rount);
    }

    function  validate(room_id) {
        var validate = 0;
        $.each(items, function (i) {
            if (items[i].room_id === room_id)
            {
                validate = 1;
                return validate;
            }
        });
        return validate;
    }
    function insertItems()
    {
        var member_category = getVal("member_category");//$("#member_category").val();
        var member_category_nm = $("#member_category option:selected").text();
        var room_category = getVal("room_category");// $("#room_category").val();
        var room_category_nm = $("#room_category option:selected").text();
        var room_id = getVal("room_id");//$("#room_id").val();
        var room_id_nm = $("#room_id option:selected").text();
        var rate = $("#rate").val();
        var norooms = getVal("norooms");//$("#norooms").val();
        var taxp = $("#taxp").val();
        var taxamt = $("#taxamt").val();
        var totalrow = $("#totalrow").val();
        if (member_category === 0 || room_category === 0 || room_id === 0 || norooms === 0)
        {
            return;
        }
        var iteadd = new item(member_category, member_category_nm, room_category, room_category_nm, room_id, room_id_nm, rate, norooms, taxp, taxamt, totalrow);

        if (validate(room_id) === 0)
        {
            addrowtoTable(iteadd);
            items.push(iteadd);
        }
        else
        {
            $("#itemname").focus();
            calert('item is already exists');
        }
    }
    function addrowtoTable(items) {
        var member_category = items.member_category;
        var member_category_nm = items.member_category_nm;
        var room_category = items.room_category;
        var room_category_nm = items.room_category_nm;
        var room_id = items.room_id;
        var room_id_nm = items.room_id_nm;
        var rate = items.rate;
        var norooms = items.norooms;
        var taxp = items.taxp;
        var taxamt = items.taxamt;
        var totalrow = items.totalrow;
        var del = '<button  type="button" data-toggle="tooltip" onclick="remove(this)"   title="Remove" index="' + room_id + '"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button>';
        var rowval = td(member_category_nm, 'member_category_nm[]')+hidden(member_category,'member_category[]')+hidden(room_category,'room_category[]')
                + td(room_category_nm, 'room_category_nm[]')
                + td(room_id_nm, 'room_id_nm')+hidden(room_id,'room_id[]');
        rowval = rowval + td(rate, 'rate[]', 'hunpx text-right');
        rowval = rowval + td(norooms, 'norooms[]', 'hunpx text-right') + td(taxp, 'taxp[]', 'hunpx text-right');
        rowval = rowval + td(taxamt, 'taxamt[]', 'hunpx text-right');
        rowval = rowval + td(totalrow, 'totalrow[]', 'text-right hunpx total') + tdhtml(del);
        var newRow = tr(rowval);
        $("#addroms").append(newRow);
    }

    function add() {
        insertItems();
        clear();
        calculateGTotal();
        $("#member_category").focus();

    }
    function rowtotal(qty, prate) {
        return (parseFloat(qty) * parseFloat(prate)).toFixed(2);
    }
    ;

    $.validate({
        modules: 'date, security,file'
    });
    $("#form-button-save").click(function () {
        var sms = $('#add').isValid();
        add();
    });
    $(document).ready(function () {
        //focus 
        $(".caldays").change(function () {
            caldays();
        });
        //supplier 
        $("#name").autocomplete({
            source: "<?php echo site_url('ajaxcall/members'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#phone').val(ui.item.phone);
                $('#email').val(ui.item.email);
                $('#address_line1').val(ui.item.address_line1);
                $('#address_line2').val(ui.item.address_line2);
                $('#details').val(ui.item.details);
                $('#memid').val(ui.item.id);
                $('#member_category').focus();
            }
        });
        $('#room_id').change(function () {
            var val = $("#room_id option:selected").attr('price');
            $("#rate").val(val);
            var taxp = $("#room_id option:selected").attr('taxp');
            $("#taxp").val(taxp);
            calcrow();
        });
        $('.rowcalc').change(function () {
            calcrow();
        });
        //Tax
        $.ajax({
            url: "<?php echo site_url('ajaxcall/room_category'); ?>",
            success: function (result) {
                $('#room_category').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/member_category'); ?>",
            success: function (result) {
                $('#member_category').html(result);
            }
        });


        $('#room_category').change(function () {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/room'); ?>",
                data: {'type': $(this).val()},
                success: function (result) {
                    $('#room_id').html(result);
                }
            });
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
        });
        $('.price').change(function () {
            var prate = $("#prate_item").val();
            var qty = $("#item_qty").val();
            $("#rowTotal").val(rowtotal(qty, prate));
        });

        $("#totalrow").keydown(function (e) {

            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                add();
            }
            if (key === 27)
            {
                add();
                $("#other").focus();
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
            if (a[k].id === v) {
                return k;
            }
        }
        return false;
    }





</script>