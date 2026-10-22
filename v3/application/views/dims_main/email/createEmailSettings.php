<form method="post" id="frmcreate" back="<?php echo site_url('dims_main/Main/listEmailSettings'); ?>" action="<?php echo site_url('dims_main/Main/saveEmailSettings'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id ?>" name="id" id="id" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add Settings</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('dims_main/Main/listEmailSettings'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('dims_main/Main/listEmailSettings'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('SMTP Host', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="host" name="host" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('SMTP Username', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="username" name="username" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('SMTP Password', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="password" name="password" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('SMTP Port', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="port" name="port" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('From Address', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="from_address" name="from_address" />
                                </div>
                            </div>

                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Reply Adress', $this, $user) ?>
                                    <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="reply_address" name="reply_address" />
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.box -->
                    <div class="box-footer">
                        <button id="form-button-save" type='submit' data-toggle="tooltip" title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</form>
<script>
    $(document).ready(function() {
        var id = $("#id").val();
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('dims_main/Main/getsing_emailsetting'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#host").val(result.smtp_host);
                    $("#username").val(result.smtp_username);
                    $("#password").val(result.smtp_password);
                    $("#port").val(result.smtp_port);
                    $("#from_address").val(result.from_address);
                    $("#reply_address").val(result.reply_address);
                }
            });
        }
    });
</script>