<?php
$add_url = site_url('item/printbarcode');
$type = 'item';
?> 
<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<form method="post" id="frmcreate"   home="<?php echo site_url('main/members/index'); ?>" back="<?php echo site_url('MultipleBarcode/list_all'); ?>" action="<?php echo site_url('item/printbarcode'); ?>"   class="form-horizontal">
    <section class="content"> 
        <div class="row">
            <div class="col-xs-12"> 
                <div class="<?=$this->box_color?>">
                    <input type="hidden" id="id" name="id" value="<?php echo $id; ?>"/> 
                    <input type="hidden" id="iname" name="iname"/> 
                    <div class="box-header">
                        <h3 class="box-title"> <?= label('Barcode Master', $this, $user) ?></h3>
                        <span class="pull-right">
                            <button id="form-button-save" tp="pdf" type='submit' data-toggle="tooltip"   title='Save' class='btn bg-success btn-flat'> <i class="glyphicon glyphicon-print"></i> </button>           
                            <div class='small-loading' id='FormLoading'> </div>
                        </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="col-sm-12">
                            <div class="col-sm-5 form-group odd_cls" >
                                <label class="col-sm-4 control-label">
                                    <?= label('Barcode Batch', $this, $user) ?> <span class="required"></span> :
                                </label>
                                <div class="col-sm-8">
                                    <input name="batch_name" id="batch_name" class="form-control"  type="text" value="" maxlength="50">
                                </div>
                            </div>
                            <div class="col-sm-6 form-group" >

                            </div>

                        </div>
                        <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                            <tr>
                                <td class="col-sm-4">
                                    <?= label('Item Name', $this, $user) ?> 
                                    <input type="hidden" class="form-control" id="toid"/> 
                                    <input  NoTab="true" type="text" class="form-control" id="name"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Quantity', $this, $user) ?> 
                                    <input  NoTab="true" type="text" class="form-control text-right  two-digits price " id="qty"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Barcode', $this, $user) ?> 
                                    <input  NoTab="true" type="text" class="form-control" id="barcode"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Sales Rate', $this, $user) ?> 
                                    <input  NoTab="true" type="text" class="form-control text-right  two-digits price " id="srate"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('MRP', $this, $user) ?> 
                                    <input  NoTab="true" type="text" class="form-control text-right  two-digits price " id="MRP"/> 
                                </td>
                                <td>
                                    <?= label('Action', $this, $user) ?> </br >
                                    <button data-toggle="tooltip" type="button"    title="Add To save" id="btnAddExtra"  class="btn btn-success" href="#">
                                        <span class="glyphicon glyphicon-plus"></span> 
                                    </button>
                                </td>
                            </tr>
                            <tbody id="rowm">
                            </tbody>
                        </table>  

                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <script type="text/javascript">
//        $('#form-button-save').attr('disabled', 'disabled');
        load();
        $("#name").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/barcodesearch", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $('#iname').val(ui.item.name);
                $("#toid").val(ui.item.id);
                $("#barcode").val(ui.item.barcode);
                $("#srate").val(ui.item.rate);
                $("#MRP").val(ui.item.MRP);
                $("#qty").focus();

                loadCust(ui)
            }
        });
        function loadCust(ui) {
            $('#name').val(ui.item.name);
        }
        $("#MRP").keydown(function (e) {
            var id = $("#toid").val();
            var itemname = $("#iname").val();
            var quantity = $("#qty").val();
            var barcode = $("#barcode").val();
            var mrp = $("#MRP").val();
            var srate = $("#srate").val();
            var key = e.charCode || e.keyCode || 0;
            if (key === 13 || key === 9) {
                if (id != "" && quantity != "") {
                    addrowtotable(id, itemname, quantity, barcode, mrp, srate);
                }
            }
        });
        function remove(btn) {
            $(btn).closest('tr').remove();
        }
        function clear() {
            $("#toid").val("");
            $("#name").val("");
            $("#qty").val("");
            $("#barcode").val("");
            $("#MRP").val("");
            $("#srate").val("");
            $("#iname").val("");
        }
        function  addrowtotable(id, itemname, quantity, barcode, mrp, srate) {
            clear();
            var rowval = '<td class="col-sm-4"><input type="text" readonly="readonly" name="item_name[]" class="form-control" value="' + itemname + '"><input name="item_id[]" value="' + id + '" type="hidden"></td>';
            rowval = rowval + '<td class="col-sm-2"><input type="text" name="item_qty[]"  class="form-control" value="' + quantity + '"></td>' + '<td class="col-sm-2"><input type="text" name="item_barcode[]" class="form-control" value="' + barcode + '"></td>';
            rowval = rowval + '<td class="col-sm-2"><input type="text" name="item_rate[]" readonly="readonly" class="form-control" value="' + srate + '"></td>' + '<td class="col-sm-2"><input type="text" name="item_MRP[]" readonly="readonly" class="form-control" value="' + mrp + '"></td>';
            rowval = rowval + '<td><span data-toggle="tooltip"   title="Remove" onclick="remove(this)"  class="btn btn-danger remove" href="#">  <span class="glyphicon glyphicon-remove-sign"></span></span></td>';
            var newRow = "<tr>" + rowval + "</tr>";
            $("#rowm").append(newRow);
        }
        function load() {
            var id = $("#id").val();
            if (id > 0) {
                $.ajax({
                    url: "<?php echo site_url('ajaxcall/barcode_batch'); ?>/" + id,
                    success: function (result) {
                        $.each(JSON.parse(result), function (i, itemsingle) {
                             $("#batch_name").val(itemsingle.batch_name);
                            addrowtotable(itemsingle.item_id, itemsingle.item_name, itemsingle.quantity, itemsingle.barcode, itemsingle.mrp, itemsingle.rate)
                        });
                    }
                });
            }
        }
    </script>


