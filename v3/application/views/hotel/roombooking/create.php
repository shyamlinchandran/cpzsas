<form method="post" id="frmcreate" enctype="multipart/form-data"  home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hotel/Roombooking/list_all'); ?>" action="<?php echo site_url('hotel/Roombooking/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="book_id" id="book_id"/> 
    <input type="hidden" value="0" id="is_taxinlcuded" name="is_taxinlcuded" />
    <input type="hidden" value="<?php echo $status; ?>" name="book_status" id="book_status"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right"> <a id="back_button" role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hotel/Roombooking/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-10">
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Customer', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="customer_id" name="customer_id"/>
                                        <input name="customer" type="text" id="customer" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Customer">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Address', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="address" class="form-control" name="address" placeholder="Address" type="text" value="" maxlength="15">              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Mobile*', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="phone" class="form-control" name="phone" placeholder="Mobile" data-validation="length" data-validation-length="min10" type="text" value="" maxlength="15">              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Contact No', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="contact" class="form-control" name="contact" placeholder="Contact Number"  type="text" value="" maxlength="15">              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Image', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="file" sub="blah" id="image_a" class="form-control" name="image_a"/>              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Id Proof', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="file" sub="blah_a" id="id_proof_a" class="form-control" name="id_proof_a" />              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Total', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input value="0.00" readonly="readonly" type="text" id="total" class="form-control" name="total" />              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('Advance', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input value="0.00" type="number" step="any" id="advance" class="form-control" name="advance" />              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?php if ($status == 'booking') { ?><?= label('Booking Date', $this, $user) ?> <span class="required"></span>  : <?php } ?>
                                        <?php if ($status != 'booking') { ?><?= label('Chek in Date', $this, $user) ?> <span class="required"></span>  : <?php } ?>


                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="start_date" class="bookdate form-control date" name="start_date" />              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?php if ($status == 'check' || $status == 'booking' || $status == 'Created') { ?><?= label('End Date', $this, $user) ?> <span class="required"></span>  : <?php } ?>
                                        <?php if ($status != 'check' && $status != 'booking' && $status != 'Created') { ?><?= label('Check Out Date', $this, $user) ?> <span class="required"></span>  : <?php } ?>
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" id="end_date" class="bookdate form-control date" name="end_date" />              
                                    </div> 
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label tax_id">
                                        <?= label('No.Of Days', $this, $user) ?> <span class="required"></span>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input readonly="readonly" type="number" id="no_of_days" class="form-control" value="1" name="no_of_days" />              
                                    </div> 
                                </div>
                                <?php if ($status == 'Checkin') { ?>
                                    <div class="col-sm-6 form-group">
                                        <label class="col-sm-4 control-label tax_id">
                                            <?= label('Pending Amount', $this, $user) ?> <span class="required"></span>  :
                                        </label>
                                        <div class="col-sm-8">
                                            <input readonly="readonly" type="number" id="pending_amount" class="form-control" value="1" name="pending_amount" />              
                                        </div> 
                                    </div>
                                <?php } ?>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-sm-12">
                                    Image
                                    <img id="blah" align="middle" width="100" src="<?php echo base_url(); ?>/assets/images/Blank_Club_Website_Avatar_Gray.jpg" height="120" src="#" alt="your image" />
                                </div>
                                <div class="col-sm-12">
                                    Id Proof
                                    <img id="blah_a" align="middle" width="100" src="<?php echo base_url(); ?>/assets/images/Blank_Club_Website_Avatar_Gray.jpg" height="120" src="#" alt="your image" />
                                </div>
                            </div>

                        </div>
                    </div>  
                    <div class="col-sm-12">
                        <table class="table table-striped table-condensed" style="width: 100%">
                            <tr>
                                <td style="width: 8%"><?= label('Floor', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Room Type', $this, $user) ?></td>
                                <td style="width: 13%"><?= label('Room', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Tax%', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Extra Beds', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Room Rate', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Single Bed Rate', $this, $user) ?></td>
                                <td style="width: 8%"><?= label('Extra Bed Rate', $this, $user) ?></td>
                                <td style="width: 13%"><?= label('Tax', $this, $user) ?></td>
                                <td style="width: 13%"><?= label('Total', $this, $user) ?></td>
                                <td style="width: 5%"><?= label('Action', $this, $user) ?></td>
                            </tr>
                            <tr>
                                <td style="width: 8%">
                                    <select id="room_floor" name="room_floor" class="form-control"></select>
                                </td>
                                <td style="width: 8%">
                                    <select  name="room_roomtype" id="room_roomtype"  class="form-control" placeholder="" ></select>
                                </td>
                                <td style="width: 13%">
                                    <input type="hidden" name="room_id" id="room_id"/>
                                    <input type="text"  name="room" id="room" placeholder="Search by Room/Floor" class="form-control" />
                                </td>
                                <td style="width: 8%">
                                    <select  name="tax_id" id="tax_id"  class="form-control" ></select>
                                </td>
                                <td style="width: 8%">
                                    <input type="text" class="form-control  two-digits" id="extra_beds" name="extra_beds"/>
                                </td>
                                <td style="width: 8%">
                                    <input type="text" class="form-control two-digits"  id="rate" name="rate"/>
                                </td>
                                <td style="width: 8%">
                                    <input type="text" readonly="readonly" class="form-control two-digits"  id="single_bed_rate" name="single_bed_rate"/>
                                </td>
                                <td style="width: 8%">
                                    <input type="text" readonly="readonly" class="form-control two-digits"  id="total_bed_rate" name="total_bed_rate"/>
                                </td>

                                <td style="width: 13%">
                                    <input type="text" readonly="readonly" class="form-control two-digits" id="tax" name="tax"/>
                                </td>
                                <td style="width: 13%">
                                    <input readonly="readonly" type="text" class="form-control two-digits" id="row_total" name="row_total"/>
                                </td>
                                <td style="width: 5%">
                                    <a data-toggle="tooltip" style="float: left"
                                       title="Add More" id="addmore" class="btn btn-success"
                                       href="#"> <span class="glyphicon glyphicon-plus"></span>
                                    </a>
                                </td>

                            </tr>
                            <tbody id="tablebody">

                            </tbody>
                            <tr>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 13%">

                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                    <b>Total For One Day:</b>
                                </td>

                                <td style="width: 13%">
                                    <input type="text" readonly="readonly" class="form-control two-digits" id="total_tax" name="total_tax"/>
                                </td>
                                <td style="width: 13%">
                                    <input readonly="readonly" type="text" class="form-control two-digits" id="total_amount" name="total_amount"/>
                                </td>
                                <td style="width: 5%">

                                </td>

                            </tr>
                            <tr>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 13%">

                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                </td>
                                <td style="width: 8%">
                                    <b>Total </b>
                                </td>

                                <td style="width: 13%">
                                    <input type="text" readonly="readonly" class="form-control two-digits" id="total_tax_days" name="total_tax_days"/>
                                </td>
                                <td style="width: 13%">
                                    <input readonly="readonly" type="text" class="form-control two-digits" id="total_amount_days" name="total_amount_days"/>
                                </td>
                                <td style="width: 5%">

                                </td>

                            </tr>
                        </table>
                    </div>
                    <div class="box-footer">    
                        <?php
                        if ($type != 'view') {
                            echo '<button id="form-button-save"  type="button" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                        }
                        ?>      
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
    var idinc = 0;
    function   additem(room__roomtype, room_tax, room_amount, room_bedcost, type, tax_id) {
        $('#room__roomtype').val('');
        $('#room_tax').val('');
        $('#room_amount').val('');
        $('#room_bedcost').val('');
        var newrow = "<tr><td><input type ='hidden' value =" + type + " name='room[]'><input disabled class='form-control'  type ='text' value = " + room__roomtype + "> </td><td><input class='form-control' disabled type ='text' value = " + room_tax + " ><input type='hidden' name='room_tax[]'  value='" + tax_id + "'></td><td><input  class='form-control'  type ='text' value = " + room_amount + " name='room_amount[]'></td><td> <input class='form-control'  type ='text' value =" + room_bedcost + " name='room_bedcost[]'></td><td><span onclick='remove(this)' data-toggle='tooltip'  title='Remove'   class='btn btn-danger remove'   href='#'>  <span class='remove glyphicon glyphicon-remove-sign'></span>     </span></td></tr>"
        $('#addrow').append(newrow);
    }

    function addrowtoTable(floor_name, floor, typename, type, room, room_id, tax, tax_id, extra_beds, rate, single_bed_rate, total_bed_rate, rowtax, row_total) {
        idinc = idinc + 1;
        var newrow = '<tr><td style="width: 8%">' +
                '<input type="text" value="' + floor_name + '" readonly="readonly" class="form-control"/><input type="hidden" value="' + floor + '" name="bok_floor_id[]"></td>' +
                '<td style="width: 8%">' +
                '<input type="text" value="' + typename + '" readonly="readonly" class="form-control"/><input type="hidden" value="' + type + '" name="bok_type_id[]"></td>' +
                '<td style="width: 13%">' +
                '<input type="text" value="' + room + '" readonly="readonly" class="form-control"/><input type="hidden" value="' + room_id + '" name="bok_room_id[]"></td>' +
                '<td style="width: 8%">' +
                '<input type="text" value="' + tax + '" readonly="readonly" class="form-control"/><input type="hidden" value="' + tax_id + '" name="bok_tax_id[]"></td>' +
                '<td style="width: 8%">' +
                '<input type="text" value="' + extra_beds + '" readonly="readonly" class="form-control two-digits" name="bok_extra_beds[]" id="bok_extra_beds' + idinc + '"/></td>' +
                '<td style="width: 8%">' +
                '<input type="text" value="' + rate + '" readonly="readonly" class="form-control two-digits" name="bok_rate[]" id="bok_rate' + idinc + '"/></td>' +
                '<td style="width: 8%">' +
                '<input type="text" value="' + single_bed_rate + '" readonly="readonly" class="form-control two-digits" name="bok_single_bed_rate[]" id="bok_single_bed_rate' + idinc + '"/></td>' +
                '<td style="width: 13%">' +
                '<input type="text" value="' + total_bed_rate + '" readonly="readonly" class="form-control two-digits" name="bok_total_bed_rate[]" id="bok_total_bed_rate' + idinc + '"/></td>' +
                '<td style="width: 13%">' +
                '<input type="text" value="' + rowtax + '" readonly="readonly" class="form-control two-digits bok_tax" name="bok_rowtax[]" id="bok_rowtax' + idinc + '"/></td>' +
                '<td style="width: 13%">' +
                '<input type="text" value="' + row_total + '" readonly="readonly" class="form-control two-digits bok_total" name="bok_row_total[]" id="bok_row_total' + idinc + '"/></td>' +
                '<td style="width: 5%">' +
                '<span onclick="remove(this)" data-toggle="tooltip"  title="Remove"   class="btn btn-danger remove"   href="#">  <span class="remove glyphicon glyphicon-remove-sign"></span></span></td></tr>';
        $('#tablebody').append(newrow);
        calculateGtotal();

    }
    function calculateGtotal() {
        var total = 0;
        var tax = 0;
        $(".bok_total").each(function () {
            total = parseFloat(total) + parseFloat($(this).val());
        });
        $(".bok_tax").each(function () {
            tax = parseFloat(tax) + parseFloat($(this).val());
        });
        $('#total_amount').val(total.toFixed(2));
        var days = $('#no_of_days').val();
        $('#total_tax_days').val(parseFloat(tax * days).toFixed(2));
        $('#total_amount_days').val(parseFloat(total * days).toFixed(2));
        $('#total_tax').val(tax.toFixed(2));
        $('#total').val(total.toFixed(2));
        var advance = $('#advance').val();
        $('#pending_amount').val(parseFloat(total * days) - parseFloat(advance).toFixed(2));

    }

    function remove(btn) {
        $(btn).closest('tr').remove();
        calculateGtotal();
    }

    function rowcalc() {
        var rate = $('#rate').val();
        var bed_rate = $('#single_bed_rate').val();
        var tax = $("#tax_id option:selected").text();
        var extra_bed = $('#extra_beds').val();
        var extra_bed_cost = parseFloat(extra_bed * bed_rate).toFixed(2);
        var total = parseFloat(rate) + parseFloat(extra_bed_cost);
        var is_taxinlcuded = $('#is_taxinlcuded').val();
        var taxamt = parseFloat(total) - ((parseFloat(total) * 100) / (parseFloat(tax) + 100));
        if (is_taxinlcuded === "0") {
            taxamt = parseFloat(total) * parseFloat(tax) / 100;
            total = (parseFloat(total) + parseFloat(taxamt));
        }
        $('#total_bed_rate').val(extra_bed_cost);
         $('#row_total').val(0.00);
         $('#tax').val(0.00);
         if (!isNaN(taxamt)) {
            $('#tax').val(taxamt);
         }
         if (!isNaN(total)) {
             $('#row_total').val(total);
         }
       


    }
    function readURL(input) {
        var sub = $(input).attr('sub');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#' + sub).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#image_a").change(function () {
        readURL(this);
    });
    $("#id_proof_a").change(function () {
        readURL(this);
    });
    function loaddata(id) {
        $.ajax({
            url: "<?php echo site_url('hotel/room/roomtype/'); ?>" + id,
            success: function (result) {
                $('#room_roomtype').html(result);
                var room_bedcost = $('#room_roomtype').find(':selected').attr('room_bedcost');
                var room_amount = $('#room_roomtype').find(':selected').attr('room_amount');
                if (id == 0) {
                    $('#rate').val(room_amount);
                    $('#single_bed_rate').val(room_bedcost);
                    rowcalc();
                }
            }
        });
        if (id === 0) {
            load();

        }

    }
    function clear() {
        $('#room').val('');
        $('#room_id').val('');
        $('#tax_id').val();
        $('#single_bed_rate').val(0);
        $('#total_bed_rate').val(0);
        $('#row_total').val(0);
        $('#tax').val(0);
        $('#extra_beds').val(0);
        $('#rate').val();
    }
    $(document).ready(function () {
        $('#form-button-save').click(function (e) {
            e.preventDefault();
            var formId = "#frmcreate";
            var isValid = $(formId).isValid();
            var image = document.getElementById("image_a").files[0];
            var id_proof = document.getElementById("id_proof_a").files[0];
            if (isValid) {
                var data = new FormData();
                data.append("image_a", image);
                data.append("id_proof_a", id_proof);
                var other_data = $(formId).serializeArray();
                $.each(other_data, function (key, input) {
                    data.append(input.name, input.value);
                });
                $.ajax({
                    url: $(formId).attr('action'),
                    type: "post",
                    data: data,
                    processData: false,
                    contentType: false,
                    cache: false,
                    async: false,
                    success: function (response) {
                        var json = JSON.parse(response);
                        console.log(json);
                        if (json.msg === true) {
                            $("#back_button").trigger("click");
                        } else {

                        }
                    }
                });

            }
        });
        $('.bookdate').change(function () {
            var start = $("#start_date").datepicker("getDate");
            var end = $("#end_date").datepicker("getDate");
            var days = (end - start) / (1000 * 60 * 60 * 24);
            $('#no_of_days').val(days + 1);
            rowcalc();
            calculateGtotal();
        });
        $('#room_roomtype').change(function () {
            var room_id = $('#room_id').val();
            if (room_id !== "") {
                var room_bedcost = $('#room_roomtype').find(':selected').attr('room_bedcost');
                var room_amount = $('#room_roomtype').find(':selected').attr('room_amount');
                $('#rate').val(room_amount);
                $('#single_bed_rate').val(room_bedcost);
                rowcalc();
            }

        });
        $("#customer").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#customer_id').val(ui.item.id);
                $('#address').val(ui.item.address_line1);
                $('#phone').val(ui.item.phone);
            }
        });
        $('#tax_id').change(function () {
            rowcalc();
        });
        $('#extra_beds').keydown(function () {
            rowcalc();
        });
        $("#rate").keydown(function (e) {
            rowcalc();
            var floor_name = $("#room_floor option:selected").text();
            var floor = $('#room_floor').val();
            var typename = $("#room_roomtype option:selected").text();
            var type = $('#room_roomtype').val();
            var room = $('#room').val();
            var room_id = $('#room_id').val();
            var tax = $("#tax_id option:selected").text();
            var tax_id = $('#tax_id').val();
            var extra_beds = $('#extra_beds').val();
            var rate = $('#rate').val();
            var single_bed_rate = $('#single_bed_rate').val();
            var total_bed_rate = $('#total_bed_rate').val();
            var rowtax = $('#tax').val();
            var row_total = $('#row_total').val();
            var key = e.charCode || e.keyCode || 0;
            if (floor !== "" && room_id !== "" && rate > 0 && type !== "") {
                if (key === 13 || key === 9)
                {
                    clear();
                    addrowtoTable(floor_name, floor, typename, type, room, room_id, tax, tax_id, extra_beds, rate, single_bed_rate, total_bed_rate, rowtax, row_total);
                }
            }
        });

