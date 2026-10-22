<form method="post"  id="frmcreate" back="<?php echo site_url('transaction/sales/listall/sales'); ?>" action="<?php echo site_url('transaction/sales_check/save'); ?>"  class="form-horizontal">
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
                            <a role="button" back="<?php echo site_url('transaction/sales/listall/sales'); ?>" class="btn  btn-success align-bottom" href="<?php echo site_url('transaction/sales/listall/sales'); ?>">
                                <span class="glyphicon glyphicon-arrow-left" title="back"></span> 
                            </a>
                        </span>
                    </div> 
                    <div class="box-body"> 

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <td>

                                    </td>
                                    <td >
                                       <?= label('Please enter Barcode here', $this, $user) ?> 
                                    </td>
                                    <td>
                                        <input  value=""  type="text" id="txtSearchBarcode"  onchange="itemsearch()"  class="cre form-control" placeholder="<?= label('Barcode', $this, $user) ?>"/>
                                    </td>
                                    <td>
                                        <p id="msg" class="danger"></p>
                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                                
                                <tr>
                                    <th><?= label('Barcode', $this, $user) ?></th>
                                    <th><?= label('Item', $this, $user) ?></th>
                                    <th><?= label('Quantity', $this, $user) ?></th>
                                    <th><?= label('Confirm', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody id="rowma">

                            </tbody>
                        </table>

                    </div>
                    <div class="box-footer">
                        <?php if ($view != 'view') { ?>
                            <button id="form-button-save"  type='submit' data-toggle="tooltip"   title='Save' class='btn bg-orange btn-flat'> <i class="glyphicon glyphicon-hdd"></i> </button>         
                        <?php } ?>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
        </div>
    </section>
</form>
<script type="text/javascript">

    $(document).ready(function () {
        $('#txtSearchBarcode').focus();
        $('#mybtn').click(function () {
            var ms = $("#frmcreate").isValid();
            if (ms !== true) {
                return;
            }
        });
        load();
    });
    var idinc = 0;
    function multiple_items(barcode, name, quantity, item_id, sal_itms_id, delivered_qty) {
        var newrow = '<tr><td><input  class="form-control" id="itemcode_old' + idinc + '"   value="' + barcode + ' "type="text" disabled><input  value="' + item_id + '"  type="text" name="item_ids[]" id="item_ids' + idinc + '"  class="hidden cre form-control" readonly=""/></td>' +
        '<input type="hidden" value="' + sal_itms_id + '" name="sale_items_id[]"/></td>' + 
                '<td><input  class="form-control"    value="' + name + ' "type="text" readonly=""></td>' +
                '<td><input  value="' + quantity + '"  type="text" id="item_qtys' + idinc + '" name="item_qtys[]"  class="cre form-control" readonly=""/></td>' +
                // '<td><</td>' +
                '<td><input  value="' + delivered_qty + '"  type="text" id="check_item_qtys' + sal_itms_id + '" name="check_item_qtys[]"  class="cre form-control"  placeholder="Quantity" readonly=""/></td></tr>';
        $("#rowma").append(newrow);
        idinc++;
    }
    var inc_inary = 0;
    function load() {
        var id = $("#id").val();
        //alert(id);
        if (id > 0) {
            $.ajax({
                url: "<?php echo site_url('transaction/sales_check/check_items'); ?>/" + id,
                success: function (result) {
                    $.each(JSON.parse(result), function (i, itemsingle) {
                        multiple_items(itemsingle.barcode, itemsingle.name, itemsingle.quantity, itemsingle.item_id, itemsingle.sal_itms_id,itemsingle.delivered_qty);
                    });
                }
            });
        }
    }
    function itemsearch(rowid) {
        $("#msg").html('');
        var text = $("#txtSearchBarcode").val();
        var customer = '';
        $.getJSON('<?php echo base_url(); ?>ajaxcall/itemssearchsale/<?= $id ?>?', {term: text}, function (result) {
            if (result != null) {
                var val = $("#check_item_qtys" + result.sal_itms_id).val();
                var rs = parseInt(val) + 1;
                if (rs <= result.quantity) {
                    $("#check_item_qtys" + result.sal_itms_id).val(rs)
                } else {
                    $("#msg").html('<?= label('Already Done Please check the quantity', $this, $user) ?>');
                }
            }else {
                $("#msg").html('<?= label('Item not present in this sale', $this, $user) ?>');
            }
        });
        $("#txtSearchBarcode").val('');
        $("#txtSearchBarcode").focus();
    }
    function itemSelect(id)
    {
        showbtn(0);
        $("#itemcode").val(srate);
    }
    $("#itemcode").keydown(function (e) {
        var key = e.charCode || e.keyCode || 0;
        if (key === 13 || key === 9)
        {
            if ($("#check_item_qtys").val() === 0 || $("#check_item_qtys").val() === '') {
                $("#check_item_qtys").val(1);
            }
            e.preventDefault();
            e.stopPropagation();
            $("#itemcode").focus().select();
        }
    });
    function calert(msg) {
        toastr["error"](msg);
    }
</script>
