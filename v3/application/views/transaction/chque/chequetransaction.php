<?php 
$user = $this->session->userdata('user');
$user_id = $user['Id'];	
?>
<style>
    .compact-details { font-size: 14px; }
    .compact-details strong { color: #555; }
    .compact-details .val { color: #000; font-weight: 500; }
    .box-title { font-weight: bold; }
    .overlay-locked { background: rgba(255,255,255,0.7); position: absolute; top:0; left:0; width:100%; height:100%; z-index: 50; display: flex; align-items: center; justify-content: center; }
    .step-box { min-height: 350px; }
</style>
<section class="content"> 
    <input type="hidden" value="<?= $id ?>" name="chq_id" id="id" /> 
    <input type="hidden" value="<?php echo $user_id; ?>" name="user_id" id='user_id' />
    
    <!-- Section 1: Cheque Details (Top) -->
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-info-circle text-blue"></i> <?= label('Cheque Details', $this, $user) ?></h3>
                    <span class="pull-right">
                        <button type="button" id="btn_edit_details" class="btn btn-warning btn-sm"><i class="glyphicon glyphicon-edit"></i> Edit Details</button>
                        <a role="button" class="btn btn-success btn-sm align-bottom" href="<?php echo site_url('transaction/chque/list_all'); ?>">
                            <span class="glyphicon glyphicon-arrow-left" title="back"></span> Back to List
                        </a>
                    </span>
                </div>
                
                <!-- Readonly Details -->
                <div class="box-body compact-details" id="details_readonly">
                    <div class="row" style="margin-bottom: 10px;">
                        <div class="col-md-3"><strong>Branch:</strong> <span class="val" id="ro_branch"></span></div>
                        <div class="col-md-3"><strong>Transaction Type:</strong> <span class="val" id="ro_chq_trans"></span></div>
                        <div class="col-md-3"><strong>Date:</strong> <span class="val" id="ro_chq_date"></span></div>
                        <div class="col-md-3"><strong>Amount:</strong> <span class="val text-green" style="font-size:16px;" id="ro_chq_amount"></span></div>
                    </div>
                    <div class="row">
                        <div class="col-md-3"><strong>Bank:</strong> <span class="val" id="ro_chq_bank"></span></div>
                        <div class="col-md-3"><strong>Cheque No:</strong> <span class="val" id="ro_chq_no"></span></div>
                        <div class="col-md-3"><strong>From/To:</strong> <span class="val" id="ro_chqe_party"></span></div>
                        <div class="col-md-3"><strong>Details:</strong> <span class="val" id="ro_chq_details"></span></div>
                    </div>
                </div>

                <!-- Editable Form (Hidden initially) -->
                <div class="box-body" id="details_editable" style="display:none; background-color:#fcfcfc; border-top: 1px solid #f4f4f4;">
                    <form method="post" id="frmcreate" action="<?php echo site_url('transaction/chque/save'); ?>" class="form-horizontal">
                        <input type="hidden" value="<?= $id ?>" name="chq_id" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Branch <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <select id="branch" name="branch" class="form-control"></select> 
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Transaction Type <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <select id="chq_trans" name="chq_trans" class="form-control"> 
                                            <option value="Clearing">PDC Clearing</option>
                                            <option value="Issue">Issue</option>
                                        </select>     
                                    </div> 
                                </div>
                                <div class="form-group" id="check_From">
                                    <label class="col-sm-4 control-label">Cheque From <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="chq_frm" name="chq_frm"/> 
                                        <input type="text" class="form-control" id="chqe_frm" data-validation="required"/>         
                                    </div> 
                                </div>
                                <div class="form-group" id="check_To">
                                    <label class="col-sm-4 control-label">Cheque To <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input type="hidden" id="chq_to" name="chq_to"/> 
                                        <input type="text" class="form-control" id="chqe_to" data-validation="required">              
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Date <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input id="chq_date" class="form-control date" name="chq_date" type="text" data-validation="required">              
                                    </div> 
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cheque Number <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input id="chq_no" class="form-control" name="chq_no" type="text" data-validation="required">              
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Cheque Amount <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input id="chq_amount" class="form-control price" name="chq_amount" type="number" data-validation="required">              
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Bank <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input id="chq_bank" class="form-control" name="chq_bank" type="text" data-validation="required">              
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Details <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <input id="chq_details" class="form-control" name="chq_details" type="text" data-validation="required">              
                                    </div> 
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-4 control-label">Collected By <span class="required">*</span>:</label>
                                    <div class="col-sm-8">
                                        <select id="collected_by" name="collected_by" class="form-control"></select>     
                                    </div> 
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button type="button" id="btn_cancel_edit" class="btn btn-default">Cancel</button>
                            <button type="submit" id="form-button-save" class="btn bg-orange">Save Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Section 2: Transaction Process -->
    <div class="row" style="margin-top: 20px;">
        <div class="col-xs-12">
            <div class="box box-success">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-cogs text-green"></i> Cheque Transaction Process</h3>
                </div>
                <div class="box-body" style="background-color: #f9f9f9; padding: 20px;">
                    <div class="row">
        
        <!-- Block 1: Clear Cheque -->
        <div class="col-md-6">
            <div class="box box-info step-box" id="block_clear">
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="badge bg-aqua">1</span> Clear Cheque</h3>
                </div>
                <div class="box-body" style="padding: 15px;">
                    <form id="frm_clear">
                        <input type="hidden" name="chq_id" value="<?= $id ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary">Select Bank <span class="required">*</span></label>
                                    <input type="hidden" name="chq_to" id="clear_chq_to">
                                    <input type="text" id="clear_chqe_to" class="form-control" placeholder="Search Bank Ledger..." required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-primary">Clear Date <span class="required">*</span></label>
                                    <input type="text" name="clear_date" id="clear_date" class="form-control date" placeholder="DD/MM/YYYY" required autocomplete="off">
                                </div>
                            </div>
                        </div>
                        
                        <p class="text-muted" style="margin-top:10px;">Tag Ageing Invoices to clear this cheque.</p>
                        <div class="checkbox" style="margin-bottom:10px;">
                            <label>
                                <input type="checkbox" id="autoCheck"> <strong>Auto Allocate Amount</strong>
                            </label>
                        </div>
                        <div style="max-height:220px; overflow-y:auto; border: 1px solid #ddd;">
                            <table id="inc_table" class="table table-bordered table-striped table-hover" width="100%" style="margin-bottom:0;">
                                <thead style="background:#f4f4f4;">
                                    <tr>
                                        <th>Date</th>
                                        <th>Voucher</th>
                                        <th>Bal</th>
                                        <th>Pay</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <button type="button" id="btn_clear_cheque" class="btn btn-info btn-block" style="margin-top:15px;" disabled>Confirm Clear</button>
                    </form>
                </div>
                <div class="overlay-locked" id="overlay_clear" style="display:none;">
                    <div class="text-center">
                        <i class="fa fa-check-circle text-green" style="font-size:40px;"></i>
                        <p class="text-green" style="margin-top:10px; font-weight:bold;">Cheque Cleared</p>
                        <button type="button" id="btn_remove_cleared" class="btn btn-warning btn-sm" style="margin-top:10px;"><i class="fa fa-undo"></i> Remove Cleared</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Block 2: Bounce -->
        <div class="col-md-6">
            <div class="box box-danger step-box" id="block_bounce">
                <div class="box-header with-border">
                    <h3 class="box-title"><span class="badge bg-red">2</span> Bounce Cheque</h3>
                </div>
                <div class="box-body text-center" style="padding: 40px 20px;">
                    <i class="fa fa-exclamation-triangle text-red" style="font-size:50px; margin-bottom:20px;"></i>
                    <p class="text-muted" style="margin-bottom:20px;">If this cheque bounces after being successfully cleared, provide the bounce date and click below to reverse the transaction.</p>
                    
                    <div class="form-group text-left" style="max-width:250px; margin: 0 auto 20px auto;">
                        <label class="text-danger">Bounce Date <span class="required">*</span></label>
                        <input type="text" id="bounce_date" name="bounce_date" class="form-control date" placeholder="DD/MM/YYYY" required autocomplete="off">
                    </div>

                    <button type="button" id="btn_bounce_cheque" class="btn btn-danger btn-lg btn-block" disabled><i class="fa fa-ban"></i> Bounce Cheque</button>
                </div>
                <div class="overlay-locked" id="overlay_bounce">
                    <div class="text-center">
                        <i class="fa fa-lock text-muted" style="font-size:40px;"></i>
                        <p class="text-muted" style="margin-top:10px;">Cheque must be Cleared first</p>
                    </div>
                </div>
            </div>
        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</section>

<script type="text/javascript">
    var inc_table;
    var global_chq_amount = 0;
    var global_chq_status = 'Submitted';
    var global_chq_trans = 'Clearing';
    var global_party_id = 0;

    $(document).ready(function () {
        // Load initial data
        $.ajax({
            url: "<?php echo site_url('ajaxcall/salesman'); ?>",
            async: false,
            success: function(result) {
                $('#collected_by').html(result);
                var user_id = $('#user_id').val();
                $('#collected_by').val(user_id);
            }
        });
        
        $.ajax({
            url: "<?php echo site_url('Ajaxcall/branch'); ?>/",
            async: false,
            success: function (result) {
                $("#branch").html(result);
                $("#branch option[value='']").remove();
            }
        });

        // Initialize Datepickers (assuming CodeIgniter setup has .date class initialized elsewhere, but we can bind change here)
        $(document).on('change', '#clear_date, #clear_chq_to, .txtamt', validateClearForm);
        $(document).on('change', '#bounce_date', validateBounceForm);
        // Also trigger on keyup
        $(document).on('keyup', '#clear_date, #clear_chqe_to', validateClearForm);
        $(document).on('keyup', '#bounce_date', validateBounceForm);

        loadData();

        // Autocomplete for Editable Details Form
        $("#chqe_frm").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led",
            minLength: 2,
            select: function (event, ui) { $("#chq_frm").val(ui.item.id); }
        });
        $("#chqe_to").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led",
            minLength: 2,
            select: function (event, ui) { $("#chq_to").val(ui.item.id); }
        });

        // Autocomplete for Block 1 (Bank Selection)
        $("#clear_chqe_to").autocomplete({
            source: "<?php echo base_url(); ?>transaction/vouchers/search/led/1",
            minLength: 2,
            select: function (event, ui) { 
                $("#clear_chq_to").val(ui.item.id); 
                validateClearForm();
            }
        });

        // Toggle Details Edit
        $('#btn_edit_details').click(function() {
            $('#details_readonly').hide();
            $('#details_editable').slideDown();
        });
        $('#btn_cancel_edit').click(function() {
            $('#details_editable').slideUp(function() {
                $('#details_readonly').show();
            });
        });

        // Transaction Type Toggle logic
        $("#chq_trans").change(function () { smload(); });

        // Save Details Form
        $('#frmcreate').submit(function(e) {
            e.preventDefault();
            var url = $(this).attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: $(this).serialize(),
                success: function(res) {
                    toastr["success"]('Details Saved Successfully');
                    $('#details_editable').slideUp();
                    $('#details_readonly').show();
                    loadData(); // refresh readonly data
                }
            });
        });

        // Auto allocation logic (Ageing)
        $(document).on('change', '#autoCheck', function() {
            var autoCheck = $(this).is(':checked');
            var totalamount = parseFloat(global_chq_amount);
            var collection = $(".chkchg");
            
            if (autoCheck) {
                if (totalamount > 0) {
                    collection.each(function() {
                        $(this).prop('checked', true);
                        var id = $(this).attr('id');
                        var hdcrdt = $("#hdcrdt" + id).val();
                        if(global_chq_trans !== 'Issue') {
                            hdcrdt = $("#hddbt" + id).val();
                        }
                        var txtamt = "#txtamt" + id;
                        
                        if (totalamount < parseFloat(hdcrdt)) {
                            $(txtamt).val(totalamount.toFixed(2));
                            totalamount = 0;
                        } else {
                            $(txtamt).val(hdcrdt);
                            totalamount = (totalamount - parseFloat(hdcrdt)).toFixed(2);
                        }
                        $(txtamt).attr('readonly', 'readonly');
                    });
                }
            } else {
                collection.each(function() {
                    $(this).prop('checked', false);
                    var id = $(this).attr('id');
                    var txtamt = "#txtamt" + id;
                    $(txtamt).val('0.00');
                    $(txtamt).removeAttr('readonly');
                });
            }
            validateClearForm();
        });

        // Submit Block 1 (Clear Cheque)
        $('#btn_clear_cheque').click(function() {
            var data = $('#frm_clear').serializeArray();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('transaction/Chque/transaction_clear'); ?>",
                data: data,
                success: function(res) {
                    var json = JSON.parse(res);
                    if (json.valid) {
                        toastr["success"](json.message);
                        loadData(); // reload everything
                    } else {
                        toastr["error"](json.message);
                    }
                }
            });
        });

        // Submit Block 2 (Bounce Cheque)
        $('#btn_bounce_cheque').click(function() {
            var bDate = $('#bounce_date').val();
            bootbox.confirm("Are you sure you want to Bounce this Cheque on " + bDate + "?", function(result){
                if(result){
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url('transaction/Chque/transaction_bounce/'.$id); ?>",
                        data: { bounce_date: bDate },
                        success: function(res) {
                            var json = JSON.parse(res);
                            if (json.valid) {
                                toastr["success"](json.message);
                                loadData(); // refresh
                            } else {
                                toastr["error"](json.message);
                            }
                        }
                    });
                }
            });
        });

        // Remove Cleared
        $(document).on('click', '#btn_remove_cleared', function() {
            bootbox.confirm("Are you sure you want to undo the Cleared status? This will reverse the ageing allocations and unpublish the ledger entries.", function(result){
                if(result){
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url('transaction/Chque/transaction_remove_cleared/'.$id); ?>",
                        success: function(res) {
                            var json = JSON.parse(res);
                            if (json.valid) {
                                toastr["success"](json.message);
                                loadData(); // refresh
                            } else {
                                toastr["error"](json.message);
                            }
                        }
                    });
                }
            });
        });

        // Remove Bounced
        $(document).on('click', '#btn_remove_bounced', function() {
            bootbox.confirm("Are you sure you want to undo the Bounced status? This will unpublish the bounce ledger entries.", function(result){
                if(result){
                    $.ajax({
                        type: 'POST',
                        url: "<?php echo site_url('transaction/Chque/transaction_remove_bounced/'.$id); ?>",
                        success: function(res) {
                            var json = JSON.parse(res);
                            if (json.valid) {
                                toastr["success"](json.message);
                                loadData(); // refresh
                            } else {
                                toastr["error"](json.message);
                            }
                        }
                    });
                }
            });
        });

    });

    function validateClearForm() {
        var cDate = $('#clear_date').val();
        var cBank = $('#clear_chq_to').val();
        
        var tot = 0;
        $('.txtamt').each(function() {
            var amt = $(this).val() || 0;
            tot += parseFloat(amt);
        });

        if(tot > global_chq_amount) {
            toastr["error"]("Value Exceeded Cheque Amount");
            $('#btn_clear_cheque').attr('disabled', true);
            return;
        }

        if(cDate && cDate.trim() !== '' && cBank && cBank > 0) {
            $('#btn_clear_cheque').removeAttr('disabled');
        } else {
            $('#btn_clear_cheque').attr('disabled', true);
        }
    }

    function validateBounceForm() {
        var bDate = $('#bounce_date').val();
        if(bDate && bDate.trim() !== '') {
            $('#btn_bounce_cheque').removeAttr('disabled');
        } else {
            $('#btn_bounce_cheque').attr('disabled', true);
        }
    }

    function smload() {
        var val = $("#chq_trans").val();
        if (val === 'Clearing') {
            $('#check_From').show();
            $('#check_To').hide();
            $("#chq_to").val(0);
        } else {
            $('#check_From').hide();
            $('#check_To').show();
            $("#chq_frm").val(0);
        }
    }

    function loadData() {
        var id = $("#id").val();
        $.ajax({
            url: "<?php echo site_url('transaction/chque/getsing'); ?>/" + id,
            success: function (results) {
                var result = JSON.parse(results);
                
                // Populate Editable Form
                $("#collected_by").val(result.collected_by);
                $("#chq_trans").val(result.chq_trans);
                $("#chq_no").val(result.chq_no);
                $("#chq_amount").val(result.chq_amount);
                $("#chq_bank").val(result.chq_bank);
                $("#chq_details").val(result.chq_details);
                $("#branch").val(result.branch_id);
                $("#chq_frm").val(result.chq_frm);
                $("#chqe_frm").val(result.chqe_frm);
                $("#chq_to").val(result.chq_to);
                $("#chqe_to").val(result.chqe_to);
                if(result.chq_date) {
                    $("#chq_date").val(result.chq_date);
                }
                smload();

                // Populate Readonly Details
                $("#ro_branch").text($("#branch option:selected").text());
                $("#ro_chq_trans").text(result.chq_trans == 'Clearing' ? 'PDC Clearing' : 'Issue');
                $("#ro_chq_date").text(result.chq_date);
                $("#ro_chq_amount").text(result.chq_amount);
                $("#ro_chq_bank").text(result.chq_bank);
                $("#ro_chq_no").text(result.chq_no);
                $("#ro_chq_details").text(result.chq_details);
                
                var party = result.chq_trans == 'Clearing' ? result.chqe_frm : result.chqe_to;
                $("#ro_chqe_party").text(party);

                // Set Globals
                global_chq_amount = parseFloat(result.chq_amount);
                global_chq_status = result.chq_status;
                global_chq_trans = result.chq_trans;
                global_party_id = result.chq_trans == 'Clearing' ? result.chq_frm : result.chq_to;

                manageBlocks();
            }
        });
    }

    function manageBlocks() {
        // Reset Overlays
        $('#overlay_clear').hide();
        $('#overlay_bounce').show();
        $('#btn_remove_cleared').show(); // Reset button visibility
        
        // Disable edit button if fully processed
        if(global_chq_status === 'Cleared' || global_chq_status === 'bounced') {
            $('#btn_edit_details').hide();
        } else {
            $('#btn_edit_details').show();
        }

        if (global_chq_status === 'Submitted') {
            // Unlocked
            loadAgeingTable();
        } 
        else if (global_chq_status === 'Cleared') {
            $('#overlay_clear').show(); // Lock Clear block
            $('#overlay_bounce').hide(); // Unlock Bounce block
            // Reset bounce overlay html in case it was reverted
            $('#overlay_bounce').html('<div class="text-center"><i class="fa fa-lock text-muted" style="font-size:40px;"></i><p class="text-muted" style="margin-top:10px;">Cheque must be Cleared first</p></div>');
        }
        else if (global_chq_status === 'bounced') {
            $('#overlay_clear').show();
            $('#btn_remove_cleared').hide(); // Hide remove cleared if bounced
            // Lock Bounce block too with custom message
            $('#overlay_bounce').show();
            $('#overlay_bounce').html('<div class="text-center"><i class="fa fa-ban text-red" style="font-size:40px;"></i><p class="text-red" style="margin-top:10px; font-weight:bold;">Cheque Bounced</p><button type="button" id="btn_remove_bounced" class="btn btn-warning btn-sm" style="margin-top:10px;"><i class="fa fa-undo"></i> Remove Bounced</button></div>');
        }
    }

    function loadAgeingTable() {
        var status = (global_chq_trans === 'Clearing') ? 'rec' : 'pay';
        
        if ($.fn.DataTable.isDataTable('#inc_table')) {
            $('#inc_table').DataTable().destroy();
        }
        
        inc_table = $('#inc_table').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "order": [],
            "bPaginate": false,
            "searching": false,
            "bInfo": false,
            "ajax": {
                "url": "<?php echo site_url('reports/aging/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.type = status;
                    data.id = global_party_id; // Using party ID as derived from logic
                    data.cheque_id = $('#id').val();
                    data.vid = 0;
                    data.voucher_type = 'cheque';
                }
            },
            "columnDefs": [{"targets": [0], "orderable": false}]
        });
    }

</script> 
