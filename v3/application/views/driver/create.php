<?php

$is_calendar = 0;
$txt_name = '';

$district = 'District';
$state = 'State';



if (isset($settings[0]['is_calendar'])) {
    $is_calendar = $settings[0]['is_calendar'];
    $district = 'District';
    $txt_name = 'First ';
}
?>

<form method="post" id="frmcreatemodeli" enctype="multipart/form-data" back="<?php echo site_url('Driver/listall'); ?>"
    action="<?php echo site_url('Driver/save'); ?>" class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $option; ?>" id="option" name="option">
    <input type="hidden" value="<?= $view ?>" name="view" id="view" />



    <input type="hidden" id="is_model" />
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            <?= label('Driver Create', $this, $user) ?>
                        </h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Driver/listall'); ?>"
                                class="btn  btn-success align-bottom" href="<?php echo site_url('Driver/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span>
                            </a>
                        </span>
                    </div>

                    <div class="box-body">

                        <div class="col-sm-12">
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Name', $this, $user) ?>*<span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="drivername" class="form-control" name="drivername" type="text" value=""
                                        data-validation="required" maxlength="50">
                                </div>
                            </div>

                            <div <?php if ((float) $is_calendar > 0) {
                                echo 'style="display:none"';
                            } ?>
                                class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('License No', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="licenseno" class="form-control" name="licenseno" type="text" value=""
                                        maxlength="50">

                                </div>

                            </div>
                            <div <?php if ((float) $is_calendar > 0) {
                                echo 'style="display:none"';
                            } ?>
                                class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Address', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                   <textarea id="address" class="form-control" name="address" type="text" value=""
                                        maxlength="50"></textarea>

                                </div>

                            </div>
                            <div <?php if ((float) $is_calendar > 0) {
                                echo 'style="display:none"';
                            } ?>
                                class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label">
                                    <?= label('Mobile No', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input id="mobileno" class="form-control" name="mobileno" type="text" value=""
                                        data-validation="required" maxlength="50">

                                </div>

                            </div>


                        </div>
                        <div class="box-body">


                            <div class="box-footer">
                                <?php if ($view != 'view') { ?>
                                    <button id="btnsaved" type='submit' data-toggle="tooltip" title='Save'
                                        class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>
                                <?php } ?>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
            </div> 
        </div>  <!-- /.row -->
    </section>
</form>





<script type="text/javascript">

    $(document).ready(function () {




        load();




    });


    function load() {
        var id = $("#id").val();
        var eid = $("#enq").val();
        var view = $("#view").val();
        var type = $("#type").val();

        if (id > 0) {
            var st = 0;
            var dis = 0;
            $.ajax({

                url: "<?php echo site_url('Driver/getdetails'); ?>/" + id,
                async: false,
                success: function (results) {
                    var result = JSON.parse(results);

                    $("#drivername").val(result.Driver_name);
                    $("#licenseno").val(result.licence_no);
                    $("#address").val(result.Address);
                    $("#mobileno").val(result.Mobile);


                }

            });

        }


    }
</script>