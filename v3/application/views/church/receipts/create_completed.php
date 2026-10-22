<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/receipt_complete/create/'); ?>" action="<?php echo site_url('church/receipt_complete/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/receipt_complete/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/receipt_complete/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>             
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Receipt type*<span class="required"></span>  :
                            </label>
                             <div class="col-sm-4" id="name_input_box">
                                <select name="receipt_type" id="receipt_type" class="form-control" data-validation="required" >
                                    <option value="">Select</option>
                                    <?php foreach ($receipt_type as $type) { ?>
                                        <option value="<?php echo $type['rtp_id']; ?>"><?php echo $type['rtp_name']; ?></option>
                                    <?php } ?>
                                </select>            
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Family /  No<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                 <input id="familyno" class="form-control" name="familyno" type="text" value="" maxlength="50" data-validation="required"> 
                                 <input type="hidden" value="" name="familyid" id="familyid" /> 
                                  <input type="hidden" value="" name="ledgerid" id="ledgerid" />          
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Amount<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="rec_amount" class="form-control" name="rec_amount" type="text" value="" maxlength="50">             
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Paid?<span class="required"></span>  :
                            </label>
                             <div class="col-sm-4" id="name_input_box">
                                <select id="paid_status" name="paid_status" class="form-control">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>          
                            </div> 
                        </div>
                         <div class="col-sm-12 form-group" id="name_field_box"> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Created on<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="createdon" class="form-control hunpx date" name="createdon" type="text" value="" maxlength="50">            
                            </div> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Paid on<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="paidon" class="form-control hunpx date" name="paidon" type="text" value="" maxlength="50">            
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="btnsaved"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>     
            </div>
            <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            load();
            $('#btnsave').click(function () {
                var ms = $("#frmcreate").isValid();
                alert(ms)
                if (ms !== true) {
                    return;
                }
            });

        });
        function loadFamily(ui) {
        $('#familyno').val(ui.item.family);
        $('#familyid').val(ui.item.hed_id);
        $('#ledgerid').val(ui.item.ledgerid);
        
    } 
        function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
        var inc_inary = 0;
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });
       
        function load() {
            var id = $("#id").val();
            //alert(id);
            $("#receipt_type").change(function(){
            var receiptid = $(this).val();
            $.ajax({
                    url: "<?php echo site_url('church/receipt_generate/getreceipt_type/'); ?>/" + receiptid,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $('#receiptid').val(result.rtp_id);
                        $('#rec_amount').val(result.rtp_amount);
                        }
                });
         });
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('church/receipt_complete/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#receipt_type").val(result.rtp_id);
                        $("#familyno").val(result.family);
                        $("#familyid").val(result.hed_id);
                        $("#rec_amount").val(result.rec_amount);
                        $("#paid_status").val(result.rec_ispaid);
                        $("#createdon").fomatDate(val(result.rec_createdate));
                        $("#paidon").fomatDate(val(result.rec_paid_date));
                        }
                });
                
            }

        }
        $("#familyno").autocomplete({
                source: "<?php echo site_url('church/receipt_complete/family_name/'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    loadFamily(ui);

                   }
            });
    </script>