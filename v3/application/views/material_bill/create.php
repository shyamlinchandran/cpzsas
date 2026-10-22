<form method="post"  id="frmcreate" back="<?php echo site_url('material/material_bill/listall'); ?>" action="<?php echo site_url('material/material_bill/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?></h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('material/material_bill/listall'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('material/material_bill/listall'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Product', $this, $user) ?>*<span class="required"></span>  :
                            </label>
                            <div class="col-sm-3" id="name_input_box">
                                <input id="product_name" class="form-control" name="product_name" type="text" value="" data-validation="required" placeholder="Start typing.." maxlength="250">
                                <input id="product_id" class="form-control" name="product_id" type="hidden">             
                            </div>
                            <div class="col-sm-2" id="name_input_box">
                                <input id="p_quantity" class="form-control two-digits price" name="p_quantity" type="text" value="" maxlength="50" placeholder="Quantity" data-validation="required">
                            </div> 
                            <div class="col-sm-2" id="name_input_box">
                                <select name="p_unit_id" id="p_unit_id" class="form-control" data-validation="required">
                                    <!--   <option value="">Select</option> -->
                                    <?php foreach ($unit as $type) { ?>
                                        <option
                                            value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                        <?php } ?>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-12 form-group" id="name_field_box">
                            <label class="col-sm-2 control-label" id="name_display_as_box">
                                <?= label('Raw material', $this, $user) ?> *<span class="required"></span>:
                            </label>
                            <div class="col-sm-9" id="name_input_box">
                                <table class="table">
                                    <tbody id="rowm">
                                        <tr id="add">
                                            <td class="col-sm-4">
                                                <input id="rawm_name" placeholder="Raw Material" class="form-control" name="rawm_name" type="text">
                                                <input id="rawm_id" class="form-control phone" name="rawm_id" type="hidden" value="">
                                            </td>
                                            <td class="col-sm-2">
                                                <input id="r_quantity" placeholder="quantity" class="form-control two-digits price" name="r_quantity " type="text">
                                            </td>
                                            <td class="col-sm-2">
                                                <select name="r_unit_id" id="r_unit_id" class="form-control" data-validation="required">
                                                    <?php foreach ($unit as $type) { ?>
                                                        <option
                                                            value="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></option>
                                                        <?php } ?>
                                                </select>
                                            </td>
                                            <td>
                                                <a data-toggle="tooltip" style="float: left"
                                                   title="Add More" id="addmore" class="btn btn-success"
                                                   href="#"> <span class="glyphicon glyphicon-plus"></span>
                                                </a>
                                            </td>
                                        </tr>
                                </table>
                            </div>
                            <div class="form-group" id="name_field_box">
                            </div> 
                            <div class="box-footer">
                                <?php if ($view != 'view') { ?>
                                    <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                                <?php } ?>
                            </div>
                            <!-- /.box -->
                        </div>
                        <!-- /.col -->

                        <!-- /.row -->
                        </section>
                        <script type="text/javascript">

                            $(document).ready(function () {
                                var id = $("#id").val();
                                var idinc = 0;
                                $('#addmore').click(function () {
                                    idinc = idinc + 1;
                                    var rawm_id = document.getElementById('rawm_id').value;
                                    var rawm_name = document.getElementById('rawm_name').value;
                                    var r_quantity = document.getElementById('r_quantity').value;
                                    var r_unit_id = document.getElementById('r_unit_id').value;
                                    var nameunit = $('#r_unit_id option:selected').text();
                                    newrow = '<tr><td ><input  class="form-control"    value="' + rawm_name + ' "type="text" disabled><input  value="' + rawm_id + '"  type="text" name="rawmid[' + idinc + ']"  class="hidden cre form-control"/></td>' + '<td ><input  class="form-control"  name="rqty[' + idinc + ']"  value="' + r_quantity + ' "type="text"></td>' + '<td ><input  class="form-control"    value="' + nameunit + ' "type="text" disabled><input  value="' + r_unit_id + '"  type="text" name="r_unitid[' + idinc + ']"  class="hidden cre form-control"/></td>' +
                                            '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                    if (rawm_id != '' && r_quantity != '')
                                    {
                                        $("#rowm").append(newrow);
                                        $('#rawm_name').val('');
                                        $('#r_quantity').val('');
                                    }

                                });
                                $(document).on('click', ".remove", function () {
                                    $('.tooltip').remove();
                                    $(this).closest('tr').remove();
                                });
                            });
                            var id = $("#id").val();
                            //bmm_id  main_item_id    bmm_quantity    updatedate  mainitemid  mainitemname    subqty  subitemid   subitemname 

                            if (id != 0)
                            {
                                $.ajax({
                                    url: "<?php echo site_url('material/material_bill/getsing'); ?>/" + id,
                                    success: function (result) {
                                        $.each(JSON.parse(result), function (i, itemsingle) {
                                            var rawm_id = itemsingle.subitemid;
                                            var rawm_name = itemsingle.subitemname;
                                            var r_quantity = itemsingle.subqty;
                                            var nameunit = itemsingle.subunit;
                                            var r_unit_id = itemsingle.subunitid;
                                            $('#product_name').val('');
                                            $('#product_name').val(itemsingle.mainitemname);
                                            $('#product_id').val(itemsingle.main_item_id);
                                            $('#p_quantity').val(itemsingle.bmm_quantity);
                                            $('#p_unit_id').val(itemsingle.mainunitid);
                                            newrow = '<tr><td ><input  class="form-control"    value="' + rawm_name + ' "type="text" disabled><input  value="' + rawm_id + '"  type="text" name="rawmid[' + idinc + ']"  class="hidden cre form-control"/></td>' + '<td ><input  class="form-control"  name="rqty[' + idinc + ']"  value="' + r_quantity + ' "type="text"></td>' +
                                                    '<td ><input  class="form-control"    value="' + nameunit + ' "type="text" disabled><input  value="' + r_unit_id + '"  type="text" name="r_unitid[' + idinc + ']"  class="hidden cre form-control"/></td>' +
                                                    '<td><span data-toggle="tooltip" title="Remove"   class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span></td></tr>';
                                            $("#rowm").append(newrow);


                                        });

                                    }
                                });
                            }
                            $("#product_name").autocomplete({
                                source: "<?php echo site_url('material/material_bill/mainitem'); ?>",
                                minLength: 2,
                                select: function (event, ui) {
                                    loaditema(ui);
                                }
                            });
                            $("#rawm_name").autocomplete({
                                source: "<?php echo site_url('material/material_bill/subitems'); ?>",
                                minLength: 2,
                                select: function (event, ui) {
                                    loaditemb(ui);
                                }
                            });
                            var inc_inary = 0;
                            $(document).on('click', ".remove", function () {
                                $('.tooltip').remove();
                                $(this).closest('tr').remove();
                            });
                            var idinc = 0;
                            function loaditema(ui) {
                                $('#product_name').val(ui.item.label);
                                $('#product_id').val(ui.item.id);
                                $('#p_quantity').focus();
                            }
                            function loaditemb(ui) {
                                $('#rawm_name').val(ui.item.label);
                                $('#rawm_id').val(ui.item.id);
                                $('#r_quantity').focus();
                            }

                        </script> 