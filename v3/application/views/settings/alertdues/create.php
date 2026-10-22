<form method="post" id="frmcreate" back="<?php echo site_url('settings/AlertDues/listall'); ?>" action="<?php echo site_url('settings/AlertDues/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/AlertDues/listall/'); ?>" class="btn btn-success align-bottom" href="<?php echo site_url('settings/AlertDues/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">
                                Company*<span class="required"></span> :
                            </label>
                            <div class="col-sm-4">
                               <select name="company_id" id="company_id" class="form-control" <?php echo ($view == 'edit') ? 'disabled' : ''; ?> data-validation="required">
                                    <option value="">Select</option>
                                </select>              
                            </div>
                            <label class="col-sm-2 control-label">
                                Type*<span class="required"></span> :
                            </label>
                             <div class="col-sm-4">
                               <select name="type" id="type" class="form-control" data-validation="required">
                                    <option value="">Select</option>
                                    <option value="alert">Alert</option>
                                    <option value="dues">Dues</option>
                                </select>              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">
                                Time Out (seconds)*<span class="required"></span> :
                            </label>
                            <div class="col-sm-4">
                                <input id="time_out" class="form-control" name="time_out" type="number" value="" data-validation="required">              
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label class="col-sm-2 control-label">
                                Alert & Dues Message*<span class="required"></span> :
                            </label>
                            <div class="col-sm-8">
                                <textarea id="message" class="form-control" name="message" style="height: 300px;" data-validation="required"></textarea>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        $(document).ready(function () {
            getcompanies();
            load();
        });

        function getcompanies() {
            $.ajax({
                url: "<?php echo site_url('settings/AlertDues/getcompanies'); ?>/",
                async: false,
                success: function (result) {
                    $("#company_id").html(result);
                }
            });
        }

        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/AlertDues/getsing'); ?>/" + id,
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
</form>
