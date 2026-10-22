<form method="post"  id="frmcreate" back="<?php echo site_url('cost_analytics/analytics_centre/create'); ?>" action="<?php echo site_url('cost_analytics/analytics_centre/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php
                            $title = label($title, $this, $user);
                            echo ucwords(str_replace('_', ' ', $title));
                            ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('cost_analytics/analytics_centre/listall/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('cost_analytics/analytics_centre/listall/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12" >
                            <div class="col-sm-6 form-group odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Analytics-Centre Name', $this, $user) ?>*
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="name" class="form-control" name="name" type="text" value="" data-validation="required" maxlength="50">              
                                </div> 
                            </div>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Main Analytics-Centre', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="main_an" class="form-control" name="main_an" type="text" value="" maxlength="50">
                                    <input type="hidden" name="mainan_id" id="mainan_id"/>
                                </div>
                            </div>   
                        </div>
                        <div class="col-sm-12" >
                            <?php if ($this->multiple != 0) { ?>
                                <div class="col-sm-6 form-group odd_cls">
                                    <label class="col-sm-4 control-label">
                                        <?= label('name_lan', $this, $user) ?>  :
                                    </label>
                                    <div class="col-sm-8">
                                        <input id="name_lan" class="form-control" name="name_lan" type="text" value=""   maxlength="50">              
                                    </div> 
                                </div>
                            <?php } ?>
                            <div class="col-sm-6 form-group">
                                <label class="col-sm-4 control-label" >
                                    <?= label('Details', $this, $user) ?>
                                    <span class="required"></span>  :
                                </label>
                                <div class="col-sm-8" >
                                    <textarea id="details" class="form-control" name="details" cols="30" rows="50"></textarea>              
                                </div>
                            </div>
                        </div>

                        <div class="form-group" >
                        </div> 
                        <div class="box-footer">
                            <?php if ($view != 'view') { ?>
                                <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                            <?php } ?>
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
    </section>
    <script type="text/javascript">

        $(document).ready(function () {
            $('#mybtn').click(function () {
                var ms = $("#frmcreate").isValid();
                if (ms !== true) {
                    return;
                }


            });
            load();
        });
        function loadanalyt(ui) {
            $('#main_an').val(ui.item.any_name);
            $('#mainan_id').val(ui.item.any_id);
        }
        var inc_inary = 0;
        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('cost_analytics/analytics_centre/getsing_any'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#name").val(result.any_name);
                        $("#name_lan").val(result.name_lan);
                        $("#main_an").val(result.mainanname);
                        $("#mainan_id").val(result.mainanid);
                        $("#details").val(result.any_description);
                    }
                });
            }

        }
        $("#main_an").autocomplete({
            source: "<?php echo site_url('cost_analytics/analytics_centre/analyt_centres'); ?>",
            minLength: 1,
            select: function (event, ui) {
                loadanalyt(ui);

            }
        });
    </script>
