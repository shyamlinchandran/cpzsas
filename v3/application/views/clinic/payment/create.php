<form method="post"  id="frmcreate" type="submit" back="<?php echo site_url('clinic/Payment/listall'); ?>" action="<?php echo site_url('clinic/Payment/save'); ?>" >
    <input type="hidden"  id="name" name="name"/>  
    <input type="hidden"  id="isinv" name="isinv" value="<?= $isinventory['value'] ?>"/>
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id"/> 
    <section class="content-header">
        <h1>
            User Profile
        </h1>  

    </section>
    <section class="content"> 
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">

                        <h4 id="pat_name" name="pat_name" class="profile-username text-center"></h4>
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                                <b>Age</b> <a id="age" name="age" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Gender</b> <a id="gender" name="gender" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Date Of Birth</b> <a name="dob" id="dob" class="pull-right"></a>
                            </li>

                            <li class="list-group-item">
                                <b>Address</b> <a id="address" name="address" class="pull-right"></a>
                            </li>
                            <li class="list-group-item">
                                <b>Phone</b> <a id="phone" name="phone" class="pull-right"></a>
                            </li>
                        </ul>

                        <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Todays Notes</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Patients Note</strong>

                        <p id="pnote" class="text-muted">
                        </p>
                        <strong><i class="fa fa-book margin-r-5"></i> Reception Note</strong>

                        <p id="rnote" class="text-muted">
                        </p>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <!--                    <ul class="nav nav-tabs">
                                            <li class="active"><a href="#activity" data-toggle="tab">Activity</a></li>
                                            <li><a href="#timeline" data-toggle="tab">Timeline</a></li>
                                                                    <li><a href="#settings" data-toggle="tab">Settings</a></li>
                                        </ul>-->
                    <div class="tab-content">
                        <div  id="activity">
                            <?php if ($isinventory['value'] == 1) { ?>
                                <!-- SELECT2 EXAMPLE -->
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <div class="pull-right">
                                        <button  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i></button>
                                    </div>
                                    <div class="pull-left">
                                        <h3 class="box-title">Doctor's Prescription</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="box-body">
                                            <div class="box-body"> 
                                                <div class=" pull-left form-group col-lg-2 hunpx">
                                                    <select name="type" data-validation="required" id="type">
                                                        <option value="Cash">Cash</option> 
                                                        <option value="Credit">Credit</option> 
                                                    </select>               
                                                </div>
                                                <div class="pull-right">
    <!--                                                <span class="span" id="balance">    
                                                    </span>    -->
                                                    <h3 id="balance" class="box-title"></h3>

                                                </div>
                                            </div>
                                            <table class="table table-condensed">
                                                <thead>
                                                    <tr>
                                                        <th>Medicine</th>
                                                        <th>Potency</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                        <th>Description</th>
                                                        <th>Rate</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="rowi">
                                                    <tr id="add">

                                                    </tr>
                                                </tbody>
                                                <tr>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th>Total</th>
                                                    <th><input id="grandtot" name="grandtot"    type="text"    class="form-control col-lg-1   two-digits" placeholder="Total" readonly="readonly"/> </th>
                                                    <th></th>
                                                </tr>
                                            </table>
                                        </div>

                                        <!-- /.box-body -->
                                        <!-- /.box -->

                                    </div>
                                    <!-- /.col (left) -->

                                    <!-- /.col (right) -->
                                </div>
                            <?php } ?>
                            <?php if ($isinventory['value'] == 0) { ?>
                                <div class="box-header">
                                    <h3 class="box-title"></h3>
                                    <div class="pull-right">
                                        <button  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i></button>
                                    </div>
                                    <div class="pull-left">
                                        <h3 class="box-title">Doctor's Prescription</h3>
                                    </div>
                                </div>
                                <div class="box-body"> 
                                    <div class=" pull-left form-group col-lg-2 hunpx">
                                        <select name="type" data-validation="required" id="type">
                                            <option value="Cash">Cash</option> 
                                            <option value="Credit">Credit</option> 
                                        </select>    
                                        <h3 id="balance" class="box-title"></h3>

                                    </div>
                                    <div class="pull-right">
    <!--                                                <span class="span" id="balance">    
                                        </span>    -->
                                        <h3 id="balance" class="box-title"></h3>

                                    </div>
                                </div>
                                <div class="box-body no-padding"> 
                                    <div class="table-responsive mailbox-messages">
                                        <textarea id="editor3" name="pre_note" rows="10" cols="80"> 
                                        </textarea>
                                    </div>
                                    <div class="mailbox-controls"> 

                                        <div class="pull-left">
                                            <input name="label" type="text" id="label"  disabled="disabled"  class="form-control pull-left hunpx" placeholder="Amount :">
                                            <input name="totamt" type="text" id="totamt"    class="form-control hunpx" placeholder="Amount">
                                        </div>
                                    </div>
                                    <div class="mailbox-controls"> 
                                        <div class="pull-right"> 
                                            <div class="btn-group pull-right">
                                                <button type="button" class="btn btnPrevious btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                                                <button type="button" class="btn btnNext btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                                            </div> 
                                            <!-- /.btn-group -->
                                        </div>
                                        <!-- /.pull-right -->
                                    </div>
                                    <!-- /.mail-box-messages -->
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <!-- The timeline -->
                        <ul class="timeline timeline-inverse">
                            <!-- timeline time label -->
                            <?php foreach ($details as $item) { ?>
                                <li class="time-label">
                                    <span class="bg-red"> <?php echo $item['Bok_Date'] ?>  </span>
                                </li>                   
                                <li>
                                    <i class="fa fa-envelope bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header"><a href="#">Observations</a> </h3>
                                        <?php foreach ($details as $detail) { ?>
                                            <?php if ($item['Bok_Id'] == $detail['Bok_Id']) { ?>
                                                <div class="timeline-body">
                                                    <?php echo $detail['Bok_DocNote'] ?> <br></br>   
                                                </div>
                                                <h3 class="timeline-header"><a href="#">Diagonise</a> </h3>
                                                <div class="timeline-body">
                                                    <?php echo $detail['Bok_DoctDescription'] ?> <br></br>   
                                                </div>
                                                <h3 class="timeline-header"><a href="#">Priscription</a> </h3>
                                                <div class="timeline-body">
                                                    <?php echo $detail['Bok_Priscription'] ?> <br></br>   
                                                </div>
                                            <?php } ?>

                                        <?php }
                                        ?> 
                                    </div>
                                </li>
                            <?php }
                            ?>  


                        </ul>
                    </div>
                </div>
                <!-- /.tab-content -->
            </div>
            <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
        </div>
    </section>
</form>
<script src="<?php echo base_url(); ?>asset/plugins/ckeditor/ckeditor.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url(); ?>asset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('form input').keydown(function (e) {
            if (e.keyCode == 13) {
                e.preventDefault();
                return false;
            }
        });
        $("#itemname").autocomplete({
            source: "<?php echo site_url('ajaxcall/items'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $("#mrp_item").val(ui.item.srate);
                $("#id_item").val(ui.item.id);
                $("#name").val(ui.item.name);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/units'); ?>/" + ui.item.unit_id,
                    success: function (result) {
                        //                        $('#unit_item').html(result);
                        //                        $('#unit_item').val(ui.item.unit_id);
                        $("#qty").focus();
                    }
                });
            }
        });
