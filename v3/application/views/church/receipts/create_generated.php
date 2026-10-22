<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/receipt_generate/create/'); ?>" action="<?php echo site_url('church/receipt_generate/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/receipt_generate/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/receipt_generate/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>    
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Month*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select id="rec_month" name="rec_month" class="form-control">
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>             
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Receipt type<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select name="receipt_type" id="receipt_type" class="form-control" >
                                    <option value="">Select</option>
                                    <?php foreach ($receipt_type as $type) { ?>
                                        <option value="<?php echo $type['rtp_id']; ?>"><?php echo $type['rtp_name']; ?></option>
                                    <?php } ?>
                                </select>            
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box"> 
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Created<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="createdon" class="form-control hunpx date" name="createdon" type="text" value="" maxlength="50">  
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Amount<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <input id="rec_amount" class="form-control" name="rec_amount" type="text" value="" maxlength="50"> 
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
         function loadCust(ui) {
        alert('test');
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
            $("#receipt_type").change(function(){
            var receiptid = $(this).val();
            $.ajax({
                    url: "<?php echo site_url('church/receipt_generate/getreceipt_type/'); ?>" + receiptid,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $('#receiptid').val(result.rtp_id);
                        $('#rec_amount').val(result.rtp_amount);
                        }
                });
         });
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('church/receipt_generate/getsing/'); ?>" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#rec_month").val(result.reg_month);
                        $("#receipt_type").val(result.rtp_id);
                        $("#createdon").val(formatDate(result.reg_createdon));
                        $("#rec_amount").val(result.reg_amount);
                        }
                });
            }

        }

    </script>