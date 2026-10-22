<?php
$add_url = site_url('crm_service/Enquiry_allocation/create');
?>
<input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />

<style>
    .box-title {
        text-transform: capitalize;
    }

    .red {
        background-color: red !important;
        color: white;
    }

    .green {
        background-color: green !important;
        color: white;
    }

    .yellow {
        background-color: #9B870C !important;
        color: white;
    }

    .blue {
        background-color: lightblue !important;
        color: white;
    }

    .light-green {
        background-color: lightgreen !important;
        color: white;
    }

    .orange {
        background-color: orange !important;
        color: white;
    }

    .grey {
        background-color: grey !important;
        color: white;
    }
</style>
<form method="post" id="allocForm" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_allocation/save_allocation'); ?>" home="<?php echo site_url('main/members/index'); ?>">
    <input type="hidden" value="" name="isbulk" id="isbulk" />
    <input type="hidden" value="<?php echo $usertype ?>" name="usertype" id="usertype" />
    <input type="hidden" value="<?php echo $datenow; ?>" name="datenow" id="datenow" />

    <section class="content">


        <div class="modal fade" id="myEnquiryModal">

            <input type="hidden" id="allocate_id" name="allocate_id">
            <input type="hidden" value="" name="totalss" id="totalss" />
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?= label('Allocate Service Call', $this, $user) ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">

                        <div class="">
                            <?= label('Date', $this, $user) ?>
                            <div class="input-group">
                                <input autocomplete="off" name="Sdate" id="Sdate" type="text" data-validation="required" class="form-control" style="width:570px" readonly>
                                <div class="input-group-addon" style="display:none">
                                </div>
                            </div>
                        </div>
                        <div class="">
                            <?= label('Allocated to', $this, $user) ?>
                            <select autocomplete="off" name="user" id="user" data-validation="required" class="form-control">
                                <option value="">Select</option>
                                <option value="product">Admin</option>
                                <option value="solution">User</option>
                            </select>
                        </div>
                        <div class="">
                            <?= label('Allocated Date', $this, $user) ?>
                            <div class="input-group">
                                <input autocomplete="off" value="" name="Edate" id="Edate" type="text" data-validation="required" class="form-control" style="width:570px" readonly>
                                <div class="input-group-addon" style="display:none">
                                </div>
                            </div>
                        </div>
                        <!-- <div class="">
                            <?= label('Delivery  Date', $this, $user) ?>
                            <div>
                                <input name="Ddate" id="Ddate" data-validation="required" type="text" class="form-control date" style="width:570px">

                            </div>

                        </div> -->
                        <div class="">
                            <?= label('Remarks*', $this, $user) ?>
                            <textarea name="remark" id="remark" class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" id="allo_btn" class="btn btn-primary">Save
                        </button>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-xs-12">
                <div class="<?=$this->box_color?>">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Service Call Register', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a back="<?php echo base_url() ?>crm_new/Enquiry_allocation/list_all" data-toggle="tooltip" title="Enquiry Allocation" id="allo" name="allo" class="btn btn-primary" data-toggle="modal" date="" data-target="#myEnquiryModal">Allocate</a>
                            <a type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" id="deletes">Delete</a>
                            <a role="button" class="btn" style="border-color:lightgreen;background-color:white;color:lime" id="filter"><i class="fa fa-filter"></i></a></a>
                            <a role="button" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>

                        </span>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table no-border" cellspacing="0" width="100%">
                            <tr class="col-sm-12" style="display:inline">
                                <th class="col-sm-4">


                                </th>

                            </tr>
                        </table>
                        <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
    </section>

</form>

<!-- <div class="modal fade" id="myClosureModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_allocation/save_closure'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="closure_id" name="closure_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Enquiry Closure*', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <?= label('Start Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input name="dates" id="dates" type="text" data-validation="required" class="form-control date">
                            <div class="input-group-addon">
                            </div>
                        </div>
                        <div id="amount" class="">
                            <?= label('Amount', $this, $user) ?>
                            <input type="text" name="amounts" id="amounts" data-validation="required" class="form-control">
                        </div>
                        <div class="">
                            <?= label('Remarks', $this, $user) ?>
                            <textarea type="text" name="remark" id="remark" data-validation="required" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                            <button type="submit" id="clos_btn" class="btn btn-primary"><?= label('Save', $this, $user) ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div> -->

