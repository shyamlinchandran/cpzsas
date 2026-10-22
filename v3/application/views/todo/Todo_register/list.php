<?php
$add_url = site_url('crm_general/Enquiry_register/create');
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
            <div class="<?=$this->box_color?>">
                <div class="box-header with-border">
                    <h3 class="box-title"> <?= label('Task Register-Todays Followup List', $this, $user) ?></h3>
                    <span class="pull-right">
                        <div class="col-sm-12">

                            <div class="col-sm-6 text-right">
                                <?= label('Inbox', $this, $user) ?><br>
                                <a role="button" href="<?php echo site_url('todo/Todo_list/listall'); ?>" class="btn" style="border-color:lightblue;background-color:white;color:skyblue" id="mail"><i class="fa fa-envelope"></i></a></a>
                            </div>

                            <div class="col-sm-6">
                                <?= label('Date', $this, $user) ?>
                                <input type="text" class="form-control date" id="date" />
                            </div>
                        </div>
                    </span>

                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th id="qualify"><?= label('Task', $this, $user) ?></th>
                                <th id="name"><?= label('Status', $this, $user) ?></th>
                                <th id="phone"><?= label('Assigned by', $this, $user) ?></th>
                                <th><?= label('Next Followup on', $this, $user) ?></th>
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
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_general/Enquiry_register/save_closure'); ?>" home="<?php echo site_url('main/members/index'); ?>">
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
                        <select name="stat" id="stat" class="form-control" required>

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
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_general/Enquiry_register/list_all'); ?>" action="<?php echo site_url('crm_general/Enquiry_register/save_allocation'); ?>" home="<?php echo site_url('main/members/index'); ?>">
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
<script type="text/javascript">
    var table;
    $(document).ready(function() {



        var crmtype = $("#crmtype").val();

        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
        }

        $('#stat').change(function() {
            if ($('#stat').val() == 2) {
                $('#ttt').hide();
                $('#amounts').val(0);
            } else {
                $('#ttt').show();
            }
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
            // alert(closure_id)
            $.ajax({

                url: "<?php echo site_url('crm_general/Enquiry_allocation/getItems'); ?>/" + closure_id,
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
            "language": lan,
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
                "url": "<?php echo site_url('todo/Todo_register/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.crmtype = crmtype;
                    data.date = $('#date').val();
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

        $('#date').change(function() {
            table.ajax.reload(null, false);
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