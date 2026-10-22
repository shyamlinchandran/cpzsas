<form method="post"  id="frmcreatemodelc" back="<?php echo site_url('sales_vehicle/Sales_vehicle/listall'); ?>" action="<?php echo site_url('sales_vehicle/Sales_vehicle/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Sales Vehicle', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('sales_vehicle/Sales_vehicle/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('sales_vehicle/Sales_vehicle/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <input type="hidden" name="invoice" id='invoice'/>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <span style="text-align: left;padding-bottom: 20px;font-size: 20px;" id="invoice_no"></span>
                            </div>
                            <div class="col-sm-3">
                                <input type="text" name="date" id="date" data-validation='required'  class="form-control date" > 
                            </div>
                            <div class="col-sm-3">
                                <input type="text" placeholder="Trip From" style="width: 100%" name="trip_from" data-validation='required' id="trip_from" data-validation='required'   > 
                            </div>
                            <div class="col-sm-3">
                                <input type="text" placeholder="Trip To" style="width: 100%" name="trip_to" data-validation='required' id="trip_to"  data-validation='required'  > 
                            </div>
                        </div>
                        <div class="col-sm-12  ">

                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Bill Type </label>
                                <select type="hidden"  id="btype" data-validation="required" name="btype" class="form-control " >                                            
                                </select>
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Pay Type </label>
                                <select id="pay_type" name="pay_type" class="form-control ">
                                    <option value="Cash" >Cash</option>
                                    <option value="Credit" >Credit</option>
                                </select>
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label"   for="inputDefault">Vehicle Number </label>
                                <input type="text" style="width: 100%" name="vehicle" data-validation='required' id="vehicle"    > 
                                <input type="hidden" id='vehicle_id' name="vehicle_id">
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label"   for="inputDefault">Driver Name </label>
                                <select style="width: 100%"   name="driver" id="driver" data-validation='required'>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Cost Center </label>
                                <select  id="Costcenter"  name="Costcenter"  class="form-control" >
                                    <option value="">Select</option> 
                                </select>
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Started Date </label>
                                <input type="text" name="startdate" id="startdate"  data-validation='required' class="form-control date" > 
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Ending Date </label>
                                <input type="text" name="enddate" id="enddate" data-validation='required'  class="form-control date" > 
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Total Days </label>
                                <input type="number" step="any" name="tot_days" id="tot_days" data-validation='required'  class="form-control" > 
                            </div>

                        </div>
                        <br><br><br>
                        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <label class="col-form-label"   for="inputDefault">Customer Name </label><br />
                                <input type="hidden" id='customer_id' name="customer_id">
                                <input style="width: 100%" type="text"  data-validation='required' name="customer" id="customer" > 
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Starting Kilometers </label><br />
                                <input style="width: 100%" type="number" step="any" class="calckm" data-validation='required' name="startkm" id="startkm" > 
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Ending Kilometers </label><br />
                                <input style="width: 100%" type="number" step="any" class="calckm" data-validation='required' name="endkm" id="endkm" > 
                            </div>
                            <div class="col-sm-3  ">
                                <label class="col-form-label"   for="inputDefault">Total Kilometers </label><br />
                                <input style="width: 100%" value="0.00" type="number" step="any" class="calckm"  name="totalkm" id="totalkm" > 
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <!--                            <div class="col-sm-3">
                                                            <label class="col-form-label"   for="inputDefault">From</label><br />
                                                            <input type="text" style="width: 100%" name="from" data-validation='required' id="from"    > 
                                                            <select name="from_id" id="from_id"></select>
                                                        </div>-->
                            <div class="col-sm-3">
                                <label class="col-form-label"   for="inputDefault">Fare</label><br />
                                <input style="width: 100%" class="calc" type="number" step="any" data-validation='required' name="fare" id="fare" > 
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label"   for="inputDefault">Tax </label><br/>
                                <select style="width: 100%" class="calc"  name="tax" id="tax" data-validation='required'>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <label class="col-form-label"   for="inputDefault">Other Charges  </label><br/>
                                <input style="width: 100%" value="0.00" class="calc" type="number" step="any" name="othercharges"  id="othercharges"  > 
                            </div>
                            <div class="col-sm-2" style="display: none">
                                <label class="col-form-label"   for="inputDefault">Tax Amount  </label><br/>
                                <input style="width: 100%"  readonly="readonly" value="0.00"  type="number" step="any" name="tax_amt"  id="tax_amt"  > 
                            </div>
                            <div class="col-sm-3">
                                <label class="col-form-label"   for="inputDefault">Total</label><br/>
                                <input style="width: 100%"   readonly="readonly" type="number" value="0.00" step="any" name="total" id="total" > 
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label class="col-form-label"   for="inputDefault">Description</label>
                                <textarea style="width: 100%"  data-validation="required" name="description" data-validation='required' id="description"  ></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer popuphide">
                        <?php if ($view != 'view') { ?>
                            <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        <?php } ?>
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
        </div>
        <!-- /.row -->
    </section>
