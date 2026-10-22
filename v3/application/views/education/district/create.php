<form method="post" id="frmcreatemodels" back="<?php echo site_url('district/District/list'); ?>" action="<?php echo site_url('district/District/save'); ?>" class="form-horizontal">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <!-- <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', '')) ?></h3> -->
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $view)) ?></h3>

                        <input id="id" class="form-control" name="id" type="hidden" value="<?= $id ?>" maxlength="50">

                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/district/District/list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('education/district/District/list'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('District', $this, $user) ?>:<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="district_name" data-validation="required" value="" class="form-control" name="district_name" type="text" maxlength="50">
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Code', $this, $user) ?>:<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="district_code" data-validation="required" value="" class="form-control" name="district_code" type="text" maxlength="50">
                                </div>
                            </div>
                            <!-- <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('select', $this, $user) ?> <span class="required"></span> 
                                </label>
                                <div class="col-sm-8">
                                    <select id="q_id" name="q_id" class="form-control">
                                        <option>select</option>
                                    </select>
                                </div>
                            </div> -->
                           
                            <!-- <div class="col-sm-12"> -->
                        </div>

                        <div class="col-sm-12">

                            <?php if ($view != 'view') { ?>

                                <div class="box-footer popuphide">
                                    <button type='submit' title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>


    </section>
</form>
<!-- </div> -->





<script type="text/javascript">  
    var id = $("#id").val();
   
    if (id > 0) {
        $.ajax({
            url: "<?php echo site_url('district/District/getsing'); ?>/" + id,
            success: function(results) {

                var result = JSON.parse(results);
              
                $("#district_name").val(result.district_name);
                $("#district_code").val(result.district_code);
                // $("#q_id").val(result.id);
            
            }
        });

    }

    // $.ajax({
    //     url: "<?php echo site_url('Qualifications/Qualifications/getElement'); ?>",
    //     success: function(result) {
    //         $('#q_id').html(result);
    //         $('#q_id').append(
    //             $('<option></option>').val("").html('all')
    //         );
    //     }
    // });
</script>