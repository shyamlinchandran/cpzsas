<style>
    .box-title {
        text-transform: capitalize;
    }
</style>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="<?= $this->box_color ?>">

                <div class="box-header">
                    <h3 class="box-title"><?php echo ucwords(str_replace('_', ' ', $titles)) ?></h3>
					<input type="hidden" id="report_header" value="<?php echo $titles;?>"/>
					<input type="hidden" id="file_header" value="<?php echo str_replace(" ","_",$titles);?>"/>
                </div>
                <div class="box-body table-responsive">
                    <table class="table table-strippped table-condensed" cellspacing="0" width="100%">
                        <tbody>
                            <tr>

                                <td class="col-sm-2">
                                    Start Date
                                    <input type="text" class="form-control date" id="startdate" />
                                </td>

                                <td class="col-sm-2">
                                    End Date
                                    <input type="text" class="form-control date" id="enddate" />
                                </td>
                                <!-- <td class="col-sm-2">
                                    ?= label('Customer', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="customer_id" id="customer_id" />
                                    <input name="supname" id="supname" type="text" NoTab="true" data-validation="required,length" data-validation-length="min2" class="form-control" placeholder="customer">
                                </td> -->
                                <td class="col-sm-2">
                                    <?= label('Brand', $this, $user) ?>
                                    <input data-validation="required" type="hidden" name="brand_id" id="brand_id" />
                                    <input name="brand" id="brand" type="text" NoTab="true" data-validation="required,length" data-validation-length="min2" class="form-control" placeholder="Brand">
                                </td>
                                <td>
                                    <br />
                                    <input type="button" class="btn btn-success" id="btn-filter" value="<?= label('Search', $this, $user) ?>" />
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>

                <div class="box-body table-responsive">

                    <div class="table-responsive">
                        <table id="table" class="table <?= $this->table_color ?> " cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th><?= label('No', $this, $user) ?></th>
                                    <th><?= label('Item Name', $this, $user) ?></th>
                                    <th><?= label('Opening Stock', $this, $user) ?></th>
                                    <th><?= label('Purchase', $this, $user) ?></th>
                                    <th><?= label('Purchase Return', $this, $user) ?></th>
                                    <th><?= label('Sales', $this, $user) ?></th>
                                    <th><?= label('Sales Return', $this, $user) ?></th>
                                    <th><?= label('Free Quentity', $this, $user) ?></th>
                                    <th><?= label('Damage Stock', $this, $user) ?></th>
                                    <th><?= label('Stock Issue', $this, $user) ?></th>
                                    <th><?= label('Stock Received', $this, $user) ?></th>
                                    <th><?= label('Closing Stock', $this, $user) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>


                        </table>
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
    $.validate({
        modules: 'date, security,file'
    });
    var table;
    var id = 0;
    var now = new Date();
    var jsDate = now.getDate() + '-' + (now.getMonth() + 1) + '-' + now.getFullYear();

    function ms() {
        if (id === 1) {
            table.destroy();
        }
        id = 1;
        //datatables
        table = $('#table').DataTable({
            "language": lan,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            'dom': "<'row'<'col-sm-6'l><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
            "fnDrawCallback": function() {
                loadpermission();
            },
            'buttons': [],
            "order": [],


            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/Stock_movement_report/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    // data.supname = $("#supname").val();
                    // data.customer_id = $("#customer_id").val();
                    data.brand = $("#brand").val();
                    data.brand_id = $('#brand_id').val();
                    data.startdate = $("#startdate").val();
                    data.enddate = $("#enddate").val();
                }
            },

            "columnDefs": [{
                "targets": [0], //first column / numbering column
                "orderable": false //set not orderable
            }]



        });
        loadpermission();
        $('#btn-filter').click(function() { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function() { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table

        });
      }
   
    // $("#supname").autocomplete({
    //     source: "<?php echo site_url('reports/Stock_movement_report/customers'); ?>",
    //     minLength: 2,
    //     select: function(event, ui) {
    //         loadCust(ui);

    //     }
    // });

    $("#brand").autocomplete({
        source: "<?php echo site_url('reports/Stock_movement_report/brand'); ?>",
        minLength: 2,
        select: function(event, ui) {
            loadCust(ui);

        }
    });

    function loadCust(ui) {
        $('#supname').val(ui.item.name);
        $('#customer_id').val(ui.item.id);
    }
    $('#btn-filter').click(function() { //button filter event click

        ms();
        //  table.ajax.reload(null, false);  //just reload table
    });
    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(null, false); //just reload table
    });
</script>