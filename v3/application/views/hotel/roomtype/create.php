<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hotel/roomtype/list_all'); ?>" action="<?php echo site_url('hotel/roomtype/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="type_id" id="type_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Room Type', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hotel/roomtype/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label ">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="type_name" type="text" id="type_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
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
    $.ajax({
        url: "<?php echo site_url('hotel/Roomtype/floor'); ?>",
        success: function (result) {
            $('#type_floor').html(result);
        }
    });
    function load() {
        var type_id = $("#type_id").val();
        if (type_id > 0) {
            $.ajax({
                url: "<?php echo site_url('hotel/roomtype/getsing'); ?>/" + type_id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#type_name").val(result.type_name);
                    $("#type_description").val(result.type_description);
                    $("#type_floor").val(result.type_room);

                }
            });
        }
    }
</script>