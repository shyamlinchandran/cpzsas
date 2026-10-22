<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/holidays/list_all'); ?>" action="<?php echo site_url('hr/holidays/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="holi_id" id="holi_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Holidays', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/holidays/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label" >
                                    <?= label(' Name', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="holi_name" class="form-control" name="holi_name" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group"> 
                                <label class="col-sm-4 control-label" >
                                    <?= label('Start Date', $this, $user) ?><span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="name_input_box">
                                    <input id="start_date" class="form-control date" name="start_date" type="text" data-validation="required" />             
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <label class="col-sm-4 control-label">
                                    <?= label('End Date', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" id="end_date">
                                    <input id="end_date" class="form-control date" name="end_date" type="text" data-validation="required" />           
                                </div> 
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
        </div> 
    </section>
</form>
<script type="text/javascript">
    load();
    function load() {
        var id = $("#holi_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/holidays/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#holi_name").val(result.holi_name);
                    $("#start_date").val(result.start_date);
                    $("#end_date").val(result.end_date);
                }
            });
        }
    }
 
</script>