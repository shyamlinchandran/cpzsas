<form method="post"  id="frmcreate" back="<?php echo site_url('sadmin/co_expiry/listall'); ?>" action="<?php echo site_url('sadmin/co_expiry/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $title)) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('sadmin/co_expiry/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('sadmin/co_expiry/listall/'); ?>">
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
                               <select name="company_id" id="company_id" class="form-control"  data-validation="required" >
                                    <option value="">Select</option>
                                </select>              
                            </div>
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Mac Address*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="mac_address" class="form-control" name="mac_address" type="text" value="" maxlength="50" data-validation="required" ></div>

                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                End Date*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <input id="end_date" class="form-control date" name="end_date" type="text" value="" data-validation="required" maxlength="50"></div>
                        </div>
                        <?php if ($view == 'view') { ?>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Licence Key<span class="required"></span>  :
                            </label>
                            <div class="col-sm-4" id="name_input_box">
                                <textarea id="licence_key" class="form-control" name="licence_key" cols="30" rows="50"></textarea>              
                            </div>
                        </div>
                        <?php } ?>
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
                url: "<?php echo site_url('sadmin/co_expiry/getcompanies'); ?>/",
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
                    url: "<?php echo site_url('sadmin/co_expiry/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                         $("#company_id").val(result.company_id);
                        $("#mac_address").val(result.mac_address);
                        $("#licence_key").val(result.generated_key);
                        $("#end_date").val(formatDate(result.end_date));                        
                    }
                });
            } 
        }
    </script>