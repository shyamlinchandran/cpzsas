<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/leavetype/list_all'); ?>" action="<?php echo site_url('hr/leavetype/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="leave_id" id="leave_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Leave Type', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/leavetype/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label ">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="leave_name" type="text" id="leave_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label ">
                                    <?= label('Is Active*', $this, $user) ?> <span class="required"></span>  :
                                </label> 
                                <div class="col-sm-8">
                                    <input type="radio" name="is_active" value="1"> Active
                                    <input type="radio" name="is_active" value="0"> Inactive
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Number Of Days', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="leave_days" class="form-control" name="leave_days" type="text" value="" maxlength="15">              
                                </div> 
                            </div
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
        var id = $("#leave_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/leavetype/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#leave_name").val(result.leave_name);
                    $("#leave_days").val(result.leave_days);
                }
            });
        }
    }
</script>
