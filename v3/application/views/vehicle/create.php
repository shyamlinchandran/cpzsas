<form method="post"  id="frmcreate" back="<?php echo site_url('vehicle/VehicleController/listall'); ?>" action="<?php echo site_url('vehicle/VehicleController/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden"  value="no" id="ledger_hide" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php
                            $title = label($title, $this, $user);
                            echo ucwords(str_replace('_', ' ', $title));
                            ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('vehicle/VehicleController/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('vehicle/VehicleController//listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" >
                        <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Customer Name', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >

                                    <input id="cus_id" class="form-control" name="cus_id" type="hidden"  data-validation="required" maxlength="50">              
                                     <input id="cus_name" class="form-control" name="cus_name" type="text"  data-validation="required" maxlength="50">              
                                </div>
                            </div>  
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Vehicle Name', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="veh_name" class="form-control" name="veh_name" type="text"  data-validation="required" maxlength="50">              
                                </div>
                            </div>                              
                                <div class="col-sm-6 form-group odd_cls">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Vehicle No', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="veh_no" class="form-control" name="veh_no" type="text" value=""   maxlength="50" data-validation="required">              
                                    </div> 
                                </div>

                                <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Vehicle Model', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input type="text" class="form-control" name="veh_model" id="veh_model" data-validation="required"/>             
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-sm-12" >                            
                           
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Vehicle Brand', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="veh_brand" class="form-control" name="veh_brand" type="text"  maxlength="50" data-validation="required">
                                </div>
                            </div> 
                        </div>
                        <div class="form-group" >
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

            $("#cus_name").autocomplete({
            source: "<?php echo base_url(); ?>crm_service/Enquiry_allocation/getcustomerdet/", // path to the get_birds method
            minLength: 1,
            select: function(event, ui) {
                $("#cus_id").val(ui.item.id);
            }
        });
           
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('vehicle/VehicleController/get_sing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#cus_name").val(result.name);
                        $("#veh_name").val(result.veh_name);
                        $("#veh_no").val(result.veh_no);
                        $("#veh_model").val(result.veh_model);
                        $("#veh_brand").val(result.veh_brand);

						
                    }
                });
            }
          
           
        });
           
       
        
    </script>
