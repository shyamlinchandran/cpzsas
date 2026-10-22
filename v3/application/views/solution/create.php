<form method="post" id="frmcreate"  enctype="multipart/form-data" home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('Solution/list_all'); ?>" action="<?php echo site_url('Solution/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Solution', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('Solution/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> :
                                </label>
                                <div class="col-sm-9">
                                    <input name="name" type="text" id="name" data-validation="length" data-validation-length="min2"   class="form-control"placeholder=Name>     
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="description" class="form-control" name="description" type="text" value="" >              
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Category', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="category" id="category">  
                                    </select>  								
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Subcategory', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="subcategory" id="subcategory">

                                    </select>           
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <div class="col-sm-6">
                                <label class="col-sm-3 control-label" id="name_display_as_box">
                                    <?= label('Tax', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="tax" id="tax">

                                    </select>   
                                </div> 			
                            </div>
                            <div class="col-sm-6">
                                <input type="hidden" name="hiddlogo" id="hiddlogo" />
                                <label class="col-sm-2 control-label" id="name_display_as_box">
                                    <?= label('Image', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <input type="hidden" name="  " id="hiddlogo" />
                                <div class="col-sm-" id="name_input_box">
                                    <input type="file" id="file" name="file" /> 
                                </div>
                            </div>
                        </div>           
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Field1', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="field1" class="form-control" name="field1" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Field2', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="field2" class="form-control" name="field2" type="text" value="" >              
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="box-footer">          
                    <?php
                    if ($type != 'view') {
                        echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                    }
                    ?>      

                </div>
                <div class=" hidden">
                    <i class="fa fa-refresh fa-spin"></i>
                </div>


            </div> 

    </section>
</form>
<script type="text/javascript">
    $.ajax({
        url: "<?php echo site_url('Solution/category'); ?>",
        success: function (result) {
            $('#category').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('Solution/subcategory'); ?>",
        success: function (result) {
            $('#subcategory').html(result);
        }
    });
    $.ajax({
        url: "<?php echo site_url('Solution/tax'); ?>",
        success: function (result) {
            $('#tax').html(result);
        }
    });
    load();
    function load() {
        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('Solution/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#tax").val(result.tax);
                    $("#name").val(result.name);
                    $("#description").val(result.description);
                    $("#subcategory").val(result.subcategory);
                    $("#category").val(result.category);
                    $("#field1").val(result.field1);
                    $("#field2").val(result.field2);
                }
            });
        }
    }
</script>
