<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content"> 
    <div class="row">
        <div class="col-xs-12"> 
            <div class="<?=$this->box_color?>">

                <div class="box-header">
                    <h3 class="box-title"><?= label('Sales Vehicle Reports', $this, $user) ?></h3>

                </div>

                <div class="box-body">
                    <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    <?= label('Start Date', $this, $user) ?>
                                    <input type="text" class="form-control date" id="startdate"/>
                                </td>
                                <td class="col-sm-2">
                                    <?= label('End Date', $this, $user) ?> 
                                    <input type="text" class="form-control date" id="enddate"/> 
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Customer', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="customer_id" id="customer_id"/><input name="cusname" id="cusname" type="text" NoTab="true"    data-validation="required,length" data-validation-length="min2"   class="form-control" placeholder="Customer">
                                </td>
                                <td class="col-sm-2">
                                    <?= label('Vehicle', $this, $user) ?>
                                    <input type="text" style="width: 100%" name="vehicle" data-validation='required' id="vehicle"    > 
                                    <input type="hidden" id='vehicle_id' name="vehicle_id">
                                <td>
                                <td class="col-sm-2">
                                    <?= label('Driver', $this, $user) ?>
                                    <select style="width:100%" id="driver" name="driver">

                                    </select>
                                </td>
                                <td class="col-sm-2">
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                    <input type="button" class="btn btn-success" id="btn-reset"  value="<?= label('Reset', $this, $user) ?>"/>
                                </td>


                            </tr>
                        </tbody>
                    </table>  
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Start Date', $this, $user) ?></th>
                                <th><?= label('End Date', $this, $user) ?></th>
                                <th><?= label('Vehicle', $this, $user) ?></th>
                                <th><?= label('Driver', $this, $user) ?></th>
                                <th><?= label('Customer', $this, $user) ?></th>
                                <th><?= label('Total', $this, $user) ?></th>
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

    $(document).ready(function () {
        $.ajax({
            url: "<?php echo site_url('ajaxcall/driver/0'); ?>",
            success: function (result) {
                $('#driver').html(result);
            }
        });
        $("#vehicle").autocomplete({
            minLength: 1,
            select: function (event, ui) {
                $('#vehicle_id').val(ui.item.id);
            },
            source: function (req, add) {
                $.ajax({
                    url: "<?php echo base_url(); ?>sales_vehicle/Sales_vehicle/vehicle_lookup",
                    dataType: 'json',
                    type: 'POST',
                    data: req,
                    success: function (data) {
                        if (data.response === "true") {
                            add(data.message);
                        }
                    }
                });
            }
        });
        $("#cusname").autocomplete({
            source: "<?php echo site_url('ajaxcall/suppliers'); ?>",
            minLength: 2,
            select: function (event, ui) {
                $('#customer_id').val(ui.item.id);
            }
        });

        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "scrollX": false,
            "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                    "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            'buttons': [
            ],
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('veh_reports/Trip_reports/ajax_list') ?>",
                "type": "POST",
                "data": function (data) {
                    data.startdate = $('#startdate').val();
                    data.enddate = $('#enddate').val();
                    data.customer_id = $('#customer_id').val();
                    data.vehicle_id = $('#vehicle_id').val();
                    data.driver = $('#driver').val();

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
            $('#customer_id').val('');
            $('#vehicle_id').val('');
            $('#driver').val('');
            $('#cusname').val('');
            $('#vehicle').val('');
            table.ajax.reload(null, false);  //just reload table
        });


    });

</script>  