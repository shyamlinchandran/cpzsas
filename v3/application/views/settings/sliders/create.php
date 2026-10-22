<form method="post"  id="frmcreate" enctype="multipart/form-data" back="<?php echo site_url('settings/sliders/listall'); ?>" action="<?php echo site_url('settings/sliders/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Sliders', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/sliders/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/sliders/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Header', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="title" class="form-control" name="title" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <textarea id="description" class="form-control" NoTab="NoTab" name="description" cols="30" rows="50"></textarea>              
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <input type="hidden" name="hiddlogo" id="hiddlogo" />
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Image', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input type="file" id="file" name="file" /> 
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label tax_id" id="name_display_as_box">
                                    <?= label('Published', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <select name="published" id="published" class="form-control">
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                        </select>
                                </div>
                            </div>
                        </div>
                        <?php if ($view != 'create') { ?>                                
                        <div class="col-sm-12 form-group old_image" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label tax_id" id="name_display_as_box">
                                    <?= label('Image', $this, $user) ?> *<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <img width="200px" height = "180px" name="uploaded_pic" id="uploaded_pic" alt="no_image">
                                </div>
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
        });
        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/sliders/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);  
                        $("#hiddlogo").val(result.sli_image);
                        if(result.sli_image!='')
                        {
                            $("#uploaded_pic").attr("src", "<?php echo base_url()?>"+"uploads/sliders/"+result.sli_image);
                        }
                        else
                        {
                            $("#old_image").hide();
                        }
                        $("#title").val(result.sli_title);
                        $("#description").val(result.sli_description);
                        $("#published").val(result.published);
                    }
                });
            }

        }
    </script>