<!-- *****************************************************************************************
*View for list all enquiries
*
*
*@author Althaf
*@created on 11-10-2019
**************************************************************************************************-->


<?php
$add_url = site_url('Items/create_category');
?>


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
                <div class="box-header">
                    <h3 class="box-title"> <?= label('Item Category', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('Items/list_category'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>

                </div>
                <!-- /.box-header -->

                <div class="box-body">

                    <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <?php 
                                if($settings[0]['is_image'] == 'yes'){
                                ?>
                                <th><?= label('Item', $this, $user) ?></th>
                                <?php
                                }
                                ?>
                                
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('Category', $this, $user) ?></th>
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
                            <tr>
                                <th class='text-center' colspan='3'><b>Enquiry Products</b></th>
                            </tr>
                        </table>
                    </div>
                    
                    <div class="">
                        <?= label('Start Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input name="dates" id="dates" type="text" class="form-control date">
                            <div class="input-group-addon">
                                <span class="glyphicon glyphicon-th"></span>
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('Amount', $this, $user) ?>
                        <input type="text" name="amounts" id="amounts" data-validation="required" class="form-control">
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

        if ($('#sort').val() == 'none') {
            $('.datess').hide()
        }

        var crmtype = $("#crmtype").val();

        if (crmtype == "COURSE_CRM") {
            $("#qualify").text("Qualification");
            $("#name").text("Full Name");
            $("#phone").text("Phone");
        }


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
                url: "<?php echo site_url('crm_general/Enquiry_allocation/getItems'); ?>/" + closure_id,
                success: function(result) {
                    text = "<tr> <th class = 'text-center' colspan = '3'><b>Enquiry Products</b></th></tr>"
                    text = text + "<tr> <th><b>Item Name</b></th> <th><b>Quantity</b></th> <th><b>Price</b></th> </tr>"
                    $.each(JSON.parse(result), function(i, items) {
                        text = text + '<tr> <td>' + items.itemname + '</td> <td>' + items.quantity + '</td> <td>' + items.price + '</td> </tr>'
                    });

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
                "url": "<?php echo site_url('Items/category_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.crmtype = crmtype;
                    data.fromDate = $('#fromDate').val();
                    data.toDate = $('#toDate').val();
                    data.dat = $('#sort').val();
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "width": "150px",
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


    });

    $('#sort').change(function() {
        if ($('#sort').val() == 'none') {
            $('.datess').hide()
        } else {
            $('.datess').show();
        }

    })
</script>