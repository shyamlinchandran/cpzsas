<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('vehicle/vehicledetails/list_all'); ?>" action="<?php echo site_url('vehicle/vehicledetails/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="veh_id" id="veh_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Vehicle Details', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('vehicle/vehicledetails/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Vehicle Name', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="veh_number" type="text" id="veh_number" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Type', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="veh_type" class="form-control" name="veh_type" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                        </div>
                    </div>  
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Engine Number', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="veh_engine" type="text" id="veh_engine" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Registration Date', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="veh_regdate" class="form-control" name="veh_regdate" type="text" value="" maxlength="15">              
                                </div> 
                            </div>
                        </div>
                    </div>  

                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Expiry Date', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="veh_expdate" type="text" id="veh_expdate" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
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
        </div>
    </section>
</form>


<script type="text/javascript">
    load();
    function load() {
        var veh_id = $("#veh_id").val();
        if (veh_id > 0) {
            $.ajax({
                url: "<?php echo site_url('vehicle/vehicledetails/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#veh_number").val(result.veh_number);
                    $("#veh_type").val(result.veh_type);
                    $("#veh_engine").val(result.veh_engine);
                    $("#veh_regdate").val(result.veh_regdate);
                    $("#veh_expdate").val(result.veh_expdate);


                }
            });
        }
    }
</script>
