<form method="post"  id="frmcreate" back="<?php echo site_url('settings/CompanyNotification/listall'); ?>" action="<?php echo site_url('settings/CompanyNotification/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/CompanyNotification/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/CompanyNotification/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Company*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                               <select name="company_id" id="company_id" class="form-control" <?php echo ($view == 'edit') ? 'disabled' : ''; ?> >
                                    <option value="">Select</option>
                                </select>              
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Type*<span class="required"></span>  :
                            </label>
                             <div class="col-sm-4" id="name_input_box">
                               <select name="type" id="type" class="form-control"  data-validation="required" >
                                    <option value="">Select</option>
                                    <option value="notification">Notification</option>
                                    <option value="support">Support</option>
                                </select>              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Time Out (seconds)*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="time_out" class="form-control" name="time_out" type="number" value="">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Notification & Support*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-8" id="name_input_box">
                                <textarea id="message" class="form-control" name="message" style="height: 300px;" data-validation="required"></textarea></div>
                        </div>
                        <div class="form-group" id="name_field_box">
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            load();
            getcompanies();
            });
        function formatDate(input) {
            var datePart = input.match(/\d+/g),
                    year = datePart[0].substring(2), // get only two digits
                    month = datePart[1], day = datePart[2];

            return day + '/' + month + '/' + year;
        }
        function getcompanies()
        {
            $.ajax({
                url: "<?php echo site_url('settings/CompanyNotification/getcompanies'); ?>/",
                async: false,
                success: function (result) {
                    $("#company_id").html(result);
                }
            });
        }
        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/CompanyNotification/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        if(Array.isArray(result) && result.length > 0) {
                            result = result[0];
                        }
                        $("#company_id").val(result.company);
                        $("#type").val(result.type);
                        $("#message").val(result.message);
                        $("#time_out").val(result.timeout);                        
                    }
                });
            } 
        }
    </script>