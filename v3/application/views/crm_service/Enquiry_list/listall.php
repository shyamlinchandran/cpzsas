<!-- *****************************************************************************************
*View for list all enquiries
*
*
*@author Althaf
*@created on 11-10-2019
**************************************************************************************************-->


<?php
$add_url = site_url('crm_service/Enquiry_list/create');
?>

<input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />

<style>
    .box-title {
        text-transform: capitalize;
    }

    .label {
        margin-bottom: -2px;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">
                <div class="box-header with-border">
                    <h3 class="box-title"> <?= label('Service Bill', $this, $user) ?></h3>
                    <span class="pull-right"> <a role="button" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>

                    </span>

                </div>
                <!-- /.box-header -->
    
                <div class="box-body">
                    <div style="padding-left:15px">

                    </div>

                    <table id="table" class="table <?= $this->table_color ?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class="selectall" name="check" value="' . $items->id . '"> &nbsp; <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Service No', $this, $user) ?></th>
                                <th><?= label('Customer', $this, $user) ?></th>
                                <th><?= label('Product Details', $this, $user) ?></th>
                                <th><?= label('Delivery Date', $this, $user) ?></th>
                                <th><?= label('Amount', $this, $user) ?></th>
                                <th><?= label('User', $this, $user) ?></th>
                                <th><?= label('Allocated USer', $this, $user) ?></th>
                                <th><?= label('Action', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="myClosureModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_service/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_register/save_closure'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="closure_id" name="closure_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"> <?= label('Enquiry Closure', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">

                    <div class="">
                        <table id="items" class="table table-bordered">
                            <tr>
                                <th class='text-center' colspan='3'><b>Enquiry Products</b></th>
                            </tr>
                        </table>
                    </div>

                    <div class="">
                        <?= label('Start Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input name="dates" id="dates" type="text" data-validation="required" class="form-control date">
                            <div class="input-group-addon">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('Status', $this, $user) ?><br>
                        <select name="stat" id="stat" class="form-control">
                            <option value="1" selected>Win</option>
                            <option value="2">Lose</option>
                        </select>
                    </div>
                    <div class="" id="ttt">
                        <?= label('Amount', $this, $user) ?>
                        <input type="text" name="amounts" id="amounts" data-validation="required number" class="form-control">
                    </div>
                    <div class="">
                        <?= label('Remarks', $this, $user) ?>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" id="clos_btn" class="btn btn-primary">Save
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="myEnquiryModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_service/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_register/save_allocation'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="allocate_id" name="allocate_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Enquiry Allocation', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <?= label('Start Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input name="Sdate" id="Sdate" type="text" class="form-control date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('Work Completion Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input name="Edate" id="Edate" type="text" data-validation="required" class="form-control date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('Select user', $this, $user) ?>
                        <select name="users" id="users" data-validation="required" class="form-control">
                            <option value="">Select</option>
                            <option value="product">Admin</option>
                            <option value="solution">User</option>
                        </select>
                    </div>
                    <div class="">
                        <?= label('Amount', $this, $user) ?>
                        <input type="text" name="amount" id="amount" data-validation="required" class="form-control">
                    </div>
                    <div class="">
                        <label>Remarks</label>
                        <textarea name="remark" id="remark" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" id="allo_btn" class="btn btn-primary">Save
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<div class="modal fade" id="myFilterModal">
    <input type="hidden" id="closure_id" name="closure_id">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?= label('Apply Filter', $this, $user) ?></h4>
            </div>
            <div class="modal-body">

                <table class="table no-border" cellspacing="0" width="100%">
                    <tr>
                        <th class="col-sm-2">
                            <?= label('Filter by', $this, $user) ?>
                            <select tabIndex="8" name="sort" id="sort" class="form-control">
                                <option value="none" selected>None</option>
                                <option value="date">Date</option>
                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th class="col-sm-1 datess">
                            <?= label('From', $this, $user) ?>
                            <input type="text" class="form-control date" id="fromDate">
                        </th>
                        <th class="col-sm-1 datess">
                            <?= label('To', $this, $user) ?>
                            <input type="text" class="form-control date" id="toDate">
                        </th>
                    </tr>
                    <tr>
                        <th class="col-sm-2 ">
                            <?= label('User', $this, $user) ?>
                            <select tabIndex="8" name="sort_user" id="sort_user" class="form-control">

                            </select>
                        </th>
                        <th class="col-sm-2 ">
                            <?= label('source', $this, $user) ?>
                            <select tabIndex="8" name="sort_source" id="sort_source" class="form-control">

                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th class="col-sm-2 ">
                            <?= label('Area', $this, $user) ?>
                            <select tabIndex="8" name="sort_area" id="sort_area" class="form-control">

                            </select>
                        </th>
                        <th class="col-sm-2 ">
                            <?= label('State', $this, $user) ?>
                            <select tabIndex="8" name="sort_state" id="sort_state" class="form-control">

                            </select>
                        </th>
                    </tr>
                    <tr>
                        <th class="col-sm-1 ">
                            <?= label('Category', $this, $user) ?>
                            <select tabIndex="8" name="sort_type" id="sort_type" class="form-control">

                            </select>
                        </th>
                        <!-- <th class="col-sm-1 ">
                            <?= label('Product', $this, $user) ?>
                            <select tabIndex="8" name="sort_product" id="sort_product" class="form-control">

                            </select>
                        </th> -->

                    </tr>

                </table>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="submit" id="clos_btn" class="btn btn-primary">Search
                    </button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var table;
    $(document).ready(function() {

        products();

        $('#sort_type').change(function() {
            var type = $('#sort_type').val()
            products(type);
        });

        if ($('#sort').val() == 'none') {
            $('.datess').hide()
        }

        var crmtype = $("#crmtype").val();

        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
        }

        $(document).on("click", "#filter", function() {
            $('#myFilterModal').modal('show');
        });
        $(document).on("click", "#allo_btn", function() {
            $('#myEnquiryModal').modal('hide');
        });
        $(document).on("click", "#clos_btn", function() {
            $('#myClosureModal').modal('hide');
        });
        $(document).on("click", ".test", function() {
            $('#myEnquiryModal').modal('show');
            var allocate_id = $(this).attr('id');
            $('#allocate_id').val(allocate_id);
        });
        $(document).on("click", ".followup", function() {
            $('#myFollowupModal').modal('show');
            var followup_id = $(this).attr('id');
            $('followup_id').val(followup_id);
        });
        $(document).on("click", ".closure", function() {
            $('#myClosureModal').modal('show');
            var closure_id = $(this).attr('idss');
            $('#closure_id').val(closure_id);
            $.ajax({

                url: "<?php echo site_url('crm_service/Enquiry_allocation/getItems'); ?>/" + closure_id,
                success: function(result) {
                    var total = 0;
                    text = "<tr> <th class = 'text-center' colspan = '3'><b>Enquiry Details</b></th></tr>";
                    text = text + "<tr> <th><b>Item Name</b></th> <th><b>Quantity</b></th> <th><b>Price</b></th> <th><b>Total</b></th> </tr>";
                    $.each(JSON.parse(result), function(i, items) {
                        var temptotal = 0;
                        temptotal = items.quantity * items.price;
                        total = total + temptotal;
                        text = text + '<tr> <td>' + items.itemname + '</td> <td>' + items.quantity + '</td> <td>' + items.price + '</td> <td>' + temptotal + '</td> </tr>'
                    });
                    text = text + "<tr> <td colspan = '3'><b>Total</b></td> <th><b>" + total + "</b></th> </tr>";

                    $('#items').html(text);
                }
            });
        });
        //datatables
        table = $('#table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": true,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_service/Enquiry_list/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.crmtype = crmtype;
                    data.fromDate = $('#fromDate').val();
                    data.toDate = $('#toDate').val();
                    data.dat = $('#sort').val();
                    data.userss = $('#sort_user').val();
                    data.source = $('#sort_source').val();
                    data.area = $('#sort_area').val();
                    data.state = $('#sort_state').val();
                    data.types = $('#sort_type').val();
                    data.productss = $('#sort_product').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]
        });
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#fromDate').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#toDate').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_user').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_source').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_area').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_state').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_type').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#sort_product').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });


    });

    $('#stat').change(function() {
        if ($('#stat').val() == 2) {
            $('#ttt').hide();
            $('#amounts').val(0);
        } else {
            $('#ttt').show();
        }
    });

    $('#sort').change(function() {
        if ($('#sort').val() == 'none') {
            $('.datess').hide();

        } else {
            $('.datess').show();
        }

    });

    $.ajax({
        url: "<?php echo site_url('crm_service/Enquiry_register/source'); ?>",
        success: function(result) {
            $('#sort_source').html(result);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_service/Leads_master/getArea'); ?>",
        async: false,
        success: function(result) {
            var option = '<option value = "">Select</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                option = option + '<option value ="' + itemsingle.id + '"> ' + itemsingle.area + '</option>';
            });
            $("#sort_area").html(option);
        }
    });

    $.ajax({
        url: "<?php echo site_url('master/amaster/states'); ?>/",
        async: false,
        success: function(result) {
            var options = '<option value = "" >Select</option>';
            $.each(JSON.parse(result), function(i, itemsingle) {
                options = options + '<option value ="' + itemsingle.StateID + '"> ' + itemsingle.StateName + '</option>';
            });
            $("#sort_state").html(options);
        }
    });

    $.ajax({
        url: "<?php echo site_url('crm_service/Enquiry_allocation/getItemTypes'); ?>",
        success: function(results) {
            var options = '<option>None</option>';
            $.each(JSON.parse(results), function(i, items) {
                options = options + '<option value = "' + items.id + '">' + items.name + '</option>';
            });
            $('#sort_type').html(options);

        }
    });
    var text = "";
    $.ajax({

        url: "<?php echo site_url('crm_service/Enquiry_register/users'); ?>",
        success: function(results) {
            text = '<option value = "">Select</option>';
            $.each(JSON.parse(results), function(i, items) {
                text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                $('#sort_user').html(text);

            });


        }
    });


    function products(type = 0) {

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_allocation/getAllItems'); ?>/" + type,
            async: false,
            success: function(result) {
                var options = '<option>Select</option>';
                $.each(JSON.parse(result), function(i, itemsingle) {
                    options = options + '<option value ="' + itemsingle.id + '"> ' + itemsingle.name + '</option>';
                });
                $("#sort_product").html(options);
            }
        });

    }
</script>