//        function load() {
////            var id = $('#id').val()
////            $.ajax({
////                url: "<?php echo site_url('ajaxcall/cli_salesitems'); ?>/" + id,
//                success: function (result) {
//                    $.each(JSON.parse(result), function (i, itemsingle) {
//                        var id = itemsingle.id;
//                        var name = itemsingle.name;
//                        var qty = itemsingle.qty;
//                        var total = itemsingle.Total;
//                        var mrp = itemsingle.Rate;
//                        $("#mrp_item").val(mrp);
//                        $("#qty").val(qty);
//                        $("#rowTot").val(total);
//                        $("#id_item").val(id);
//                        $("#name").val(name);
//                        additem();
//                    });
//                }
//            });
//            $.ajax({
//                url: "<?php echo site_url('ajaxcall/cli_observation'); ?>/" + id,
//                success: function (result) {
//                    $.each(JSON.parse(result), function (i, itemsingle) {
//                        var id = itemsingle.Obs_id;
//                        var name = itemsingle.Observation;
//                        addrowobservation(id, name);
//                    });
//                }
//            });
//            $.ajax({
//                url: "<?php echo site_url('ajaxcall/cli_diagonise'); ?>/" + id,
////                success: function (result) {
////                    $.each(JSON.parse(result), function (i, itemsingle) {
////                        var id = itemsingle.Dig_Id;
////                        var name = itemsingle.Diagnose;
////                        addrow(id, name);
////                    });
////                }
////            });
//
//        }

        $("#qty").keydown(function (e) {

            var rate = $("#mrp_item").val();
            var qty = $("#qty").val();
            var rowtotal = parseFloat(rate) * parseFloat(qty);
            $("#rowTot").val(rowtotal);
        });
        $("#diagonise").keydown(function (e) {
            var name = $("#diagonise").val();
            if (name != "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    var id = 0;
                    addrow(id, name);
                    $("#diagonise").focus();
                }
            }
            if (name == "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#observation").focus();
                }
            }
        });
        $("#observation").keydown(function (e) {
            var name = $("#observation").val();
            if (name != "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 9)
                {
                    var id = 0;
                    addrowobservation(id, name);

                }
                $('#observation').focus();
            }
            if (name == "") {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    $("#itemname").focus();
                }
            }
        });
        $("#mrp_item").keydown(function (e) {

            var rate = $("#mrp_item").val();
            var qty = $("#qty").val();
            var id = $("#id_item").val();
            var name = $("#name").val();
            var rowtotal = parseFloat(rate) * parseFloat(qty);
            $("#rowTot").val(rowtotal);
            var rowtotal = $("#rowTot").val();
            var unit = $("#unit_item").val();
            if (rowtotal > 0 && name != '' && id != '') {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9)
                {
                    additem();
                }
            }
        });
        function clear() {
            clearValue($("#mrp_item"));
            clearValue($("#qty"));
            clearValue($("#rowTot"));
            clearValue($("#name"));
            clearValue($("#id_item"));
            clearValue($("#itemname"));

        }
