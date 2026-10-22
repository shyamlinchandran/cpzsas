<?php ?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('Item_tags/list_all/'); ?>" action="<?php echo site_url('Item_tags/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Item Tags Create', $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('Item_tags/list_all/'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('Item_tags/list_all/'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-4  odd_cls">
                                <div class="col-sm-12" >
                                    <?= label('Item', $this, $user) ?>
                                    <br />
                                    <input type="hidden" id="item_id" name="item_id">
                                    <input id="tag_item" class="form-control" name="tag_item" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                        </div>
                        <div id="divtag" class="col-sm-12">

                        </div>
                    </div>
                    <div class="box-footer" class="col-sm-12">
                        <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                    </div>
                </div>
            </div>
        </div>
        <!-- /.col -->

        <!-- /.row -->
    </section>
    <script type="text/javascript">
        function addrow(sub_tag, sub_tag_code, description) {
            var text = "<tr><td><input type='text' value='" + sub_tag + "' class='form-control'   name='sub[]' /></td><td><input class='form-control' value='" + sub_tag_code + "' type='text' name='tag[]' /></td><td><input class='form-control' value='" + description + "' type='text' name='des[]' /></td><td><span data-toggle='tooltip'   title='Remove' onclick='removekit(this)'    class='btn btn-danger remove' href='#'>  <span class='glyphicon glyphicon-remove-sign'></span>     </span></td></tr>";
            $('#subtags').append(text);
        }
        $(document).ready(function () {
            load();
            $("#tag_item").autocomplete({
                source: "<?php echo base_url(); ?>ajaxcall/items", // path to the get_birds method
                minLength: 2,
                select: function (event, ui) {
                    $("#item_id").val(ui.item.id);
                }
            });

        });



        function load() {
            var id = $("#id").val();
            $.ajax({
                url: "<?php echo site_url('Item_tags/getalltags'); ?>",
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                       
                    });


                }
            });
        }


    </script> 