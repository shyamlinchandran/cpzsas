<?php
$add_url = site_url('reports/items/refreshreport');
$type = 'item';
?> 

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
                    <h3 class="box-title"> <?= label('Export Reports', $this, $user) ?></h3>
                    <span class="pull-right">
                        <button type="button" class="btn  btn-success align-bottom" id="btn">
                           Refresh
                        </button>
                    </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                 <table   class="table <?=$this->table_color?>" cellspacing="0" width="100%">
                        <tbody>
                            <tr>
                                <td class="col-sm-2">
                                    <?= label('Status', $this, $user) ?>
                                    <select id="status"  class="form-control" name="status">
                                        <option value="completed">Completed</option>
                                        <option value="created">Created</option>
                                    </select>      
                                </td>
                                <td class="col-sm-2">
                                    Type
                                    <select id="type"  class="form-control" name="type">
                                        <option value="">All</option>
                                        <option value="stock_report">Stock Report</option>
                                    </select> 
                                </td>
                                 <td>
                                    <br/>
                                    <input type="button" class="btn btn-success" id="btn-filter"  value="<?= label('Search', $this, $user) ?>"/>
                                </td>
                             </tr>
                                                     </tbody>

                        </table>
                    <table id="table"  class="table <?=$this->table_color?> table-responsive" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th> <?= label('SNo', $this, $user) ?></th>
                                <th><?= label('Created Date', $this, $user) ?></th>
                                <th><?= label('Type', $this, $user) ?></th>
                                <th> <?= label('Status', $this, $user) ?></th>
                                <th> <?= label('Filter', $this, $user) ?></th>

                                <th><?= label('Actions', $this, $user) ?></th>
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
        $('#btn').click(function(){

           $.ajax({
    url: "<?php echo site_url('reports/items/refreshreport'); ?>",
    type: 'POST',
    dataType: 'json',
    success: function(response) {
        if (response.success) {
            // Only reload the table if the API call was successful
            table.ajax.reload(null, false);
        } else {
            // Show error message if the API call failed
        }
    },
    error: function(xhr, status, error) {
        // Handle AJAX errors
    }
});
});
        //datatables
        table = $('#table').DataTable({
            "language": lan, "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            //"scrollX": true,
           "lengthMenu": [[10, 25, 50, 100], [10, 25, 50, 100]],
            //"<'row'<'col-sm-6'><'col-sm-2  text-right 'B><'col-sm-4 pull-right'f >>" +
            'dom': "<'row'<'col-sm-12'tr>>" +
                    "<'row'<'col-sm-5 align-middle'li><'col-sm-7'p>>",

            "order": [], //Initial no order.
            "fnDrawCallback": function () {
                loadpermission();
            },
            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reports/items/export_report_list') ?>",
                "async": "false",
                "type": "POST",
                "data": function (data) {
                    data.status = $('#status').val();
                    data.type = $('#type').val();

                }
            },
            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [0], //first column / numbering column
                    "orderable": false //set not orderable
                }]

        });

        $('#btn-Search').click(function () {
            table.search(value).draw();
        });
        $('#btn-Clear').click(function () {
            table.search(value).draw();
        });

        $('.dataTables_filter input').unbind().keyup(function () {


        });
        $('#btn-filter').click(function () { //button filter event click
            table.ajax.reload(null, false); //just reload table
        });
        $('#btn-reset').click(function () { //button reset event click
            $('#form-filter')[0].reset();
            table.ajax.reload(null, false); //just reload table
        });
    });



</script>  