//        function additem() {
//            var rate = $("#mrp_item").val();
//            var qty = $("#qty").val();
//            var rowtotal = $("#rowTot").val();
//            var id = $("#id_item").val();
//            var name = $("#name").val();
//            var singrow = '<td><input type="hidden" value=' + id + '   name="item_id[]" readonly="readonly" />' +
//                    '<input  id="itemname[]" NoTab="true" name="item_name[]" value=' + name + ' readonly="readonly" /></td> ' +
//                    '<td><input class="form-control  two-digits price"  id="item_qty[]" name="item_qty[]" value=' + qty + ' readonly="readonly" ></td>' +
//                    '<td><input id="mrp_item[]" name="mrpitem[]" value=' + rate + ' placeholder="MRP" readonly="readonly" /></td>' +
//                    '<td><input id="rowTotal[]" name="rowTotal[]" value=' + rowtotal + ' readonly="readonly"/></td>' +
//                    '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
//            var newRow = "<tr>" + singrow + "</tr>";
//            $("#rowi").append(newRow);
//        }
        $("#observation").autocomplete({
            source: "<?php echo site_url('ajaxcall/Observation'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#observation').val(ui.item.Observation);
                $('#obid').val(ui.item.Obs_Id);
                addrowobservation(ui.item.Obs_Id, ui.item.Observation);
                clearValue($("#observation"));
                clearValue($("#obid"));

            }
        });
        function addrow(id, diagonise) {
            var singrow = '<td><input type="hidden" value=' + id + '  name="dig_id[]" class="ids"/>' +
                    '<input data-validation="length" name="dig_name[]" value="' + diagonise + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                    '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
            var newRow = "<tr>" + singrow + "</tr>";
            $("#rowm").append(newRow);
            clearValue($("#diagonise"));
            clearValue($("#dgid"));
            $("#diagonise").clear();
            $("#dgid").clear();
        }
        function addrowobservation(id, observation) {
            var singrow = '<td><input type="hidden" value=' + id + '  name="ob_id[]" class="ids"/>' +
                    '<input data-validation="length" name="obs_name[]"  value="' + observation + '" data-validation-length="min2"  type="text" NoTab="true"    class="form-control ledger" placeholder="Name"/></td>' +
                    '<td><span data-toggle="tooltip"   title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td>';
            var newRow = "<tr>" + singrow + "</tr>";
            $("#rown").append(newRow);
            clearValue($("#observation"));
            clearValue($("#obid"));
            $("#obid").clear();
            $("#observation").clear();
        }
