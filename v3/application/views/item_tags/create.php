<?php ?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('Item_tags/list_all/'); ?>" action="<?php echo site_url('Item_tags/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label('Tags Create', $this, $user) ?></h3>
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
                                    <?= label('Tag Name', $this, $user) ?>
                                    <br />
                                    <input id="tag_name" class="form-control" name="tag_name" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                            <div class="col-sm-4  odd_cls">

                                <div class="col-sm-12" >
                                    <?= label('Tag Code', $this, $user) ?>
                                    <br />
                                    <input id="tag_code" class="form-control" name="tag_code" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                            <div class="col-sm-4  odd_cls">

                                <div class="col-sm-12" >
                                    <?= label('Description', $this, $user) ?>
                                    <br />
                                    <input id="tag_des" class="form-control" name="tag_des" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                        </div>
                        <br />
                        <div style="padding-top: 30px;" class="col-sm-12">
                            <div class="col-sm-12  odd_cls">
                                <table  class="table table-striped table-condensed">
                                    <tr>
                                        <th><?= label('Name', $this, $user) ?></th>
                                        <th><?= label('Code', $this, $user) ?></th>
                                        <th><?= label('Description', $this, $user) ?></th>
                                        <th><?= label('Action', $this, $user) ?></th>
                                    </tr>
                                    <tr>
                                        <td><input id="sub_tag" class="form-control" name="sub_tag" type="text" value=""  placeholder="<?= label('Sub Tag', $this, $user) ?>" maxlength="250"></td>
                                        <td><input id="sub_tag_code" class="form-control" name="sub_tag_code" type="text" value=""  placeholder="<?= label('Sub Tag Code', $this, $user) ?>" maxlength="250"></td>
                                        <td><input id="description" class="form-control" name="description" type="text" value=""  placeholder="<?= label('Description', $this, $user) ?>" maxlength="250"></td>
                                        <td><button data-toggle="tooltip" type="button"  id="addmore"  title="Add To save"   class="btn btn-success" href="#">
                                                <span class="glyphicon glyphicon-plus"></span> 
                                            </button></td>
                                    </tr>
                                    <tbody id="subtags">

                                    </tbody>
                                </table>
                            </div>

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
            $('#description').keydown(function (e) {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    var sub_tag = $('#sub_tag').val();
                    var sub_tag_code = $('#sub_tag_code').val();
                    var description = $('#description').val();
                    if (sub_tag !== "" && sub_tag_code !== "") {
                        addrow(sub_tag, sub_tag_code, description);
                        $('#sub_tag').val('');
                        $('#sub_tag_code').val('');
                        $('#description').val('');
                    }
                }
            });
            $("#addmore").click(function () {
                var sub_tag = $('#sub_tag').val();
                var sub_tag_code = $('#sub_tag_code').val();
                var description = $('#description').val();
                if (sub_tag != "" && sub_tag_code != "") {
                    addrow(sub_tag, sub_tag_code, description);
                    $('#sub_tag').val('');
                    $('#sub_tag_code').val('');
                    $('#description').val('');
                }
            });

        });



        function load() {
            var id = $("#id").val();
            if (id !== '0') {
                $.ajax({
                    url: "<?php echo site_url('Item_tags/gesing'); ?>/" + id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            addrow(itemsingle.name, itemsingle.code, itemsingle.description);
                            $('#tag_name').val(itemsingle.tag_name);
                            $('#tag_code').val(itemsingle.tagcode);
                            $('#tag_des').val(itemsingle.des);
                        });


                    }
                });
            }
        }


    </script> 