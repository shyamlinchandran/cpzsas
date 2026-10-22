<form method="post" id="frmcreatemodels" back="<?php echo site_url('implementation_type/Implementation_type/list'); ?>" action="<?php echo site_url('implementation_type/Implementation_type/save'); ?>" class="form-horizontal">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $view)) ?></h3>
                        <input id="no_use" name="no_use" type="hidden" value="" maxlength="50">
                        <input id="id" name="id" type="hidden" value="<?= $id ?>" maxlength="50">

                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('implementation_type/Implementation_type/list'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('implementation_type/Implementation_type/list'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body with-border">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name', $this, $user) ?>*<span class="required"></span>
                                </label>
                                <div class="col-sm-8">
                                    <input id="name" data-validation="required" value="" class="form-control" name="name" type="text" maxlength="50" />
                                </div>
                            </div>

                        </div>
                        <div class="box-footer popuphide">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
</form>




<script type="text/javascript">
    var id = $("#id").val();


    if (id > 0) {
        $.ajax({
            url: "<?php echo site_url('implementation_type/Implementation_type/getsing'); ?>/" + id,
            success: function(results) {

                var result = JSON.parse(results);
                $("#name").val(result.name);
            }
        });

    }
</script>