</form>

<script>
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {
        var id = $('#id').val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('sales_vehicle/Sales_vehicle/getsing'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        $('#trip_from').val(itemsingle.trip_from);
                        $('#trip_to').val(itemsingle.trip_to);
                        $('#btype').val(itemsingle.bill_type);
                        $('#pay_type').val(itemsingle.pay_type);
                        $('#Costcenter').val(itemsingle.Costcenter);
                        $('#startdate').val(formatDate(itemsingle.trip_startdate));
                        $('#enddate').val(formatDate(itemsingle.trip_enddate));
                        $('#date').val(formatDate(itemsingle.invoice_date));
                        $('#vehicle').val(itemsingle.vehicle);
                        $('#vehicle_id').val(itemsingle.vehicle_id);
                        $('#invoice_no').html('INVOICE :' + itemsingle.invoice);
                        $('#customer').val(itemsingle.customer);
                        $('#customer_id').val(itemsingle.customer_id);
                        $('#startkm').val(itemsingle.trip_startkm);
                        $('#endkm').val(itemsingle.trip_endkm);
                        $('#totalkm').val(itemsingle.endkm - itemsingle.trip_startkm);
                        $('#description').val(itemsingle.trip_description);
                        $('#fare').val(itemsingle.trip_fare);
                        $('#tax').val(itemsingle.trip_tax);
                        $('#othercharges').val(itemsingle.trip_othercharges);
                        $('#tax_amt').val(itemsingle.trip_taxamt);
                        $('#trip_total').val(itemsingle.trip_taxamt);
                        $('#invoice').val(itemsingle.invoice);
                        loaddriver(itemsingle.vehicle_id, itemsingle.trip_driver)
                    });
                }
            });

        }

    }

    function loaddriver(id, did = 0) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/driver/'); ?>" + id,
            success: function (result) {
                $('#driver').html(result);
                if (did !== 0) {
                    $('#driver').val(did);
                }
            }
        });
    }
    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/setledgers/4'); ?>",
            success: function (result) {
                $('#from_id').html(result);
            }
        });
        //load();
        $.ajax({
            url: "<?php echo site_url('ajaxcall/costcenter'); ?>",
            success: function (result) {
                $('#Costcenter').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/billtype/trip'); ?>",
            success: function (result) {
                $('#btype').html(result);
                var bill = $('#btype').val();
                setbillno(bill);
            }
        });
        function setbillno(id) {
            var sid = $('#id').val();
            if (sid === '0') {
                $.ajax({
                    url: "<?php echo site_url('sales_vehicle/Sales_vehicle/getinoviceno'); ?>/" + id,
                    success: function (result) {
                        $('#invoice_no').html('INVOICE : ' + result);
                    }
                });
            }
        }
        $(".calc").on('change', function () {
            var fare = $("#fare").val();
            var tax = $("#tax").val();
            tax = $("#tax option:selected").html()
            var othercharges = $("#othercharges").val();
            var othercharges = parseFloat(othercharges);
            var fare = parseFloat(fare);
            var othercharges_plus = parseFloat(fare + othercharges);
            var percentage = parseFloat((othercharges_plus * tax) / 100);
            $('#tax_amt').val(percentage.toFixed(2));
            var percentage1 = parseFloat(othercharges_plus + percentage);
            $("#total").val(percentage1.toFixed(2));

        });

        $(".calckm").on('change', function () {
            var startkm = $("#startkm").val();
            var startkm = parseFloat(startkm);
            var endkm = $("#endkm").val();
            var endkm = parseFloat(endkm);
            var totalkm = (endkm - startkm);
            $("#totalkm").val(totalkm.toFixed(2));
        });



        $("#customer").autocomplete({
            minLength: 1,
            select: function (event, ui) {
                $('#customer_id').val(ui.item.id);
            },
            source: function (req, add) {
                $.ajax({
                    url: "<?php echo base_url(); ?>sales_vehicle/Sales_vehicle/customer_lookup",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        if (data.response === "true") {
                            add(data.message);
                        }
                    }
                });
            }
        });




        $("#vehicle").autocomplete({
            minLength: 1,
            select: function (event, ui) {
                $('#vehicle_id').val(ui.item.id);
                loaddriver(ui.item.id);
            },
            source: function (req, add) {
                $.ajax({
                    url: "<?php echo base_url(); ?>sales_vehicle/Sales_vehicle/vehicle_lookup",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        if (data.response === "true") {
                            add(data.message);
                        }
                    }
                });
            }
        });


        $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax').html(result);
                load();
            }
        });


    });


</script>
