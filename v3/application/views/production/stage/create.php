<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('production/stage/stage_controller/listall'); ?>" action="<?php echo site_url('production/stage/stage_controller/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="id" id="id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('production/stage/stage_controller/listall'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" >
                                    <?= label(' Stage', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="stage" class="form-control" name="stage" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group"> 
                                <label class="col-sm-4 control-label" >
                                    <?= label('Order', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="order" class="form-control " name="order" type="text" data-validation="required" />             
                                </div>  
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" >
                                    <?= label(' Accept Only From Previous ', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="is_previous" name="is_previous" type="checkbox" value="True"  data-validation="required">              
                                </div> 
                            </div>
                       
                </div>
            </div>  
            <div class="box-footer">    
                <?php
                if ($view != 'view') {
                    echo '<button id="form-button-save"  type="submit" data-toggle="tooltip"   title="Save" class="btn bg-orange btn-flat"> <i class="glyphicon glyphicon-hdd"></i> </button>           
                        <div class="small-loading" id="FormLoading"> </div>';
                }
                ?>      
            </div>
            <div class=" hidden">
                <i class="fa fa-refresh fa-spin"></i>
            </div>
        </div>
        </div> 
    </section>
</form>
<script type="text/javascript">
    load();
    function load() {
        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('production/stage/stage_controller/getdata'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#stage").val(result.stage);
                    $("#order").val(result.order);
                    $("#is_previous").val(result.is_previous);

                  

                }
            });
        }
    }
 
</script>
