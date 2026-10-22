<!-- 
    *********************************************************************************************
    *adddiscount
    *
    *
    *@author Althaf
    *@created on : 12-10-2019
    *
    *******************************************************************************************
 -->
<form method="post" id="frmcreatemodelc" back="<?php echo site_url('education/Student/listDoc'); ?>" action="<?php echo site_url('education/Student/saveDoc'); ?>" class="form-horizontal">
    <input type="hidden" value="<?php echo $id; ?>" id="id" name="id">
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Document Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('education/Student/listDoc'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('education/Student/listDoc'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>
                    <input type="hidden" name="invoice" id='invoice' />
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-12 ">

                                <div class="col-sm-6">
                                    <label class="col-sm-4">
                                        <?= label('Document Type', $this, $user) ?> <span class="required"></span> :
                                    </label>
                                    <div class="col-sm-8">
                                        <input type="text" id = "type" name = "type" class="form-control" placeholder="Eg: SSLC">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="col-sm-4">
                                        <?= label('Note', $this, $user) ?>
                                    </div>
                                    <div class="col-sm-8">
                                        <textarea class="form-control" name="note" id="note"></textarea>
                                    </div>
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
    load();

    function load() {

        var id = $('#id').val();

        if (id > 0) {

            $.ajax({
                url: "<?php echo site_url('education/Student/getDoc'); ?>/" + id,
                success: function(results) {
                    var result = JSON.parse(results);
                    $("#type").val(result.document_name);
                    $("#note").val(result.note);
                }
            });
        }


    }
</script>