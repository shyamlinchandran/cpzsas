<form method="post" id="frmcreatemodelc" back="<?php echo site_url('crm_general/Enquiry_allocation/listOtherofBuss'); ?>" action="<?php echo site_url('crm_general/Enquiry_allocation/saveOtherBussiness'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Add nature of Bussiness', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('crm_general/Enquiry_allocation/listOtherofBuss'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('crm_general/Enquiry_allocation/listOtherofBuss'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <input type="hidden" name="invoice" id='invoice' />
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 ">
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Type', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="type" class="form-control required" data-validation="required" name="type" type="text" value="" maxlength="50">
                                    </div>
                                </div>
                                <div class="col-sm-6 form-group">
                                    <label class="col-sm-4 control-label">
                                        <?= label('Note', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        <textarea id="note" class="form-control" name="note" type="text" value="" maxlength="50"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="box-footer">
                            <?php
                            if ($option != 'view') {
                                ?>
                                <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                            <?php
                            }
                            ?>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </div>
            <!-- /.row -->
    </section>
</form>

<script>
    var id = $('#id').val();
    if (id > 0) {
        $.ajax({
            url: '<?php echo site_url('crm_general/Enquiry_allocation/getAllBussOther'); ?>/' + id,
            success: function(result) {
                var results = JSON.parse(result)
                $('#type').val(results.type);
                $('#note').val(results.note);
            }
        })
    }
</script>