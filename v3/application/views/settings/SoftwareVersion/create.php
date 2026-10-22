<form method="post"  id="frmcreate" back="<?php echo site_url('settings/SoftwareVersion/create'); ?>" action="<?php echo site_url('settings/SoftwareVersion/save'); ?>"  class="form-horizontal">

    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title">Software Version</h3>
                    </div>

                    <div class="box-body">
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Software Version Name<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="version_name" class="form-control" name="version_name" type="text" value="" maxlength="50">              
                            </div> 
                        </div>

                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Folder Path<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="folder_path" class="form-control" name="folder_path" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                db_path<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="db_path" class="form-control" name="db_path" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
<!--                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Created Date<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">
                                <input id="created_date" class="form-control date" name="created_date" type="text"   maxlength="50">              
                            </div> 
                        </div>
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                Created By<span class="required"></span>  :
                            </label>
                            <div class="col-sm-10" id="name_input_box">

                                <input id="created_by" class="form-control" name="created_by" type="text" value="" maxlength="50">              
                            </div> 
                        </div>-->

                        <div class="box-footer">  
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
                        </div>
                        <div class=" hidden">
                            <i class="fa fa-refresh fa-spin"></i>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <script type="text/javascript">

        $(document).ready(function () {

            $("#Subscription").autocomplete({
                source: "<?php echo base_url(); ?>transaction/vouchers/search/led", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $("#chq_frm").val(ui.item.id);
                }
            });


        });

    </script>