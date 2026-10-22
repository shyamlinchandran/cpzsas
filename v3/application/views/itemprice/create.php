
<form method="post"  id="frmcreate" back="<?php echo site_url('settings/itemprice/create'); ?>" action="<?php echo site_url('settings/itemprice/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?= $id ?>" name="itemid" id="itemid" /> 
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary"> 
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Item Price', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('settings/customerprice/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('settings/customerprice/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div>
                    <div class="box-body">
                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               <?= label('Item Name', $this, $user) ?> <span class="required"></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <input id="itemname" class="form-control" name="itemname" type="text" value="" data-validation="required" maxlength="50">              
                            </div> 
                        </div>



                        <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Price Title', $this, $user) ?><span class="required"></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <input id="pname" class="form-control" name="pname" type="text" value="" maxlength="50">              
                            </div> 
                        </div>

                         <div class="form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                               <?= label('Sales Rate', $this, $user) ?> <span class="required"></span>  :
                            </label>
                            <div class="col-sm-6" id="name_input_box">

                                <input id="srate" class="form-control" name="srate" type="text" value="" maxlength="50">              
                            </div> 
                        </div>
                    </div> 
                </div>
    <?php if ($view != 'view') { ?>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>   
     <?php } ?>
 </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
    </section>
    <script type="text/javascript">

          function loadItem(ui) {
        $('#itemid').val(ui.item.id);
        $('#itemname').val(ui.item.name);
        $('#srate').val(ui.item.srate);
        }

        $(document).ready(function () {
            load(); 
        });
        var inc_inary = 0; 
        
        $(document).on('click', ".remove", function () {
            $('.tooltip').remove();
            $(this).closest('tr').remove();
        });

        function load() {
            var id = $("#id").val();
            //alert(id);
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('settings/itemprice/getsing'); ?>/" + id,
                    success: function (results) {
                        var result = JSON.parse(results);
                        $("#itemname").val(result.itemname);
                        $("#pname").val(result.pname);
                        $("#srate").val(result.srate);
                    }
                });
            }

         $("#itemname").autocomplete({
                source: "<?php echo site_url('settings/itemprice/getitem'); ?>",
                minLength: 1,
                select: function (event, ui) {
                    loadItem(ui);

                   }
            });
            }
    </script>