//        $("#room").autocomplete({
//            source: "<?php echo site_url('hotel/Roombooking/getrooms'); ?>",
//            minLength: 2,
//            type: 'POST',
//            data: {room_floor: $('#room_floor').val(), room_roomtype: $('#room_roomtype').val(), Start_Date: $('#start_date').val(), End_date: $('#end_date').val()},
//            select: function (event, ui) {
//
//            }
//        });
        $("#room").autocomplete({
            source: function (request, response) {
                $.getJSON(
                        "<?php echo site_url('hotel/Roombooking/getrooms'); ?>",
                        {term: request.term, room_floor: $('#room_floor').val(), room_roomtype: $('#room_roomtype').val(), Start_Date: $('#start_date').val(), End_date: $('#end_date').val()},
                        response
                        );
            },
            minLength: 2,
            select: function (event, ui) {
                $('#room_id').val(ui.item.roomid);
                $('#room_floor').val(ui.item.room_floor);
                $('#room_roomtype').val(ui.item.room_type);
                $('#rate').val(ui.item.room_amount);
                $('#single_bed_rate').val(ui.item.room_bedcost);
                $('#total_bed_rate').val(ui.item.room_bedcost);
                $('#tax_id').val(ui.item.tax_id);
                $('#extra_beds').val(0.00);
                rowcalc();
                loaddata(ui.item.roomid);
            }
        });


        $.ajax({
            url: "<?php echo site_url('hotel/room/tax'); ?>",
            success: function (result) {
                $('#tax_id').html(result);
            }
        });


        $.ajax({
            url: "<?php echo site_url('hotel/room/room_category'); ?>",
            success: function (result) {
                $('#room_category').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('hotel/room/room_floor/'); ?>",
            success: function (result) {
                $('#room_floor').html(result);
            }
        });

        $.ajax({
            url: "<?php echo site_url('hotel/room/tax'); ?>",
            success: function (result) {
                $('#room_tax').html(result);
                loaddata(0);
            }
        });
        $('#addmore').click(function () {
            var type = $('#room_roomtype').val();
            var tax_id = $('#room_tax').val();
            var room__roomtype = $('#room_roomtype option:selected').text();
            var room_tax = $('#room_tax option:selected').text();
            var room_amount = $('#room_amount').val();
            var room_bedcost = $('#room_bedcost').val();
            additem(room__roomtype, room_tax, room_amount, room_bedcost, type, tax_id);
        });
    });
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {
        var id = $('#book_id').val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hotel/Roombooking/getsing'); ?>/" + id,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#customer").val(result.customer_name);
                    $('#customer_id').val(result.customer_id);
                    $("#address").val(result.address_line1);
                    $("#phone").val(result.phone);
                    $("#contact").val(result.booking_phone);
                    $("#total").val(result.booking_amount);
                    $("#advance").val(result.booking_advance);
                    $('#start_date').val(formatDate(result.bok_start_date));
                    $('#end_date').val(formatDate(result.bok_end_date));
                    $('#no_of_days').val(result.no_of_days);
                    $('#blah').attr('src', '<?php echo base_url() . ''; ?>assets/images/' + result.image);
                    $('#blah_a').attr('src', '<?php echo base_url() . ''; ?>assets/images/' + result.id_proof);
                }
            });
            $.ajax({
                url: "<?php echo site_url('hotel/Roombooking/book_details'); ?>/" + id,
                async :false,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var floor_name = $("#room_floor [value=" + itemsingle.floor_id + "]").text();
                        var floor = itemsingle.floor_id;
                        var typename = $("#room_roomtype [value=" + itemsingle.room_type_id + "]").text();
                        var type = itemsingle.room_type_id;
                        var room = itemsingle.room_name;
                        var room_id = itemsingle.room_id;
                        var tax = $("#tax_id [value=" + itemsingle.tax_id + "]").text();
                        var tax_id = itemsingle.tax_id;
                        var extra_beds = itemsingle.extra_beds;
                        var rate = itemsingle.room_rate;
                        var single_bed_rate = itemsingle.extra_bed_rate;
                        var total_bed_rate = itemsingle.total_extra_bed_rate;
                        var rowtax = itemsingle.tax;
                        var row_total = itemsingle.total;
                        addrowtoTable(floor_name, floor, typename, type, room, room_id, tax, tax_id, extra_beds, rate, single_bed_rate, total_bed_rate, rowtax, row_total);
                    });
                }

            });

        }

    }
</script>