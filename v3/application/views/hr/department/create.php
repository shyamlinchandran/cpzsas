<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/department/list_all'); ?>" action="<?php echo site_url('hr/department/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="dept_id" id="dept_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Department', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/department/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="dept_name" type="text" id="dept_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="dept_description" class="form-control" name="dept_description" type="text" value="" maxlength="15">              
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
        var id = $("#dept_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/department/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#dept_name").val(result.dept_name);
                    $("#dept_description").val(result.dept_description);
                }
            });
        }
    }
</script>