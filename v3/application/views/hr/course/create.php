<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('hr/course/list_all'); ?>" action="<?php echo site_url('hr/course/save'); ?>"   class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" name="course_id" id="course_id"/> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Course', $this, $user) ?></h3>
                        <span class="pull-right"> <a role="button"
                                                     class="btn  btn-success align-bottom"
                                                     href="<?php echo site_url('hr/course/list_all'); ?>"> <span
                                    class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-6  form-group">
                                <label class="col-sm-4 control-label tax_id">
                                    <?= label('Name*', $this, $user) ?> <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" name="course_name" class="form-control" id="course_name" data-validation="required">
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
        var id = $("#course_id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('hr/course/getsing'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results);
                    $("#course_name").val(result.course_name);
                }
            });
        }
    }
</script>