<div class="modal fade" id="myClosureModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_service/Enquiry_allocation/varify'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="closure_id" name="closure_id" />
        <input type="hidden" value="<?php echo $id; ?>" id="var_id" name="var_id" />

        <div class="col-md-8" style="margin-left: 20%; margin-top:10px; width 100%">
            <div class="box box-default">
                <div class="box-header with-border" id="appendhead">
                    <h3 class="box-title">Followups</h3>
                </div>
                <div class="box-body" id="appendrow">

                    <table id="tablenot" class="table table-bordered table-striped table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th><?= label('Updated on', $this, $user) ?></th>
                                <th><?= label('Next Followup on', $this, $user) ?></th>
                                <th><?= label('Remarks', $this, $user) ?></th>
                                <th><?= label('Files', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer with-border">

                    <div style="float:right">
                        <button type="submit" id="clos_btn" class="btn btn-success"><?= label('Ok', $this, $user) ?></button>
                        </button>
                    </div>
                    <div class="col-sm-3" style="float:right">
                        <select id="stats" name="stats" class="form-control">
                            <option value=1>Accept</option>
                            <option value=2>Reject</option>
                        </select>
                    </div>


                </div>
            </div>
        </div>
    </form>
</div>


<div class="modal fade" id="myWarning">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= label('Warning', $this, $user) ?></h4>
            </div>
            <div class="modal-body no-border">
                <input type="text" id="changess" value="Nothing to change" style="border:none;width:100%" />
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="myConfirm">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= label('Confirm', $this, $user) ?></h4>
            </div>
            <div class="modal-body no-border">
                <input type="text" id="changess" value="Do you want to delete selected" style="border:none;width:100%" />
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                <button type="button" class="btn btn-danger" id="delConf" data-dismiss="modal"><?= label('Delete', $this, $user) ?></button>
                </button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="myFollowupModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_service/Enquiry_allocation/list_all'); ?>" enctype="multipart/form-data" <?php echo site_url('enquiry_followup/save_followup'); ?>" home="<?php echo site_url('main/members/index'); ?>">
        <input type="hidden" id="followup_id" name="followup_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Enquiry Followup*', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="container">
                    <div class="col-md-6">
                        <div class="form-group">
                            <?= label('Image Upload*', $this, $user) ?>
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <span class="btn btn-default btn-file">
                                        <?= label('Browse....', $this, $user) ?> <input type="file" id="imgInp">
                                    </span>
                                </span>
                                <input type="text" data-validation="required" class="form-control">
                            </div>
                            <img id='imgupload' />
                            <div class="">
                                <?= label('Description*', $this, $user) ?>
                                <input type="text" name="description" id="description" data-validation="required" class="form-control">
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close*', $this, $user) ?></button>
                                <button type="submit" class="btn btn-primary"><?= label('Save*', $this, $user) ?>
                                </button>
                            </div>
                        </div>
                    </div>
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
                            <select tabIndex="8" name="sort_cuser" id="sort_cuser" class="form-control">

                            </select>
                        </th>
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
    varid = 0;
    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('input:checkbox').prop('checked', true);
        } else {
            $('input:checkbox').prop('checked', false);
        }
    });

    $(document).on("click", "#filter", function() {
        $('#myFilterModal').modal('show');
    });


    $(document).ready(function() {


        $('.datess').hide();


        $('#sort').change(function() {
            if ($('#sort').val() == 'none') {
                $('.datess').hide();

            } else {
                $('.datess').show();
            }

        });

        $('#allo_btn').click(function() {
            var formId = '#allocForm';
            var isValid = $(formId).isValid();
            if (isValid) {
                $('#allo_btn').submit();
                //    var formData = $(formId).serialize();
                //    $.ajax({
                //     url:$(formId).attr('action'),
                //     type : "POST",
                //     data : formData,
                //     success:function(response){

                //     }
                //   });
                $(document).on("click", "#allo_btn", function() {
                    $('#myEnquiryModal').modal('hide');
                });
            } else {
                $('#changess').val('Please fill the required fields');
                $('#myWarning').modal('show');
            }


        });
        var crmtype = $('#crmtype').val()

        if (crmtype == 'COURSE_CRM') {
            $('#amount').hide();
        }


        $('#deletes').click(function() {
            if (!$('input.enquiry:checkbox:checked').val()) {
                $('#changess').val('Nothing to Delete');
                $('#myWarning').modal('show');
            } else {
                $('#myConfirm').modal('show');
                $('#delConf').click(function() {
                    var text = "";
                    $('input.enquiry:checkbox:checked').each(function() {
                        if (text === "") {
                            text = $(this).val();
                        } else {
                            text = text + ',' + $(this).val();
                        }
                    });
                    if (text != "") {
                        $.ajax({
                            url: "<?php echo site_url('crm_service/Enquiry_allocation/deleteEnq'); ?>/",
                            type: "POST",
                            data: {
                                text: text
                            },
                            success: function(response) {}
                        });
                    }
                });


            }


        });

        $('.datepicker').datepicker({
            autoclose: true,
        })

        var crmtype = $("#crmtype").val();

        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
        }

        $.ajax({
            url: "<?php echo site_url('crm_service/Enquiry_register/user'); ?>",
            success: function(result) {
                $('#user').html(result);
            }
        });

        $(document).on("click", "#clos_btn", function() {
            $('#myClosureModal').modal('hide');
        });
        $(document).on("click", ".test", function() {
            $('#isbulk').val(0);
            var id = $(this).attr('id');

            $.ajax({

                url: "<?php echo site_url('crm_service/Enquiry_allocation/getItems'); ?>/" + id,
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
                    $('#totalss').val(total);

                    $('#items').html(text);
                }
            });

            $('#myEnquiryModal').modal('show');
            var allocate_id = $(this).attr('id');
            var date = $(this).attr('date');
            $('#Sdate').val(formatDate(date));
            dates = $('#datenow').val()
            $('#Edate').val(formatDate(dates));
            $('#allocate_id').val(allocate_id);
        });

        // $(document).on("click", "#cclose", function() {
        //     dates = $('#datenow').val();
        //     $('#dates').val(formatDate(dates));
        // });

        $('#Ddate').change(function() {


        });



        $(document).on("click", "#allo", function() {
            $('#isbulk').val(1);
            if (!$('input.enquiry:checkbox:checked').val()) {
                $('#changess').val('Nothing to allocate');
                $('#myWarning').modal('show');
            } else {

                $('#myEnquiryModal').modal('show');
                var allocate_id = $(this).attr('id');
                dates = $('#datenow').val();
                $('#Sdate').val(formatDate(dates));
                $('#Edate').val(formatDate(dates));
                $('#allocate_id').val(allocate_id);
            }

        });

        $(document).on("click", ".followup", function() {
            $('#myFollowupModal').modal('show');
            var followup_id = $(this).attr('id');
            $('followup_id').val(followup_id);
        });
        $(document).on("click", ".closure", function() {
            var var_id = $(this).attr('var_id');
            $('#var_id').val(var_id);
            table.ajax.reload(null, false);
            $('#myClosureModal').modal('show');
            var closure_id = $(this).attr('idss');
            $('#closure_id').val(closure_id);

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
            "createdRow": function(row, data, dataIndex) {

                var st = data[7];
                switch (st) {
                    case 'positive':
                        $(row).find('td:eq(7)').addClass('green');
                        break;
                    case 'interested':
                        $(row).find('td:eq(7)').addClass('blue');
                        break;
                    case 'neutral':
                        $(row).find('td:eq(7)').addClass('grey');
                        break;
                    case 'visited':
                        $(row).find('td:eq(7)').addClass('light-green');
                        break;
                    case 'negative':
                        $(row).find('td:eq(7)').addClass('red');
                        break;
                }

            },
            'buttons': [],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_service/Enquiry_allocation/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.dat = $('#sort').val();
                    data.fromDate = $('#fromDate').val();    
                    data.toDate = $('#toDate').val();
                    data.userr = $('#sort_user').val();
                    data.cuser = $('#sort_cuser').val();
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
        $('#btn-reset').click(function() { //button reset event click
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
        $('#sort_cuser').change(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#delConf').click(function() {
            setTimeout(function() {
                table.ajax.reload(null, false);
            }, 250);

        });

    });

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0], // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
    }
