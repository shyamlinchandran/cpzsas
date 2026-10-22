<?php
$add_url = site_url('crm_new/Enquiry_allocation/create');
?>
<input type = "hidden" value = "<?php echo $settings[0]['crm_type'];?>" name="crmtype" id="crmtype"/>

<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post" id="allocForm" back="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_new/Enquiry_allocation/save_allocation'); ?>" home="<?php echo site_url('main/members/index'); ?>">
<input type = "hidden" value = "" name="isbulk" id="isbulk"/>

<input type = "hidden" value = "<?php echo $datenow;?>" name="datenow" id="datenow"/>
<section class="content">


<div class="modal fade" id="myEnquiryModal">
    
        <input type="hidden" id="allocate_id" name="allocate_id">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Enquiry Allocation', $this, $user) ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="">
                        <?= label('Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input autocomplete="off" name="Sdate" id="Sdate" type="text" data-validation="required" class="form-control date" style="width:570px">
                            <div class="input-group-addon" style = "display:none">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('User', $this, $user) ?>
                        <select autocomplete="off" name="user" id="user" data-validation="required" class="form-control">
                            <option value="">Select</option>
                            <option value="product">Admin</option>
                            <option value="solution">User</option>
                        </select>
                    </div>
                    <div class="">
                        <?= label('Allocated Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input autocomplete="off" value="" name="Edate" id="Edate" type="text" data-validation="required" class="form-control date" style="width:570px">
                            <div class="input-group-addon" style = "display:none">
                            </div>
                        </div>
                    </div>
                    <div class="">
                        <?= label('Delivery  Date', $this, $user) ?>
                        <div class="input-group date" data-provide="datepicker">
                            <input autocomplete="off" name="Ddate" id="Ddate" data-validation="required" type="text" class="form-control date" style="width:570px">
                            <div class="input-group-addon" style = "display:none">
                            </div>
                        </div>
                        
                    </div>
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
                <div class="box-header">
                    <h3 class="box-title"><?= label('Enquiry Master', $this, $user) ?></h3>
                    <span class="pull-right">
                        <a role="button" back="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>" class="btn  btn-success align-bottom" href="<?php echo $add_url ?>">
                            <span class="glyphicon glyphicon-plus"></span>
                        </a>
                    </span>
                </div>

                <!-- /.box-header -->
                <div class="box-body">
                <table class="table no-border" cellspacing="0" width="100%">
                        <tr class = "col-sm-12"  style = "display:inline">
                        <th class = "col-sm-4">
                        <a  back="<?php echo base_url()?>crm_new/Enquiry_allocation/list_all"  data-toggle="tooltip" title="Enquiry Allocation" id="allo" name = "allo" class="btn btn-primary"  data-toggle="modal" date="" data-target="#myEnquiryModal">Allocate</span></a>
                        <a type="button" data-toggle="tooltip" title="Delete"  class="btn btn-danger" id="deletes">Delete</a>
                        
                    </th>
                    
                        </tr>
                    </table>
                    <table id="table" class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><input type="checkbox" class = "selectall" name="check" value="' . $items->id . '"> &nbsp; <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Date', $this, $user) ?></th>
                                <th id = "qualify"><?= label('Company Name', $this, $user) ?></th>
                                <th id = "name"><?= label('Contact Person', $this, $user) ?></th>
                                <th id = "phone"><?= label('Contact Number', $this, $user) ?></th>
                                <th><?= label('Allocated to', $this, $user) ?></th>
                                <!-- <th><?= label('Location', $this, $user) ?></th> -->
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

<div class="modal fade" id="myClosureModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>" action="<?php echo site_url('crm_new/Enquiry_allocation/save_closure'); ?>" home="<?php echo site_url('main/members/index'); ?>">
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
                        <div id = "amount" class="">
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
</div>

<div class="modal fade" id="myWarning">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= label('Warning', $this, $user) ?></h4>
                </div>
                <div class="modal-body no-border">
                <input type="text" id = "changess" value = "Nothing to change" style="border:none;width:100%"/>
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
                <input type="text" id = "changess" value = "Do you want to delete selected" style="border:none;width:100%"/>
                </div>          
                <div class="modal-footer no-border">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= label('Close', $this, $user) ?></button>
                <button type="button" class="btn btn-danger" id = "delConf" data-dismiss="modal"><?= label('Delete', $this, $user) ?></button>
                    </button>
                </div>
            </div>
        </div>
</div>


<div class="modal fade" id="myFollowupModal">
    <form method="post" id="frmcreate" back="<?php echo site_url('crm_new/Enquiry_allocation/list_all'); ?>" enctype="multipart/form-data" <?php echo site_url('enquiry_followup/save_followup'); ?>" home="<?php echo site_url('main/members/index'); ?>">
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



<script type="text/javascript">
    var table;
    $('.selectall').click(function() {
        if ($(this).is(':checked')) {
            $('input:checkbox').prop('checked', true);
        } else {
            $('input:checkbox').prop('checked', false);
        }
    });


    $(document).ready(function() {

        $('#allo_btn').click(function(){
            var formId = '#allocForm';
            var isValid = $(formId).isValid();
            if(isValid){
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
         }
         else{
            $('#changess').val('Please fill the required fields');
            $('#myWarning').modal('show');
         }
            
            
        });
        var crmtype = $('#crmtype').val()

        if(crmtype == 'COURSE_CRM'){
            $('#amount').hide();
        }


        $('#deletes').click(function(){
            if(!$('input.enquiry:checkbox:checked').val()){
                $('#changess').val('Nothing to Delete');
                $('#myWarning').modal('show');
            }
            else{
                $('#myConfirm').modal('show');
                $('#delConf').click(function(){
                    var text = "";
                    $('input.enquiry:checkbox:checked').each(function() {
                    if(text ===""){
                        text =$(this).val();
                    }else{
                        text =text+','+$(this).val();
                    }
                    });
                    if(text != ""){
                        $.ajax({
                        url:"<?php echo site_url('crm_new/Enquiry_allocation/deleteEnq'); ?>/",
                        type:"POST",
                        data:{text:text},
                        success:function(response){    
                        }   
                    });
                    }
                });
                
                
            }
            
            
        });

        $('.datepicker').datepicker({
            autoclose: true,
            })

        var crmtype = $("#crmtype").val();

        if(crmtype == "COURSE_CRM"){
                    $("#qualify").text("Qualification");    
                    $("#name").text("Full Name");
                    $("#phone").text("Phone");         
                }

        $.ajax({
            url: "<?php echo site_url('crm_new/Enquiry_register/user'); ?>",
            success: function(result) {
                $('#user').html(result);
            }
        });

        $(document).on("click", "#allo_btn", function() {
        });
        $(document).on("click", "#clos_btn", function() {
            $('#myClosureModal').modal('hide');
        });
        $(document).on("click", ".test", function() {
            $('#isbulk').val(0);
            $('#myEnquiryModal').modal('show');
            var allocate_id = $(this).attr('id');
            var date = $(this).attr('date');
            $('#Sdate').val(formatDate(date));
            dates = $('#datenow').val()
            $('#Edate').val(formatDate(dates));
            $('#allocate_id').val(allocate_id);
        });

        $(document).on("click", "#cclose", function(){
            dates = $('#datenow').val();
            $('#dates').val(formatDate(dates));
        });

        $(document).on("click", "#allo", function(){
            $('#isbulk').val(1);
            if(!$('input.enquiry:checkbox:checked').val()){
                $('#changess').val('Nothing to allocate');
                $('#myWarning').modal('show');
            }
            else{
                
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
            $('#myClosureModal').modal('show');
            var closure_id = $(this).attr('idss');
            $('#closure_id').val(closure_id);

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
                "url": "<?php echo site_url('crm_new/Enquiry_allocation/ajax_list') ?>",
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
        $('#delConf').click(function(){
            setTimeout(function(){
                table.ajax.reload(null, false);
            },250);
            
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