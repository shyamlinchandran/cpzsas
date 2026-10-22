<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/role/list_all'); ?>" action="<?php echo site_url('hr/role/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="role_id" id="role_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Role', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/role/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input name="role_name" type="text" id="role_name" data-validation="length" data-validation-length="min2"   class="form-control" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Description', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input id="role_description" class="form-control" name="role_description" type="text" value="" maxlength="15">              
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
        var id = $("#role_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/role/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#role_name").val(result.role_name);
                    $("#role_description").val(result.role_description);
                }
            });
        }
    }
</script>