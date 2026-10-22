<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">
                <div class="box-header">
                    <h3 class="box-title"><?= label('Item  Report', $this, $user) ?></h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Godown', $this, $user) ?>
                                    <select id="item_godown"  class="form-control" name="item_godown">
                                        <option value="">Select</select>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Hsn', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="hsnid" id="hsnid"/><input name="hsn" id="hsn" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="<?= label('Hsn', $this, $user) ?>"></td>
                                <td class="col-sm-2">
                                    Category
                                    <select id="category"  class="form-control" name="category">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
                                 <td class="col-sm-2">
                                     <?= label('Tax', $this, $user) ?>
                                    <select id="tax"  class="form-control" name="tax">
                                        <option value=""><?= label('Select', $this, $user) ?></select>
                                    </select> 
                                </td>
                                <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>

                              
                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th><?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Name', $this, $user) ?></th>
                                <th><?= label('HSN', $this, $user) ?></th>
                                <th><?= label('Unit', $this, $user) ?></th>
                                <th><?= label('Godown', $this, $user) ?></th>
                                <th><?= label('Quantity', $this, $user) ?></th>
                                 <th><?= label('Current Stock', $this, $user) ?></th>
                                <th><?= label('Opening Stock', $this, $user) ?></th>
                                <th><?= label('Opening Stock Rate', $this, $user) ?></th>
                                <th><?= label('Sale Rate', $this, $user) ?></th>
                                <th><?= label('MRP', $this, $user) ?></th>
                            </tr>
                        </thead>
                        <tbody>
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

    var table;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();
    $(document).ready(function () {
        $("#hsn").autocomplete({
            source: "<?php echo base_url(); ?>ajaxcall/hsn", // path to the get_birds method
            minLength: 2,
            select: function (event, ui) {
                $("#hsnid").val(ui.item.hsnid);
                $("#btn-filter").focus();
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/godown'); ?>",
            success: function (result) {
                $('#item_godown').html(result);
                $('#item_godown').append(
                        $('<option></option>').val("").html('all')
                        );
            }
        });
        $.ajax({
            url: "<?php echo site_url('ajaxcall/itemgroup'); ?>",
            success: function (result) {
                $('#category').html(result);

            }
        });
         $.ajax({
            url: "<?php echo site_url('ajaxcall/tax'); ?>",
            success: function (result) {
                $('#tax').html(result);

            }
        });
        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "buttons": [],

            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/items/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.tax=$("#tax").val();
                    data.godown = $("#item_godown").val();
                    data.hsn = $("#hsnid").val();
                    data.category=$("#category").val();
                    $("#hsnid").val('');
                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false);  //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  