//        function remove(btn) {
////            var id = $(btn).attr('index');
//            $('.tooltip').remove();
//            $(btn).closest('tr').remove();
//        }
        $(document).on('click', ".remove", function () {
            var btnid = $(this).attr("index");
            calculateGTotal(btnid);
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });
        $("#diagonise").autocomplete({
            source: "<?php echo site_url('ajaxcall/Diagonise'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#diagonise').val(ui.item.Diagnose);
                $('#dgid').val(ui.item.Obs_Id);
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/Cat'); ?>",
                    success: function (result) {
                        $('#diagonise').focus();
                    }
                });
                addrow(ui.item.Dig_id, ui.item.Diagnose);
            }
        });

        $.ajax({
            url: "<?php echo site_url('ajaxcall/Doctor'); ?>",
            success: function (result) {
                $('#doc').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Procedure'); ?>",
            success: function (result) {
                $('#procedure').html(result);
            }
        });
//        $.ajax({
//            url: "<?php echo site_url('ajaxcall/Schedule'); ?>",
//            success: function (result) {
//                $('#at').html(result);
//            }
//        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Intervel'); ?>",
            success: function (result) {
                $('#from').html(result);
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Cat'); ?>",
            success: function (result) {
                $('#cat').html(result);
            }
        });
        load();
    });

    function calculaterow(id) {
        var rate = $("#itmmrp" + id).val();
        var qty = $("#itmqty" + id).val();
        var rowtotal = $('#itmtotal' + id).val();
        var total = $('#grandtot').val();
        total = parseFloat(total) - parseFloat(rowtotal);
        rowtotal = parseFloat(qty) * parseFloat(rate);
        $("#itmtotal" + id).val(rowtotal.toFixed(2));
        total = parseFloat(total) + parseFloat(rowtotal);
        $("#grandtot").val(total);
    }
    function calculateGTotal(btnid) {
        var rowtotal = $("#itmtotal" + btnid).val();
        var grandtotal = $('#grandtot').val();
        grandtotal = parseFloat(grandtotal - rowtotal);
        $("#grandtot").val(grandtotal);
    }
    var inc_inary = 0;
