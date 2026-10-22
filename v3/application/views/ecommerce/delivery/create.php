<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post"  id="frmcreate" back="<?php echo site_url('ecommerce/Delivery_method/list_all/') . $type; ?>" action="<?php echo site_url('ecommerce/Delivery_method/save/'); ?>"  class="form-horizontal"> 
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= label($title, $this, $user) ?>
                        </h3>
                        <span class="pull-right">
                            <a role="button" class="btn  btn-info align-bottom" href="<?php echo site_url('ecommerce/Delivery_method/list_all/') . $type; ?>" title="cancel">
                                <span class="glyphicon glyphicon-arrow-left"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label($title, $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="delivery_method" class="form-control" name="delivery_method" type="text" value="" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box">
                                    <?= label($text, $this, $user) ?> Amount<span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="delivery_amt" class="form-control two-digits" name="delivery_amt" type="text" value="" maxlength="50">              
                                </div> 
                            </div>

                        </div>
                        <div class="col-sm-12">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" id="name_display_as_box"><br />
                                    Applicable States<span class="required"></span>  :
                                </label>
                                <div id="statediv" class="col-sm-8" style="margin-bottom: 20px;padding: 20px;">

                                </div>
                            </div>
                        </div>
                        <br />
                        <div class="box-footer">
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
    <script type="text/javascript">
        load();
        function load() {
            var id = $('#id').val();
            $.ajax({
                async: false,
                url: "<?php echo site_url('ecommerce/Delivery_method/get_state'); ?>/" + id,
                success: function (result) {
                    var text = "";
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        var check = "";
                        if (itemsingle.state !== "0") {
                            check = "checked";
                        }
                        text = text + "<input "+check+" type='checkbox' name='state[]' value='" + itemsingle.StateID + "'>" + itemsingle.StateName + " <br />   ";
                    });

                    $('#statediv').html(text);
                }
            });
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('ecommerce/Delivery_method/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#delivery_method").val(result.delivery_method);
                        $("#delivery_amt").val(result.amount);
                    }
                });
            }
        }
    </script>
