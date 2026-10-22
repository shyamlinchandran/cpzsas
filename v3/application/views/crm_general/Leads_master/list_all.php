<?php
$add_url = site_url('crm_general/Leads_master/create');
?>
<input type="hidden" value="<?php echo $settings[0]['crm_type']; ?>" name="crmtype" id="crmtype" />

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post" id="allocForm" back="<?php echo site_url('crm_general/Leads_master/list_all'); ?>" action="<?php echo site_url('crm_general/Leads_master/addToEnquiry'); ?>" home="<?php echo site_url('main/members/index'); ?>">
    <input type="hidden" value="" name="isbulk" id="isbulk" />
    <input type="hidden" value="<?php echo $usertype ?>" name="usertype" id="usertype" />
    <input type="hidden" value="<?php echo $datenow; ?>" name="datenow" id="datenow" />
    <section class="content">


        <div class="row">
            <div class="col-xs-12">
				<div class="<?=$this->box_color?>">
                    <div class="box-header">
                        <h3 class="box-title"><?= label('Leads Master', $this, $user) ?></h3>
                        <span class="pull-right">
                        <a type="button" data-toggle="tooltip" title="Delete" class="btn btn-danger" id="deletes">Delete</a>
                            <a role="button" back="<?php echo site_url('crm_general/Leads_master/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>
                        </span>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><input type="checkbox" class="selectall" name="check" value="' . $items->id . '"> &nbsp; <?= label('SNo', $this, $user) ?></th>
                                    <th><?= label('Date', $this, $user) ?></th>
                                    <th id="qualify"><?= label('Company Name', $this, $user) ?></th>
                                    <th id="name"><?= label('Contact Person', $this, $user) ?></th>
                                    <th id="phone"><?= label('Contact Number', $this, $user) ?></th>
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

<div class="modal fade" id="myConfirmAdd">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?= label('Confirm', $this, $user) ?></h4>
            </div>
            <div class="modal-body no-border">
                <input type="text" id="changess" value="Do you want to Add selected in to enquiry " style="border:none;width:100%" />
            </div>
            <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                <button type="button" class="btn btn-success" id="addConf" data-dismiss="modal"><?= label('Add', $this, $user) ?></button>
                </button>
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


    $(document).ready(function() {

        //Deleting
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
                            url: "<?php echo site_url('crm_general/Leads_master/deleteLeads'); ?>/",
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

        //Adding to enquiry
        $('#allo').click(function() {
            if (!$('input.enquiry:checkbox:checked').val()) {
                $('#changess').val('Nothing to add');
                $('#myWarning').modal('show');
            } else {
                $('#myConfirmAdd').modal('show');
                $('#addConf').click(function() { 
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
                            url: "<?php echo site_url('crm_general/Leads_master/addToEnquiry'); ?>/",
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
                "url": "<?php echo site_url('crm_general/Leads_master/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {}
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
