<form method="post"  id="frmcreate" enctype="multipart/form-data" back="<?php echo site_url('master/coupons/listall'); ?>" action="<?php echo site_url('master/coupons/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Coupons', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('master/coupons/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('master/coupons/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Code', $this, $user) ?>  <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="ccode" class="form-control" name="ccode" type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Discount', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                   <input id="discount" class="form-control two-digits price" name="discount" type="text" value="" maxlength="50">             
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 form-group">
                                        <div class="col-sm-6   odd_cls">
                                            <label class="col-sm-4 control-label">
                                                <?= label('Start Date', $this, $user) ?>   <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="date_from" type="text" id="date_from"
                                                       data-validation="required" class="form-control hunpx date"
                                                       placeholder="Date">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 form-group">
                                            <label class="col-sm-4 control-label">
                                                <?= label('End Date', $this, $user) ?>  <span class="required"></span> :
                                            </label>
                                            <div class="col-sm-8">
                                                <input name="date_to" type="text" id="date_to"
                                                       data-validation="required" class="form-control hunpx date"
                                                       placeholder="Date">
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
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label('Discount %', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="discountp" class="form-control two-digits price" name="discountp" type="text" value="" maxlength="50">              
                                </div>
                            </div>
                            <?php if ($this->multiple != 0) { ?>
                                        <div class="col-sm-6">
                                            <label class="col-sm-4 control-label">
                                                <?= label('name_lan', $this, $user) ?>  :
                                            </label>
                                            <div class="col-sm-8">
                                                <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                            </div> 
                                        </div>
                                        <div class="col-sm-6 form-group odd_cls">

                                        </div>
                                    <?php } ?>
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
        function formatDate(input) {
        var datePart = input.match(/\d+/g),
                year = datePart[0].substring(2), // get only two digits
                month = datePart[1], day = datePart[2];

        return day + '/' + month + '/' + year;
    }
        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('master/coupons/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);  
                        $("#hiddlogo").val(result.cou_image);
                        if(result.cou_image!='')
                        {
                            $("#uploaded_pic").attr("src", "<?php echo base_url()?>"+"uploads/coupons/"+result.cou_image);
                        }
                        else
                        {
                            $("#old_image").hide();
                        }
                        $("#ccode").val(result.cou_code);
                        $("#name_lan").val(result.name_lan);
                        $("#date_from").val(formatDate(result.date_from));
                        $("#date_to").val(formatDate(result.date_to));
                        $("#discountp").val(result.cou_discountp);
                        $("#discount").val(result.cou_discount);
                        $("#published").val(result.published);
                    }
                });
            }

        }
    </script>