</script>

<script type="text/javascript">
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    $(document).on("click", ".closure", function() {
        // setTimeout(function() {
        var table = $('#tablenot').DataTable();
        table.destroy();
        var id = $('#id').val();
        var table = $('#tablenot').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [
                [10, 25, 50, 100],
                [10, 25, 50, 100]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [{
                    extend: 'excelHtml5',
                    className: 'btn bg-navy',
                    filename: 'Followups' + jsDate,
                    text: '<i class="fa fa-file-excel-o"></i>',
                    messageTop: "Printed Date-  " + jsDate,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    },
                    titleAttr: 'Excel',
                    action: newexportaction,
                    customize: function(xlsx) {
                        var sheet = xlsx.xl.worksheets['sheet1.xml'];
                        $('c[r=A1] t', sheet).text(company + " - " + 'Followups');
                        $('c[r=A2] t', sheet).text("");
                    }
                },
                {
                    text: '<i class="fa fa-file-pdf-o"></i>',
                    extend: 'pdfHtml5',
                    title: "dsads",
                    className: 'btn bg-olive',
                    filename: 'Followups' + jsDate,
                    messageTop: "Printed Date-  " + jsDate,
                    pageSize: 'A4', //A3 , A5 , A6 , legal , letter
                    action: newexportaction,
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4],
                        search: 'applied',
                        order: 'applied'
                    },
                    customize: function(doc) {
                        //Remove the title created by datatTables
                        doc.content.splice(0, 1);
                        doc.content[0].text = "Followups";
                        //Create a date string that we use in the footer. Format is dd-mm-yyyy

                        // Logo converted to base64
                        // var logo = getBase64FromImageUrl('https://datatables.net/media/images/logo.png');
                        // The above call should work, but not when called from codepen.io
                        // So we use a online converter and paste the string in.
                        // Done on http://codebeautify.org/image-to-base64-converter
                        // It's a LONG string scroll down to see the rest of the code !!!

                        //  doc.pageMargins = [20, 60, 20, 30];
                        // Set the font size fot the entire document
                        doc.defaultStyle.fontSize = 9;
                        // Set the fontsize for the table header
                        doc.styles.tableHeader.fontSize = 9;
                        // Create a header object with 3 columns
                        // Left side: Logo
                        // Middle: brandname
                        // Right side: A document title
                        doc['header'] = (function() {
                            return {
                                columns: [{
                                    alignment: 'center',
                                    //italics: true,
                                    text: company + " - " + 'Followups',
                                    fontSize: 14,
                                    margin: [10, 0]
                                }],
                                margin: 20
                            }
                        });
                        /*for (var i = 1; i < doc.content[1].table.body.length; i++) {
                         doc.content[1].table.body[i][4].alignment = 'right';
                         doc.content[1].table.body[i][0].alignment = 'center';
                         doc.content[1].table.body[i][1].alignment = 'center';
                         }*/
                        // Create a footer object with 2 columns
                        // Left side: report creation date
                        // Right side: current page and total pages
                        doc['footer'] = (function(page, pages) {
                            return {
                                columns: [{
                                        alignment: 'left',
                                        text: ['Created on: ', {
                                            text: jsDate.toString()
                                        }]
                                    },
                                    {
                                        alignment: 'center',
                                        text: ['Signature ']
                                    },
                                    {
                                        alignment: 'right',
                                        text: ['page ', {
                                            text: page.toString()
                                        }, ' of ', {
                                            text: pages.toString()
                                        }]
                                    }
                                ],
                                margin: 20
                            }
                        });
                        // Change dataTable layout (Table styling)
                        // To use predefined layouts uncomment the line below and comment the custom lines below
                        // doc.content[0].layout = 'lightHorizontalLines'; // noBorders , headerLineOnly
                        var objLayout = {};
                        objLayout['hLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['vLineWidth'] = function(i) {
                            return .5;
                        };
                        objLayout['hLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['vLineColor'] = function(i) {
                            return '#aaa';
                        };
                        objLayout['paddingLeft'] = function(i) {
                            return 4;
                        };
                        objLayout['paddingRight'] = function(i) {
                            return 4;
                        };
                        doc.content[0].layout = objLayout;
                    }
                }
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('crm_service/Enquiry_followup/getsing'); ?>/" + $('#var_id').val(),
                "type": "POST",
                "data": function(data) {
                    data.var_id = $('#var_id').val();
                    data.type = 'create';
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]

        });

        // }, 2000);

    });

    $.ajax({

        url: "<?php echo site_url('crm_service/Enquiry_register/users'); ?>",
        success: function(results) {
            text = '<option value = "">All</option>';
            $.each(JSON.parse(results), function(i, items) {
                text = text + '<option value = "' + items.Id + '">' + items.user_name + '</option>';
                $('#sort_user').html(text);
                $('#sort_cuser').html(text);
            });


        }
    });
</script>