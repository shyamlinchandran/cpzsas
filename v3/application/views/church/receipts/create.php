<form method="post"  id="frmcreatemodel" back="<?php echo site_url('church/receipt_type/create/'); ?>" action="<?php echo site_url('church/receipt_type/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"   id="is_model" />  
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('church/receipt_type/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('church/receipt_type/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>             
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Name*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                For all family?<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <select id="isallfamily" name="isallfamily" class="form-control">
                                    <option value="true">Yes</option>
                                    <option value="false">No</option>
                                </select>             
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
                                Details<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <textarea id="description" name="description" class="form-control" cols="20" rows="50"></textarea>
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
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('church/receipt_type/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#name").val(result.rtp_name);
                        $("#rec_amount").val(result.rtp_amount);
                        $("#description").val(result.rtp_description);
                        $("#isallfamily").val(result.rtp_is_allmembers);
                        }
                });
            }

        }
    </script>