//    (document).on('click', ".remove", function () {
//        $('.tooltip').remove();
//        $(this).closest('tr').remove();
//    });
//    $("#supname").autocomplete({
//        source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
//        minLength: 2,
//        select: function (event, ui) {
//            loadCust(ui);
//            $.ajax({
//                url: "<?php echo site_url('transaction/sales/ledbal'); ?>/" + ui.item.id + "",
//                success: function (results) {
//
//                    $("#balance").html("Clossing Balance: " + results);
//                }
//            });
//            $('#itemname').focus();
//        }
//    });

    function loadCustByid(id) {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/Patientbyid'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results)[0];
                $('#phone').val(result.Pat_Phone);
                $('#email').val(result.Pat_Email);
                $('#supid').val(result.Pat_Id);
                $('#supname').val(result.Pat_Name);
            }
        });
    }
    function loadCust(ui) {

    }
    function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
    function load() {
        var id = $("#id").val();
        var isinventory = $("#isinv").val();
        var idinc = 0;
        var Gtot = 0;
        //alert(id);
        if (id > 0) {
            if (isinventory == 1) {
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/cli_salesitems'); ?>/" + id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            idinc = idinc + 1;
                            var id = itemsingle.id;
                            var name = itemsingle.name;
                            var qty = itemsingle.qty;
                            var total = itemsingle.Total;
                            var mrp = itemsingle.Rate;
                            Gtot = parseFloat(Gtot) + parseFloat(total);
                            var mednote = itemsingle.Med_note;
                            var potencyid = itemsingle.Pot_Id;
                            var potname = itemsingle.Potency;
                            var unitid = itemsingle.Unit_Id;
                            var unitname = itemsingle.uname;
                            $("#mrp_item").val(mrp);
                            $("#qty").val(qty);
                            $("#rowTot").val(total);
                            $("#id_item").val(id);
                            $("#name").val(name);
                            var singrow = '<td><input type="hidden" value=' + id + '   name="item_id[]" id="itmid' + idinc + '" readonly="readonly" />' +
                                    '<input class="form-control"  style="height:25px" id="itemname[]" id="itmname' + idinc + '" NoTab="true" name="item_name[]" value=' + name + '  readonly="readonly"></td> ' +
                                    '<td class="hunpx"><input type="hidden" value=' + potencyid + '   name="cli_potency[]" readonly="readonly" >' +
                                    '<input class="form-control hunpx" id="potencyname[]" NoTab="true" name="potencyname[]" value=' + potname + ' readonly="readonly" ></td> ' +
                                    '<td><input class="form-control" style="height:25px"  class="form-control  two-digits price" id="itmqty' + idinc + '" onchange=calculaterow(' + idinc + ') name="item_qty[]" value=' + qty + ' ></td>' +
                                    '<td class="hunpx"><input type="hidden" value=' + unitid + '   name="uid[]" readonly="readonly" >' +
                                    '<input class="form-control hunpx" id="unitname[]" NoTab="true" name="unitname[]" value=' + unitname + ' readonly="readonly" ></td> ' +
                                    '<td><input id="med_nte' + idinc + '"  name="med_nte[]" value=' + mednote + ' readonly="readonly"></td>' +
                                    '<td><input class="form-control" style="height:25px" id="itmmrp' + idinc + '" onchange=calculaterow(' + idinc + ') name="mrpitem[]" value=' + mrp + ' placeholder="MRP" ></td>' +
                                    '<td><input class="form-control" style="height:25px"  id="itmtotal' + idinc + '" name="rowTotal[]" value=' + total + ' readonly="readonly"></td>' +
                                    '<td><button  type="button" data-toggle="tooltip"   index="' + idinc + '"   title="Remove"   class="btn btn-danger remove"><span class="glyphicon glyphicon-remove-sign"></span></button></td>';
                            var newRow = "<tr>" + singrow + "</tr>";
                            $("#rowi").append(newRow);
                            $("#grandtot").val(Gtot);
                        });
                    }

                });
            }
            $.ajax({
                url: "<?php echo site_url('clinic/Payment/getsing'); ?>/" + id,
                async:false,
                success: function (results) {
                    var result = JSON.parse(results);
                    var isinventory = $("#isinv").val();
                    if (isinventory === '0') {
                        $("#editor3").val(result.Pre_note);
                        $("#totamt").val(result.Bok_Amount);
                    }
                    $("#pat_name").html(result.Pat_Name);
                    $("#age").html(result.Pat_Age);
                    if (result.Pat_Dob != '0000-00-00') {
                        $("#dob").html(result.Pat_Dob);
                    }
                    $("#phone").html(result.Pat_Phone);
                    $("#gender").html(result.Pat_Gender);
                    $("#address").html(result.Pat_Address);
                    $("#doctor").html(result.Doc_Name);
                    $("#pnote").html(result.Bok_Note);
                    $("#rnote").html(result.Apr_Note);
                }
            });
        }



    }
</script>
<script>
    $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.

        CKEDITOR.replace('editor3');
    })
</script>