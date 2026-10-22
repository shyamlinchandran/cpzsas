<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hotel/roomrate/list_all'); ?>" action="<?php echo site_url('hotel/roomrate/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="room_id" id="room_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Room Rate', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hotel/roomrate/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12 ">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Amount', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input name="rate_amount" type="text" id="rate_amount" data-validation="length" data-validation-length="min2"   class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-3 control-label tax_id">
                                    <?= label('Exta Bed Cost', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-9">
                                    <input id="room_extrabed" class="form-control" name="room_extrabed" type="text" value="" maxlength="15">              
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
        var room_id = $("#room_id").val();
        if (room_id > 0) {
            $.ajax({
                url: "<?php echo site_url('hotel/roomrate/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#rate_amount").val(result.rate_amount);
                    $("#room_extrabed").val(result.room_extrabed);

                }
            });
        }
    }
</script>