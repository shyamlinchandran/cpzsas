<?php
$customer = '';
if ($settings[0]['is_kitcustomer'] == 0) {
    $customer = 'disabled';
}
?> 
<form method="post"  id="frmcreate" back="<?php echo site_url('kitgroup/listall/' . $type); ?>" action="<?php echo site_url('kitgroup/save'); ?>"  class="form-horizontal">
    <input type="hidden" value="<?= $type ?>" name="type" id="type" />
    <input type="hidden" value="<?= $id ?>" name="id" id="id" />
    <input type="hidden" value="<?php echo $settings[0]['is_kitcustomer']; ?>" id="is_kitcustomer" name="is_kitcustomer"/>
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= label($title, $this, $user) ?> Create</h3>
                        <span class="pull-right">
                            <a role="button" back="<?php echo site_url('kitgroup/listall/' . $type); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('kitgroup/listall/' . $type); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-6  odd_cls">
                                <label class="col-sm-4 control-label" >
                                    <?= label($title, $this, $user) ?> *<span class="required"></span> :
                                </label>
                                <div class="col-sm-8" >
                                    <input id="kit_name" class="form-control" name="kit_name" type="text"
                                           value="" data-validation="required" maxlength="250">
                                </div>
                            </div>
                            <?php if ($type == 'price_code') { ?>
                                <!--  <label class="col-sm-2 control-label" >
                                     Customer *<span class="required"></span> :
                                 </label>
                                 <div class="col-sm-4" >
                                     <input data-validation type="hidden"   name="customer_id" id="customer_id"/> <input name="cusname"  <?php echo $customer; ?> id="cusname" type="text" NoTab="true"    data-validation   class="form-control" placeholder="Customer">
                                 </div> -->
                            <?php } ?>

                        </div>
                        <div class="col-sm-6 form-group  odd_cls">
                            <table class="table table-striped table-condensed">
                                <tr>
                                    <th><?= label('Item', $this, $user) ?></th>
                                    <?php
                                    if ($type == 'price_code') {
                                        echo " <th>" . label('Stock Rate', $this, $user) . "</th>";
                                    } else {
                                        echo " <th>" . label('Quantity', $this, $user) . "</th>";
                                    }
                                    ?>

                                    <th><?= label('Rate', $this, $user) ?></th>
                                    <th></th>
                                </tr>
                                <tr>
                                    <td> 
                                        <input id="product_name" class="form-control" name="product_name" type="text" value=""  placeholder="<?= label('Item Name', $this, $user) ?>" maxlength="250">
                                        <input id="product_id" class="form-control" name="product_id" type="hidden"> 
                                    </td>  
                                    <td>
                                        <input id="p_quantity" class="form-control two-digits price" name="p_quantity" type="text" value="" maxlength="50" placeholder=" <?php
                                        if ($type == 'price_code') {
                                            echo label('Stock Rate', $this, $user);
                                        } else {
                                            echo label('Quantity', $this, $user);
                                        }
                                        ?>" >
                                    </td>
                                    <td>
                                        <input id="p_rate" class="form-control two-digits price" name="p_rate" type="text" value="" maxlength="50" placeholder="<?= label('Rate', $this, $user) ?>" >
                                    </td>
                                    <td> 
                                        <button data-toggle="tooltip" type="button"  id="addmore"  title="Add To save"   class="btn btn-success" href="#">
                                            <span class="glyphicon glyphicon-plus"></span> 
                                        </button>
                                    </td>
                                <tbody id="rows">

                                </tbody>


                                </tr>
                            </table>

                        </div>


                        <!-- /.box -->
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

        $(document).ready(function () {
            $("#cusname").autocomplete({
                source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    $('#customer_id').val(ui.item.id);

                }
            });
            $("#product_name").autocomplete({
                source: "<?php echo site_url('ajaxcall/items'); ?>",
                minLength: 2,
                select: function (event, ui) {
                    var type = $('#type').val();
                    $('#product_id').val(ui.item.id);
                    $('#product_name').val(ui.item.name);
                    $('#p_rate').val(ui.item.srate);
                    $('#p_quantity').val(0);
                    if (type == 'price_code') {
                        $('#p_quantity').val(ui.item.prate);
                    }
                    $('#p_quantity').focus();
                    if (type == 'price_code') {
                        $('#p_quantity').val(ui.item.prate);
                    } else {
                        $('#p_quantity').focus().select();
                    }
                }
            });
            load();

        });
        $("#p_rate").keydown(function (e) {
            var product_name = $('#product_name').val();
            var p_quantity = $("#p_quantity").val();
            var product_id = $("#product_id").val();
            var p_rate = $("#p_rate").val();
            if (p_quantity !== '' && product_id !== '') {
                var key = e.charCode || e.keyCode || 0;
                if (key === 13 || key === 9) {
                    addrowtokit(product_name, product_id, p_quantity, p_rate);
                }
            }

        });
        $("#addmore").click(function () {
            var product_name = $('#product_name').val();
            var p_quantity = $("#p_quantity").val();
            var product_id = $("#product_id").val();
            var p_rate = $("#p_rate").val();
            if (p_quantity !== '' && product_id !== '') {
                addrowtokit(product_name, product_id, p_quantity, p_rate);

            }
        });

        function addrowtokit(product_name, product_id, p_quantity, p_rate) {
            $("#product_name").val('');
            $("#p_quantity").val('');
            $("#product_id").val('');
            $("#p_rate").val('');
            var newrow = '<tr><td><input id="productname[]" readonly="readonly" class="form-control" name="productname[]" type="text" value="' + product_name + '" data-validation="required" placeholder="Itemname" maxlength="250"><input id="productid[]" class="form-control" name="productid[]" value="' + product_id + '" type="hidden"></td>' +
                    ' <td> <input id="pquantity[]" readonly="readonly" class="form-control two-digits price" name="pquantity[]" type="text" value="' + p_quantity + '" maxlength="50" placeholder="Quantity" data-validation="required"></td>' +
                    ' <td><input id="prate[]" readonly="readonly" class="form-control two-digits price" name="prate[]" type="text" value="' + p_rate + '" maxlength="50" placeholder="Quantity" data-validation="required"></td>' +
                    '<td> <span data-toggle="tooltip"   title="Remove" onclick="removekit(this)"    class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span>     </span> </td></tr>';
            $("#rows").append(newrow);
        }
        function removekit(btn) {
            $(btn).closest('tr').remove();
        }
        function clearservice() {

        }
        function loadCustByid(id) {
            $.ajax({
                url: "<?php echo site_url('ajaxcall/customer'); ?>/" + id,
                success: function (results) {
                    var result = JSON.parse(results)[0];
                    $('#cusname').val(result.name);
                    $('#customer_id').val(result.id);
                }
            });
        }
        function load() {
            var id = $("#id").val();
            if (id !== '0') {
                var customer = 0;
                $.ajax({
                    url: "<?php echo site_url('Kitgroup/kit_items'); ?>/" + id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                            $('#kit_name').val(itemsingle.name);
                            customer = itemsingle.customer_id;
                            addrowtokit(itemsingle.item, itemsingle.item_id, itemsingle.quantity, itemsingle.rate);
                        });
                        if (customer !== "0") {
                            loadCustByid(customer);
                        }

                    }
                });
            }
        }


    </script> 